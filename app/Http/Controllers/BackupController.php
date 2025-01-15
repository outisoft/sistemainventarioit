<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:backup.index')->only('index');
        $this->middleware('can:backup.create')->only('create');
        $this->middleware('can:backup.download')->only('download');
        $this->middleware('can:backup.restore')->only('restore');
    }

    public function index()
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $files = collect();

            // Buscar en diferentes rutas posibles
            $possiblePaths = [
                'Laravel/',  // Ruta con L mayúscula
                'laravel/',  // Ruta con l minúscula
                '',         // Directorio raíz
            ];

            foreach ($possiblePaths as $path) {
                if ($disk->exists($path)) {
                    $pathFiles = $disk->files($path);
                    $files = $files->concat(
                        collect($pathFiles)->filter(function ($file) {
                            return in_array(pathinfo($file, PATHINFO_EXTENSION), ['zip', 'sql']);
                        })
                    );
                }
            }

            // Log para debugging
            \Log::info('Archivos encontrados:', [
                'files' => $files->toArray(),
                'disk_path' => $disk->path(''),
                'storage_path' => storage_path('app')
            ]);

            return view('backup.index', compact('files'));
        } catch (\Exception $e) {
            \Log::error('Error al listar backup: ' . $e->getMessage());
            return view('backup.index', ['files' => collect()])
                ->with('error', 'Error al listar los respaldos: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {            
            Artisan::call('backup:run', ['--only-db' => true]);
            
            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó respaldo correctamente.");

            return redirect()->route('backup.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear respaldo: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            
            // Posibles rutas donde podría estar el archivo
            $possiblePaths = [
                'Laravel/' . $filename,
                'laravel/' . $filename,
                $filename
            ];

            // Buscar el archivo en las posibles rutas
            $filePath = null;
            foreach ($possiblePaths as $path) {
                if ($disk->exists($path)) {
                    $filePath = $path;
                    break;
                }
            }

            if (!$filePath) {
                \Log::error('Archivo no encontrado', [
                    'filename' => $filename,
                    'paths_checked' => $possiblePaths
                ]);
                abort(404, 'Archivo de respaldo no encontrado');
            }

            return response()->download(
                $disk->path($filePath),
                $filename,
                [
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"'
                ]
            );
        } catch (\Exception $e) {
            \Log::error('Error al descargar backup: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al descargar el archivo: ' . $e->getMessage());
        }
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        try {
            $file = $request->file('backup_file');
            
            // Credenciales de la base de datos
            $dbHost = config('database.connections.mysql.host');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbName = config('database.connections.mysql.database');

            // Leer el contenido del archivo SQL
            $sqlContent = file_get_contents($file->getRealPath());
            
            // Crear archivo temporal para los INSERTs validados
            $tempFile = storage_path('app/temp_' . uniqid() . '.sql');
            $validStatements = [];

            // Obtener todas las sentencias SQL
            $statements = array_filter(
                explode(";\n", str_replace(";\r\n", ";\n", $sqlContent))
            );

            foreach ($statements as $statement) {
                $statement = trim($statement);
                
                // Procesar solo sentencias INSERT
                if (stripos($statement, 'INSERT INTO') === 0) {
                    // Extraer nombre de la tabla
                    preg_match('/INSERT INTO [`]?(\w+)[`]?/i', $statement, $matches);
                    
                    if (!empty($matches[1])) {
                        $tableName = $matches[1];
                        
                        // Validar que la tabla existe
                        if(DB::getSchemaBuilder()->hasTable($tableName)) {
                            // Añadir sentencias de desactivación/activación de claves
                            if (!in_array("/*!40000 ALTER TABLE `{$tableName}` DISABLE KEYS */", $validStatements)) {
                                $validStatements[] = "/*!40000 ALTER TABLE `{$tableName}` DISABLE KEYS */";
                            }
                            
                            $validStatements[] = $statement;
                            
                            if (!in_array("/*!40000 ALTER TABLE `{$tableName}` ENABLE KEYS */", $validStatements)) {
                                $validStatements[] = "/*!40000 ALTER TABLE `{$tableName}` ENABLE KEYS */";
                            }
                        } else {
                            Log::warning("Tabla no encontrada: {$tableName}");
                        }
                    }
                }
            }

            if (empty($validStatements)) {
                throw new \Exception('No se encontraron sentencias INSERT válidas en el archivo.');
            }

            // Guardar sentencias validadas en archivo temporal
            file_put_contents($tempFile, implode(";\n", $validStatements) . ';');

            // Desactivar verificaciones de claves foráneas
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Ejecutar archivo SQL
            $command = sprintf(
                'mysql -h %s -u %s -p%s %s < %s',
                escapeshellarg($dbHost),
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbName),
                escapeshellarg($tempFile)
            );

            exec($command . ' 2>&1', $output, $returnVar);

            // Reactivar verificaciones de claves foráneas
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Limpiar archivo temporal
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }

            if ($returnVar !== 0) {
                Log::error('Error en importación', [
                    'output' => $output,
                    'command' => $command
                ]);
                throw new \Exception('Error al importar datos: ' . implode("\n", $output));
            }

            return redirect()->route('backup.index')
                ->with('success', 'Datos importados exitosamente');

        } catch (\Exception $e) {
            Log::error('Error en restauración: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al restaurar: ' . $e->getMessage());
        }
    }

    private function validateInsertStatement($statement)
    {
        // Extraer nombre de la tabla
        preg_match('/INSERT INTO `?(\w+)`?/i', $statement, $matches);
        if (empty($matches[1])) {
            return false;
        }
        
        $tableName = $matches[1];
        
        try {
            // Obtener estructura de la tabla
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
            $columnNames = array_column($columns, 'Field');
            
            // Analizar el INSERT
            if (preg_match('/INSERT INTO.*?\((.*?)\)\s+VALUES/is', $statement, $colMatches)) {
                // INSERT especifica columnas
                $specifiedColumns = array_map('trim', explode(',', $colMatches[1]));
                $columnCount = count($specifiedColumns);
            } else {
                // INSERT sin especificar columnas
                $columnCount = count($columnNames);
            }
            
            // Contar valores
            preg_match('/VALUES\s*\((.*)\)/is', $statement, $valueMatches);
            if (!empty($valueMatches[1])) {
                $values = str_getcsv($valueMatches[1], ',', "'");
                $valueCount = count($values);
                
                if ($columnCount !== $valueCount) {
                    Log::error("INSERT inválido", [
                        'table' => $tableName,
                        'expected_columns' => $columnCount,
                        'actual_values' => $valueCount,
                        'table_structure' => $columnNames,
                        'statement' => $statement
                    ]);
                    return false;
                }
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error("Error validando INSERT: " . $e->getMessage());
            return false;
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use Carbon\Carbon;

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

            // Calcular el tamaño total de los archivos
            $totalSize = $files->reduce(function ($carry, $file) use ($disk) {
                return $carry + $disk->size($file);
            }, 0);

            // Log para debugging
            \Log::info('Archivos encontrados:', [
                'files' => $files->toArray(),
                'disk_path' => $disk->path(''),
                'storage_path' => storage_path('app'),
                'total_size' => $totalSize
            ]);

            return view('backup.index', compact('files', 'totalSize'));
        } catch (\Exception $e) {
            \Log::error('Error al listar backup: ' . $e->getMessage());
            return view('backup.index', ['files' => collect(), 'totalSize' => 0])
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
            $extension = $file->getClientOriginalExtension();
            
            // Credenciales de la base de datos
            $dbHost = config('database.connections.mysql.host');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbName = config('database.connections.mysql.database');

            $sqlContents = [];

            if ($extension === 'zip') {
                // Descomprimir archivo ZIP
                $zip = new ZipArchive;
                if ($zip->open($file->getRealPath()) === TRUE) {
                    $extractPath = storage_path('app/temp_' . uniqid());
                    $zip->extractTo($extractPath);
                    $zip->close();

                    // Leer todos los archivos SQL del ZIP
                    $files = glob($extractPath . '/*.sql');
                    foreach ($files as $sqlFile) {
                        $sqlContents[] = file_get_contents($sqlFile);
                    }

                    // Limpiar archivos extraídos
                    array_map('unlink', $files);
                    $this->deleteDirectory($extractPath);
                } else {
                    throw new \Exception('No se pudo abrir el archivo ZIP.');
                }
            } elseif ($extension === 'sql') {
                // Leer el contenido del archivo SQL
                $sqlContents[] = file_get_contents($file->getRealPath());
            } else {
                throw new \Exception('Formato de archivo no soportado. Solo se permiten archivos ZIP o SQL.');
            }

            // Crear archivo temporal para las sentencias validadas
            $tempFile = storage_path('app/temp_' . uniqid() . '.sql');
            $createStatements = [];
            $alterStatements = [];
            $insertStatements = [];

            foreach ($sqlContents as $sqlContent) {
                // Obtener todas las sentencias SQL
                $statements = array_filter(
                    explode(";\n", str_replace(";\r\n", ";\n", $sqlContent))
                );

                foreach ($statements as $statement) {
                    $statement = trim($statement);

                    // Clasificar las sentencias
                    if (stripos($statement, 'CREATE TABLE') === 0) {
                        $createStatements[] = $statement;
                    } elseif (stripos($statement, 'ALTER TABLE') === 0) {
                        $alterStatements[] = $statement;
                    } elseif (stripos($statement, 'INSERT INTO') === 0) {
                        $insertStatements[] = $statement;
                    }
                }
            }

            // Guardar sentencias en orden jerárquico
            file_put_contents($tempFile, implode(";\n", $createStatements) . ";\n");
            file_put_contents($tempFile, implode(";\n", $alterStatements) . ";\n", FILE_APPEND);
            file_put_contents($tempFile, implode(";\n", $insertStatements) . ";\n", FILE_APPEND);

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

    private function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
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

    public function delete($filename)
    {
        try {
            Storage::disk('backups')->delete($filename);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se eliminó respaldo correctamente.");

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar respaldo: ' . $e->getMessage());
        }
    }
}
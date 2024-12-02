<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    public function index()
    {
        // Obtener lista de respaldos existentes
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        
        return view('backup.index', compact('files'));
    }

    public function create()
    {
        try {
            // Desactiva las notificaciones temporalmente
            config(['backup.notifications.disable_notifications' => true]);
            
            Artisan::call('backup:run', [
                '--disable-notifications' => true
            ]);
            
            return redirect()->route('backup.index')
                ->with('success', 'Respaldo creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear respaldo: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $fullPath = storage_path('app/Laravel/' . $filename);
        
        if (!file_exists($fullPath)) {
            abort(404, 'Archivo de respaldo no encontrado');
        }

        return response()->download(
            $fullPath, 
            $filename, 
            [
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]
        );
    }

    public function restore(Request $request)
    {
        // Validación del archivo de respaldo
        $request->validate([
            'backup_file' => 'required|file|mimes:zip,sql'
        ]);

        try {
            $file = $request->file('backup_file');
            
            // Configuración de base de datos
            $dbName = config('database.connections.mysql.database');
            $dbUser = config('database.connections.mysql.username');
            $dbPass = config('database.connections.mysql.password');
            $dbHost = config('database.connections.mysql.host');

            // Si es un archivo ZIP, extraer primero
            if ($file->getClientOriginalExtension() === 'zip') {
                // Crear directorio temporal
                $tempDir = storage_path('temp_backup_restore');
                if (!file_exists($tempDir)) {
                    mkdir($tempDir, 0755, true);
                }

                // Extraer archivo
                $zip = new \ZipArchive();
                $zipPath = $file->getRealPath();
                
                if ($zip->open($zipPath) === TRUE) {
                    // Encontrar archivo SQL en el ZIP
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i);
                        if (pathinfo($filename, PATHINFO_EXTENSION) === 'sql') {
                            // Extraer archivo SQL
                            $sqlContent = $zip->getFromIndex($i);
                            $sqlPath = $tempDir . '/restore.sql';
                            file_put_contents($sqlPath, $sqlContent);
                            break;
                        }
                    }
                    $zip->close();
                } else {
                    throw new \Exception('No se pudo abrir el archivo ZIP');
                }

                $sqlPath = $tempDir . '/restore.sql';
            } else {
                // Si es directamente un archivo SQL
                $sqlPath = $file->getRealPath();
            }

            // Comando para restaurar base de datos
            $command = "mysql -h {$dbHost} -u {$dbUser} " . 
                ($dbPass ? "-p{$dbPass}" : "") . 
                " {$dbName} < {$sqlPath}";

            // Ejecutar restauración
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new \Exception('Error en la restauración de la base de datos');
            }

            // Limpiar archivos temporales
            if (isset($tempDir) && file_exists($tempDir)) {
                array_map('unlink', glob($tempDir . '/*'));
                rmdir($tempDir);
            }

            return redirect()->route('backup.index')
                ->with('success', 'Base de datos restaurada exitosamente');

        } catch (\Exception $e) {
            Log::error('Backup restore error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al restaurar: ' . $e->getMessage());
        }
    }
}
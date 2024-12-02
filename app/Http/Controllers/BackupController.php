<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\Artisan;

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
            
            return redirect()->route('backups.index')
                ->with('success', 'Respaldo creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear respaldo: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        
        if (!$disk->exists($filename)) {
            abort(404);
        }

        return response()->download($disk->path($filename));
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip'
        ]);

        try {
            // NOTA: La restauración completa requiere un proceso más complejo
            // Este es solo un ejemplo básico
            $file = $request->file('backup_file');
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            
            // Guardar el archivo de respaldo
            $path = $file->store('backups', 'local');
            
            // Restauración de base de datos 
            // ADVERTENCIA: Esto es un ejemplo simplificado
            Artisan::call('backup:restore', [
                '--filename' => $path
            ]);
            
            return redirect()->route('backup.index')
                ->with('success', 'Respaldo restaurado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al restaurar: ' . $e->getMessage());
        }
    }
}
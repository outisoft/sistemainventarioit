<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Maintenance;
use App\Models\Historial;

class MaintenanceController extends Controller
{
    public function index()
    {
        $equipos = Equipo::orderBy('serie', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        $maintenances = maintenance::with('equipment', 'user')->orderBy('date', 'asc')->get();
        return view('maintenance.index', compact('maintenances','equipos', 'users'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            'equipment_id' => 'required|exists:equipos,id',
            'user_id' => 'required|exists:users,id',
            'maintenance_type' => 'required|in:Preventivo,Correctivo',
            'date' => 'required|date',
            'description' => 'required|string',
            'parts_used' => 'nullable', //|array
            'status' => 'required|in:Completado,Pendiente',
        ]);
        //dd($data);
        $registro = Maintenance::create($data);

        $user = auth()->id();

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agendo el equipo para la fecha {$registro->date}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Equipo agendado exitosamente.");

        return redirect()->route('maintenances.index');
    }
}

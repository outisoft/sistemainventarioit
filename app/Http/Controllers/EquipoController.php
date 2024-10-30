<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Complement;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:equipo.index')->only('index');
        $this->middleware('can:equipo.create')->only('create', 'store');
        $this->middleware('can:equipo.edit')->only('edit', 'update');
        //$this->middleware('can:equipo.show')->only('show');
        $this->middleware('can:equipo.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filtrar equipos por tipo
        // Obtener todos los equipos
        $equipos = Equipo::with('tipo')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('equipos.index', compact('equipos'));
    }    

    public function show(Equipo $equipo)
    {
        $complementosAsignados = $equipo->complements;
    
        if ($complementosAsignados->isEmpty()) {
            $complementosDisponibles = Complement::all();
        } else {
            $complementosDisponibles = Complement::whereNotIn('id', $complementosAsignados->pluck('id'))->get();
        }
        
        return view('equipos.desktops.show', compact('equipo', 'complementosAsignados', 'complementosDisponibles'));
    }

    public function asignarComplementos(Request $request, Equipo $equipo)
    {
        $request->validate([
            'complements_id' => 'required|array',
            'complements_id.*' => 'exists:complements,id'
        ]);

        $equipo->complements()->attach($request->complements_id);

        $complement = Complement::where('id', $request->complements_id)->with('type')->first();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Asignacion',
            'descripcion' => "Se asigno al equipo {$equipo->name} (S/N:{$equipo->serial}) el complemento {$complement->type->name} (N/S: {$complement->serial})",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Complemento {$complement->type->name} asignado.");

        return redirect()->route('equipo.show', $equipo);
    }

    // En EquipoController
    public function eliminarComplemento($equipo_id, $complement_id)
    {
        $equipo = Equipo::find($equipo_id);
        $equipo->complements()->detach($complement_id);

        $complement = Complement::where('id', $complement_id)->with('type')->first();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Desvinculó',
            'descripcion' => "Se desvinculó al equipo {$equipo->name} (S/N: {$equipo->serial} ) el complemento tipo {$complement->type->name} (S/N: {$complement->serial} )",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Complemento {$equipo->name} desvinculado.");
        
        return redirect()->route('equipo.show', $equipo);
    }

    public function getEquipo($serial)
    {
        $equipo = Equipo::where('serial', $serial)
            ->orWhere('name', $serial)
            ->first();
        
        return response()->json($equipo);
    }
}

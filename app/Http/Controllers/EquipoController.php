<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Historial;
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
        $this->middleware('can:equipo.show')->only('show');
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

    public function getEquipo($serial)
    {
        $equipo = Equipo::where('serial', $serial)->first();
        
        return response()->json($equipo);
    }
}

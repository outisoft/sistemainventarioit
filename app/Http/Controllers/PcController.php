<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Equipo;
use Illuminate\Http\Request;

class PcController extends Controller
{
    public function index()
    {
        $tipoLaptop = Tipo::where('name', 'DESKTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipoLaptop->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('pc.index', compact('equipos'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('pc.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:pcs',
            'name' => 'required|unique:pcs',
            'ip' => 'required|unique:pcs',
            'empleado_id' => 'nullable|exists:empleados,id',
        ]);

        Pc::create($request->all());

        return redirect()->route('pc.index');
    }

    // Implementa los demás métodos (show, edit, update, destroy) según sea necesario
}
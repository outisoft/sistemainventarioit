<?php

namespace App\Http\Controllers;

use App\Models\Pc;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PcController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('hotel')->orderBy('name', 'asc')->get();
        $pcs = Pc::with('empleado')->get();
        return view('pc.index', compact('pcs', 'empleados'));
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
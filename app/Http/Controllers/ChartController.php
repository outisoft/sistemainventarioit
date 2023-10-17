<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Equipo;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    // En tu controlador
    public function index()
    {
        $numEmpleados = Empleado::count();
        $numUsuarios = User::count();
        $numEquipos = Equipo::count();

        return view('charts.index', compact('numEmpleados', 'numUsuarios', 'numEquipos'));
    }

    public function empleados(Request $request)
    {
        $tipoSeleccionado = $request->input('tipo_seleccionado', 'hotel'); // Por defecto, muestra datos del hotel.

        if ($tipoSeleccionado === 'hotel') {
            $empleados = Empleado::where('tipo', 'hotel')->get();
        } else {
            $empleados = Empleado::where('tipo', 'departamento')->get();
        }

        return view('charts.index', compact('empleados', 'tipoSeleccionado'));
    }


    public function userChart()
    {
        //$data = User::all();
        $numUsuarios = User::count();
        $numEmpleados = Empleado::count();
        $numEquipos = Equipo::count();

        $data = [
            ['label' => 'Usuarios', 'value' => $numUsuarios],
            ['label' => 'Empleados', 'value' => $numEmpleados],
            ['label' => 'Equipos', 'value' => $numEquipos],
        ];

        //dd($data);

        return view('users.chart')->with('data', $data);
    }
}

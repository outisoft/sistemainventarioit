<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    // En tu controlador
    // En tu controlador
    public function index()
    {
        $empleadosPorHotel = DB::table('empleados')
            ->join('hotels', 'empleados.hotel_id', '=', 'hotels.id')
            ->select('hotels.nombre as hotel', DB::raw('count(*) as cantidad_empleados'))
            ->groupBy('hotels.nombre')
            ->get();

        $empleadosPorDepartamento = DB::table('empleados')
            ->join('departamentos', 'empleados.departamento_id', '=', 'departamentos.id')
            ->select('departamentos.name as departamento', DB::raw('count(*) as cantidad_empleados'))
            ->groupBy('departamentos.name')
            ->get();

        return view('charts.index', compact('empleadosPorHotel', 'empleadosPorDepartamento'));
    }

    public function show(Request $request)
    {
        $tipoSeleccionado = $request->input('tipo_seleccionado', 'hotel'); // Por defecto, muestra datos del hotel.

        if ($tipoSeleccionado === 'hotel') {
            $empleados = Empleado::where('tipo', 'hotel')->get();
        } else {
            $empleados = Empleado::where('tipo', 'departamento')->get();
        }

        return view('charts.show', compact('empleados', 'tipoSeleccionado'));
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

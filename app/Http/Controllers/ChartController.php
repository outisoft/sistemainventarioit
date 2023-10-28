<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Tipo;
use App\Models\Hotel;
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

        $equiposPorTipo = DB::table('equipos')
            ->join('tipos', 'equipos.tipo_id', '=', 'tipos.id')
            ->select('tipos.name as tipo', DB::raw('count(*) as cantidad_equipos'))
            ->groupBy('tipos.name')
            ->get();

        $equiposCpu = Equipo::whereHas('tipo', function ($query) {//obtiene el equipo CPU 
                $query->where('name', 'CPU');
            })->get();
            
        // Obtén todos los hoteles con sus empleados
        $hoteles = Hotel::with('empleados')->get();

        $e_e = DB::table('empleado_equipo')
            ->join('equipos', 'empleado_equipo.equipo_id', '=', 'equipos.tipo_id')
            ->where('equipos.tipo_id', '=', 1)
            ->count();

        //dd($e_e);

        $hotels = Hotel::with('equiposCpu')->get();
        $labels = $hotels->pluck('nombre')->toArray();
        $data = $hotels->map(function ($hotel) {
            return $hotel->equiposCpu->count();
        })->toArray();

        return view('charts.index', compact('labels','data','hotels','equiposCpu','hoteles','empleadosPorHotel', 'empleadosPorDepartamento', 'equiposPorTipo'));
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

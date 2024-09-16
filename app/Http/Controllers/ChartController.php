<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    // En tu controlador
    public function index()
    {
        $empleadosPorHotel = DB::table('empleados')
            ->join('hotels', 'empleados.hotel_id', '=', 'hotels.id')
            ->select('hotels.name as hotel', DB::raw('count(*) as cantidad_empleados'))
            ->groupBy('hotels.name')
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

        $datosLap = DB::table('hotels')
            ->select('hotels.name as hotel', DB::raw('COUNT(empleados.id) as empleados'), 'tipos.name as tipo_equipo', DB::raw('COUNT(equipos.id) as cantidad_equipos'))
            ->leftJoin('empleados', 'hotels.id', '=', 'empleados.hotel_id')
            ->leftJoin('empleado_equipo', 'empleados.id', '=', 'empleado_equipo.empleado_id')
            ->leftJoin('equipos', 'empleado_equipo.equipo_id', '=', 'equipos.id')
            ->leftJoin('tipos', 'equipos.tipo_id', '=', 'tipos.id')
            ->whereIn('tipos.name', ['laptop'])
            ->groupBy('hotels.name', 'hotels.id', 'tipo_equipo')
            ->get();

        $datosCPU = DB::table('hotels')
            ->select('hotels.name as hotel', DB::raw('COUNT(empleados.id) as empleados'), 'tipos.name as tipo_equipo', DB::raw('COUNT(equipos.id) as cantidad_equipos'))
            ->leftJoin('empleados', 'hotels.id', '=', 'empleados.hotel_id')
            ->leftJoin('empleado_equipo', 'empleados.id', '=', 'empleado_equipo.empleado_id')
            ->leftJoin('equipos', 'empleado_equipo.equipo_id', '=', 'equipos.id')
            ->leftJoin('tipos', 'equipos.tipo_id', '=', 'tipos.id')
            ->whereIn('tipos.name', ['CPU'])
            ->groupBy('hotels.name', 'hotels.id', 'tipo_equipo')
            ->get();

        return view('charts.index', compact('datosLap', 'datosCPU', 'empleadosPorHotel', 'empleadosPorDepartamento', 'equiposPorTipo'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Tipo;
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

        // Obtener el tipo "cpu" de la tabla "tipo"
        $tipoCpu = Tipo::where('name', 'cpu')->first();
        $empleados = Empleado::all();
        if ($tipoCpu) {
            // Ahora tienes el tipo "cpu" en la variable $tipoCpu
            $nombreTipo = $tipoCpu->nombre;
            // Puedes acceder a otros atributos del tipo según sea necesario
        } else {
            // El tipo "cpu" no se encontró en la tabla
            $nombreTipo = "No se encontró";
        }

        if ($tipoCpu) {
            // Ahora tienes el tipo "cpu" en la variable $tipoCpu

            // Contador para contar empleados con el tipo "cpu"
            $contadorEmpleadosCpu = 0;

            // Itera sobre la colección de empleados
            foreach ($empleados as $empleado) {

                // Comprueba si el tipo del empleado coincide con el tipo "cpu"
                if ($empleado->tipo_id === $tipoCpu->id) {
                    // Incrementa el contador
                    $contadorEmpleadosCpu++;
                }
                dd($contadorEmpleadosCpu);
            }

            // $contadorEmpleadosCpu ahora contiene la cantidad de empleados con el tipo "cpu" en $empleadosPorHotel
        } else {
            // El tipo "cpu" no se encontró en la tabla
            $contadorEmpleadosCpu = 0;
        }

        return view('charts.index', compact('empleadosPorHotel', 'empleadosPorDepartamento', 'equiposPorTipo', 'contadorEmpleadosCpu'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Coming2;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Tpv;
use App\Models\Swittch;
use App\Models\AccessPoint;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener la cantidad de equipos de cada tipo
        //$tipos = Tipo::withCount('equipos')->get();
        $tipos = Tipo::whereIn('id', [2, 3, 4, 10, 11, 12, 13])->withCount('equipos')->get();

        //$labels = $tipos->pluck('name')->toArray();
        $labels = $tipos->whereIn('id', [2, 3, 4, 10, 11, 12, 13])->pluck('name')->toArray();
        $data = $tipos->pluck('equipos_count')->toArray();

        // Obtener todos los equipos disponibles u ocupado de tupo CPU
        $equiposCPU = Equipo::with('tipo')
            ->whereHas('tipo', function ($query) {
                $query->where('name', 'DESKTOP');
            })
            ->get();

        $equipos_en_uso = 0;
        $equipos_libres = 0;

        foreach ($equiposCPU as $equipo) {
            if ($equipo->empleados->isEmpty()) {
                $equipos_libres++;
            } else {
                $equipos_en_uso++;
            }
        }

        // Datos para la gráfica
        $datos_grafica = [
            [
                'estado' => 'En Uso',
                'total' => $equipos_en_uso
            ],
            [
                'estado' => 'Libre',
                'total' => $equipos_libres
            ]
        ];

        // Obtener todos los equipos disponibles u ocupado de tupo Laptop
        $equiposLap = Equipo::with('tipo')
            ->whereHas('tipo', function ($query) {
                $query->where('name', 'LAPTOP');
            })
            ->get();

        $laptops_en_uso = 0;
        $laptops_libres = 0;

        foreach ($equiposLap as $lap) {
            if ($lap->empleados->isEmpty()) {
                $laptops_libres++;
            } else {
                $laptops_en_uso++;
            }
        }

        // Datos para la gráfica
        $total_laptops = [
            [
                'estado' => 'En Uso',
                'total' => $laptops_en_uso
            ],
            [
                'estado' => 'Libre',
                'total' => $laptops_libres
            ]
        ];

        // Obtén el total de elementos
        $totalComing2 = Coming2::count();
        $totalEmpleados = Empleado::count();
        $totalEquipos = Equipo::count();
        $totalUsuarios = User::count();
        $totalTpvs = Tpv::count();
        $totalSw = Swittch::count();
        $totalAps = AccessPoint::count();

        $totalTablets = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'TABLET');
        })->with('policy')->count();

        $hora_actual = Carbon::now()->format('H:i:s A');

        $tpvPorDepartamento = Tpv::select('hotel_id', DB::raw('COUNT(*) as total_tpvs'))
            ->groupBy('hotel_id')
            ->get();

        $tpvsPorDepartamento = DB::table('tpvs')
            ->join('hotels', 'tpvs.hotel_id', '=', 'hotels.id')
            ->select('hotels.name as hotel', DB::raw('count(*) as cantidad_tpvs'))
            ->groupBy('hotels.name')
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $user = auth()->user();
                $regionIds = $user->regions()->pluck('region_id'); // Asumiendo que tienes una relación 'regions' definida en el modelo User
                $query->whereIn('hotels.region_id', $regionIds);
            })
            ->get();

        $datosLap = DB::table('hotels')
            ->select('hotels.name as hotel', DB::raw('COUNT(empleados.id) as empleados'), 'tipos.name as tipo_equipo', DB::raw('COUNT(equipos.id) as cantidad_equipos'))
            ->leftJoin('empleados', 'hotels.id', '=', 'empleados.hotel_id')
            ->leftJoin('empleado_equipo', 'empleados.id', '=', 'empleado_equipo.empleado_id')
            ->leftJoin('equipos', 'empleado_equipo.equipo_id', '=', 'equipos.id')
            ->leftJoin('tipos', 'equipos.tipo_id', '=', 'tipos.id')
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $user = auth()->user();
                $regionIds = $user->regions()->pluck('region_id'); // Asumiendo que tienes una relación 'regions' definida en el modelo User
                $query->whereIn('hotels.region_id', $regionIds);
            })
            ->whereIn('tipos.name', ['laptop'])
            ->groupBy('hotels.name', 'hotels.id', 'tipo_equipo')
            ->get();
        
        $datosCPU = DB::table('hotels')
            ->select('hotels.name as hotel', DB::raw('COUNT(empleados.id) as empleados'), 'tipos.name as tipo_equipo', DB::raw('COUNT(equipos.id) as cantidad_equipos'))
            ->leftJoin('empleados', 'hotels.id', '=', 'empleados.hotel_id')
            ->leftJoin('empleado_equipo', 'empleados.id', '=', 'empleado_equipo.empleado_id')
            ->leftJoin('equipos', 'empleado_equipo.equipo_id', '=', 'equipos.id')
            ->leftJoin('tipos', 'equipos.tipo_id', '=', 'tipos.id')
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $user = auth()->user();
                $regionIds = $user->regions()->pluck('region_id'); // Asumiendo que tienes una relación 'regions' definida en el modelo User
                $query->whereIn('hotels.region_id', $regionIds);
            })
            ->whereIn('tipos.name', ['DESKTOP'])
            ->groupBy('hotels.name', 'hotels.id', 'tipo_equipo')
            ->get();

        return view('home', compact('totalAps','totalSw','totalComing2','datosLap', 'datosCPU', 'hora_actual', 'tpvsPorDepartamento', 'totalTablets', 'totalTpvs', 'totalEmpleados', 'totalEquipos', 'totalUsuarios', 'labels', 'data', 'datos_grafica', 'total_laptops'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Tpv;
use App\Models\Complement;
use App\Models\Hotel;
use App\Models\Swittch;
use App\Models\AccessPoint;
use App\Models\Phone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\License;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener la cantidad de equipos de cada tipo
        //$tipos = Tipo::withCount('equipos')->get();
        $tipos = Tipo::whereIn('id', [2, 3, 4, 10, 12, 13])->withCount('equipos')->get();

        //$labels = $tipos->pluck('name')->toArray();
        $labels = $tipos->whereIn('id', [2, 3, 4, 10, 12, 13])->pluck('name')->toArray();
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
        $totalEmpleados = Empleado::count();
        $totalEquipos = Equipo::count();
        $totalUsuarios = User::count();
        $totalTpvs = Tpv::count();
        $totalSw = Swittch::count();
        $totalAps = AccessPoint::count();
        $totalPhones = Phone::count();

        $totalTablets = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'TABLET');
        })->with('policy')->count();

        $hora_actual = Carbon::now()->format('H:i:s A');

        $officeCount = License::where('type_id', 11)->count(); // Office
        $adobeCount = License::where('type_id', 15)->count(); // Adobe
        //$autocadCount = License::where('type_id', 3)->count(); // AutoCAD
        //$sketchupCount = License::where('type_id', 4)->count(); // SketchUp

        $user = Auth::user();
        $regionIds = $user->regions()->pluck('region_id');
        $userHotelsCount = Hotel::whereIn('region_id', $regionIds)->count(); // Asumiendo que el usuario tiene una relación con los hoteles

        // Contabilizar el total de equipos de tipo "LAPTOP"
        $totalDesktops = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'DESKTOP');
        })->count();

        $totalLaptops = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'LAPTOP');
        })->count();

        $totalOther = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'OTHER');
        })->count();

        $totalPhone = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'PHONE');
        })->count();

        $totalPrinter = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'IMPRESORA');
        })->count();

        $totalTablet = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'TABLET');
        })->count();

        // Contabilizar el total de complements
        $totalCharger = Complement::whereHas('type', function ($query) {
            $query->where('name', 'CHARGER');
        })->count();

        $totalMonitor = Complement::whereHas('type', function ($query) {
            $query->where('name', 'MONITOR');
        })->count();

        $totalMouse = Complement::whereHas('type', function ($query) {
            $query->where('name', 'MOUSE');
        })->count();

        $totalBreack = Complement::whereHas('type', function ($query) {
            $query->where('name', 'NO BREACK');
        })->count();

        $totalScanner = Complement::whereHas('type', function ($query) {
            $query->where('name', 'SCANNER');
        })->count();

        $totalKeyboard = Complement::whereHas('type', function ($query) {
            $query->where('name', 'TECLADO');
        })->count();

        $totalTicket = Complement::whereHas('type', function ($query) {
            $query->where('name', 'TICKETERA');
        })->count();

        $totalWacom = Complement::whereHas('type', function ($query) {
            $query->where('name', 'WACOM');
        })->count();

        /*CHART LICENSES*/
        // Total de licencias por tipo
        $officeCount = License::where('type_id', 11)->count(); // Office
        $adobeCount = License::where('type_id', 15)->count(); // Adobe
        $autocadCount = License::where('type_id', 17)->count(); // AutoCAD
        $sketchupCount = License::where('type_id', 18)->count(); // SketchUp

        // Licencias activas por tipo
        $officeActivas = License::where('type_id', 11)->where('end_date', '>=', now())->count();
        $adobeActivas = License::where('type_id', 15)->where('end_date', '>=', now())->count();
        $autocadActivas = License::where('type_id', 17)->where('end_date', '>=', now())->count();
        $sketchupActivas = License::where('type_id', 18)->where('end_date', '>=', now())->count();

        // Licencias vencidas por tipo
        $officeVencidas = License::where('type_id', 11)->where('end_date', '<', now())->count();
        $adobeVencidas = License::where('type_id', 15)->where('end_date', '<', now())->count();
        $autocadVencidas = License::where('type_id', 17)->where('end_date', '<', now())->count();
        $sketchupVencidas = License::where('type_id', 18)->where('end_date', '<', now())->count();

        // Totales
        $totalLicencias = $officeCount + $adobeCount + $autocadCount + $sketchupCount;
        $totalActivas = $officeActivas + $adobeActivas + $autocadActivas + $sketchupActivas;
        $totalVencidas = $officeVencidas + $adobeVencidas + $autocadVencidas + $sketchupVencidas;

        // Verificar si el usuario tiene el rol "Administrator"
        $isAdmin = auth()->user()->hasRole('Administrator'); // Suponiendo que usas un paquete como Spatie Roles & Permissions
        $userRegions = auth()->user()->regions;

        if ($isAdmin) {
            // Si es administrador, no filtrar por regiones
            $hotels = DB::table('hotels')->pluck('id');
        } else {
            // Filtrar los hoteles según las regiones del usuario
            $hotels = DB::table('hotels')
                ->whereIn('region_id', $userRegions->pluck('id'))
                ->pluck('id');
        }

        // Obtener el total de laptops asignadas por hotel
        $laptopsPorHotel = DB::table('equipos')
            ->join('empleado_equipo', 'equipos.id', '=', 'empleado_equipo.equipo_id')
            ->join('empleados', 'empleado_equipo.empleado_id', '=', 'empleados.id')
            ->join('hotels', 'empleados.hotel_id', '=', 'hotels.id')
            ->where('equipos.tipo_id', '=', 4) // Suponiendo que el tipo_id = 4 es para laptops
            ->whereIn('hotels.id', $hotels) // Filtrar por hoteles de las regiones del usuario o todos si es admin
            ->select('hotels.name as hotel', DB::raw('COUNT(equipos.id) as total'))
            ->groupBy('hotels.name')
            ->get();

        // Obtener el total de laptops en stock (no asignadas)
        $laptopsEnStock = DB::table('equipos')
            ->where('tipo_id', '=', 4) // Suponiendo que el tipo_id = 4 es para laptops
            ->whereNotIn('id', function ($query) use ($hotels) {
                $query->select('equipo_id')
                    ->from('empleado_equipo')
                    ->join('empleados', 'empleado_equipo.empleado_id', '=', 'empleados.id')
                    ->whereIn('empleados.hotel_id', $hotels); // Filtrar por hoteles de las regiones del usuario
            })
            ->count();

        // Preparar datos para la gráfica
        $laptopLabels = $laptopsPorHotel->pluck('hotel')->toArray();
        $laptopData = $laptopsPorHotel->pluck('total')->toArray();

        // Agregar la columna "Stock"
        $laptopLabels[] = 'Stock';
        $laptopData[] = $laptopsEnStock;

        // Obtener el total de desktops asignadas por hotel
        $desktopsPorHotel = DB::table('equipos')
            ->join('empleado_equipo', 'equipos.id', '=', 'empleado_equipo.equipo_id')
            ->join('empleados', 'empleado_equipo.empleado_id', '=', 'empleados.id')
            ->join('hotels', 'empleados.hotel_id', '=', 'hotels.id')
            ->where('equipos.tipo_id', '=', 3) // Suponiendo que el tipo_id = 3 es para desktops
            ->whereIn('hotels.id', $hotels) // Filtrar por hoteles de las regiones del usuario o todos si es admin
            ->select('hotels.name as hotel', DB::raw('COUNT(equipos.id) as total'))
            ->groupBy('hotels.name')
            ->get();

        // Obtener el total de desktops en stock (no asignadas)
        $desktopsEnStock = DB::table('equipos')
            ->where('tipo_id', '=', 2) // Suponiendo que el tipo_id = 2 es para desktops
            ->whereNotIn('id', function ($query) use ($hotels) {
                $query->select('equipo_id')
                    ->from('empleado_equipo')
                    ->join('empleados', 'empleado_equipo.empleado_id', '=', 'empleados.id')
                    ->whereIn('empleados.hotel_id', $hotels); // Filtrar por hoteles de las regiones del usuario
            })
            ->count();

        // Preparar datos para la gráfica de desktops
        $desktopLabels = $desktopsPorHotel->pluck('hotel')->toArray();
        $desktopData = $desktopsPorHotel->pluck('total')->toArray();

        // Agregar la columna "Stock"
        $desktopLabels[] = 'Stock';
        $desktopData[] = $desktopsEnStock;

        // Obtener las regiones asignadas al usuario
        $userRegions = auth()->user()->regions;

        // Contar el total de hoteles en todas las regiones del usuario
        $totalHotels = DB::table('hotels')
            ->whereIn('region_id', $userRegions->pluck('id'))
            ->count();

        // Determinar si se deben mostrar las gráficas
        $showGraphs = $userRegions->count() > 1 || $totalHotels > 1;


        return view('home', compact('showGraphs', 'desktopLabels', 'desktopData', 'laptopLabels', 'laptopData', 'totalPhones', 'officeCount', 'adobeCount', 'autocadCount', 'sketchupCount',
        'officeActivas', 'adobeActivas', 'autocadActivas', 'sketchupActivas',
        'officeVencidas', 'adobeVencidas', 'autocadVencidas', 'sketchupVencidas',
        'totalLicencias', 'totalActivas', 'totalVencidas', 'totalPhone', 'totalWacom', 
        'totalTicket', 'totalKeyboard', 'totalScanner', 'totalBreack', 'totalMouse', 
        'totalMonitor', 'totalCharger', 'totalOther', 'totalTablet', 'totalPrinter', 
        'totalDesktops', 'totalLaptops', 'userHotelsCount', 'officeCount', 'adobeCount', 
        'totalAps','totalSw', 'hora_actual', 
        'totalTablets', 'totalTpvs', 'totalEmpleados', 'totalEquipos', 'totalUsuarios', 
        'labels', 'data', 'datos_grafica', 'total_laptops'));
    }
}

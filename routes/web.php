<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TabletController;
use App\Http\Controllers\TpvController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\DesktopController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ComplementController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\AccessPointController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Coming2Controller;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\EquipmentComplementController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\GraphController;
use Carbon\Carbon;
use App\Exports\EmpleadoExport;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Coming2;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Tpv;
use App\Models\Swittch;
use App\Models\AccessPoint;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


Route::group(['middleware' => ['auth', 'check.country']], function ()  {

    Route::get('/home', function () {
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
            ->whereIn('tipos.name', ['DESKTOP'])
            ->groupBy('hotels.name', 'hotels.id', 'tipo_equipo')
            ->get();

        return view('home', compact('totalAps','totalSw','totalComing2','datosLap', 'datosCPU', 'hora_actual', 'tpvsPorDepartamento', 'totalTablets', 'totalTpvs', 'totalEmpleados', 'totalEquipos', 'totalUsuarios', 'labels', 'data', 'datos_grafica', 'total_laptops'));
    })->name('home');

    Route::get('/exportar-grafica', function () {
        return Excel::download(new EmpleadoExport, 'datos-grafica.xlsx');
    });

    Route::get('/microsoft', [GraphController::class, 'index'])->name('graph.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rutas de CRUD
    Route::resource('inventario', InventarioController::class); // Rutas Inventario
    Route::resource('empleados', EmpleadoController::class); // Rutas Empleados
    Route::resource('equipo', EquipoController::class); // Rutas Equipos
    Route::resource('users', UserController::class); // Rutas Usuario
    Route::resource('charts', ChartController::class); // Rutas Graficas
    Route::resource('roles', RoleController::class); // Rutas roles
    Route::resource('tpvs', TpvController::class);  //Rutas TPVS
    Route::resource('maintenances', MaintenanceController::class); //Rutas Mantenimiento
    Route::resource('licenses', LicenseController::class); //Rutas Mantenimiento
    Route::resource('desktops', DesktopController::class); //Rutas PC
    Route::resource('regions', RegionController::class); //Rutas Region
    Route::resource('hotels', HotelController::class); //Rutas hoteles
    Route::resource('departments', DepartamentoController::class); //Rutas departamentos
    Route::resource('printers', PrinterController::class);//Rutas printers
    Route::resource('complements', ComplementController::class);//Rutas complements
    Route::resource('laptops', LaptopController::class);//Rutas laptops
    Route::resource('tabs', TabController::class);//Rutas tabs
    Route::resource('mobiles', MobileController::class);//Rutas phones
    Route::resource('phones', PhoneController::class);//Rutas phones
    Route::resource('access-points', AccessPointController::class);//Rutas access points
    Route::resource('switches', SwitchController::class);//Rutas switches
    Route::resource('assignment', AssignmentController::class);//Rutas asignacion
    Route::resource('coming2', Coming2Controller::class);//Rutas coming2
    Route::resource('other', OtherController::class);//Rutas Otros
    Route::get('/switches/{switch}/available-ports', [AccessPointController::class, 'getAvailablePort']); // Create ap
    Route::get('/details/{equipo}/equipment', [EquipoController::class, 'details'])->name('details');


    //Backup
    Route::prefix('backup')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/create', [BackupController::class, 'create'])->name('backup.create');
        Route::get('/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::post('/restore', [BackupController::class, 'restore'])->name('backup.restore');
    });

    //coming2
    Route::get('/co2/trashed', [Coming2Controller::class, 'trashedEmpleados'])->name('co2.trashed');
    Route::delete('/co2/{id}/trash', [Coming2Controller::class, 'trash'])->name('co2.trash');
    Route::post('/co2/{id}/restore', [Coming2Controller::class, 'restore'])->name('co2.restore');

    // Asignar complementos a un equipo
    Route::post('/equipos/{equipo}/asignar-complementos', [EquipoController::class, 'asignarComplementos'])->name('equipos.asignar-complementos');
    Route::delete('/equipos/{equipo}/complementos/{complemento}', [EquipoController::class, 'eliminarComplemento'])->name('equipos.complementos.destroy');

    Route::get('/empleado/{no_empleado}', [EmpleadoController::class, 'getEmpleado']);
    Route::get('/equipos/{serial}', [EquipoController::class, 'getEquipo']);


    Route::get('/qrcode/{id}', [AssignmentController::class, 'generateQRCode'])->name('generateQRCode');
    Route::get('/qrcode/{id}/download', [AssignmentController::class, 'downloadQRCode'])->name('downloadQRCode');
    Route::get('/qrcode/{id}/details', [AssignmentController::class, 'employeeDetails'])->name('employeeDetails');

    Route::get('empleados/{id}/equipos', [EmpleadoController::class, 'equipos'])->name('empleados.equipos');

    Route::get('/get-departamentos', [EmpleadoController::class, 'getDepartamentos'])->name('get.departamentos');
    /*Route::get('/hotel/{hotel}/departments', [HotelController::class, 'getDepartments']);
    Route::get('/get-departments/{hotel}', [EmpleadoController::class, 'getDepartments']);*/

    Route::get('/inventario/{id}/historial', [InventarioController::class, 'historial'])->name('inventario.historial'); // Nueva ruta para mostrar el historial
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index'); //muestra view historial

    //imports
    Route::post('/import', [InventarioController::class, 'import'])->name('import'); //importador de reporte en excel
    Route::post('/importequipo', [EquipoController::class, 'import']); //importador de reporte en excel
    Route::post('/importempleado', [EmpleadoController::class, 'import']); //importador de reporte en excel

    //export
    Route::get('/export', [InventarioController::class, 'export'])->name('export'); //expotador de reporte en excel
    Route::get('/exportequipo', [EquipoController::class, 'export']); //exportar de usuarios
    Route::get('/exportempleado', [EmpleadoController::class, 'export']); //exportar de usuarios

    Route::post('/asignar-rol/{usuarioId}/{rol}', [EmpleadoController::class, 'asignarRol'])->name('asignar.rol');

    //serachs
    Route::post('/empleados/search', [EmpleadoController::class, 'search'])->name('empleados.search'); //buscador de empleados
    Route::post('/inventario/search', [InventarioController::class, 'search'])->name('inventario.search'); //buscador de inventario
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search'); //buscador de usuarios
    Route::post('/equipo/search', [EquipoController::class, 'search'])->name('equipo.search'); //buscador de usuarios
    Route::post('/tablet/search', [TabletController::class, 'search'])->name('tablet.search'); //buscador de usuarios
    Route::get('/empleados/buscar', [EmpleadoController::class, 'buscar'])->name('empleados.buscar'); //buscador de usuarios
    Route::post('/tpvs/search', [TpvController::class, 'search'])->name('tpvs.search');

    //Rutas asignacion   Route::resource('assignment', AssignmentController::class);
    //asignacion de equipo a empleado 
    //Route::get('/asignacion', [EmpleadoController::class, 'agregar'])->name('asignacion.index');
    Route::post('/asignar', [AssignmentController::class, 'asignar'])->name('asignar');
    Route::get('/desvincular/{empleado_id}/{equipo_id}', [AssignmentController::class, 'desvincular'])->name('desvincular');
    Route::get('/save-pdf/{id}', [AssignmentController::class, 'save_pdf'])->name('save-pdf');
    //Route::get('/detalles/{id}', [AssignmentController::class, 'detalles'])->name('detalles');

    //Generacion de hojas de resguardo
    Route::get('/coming2/{id}/save-pdf', [Coming2Controller::class, 'save_pdf'])->name('coming2.save-pdf');
    //Route::get('/empleado/save-pdf/{id}', [EmpleadoController::class, 'save_pdf'])->name('empleado.save-pdf');

    //CHARTS
    Route::get('/grafica-usuarios', [ChartController::class, 'userChart'])->name('usuarios.chart');
});

Route::get('/', function () {
    if (Auth::check()) {
        // El usuario está autenticado
        return redirect()->route('home');
    } else {
        // El usuario no está autenticado
        return redirect()->route('login');
    }
})->name('login');

Route::get('/welcome', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

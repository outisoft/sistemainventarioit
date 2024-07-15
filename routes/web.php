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
use Carbon\Carbon;
use App\Exports\EmpleadoExport;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Tablet;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Tpv;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        // Obtener la cantidad de equipos de cada tipo
        $tipos = Tipo::withCount('equipos')->get();

        $labels = $tipos->pluck('name')->toArray();
        $data = $tipos->pluck('equipos_count')->toArray();

        // Obtener todos los equipos disponibles u ocupado de tupo CPU
        $equiposCPU = Equipo::with('tipo')
            ->whereHas('tipo', function ($query) {
                $query->where('name', 'CPU');
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
        $totalTablets = Tablet::count();
        $hora_actual = Carbon::now()->format('H:i:s A');

        $tpvPorDepartamento = Tpv::select('hotel_id', DB::raw('COUNT(*) as total_tpvs'))
            ->groupBy('hotel_id')
            ->get();

        $tpvsPorDepartamento = DB::table('tpvs')
            ->join('hotels', 'tpvs.hotel_id', '=', 'hotels.id')
            ->select('hotels.nombre as hotel', DB::raw('count(*) as cantidad_tpvs'))
            ->groupBy('hotels.nombre')
            ->get();

        return view('home', compact('hora_actual', 'tpvsPorDepartamento', 'totalTablets', 'totalTpvs', 'totalEmpleados', 'totalEquipos', 'totalUsuarios', 'labels', 'data', 'datos_grafica', 'total_laptops'));
    })->name('home');

    Route::get('/exportar-grafica', function () {
        return Excel::download(new EmpleadoExport, 'datos-grafica.xlsx');
    });

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
    Route::resource('tablets', TabletController::class); // Rutas Usuario
    Route::resource('tpvs', TpvController::class);  //Rutas TPVS
    Route::resource('maintenances', MaintenanceController::class); //Rutas Mantenimiento
    Route::resource('licenses', LicenseController::class); //Rutas Mantenimiento

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

    //asignacion de equipo a empleado
    Route::get('/asignacion', [EmpleadoController::class, 'agregar'])->name('asignacion.index');
    Route::post('/asignacion/asignar', [EmpleadoController::class, 'asignar'])->name('asignacion.asignar');
    Route::get('/asignacion/desvincular/{empleado_id}/{equipo_id}', [EmpleadoController::class, 'desvincular'])->name('asignacion.desvincular');
    Route::get('/detalles/{id}', [EmpleadoController::class, 'detalles'])->name('empleados.detalles');

    //Generacion de hojas de resguardo
    Route::get('/tablet/save-pdf/{id}', [TabletController::class, 'save_pdf'])->name('tablet.save-pdf');
    Route::get('/empleado/save-pdf/{id}', [EmpleadoController::class, 'save_pdf'])->name('empleado.save-pdf');

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


require __DIR__ . '/auth.php';

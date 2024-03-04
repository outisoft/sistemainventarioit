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
use Carbon\Carbon;
use App\Exports\EmpleadoExport;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        // Obtén el total de elementos
        $totalEmpleados = Empleado::count();
        $totalEquipos = Equipo::count();
        $totalUsuarios = User::count();
        $hora_actual = Carbon::now()->format('H:i:s A');
        return view('home', compact('hora_actual', 'totalEmpleados', 'totalEquipos', 'totalUsuarios'));
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
    Route::resource('roles', RoleController::class); // Rutas Graficas

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

    //asignacion de equipo a empleado
    Route::get('/asignacion', [EmpleadoController::class, 'agregar'])->name('asignacion.index');
    Route::post('/asignacion/asignar', [EmpleadoController::class, 'asignar'])->name('asignacion.asignar');
    Route::get('/asignacion/desvincular/{empleado_id}/{equipo_id}', [EmpleadoController::class, 'desvincular'])->name('asignacion.desvincular');
    Route::get('/detalles/{id}', [EmpleadoController::class, 'detalles'])->name('empleados.detalles');


    Route::get('/grafica-usuarios', [ChartController::class, 'userChart'])->name('usuarios.chart');
});

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', function () {return view('home');})->middleware(['auth', 'verified'])->name('home');


require __DIR__ . '/auth.php';

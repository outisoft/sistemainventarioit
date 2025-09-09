<?php
use Illuminate\Support\Facades\Route;

use App\Exports\EmpleadoExport;
use App\Http\Controllers\AccessPointController;
use App\Http\Controllers\AdobeController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AutocadController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ComplementController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DesktopController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OntController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SketchupController;
use App\Http\Controllers\SpecificLocationController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\TpvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillaController;
use Maatwebsite\Excel\Facades\Excel;


Route::group(['middleware' => ['auth', 'check.country', 'force.password.change']], function ()  {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/exportar-grafica', function () {
        return Excel::download(new EmpleadoExport, 'datos-grafica.xlsx');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/remove-avatar', [ProfileController::class, 'removeAvatar'])->name('profile.remove-avatar');

    //Rutas de CRUD
    Route::resource('access-points', AccessPointController::class);//Rutas access points
    Route::resource('adobe', AdobeController::class);//Rutas Adobe
    Route::resource('assignment', AssignmentController::class);//Rutas asignacion
    Route::resource('autocad', AutocadController::class);//Rutas Autocad
    Route::resource('companies', CompanyController::class);//Rutas companies
    Route::resource('complements', ComplementController::class);//Rutas complements
    Route::resource('departments', DepartamentoController::class); //Rutas departamentos
    Route::resource('desktops', DesktopController::class); //Rutas PC
    Route::resource('empleados', EmpleadoController::class); // Rutas Empleados
    Route::resource('employees', EmployeeController::class); // Rutas Empleados
    Route::resource('equipo', EquipoController::class); // Rutas Equipos
    Route::resource('hotels', HotelController::class); //Rutas hoteles
    Route::resource('inventario', InventarioController::class); // Rutas Inventario
    Route::resource('laptops', LaptopController::class);//Rutas laptops
    Route::resource('lease', LeaseController::class); // Rutas Lease
    Route::resource('licenses', LicenseController::class); //Rutas Mantenimiento
    Route::resource('locations', SpecificLocationController::class);//Rutas locations
    Route::resource('maintenances', MaintenanceController::class); //Rutas Mantenimiento
    Route::resource('mobiles', MobileController::class);//Rutas phones
    Route::resource('office', OfficeController::class);//Rutas Office
    Route::resource('ont', OntController::class);//Rutas ONT
    Route::resource('other', OtherController::class);//Rutas Otros
    Route::resource('phones', PhoneController::class);//Rutas phones
    Route::resource('policy', PolicyController::class);//Rutas Policies
    Route::resource('positions', PositionController::class);//Rutas Positions
    Route::resource('printers', PrinterController::class);//Rutas printers
    Route::resource('regions', RegionController::class); //Rutas Region
    Route::resource('roles', RoleController::class); // Rutas roles
    Route::resource('rooms', RoomController::class);//Rutas Rooms
    Route::resource('sketchup', SketchupController::class);//Rutas SketchUp
    Route::resource('switches', SwitchController::class);//Rutas switches
    Route::resource('tabs', TabController::class);//Rutas tabs
    Route::resource('tpvs', TpvController::class);  //Rutas TPVS
    Route::resource('users', UserController::class); // Rutas Usuario
    Route::resource('villas', VillaController::class);//Rutas Villas
    Route::get('/hotels/{hotel}/switches', [SwitchController::class, 'showSwitches'])->name('hotels.switches');
    Route::get('/switches/{switch}/available-ports', [AccessPointController::class, 'getAvailablePort']); // Create ap
    Route::get('/details/{equipo}/equipment', [EquipoController::class, 'details'])->name('details');

    Route::get('/hotels/{hotel}/villas', [VillaController::class, 'show'])->name('villas.show');
    Route::get('/hotels/{hotel}/switch', [SwitchController::class, 'details'])->name('switch.details');
    Route::get('/hotels/{hotel}/access-points', [AccessPointController::class, 'details'])->name('access-points.details');
    Route::get('/hotels/{hotel}/ont', [OntController::class, 'details'])->name('ont.details');

    Route::get('/exportar-excel', [HomeController::class, 'exportarExcel'])->name('download.excel');

    Route::post('/licencias/{licenciaId}/asignar/{equipoId}', [OfficeController::class, 'asignarLicencia'])->name('licencias.asignar.post');
    Route::delete('/licencias/{licenciaId}/desasignar/{equipoId}', [OfficeController::class, 'desasignarLicencia'])->name('licencias.desasignar');

    Route::post('/adobe/{licenciaId}/asignar/{equipoId}', [AdobeController::class, 'asignarLicencia'])->name('adobe.asignar.post');
    Route::delete('/adobe/{licenciaId}/desasignar/{equipoId}', [AdobeController::class, 'desasignarLicencia'])->name('adobe.desasignar');

    Route::post('/sketchup/{licenciaId}/asignar/{equipoId}', [SketchupController::class, 'asignarLicencia'])->name('sketchup.asignar.post');
    Route::delete('/sketchup/{licenciaId}/desasignar/{equipoId}', [SketchupController::class, 'desasignarLicencia'])->name('sketchup.desasignar');

    Route::post('/autocad/{licenciaId}/asignar/{equipoId}', [AutocadController::class, 'asignarLicencia'])->name('autocad.asignar.post');
    Route::delete('/autocad/{licenciaId}/desasignar/{equipoId}', [AutocadController::class, 'desasignarLicencia'])->name('autocad.desasignar');

    Route::post('/phone/{phoneId}/asignar/{positionId}', [PhoneController::class, 'asignarPhone'])->name('phone.asignar');
    Route::delete('/phone/{phoneId}/desasignar/{positionId}', [PhoneController::class, 'desasignarPhone'])->name('phone.desasignar');

    //Asignar breack al sw
    Route::post('/switch/{switch}/asignar/', [SwitchController::class, 'asignarBreack'])->name('breack.asignar');
    Route::delete('/switch/{switch}/desasignar/{breack}', [SwitchController::class, 'desasignarBreack'])->name('breack.desasignar');


    Route::get('/get-villas', [PhoneController::class, 'getVillas'])->name('getVillas');
    Route::get('/get-rooms', [PhoneController::class, 'getRooms'])->name('getRooms');

    //Backup
    Route::prefix('backup')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/create', [BackupController::class, 'create'])->name('backup.create');
        Route::get('/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::post('/restore', [BackupController::class, 'restore'])->name('backup.restore');
        Route::delete('/delete/{filename}', [BackupController::class, 'delete'])->name('backup.delete');
    });

    //Laptop trashes
    Route::prefix('laptops')->group(function () {
        Route::get('/trashes', [LaptopController::class, 'trashes'])->name('laptops.trashes');
        Route::delete('/{id}/trash', [LaptopController::class, 'trash'])->name('laptops.trash');
        Route::post('/{id}/restore', [LaptopController::class, 'restore'])->name('laptops.restore');
    });

    //Desktop trashes
    Route::prefix('desktops')->group(function () {
        Route::get('/trashes', [DesktopController::class, 'trashes'])->name('desktops.trashes');
        Route::delete('/{id}/trash', [DesktopController::class, 'trash'])->name('desktops.trash');
        Route::post('/{id}/restore', [DesktopController::class, 'restore'])->name('desktops.restore');
    });
    
    Route::post('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::post('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

    // Asignar complementos a un equipo
    Route::post('/equipos/{equipo}/asignar-complementos', [EquipoController::class, 'asignarComplementos'])->name('equipos.asignar-complementos');
    Route::delete('/equipos/{equipo}/complementos/{complemento}', [EquipoController::class, 'eliminarComplemento'])->name('equipos.complementos.destroy');

    Route::get('/empleado/{no_empleado}', [EmpleadoController::class, 'getEmpleado']);
    Route::get('/position/{position}', [PositionController::class, 'getPosition']);
    Route::get('/equipos/{serial}', [EquipoController::class, 'getEquipo']);


    Route::get('/qrcode/{id}', [AssignmentController::class, 'generateQRCode'])->name('generateQRCode');
    Route::get('/qrcode/{id}/download', [AssignmentController::class, 'downloadQRCode'])->name('downloadQRCode');
    //Route::get('/qrcode/{id}/details', [AssignmentController::class, 'employeeDetails'])->name('employeeDetails');

    Route::get('empleados/{id}/equipos', [EmpleadoController::class, 'equipos'])->name('empleados.equipos');

    Route::get('/get-departamentos', [EmpleadoController::class, 'getDepartamentos'])->name('get.departamentos');
    Route::get('/get-departments', [TpvController::class, 'getDepartments']);
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

    //Rutas asignacion   Route::resource('assignment', AssignmentController::class);
    //asignacion de equipo a empleado 
    //Route::get('/asignacion', [EmpleadoController::class, 'agregar'])->name('asignacion.index');
    Route::post('/asignar', [AssignmentController::class, 'asignar'])->name('asignar');
    Route::get('/desvincular/{position_id}/{equipment_id}', [AssignmentController::class, 'desvincular'])->name('desvincular');
    Route::get('/save-pdf/{id}', [AssignmentController::class, 'save_pdf'])->name('save-pdf');
    Route::get('/save-word/{id}', [AssignmentController::class, 'save_word'])->name('save-word');
    Route::get('/save-pdf-tcc/{id}', [AssignmentController::class, 'save_pdf_tcc'])->name('save-pdf-tcc');
    //Route::get('/detalles/{id}', [AssignmentController::class, 'detalles'])->name('detalles');

    //CHARTS
    Route::get('/grafica-usuarios', [ChartController::class, 'userChart'])->name('usuarios.chart');
});
Route::get('/qrcode/{id}/details', [AssignmentController::class, 'employeeDetails'])->name('employeeDetails');

Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
Route::post('/password/change', [PasswordController::class, 'change'])->name('password.update');

Route::resource('agenda', AgendaController::class);
Route::get('/agenda/buscar', [AgendaController::class, 'buscar'])->name('agenda.buscar');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
    //return view('errors/maintenance');
})->name('login');

Route::get('/welcome', function () {
    return view('welcome');
});

/*Route::get('/maintenance', function () {
    return view('errors/maintenance');
});*/


require __DIR__ . '/auth.php';

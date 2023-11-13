<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Exports\EmpleadoExport;
use App\Imports\EmpleadoImport;
use Spatie\Permission\Models\Role;
use App\Models\User; // Asegúrate de importar tu modelo de usuario si es necesario
use Maatwebsite\Excel\Facades\Excel;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:empleados.index')->only('index');
        $this->middleware('can:empleados.create')->only('create', 'store');
        $this->middleware('can:empleados.edit')->only('edit', 'update');
        $this->middleware('can:empleados.show')->only('show');
        $this->middleware('can:empleados.destroy')->only('destroy');
    }

    public function index()
    {
        $empleados = Empleado::with('hotel', 'departamento')->orderBy('name', 'asc')->get();
        $hoteles = Hotel::all();
        $departamentos = Departamento::all();
        return view('empleados.index', compact('empleados', 'hoteles', 'departamentos'));
    }

    public function create()
    {
        $hoteles = Hotel::all();
        $departamentos = Departamento::all();
        return view('empleados.create', compact('hoteles', 'departamentos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_empleado' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'puesto' => 'required',
            'departamento_id' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'ad' => 'required',
        ]);
        //dd($data);

        $registro = Empleado::create($data);

        Historial::create([
            'accion' => 'creacion',
            'descripcion' => "Se creó el registro {$registro->name}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$registro->name} creado.");
        return redirect()->route('empleados.index');
    }

    // Método para mostrar un registro específico
    public function show($id)
    {
        $registro = Empleado::findOrFail($id);
        $hotel = Hotel::find($registro->hotel_id); // Obtiene el hotel asociado al empleado
        $departamento = Departamento::find($registro->departamento_id);
        return view('empleados.show', compact('registro', 'hotel', 'departamento'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        //$empleados = Empleado::with('hotel','departamento')->orderBy('name', 'asc')->get();
        $empleados = Empleado::findOrFail($id);
        $hoteles = Hotel::all(); // Obtén la lista de hoteles
        $departamentos = Departamento::all();
        return view('empleados.edit', compact('empleados', 'hoteles', 'departamentos'));
    }

    // Método para actualizar un registro
    public function update(Request $request, $id)
    {
        //dd($request);
        $data = $request->validate([
            'no_empleado' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'puesto' => 'required',
            'departamento_id' => 'required|exists:departamentos,id',
            'hotel_id' => 'required|exists:hotels,id',
            'ad' => 'required',
        ]);

        //dd($data);

        $registro = Empleado::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el registro {$registro->name}",
            'registro_id' => $registro->id,
        ]);
        // Mostrar notificación Toastr para éxito

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$registro->name} actualizado.");
        return redirect()->route('empleados.index');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = Empleado::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el registro {$registro->name}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$registro->name} eliminado.");
        return redirect()->route('empleados.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $empleados = Empleado::where('name', 'like', '%' . $query . '%')
            ->orWhere('ad', 'like', '%' . $query . '%')
            ->get();

        return view('empleados._employee_list', compact('empleados'));
    }

    public function agregar()
    {
        $empleados = Empleado::with('hotel', 'departamento')->orderBy('name', 'asc')->get();
        $equipos = Equipo::with('tipo')->get();
        //$equipos = DB::table('equipos')->get();
        $empleadosConEquipos = Empleado::whereHas('empleados_equipos')->get();
        $equiposSinAsignar = Equipo::whereDoesntHave('empleados')->get();

        return view('empleados.asignacion', compact('empleados', 'equipos', 'empleadosConEquipos', 'equiposSinAsignar'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $empleado = Empleado::find($request->input('empleado_id'));
        $empleado->equipos()->attach($request->input('equipo_id'));

        return redirect()->route('asignacion.index');
    }

    public function desvincular($empleado_id, $equipo_id)
    {
        $empleado = Empleado::find($empleado_id);
        $empleado->equipos()->detach($equipo_id);

        return redirect()->route('asignacion.index');
    }

    public function asignarRol($usuarioId, $rol)
    {
        try {
            $usuario = User::find($usuarioId);

            if (!$usuario) {
                return redirect()->back()->with('error', 'Usuario no encontrado.');
            }

            $rol = Role::where('name', $rol)->first();

            if (!$rol) {
                return redirect()->back()->with('error', 'Rol no encontrado.');
            }

            $usuario->assignRole($rol);

            return redirect()->back()->with('success', 'Rol asignado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al asignar el rol.');
        }
    }

    public function export()
    {
        $equipos = Equipo::all();
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Exportacion de datos correctamente.");

        return Excel::download(new EmpleadoExport($equipos), 'empleados.xlsx');
    }

    public function import()
    {
        Excel::import(new EmpleadoImport, request()->file('file'));

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Importacion de datos correctamente.");

        return redirect()->route('empleados.index');
    }

    public function detalles($id)
    {
        $empleado = Empleado::find($id); // Reemplaza 'Empleado' con el nombre de tu modelo de empleado
        $hotel = Hotel::find($empleado->hotel_id); // Obtiene el hotel asociado al empleado
        $departamento = Departamento::find($empleado->departamento_id);
        return view('empleados.detalles', compact('empleado', 'hotel', 'departamento'));
    }
}

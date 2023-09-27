<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use App\Models\User; // Asegúrate de importar tu modelo de usuario si es necesario


class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('hotel')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $hoteles = Hotel::all();
        return view('empleados.create', compact('hoteles'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'no_empleado' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'puesto' => 'required',
            'departamento' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'ad' => 'required',
        ]);
        //dd($data);

        $registro = Empleado::create($data);

        Historial::create([
            'accion' => 'creacion',
            'descripcion' => "Se creó el registro {$registro->nombre}",
            'registro_id' => $registro->id,
        ]);

        return response()->json(['message' => 'Registro creado exitosamente']); 

        //return redirect()->route('empleados.index')->with('success', 'Registro creado exitosamente.');
    }

    // Método para mostrar un registro específico
    public function show($id)
    {
        $registro = Empleado::findOrFail($id);
        $hotel = Hotel::find($registro->hotel_id); // Obtiene el hotel asociado al empleado
        return view('empleados.show', compact('registro', 'hotel'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $registro = Empleado::findOrFail($id);
        $hoteles = Hotel::all(); // Obtén la lista de hoteles
        $hotelSeleccionado = Hotel::find($registro->hotel_id); // Obtén el hotel asociado al empleado
        return view('empleados.edit', compact('registro','hoteles', 'hotelSeleccionado'));
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
            'departamento' => 'required',
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
        //return redirect()->route('empleados.index')->with('success', 'Registro actualizado exitosamente.');
        return response()->json(['message' => 'Actualizacion exitosa']); 

        // Almacena el mensaje en la sesión
        //Session::flash('success', 'La acción se realizó con éxito');
        
        //return response()->json(['message' => 'Actualizacion exitosa']);
        //return redirect()->route('empleados.index');
        // Redirige a la vista "index"
        //return redirect()->route('empleados.index');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = Empleado::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el registro {$registro->nombre}",
            'registro_id' => $registro->id,
        ]);

        return response()->json(['message' => 'Eliminacion exitosa']);

        //return Redirect::route('empleados.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $empleados = Empleado::where('name', 'like', '%' . $query . '%')
                            ->orWhere('ad', 'like', '%' . $query . '%')
                            ->get();

        return view('empleados._employee_list', compact('empleados'));
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

}

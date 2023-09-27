<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Historial;

class UserController extends Controller
{
    // Método para listar todos los usuarios
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    // Método para guardar un nuevo registro
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contraseña' => 'required',
        ]);

        $registro = User::create($data);

        Historial::create([
            'accion' => 'creacion',
            'descripcion' => "Se creó el registro {$registro->nombre}",
            'registro_id' => $registro->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Registro creado exitosamente.');
    }

    // Método para mostrar un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', compact('users'));
    }

    // Método para actualizar un registro
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        //dd($data);

        $registro = User::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el registro {$registro->nombre}",
            'registro_id' => $registro->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Registro actualizado exitosamente.');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = User::findOrFail($id);
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
        $users = User::where('name', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->get();

        return view('users._employee_list', compact('users'));
    }

    // Otros métodos para crear, actualizar y eliminar usuarios pueden agregarse aquí
}

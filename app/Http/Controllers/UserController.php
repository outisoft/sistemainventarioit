<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Historial;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store', 'crearUsuario');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
    }
    // Método para listar todos los usuarios
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Método para guardar un nuevo registro
    public function store(Request $request)
    {
        // Crear el usuario
        $usuario = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Obtener el tipo de usuario (por ejemplo, "admin", "editor", "usuario")
        $tipoUsuario = $request->input('rol');

        //dd($tipoUsuario);

        // Asignar el rol correspondiente al tipo de usuario
        if ($tipoUsuario === 'administrador') {
            $usuario->assignRole('administrador');
        } elseif ($tipoUsuario === 'pro') {
            $usuario->assignRole('pro');
        } else {
            $usuario->assignRole('basico');
        }

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Usuario {$usuario->name} creado.");

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('users.index');
    }

    public function crearUsuario(Request $request)
    {
        // Crear el usuario
        $usuario = User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Asegúrate de gestionar la contraseña de manera segura
        ]);

        // Obtener el rol seleccionado
        $nombreRol = $request->input('rol');

        // Asignar el rol al usuario
        $rol = Role::findByName($nombreRol);
        $usuario->assignRole($rol);

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('lista-usuarios')->with('success', 'Usuario creado exitosamente.');
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
        $roles = Role::pluck('name', 'name');
        // Verifica si el usuario tiene roles asignados
        $tieneRoles = $users->roles->isNotEmpty();
        return view('users.edit', compact('users', 'roles', 'tieneRoles'));
    }

    // Método para actualizar un registro
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        /*$registro = User::findOrFail($id);
        $registro->update($data);*/

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el usuario {$user->name}",
            'registro_id' => $user->id,
        ]);
        // Actualizar el rol del usuario si se ha seleccionado un nuevo rol
        if ($request->has('rol')) {
            $nuevoRol = $request->input('rol');
            $user->syncRoles([$nuevoRol]); // Asigna el nuevo rol
        }

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Usuario {$user->name} actualizado.");

        return redirect()->route('users.index');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = User::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el usuario {$registro->name}",
            'registro_id' => $registro->id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Usuario {$registro->name} eliminado.");

        return redirect()->route('users.index');
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

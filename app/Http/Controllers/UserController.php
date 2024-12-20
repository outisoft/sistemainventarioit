<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use App\Models\Historial;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role as Rol;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store', 'crearUsuario');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
    }
    // Método para listar todos los usuarios
    public function index()
    {
        $users = User::with(['region', 'roles'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();
        $regions = Region::orderBy('name', 'asc')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles', 'regions'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Método para guardar un nuevo registro
    public function store(Request $request)
    {
        try {
            //dd($request);
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'region_id' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'rol' => 'required|exists:roles,name',
            ]);
            // Crear el usuario
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'region_id' => $validatedData['region_id'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Obtener el tipo de usuario (por ejemplo, "admin", "editor", "usuario")
            /*$tipoUsuario = $request->input('rol');
            $user->assignRole([$tipoUsuario]);*/

            $role = Rol::findByName($validatedData['rol']);
            $user->assignRole($role);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Usuario {$user->name} creado.");

            // Redireccionar o mostrar un mensaje de éxito
            return redirect()->route('users.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if (isset($e->validator->failed()['email'])) {
                toastr()
                    ->timeOut(3000)
                    ->addError("El correo electrónico ya está en uso.");
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
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
        $rolesN = Role::all();
        // Verifica si el usuario tiene roles asignados
        $tieneRoles = $users->roles->isNotEmpty();
        return view('users.edit', compact('users', 'roles', 'tieneRoles', 'rolesN'));
    }

    // Método para actualizar un registro
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->region_id = $request->input('region_id');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

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

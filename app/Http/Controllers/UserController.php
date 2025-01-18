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
        $users = User::with(['regions', 'roles'])
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
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'regions' => 'required|array',
                'regions.*' => 'exists:regions,id',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'rol' => 'required|exists:roles,name',
            ]);

            // Crear el usuario
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->regions()->sync($request->regions);

            $role = Rol::findByName($validatedData['rol']);
            $user->assignRole($role);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Usuario {$user->name} creado.");

            return redirect()->route('users.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if (isset($e->validator->failed()['email'])) {
                toastr()
                    ->timeOut(3000) // 3 second
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
        // Validar los datos de entrada
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
            'rol' => 'required|exists:roles,name',
        ]);

        // Encontrar el usuario por ID
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
        ]);

        // Sincronizar las regiones del usuario
        $user->regions()->sync($request->regions);

        // Verificar si el rol ha cambiado
        $currentRole = $user->roles->first()->name ?? null;
        if ($currentRole !== $data['rol']) {
            // Eliminar el rol actual y asignar el nuevo rol
            $user->syncRoles([$data['rol']]);
        }

        // Mostrar mensaje de éxito
        toastr()
            ->timeOut(3000) // 3 segundos
            ->addSuccess("Usuario {$user->name} actualizado.");

        // Redirigir a la lista de usuarios
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

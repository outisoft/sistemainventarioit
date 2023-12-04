<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\Message;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        // Obtener el tipo de usuario (por ejemplo, "admin", "editor", "usuario")
        $tipoUsuario = $request->input('rol');

        //dd($tipoUsuario);

        // Asignar el rol correspondiente al tipo de usuario
        if ($tipoUsuario === 'administrador') {
            $user->assignRole('administrador');
        } elseif ($tipoUsuario === 'pro') {
            $user->assignRole('pro');
        } elseif ($tipoUsuario === 'pro') {
            $user->assignRole('basico');
        } else {
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Usuario {$user->name} creado.");
        }
        //Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

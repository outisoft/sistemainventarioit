<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Historial;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::all();
        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . License::class],
                'password' => 'required',
            ]);

            License::create($request->all());

            $user = auth()->id();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro la licencia {$request->email}",
                'user_id' => $user,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Licencia registrada.");    

            return redirect()->route('licenses.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (isset($e->validator->failed()['email'])) {
                toastr()
                    ->timeOut(3000)
                    ->addError("El correo electrónico ya está en uso.");
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(License $license)
    {
        $license->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino licencia {$license->email} correctamente",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Licencia {$license->email} eliminado.");
        return redirect()->route('licenses.index');
    }
}
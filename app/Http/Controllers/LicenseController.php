<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    public function index()
    {
        $tipo = Tipo::where('name', 'OFFICE')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('licenses.index', compact('equipos'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo_id' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Equipo::class],
                'password' => 'required',
            ]);

            Equipo::create($request->all());

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

    public function update(Request $request, $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'email' => 'required|unique:equipos,email,' . $id,
            'password' => 'required',

        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la {$registro->tipo->name} del correo: {$registro->email}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->email} correctamente.");

        return redirect()->route('licenses.index');
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
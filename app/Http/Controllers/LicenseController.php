<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    public function index()
    {
        //$tipo = Tipo::where('name', 'OFFICE')->first();

        //$equipos = Equipo::where('tipo_id', $tipo->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        $equipos = License::get();

        return view('licenses.index', compact('equipos'));
    }

    public function show($licenciaId)
    {
        $licencia = License::findOrFail($licenciaId);
        $equiposAsignados = $licencia->equipo->pluck('id')->toArray();

        $equipos = Equipo::whereNotIn('id', $equiposAsignados)
                 ->whereIn('tipo_id', [2, 4])
                 ->get();

        return view('licenses.show', compact('licencia', 'equipos'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . License::class],
                'password' => 'required',
            ]);

            License::create($request->all());

            $user = auth()->id();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro la licencia de {$request->name} con el correo {$request->email}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
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
            'name' => 'required',
            'email' => 'required|unique:equipos,email,' . $id,
            'password' => 'required',

        ]);

        $registro = License::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la licencia de {$registro->name} con el correo {$request->email}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->email} correctamente.");

        return redirect()->route('licenses.index');
    }

    public function destroy(string $id)
    {
        $registro = License::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la licencia de {$registro->name} con el correo {$registro->email}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->name}.");

        return redirect()->route('licenses.index');
    }
}
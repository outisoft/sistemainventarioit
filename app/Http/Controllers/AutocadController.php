<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Models\License;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use Illuminate\Validation\Rule; 

class AutocadController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions;

        $tipo = Tipo::where('name', 'AUTOCAD')->first();
        $licenses = License::where('type_id', $tipo->id)
            ->with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->get();

        return view('licenses.autocad.index', compact('userRegions', 'regions', 'licenses'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'type_id' => 'required',
                'type' => 'required', // Validar los tipos permitidos
                'key' => [
                    'required',
                    'string',
                    Rule::unique('licenses')->where(function ($query) use ($request) {
                        return $query->where('key', $request->key)
                                    ->where('type_id', $request->type_id);
                    }),
                ],
                'end_date' => 'date|required',
                'region_id' => 'required',
            ]);

            $licencia = License::create([
                'type_id' => $request->type_id,
                'type' => $request->type,
                'key' => $request->key,
                'end_date' => $request->end_date,
                'max' => 1,
                'region_id' => $request->region_id,
            ]);

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro una licencia de: {$licencia->type} ({$licencia->key})",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se registro la licencia {$licencia->type}");

            return redirect()->route('autocad.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function show($licenciaId)
    {
        $licencia = License::findOrFail($licenciaId);
        $equiposAsignados = $licencia->equipo->pluck('id')->toArray();

        $equipos = Equipo::whereNotIn('id', $equiposAsignados)
                ->whereIn('tipo_id', [2, 4]) 
                ->get();

        return view('licenses.autocad.show', compact('licencia', 'equipos'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->id();
        try {
            $licencia = License::findOrFail($id); 

            $data = $request->validate([
                'type' => 'required',
                'key' => [
                    'required',
                    'string',
                    Rule::unique('licenses')->where(function ($query) use ($request) {
                        return $query->where('key', $request->key)
                                    ->where('type_id', $request->type_id);
                    })->ignore($licencia->id),
                ], // Ignorar la clave actual
                'end_date' => 'date|required', // Obligatorio solo para Office 365
                'region_id' => 'required',
            ]);

            $licencia->update([
                'type' => $request->type,
                'key' => $request->key,
                'end_date' => $request->end_date,
                'region_id' => $request->region_id,
            ]);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó la licencia de {$licencia->type} ({$licencia->key}) ",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó la licencia de {$licencia->type} correctamente.");

            return redirect()->route('autocad.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function asignarLicencia(Request $request, $licenciaId, $equipoId)
    {
        $licencia = License::findOrFail($licenciaId);
        $equipo = Equipo::findOrFail($equipoId);
        $licenciaExistente = $equipo->license()->where('type_id', $licencia->type_id)->exists();

        if ($licenciaExistente) {
            toastr()
                ->timeOut(3000) // 3 second
                ->addError("Este equipo ya tiene una licencia asignada.");
            return redirect()->route('office.show', $licenciaId);
        }
        if ($licencia->equipo()->count() >= $licencia->max) {
            toastr()
                ->timeOut(3000) // 3 second
                ->addError("Límite de asignaciones alcanzado para esta licencia.");
            return redirect()->route('office.show', $licenciaId);
        }

        // Asignar la licencia al equipo
        $licencia->equipo()->attach($equipoId);
        $user = auth()->id();

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se asigno una licencia de {$licencia->type} ({$licencia->key}) al equipo {$equipo->name}",
            'user_id' => $user,
            'region_id' => $licencia->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se asigno la licencia correctamente.");

        return redirect()->route('autocad.show', $licenciaId);
    }

    public function desasignarLicencia($licenciaId, $equipoId)
    {
        // Obtener la licencia por su ID
        $licencia = License::findOrFail($licenciaId);

        // Desasignar la licencia del equipo
        $licencia->equipo()->detach($equipoId);

        $user = auth()->id();
        $equipo = Equipo::findOrFail($equipoId);

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se desvinculo una licencia de {$licencia->type} ({$licencia->key}) al equipo {$equipo->name}",
            'user_id' => $user,
            'region_id' => $licencia->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se desvinculo la licencia correctamente.");

        return redirect()->route('autocad.show', $licenciaId);
    }

    public function destroy($id)
    {
        $licencia = License::findOrFail($id);
        $licencia->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la licencia de {$licencia->type} ({$licencia->key}) ",
            'user_id' => $user,
            'region_id' => $licencia->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la licencia de {$licencia->type}.");

        return redirect()->route('autocad.index');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\License;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$tipo = Tipo::where('name', 'OFFICE')->first();

        $regions = Region::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions;

        $offices = License::with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->get();

        return view('licenses.office.index', compact('userRegions', 'regions', 'offices'));
    }

    public function show($licenciaId)
    {
        $licencia = License::findOrFail($licenciaId);
        $equiposAsignados = $licencia->equipo->pluck('id')->toArray();

        $equipos = Equipo::whereNotIn('id', $equiposAsignados)->get();

        return view('licenses.office.show', compact('licencia', 'equipos'));
    }


    public function asignarLicencia(Request $request, $licenciaId, $equipoId)
    {
        // Obtener la licencia y el equipo
        $licencia = License::findOrFail($licenciaId);
        $equipo = Equipo::findOrFail($equipoId);

        // Validar que el equipo no tenga ya una licencia asignada
        if ($equipo->license()->exists()) {
            return redirect()->route('office.show', $licenciaId)
                            ->with('error', 'Este equipo ya tiene una licencia asignada.');
        }

        // Validar que la licencia no haya alcanzado su límite de asignaciones
        if ($licencia->equipo()->count() >= $licencia->max) {
            return redirect()->route('office.show', $licenciaId)
                            ->with('error', 'Límite de asignaciones alcanzado para esta licencia.');
        }

        // Asignar la licencia al equipo
        $licencia->equipo()->attach($equipoId);

        return redirect()->route('office.show', $licenciaId)
                        ->with('success', 'Licencia asignada correctamente.');
    }

    public function desasignarLicencia($licenciaId, $equipoId)
    {
        // Obtener la licencia por su ID
        $licencia = License::findOrFail($licenciaId);

        // Desasignar la licencia del equipo
        $licencia->equipo()->detach($equipoId);

        return redirect()->route('office.show', $licenciaId)
                        ->with('success', 'Licencia desasignada correctamente.');
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'type_id' => 'required',
                'type' => 'required|in:365,2019,2016,2013,2010,2007,2003', // Validar los tipos permitidos
                'key' => 'required|string|unique:licenses,key',
                'end_date' => 'nullable|date|required_if:tipo,365',
                'region_id' => 'required',
            ]);

            $licencia = new License();
            $licencia->type_id = $request->type_id;
            $licencia->type = $request->type;
            $licencia->key = $request->key;
            $licencia->end_date = $request->end_date;
            $licencia->max = ($request->type == '365') ? 5 : 1; // 5 asignaciones para Office 365, 1 para otros
            $licencia->region_id = $request->region_id;
            $licencia->save();
            /*$registro = Equipo::create($validated);
            $registro->save();*/

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro una licencia de: {$licencia->type}",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se registro la licencia {$licencia->type}");

            return redirect()->route('office.index');

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

    public function update(Request $request, $id)
    {
        $user = auth()->id();
        try {
            $licencia = License::findOrFail($id); 

            $data = $request->validate([
                'type' => 'required|in:365,2019,2016,2013,2010,2007,2003', // Validar los tipos permitidos
                'key' => 'required|string|unique:licenses,key,' . $licencia->id, // Ignorar la clave actual
                'end_date' => 'nullable|date|required_if:type,365', // Obligatorio solo para Office 365
                'region_id' => 'required',
            ]);

            $licencia->type = $request->type;
            $licencia->key = $request->key;
            $licencia->end_date = $request->end_date;
            $licencia->save();

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó la licencia de {$licencia->type} ",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó la licencia de {$licencia->type} correctamente.");

            return redirect()->route('office.index');

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

    public function destroy(Office $office)
    {
        //
    }
}

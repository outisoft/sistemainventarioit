<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Models\License;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use Illuminate\Validation\Rule; 

class AdobeController extends Controller
{
    
    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions;

        $tipo = Tipo::where('name', 'ADOBE')->first();
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

        return view('licenses.adobe.index', compact('userRegions', 'regions', 'licenses'));
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
                'end_date' => 'nullable|date|required_if:tipo,Creative Cloud',
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
                'descripcion' => "Se registro una licencia de: Adobe {$licencia->type} ({$licencia->key})",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se registro la licencia {$licencia->type}");

            return redirect()->route('adobe.index');

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
                'type' => 'required',
                'key' => [
                    'required',
                    'string',
                    Rule::unique('licenses')->where(function ($query) use ($request) {
                        return $query->where('key', $request->key)
                                    ->where('type_id', $request->type_id);
                    })->ignore($licencia->id),
                ], // Ignorar la clave actual
                'end_date' => 'nullable|date|required_if:type,365', // Obligatorio solo para Office 365
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
                'descripcion' => "Se actualizó la licencia de Adobe {$licencia->type} ({$licencia->key}) ",
                'user_id' => $user,
                'region_id' => $licencia->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó la licencia de {$licencia->type} correctamente.");

            return redirect()->route('adobe.index');

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

    public function destroy($id)
    {
        $licencia = License::findOrFail($id);
        $licencia->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la licencia de Adobe {$licencia->type} ({$licencia->key}) ",
            'user_id' => $user,
            'region_id' => $licencia->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la licencia de Adobe {$licencia->type}.");

        return redirect()->route('adobe.index');
    }
}

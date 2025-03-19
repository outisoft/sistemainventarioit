<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Policy;
use App\Models\Historial;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('name', 'asc')
            ->get();
        
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        return view('policies.index', compact('policies', 'regions', 'userRegions'));
    }

    public function store(Request $request)
    {
        try {

            $user = auth()->id();

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'region_id' => 'required|exists:regions,id'
            ]);

            $registro = Policy::create($data);
            $registro->save();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro de la politica ({$registro->name})",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se resgistro {$registro->name} correctamente.");

            return redirect()->route('policy.index');

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

    public function update(Request $request, Policy $policy)
    {
        try {

            $user = auth()->id();

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'region_id' => 'required|exists:regions,id'
            ]);

            $policy->update($data);

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la politica ({$policy->name})",
                'user_id' => $user,
                'region_id' => $policy->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se actualizo la politica {$policy->name} correctamente.");

            return redirect()->route('policy.index');

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

    public function destroy(Policy $policy)
    {
        try {

            $user = auth()->id();

            $policy->delete();

            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino la politica ({$policy->name})",
                'user_id' => $user,
                'region_id' => $policy->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se elimino la politica {$policy->name} correctamente.");

            return redirect()->route('policy.index');

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
}

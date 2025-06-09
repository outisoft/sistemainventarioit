<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Complement;
use App\Models\Historial;
use App\Models\Region;
use App\Models\Lease;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ComplementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:complements.index')->only('index');
        $this->middleware('can:complements.create')->only('create', 'store');
        $this->middleware('can:complements.edit')->only('edit', 'update');
        $this->middleware('can:complements.show')->only('show');
        $this->middleware('can:complements.destroy')->only('destroy');
    }
    
    public function index()
    {
        $tipos = Tipo::whereIn('name', ['CHARGER', 'MONITOR', 'MOUSE', 'NO BREACK', 'SCANNER', 'TECLADO', 'TICKETERA', 'WACOM'])->get();
        $equipos = Complement::with(['region', 'type', 'equipments', 'leases'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->get();
        
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;
        $leases = Lease::orderBy('lease', 'asc')->get();
        
        return view('equipos.complements.index', compact('leases', 'userRegions', 'equipos', 'regions', 'tipos'));
    }

    public function store(Request $request)
    {
        //try {
            $tipo = $request->input('type_id');
            $user = auth()->id();
            $data = $request->validate([
                'type_id' => 'required',
                'tipo_conexion' => 'nullable',
                'tipo_presentacion' => 'nullable',
                'brand' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:complements,serial',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
                'region_id' => 'required',
                'af_code' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('type_id') == $this->getMonitorTypeId() && !$request->input('lease');
                    }),
                ],
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'af_code.required' => 'Es necesario el codigo de Activo Fijo.',
            ]);

            $registro = Complement::create($data);
            $registro->save();
            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agrego {$registro->type->name} con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se creo {$registro->type->name} ({$registro->serial}) correctamente.");
            return redirect()->route('complements.index');
        /*} catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }*/
    }

    private function getMonitorTypeId()
    {
        // Asumiendo que tienes un modelo Type y el nombre del tipo es 'MONITOR'
        return \App\Models\Tipo::where('name', 'MONITOR')->first()->id;
    }

    public function show(Complement $complement)
    {
        return view('equipos.complements.show', compact('complement'));
    }

    public function update(Request $request, string $id)
    {
        $user = auth()->id();
        try {
            $data = $request->validate([
                'brand' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:complements,serial,' . $id,
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
                'region_id' => 'required',
                'af_code' => 'nullable',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
            ]);

            $registro = Complement::findOrFail($id);
            $registro->update($data);

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el {$registro->type->name} con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

            return redirect()->route('complements.index');
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

    public function destroy(string $id)
    {
        $registro = Complement::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->type->name} con N/S {$registro->serial}.",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->type->name}.");

        return redirect()->route('complements.index');
    }
}

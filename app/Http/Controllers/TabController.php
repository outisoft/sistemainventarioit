<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use App\Models\Lease;
use App\Models\Policy;
use Illuminate\Http\Request;

class TabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:tabs.index')->only('index');
        $this->middleware('can:tabs.create')->only('create', 'store');
        $this->middleware('can:tabs.edit')->only('edit', 'update');
        $this->middleware('can:tabs.show')->only('show');
        $this->middleware('can:tabs.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = Policy::orderBy('name')->get();

        $equipos = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'TABLET');
            })
            ->with(['region', 'policy', 'leases'])
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
        $leases = Lease::orderBy('lease', 'asc')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->positions->isEmpty() ? 'Libre' : 'En Uso';
        }
        $userRegions = auth()->user()->regions;

        return view('equipos.tabs.index', compact('leases', 'userRegions', 'equipos', 'policies', 'regions'));
    }

    public function store(Request $request)
    {        
        $user = auth()->id();
        try {
            $data = $request->validate([
                'tipo_id' => 'required',
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial',
                'policy_id' => 'required',
                'lease' => 'required|boolean',
                'af_code' => 'required_if:lease,0',
                'lease_id' => 'required_if:lease,1',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
            ]);
            $registro = Equipo::create($data);
            $registro->save();
            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agrego la {$registro->tipo->name} con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se creo {$registro->tipo->name} ({$registro->serial}) correctamente.");
            return redirect()->route('tabs.index');
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->id();
        try {
            $data = $request->validate([
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial,' . $id,
                'policy_id' => 'required',
                'lease' => 'required|boolean',
                'af_code' => 'required_if:lease,0',
                'lease_id' => 'required_if:lease,1',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
            ]);

            $registro = Equipo::findOrFail($id);
            $registro->update($data);

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la {$registro->tipo->name} con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

            return redirect()->route('tabs.index');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la {$registro->tipo->name} con N/S {$registro->serial}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->tipo->name}.");

        return redirect()->route('tabs.index');
    }
}

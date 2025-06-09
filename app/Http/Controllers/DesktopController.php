<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Lease;
use App\Models\Region;
use Illuminate\Http\Request;

class DesktopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:desktops.index')->only('index');
        $this->middleware('can:desktops.create')->only('create', 'store');
        $this->middleware('can:desktops.edit')->only('edit', 'update');
        $this->middleware('can:desktops.destroy')->only('destroy');
    }

    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();
        $leases = Lease::orderBy('lease', 'asc')->get();
        $tipo = Tipo::where('name', 'DESKTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)
            ->with(['region', 'leases'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->positions->isEmpty() ? 'Libre' : 'En Uso';
        }

        $userRegions = auth()->user()->regions;

        return view('equipos.desktops.index', compact('leases', 'userRegions', 'equipos', 'regions'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        try {
            $data = $request->validate([
                'region_id' => 'required',
                'tipo_id' => 'required',
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial',
                'name' => 'required|unique:equipos,name',
                'ip' => 'required|unique:equipos,ip',
                'so' => 'required',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
                'af_code' => 'required_if:lease,0',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'name.unique' => 'Este nombre de equipo ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);
            
            $registro = Equipo::create($data);
            $registro->save();
            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agrego el {$registro->tipo->name} ({$registro->name}) con S/N: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se creo {$registro->name} correctamente.");
            return redirect()->route('desktops.index');
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

    
    public function show(Request $request)
    {
        $type = Tipo::where('name', 'DESKTOP')->first();

        $equipments = Equipo::where('tipo_id', $type->id)
            ->with(['region', 'leases'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->onlyTrashed()
            ->get();

        $userRegions = auth()->user()->regions;

        return view('equipos.desktops.trash', compact('userRegions', 'equipments'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->id();
        try {
            $data = $request->validate([
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial,' . $id,
                'name' => 'required|unique:equipos,name,' . $id,
                'ip' => 'required|unique:equipos,ip,' . $id,
                'so' => 'required',
                'region_id' => 'required',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
                'af_code' => 'required_if:lease,0',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'name.unique' => 'Este nombre de equipo ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);

            $registro = Equipo::findOrFail($id);
            $registro->update($data);

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el {$registro->tipo->name} ({$registro->name}) con S/N: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) 
                ->addSuccess("Se actualizo el {$registro->name} correctamente.");

            return redirect()->route('desktops.index');
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

    public function trashes()
    {
        $type = Tipo::where('name', 'DESKTOP')->first();

        $equipments = Equipo::where('tipo_id', $type->id)
            ->with(['region', 'leases'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->onlyTrashed()
            ->get();

        $userRegions = auth()->user()->regions;

        return view('equipos.desktops.trash', compact('userRegions', 'equipments'));
    }

    public function trash($id)
    {
        $equipment = Equipo::findOrFail($id);
        $equipment->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Trash',
            'descripcion' => "Se envio la pc a la papelera con numero de serie {$equipment->serial}",
            'user_id' => $user,
            'region_id' => $equipment->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Equipo eliminado.");
        return redirect()->route('desktops.index');
    }

    public function restore($id)
    {
        $equipment = Equipo::withTrashed()->findOrFail($id);
        $equipment->restore();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Restore',
            'descripcion' => "Se restauro de la papelera la pc con numero de serie {$equipment->serial}",
            'user_id' => $user,
            'region_id' => $equipment->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Equipo restaurado correctamente.");
        return redirect()->route('desktops.trashes');
    }

    public function destroy($id)
    {
        try {
            $registro = Equipo::withTrashed()->findOrFail($id);
            $registro->forceDelete();
            $user = auth()->id();

            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino la pc de {$registro->name} con numero de serie {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 segundos
                ->addSuccess("Equipo {$registro->name} eliminado.");

            return redirect()->route('desktops.trashes');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

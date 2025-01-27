<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:laptops.index')->only('index');
        $this->middleware('can:laptops.create')->only('create', 'store');
        $this->middleware('can:laptops.edit')->only('edit', 'update');
        $this->middleware('can:laptops.show')->only('show');
        $this->middleware('can:laptops.destroy')->only('destroy');
    }

    public function index()
    {
        $tipo = Tipo::where('name', 'LAPTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)
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

        $regions = Region::orderBy('name', 'asc')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        $userRegions = auth()->user()->regions;

        return view('equipos.laptops.index', compact('userRegions', 'equipos', 'regions'));
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
                'name' => 'required|unique:equipos,name',
                'ip' => 'required|unique:equipos,ip',
                'so' => 'required',
                'orden' => 'required',
                'lease' => 'required|boolean',
                'code' => 'required_if:lease,1',
                'date' => 'required_if:lease,1',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'name.unique' => 'Este nombre de equipo ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);
            $registro = Equipo::create($data);
            $registro->save();
            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agrego la {$registro->tipo->name} ({$registro->name}) con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se creo {$registro->name} correctamente.");
            return redirect()->route('laptops.index');
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

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial,' . $id,
                'name' => 'required|unique:equipos,name,' . $id,
                'ip' => 'required|unique:equipos,ip,' . $id,
                'so' => 'required',
                'orden' => 'required',
                'lease' => 'required|boolean',
                'code' => 'required_if:lease,1',
                'date' => 'required_if:lease,1',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'name.unique' => 'Este nombre de equipo ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);

            $registro = Equipo::findOrFail($id);
            $registro->update($data);
            $user = auth()->id();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la {$registro->tipo->name} ({$registro->name}) con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);
            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se actualizo el {$registro->name} correctamente.");

            return redirect()->route('laptops.index');
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
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la {$registro->tipo->name} ({$registro->name}) con N/S: {$registro->serial}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->name}.");

        return redirect()->route('laptops.index');
    }
}

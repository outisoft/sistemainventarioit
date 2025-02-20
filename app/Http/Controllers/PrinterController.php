<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Lease;
use App\Models\Region;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:printers.index')->only('index');
        $this->middleware('can:printers.create')->only('create', 'store');
        $this->middleware('can:printers.edit')->only('edit', 'update');
        $this->middleware('can:printers.show')->only('show');
        $this->middleware('can:printers.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo = Tipo::where('name', 'IMPRESORA')->first();

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
        $leases = Lease::orderBy('lease', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        $userRegions = auth()->user()->regions;

        return view('equipos.printers.index', compact('leases', 'userRegions', 'equipos', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $user = auth()->id();
        try {
            $data = $request->validate([
                'tipo_id' => 'required',
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial',
                'ip' => 'required|unique:equipos,ip',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
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
            return redirect()->route('printers.index');
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
    public function update(Request $request, $id)
    {
        $user = auth()->id();
        try {
            $data = $request->validate([
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial,' . $id,
                'ip' => 'required|unique:equipos,ip,' . $id,
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1|exists:leases,id',
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este No. de serie ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);

            $registro = Equipo::findOrFail($id);
            //dd($data);
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

            return redirect()->route('printers.index');
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
            'descripcion' => "Se elimino la {$registro->tipo->name} con N/S {$registro->serial}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->tipo->name}.");

        return redirect()->route('printers.index');
    }
}

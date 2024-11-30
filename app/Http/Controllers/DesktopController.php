<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
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
        $this->middleware('can:desktops.show')->only('show');
        $this->middleware('can:desktops.destroy')->only('destroy');
    }

    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();
        $tipo = Tipo::where('name', 'DESKTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)
            ->with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('equipos.desktops.index', compact('equipos', 'regions'));
    }

    public function store(Request $request)
    {
        $tipo = $request->input('tipo_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'region_id' => 'required',
            'tipo_id' => 'required',
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:equipos,serial',
            'name' => 'required|unique:equipos,name',
            'ip' => 'required|unique:equipos,ip',
            'so' => 'required',
            'orden' => 'required',
        ]);
        //dd($data);
        $registro = Equipo::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego el {$registro->tipo->name} ({$registro->name}) con S/N: {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->name} correctamente.");
        return redirect()->route('desktops.index');
    }

    public function update(Request $request, $id)
    {
        //$tipo = $request->input('tipo_id');
        $user = auth()->id();

        $data = $request->validate([
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:equipos,serial,' . $id,
            'name' => 'required|unique:equipos,name,' . $id,
            'ip' => 'required|unique:equipos,ip,' . $id,
            'so' => 'required',
            'orden' => 'required',
            'region_id' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->tipo->name} ({$registro->name}) con S/N: {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->name} correctamente.");

        return redirect()->route('desktops.index');

    }

    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->tipo->name} ({$registro->name}) con S/N: {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->tipo->name}.");

        return redirect()->route('desktops.index');
    }
}

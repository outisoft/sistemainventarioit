<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Complement;
use App\Models\Historial;
use App\Models\Region;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Complement::with(['region', 'type', 'equipments'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();
        
        $regions = Region::all();
        
        return view('equipos.complements.index', compact('equipos', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipo = $request->input('type_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'type_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:complements,serial',
            'region_id' => 'required',
        ]);
        $registro = Complement::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego {$registro->type->name} con N/S: {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->type->name} ({$registro->serial}) correctamente.");
        return redirect()->route('complements.index');
    }

    public function show(Complement $complement)
    {
        return view('equipos.complements.show', compact('complement'));
    }

    public function update(Request $request, string $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:complements,serial,' . $id,
            'region_id' => 'required',
        ]);

        $registro = Complement::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->type->name} con N/S: {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

        return redirect()->route('complements.index');
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
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->type->name}.");

        return redirect()->route('complements.index');
    }
}

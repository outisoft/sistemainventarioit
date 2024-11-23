<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Policy;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:mobile.index')->only('index');
        $this->middleware('can:mobile.create')->only('create', 'store');
        $this->middleware('can:mobile.edit')->only('edit', 'update');
        $this->middleware('can:mobile.show')->only('show');
        $this->middleware('can:mobile.destroy')->only('destroy');
    }
    public function index()
    {
        $policies = Policy::orderBy('name')->get();

        $equipos = Equipo::whereHas('tipo', function ($query) {
            $query->where('name', 'PHONE');
        })->with('policy')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('equipos.mobile.index', compact('equipos', 'policies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipo = $request->input('tipo_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'tipo_id' => 'required',
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:equipos,serial',
            'policy_id' => 'required',
        ]);
        $registro = Equipo::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego un {$registro->tipo->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->tipo->name} ({$registro->serial}) correctamente.");
        return redirect()->route('mobile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:equipos,serial,' . $id,
            'policy_id' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->tipo->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

        return redirect()->route('mobile.index');
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
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->tipo->name}.");

        return redirect()->route('mobile.index');
    }
}

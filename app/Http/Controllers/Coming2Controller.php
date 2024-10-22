<?php

namespace App\Http\Controllers;
use App\Models\Tablet;
use App\Models\Historial;
use App\Models\Policy;
use App\Models\Coming2;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Coming2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coming2.index')->only('index');
        $this->middleware('can:coming2.create')->only('create', 'store');
        $this->middleware('can:coming2.edit')->only('edit', 'update');
        $this->middleware('can:coming2.show')->only('show');
        $this->middleware('can:coming2.destroy')->only('destroy');
    }

    public function index()
    {
        $politicas = Policy::orderBy('name')->get();
        $tablets = Coming2::get();
        return view('coming2.index', compact('tablets', 'politicas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'operario' => 'required',
            'puesto' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Coming2::class],
            'usuario' => 'required',
            'password' => 'required',
            'numero_tableta' => 'required',
            'serial' => 'required',
            'numero_telefono' => 'required',
            'imei' => 'required',
            'sim' => 'required',
            'policy_id' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Coming2::create($data);

        //dd($request);
        $user = auth()->id();

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se creó la tableta para {$registro->operario} con numero de serie {$registro->serial}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro creado exitosamente.");

        return redirect()->route('coming2.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coming2 $coming2)
    {
        $policies = Policy::orderBy('name')->get();
        return view('coming2.show', compact('coming2', 'policies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tablets = Coming2::findOrFail($id);
        $politicas = Policy::orderBy('name')->get();
        //dd($configurada);
        return view('coming2.edit', compact('tablets', 'politicas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $data = $request->validate([
            'operario' => 'required',
            'puesto' => 'required',
            'email' => 'required|email',
            'usuario' => 'required',
            'password' => 'required',
            'numero_tableta' => 'required',
            'serial' => 'required',
            'numero_telefono' => 'required',
            'imei' => 'required',
            'sim' => 'required',
            'policy_id' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Coming2::findOrFail($id);
        $registro->update($data);

        $user = auth()->id();

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la tableta de {$registro->operario} con numero de serie {$registro->serial}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->operario} actualizado.");

        return redirect()->route('coming2.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coming2 $tablet)
    {
        $tablet->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la tableta de {$tablet->operario} con numero de serie {$tablet->serial}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Tablet de {$tablet->operario} eliminado.");
        return redirect()->route('coming2.index');
    }

    public function save_pdf($id)
    {

        // Obtener la fecha actual
        $today = Carbon::now();

        // Formatear la fecha como "día, mes y año"
        $date = $today->format('d \d\e M \d\e\l Y');

        $tablet = Coming2::findOrFail($id);
        $pdf = FacadePdf::loadView('coming2.save-pdf', compact('tablet', 'date'));
        return $pdf->stream();
    }
}

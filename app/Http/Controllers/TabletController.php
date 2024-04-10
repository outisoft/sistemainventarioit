<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use App\Models\Historial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class TabletController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tablets.index')->only('index');
        $this->middleware('can:tablets.create')->only('create', 'store');
        $this->middleware('can:tablets.edit')->only('edit', 'update');
        $this->middleware('can:tablets.show')->only('show');
        $this->middleware('can:tablets.destroy')->only('destroy');
    }

    public function index()
    {
        $tablets = Tablet::get();
        return view('tablets.index', compact('tablets'));
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
        //dd($request);

        $data = $request->validate([
            'operario' => 'required',
            'puesto' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Tablet::class],
            'usuario' => 'required',
            'password' => 'required',
            'numero_tableta' => 'required',
            'serial' => 'required',
            'numero_telefono' => 'required',
            'imei' => 'required',
            'sim' => 'required',
            'politica' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'giacode' => 'required',
            'personalsdscode' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Tablet::create($data);

        //dd($request);

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se creó la tableta para {$registro->operario}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro creado exitosamente.");

        return redirect()->route('tablets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tablet $tablet)
    {
        return view('tablets.show', compact('tablet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tablets = Tablet::findOrFail($id);

        //dd($configurada);
        return view('tablets.edit', compact('tablets'));
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
            'politica' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'giacode' => 'required',
            'personalsdscode' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Tablet::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la tableta de {$registro->operario}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->operario} actualizado.");

        return redirect()->route('tablets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tablet $tablet)
    {
        $tablet->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la tableta de {$tablet->operario}",
            'registro_id' => $tablet->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Tablet de {$tablet->operario} eliminado.");
        return redirect()->route('tablets.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $tablet = Tablet::where('operario', 'like', '%' . $query . '%')
            ->orWhere('usuario', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('serial', 'like', '%' . $query . '%')
            ->orWhere('numero_tableta', 'like', '%' . $query . '%')
            ->orWhere('imei', 'like', '%' . $query . '%')
            ->get();

        return view('tablets._tablet_list', compact('tablet'));
    }

    public function save_pdf($id){

        // Obtener la fecha actual
        $today = Carbon::now();

        // Formatear la fecha como "día, mes y año"
        $date = $today->format('d \d\e M \d\e\l Y');

        $tablet = Tablet::findOrFail($id);
        $pdf = FacadePdf::loadView('tablets.save-pdf', compact('tablet', 'date'));
        return $pdf->stream();
    }
}

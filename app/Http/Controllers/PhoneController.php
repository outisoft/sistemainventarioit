<?php

namespace App\Http\Controllers;
use App\Models\Phone;
use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\PhoneStoreRequest;
use App\Http\Requests\PhoneUpdateRequest;

class PhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:phones.index')->only('index');
        $this->middleware('can:phones.create')->only('create', 'store');
        $this->middleware('can:phones.edit')->only('edit', 'update');
        $this->middleware('can:phones.show')->only('show');
        $this->middleware('can:phones.destroy')->only('destroy');
    }
    
    public function index()
    {
        $phones = Phone::all();
        return view('comunications.phone.index', compact('phones'));
    }

    public function store(PhoneStoreRequest $request)
    {        
        $user = auth()->id();

        $registro = Phone::create($request->all());
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego un telefono con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo el telefono ({$registro->serial}) correctamente.");
        return redirect()->route('phones.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhoneUpdateRequest $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        $registro = Phone::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el telefono ({$registro->extension}) con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->extension}.");

        return redirect()->route('phones.index');
    }
}

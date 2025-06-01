<?php

namespace App\Http\Controllers;
use App\Models\Phone;
use App\Models\Hotel;
use App\Models\Villa;
use App\Models\Room;
use App\Models\Region;
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
        $phones = Phone::with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('extension', 'asc')
            ->get();

        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;
        return view('comunications.phone.index', compact('phones', 'regions', 'userRegions'));
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
            'region_id' => $registro->region_id,
        ]);
        
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo el telefono ({$registro->serial}) correctamente.");
        return redirect()->route('phones.index');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'extension' => 'required|unique:phones,extension,' . $id,
            'service' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:phones,serial,' . $id,
            'region_id' => 'required|exists:regions,id',
        ]);

        $registro = Phone::findOrFail($id);
        $registro->update($request->all());
        $registro->save();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el telefono ({$registro->extension}) con N/S: {$registro->serial}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->extension} correctamente.");
        return redirect()->route('phones.index');        
    }

    public function show(string $id)
    {
        $phone = Phone::with(['region'])->findOrFail($id);
        $userRegions = auth()->user()->regions;

        return view('comunications.phone.show', compact('phone', 'userRegions'));
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
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->extension}.");

        return redirect()->route('phones.index');
    }
}

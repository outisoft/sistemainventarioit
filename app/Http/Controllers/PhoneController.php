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
        $phones = Phone::with(['region', 'room.villa.hotel'])
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

        $hotels = Hotel::all();
        $villas = Villa::all();
        $rooms = Room::all();
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;
        return view('comunications.phone.index', compact('phones', 'hotels', 'villas', 'rooms', 'regions', 'userRegions'));
    }

    public function getVillas(Request $request)
    {
        $villas = Villa::where('hotel_id', $request->hotel_id)->get();
        return response()->json($villas);
    }

    public function getRooms(Request $request)
    {
        $rooms = Room::where('villa_id', $request->villa_id)->get();
        return response()->json($rooms);
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
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->extension}.");

        return redirect()->route('phones.index');
    }
}

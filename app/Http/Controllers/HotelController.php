<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Departamento;
use App\Models\Region;
use App\Http\Requests\HotelStoreRequest;
use App\Http\Requests\HotelUpdateRequest;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:hotels.index')->only('index');
        $this->middleware('can:hotels.create')->only('create', 'store');
        $this->middleware('can:hotels.edit')->only('edit', 'update');
        $this->middleware('can:hotels.show')->only('show');
        $this->middleware('can:hotels.destroy')->only('destroy');
    }

    public function index()
    {
        $hotels = Hotel::orderBy('name', 'asc')
            ->withCount(['departments'])
            ->with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('name', 'asc')
            ->get();
        $departments = Departamento::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        return view('hotels.index', compact('userRegions', 'hotels', 'departments', 'regions'));
    }

    public function getDepartments($hotel_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $departments = $hotel->departments->sortBy('name')->values();
        return response()->json($departments);
    }

    public function store(HotelStoreRequest $request)
    {
        $hotel = Hotel::create($request->all());

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Hotel {$hotel->name} creado.");
        return redirect()->route('hotels.index');
    }

    public function update(HotelUpdateRequest $request, Hotel $hotel)
    {
        $hotel->update($request->all());
        $hotel->departments()->sync($request->department_ids ?? []);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Asignaciones actualizadas correctamente.");

        return redirect()->route('hotels.index');
    }
    
    public function getDepartamentos(Hotel $hotel)
    {
        try {
            $departamentos = $hotel->departamentos;
            return response()->json($departamentos);
        } catch (\Exception $e) {
            \Log::error('Error en getDepartamentos: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("{$hotel->name} eliminado.");
        return redirect()->route('hotels.index');
    }
}

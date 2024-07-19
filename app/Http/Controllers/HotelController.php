<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Departamento;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:hotels.index')->only('index');
        $this->middleware('can:hotels.create')->only('create', 'store');
        $this->middleware('can:hotels.edit')->only('edit', 'update');
        $this->middleware('can:hotels.show')->only('show');
        $this->middleware('can:hotels.destroy')->only('destroy');
    }

    public function index()
    {
        $hotels = Hotel::orderBy('name', 'asc')->get();
        $departamentos = Departamento::orderBy('name', 'asc')->get();
        return view('hotels.index', compact('hotels', 'departamentos'));
    }

    public function getDepartments($hotel_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $departments = $hotel->departments;
        return response()->json($departments);
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('hotels.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $hotel = Hotel::create([
            'name' => $request->input('name'),
            'tipo' => $request->input('tipo'),
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Hotel {$hotel->name} creado.");
        return redirect()->route('hotels.index');
    }

    public function edit($hotel_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $departments = Departamento::all();
        $assignedDepartments = $hotel->departments->pluck('id')->toArray();
        return view('hotels.edit', compact('hotel', 'departments', 'assignedDepartments'));
    }

    public function update(Request $request, $hotel_id)
    {
        $request->validate([
            'department_ids' => 'array',
            'department_ids.*' => 'exists:departamentos,id',
        ]);

        $hotel = Hotel::findOrFail($hotel_id);
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

<?php

namespace App\Http\Controllers;
use App\Models\Equipo;
use App\Models\Complement;
use Illuminate\Http\Request;

class EquipmentComplementController extends Controller
{
    public function create()
    {
        $equipment = Equipo::all();
        $complements = Complement::all();
        return view('equipos.desktops.assignment', compact('equipment', 'complements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipos,id',
            'complement_ids' => 'required|array',
            'complement_ids.*' => 'exists:complements,id',
        ]);

        $equipment = Equipo::find($request->equipment_id);
        $equipment->complements()->sync($request->complement_ids);

        return redirect()->back()->with('success', 'Complementos asignados correctamente');
    }
}

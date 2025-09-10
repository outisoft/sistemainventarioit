<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CCTV\TypeCamera;

class TypeCameraController extends Controller
{
    public function index()
    {
        // Lógica para listar los tipos de cámaras
        $types = TypeCamera::orderBy('name')->get();
        return view('cctv.type.index', compact('types'));
    }

    public function store(Request $request)
    {
        // Validar y guardar un nuevo tipo de cámara
        $validated = $request->validate([
            'name' => 'required|string|unique:type_cameras,name',
        ]);

        TypeCamera::create($validated);

        toastr()
            ->timeOut(3000)
            ->addSuccess("Type {$validated['name']} created.");

        return redirect()->route('types.index');
    }

    public function update(Request $request, TypeCamera $type)
    {
        // Validar y actualizar un tipo de cámara existente
        $validated = $request->validate([
            'name' => 'required|string|unique:type_cameras,name,' . $type->id,
        ]);

        $type->update($validated);

        toastr()
            ->timeOut(3000)
            ->addSuccess("Type {$validated['name']} updated.");

        return redirect()->route('types.index');
    }

    public function destroy(TypeCamera $type)
    {
        // Eliminar un tipo de cámara
        $type->delete();

        toastr()
            ->timeOut(3000)
            ->addSuccess("Type {$type->name} deleted.");

        return redirect()->route('types.index');
    }
}

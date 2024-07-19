<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:departments.index')->only('index');
        $this->middleware('can:departments.create')->only('create', 'store');
        $this->middleware('can:departments.edit')->only('edit', 'update');
        $this->middleware('can:departments.show')->only('show');
        $this->middleware('can:departments.destroy')->only('destroy');
    }

    public function index(){
        $departamentos = Departamento::orderBy('name', 'asc')->get();
        return view('departments.index', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $departamento = Departamento::create([
            'name' => $request->input('name'),
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Departamento {$departamento->name} creado.");

        return redirect()->route('departments.index');
    }

    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departments.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        //dd($data);

        $registro = Departamento::findOrFail($id);
        $registro->update($data);

        $user = auth()->id();


        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Departamento {$registro->name} actualizado.");
        return redirect()->route('departments.index');
    }

    public function destroy($id)
    {
        $registro = Departamento::findOrFail($id);
        $registro->delete();

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("{$registro->name} eliminado.");
        return redirect()->route('departments.index');
    }
}

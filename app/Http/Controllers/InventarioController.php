<?php

namespace App\Http\Controllers;

use Toastr;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Historial;
use App\Exports\InventarioExport;
use App\Imports\InventarioImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class InventarioController extends Controller
{
    // Método para mostrar todos los registros
    public function index()
    {
        $inventario = Inventario::all();
        return view('inventario.index', compact('inventario'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('inventario.create');
    }

    // Método para guardar un nuevo registro
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        $registro = Inventario::create($data);

        Historial::create([
            'accion' => 'creacion',
            'descripcion' => "Se creó el registro {$registro->nombre}",
            'user_id' => $registro->id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->nombre} creado.");

        return redirect()->route('inventario.index');
    }

    // Método para mostrar un registro específico    no breack asistente chef, mause dañado
    public function show($id)
    {
        $registro = Inventario::findOrFail($id);
        return view('inventario.show', compact('registro'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $registro = Inventario::findOrFail($id);
        return view('inventario.edit', compact('registro'));
    }

    // Método para actualizar un registro
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        $registro = Inventario::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el registro {$registro->nombre}",
            'user_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->nombre} actualizado.");

        return redirect()->route('inventario.index');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = Inventario::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el registro {$registro->nombre}",
            'user_id' => $registro->id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->nombre} eliminado.");

        return redirect()->route('inventario.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $inventario = Inventario::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('cantidad', 'like', '%' . $query . '%')
            ->get();

        return view('inventario._employee_list', compact('inventario'));
    }

    public function historial($id)
    {
        $registro = Inventario::findOrFail($id);
        $historial = Historial::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('inventario.historial', compact('registro', 'historial'));
    }

    public function import(Request $request)
    {
        $importacion = $request->validate([

            'file' => 'required',

        ]);
        Excel::import(new InventarioImport, $request->file('file')->store('temp'));
        return back()->with('status', 'The file has been excel/csv imported to database in Laravel 10');
        //return redirect('excel-csv-file')->with('status', 'The file has been excel/csv imported to database in Laravel 10');
    }
    // Método para exportar a Excel
    public function export()
    {
        //$fileName = 'inventario.xlsx';
        //return Excel::download(new InventarioExport(), 'inventario.xlsx');
        return Excel::download(new InventarioExport, 'inventario.xlsx');
        /*Excel::import(new ImportEmployee, $request->file('file')->store('temp'));
        return back();*/
    }
}

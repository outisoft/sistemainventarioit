<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:region.index')->only('index');
        $this->middleware('can:region.create')->only('create', 'store');
        $this->middleware('can:region.edit')->only('edit', 'update');
        $this->middleware('can:region.show')->only('show');
        $this->middleware('can:region.destroy')->only('destroy');
    }

    public function index()
    {
        $regions =  Region::orderBy('name', 'asc')->with('hotels.departments')->get();
        return view('region.index', compact('regions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $region = Region::create($request->all());

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Region {$region->name} agregado.");

        return redirect()->route('regions.index');
    }

    public function update(Request $request, $id)
    {
            $data = $request->validate([
                'name' => 'required',
            ]);

            $registro = Region::findOrFail($id);
            $registro->update($data);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$registro->no_contrato} ({$registro->serial}) correctamente.");

            return redirect()->route('regions.index');
    }

    public function destroy(Region $region)
    {
        $region->delete();

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("{$region->name} eliminado.");
        return redirect()->route('regions.index');
    }
}

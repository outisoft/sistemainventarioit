<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Importante para la validación
use App\Models\Region;

class NetworkController extends Controller
{
    /**
     * Muestra una lista de todas las redes.
     */
    public function index()
    {
        $networks = Network::orderBy('name', 'asc')->paginate(10);
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        return view('networks.index', compact('networks', 'regions', 'userRegions'));
    }

    /**
     * Guarda la nueva red en la base de datos.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:networks',
                'vlan_id' => 'nullable|integer|min:1|max:4094', // Rango estándar de VLANs
                'region_id' => 'required|exists:regions,id',
            ]);

            Network::create($validatedData);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se registró la red {$validatedData['name']} correctamente.");

            return redirect()->route('networks.index');
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Actualiza la red en la base de datos.
     */
    public function update(Request $request, Network $network)
    {
        try {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('networks')->ignore($network->id), // Ignora el ID actual
            ],
            'vlan_id' => 'nullable|integer|min:1|max:4094',
        ]);

        $network->update($validatedData);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizó la red {$validatedData['name']} correctamente.");

        return redirect()->route('networks.index');
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Elimina la red de la base de datos.
     */
    public function destroy(Network $network)
    {
        try {
        // Opcional: Validar si la red tiene dispositivos asociados antes de borrar
        if ($network->devices()->count() > 0) {
            return redirect()->route('networks.index')
                             ->with('error', 'No se puede eliminar la red porque tiene dispositivos asociados.');
        }

        $network->delete();

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se eliminó la red {$network->name} correctamente.");

        return redirect()->route('networks.index');
        } catch (\Exception $e) {
            toastr()
                ->timeOut(5000)
                ->addError('Ocurrió un error al eliminar la red: ' . $e->getMessage());

            return redirect()->route('networks.index');
        }
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\Lease;
use App\Models\Region;
use App\Models\Historial;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with(['regions'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('lease', 'asc')
            ->get();
        
        $regions = Region::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        return view('lease.index', compact('leases', 'regions', 'userRegions'));
    }

    public function store(Request $request)
    {
        try {

            $user = auth()->id();

            $data = $request->validate([
                'lease' => 'required|string|max:255',
                'end_date' => 'required|date',
                'region_id' => 'required|exists:regions,id'
            ]);

            $registro = Lease::create($data);
            $registro->save();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro el arrendamineto ({$registro->lease}) con caducidad {$registro->end_date}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se resgistro el arrendamiento {$registro->lease} correctamente.");

            return redirect()->route('lease.index');

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

    public function show (Lease $lease)
    {
        return view('lease.show', compact('lease'));
    }

    public function update(Request $request, Lease $lease)
    {
        try {

            $user = auth()->id();

            $data = $request->validate([
                'lease' => 'required|string|max:255',
                'end_date' => 'required|date',
                'region_id' => 'required|exists:regions,id'
            ]);

            $lease->update($data);

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el arrendamineto ({$lease->lease}) con caducidad {$lease->end_date}",
                'user_id' => $user,
                'region_id' => $lease->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se actualizo el arrendamiento {$lease->lease} correctamente.");

            return redirect()->route('lease.index');

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

    public function destroy(Lease $lease)
    {
        try {

            $user = auth()->id();

            $lease->delete();

            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino el arrendamineto ({$lease->lease}) con caducidad {$lease->end_date}",
                'user_id' => $user,
                'region_id' => $lease->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Se elimino el arrendamiento {$lease->lease} correctamente.");

            return redirect()->route('lease.index');

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
}

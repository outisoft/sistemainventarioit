<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecificLocation;
use App\Models\Region;
use App\Models\Hotel;

class SpecificLocationController extends Controller
{
    public function index()
    {
        $locations = SpecificLocation::with(['hotel'])
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

        $hotels = Hotel::orderBy('name', 'asc')->get();

        return view('location.index', compact('locations', 'hotels'));        
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'hotel_id' => 'nullable|exists:hotels,id',
            ]);

            SpecificLocation::create($request->all());

            toastr()
                    ->timeOut(3000)
                    ->addSuccess("Location created successfully");

            return redirect()->route('locations.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            
            return back()->withErrors($e->errors())->withInput();
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
    public function update(Request $request, SpecificLocation $location)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'hotel_id' => 'nullable|exists:hotels,id',
            ]);

            $location->update($request->all());

            toastr()
                    ->timeOut(3000)
                    ->addSuccess("Location updated successfully");

            return redirect()->route('locations.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            
            return back()->withErrors($e->errors())->withInput();
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
    public function destroy(SpecificLocation $location)
    {
        try {
            $location->delete();

            toastr()
                    ->timeOut(3000)
                    ->addSuccess("Location deleted successfully");

            return redirect()->route('locations.index');

        } catch (\Exception $e) {
            toastr()
                ->timeOut(5000)
                ->addError($e->getMessage());

            return back();
        }
    }
}

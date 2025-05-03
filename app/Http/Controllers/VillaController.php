<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\Region;
use App\Models\Hotel;
use Illuminate\Http\Request;

class VillaController extends Controller
{
    public function index()
    {
        $villas = Villa::with(['region', 'hotel'])
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

        $regions = Region::orderBy('name', 'asc')->get();
        $hotels = Hotel::orderBy('name', 'asc')->withCount('villas')->get();
        $userRegions = auth()->user()->regions;

        return view('villas.index', compact('villas', 'regions', 'userRegions', 'hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        Villa::create($request->all());

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Villa {$request->name} created successfully");

        return redirect()->back();
    }

    public function update(Request $request, Villa $villa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        $villa->update($request->all());

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Villa {$request->name} updated successfully");

        return redirect()->back();
    }

    public function show(Hotel $hotel)
    {
        $regions = Region::orderBy('name', 'asc')->get();
        $hotels = Hotel::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        $villas = $hotel->villas()->orderBy('name')->get();
        return view('villas.show', compact('villas', 'hotel', 'regions', 'userRegions', 'hotels'));
    }

    public function destroy(Villa $villa)
    {
        $villa->delete();

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Villa {$villa->name} deleted successfully");

        return redirect()->back();
    }
}

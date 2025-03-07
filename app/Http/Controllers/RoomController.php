<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Region;
use App\Models\Villa;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['region', 'villa'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('number', 'asc')
            ->get();

        $regions = Region::orderBy('name', 'asc')->get();
        $villas = Villa::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        return view('rooms.index', compact('villas', 'regions', 'userRegions', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'villa_id' => 'required|exists:villas,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'villa_id' => 'required|exists:villas,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index');
    }
}

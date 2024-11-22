<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function index(){

        $regions =  Region::orderBy('name', 'asc')->with('hotels.departments')->get();
        return view('region.index', compact('regions'));
    }
}

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

    public function index(){

        $regions =  Region::orderBy('name', 'asc')->with('hotels.departments')->get();
        return view('region.index', compact('regions'));
    }
}

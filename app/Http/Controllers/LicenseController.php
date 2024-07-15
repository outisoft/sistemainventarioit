<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::all();
        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'password' => 'required',
            'total_licenses' => 'required|integer|min:1',
            'applied_licenses' => 'required|integer|min:0|lte:total_licenses',
        ]);

        License::create($request->all());

        return redirect()->route('licenses.index')->with('success', 'Licencia creada exitosamente.');
    }
}
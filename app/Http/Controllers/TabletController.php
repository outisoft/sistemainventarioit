<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tablets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tablet $tablet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tablet $tablet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tablet $tablet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tablet $tablet)
    {
        //
    }
}

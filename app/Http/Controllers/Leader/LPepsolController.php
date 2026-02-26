<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use Illuminate\Http\Request;

class LPepsolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('leader.pepsol.index');
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
    public function show(Pepsol $pepsol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pepsol $pepsol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pepsol $pepsol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pepsol $pepsol)
    {
        //
    }
}

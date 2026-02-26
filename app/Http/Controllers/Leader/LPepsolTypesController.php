<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pepsol\Type\StoreTypeRequest;
use App\Http\Requests\Pepsol\Type\UpdateTypeRequest;
use App\Models\PepsolType;
use Illuminate\Http\Request;

class LPepsolTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = PepsolType::orderBy('id')->paginate(10);
        return view('leader.pepsol.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leader.pepsol.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        PepsolType::create($request->validated());
        return redirect()->route('leader.pepsol-types.index')->with('success', 'Pepsol Types Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(PepsolType $pepsolType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PepsolType $pepsolType)
    {
        return view('leader.pepsol.type.edit', compact('pepsolType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, PepsolType $pepsolType)
    {
        $pepsolType->update($request->validated());
        return redirect()->route('leader.pepsol-types.index')->with('success', 'Pepsol Types Successfully Updated');
    }

    public function archived()
    {
        $types = PepsolType::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('leader.pepsol.type.archive', compact('types'));
    }
    public function archive(PepsolType $pepsolType)
    {
        $pepsolType->delete();
        return redirect()->route('leader.pepsol-types.index')->with('success', 'Pepsol Types Successfully Archived');
    }

    public function restore($id)
    {
        $types = PepsolType::onlyTrashed()->findOrFail($id);
        $types->restore();
        return redirect()->route('leader.pepsol-types.archived')->with('success', 'Pepsol Type Successfully Restored');
    }

    public function forceDelete($id)
    {
        $types = PepsolType::onlyTrashed()->findOrFail($id);
        $types->forceDelete();
        return redirect()->route('leader.pepsol-types.archived')->with('success', 'Pepsol Type Successfully Deleted');
    }
}

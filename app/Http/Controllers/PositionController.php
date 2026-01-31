<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Services\PositionService;
use Database\Seeders\PositionSeeder;
use App\Http\Requests\Position\StorePositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;

class PositionController extends Controller
{
    protected PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }
    public function index(Request $request)
    {
        $positions = $this->positionService->getPaginatePosition($request);
        return view('staff.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        Position::create($request->validated());
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('staff.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->validated());
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }

    public function archived(Request $request)
    {

        $positions = $this->positionService->getArchivePosition($request);
        return view('staff.positions.archive', compact('positions'));
    }

    public function archive(Position $position)
    {
        $position->delete();
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Archived');
    }

    public function restore($id)
    {
        $positions = Position::onlyTrashed()->findOrFail($id);
        $positions->restore($id);
        return redirect()->route('staff.positions.archived')->with('success', 'Position Successfully Restored');
    }

    public function forceDelete($id)
    {
        $positions = Position::onlyTrashed()->findOrFail($id);
        $positions->forceDelete($id);

        return redirect()->route('staff.positions.archived')->with('success', 'Position Successfully Deleted');
    }
}

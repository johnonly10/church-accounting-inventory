<?php

namespace App\Http\Controllers;

use App\Http\Requests\Leader\StoreLeaderRequest;
use App\Models\Leader;
use Illuminate\Http\Request;
use App\Services\LeaderService;

class LeaderController extends Controller
{
    protected LeaderService $leaderService;

    public function __construct(LeaderService $leaderService)
    {
        $this->leaderService = $leaderService;
    }

    public function index(Request $request)
    {
        $leaders = $this->leaderService->getPaginateLeader($request);
        return view('staff.leaders.index', compact('leaders'));
    }

    public function create()
    {
        return view('staff.leaders.create');
    }

    public function store(StoreLeaderRequest $request)
    {
        // dd($request->all());
        Leader::create($request->validated());
        return redirect()->route('staff.leaders.index')->with('success', 'Leaders Succesfully Added');
    }

    public function edit(Leader $leader)
    {
        return view('staff.leaders.edit', compact('leader'));
    }

    public function update(StoreLeaderRequest $request, Leader $leader)
    {
        $leader->update($request->validated());
        return redirect()->route('staff.leaders.index')->with('success', "Leader's Information Successfully Updated");
    }

    public function archive(Leader $leader)
    {
        $leader->delete();
        return redirect()->route('staff.leaders.index')->with('success', 'Leader archived Successfully');
    }

    public function archived(Request $request)
    {
        $leaders = $this->leaderService->getArchiveLeader($request);
        return view('staff.leaders.archive', compact('leaders'));
    }

    public function restore($id)
    {
        $leader = Leader::onlyTrashed()->findOrFail($id);
        $leader->restore();
        return redirect()->route('staff.leaders.archived')->with('success', 'Leader restore Successfully');
    }

    public function forceDelete($id)
    {
        $leader = Leader::onlyTrashed()->findOrFail($id);
        $leader->forceDelete();
        return redirect()->route('staff.leaders.archived')->with('success', 'Leader permanently Deleted');
    }
}

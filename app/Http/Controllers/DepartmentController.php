<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('id')->paginate(10);
        return view('staff.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name'
        ]);

        Department::create($validated);
        return redirect()->route('staff.departments.index')->with('success', 'Department Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('staff.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        $department->update($validated);
        return redirect()->route('staff.departments.index')->with('success', 'Department Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }

    public function archived()
    {
        $departments = Department::onlyTrashed()->paginate(10);
        return view('staff.departments.archive', compact('departments'));
    }

    public function archive(Department $department)
    {
        $department->delete();
        return redirect()->route('staff.departments.index')->with('success', 'Department Successfully Archive');
    }

    public function restore($id)
    {
        $department = Department::onlyTrashed()->findorFail($id);
        $department->restore();
        return redirect()->route('staff.departments.archived')->with('success', 'Department Successfull Restored');
    }

    public function forceDelete($id)
    {
        $deparmtent = Department::onlyTrashed()->findOrFail($id);
        $deparmtent->forceDelete();
        return redirect()->route('staff.departments.archived')->with('success', 'Department Successfully Deleted');
    }
}

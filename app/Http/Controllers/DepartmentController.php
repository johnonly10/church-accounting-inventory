<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use Database\Seeders\DepartmentSeeder;

class DepartmentController extends Controller
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        $departments = $this->departmentService->getPaginatedDepartment($request);
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
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
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
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('staff.departments.index')->with('success', 'Department Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }

    public function archived(Request $request)
    {
        $departments = $this->departmentService->getArchiveDepartment($request);
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

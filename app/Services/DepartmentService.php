<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentService
{
    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function getPaginatedDepartment(Request $request)
    {
        $query = Department::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('id')->paginate(10)->withQueryString();
    }

    public function getArchiveDepartment(Request $request)
    {
        $query = Department::onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }
}

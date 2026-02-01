<?php

namespace App\Services;

use App\Models\RevenueType;
use Illuminate\Http\Request;

class RevenueTypeService
{
    public function getPaginateRevenueType(Request $request)
    {
        $query = RevenueType::query();
        $query = $this->applyFilter($query, $request);
        return $query->orderBy('name')->paginate(10)->withQueryString();
    }

    public function getArchiveRevenueType(Request $request)
    {
        $query = RevenueType::query()->onlyTrashed();
        $query = $this->applyFilter($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }

    protected function applyFilter($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}

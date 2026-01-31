<?php

namespace App\Services;

use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryService
{
    public function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function getPaginateMinistry(Request $request)
    {
        $query = Ministry::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('id')->paginate(10)->withQueryString();
    }

    public function getArchiveMinistry(Request $request)
    {
        $query = Ministry::onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10);
    }
}

<?php

namespace App\Services;

use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderService
{
    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nickname', 'like', "%{$search}%")
                    ->orWhere('cell_name', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function getPaginateLeader(Request $request)
    {
        $query = Leader::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('id')->paginate(10)->withQueryString();
    }

    public function getArchiveLeader(Request $request)
    {
        $query = Leader::onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }
}

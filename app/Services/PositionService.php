<?php

namespace App\Services;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionService
{

    public function getPaginatePosition(Request $request)
    {
        $query = Position::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('name')->paginate(10);
    }

    public function getArchivePosition(Request $request)
    {
        $query = Position::onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10);
    }

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
}

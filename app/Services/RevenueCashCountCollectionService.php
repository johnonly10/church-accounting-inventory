<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\RevenueCashCount;

class RevenueCashCountCollectionService
{
    public function getPaginateRevenueCashCount(Request $request)
    {
        $query =  RevenueCashCount::query();
        $query = $this->applyFilter($query, $request);
        return $query->orderBy('date', 'desc')->paginate(10)->withQueryString();
    }


    protected function applyFilter($query, Request $request)
    {
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        return $query;
    }

    public function getArchiveRevenueCashCount(Request $request)
    {
        $query = RevenueCashCount::onlyTrashed();
        $query = $this->applyFilter($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }
}

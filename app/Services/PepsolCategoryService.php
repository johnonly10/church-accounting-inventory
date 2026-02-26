<?php

namespace App\Services;

use App\Models\PepsolCategory;
use Illuminate\Http\Request;

class PepsolCategoryService
{


    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        return $query;
    }


    public function getPaginatedCategories(Request $request)
    {
        $query = PepsolCategory::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('id')->paginate(10)->withQueryString();
    }

    public function getArchivedCategories(Request $request)
    {
        $query = PepsolCategory::query()->onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }
}

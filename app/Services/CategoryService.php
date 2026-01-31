<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
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

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        return $query;
    }

    public function getPaginatedCategories(Request $request)
    {
        $query = Category::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('code')->paginate(10)->withQueryString();
    }

    public function getArchivedCategories(Request $request)
    {
        $query = Category::onlyTrashed();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getPaginateUser(Request $request)
    {
        $query = User::with(['ministry', 'leader']);
        $query = $this->applyFilter($query, $request);
        return $query->orderBy('name')->paginate(10)->withQueryString();
    }

    public function applyFilter($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}

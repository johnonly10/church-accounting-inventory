<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolName;
use App\Models\PepsolTopic;
use App\Models\PepsolType;
use Illuminate\Http\Request;

class PepsolController extends Controller
{
    public function index(Request $request)
    {
        $categories = PepsolCategory::withCount('pepsols')->get();
        $types = PepsolType::all();

        $namesQuery = PepsolName::withCount('lessons');

        if ($request->filled('category')) {
            $namesQuery->whereHas('lessons.pepsol', function ($q) use ($request) {
                $q->where('pepsol_category_id', $request->category);
            });
        }

        if ($request->filled('types')) {
            $typeIds = $request->types;
            if (is_string($typeIds)) {
                $typeIds = explode(',', $typeIds);
            }
            $namesQuery->whereHas('lessons.pepsol', function ($q) use ($typeIds) {
                $q->whereIn('pepsol_type_id', $typeIds);
            });
        }

        if ($request->filled('search')) {
            $namesQuery->where('name', 'like', '%' . $request->search . '%');
        }

        switch ($request->sort) {
            case 'title_asc':
                $namesQuery->orderBy('name', 'asc');
                break;
            case 'title_desc':
                $namesQuery->orderBy('name', 'desc');
                break;
            default:
                $namesQuery->orderBy('created_at', 'desc');
        }

        $names = $namesQuery->paginate(12)->withQueryString();

        return view('guest.pepsol', compact('names', 'categories', 'types'));
    }
}

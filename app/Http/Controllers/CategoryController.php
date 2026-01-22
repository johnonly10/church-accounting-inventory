<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();


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

        $categories = $query->orderBy('code')->paginate(10)->withQueryString();

        // dd($request->all());
        return view('staff.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('staff.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:categories,code',
            'type' => 'required|string|in:asset,liability,equity,receipts,expenses,funds',
        ]);

        Category::create($validated);
        return redirect()->route('staff.categories.index')->with('success', 'Category Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('staff.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:categories,code,' . $category->id,
            'type' => 'required|string|in:asset,liability,equity,receipts,expenses,funds',
        ]);

        $category->update($validated);
        return redirect()->route('staff.categories.index')->with('success', 'Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function archived(Request $request)
    {
        $query = Category::onlyTrashed();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                ;
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $categories = $query->onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10)->withQueryString();
        return view('staff.categories.archive', compact('categories'));
    }

    public function archive(Category $category)
    {
        $category->delete();
        return redirect()->route('staff.categories.index')->with('success', 'Category Successfully Archived');
    }

    public function restore($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore($id);
        return redirect()->route('staff.categories.archived')->with('success', 'Category Successfully Restore');
    }

    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete($id);
        return redirect()->route('staff.categories.archived')->with('success', 'Category Successfully Deleted');
    }
}

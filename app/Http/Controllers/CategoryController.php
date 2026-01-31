<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    // preload the categoryserivce code
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getPaginatedCategories($request);
        return view('staff.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('staff.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());

        Category::create($request->validated());
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
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

        $categories = $this->categoryService->getArchivedCategories($request);
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

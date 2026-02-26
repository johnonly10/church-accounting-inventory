<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pepsol\Category\StoreCategoryRequest;
use App\Http\Requests\Pepsol\Category\UpdateCategoryRequest;
use App\Models\PepsolCategory;
use App\Services\PepsolCategoryService;
use Illuminate\Http\Request;

class LPepsolCategoriesController extends Controller
{

    protected PepsolCategoryService $pepsolCategoryService;

    public function __construct(PepsolCategoryService $pepsolCategoryService)
    {
        $this->pepsolCategoryService = $pepsolCategoryService;
    }

    public function index(Request $request)
    {

        $categories = $this->pepsolCategoryService->getPaginatedCategories($request);
        return view('leader.pepsol.category.index', compact('categories'));
    }

    public function create()
    {
        return view('leader.pepsol.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        PepsolCategory::create($request->validated());
        return redirect()->route('leader.pepsol-categories.index')->with('success', 'Category Successfully Created');
    }

    public function edit(PepsolCategory $pepsolCategory)
    {
        return view('leader.pepsol.category.edit', compact('pepsolCategory'));
    }

    public function update(UpdateCategoryRequest $request, PepsolCategory $pepsolCategory)
    {
        $pepsolCategory->update($request->validated());
        return redirect()->route('leader.pepsol-categories.index')->with('success', 'Categories Successfully Updated');
    }

    public function archived(Request $request)
    {
        $categories = $this->pepsolCategoryService->getArchivedCategories($request);
        return view('leader.pepsol.category.archive', compact('categories'));
    }

    public function archive(PepsolCategory $pepsolCategory)
    {
        $pepsolCategory->delete();
        return redirect()->route('leader.pepsol-categories.index')->with('success', 'Category Successfully Archived');
    }

    public function restore($id)
    {
        $categories = PepsolCategory::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('leader.pepsol-categories.archived')->with('success', 'Category Successfully Restore');
    }

    public function forceDelete($id)
    {
        $categories = PepsolCategory::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();
        return redirect()->route('leader.pepsol-categories.archived')->with('success', 'Category Successfully Deleted');
    }
}

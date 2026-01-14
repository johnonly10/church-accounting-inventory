<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{

    public function index()
    {
        $ecategories = ExpenseCategory::orderBy('id')->paginate(10);
        return view('staff.expense-categories.index', compact('ecategories'));
    }

    public function create()
    {
        return view('staff.expense-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:expense_categories,code',
        ]);

        ExpenseCategory::create($validated);
        return redirect()->route('staff.expense-categories.index')->with('success', 'Category Expense Successfully Created');
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('staff.expense-categories.edit', compact('expenseCategory'));
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:expense_categories,code,' . $expenseCategory->id,
        ]);

        $expenseCategory->update($validated);
        return redirect()->route('staff.expense-categories.index')->with('success', 'Category Expenses Successfully Updated');
    }

    public function archived()
    {
        $ecategories = ExpenseCategory::onlyTrashed()->paginate(10);
        return view('staff.expense-categories.archive', compact('ecategories'));
    }


    public function archive(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        return redirect()->route('staff.expense-categories.index')->with('success', 'Category Expense Successfully Archived');
    }


    public function restore($id)
    {
        $ecategories = ExpenseCategory::onlyTrashed()->findOrFail($id);
        $ecategories->restore($id);
        return redirect()->route('staff.expense-categories.archived')->with('success', 'Category Expense Successfully Restored');
    }

    public function forceDelete($id)
    {
        $ecategories = ExpenseCategory::onlyTrashed()->findOrFail($id);
        $ecategories->forceDelete($id);
        return redirect()->route('staff.expense-categories.archived')->with('success', 'Category Expenses Successfully Deleted');
    }
}

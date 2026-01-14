<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('category')->latest()->paginate(10);
        return view('staff.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id')->get();
        return view('staff.expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        Expense::create($validated);
        return redirect()->route('staff.expenses.index')->with('success', 'Expenses Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::orderBy('id')->get();
        return view('staff.expenses.edit', compact('categories', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        $expense->update($validated);
        return redirect()->route('staff.expenses.index')->with('success', 'Expense Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function archived()
    {
        $expenses = Expense::with('category')->onlyTrashed()->paginate(10);
        return view('staff.expenses.archive', compact('expenses'));
    }

    public function archive(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('staff.expenses.index')->with('success', 'Expense Successfully Archived');
    }

    public function restore($id)
    {
        $expenses = Expense::onlyTrashed()->findOrFail($id);
        $expenses->restore($id);
        return redirect()->route('staff.expenses.archived')->with('successs', 'Expense Successfully Restored');
    }

    public function forceDelete($id)
    {
        $expenses = Expense::onlyTrashed()->findOrFail($id);
        $expenses->forceDelete($id);
        return redirect()->route('staff.expenses.archived')->with('success', 'Expenses Successfully Delete');
    }
}

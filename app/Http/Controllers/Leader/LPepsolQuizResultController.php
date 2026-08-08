<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\PepsolUserQuizAttempt;
use Illuminate\Http\Request;

class LPepsolQuizResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attempts = PepsolUserQuizAttempt::with(['user', 'quiz'])
            ->when(request('status'), function ($query) {
                return $query->where('status', request('status'));
            })
            ->when(request('passed'), function ($query) {
                return $query->where('passed', request('passed'));
            })
            ->when(request('search'), function ($query) {
                $search = request('search');
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('quiz', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        // Pass status options to view
        $statusOptions = [
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'abandoned' => 'Abandoned',
        ];

        return view('leader.pepsol.result.index', compact('attempts', 'statusOptions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

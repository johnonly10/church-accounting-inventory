<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leader;
use App\Models\Ministry;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['ministry', 'leader'])
            ->latest()->paginate(10);
        return view('staff.users.index', compact('users'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $leaders = Leader::orderBy('name')->get();
        $ministries = Ministry::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('staff.users.create', compact('departments', 'leaders', 'ministries', 'positions'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate(
            [
                'department_id' => 'nullable|exists:departments,id',
                'leader_id' => 'nullable|exists:leaders,id',
                'ministry_id' => 'nullable|exists:ministries,id',
                'position_id'  => 'required|exists:positions,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users,email',
                'password' => 'required|string|max:255',
            ],

            [
                'email.unique' => 'This email is already taken.',
                'password.confirmed' => 'Passwords do not match.',
                'password.required' => 'Password is required.',
            ]
        );

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);
        return redirect()->route('staff.users.index')->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        $departments = Department::orderBy('name')->get();
        $leaders = Leader::orderBy('name')->get();
        $ministries = Ministry::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('staff.users.edit', compact('user', 'departments', 'leaders', 'ministries', 'positions'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email,' . $user->id,
            'department_id' => 'nullable|exists:departments,id',
            'leader_id' => 'nullable|exists:leaders,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'position_id' => 'required|exists:positions,id',

        ]);

        $user->update($validated);
        return redirect()->route('staff.users.index')->with('success', 'User Updated Successfully');
    }

    public function archive() {}
}

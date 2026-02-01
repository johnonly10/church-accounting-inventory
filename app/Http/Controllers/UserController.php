<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Leader;
use App\Models\Ministry;
use App\Models\Department;
use App\Models\Position;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {

        $users = $this->userService->getPaginateUser($request);
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

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        User::create($request->validated());
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

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $user->update($request->validated());
        return redirect()->route('staff.users.index')->with('success', 'User Updated Successfully');
    }
}

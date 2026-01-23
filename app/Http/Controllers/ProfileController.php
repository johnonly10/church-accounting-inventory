<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Leader;
use App\Models\Ministry;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Load the current user's profile with relationships
        $user = Auth::user()->load(['department', 'leader', 'ministry', 'position']);

        return view('staff.profile.index', compact('user'));
    }

    public function edit($id)
    {
        // Ensure users can only edit their own profile
        if (Auth::user()->id != $id && Auth::user()->roletype != 'PASTOR') {
            abort(403, 'Unauthorized action.');
        }

        $departments = Department::all();
        $leaders = Leader::all();
        $ministries = Ministry::all();
        $positions = Position::all();

        return view('staff.profile.edit', compact('departments', 'leaders', 'ministries', 'positions'));
    }

    public function update(Request $request, $id)
    {
        // Ensure users can only update their own profile
        if (Auth::user()->id != $id && Auth::user()->roletype != 'PASTOR') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'leader_id' => 'nullable|exists:leaders,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'position_id' => 'nullable|exists:positions,id',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists and it's not the default image
            if ($user->path && $user->path != 'default.jpg') {
                $oldImagePath = public_path('storage/Profile/' . $user->path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new image
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $user->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Profile'), $imageName);

            $user->path = $imageName;
        }

        $user->update([
            'department_id' => $request->department_id,
            'leader_id' => $request->leader_id,
            'ministry_id' => $request->ministry_id,
            'position_id' => $request->position_id,
            'path' => $user->path,
        ]);

        return redirect()->route('staff.profile.index')->with('success', 'Profile updated successfully!');
    }
}

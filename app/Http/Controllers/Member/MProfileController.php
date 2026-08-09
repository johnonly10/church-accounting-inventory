<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Leader;
use App\Models\Ministry;
use App\Models\PepsolType;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->load([
            'department',
            'leader',
            'ministry',
            'position',
            'pepsolType'
        ]);

        // Get completed lessons with their relationships
        $completedLessons = $user->completedLessons()
            ->with(['topic', 'pepsol'])
            ->wherePivot('completed', true)
            ->whereNotNull('pepsol_user_lesson_progress.completed_at')
            ->get();

        $completedLessonsCount = $completedLessons->count();

        return view('member.profile.index', compact('user', 'completedLessons', 'completedLessonsCount'));
    }
    public function edit()
    {
        $user = Auth::user()->load([
            'department',
            'leader',
            'ministry',
            'position',
            'pepsolType'
        ]);

        $departments = Department::orderBy('name')->get();
        $leaders = Leader::orderBy('name')->get();
        $ministries = Ministry::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $pepsolTypes = PepsolType::orderBy('name')->get();

        return view('member.profile.edit', compact(
            'user',
            'departments',
            'leaders',
            'ministries',
            'positions',
            'pepsolTypes'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'leader_id' => 'nullable|exists:leaders,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'position_id' => 'nullable|exists:positions,id',
            'pepsol_type_id' => 'nullable|exists:pepsol_types,id',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|in:1',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($user->path) {
                // Delete old image from Member/Profile directory
                $oldPath = str_replace('storage/', '', $user->path);
                Storage::disk('public')->delete($oldPath);
            }
            $validated['path'] = null;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->path) {
                $oldPath = str_replace('storage/', '', $user->path);
                Storage::disk('public')->delete($oldPath);
            }

            // Store new image in Member/Profile directory
            $file = $request->file('profile_image');
            $filename = time() . '_' . $user->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Member/Profile', $filename, 'public');

            $validated['path'] = 'Member/Profile/' . $filename;
        }

        // Remove non-database fields
        unset($validated['profile_image']);
        unset($validated['remove_image']);

        $user->update($validated);

        return redirect()->route('member.profiles.index')->with('success', 'Profile updated successfully!');
    }
}

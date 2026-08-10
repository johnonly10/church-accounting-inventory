<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\PepsolUserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $completedLessons = $user->completedLessons()
            ->with(['pepsol', 'topic'])
            ->get()
            ->sortByDesc(fn($lesson) => $lesson->pivot->completed_at);

        $passedAttempts = PepsolUserQuizAttempt::where('user_id', $user->id)
            ->where('passed', true)
            ->where('status', 'completed')
            ->with('quiz.lesson')
            ->orderByDesc('completed_at')
            ->get();

        return view('guest.pepsol.profile.index', [
            'user' => $user,
            'completedLessons' => $completedLessons,
            'passedAttempts' => $passedAttempts
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($user->path) {
            Storage::disk('public')->delete($user->path);
        }

        $path = $request->file('photo')->store('avatars', 'public');
        $user->update(['path' => $path]);

        return back()->with('status', 'Profile photo updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Password updated successfully.');
    }
}

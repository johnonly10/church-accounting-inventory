<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }

        $images = Image::query()
            ->where('is_active', true)
            ->whereIn('type', ['logo', 'background', 'background_2'])
            ->get()
            ->keyBy('type');

        return view('auth.login', [
            'logoPath' => $images['logo']->path ?? null,
            'bgPath'   => $images['background']->path ?? null,
            'bg2Path'  => $images['background_2']->path ?? null,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Invalid credentials provided.'])
                ->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->roletype === 'STAFF') {
            return redirect()->intended(route('staff.index'));
        }

        if ($user->roletype === 'PASTOR') {
            return redirect()->intended(route('pastor.index'));
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

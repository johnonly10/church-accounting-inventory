<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(24)),
                    'email_verified_at' => now(),
                    'roletype' => 'MEMBER'
                ]);
            }

            Auth::login($user, true);

            if ($user->roletype === 'STAFF') {
                return redirect()->intended(route('staff.index'));
            }

            if ($user->roletype === 'MEMBER') {
                return redirect()->route('maintenance.index');
            }


            return redirect()->intended(route('/'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Unable to login with Google. Please try again.'
            ]);
        }
    }
}

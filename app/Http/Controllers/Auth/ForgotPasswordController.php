<?php

namespace App\Http\Controllers\Auth;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Container\Attributes\Auth;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        $images = Image::query()
            ->where('is_active', true)
            ->whereIn('type', ['logo', 'background', 'background_2'])
            ->get()
            ->keyBy('type');

        return view('auth.forgot-password', [
            'logoPath' => $images['logo']->path ?? null,
            'bgPath'   => $images['background']->path ?? null,
            'bg2Path'  => $images['background_2']->path ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}

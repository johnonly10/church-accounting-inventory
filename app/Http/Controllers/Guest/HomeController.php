<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Image;
use App\Models\PepsolName;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $logo = Image::where('type', 'logo')
            ->where('is_active', true)
            ->first();

        $events = Event::orderBy('start_at')->get();

        $pepsolNames = PepsolName::withCount('lessons')
            ->having('lessons_count', '>', 0)
            ->orderBy('name')
            ->get();

        return view('guest.home', compact('logo', 'events', 'pepsolNames'));
    }
}

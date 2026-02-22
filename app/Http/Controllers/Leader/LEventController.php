<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\StoreEventsRequest;
use App\Http\Requests\Events\UpdateEventsRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LEventController extends Controller
{

    protected EventService $eventService;
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = Event::orderBy('id')->paginate(10);
        return view('leader.events.index', compact('events'));
    }

    public function create()
    {
        return view('leader.events.create');
    }

    public function store(StoreEventsRequest $request)
    {
        $validated = $request->validated();

        $validated['image_path'] = $this->eventService->upload($request->file('image_path'));


        $validated['slug'] = Str::slug($request->name);
        Event::create($validated);

        return redirect()->route('leader.events.index')->with('success', 'Events Successfully Created');
    }

    public function edit(Event $event)
    {
        return view('leader.events.edit', compact('event'));
    }

    public function update(UpdateEventsRequest $request, Event $event)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $this->eventService->replace($request->file('image_path'), $event->image_path);
        } elseif ($request->boolean('remove_image')) {
            $this->eventService->delete($event->image_path);
            $validated['image_path'] = null;
        } else {
            unset($validated['image_path']);
        }

        $validated['slug'] = Str::slug($validated['name']);
        $event->update($validated);

        return redirect()->route('leader.events.index')->with('success', 'Event Successfully Updated');
    }
}

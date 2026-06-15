<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolLessonBlock;
use App\Models\PepsolLessonParts;
use App\Models\PepsolType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LPepsolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pepsol::with([
            'category',
            'type',
            'creator',
            'lessons',
        ]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('lessons', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('pepsol_category_id', $request->category);
        }

        $pepsols = $query->latest()->paginate(12);

        $categories = PepsolCategory::withCount('pepsols')
            ->orderBy('name')
            ->get();

        return view('leader.pepsol.index', compact(
            'pepsols',
            'categories',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PepsolCategory::orderBy('id')->get();
        $types = PepsolType::orderBy('id')->get();
        return view('leader.pepsol.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'nullable|exists:pepsol_categories,id',
            'type' => 'nullable|exists:pepsol_types,id',
            'status' => 'required|in:published,draft',
            'description' => 'nullable|string',
            'guidelines' => 'nullable|string',
            'orientation' => 'nullable|string',
            'lesson_title' => 'required|string|max:255',
            'lesson_subtitle' => 'nullable|string|max:255',
            'lesson_summary' => 'nullable|string',
            'lesson_cover' => 'nullable|image|max:2048',
            'parts' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $pepsol = Pepsol::create([
                'pepsol_category_id' => $request->category,
                'pepsol_type_id' => $request->type,
                'created_by' => auth()->id(),
                'name' => $request->lesson_title,
                'description' => $request->description,
                'rules' => $request->guidelines,
                'orientation' => $request->orientation,
                'status' => $request->status,
            ]);

            $coverPath = null;
            if ($request->hasFile('lesson_cover')) {
                $coverPath = $request->file('lesson_cover')->store('pepsol-lessons', 'public');
            }

            $lesson = PepsolLesson::create([
                'pepsol_id' => $pepsol->id,
                'title' => $request->lesson_title,
                'subtitle' => $request->lesson_subtitle,
                'summary' => $request->lesson_summary,
                'image' => $coverPath,
            ]);

            if ($request->has('parts') && is_array($request->parts)) {
                foreach ($request->parts as $partId => $partData) {
                    if (empty($partData['type'])) {
                        continue;
                    }

                    $part = PepsolLessonParts::create([
                        'pepsol_lesson_id' => $lesson->id,
                        'part_key' => $partData['type'],
                    ]);

                    $blockData = [
                        'pepsol_lesson_part_id' => $part->id,
                        'body' => null,
                        'quote' => null,
                        'source' => null,
                        'scripture' => null,
                        'image' => null,
                        'video' => null,
                        'file' => null,
                        'url' => null,
                    ];

                    if (isset($partData['blocks']) && is_array($partData['blocks'])) {
                        foreach ($partData['blocks'] as $block) {
                            $type = $block['type'] ?? null;

                            if ($type === 'body') {
                                $blockData['body'] = $block['content'] ?? null;
                            }

                            if ($type === 'quote') {
                                $blockData['quote'] = $block['content']['quote'] ?? null;
                                if (isset($block['content']['source'])) {
                                    $blockData['source'] = $block['content']['source'];
                                }
                            }

                            if ($type === 'media') {
                                if (isset($block['content']['image']) && $block['content']['image'] instanceof \Illuminate\Http\UploadedFile) {
                                    $blockData['image'] = $block['content']['image']->store('pepsol-lessons/images', 'public');
                                }
                                if (isset($block['content']['video']) && $block['content']['video'] instanceof \Illuminate\Http\UploadedFile) {
                                    $blockData['video'] = $block['content']['video']->store('pepsol-lessons/videos', 'public');
                                }
                                if (isset($block['content']['file']) && $block['content']['file'] instanceof \Illuminate\Http\UploadedFile) {
                                    $blockData['file'] = $block['content']['file']->store('pepsol-lessons/files', 'public');
                                }
                            }

                            if ($type === 'url') {
                                $blockData['url'] = $block['content']['url'] ?? null;
                            }
                        }
                    }

                    $hasData = false;
                    foreach ($blockData as $key => $value) {
                        if ($key !== 'pepsol_lesson_part_id' && !empty($value)) {
                            $hasData = true;
                            break;
                        }
                    }

                    if ($hasData) {
                        PepsolLessonBlock::create($blockData);
                    }
                }
            }

            DB::commit();

            return redirect()->route('leader.pepsol.index')
                ->with('success', 'Discipleship module created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($coverPath) && $coverPath) {
                Storage::disk('public')->delete($coverPath);
            }

            return back()->withErrors(['error' => 'Failed to create module: ' . $e->getMessage()])->withInput();
        }
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pepsol $pepsol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pepsol $pepsol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pepsol $pepsol)
    {
        //
    }
}

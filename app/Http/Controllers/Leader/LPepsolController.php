<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolLessonBlock;
use App\Models\PepsolLessonParts;
use App\Models\PepsolName;
use App\Models\PepsolTopic;
use App\Models\PepsolType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LPepsolController extends Controller
{
    public function index(Request $request)
    {
        $query = Pepsol::with([
            'category',
            'type',
            'creator',
            'lessons.name',
            'lessons.topic',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('lessons', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%");
            });
        }

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

    public function create()
    {
        $categories = PepsolCategory::orderBy('id')->get();
        $types = PepsolType::orderBy('id')->get();
        $topics = PepsolTopic::orderBy('id')->get();
        $names = PepsolName::orderBy('id')->get();
        return view('leader.pepsol.create', compact('categories', 'types', 'topics', 'names'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category' => 'nullable|exists:pepsol_categories,id',
            'pepsol_name_id' => 'nullable|exists:pepsol_names,id',
            'pepsol_topic_id' => 'nullable|exists:pepsol_topics,id',
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
                $file = $request->file('lesson_cover');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('Images/Pepsol/Lesson');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $file->move($destinationPath, $filename);
                $coverPath = 'Images/Pepsol/Lesson/' . $filename;
            }

            $lesson = PepsolLesson::create([
                'pepsol_id' => $pepsol->id,
                'pepsol_name_id' => $request->pepsol_name_id,
                'pepsol_topic_id' => $request->pepsol_topic_id,
                'title' => $request->lesson_title,
                'subtitle' => $request->lesson_subtitle,
                'summary' => $request->lesson_summary,
                'image' => $coverPath,
            ]);

            if ($request->has('parts') && is_array($request->parts)) {
                foreach ($request->parts as $partData) {
                    if (empty($partData['part_key'])) {
                        continue;
                    }

                    $part = PepsolLessonParts::create([
                        'pepsol_lesson_id' => $lesson->id,
                        'part_key' => $partData['part_key'],
                    ]);

                    if (isset($partData['blocks']) && is_array($partData['blocks'])) {
                        foreach ($partData['blocks'] as $blockData) {
                            $blockType = $blockData['block_type'] ?? null;
                            $content = $blockData['content'] ?? null;
                            $reference = $blockData['reference'] ?? null;
                            $media = null;
                            $sortOrder = $blockData['sort_order'] ?? 0;

                            if ($blockType && $content instanceof \Illuminate\Http\UploadedFile) {
                                $filename = time() . '_' . $content->getClientOriginalName();
                                $destinationPath = public_path('Images/Pepsol/Blocks');

                                if (!file_exists($destinationPath)) {
                                    mkdir($destinationPath, 0777, true);
                                }

                                $content->move($destinationPath, $filename);
                                $media = 'Images/Pepsol/Blocks/' . $filename;
                                $content = null;
                            }

                            PepsolLessonBlock::create([
                                'pepsol_lesson_part_id' => $part->id,
                                'block_type' => $blockType,
                                'content' => $content,
                                'reference' => $reference,
                                'media' => $media,
                                'sort_order' => $sortOrder,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('leader.pepsol.index')
                ->with('success', 'Discipleship module created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($coverPath) && $coverPath) {
                $fullPath = public_path($coverPath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            return back()->withErrors(['error' => 'Failed to create module: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $pepsol = Pepsol::with([
            'category',
            'type',
            'creator',
            'lessons.parts.blocks',
        ])->findOrFail($id);

        $categories = PepsolCategory::orderBy('id')->get();
        $types = PepsolType::orderBy('id')->get();
        $names = PepsolName::orderBy('name')->get();
        $topics = PepsolTopic::orderBy('name')->get();

        return view('leader.pepsol.edit', compact('pepsol', 'categories', 'types', 'names', 'topics'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|exists:pepsol_categories,id',
            'type' => 'nullable|exists:pepsol_types,id',
            'pepsol_name_id' => 'nullable|exists:pepsol_names,id',
            'pepsol_topic_id' => 'nullable|exists:pepsol_topics,id',
            'status' => 'required|in:published,draft',
            'description' => 'nullable|string',
            'guidelines' => 'nullable|string',
            'orientation' => 'nullable|string',
            'lesson_title' => 'required|string|max:255',
            'lesson_subtitle' => 'nullable|string|max:255',
            'lesson_summary' => 'nullable|string',
            'lesson_cover' => 'nullable|image|max:2048',
            'remove_lesson_cover' => 'nullable|boolean',
            'new_parts' => 'nullable|array',
            'existing_parts' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $pepsol = Pepsol::findOrFail($id);

            $pepsol->update([
                'pepsol_category_id' => $request->category,
                'pepsol_type_id' => $request->type,
                'description' => $request->description,
                'rules' => $request->guidelines,
                'orientation' => $request->orientation,
                'status' => $request->status,
            ]);

            $lesson = $pepsol->lessons()->first();
            $coverPath = $lesson ? $lesson->image : null;

            if ($request->has('remove_lesson_cover') && $request->remove_lesson_cover) {
                if ($coverPath) {
                    $fullPath = public_path($coverPath);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                }
                $coverPath = null;
            }

            if ($request->hasFile('lesson_cover')) {
                if ($coverPath) {
                    $fullPath = public_path($coverPath);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                }
                $file = $request->file('lesson_cover');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('Images/Pepsol/Lesson');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $file->move($destinationPath, $filename);
                $coverPath = 'Images/Pepsol/Lesson/' . $filename;
            }

            if ($lesson) {
                $lesson->update([
                    'pepsol_name_id' => $request->pepsol_name_id,
                    'pepsol_topic_id' => $request->pepsol_topic_id,
                    'title' => $request->lesson_title,
                    'subtitle' => $request->lesson_subtitle,
                    'summary' => $request->lesson_summary,
                    'image' => $coverPath,
                ]);
            } else {
                $lesson = PepsolLesson::create([
                    'pepsol_id' => $pepsol->id,
                    'pepsol_name_id' => $request->pepsol_name_id,
                    'pepsol_topic_id' => $request->pepsol_topic_id,
                    'title' => $request->lesson_title,
                    'subtitle' => $request->lesson_subtitle,
                    'summary' => $request->lesson_summary,
                    'image' => $coverPath,
                ]);
            }

            if ($request->has('existing_parts') && is_array($request->existing_parts)) {
                $existingPartIds = array_keys($request->existing_parts);

                PepsolLessonParts::where('pepsol_lesson_id', $lesson->id)
                    ->whereNotIn('id', $existingPartIds)
                    ->delete();

                foreach ($request->existing_parts as $partId => $partData) {
                    $part = PepsolLessonParts::find($partId);

                    if (!$part || empty($partData['part_key'])) {
                        continue;
                    }

                    $part->update([
                        'part_key' => $partData['part_key'],
                    ]);

                    if (isset($partData['blocks']) && is_array($partData['blocks'])) {
                        $existingBlockIds = [];

                        foreach ($partData['blocks'] as $blockId => $blockData) {
                            if (is_numeric($blockId)) {
                                $existingBlockIds[] = $blockId;
                                $block = PepsolLessonBlock::find($blockId);

                                if ($block) {
                                    $block->update([
                                        'block_type' => $blockData['block_type'] ?? $block->block_type,
                                        'content' => $blockData['content'] ?? $block->content,
                                        'reference' => $blockData['reference'] ?? $block->reference,
                                        'sort_order' => $blockData['sort_order'] ?? $block->sort_order,
                                    ]);
                                }
                            }
                        }

                        if (!empty($existingBlockIds)) {
                            PepsolLessonBlock::where('pepsol_lesson_part_id', $part->id)
                                ->whereNotIn('id', $existingBlockIds)
                                ->delete();
                        }
                    }

                    if (isset($partData['new_blocks']) && is_array($partData['new_blocks'])) {
                        foreach ($partData['new_blocks'] as $newBlockData) {
                            PepsolLessonBlock::create([
                                'pepsol_lesson_part_id' => $part->id,
                                'block_type' => $newBlockData['block_type'] ?? 'paragraph',
                                'content' => $newBlockData['content'] ?? null,
                                'reference' => $newBlockData['reference'] ?? null,
                                'media' => null,
                                'sort_order' => $newBlockData['sort_order'] ?? 0,
                            ]);
                        }
                    }
                }
            } else {
                PepsolLessonParts::where('pepsol_lesson_id', $lesson->id)->delete();
            }

            if ($request->has('new_parts') && is_array($request->new_parts)) {
                foreach ($request->new_parts as $partKey => $partData) {
                    if (empty($partData['part_key'])) {
                        continue;
                    }

                    $part = PepsolLessonParts::create([
                        'pepsol_lesson_id' => $lesson->id,
                        'part_key' => $partData['part_key'],
                    ]);

                    if (isset($partData['blocks']) && is_array($partData['blocks'])) {
                        foreach ($partData['blocks'] as $blockData) {
                            PepsolLessonBlock::create([
                                'pepsol_lesson_part_id' => $part->id,
                                'block_type' => $blockData['block_type'] ?? 'paragraph',
                                'content' => $blockData['content'] ?? null,
                                'reference' => $blockData['reference'] ?? null,
                                'media' => null,
                                'sort_order' => $blockData['sort_order'] ?? 0,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('leader.pepsol.index')
                ->with('success', 'Discipleship module updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($coverPath) && $coverPath && $request->hasFile('lesson_cover')) {
                $fullPath = public_path($coverPath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            return back()->withErrors(['error' => 'Failed to update module: ' . $e->getMessage()])->withInput();
        }
    }



    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $pepsol = Pepsol::with(['lessons.parts.blocks'])->findOrFail($id);

            foreach ($pepsol->lessons as $lesson) {
                if ($lesson->image) {
                    Storage::disk('public')->delete($lesson->image);
                }

                foreach ($lesson->parts as $part) {
                    foreach ($part->blocks as $block) {
                        if ($block->image) {
                            Storage::disk('public')->delete($block->image);
                        }
                        if ($block->video) {
                            Storage::disk('public')->delete($block->video);
                        }
                        if ($block->file) {
                            Storage::disk('public')->delete($block->file);
                        }
                    }

                    $part->blocks()->delete();
                }

                $lesson->parts()->delete();
            }

            $pepsol->lessons()->delete();

            $pepsol->delete();

            DB::commit();

            return redirect()->route('leader.pepsol.index')
                ->with('success', 'Discipleship module deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Failed to delete module: ' . $e->getMessage()]);
        }
    }
}

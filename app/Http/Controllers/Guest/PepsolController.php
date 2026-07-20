<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolName;
use App\Models\PepsolTopic;
use App\Models\PepsolType;
use Illuminate\Http\Request;

class PepsolController extends Controller
{
    public function index(Request $request)
    {
        $categories = PepsolCategory::withCount('pepsols')->get();
        $types = PepsolType::all();


        $namesQuery = PepsolName::withCount('lessons')
            ->has('lessons');

        if ($request->filled('category')) {
            $namesQuery->whereHas('lessons.pepsol', function ($q) use ($request) {
                $q->where('pepsol_category_id', $request->category);
            });
        }

        if ($request->filled('types')) {
            $typeIds = $request->types;
            if (is_string($typeIds)) {
                $typeIds = explode(',', $typeIds);
            }
            $namesQuery->whereHas('lessons.pepsol', function ($q) use ($typeIds) {
                $q->whereIn('pepsol_type_id', $typeIds);
            });
        }

        if ($request->filled('search')) {
            $namesQuery->where('name', 'like', '%' . $request->search . '%');
        }

        switch ($request->sort) {
            case 'title_asc':
                $namesQuery->orderBy('name', 'asc');
                break;
            case 'title_desc':
                $namesQuery->orderBy('name', 'desc');
                break;
            default:
                $namesQuery->orderBy('created_at', 'desc');
        }

        $names = $namesQuery->paginate(12)->withQueryString();

        return view('guest.pepsol.index', compact('names', 'categories', 'types'));
    }

    public function lesson(PepsolName $pepsolName)
    {
        $pepsolName->load([
            'lessons' => function ($query) {
                $query->with('topic')
                    ->orderBy('pepsol_topic_id')
                    ->orderBy('id');
            },
        ]);

        $lessonsByTopic = $pepsolName->lessons->groupBy(function ($lesson) {
            return $lesson->topic->name ?? 'Uncategorized';
        });

        return view('guest.pepsol.lesson', [
            'pepsolName'     => $pepsolName,
            'lessonsByTopic' => $lessonsByTopic,
        ]);
    }

    public function details(PepsolName $pepsolName, PepsolLesson $lesson)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);

        $lesson->load(['topic', 'parts.blocks']);

        $partLabels = [
            'header'     => 'Opening',
            'body'       => 'Teaching',
            'end'        => 'Reflection',
            'conclusion' => 'Closing',
        ];

        $partOrder = array_flip(array_keys($partLabels));
        $orderedParts = $lesson->parts->sortBy(function ($part) use ($partOrder) {
            return $partOrder[$part->part_key] ?? 99;
        });

        $pepsolName->load([
            'lessons' => function ($query) {
                $query->with('topic')
                    ->orderBy('pepsol_topic_id')
                    ->orderBy('id');
            },
        ]);

        $lessonsByTopic = $pepsolName->lessons->groupBy(function ($l) {
            return $l->topic->name ?? 'Uncategorized';
        });

        $allLessons = $pepsolName->lessons->values();
        $currentIndex = $allLessons->search(function ($l) use ($lesson) {
            return $l->id === $lesson->id;
        });

        $previousLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex !== false && $currentIndex < $allLessons->count() - 1
            ? $allLessons[$currentIndex + 1]
            : null;

        return view('guest.pepsol.details', [
            'pepsolName'      => $pepsolName,
            'lesson'          => $lesson,
            'orderedParts'    => $orderedParts,
            'partLabels'      => $partLabels,
            'lessonsByTopic'  => $lessonsByTopic,
            'allLessons'      => $allLessons,
            'currentIndex'    => $currentIndex,
            'previousLesson'  => $previousLesson,
            'nextLesson'      => $nextLesson,
        ]);
    }
}

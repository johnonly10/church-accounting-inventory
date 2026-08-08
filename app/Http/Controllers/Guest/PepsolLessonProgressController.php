<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\PepsolLesson;
use App\Models\PepsolUserLessonProgress;
use Illuminate\Http\Request;

class PepsolLessonProgressController extends Controller
{
    public function complete(Request $request, $pepsolName, $lesson)
    {
        $user = auth()->user();

        $lessonModel = PepsolLesson::find($lesson);

        if (!$lessonModel) {
            return back()->with('error', 'Lesson not found.');
        }

        $progress = PepsolUserLessonProgress::firstOrNew([
            'user_id' => $user->id,
            'pepsol_lesson_id' => $lessonModel->id,
        ]);

        if (!$progress->completed) {
            $progress->completed = true;
            $progress->completed_at = now();
            $progress->save();

            return back()->with('success', 'Lesson marked as completed!');
        }

        return back()->with('info', 'Lesson already completed.');
    }

    public function uncomplete(Request $request, $pepsolName, $lesson)
    {
        $user = auth()->user();

        $lessonModel = PepsolLesson::find($lesson);

        if (!$lessonModel) {
            return back()->with('error', 'Lesson not found.');
        }

        $progress = PepsolUserLessonProgress::where([
            'user_id' => $user->id,
            'pepsol_lesson_id' => $lessonModel->id,
        ])->first();

        if ($progress) {
            $progress->delete();
            return back()->with('success', 'Lesson unmarked as completed.');
        }

        return back()->with('info', 'Lesson was not completed.');
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pepsol;
use App\Models\PepsolCategory;
use App\Models\PepsolLesson;
use App\Models\PepsolName;
use App\Models\PepsolQuestion;
use App\Models\PepsolQuestionOption;
use App\Models\PepsolQuiz;
use App\Models\PepsolTopic;
use App\Models\PepsolType;
use App\Models\PepsolUserAnswer;
use App\Models\PepsolUserLessonProgress;
use App\Models\PepsolUserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $completedLessonIds = [];
        if (auth()->check()) {
            $completedLessonIds = PepsolUserLessonProgress::where('user_id', auth()->id())
                ->where('completed', true)
                ->pluck('pepsol_lesson_id')
                ->toArray();
        }

        return view('guest.pepsol.lesson', [
            'pepsolName' => $pepsolName,
            'lessonsByTopic' => $lessonsByTopic,
            'completedLessonIds' => $completedLessonIds,
        ]);
    }

    public function details(PepsolName $pepsolName, PepsolLesson $lesson)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);

        $lesson->load(['topic', 'parts.blocks', 'quizzes' => function ($query) {
            $query->where('status', 'published')->withCount('questions');
        }]);

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
                $query->with(['topic', 'quizzes' => function ($q) {
                    $q->where('status', 'published');
                }])
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

    // public function showQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz)
    // {
    //     abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
    //     abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
    //     abort_if($quiz->status !== 'published', 404);

    //     $quiz->loadCount('questions');

    //     $userAttempts = null;
    //     if (Auth::check()) {
    //         $userAttempts = PepsolUserQuizAttempt::where('user_id', Auth::id())
    //             ->where('pepsol_quiz_id', $quiz->id)
    //             ->orderBy('created_at', 'desc')
    //             ->get();
    //     }

    //     $pepsolName->load([
    //         'lessons' => function ($query) {
    //             $query->with(['topic', 'quizzes' => function ($q) {
    //                 $q->where('status', 'published');
    //             }])
    //                 ->orderBy('pepsol_topic_id')
    //                 ->orderBy('id');
    //         },
    //     ]);

    //     $lessonsByTopic = $pepsolName->lessons->groupBy(function ($l) {
    //         return $l->topic->name ?? 'Uncategorized';
    //     });

    //     $allLessons = $pepsolName->lessons->values();

    //     return view('guest.pepsol.quiz-intro', compact(
    //         'pepsolName',
    //         'lesson',
    //         'quiz',
    //         'userAttempts',
    //         'lessonsByTopic',
    //         'allLessons'
    //     ));
    // }

    // public function startQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz)
    // {
    //     abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
    //     abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
    //     abort_if($quiz->status !== 'published', 404);

    //     if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }

    //     $attemptCount = PepsolUserQuizAttempt::where('user_id', Auth::id())
    //         ->where('pepsol_quiz_id', $quiz->id)
    //         ->count();

    //     if (!$quiz->allow_retake && $attemptCount > 0) {
    //         return redirect()->route('pepsol.quiz.show', [
    //             'pepsolName' => $pepsolName,
    //             'lesson' => $lesson,
    //             'quiz' => $quiz
    //         ])->with('error', 'You have already taken this quiz.');
    //     }

    //     if ($quiz->max_attempts && $attemptCount >= $quiz->max_attempts) {
    //         return redirect()->route('pepsol.quiz.show', [
    //             'pepsolName' => $pepsolName,
    //             'lesson' => $lesson,
    //             'quiz' => $quiz
    //         ])->with('error', 'You have reached the maximum number of attempts.');
    //     }

    //     $attempt = PepsolUserQuizAttempt::create([
    //         'user_id' => Auth::id(),
    //         'pepsol_quiz_id' => $quiz->id,
    //         'attempt_number' => $attemptCount + 1,
    //         'started_at' => now(),
    //         'status' => 'in_progress',
    //     ]);

    //     return redirect()->route('pepsol.quiz.take', [
    //         'pepsolName' => $pepsolName,
    //         'lesson' => $lesson,
    //         'quiz' => $quiz,
    //         'attempt' => $attempt->id
    //     ]);
    // }

    // public function takeQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    // {
    //     abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
    //     abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
    //     abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
    //     abort_unless($attempt->user_id === Auth::id(), 403);
    //     abort_if($attempt->status !== 'in_progress', 404);

    //     $quiz->load(['questions' => function ($query) {
    //         $query->orderBy('sort_order')->with(['options' => function ($q) {
    //             $q->orderBy('sort_order');
    //         }]);
    //     }]);

    //     return view('guest.pepsol.quiz-take', compact(
    //         'pepsolName',
    //         'lesson',
    //         'quiz',
    //         'attempt'
    //     ));
    // }

    // public function submitQuiz(Request $request, PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    // {
    //     abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
    //     abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
    //     abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
    //     abort_unless($attempt->user_id === Auth::id(), 403);
    //     abort_if($attempt->status !== 'in_progress', 404);

    //     $request->validate([
    //         'answers' => 'required|array',
    //         'answers.*' => 'required|exists:pepsol_question_options,id',
    //     ]);

    //     $totalPoints = 0;
    //     $earnedPoints = 0;

    //     foreach ($request->answers as $questionId => $optionId) {
    //         $question = PepsolQuestion::findOrFail($questionId);
    //         $option = PepsolQuestionOption::findOrFail($optionId);

    //         $isCorrect = $option->is_correct;

    //         PepsolUserAnswer::create([
    //             'pepsol_user_quiz_attempt_id' => $attempt->id,
    //             'pepsol_question_id' => $questionId,
    //             'selected_option_id' => $optionId,
    //             'is_correct' => $isCorrect,
    //         ]);

    //         $totalPoints += $question->points;
    //         if ($isCorrect) {
    //             $earnedPoints += $question->points;
    //         }
    //     }

    //     $percentage = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;
    //     $passed = $percentage >= $quiz->passing_score;

    //     $attempt->update([
    //         'score' => $earnedPoints,
    //         'total_points' => $totalPoints,
    //         'percentage' => $percentage,
    //         'passed' => $passed,
    //         'completed_at' => now(),
    //         'status' => 'completed',
    //     ]);

    //     return redirect()->route('pepsol.quiz.result', [
    //         'pepsolName' => $pepsolName,
    //         'lesson' => $lesson,
    //         'quiz' => $quiz,
    //         'attempt' => $attempt->id
    //     ]);
    // }

    // public function quizResult(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    // {
    //     abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
    //     abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
    //     abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
    //     abort_unless($attempt->user_id === Auth::id(), 403);
    //     abort_if($attempt->status !== 'completed', 404);

    //     $attempt->load(['answers.question', 'answers.selectedOption']);

    //     return view('guest.pepsol.quiz-result', compact(
    //         'pepsolName',
    //         'lesson',
    //         'quiz',
    //         'attempt'
    //     ));
    // }
}

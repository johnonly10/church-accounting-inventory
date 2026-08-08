<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PepsolLesson;
use App\Models\PepsolName;
use App\Models\PepsolQuestion;
use App\Models\PepsolQuestionOption;
use App\Models\PepsolQuiz;
use App\Models\PepsolUserAnswer;
use App\Models\PepsolUserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PepsolQuizController extends Controller
{
    public function showQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
        abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
        abort_if($quiz->status !== 'published', 404);

        $quiz->loadCount('questions');

        $userAttempts = null;
        if (Auth::check()) {
            $userAttempts = PepsolUserQuizAttempt::where('user_id', Auth::id())
                ->where('pepsol_quiz_id', $quiz->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

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

        return view('guest.pepsol.quiz-intro', compact(
            'pepsolName',
            'lesson',
            'quiz',
            'userAttempts',
            'lessonsByTopic',
            'allLessons'
        ));
    }

    public function startQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
        abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
        abort_if($quiz->status !== 'published', 404);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $attemptCount = PepsolUserQuizAttempt::where('user_id', Auth::id())
            ->where('pepsol_quiz_id', $quiz->id)
            ->count();

        if (!$quiz->allow_retake && $attemptCount > 0) {
            return redirect()->route('pepsol.quiz.show', [
                'pepsolName' => $pepsolName,
                'lesson' => $lesson,
                'quiz' => $quiz
            ])->with('error', 'You have already taken this quiz.');
        }

        if ($quiz->max_attempts && $attemptCount >= $quiz->max_attempts) {
            return redirect()->route('pepsol.quiz.show', [
                'pepsolName' => $pepsolName,
                'lesson' => $lesson,
                'quiz' => $quiz
            ])->with('error', 'You have reached the maximum number of attempts.');
        }

        $attempt = PepsolUserQuizAttempt::create([
            'user_id' => Auth::id(),
            'pepsol_quiz_id' => $quiz->id,
            'attempt_number' => $attemptCount + 1,
            'started_at' => now(),
            'status' => 'in_progress',
        ]);

        return redirect()->route('pepsol.quiz.take', [
            'pepsolName' => $pepsolName,
            'lesson' => $lesson,
            'quiz' => $quiz,
            'attempt' => $attempt->id
        ]);
    }

    public function takeQuiz(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
        abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
        abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
        abort_unless($attempt->user_id === Auth::id(), 403);
        abort_if($attempt->status !== 'in_progress', 404);

        $quiz->load(['questions' => function ($query) {
            $query->orderBy('sort_order')->with(['options' => function ($q) {
                $q->orderBy('sort_order');
            }]);
        }]);

        return view('guest.pepsol.quiz-take', compact(
            'pepsolName',
            'lesson',
            'quiz',
            'attempt'
        ));
    }

    public function submitQuiz(Request $request, PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
        abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
        abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
        abort_unless($attempt->user_id === Auth::id(), 403);
        abort_if($attempt->status !== 'in_progress', 404);

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:pepsol_question_options,id',
        ]);

        $totalPoints = 0;
        $earnedPoints = 0;

        foreach ($request->answers as $questionId => $optionId) {
            $question = PepsolQuestion::findOrFail($questionId);
            $option = PepsolQuestionOption::findOrFail($optionId);

            $isCorrect = $option->is_correct;

            PepsolUserAnswer::create([
                'pepsol_user_quiz_attempt_id' => $attempt->id,
                'pepsol_question_id' => $questionId,
                'selected_option_id' => $optionId,
                'is_correct' => $isCorrect,
            ]);

            $totalPoints += $question->points;
            if ($isCorrect) {
                $earnedPoints += $question->points;
            }
        }

        $percentage = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;
        $passed = $percentage >= $quiz->passing_score;

        $attempt->update([
            'score' => $earnedPoints,
            'total_points' => $totalPoints,
            'percentage' => $percentage,
            'passed' => $passed,
            'completed_at' => now(),
            'status' => 'completed',
        ]);

        return redirect()->route('pepsol.quiz.result', [
            'pepsolName' => $pepsolName,
            'lesson' => $lesson,
            'quiz' => $quiz,
            'attempt' => $attempt->id
        ]);
    }

    public function quizResult(PepsolName $pepsolName, PepsolLesson $lesson, PepsolQuiz $quiz, PepsolUserQuizAttempt $attempt)
    {
        abort_unless($lesson->pepsol_name_id === $pepsolName->id, 404);
        abort_unless($quiz->pepsol_lesson_id === $lesson->id, 404);
        abort_unless($attempt->pepsol_quiz_id === $quiz->id, 404);
        abort_unless($attempt->user_id === Auth::id(), 403);
        abort_if($attempt->status !== 'completed', 404);

        $attempt->load(['answers.question', 'answers.selectedOption']);

        return view('guest.pepsol.quiz-result', compact(
            'pepsolName',
            'lesson',
            'quiz',
            'attempt'
        ));
    }
}

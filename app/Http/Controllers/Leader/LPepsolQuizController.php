<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\PepsolLesson;
use App\Models\PepsolQuiz;
use App\Models\PepsolQuestion;
use App\Models\PepsolQuestionOption;
use Illuminate\Http\Request;

class LPepsolQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $quizzes = PepsolQuiz::with(['lesson.pepsol', 'questions'])
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('lesson', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->lesson, function ($query, $lesson) {
                $query->where('pepsol_lesson_id', $lesson);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $lessons = PepsolLesson::with('pepsol')->get();

        return view('leader.pepsol.quiz.index', compact('quizzes', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = PepsolLesson::with('pepsol')->get();
        return view('leader.pepsol.quiz.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pepsol_lesson_id' => 'required|exists:pepsol_lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            // 'time_limit' => 'nullable|integer|min:1',
            'allow_retake' => 'boolean',
            'max_attempts' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.explanation' => 'nullable|string',
            'questions.*.reference' => 'nullable|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.sort_order' => 'required|integer',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
            'questions.*.options.*.sort_order' => 'required|integer',
        ]);

        $quiz = PepsolQuiz::create([
            'pepsol_lesson_id' => $validated['pepsol_lesson_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'passing_score' => $validated['passing_score'],
            // 'time_limit' => $validated['time_limit'],
            'allow_retake' => $request->boolean('allow_retake'),
            'max_attempts' => $validated['max_attempts'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['questions'] as $questionData) {
            $question = $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'] ?? null,
                'reference' => $questionData['reference'] ?? null,
                'points' => $questionData['points'],
                'sort_order' => $questionData['sort_order'],
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'sort_order' => $optionData['sort_order'],
                ]);
            }
        }

        return redirect()->route('leader.pepsol-quiz.index')
            ->with('success', 'Quiz created successfully.');
    }

    public function edit(PepsolQuiz $pepsol_quiz)
    {
        $pepsol_quiz->load(['questions.options', 'lesson.pepsol']);
        $lessons = PepsolLesson::with('pepsol')->get();
        return view('leader.pepsol.quiz.edit', compact('pepsol_quiz', 'lessons'));
    }

    public function update(Request $request, PepsolQuiz $pepsol_quiz)
    {
        $validated = $request->validate([
            'pepsol_lesson_id' => 'required|exists:pepsol_lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            'allow_retake' => 'boolean',
            'max_attempts' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'questions' => 'required|array|min:1',
            'questions.*.id' => 'nullable|exists:pepsol_questions,id',
            'questions.*.question_text' => 'required|string',
            'questions.*.explanation' => 'nullable|string',
            'questions.*.reference' => 'nullable|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.sort_order' => 'required|integer',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*.id' => 'nullable|exists:pepsol_question_options,id',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
            'questions.*.options.*.sort_order' => 'required|integer',
        ]);

        $pepsol_quiz->update([
            'pepsol_lesson_id' => $validated['pepsol_lesson_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'passing_score' => $validated['passing_score'],
            'allow_retake' => $request->boolean('allow_retake'),
            'max_attempts' => $validated['max_attempts'],
            'status' => $validated['status'],
        ]);

        $existingQuestionIds = $pepsol_quiz->questions()->pluck('id')->toArray();
        $updatedQuestionIds = [];

        foreach ($validated['questions'] as $questionData) {
            if (isset($questionData['id'])) {
                $question = PepsolQuestion::find($questionData['id']);
                $question->update([
                    'question_text' => $questionData['question_text'],
                    'explanation' => $questionData['explanation'] ?? null,
                    'reference' => $questionData['reference'] ?? null,
                    'points' => $questionData['points'],
                    'sort_order' => $questionData['sort_order'],
                ]);
                $updatedQuestionIds[] = $question->id;
            } else {
                $question = $pepsol_quiz->questions()->create([
                    'question_text' => $questionData['question_text'],
                    'explanation' => $questionData['explanation'] ?? null,
                    'reference' => $questionData['reference'] ?? null,
                    'points' => $questionData['points'],
                    'sort_order' => $questionData['sort_order'],
                ]);
                $updatedQuestionIds[] = $question->id;
            }

            $existingOptionIds = $question->options()->pluck('id')->toArray();
            $updatedOptionIds = [];

            foreach ($questionData['options'] as $optionData) {
                if (isset($optionData['id'])) {
                    $option = PepsolQuestionOption::find($optionData['id']);
                    $option->update([
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $optionData['is_correct'],
                        'sort_order' => $optionData['sort_order'],
                    ]);
                    $updatedOptionIds[] = $option->id;
                } else {
                    $option = $question->options()->create([
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $optionData['is_correct'],
                        'sort_order' => $optionData['sort_order'],
                    ]);
                    $updatedOptionIds[] = $option->id;
                }
            }

            $optionsToDelete = array_diff($existingOptionIds, $updatedOptionIds);
            if (!empty($optionsToDelete)) {
                PepsolQuestionOption::whereIn('id', $optionsToDelete)->delete();
            }
        }

        $questionsToDelete = array_diff($existingQuestionIds, $updatedQuestionIds);
        if (!empty($questionsToDelete)) {
            PepsolQuestion::whereIn('id', $questionsToDelete)->delete();
        }

        return redirect()->route('leader.pepsol-quiz.index')
            ->with('success', 'Quiz updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PepsolQuiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('leader.pepsol-quiz.index')
            ->with('success', 'Quiz deleted successfully.');
    }

    /**
     * Get quiz status options for filters
     */
    public static function getStatusOptions()
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
        ];
    }
}

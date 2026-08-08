@extends('layouts.guest')

@php
    if (!function_exists('ordinal')) {
        function ordinal($number)
        {
            $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
            if ($number % 100 >= 11 && $number % 100 <= 13) {
                return $number . 'th';
            } else {
                return $number . $ends[$number % 10];
            }
        }
    }
@endphp

@section('content')
    <header>
        <x-hero-section title="{{ $quiz->title }}" :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Pepsol Lessons', 'url' => route('pepsol.lessons', $pepsolName)],
            [
                'label' => $lesson->title,
                'url' => route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]),
            ],
            ['label' => $quiz->title],
        ]" />
    </header>

    <a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>

    <main id="main-content" class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
        <nav class="mb-4 d-flex flex-wrap gap-2 align-items-center justify-content-between" aria-label="Quiz navigation">
            <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}" class="btn back-btn"
                aria-label="Return to lesson: {{ $lesson->title }}">
                <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Back to Lesson
            </a>
        </nav>

        <div class="row g-4">
            <aside class="col-lg-3">
                <x-white-card class="lesson-nav-card">
                    <h2 class="lesson-nav-title mb-3">All Lessons</h2>

                    @foreach ($lessonsByTopic as $topicName => $topicLessons)
                        <p class="lesson-nav-topic mb-2">{{ $topicName }}</p>
                        <ul class="list-unstyled lesson-nav-list mb-3" aria-label="Lessons in {{ $topicName }}">
                            @foreach ($topicLessons as $navLesson)
                                @php
                                    $number = $allLessons->search(fn($l) => $l->id === $navLesson->id) + 1;
                                    $isLessonActive = $navLesson->id === $lesson->id && !isset($activeQuiz);
                                @endphp
                                <li>
                                    <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $navLesson]) }}"
                                        class="lesson-nav-link {{ $isLessonActive ? 'active' : '' }}"
                                        @if ($isLessonActive) aria-current="page" @endif
                                        aria-label="Lesson {{ $number }}: {{ $navLesson->title }}">
                                        <span class="lesson-nav-number">{{ $number }}</span>
                                        <span class="lesson-nav-label">{{ $navLesson->title }}</span>
                                    </a>

                                    @if ($navLesson->quizzes->where('status', 'published')->count() > 0)
                                        <div class="quiz-nav-items" role="group"
                                            aria-label="Quizzes for {{ $navLesson->title }}">
                                            @foreach ($navLesson->quizzes->where('status', 'published') as $navQuiz)
                                                @php
                                                    $isQuizActive = $navQuiz->id === $quiz->id;
                                                @endphp
                                                <a href="{{ route('pepsol.quiz.show', ['pepsolName' => $pepsolName, 'lesson' => $navLesson, 'quiz' => $navQuiz]) }}"
                                                    class="lesson-nav-link quiz-nav-link {{ $isQuizActive ? 'active' : '' }}"
                                                    @if ($isQuizActive) aria-current="page" @endif
                                                    aria-label="Quiz: {{ $navQuiz->title }}">
                                                    <span class="lesson-nav-number quiz-number">
                                                        <i class="fas fa-question-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="lesson-nav-label">{{ $navQuiz->title }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </x-white-card>
            </aside>

            <section class="col-lg-9" aria-label="Quiz information">
                <x-white-card class="quiz-intro-card">
                    <div id="quiz-loading" style="display: none;" role="status" aria-label="Loading quiz content">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary mb-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="text-muted">Preparing your quiz...</p>
                        </div>
                    </div>

                    <div id="quiz-content">
                        <div class="text-center mb-4">
                            <div class="quiz-icon-wrap mb-3" role="img" aria-label="Quiz icon">
                                <i class="fas fa-clipboard-check quiz-icon" aria-hidden="true"></i>
                            </div>
                            <h1 class="quiz-intro-title">{{ $quiz->title }}</h1>

                            @if ($quiz->description)
                                <p class="quiz-intro-description">{{ $quiz->description }}</p>
                            @endif
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-3 col-6">
                                <div class="quiz-stat-card" data-bs-toggle="tooltip" title="Total number of questions"
                                    tabindex="0" aria-label="Questions: {{ $quiz->questions_count }}">
                                    <div class="quiz-stat-icon">
                                        <i class="fas fa-question" aria-hidden="true"></i>
                                    </div>
                                    <div class="quiz-stat-info">
                                        <span class="quiz-stat-value" data-count="{{ $quiz->questions_count }}">0</span>
                                        <span class="quiz-stat-label">Questions</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="quiz-stat-card" data-bs-toggle="tooltip" title="Score needed to pass"
                                    tabindex="0" aria-label="Passing score: {{ $quiz->passing_score }} percent">
                                    <div class="quiz-stat-icon">
                                        <i class="fas fa-trophy" aria-hidden="true"></i>
                                    </div>
                                    <div class="quiz-stat-info">
                                        <span class="quiz-stat-value" data-count="{{ $quiz->passing_score }}">0</span>
                                        <span class="quiz-stat-label">Passing Score</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="quiz-stat-card" data-bs-toggle="tooltip"
                                    title="{{ $quiz->max_attempts ? 'Maximum attempts allowed' : 'Unlimited attempts' }}"
                                    tabindex="0"
                                    aria-label="{{ $quiz->max_attempts ? 'Maximum attempts: ' . $quiz->max_attempts : 'Unlimited attempts' }}">
                                    <div class="quiz-stat-icon">
                                        <i class="fas fa-redo" aria-hidden="true"></i>
                                    </div>
                                    <div class="quiz-stat-info">
                                        <span class="quiz-stat-value" data-count="{{ $quiz->max_attempts ?? 'unlimited' }}"
                                            aria-label="{{ $quiz->max_attempts ? $quiz->max_attempts . ' attempts' : 'Unlimited attempts' }}">
                                            {{ $quiz->max_attempts ?? '∞' }}
                                        </span>
                                        <span class="quiz-stat-label">Max Attempts</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="quiz-stat-card" data-bs-toggle="tooltip"
                                    title="{{ $quiz->time_limit ? 'Time limit in minutes' : 'No time limit' }}"
                                    tabindex="0"
                                    aria-label="{{ $quiz->time_limit ? 'Time limit: ' . $quiz->time_limit . ' minutes' : 'No time limit' }}">
                                    <div class="quiz-stat-icon">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                    </div>
                                    <div class="quiz-stat-info">
                                        <span class="quiz-stat-value">{{ $quiz->time_limit ?? '∞' }}</span>
                                        <span
                                            class="quiz-stat-label">{{ $quiz->time_limit ? 'Minutes' : 'No Limit' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @auth
                            @if ($userAttempts && $userAttempts->count() > 0)
                                @php
                                    $bestScore = $userAttempts->max('percentage');
                                    $lastAttempt = $userAttempts->last();
                                    $attemptCount = $userAttempts->count();
                                @endphp
                                <div class="progress-section mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">
                                            <i class="fas fa-chart-line me-1" aria-hidden="true"></i>
                                            Your Best Score
                                        </span>
                                        <div>
                                            <span
                                                class="fw-bold {{ $bestScore >= $quiz->passing_score ? 'text-success' : 'text-danger' }}">
                                                {{ number_format($bestScore, 1) }}%
                                            </span>
                                            <span class="badge bg-primary ms-2" data-bs-toggle="tooltip"
                                                title="Your attempt count">
                                                <i class="fas fa-history me-1" aria-hidden="true"></i>
                                                {{ $attemptCount }}/{{ $quiz->max_attempts ?? '∞' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress" style="height: 8px;" role="progressbar"
                                        aria-label="Best score progress" aria-valuenow="{{ $bestScore }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar {{ $bestScore >= $quiz->passing_score ? 'bg-success' : 'bg-warning' }}"
                                            style="width: 0%" data-width="{{ $bestScore }}%">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        @if ($quiz->instructions)
                            <div class="quiz-instructions mb-4">
                                <h3 class="quiz-section-title">
                                    <i class="fas fa-book-open me-2" aria-hidden="true"></i>
                                    Instructions
                                </h3>
                                <div class="quiz-instructions-content">
                                    {!! nl2br(e($quiz->instructions)) !!}
                                </div>
                            </div>
                        @endif

                        @auth
                            @if ($userAttempts && $userAttempts->count() > 0)
                                <div class="quiz-previous-attempts mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="quiz-section-title mb-0">
                                            <i class="fas fa-history me-2" aria-hidden="true"></i>
                                            Your Previous Attempts
                                        </h3>
                                    </div>

                                    <div class="attempt-history">
                                        @foreach ($userAttempts as $prevAttempt)
                                            <div class="attempt-card mb-3 p-3 rounded-3 border" role="article"
                                                aria-label="Attempt {{ $prevAttempt->attempt_number }}: {{ $prevAttempt->passed ? 'Passed' : 'Failed' }} with {{ number_format($prevAttempt->percentage, 1) }}%">
                                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                    <div>
                                                        <span class="fw-bold">Attempt
                                                            #{{ $prevAttempt->attempt_number }}</span>
                                                        <span class="text-muted ms-2" data-bs-toggle="tooltip"
                                                            title="{{ $prevAttempt->completed_at ? $prevAttempt->completed_at->format('M d, Y H:i') : 'In Progress' }}">
                                                            <i class="far fa-clock me-1" aria-hidden="true"></i>
                                                            {{ $prevAttempt->completed_at ? $prevAttempt->completed_at->diffForHumans() : 'In Progress' }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="text-center">
                                                            <div class="fw-bold {{ $prevAttempt->passed ? 'text-success' : 'text-danger' }}"
                                                                style="font-size: 1.1rem;">
                                                                {{ number_format($prevAttempt->percentage, 1) }}%
                                                            </div>
                                                            <small class="text-muted">
                                                                {{ $prevAttempt->score }}/{{ $prevAttempt->total_points }}
                                                            </small>
                                                        </div>
                                                        <span
                                                            class="badge badge-lg bg-{{ $prevAttempt->passed ? 'success' : 'danger' }}">
                                                            @if ($prevAttempt->passed)
                                                                <i class="fas fa-check-circle me-1" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fas fa-times-circle me-1" aria-hidden="true"></i>
                                                            @endif
                                                            {{ $prevAttempt->passed ? 'Passed' : 'Failed' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @php
                                $canTake = true;
                                $attemptCount = $userAttempts ? $userAttempts->count() : 0;

                                if (!$quiz->allow_retake && $attemptCount > 0) {
                                    $canTake = false;
                                }
                                if ($quiz->max_attempts && $attemptCount >= $quiz->max_attempts) {
                                    $canTake = false;
                                }
                            @endphp

                            <div class="text-center">
                                @if ($canTake)
                                    <button type="button" class="btn btn-primary btn-lg px-5 start-quiz-btn"
                                        data-bs-toggle="modal" data-bs-target="#startQuizModal"
                                        aria-label="{{ $attemptCount > 0 ? 'Retake quiz: ' . $quiz->title : 'Start quiz: ' . $quiz->title }}">
                                        <i class="fas fa-play me-2" aria-hidden="true"></i>
                                        {{ $attemptCount > 0 ? 'Retake Quiz' : 'Start Quiz' }}
                                    </button>
                                @else
                                    <div class="alert alert-info d-inline-flex align-items-center" role="alert">
                                        <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                                        <div>
                                            <strong>Maximum attempts reached</strong>
                                            <p class="mb-0 mt-1">You have used all {{ $quiz->max_attempts }} available
                                                attempts for this quiz.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5"
                                    aria-label="Login to take the quiz: {{ $quiz->title }}">
                                    <i class="fas fa-sign-in-alt me-2" aria-hidden="true"></i>Login to Take Quiz
                                </a>
                            </div>
                        @endauth
                    </div>
                </x-white-card>
            </section>
        </div>
    </main>

    @auth
        @if ($canTake)
            <div class="modal fade" id="startQuizModal" tabindex="-1" aria-labelledby="startQuizModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="startQuizModalLabel">Ready to Begin?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="quiz-icon-wrap mb-3 mx-auto" style="width: 60px; height: 60px;" role="img"
                                aria-label="Quiz icon">
                                <i class="fas fa-clipboard-check quiz-icon" style="font-size: 1.75rem;"
                                    aria-hidden="true"></i>
                            </div>
                            <p class="mb-4">Please review the quiz details before starting:</p>

                            <ul class="list-unstyled text-start d-inline-block">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2" aria-hidden="true"></i>
                                    <strong>{{ $quiz->questions_count }}</strong> questions to answer
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2" aria-hidden="true"></i>
                                    Passing score: <strong>{{ $quiz->passing_score }}%</strong>
                                </li>
                                @if ($quiz->time_limit)
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2" aria-hidden="true"></i>
                                        Time limit: <strong>{{ $quiz->time_limit }} minutes</strong>
                                    </li>
                                @endif
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2" aria-hidden="true"></i>
                                    Attempt: <strong>{{ $attemptCount + 1 }}</strong> of
                                    <strong>{{ $quiz->max_attempts ?? '∞' }}</strong>
                                </li>
                            </ul>

                            @if ($quiz->time_limit)
                                <div class="alert alert-warning mt-4" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                    <strong>Important:</strong> Once started, the timer cannot be paused. Ensure you have a
                                    stable internet connection and enough time to complete the quiz.
                                </div>
                            @endif

                            @if ($attemptCount > 0)
                                <div class="alert alert-info mt-3" role="alert">
                                    <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                                    This will be your <strong>{{ ordinal($attemptCount + 1) }} attempt</strong>. Only your best
                                    score will be recorded.
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2" aria-hidden="true"></i>Cancel
                            </button>
                            <form
                                action="{{ route('pepsol.quiz.start', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]) }}"
                                method="POST" id="startQuizForm">
                                @csrf
                                <button type="submit" class="btn btn-primary px-4" id="confirmStartQuiz">
                                    <i class="fas fa-play me-2" aria-hidden="true"></i>
                                    Start Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <div class="keyboard-shortcuts visually-hidden" aria-live="polite">
        Press Enter to start the quiz
    </div>
@endsection

@push('styles')
    <style>
        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #4f46e5;
            color: white;
            padding: 8px;
            z-index: 100;
        }

        .skip-link:focus {
            top: 0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            background: #fff;
            color: #4f46e5;
            border: 1px solid #e5e7eb;
            font-weight: 600;
            font-size: 1rem;
            border-radius: .75rem;
            padding: .6rem 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
            transition: background .2s ease, transform .15s ease;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #eef0fe;
            transform: translateX(-2px);
            color: #4f46e5;
            text-decoration: none;
        }

        .back-btn:focus-visible {
            outline: 2px solid #4f46e5;
            outline-offset: 2px;
        }

        .quiz-intro-card {
            border-radius: 1.5rem !important;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
            padding: 2.5rem !important;
        }

        .quiz-icon-wrap {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .quiz-icon {
            font-size: 2.5rem;
            color: #fff;
        }

        .quiz-intro-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .quiz-intro-description {
            font-size: 1.125rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .quiz-stat-card {
            background: #f9fafb;
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            height: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: default;
        }

        .quiz-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .quiz-stat-card:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }

        .quiz-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #eef0fe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6366f1;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .quiz-stat-info {
            display: flex;
            flex-direction: column;
        }

        .quiz-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            line-height: 1;
        }

        .quiz-stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .progress-section {
            background: #f9fafb;
            border-radius: 1rem;
            padding: 1.25rem;
        }

        .progress {
            background-color: #e5e7eb;
            border-radius: 1rem;
        }

        .progress-bar {
            transition: width 1.5s ease-in-out;
            border-radius: 1rem;
        }

        .quiz-section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eef0fe;
        }

        .quiz-instructions-content {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1.25rem;
            color: #374151;
            line-height: 1.8;
        }

        .attempt-card {
            background: #fff;
            transition: all 0.2s ease;
        }

        .attempt-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transform: translateX(4px);
        }

        .badge-lg {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
        }

        .start-quiz-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .start-quiz-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .start-quiz-btn:active {
            transform: translateY(0);
        }

        .start-quiz-btn:focus-visible {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .loading-pulse {
            animation: pulse 1.5s ease-in-out infinite;
        }

        .lesson-nav-card {
            border-radius: 1.5rem !important;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
            padding: 2rem !important;
            position: sticky;
            top: 1rem;
        }

        .lesson-nav-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
        }

        .lesson-nav-topic {
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #4f46e5;
            line-height: 1.4;
        }

        .lesson-nav-list {
            margin-bottom: 1.5rem;
        }

        .lesson-nav-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .625rem .75rem;
            border-radius: .6rem;
            text-decoration: none;
            color: #374151;
            font-size: 1rem;
            line-height: 1.5;
            transition: background .15s ease, color .15s ease;
        }

        .lesson-nav-link:hover {
            background: #eef0fe;
            color: #4f46e5;
            text-decoration: none;
        }

        .lesson-nav-link:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
            background: #eef0fe;
        }

        .lesson-nav-link.active {
            background: #6366f1;
            color: #fff;
            font-weight: 600;
        }

        .lesson-nav-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(99, 102, 241, .12);
            color: #4f46e5;
            font-size: 0.875rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .lesson-nav-link.active .lesson-nav-number {
            background: rgba(255, 255, 255, .25);
            color: #fff;
        }

        .quiz-nav-items {
            margin-top: 0.25rem;
        }

        .quiz-nav-link {
            padding-left: 2.5rem !important;
            font-size: 0.875rem !important;
        }

        .quiz-number {
            background: rgba(251, 191, 36, 0.1) !important;
            color: #f59e0b !important;
        }

        .quiz-nav-link.active .quiz-number {
            background: rgba(255, 255, 255, 0.25) !important;
            color: #fff !important;
        }

        .modal-content {
            border-radius: 1.5rem;
            border: none;
        }

        .modal-header {
            padding: 1.5rem 1.5rem 0;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 0 1.5rem 1.5rem;
        }

        @media (max-width: 991.98px) {
            .lesson-nav-card {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .quiz-intro-card {
                padding: 1.5rem !important;
            }

            .quiz-intro-title {
                font-size: 1.5rem;
            }

            .quiz-stat-card {
                padding: 1rem;
            }

            .quiz-stat-value {
                font-size: 1.25rem;
            }

            .lesson-nav-card {
                padding: 1.25rem !important;
            }

            .lesson-nav-link {
                padding: .5rem .625rem;
                font-size: 0.875rem;
            }

            .attempt-card {
                font-size: 0.875rem;
            }
        }

        @media print {

            .back-btn,
            nav,
            .quiz-nav-card,
            .start-quiz-btn,
            #startQuizModal {
                display: none !important;
            }

            .quiz-intro-card {
                box-shadow: none !important;
                border: 1px solid #dee2e6;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .progress-bar {
                transition: none;
            }

            .quiz-stat-card:hover {
                transform: none;
            }
        }

        @media (prefers-contrast: high) {
            .quiz-stat-card {
                border: 2px solid #000;
            }

            .lesson-nav-link.active {
                outline: 2px solid #fff;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    delay: {
                        show: 500,
                        hide: 100
                    }
                });
            });

            animateStatCards();

            animateProgressBar();

            const startQuizForm = document.getElementById('startQuizForm');
            const confirmStartBtn = document.getElementById('confirmStartQuiz');

            if (confirmStartBtn && startQuizForm) {
                confirmStartBtn.addEventListener('click', function(e) {
                    const originalText = confirmStartBtn.innerHTML;
                    confirmStartBtn.disabled = true;
                    confirmStartBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status"><span class="visually-hidden">Loading...</span></span>Starting Quiz...';

                    setTimeout(() => {
                        startQuizForm.submit();
                    }, 300);
                });
            }

            const startQuizBtn = document.querySelector('.start-quiz-btn');
            if (startQuizBtn) {
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !document.querySelector('.modal.show')) {
                        const modal = document.getElementById('startQuizModal');
                        if (modal) {
                            const bsModal = new bootstrap.Modal(modal);
                            bsModal.show();
                        }
                    }
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && document.querySelector('#startQuizModal.show')) {
                        if (confirmStartBtn && !confirmStartBtn.disabled) {
                            confirmStartBtn.click();
                        }
                    }
                });
            }

            const lessonLinks = document.querySelectorAll('.lesson-nav-link');
            lessonLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href').includes('#')) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });

        function animateStatCards() {
            const statValues = document.querySelectorAll('.quiz-stat-value[data-count]');

            statValues.forEach(element => {
                const count = element.getAttribute('data-count');

                if (count === 'unlimited') {
                    element.textContent = '∞';
                    return;
                }

                const finalValue = parseInt(count);
                if (isNaN(finalValue)) return;

                const currentText = element.textContent;
                const suffix = currentText.includes('%') ? '%' : '';

                animateValue(element, 0, finalValue, 1500, suffix);
            });
        }

        function animateValue(element, start, end, duration, suffix = '') {
            const startTime = performance.now();

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                const easeOutCubic = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(easeOutCubic * (end - start) + start);

                element.textContent = current + suffix;

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.textContent = end + suffix;
                }
            }

            requestAnimationFrame(update);
        }

        function animateProgressBar() {
            const progressBar = document.querySelector('.progress-bar[data-width]');
            if (!progressBar) return;

            const targetWidth = progressBar.getAttribute('data-width');

            setTimeout(() => {
                progressBar.style.width = targetWidth;
            }, 500);
        }

        const startModal = document.getElementById('startQuizModal');
        if (startModal) {
            startModal.addEventListener('shown.bs.modal', function() {
                const confirmBtn = document.getElementById('confirmStartQuiz');
                if (confirmBtn) {
                    confirmBtn.focus();
                }
            });

            startModal.addEventListener('hidden.bs.modal', function() {
                const startBtn = document.querySelector('.start-quiz-btn');
                if (startBtn) {
                    startBtn.focus();
                }
            });
        }
    </script>
@endpush

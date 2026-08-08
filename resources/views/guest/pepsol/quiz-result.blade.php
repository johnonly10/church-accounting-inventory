@extends('layouts.guest')

@section('content')
    <header>
        <x-hero-section title="Quiz Results" :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Pepsol Lessons', 'url' => route('pepsol.lessons', $pepsolName)],
            [
                'label' => $lesson->title,
                'url' => route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]),
            ],
            [
                'label' => $quiz->title,
                'url' => route('pepsol.quiz.show', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]),
            ],
            ['label' => 'Results'],
        ]" />
    </header>

    <main id="main-content" class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <x-white-card class="result-summary-card mb-4">
                    <div class="text-center">
                        @if ($attempt->passed)
                            <div class="result-icon success mb-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h1 class="result-title text-success">Congratulations!</h1>
                            <p class="result-subtitle">You passed the quiz!</p>
                        @else
                            <div class="result-icon failed mb-3">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h1 class="result-title text-danger">Keep Learning</h1>
                            <p class="result-subtitle">You didn't pass this time. Don't give up!</p>
                        @endif
                    </div>

                    <div
                        class="feedback-card {{ $attempt->passed ? 'bg-success-light' : 'bg-danger-light' }} p-4 rounded mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feedback-icon display-4">
                                {{ $attempt->passed ? '🎉' : '💪' }}
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $attempt->passed ? 'Excellent Work!' : 'Almost There!' }}</h4>
                                <p class="mb-0">
                                    @if ($attempt->passed)
                                        You've demonstrated understanding of this topic.
                                        @if ($quiz->passing_score - $attempt->percentage < 10)
                                            Great job! You're ready to advance.
                                        @else
                                            Keep up the good work!
                                        @endif
                                    @else
                                        You're {{ number_format($quiz->passing_score - $attempt->percentage, 1) }}% away
                                        from passing.
                                        Focus on the questions you missed and try again.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 g-md-4 mt-2">
                        <div class="col-md-4 col-6">
                            <div class="result-stat-card">
                                <div class="result-stat-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="result-stat-info">
                                    <span
                                        class="result-stat-value">{{ $attempt->score }}/{{ $attempt->total_points }}</span>
                                    <span class="result-stat-label">Score</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="result-stat-card">
                                <div class="result-stat-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <div class="result-stat-info">
                                    <span class="result-stat-value">{{ number_format($attempt->percentage, 1) }}%</span>
                                    <span class="result-stat-label">Percentage</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="result-stat-card">
                                <div class="result-stat-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="result-stat-info">
                                    <span class="result-stat-value">{{ $quiz->passing_score }}%</span>
                                    <span class="result-stat-label">Passing Score</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $canRetake =
                            $quiz->allow_retake &&
                            (!$quiz->max_attempts || $attempt->attempt_number < $quiz->max_attempts);
                        $showCorrectAnswers = !$quiz->allow_retake || $attempt->passed;
                    @endphp

                    @if (!$showCorrectAnswers)
                        <div class="alert alert-warning mt-4">
                            <i class="fas fa-lock me-2"></i>
                            <strong>Answers Hidden:</strong> Correct answers are hidden because you can retake this quiz.
                            Review the lesson material and try again!
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            @if ($canRetake)
                                <form
                                    action="{{ route('pepsol.quiz.start', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-redo me-2"></i>Retake Quiz
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}"
                                class="btn btn-outline-primary">
                                <i class="fas fa-book me-2"></i>Back to Lesson
                            </a>
                            <a href="{{ route('pepsol.quiz.show', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]) }}"
                                class="btn btn-outline-secondary">
                                <i class="fas fa-clipboard-list me-2"></i>Quiz Overview
                            </a>
                            {{-- <button class="btn btn-outline-secondary" onclick="window.print()">
                                <i class="fas fa-print me-1"></i>Print Results
                            </button> --}}
                        </div>
                    </div>
                </x-white-card>

                <x-white-card class="answers-review-card">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <h2 class="answers-review-title mb-0">Review Your Answers</h2>
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary btn-sm active" data-filter="all">All</button>
                                <button class="btn btn-outline-success btn-sm" data-filter="correct">
                                    <i class="fas fa-check"></i> Correct
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-filter="incorrect">
                                    <i class="fas fa-times"></i> Incorrect
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="question-navigator mb-4">
                        <h5 class="mb-3">Jump to Question</h5>
                        <div class="d-flex flex-wrap gap-2" id="questionNavigator">
                            @foreach ($attempt->answers as $index => $answer)
                                <a href="#question-{{ $index }}"
                                    class="btn btn-sm {{ $answer->is_correct ? 'btn-success' : 'btn-danger' }} question-nav-btn"
                                    data-question="{{ $index }}">
                                    {{ $index + 1 }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="search-filter mb-3">
                        <input type="text" class="form-control" id="questionSearch" placeholder="Search questions...">
                    </div>

                    @if ($showCorrectAnswers)
                        @foreach ($attempt->answers as $index => $answer)
                            <div class="answer-review-item mb-4 pb-4 border-bottom" id="question-{{ $index }}">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="answer-status-icon me-3">
                                        @if ($answer->is_correct)
                                            <span class="text-success">
                                                <i class="fas fa-check-circle fa-lg"></i>
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                <i class="fas fa-times-circle fa-lg"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h3 class="answer-question-text">
                                                <span class="badge bg-primary me-2">Q{{ $index + 1 }}</span>
                                                {{ $answer->question->question_text }}
                                            </h3>
                                            <span class="badge bg-secondary">{{ $answer->question->points }}
                                                point(s)</span>
                                        </div>

                                        @if ($answer->question->reference)
                                            <p class="answer-reference text-muted mb-2">
                                                <i class="fas fa-book-open me-1"></i>
                                                {{ $answer->question->reference }}
                                            </p>
                                        @endif

                                        <div class="answer-options-review mt-3">
                                            @foreach ($answer->question->options as $option)
                                                @php
                                                    $isSelected = $answer->selected_option_id == $option->id;
                                                    $isCorrectOption = $option->is_correct;

                                                    if ($isSelected && $isCorrectOption) {
                                                        $optionClass = 'option-correct';
                                                    } elseif ($isSelected && !$isCorrectOption) {
                                                        $optionClass = 'option-wrong';
                                                    } elseif (!$isSelected && $isCorrectOption) {
                                                        $optionClass = 'option-correct-missed';
                                                    } else {
                                                        $optionClass = '';
                                                    }
                                                @endphp
                                                <div class="option-review-item mb-2 {{ $optionClass }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="option-review-marker me-3">
                                                            @if ($isSelected && $isCorrectOption)
                                                                <i class="fas fa-check-circle text-success"></i>
                                                            @elseif ($isSelected && !$isCorrectOption)
                                                                <i class="fas fa-times-circle text-danger"></i>
                                                            @elseif (!$isSelected && $isCorrectOption)
                                                                <i class="fas fa-check text-success"></i>
                                                            @else
                                                                <i class="far fa-circle text-muted"></i>
                                                            @endif
                                                        </span>
                                                        <span
                                                            class="option-review-text 
                                                            @if ($isCorrectOption) fw-bold @endif
                                                            @if ($isSelected && !$isCorrectOption) text-danger @endif">
                                                            {{ $option->option_text }}
                                                            @if ($isSelected)
                                                                <span class="badge bg-secondary ms-2">Your Answer</span>
                                                            @endif
                                                            @if ($isCorrectOption)
                                                                <span class="badge bg-success ms-2">Correct Answer</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($answer->question->explanation)
                                            <div class="answer-explanation mt-3">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    <strong>Explanation:</strong> {{ $answer->question->explanation }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($attempt->answers as $index => $answer)
                            <div class="answer-review-item mb-4 pb-4 border-bottom" id="question-{{ $index }}">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="answer-status-icon me-3">
                                        @if ($answer->is_correct)
                                            <span class="text-success">
                                                <i class="fas fa-check-circle fa-lg"></i>
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                <i class="fas fa-times-circle fa-lg"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h3 class="answer-question-text">
                                                <span class="badge bg-primary me-2">Q{{ $index + 1 }}</span>
                                                {{ $answer->question->question_text }}
                                            </h3>
                                            <span class="badge bg-secondary">{{ $answer->question->points }}
                                                point(s)</span>
                                        </div>

                                        @if ($answer->question->reference)
                                            <p class="answer-reference text-muted mb-2">
                                                <i class="fas fa-book-open me-1"></i>
                                                {{ $answer->question->reference }}
                                            </p>
                                        @endif

                                        <div class="answer-options-review mt-3">
                                            @foreach ($answer->question->options as $option)
                                                @php
                                                    $isSelected = $answer->selected_option_id == $option->id;

                                                    if ($isSelected && $answer->is_correct) {
                                                        $optionClass = 'option-correct';
                                                    } elseif ($isSelected && !$answer->is_correct) {
                                                        $optionClass = 'option-wrong';
                                                    } else {
                                                        $optionClass = '';
                                                    }
                                                @endphp
                                                <div class="option-review-item mb-2 {{ $optionClass }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="option-review-marker me-3">
                                                            @if ($isSelected && $answer->is_correct)
                                                                <i class="fas fa-check-circle text-success"></i>
                                                            @elseif ($isSelected && !$answer->is_correct)
                                                                <i class="fas fa-times-circle text-danger"></i>
                                                            @else
                                                                <i class="far fa-circle text-muted"></i>
                                                            @endif
                                                        </span>
                                                        <span
                                                            class="option-review-text 
                                                            @if ($isSelected && !$answer->is_correct) text-danger @endif">
                                                            {{ $option->option_text }}
                                                            @if ($isSelected)
                                                                <span class="badge bg-secondary ms-2">Your Answer</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($answer->question->explanation && $answer->is_correct)
                                            <div class="answer-explanation mt-3">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    <strong>Explanation:</strong> {{ $answer->question->explanation }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center mt-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Study Tip:</strong> Review the lesson material to find the correct answers. You can
                                retake the quiz to improve your score!
                            </div>
                        </div>
                    @endif
                </x-white-card>

                <div class="text-center mt-4">
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        @if ($canRetake)
                            <form
                                action="{{ route('pepsol.quiz.start', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-redo me-2"></i>Retake Quiz
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}"
                            class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Back to Lesson
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        .result-summary-card {
            border-radius: 1.5rem !important;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
            padding: 2.5rem !important;
        }

        .result-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .result-icon.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
        }

        .result-icon.failed {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
        }

        .result-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .result-subtitle {
            font-size: 1.125rem;
            color: #6b7280;
        }

        .result-stat-card {
            background: #f9fafb;
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            height: 100%;
        }

        .result-stat-icon {
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

        .result-stat-info {
            display: flex;
            flex-direction: column;
        }

        .result-stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            line-height: 1;
        }

        .result-stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .answers-review-card {
            border-radius: 1.5rem !important;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
            padding: 2.5rem !important;
        }

        .answers-review-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }

        .answer-review-item {
            padding-bottom: 1.5rem;
        }

        .answer-review-item:last-child {
            border-bottom: none !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        .answer-status-icon {
            padding-top: 0.25rem;
        }

        .answer-question-text {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .answer-reference {
            font-size: 0.875rem;
        }

        .option-review-item {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .option-review-item.option-correct {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .option-review-item.option-wrong {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .option-review-item.option-correct-missed {
            background: #fffbeb;
            border-color: #fde68a;
        }

        .option-review-marker {
            flex-shrink: 0;
            font-size: 1.25rem;
            width: 24px;
        }

        .option-review-text {
            font-size: 1rem;
            color: #374151;
            line-height: 1.5;
        }

        .option-review-text.fw-bold {
            color: #059669;
        }

        .option-review-text.text-danger {
            color: #dc2626;
        }

        .answer-explanation {
            margin-top: 1rem;
        }

        .alert-info {
            border-radius: 0.75rem;
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        .alert-warning {
            border-radius: 0.75rem;
            background: #fffbeb;
            border-color: #fde68a;
            color: #92400e;
        }

        .bg-success-light {
            background-color: #f0fdf4;
        }

        .bg-danger-light {
            background-color: #fef2f2;
        }

        .feedback-card {
            border: 1px solid transparent;
        }

        .feedback-card.bg-success-light {
            border-color: #bbf7d0;
        }

        .feedback-card.bg-danger-light {
            border-color: #fecaca;
        }

        .question-nav-btn {
            min-width: 38px;
            text-align: center;
            transition: all 0.2s ease;
        }

        .question-nav-btn:hover {
            transform: scale(1.05);
        }

        .question-nav-btn.btn-success {
            background-color: #059669;
            border-color: #059669;
        }

        .question-nav-btn.btn-danger {
            background-color: #dc2626;
            border-color: #dc2626;
        }

        .badge.bg-success {
            background-color: #059669 !important;
        }

        .badge.bg-secondary {
            background-color: #6b7280 !important;
        }

        #questionSearch {
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        #questionSearch:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn-group .btn {
            border-radius: 0.5rem !important;
        }

        .btn-group .btn:not(:last-child) {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .btn-group .btn:not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        @media print {

            .btn-group,
            .question-navigator,
            .search-filter,
            .btn,
            form {
                display: none !important;
            }

            .result-summary-card,
            .answers-review-card {
                box-shadow: none !important;
                border: 1px solid #e5e7eb !important;
            }

            .answer-review-item {
                page-break-inside: avoid;
            }
        }

        @media (max-width: 767.98px) {

            .result-summary-card,
            .answers-review-card {
                padding: 1.5rem !important;
            }

            .result-title {
                font-size: 1.5rem;
            }

            .result-icon {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .answer-question-text {
                font-size: 1rem;
            }

            .option-review-text {
                font-size: 0.875rem;
            }

            .result-stat-card {
                padding: 0.75rem;
                gap: 0.5rem;
            }

            .result-stat-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .result-stat-value {
                font-size: 1rem;
            }

            .feedback-card {
                padding: 1rem !important;
            }

            .feedback-icon {
                font-size: 2rem !important;
            }

            .question-nav-btn {
                min-width: 32px;
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            .btn-group .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            .answers-review-title {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 575.98px) {
            .result-stat-card {
                flex-direction: column;
                text-align: center;
                padding: 0.5rem;
            }

            .result-stat-info {
                align-items: center;
            }

            .option-review-item {
                padding: 0.5rem;
            }

            .option-review-marker {
                font-size: 1rem;
                width: 20px;
            }

            .option-review-text {
                font-size: 0.8rem;
            }

            .badge {
                font-size: 0.65rem;
            }

            .answer-question-text {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var filterButtons = document.querySelectorAll('[data-filter]');
            var questionItems = document.querySelectorAll('.answer-review-item');
            var searchInput = document.getElementById('questionSearch');
            var navButtons = document.querySelectorAll('.question-nav-btn');

            function updateNavButtons() {
                navButtons.forEach(function(btn) {
                    var index = parseInt(btn.dataset.question);
                    var item = questionItems[index];
                    if (item) {
                        var isVisible = item.style.display !== 'none';
                        btn.style.display = isVisible ? 'inline-block' : 'none';
                    }
                });
            }

            filterButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(function(b) {
                        b.classList.remove('active');
                    });
                    this.classList.add('active');

                    var filter = this.dataset.filter;
                    questionItems.forEach(function(item) {
                        var isCorrect = item.querySelector('.fa-check-circle') !== null;
                        if (filter === 'all') {
                            item.style.display = 'block';
                        } else if (filter === 'correct') {
                            item.style.display = isCorrect ? 'block' : 'none';
                        } else if (filter === 'incorrect') {
                            item.style.display = !isCorrect ? 'block' : 'none';
                        }
                    });

                    updateNavButtons();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    var search = e.target.value.toLowerCase().trim();
                    questionItems.forEach(function(item) {
                        var text = item.querySelector('.answer-question-text').textContent
                            .toLowerCase();
                        var matches = text.includes(search);
                        item.style.display = matches ? 'block' : 'none';
                    });

                    updateNavButtons();
                });
            }

            navButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetId = this.getAttribute('href');
                    var target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        target.style.transition = 'background-color 0.3s ease';
                        target.style.backgroundColor = '#f3f4f6';
                        setTimeout(function() {
                            target.style.backgroundColor = 'transparent';
                        }, 1500);
                    }
                });
            });

            if (window.location.hash) {
                var target = document.querySelector(window.location.hash);
                if (target) {
                    setTimeout(function() {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        target.style.transition = 'background-color 0.3s ease';
                        target.style.backgroundColor = '#f3f4f6';
                        setTimeout(function() {
                            target.style.backgroundColor = 'transparent';
                        }, 1500);
                    }, 500);
                }
            }
        });

        function shareResult(platform) {
            var url = window.location.href;
            var text =
                'I just completed the quiz "{{ $quiz->title }}" with {{ number_format($attempt->percentage, 1) }}%!';

            var shareUrl = '';
            switch (platform) {
                case 'linkedin':
                    shareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url);
                    break;
                case 'twitter':
                    shareUrl = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(text) + '&url=' +
                        encodeURIComponent(url);
                    break;
                case 'email':
                    shareUrl = 'mailto:?subject=Quiz Results&body=' + encodeURIComponent(text + '\n\n' + url);
                    break;
                default:
                    return;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=600');
            }
        }
    </script>
@endpush

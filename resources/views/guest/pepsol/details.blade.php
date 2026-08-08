@extends('layouts.guest')

@section('content')
    <header>
        <x-hero-section title="{{ $lesson->title }}" :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Pepsol Lessons', 'url' => route('pepsol.lessons', $pepsolName)],
            ['label' => $lesson->title],
        ]" />
    </header>

    <main id="main-content" class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
        <nav class="mb-4 d-flex flex-wrap gap-2 align-items-center justify-content-between" aria-label="Lesson navigation">
            <a href="{{ route('pepsol.lessons', $pepsolName) }}" class="btn back-btn">
                <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Back to Lessons
            </a>

            <div class="d-flex gap-2">
                @if ($previousLesson)
                    <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $previousLesson]) }}"
                        class="btn btn-outline-primary rounded-pill px-3">
                        <i class="fas fa-chevron-left me-1" aria-hidden="true"></i>Previous
                    </a>
                @endif
                @if ($nextLesson)
                    <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $nextLesson]) }}"
                        class="btn btn-outline-primary rounded-pill px-3">
                        Next<i class="fas fa-chevron-right ms-1" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </nav>

        <div class="row g-4">
            {{-- Numbered lesson jump list --}}
            <aside class="col-lg-3">
                <x-white-card class="lesson-nav-card">
                    <h2 class="lesson-nav-title mb-3">All Lessons</h2>

                    @foreach ($lessonsByTopic as $topicName => $topicLessons)
                        <p class="lesson-nav-topic mb-2">{{ $topicName }}</p>
                        <ul class="list-unstyled lesson-nav-list mb-3" aria-label="Lessons in {{ $topicName }}">
                            @foreach ($topicLessons as $navLesson)
                                @php
                                    $number = $allLessons->search(fn($l) => $l->id === $navLesson->id) + 1;
                                    $isActive = $navLesson->id === $lesson->id;
                                @endphp
                                <li>
                                    <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $navLesson]) }}"
                                        class="lesson-nav-link {{ $isActive ? 'active' : '' }}"
                                        @if ($isActive) aria-current="page" @endif>
                                        <span class="lesson-nav-number">{{ $number }}</span>
                                        <span class="lesson-nav-label">{{ $navLesson->title }}</span>
                                    </a>

                                    {{-- Quiz link for each lesson --}}
                                    @if ($navLesson->quizzes && $navLesson->quizzes->where('status', 'published')->count() > 0)
                                        <div class="quiz-nav-items">
                                            @foreach ($navLesson->quizzes->where('status', 'published') as $quiz)
                                                @php
                                                    $isQuizActive = isset($activeQuiz) && $activeQuiz->id === $quiz->id;
                                                @endphp
                                                <a href="{{ route('pepsol.quiz.show', ['pepsolName' => $pepsolName, 'lesson' => $navLesson, 'quiz' => $quiz]) }}"
                                                    class="lesson-nav-link quiz-nav-link {{ $isQuizActive ? 'active' : '' }}"
                                                    @if ($isQuizActive) aria-current="page" @endif>
                                                    <span class="lesson-nav-number quiz-number">
                                                        <i class="fas fa-question-circle"></i>
                                                    </span>
                                                    <span class="lesson-nav-label">{{ $quiz->title }}</span>
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

            {{-- Lesson content --}}
            <section class="col-lg-9" aria-label="Lesson content">
                <x-white-card class="lesson-detail-card">
                    <header class="lesson-detail-header mb-4">
                        @if ($lesson->topic)
                            <span class="badge rounded-pill mb-3 lesson-badge">
                                <i class="fas fa-graduation-cap me-1" aria-hidden="true"></i>
                                {{ $lesson->topic->name }}
                            </span>
                        @endif

                        @if ($lesson->image)
                            <figure class="lesson-detail-image-wrap mb-4">
                                <img src="{{ asset($lesson->image) }}" alt="{{ $lesson->title }}"
                                    class="lesson-detail-image" loading="lazy">
                            </figure>
                        @endif

                        <h1 class="lesson-detail-title">{{ $lesson->title }}</h1>

                        @if ($lesson->subtitle)
                            <p class="lesson-detail-subtitle text-muted">{{ $lesson->subtitle }}</p>
                        @endif

                        @if ($lesson->summary)
                            <p class="lesson-detail-summary">{{ $lesson->summary }}</p>
                        @endif
                    </header>

                    {{-- Lesson parts: Opening / Teaching / Reflection / Closing --}}
                    <div class="lesson-parts">
                        @forelse ($orderedParts as $part)
                            <section class="lesson-part mb-5" aria-labelledby="part-{{ $part->id }}">
                                <h2 class="lesson-part-title" id="part-{{ $part->id }}">
                                    {{ $partLabels[$part->part_key] ?? ucfirst($part->part_key) }}
                                </h2>

                                @forelse ($part->blocks->sortBy('sort_order') as $block)
                                    <div class="lesson-block lesson-block-{{ $block->block_type }} mb-3">
                                        @switch($block->block_type)
                                            @case('heading')
                                                <h3 class="lesson-block-heading">{{ $block->content }}</h3>
                                            @break

                                            @case('subheading')
                                                <h4 class="lesson-block-subheading">{{ $block->content }}</h4>
                                            @break

                                            @case('paragraph')
                                                @if (!empty($block->content))
                                                    <p class="lesson-block-body">{!! nl2br(e($block->content)) !!}</p>
                                                @endif
                                            @break

                                            @case('quote')
                                                <blockquote class="lesson-block-quote">
                                                    <p class="mb-1">{{ $block->content }}</p>
                                                    @if (!empty($block->reference))
                                                        <footer class="lesson-block-quote-footer">
                                                            &mdash; {{ $block->reference }}
                                                        </footer>
                                                    @endif
                                                </blockquote>
                                            @break

                                            @case('scripture')
                                                <div class="lesson-block-scripture">
                                                    @if (!empty($block->reference))
                                                        <p class="scripture-reference">{{ $block->reference }}</p>
                                                    @endif
                                                    @if (!empty($block->content))
                                                        <p class="scripture-text">&ldquo;{{ $block->content }}&rdquo;</p>
                                                    @endif
                                                </div>
                                            @break

                                            @case('question')
                                                <div class="lesson-block-question">
                                                    <i class="fas fa-circle-question me-2" aria-hidden="true"></i>
                                                    <span>{{ $block->content }}</span>
                                                </div>
                                            @break

                                            @case('prayer')
                                                <div class="lesson-block-prayer">
                                                    <i class="fas fa-hands-praying me-2" aria-hidden="true"></i>
                                                    <div>{!! nl2br(e($block->content)) !!}</div>
                                                </div>
                                            @break

                                            @case('list')
                                                @php
                                                    $listItems = collect(
                                                        preg_split('/\r\n|\r|\n/', trim($block->content ?? '')),
                                                    )
                                                        ->map(fn($item) => trim($item))
                                                        ->filter();
                                                @endphp
                                                @if ($listItems->isNotEmpty())
                                                    <ul class="lesson-block-list">
                                                        @foreach ($listItems as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @break

                                            @case('divider')
                                                <hr class="lesson-block-divider">
                                            @break

                                            @default
                                                @if (!empty($block->content))
                                                    <p class="lesson-block-body">{!! nl2br(e($block->content)) !!}</p>
                                                @endif
                                        @endswitch

                                        @if (!empty($block->media))
                                            @php
                                                $mediaExt = strtolower(
                                                    pathinfo(
                                                        parse_url($block->media, PHP_URL_PATH) ?? $block->media,
                                                        PATHINFO_EXTENSION,
                                                    ),
                                                );
                                                $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
                                                $videoExts = ['mp4', 'mov', 'webm'];
                                                $isExternalUrl =
                                                    filter_var($block->media, FILTER_VALIDATE_URL) !== false;
                                                $isVideoEmbed =
                                                    str_contains($block->media, 'youtube.com') ||
                                                    str_contains($block->media, 'youtu.be') ||
                                                    str_contains($block->media, 'vimeo.com');
                                            @endphp

                                            @if (in_array($mediaExt, $imageExts))
                                                <figure class="lesson-block-image-wrap mt-3">
                                                    <img src="{{ $isExternalUrl ? $block->media : asset($block->media) }}"
                                                        alt="" class="lesson-block-image" loading="lazy">
                                                </figure>
                                            @elseif ($isVideoEmbed || in_array($mediaExt, $videoExts))
                                                <div class="lesson-block-video ratio ratio-16x9 mt-3">
                                                    <iframe src="{{ $block->media }}" title="Lesson media"
                                                        allowfullscreen></iframe>
                                                </div>
                                            @elseif ($isExternalUrl)
                                                <a href="{{ $block->media }}"
                                                    class="lesson-block-url mt-2 d-inline-flex align-items-center"
                                                    target="_blank" rel="noopener">
                                                    <i class="fas fa-link me-2" aria-hidden="true"></i>{{ $block->media }}
                                                </a>
                                            @else
                                                <a href="{{ asset($block->media) }}"
                                                    class="lesson-block-file mt-2 d-inline-flex align-items-center"
                                                    target="_blank" rel="noopener">
                                                    <i class="fas fa-file-alt me-2" aria-hidden="true"></i>Download
                                                    attachment
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                    @empty
                                        <p class="text-muted">No content added for this section yet.</p>
                                    @endforelse
                                </section>
                                @empty
                                    <p class="text-muted">This lesson doesn't have any content yet.</p>
                                @endforelse
                            </div>

                            @auth
                                @php
                                    $isCompleted = auth()->user()->hasCompletedLesson($lesson->id);
                                @endphp

                                <div class="lesson-completion-section mt-5 pt-3 border-top">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                        <div>
                                            @if ($isCompleted)
                                                <div class="d-flex align-items-center text-success">
                                                    <i class="fas fa-check-circle me-2" style="font-size: 1.5rem;"></i>
                                                    <div>
                                                        <strong>Lesson Completed!</strong>
                                                        <p class="mb-0 text-muted small">You've successfully completed this lesson.</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div>
                                                    <strong>Mark as Complete</strong>
                                                    <p class="mb-0 text-muted small">Click the button when you've finished this lesson.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <form
                                            action="{{ route('pepsol.lesson.complete', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @if ($isCompleted)
                                                <button type="submit"
                                                    formaction="{{ route('pepsol.lesson.uncomplete', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}"
                                                    class="btn btn-outline-secondary rounded-pill px-4">
                                                    <i class="fas fa-undo me-2"></i>Undo Complete
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                                    <i class="fas fa-check me-2"></i>Complete Lesson
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            @endauth

                            {{-- Quiz Section at the bottom of lesson content --}}
                            @if ($lesson->quizzes && $lesson->quizzes->where('status', 'published')->count() > 0)
                                <div class="lesson-quiz-section mt-5">
                                    <h2 class="lesson-part-title">Lesson Quiz</h2>
                                    <div class="row g-3">
                                        @foreach ($lesson->quizzes->where('status', 'published') as $quiz)
                                            <div class="col-md-6">
                                                <div class="quiz-card">
                                                    <div class="quiz-card-body">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="quiz-card-icon">
                                                                <i class="fas fa-clipboard-check"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h3 class="quiz-card-title">{{ $quiz->title }}</h3>
                                                                @if ($quiz->description)
                                                                    <p class="quiz-card-desc">
                                                                        {{ Str::limit($quiz->description, 100) }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="quiz-card-stats">
                                                            <span class="quiz-stat">
                                                                <i class="fas fa-question-circle"></i>
                                                                {{ $quiz->questions_count ?? $quiz->questions->count() }} Questions
                                                            </span>
                                                            <span class="quiz-stat">
                                                                <i class="fas fa-trophy"></i>
                                                                Passing: {{ $quiz->passing_score }}%
                                                            </span>
                                                        </div>
                                                        <a href="{{ route('pepsol.quiz.show', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz]) }}"
                                                            class="btn btn-primary w-100 mt-3">
                                                            <i class="fas fa-play me-2"></i>Take Quiz
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </x-white-card>
                    </section>
                </div>
            </main>
        @endsection

        @push('styles')
            <style>
                :root {
                    --pepsol-primary: #6366f1;
                    --pepsol-primary-dark: #4f46e5;
                    --pepsol-primary-light: #eef0fe;
                    --card-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
                    --card-radius: 1.5rem;

                    /* Improved type scale for better accessibility */
                    --text-xs: 0.75rem;
                    --text-sm: 0.875rem;
                    --text-base: 1rem;
                    --text-md: 1.0625rem;
                    --text-lg: 1.125rem;
                    --text-xl: 1.25rem;
                    --text-2xl: 1.5rem;
                    --text-3xl: 1.75rem;
                }

                .back-btn {
                    display: inline-flex;
                    align-items: center;
                    background: #fff;
                    color: var(--pepsol-primary-dark);
                    border: 1px solid #e5e7eb;
                    font-weight: 600;
                    font-size: var(--text-base);
                    border-radius: .75rem;
                    padding: .6rem 1.25rem;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
                    transition: background .2s ease, transform .15s ease;
                }

                .back-btn:hover {
                    background: var(--pepsol-primary-light);
                    transform: translateX(-2px);
                }

                .lesson-nav-card,
                .lesson-detail-card {
                    border-radius: var(--card-radius) !important;
                    box-shadow: var(--card-shadow);
                    padding: 2rem !important;
                }

                .lesson-nav-title {
                    font-size: var(--text-lg);
                    font-weight: 700;
                    color: #1f2937;
                }

                .lesson-nav-topic {
                    font-size: var(--text-sm);
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    color: var(--pepsol-primary-dark);
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
                    font-size: var(--text-base);
                    line-height: 1.5;
                    transition: background .15s ease, color .15s ease;
                }

                .lesson-nav-link:hover {
                    background: var(--pepsol-primary-light);
                    color: var(--pepsol-primary-dark);
                }

                .lesson-nav-link.active {
                    background: var(--pepsol-primary);
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
                    color: var(--pepsol-primary-dark);
                    font-size: var(--text-sm);
                    font-weight: 700;
                    flex-shrink: 0;
                }

                .lesson-nav-link.active .lesson-nav-number {
                    background: rgba(255, 255, 255, .25);
                    color: #fff;
                }

                /* Quiz navigation styles */
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

                /* Quiz card styles for lesson bottom */
                .quiz-card {
                    background: #fff;
                    border: 1px solid #e5e7eb;
                    border-radius: 1rem;
                    padding: 1.5rem;
                    transition: all 0.3s ease;
                    height: 100%;
                }

                .quiz-card:hover {
                    border-color: var(--pepsol-primary);
                    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
                    transform: translateY(-2px);
                }

                .quiz-card-icon {
                    width: 48px;
                    height: 48px;
                    border-radius: 12px;
                    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-size: 1.25rem;
                    flex-shrink: 0;
                }

                .quiz-card-title {
                    font-size: 1.125rem;
                    font-weight: 700;
                    color: #1f2937;
                    margin-bottom: 0.25rem;
                }

                .quiz-card-desc {
                    font-size: 0.875rem;
                    color: #6b7280;
                    margin-bottom: 0;
                }

                .quiz-card-stats {
                    display: flex;
                    gap: 1rem;
                    flex-wrap: wrap;
                }

                .quiz-stat {
                    font-size: 0.875rem;
                    color: #6b7280;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .quiz-stat i {
                    color: var(--pepsol-primary);
                }

                .lesson-badge {
                    background: var(--pepsol-primary);
                    color: #fff;
                    font-size: var(--text-sm);
                    font-weight: 600;
                    padding: .55rem 1.1rem;
                }

                .lesson-detail-image-wrap {
                    width: 100%;
                    max-height: 380px;
                    border-radius: 1.1rem;
                    overflow: hidden;
                }

                .lesson-detail-image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .lesson-detail-title {
                    font-size: var(--text-3xl);
                    font-weight: 700;
                    color: #1f2937;
                    line-height: 1.3;
                }

                .lesson-detail-subtitle {
                    font-size: var(--text-lg);
                    line-height: 1.5;
                }

                .lesson-detail-summary {
                    font-size: var(--text-md);
                    color: #4b5563;
                    margin-top: .75rem;
                    line-height: 1.6;
                }

                .lesson-part-title {
                    font-size: var(--text-2xl);
                    font-weight: 700;
                    color: var(--pepsol-primary-dark);
                    border-bottom: 2px solid var(--pepsol-primary-light);
                    padding-bottom: .5rem;
                    margin-bottom: 1rem;
                }

                .lesson-block-heading {
                    font-size: var(--text-xl);
                    font-weight: 700;
                    color: #1f2937;
                    margin-top: 1rem;
                    line-height: 1.4;
                }

                .lesson-block-subheading {
                    font-size: var(--text-lg);
                    font-weight: 700;
                    color: #374151;
                    margin-top: .75rem;
                    line-height: 1.4;
                }

                .lesson-block-body {
                    font-size: var(--text-base);
                    line-height: 1.8;
                    color: #374151;
                }

                .lesson-block-quote {
                    border-left: 4px solid var(--pepsol-primary);
                    background: var(--pepsol-primary-light);
                    padding: 1.25rem 1.5rem;
                    border-radius: .5rem;
                    font-style: italic;
                    color: #374151;
                    font-size: var(--text-md);
                    line-height: 1.7;
                }

                .lesson-block-quote-footer {
                    font-size: var(--text-sm);
                    font-style: normal;
                    font-weight: 600;
                    color: var(--pepsol-primary-dark);
                    margin-top: .5rem;
                }

                .lesson-block-scripture {
                    background: #f9fafb;
                    border-radius: .75rem;
                    padding: 1.25rem;
                }

                .scripture-reference {
                    font-weight: 700;
                    color: var(--pepsol-primary-dark);
                    margin-bottom: .25rem;
                    font-size: var(--text-base);
                }

                .scripture-text {
                    font-style: italic;
                    color: #4b5563;
                    margin-bottom: 0;
                    font-size: var(--text-md);
                    line-height: 1.7;
                }

                .lesson-block-question {
                    display: flex;
                    align-items: flex-start;
                    background: #fffbeb;
                    border: 1px solid #fde68a;
                    border-radius: .75rem;
                    padding: 1rem 1.25rem;
                    color: #92400e;
                    font-weight: 600;
                    font-size: var(--text-base);
                    line-height: 1.6;
                }

                .lesson-block-prayer {
                    display: flex;
                    align-items: flex-start;
                    background: #f0fdf4;
                    border: 1px solid #bbf7d0;
                    border-radius: .75rem;
                    padding: 1rem 1.25rem;
                    color: #166534;
                    font-style: italic;
                    line-height: 1.8;
                    font-size: var(--text-base);
                }

                .lesson-block-list {
                    padding-left: 1.5rem;
                    color: #374151;
                    line-height: 1.8;
                    font-size: var(--text-base);
                }

                .lesson-block-list li {
                    margin-bottom: 0.5rem;
                }

                .lesson-block-divider {
                    border: none;
                    border-top: 2px dashed var(--pepsol-primary-light);
                    margin: 1.5rem 0;
                }

                .lesson-block-image-wrap img {
                    width: 100%;
                    border-radius: .9rem;
                }

                .lesson-block-file,
                .lesson-block-url {
                    color: var(--pepsol-primary-dark);
                    font-weight: 600;
                    text-decoration: none;
                    font-size: var(--text-base);
                }

                .lesson-block-file:hover,
                .lesson-block-url:hover {
                    text-decoration: underline;
                }

                /* Responsive adjustments */
                @media (max-width: 767.98px) {

                    .lesson-nav-card,
                    .lesson-detail-card {
                        padding: 1.25rem !important;
                    }

                    .lesson-detail-title {
                        font-size: var(--text-2xl);
                    }

                    .lesson-part-title {
                        font-size: var(--text-xl);
                    }

                    .lesson-nav-link {
                        padding: .5rem .625rem;
                        font-size: var(--text-sm);
                    }
                }

                /* High contrast mode support */
                @media (prefers-contrast: high) {
                    .lesson-nav-link {
                        border: 1px solid currentColor;
                    }

                    .lesson-block-quote {
                        border-left-width: 5px;
                    }
                }

                /* Reduced motion preference */
                @media (prefers-reduced-motion: reduce) {

                    .back-btn,
                    .lesson-nav-link {
                        transition: none;
                    }
                }
            </style>
        @endpush

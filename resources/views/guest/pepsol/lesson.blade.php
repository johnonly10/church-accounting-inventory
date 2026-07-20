@extends('layouts.guest')

@section('content')
    <header>
        <x-hero-section title="Pepsol <em>Lessons</em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Pepsol Lessons']]" />
    </header>

    <main id="main-content" class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
        <nav class="mb-4 d-flex flex-wrap gap-2 align-items-center justify-content-between" aria-label="Lesson navigation">
            <a href="{{ route('pepsol.index') }}" class="btn back-btn">
                <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Back to Pepsol
            </a>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary rounded-pill px-3" id="viewToggle"
                    aria-label="Toggle between grid and list view" aria-pressed="false">
                    <i class="fas fa-th-large" aria-hidden="true"></i>
                    <span class="visually-hidden">Switch to list view</span>
                </button>
            </div>
        </nav>

        <section class="lesson-filters mb-4" aria-label="Lesson filters">
            <form role="search" aria-label="Filter and sort lessons">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label for="lessonSearch" class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted" aria-hidden="true"></i>
                                <span class="visually-hidden">Search lessons</span>
                            </label>
                            <input type="search" class="form-control border-start-0" placeholder="Search lessons..."
                                id="lessonSearch" aria-label="Search lessons by title or topic">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sortLessons" class="visually-hidden">Sort lessons</label>
                        <select class="form-select" id="sortLessons" aria-label="Sort lessons by order">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="a-z">A-Z</option>
                            <option value="z-a">Z-A</option>
                        </select>
                    </div>
                </div>
            </form>
        </section>

        @php
            $allLessons = $lessonsByTopic->flatMap(function ($lessons, $topicName) {
                return $lessons->map(function ($lesson) use ($topicName) {
                    $lesson->topicName = $topicName;
                    return $lesson;
                });
            });

            $perPage = 20;
            $currentPage = request()->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedLessons = $allLessons->slice($offset, $perPage);
            $totalLessons = $allLessons->count();
            $lastPage = ceil($totalLessons / $perPage);
        @endphp

        <!-- Skeleton Loading State -->
        <section id="skeletonLoader" aria-label="Loading lessons" aria-busy="true" aria-live="polite">
            <h2 class="visually-hidden">Loading lessons...</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4">
                @for ($i = 0; $i < 8; $i++)
                    <div class="col">
                        <article class="card skeleton-card"
                            style="border-radius:1.5rem;overflow:hidden;border:1px solid rgba(0,0,0,.04);padding:2rem;height:100%;"
                            aria-hidden="true">
                            <div class="skeleton-shimmer"
                                style="height:20px;width:40%;border-radius:20px;background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;">
                            </div>
                            <div class="skeleton-shimmer mt-3"
                                style="height:180px;width:100%;border-radius:1.1rem;background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;">
                            </div>
                            <div class="skeleton-shimmer mt-3"
                                style="height:16px;width:60%;border-radius:4px;background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;">
                            </div>
                            <div class="skeleton-shimmer mt-2"
                                style="height:14px;width:80%;border-radius:4px;background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;">
                            </div>
                            <div class="skeleton-shimmer mt-3"
                                style="height:48px;width:100%;border-radius:.9rem;background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;">
                            </div>
                        </article>
                    </div>
                @endfor
            </div>
        </section>

        <!-- Lessons Content -->
        <section id="lessonsContainer" style="display:none;" aria-label="Lesson cards" aria-live="polite">
            @if ($paginatedLessons->isNotEmpty())
                <h2 class="visually-hidden">Available Lessons</h2>
                <ul class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4 list-unstyled"
                    aria-label="All Pepsol lessons">
                    @foreach ($paginatedLessons as $lesson)
                        <li class="col lesson-item" data-topic="{{ $lesson->topicName }}"
                            data-level="{{ $lesson->level ?? 'beginner' }}" data-title="{{ $lesson->title }}"
                            data-date="{{ $lesson->created_at ?? now() }}"
                            aria-labelledby="lesson-title-{{ $lesson->id }}">
                            <article class="h-100 lesson-card-wrapper">
                                <a href="{{ route('pepsol.details', ['pepsolName' => $pepsolName, 'lesson' => $lesson]) }}"
                                    class="text-decoration-none lesson-card-link d-block h-100"
                                    aria-label="View lesson: {{ $lesson->title }}">
                                    <x-white-card class="h-100 lesson-card">
                                        <div class="lesson-card-inner d-flex flex-column h-100">
                                            <header class="lesson-card-header">
                                                <span class="badge rounded-pill mb-3 lesson-badge">
                                                    <i class="fas fa-graduation-cap me-1" aria-hidden="true"></i>
                                                    {{ $lesson->topicName }}
                                                </span>

                                                <figure class="lesson-image-wrap mb-3">
                                                    @if ($lesson->image)
                                                        <img src="{{ asset($lesson->image) }}" alt="{{ $lesson->title }}"
                                                            class="lesson-image" loading="lazy" width="400"
                                                            height="275">
                                                    @else
                                                        <div class="lesson-image-placeholder" role="img"
                                                            aria-label="Lesson illustration placeholder">
                                                            <i class="fas fa-book-open" aria-hidden="true"></i>
                                                        </div>
                                                    @endif
                                                </figure>
                                            </header>

                                            <div class="lesson-card-body flex-grow-1">
                                                <dl class="lesson-meta d-flex gap-3 mb-2" aria-label="Lesson details">
                                                    @if ($lesson->duration ?? false)
                                                        <div class="d-flex align-items-center gap-1">
                                                            <dt class="visually-hidden">Duration</dt>
                                                            <dd class="mb-0 lesson-duration">
                                                                <i class="far fa-clock" aria-hidden="true"></i>
                                                                {{ $lesson->duration }}
                                                            </dd>
                                                        </div>
                                                    @endif
                                                    @if ($lesson->level ?? false)
                                                        <div class="d-flex align-items-center gap-1">
                                                            <dt class="visually-hidden">Level</dt>
                                                            <dd class="mb-0 lesson-level">
                                                                <i class="fas fa-signal" aria-hidden="true"></i>
                                                                {{ ucfirst($lesson->level) }}
                                                            </dd>
                                                        </div>
                                                    @endif
                                                </dl>

                                                <p class="lesson-topic-tag mb-1"
                                                    aria-label="Topic: {{ $lesson->topicName }}">
                                                    {{ $lesson->topicName }}
                                                </p>

                                                <h3 class="lesson-title mb-1" id="lesson-title-{{ $lesson->id }}">
                                                    {{ $lesson->title }}
                                                </h3>

                                                @if ($lesson->subtitle)
                                                    <p class="text-muted small mb-2 lesson-subtitle">
                                                        {{ $lesson->subtitle }}
                                                    </p>
                                                @endif
                                            </div>

                                            <footer class="d-flex gap-2 align-items-center mt-auto">
                                                <span class="btn lesson-action-btn flex-grow-1" role="button">
                                                    View Lesson
                                                    <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                                                </span>
                                                <button class="btn btn-outline-secondary rounded-circle bookmark-btn"
                                                    data-lesson="{{ $lesson->id }}"
                                                    aria-label="Bookmark lesson: {{ $lesson->title }}"
                                                    aria-pressed="false">
                                                    <i class="far fa-bookmark" aria-hidden="true"></i>
                                                </button>
                                            </footer>
                                        </div>
                                    </x-white-card>
                                </a>
                            </article>
                        </li>
                    @endforeach
                </ul>

                @if ($totalLessons > $perPage)
                    <nav class="d-flex justify-content-center mt-5" aria-label="Lesson pagination">
                        <ul class="pagination">
                            <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $currentPage > 1 ? '?page=' . ($currentPage - 1) : '#' }}"
                                    tabindex="{{ $currentPage <= 1 ? '-1' : '0' }}"
                                    aria-disabled="{{ $currentPage <= 1 ? 'true' : 'false' }}"
                                    aria-label="Previous page">
                                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                </a>
                            </li>

                            @for ($i = 1; $i <= $lastPage; $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}"
                                    {{ $i == $currentPage ? 'aria-current="page"' : '' }}>
                                    <a class="page-link" href="?page={{ $i }}"
                                        aria-label="Go to page {{ $i }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            <li class="page-item {{ $currentPage >= $lastPage ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage < $lastPage ? '?page=' . ($currentPage + 1) : '#' }}"
                                    tabindex="{{ $currentPage >= $lastPage ? '-1' : '0' }}"
                                    aria-disabled="{{ $currentPage >= $lastPage ? 'true' : 'false' }}"
                                    aria-label="Next page">
                                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endif
            @else
                <section class="empty-state text-center py-5" aria-label="No lessons available">
                    <div class="empty-state-icon mb-4" aria-hidden="true">
                        <i class="fas fa-book-open text-muted" style="font-size:4rem;opacity:.2;"></i>
                    </div>
                    <h2 class="mb-2">No Lessons Available</h2>
                    <p class="text-muted mb-4">No lessons available yet for {{ $pepsolName->name ?? 'this Pepsol' }}.</p>
                    <a href="{{ route('guest.pepsol.index') }}" class="btn btn-primary rounded-pill px-5">
                        <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Browse Other Pepsols
                    </a>
                </section>
            @endif
        </section>
    </main>

    <footer>
        <button id="scrollTopBtn" type="button" class="scroll-top-btn" aria-label="Scroll to top">
            <i class="fas fa-arrow-up" aria-hidden="true"></i>
        </button>
    </footer>
@endsection

@push('styles')
    <style>
        :root {
            --pepsol-primary: #6366f1;
            --pepsol-primary-dark: #4f46e5;
            --pepsol-primary-light: #eef0fe;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --card-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
            --hover-shadow: 0 12px 40px rgba(99, 102, 241, 0.15);
            --card-radius: 1.5rem;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            background: #fff;
            color: var(--pepsol-primary-dark);
            border: 1px solid #e5e7eb;
            font-weight: 600;
            font-size: .95rem;
            border-radius: .75rem;
            padding: .6rem 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
            transition: background .2s ease, transform .15s ease, box-shadow .2s ease;
        }

        .back-btn:hover {
            background: var(--pepsol-primary-light);
            color: var(--pepsol-primary-dark);
            transform: translateX(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, .15);
        }

        .back-btn:active {
            transform: translateX(-1px) scale(.98);
        }

        main {
            width: 100%;
            align-self: stretch;
        }

        .lesson-card-link {
            display: block;
            height: 100%;
            position: relative;
        }

        .lesson-card {
            border-radius: var(--card-radius) !important;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .04);
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: translateY(16px);
            animation: fadeInUp .5s ease forwards;
            padding: 2rem !important;
            position: relative;
        }

        .lesson-card-inner {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .lesson-card-link:hover .lesson-card,
        .lesson-card-link:focus-visible .lesson-card {
            transform: translateY(-8px) scale(1.01);
            box-shadow: var(--hover-shadow);
        }

        .lesson-card-link:active .lesson-card {
            transform: translateY(-3px) scale(.99);
        }

        .lesson-badge {
            background: var(--pepsol-primary);
            color: #fff;
            align-self: flex-start;
            font-size: .9rem;
            font-weight: 600;
            padding: .55rem 1.1rem;
        }

        .lesson-topic-tag {
            display: inline-block;
            font-size: .85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--pepsol-primary-dark);
            margin-top: .5rem;
        }

        .lesson-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.4;
            margin-top: 0.25rem;
        }

        .lesson-image-wrap {
            width: 100%;
            aspect-ratio: 16 / 11;
            border-radius: 1.1rem;
            overflow: hidden;
            background: #f3f4f6;
            margin-top: .5rem;
        }

        .lesson-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .lesson-card-link:hover .lesson-image {
            transform: scale(1.06);
        }

        .lesson-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #eef0fe, #f7f8ff);
            color: var(--pepsol-primary);
        }

        .lesson-image-placeholder i {
            font-size: 3.25rem;
            opacity: .5;
        }

        .lesson-meta {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .lesson-meta i {
            font-size: 0.75rem;
            margin-right: 4px;
        }

        .lesson-subtitle {
            font-size: clamp(0.9rem, 1.5vw, 1.05rem);
            line-height: 1.5;
            color: #6b7280;
        }

        .lesson-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            background: var(--primary-gradient);
            color: #fff !important;
            font-weight: 600;
            font-size: 1rem;
            border-radius: .9rem;
            padding: .9rem 1.25rem;
            min-height: 48px;
            white-space: nowrap;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .lesson-action-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .lesson-card-link:hover .lesson-action-btn::after {
            transform: translateX(100%);
        }

        .lesson-card-link:hover .lesson-action-btn {
            box-shadow: 0 10px 22px rgba(99, 102, 241, .35);
            transform: translateY(-2px);
        }

        .lesson-action-btn:active {
            transform: scale(.97);
        }

        .bookmark-btn {
            width: 48px;
            height: 48px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.25s ease;
            flex-shrink: 0;
        }

        .bookmark-btn:hover {
            background: var(--pepsol-primary-light);
            border-color: var(--pepsol-primary);
            transform: scale(1.1);
        }

        .bookmark-btn.bookmarked i {
            color: var(--pepsol-primary);
        }

        .scroll-top-btn {
            position: fixed;
            bottom: 1.75rem;
            right: 1.75rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: none;
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 8px 20px rgba(99, 102, 241, .35);
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            z-index: 1050;
            transition: all .25s ease;
        }

        .scroll-top-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 28px rgba(99, 102, 241, .45);
        }

        .scroll-top-btn:active {
            transform: scale(.95);
        }

        .scroll-top-btn.show {
            display: flex;
            animation: fadeInUp 0.3s ease;
        }

        .empty-state-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            padding: 16px 24px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            min-width: 300px;
            max-width: 450px;
            border-left: 4px solid var(--pepsol-primary);
        }

        .toast-success {
            border-left-color: #10b981;
        }

        .toast-error {
            border-left-color: #ef4444;
        }

        .toast-warning {
            border-left-color: #f59e0b;
        }

        .toast-content {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #9ca3af;
            padding: 0 4px;
        }

        .toast-close:hover {
            color: #4b5563;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        @media (max-width: 768px) {
            .lesson-card {
                padding: 1.5rem !important;
            }

            .lesson-meta {
                font-size: 0.75rem;
            }

            .lesson-action-btn {
                font-size: 0.9rem;
                padding: 0.7rem 1rem;
                min-height: 44px;
            }

            .back-btn {
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
                min-height: 44px;
            }

            .toast {
                min-width: unset;
                width: 90%;
                max-width: 400px;
            }

            .lesson-filters .row>div {
                margin-bottom: 10px;
            }

            .lesson-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .lesson-filters .row>div {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skeletonLoader = document.getElementById('skeletonLoader');
            const lessonsContainer = document.getElementById('lessonsContainer');
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            const lessonSearch = document.getElementById('lessonSearch');
            const sortLessons = document.getElementById('sortLessons');
            const viewToggle = document.getElementById('viewToggle');
            let currentView = 'grid';

            setTimeout(function() {
                if (skeletonLoader) {
                    skeletonLoader.style.display = 'none';
                }
                if (lessonsContainer) {
                    lessonsContainer.style.display = 'block';
                }
            }, 800);

            function filterLessons() {
                const searchTerm = lessonSearch ? lessonSearch.value.toLowerCase().trim() : '';
                const items = document.querySelectorAll('.lesson-item');

                items.forEach(function(item) {
                    const title = item.dataset.title ? item.dataset.title.toLowerCase() : '';
                    const topic = item.dataset.topic || '';

                    let matchSearch = true;
                    if (searchTerm) {
                        matchSearch = title.includes(searchTerm) || topic.toLowerCase().includes(
                            searchTerm);
                    }

                    if (matchSearch) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            function sortLessonsFunction() {
                const sortValue = sortLessons ? sortLessons.value : 'newest';
                const container = document.querySelector('.row.g-4');
                if (!container) return;

                const items = Array.from(container.querySelectorAll('.lesson-item'));

                items.sort(function(a, b) {
                    const titleA = a.dataset.title || '';
                    const titleB = b.dataset.title || '';
                    const dateA = new Date(a.dataset.date || 0);
                    const dateB = new Date(b.dataset.date || 0);

                    switch (sortValue) {
                        case 'a-z':
                            return titleA.localeCompare(titleB);
                        case 'z-a':
                            return titleB.localeCompare(titleA);
                        case 'oldest':
                            return dateA - dateB;
                        case 'newest':
                        default:
                            return dateB - dateA;
                    }
                });

                items.forEach(function(item) {
                    container.appendChild(item);
                });
            }

            if (lessonSearch) {
                let searchTimeout;
                lessonSearch.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(filterLessons, 300);
                });
            }

            if (sortLessons) {
                sortLessons.addEventListener('change', function() {
                    sortLessonsFunction();
                });
            }

            if (viewToggle) {
                viewToggle.addEventListener('click', function() {
                    const container = document.querySelector('.row.g-4');
                    if (!container) return;

                    if (currentView === 'grid') {
                        container.className = 'row row-cols-1 g-4';
                        currentView = 'list';
                        this.innerHTML = '<i class="fas fa-th" aria-hidden="true"></i>';
                    } else {
                        container.className =
                            'row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4';
                        currentView = 'grid';
                        this.innerHTML = '<i class="fas fa-th-large" aria-hidden="true"></i>';
                    }
                });
            }

            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    scrollTopBtn?.classList.add('show');
                } else {
                    scrollTopBtn?.classList.remove('show');
                }
            });

            scrollTopBtn?.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            document.querySelectorAll('.bookmark-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const icon = this.querySelector('i');

                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.add('bookmarked');
                        showToast('Lesson bookmarked successfully!', 'success');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('bookmarked');
                        showToast('Bookmark removed', 'info');
                    }
                });
            });

            function showToast(message, type = 'info') {
                const existingToasts = document.querySelectorAll('.toast');
                existingToasts.forEach(function(toast) {
                    toast.remove();
                });

                const container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);

                const toast = document.createElement('div');
                toast.className = 'toast toast-' + type;
                const icons = {
                    success: 'fa-check-circle',
                    error: 'fa-exclamation-circle',
                    warning: 'fa-exclamation-triangle',
                    info: 'fa-info-circle'
                };
                toast.innerHTML = `
                    <div class="toast-content">
                        <i class="fas ${icons[type] || icons.info}" aria-hidden="true"></i>
                        <span>${message}</span>
                    </div>
                    <button class="toast-close" aria-label="Close notification">&times;</button>
                `;
                container.appendChild(toast);

                const closeBtn = toast.querySelector('.toast-close');
                closeBtn.addEventListener('click', function() {
                    toast.remove();
                });

                setTimeout(function() {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.transition = 'all 0.3s ease';
                    setTimeout(function() {
                        toast.remove();
                    }, 300);
                }, 4000);
            }

            document.querySelectorAll('.lesson-card-link').forEach(function(link) {
                link.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {
                passive: true
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    const items = document.querySelectorAll('.lesson-item:not([style*="display: none"])');
                    if (items.length === 0) return;

                    let currentIndex = -1;
                    items.forEach(function(item, index) {
                        if (item.querySelector('.lesson-card-link:focus')) {
                            currentIndex = index;
                        }
                    });

                    if (currentIndex === -1) return;

                    let targetIndex;
                    if (diff > 0 && currentIndex < items.length - 1) {
                        targetIndex = currentIndex + 1;
                    } else if (diff < 0 && currentIndex > 0) {
                        targetIndex = currentIndex - 1;
                    } else {
                        return;
                    }

                    const targetLink = items[targetIndex].querySelector('.lesson-card-link');
                    if (targetLink) {
                        targetLink.focus();
                    }
                }
            }
        });
    </script>
@endpush

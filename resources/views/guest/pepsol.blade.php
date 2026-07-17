@extends('layouts.guest')

@section('content')
    <x-hero-section title="Pepsol <em></em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Pepsol Page']]" />

    <div class="container section-padding">
        <div class="row g-4">
            <div class="col-lg-3">
                <button type="button" class="filters-toggle" id="filtersToggle" aria-expanded="false"
                    aria-controls="filtersPanel">
                    <span><i class="fas fa-sliders-h" aria-hidden="true"></i> Filters</span>
                    <i class="fas fa-chevron-down toggle-caret" aria-hidden="true"></i>
                </button>

                <div class="sidebar-modern" id="filtersPanel">
                    <div class="sidebar-card">
                        <label for="searchInput" class="visually-hidden">Search lessons</label>
                        <div class="search-bar-modern">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input type="text" id="searchInput" placeholder="Search lessons..."
                                value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <h2 class="sidebar-title"><i class="fas fa-layer-group" aria-hidden="true"></i> Categories</h2>
                        <ul class="category-list-modern">
                            <li>
                                <a href="{{ route('pepsol.index', array_filter(array_merge(request()->only(['types', 'search', 'sort'])))) }}"
                                    class="category-link {{ !request('category') ? 'active' : '' }}"
                                    {{ !request('category') ? 'aria-current=page' : '' }}>
                                    All Categories
                                    <span class="category-badge">{{ $names->total() }}</span>
                                </a>
                            </li>
                            @forelse($categories ?? [] as $category)
                                <li>
                                    <a href="{{ route('pepsol.index', array_filter(array_merge(request()->only(['types', 'search', 'sort']), ['category' => $category->id]))) }}"
                                        class="category-link {{ request('category') == $category->id ? 'active' : '' }}"
                                        {{ request('category') == $category->id ? 'aria-current=page' : '' }}>
                                        {{ $category->name }}
                                        <span class="category-badge">{{ $category->pepsols_count ?? 0 }}</span>
                                    </a>
                                </li>
                            @empty
                                <li class="text-muted">No categories found</li>
                            @endforelse
                        </ul>
                    </div>

                    <fieldset class="sidebar-card">
                        <legend class="sidebar-title"><i class="fas fa-filter" aria-hidden="true"></i> Lesson Type</legend>
                        @forelse($types ?? [] as $type)
                            <div class="form-check mb-2">
                                <input class="form-check-input type-filter" type="checkbox" id="type{{ $type->id }}"
                                    value="{{ $type->id }}"
                                    {{ in_array($type->id, explode(',', request('types', ''))) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="type{{ $type->id }}">
                                    {{ $type->name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">No types available</p>
                        @endforelse
                    </fieldset>
                </div>
            </div>

            <div class="col-lg-9">
                <h2 class="visually-hidden">Pepsol modules</h2>

                <div class="toolbar-modern">
                    <div class="results-count" aria-live="polite">
                        Showing <span>{{ $names->count() }}</span> of <span>{{ $names->total() }}</span> modules
                    </div>
                    <div class="sort-wrap">
                        <label for="sortSelect" class="sort-label">Sort by</label>
                        <select class="sort-select" id="sortSelect">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>
                                Latest
                            </option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>
                                Title A-Z
                            </option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>
                                Title Z-A
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row g-4 results-grid">
                    @forelse($names ?? [] as $name)
                        <div class="col-sm-6 col-lg-4">
                            <a href="#" class="lesson-card-link">
                                <div class="lesson-card-modern">
                                    <div class="lesson-card-image-wrapper">
                                        <img src="{{ asset('Images/Pepsol/Name/' . $name->image) }}"
                                            class="lesson-card-image" alt="{{ $name->name }}" loading="lazy">
                                        <div class="lesson-card-overlay"></div>
                                        <span class="lesson-card-category-tag">
                                            {{ $name->code ?? 'Module' }}
                                        </span>
                                    </div>
                                    <div class="lesson-card-body-modern">
                                        <h3 class="lesson-card-title">{{ $name->name }}</h3>
                                        <p class="lesson-card-summary text-muted">
                                            {{ $name->lessons_count }} {{ Str::plural('lesson', $name->lessons_count) }}
                                            available
                                        </p>
                                        <div class="lesson-card-footer">
                                            <div class="lesson-card-meta">
                                                <span><i class="far fa-book-open" aria-hidden="true"></i>
                                                    {{ $name->lessons_count }}
                                                    {{ Str::plural('Lesson', $name->lessons_count) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state" role="status">
                                <div class="empty-state-icon">
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                </div>
                                <h3>No modules found</h3>
                                @if (request()->filled('search'))
                                    <p class="text-muted">
                                        We couldn't find anything matching
                                        "<strong>{{ request('search') }}</strong>".
                                        Try a different search term or clear your filters below.
                                    </p>
                                @else
                                    <p class="text-muted">
                                        No discipleship modules match the filters you've selected.
                                        Try adjusting or clearing them to see more results.
                                    </p>
                                @endif
                                <div class="empty-state-actions">
                                    <a href="{{ route('pepsol.index') }}" class="btn btn-primary">
                                        <i class="fas fa-sync-alt me-2" aria-hidden="true"></i>Reset all filters
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <nav class="mt-5 pagination-nav-slot" aria-label="Pagination">
                    @if (isset($names) && $names->hasPages())
                        <ul class="pagination pagination-modern justify-content-center">
                            {{ $names->appends(request()->query())->links() }}
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
    </div>

    <button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll to top">
        <i class="fas fa-arrow-up" aria-hidden="true"></i>
    </button>
@endsection

@push('styles')
    <style>
        #main-content {
            width: 100%;
            align-self: stretch;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #eef2ff;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --secondary: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --gray-50: #fafafa;
            --gray-100: #f4f4f5;
            --gray-200: #e4e4e7;
            --gray-300: #d4d4d8;
            --gray-600: #52525b;
            --gray-700: #3f3f46;
            --gray-800: #27272a;
            --gray-900: #18181b;
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.25rem;
            --radius-2xl: 1.5rem;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --focus-ring: 0 0 0 3px rgba(99, 102, 241, 0.35);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: linear-gradient(180deg, #fafafa 0%, #f4f4f5 100%);
            color: var(--gray-800);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        html {
            scroll-behavior: smooth;
        }

        .visually-hidden {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        a:focus-visible,
        button:focus-visible,
        input:focus-visible,
        select:focus-visible,
        .lesson-card-link:focus-visible .lesson-card-modern {
            outline: 2px solid var(--primary-dark);
            outline-offset: 2px;
            box-shadow: var(--focus-ring);
        }

        .section-padding {
            padding: 2rem 0 4rem;
        }

        .container {
            max-width: 1320px;
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1360px;
            }
        }

        .filters-toggle {
            display: none;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 0.875rem 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1rem;
            cursor: pointer;
        }

        .filters-toggle i {
            color: var(--primary);
        }

        .toggle-caret {
            transition: transform 0.2s ease;
        }

        .filters-toggle[aria-expanded="true"] .toggle-caret {
            transform: rotate(180deg);
        }

        .sidebar-modern {
            position: sticky;
            top: 100px;
        }

        .sidebar-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            margin-bottom: 1.5rem;
            border: 1px solid rgba(99, 102, 241, 0.08);
            transition: var(--transition);
        }

        fieldset.sidebar-card {
            border: 1px solid rgba(99, 102, 241, 0.08);
        }

        .sidebar-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .sidebar-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0;
        }

        .sidebar-title i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .category-list-modern {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list-modern li {
            margin-bottom: 0.4rem;
        }

        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.875rem 1rem;
            border-radius: var(--radius-md);
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            background: transparent;
            border: 1px solid transparent;
            min-height: 44px;
        }

        .category-link:hover,
        .category-link.active {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-color: rgba(99, 102, 241, 0.2);
            font-weight: 600;
        }

        .category-badge {
            background: var(--gray-100);
            color: var(--gray-600);
            border-radius: 2rem;
            padding: 0.2rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .category-link:hover .category-badge,
        .category-link.active .category-badge {
            background: white;
            color: var(--primary-dark);
        }

        .search-bar-modern {
            position: relative;
            margin-bottom: 0;
        }

        .search-bar-modern input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xl);
            font-size: 1rem;
            font-weight: 500;
            transition: var(--transition);
            background: white;
            min-height: 44px;
        }

        .search-bar-modern input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: var(--focus-ring);
        }

        .search-bar-modern i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        .form-check-input.type-filter {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.15em;
            cursor: pointer;
        }

        .form-check-input.type-filter:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            cursor: pointer;
            padding: 0.25rem 0;
        }

        .toolbar-modern {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .results-count {
            color: var(--gray-600);
            font-weight: 500;
        }

        .results-count span {
            font-weight: 700;
            color: var(--primary-dark);
        }

        .sort-wrap {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .sort-label {
            font-weight: 500;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .sort-select {
            padding: 0.6rem 2rem 0.6rem 1rem;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            background: white;
            font-weight: 500;
            color: var(--gray-700);
            cursor: pointer;
            transition: var(--transition);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2352525b' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            min-height: 44px;
        }

        .sort-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: var(--focus-ring);
        }

        .results-grid {
            align-items: start;
            min-height: 400px;
        }

        .pagination-nav-slot {
            min-height: 60px;
        }

        .lesson-card-link {
            text-decoration: none;
            display: block;
            border-radius: var(--radius-xl);
        }

        .lesson-card-modern {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(99, 102, 241, 0.06);
            cursor: pointer;
            position: relative;
        }

        .lesson-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .lesson-card-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .lesson-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .lesson-card-modern:hover .lesson-card-image {
            transform: scale(1.05);
        }

        .lesson-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 60%, rgba(0, 0, 0, 0.7) 100%);
        }

        .lesson-card-category-tag {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.3rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary-dark);
            z-index: 2;
        }

        .lesson-card-body-modern {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .lesson-card-title {
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            color: var(--gray-900);
            line-height: 1.4;
        }

        .lesson-card-summary {
            color: var(--gray-600);
            font-size: 0.875rem;
            line-height: 1.6;
            flex: 1;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .lesson-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-100);
        }

        .lesson-card-meta {
            display: flex;
            gap: 0.75rem;
            font-size: 0.8rem;
            color: var(--gray-600);
        }

        .lesson-card-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            max-width: 480px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .empty-state-icon {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .empty-state-icon i {
            font-size: 2.25rem;
            color: var(--primary);
        }

        .empty-state h3 {
            font-weight: 700;
            font-size: 1.35rem;
            color: var(--gray-900);
            margin-bottom: 0.6rem;
        }

        .empty-state p {
            color: var(--gray-600);
            line-height: 1.7;
            margin-bottom: 1.75rem;
        }

        .empty-state p strong {
            color: var(--gray-800);
        }

        .empty-state-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .empty-state .btn-primary {
            background: var(--primary-gradient);
            border: none;
            min-height: 44px;
            padding: 0.7rem 1.75rem;
            border-radius: var(--radius-lg);
            font-weight: 600;
            transition: var(--transition);
        }

        .empty-state .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .pagination-modern {
            gap: 0.3rem;
            flex-wrap: wrap;
        }

        .pagination-modern .page-link {
            border: none;
            border-radius: var(--radius-md) !important;
            padding: 0.6rem 1rem;
            color: var(--gray-700);
            font-weight: 500;
            transition: var(--transition);
            background: white;
            box-shadow: var(--shadow-sm);
            min-width: 44px;
            min-height: 44px;
        }

        .pagination-modern .page-link:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .pagination-modern .active .page-link {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .scroll-top-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 48px;
            height: 48px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(99, 102, 241, 0.4);
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .lesson-card-image-wrapper {
                height: 180px;
            }

            .lesson-card-body-modern {
                padding: 1.25rem;
            }
        }

        @media (max-width: 991.98px) {
            .filters-toggle {
                display: flex;
            }

            .sidebar-modern {
                position: static;
                display: none;
            }

            .sidebar-modern.open {
                display: block;
            }

            .col-lg-9 {
                margin-top: 0.25rem;
            }
        }

        @media (max-width: 767.98px) {
            .section-padding {
                padding: 1.25rem 0 2.5rem;
            }

            .toolbar-modern {
                align-items: stretch;
            }

            .sort-wrap {
                justify-content: space-between;
            }

            .lesson-card-image-wrapper {
                height: 170px;
            }

            .results-count {
                text-align: center;
            }

            .scroll-top-btn {
                bottom: 1.25rem;
                right: 1.25rem;
            }

            .empty-state {
                padding: 3rem 1.25rem;
            }
        }

        @media (max-width: 575.98px) {
            .filters-toggle {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .sidebar-card {
                padding: 1.25rem;
            }

            .lesson-card-body-modern {
                padding: 1.1rem;
            }

            .lesson-card-title {
                font-size: 1.05rem;
            }

            .toolbar-modern {
                gap: 0.75rem;
            }

            .sort-wrap {
                width: 100%;
            }

            .sort-select {
                flex: 1;
            }

            .empty-state-icon {
                width: 72px;
                height: 72px;
            }

            .empty-state-icon i {
                font-size: 1.85rem;
            }

            .empty-state h3 {
                font-size: 1.2rem;
            }

            .scroll-top-btn {
                width: 44px;
                height: 44px;
                bottom: 1rem;
                right: 1rem;
            }
        }

        @media (max-width: 380px) {
            .lesson-card-image-wrapper {
                height: 150px;
            }

            .lesson-card-summary {
                display: none;
            }

            .hero-section,
            .breadcrumb {
                font-size: 0.9rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }

            .lesson-card-modern:hover {
                transform: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            if (scrollTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 500) {
                        scrollTopBtn.classList.add('visible');
                    } else {
                        scrollTopBtn.classList.remove('visible');
                    }
                });

                scrollTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            const filtersToggle = document.getElementById('filtersToggle');
            const filtersPanel = document.getElementById('filtersPanel');
            if (filtersToggle && filtersPanel) {
                filtersToggle.addEventListener('click', function() {
                    const isOpen = filtersPanel.classList.toggle('open');
                    filtersToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }

            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        const searchTerm = this.value;
                        const currentUrl = new URL(window.location.href);
                        if (searchTerm) {
                            currentUrl.searchParams.set('search', searchTerm);
                        } else {
                            currentUrl.searchParams.delete('search');
                        }
                        currentUrl.searchParams.delete('page');
                        window.location.href = currentUrl.toString();
                    }, 500);
                });
            }

            document.querySelectorAll('.type-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const currentUrl = new URL(window.location.href);
                    const selectedTypes = Array.from(document.querySelectorAll(
                            '.type-filter:checked'))
                        .map(cb => cb.value);

                    if (selectedTypes.length > 0) {
                        currentUrl.searchParams.set('types', selectedTypes.join(','));
                    } else {
                        currentUrl.searchParams.delete('types');
                    }
                    currentUrl.searchParams.delete('page');
                    window.location.href = currentUrl.toString();
                });
            });

            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('sort', this.value);
                    currentUrl.searchParams.delete('page');
                    window.location.href = currentUrl.toString();
                });
            }
        });
    </script>
@endpush

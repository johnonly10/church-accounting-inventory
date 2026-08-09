@extends('layouts.guest')

@section('content')
    <x-hero-section title="Pepsol <em></em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Pepsol Page']]" />

    <a href="#main-content" class="skip-to-content">Skip to main content</a>

    <main id="main-content" class="container section-padding">
        <div class="row g-4">
            <aside class="col-lg-3" aria-label="Filters sidebar">
                <div class="active-filters" id="activeFilters" style="display: none;">
                    <div class="active-filters-header">
                        <span>Active Filters</span>
                        <button type="button" class="clear-all-filters" id="clearAllFilters">
                            <i class="fas fa-times" aria-hidden="true"></i> Clear All
                        </button>
                    </div>
                    <div class="active-filters-list" id="activeFiltersList"></div>
                </div>

                <button type="button" class="filters-toggle" id="filtersToggle" aria-expanded="false"
                    aria-controls="filtersPanel">
                    <span><i class="fas fa-sliders-h" aria-hidden="true"></i> Filters</span>
                    <i class="fas fa-chevron-down toggle-caret" aria-hidden="true"></i>
                </button>

                <div class="sidebar-modern" id="filtersPanel" role="search">
                    <section class="sidebar-card" aria-label="Search lessons">
                        <label for="searchInput" class="visually-hidden">Search lessons</label>
                        <div class="search-bar-modern">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input type="text" id="searchInput" placeholder="Search lessons..."
                                value="{{ request('search') }}" autocomplete="off">
                            <button type="button" class="search-clear-btn" id="searchClearBtn"
                                style="display: {{ request('search') ? 'flex' : 'none' }};" aria-label="Clear search">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </button>
                            <div class="search-spinner" id="searchSpinner" style="display: none;">
                                <i class="fas fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                        </div>
                    </section>

                    <section class="sidebar-card" aria-label="Lesson categories">
                        <h2 class="sidebar-title"><i class="fas fa-layer-group" aria-hidden="true"></i> Categories</h2>
                        <nav aria-label="Category navigation">
                            <ul class="category-list-modern">
                                <li>
                                    <a href="{{ route('pepsol.index', array_filter(array_merge(request()->only(['types', 'search', 'sort'])))) }}"
                                        class="category-link {{ !request('category') ? 'active' : '' }}"
                                        {{ !request('category') ? 'aria-current=page' : '' }} data-category="all">
                                        All Categories
                                        <span class="category-badge">{{ $names->total() }}</span>
                                    </a>
                                </li>
                                @forelse($categories ?? [] as $category)
                                    <li>
                                        <a href="{{ route('pepsol.index', array_filter(array_merge(request()->only(['types', 'search', 'sort']), ['category' => $category->id]))) }}"
                                            class="category-link {{ request('category') == $category->id ? 'active' : '' }}"
                                            {{ request('category') == $category->id ? 'aria-current=page' : '' }}
                                            data-category="{{ $category->id }}">
                                            {{ $category->name }}
                                            <span class="category-badge">{{ $category->pepsols_count ?? 0 }}</span>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-muted">No categories found</li>
                                @endforelse
                            </ul>
                        </nav>
                    </section>

                    <section class="sidebar-card" aria-label="Filter by lesson type">
                        <h2 class="sidebar-title"><i class="fas fa-filter" aria-hidden="true"></i> Lesson Type</h2>
                        <fieldset>
                            <legend class="visually-hidden">Select lesson types to filter</legend>
                            @forelse($types ?? [] as $type)
                                <div class="form-check mb-2">
                                    <input class="form-check-input type-filter" type="checkbox"
                                        id="type{{ $type->id }}" value="{{ $type->id }}"
                                        {{ in_array($type->id, explode(',', request('types', ''))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type{{ $type->id }}">
                                        {{ $type->name }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted">No types available</p>
                            @endforelse
                        </fieldset>
                    </section>

                    <button type="button" class="btn btn-outline-primary w-100 mt-2 close-filters-mobile"
                        id="closeFiltersMobile">
                        <i class="fas fa-check me-2" aria-hidden="true"></i> Apply Filters
                    </button>
                </div>
            </aside>

            <section class="col-lg-9" aria-label="Pepsol modules listing">
                <div class="loading-overlay" id="loadingOverlay" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <header class="toolbar-modern">
                    <div class="results-count" aria-live="polite" aria-atomic="true">
                        Showing <span>{{ $names->count() }}</span> of <span>{{ $names->total() }}</span> modules
                    </div>
                    <div class="sort-wrap">
                        <label for="sortSelect" class="sort-label">Sort by</label>
                        <select class="sort-select" id="sortSelect" aria-label="Sort modules by">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>
                                Latest
                            </option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>
                                Title A-Z
                            </option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>
                                Title Z-A
                            </option>
                            {{-- <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                                Most Popular
                            </option> --}}
                        </select>
                    </div>
                </header>

                <div class="row g-4 results-grid" role="list" aria-label="Pepsol modules">
                    @forelse($names ?? [] as $name)
                        <article class="col-sm-6 col-lg-4" role="listitem">
                            <a href="{{ route('pepsol.lessons', $name) }}" class="lesson-card-link"
                                aria-label="View module: {{ $name->name }}">
                                <div class="lesson-card-modern">
                                    <figure class="lesson-card-image-wrapper">
                                        <img src="{{ asset('Images/Pepsol/Name/' . $name->image) }}"
                                            class="lesson-card-image" alt="{{ $name->name }}" loading="lazy"
                                            width="400" height="200">
                                        <figcaption class="lesson-card-overlay" aria-hidden="true"></figcaption>
                                        <span class="lesson-card-category-tag">
                                            {{ $name->code ?? 'Module' }}
                                        </span>
                                    </figure>
                                    <div class="lesson-card-body-modern">
                                        <h3 class="lesson-card-title">{{ $name->name }}</h3>
                                        <p class="lesson-card-summary text-muted">
                                            {{ $name->lessons_count }} {{ Str::plural('lesson', $name->lessons_count) }}
                                            available
                                        </p>
                                        <footer class="lesson-card-footer">
                                            <div class="lesson-card-meta">
                                                <span>
                                                    <i class="far fa-book-open" aria-hidden="true"></i>
                                                    {{ $name->lessons_count }}
                                                    {{ Str::plural('Lesson', $name->lessons_count) }}
                                                </span>
                                                @if (isset($name->difficulty))
                                                    <span>
                                                        <i class="fas fa-signal" aria-hidden="true"></i>
                                                        {{ $name->difficulty }}
                                                    </span>
                                                @endif
                                                @if (isset($name->duration))
                                                    <span>
                                                        <i class="far fa-clock" aria-hidden="true"></i>
                                                        {{ $name->duration }}
                                                    </span>
                                                @endif
                                            </div>
                                        </footer>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="col-12">
                            <div class="empty-state" role="alert">
                                <div class="empty-state-icon">
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                </div>
                                <h2>No modules found</h2>
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
                                    @if (isset($suggestedModules) && count($suggestedModules) > 0)
                                        <div class="suggested-modules mt-4">
                                            <h3>You might be interested in</h3>
                                            <div class="row g-3 mt-2">
                                                @foreach ($suggestedModules as $suggested)
                                                    <div class="col-6">
                                                        <a href="{{ route('pepsol.lessons', $suggested) }}"
                                                            class="suggested-link">
                                                            <i class="fas fa-arrow-right me-2"></i>
                                                            {{ $suggested->name }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="skeleton-grid" id="skeletonGrid" style="display: none;">
                    <div class="row g-4">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="col-sm-6 col-lg-4">
                                <div class="skeleton-card">
                                    <div class="skeleton-image"></div>
                                    <div class="skeleton-body">
                                        <div class="skeleton-line skeleton-title"></div>
                                        <div class="skeleton-line skeleton-text"></div>
                                        <div class="skeleton-line skeleton-text short"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <footer class="mt-5 pagination-nav-slot">
                    @if (isset($names) && $names->hasPages())
                        <nav aria-label="Pagination navigation">
                            <ul class="pagination pagination-modern justify-content-center">
                                @if ($names->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-disabled="true">
                                            <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $names->previousPageUrl() }}" rel="prev">
                                            <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($names->getUrlRange(1, $names->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $names->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($names->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $names->nextPageUrl() }}" rel="next">
                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-disabled="true">
                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </footer>
            </section>
        </div>
    </main>

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

        .skip-to-content {
            position: absolute;
            top: -100%;
            left: 0;
            background: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            z-index: 10000;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0 0 var(--radius-md) 0;
            transition: top 0.2s ease;
        }

        .skip-to-content:focus {
            top: 0;
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

        @media (prefers-contrast: high) {

            a:focus-visible,
            button:focus-visible,
            input:focus-visible,
            select:focus-visible {
                outline: 3px solid #000;
                outline-offset: 3px;
            }
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

        .active-filters {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
        }

        .active-filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--gray-800);
            font-size: 0.9rem;
        }

        .clear-all-filters {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .clear-all-filters:hover {
            background: #fef2f2;
        }

        .active-filters-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-chip {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.35rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .filter-chip button {
            background: none;
            border: none;
            color: var(--primary-dark);
            cursor: pointer;
            padding: 0;
            font-size: 0.8rem;
            line-height: 1;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition);
        }

        .filter-chip button:hover {
            background: rgba(99, 102, 241, 0.2);
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
            min-height: 48px;
        }

        .filters-toggle i {
            color: var(--primary);
        }

        .filters-toggle:active {
            transform: scale(0.98);
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
            min-height: 48px;
            position: relative;
        }

        .category-link:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-color: rgba(99, 102, 241, 0.2);
            font-weight: 600;
        }

        .category-link.active {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-color: rgba(99, 102, 241, 0.2);
            font-weight: 600;
        }

        .category-link:active {
            transform: scale(0.98);
        }

        .category-badge {
            background: var(--gray-100);
            color: var(--gray-600);
            border-radius: 2rem;
            padding: 0.2rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
            min-width: 24px;
            text-align: center;
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
            padding: 0.875rem 3rem 0.875rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xl);
            font-size: 1rem;
            font-weight: 500;
            transition: var(--transition);
            background: white;
            min-height: 48px;
        }

        .search-bar-modern input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: var(--focus-ring);
        }

        .search-bar-modern>i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .search-clear-btn {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gray-200);
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--gray-600);
            transition: var(--transition);
        }

        .search-clear-btn:hover {
            background: var(--gray-300);
            color: var(--gray-800);
        }

        .search-spinner {
            position: absolute;
            right: 3.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }

        .form-check.mb-2 {
            display: flex;
            align-items: center;
            min-height: 44px;
            padding-left: 0;
            margin-bottom: 0.5rem !important;
        }

        .form-check-input.type-filter {
            width: 1.2em;
            height: 1.2em;
            margin: 0;
            cursor: pointer;
            min-width: 20px;
            min-height: 20px;
            flex-shrink: 0;
        }

        .form-check-input.type-filter:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            cursor: pointer;
            padding: 0;
            margin-left: 0.75rem;
            min-height: 44px;
            display: flex;
            align-items: center;
            font-weight: 500;
            color: var(--gray-700);
            flex: 1;
        }

        .form-check-label:hover {
            color: var(--primary-dark);
        }

        .close-filters-mobile {
            display: none;
            min-height: 48px;
            font-weight: 600;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
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
            min-height: 48px;
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

        .skeleton-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(99, 102, 241, 0.06);
        }

        .skeleton-image {
            height: 200px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .skeleton-body {
            padding: 1.5rem;
        }

        .skeleton-line {
            height: 12px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: var(--radius-sm);
            margin-bottom: 0.75rem;
        }

        .skeleton-title {
            width: 70%;
            height: 20px;
        }

        .skeleton-text {
            width: 90%;
        }

        .skeleton-text.short {
            width: 50%;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
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

        .lesson-card-modern:active {
            transform: translateY(-4px);
        }

        .lesson-card-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: var(--gray-100);
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
            padding: 0.4rem 0.9rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary-dark);
            z-index: 2;
            min-height: 28px;
            display: flex;
            align-items: center;
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
            flex-wrap: wrap;
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

        .empty-state h2 {
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
            flex-direction: column;
            gap: 0.75rem;
            width: 100%;
        }

        .empty-state .btn-primary {
            background: var(--primary-gradient);
            border: none;
            min-height: 48px;
            padding: 0.7rem 1.75rem;
            border-radius: var(--radius-lg);
            font-weight: 600;
            transition: var(--transition);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .empty-state .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .suggested-modules {
            text-align: left;
            width: 100%;
        }

        .suggested-modules h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.75rem;
        }

        .suggested-link {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .suggested-link:hover {
            background: var(--primary-light);
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
            min-width: 48px;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .pagination-modern .disabled .page-link {
            color: var(--gray-300);
            cursor: not-allowed;
            box-shadow: none;
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
            min-width: 48px;
            min-height: 48px;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(99, 102, 241, 0.4);
        }

        .scroll-top-btn:active {
            transform: translateY(-1px);
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

            .close-filters-mobile {
                display: block;
            }

            .sidebar-modern {
                position: static;
                display: none;
            }

            .sidebar-modern.open {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: white;
                z-index: 1050;
                overflow-y: auto;
                padding: 1.5rem;
            }

            .col-lg-9 {
                margin-top: 0.25rem;
            }

            .active-filters {
                display: none;
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

            .empty-state h2 {
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

            .skeleton-image,
            .skeleton-line {
                animation: none;
                background: #f0f0f0;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            if (scrollTopBtn) {
                const handleScroll = () => {
                    if (window.scrollY > 500) {
                        scrollTopBtn.classList.add('visible');
                    } else {
                        scrollTopBtn.classList.remove('visible');
                    }
                };

                window.addEventListener('scroll', handleScroll, {
                    passive: true
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
            const closeFiltersMobile = document.getElementById('closeFiltersMobile');

            if (filtersToggle && filtersPanel) {
                filtersToggle.addEventListener('click', function() {
                    const isOpen = !filtersPanel.classList.contains('open');
                    filtersPanel.classList.toggle('open');
                    filtersToggle.setAttribute('aria-expanded', isOpen);

                    if (isOpen && window.innerWidth <= 991.98) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                });

                if (closeFiltersMobile) {
                    closeFiltersMobile.addEventListener('click', function() {
                        filtersPanel.classList.remove('open');
                        filtersToggle.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && filtersPanel.classList.contains('open') && window
                        .innerWidth <= 991.98) {
                        filtersPanel.classList.remove('open');
                        filtersToggle.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                        filtersToggle.focus();
                    }
                });
            }

            function updateActiveFilters() {
                const activeFiltersList = document.getElementById('activeFiltersList');
                const activeFiltersContainer = document.getElementById('activeFilters');

                if (!activeFiltersList || !activeFiltersContainer) return;

                const chips = [];
                const searchTerm = document.getElementById('searchInput')?.value;
                const checkedTypes = Array.from(document.querySelectorAll('.type-filter:checked'));
                const activeCategory = document.querySelector('.category-link.active');

                if (searchTerm) {
                    chips.push({
                        label: `Search: ${searchTerm}`,
                        clearId: 'search'
                    });
                }

                if (activeCategory && activeCategory.dataset.category !== 'all') {
                    chips.push({
                        label: `Category: ${activeCategory.textContent.trim().split(' ')[0]}`,
                        clearId: 'category'
                    });
                }

                checkedTypes.forEach(checkbox => {
                    const label = document.querySelector(`label[for="${checkbox.id}"]`);
                    if (label) {
                        chips.push({
                            label: label.textContent.trim(),
                            clearId: `type${checkbox.value}`
                        });
                    }
                });

                if (chips.length > 0) {
                    activeFiltersContainer.style.display = 'block';
                    activeFiltersList.innerHTML = chips.map(chip => `
                        <span class="filter-chip">
                            ${chip.label}
                            <button type="button" data-clear="${chip.clearId}" aria-label="Remove ${chip.label} filter">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </button>
                        </span>
                    `).join('');

                    document.querySelectorAll('.filter-chip button').forEach(button => {
                        button.addEventListener('click', function() {
                            const clearId = this.dataset.clear;
                            if (clearId === 'search') {
                                document.getElementById('searchInput').value = '';
                                document.getElementById('searchClearBtn').style.display = 'none';
                                navigateWithParams({
                                    search: null
                                });
                            } else if (clearId === 'category') {
                                navigateToUrl(document.querySelector(
                                    '.category-link[data-category="all"]').href);
                            } else if (clearId.startsWith('type')) {
                                const typeId = clearId.replace('type', '');
                                const checkbox = document.getElementById(`type${typeId}`);
                                if (checkbox) {
                                    checkbox.checked = false;
                                    updateTypeFilters();
                                }
                            }
                        });
                    });

                    document.getElementById('clearAllFilters').onclick = function() {
                        window.location.href = '{{ route('pepsol.index') }}';
                    };
                } else {
                    activeFiltersContainer.style.display = 'none';
                }
            }

            function showLoading() {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.style.display = 'flex';
                }
            }

            function hideLoading() {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.style.display = 'none';
                }
            }

            function navigateWithParams(params) {
                showLoading();
                const currentUrl = new URL(window.location.href);

                Object.keys(params).forEach(key => {
                    if (params[key] === null || params[key] === '') {
                        currentUrl.searchParams.delete(key);
                    } else {
                        currentUrl.searchParams.set(key, params[key]);
                    }
                });

                currentUrl.searchParams.delete('page');

                const resultsGrid = document.querySelector('.results-grid');
                const skeletonGrid = document.getElementById('skeletonGrid');
                if (resultsGrid && skeletonGrid) {
                    resultsGrid.style.display = 'none';
                    skeletonGrid.style.display = 'block';
                }

                window.location.href = currentUrl.toString();
            }

            function navigateToUrl(url) {
                showLoading();
                const resultsGrid = document.querySelector('.results-grid');
                const skeletonGrid = document.getElementById('skeletonGrid');
                if (resultsGrid && skeletonGrid) {
                    resultsGrid.style.display = 'none';
                    skeletonGrid.style.display = 'block';
                }
                window.location.href = url;
            }

            function updateTypeFilters() {
                const checkedTypes = Array.from(document.querySelectorAll('.type-filter:checked'))
                    .map(cb => cb.value);

                navigateWithParams({
                    types: checkedTypes.length > 0 ? checkedTypes.join(',') : null
                });
            }

            const searchInput = document.getElementById('searchInput');
            const searchClearBtn = document.getElementById('searchClearBtn');
            const searchSpinner = document.getElementById('searchSpinner');

            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value;

                    if (searchClearBtn) {
                        searchClearBtn.style.display = searchTerm ? 'flex' : 'none';
                    }

                    if (searchSpinner) {
                        searchSpinner.style.display = 'block';
                    }

                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        navigateWithParams({
                            search: searchTerm || null
                        });
                    }, 500);
                });

                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        this.value = '';
                        if (searchClearBtn) searchClearBtn.style.display = 'none';
                        navigateWithParams({
                            search: null
                        });
                        this.blur();
                    }
                });
            }

            if (searchClearBtn) {
                searchClearBtn.addEventListener('click', function() {
                    if (searchInput) {
                        searchInput.value = '';
                        searchClearBtn.style.display = 'none';
                        searchInput.focus();
                        navigateWithParams({
                            search: null
                        });
                    }
                });
            }

            document.querySelectorAll('.type-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTypeFilters();
                });
            });

            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    navigateWithParams({
                        sort: this.value
                    });
                });
            }

            document.querySelectorAll('.category-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    navigateToUrl(this.href);
                });
            });

            updateActiveFilters();

            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    hideLoading();
                    const skeletonGrid = document.getElementById('skeletonGrid');
                    const resultsGrid = document.querySelector('.results-grid');
                    if (skeletonGrid) skeletonGrid.style.display = 'none';
                    if (resultsGrid) resultsGrid.style.display = '';
                }
            });

            window.addEventListener('error', function(e) {
                hideLoading();
                const skeletonGrid = document.getElementById('skeletonGrid');
                const resultsGrid = document.querySelector('.results-grid');
                if (skeletonGrid) skeletonGrid.style.display = 'none';
                if (resultsGrid) resultsGrid.style.display = '';
            });
        });
    </script>
@endpush

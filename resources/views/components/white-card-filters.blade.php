@props([
    'searchPlaceholder' => '',
    'searchName' => 'search',
    'searchValue' => request('search'),
    'dateFromLabel' => '',
    'dateFromName' => 'date_from',
    ($dateFromValue = null),
    'dateToLabel' => '',
    'dateToName' => 'date_to',
    ($dateToValue = null),
    'filter1Label' => null,
    'filter1Name' => 'filter1',
    'filter1Value' => null,
    'filter1Options' => [],
    'filter2Label' => null,
    'filter2Name' => 'filter2',
    'filter2Value' => null,
    'filter2Options' => [],
    'filter3Label' => null,
    'filter3Name' => 'filter3',
    'filter3Value' => null,
    'filter3Options' => [],
    'filter4Label' => null,
    'filter4Name' => 'filter4',
    'filter4Value' => null,
    'filter4Options' => [],
    'resultsContainerId' => 'filter-results-container',
])

@php
    $searchValue = $searchValue ?? request()->get($searchName, '');
    $dateFromValue = $dateFromValue ?? request()->get($dateFromName, '');
    $dateToValue = $dateToValue ?? request()->get($dateToName, '');
    $filter1Value = $filter1Value ?? request()->get($filter1Name, '');
    $filter2Value = $filter2Value ?? request()->get($filter2Name, '');
    $filter3Value = $filter3Value ?? request()->get($filter3Name, '');
    $filter4Value = $filter4Value ?? request()->get($filter4Name, '');

    $hasActiveFilters =
        $searchValue ||
        $dateFromValue ||
        $dateToValue ||
        $filter1Value ||
        $filter2Value ||
        $filter3Value ||
        $filter4Value;
    $activeFiltersCount = collect([
        $searchValue,
        $dateFromValue,
        $dateToValue,
        $filter1Value,
        $filter2Value,
        $filter3Value,
        $filter4Value,
    ])
        ->filter()
        ->count();
@endphp

<div class="filters-container-dropdown">
    <div class="filters-header">
        <button type="button" class="filters-toggle-btn" id="filtersToggleBtn" onclick="toggleFiltersDropdown()">
            <div class="toggle-btn-content">
                <i class="fas fa-sliders-h toggle-icon-left"></i>
                <span class="toggle-text">Filters</span>
                @if ($hasActiveFilters)
                    <span class="active-filters-badge" id="activeFiltersBadge">{{ $activeFiltersCount }}</span>
                @endif
            </div>
            <i class="fas fa-chevron-down toggle-icon-right" id="toggleIconRight"></i>
        </button>

        @if ($hasActiveFilters)
            <button type="button" class="quick-clear-btn" onclick="clearAllFiltersAjax()" title="Clear all filters">
                <i class="fas fa-times-circle"></i>
                <span>Clear All</span>
            </button>
        @endif
    </div>

    <!-- REMOVED the 'show' class to hide by default -->
    <div class="filters-dropdown-panel" id="filtersDropdownPanel">
        <form id="filterForm" method="GET" class="filter-form">
            <div class="filters-grid">
                @if (!empty($searchPlaceholder))
                    <div class="filter-item search-item">
                        <label class="filter-label">
                            <i class="fas fa-search label-icon"></i>
                            Search
                        </label>
                        <div class="search-input-wrapper">
                            <input type="text" name="{{ $searchName }}" id="search-input"
                                class="form-control search-input" placeholder="{{ $searchPlaceholder }}"
                                value="{{ $searchValue }}" autocomplete="off">
                            @if ($searchValue)
                                <button type="button" class="clear-input-btn"
                                    onclick="clearSearchAjax('{{ $searchName }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

                @if (!empty($dateFromLabel))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-calendar-alt label-icon"></i>
                            {{ $dateFromLabel }}
                        </label>
                        <div class="date-input-wrapper">
                            <input type="date" name="{{ $dateFromName }}" id="dateFromInput"
                                class="form-control date-input ajax-filter" value="{{ $dateFromValue }}"
                                max="{{ $dateToValue ? $dateToValue : '' }}">
                            @if ($dateFromValue)
                                <button type="button" class="clear-input-btn"
                                    onclick="clearSearchAjax('{{ $dateFromName }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                        <div class="date-error-message" id="dateFromError" style="display: none;"></div>
                    </div>
                @endif

                @if (!empty($dateToLabel))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-calendar-alt label-icon"></i>
                            {{ $dateToLabel }}
                        </label>
                        <div class="date-input-wrapper">
                            <input type="date" name="{{ $dateToName }}" id="dateToInput"
                                class="form-control date-input ajax-filter" value="{{ $dateToValue }}"
                                min="{{ $dateFromValue ? $dateFromValue : '' }}">
                            @if ($dateToValue)
                                <button type="button" class="clear-input-btn"
                                    onclick="clearSearchAjax('{{ $dateToName }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                        <div class="date-error-message" id="dateToError" style="display: none;"></div>
                    </div>
                @endif

                @if ($filter1Label && !empty($filter1Options))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-filter label-icon"></i>
                            {{ $filter1Label }}
                        </label>
                        <select name="{{ $filter1Name }}" class="form-select filter-select ajax-filter">
                            <option value="">All {{ $filter1Label }}</option>
                            @foreach ($filter1Options as $key => $value)
                                <option value="{{ $key }}" {{ $filter1Value == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($filter2Label && !empty($filter2Options))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-filter label-icon"></i>
                            {{ $filter2Label }}
                        </label>
                        <select name="{{ $filter2Name }}" class="form-select filter-select ajax-filter">
                            <option value="">All {{ $filter2Label }}</option>
                            @foreach ($filter2Options as $key => $value)
                                <option value="{{ $key }}" {{ $filter2Value == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($filter3Label && !empty($filter3Options))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-filter label-icon"></i>
                            {{ $filter3Label }}
                        </label>
                        <select name="{{ $filter3Name }}" class="form-select filter-select ajax-filter">
                            <option value="">All {{ $filter3Label }}</option>
                            @foreach ($filter3Options as $key => $value)
                                <option value="{{ $key }}" {{ $filter3Value == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($filter4Label && !empty($filter4Options))
                    <div class="filter-item">
                        <label class="filter-label">
                            <i class="fas fa-filter label-icon"></i>
                            {{ $filter4Label }}
                        </label>
                        <select name="{{ $filter4Name }}" class="form-select filter-select ajax-filter">
                            <option value="">All {{ $filter4Label }}</option>
                            @foreach ($filter4Options as $key => $value)
                                <option value="{{ $key }}" {{ $filter4Value == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="filters-actions">
                <div class="filters-info">
                    @if ($hasActiveFilters)
                        <span class="active-count" id="filterStatusText">{{ $activeFiltersCount }} filter(s)
                            active</span>
                    @else
                        <span class="no-filters" id="filterStatusText">No filters applied</span>
                    @endif
                </div>
                @if ($hasActiveFilters)
                    <button type="button" class="btn-reset-filters" onclick="clearAllFiltersAjax()">
                        <i class="fas fa-redo-alt"></i>
                        Reset All Filters
                    </button>
                @endif
            </div>
        </form>
    </div>

    <div class="filter-loading-overlay" id="filterLoadingOverlay">
        <div class="filter-spinner">
            <i class="fas fa-circle-notch fa-spin"></i>
            <span>Loading...</span>
        </div>
    </div>
</div>

<style>
    .filters-container-dropdown {
        margin-bottom: 1.25rem;
        position: relative;
        min-width: 140px;
    }

    .filters-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0;
    }

    .filters-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.75rem 1.25rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 0.625rem;
        color: #fff;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.25);
        min-width: 140px;
    }

    .filters-toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.35);
    }

    .filters-toggle-btn:active {
        transform: translateY(0);
    }

    .toggle-btn-content {
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .toggle-icon-left {
        font-size: 1rem;
    }

    .toggle-text {
        font-weight: 600;
        letter-spacing: 0.01em;
    }

    .active-filters-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.375rem;
        height: 1.375rem;
        padding: 0 0.375rem;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 0.625rem;
        font-size: 0.75rem;
        font-weight: 700;
        backdrop-filter: blur(4px);
    }

    .toggle-icon-right {
        font-size: 0.875rem;
        transition: transform 0.3s ease;
    }

    .filters-toggle-btn.active .toggle-icon-right {
        transform: rotate(180deg);
    }

    .quick-clear-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: #fff;
        border: 1.5px solid #e4e9f2;
        border-radius: 0.625rem;
        color: #ef4444;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .quick-clear-btn:hover {
        background: #fef2f2;
        border-color: #ef4444;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }

    .quick-clear-btn i {
        font-size: 0.875rem;
    }

    /* CHANGED: Removed initial show state, hidden by default */
    .filters-dropdown-panel {
        position: absolute;
        z-index: 1050;
        width: 100%;
        min-width: 600px;
        max-width: 800px;
        left: 0;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fff;
        border-radius: 0.75rem;
        margin-top: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        visibility: hidden;
    }

    /* CHANGED: Only show when 'show' class is added */
    .filters-dropdown-panel.show {
        max-height: 1000px;
        opacity: 1;
        border: 1.5px solid #e4e9f2;
        visibility: visible;
    }

    .filter-form {
        padding: 1.5rem;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .search-item {
        grid-column: span 2;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #2e384d;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0;
    }

    .label-icon {
        font-size: 0.875rem;
        color: #667eea;
    }

    .search-input-wrapper,
    .date-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input,
    .date-input,
    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e4e9f2;
        border-radius: 0.5rem;
        font-size: 0.9375rem;
        color: #2e384d;
        background: #fff;
        transition: all 0.3s ease;
    }

    .search-input {
        padding-right: 2.5rem;
    }

    .date-input,
    .filter-select {
        padding-right: 2.5rem;
    }

    .search-input:focus,
    .date-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-input:hover,
    .date-input:hover,
    .filter-select:hover {
        border-color: #c5cee0;
    }

    .date-input {
        cursor: pointer;
        color-scheme: light;
    }

    .date-input::-webkit-calendar-picker-indicator {
        cursor: pointer;
        padding: 0.25rem;
        margin-right: -0.25rem;
    }

    .filter-select {
        appearance: none;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 14px 14px;
    }

    .clear-input-btn {
        position: absolute;
        right: 0.75rem;
        background: none;
        border: none;
        color: #8f9bb3;
        cursor: pointer;
        padding: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .clear-input-btn:hover {
        color: #ef4444;
        background: #fef2f2;
    }

    .clear-input-btn i {
        font-size: 0.875rem;
    }

    .filters-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1.25rem;
        border-top: 1.5px solid #e4e9f2;
        margin-top: 0.5rem;
    }

    .filters-info {
        font-size: 0.875rem;
    }

    .active-count {
        color: #667eea;
        font-weight: 600;
    }

    .no-filters {
        color: #8f9bb3;
        font-weight: 500;
    }

    .btn-reset-filters {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: linear-gradient(135deg, #f5f6fa 0%, #e4e9f2 100%);
        border: 1.5px solid #c5cee0;
        border-radius: 0.5rem;
        color: #2e384d;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-reset-filters:hover {
        background: linear-gradient(135deg, #e4e9f2 0%, #c5cee0 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-reset-filters i {
        font-size: 0.875rem;
    }

    .filter-loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .filter-loading-overlay.active {
        display: flex;
    }

    .filter-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 2rem;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    .filter-spinner i {
        font-size: 2.5rem;
        color: #667eea;
    }

    .filter-spinner span {
        font-size: 1rem;
        font-weight: 600;
        color: #2e384d;
    }

    .date-error-message {
        font-size: 0.75rem;
        color: #ef4444;
        margin-top: 0.25rem;
        display: none;
    }

    .date-input.invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .filters-dropdown-panel {
            min-width: 100%;
            max-width: 100%;
            left: 0;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 95%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .filters-dropdown-panel.show {
            max-height: 80vh;
        }

        .filter-form {
            padding: 1rem;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .search-item {
            grid-column: 1;
        }

        .filters-header {
            justify-content: flex-start;
        }

        .quick-clear-btn {
            margin-left: auto;
        }
    }

    @media (max-width: 576px) {
        .filters-header {
            flex-direction: column;
            align-items: stretch;
        }

        .filters-toggle-btn,
        .quick-clear-btn {
            width: 100%;
            justify-content: space-between;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .search-item {
            grid-column: 1;
        }

        .filters-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 0.75rem;
        }

        .btn-reset-filters {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    const RESULTS_CONTAINER_ID = '{{ $resultsContainerId }}';
    let ajaxRequestController = null;
    let filtersPanelVisible = false;

    function toggleFiltersDropdown() {
        const panel = document.getElementById('filtersDropdownPanel');
        const btn = document.getElementById('filtersToggleBtn');
        filtersPanelVisible = !filtersPanelVisible;

        if (filtersPanelVisible) {
            panel.classList.add('show');
            btn.classList.add('active');
        } else {
            panel.classList.remove('show');
            btn.classList.remove('active');
        }
    }

    function closeFiltersDropdown() {
        const panel = document.getElementById('filtersDropdownPanel');
        const btn = document.getElementById('filtersToggleBtn');
        panel.classList.remove('show');
        btn.classList.remove('active');
        filtersPanelVisible = false;
    }

    function getFilterParams() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams();
        for (let [key, value] of formData.entries()) {
            if (value && value.trim() !== '') {
                params.append(key, value);
            }
        }
        return params;
    }

    function showLoading() {
        document.getElementById('filterLoadingOverlay').classList.add('active');
    }

    function hideLoading() {
        document.getElementById('filterLoadingOverlay').classList.remove('active');
    }

    function updateURL(params) {
        const url = new URL(window.location);
        url.search = params.toString();
        window.history.pushState({}, '', url);
    }

    function validateDates() {
        const dateFromInput = document.getElementById('dateFromInput');
        const dateToInput = document.getElementById('dateToInput');
        const dateFromError = document.getElementById('dateFromError');
        const dateToError = document.getElementById('dateToError');

        let isValid = true;

        if (dateFromInput && dateToInput) {
            const dateFromValue = dateFromInput.value;
            const dateToValue = dateToInput.value;

            if (dateFromValue && dateToValue) {
                const fromDate = new Date(dateFromValue);
                const toDate = new Date(dateToValue);

                if (fromDate > toDate) {
                    dateFromInput.classList.add('invalid');
                    dateToInput.classList.add('invalid');
                    dateFromError.textContent = 'Date From must be less than or equal to Date To';
                    dateToError.textContent = 'Date To must be greater than or equal to Date From';
                    dateFromError.style.display = 'block';
                    dateToError.style.display = 'block';
                    isValid = false;
                } else {
                    dateFromInput.classList.remove('invalid');
                    dateToInput.classList.remove('invalid');
                    dateFromError.style.display = 'none';
                    dateToError.style.display = 'none';
                }
            } else {
                dateFromInput.classList.remove('invalid');
                dateToInput.classList.remove('invalid');
                dateFromError.style.display = 'none';
                dateToError.style.display = 'none';
            }
        }

        return isValid;
    }

    function updateDateConstraints() {
        const dateFromInput = document.getElementById('dateFromInput');
        const dateToInput = document.getElementById('dateToInput');

        if (dateFromInput && dateToInput) {
            dateToInput.min = dateFromInput.value;
            dateFromInput.max = dateToInput.value;
        }
    }

    function performAjaxFilter() {
        if (!validateDates()) {
            return false;
        }

        if (ajaxRequestController) {
            ajaxRequestController.abort();
        }

        ajaxRequestController = new AbortController();
        const params = getFilterParams();
        showLoading();

        fetch(window.location.pathname + '?' + params.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: ajaxRequestController.signal
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById(RESULTS_CONTAINER_ID);
                const currentContainer = document.getElementById(RESULTS_CONTAINER_ID);
                if (newContent && currentContainer) {
                    currentContainer.innerHTML = newContent.innerHTML;
                }
                updateURL(params);
                updateFilterUI();
                hideLoading();
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error('Filter error:', error);
                    hideLoading();
                }
            });
    }

    function updateFilterUI() {
        const params = getFilterParams();
        const form = document.getElementById('filterForm');
        const inputs = form.querySelectorAll('input, select');
        let hasActiveFilters = false;

        inputs.forEach(input => {
            if (input.value && input.value.trim() !== '') {
                hasActiveFilters = true;
            }
        });

        const activeFiltersCount = Array.from(params.keys()).length;
        const badge = document.getElementById('activeFiltersBadge');
        const statusText = document.getElementById('filterStatusText');
        const quickClearBtn = document.querySelector('.quick-clear-btn');
        const resetFiltersBtn = document.querySelector('.btn-reset-filters');

        if (hasActiveFilters) {
            if (badge) {
                badge.textContent = activeFiltersCount;
                badge.style.display = 'inline-flex';
            } else {
                const newBadge = document.createElement('span');
                newBadge.id = 'activeFiltersBadge';
                newBadge.className = 'active-filters-badge';
                newBadge.textContent = activeFiltersCount;
                document.querySelector('.toggle-btn-content').appendChild(newBadge);
            }
            if (statusText) {
                statusText.textContent = `${activeFiltersCount} filter(s) active`;
                statusText.className = 'active-count';
            }
            if (!quickClearBtn) {
                const newQuickClearBtn = document.createElement('button');
                newQuickClearBtn.type = 'button';
                newQuickClearBtn.className = 'quick-clear-btn';
                newQuickClearBtn.onclick = clearAllFiltersAjax;
                newQuickClearBtn.title = 'Clear all filters';
                newQuickClearBtn.innerHTML = '<i class="fas fa-times-circle"></i><span>Clear All</span>';
                document.querySelector('.filters-header').appendChild(newQuickClearBtn);
            }
            if (!resetFiltersBtn) {
                const newResetBtn = document.createElement('button');
                newResetBtn.type = 'button';
                newResetBtn.className = 'btn-reset-filters';
                newResetBtn.onclick = clearAllFiltersAjax;
                newResetBtn.innerHTML = '<i class="fas fa-redo-alt"></i>Reset All Filters';
                document.querySelector('.filters-actions').appendChild(newResetBtn);
            }
        } else {
            if (badge) {
                badge.style.display = 'none';
            }
            if (statusText) {
                statusText.textContent = 'No filters applied';
                statusText.className = 'no-filters';
            }
            if (quickClearBtn) {
                quickClearBtn.remove();
            }
            if (resetFiltersBtn) {
                resetFiltersBtn.remove();
            }
        }

        document.querySelectorAll('.clear-input-btn').forEach(btn => {
            const inputName = btn.getAttribute('onclick').match(/'([^']+)'/)[1];
            const input = document.querySelector(`[name="${inputName}"]`);
            btn.style.display = (input && input.value) ? 'flex' : 'none';
        });

        updateDateConstraints();
    }

    let searchTimeout;
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performAjaxFilter();
            }, 600);
        });
    }

    function clearSearchAjax(fieldName) {
        const input = document.querySelector(`[name="${fieldName}"]`);
        if (input) {
            input.value = '';
            if (fieldName === 'date_from' || fieldName === 'date_to') {
                updateDateConstraints();
                validateDates();
            }
            performAjaxFilter();
        }
    }

    function clearAllFiltersAjax() {
        const form = document.getElementById('filterForm');
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.value = '';
        });
        updateDateConstraints();
        validateDates();
        performAjaxFilter();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const filterInputs = document.querySelectorAll('.ajax-filter');
        filterInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.id === 'dateFromInput' || this.id === 'dateToInput') {
                    updateDateConstraints();
                }
                performAjaxFilter();
            });
        });

        updateFilterUI();
        validateDates();
    });

    // Close filters when clicking outside
    document.addEventListener('click', function(event) {
        const container = document.querySelector('.filters-container-dropdown');
        if (container && !container.contains(event.target) && filtersPanelVisible) {
            closeFiltersDropdown();
        }
    });

    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

    window.addEventListener('popstate', function() {
        location.reload();
    });
</script>

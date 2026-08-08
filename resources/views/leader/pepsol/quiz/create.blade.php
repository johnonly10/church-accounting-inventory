@extends('layouts.staff')

@push('styles')
    <style>
        :root {
            --pepsol-primary: #6366f1;
            --pepsol-primary-dark: #4f46e5;
            --pepsol-primary-tint: #eef0ff;
        }

        body {
            background: #f5f7fb;
        }

        .page-shell {
            padding-bottom: 110px;
        }

        .ewm-card {
            border: 1px solid #e5e9f2;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .ewm-card+.ewm-card {
            margin-top: 24px;
        }

        .ewm-card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #eef1f6;
            background: #fff;
            cursor: pointer;
        }

        .ewm-card-header:focus-visible {
            outline: 2px solid var(--pepsol-primary);
            outline-offset: -2px;
        }

        .ewm-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #2f3b52;
            margin-bottom: 3px;
        }

        .ewm-card-subtitle {
            font-size: 13px;
            color: #7c8597;
            margin-bottom: 0;
        }

        .ewm-card-body {
            padding: 22px;
        }

        .ewm-toggle-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #f3f6fb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4f5d75;
            transition: all .2s ease;
        }

        .ewm-toggle-icon i {
            transition: transform .2s ease;
        }

        .form-control,
        .form-select {
            min-height: 44px;
            border-radius: 10px;
            border: 1px solid #d8dfeb;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--pepsol-primary);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }

        .invalid-feedback-text {
            display: none;
            font-size: 12px;
            font-weight: 600;
            color: #dc3545;
            margin-top: 6px;
        }

        .is-invalid+.invalid-feedback-text,
        .is-invalid~.invalid-feedback-text {
            display: block;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #33415c;
            margin-bottom: 8px;
        }

        .text-optional {
            font-weight: 500;
            color: #8b95a7;
            text-transform: none;
        }

        textarea.form-control {
            min-height: 44px;
            resize: vertical;
        }

        .btn-primary {
            background-color: var(--pepsol-primary);
            border-color: var(--pepsol-primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--pepsol-primary-dark);
            border-color: var(--pepsol-primary-dark);
        }

        .btn-outline-primary {
            color: var(--pepsol-primary);
            border-color: var(--pepsol-primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--pepsol-primary);
            border-color: var(--pepsol-primary);
            color: #fff;
        }

        .btn-outline-secondary:hover {
            color: #fff;
        }

        .btn[disabled],
        .btn:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .quiz-summary-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px 18px;
            padding: 10px 14px;
            background: var(--pepsol-primary-tint);
            border: 1px solid #dfe1ff;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: 700;
            color: #3c3f8a;
        }

        .quiz-summary-bar .summary-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .quiz-summary-bar i {
            color: var(--pepsol-primary);
        }

        .questions-empty-state {
            border: 1px dashed #d3d9e8;
            border-radius: 12px;
            padding: 36px 20px;
            text-align: center;
            color: #8b95a7;
            background: #fbfcfe;
        }

        .questions-empty-state i {
            font-size: 28px;
            color: #c7cee0;
            margin-bottom: 10px;
            display: block;
        }

        .questions-empty-state p {
            margin-bottom: 0;
            font-size: 13.5px;
        }

        .d-none-important {
            display: none !important;
        }

        .question-card {
            border: 1px solid #e5e9f2;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .question-card+.question-card {
            margin-top: 14px;
        }

        .question-card-header {
            padding: 14px 16px;
            background: #fbfcfe;
            border-bottom: 1px solid #eef1f6;
            cursor: pointer;
        }

        .question-card-header:focus-visible {
            outline: 2px solid var(--pepsol-primary);
            outline-offset: -2px;
        }

        .question-card-title-group {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .question-card-preview {
            font-size: 12px;
            font-weight: 500;
            color: #8b95a7;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            min-width: 0;
        }

        .question-card-body {
            padding: 16px;
        }

        .card-body-collapse {
            overflow: hidden;
            transition: max-height .25s ease, opacity .2s ease;
            max-height: 5000px;
            opacity: 1;
        }

        .card-body-collapse.collapsed {
            max-height: 0 !important;
            opacity: 0;
            pointer-events: none;
        }

        .option-item {
            border: 1px solid #e5e9f2;
            border-radius: 10px;
            padding: 12px;
            background: #fafbfd;
            transition: border-color .15s ease, background .15s ease;
        }

        .option-item+.option-item {
            margin-top: 10px;
        }

        .option-item.is-correct {
            border-color: var(--pepsol-primary);
            background: var(--pepsol-primary-tint);
        }

        .correct-badge {
            background: #d4edda;
            color: #155724;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .option-item.is-correct .correct-badge {
            background: var(--pepsol-primary);
            color: #fff;
        }

        .status-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .status-pill-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid #d8dfeb;
            border-radius: 999px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #4f5d75;
            transition: all .15s ease;
        }

        .status-pill-label input {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
        }

        .status-pill-label:has(input:checked),
        .status-pill-label.is-active {
            border-color: var(--pepsol-primary);
            background: var(--pepsol-primary-tint);
            color: var(--pepsol-primary);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c4ccd8;
            flex-shrink: 0;
        }

        .status-pill-label:has(input[value="published"]:checked) .status-dot,
        .status-pill-label.is-active[data-status="published"] .status-dot {
            background: #28a745;
        }

        .status-pill-label:has(input[value="draft"]:checked) .status-dot,
        .status-pill-label.is-active[data-status="draft"] .status-dot {
            background: #ffc107;
        }

        #toast-region {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toastx {
            padding: 12px 16px;
            border-radius: 10px;
            color: #fff;
            min-width: 240px;
            max-width: 340px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
        }

        .toastx.ok {
            background: #28a745;
        }

        .toastx.bad {
            background: #dc3545;
        }

        @media (max-width: 767.98px) {

            .ewm-card-header,
            .ewm-card-body {
                padding: 16px;
            }

            .question-card-preview {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <main class="container-fluid page-shell px-3 px-md-4 py-4">
        <x-page-title title="Create Quiz" active="Create Quiz" home="Quizzes" :home-route="route('leader.pepsol-quiz.index')" />

        @if ($errors->any())
            <aside class="alert alert-danger mb-4" role="alert">
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </aside>
        @endif

        <output id="toast-region" aria-live="polite"></output>

        <form id="quizForm" action="{{ route('leader.pepsol-quiz.store') }}" method="POST" novalidate>
            @csrf

            <section class="ewm-card" aria-labelledby="quiz-info-heading">
                <header class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)"
                    onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();toggleSection(this);}"
                    role="button" tabindex="0" aria-expanded="true">
                    <div>
                        <h2 class="ewm-card-title" id="quiz-info-heading">Quiz Information</h2>
                        <p class="ewm-card-subtitle">Basic quiz settings and configuration</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true" aria-hidden="true">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </header>

                <div class="ewm-card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="lesson-select" class="form-label">
                                Lesson <span class="text-danger" aria-label="required">*</span>
                            </label>
                            <select id="lesson-select" name="pepsol_lesson_id" class="form-select" required>
                                <option value="">Select a lesson</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{ $lesson->id }}"
                                        {{ old('pepsol_lesson_id') == $lesson->id ? 'selected' : '' }}>
                                        {{ $lesson->title }}
                                        @if ($lesson->pepsol)
                                            ({{ $lesson->pepsol->description ? Str::limit($lesson->pepsol->description, 30) : '' }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback-text">Please select a lesson.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="quiz-title" class="form-label">
                                Quiz Title <span class="text-danger" aria-label="required">*</span>
                            </label>
                            <input type="text" id="quiz-title" name="title" class="form-control"
                                placeholder="e.g. Understanding the Holy Spirit Quiz" value="{{ old('title') }}" required>
                            <div class="invalid-feedback-text">Please enter a quiz title.</div>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="quiz-description" class="form-label">
                                Description <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="quiz-description" name="description" class="form-control" rows="3"
                                placeholder="Brief description of this quiz...">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="quiz-instructions" class="form-label">
                                Instructions <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="quiz-instructions" name="instructions" class="form-control" rows="3"
                                placeholder="Instructions for taking this quiz...">{{ old('instructions') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-6">
                            <label for="passing-score" class="form-label">
                                Passing Score (%) <span class="text-danger" aria-label="required">*</span>
                            </label>
                            <input type="number" id="passing-score" name="passing_score" class="form-control"
                                min="0" max="100" value="{{ old('passing_score', 70) }}" required>
                        </div>

                        {{-- <div class="col-md-4 mb-4">
                            <label for="time-limit" class="form-label">
                                Time Limit (minutes) <span class="text-optional">— optional</span>
                            </label>
                            <input type="number" id="time-limit" name="time_limit" class="form-control" min="1"
                                placeholder="Leave empty for no limit" value="{{ old('time_limit') }}">
                        </div> --}}

                        <div class="col-md-6 mb-6">
                            <label for="max-attempts" class="form-label">
                                Max Attempts <span class="text-optional">— optional</span>
                            </label>
                            <input type="number" id="max-attempts" name="max_attempts" class="form-control" min="1"
                                placeholder="Leave empty for unlimited" value="{{ old('max_attempts') }}">
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-check">
                                <input type="checkbox" id="allow-retake" name="allow_retake" class="form-check-input"
                                    value="1" {{ old('allow_retake', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow-retake">Allow Retake</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <fieldset>
                                <legend class="form-label">Status</legend>
                                <div class="status-pills" id="status-pills">
                                    <label class="status-pill-label" for="status-published" data-status="published">
                                        <input type="radio" id="status-published" name="status" value="published"
                                            {{ old('status', 'draft') === 'published' ? 'checked' : '' }}>
                                        <span class="status-dot" aria-hidden="true"></span>
                                        Published
                                    </label>
                                    <label class="status-pill-label" for="status-draft" data-status="draft">
                                        <input type="radio" id="status-draft" name="status" value="draft"
                                            {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                                        <span class="status-dot" aria-hidden="true"></span>
                                        Draft
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ewm-card" aria-labelledby="questions-heading">
                <header class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)"
                    onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();toggleSection(this);}"
                    role="button" tabindex="0" aria-expanded="true">
                    <div>
                        <h2 class="ewm-card-title" id="questions-heading">Questions</h2>
                        <p class="ewm-card-subtitle">Add questions with multiple choice options</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true" aria-hidden="true">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </header>

                <div class="ewm-card-body">
                    <div class="quiz-summary-bar" id="quiz-summary" aria-live="polite">
                        <span class="summary-item"><i class="fas fa-circle-question"></i> <span
                                id="summary-question-count">0</span> questions</span>
                        <span class="summary-item"><i class="fas fa-star"></i> <span id="summary-point-total">0</span>
                            points total</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4"
                        style="gap:10px; flex-wrap: wrap;">
                        <h4 class="mb-0">Question List</h4>
                        <div class="d-flex" style="gap:8px;">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="collapseAllBtn"
                                onclick="toggleCollapseAll()">
                                <i class="fas fa-compress mr-1"></i> Collapse All
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion()">
                                <i class="fas fa-plus mr-1"></i> Add Question
                            </button>
                        </div>
                    </div>

                    <div id="questions-empty-state" class="questions-empty-state">
                        <i class="fas fa-list-check" aria-hidden="true"></i>
                        <p>No questions yet. Click "Add Question" to get started.</p>
                    </div>

                    <div id="questions-container"></div>
                </div>
            </section>

            <footer class="mt-4">
                <x-buttons.form-action primaryTitle="Create Quiz" primaryId="createQuizBtn" :cancel-route="route('leader.pepsol-quiz.index')" />
            </footer>
        </form>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/package/dist/sweetalert2.all.min.js') }}"></script>
    <script>
        let questionCounter = 0;
        let optionCounter = 0;

        function toggleSection(headerEl) {
            const icon = headerEl.querySelector('[data-open]');
            const isOpen = icon.dataset.open === 'true';
            const body = headerEl.nextElementSibling;
            if (!body) return;
            body.style.display = isOpen ? 'none' : 'block';
            icon.dataset.open = isOpen ? 'false' : 'true';
            headerEl.setAttribute('aria-expanded', String(!isOpen));
            const iconEl = icon.querySelector('i');
            if (iconEl) iconEl.style.transform = isOpen ? 'rotate(-90deg)' : 'rotate(0deg)';
        }

        function toast(msg, type = 'ok') {
            const r = document.getElementById('toast-region');
            const el = document.createElement('div');
            el.className = 'toastx ' + type;
            el.textContent = msg;
            el.setAttribute('role', 'alert');
            r.appendChild(el);
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transition = 'opacity .3s';
                setTimeout(() => el.remove(), 300);
            }, 3000);
        }

        function refreshEmptyState() {
            const container = document.getElementById('questions-container');
            const emptyState = document.getElementById('questions-empty-state');
            emptyState.classList.toggle('d-none-important', container.children.length > 0);
        }

        function updateQuizSummary() {
            const questions = document.querySelectorAll('#questions-container .question-card');
            let totalPoints = 0;
            questions.forEach(q => {
                const pointsInput = q.querySelector('input[name*="[points]"]');
                const val = pointsInput ? parseInt(pointsInput.value, 10) : 0;
                totalPoints += isNaN(val) ? 0 : val;
            });
            document.getElementById('summary-question-count').textContent = questions.length;
            document.getElementById('summary-point-total').textContent = totalPoints;
        }

        function clearFieldError(el) {
            if (el) el.classList.remove('is-invalid');
        }

        function markFieldError(el) {
            if (el) el.classList.add('is-invalid');
        }

        function addQuestion() {
            questionCounter++;
            const questionId = `question_${questionCounter}`;
            const container = document.getElementById('questions-container');

            const questionHtml = `
                <div class="question-card" id="${questionId}" data-question-num="${questionCounter}">
                    <header class="question-card-header d-flex align-items-center justify-content-between" role="button" tabindex="0" aria-expanded="true">
                        <div class="question-card-title-group">
                            <span class="badge bg-primary">Q${questionCounter}</span>
                            <span class="font-weight-bold">Question ${questionCounter}</span>
                            <span class="question-card-preview" data-role="preview"></span>
                        </div>
                        <div class="d-flex align-items-center" style="gap:8px;">
                            <span class="ewm-toggle-icon" style="width:30px;height:30px;" aria-hidden="true">
                                <i class="fas fa-angle-down"></i>
                            </span>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-action="remove-question" aria-label="Remove question ${questionCounter}">
                                <i class="fas fa-trash mr-1"></i> Remove
                            </button>
                        </div>
                    </header>
                    <div class="card-body-collapse">
                        <div class="question-card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="question-text-${questionId}" class="form-label">
                                        Question Text <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="question-text-${questionId}" name="questions[${questionCounter}][question_text]" class="form-control" rows="3" placeholder="Enter your question..." required></textarea>
                                    <div class="invalid-feedback-text">Question text is required.</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="question-explanation-${questionId}" class="form-label">
                                        Explanation <span class="text-optional">— optional</span>
                                    </label>
                                    <textarea id="question-explanation-${questionId}" name="questions[${questionCounter}][explanation]" class="form-control" rows="2" placeholder="Explanation shown after answering..."></textarea>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="question-reference-${questionId}" class="form-label">
                                        Scripture Reference <span class="text-optional">— optional</span>
                                    </label>
                                    <input type="text" id="question-reference-${questionId}" name="questions[${questionCounter}][reference]" class="form-control" placeholder="e.g. John 3:16">
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="question-points-${questionId}" class="form-label">
                                        Points <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="question-points-${questionId}" name="questions[${questionCounter}][points]" class="form-control" min="1" value="1" required>
                                </div>

                                <div class="col-12">
                                    <input type="hidden" name="questions[${questionCounter}][sort_order]" value="${questionCounter - 1}">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0">Options</h5>
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-action="add-option">
                                            <i class="fas fa-plus mr-1"></i> Add Option
                                        </button>
                                    </div>
                                    <div id="options-${questionId}" class="options-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', questionHtml);

            addOption(questionId, questionCounter);
            addOption(questionId, questionCounter);

            updateQuestionNumbers();
            refreshEmptyState();
            updateQuizSummary();
        }

        function updateQuestionPreview(questionId, text) {
            const card = document.getElementById(questionId);
            if (!card) return;
            const preview = card.querySelector('[data-role="preview"]');
            if (!preview) return;
            const trimmed = text.trim();
            preview.textContent = trimmed ? `— ${trimmed}` : '';
        }

        function addOption(questionId, questionNum) {
            optionCounter++;
            const optionId = `option_${optionCounter}`;
            const container = document.getElementById(`options-${questionId}`);
            const optionCount = container.children.length;

            const optionHtml = `
                <div class="option-item" id="${optionId}">
                    <div class="row align-items-end">
                        <div class="col-md-7 mb-2 mb-md-0">
                            <label for="option-text-${optionId}" class="form-label">Option Text <span class="text-danger">*</span></label>
                            <input type="text" id="option-text-${optionId}" name="questions[${questionNum}][options][${optionCounter}][option_text]" class="form-control" placeholder="Enter option text..." required>
                            <input type="hidden" name="questions[${questionNum}][options][${optionCounter}][sort_order]" value="${optionCount}">
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <div class="form-check">
                                <input type="radio" id="correct-${optionId}" name="questions[${questionNum}][correct_option]" value="${optionCounter}" class="form-check-input correct-radio">
                                <label class="form-check-label" for="correct-${optionId}">
                                    <span class="correct-badge">Correct Answer</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100" data-action="remove-option">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="questions[${questionNum}][options][${optionCounter}][is_correct]" value="0" class="correct-hidden">
                </div>
            `;

            container.insertAdjacentHTML('beforeend', optionHtml);
            refreshOptionRemoveState(questionId);
        }

        function refreshOptionRemoveState(questionId) {
            const options = document.querySelectorAll(`#options-${questionId} .option-item`);
            const removeButtons = document.querySelectorAll(`#options-${questionId} [data-action="remove-option"]`);
            const atMinimum = options.length <= 2;
            removeButtons.forEach(btn => {
                btn.disabled = atMinimum;
                btn.title = atMinimum ? 'At least 2 options are required' : '';
            });
        }

        function toggleQuestionCard(questionId) {
            const card = document.getElementById(questionId);
            if (!card) return;
            const collapse = card.querySelector('.card-body-collapse');
            const header = card.querySelector('.question-card-header');
            if (!collapse || !header) return;

            const isCollapsed = collapse.classList.contains('collapsed');
            collapse.classList.toggle('collapsed', !isCollapsed);
            header.setAttribute('aria-expanded', String(isCollapsed));
        }

        function toggleCollapseAll() {
            const cards = document.querySelectorAll('#questions-container .question-card');
            const btn = document.getElementById('collapseAllBtn');
            if (!cards.length) {
                toast('Add a question first.', 'bad');
                return;
            }

            const anyExpanded = Array.from(cards).some(card => {
                const collapse = card.querySelector('.card-body-collapse');
                return collapse && !collapse.classList.contains('collapsed');
            });
            const shouldCollapse = anyExpanded;

            cards.forEach(card => {
                const collapse = card.querySelector('.card-body-collapse');
                const header = card.querySelector('.question-card-header');
                if (!collapse || !header) return;
                collapse.classList.toggle('collapsed', shouldCollapse);
                header.setAttribute('aria-expanded', String(!shouldCollapse));
            });

            btn.innerHTML = shouldCollapse ?
                '<i class="fas fa-expand mr-1"></i> Expand All' :
                '<i class="fas fa-compress mr-1"></i> Collapse All';
        }

        function removeQuestion(questionId) {
            Swal.fire({
                title: 'Remove this question?',
                text: 'This question and all its options will be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;
                const el = document.getElementById(questionId);
                if (el) el.remove();
                updateQuestionNumbers();
                refreshEmptyState();
                updateQuizSummary();
                Swal.fire({
                    title: 'Removed',
                    text: 'The question was removed successfully.',
                    icon: 'success',
                    timer: 1400,
                    showConfirmButton: false
                });
            });
        }

        function updateQuestionNumbers() {
            const questions = document.querySelectorAll('#questions-container .question-card');
            questions.forEach((question, index) => {
                const badge = question.querySelector('.badge');
                const title = question.querySelector('.font-weight-bold');
                if (badge) badge.textContent = `Q${index + 1}`;
                if (title) title.textContent = `Question ${index + 1}`;

                const sortInput = question.querySelector('input[name*="[sort_order]"]');
                if (sortInput) sortInput.value = index;
            });
            updateQuizSummary();
        }

        const questionsContainer = document.getElementById('questions-container');

        questionsContainer.addEventListener('click', function(e) {
            const removeQuestionBtn = e.target.closest('[data-action="remove-question"]');
            if (removeQuestionBtn) {
                e.stopPropagation();
                const card = removeQuestionBtn.closest('.question-card');
                if (card) removeQuestion(card.id);
                return;
            }

            const removeOptionBtn = e.target.closest('[data-action="remove-option"]');
            if (removeOptionBtn) {
                e.stopPropagation();
                const optionItem = removeOptionBtn.closest('.option-item');
                const questionCard = removeOptionBtn.closest('.question-card');
                if (optionItem) optionItem.remove();
                if (questionCard) refreshOptionRemoveState(questionCard.id);
                return;
            }

            const addOptionBtn = e.target.closest('[data-action="add-option"]');
            if (addOptionBtn) {
                e.stopPropagation();
                const questionCard = addOptionBtn.closest('.question-card');
                if (questionCard) addOption(questionCard.id, questionCard.dataset.questionNum);
                return;
            }

            const header = e.target.closest('.question-card-header');
            if (header && !e.target.closest('button, input, label, select, textarea, a')) {
                const card = header.closest('.question-card');
                if (card) toggleQuestionCard(card.id);
            }
        });

        questionsContainer.addEventListener('keydown', function(e) {
            if (e.key !== 'Enter' && e.key !== ' ') return;
            const header = e.target.closest('.question-card-header');
            if (!header) return;
            if (e.target.closest('button, input, label, select, textarea, a')) return;
            e.preventDefault();
            const card = header.closest('.question-card');
            if (card) toggleQuestionCard(card.id);
        });

        questionsContainer.addEventListener('change', function(e) {
            if (e.target.classList.contains('correct-radio')) {
                const optionsContainer = e.target.closest('.options-container');
                if (!optionsContainer) return;
                optionsContainer.querySelectorAll('.correct-hidden').forEach(input => input.value = '0');
                optionsContainer.querySelectorAll('.option-item').forEach(item => item.classList.remove(
                    'is-correct'));
                const optionItem = e.target.closest('.option-item');
                const hiddenInput = optionItem.querySelector('.correct-hidden');
                if (hiddenInput) hiddenInput.value = '1';
                optionItem.classList.add('is-correct');
                return;
            }
            if (e.target.matches('input[name*="[points]"]')) {
                updateQuizSummary();
            }
        });

        questionsContainer.addEventListener('input', function(e) {
            if (e.target.matches('textarea[name*="[question_text]"]')) {
                const card = e.target.closest('.question-card');
                if (card) updateQuestionPreview(card.id, e.target.value);
                clearFieldError(e.target);
            }
            if (e.target.matches('.option-item input[type="text"]')) {
                clearFieldError(e.target);
            }
            if (e.target.matches('input[name*="[points]"]')) {
                updateQuizSummary();
            }
        });

        document.getElementById('lesson-select').addEventListener('change', function() {
            clearFieldError(this);
        });

        document.getElementById('quiz-title').addEventListener('input', function() {
            clearFieldError(this);
        });

        document.querySelectorAll('#status-pills input[name="status"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('#status-pills .status-pill-label').forEach(label => {
                    label.classList.remove('is-active');
                });
                const label = this.closest('.status-pill-label');
                if (label) label.classList.add('is-active');
            });
        });

        document.getElementById('quizForm').addEventListener('submit', function(e) {
            const lessonSelect = document.getElementById('lesson-select');
            const quizTitleInput = document.getElementById('quiz-title');
            const lessonId = lessonSelect.value;
            const quizTitle = quizTitleInput.value.trim();
            const questions = document.querySelectorAll('#questions-container .question-card');

            document.querySelectorAll('.is-invalid').forEach(el => clearFieldError(el));

            let firstInvalidEl = null;
            let hasError = false;

            if (!lessonId) {
                e.preventDefault();
                toast('Please select a lesson.', 'bad');
                markFieldError(lessonSelect);
                firstInvalidEl = firstInvalidEl || lessonSelect;
                hasError = true;
            }

            if (!quizTitle) {
                e.preventDefault();
                toast('Please enter a quiz title.', 'bad');
                markFieldError(quizTitleInput);
                firstInvalidEl = firstInvalidEl || quizTitleInput;
                hasError = true;
            }

            if (questions.length === 0) {
                e.preventDefault();
                toast('Please add at least one question.', 'bad');
                hasError = true;
            }

            questions.forEach((question, index) => {
                const questionTextEl = question.querySelector('textarea[name*="[question_text]"]');
                const questionText = questionTextEl.value.trim();
                const options = question.querySelectorAll('.option-item');
                const correctSelected = question.querySelector('.correct-radio:checked');

                if (!questionText) {
                    e.preventDefault();
                    toast(`Question ${index + 1} text is required.`, 'bad');
                    markFieldError(questionTextEl);
                    firstInvalidEl = firstInvalidEl || questionTextEl;
                    hasError = true;
                }

                if (options.length < 2) {
                    e.preventDefault();
                    toast(`Question ${index + 1} must have at least 2 options.`, 'bad');
                    hasError = true;
                }

                if (!correctSelected) {
                    e.preventDefault();
                    toast(`Please select the correct answer for question ${index + 1}.`, 'bad');
                    hasError = true;
                }

                options.forEach(option => {
                    const optionTextEl = option.querySelector('input[type="text"]');
                    const optionText = optionTextEl.value.trim();
                    if (!optionText) {
                        e.preventDefault();
                        toast(`All options in question ${index + 1} must have text.`, 'bad');
                        markFieldError(optionTextEl);
                        firstInvalidEl = firstInvalidEl || optionTextEl;
                        hasError = true;
                    }
                });
            });

            if (hasError) {
                if (firstInvalidEl) {
                    const parentCard = firstInvalidEl.closest('.question-card');
                    if (parentCard) {
                        const collapse = parentCard.querySelector('.card-body-collapse');
                        const header = parentCard.querySelector('.question-card-header');
                        if (collapse && collapse.classList.contains('collapsed')) {
                            collapse.classList.remove('collapsed');
                            if (header) header.setAttribute('aria-expanded', 'true');
                        }
                    }
                    firstInvalidEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    firstInvalidEl.focus({
                        preventScroll: true
                    });
                }
                return false;
            }

            const submitBtn = document.getElementById('createQuizBtn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Creating Quiz...';
            }

            return true;
        });

        refreshEmptyState();
        updateQuizSummary();
    </script>
@endpush

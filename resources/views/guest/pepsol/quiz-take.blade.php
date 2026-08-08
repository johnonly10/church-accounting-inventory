@extends('layouts.guest')

@section('content')
    <header>
        <x-hero-section title="Take Quiz" :breadcrumbs="[
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
            ['label' => 'Take Quiz'],
        ]" />
    </header>

    <main id="main-content" class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="quizForm"
                    action="{{ route('pepsol.quiz.submit', ['pepsolName' => $pepsolName, 'lesson' => $lesson, 'quiz' => $quiz, 'attempt' => $attempt]) }}"
                    method="POST">
                    @csrf

                    <div class="quiz-progress-bar mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="quiz-progress-text">Question <span id="currentQuestion">1</span> of
                                {{ $quiz->questions->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="quiz-status-panel mb-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="status-card status-answered rounded-3 p-3 text-center">
                                    <div class="status-icon-wrapper mb-2">
                                        <div class="status-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-success"></i>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 text-muted small">Answered</h6>
                                    <span class="fs-4 fw-bold text-success" id="answeredCount">0</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="status-card status-unanswered rounded-3 p-3 text-center">
                                    <div class="status-icon-wrapper mb-2">
                                        <div class="status-icon bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-circle text-danger"></i>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 text-muted small">Unanswered</h6>
                                    <span class="fs-4 fw-bold text-danger"
                                        id="unansweredCount">{{ $quiz->questions->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($quiz->questions as $index => $question)
                        <div class="quiz-question-card question-slide" id="question-{{ $index }}"
                            style="{{ $index === 0 ? '' : 'display:none;' }}" role="tabpanel"
                            aria-labelledby="question-heading-{{ $index }}">
                            <x-white-card>
                                <div class="question-header mb-4">
                                    <span class="badge bg-primary mb-2">Question {{ $index + 1 }}</span>
                                    <span class="badge bg-secondary ms-2">{{ $question->points }} point(s)</span>
                                    <h2 class="question-text mt-2" id="question-heading-{{ $index }}">
                                        {{ $question->question_text }}</h2>
                                    @if ($question->reference)
                                        <p class="question-reference text-muted">
                                            <i class="fas fa-book-open me-1"></i>{{ $question->reference }}
                                        </p>
                                    @endif
                                </div>

                                <div class="question-options">
                                    @foreach ($question->options as $option)
                                        <label class="option-card" for="option-{{ $question->id }}-{{ $option->id }}">
                                            <input type="radio" id="option-{{ $question->id }}-{{ $option->id }}"
                                                name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                class="option-radio" data-question="{{ $index }}">
                                            <span class="option-marker"></span>
                                            <span class="option-text">{{ $option->option_text }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </x-white-card>
                        </div>
                    @endforeach

                    <div class="quiz-navigation mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" class="btn btn-outline-primary" id="prevBtn"
                                onclick="navigateQuestion(-1)" style="display:none;" aria-label="Go to previous question">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="navigateQuestion(1)"
                                aria-label="Go to next question">
                                Next<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="button" class="btn btn-success" id="submitBtn" style="display:none;"
                                onclick="confirmSubmit()" aria-label="Submit quiz">
                                <i class="fas fa-check me-2"></i>Submit Quiz
                            </button>
                        </div>

                        <div class="question-navigator mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Jump to Question:</h6>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                        onclick="filterQuestions('all')" id="filterAll">
                                        All
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm"
                                        onclick="filterQuestions('answered')" id="filterAnswered">
                                        Answered
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="filterQuestions('unanswered')" id="filterUnanswered">
                                        Unanswered
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2" id="questionDots">
                                @foreach ($quiz->questions as $index => $q)
                                    <button type="button" class="btn btn-outline-secondary btn-sm question-dot"
                                        id="dot-{{ $index }}" onclick="goToQuestion({{ $index }})"
                                        aria-label="Go to question {{ $index + 1 }}" data-status="unanswered">
                                        {{ $index + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer"></div>

    <div aria-live="polite" aria-atomic="true" class="visually-hidden" id="screenReaderAnnouncement"></div>
@endsection

@push('scripts')
    <script>
        let currentQuestion = 0;
        const totalQuestions = {{ $quiz->questions->count() }};
        let answeredQuestions = new Set();
        let currentFilter = 'all';
        let isSubmitting = false;

        function navigateQuestion(direction) {
            const newIndex = currentQuestion + direction;
            if (newIndex >= 0 && newIndex < totalQuestions) {
                goToQuestion(newIndex);
            }
        }

        function goToQuestion(index) {
            document.getElementById(`question-${currentQuestion}`).style.display = 'none';
            document.getElementById(`question-${currentQuestion}`).setAttribute('aria-hidden', 'true');
            document.getElementById(`question-${index}`).style.display = 'block';
            document.getElementById(`question-${index}`).setAttribute('aria-hidden', 'false');
            document.getElementById(`question-${index}`).querySelector('.question-text').focus({
                preventScroll: true
            });

            currentQuestion = index;

            const status = answeredQuestions.has(index) ? 'answered' : 'unanswered';
            announceToScreenReader(`Question ${index + 1} of ${totalQuestions}, ${status}`);

            updateNavigation();
            updateProgress();
            updateDots();
            updateStatusCounts();
            applyQuestionFilter();

            document.getElementById(`question-${index}`).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function updateNavigation() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            prevBtn.style.display = currentQuestion === 0 ? 'none' : 'inline-block';

            if (currentQuestion === totalQuestions - 1) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            }

            document.getElementById('currentQuestion').textContent = currentQuestion + 1;
        }

        function updateProgress() {
            const progress = ((currentQuestion + 1) / totalQuestions) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
            document.getElementById('progressBar').setAttribute('aria-valuenow', Math.round(progress));
        }

        function updateDots() {
            for (let i = 0; i < totalQuestions; i++) {
                const dot = document.getElementById(`dot-${i}`);
                dot.classList.remove('btn-primary', 'btn-success', 'btn-outline-secondary');

                if (i === currentQuestion) {
                    dot.classList.add('btn-primary');
                    dot.innerHTML = `${i + 1}`;
                } else if (answeredQuestions.has(i)) {
                    dot.classList.add('btn-success');
                    dot.innerHTML = `<i class="fas fa-check"></i> ${i + 1}`;
                } else {
                    dot.classList.add('btn-outline-secondary');
                    dot.innerHTML = `${i + 1}`;
                }

                dot.setAttribute('data-status', answeredQuestions.has(i) ? 'answered' : 'unanswered');
            }
        }

        function updateStatusCounts() {
            const answeredCount = answeredQuestions.size;
            const unansweredCount = totalQuestions - answeredCount;

            document.getElementById('answeredCount').textContent = answeredCount;
            document.getElementById('unansweredCount').textContent = unansweredCount;
        }

        function filterQuestions(filter) {
            currentFilter = filter;

            document.getElementById('filterAll').classList.remove('active');
            document.getElementById('filterAnswered').classList.remove('active');
            document.getElementById('filterUnanswered').classList.remove('active');

            switch (filter) {
                case 'all':
                    document.getElementById('filterAll').classList.add('active');
                    break;
                case 'answered':
                    document.getElementById('filterAnswered').classList.add('active');
                    break;
                case 'unanswered':
                    document.getElementById('filterUnanswered').classList.add('active');
                    break;
            }

            applyQuestionFilter();
        }

        function applyQuestionFilter() {
            const dots = document.querySelectorAll('.question-dot');

            dots.forEach(dot => {
                const status = dot.getAttribute('data-status');

                switch (currentFilter) {
                    case 'all':
                        dot.style.display = 'inline-flex';
                        dot.style.opacity = '1';
                        break;
                    case 'answered':
                        dot.style.display = 'inline-flex';
                        dot.style.opacity = status === 'answered' ? '1' : '0.3';
                        break;
                    case 'unanswered':
                        dot.style.display = 'inline-flex';
                        dot.style.opacity = status === 'unanswered' ? '1' : '0.3';
                        break;
                }
            });
        }

        function confirmSubmit() {
            if (isSubmitting) return;

            const unanswered = totalQuestions - answeredQuestions.size;
            const allAnswered = unanswered === 0;

            let statsHtml = `
                <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                    <div style="flex: 1; background: #ecfdf5; border: 1px solid #86efac; border-radius: 12px; padding: 18px; text-align: center;">
                        <div style="font-size: 30px; font-weight: 800; color: #15803d; line-height: 1;">${answeredQuestions.size}</div>
                        <div style="font-size: 13px; color: #14532d; font-weight: 600; margin-top: 6px; letter-spacing: 0.02em;">ANSWERED</div>
                    </div>
                    <div style="flex: 1; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px; padding: 18px; text-align: center;">
                        <div style="font-size: 30px; font-weight: 800; color: #b91c1c; line-height: 1;">${unanswered}</div>
                        <div style="font-size: 13px; color: #7f1d1d; font-weight: 600; margin-top: 6px; letter-spacing: 0.02em;">UNANSWERED</div>
                    </div>
                </div>`;

            let statusHtml = '';
            if (!allAnswered) {
                statusHtml = `
                    <div style="background: #fffbeb; border: 1px solid #fbbf24; border-radius: 12px; padding: 16px; margin-bottom: 14px; display: flex; align-items: flex-start; gap: 12px; text-align: left;">
                        <div style="background: #d97706; border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-exclamation-triangle" style="color: #ffffff; font-size: 14px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700; color: #78350f; margin-bottom: 4px;">Unanswered Questions</div>
                            <div style="font-size: 13px; color: #92400e; line-height: 1.5;">You have <strong>${unanswered} unanswered question(s)</strong>. These will be marked as incorrect.</div>
                        </div>
                    </div>`;
            } else {
                statusHtml = `
                    <div style="background: #ecfdf5; border: 1px solid #86efac; border-radius: 12px; padding: 16px; margin-bottom: 14px; display: flex; align-items: flex-start; gap: 12px; text-align: left;">
                        <div style="background: #16a34a; border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-check" style="color: #ffffff; font-size: 14px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700; color: #14532d; margin-bottom: 4px;">All Questions Answered</div>
                            <div style="font-size: 13px; color: #166534; line-height: 1.5;">Great job! You've answered all questions.</div>
                        </div>
                    </div>`;
            }

            const htmlContent = `
                <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                    ${statsHtml}
                    ${statusHtml}
                    <div style="background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 12px; padding: 16px; display: flex; align-items: flex-start; gap: 12px; text-align: left;">
                        <div style="background: #4f46e5; border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-info" style="color: #ffffff; font-size: 14px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700; color: #312e81; margin-bottom: 4px;">Important Reminder</div>
                            <div style="font-size: 13px; color: #3730a3; line-height: 1.5;">Once submitted, you cannot change your answers. Please review before submitting.</div>
                        </div>
                    </div>
                </div>`;

            Swal.fire({
                title: '<span style="font-size: 21px; font-weight: 800; color: #0f172a;">Submit Quiz?</span>',
                html: htmlContent,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-paper-plane" style="margin-right: 6px;"></i>Submit Quiz',
                cancelButtonText: '<i class="fas fa-arrow-left" style="margin-right: 6px;"></i>Review Answers',
                reverseButtons: true,
                width: '460px',
                padding: '28px',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-4 border-0 shadow-lg',
                    title: 'mb-3',
                    htmlContainer: 'mb-0',
                    confirmButton: 'btn px-4 py-2 fw-semibold border-0',
                    cancelButton: 'btn px-4 py-2 fw-semibold border-0',
                    actions: 'mt-3 gap-3'
                },
                buttonsStyling: false,
                didOpen: () => {
                    const confirmBtn = Swal.getConfirmButton();
                    const cancelBtn = Swal.getCancelButton();

                    const confirmColor = allAnswered ? '#16a34a' : '#4f46e5';
                    const confirmHover = allAnswered ? '#15803d' : '#4338ca';

                    confirmBtn.style.cssText =
                        `background: ${confirmColor}; color: #ffffff; font-size: 14px; border-radius: 8px; transition: background 0.2s;`;
                    confirmBtn.onmouseover = () => confirmBtn.style.background = confirmHover;
                    confirmBtn.onmouseout = () => confirmBtn.style.background = confirmColor;

                    cancelBtn.style.cssText =
                        'background: #f1f5f9; color: #1e293b; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; transition: background 0.2s;';
                    cancelBtn.onmouseover = () => cancelBtn.style.background = '#e2e8f0';
                    cancelBtn.onmouseout = () => cancelBtn.style.background = '#f1f5f9';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    isSubmitting = true;
                    showSubmittingLoader();
                    setTimeout(() => {
                        document.getElementById('quizForm').submit();
                    }, 1500);
                }
            });
        }

        function showSubmittingLoader() {
            Swal.fire({
                html: `
                    <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; text-align: center; padding: 12px 0;">
                        <div style="margin-bottom: 20px;">
                            <div style="width: 56px; height: 56px; margin: 0 auto; position: relative;">
                                <div style="width: 56px; height: 56px; border: 4px solid #e2e8f0; border-top-color: #4f46e5; border-radius: 50%; animation: spin 0.8s linear infinite;"></div>
                            </div>
                        </div>
                        <div style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Submitting Your Quiz</div>
                        <div style="font-size: 13px; color: #475569; margin-bottom: 18px;">Please wait while we evaluate your answers...</div>
                        <div style="background: #e2e8f0; border-radius: 100px; height: 6px; overflow: hidden;">
                            <div style="background: linear-gradient(90deg, #4f46e5, #7c3aed); height: 100%; width: 100%; border-radius: 100px; animation: shimmer 2s infinite;"></div>
                        </div>
                    </div>
                    <style>
                        @keyframes spin { to { transform: rotate(360deg); } }
                        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
                    </style>
                `,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                width: '380px',
                padding: '32px',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-4 border-0 shadow-lg'
                }
            });
        }

        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();

            const iconClass = type === 'success' ? 'fa-check-circle' :
                type === 'warning' ? 'fa-exclamation-triangle' :
                type === 'error' ? 'fa-times-circle' : 'fa-info-circle';

            const bgClass = type === 'success' ? 'bg-success' :
                type === 'warning' ? 'bg-warning' :
                type === 'error' ? 'bg-danger' : 'bg-info';

            const toastHtml = `
                <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas ${iconClass} me-2"></i>${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHtml);

            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                delay: 3000,
                animation: true
            });

            toast.show();

            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        function announceToScreenReader(message) {
            const announcer = document.getElementById('screenReaderAnnouncement');
            announcer.textContent = '';
            setTimeout(() => {
                announcer.textContent = message;
            }, 50);
        }

        document.querySelectorAll('.option-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const questionIndex = parseInt(this.dataset.question);
                const wasAnswered = answeredQuestions.has(questionIndex);

                answeredQuestions.add(questionIndex);
                updateDots();
                updateStatusCounts();
                applyQuestionFilter();

                if (!wasAnswered) {
                    showToast(`Question ${questionIndex + 1} answered`, 'success');
                }

                if (currentQuestion === questionIndex && currentQuestion < totalQuestions - 1) {
                    setTimeout(() => {
                        navigateQuestion(1);
                    }, 500);
                }
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (answeredQuestions.size > 0 && !isSubmitting) {
                e.preventDefault();
                e.returnValue = 'You have unsaved progress. Are you sure you want to leave?';
                return e.returnValue;
            }
        });

        document.getElementById('quizForm').addEventListener('submit', function() {
            window.removeEventListener('beforeunload', arguments.callee);
        });

        updateNavigation();
        updateProgress();
        updateDots();
        updateStatusCounts();
    </script>
@endpush

@push('styles')
    <style>
        .quiz-progress-bar {
            background: #fff;
            border-radius: 1rem;
            padding: 1.25rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .quiz-progress-text {
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
        }

        .progress {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .progress-bar {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .quiz-status-panel .status-card {
            transition: all 0.3s ease;
            cursor: default;
        }

        .quiz-status-panel .status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .quiz-status-panel .status-answered {
            border-left: 4px solid #10b981;
        }

        .quiz-status-panel .status-unanswered {
            border-left: 4px solid #ef4444;
        }

        .quiz-question-card {
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .question-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.5;
        }

        .question-reference {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .question-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .option-card {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0;
            position: relative;
        }

        .option-card:hover {
            border-color: #6366f1;
            background: #f9fafb;
            transform: translateX(5px);
        }

        .option-radio {
            display: none;
        }

        .option-marker {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            margin-right: 1rem;
            position: relative;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .option-marker::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #6366f1;
            transition: transform 0.2s ease;
        }

        .option-radio:checked+.option-marker {
            border-color: #6366f1;
            background: #eef0fe;
        }

        .option-radio:checked+.option-marker::after {
            transform: translate(-50%, -50%) scale(1);
        }

        .option-radio:checked~.option-text {
            color: #6366f1;
            font-weight: 600;
        }

        .option-card:has(.option-radio:checked) {
            border-color: #6366f1;
            background: #eef0fe;
        }

        .option-text {
            font-size: 1rem;
            color: #374151;
            line-height: 1.5;
        }

        .question-navigator {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .question-navigator .btn.active {
            font-weight: 600;
        }

        #filterAll.active {
            background-color: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        #filterAnswered.active {
            background-color: #10b981;
            border-color: #10b981;
            color: white;
        }

        #filterUnanswered.active {
            background-color: #ef4444;
            border-color: #ef4444;
            color: white;
        }

        .question-dot {
            width: 40px;
            height: 40px;
            border-radius: 50% !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .question-dot:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .question-dot.btn-primary {
            background: #6366f1;
            border-color: #6366f1;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .question-dot.btn-success {
            background: #10b981;
            border-color: #10b981;
        }

        .toast-container {
            z-index: 9999;
        }

        .toast {
            min-width: 250px;
        }

        @media (max-width: 767.98px) {
            .quiz-progress-bar {
                padding: 1rem;
            }

            .question-text {
                font-size: 1.125rem;
            }

            .option-card {
                padding: 0.875rem 1rem;
            }

            .quiz-status-panel .row {
                margin-left: -0.25rem;
                margin-right: -0.25rem;
            }

            .quiz-status-panel .col-6 {
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }

            .quiz-status-panel .status-card {
                padding: 0.75rem !important;
            }

            .quiz-status-panel .fs-4 {
                font-size: 1.25rem !important;
            }

            .question-dot {
                width: 35px;
                height: 35px;
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

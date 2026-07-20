@extends('layouts.staff')

@push('styles')
    <style>
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
            border-color: #4c6fff;
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

        .content-textarea {
            min-height: 300px !important;
            font-size: 15px !important;
            line-height: 1.8 !important;
        }

        .lesson-badge {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #4c6fff;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .section-mini-title {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            color: #8b95a7;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .part-card {
            border: 1px solid #e5e9f2;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .part-card+.part-card {
            margin-top: 14px;
        }

        .part-card-header {
            padding: 14px 16px;
            background: #fbfcfe;
            border-bottom: 1px solid #eef1f6;
            cursor: pointer;
        }

        .part-card-body {
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

        .part-chevron {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #eef3fb;
            color: #52627a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all .2s ease;
        }

        .part-chevron.closed i {
            transform: rotate(-90deg);
        }

        .part-block-count {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 999px;
            background: #eef3fb;
            color: #52627a;
            display: none;
        }

        .part-card.is-collapsed .part-block-count {
            display: inline-block;
        }

        .block-card {
            border: 1px solid #e5e9f2;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
        }

        .block-card+.block-card {
            margin-top: 12px;
        }

        .block-card.is-collapsed {
            border-color: #dfe6f1;
        }

        .block-card-header {
            padding: 12px 14px;
            background: #f8fafc;
            border-bottom: 1px solid #eef1f6;
            font-size: 13px;
            font-weight: 700;
            color: #44516a;
        }

        .block-card-body {
            padding: 14px;
        }

        .part-type-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn-check:checked+.btn-outline-secondary {
            background: #4c6fff;
            border-color: #4c6fff;
            color: #fff;
        }

        .btn-outline-secondary {
            border-color: #d8dfeb;
            color: #4f5d75;
        }

        .btn-outline-secondary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f5f5f5;
        }

        .btn-outline-danger {
            border-radius: 8px;
        }

        .btn-outline-primary,
        .btn-primary,
        .btn-outline-secondary {
            border-radius: 10px;
        }

        .badge-soft {
            display: inline-block;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 999px;
            background: #eef3fb;
            color: #4c6fff;
        }

        .badge-soft.secondary {
            background: #edf1f7;
            color: #52627a;
        }

        .badge-soft.warning {
            background: #fff4db;
            color: #c58b00;
        }

        .badge-soft.info {
            background: #eaf6ff;
            color: #0c7abf;
        }

        .blocks-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .add-block-btn {
            border: 1px solid #d8dfeb;
            background: #fff;
            color: #52627a;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .add-block-btn:hover {
            border-color: #4c6fff;
            color: #4c6fff;
        }

        .add-block-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            display: none;
        }

        .status-pill-label:has(input:checked) {
            border-color: #4c6fff;
            background: #eef3fb;
            color: #4c6fff;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c4ccd8;
            flex-shrink: 0;
        }

        .status-pill-label:has(input[value="published"]:checked) .status-dot {
            background: #28a745;
        }

        .status-pill-label:has(input[value="draft"]:checked) .status-dot {
            background: #ffc107;
        }

        .fixed-bottom-bar {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1030;
            background: #fff;
            border-top: 1px solid #e5e9f2;
            box-shadow: 0 -4px 18px rgba(0, 0, 0, 0.04);
        }

        .bottom-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 24px;
        }

        .bar-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bar-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #c4ccd8;
        }

        .bar-dot.ready {
            background: #28a745;
        }

        .bar-name {
            font-size: 15px;
            font-weight: 700;
            color: #2f3b52;
            line-height: 1.2;
        }

        .bar-status {
            font-size: 12px;
            color: #8b95a7;
            margin-top: 2px;
        }

        .bar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
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

        .alert-danger {
            border-radius: 12px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        @media (max-width: 767.98px) {

            .ewm-card-header,
            .ewm-card-body {
                padding: 16px;
            }

            .bottom-bar-inner {
                flex-direction: column;
                align-items: stretch;
                padding: 14px 16px;
            }

            .bar-actions {
                justify-content: flex-end;
            }
        }
    </style>
@endpush

@section('content')
    <main class="container-fluid page-shell px-3 px-md-4 py-4">
        <x-page-title title="Create Discipleship Module" active="Create Discipleship Module" home="Discipleship"
            :home-route="route('leader.pepsol.index')" />

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

        <form id="pepsolForm" action="{{ route('leader.pepsol.store') }}" method="POST" enctype="multipart/form-data"
            novalidate>
            @csrf

            <section class="ewm-card" aria-labelledby="module-info-heading">
                <header class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)" role="button" tabindex="0" aria-expanded="true">
                    <div>
                        <h2 class="ewm-card-title" id="module-info-heading">Module Information</h2>
                        <p class="ewm-card-subtitle">Ministry category, type, status, description, guidelines, and
                            orientation</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true" aria-hidden="true">
                        <i class="ti-angle-down"></i>
                    </span>
                </header>

                <div class="ewm-card-body" id="body-info">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="f-cat" class="form-label">
                                Category <span class="text-optional">— optional</span>
                            </label>
                            <select id="f-cat" name="category" class="form-select">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="f-type" class="form-label">
                                Type <span class="text-optional">— optional</span>
                            </label>
                            <select id="f-type" name="type" class="form-select">
                                <option value="">Select a type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <fieldset>
                                <legend class="form-label">Status</legend>
                                <div class="status-pills">
                                    <label class="status-pill-label" for="status-published">
                                        <input type="radio" id="status-published" name="status" value="published"
                                            {{ old('status', 'published') === 'published' ? 'checked' : '' }}>
                                        <span class="status-dot" aria-hidden="true"></span>
                                        Published
                                    </label>
                                    <label class="status-pill-label" for="status-draft">
                                        <input type="radio" id="status-draft" name="status" value="draft"
                                            {{ old('status') === 'draft' ? 'checked' : '' }}>
                                        <span class="status-dot" aria-hidden="true"></span>
                                        Draft
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="ta-desc" class="form-label">
                                Description <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="ta-desc" name="description" class="form-control content-textarea"
                                placeholder="Describe what this module covers, who it's for, and what members will grow in spiritually...">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="ta-guidelines" class="form-label">
                                Guidelines <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="ta-guidelines" name="guidelines" class="form-control content-textarea"
                                placeholder="Community guidelines or fellowship participation expectations...">{{ old('guidelines') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="ta-orient" class="form-label">
                                Orientation <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="ta-orient" name="orientation" class="form-control content-textarea"
                                placeholder="A pastoral welcome note or orientation for new members joining this group...">{{ old('orientation') }}</textarea>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ewm-card" aria-labelledby="teaching-session-heading">
                <header class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)" role="button" tabindex="0" aria-expanded="true">
                    <div>
                        <h2 class="ewm-card-title" id="teaching-session-heading">Teaching Session</h2>
                        <p class="ewm-card-subtitle">One teaching session with sections and content blocks</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true" aria-hidden="true">
                        <i class="ti-angle-down"></i>
                    </span>
                </header>

                <div class="ewm-card-body" id="body-lessons">
                    <header class="d-flex align-items-center mb-4">
                        <span class="lesson-badge mr-2" aria-hidden="true">1</span>
                        <h3 class="mb-0 font-weight-bold" id="ld-1">Session 1</h3>
                    </header>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="pepsol-name" class="form-label">
                                Name <span class="text-optional">— optional</span>
                            </label>
                            <select id="pepsol-name" name="pepsol_name_id" class="form-select">
                                <option value="">Select a Name</option>
                                @foreach ($names as $name)
                                    <option value="{{ $name->id }}"
                                        {{ old('pepsol_name_id') == $name->id ? 'selected' : '' }}>
                                        {{ $name->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pepsol-topic" class="form-label">
                                Topic <span class="text-optional">— optional</span>
                            </label>
                            <select id="pepsol-topic" name="pepsol_topic_id" class="form-select">
                                <option value="">Select a Topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}"
                                        {{ old('pepsol_topic_id') == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="lesson-title-1" class="form-label">
                                Title <span class="text-danger" aria-label="required">*</span>
                            </label>
                            <input type="text" id="lesson-title-1" name="lesson_title" class="form-control"
                                placeholder="e.g. Walking in the Spirit" oninput="onLessonTitleChange(this.value)"
                                value="{{ old('lesson_title') }}" required>
                            <div class="invalid-feedback d-block" id="err-lesson-title" style="display:none!important"
                                role="alert">
                                Please enter a session title.
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="lesson-subtitle-1" class="form-label">
                                Subtitle <span class="text-optional">— optional</span>
                            </label>
                            <input type="text" id="lesson-subtitle-1" name="lesson_subtitle" class="form-control"
                                placeholder="e.g. A study on Galatians 5" value="{{ old('lesson_subtitle') }}">
                        </div>

                        <div class="col-12 mb-4">
                            <label for="ta-lsum-1" class="form-label">
                                Summary <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="ta-lsum-1" name="lesson_summary" class="form-control content-textarea"
                                placeholder="What spiritual truths or biblical principles will members explore?">{{ old('lesson_summary') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="lesson-cover" class="form-label">
                                Cover Image <span class="text-optional">— optional</span>
                            </label>
                            <input type="file" id="lesson-cover" name="lesson_cover" accept="image/*"
                                class="form-control">
                        </div>

                        <div class="col-12">
                            <header class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                                <h4 class="section-mini-title mb-0">Sections</h4>
                                <button type="button" class="btn btn-primary btn-sm" id="btn-add-part-1"
                                    onclick="addPart(1)" aria-label="Add new section">
                                    <i class="ti-plus mr-1" aria-hidden="true"></i> Add Section
                                </button>
                            </header>
                            <div id="parts-1" role="list" aria-label="Lesson sections"></div>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                <x-buttons.form-action primaryTitle="Create Pepsol" primaryId="createPepsolBtn" :cancel-route="route('leader.pepsol.index')" />
            </footer>
        </form>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/package/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        let partCounter = 0;
        let blockCounter = 0;

        const PART_TYPES = [{
                key: 'header',
                label: 'Opening',
                badge: 'info'
            },
            {
                key: 'body',
                label: 'Body',
                badge: ''
            },
            {
                key: 'end',
                label: 'Conclusion',
                badge: 'warning'
            },
            {
                key: 'conclusion',
                label: 'Summary',
                badge: 'secondary'
            }
        ];

        const BLOCK_TYPES = [{
                key: 'heading',
                label: 'Heading',
                icon: 'ti-text'
            },
            {
                key: 'subheading',
                label: 'Subheading',
                icon: 'ti-paragraph'
            },
            {
                key: 'paragraph',
                label: 'Paragraph',
                icon: 'ti-align-left'
            },
            {
                key: 'quote',
                label: 'Quote',
                icon: 'fas fa-quote-left'
            },
            {
                key: 'scripture',
                label: 'Scripture',
                icon: 'fas fa-bible'
            },
            {
                key: 'question',
                label: 'Question',
                icon: 'ti-help-alt'
            },
            {
                key: 'prayer',
                label: 'Prayer',
                icon: 'fas fa-pray'
            },
            {
                key: 'list',
                label: 'List',
                icon: 'ti-list'
            },
            {
                key: 'divider',
                label: 'Divider',
                icon: 'ti-minus'
            }
        ];

        function toggleSection(headerEl) {
            const icon = headerEl.querySelector('[data-open]');
            const isOpen = icon.dataset.open === 'true';
            const body = headerEl.nextElementSibling;
            if (!body) return;
            body.style.display = isOpen ? 'none' : 'block';
            icon.dataset.open = isOpen ? 'false' : 'true';
            headerEl.setAttribute('aria-expanded', !isOpen);
            const iconEl = icon.querySelector('i');
            if (iconEl) iconEl.style.transform = isOpen ? 'rotate(-90deg)' : 'rotate(0deg)';
        }

        function onLessonTitleChange(val) {
            const trimmed = val.trim();
            const el = document.getElementById('ld-1');
            if (el) el.textContent = trimmed || 'Session 1';
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

        function checkExistingPartTypes() {
            const existingTypes = [];
            const parts = document.getElementById('parts-1');
            if (!parts) return existingTypes;
            const partCards = parts.querySelectorAll('.part-card');
            partCards.forEach(card => {
                const selectedRadio = card.querySelector('input[type="radio"]:checked');
                if (selectedRadio && selectedRadio.value) {
                    existingTypes.push(selectedRadio.value);
                }
            });
            return existingTypes;
        }

        function updatePartTypeButtonsState(partId = null) {
            const existingTypes = checkExistingPartTypes();
            const parts = document.getElementById('parts-1');
            if (!parts) return;
            const allRadios = parts.querySelectorAll('input[type="radio"][name*="[part_key]"]');
            allRadios.forEach(radio => {
                const label = radio.nextElementSibling;
                if (existingTypes.includes(radio.value) && !radio.checked) {
                    radio.disabled = true;
                    if (label) {
                        label.style.opacity = '0.5';
                        label.style.cursor = 'not-allowed';
                        label.title = 'This section type is already used in another section';
                    }
                } else {
                    radio.disabled = false;
                    if (label) {
                        label.style.opacity = '1';
                        label.style.cursor = 'pointer';
                        label.title = '';
                    }
                }
            });
        }

        function addPart(ln) {
            partCounter++;
            const partId = `part_${partCounter}`;
            const pillsHtml = PART_TYPES.map(t => `
                <input type="radio" class="btn-check" name="parts[${partId}][part_key]" id="pt-${partId}-${t.key}" value="${t.key}" onchange="updatePartTypeLabel('${partId}', '${t.key}', '${t.label}'); updatePartTypeButtonsState('${partId}');">
                <label class="btn btn-outline-secondary btn-sm" id="lbl-${partId}-${t.key}" for="pt-${partId}-${t.key}">${t.label}</label>
            `).join('');

            const blockButtonsHtml = BLOCK_TYPES.map(bt => `
                <button type="button" class="add-block-btn" onclick="addBlock('${partId}','${bt.key}')" aria-label="Add ${bt.label} block">
                    <i class="${bt.icon}" aria-hidden="true"></i> ${bt.label}
                </button>
            `).join('');

            const el = document.createElement('div');
            el.className = 'part-card';
            el.id = partId;
            el.setAttribute('role', 'listitem');
            el.setAttribute('aria-labelledby', `pname-${partId}`);

            el.innerHTML = `
                <header class="part-card-header d-flex align-items-center justify-content-between" onclick="togglePartCard('${partId}', event)" role="button" tabindex="0" aria-expanded="true">
                    <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
                        <span class="badge-soft secondary" id="ptag-${partId}">Unset</span>
                        <span class="font-weight-bold" id="pname-${partId}">Section ${partCounter}</span>
                        <span class="part-block-count" id="pbc-${partId}" aria-label="0 blocks">0 blocks</span>
                    </div>
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span class="part-chevron" id="pchev-${partId}" aria-hidden="true"><i class="ti-angle-down"></i></span>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePart('${partId}', event)" aria-label="Remove section ${partCounter}">Remove</button>
                    </div>
                </header>
                <div class="card-body-collapse" id="pcollapse-${partId}">
                    <div class="part-card-body">
                        <fieldset class="mb-4">
                            <legend class="form-label">Section Type <span class="text-danger" aria-label="required">*</span></legend>
                            <div class="part-type-pills">${pillsHtml}</div>
                        </fieldset>
                        <header class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                            <h5 class="section-mini-title mb-0">Content Blocks</h5>
                            <nav class="blocks-toolbar" aria-label="Add content blocks">
                                ${blockButtonsHtml}
                            </nav>
                        </header>
                        <div id="blocks-${partId}" role="list" aria-label="Content blocks for this section"></div>
                    </div>
                </div>
            `;

            document.getElementById('parts-1').appendChild(el);
            updatePartBlockCount(partId);
            updatePartTypeButtonsState();
            setTimeout(() => el.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            }), 60);
        }

        function updatePartTypeLabel(partId, typeKey, typeLabel) {
            const tag = document.getElementById('ptag-' + partId);
            const name = document.getElementById('pname-' + partId);
            if (tag) tag.textContent = typeLabel;
            if (name) name.textContent = typeLabel + ' Section';
        }

        function togglePartCard(partId, e) {
            if (e && e.target.closest('button, input, label, select, textarea, a')) return;
            const collapse = document.getElementById('pcollapse-' + partId);
            const chev = document.getElementById('pchev-' + partId);
            const card = document.getElementById(partId);
            const header = card.querySelector('.part-card-header');
            if (!collapse || !chev || !card) return;
            const isCollapsed = collapse.classList.contains('collapsed');
            if (isCollapsed) {
                collapse.classList.remove('collapsed');
                chev.classList.remove('closed');
                card.classList.remove('is-collapsed');
                header.setAttribute('aria-expanded', 'true');
            } else {
                collapse.classList.add('collapsed');
                chev.classList.add('closed');
                card.classList.add('is-collapsed');
                header.setAttribute('aria-expanded', 'false');
            }
        }

        function toggleBlockCard(blockId, e) {
            if (e && e.target.closest('button, input, label, select, textarea, a')) return;
            const collapse = document.getElementById('bcollapse-' + blockId);
            const chev = document.getElementById('bchev-' + blockId);
            const card = document.getElementById(blockId);
            const header = card.querySelector('.block-card-header');
            if (!collapse || !chev || !card) return;
            const isCollapsed = collapse.classList.contains('collapsed');
            if (isCollapsed) {
                collapse.classList.remove('collapsed');
                chev.classList.remove('closed');
                card.classList.remove('is-collapsed');
                header.setAttribute('aria-expanded', 'true');
            } else {
                collapse.classList.add('collapsed');
                chev.classList.add('closed');
                card.classList.add('is-collapsed');
                header.setAttribute('aria-expanded', 'false');
            }
        }

        function removePart(partId, e) {
            if (e) e.stopPropagation();
            Swal.fire({
                title: 'Remove this section?',
                text: 'This section and all of its content blocks will be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;
                const el = document.getElementById(partId);
                if (el) el.remove();
                updatePartTypeButtonsState();
                Swal.fire({
                    title: 'Removed',
                    text: 'The section was removed successfully.',
                    icon: 'success',
                    timer: 1400,
                    showConfirmButton: false
                });
            });
        }

        function addBlock(partId, blockType) {
            blockCounter++;
            const blockId = `block_${blockCounter}`;
            const container = document.getElementById('blocks-' + partId);
            const blockCount = container.children.length;

            let bodyHtml = '';

            switch (blockType) {
                case 'heading':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Heading Text</label>
                            <input type="text" id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control" placeholder="Enter heading text...">
                        </div>`;
                    break;
                case 'subheading':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Subheading Text</label>
                            <input type="text" id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control" placeholder="Enter subheading text...">
                        </div>`;
                    break;
                case 'paragraph':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Content</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Write the teaching content or message notes here..."></textarea>
                        </div>`;
                    break;
                case 'quote':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Quote</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Enter the quote here..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reference-${blockId}" class="form-label">Reference <span class="text-optional">— optional</span></label>
                            <input type="text" id="reference-${blockId}" name="parts[${partId}][blocks][${blockId}][reference]" class="form-control" placeholder="e.g. John Piper, Desiring God">
                        </div>`;
                    break;
                case 'scripture':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Scripture Text</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Enter the scripture passage..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reference-${blockId}" class="form-label">Scripture Reference <span class="text-optional">— optional</span></label>
                            <input type="text" id="reference-${blockId}" name="parts[${partId}][blocks][${blockId}][reference]" class="form-control" placeholder="e.g. John 3:16">
                        </div>`;
                    break;
                case 'question':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Question</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Enter the discussion or reflection question..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reference-${blockId}" class="form-label">Reference <span class="text-optional">— optional</span></label>
                            <input type="text" id="reference-${blockId}" name="parts[${partId}][blocks][${blockId}][reference]" class="form-control" placeholder="e.g. Related scripture or source">
                        </div>`;
                    break;
                case 'prayer':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">Prayer</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Enter the prayer text..."></textarea>
                        </div>`;
                    break;
                case 'list':
                    bodyHtml = `
                        <div class="mb-3">
                            <label for="content-${blockId}" class="form-label">List Items</label>
                            <textarea id="content-${blockId}" name="parts[${partId}][blocks][${blockId}][content]" class="form-control content-textarea" placeholder="Enter list items, one per line..."></textarea>
                            <small class="text-muted">Enter each item on a new line</small>
                        </div>`;
                    break;
                case 'divider':
                    bodyHtml = `
                        <div class="mb-3">
                            <input type="hidden" name="parts[${partId}][blocks][${blockId}][content]" value="">
                            <p class="text-muted mb-0">A visual divider will be displayed between content blocks.</p>
                        </div>`;
                    break;
            }

            const el = document.createElement('div');
            el.className = 'block-card';
            el.id = blockId;
            el.setAttribute('role', 'listitem');

            const blockDef = BLOCK_TYPES.find(bt => bt.key === blockType);

            el.innerHTML = `
                <input type="hidden" name="parts[${partId}][blocks][${blockId}][block_type]" value="${blockType}">
                <input type="hidden" name="parts[${partId}][blocks][${blockId}][sort_order]" value="${blockCount}">
                <header class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${blockId}', event)" role="button" tabindex="0" aria-expanded="true">
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span aria-hidden="true"><i class="${blockDef.icon}"></i></span>
                        <span>${blockDef.label}</span>
                    </div>
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span class="part-chevron" id="bchev-${blockId}" aria-hidden="true"><i class="ti-angle-down"></i></span>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${blockId}', '${partId}', event)" aria-label="Remove ${blockDef.label} block">Remove</button>
                    </div>
                </header>
                <div class="card-body-collapse" id="bcollapse-${blockId}">
                    <div class="block-card-body">${bodyHtml}</div>
                </div>
            `;

            container.appendChild(el);
            updatePartBlockCount(partId);
            updateBlockSortOrders(partId);
        }

        function removeBlock(blockId, partId, e) {
            if (e) e.stopPropagation();
            Swal.fire({
                title: 'Remove this block?',
                text: 'This block will be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;
                const el = document.getElementById(blockId);
                if (el) el.remove();
                updatePartBlockCount(partId);
                updateBlockSortOrders(partId);
                Swal.fire({
                    title: 'Removed',
                    text: 'The block was removed successfully.',
                    icon: 'success',
                    timer: 1400,
                    showConfirmButton: false
                });
            });
        }

        function updatePartBlockCount(partId) {
            const container = document.getElementById('blocks-' + partId);
            const count = container ? container.children.length : 0;
            const badge = document.getElementById('pbc-' + partId);
            if (badge) {
                badge.textContent = `${count} block${count === 1 ? '' : 's'}`;
                badge.setAttribute('aria-label', `${count} block${count === 1 ? '' : 's'}`);
            }
        }

        function updateBlockSortOrders(partId) {
            const container = document.getElementById('blocks-' + partId);
            if (!container) return;
            const blocks = container.children;
            for (let i = 0; i < blocks.length; i++) {
                const sortInput = blocks[i].querySelector('input[name*="[sort_order]"]');
                if (sortInput) {
                    sortInput.value = i;
                }
            }
        }

        document.getElementById('pepsolForm').addEventListener('submit', function(e) {
            const lessonTitle = document.getElementById('lesson-title-1')?.value?.trim();
            if (!lessonTitle) {
                e.preventDefault();
                document.getElementById('lesson-title-1').classList.add('is-invalid');
                document.getElementById('err-lesson-title').style.display = 'block';
                toast('Please enter a session title.', 'bad');
                const lessonsBody = document.getElementById('body-lessons');
                if (lessonsBody && lessonsBody.style.display === 'none') {
                    lessonsBody.previousElementSibling?.click();
                }
                return false;
            }
            return true;
        });
    </script>
@endpush

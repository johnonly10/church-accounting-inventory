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
            max-height: 2000px;
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

        .block-card-body textarea.form-control {
            min-height: 180px;
        }

        .existing-file {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .existing-file img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
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
    <div class="container-fluid page-shell px-3 px-md-4 py-4">
        <x-page-title title="Edit Discipleship Module" active="Edit Discipleship Module" home="Discipleship"
            :home-route="route('leader.pepsol.index')" />

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="toast-region"></div>

        <form id="pepsolForm" action="{{ route('leader.pepsol.update', $pepsol->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="ewm-card">
                <div class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)">
                    <div>
                        <div class="ewm-card-title">Module Information</div>
                        <p class="ewm-card-subtitle">Ministry category, type, status, description, guidelines, and
                            orientation</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true">
                        <i class="ti-angle-down"></i>
                    </span>
                </div>

                <div class="ewm-card-body" id="body-info">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                Category <span class="text-optional">— optional</span>
                            </label>
                            <select id="f-cat" name="category" class="form-select">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category', $pepsol->pepsol_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                Type <span class="text-optional">— optional</span>
                            </label>
                            <select id="f-type" name="type" class="form-select">
                                <option value="">Select a type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type', $pepsol->pepsol_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">Status</label>
                            <div class="status-pills">
                                <label class="status-pill-label">
                                    <input type="radio" name="status" value="published"
                                        {{ old('status', $pepsol->status) === 'published' ? 'checked' : '' }}>
                                    <span class="status-dot"></span>
                                    Published
                                </label>
                                <label class="status-pill-label">
                                    <input type="radio" name="status" value="draft"
                                        {{ old('status', $pepsol->status) === 'draft' ? 'checked' : '' }}>
                                    <span class="status-dot"></span>
                                    Draft
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">
                                Description <span class="text-optional">— optional</span>
                            </label>
                            <textarea id="ta-desc" name="description" class="form-control" rows="6"
                                placeholder="Describe what this module covers, who it's for, and what members will grow in spiritually...">{{ old('description', $pepsol->description) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Guidelines <span class="text-optional">— optional</span></label>
                            <textarea id="ta-guidelines" name="guidelines" class="form-control" rows="5"
                                placeholder="Community guidelines or fellowship participation expectations...">{{ old('guidelines', $pepsol->rules) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Orientation <span class="text-optional">— optional</span></label>
                            <textarea id="ta-orient" name="orientation" class="form-control" rows="5"
                                placeholder="A pastoral welcome note or orientation for new members joining this group...">{{ old('orientation', $pepsol->orientation) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $firstLesson = $pepsol->lessons->first();
            @endphp

            <div class="ewm-card">
                <div class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)">
                    <div>
                        <div class="ewm-card-title">Teaching Session</div>
                        <p class="ewm-card-subtitle">One teaching session with sections and content blocks</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true">
                        <i class="ti-angle-down"></i>
                    </span>
                </div>

                <div class="ewm-card-body" id="body-lessons">
                    <div class="d-flex align-items-center mb-4">
                        <span class="lesson-badge mr-2">1</span>
                        <h5 class="mb-0 font-weight-bold" id="ld-1">{{ $firstLesson->title ?? 'Session 1' }}</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                Name <span class="text-optional">— optional</span>
                            </label>
                            <select id="pepsol-name" name="pepsol_name_id" class="form-select">
                                <option value="">Select a Name</option>
                                @foreach ($names as $name)
                                    <option value="{{ $name->id }}"
                                        {{ old('pepsol_name_id', $firstLesson->pepsol_name_id ?? '') == $name->id ? 'selected' : '' }}>
                                        {{ $name->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                Topic <span class="text-optional">— optional</span>
                            </label>
                            <select id="pepsol-topic" name="pepsol_topic_id" class="form-select">
                                <option value="">Select a Topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}"
                                        {{ old('pepsol_topic_id', $firstLesson->pepsol_topic_id ?? '') == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="lesson-title-1" name="lesson_title" class="form-control"
                                placeholder="e.g. Walking in the Spirit" oninput="onLessonTitleChange(this.value)"
                                value="{{ old('lesson_title', $firstLesson->title ?? '') }}">
                            <div class="invalid-feedback d-block" id="err-lesson-title" style="display:none!important">
                                Please enter a session title.
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Subtitle <span class="text-optional">— optional</span></label>
                            <input type="text" id="lesson-subtitle-1" name="lesson_subtitle" class="form-control"
                                placeholder="e.g. A study on Galatians 5"
                                value="{{ old('lesson_subtitle', $firstLesson->subtitle ?? '') }}">
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">Summary <span class="text-optional">— optional</span></label>
                            <textarea id="ta-lsum-1" name="lesson_summary" class="form-control" rows="4"
                                placeholder="What spiritual truths or biblical principles will members explore?">{{ old('lesson_summary', $firstLesson->summary ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Cover Image <span class="text-optional">— optional</span></label>
                            @if ($firstLesson && $firstLesson->image)
                                <div class="existing-file">
                                    <img src="{{ asset($firstLesson->image) }}" alt="Current cover">
                                    <div>
                                        <span class="text-muted small">Current image</span>
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_lesson_cover"
                                                value="1" id="removeCover">
                                            <label class="form-check-label small" for="removeCover">Remove image</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="lesson_cover" accept="image/*" class="form-control">
                            <small class="text-muted">Upload a new image to replace the existing one</small>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                                <div class="section-mini-title mb-0">Sections</div>
                                <button type="button" class="btn btn-primary btn-sm" id="btn-add-part-1"
                                    onclick="addPart(1)">
                                    <i class="ti-plus mr-1"></i> Add Section
                                </button>
                            </div>
                            <div id="parts-1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <x-buttons.form-action primaryTitle="Update Module" primaryId="updatePepsolBtn" :cancel-route="route('leader.pepsol.index')" />
        </form>
    </div>
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

        const BLOCK_DEFS = {
            body: {
                label: 'Body',
                icon: 'ti-align-left'
            },
            quote: {
                label: 'Quote',
                icon: 'fas fa-quote-left'
            },
            scripture: {
                label: 'Scripture',
                icon: 'fas fa-bible'
            },
            image: {
                label: 'Image',
                icon: 'ti-image'
            },
            video: {
                label: 'Video',
                icon: 'ti-video-camera'
            },
            file: {
                label: 'File',
                icon: 'ti-file'
            },
            url: {
                label: 'URL',
                icon: 'ti-link'
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            @if ($firstLesson && $firstLesson->parts->count() > 0)
                @foreach ($firstLesson->parts as $part)
                    loadExistingPart(@json($part));
                @endforeach
            @endif
        });

        function loadExistingPart(part) {
            partCounter++;
            const partId = `existing_part_${part.id}`;

            const pillsHtml = PART_TYPES.map(t => `
        <input type="radio" class="btn-check" name="existing_parts[${part.id}][type]" id="pt-${partId}-${t.key}" value="${t.key}" ${part.part_key === t.key ? 'checked' : ''} onchange="updatePartTypeLabel('${partId}', '${t.key}', '${t.label}'); updatePartTypeButtonsState('${partId}');">
        <label class="btn btn-outline-secondary btn-sm" id="lbl-${partId}-${t.key}" for="pt-${partId}-${t.key}">${t.label}</label>
    `).join('');

            const el = document.createElement('div');
            el.className = 'part-card';
            el.id = partId;

            const partTypeLabel = PART_TYPES.find(t => t.key === part.part_key)?.label || 'Unset';

            el.innerHTML = `
        <input type="hidden" name="existing_parts[${part.id}][id]" value="${part.id}">
        <div class="part-card-header d-flex align-items-center justify-content-between" onclick="togglePartCard('${partId}', event)">
            <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
                <span class="badge-soft secondary" id="ptag-${partId}">${partTypeLabel}</span>
                <span class="font-weight-bold" id="pname-${partId}">${partTypeLabel} Section</span>
                <span class="part-block-count" id="pbc-${partId}">0 blocks</span>
            </div>
            <div class="d-flex align-items-center" style="gap:8px;">
                <span class="part-chevron" id="pchev-${partId}"><i class="ti-angle-down"></i></span>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePart('${partId}', event)">Remove</button>
            </div>
        </div>
        <div class="card-body-collapse" id="pcollapse-${partId}">
            <div class="part-card-body">
                <div class="mb-4">
                    <label class="form-label">Section Type <span class="text-danger">*</span></label>
                    <div class="part-type-pills">${pillsHtml}</div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <div class="section-mini-title mb-0">Content Blocks</div>
                    <div class="blocks-toolbar">
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','body')"><i class="ti-align-left"></i> Body</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','quote')"><i class="fas fa-quote-left"></i> Quote</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','scripture')"><i class="fas fa-bible"></i> Scripture</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','image')"><i class="ti-image"></i> Image</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','video')"><i class="ti-video-camera"></i> Video</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','file')"><i class="ti-file"></i> File</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','url')"><i class="ti-link"></i> URL</button>
                    </div>
                </div>
                <div id="blocks-${partId}"></div>
            </div>
        </div>
    `;

            document.getElementById('parts-1').appendChild(el);

            if (part.blocks && part.blocks.length > 0) {
                part.blocks.forEach(block => {
                    loadExistingBlock(partId, part.id, block);
                });
            }

            updatePartBlockCount(partId);
            updatePartTypeButtonsState();
            updateBlockButtonsState(partId);
        }

        function loadExistingBlock(partId, partDbId, block) {
            blockCounter++;
            const blockId = `existing_block_${block.id}`;

            if (block.body) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][body][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][body][type]`;
                const bodyBlockId = `${blockId}_body`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = bodyBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="body">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${bodyBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="ti-align-left"></i></span>
                    <span>Body</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${bodyBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${bodyBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${bodyBlockId}">
                <div class="block-card-body">
                    <div>
                        <label class="form-label">Content</label>
                        <textarea name="${contentFieldName}" class="form-control" rows="8" placeholder="Write the teaching content or message notes here...">${block.body || ''}</textarea>
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.quote) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][quote][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][quote][type]`;
                const quoteBlockId = `${blockId}_quote`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = quoteBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="quote">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${quoteBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="fas fa-quote-left"></i></span>
                    <span>Quote</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${quoteBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${quoteBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${quoteBlockId}">
                <div class="block-card-body">
                    <div class="mb-3">
                        <label class="form-label">Quote</label>
                        <textarea name="${contentFieldName}[quote]" class="form-control" rows="4" placeholder="Enter the inspirational or theological quote here...">${block.quote || ''}</textarea>
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.scripture) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][scripture][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][scripture][type]`;
                const scriptureBlockId = `${blockId}_scripture`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = scriptureBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="scripture">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${scriptureBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="fas fa-bible"></i></span>
                    <span>Scripture</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${scriptureBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${scriptureBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${scriptureBlockId}">
                <div class="block-card-body">
                    <div class="mb-3">
                        <label class="form-label">Scripture</label>
                        <textarea name="${contentFieldName}[scripture]" class="form-control" rows="4" placeholder="Enter the scripture reference and text...">${block.scripture || ''}</textarea>
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.image) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][image][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][image][type]`;
                const imageBlockId = `${blockId}_image`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = imageBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="image">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${imageBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="ti-image"></i></span>
                    <span>Image</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${imageBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${imageBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${imageBlockId}">
                <div class="block-card-body">
                    <div class="existing-file mb-3">
                        <img src="{{ asset('') }}${block.image}" alt="Current image">
                        <span class="text-muted small">Current image</span>
                    </div>
                    <div>
                        <label class="form-label">Replace Image <span class="text-optional">— optional</span></label>
                        <input type="file" name="${contentFieldName}[image]" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.video) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][video][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][video][type]`;
                const videoBlockId = `${blockId}_video`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = videoBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="video">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${videoBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="ti-video-camera"></i></span>
                    <span>Video</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${videoBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${videoBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${videoBlockId}">
                <div class="block-card-body">
                    <div class="mb-3">
                        <span class="text-muted small">Current video: ${block.video.split('/').pop()}</span>
                    </div>
                    <div>
                        <label class="form-label">Replace Video <span class="text-optional">— optional</span></label>
                        <input type="file" name="${contentFieldName}[video]" class="form-control" accept="video/*">
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.file) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][file][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][file][type]`;
                const fileBlockId = `${blockId}_file`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = fileBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="file">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${fileBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="ti-file"></i></span>
                    <span>File</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${fileBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${fileBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${fileBlockId}">
                <div class="block-card-body">
                    <div class="mb-3">
                        <span class="text-muted small">Current file: ${block.file.split('/').pop()}</span>
                    </div>
                    <div>
                        <label class="form-label">Replace File <span class="text-optional">— optional</span></label>
                        <input type="file" name="${contentFieldName}[file]" class="form-control">
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            if (block.url) {
                const contentFieldName = `existing_parts[${partDbId}][blocks][${block.id}][url][content]`;
                const typeFieldName = `existing_parts[${partDbId}][blocks][${block.id}][url][type]`;
                const urlBlockId = `${blockId}_url`;

                const el = document.createElement('div');
                el.className = 'block-card';
                el.id = urlBlockId;

                el.innerHTML = `
            <input type="hidden" name="${typeFieldName}" value="url">
            <input type="hidden" name="existing_parts[${partDbId}][blocks][${block.id}][id]" value="${block.id}">
            <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${urlBlockId}', event)" style="cursor:pointer;">
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span><i class="ti-link"></i></span>
                    <span>URL</span>
                </div>
                <div class="d-flex align-items-center" style="gap:8px;">
                    <span class="part-chevron" id="bchev-${urlBlockId}"><i class="ti-angle-down"></i></span>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${urlBlockId}', '${partId}', event)">Remove</button>
                </div>
            </div>
            <div class="card-body-collapse" id="bcollapse-${urlBlockId}">
                <div class="block-card-body">
                    <div>
                        <label class="form-label">URL</label>
                        <input type="url" name="${contentFieldName}[url]" class="form-control" placeholder="https://example.com" value="${block.url || ''}">
                    </div>
                </div>
            </div>
        `;

                document.getElementById('blocks-' + partId).appendChild(el);
            }

            updatePartBlockCount(partId);
            updateBlockButtonsState(partId);
        }

        function toggleSection(headerEl) {
            const icon = headerEl.querySelector('[data-open]');
            const isOpen = icon.dataset.open === 'true';
            const body = headerEl.nextElementSibling;
            if (!body) return;
            body.style.display = isOpen ? 'none' : 'block';
            icon.dataset.open = isOpen ? 'false' : 'true';
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

            const allRadios = parts.querySelectorAll('input[type="radio"][name*="[type]"]');
            allRadios.forEach(radio => {
                const label = radio.nextElementSibling;
                const currentPartId = radio.closest('.part-card').id;

                if (existingTypes.includes(radio.value) && !radio.checked) {
                    radio.disabled = true;
                    if (label) {
                        label.style.opacity = '0.5';
                        label.style.cursor = 'not-allowed';
                        label.title = `This section type is already used in another section`;
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

        function checkExistingBlockTypes(partId) {
            const container = document.getElementById('blocks-' + partId);
            if (!container) return [];

            const existingTypes = [];
            const blocks = container.children;

            for (let i = 0; i < blocks.length; i++) {
                const block = blocks[i];
                const typeInput = block.querySelector('input[name*="[type]"]');
                if (typeInput && typeInput.value) {
                    existingTypes.push(typeInput.value);
                }
            }

            return existingTypes;
        }

        function updateBlockButtonsState(partId) {
            const existingTypes = checkExistingBlockTypes(partId);
            const partCard = document.getElementById(partId);
            if (!partCard) return;

            const addButtons = partCard.querySelectorAll('.add-block-btn');
            addButtons.forEach(btn => {
                const btnType = btn.getAttribute('onclick');
                let blockType = '';

                if (btnType.includes("'body'")) blockType = 'body';
                if (btnType.includes("'quote'")) blockType = 'quote';
                if (btnType.includes("'scripture'")) blockType = 'scripture';
                if (btnType.includes("'image'")) blockType = 'image';
                if (btnType.includes("'video'")) blockType = 'video';
                if (btnType.includes("'file'")) blockType = 'file';
                if (btnType.includes("'url'")) blockType = 'url';

                if (existingTypes.includes(blockType)) {
                    btn.disabled = true;
                    btn.style.opacity = '0.5';
                    btn.style.cursor = 'not-allowed';
                    btn.title = `This section already has a ${blockType} block`;
                } else {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                    btn.title = `Add ${blockType} block`;
                }
            });
        }

        function addPart(ln) {
            partCounter++;
            const partId = `part_${partCounter}`;

            const pillsHtml = PART_TYPES.map(t => `
        <input type="radio" class="btn-check" name="new_parts[${partId}][type]" id="pt-${partId}-${t.key}" value="${t.key}" onchange="updatePartTypeLabel('${partId}', '${t.key}', '${t.label}'); updatePartTypeButtonsState('${partId}');">
        <label class="btn btn-outline-secondary btn-sm" id="lbl-${partId}-${t.key}" for="pt-${partId}-${t.key}">${t.label}</label>
    `).join('');

            const el = document.createElement('div');
            el.className = 'part-card';
            el.id = partId;

            el.innerHTML = `
        <div class="part-card-header d-flex align-items-center justify-content-between" onclick="togglePartCard('${partId}', event)">
            <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
                <span class="badge-soft secondary" id="ptag-${partId}">Unset</span>
                <span class="font-weight-bold" id="pname-${partId}">Section ${partCounter}</span>
                <span class="part-block-count" id="pbc-${partId}">0 blocks</span>
            </div>
            <div class="d-flex align-items-center" style="gap:8px;">
                <span class="part-chevron" id="pchev-${partId}"><i class="ti-angle-down"></i></span>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePart('${partId}', event)">Remove</button>
            </div>
        </div>
        <div class="card-body-collapse" id="pcollapse-${partId}">
            <div class="part-card-body">
                <div class="mb-4">
                    <label class="form-label">Section Type <span class="text-danger">*</span></label>
                    <div class="part-type-pills">${pillsHtml}</div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <div class="section-mini-title mb-0">Content Blocks</div>
                    <div class="blocks-toolbar">
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','body')"><i class="ti-align-left"></i> Body</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','quote')"><i class="fas fa-quote-left"></i> Quote</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','scripture')"><i class="fas fa-bible"></i> Scripture</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','image')"><i class="ti-image"></i> Image</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','video')"><i class="ti-video-camera"></i> Video</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','file')"><i class="ti-file"></i> File</button>
                        <button type="button" class="add-block-btn" onclick="addBlock('${partId}','url')"><i class="ti-link"></i> URL</button>
                    </div>
                </div>
                <div id="blocks-${partId}"></div>
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
            if (!collapse || !chev || !card) return;
            const isCollapsed = collapse.classList.contains('collapsed');
            if (isCollapsed) {
                collapse.classList.remove('collapsed');
                chev.classList.remove('closed');
                card.classList.remove('is-collapsed');
            } else {
                collapse.classList.add('collapsed');
                chev.classList.add('closed');
                card.classList.add('is-collapsed');
            }
        }

        function toggleBlockCard(blockId, e) {
            if (e && e.target.closest('button, input, label, select, textarea, a')) return;
            const collapse = document.getElementById('bcollapse-' + blockId);
            const chev = document.getElementById('bchev-' + blockId);
            const card = document.getElementById(blockId);
            if (!collapse || !chev || !card) return;
            const isCollapsed = collapse.classList.contains('collapsed');
            if (isCollapsed) {
                collapse.classList.remove('collapsed');
                chev.classList.remove('closed');
                card.classList.remove('is-collapsed');
            } else {
                collapse.classList.add('collapsed');
                chev.classList.add('closed');
                card.classList.add('is-collapsed');
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

        function addBlock(partId, type) {
            const existingTypes = checkExistingBlockTypes(partId);
            if (existingTypes.includes(type)) {
                toast(`A ${type} block already exists in this section. Only one ${type} block is allowed per section.`,
                    'bad');
                return;
            }

            blockCounter++;
            const blockId = `block_${blockCounter}`;
            const partCard = document.getElementById(partId);
            const isExistingPart = partId.startsWith('existing_part_');

            let contentFieldName, typeFieldName;

            if (isExistingPart) {
                const partDbId = partId.replace('existing_part_', '');
                contentFieldName = `existing_parts[${partDbId}][new_blocks][${blockId}][content]`;
                typeFieldName = `existing_parts[${partDbId}][new_blocks][${blockId}][type]`;
            } else {
                contentFieldName = `new_parts[${partId}][blocks][${blockId}][content]`;
                typeFieldName = `new_parts[${partId}][blocks][${blockId}][type]`;
            }

            let bodyHtml = '';

            if (type === 'body') {
                bodyHtml = `
            <div>
                <label class="form-label">Content</label>
                <textarea name="${contentFieldName}" class="form-control" rows="8" placeholder="Write the teaching content or message notes here..."></textarea>
            </div>`;
            }

            if (type === 'quote') {
                bodyHtml = `
            <div class="mb-3">
                <label class="form-label">Quote</label>
                <textarea name="${contentFieldName}[quote]" class="form-control" rows="4" placeholder="Enter the inspirational or theological quote here..."></textarea>
            </div>`;
            }

            if (type === 'scripture') {
                bodyHtml = `
            <div class="mb-3">
                <label class="form-label">Scripture</label>
                <textarea name="${contentFieldName}[scripture]" class="form-control" rows="4" placeholder="Enter the scripture reference and text..."></textarea>
            </div>`;
            }

            if (type === 'image') {
                bodyHtml = `
            <div>
                <label class="form-label">Image <span class="text-optional">— optional</span></label>
                <input type="file" name="${contentFieldName}[image]" class="form-control" accept="image/*">
            </div>`;
            }

            if (type === 'video') {
                bodyHtml = `
            <div>
                <label class="form-label">Video <span class="text-optional">— optional</span></label>
                <input type="file" name="${contentFieldName}[video]" class="form-control" accept="video/*">
            </div>`;
            }

            if (type === 'file') {
                bodyHtml = `
            <div>
                <label class="form-label">File <span class="text-optional">— optional</span></label>
                <input type="file" name="${contentFieldName}[file]" class="form-control">
            </div>`;
            }

            if (type === 'url') {
                bodyHtml = `
            <div>
                <label class="form-label">URL</label>
                <input type="url" name="${contentFieldName}[url]" class="form-control" placeholder="https://example.com">
            </div>`;
            }

            const container = document.getElementById('blocks-' + partId);
            const el = document.createElement('div');
            el.className = 'block-card';
            el.id = blockId;

            el.innerHTML = `
        <input type="hidden" name="${typeFieldName}" value="${type}">
        <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${blockId}', event)" style="cursor:pointer;">
            <div class="d-flex align-items-center" style="gap:8px;">
                <span><i class="${BLOCK_DEFS[type].icon}"></i></span>
                <span>${BLOCK_DEFS[type].label}</span>
            </div>
            <div class="d-flex align-items-center" style="gap:8px;">
                <span class="part-chevron" id="bchev-${blockId}"><i class="ti-angle-down"></i></span>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${blockId}', '${partId}', event)">Remove</button>
            </div>
        </div>
        <div class="card-body-collapse" id="bcollapse-${blockId}">
            <div class="block-card-body">${bodyHtml}</div>
        </div>
    `;

            container.appendChild(el);
            updatePartBlockCount(partId);
            updateBlockButtonsState(partId);
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
                updateBlockButtonsState(partId);
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
            if (badge) badge.textContent = `${count} block${count === 1 ? '' : 's'}`;
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

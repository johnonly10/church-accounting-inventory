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
    <div class="container-fluid page-shell px-3 px-md-4 py-4">
        <x-page-title title="Create Discipleship Module" active="Create Discipleship Module" home="Discipleship"
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

        <form id="pepsolForm" action="{{ route('leader.pepsol.store') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return handleSubmit(event)">
            @csrf

            <input type="hidden" name="payload" id="hidden-payload">

            <div class="ewm-card">
                <div class="ewm-card-header d-flex align-items-center justify-content-between"
                    onclick="toggleSection(this)">
                    <div>
                        <div class="ewm-card-title">Module Information</div>
                        <p class="ewm-card-subtitle">Ministry category, type, title, description, guidelines, and
                            orientation</p>
                    </div>
                    <span class="ewm-toggle-icon" data-open="true">
                        <i class="ti-angle-down"></i>
                    </span>
                </div>

                <div class="ewm-card-body" id="body-info">
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select id="f-cat" name="category" class="form-select" onchange="onFieldChange()">
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select a category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback d-block" id="err-cat" style="display:none!important">
                                Please select a category.
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select id="f-type" name="type" class="form-select" onchange="onFieldChange()">
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select a type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback d-block" id="err-type" style="display:none!important">Please
                                select a type.</div>
                        </div>



                        <div class="col-12 mb-4">
                            <label class="form-label">Description <span class="text-optional">— optional</span></label>
                            <textarea id="ta-desc" name="description" class="form-control" rows="6"
                                placeholder="Describe what this module covers, who it's for, and what members will grow in spiritually..."
                                oninput="onFieldChange()">{{ old('description') }}</textarea>
                            <div class="invalid-feedback d-block" id="err-desc" style="display:none!important">Please add a
                                description.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Guidelines <span class="text-optional">— optional</span></label>
                            <textarea id="ta-rules" name="rules" class="form-control" rows="5"
                                placeholder="Community guidelines or fellowship participation expectations...">{{ old('rules') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Orientation <span class="text-optional">— optional</span></label>
                            <textarea id="ta-orient" name="orientation" class="form-control" rows="5"
                                placeholder="A pastoral welcome note or orientation for new members joining this group...">{{ old('orientation') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

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
                        <h5 class="mb-0 font-weight-bold" id="ld-1">Session 1</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" id="lesson-title-1" class="form-control"
                                placeholder="e.g. Walking in the Spirit" oninput="setLTitle(1,this.value)">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Subtitle <span class="text-optional">— optional</span></label>
                            <input type="text" id="lesson-subtitle-1" class="form-control"
                                placeholder="e.g. A study on Galatians 5">
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label">Summary <span class="text-optional">— optional</span></label>
                            <textarea id="ta-lsum-1" class="form-control" rows="4"
                                placeholder="What spiritual truths or biblical principles will members explore?"></textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Cover Image <span class="text-optional">— optional</span></label>
                            <input type="file" name="lesson_cover" accept="image/*" class="form-control">
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
        </form>
    </div>

    <div class="fixed-bottom-bar">
        <div class="bottom-bar-inner">
            <div class="bar-meta">
                <span class="bar-dot" id="bar-dot"></span>
                <div>
                    <div class="bar-name" id="bar-name">Untitled</div>
                    <div class="bar-status" id="bar-status">Fill required fields</div>
                </div>
            </div>
        </div>
    </div>

    <x-buttons.form-action primaryTitle="Create Module" primaryId="createPepsolBtn" :cancel-route="route('leader.pepsol-types.index')" />
@endsection

@push('scripts')
    <script src="{{ asset('vendors/package/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
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

        function onNameInput(val) {
            document.getElementById('bar-name').textContent = val.trim() || 'Untitled';
            onFieldChange();
        }

        function onFieldChange() {
            const n = document.getElementById('f-name').value.trim();
            const c = document.getElementById('f-cat').value;
            const t = document.getElementById('f-type')?.value;
            const d = document.getElementById('ta-desc')?.value.trim();
            const ok = !!(n && c && t && d);
            document.getElementById('bar-status').textContent = ok ? 'Ready to save' : 'Fill required fields';
            const dot = document.getElementById('bar-dot');
            if (dot) dot.classList.toggle('ready', ok);
        }

        function setLTitle(n, val) {
            const el = document.getElementById('ld-' + n);
            if (el) el.textContent = val.trim() || ('Session ' + n);
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

        const usedPartTypes = {
            1: new Set()
        };
        const partTypeByPid = {};
        const partCount = {
            1: 0
        };
        const blockCount = {};
        let blockSeq = 0;

        function updateAddPartButtonState(ln) {
            const btn = document.getElementById(`btn-add-part-${ln}`);
            if (!btn) return;
            btn.disabled = (usedPartTypes[ln] || new Set()).size >= PART_TYPES.length;
        }

        function updateAllPartTypeAvailability(ln) {
            const used = usedPartTypes[ln] || new Set();
            document.querySelectorAll(`#parts-${ln} .part-card`).forEach(partEl => {
                const pid = partEl.dataset.pid;
                const current = partTypeByPid[pid] || null;
                PART_TYPES.forEach(t => {
                    const input = document.getElementById(`pt-${pid}-${t.key}`);
                    const label = document.getElementById(`lbl-${pid}-${t.key}`);
                    if (!input || !label) return;
                    const shouldDisable = used.has(t.key) && current !== t.key;
                    input.disabled = shouldDisable;
                    label.classList.toggle('disabled', shouldDisable);
                });
            });
            updateAddPartButtonState(ln);
        }

        function updatePartBlockCount(pid) {
            const count = document.querySelectorAll(`#blocks-${pid} > .block-card`).length;
            const badge = document.getElementById('pbc-' + pid);
            if (badge) badge.textContent = `${count} block${count === 1 ? '' : 's'}`;
        }

        function badgeClassByType(type) {
            if (type === 'header') return 'badge-soft info';
            if (type === 'body') return 'badge-soft';
            if (type === 'end') return 'badge-soft warning';
            if (type === 'conclusion') return 'badge-soft secondary';
            return 'badge-soft secondary';
        }

        function togglePartCard(pid, e) {
            if (e && e.target.closest('button, input, label, select, textarea, a')) return;
            const collapse = document.getElementById('pcollapse-' + pid);
            const chev = document.getElementById('pchev-' + pid);
            const card = document.querySelector(`.part-card[data-pid="${pid}"]`);
            const badge = document.getElementById('pbc-' + pid);
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
            if (badge) {
                const count = document.getElementById('blocks-' + pid)?.children.length || 0;
                badge.textContent = `${count} block${count === 1 ? '' : 's'}`;
            }
        }

        function toggleBlockCard(bid, e) {
            if (e && e.target.closest('button, input, label, select, textarea, a')) return;
            const collapse = document.getElementById('bcollapse-' + bid);
            const chev = document.getElementById('bchev-' + bid);
            const card = document.getElementById('block-' + bid);
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

        function addPart(ln) {
            const used = usedPartTypes[ln] || (usedPartTypes[ln] = new Set());
            if (used.size >= PART_TYPES.length) {
                toast('All section types have already been added.', 'bad');
                updateAddPartButtonState(ln);
                return;
            }

            partCount[ln] = (partCount[ln] || 0) + 1;
            const pn = partCount[ln];
            const pid = `${ln}_${pn}`;
            blockCount[pid] = 0;

            const pillsHtml = PART_TYPES.map(t => `
                <input type="radio" class="btn-check" name="pt-${pid}" id="pt-${pid}-${t.key}" value="${t.key}" onchange="setPartType('${pid}','${t.key}')">
                <label class="btn btn-outline-secondary btn-sm" id="lbl-${pid}-${t.key}" for="pt-${pid}-${t.key}">${t.label}</label>
            `).join('');

            const el = document.createElement('div');
            el.className = 'part-card';
            el.dataset.pid = pid;

            el.innerHTML = `
                <div class="part-card-header d-flex align-items-center justify-content-between" onclick="togglePartCard('${pid}', event)">
                    <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
                        <span class="badge-soft secondary" id="ptag-${pid}">Unset</span>
                        <span class="font-weight-bold" id="pname-${pid}">Section ${pn}</span>
                        <span class="part-block-count" id="pbc-${pid}">0 blocks</span>
                    </div>
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span class="part-chevron" id="pchev-${pid}"><i class="ti-angle-down"></i></span>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePart('${pid}', event)">Remove</button>
                    </div>
                </div>
                <div class="card-body-collapse" id="pcollapse-${pid}">
                    <div class="part-card-body">
                        <div class="mb-4">
                            <label class="form-label">Part Type <span class="text-danger">*</span></label>
                            <div class="part-type-pills">${pillsHtml}</div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                            <div class="section-mini-title mb-0">Content Blocks</div>
                            <div class="blocks-toolbar">
                                <button type="button" class="add-block-btn" onclick="addBlock('${pid}','body')"><i class="ti-align-left"></i> Body</button>
                                <button type="button" class="add-block-btn" onclick="addBlock('${pid}','quote')"><i class="fas fa-quote-left"></i> Quote</button>
                                <button type="button" class="add-block-btn" onclick="addBlock('${pid}','scripture')"><i class="ti-book"></i> Scripture</button>
                                <button type="button" class="add-block-btn" onclick="addBlock('${pid}','media')"><i class="ti-image"></i> Media</button>
                                <button type="button" class="add-block-btn" onclick="addBlock('${pid}','url')"><i class="ti-link"></i> URL</button>
                            </div>
                        </div>
                        <div id="blocks-${pid}"></div>
                    </div>
                </div>
            `;

            document.getElementById('parts-' + ln).appendChild(el);
            updateAllPartTypeAvailability(ln);
            updateAddPartButtonState(ln);
            updatePartBlockCount(pid);
            setTimeout(() => el.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            }), 60);
        }

        function removePart(pid, e) {
            if (e) e.stopPropagation();
            Swal.fire({
                title: 'Remove this part?',
                text: 'This section and all of its content blocks will be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;
                const ln = parseInt(pid.split('_')[0], 10);
                const prev = partTypeByPid[pid];
                if (prev) {
                    usedPartTypes[ln]?.delete(prev);
                    delete partTypeByPid[pid];
                }
                const el = [...document.querySelectorAll('.part-card')].find(x => x.dataset.pid === pid);
                if (el) el.remove();
                updateAllPartTypeAvailability(ln);
                Swal.fire({
                    title: 'Removed',
                    text: 'The section was removed successfully.',
                    icon: 'success',
                    timer: 1400,
                    showConfirmButton: false
                });
            });
        }

        function setPartType(pid, key) {
            const ln = parseInt(pid.split('_')[0], 10);
            const used = usedPartTypes[ln] || (usedPartTypes[ln] = new Set());
            const prev = partTypeByPid[pid] || null;
            if (prev === key) return;
            if (used.has(key) && prev !== key) {
                toast('That section type has already been used.', 'bad');
                if (prev) {
                    const prevRadio = document.getElementById(`pt-${pid}-${prev}`);
                    if (prevRadio) prevRadio.checked = true;
                }
                return;
            }
            if (prev) used.delete(prev);
            used.add(key);
            partTypeByPid[pid] = key;
            const t = PART_TYPES.find(x => x.key === key);
            const tag = document.getElementById('ptag-' + pid);
            const name = document.getElementById('pname-' + pid);
            if (tag && t) {
                tag.textContent = t.label;
                tag.className = badgeClassByType(key);
            }
            if (name && t) name.textContent = t.label + ' Section';
            updateAllPartTypeAvailability(ln);
        }

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
                icon: 'ti-book'
            },
            media: {
                label: 'Media',
                icon: 'ti-image'
            },
            url: {
                label: 'URL',
                icon: 'ti-link'
            }
        };

        function addBlock(pid, type) {
            blockCount[pid] = (blockCount[pid] || 0) + 1;
            blockSeq++;
            const bid = `${pid}_b${blockCount[pid]}`;
            const taId = `ta-blk-${blockSeq}`;

            let bodyHtml = '';

            if (type === 'body') {
                bodyHtml = `
                    <div>
                        <label class="form-label">Content</label>
                        <textarea id="${taId}" class="form-control" rows="5" placeholder="Write the teaching content or message notes here..."></textarea>
                    </div>
                `;
            }

            if (type === 'quote') {
                bodyHtml = `
                    <div class="mb-3">
                        <label class="form-label">Quote</label>
                        <textarea id="${taId}" class="form-control" rows="4" placeholder="Enter the inspirational or theological quote here..."></textarea>
                    </div>
                    <div>
                        <label class="form-label">Attribution <span class="text-optional">— optional</span></label>
                        <input type="text" class="form-control" placeholder="Author or source">
                    </div>
                `;
            }

            if (type === 'scripture') {
                bodyHtml = `
                    <div class="mb-3 table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Version</th>
                                    <th>Language</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="John 3:16"></td>
                                    <td><input type="text" class="form-control" placeholder="NIV"></td>
                                    <td><input type="text" class="form-control" placeholder="English"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label class="form-label">Text</label>
                        <textarea id="${taId}" class="form-control" rows="4" placeholder="Paste the scripture text..."></textarea>
                    </div>
                `;
            }

            if (type === 'media') {
                bodyHtml = `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Video</label>
                            <input type="file" class="form-control" accept="video/*">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">File</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Caption <span class="text-optional">— optional</span></label>
                            <input type="text" class="form-control" placeholder="Describe this media">
                        </div>
                    </div>
                `;
            }

            if (type === 'url') {
                bodyHtml = `
                    <div class="mb-3">
                        <label class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" placeholder="https://example.com">
                    </div>
                    <div>
                        <label class="form-label">Label <span class="text-optional">— optional</span></label>
                        <input type="text" class="form-control" placeholder="Friendly display name">
                    </div>
                `;
            }

            const container = document.getElementById('blocks-' + pid);
            const el = document.createElement('div');
            el.className = 'block-card';
            el.id = 'block-' + bid;
            el.dataset.type = type;
            el.dataset.taid = taId;

            el.innerHTML = `
                <div class="block-card-header d-flex align-items-center justify-content-between" onclick="toggleBlockCard('${bid}', event)" style="cursor:pointer;">
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span><i class="${BLOCK_DEFS[type].icon}"></i></span>
                        <span>${BLOCK_DEFS[type].label}</span>
                    </div>
                    <div class="d-flex align-items-center" style="gap:8px;">
                        <span class="part-chevron" id="bchev-${bid}"><i class="ti-angle-down"></i></span>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeBlock('${bid}', event)">Remove</button>
                    </div>
                </div>
                <div class="card-body-collapse" id="bcollapse-${bid}">
                    <div class="block-card-body">${bodyHtml}</div>
                </div>
            `;

            container.appendChild(el);
            updatePartBlockCount(pid);
        }

        function removeBlock(bid, e) {
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
                const el = document.getElementById('block-' + bid);
                if (!el) return;
                const parts = bid.split('_');
                const pid = `${parts[0]}_${parts[1]}`;
                el.remove();
                updatePartBlockCount(pid);
                Swal.fire({
                    title: 'Removed',
                    text: 'The block was removed successfully.',
                    icon: 'success',
                    timer: 1400,
                    showConfirmButton: false
                });
            });
        }

        function getTextareaValue(taId) {
            const ta = document.getElementById(taId);
            return ta ? ta.value.trim() : '';
        }

        function serializePayload() {
            const parts = [];

            document.querySelectorAll('#parts-1 .part-card').forEach(partEl => {
                const pid = partEl.dataset.pid;
                const partType = partTypeByPid[pid] || null;
                const blocks = [];

                document.querySelectorAll(`#blocks-${pid} > .block-card`).forEach(blockEl => {
                    const type = blockEl.dataset.type || null;
                    const taId = blockEl.dataset.taid || null;
                    const blockData = {
                        type
                    };

                    if (type === 'body' && taId) {
                        blockData.text = getTextareaValue(taId);
                    }

                    if (type === 'quote') {
                        const inputs = blockEl.querySelectorAll('input');
                        blockData.text = taId ? getTextareaValue(taId) : '';
                        blockData.attribution = inputs[0]?.value?.trim() || '';
                    }

                    if (type === 'scripture') {
                        const inputs = blockEl.querySelectorAll('input');
                        blockData.reference = inputs[0]?.value?.trim() || '';
                        blockData.version = inputs[1]?.value?.trim() || '';
                        blockData.language = inputs[2]?.value?.trim() || '';
                        blockData.text = taId ? getTextareaValue(taId) : '';
                    }

                    if (type === 'media') {
                        const inputs = blockEl.querySelectorAll('input');
                        blockData.caption = inputs[3]?.value?.trim() || '';
                    }

                    if (type === 'url') {
                        const inputs = blockEl.querySelectorAll('input');
                        blockData.url = inputs[0]?.value?.trim() || '';
                        blockData.label = inputs[1]?.value?.trim() || '';
                    }

                    blocks.push(blockData);
                });

                parts.push({
                    pid,
                    type: partType,
                    blocks
                });
            });

            return {
                lesson: {
                    title: document.getElementById('lesson-title-1')?.value?.trim() || '',
                    subtitle: document.getElementById('lesson-subtitle-1')?.value?.trim() || '',
                    summary: document.getElementById('ta-lsum-1')?.value?.trim() || '',
                    parts
                }
            };
        }

        function handleSubmit(e) {
            const name = document.getElementById('f-name').value.trim();
            const cat = document.getElementById('f-cat').value;
            const type = document.getElementById('f-type').value;
            const desc = document.getElementById('ta-desc')?.value.trim();

            let ok = true;

            if (!cat) {
                document.getElementById('f-cat').classList.add('is-invalid');
                document.getElementById('err-cat').style.setProperty('display', 'block', 'important');
                ok = false;
            } else {
                document.getElementById('f-cat').classList.remove('is-invalid');
                document.getElementById('err-cat').style.setProperty('display', 'none', 'important');
            }

            if (!type) {
                document.getElementById('f-type').classList.add('is-invalid');
                document.getElementById('err-type').style.setProperty('display', 'block', 'important');
                ok = false;
            } else {
                document.getElementById('f-type').classList.remove('is-invalid');
                document.getElementById('err-type').style.setProperty('display', 'none', 'important');
            }

            if (!name) {
                document.getElementById('f-name').classList.add('is-invalid');
                document.getElementById('err-name').style.setProperty('display', 'block', 'important');
                ok = false;
            } else {
                document.getElementById('f-name').classList.remove('is-invalid');
                document.getElementById('err-name').style.setProperty('display', 'none', 'important');
            }

            if (!desc) {
                document.getElementById('ta-desc').classList.add('is-invalid');
                document.getElementById('err-desc').style.setProperty('display', 'block', 'important');
                ok = false;
            } else {
                document.getElementById('ta-desc').classList.remove('is-invalid');
                document.getElementById('err-desc').style.setProperty('display', 'none', 'important');
            }

            if (!ok) {
                e.preventDefault();
                toast('Please fill in all required fields.', 'bad');
                const infoBody = document.getElementById('body-info');
                if (infoBody && infoBody.style.display === 'none') {
                    infoBody.previousElementSibling?.click();
                }
                return false;
            }

            document.getElementById('hidden-payload').value = JSON.stringify(serializePayload());
            document.getElementById('bar-status').textContent = 'Saving...';
            return true;
        }

        window.onload = () => {
            updateAddPartButtonState(1);
            onFieldChange();
        };
    </script>
@endpush

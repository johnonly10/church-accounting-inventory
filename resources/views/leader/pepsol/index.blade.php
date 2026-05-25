@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        {{-- <x-page-title title="Pepsols" active="Pepsols" :dashboard="route('leader.pepsols.index')" /> --}}

        <div class="white-card">
            <div class="white-card-header">
                <h4 class="white-card-title">Pepsols</h4>
                <a href="{{ route('leader.pepsol.create') }}" class="btn-create">
                    <svg viewBox="0 0 16 16">
                        <path d="M8 3v10M3 8h10" stroke-linecap="round" />
                    </svg>
                    New Pepsol
                </a>
            </div>

            <div id="ajax-results-container">

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-label">Total Pepsols</div>
                        <div class="stat-value"><em id="total-stat-value">12</em></div>
                        <div class="stat-sub" id="total-stat-sub">across 6 categories</div>
                    </div>
                </div>

                <div class="toolbar">
                    <div class="search-wrap">
                        <svg viewBox="0 0 16 16">
                            <circle cx="6.5" cy="6.5" r="4" />
                            <path d="M10 10l3 3" stroke-linecap="round" />
                        </svg>
                        <input type="text" class="search-input" placeholder="Search pepsols…"
                            oninput="onSearch(this.value)">
                    </div>
                    <div class="toolbar-right">
                        <select class="filter-select" onchange="onSort(this.value)">
                            <option value="recent">Most Recent</option>
                            <option value="alpha">A → Z</option>
                            <option value="lessons">Most Lessons</option>
                        </select>
                        <div class="view-toggle">
                            <button class="view-btn active" title="Grid view" onclick="setView('grid', this)">
                                <svg viewBox="0 0 16 16">
                                    <rect x="2" y="2" width="5" height="5" rx="1" />
                                    <rect x="9" y="2" width="5" height="5" rx="1" />
                                    <rect x="2" y="9" width="5" height="5" rx="1" />
                                    <rect x="9" y="9" width="5" height="5" rx="1" />
                                </svg>
                            </button>
                            <button class="view-btn" title="List view" onclick="setView('list', this)">
                                <svg viewBox="0 0 16 16">
                                    <path d="M2 4h12M2 8h12M2 12h12" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="results-label" id="results-label">
                    Showing <strong>12</strong> pepsols
                </div>

                <div class="pepsol-grid" id="pepsol-grid"></div>

                <x-sweet-alert entity="Pepsol" />

            </div>
        </div>

    </div>

    <div id="ctx-menu" class="ctx-menu" style="display:none;"></div>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            --ink: #0f0e17;
            --ink-60: #5c5a6e;
            --ink-30: #b0aebf;
            --ink-10: #eeedf3;
            --ink-05: #f7f7fa;
            --indigo: #6366f1;
            --indigo-dark: #4f46e5;
            --indigo-mid: #818cf8;
            --indigo-bg: #f0f0fe;
            --indigo-soft: #e0e7ff;
            --white: #ffffff;
            --line: #e4e3ec;
            --danger: #e03e3e;
            --success: #16a34a;
            --amber: #d97706;
            --r: 10px;
            --r-sm: 6px;
        }

        .white-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r);
            padding: 24px;
            margin-bottom: 24px;
        }

        .white-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .white-card-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
        }

        .btn-create {
            font-size: 13.5px;
            font-weight: 600;
            background: var(--indigo);
            color: white;
            border: none;
            border-radius: var(--r-sm);
            padding: 10px 18px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
            text-decoration: none;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-create svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 2.2;
            fill: none;
        }

        .btn-create:hover {
            background: var(--indigo-dark);
            color: white;
        }

        .btn-create:active {
            transform: translateY(1px);
        }

        .stats-row {
            display: grid;
            grid-template-columns: 1fr;
            max-width: 280px;
            gap: 12px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r);
            padding: 16px 18px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--ink-30);
            margin-bottom: 6px;
        }

        .stat-value {
            font-family: 'Libre Baskerville', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .stat-value em {
            font-style: normal;
            color: var(--indigo);
        }

        .stat-sub {
            font-size: 11.5px;
            color: var(--ink-30);
            font-weight: 300;
            margin-top: 4px;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 320px;
        }

        .search-wrap svg {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            stroke: var(--ink-30);
            stroke-width: 1.8;
            fill: none;
            pointer-events: none;
        }

        .search-input {
            font-size: 13px;
            font-weight: 400;
            color: var(--ink);
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-sm);
            padding: 8px 12px 8px 33px;
            width: 100%;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .search-input::placeholder {
            color: var(--ink-30);
            font-weight: 300;
        }

        .search-input:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }

        .filter-select {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--ink-60);
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-sm);
            padding: 7px 28px 7px 10px;
            cursor: pointer;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%23b0aebf' stroke-width='1.3' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 9px center;
            transition: border-color 0.12s;
        }

        .filter-select:hover,
        .filter-select:focus {
            border-color: var(--indigo-mid);
            color: var(--ink);
        }

        .view-toggle {
            display: flex;
            gap: 2px;
        }

        .view-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--line);
            background: var(--white);
            border-radius: var(--r-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink-30);
            transition: all 0.12s;
        }

        .view-btn:hover {
            color: var(--ink);
            border-color: var(--ink-30);
        }

        .view-btn.active {
            background: var(--indigo-bg);
            border-color: var(--indigo-soft);
            color: var(--indigo);
        }

        .view-btn svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
        }

        .results-label {
            font-size: 12px;
            color: var(--ink-30);
            font-weight: 300;
            margin-bottom: 14px;
        }

        .results-label strong {
            color: var(--ink-60);
            font-weight: 600;
        }

        .pepsol-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .pepsol-grid.list-view {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .pcard {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r);
            overflow: hidden;
            cursor: pointer;
            transition: border-color 0.15s, box-shadow 0.15s, transform 0.15s;
            animation: fadeUp 0.25s ease both;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .pcard:hover {
            border-color: var(--indigo-mid);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.12);
            transform: translateY(-2px);
        }

        .pcard:active {
            transform: none;
        }

        .pcard-stripe {
            height: 3px;
            width: 100%;
        }

        .pcard-body {
            padding: 16px 18px;
            flex: 1;
        }

        .pcard-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .pcard-cat {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--ink-30);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pcard-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .pcard-menu {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-30);
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 16px;
            line-height: 1;
            flex-shrink: 0;
            opacity: 0;
            transition: opacity 0.15s;
        }

        .pcard:hover .pcard-menu {
            opacity: 1;
        }

        .pcard-menu:hover {
            color: var(--ink);
            background: var(--ink-10);
        }

        .pcard-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.35;
            margin-bottom: 6px;
            letter-spacing: -0.2px;
        }

        .pcard-desc {
            font-size: 12.5px;
            color: var(--ink-60);
            font-weight: 300;
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .pcard-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .pcard-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            color: var(--ink-30);
            font-weight: 400;
        }

        .pcard-meta-item svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
            flex-shrink: 0;
        }

        .pcard-footer {
            padding: 10px 18px;
            border-top: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ink-05);
        }

        .pcard-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status--published .status-dot {
            background: var(--success);
        }

        .status--published {
            color: var(--success);
        }

        .status--draft .status-dot {
            background: var(--amber);
        }

        .status--draft {
            color: var(--amber);
        }

        .status--archived .status-dot {
            background: var(--ink-30);
        }

        .status--archived {
            color: var(--ink-30);
        }

        .pcard-date {
            font-size: 11px;
            color: var(--ink-30);
            font-weight: 300;
        }

        .pepsol-grid.list-view .pcard {
            flex-direction: row;
            align-items: stretch;
        }

        .pepsol-grid.list-view .pcard-stripe {
            width: 4px;
            height: auto;
            flex-shrink: 0;
        }

        .pepsol-grid.list-view .pcard-body {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 14px 18px;
            flex: 1;
        }

        .pepsol-grid.list-view .pcard-top {
            flex-direction: column;
            gap: 3px;
            min-width: 180px;
            margin-bottom: 0;
        }

        .pepsol-grid.list-view .pcard-title {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .pepsol-grid.list-view .pcard-desc {
            margin-bottom: 0;
            -webkit-line-clamp: 1;
            flex: 1;
        }

        .pepsol-grid.list-view .pcard-meta {
            flex: 0;
            gap: 16px;
            flex-shrink: 0;
        }

        .pepsol-grid.list-view .pcard-footer {
            border-top: none;
            border-left: 1px solid var(--line);
            padding: 0 16px;
            background: transparent;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            gap: 4px;
            min-width: 120px;
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 60px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .empty-icon {
            width: 52px;
            height: 52px;
            background: var(--indigo-bg);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--indigo);
        }

        .empty-icon svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 1.5;
            fill: none;
        }

        .empty-title {
            font-family: 'Libre Baskerville', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
        }

        .empty-text {
            font-size: 13px;
            color: var(--ink-60);
            font-weight: 300;
            max-width: 280px;
            line-height: 1.6;
        }

        .ctx-menu {
            position: fixed;
            z-index: 500;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--r-sm);
            box-shadow: 0 8px 24px rgba(15, 14, 23, 0.12);
            padding: 4px;
            min-width: 160px;
            animation: menuIn 0.12s ease;
        }

        @keyframes menuIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(-4px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .ctx-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-60);
            cursor: pointer;
            transition: background 0.1s, color 0.1s;
        }

        .ctx-item:hover {
            background: var(--ink-05);
            color: var(--ink);
        }

        .ctx-item.danger:hover {
            background: #fff1f1;
            color: var(--danger);
        }

        .ctx-item svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
            flex-shrink: 0;
        }

        .ctx-divider {
            height: 1px;
            background: var(--line);
            margin: 3px 0;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 900px) {
            .pepsol-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 720px) {
            .pepsol-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .toolbar {
                flex-wrap: wrap;
            }
        }
    </style>

    <script>
        const CATS = [{
                name: 'Bible Study',
                color: '#6366f1',
                count: 3
            },
            {
                name: 'Youth Group',
                color: '#ec4899',
                count: 2
            },
            {
                name: 'Adult Education',
                color: '#f59e0b',
                count: 2
            },
            {
                name: "Children's Ministry",
                color: '#10b981',
                count: 2
            },
            {
                name: 'Leadership',
                color: '#3b82f6',
                count: 2
            },
            {
                name: 'Devotional',
                color: '#8b5cf6',
                count: 1
            },
        ];

        const PEPSOLS = [{
                id: 1,
                title: 'Foundations of Faith',
                cat: 'Bible Study',
                desc: 'A deep dive into the core principles that shape Christian belief, designed for new believers and those seeking to strengthen their spiritual foundation.',
                lessons: 6,
                status: 'published',
                date: 'Jun 12, 2025'
            },
            {
                id: 2,
                title: 'Youth Leadership Camp',
                cat: 'Youth Group',
                desc: 'A dynamic weekend intensive that equips young leaders with practical tools for serving their communities and living with purpose.',
                lessons: 4,
                status: 'published',
                date: 'Jun 8, 2025'
            },
            {
                id: 3,
                title: 'The Sermon on the Mount',
                cat: 'Bible Study',
                desc: "An in-depth study of Jesus' most famous teaching, exploring the Beatitudes and their application to modern life.",
                lessons: 8,
                status: 'published',
                date: 'May 30, 2025'
            },
            {
                id: 4,
                title: 'Parenting with Purpose',
                cat: 'Adult Education',
                desc: 'Practical wisdom for raising children with strong values, healthy boundaries, and a deep sense of identity and belonging.',
                lessons: 5,
                status: 'draft',
                date: 'May 22, 2025'
            },
            {
                id: 5,
                title: 'Sunday School Starter',
                cat: "Children's Ministry",
                desc: 'A gentle, engaging introduction to key Bible stories and Christian values, designed specifically for children aged 4–8.',
                lessons: 10,
                status: 'published',
                date: 'May 18, 2025'
            },
            {
                id: 6,
                title: 'Servant Leadership 101',
                cat: 'Leadership',
                desc: 'A practical study on the principles of servant leadership, drawing from both scripture and contemporary examples of transformational leadership.',
                lessons: 7,
                status: 'published',
                date: 'May 10, 2025'
            },
            {
                id: 7,
                title: 'Daily Bread Devotionals',
                cat: 'Devotional',
                desc: 'A 30-day guided devotional series that helps participants build a consistent morning prayer and reflection habit.',
                lessons: 3,
                status: 'published',
                date: 'Apr 28, 2025'
            },
            {
                id: 8,
                title: 'Teen Talk: Faith & Identity',
                cat: 'Youth Group',
                desc: 'Honest, thoughtful conversations about identity, belonging, and faith for teenagers navigating the pressures of modern life.',
                lessons: 5,
                status: 'draft',
                date: 'Apr 20, 2025'
            },
            {
                id: 9,
                title: 'Letters to the Church',
                cat: 'Bible Study',
                desc: "A verse-by-verse study of Paul's epistles — exploring timeless wisdom about community, grace, and the life of faith.",
                lessons: 9,
                status: 'published',
                date: 'Apr 15, 2025'
            },
            {
                id: 10,
                title: 'Money & Stewardship',
                cat: 'Adult Education',
                desc: 'A biblical approach to personal finances — covering giving, saving, debt, and the theology of enough.',
                lessons: 4,
                status: 'draft',
                date: 'Apr 5, 2025'
            },
            {
                id: 11,
                title: 'Little Explorers: Creation',
                cat: "Children's Ministry",
                desc: 'A colorful, hands-on curriculum exploring the story of creation, designed to spark wonder and curiosity in young children.',
                lessons: 6,
                status: 'published',
                date: 'Mar 28, 2025'
            },
            {
                id: 12,
                title: 'Leading Through Change',
                cat: 'Leadership',
                desc: 'How to navigate uncertainty, lead with courage, and keep teams grounded in purpose when everything feels unstable.',
                lessons: 5,
                status: 'archived',
                date: 'Mar 10, 2025'
            },
        ];

        let searchQuery = '';
        let sortMode = 'recent';
        let viewMode = 'grid';

        window.onload = () => {
            render();
        };

        function onSearch(val) {
            searchQuery = val.toLowerCase();
            render();
        }

        function onSort(val) {
            sortMode = val;
            render();
        }

        function setView(mode, btn) {
            viewMode = mode;
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('pepsol-grid').classList.toggle('list-view', mode === 'list');
        }

        function getFiltered() {
            let items = [...PEPSOLS];
            if (searchQuery) items = items.filter(p =>
                p.title.toLowerCase().includes(searchQuery) ||
                p.desc.toLowerCase().includes(searchQuery) ||
                p.cat.toLowerCase().includes(searchQuery)
            );
            if (sortMode === 'alpha') items.sort((a, b) => a.title.localeCompare(b.title));
            if (sortMode === 'lessons') items.sort((a, b) => b.lessons - a.lessons);
            if (sortMode === 'recent') items.sort((a, b) => b.id - a.id);
            return items;
        }

        function render() {
            const filtered = getFiltered();
            const total = filtered.length;
            const uniqueCats = [...new Set(PEPSOLS.map(p => p.cat))].length;

            document.getElementById('total-stat-value').textContent = total;
            document.getElementById('total-stat-sub').textContent = `across ${uniqueCats} categories`;

            const label = document.getElementById('results-label');
            let labelText = `Showing <strong>${total}</strong> pepsol${total !== 1 ? 's' : ''}`;
            if (searchQuery) labelText += ` for "<strong>${searchQuery}</strong>"`;
            label.innerHTML = labelText;

            const grid = document.getElementById('pepsol-grid');
            grid.classList.toggle('list-view', viewMode === 'list');

            if (filtered.length === 0) {
                grid.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div class="empty-title">No pepsols found</div>
                <div class="empty-text">Try adjusting your search to find what you're looking for.</div>
                <a href="{{ route('leader.pepsol.create') }}" class="btn-create" style="margin-top:4px;">
                    <svg viewBox="0 0 16 16"><path d="M8 3v10M3 8h10" stroke-linecap="round"/></svg>
                    Create New Pepsol
                </a>
            </div>`;
            } else {
                grid.innerHTML = filtered.map((p, i) => buildCard(p, i)).join('');
            }
        }

        function buildCard(p, i) {
            const cat = CATS.find(c => c.name === p.cat) || {
                color: '#6366f1'
            };
            const delay = `animation-delay:${i * 0.04}s`;
            const statusCls = `status--${p.status}`;
            const statusLabel = p.status.charAt(0).toUpperCase() + p.status.slice(1);

            return `
        <div class="pcard" style="${delay}" onclick="openPepsol(${p.id})" id="pcard-${p.id}">
            <div class="pcard-stripe" style="background:${cat.color}"></div>
            <div class="pcard-body">
                <div class="pcard-top">
                    <div class="pcard-cat">
                        <div class="pcard-cat-dot" style="background:${cat.color}"></div>
                        ${p.cat}
                    </div>
                    <button class="pcard-menu" onclick="openCtx(event,${p.id})" title="Options">···</button>
                </div>
                <div class="pcard-title">${p.title}</div>
                <div class="pcard-desc">${p.desc}</div>
                <div class="pcard-meta">
                    <div class="pcard-meta-item">
                        <svg viewBox="0 0 16 16"><path d="M3 4h10M3 7h10M3 10h6"/></svg>
                        ${p.lessons} lesson${p.lessons !== 1 ? 's' : ''}
                    </div>
                </div>
            </div>
            <div class="pcard-footer">
                <div class="pcard-status ${statusCls}">
                    <div class="status-dot"></div>
                    ${statusLabel}
                </div>
                <div class="pcard-date">${p.date}</div>
            </div>
        </div>`;
        }

        function openCtx(e, id) {
            e.stopPropagation();
            const menu = document.getElementById('ctx-menu');
            const p = PEPSOLS.find(x => x.id === id);

            menu.innerHTML = `
        <div class="ctx-item" onclick="openPepsol(${id}); closeCtx()">
            <svg viewBox="0 0 16 16"><path d="M8 3a5 5 0 100 10A5 5 0 008 3zM8 6v4M8 10h.01"/></svg>
            View details
        </div>
        <div class="ctx-item" onclick="editPepsol(${id}); closeCtx()">
            <svg viewBox="0 0 16 16"><path d="M11 2.5l2.5 2.5-8 8H3v-2.5l8-8z"/></svg>
            Edit
        </div>
        <div class="ctx-item" onclick="duplicatePepsol(${id}); closeCtx()">
            <svg viewBox="0 0 16 16"><rect x="6" y="6" width="7" height="8" rx="1"/><path d="M3 10V3h7"/></svg>
            Duplicate
        </div>
        <div class="ctx-divider"></div>
        <div class="ctx-item" onclick="toggleStatus(${id}); closeCtx()">
            <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5"/><path d="M5.5 8l2 2 3-3"/></svg>
            ${p.status === 'published' ? 'Unpublish' : 'Publish'}
        </div>
        <div class="ctx-divider"></div>
        <div class="ctx-item danger" onclick="deletePepsol(${id}); closeCtx()">
            <svg viewBox="0 0 16 16"><path d="M3 4h10M6 4V2.5h4V4M6.5 7v5M9.5 7v5M4 4l.7 8.5h6.6L12 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Delete
        </div>`;

            const x = Math.min(e.clientX, window.innerWidth - 180);
            const y = Math.min(e.clientY, window.innerHeight - 220);
            menu.style.left = x + 'px';
            menu.style.top = y + 'px';
            menu.style.display = 'block';

            setTimeout(() => document.addEventListener('click', closeCtx, {
                once: true
            }), 10);
        }

        function closeCtx() {
            document.getElementById('ctx-menu').style.display = 'none';
        }

        function openPepsol(id) {
            const p = PEPSOLS.find(x => x.id === id);
            showToast(`Opening "${p.title}"…`);
        }

        function editPepsol(id) {
            window.location.href = '#';
        }

        function duplicatePepsol(id) {
            const p = PEPSOLS.find(x => x.id === id);
            const newItem = {
                ...p,
                id: PEPSOLS.length + 1,
                title: p.title + ' (Copy)',
                status: 'draft',
                date: 'Just now'
            };
            PEPSOLS.unshift(newItem);
            const catObj = CATS.find(c => c.name === p.cat);
            if (catObj) catObj.count++;
            render();
            showToast(`"${p.title}" duplicated as a draft.`);
        }

        function toggleStatus(id) {
            const p = PEPSOLS.find(x => x.id === id);
            if (p.status === 'published') {
                p.status = 'draft';
                showToast(`"${p.title}" moved to drafts.`);
            } else {
                p.status = 'published';
                showToast(`"${p.title}" published!`, 'ok');
            }
            render();
        }

        function deletePepsol(id) {
            const p = PEPSOLS.find(x => x.id === id);
            if (!confirm(`Delete "${p.title}"? This cannot be undone.`)) return;
            PEPSOLS.splice(PEPSOLS.indexOf(p), 1);
            const catObj = CATS.find(c => c.name === p.cat);
            if (catObj && catObj.count > 0) catObj.count--;
            render();
            showToast(`"${p.title}" deleted.`, 'bad');
        }

        let toastEl = null;

        function showToast(msg, type = 'neutral') {
            if (toastEl) toastEl.remove();
            toastEl = document.createElement('div');
            toastEl.style.cssText = `
        position:fixed; bottom:24px; left:50%; transform:translateX(-50%);
        background:${type === 'ok' ? '#15803d' : type === 'bad' ? '#e03e3e' : '#0f0e17'};
        color:white; padding:10px 18px; border-radius:8px;
        font-family:'Sora',sans-serif; font-size:13px; font-weight:500;
        box-shadow:0 4px 20px rgba(0,0,0,0.18); z-index:999;
        animation:fadeUp 0.2s ease; white-space:nowrap;`;
            toastEl.textContent = msg;
            document.body.appendChild(toastEl);
            setTimeout(() => {
                toastEl.style.opacity = '0';
                toastEl.style.transition = 'opacity 0.3s';
                setTimeout(() => toastEl?.remove(), 300);
            }, 2800);
        }
    </script>
@endsection

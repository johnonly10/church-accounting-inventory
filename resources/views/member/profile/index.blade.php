@extends('layouts.guest')
@section('content')
    <x-hero-section title="My Account" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'My Account']]" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <section class="account-page">
        <div class="container">
            <div class="row g-4 align-items-start">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>

                <div class="col-12 col-md-3" id="sidebarContainer">
                    <div class="account-sidebar" role="navigation" aria-label="Account navigation">
                        <div class="sidebar-profile-mini">
                            <img src="{{ $user->path ? asset('storage/' . $user->path) : asset('storage/Member/Profile/default.jpg') }}"
                                alt="Avatar of {{ $user->name }}" class="sidebar-avatar" loading="lazy">
                            <div>
                                <div class="s-name">{{ $user->name }}</div>
                                <div class="s-role">{{ $user->pepsolType ? $user->pepsolType->name : 'Member' }}</div>
                            </div>
                        </div>
                        <ul class="sidebar-nav">
                            <li>
                                <a href="#" class="active" data-panel="account-details" role="tab"
                                    aria-selected="true" aria-controls="panel-account-details">
                                    <i class="bi bi-person-gear" aria-hidden="true"></i> Account Details
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="pepsol-history" role="tab" aria-selected="false"
                                    aria-controls="panel-pepsol-history">
                                    <i class="bi bi-journal-text" aria-hidden="true"></i> PEPSOL History
                                </a>
                            </li>
                            <li class="nav-divider" role="separator"></li>
                            <li>
                                <a href="#" class="logout-link" onclick="event.preventDefault(); confirmLogout();"
                                    role="button">
                                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                        <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <div class="account-content" role="main">
                        <div id="toastContainer" aria-live="polite" aria-atomic="true"></div>

                        @if (session('success'))
                            <div class="alert-success" role="alert">
                                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="profile-hero">
                            <div class="profile-hero-avatar-wrap">
                                <img src="{{ $user->path ? asset('storage/' . $user->path) : asset('storage/Member/Profile/default.jpg') }}"
                                    alt="Profile photo of {{ $user->name }}" class="profile-hero-avatar" loading="lazy">
                                <span class="avatar-status" title="Online" role="status"></span>
                            </div>
                            <div class="profile-hero-info">
                                <div class="hero-name">{{ $user->name }}</div>
                                <div class="hero-email">
                                    <i class="bi bi-envelope" style="opacity:.7;margin-right:4px;font-size:.72rem;"
                                        aria-hidden="true"></i>
                                    {{ $user->email }}
                                </div>
                                <div class="hero-bio d-none d-sm-block">
                                    {{ $user->position ? $user->position->name : '' }}{{ $user->ministry ? ' at ' . $user->ministry->name : '' }}
                                </div>
                                <div class="hero-stats">
                                    <div class="hero-stat">
                                        <div class="val">{{ $completedLessonsCount ?? 0 }}</div>
                                        <div class="lbl">Completed</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('member.profiles.edit', $user->id) }}"
                                class="btn-edit-profile ms-auto mt-2 mt-sm-0" aria-label="Edit profile">
                                <i class="bi bi-pencil" aria-hidden="true"></i> Edit Profile
                            </a>
                        </div>

                        <div class="tab-panel active" id="panel-account-details" role="tabpanel"
                            aria-labelledby="tab-account-details">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-person-gear" aria-hidden="true"></i> Account
                                    Details</div>
                                <a href="{{ route('member.profiles.edit', $user->id) }}" class="btn-edit-profile"
                                    style="background:var(--accent-l);color:var(--accent);border-color:var(--accent);font-size:.75rem;padding:5px 14px;">
                                    <i class="bi bi-pencil" aria-hidden="true"></i> Edit
                                </a>
                            </div>

                            <div class="account-list mb-4" role="list">
                                <div class="account-list-item" role="listitem">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-building" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="account-key">Department</div>
                                            <div class="account-value">
                                                {{ $user->department ? $user->department->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-list-item" role="listitem">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-person-badge"
                                                aria-hidden="true"></i></div>
                                        <div>
                                            <div class="account-key">Leader</div>
                                            <div class="account-value">{{ $user->leader ? $user->leader->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-list-item" role="listitem">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-flag" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="account-key">Ministry</div>
                                            <div class="account-value">
                                                {{ $user->ministry ? $user->ministry->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="account-list-item" role="listitem">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-briefcase" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="account-key">Position</div>
                                            <div class="account-value">
                                                {{ $user->position ? $user->position->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="account-list-item" role="listitem">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-tag" aria-hidden="true"></i></div>
                                        <div>
                                            <div class="account-key">PEPSOL Type</div>
                                            <div class="account-value">
                                                {{ $user->pepsolType ? $user->pepsolType->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-pepsol-history" role="tabpanel"
                            aria-labelledby="tab-pepsol-history">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-journal-text" aria-hidden="true"></i> PEPSOL
                                    History</div>
                                <div class="search-box">
                                    <i class="bi bi-search" aria-hidden="true"></i>
                                    <input type="text" id="historySearch" placeholder="Search lessons..."
                                        aria-label="Search history">
                                </div>
                            </div>

                            @if (isset($completedLessons) && $completedLessons->count() > 0)
                                <div style="overflow-x:auto;">
                                    <table class="history-table" role="table" aria-label="PEPSOL history table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Lesson</th>
                                                <th scope="col">Topic</th>
                                                {{-- <th scope="col">Category</th> --}}
                                                <th scope="col">Completed At</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($completedLessons as $lesson)
                                                <tr>
                                                    <td><strong>{{ $lesson->title }}</strong></td>
                                                    <td>{{ $lesson->topic ? $lesson->topic->name : 'N/A' }}</td>
                                                    {{-- <td>{{ $lesson->pepsol ? $lesson->pepsol->name : 'N/A' }}</td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($lesson->pivot->completed_at)->format('M d, Y h:i A') }}
                                                    </td>
                                                    <td><span class="status-pill completed">Completed</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-state" role="status">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-journal-x" aria-hidden="true"></i>
                                    </div>
                                    <div class="empty-state-title">No Completed Lessons</div>
                                    <div class="empty-state-description">You haven't completed any PEPSOL lessons yet.
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="text-center pt-4 mt-3 border-top" style="border-color:var(--border)!important">
                            <button type="button" class="btn-logout" onclick="confirmLogout()">
                                <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sign Out of Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-overlay" id="confirmModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Confirm Sign Out</h3>
                <button class="modal-close" onclick="closeModal()" aria-label="Close modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to sign out of your account?</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="modal-btn modal-btn-danger" onclick="confirmLogoutAction()">Sign Out</button>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            :root {
                --ink: #12111a;
                --ink-2: #3d3a52;
                --muted: #8b87a8;
                --border: #e8e6f0;
                --surface: #f5f4fb;
                --card: #ffffff;
                --accent: #7c5cfc;
                --accent-d: #5b3de8;
                --accent-l: #ede8ff;
                --orange: #f97316;
                --orange-l: #fff7ed;
                --teal: #0d9488;
                --teal-l: #f0fdfa;
                --danger: #ef4444;
                --danger-l: #fef2f2;
                --success: #10b981;
                --success-l: #ecfdf5;
                --warn-l: #fef9c3;
                --radius-lg: 20px;
                --radius-md: 14px;
                --radius-sm: 9px;
                --shadow-sm: 0 2px 8px rgba(124, 92, 252, .07);
                --shadow-md: 0 8px 28px rgba(124, 92, 252, .13);
                --shadow-lg: 0 20px 60px rgba(124, 92, 252, .18);
                --transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
            }

            *:focus-visible {
                outline: 3px solid var(--accent);
                outline-offset: 2px;
                border-radius: 4px;
            }

            .account-page {
                padding: 56px 0 88px;
            }

            .account-sidebar {
                background: var(--card);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-md);
                overflow: hidden;
                position: sticky;
                top: 24px;
                transition: transform 0.3s ease;
            }

            .sidebar-profile-mini {
                padding: 22px 18px 16px;
                background: linear-gradient(135deg, #7c5cfc 0%, #a78bfa 100%);
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .sidebar-avatar {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                border: 2.5px solid rgba(255, 255, 255, .65);
                object-fit: cover;
                flex-shrink: 0;
            }

            .sidebar-profile-mini .s-name {
                font-weight: 600;
                font-size: .88rem;
                color: #fff;
                line-height: 1.25;
            }

            .sidebar-profile-mini .s-role {
                font-size: .72rem;
                color: rgba(255, 255, 255, .72);
            }

            .sidebar-nav {
                list-style: none;
                padding: 8px 0 12px;
                margin: 0;
            }

            .sidebar-nav li a {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 20px;
                font-size: .855rem;
                font-weight: 500;
                color: var(--ink-2);
                text-decoration: none;
                transition: var(--transition);
                border-left: 3px solid transparent;
                cursor: pointer;
            }

            .sidebar-nav li a:hover {
                background: var(--accent-l);
                color: var(--accent);
                border-left-color: var(--accent);
            }

            .sidebar-nav li a.active {
                background: var(--accent-l);
                color: var(--accent);
                border-left-color: var(--accent);
                font-weight: 600;
            }

            .sidebar-nav li a i {
                font-size: .9rem;
                width: 17px;
                text-align: center;
                color: var(--muted);
                transition: var(--transition);
                flex-shrink: 0;
            }

            .sidebar-nav li a:hover i,
            .sidebar-nav li a.active i {
                color: var(--accent);
            }

            .nav-divider {
                border-top: 1px solid var(--border);
                margin: 6px 0;
            }

            .sidebar-nav li a.logout-link {
                color: var(--danger);
            }

            .sidebar-nav li a.logout-link i {
                color: var(--danger);
            }

            .sidebar-nav li a.logout-link:hover {
                background: var(--danger-l);
                border-left-color: var(--danger);
            }

            .account-content {
                background: var(--card);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-md);
                padding: 40px 44px;
                min-height: 500px;
            }

            .profile-hero {
                background: linear-gradient(135deg, #7c5cfc 0%, #5b3de8 55%, #7c3aed 100%);
                border-radius: var(--radius-lg);
                padding: 30px 32px 26px;
                display: flex;
                align-items: center;
                gap: 22px;
                margin-bottom: 36px;
                position: relative;
                overflow: hidden;
            }

            .profile-hero::before {
                content: '';
                position: absolute;
                top: -60px;
                right: -60px;
                width: 220px;
                height: 220px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .06);
                pointer-events: none;
            }

            .profile-hero::after {
                content: '';
                position: absolute;
                bottom: -40px;
                left: 20%;
                width: 160px;
                height: 160px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .04);
                pointer-events: none;
            }

            .profile-hero-avatar-wrap {
                position: relative;
                flex-shrink: 0;
            }

            .profile-hero-avatar {
                width: 82px;
                height: 82px;
                border-radius: 50%;
                border: 3.5px solid rgba(255, 255, 255, .7);
                object-fit: cover;
                display: block;
            }

            .avatar-status {
                position: absolute;
                bottom: 4px;
                right: 2px;
                width: 13px;
                height: 13px;
                border-radius: 50%;
                background: var(--success);
                border: 2.5px solid #fff;
            }

            .profile-hero-info {
                flex-grow: 1;
                min-width: 0;
            }

            .hero-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: #fff;
                margin: 0 0 2px;
                line-height: 1.2;
            }

            .hero-email {
                font-size: .8rem;
                color: rgba(255, 255, 255, .75);
                margin-bottom: 6px;
            }

            .hero-bio {
                font-size: .79rem;
                color: rgba(255, 255, 255, .65);
                line-height: 1.6;
                max-width: 420px;
            }

            .hero-stats {
                display: flex;
                gap: 18px;
                margin-top: 13px;
            }

            .hero-stat .val {
                font-size: 1.1rem;
                font-weight: 700;
                color: #fff;
                line-height: 1.1;
            }

            .hero-stat .lbl {
                font-size: .68rem;
                color: rgba(255, 255, 255, .65);
                text-transform: uppercase;
                letter-spacing: .06em;
            }

            .btn-edit-profile {
                background: rgba(255, 255, 255, .18);
                border: 1.5px solid rgba(255, 255, 255, .5);
                color: #fff;
                font-family: 'Outfit', sans-serif;
                font-size: .79rem;
                font-weight: 500;
                padding: 7px 20px;
                border-radius: 50px;
                transition: var(--transition);
                white-space: nowrap;
                flex-shrink: 0;
                align-self: flex-start;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }

            .btn-edit-profile:hover {
                background: #fff;
                color: var(--accent);
                border-color: #fff;
                box-shadow: 0 4px 16px rgba(0, 0, 0, .15);
            }

            .panel-heading {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 2px solid var(--accent-l);
                position: relative;
                flex-wrap: wrap;
                gap: 12px;
            }

            .panel-heading::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 36px;
                height: 2px;
                background: var(--accent);
                border-radius: 2px;
            }

            .panel-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--ink);
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .panel-title i {
                font-size: .95rem;
                color: var(--accent);
            }

            .search-box {
                position: relative;
                display: inline-flex;
                align-items: center;
            }

            .search-box i {
                position: absolute;
                left: 10px;
                color: var(--muted);
                font-size: .9rem;
            }

            .search-box input {
                padding: 5px 12px 5px 32px;
                border: 1.5px solid var(--border);
                border-radius: 50px;
                font-family: 'Outfit', sans-serif;
                font-size: .79rem;
                width: 200px;
                transition: var(--transition);
                background: var(--surface);
            }

            .search-box input:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(124, 92, 252, .1);
                width: 250px;
            }

            .tab-panel {
                display: none;
            }

            .tab-panel.active {
                display: block;
            }

            .account-list {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .account-list-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 13px 18px;
                border-radius: var(--radius-sm);
                background: var(--surface);
                border: 1.5px solid var(--border);
                transition: var(--transition);
            }

            .account-list-item:hover {
                border-color: #c4b5fd;
                background: var(--accent-l);
            }

            .account-list-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .account-list-icon {
                width: 34px;
                height: 34px;
                border-radius: 8px;
                background: var(--accent-l);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--accent);
                font-size: .88rem;
                flex-shrink: 0;
            }

            .account-key {
                font-size: .71rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .07em;
                color: var(--muted);
            }

            .account-value {
                font-size: .875rem;
                font-weight: 500;
                color: var(--ink);
                margin-top: 1px;
            }

            .history-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0 6px;
            }

            .history-table thead th {
                font-size: .7rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .07em;
                color: var(--muted);
                padding: 4px 14px 8px;
                border-bottom: 2px solid var(--border);
                text-align: left;
            }

            .history-table tbody tr {
                background: var(--surface);
                transition: var(--transition);
                cursor: default;
            }

            .history-table tbody tr:hover {
                background: var(--accent-l);
            }

            .history-table tbody td {
                padding: 12px 14px;
                font-size: .855rem;
                color: var(--ink-2);
                border-top: 1px solid var(--border);
                border-bottom: 1px solid var(--border);
                vertical-align: middle;
            }

            .history-table tbody td:first-child {
                border-left: 1px solid var(--border);
                border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            }

            .history-table tbody td:last-child {
                border-right: 1px solid var(--border);
                border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            }

            .status-pill {
                display: inline-block;
                font-size: .7rem;
                font-weight: 600;
                padding: 3px 10px;
                border-radius: 20px;
            }

            .status-pill.completed {
                background: var(--success-l);
                color: #065f46;
            }

            .empty-state {
                text-align: center;
                padding: 60px 20px;
            }

            .empty-state-icon {
                font-size: 3.5rem;
                color: var(--muted);
                margin-bottom: 12px;
            }

            .empty-state-title {
                font-size: 1rem;
                font-weight: 600;
                color: var(--ink-2);
                margin-bottom: 4px;
            }

            .empty-state-description {
                font-size: .85rem;
                color: var(--muted);
            }

            .btn-logout {
                background: transparent;
                border: 1.5px solid var(--danger);
                color: var(--danger);
                font-family: 'Outfit', sans-serif;
                font-weight: 500;
                font-size: .85rem;
                padding: 9px 28px;
                border-radius: 50px;
                transition: var(--transition);
                display: inline-flex;
                align-items: center;
                gap: 7px;
                cursor: pointer;
            }

            .btn-logout:hover {
                background: var(--danger);
                color: #fff;
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(239, 68, 68, .28);
            }

            .alert-success {
                background: var(--success-l);
                border: 1.5px solid #6ee7b7;
                color: #065f46;
                padding: 12px 18px;
                border-radius: var(--radius-sm);
                font-size: .85rem;
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 20px;
            }

            #toastContainer {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
                max-width: 360px;
                width: 100%;
            }

            .toast {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 18px;
                background: #fff;
                border-radius: var(--radius-sm);
                box-shadow: var(--shadow-lg);
                border-left: 4px solid var(--success);
                animation: slideInRight 0.4s ease;
                transition: all 0.3s ease;
            }

            .toast-success {
                border-left-color: var(--success);
            }

            .toast-error {
                border-left-color: var(--danger);
            }

            .toast-info {
                border-left-color: var(--accent);
            }

            .toast-icon {
                font-size: 1.2rem;
                color: var(--success);
                flex-shrink: 0;
            }

            .toast-error .toast-icon {
                color: var(--danger);
            }

            .toast-info .toast-icon {
                color: var(--accent);
            }

            .toast-message {
                flex: 1;
                font-size: .85rem;
                color: var(--ink-2);
            }

            .toast-close {
                background: none;
                border: none;
                font-size: 1.2rem;
                color: var(--muted);
                cursor: pointer;
                padding: 0 4px;
                transition: var(--transition);
            }

            .toast-close:hover {
                color: var(--ink);
                transform: rotate(90deg);
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .5);
                backdrop-filter: blur(4px);
                z-index: 10000;
                align-items: center;
                justify-content: center;
                animation: fadeIn 0.3s ease;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal-content {
                background: #fff;
                border-radius: var(--radius-lg);
                max-width: 440px;
                width: 90%;
                box-shadow: var(--shadow-lg);
                animation: scaleIn 0.3s ease;
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 18px 24px;
                border-bottom: 1.5px solid var(--border);
            }

            .modal-header h3 {
                margin: 0;
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.2rem;
                color: var(--ink);
            }

            .modal-close {
                background: none;
                border: none;
                font-size: 1.5rem;
                color: var(--muted);
                cursor: pointer;
                transition: var(--transition);
                padding: 0 4px;
            }

            .modal-close:hover {
                color: var(--ink);
                transform: rotate(90deg);
            }

            .modal-body {
                padding: 20px 24px;
            }

            .modal-body p {
                margin: 0;
                color: var(--ink-2);
                font-size: .85rem;
            }

            .modal-footer {
                padding: 16px 24px;
                border-top: 1.5px solid var(--border);
                display: flex;
                justify-content: flex-end;
                gap: 8px;
            }

            .modal-btn {
                padding: 8px 20px;
                border: none;
                border-radius: 50px;
                font-family: 'Outfit', sans-serif;
                font-weight: 500;
                font-size: .85rem;
                cursor: pointer;
                transition: var(--transition);
            }

            .modal-btn-secondary {
                background: var(--surface);
                color: var(--ink-2);
            }

            .modal-btn-secondary:hover {
                background: var(--border);
            }

            .modal-btn-danger {
                background: var(--danger);
                color: #fff;
            }

            .modal-btn-danger:hover {
                background: #dc2626;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(239, 68, 68, .3);
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0.9);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            .sidebar-toggle {
                display: none;
                position: fixed;
                bottom: 24px;
                right: 24px;
                z-index: 100;
                width: 52px;
                height: 52px;
                border-radius: 50%;
                background: var(--accent);
                color: #fff;
                border: none;
                font-size: 1.5rem;
                cursor: pointer;
                box-shadow: var(--shadow-lg);
                transition: var(--transition);
            }

            .sidebar-toggle:hover {
                transform: scale(1.1);
                box-shadow: 0 8px 24px rgba(124, 92, 252, .4);
            }

            @media (max-width: 991.98px) {
                .account-content {
                    padding: 30px 28px;
                }
            }

            @media (max-width: 767.98px) {
                .account-content {
                    padding: 24px 18px;
                }

                .profile-hero {
                    flex-wrap: wrap;
                    gap: 14px;
                    padding: 22px 18px;
                }

                .profile-hero-avatar {
                    width: 60px;
                    height: 60px;
                }

                .sidebar-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                #sidebarContainer {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 280px;
                    height: 100vh;
                    z-index: 99;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }

                #sidebarContainer.open {
                    transform: translateX(0);
                }

                #sidebarContainer .account-sidebar {
                    height: 100%;
                    border-radius: 0;
                    overflow-y: auto;
                    top: 0;
                }

                .sidebar-overlay {
                    display: none;
                    position: fixed;
                    inset: 0;
                    background: rgba(0, 0, 0, .5);
                    z-index: 98;
                }

                .sidebar-overlay.active {
                    display: block;
                }

                .search-box input {
                    width: 140px;
                }

                .search-box input:focus {
                    width: 160px;
                }

                .panel-heading {
                    flex-direction: column;
                    align-items: stretch;
                }
            }

            @media (max-width: 575.98px) {
                .account-page {
                    padding: 30px 0 56px;
                }

                .account-content {
                    padding: 16px 12px;
                }

                .history-table {
                    font-size: .8rem;
                }

                .history-table tbody td,
                .history-table thead th {
                    padding: 8px 10px;
                }

                .search-box input {
                    width: 100%;
                }

                .search-box input:focus {
                    width: 100%;
                }
            }

            @media print {

                .sidebar-toggle,
                .btn-edit-profile,
                .btn-logout,
                .search-box {
                    display: none !important;
                }

                .account-sidebar {
                    box-shadow: none !important;
                }

                .profile-hero {
                    break-inside: avoid;
                    background: #7c5cfc !important;
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }

                .account-content {
                    box-shadow: none !important;
                    padding: 20px !important;
                }

                .tab-panel {
                    display: block !important;
                }

                .tab-panel:not(.active) {
                    display: block !important;
                }

                .modal-overlay {
                    display: none !important;
                }

                #toastContainer {
                    display: none !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function activatePanel(panelId) {
                document.querySelectorAll('.sidebar-nav li a[data-panel]').forEach(function(a) {
                    a.classList.remove('active');
                    a.setAttribute('aria-selected', 'false');
                });
                var link = document.querySelector('.sidebar-nav li a[data-panel="' + panelId + '"]');
                if (link) {
                    link.classList.add('active');
                    link.setAttribute('aria-selected', 'true');
                }

                document.querySelectorAll('.tab-panel').forEach(function(p) {
                    p.classList.remove('active');
                });
                var panel = document.getElementById('panel-' + panelId);
                if (panel) panel.classList.add('active');

                closeSidebar();
            }

            document.querySelectorAll('.sidebar-nav li a[data-panel]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    activatePanel(this.dataset.panel);
                });
            });

            function showToast(message, type) {
                type = type || 'success';
                var container = document.getElementById('toastContainer');
                var toast = document.createElement('div');
                toast.className = 'toast toast-' + type;
                var icon = 'bi-check-circle-fill';
                if (type === 'error') icon = 'bi-exclamation-circle-fill';
                if (type === 'info') icon = 'bi-info-circle-fill';
                toast.innerHTML = '<div class="toast-icon"><i class="bi ' + icon +
                    '" aria-hidden="true"></i></div><div class="toast-message">' + message +
                    '</div><button class="toast-close" onclick="this.closest(\'.toast\').remove()" aria-label="Close notification"><i class="bi bi-x" aria-hidden="true"></i></button>';
                container.appendChild(toast);
                setTimeout(function() {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(function() {
                        toast.remove();
                    }, 300);
                }, 5000);
            }

            function confirmLogout() {
                document.getElementById('confirmModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                document.getElementById('confirmModal').classList.remove('active');
                document.body.style.overflow = '';
            }

            function confirmLogoutAction() {
                closeModal();
                document.getElementById('sidebar-logout-form').submit();
            }

            document.getElementById('confirmModal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });

            var sidebarToggle = document.getElementById('sidebarToggle');
            var sidebarContainer = document.getElementById('sidebarContainer');

            var overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);

            function toggleSidebar() {
                sidebarContainer.classList.toggle('open');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebarContainer.classList.contains('open') ? 'hidden' : '';
            }

            function closeSidebar() {
                sidebarContainer.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            sidebarToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', closeSidebar);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebarContainer.classList.contains('open')) {
                    closeSidebar();
                }
            });

            var searchInput = document.getElementById('historySearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    var searchTerm = this.value.toLowerCase();
                    var rows = document.querySelectorAll('.history-table tbody tr');
                    rows.forEach(function(row) {
                        var text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'e') {
                    e.preventDefault();
                    var editBtn = document.querySelector('.btn-edit-profile');
                    if (editBtn) window.location.href = editBtn.href;
                }
                if (e.ctrlKey && e.key === 'h') {
                    e.preventDefault();
                    var historyLink = document.querySelector('[data-panel="pepsol-history"]');
                    if (historyLink) historyLink.click();
                }
                if (e.ctrlKey && e.key === 'd') {
                    e.preventDefault();
                    var detailsLink = document.querySelector('[data-panel="account-details"]');
                    if (detailsLink) detailsLink.click();
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var tables = document.querySelectorAll('.history-table');
                tables.forEach(function(table) {
                    table.style.opacity = '0.6';
                    setTimeout(function() {
                        table.style.opacity = '1';
                        table.style.transition = 'opacity 0.3s ease';
                    }, 500);
                });

                var successMessage = document.querySelector('.alert-success');
                if (successMessage) {
                    setTimeout(function() {
                        successMessage.style.transition = 'opacity 0.5s ease';
                        successMessage.style.opacity = '0';
                        setTimeout(function() {
                            successMessage.remove();
                        }, 500);
                    }, 5000);
                }
            });

            document.querySelectorAll('[title]').forEach(function(el) {
                el.addEventListener('mouseenter', function(e) {
                    var tooltip = document.createElement('div');
                    tooltip.className = 'tooltip-popup';
                    tooltip.textContent = this.getAttribute('title');
                    tooltip.style.cssText =
                        'position:fixed;background:#12111a;color:#fff;padding:4px 12px;border-radius:6px;font-size:.7rem;font-weight:500;z-index:9999;pointer-events:none;transform:translateY(-100%);margin-top:-8px;box-shadow:0 2px 8px rgba(124,92,252,.07);';
                    document.body.appendChild(tooltip);
                    var rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                    tooltip.style.top = rect.top + 'px';
                    this._tooltip = tooltip;
                });

                el.addEventListener('mouseleave', function() {
                    if (this._tooltip) {
                        this._tooltip.remove();
                        this._tooltip = null;
                    }
                });
            });
        </script>
    @endpush
@endsection

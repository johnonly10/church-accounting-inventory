@extends('layouts.guest')
@section('content')
    <x-hero-section title="My Account" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'My Account']]" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--surface);
            color: var(--ink);
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

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: .66rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
            line-height: 1.5;
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

        .hero-stat-divider {
            width: 1px;
            background: rgba(255, 255, 255, .2);
            align-self: stretch;
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

        .btn-panel-action {
            background: var(--accent-l);
            border: none;
            color: var(--accent);
            font-family: 'Outfit', sans-serif;
            font-size: .78rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-panel-action:hover {
            background: var(--accent);
            color: #fff;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 13px;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: #c4b5fd;
            box-shadow: var(--shadow-sm);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--accent-l);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .stat-info .stat-val {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
        }

        .stat-info .stat-lbl {
            font-size: .72rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .quick-links {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .quick-link-card {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px 18px;
            background: var(--surface);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 13px;
            text-decoration: none;
            color: inherit;
        }

        .quick-link-card:hover {
            border-color: #c4b5fd;
            background: var(--accent-l);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .quick-link-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .ql-title {
            font-weight: 600;
            font-size: .86rem;
            color: var(--ink);
        }

        .ql-sub {
            font-size: .75rem;
            color: var(--muted);
        }

        .event-card {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            background: var(--card);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: #c4b5fd;
        }

        .event-card-top {
            height: 5px;
            background: linear-gradient(90deg, var(--accent), #a78bfa);
        }

        .event-card-body {
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .event-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .event-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--accent-l);
            color: var(--accent-d);
            font-size: .7rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
        }

        .event-status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, .18);
        }

        .event-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .event-desc {
            font-size: .8rem;
            color: var(--muted);
            line-height: 1.65;
            flex-grow: 1;
        }

        .btn-view-details {
            background: var(--accent);
            color: #fff;
            border: none;
            font-family: 'Outfit', sans-serif;
            font-size: .76rem;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 50px;
            margin-top: 13px;
            transition: var(--transition);
            align-self: flex-start;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view-details:hover {
            background: var(--accent-d);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(124, 92, 252, .38);
            color: #fff;
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
        }

        .history-table tbody tr {
            background: var(--surface);
            transition: var(--transition);
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

        .status-pill.upcoming {
            background: var(--accent-l);
            color: var(--accent-d);
        }

        .status-pill.cancelled {
            background: var(--danger-l);
            color: #991b1b;
        }

        .status-pill.in-progress {
            background: var(--warn-l);
            color: #713f12;
        }

        .status-pill.passed {
            background: var(--success-l);
            color: #065f46;
        }

        .status-pill.failed {
            background: var(--danger-l);
            color: #991b1b;
        }

        .training-card {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            background: var(--card);
            padding: 20px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .training-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--teal), #2dd4bf);
        }

        .training-card:hover {
            border-color: #99f6e4;
            box-shadow: 0 8px 28px rgba(13, 148, 136, .12);
            transform: translateY(-3px);
        }

        .training-progress-wrap {
            margin-top: 12px;
        }

        .training-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: .72rem;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .training-progress-bar {
            height: 6px;
            background: var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .training-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--teal), #2dd4bf);
            border-radius: 10px;
            transition: width .6s ease;
        }

        .training-meta {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .training-tag {
            font-size: .7rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--teal-l);
            color: var(--teal);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-training {
            background: var(--teal);
            color: #fff;
            border: none;
            font-family: 'Outfit', sans-serif;
            font-size: .76rem;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 50px;
            margin-top: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-training:hover {
            background: #0f766e;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(13, 148, 136, .3);
            color: #fff;
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

        .btn-copy {
            background: none;
            border: 1.5px solid var(--border);
            color: var(--muted);
            font-family: 'Outfit', sans-serif;
            font-size: .73rem;
            padding: 4px 12px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .btn-copy:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-l);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(18, 17, 26, .55);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 520px;
            padding: 34px 38px 30px;
            transform: translateY(18px) scale(.97);
            transition: transform .28s cubic-bezier(.4, 0, .2, 1);
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-title i {
            color: var(--accent);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'Outfit', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            background: var(--surface);
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(124, 92, 252, .12);
        }

        .form-control::placeholder {
            color: var(--muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 84px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .btn-cancel {
            background: none;
            border: 1.5px solid var(--border);
            color: var(--muted);
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: .85rem;
            padding: 8px 22px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-cancel:hover {
            border-color: var(--ink-2);
            color: var(--ink);
        }

        .btn-save {
            background: var(--accent);
            border: none;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: .85rem;
            padding: 8px 26px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-save:hover {
            background: var(--accent-d);
            box-shadow: 0 6px 18px rgba(124, 92, 252, .35);
            transform: translateY(-1px);
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

        .toast-notify {
            position: fixed;
            bottom: 26px;
            right: 26px;
            background: var(--ink);
            color: #fff;
            font-size: .82rem;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 10px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .22);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2000;
            opacity: 0;
            transform: translateY(12px);
            transition: all .3s ease;
            pointer-events: none;
        }

        .toast-notify.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast-notify i {
            color: var(--success);
            font-size: .95rem;
        }

        @media (max-width: 991.98px) {
            .hero-bio {
                display: none;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
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

            .btn-edit-profile {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .quick-links {
                grid-template-columns: 1fr;
            }

            .modal-box {
                padding: 24px 20px 20px;
            }
        }

        @media (max-width: 575.98px) {
            .account-page {
                padding: 30px 0 56px;
            }
        }
    </style>

    <section class="account-page">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-12 col-md-3">
                    <div class="account-sidebar">
                        <div class="sidebar-profile-mini">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffffff&color=7c5cfc&size=200&bold=true"
                                alt="Avatar" class="sidebar-avatar">
                            <div>
                                <div class="s-name">{{ $user->name }}</div>
                                <div class="s-role">{{ ucfirst(strtolower($user->roletype)) }} Member</div>
                            </div>
                        </div>
                        <ul class="sidebar-nav">
                            <li>
                                <a href="#" class="active" data-panel="dashboard">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="events">
                                    <i class="bi bi-bag-check"></i> Events
                                    <span class="nav-badge">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="events-history">
                                    <i class="bi bi-clock-history"></i> Events History
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="pepsol-training">
                                    <i class="bi bi-mortarboard"></i> PEPSOL Training
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="pepsol-history">
                                    <i class="bi bi-journal-text"></i> PEPSOL History
                                </a>
                            </li>
                            <li>
                                <a href="#" data-panel="account-details">
                                    <i class="bi bi-person-gear"></i> Account Details
                                </a>
                            </li>
                            <li class="nav-divider"></li>
                            <li>
                                <a href="#" class="logout-link"
                                    onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                        <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="account-content">
                        <div class="profile-hero">
                            <div class="profile-hero-avatar-wrap">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffffff&color=7c5cfc&size=200&bold=true"
                                    alt="Profile Photo" class="profile-hero-avatar">
                                <span class="avatar-status" title="Online"></span>
                            </div>
                            <div class="profile-hero-info">
                                <div class="hero-name">{{ $user->name }}</div>
                                <div class="hero-email">
                                    <i class="bi bi-envelope" style="opacity:.7;margin-right:4px;font-size:.72rem;"></i>
                                    {{ $user->email }}
                                </div>
                                <div class="hero-bio d-none d-sm-block">
                                    Creative strategist and event enthusiast. Passionate about curating meaningful
                                    experiences.
                                </div> 
                                <div class="hero-stats">
                                    <div class="hero-stat">
                                        <div class="val">3</div>
                                        <div class="lbl">Events</div>
                                    </div>
                                    <div class="hero-stat-divider"></div>
                                    <div class="hero-stat">
                                        <div class="val">5</div>
                                        <div class="lbl">Trainings</div>
                                    </div>
                                    <div class="hero-stat-divider"></div>
                                    <div class="hero-stat">
                                        <div class="val">2y</div>
                                        <div class="lbl">Member</div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-edit-profile ms-auto mt-2 mt-sm-0" id="editProfileBtn">
                                <i class="bi bi-pencil me-1"></i> Edit Profile
                            </button>
                        </div>

                        <div class="tab-panel active" id="panel-dashboard">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-speedometer2"></i> Dashboard</div>
                                <button class="btn-panel-action"><i class="bi bi-grid"></i> Quick Access</button>
                            </div>
                            <div class="stats-row">
                                <div class="stat-card">
                                    <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
                                    <div class="stat-info">
                                        <div class="stat-val">3</div>
                                        <div class="stat-lbl">Upcoming Events</div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon" style="background:var(--teal-l);color:var(--teal)">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div class="stat-info">
                                        <div class="stat-val">5</div>
                                        <div class="stat-lbl">PEPSOL Trainings</div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon" style="background:var(--orange-l);color:var(--orange)">
                                        <i class="bi bi-trophy"></i>
                                    </div>
                                    <div class="stat-info">
                                        <div class="stat-val">12</div>
                                        <div class="stat-lbl">Completions</div>
                                    </div>
                                </div>
                            </div>
                            <p class="panel-title" style="font-size:.95rem;margin-bottom:12px;">
                                <i class="bi bi-grid"></i> Quick Access
                            </p>
                            <div class="quick-links">
                                <a href="#" class="quick-link-card" data-panel="events">
                                    <div class="quick-link-icon" style="background:var(--accent-l);color:var(--accent)">
                                        <i class="bi bi-bag-check"></i>
                                    </div>
                                    <div>
                                        <div class="ql-title">My Events</div>
                                        <div class="ql-sub">3 registered · 1 upcoming</div>
                                    </div>
                                </a>
                                <a href="#" class="quick-link-card" data-panel="events-history">
                                    <div class="quick-link-icon" style="background:#fef3c7;color:#b45309">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div>
                                        <div class="ql-title">Events History</div>
                                        <div class="ql-sub">9 past events</div>
                                    </div>
                                </a>
                                <a href="#" class="quick-link-card" data-panel="pepsol-training">
                                    <div class="quick-link-icon" style="background:var(--teal-l);color:var(--teal)">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div>
                                        <div class="ql-title">PEPSOL Training</div>
                                        <div class="ql-sub">2 in progress</div>
                                    </div>
                                </a>
                                <a href="#" class="quick-link-card" data-panel="account-details">
                                    <div class="quick-link-icon" style="background:var(--surface);color:var(--muted)">
                                        <i class="bi bi-person-gear"></i>
                                    </div>
                                    <div>
                                        <div class="ql-title">Account Details</div>
                                        <div class="ql-sub">Update your profile</div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-events">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-bag-check"></i> My Events</div>
                                <button class="btn-panel-action"><i class="bi bi-plus-lg"></i> Browse Events</button>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-sm-4 d-flex">
                                    <div class="event-card">
                                        <div class="event-card-top"></div>
                                        <div class="event-card-body">
                                            <div class="event-meta">
                                                <span class="event-date-badge">
                                                    <i class="bi bi-calendar3"></i> Mar 15, 2025
                                                </span>
                                                <span class="event-status-dot" title="Registered"></span>
                                            </div>
                                            <div class="event-title">Design Summit 2025</div>
                                            <div class="event-desc">A two-day gathering of designers and makers exploring
                                                human experience and emerging technology.</div>
                                            <button class="btn btn-view-details">View <i
                                                    class="bi bi-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 d-flex">
                                    <div class="event-card">
                                        <div class="event-card-top"
                                            style="background:linear-gradient(90deg,#f97316,#fb923c)"></div>
                                        <div class="event-card-body">
                                            <div class="event-meta">
                                                <span class="event-date-badge" style="background:#fff7ed;color:#c2410c">
                                                    <i class="bi bi-calendar3"></i> Apr 22, 2025
                                                </span>
                                                <span class="event-status-dot"
                                                    style="background:var(--orange);box-shadow:0 0 0 3px rgba(249,115,22,.18)"></span>
                                            </div>
                                            <div class="event-title">Spring Gala Night</div>
                                            <div class="event-desc">An elegant evening celebrating community achievements
                                                with live music, fine dining, and award presentations.</div>
                                            <button class="btn btn-view-details" style="background:#f97316">View <i
                                                    class="bi bi-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 d-flex">
                                    <div class="event-card">
                                        <div class="event-card-top"
                                            style="background:linear-gradient(90deg,#10b981,#34d399)"></div>
                                        <div class="event-card-body">
                                            <div class="event-meta">
                                                <span class="event-date-badge"
                                                    style="background:var(--success-l);color:#065f46">
                                                    <i class="bi bi-calendar3"></i> Jun 08, 2025
                                                </span>
                                                <span class="event-status-dot" style="background:var(--success)"></span>
                                            </div>
                                            <div class="event-title">Tech for Good Hackathon</div>
                                            <div class="event-desc">A 48-hour innovation sprint where teams build solutions
                                                for social impact, mentored by industry leaders.</div>
                                            <button class="btn btn-view-details" style="background:#10b981">View <i
                                                    class="bi bi-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-events-history">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-clock-history"></i> Events History</div>
                                <button class="btn-panel-action" style="background:#fef3c7;color:#b45309">
                                    <i class="bi bi-download"></i> Export
                                </button>
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Design Summit 2024</strong></td>
                                            <td>Mar 12, 2024</td>
                                            <td>Manila, PH</td>
                                            <td><span class="status-pill completed">Completed</span></td>
                                            <td><button class="btn-copy"><i class="bi bi-eye"></i> View</button></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Community Forum Q4</strong></td>
                                            <td>Nov 20, 2024</td>
                                            <td>Online</td>
                                            <td><span class="status-pill completed">Completed</span></td>
                                            <td><button class="btn-copy"><i class="bi bi-eye"></i> View</button></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Youth Leaders Summit</strong></td>
                                            <td>Aug 05, 2024</td>
                                            <td>Cebu, PH</td>
                                            <td><span class="status-pill completed">Completed</span></td>
                                            <td><button class="btn-copy"><i class="bi bi-eye"></i> View</button></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Innovation Workshop</strong></td>
                                            <td>May 18, 2024</td>
                                            <td>Davao, PH</td>
                                            <td><span class="status-pill cancelled">Cancelled</span></td>
                                            <td><button class="btn-copy"><i class="bi bi-eye"></i> View</button></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Annual Gala 2023</strong></td>
                                            <td>Dec 10, 2023</td>
                                            <td>Manila, PH</td>
                                            <td><span class="status-pill completed">Completed</span></td>
                                            <td><button class="btn-copy"><i class="bi bi-eye"></i> View</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-pepsol-training">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-mortarboard"></i> PEPSOL Training</div>
                                <button class="btn-panel-action" style="background:var(--teal-l);color:var(--teal)">
                                    <i class="bi bi-plus-lg"></i> Enroll
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 d-flex">
                                    <div class="training-card w-100">
                                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                            <div>
                                                <div class="event-title" style="margin-bottom:3px;">Leadership Foundations
                                                </div>
                                                <div style="font-size:.78rem;color:var(--muted);">Module 3 of 6 ·
                                                    Intermediate</div>
                                            </div>
                                            <span class="status-pill in-progress"
                                                style="white-space:nowrap;flex-shrink:0;">In Progress</span>
                                        </div>
                                        <div class="training-progress-wrap">
                                            <div class="training-progress-label"><span>Progress</span><span>48%</span>
                                            </div>
                                            <div class="training-progress-bar">
                                                <div class="training-progress-fill" style="width:48%"></div>
                                            </div>
                                        </div>
                                        <div class="training-meta">
                                            <span class="training-tag"><i class="bi bi-clock"></i> 4h 30m left</span>
                                            <span class="training-tag"><i class="bi bi-people"></i> 24 enrolled</span>
                                        </div>
                                        <button class="btn-training">Continue <i class="bi bi-play-fill"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex">
                                    <div class="training-card w-100">
                                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                            <div>
                                                <div class="event-title" style="margin-bottom:3px;">Community Organizing
                                                </div>
                                                <div style="font-size:.78rem;color:var(--muted);">Module 1 of 5 · Beginner
                                                </div>
                                            </div>
                                            <span class="status-pill in-progress"
                                                style="white-space:nowrap;flex-shrink:0;">In Progress</span>
                                        </div>
                                        <div class="training-progress-wrap">
                                            <div class="training-progress-label"><span>Progress</span><span>15%</span>
                                            </div>
                                            <div class="training-progress-bar">
                                                <div class="training-progress-fill" style="width:15%"></div>
                                            </div>
                                        </div>
                                        <div class="training-meta">
                                            <span class="training-tag"><i class="bi bi-clock"></i> 7h 10m left</span>
                                            <span class="training-tag"><i class="bi bi-people"></i> 38 enrolled</span>
                                        </div>
                                        <button class="btn-training">Continue <i class="bi bi-play-fill"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex">
                                    <div class="training-card w-100" style="opacity:.8;">
                                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                            <div>
                                                <div class="event-title" style="margin-bottom:3px;">Social Impact Strategy
                                                </div>
                                                <div style="font-size:.78rem;color:var(--muted);">6 Modules · Advanced
                                                </div>
                                            </div>
                                            <span class="status-pill upcoming"
                                                style="white-space:nowrap;flex-shrink:0;">Upcoming</span>
                                        </div>
                                        <div class="training-progress-wrap">
                                            <div class="training-progress-label"><span>Starts Jun 1,
                                                    2025</span><span>0%</span></div>
                                            <div class="training-progress-bar">
                                                <div class="training-progress-fill" style="width:0%"></div>
                                            </div>
                                        </div>
                                        <div class="training-meta">
                                            <span class="training-tag"><i class="bi bi-clock"></i> ~10h total</span>
                                        </div>
                                        <button class="btn-training" style="background:#94a3b8;cursor:not-allowed"
                                            disabled>
                                            Locked <i class="bi bi-lock-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex">
                                    <div class="training-card w-100">
                                        <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                            <div>
                                                <div class="event-title" style="margin-bottom:3px;">Advocacy &
                                                    Communication</div>
                                                <div style="font-size:.78rem;color:var(--muted);">4 Modules · Intermediate
                                                </div>
                                            </div>
                                            <span class="status-pill completed"
                                                style="white-space:nowrap;flex-shrink:0;">Completed</span>
                                        </div>
                                        <div class="training-progress-wrap">
                                            <div class="training-progress-label"><span>Progress</span><span>100%</span>
                                            </div>
                                            <div class="training-progress-bar">
                                                <div class="training-progress-fill"
                                                    style="width:100%;background:linear-gradient(90deg,var(--success),#34d399)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="training-meta">
                                            <span class="training-tag" style="background:var(--success-l);color:#065f46">
                                                <i class="bi bi-patch-check-fill"></i> Certificate earned
                                            </span>
                                        </div>
                                        <button class="btn-training" style="background:var(--success)">
                                            Download Certificate <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-pepsol-history">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-journal-text"></i> PEPSOL History</div>
                                <button class="btn-panel-action" style="background:var(--teal-l);color:var(--teal)">
                                    <i class="bi bi-download"></i> Export
                                </button>
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>Training</th>
                                            <th>Completed</th>
                                            <th>Duration</th>
                                            <th>Score</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Advocacy & Communication</strong></td>
                                            <td>Feb 10, 2025</td>
                                            <td>8h 15m</td>
                                            <td><strong style="color:var(--success)">94%</strong></td>
                                            <td><span class="status-pill passed">Passed</span></td>
                                            <td>
                                                <button class="btn-copy"
                                                    style="color:var(--teal);border-color:var(--teal)">
                                                    <i class="bi bi-award"></i> Cert
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Intro to PEPSOL Framework</strong></td>
                                            <td>Nov 5, 2024</td>
                                            <td>3h 40m</td>
                                            <td><strong style="color:var(--success)">88%</strong></td>
                                            <td><span class="status-pill passed">Passed</span></td>
                                            <td>
                                                <button class="btn-copy"
                                                    style="color:var(--teal);border-color:var(--teal)">
                                                    <i class="bi bi-award"></i> Cert
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Grant Writing Basics</strong></td>
                                            <td>Sep 18, 2024</td>
                                            <td>5h 00m</td>
                                            <td><strong style="color:#b45309">62%</strong></td>
                                            <td><span class="status-pill failed">Failed</span></td>
                                            <td>
                                                <button class="btn-copy">
                                                    <i class="bi bi-arrow-repeat"></i> Retake
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Youth Engagement Methods</strong></td>
                                            <td>Jun 22, 2024</td>
                                            <td>4h 20m</td>
                                            <td><strong style="color:var(--success)">91%</strong></td>
                                            <td><span class="status-pill passed">Passed</span></td>
                                            <td>
                                                <button class="btn-copy"
                                                    style="color:var(--teal);border-color:var(--teal)">
                                                    <i class="bi bi-award"></i> Cert
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-panel" id="panel-account-details">
                            <div class="panel-heading">
                                <div class="panel-title"><i class="bi bi-person-gear"></i> Account Details</div>
                                <button class="btn-panel-action" id="editProfileBtn2">
                                    <i class="bi bi-pencil"></i> Edit Profile
                                </button>
                            </div>
                            <div class="account-list mb-4">
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-person"></i></div>
                                        <div>
                                            <div class="account-key">Full Name</div>
                                            <div class="account-value">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-at"></i></div>
                                        <div>
                                            <div class="account-key">Username</div>
                                            <div class="account-value">@php echo strtolower(str_replace(' ', '_', $user->name)); @endphp</div>
                                        </div>
                                    </div>
                                    <button class="btn-copy"
                                        onclick="copyText('@php echo strtolower(str_replace(' ', '_', $user->name)); @endphp', this)">
                                        <i class="bi bi-copy"></i> Copy
                                    </button>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-envelope"></i></div>
                                        <div>
                                            <div class="account-key">Email</div>
                                            <div class="account-value">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    <button class="btn-copy" onclick="copyText('{{ $user->email }}', this)">
                                        <i class="bi bi-copy"></i> Copy
                                    </button>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-calendar-check"></i></div>
                                        <div>
                                            <div class="account-key">Member Since</div>
                                            <div class="account-value">{{ $user->created_at->format('F d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-patch-check"></i></div>
                                        <div>
                                            <div class="account-key">Plan</div>
                                            <div class="account-value">
                                                {{ ucfirst(strtolower($user->roletype)) }} &nbsp;
                                                <span
                                                    style="background:var(--accent-l);color:var(--accent-d);font-size:.7rem;font-weight:600;padding:2px 9px;border-radius:20px;">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-shield-lock"></i></div>
                                        <div>
                                            <div class="account-key">Password</div>
                                            <div class="account-value">Last changed 3 months ago</div>
                                        </div>
                                    </div>
                                    <button class="btn-copy"
                                        style="color:var(--accent);border-color:var(--accent)">Change</button>
                                </div>
                                <div class="account-list-item">
                                    <div class="account-list-left">
                                        <div class="account-list-icon"><i class="bi bi-shield-check"></i></div>
                                        <div>
                                            <div class="account-key">Two-Factor Auth</div>
                                            <div class="account-value">Not enabled</div>
                                        </div>
                                    </div>
                                    <button class="btn-copy" style="color:var(--success);border-color:var(--success)">
                                        <i class="bi bi-toggle-off"></i> Enable
                                    </button>
                                </div>
                            </div>
                            <div
                                style="background:var(--danger-l);border:1.5px solid #fecaca;border-radius:var(--radius-sm);padding:14px 18px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                                <div style="display:flex;align-items:center;gap:11px;">
                                    <div
                                        style="width:34px;height:34px;border-radius:8px;background:#fee2e2;color:var(--danger);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size:.71rem;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#b91c1c;">
                                            Danger Zone
                                        </div>
                                        <div style="font-size:.85rem;color:var(--ink-2);">Permanently delete your account
                                            and all data</div>
                                    </div>
                                </div>
                                <button class="btn-copy"
                                    style="color:var(--danger);border-color:var(--danger);flex-shrink:0;">
                                    Delete Account
                                </button>
                            </div>
                        </div>

                        <div class="text-center pt-4 mt-3 border-top" style="border-color:var(--border)!important">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="bi bi-box-arrow-right"></i> Sign Out of Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-title"><i class="bi bi-person-gear"></i> Edit Profile</div>
            <div class="row g-3">
                @php
                    $nameParts = explode(' ', $user->name);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : '';
                @endphp
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ $firstName }}"
                            placeholder="First name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ $lastName }}" placeholder="Last name">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control" placeholder="Tell us about yourself…">Creative strategist and event enthusiast. Passionate about curating meaningful experiences.</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" id="cancelEditBtn">Cancel</button>
                <button class="btn-save" id="saveEditBtn"><i class="bi bi-check-lg me-1"></i> Save Changes</button>
            </div>
        </div>
    </div>

    <div class="toast-notify" id="toastNotify">
        <i class="bi bi-check-circle-fill"></i>
        <span id="toastMsg">Done!</span>
    </div>

    <script>
        function activatePanel(panelId) {
            document.querySelectorAll('.sidebar-nav li a[data-panel]').forEach(a => a.classList.remove('active'));
            const link = document.querySelector(`.sidebar-nav li a[data-panel="${panelId}"]`);
            if (link) link.classList.add('active');
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            const panel = document.getElementById('panel-' + panelId);
            if (panel) panel.classList.add('active');
        }

        document.querySelectorAll('.sidebar-nav li a[data-panel]').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                activatePanel(link.dataset.panel);
            });
        });

        document.querySelectorAll('.quick-link-card[data-panel]').forEach(card => {
            card.addEventListener('click', e => {
                e.preventDefault();
                activatePanel(card.dataset.panel);
            });
        });

        const modal = document.getElementById('editModal');
        const openModal = () => modal.classList.add('open');
        const closeModal = () => modal.classList.remove('open');

        document.getElementById('editProfileBtn').addEventListener('click', openModal);
        const btn2 = document.getElementById('editProfileBtn2');
        if (btn2) btn2.addEventListener('click', openModal);
        document.getElementById('cancelEditBtn').addEventListener('click', closeModal);
        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
        document.getElementById('saveEditBtn').addEventListener('click', () => {
            closeModal();
            showToast('Profile updated successfully!');
        });

        function copyText(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-lg"></i> Copied!';
                btn.style.color = 'var(--success)';
                btn.style.borderColor = 'var(--success)';
                showToast('Copied to clipboard!');
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.style.color = '';
                    btn.style.borderColor = '';
                }, 1800);
            });
        }

        function showToast(msg) {
            const t = document.getElementById('toastNotify');
            document.getElementById('toastMsg').textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2600);
        }
    </script>
@endsection

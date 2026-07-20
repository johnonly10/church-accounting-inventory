@extends('layouts.guest')

@section('content')
    <style>
        .tour-hero {
            position: relative;
            width: 100vw;
            min-height: 90vh;
            border-radius: 0;
            overflow: hidden;
            background: #0b1220;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
        }

        .tour-hero__img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.02);
            transition: opacity 400ms ease-in-out, transform 400ms ease;
            opacity: 1;
        }

        .tour-hero__img.loading {
            opacity: 0;
        }

        .tour-hero__img.loaded {
            opacity: 1;
        }

        .tour-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(6, 10, 18, .78) 0%, rgba(6, 10, 18, .35) 55%, rgba(6, 10, 18, .10) 100%);
        }

        .tour-bottom {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 26px;
            z-index: 3;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            padding: 0 34px;
        }

        .tour-hero__body {
            display: flex;
            align-items: flex-end;
            flex: 1 1 auto;
            min-width: 280px;
            max-width: min(760px, 55vw);
        }

        .tour-meta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, .92);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .tour-title {
            color: #fff;
            font-weight: 900;
            letter-spacing: .6px;
            line-height: .95;
            font-size: clamp(44px, 6.5vw, 88px);
            margin: 0 0 14px 0;
            text-transform: uppercase;
            transition: opacity 300ms ease;
        }

        .tour-desc {
            color: rgba(255, 255, 255, .85);
            max-width: 680px;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 18px 0;
            transition: opacity 300ms ease;
        }

        .tour-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-explore {
            background: rgba(255, 255, 255, .92);
            color: #111827;
            border: 0;
            padding: 12px 18px;
            border-radius: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .22);
            text-decoration: none;
            display: inline-block;
            transition: background 200ms ease, transform 200ms ease, box-shadow 200ms ease;
        }

        .btn-explore:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 14px 34px rgba(0, 0, 0, .28);
        }

        .btn-explore:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 3px;
        }

        .btn-outline {
            background: rgba(255, 255, 255, .12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .25);
            padding: 12px 18px;
            border-radius: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 200ms ease, transform 200ms ease;
            backdrop-filter: blur(4px);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, .22);
            transform: translateY(-2px);
        }

        .btn-outline:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 3px;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 0;
            background: rgba(255, 255, 255, .18);
            color: #fff;
            cursor: pointer;
            display: grid;
            place-items: center;
            backdrop-filter: blur(8px);
            flex-shrink: 0;
            transition: background 200ms ease, transform 200ms ease, opacity 200ms ease;
        }

        .btn-icon:hover:not(:disabled) {
            background: rgba(255, 255, 255, .28);
            transform: scale(1.05);
        }

        .btn-icon:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 2px;
        }

        .btn-icon:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            transform: none;
        }

        .tour-cards-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        .tour-cards {
            display: flex;
            gap: 16px;
            align-items: flex-end;
            flex: 0 0 auto;
        }

        .tour-card {
            position: relative;
            width: 240px;
            height: 210px;
            border-radius: 22px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, .18);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .35);
            transform: translateY(0);
            transition: transform 250ms cubic-bezier(0.4, 0, 0.2, 1), border-color 250ms cubic-bezier(0.4, 0, 0.2, 1), box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1);
            background: #0b1220;
            flex: 0 0 auto;
        }

        .tour-card:hover:not(.is-active) {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, .35);
            box-shadow: 0 22px 54px rgba(0, 0, 0, .45);
        }

        .tour-card.is-active {
            border-color: rgba(255, 255, 255, .80);
            box-shadow: 0 26px 64px rgba(0, 0, 0, .55);
            transform: translateY(-6px);
        }

        .tour-card:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 2px;
        }

        .tour-card__img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(1.08);
            transition: transform 500ms ease;
        }

        .tour-card:hover .tour-card__img {
            transform: scale(1.05);
        }

        .tour-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .06) 0%, rgba(0, 0, 0, .55) 72%, rgba(0, 0, 0, .78) 100%);
        }

        .tour-card__content {
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 14px;
            color: #fff;
        }

        .tour-card__place {
            font-size: 12px;
            opacity: .92;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tour-card__name {
            font-size: 20px;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.05;
            letter-spacing: .3px;
        }

        .tour-dots {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-top: 6px;
        }

        .tour-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, .25);
            cursor: pointer;
            padding: 0;
            transition: all 250ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tour-dot:hover {
            background: rgba(255, 255, 255, .45);
            transform: scale(1.2);
        }

        .tour-dot.is-active {
            background: #818cf8;
            width: 24px;
            border-radius: 4px;
        }

        .tour-dot:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 2px;
        }

        .skeleton-loader {
            position: absolute;
            inset: 0;
            background: #1a2332;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .skeleton-loader.hidden {
            display: none;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .skeleton-loader__spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255, 255, 255, .1);
            border-top-color: #818cf8;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .content-fade {
            transition: opacity 300ms ease, transform 300ms ease;
        }

        .content-fade.hidden {
            opacity: 0;
            transform: translateY(8px);
        }

        @media (max-width: 1024px) {
            .tour-hero {
                min-height: 92vh;
            }

            .tour-bottom {
                padding: 0 18px;
            }

            .tour-hero__body {
                max-width: min(700px, 52vw);
            }

            .tour-card {
                width: 220px;
                height: 200px;
            }
        }

        @media (max-width: 900px) {
            .tour-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .tour-hero__body {
                max-width: 100%;
            }

            .tour-cards-wrapper {
                width: 100%;
            }

            .tour-cards {
                flex: 1 1 auto;
            }

            .tour-dots {
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .tour-title {
                font-size: clamp(32px, 9vw, 50px);
            }

            .tour-card {
                width: 180px;
                height: 170px;
            }

            .tour-bottom {
                padding: 0 14px;
                bottom: 16px;
                gap: 10px;
            }

            .btn-icon {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .tour-card {
                width: 150px;
                height: 150px;
            }

            .tour-card__name {
                font-size: 16px;
            }

            .btn-explore,
            .btn-outline {
                padding: 10px 14px;
                font-size: 13px;
            }
        }
    </style>

    @if ($events->isNotEmpty())
        @php $first = $events->first(); @endphp
        <section aria-label="Featured events and destinations">
            <div class="tour-hero" id="tourHero" role="region" aria-label="Event showcase">
                <div class="skeleton-loader" id="heroSkeleton" role="status" aria-label="Loading content">
                    <div class="skeleton-loader__spinner"></div>
                </div>

                <img id="heroMainImage" class="tour-hero__img loading" src="{{ asset($first->image_path) }}"
                    alt="{{ $first->name }} - featured event" loading="eager" fetchpriority="high"
                    onerror="this.src='/images/fallback-hero.jpg'; this.alt='Image unavailable';">

                <div class="tour-hero__overlay" aria-hidden="true"></div>

                <div class="tour-bottom">
                    <div class="tour-hero__body">
                        <div>
                            <div class="tour-meta" id="heroLocation">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 22s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12Z"
                                        stroke="rgba(255,255,255,.9)" stroke-width="2" />
                                    <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="rgba(255,255,255,.9)"
                                        stroke-width="2" />
                                </svg>
                                <span>{{ $first->location }}</span>
                            </div>

                            <h1 class="tour-title" id="heroTitle">{{ $first->name }}</h1>

                            <p class="tour-desc" id="heroDesc">{{ Str::limit($first->short_description, 120) }}</p>

                            <div class="tour-actions">
                                <a href="#" class="btn-explore" id="heroExploreBtn"
                                    aria-label="Explore {{ $first->name }}">
                                    Explore
                                </a>
                                {{-- @if ($events->count() > 1)
                                    <a href="{{ route('events.index') }}" class="btn-outline" aria-label="View all events">
                                        View All Events
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </div>

                    <div class="tour-cards-wrapper">
                        <button id="cardPrev" type="button" class="btn-icon" aria-label="Previous slide" disabled>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 18l-6-6 6-6" stroke="rgba(255,255,255,.95)" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div class="tour-cards" id="tourCards" role="tablist" aria-label="Event slides">
                            @foreach ($events as $event)
                                <div class="tour-card {{ $loop->first ? 'is-active' : '' }}" role="tab" tabindex="0"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}" aria-label="{{ $event->name }}"
                                    data-image="{{ asset($event->image_path) }}" data-location="{{ $event->location }}"
                                    data-title="{{ $event->name }}"
                                    data-desc="{{ Str::limit($event->short_description, 120) }}"
                                    data-slug="{{ $event->slug ?? '#' }}">
                                    <img class="tour-card__img" src="{{ asset($event->image_path) }}"
                                        alt="{{ $event->name }}" loading="lazy" decoding="async"
                                        onerror="this.src='/images/fallback-card.jpg'; this.alt='Image unavailable';">
                                    <div class="tour-card__overlay" aria-hidden="true"></div>
                                    <div class="tour-card__content">
                                        <div class="tour-card__place">{{ $event->location }}</div>
                                        <div class="tour-card__name">{{ $event->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button id="cardNext" type="button" class="btn-icon" aria-label="Next slide">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M9 18l6-6-6-6" stroke="rgba(255,255,255,.95)" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="tour-dots" id="tourDots" role="tablist" aria-label="Slide indicators">
                        @foreach ($events as $index => $event)
                            <button class="tour-dot {{ $index === 0 ? 'is-active' : '' }}" role="tab"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Go to slide {{ $index + 1 }}: {{ $event->name }}"
                                data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="py-24 relative overflow-hidden" style="background:#fafafa;" aria-labelledby="modules-heading">
        <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full opacity-[0.06]"
            style="background:#6366f1;" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <span
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase mb-4"
                    style="background:#eef2ff; color:#4f46e5;">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s4.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                    </svg>
                    Discipleship Modules
                </span>
                <h2 id="modules-heading" class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                    Explore Our Pepsol Modules
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Structured lessons designed to help you grow deeper in faith, one step at a time.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($pepsolNames ?? [] as $pepsol)
                    @if ($pepsol->lessons_count > 0)
                        <a href="{{ route('pepsol.lessons', $pepsol) }}"
                            class="group block bg-white rounded-2xl overflow-hidden border border-gray-100 transition-all duration-300 hover:-translate-y-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            style="box-shadow: 0 1px 3px rgba(0,0,0,.06);"
                            onmouseover="this.style.boxShadow='0 20px 40px -12px rgba(99,102,241,.25)'"
                            onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.06)'"
                            aria-label="{{ $pepsol->name }} - {{ $pepsol->lessons_count }} lessons">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ asset('Images/Pepsol/Name/' . $pepsol->image) }}" alt="{{ $pepsol->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out"
                                    loading="lazy" decoding="async"
                                    onerror="this.src='/images/fallback-module.jpg'; this.alt='Image unavailable';">
                                <div class="absolute inset-0"
                                    style="background:linear-gradient(180deg, transparent 50%, rgba(17,24,39,.55) 100%);"
                                    aria-hidden="true"></div>
                                <span
                                    class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm"
                                    style="background:rgba(255,255,255,.92); color:#4f46e5;">
                                    {{ $pepsol->lessons_count }} {{ Str::plural('Lesson', $pepsol->lessons_count) }}
                                </span>
                                @if ($pepsol->code)
                                    <span
                                        class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm"
                                        style="background:rgba(99,102,241,.85); color:#fff;">
                                        {{ $pepsol->code }}
                                    </span>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                    {{ $pepsol->name }}
                                </h3>
                                <div class="flex items-center justify-between pt-3 mt-1 border-t border-gray-100">
                                    <span class="text-sm font-semibold flex items-center gap-1.5" style="color:#6366f1;">
                                        View Module
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endif
                @empty
                    <div class="col-span-full text-center py-16" role="status">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                            style="background:#eef2ff;">
                            <svg class="w-8 h-8" style="color:#6366f1;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s4.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-gray-500">No modules available yet. Check back soon.</p>
                    </div>
                @endforelse
            </div>

            @php
                $hasModules =
                    isset($pepsolNames) &&
                    $pepsolNames->contains(function ($p) {
                        return $p->lessons_count > 0;
                    });
            @endphp

            @if ($hasModules)
                <div class="text-center mt-14">
                    <a href="{{ route('pepsol.index') }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold text-white transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        style="background:#6366f1; box-shadow: 0 4px 14px rgba(99,102,241,.35);">
                        Browse All Modules
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="relative py-28 overflow-hidden"
        style="background: linear-gradient(135deg, #111827 0%, #1f2937 55%, #1e1b4b 100%);"
        aria-labelledby="about-heading">
        <svg class="absolute inset-0 w-full h-full opacity-[0.04]" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
                <pattern id="grid-pattern" width="42" height="42" patternUnits="userSpaceOnUse">
                    <path d="M42 0H0V42" fill="none" stroke="white" stroke-width="1" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-8"
                style="background:rgba(99,102,241,.15); border:1px solid rgba(99,102,241,.3);">
                <svg class="w-7 h-7" style="color:#818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 21c-4.418-2.686-8-6.686-8-11a8 8 0 1116 0c0 4.314-3.582 8.314-8 11z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 12a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                </svg>
            </div>

            <span class="inline-block text-xs font-semibold tracking-widest uppercase mb-4" style="color:#a5b4fc;">Our
                Story</span>
            <h2 id="about-heading" class="text-3xl sm:text-4xl font-bold text-white mb-6 tracking-tight">
                Growing in Faith, Together
            </h2>
            <p class="text-gray-300 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                {{ Str::limit($aboutExcerpt ?? "Founded in 1987, we are a Christ-centered church family committed to loving God, loving people, and making disciples. We gather to worship Jesus, grow through God's Word, and encourage one another through authentic community.", 240) }}
            </p>
            <a href="{{ route('about') }}"
                class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold transition-all duration-300 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                style="background:#6366f1; color:#fff; box-shadow: 0 8px 24px rgba(99,102,241,.4);">
                Learn More About Us
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    <section class="py-24 bg-white" aria-labelledby="contact-heading">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl overflow-hidden grid grid-cols-1 lg:grid-cols-2"
                style="background:linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); box-shadow: 0 20px 50px -20px rgba(99,102,241,.25);">
                <div class="p-10 sm:p-14 flex flex-col justify-center">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold tracking-wide uppercase mb-4"
                        style="color:#4f46e5;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:#4f46e5;" aria-hidden="true"></span>
                        Get In Touch
                    </span>
                    <h2 id="contact-heading" class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 tracking-tight">
                        We'd Love to Hear From You
                    </h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Have a question, prayer request, or just want to connect? Reach out and our team
                        will get back to you soon.
                    </p>
                    <div>
                        <a href="{{ route('contact.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold text-white transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            style="background:#6366f1; box-shadow: 0 4px 14px rgba(99,102,241,.35);">
                            Contact Us
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="hidden lg:flex items-center justify-center p-14 relative">
                    <div class="absolute w-56 h-56 rounded-full opacity-40"
                        style="background:radial-gradient(circle, rgba(99,102,241,.3) 0%, transparent 70%);"
                        aria-hidden="true"></div>
                    <svg class="w-36 h-36 relative" style="color:#6366f1;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-6l-4 4v-4z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function() {
            const mainImg = document.getElementById('heroMainImage');
            const heroSkeleton = document.getElementById('heroSkeleton');
            const heroLocation = document.getElementById('heroLocation').querySelector('span');
            const heroTitle = document.getElementById('heroTitle');
            const heroDesc = document.getElementById('heroDesc');
            const heroExploreBtn = document.getElementById('heroExploreBtn');
            const cardsWrap = document.getElementById('tourCards');
            const prevBtn = document.getElementById('cardPrev');
            const nextBtn = document.getElementById('cardNext');
            const dotsContainer = document.getElementById('tourDots');

            const allCards = Array.from(cardsWrap.querySelectorAll('.tour-card'));
            const allDots = Array.from(dotsContainer.querySelectorAll('.tour-dot'));
            const perPage = 3;
            let offset = 0;
            let currentIndex = 0;
            let autoplayInterval = null;
            let isTransitioning = false;

            function renderWindow() {
                allCards.forEach((card, i) => {
                    card.style.display = (i >= offset && i < offset + perPage) ? '' : 'none';
                    card.setAttribute('aria-hidden', (i >= offset && i < offset + perPage) ? 'false' : 'true');
                });

                prevBtn.disabled = offset === 0;
                nextBtn.disabled = offset + perPage >= allCards.length;
                updateDots();
            }

            function updateDots() {
                allDots.forEach((dot, index) => {
                    const isActive = index === currentIndex;
                    dot.classList.toggle('is-active', isActive);
                    dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            }

            function setActive(card) {
                if (isTransitioning) return;
                isTransitioning = true;

                const newIndex = allCards.indexOf(card);
                if (newIndex !== -1 && newIndex !== currentIndex) {
                    currentIndex = newIndex;
                    updateDots();
                }

                const titleEl = document.getElementById('heroTitle');
                const descEl = document.getElementById('heroDesc');

                titleEl.classList.add('hidden');
                descEl.classList.add('hidden');

                mainImg.classList.add('loading');
                mainImg.classList.remove('loaded');

                setTimeout(() => {
                    mainImg.src = card.dataset.image;
                    mainImg.alt = card.dataset.title || 'Featured event';

                    const imageLoadHandler = () => {
                        mainImg.classList.remove('loading');
                        mainImg.classList.add('loaded');
                        heroSkeleton.classList.add('hidden');

                        heroLocation.textContent = card.dataset.location || '';
                        heroTitle.textContent = card.dataset.title || '';
                        heroDesc.textContent = card.dataset.desc || '';
                        heroExploreBtn.href = card.dataset.slug || '#';
                        heroExploreBtn.textContent = 'Explore';

                        setTimeout(() => {
                            titleEl.classList.remove('hidden');
                            descEl.classList.remove('hidden');
                        }, 50);

                        mainImg.removeEventListener('load', imageLoadHandler);
                        isTransitioning = false;
                    };

                    const imageErrorHandler = () => {
                        mainImg.src = '/images/fallback-hero.jpg';
                        mainImg.alt = 'Image unavailable';
                        mainImg.classList.remove('loading');
                        mainImg.classList.add('loaded');
                        heroSkeleton.classList.add('hidden');

                        setTimeout(() => {
                            titleEl.classList.remove('hidden');
                            descEl.classList.remove('hidden');
                        }, 50);

                        mainImg.removeEventListener('error', imageErrorHandler);
                        isTransitioning = false;
                    };

                    mainImg.addEventListener('load', imageLoadHandler);
                    mainImg.addEventListener('error', imageErrorHandler);

                    setTimeout(() => {
                        if (mainImg.complete) {
                            mainImg.dispatchEvent(new Event('load'));
                        }
                    }, 100);
                }, 200);

                allCards.forEach(c => {
                    c.classList.remove('is-active');
                    c.setAttribute('aria-selected', 'false');
                });
                card.classList.add('is-active');
                card.setAttribute('aria-selected', 'true');
            }

            function goToSlide(index) {
                if (index < 0 || index >= allCards.length || isTransitioning) return;

                const targetCard = allCards[index];
                if (!targetCard) return;

                if (index < offset || index >= offset + perPage) {
                    offset = Math.min(
                        Math.max(0, Math.floor(index / perPage) * perPage),
                        allCards.length - perPage
                    );
                    renderWindow();
                }

                setActive(targetCard);
                resetAutoplay();
            }

            function goToNext() {
                const nextIndex = (currentIndex + 1) % allCards.length;
                goToSlide(nextIndex);
            }

            function goToPrev() {
                const prevIndex = (currentIndex - 1 + allCards.length) % allCards.length;
                goToSlide(prevIndex);
            }

            function resetAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
                startAutoplay();
            }

            function startAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                }
                autoplayInterval = setInterval(goToNext, 5000);
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }

            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                goToPrev();
            });

            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                goToNext();
            });

            allDots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.dataset.index);
                    if (!isNaN(index) && index !== currentIndex) {
                        goToSlide(index);
                    }
                });
            });

            cardsWrap.addEventListener('click', (e) => {
                const card = e.target.closest('.tour-card');
                if (card) {
                    const index = allCards.indexOf(card);
                    if (index !== -1 && index !== currentIndex) {
                        goToSlide(index);
                    }
                }
            });

            cardsWrap.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const card = e.target.closest('.tour-card');
                    if (card) {
                        const index = allCards.indexOf(card);
                        if (index !== -1 && index !== currentIndex) {
                            goToSlide(index);
                        }
                    }
                }
                if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    if (e.key === 'ArrowLeft') {
                        goToPrev();
                    } else {
                        goToNext();
                    }
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                    const hero = document.getElementById('tourHero');
                    if (hero && hero.contains(document.activeElement)) {
                        e.preventDefault();
                        if (e.key === 'ArrowLeft') {
                            goToPrev();
                        } else {
                            goToNext();
                        }
                    }
                }
            });

            const heroContainer = document.getElementById('tourHero');
            heroContainer.addEventListener('mouseenter', stopAutoplay);
            heroContainer.addEventListener('mouseleave', startAutoplay);
            heroContainer.addEventListener('touchstart', stopAutoplay);
            heroContainer.addEventListener('touchend', startAutoplay);

            let touchStartX = 0;
            let touchEndX = 0;

            heroContainer.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            heroContainer.addEventListener('touchmove', (e) => {
                e.preventDefault();
            }, {
                passive: false
            });

            heroContainer.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        goToNext();
                    } else {
                        goToPrev();
                    }
                }
            }, {
                passive: true
            });

            if (mainImg.complete) {
                heroSkeleton.classList.add('hidden');
                mainImg.classList.add('loaded');
            } else {
                mainImg.addEventListener('load', () => {
                    heroSkeleton.classList.add('hidden');
                    mainImg.classList.add('loaded');
                });
                mainImg.addEventListener('error', () => {
                    mainImg.src = '/images/fallback-hero.jpg';
                    mainImg.alt = 'Image unavailable';
                    heroSkeleton.classList.add('hidden');
                    mainImg.classList.add('loaded');
                });
            }

            renderWindow();
            const initialCard = allCards[0];
            if (initialCard) {
                setActive(initialCard);
            }
            startAutoplay();
        })();
    </script>
@endpush

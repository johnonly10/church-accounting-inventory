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
            transition: opacity 220ms ease;
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
        }

        .tour-desc {
            color: rgba(255, 255, 255, .85);
            max-width: 680px;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 18px 0;
        }

        .tour-actions {
            display: flex;
            align-items: center;
            gap: 12px;
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
        }

        .btn-explore:hover {
            background: #fff;
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
        }

        .btn-icon:hover {
            background: rgba(255, 255, 255, .25);
        }

        .btn-icon:disabled {
            opacity: 0.3;
            cursor: default;
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
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .35);
            transform: translateY(0);
            transition: transform 160ms ease, border-color 160ms ease, box-shadow 160ms ease;
            background: #0b1220;
            flex: 0 0 auto;
        }

        .tour-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, .35);
            box-shadow: 0 22px 54px rgba(0, 0, 0, .45);
        }

        .tour-card.is-active {
            border-color: rgba(255, 255, 255, .70);
            box-shadow: 0 26px 64px rgba(0, 0, 0, .55);
        }

        .tour-card__img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(1.08);
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
        }

        @media (max-width: 560px) {
            .tour-title {
                font-size: clamp(38px, 9vw, 70px);
            }

            .tour-card {
                width: 210px;
                height: 190px;
            }
        }
    </style>

    @if ($events->isNotEmpty())
        @php $first = $events->first(); @endphp
        <section>
            <div class="tour-hero" id="tourHero">
                <img id="heroMainImage" class="tour-hero__img" src="{{ asset($first->image_path) }}" alt="{{ $first->name }}">
                <div class="tour-hero__overlay"></div>

                <div class="tour-bottom">
                    <div class="tour-hero__body">
                        <div>
                            <div class="tour-meta" id="heroLocation">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 22s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12Z"
                                        stroke="rgba(255,255,255,.9)" stroke-width="2" />
                                    <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="rgba(255,255,255,.9)"
                                        stroke-width="2" />
                                </svg>
                                <span>{{ $first->location }}</span>
                            </div>

                            <h1 class="tour-title" id="heroTitle">{{ $first->name }}</h1>

                            <p class="tour-desc" id="heroDesc">{{ $first->short_description }}</p>

                            <div class="tour-actions">
                                <a href="#" class="btn-explore" id="heroExploreBtn">Explore</a>
                            </div>
                        </div>
                    </div>

                    <div class="tour-cards-wrapper">
                        <button id="cardPrev" type="button" class="btn-icon" aria-label="Previous">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M15 18l-6-6 6-6" stroke="rgba(255,255,255,.95)" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div class="tour-cards" id="tourCards">
                            @foreach ($events as $event)
                                <div class="tour-card {{ $loop->first ? 'is-active' : '' }}" role="button" tabindex="0"
                                    data-image="{{ asset($event->image_path) }}" data-location="{{ $event->location }}"
                                    data-title="{{ $event->name }}" data-desc="{{ $event->short_description }}">
                                    <img class="tour-card__img" src="{{ asset($event->image_path) }}"
                                        alt="{{ $event->name }}">
                                    <div class="tour-card__overlay"></div>
                                    <div class="tour-card__content">
                                        <div class="tour-card__place">{{ $event->location }}</div>
                                        <div class="tour-card__name">{{ $event->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button id="cardNext" type="button" class="btn-icon" aria-label="Next">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M9 18l6-6-6-6" stroke="rgba(255,255,255,.95)" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        (function() {
            const mainImg = document.getElementById('heroMainImage');
            const heroLocation = document.getElementById('heroLocation').querySelector('span');
            const heroTitle = document.getElementById('heroTitle');
            const heroDesc = document.getElementById('heroDesc');
            const heroExploreBtn = document.getElementById('heroExploreBtn');
            const cardsWrap = document.getElementById('tourCards');
            const prevBtn = document.getElementById('cardPrev');
            const nextBtn = document.getElementById('cardNext');

            const allCards = Array.from(cardsWrap.querySelectorAll('.tour-card'));
            const perPage = 3;
            let offset = 0;

            function renderWindow() {
                allCards.forEach((card, i) => {
                    card.style.display = (i >= offset && i < offset + perPage) ? '' : 'none';
                });

                prevBtn.disabled = offset === 0;
                nextBtn.disabled = offset + perPage >= allCards.length;
            }

            function setActive(card) {
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    mainImg.src = card.dataset.image;
                    const restore = () => {
                        mainImg.style.opacity = '1';
                    };
                    mainImg.onload = restore;
                    setTimeout(restore, 120);
                }, 120);

                heroLocation.textContent = card.dataset.location || '';
                heroTitle.textContent = card.dataset.title || '';
                heroDesc.textContent = card.dataset.desc || '';
                heroExploreBtn.href = card.dataset.slug || '#';

                allCards.forEach(c => c.classList.remove('is-active'));
                card.classList.add('is-active');
            }

            prevBtn.addEventListener('click', () => {
                if (offset > 0) {
                    offset--;
                    renderWindow();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (offset + perPage < allCards.length) {
                    offset++;
                    renderWindow();
                }
            });

            cardsWrap.addEventListener('click', (e) => {
                const card = e.target.closest('.tour-card');
                if (card) setActive(card);
            });

            cardsWrap.addEventListener('keydown', (e) => {
                if (e.key !== 'Enter' && e.key !== ' ') return;
                const card = e.target.closest('.tour-card');
                if (!card) return;
                e.preventDefault();
                setActive(card);
            });

            renderWindow();
            setActive(allCards[0]);
        })();
    </script>
@endpush

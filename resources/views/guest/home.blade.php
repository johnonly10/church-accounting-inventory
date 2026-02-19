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

        .tour-hero__top {
            position: relative;
            z-index: 3;
            padding: 22px 22px 0 22px;
            display: flex;
            justify-content: center;
        }

        .tour-search {
            width: min(720px, 92%);
            background: rgba(255, 255, 255, .92);
            border-radius: 999px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .18);
            backdrop-filter: blur(8px);
        }

        .tour-search input {
            border: 0;
            outline: none;
            width: 100%;
            font-size: 14px;
            background: transparent;
        }

        .tour-search button {
            border: 0;
            background: transparent;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 10px;
        }

        .tour-search button:hover {
            background: rgba(0, 0, 0, .06);
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
        }

        .btn-icon:hover {
            background: rgba(255, 255, 255, .25);
        }

        .tour-cards {
            display: flex;
            gap: 16px;
            align-items: flex-end;
            justify-content: flex-end;
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

            .tour-cards {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding-bottom: 2px;
            }

            .tour-cards::-webkit-scrollbar {
                display: none;
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
    <section>
        <div class="tour-hero" id="tourHero">
            <img id="heroMainImage" class="tour-hero__img" src="{{ asset('Images/Banner/hills.jpg') }}" alt="Main destination">
            <div class="tour-hero__overlay"></div>

            <div class="tour-bottom">
                <div class="tour-hero__body">
                    <div>
                        <div class="tour-meta" id="heroLocation">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12Z" stroke="rgba(255,255,255,.9)"
                                    stroke-width="2" />
                                <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="rgba(255,255,255,.9)"
                                    stroke-width="2" />
                            </svg>
                            <span>Bohol, Philippines</span>
                        </div>

                        <h1 class="tour-title" id="heroTitle">Chocolate Hills</h1>

                        <p class="tour-desc" id="heroDesc">
                            The Chocolate Hills are conical karst hills. These hills consist of Late Pliocene to Early
                            Pleistocene, thin to medium bedded, sandy to rubbly marine limestone.
                        </p>

                        <div class="tour-actions">
                            <button class="btn-explore" type="button">Explore</button>
                            <button class="btn-icon" type="button" aria-label="Bookmark">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M7 3h10a1 1 0 0 1 1 1v17l-6-3-6 3V4a1 1 0 0 1 1-1Z"
                                        stroke="rgba(255,255,255,.95)" stroke-width="2" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tour-cards" id="tourCards">
                    <div class="tour-card" role="button" tabindex="0"
                        data-image="{{ asset('Images/Banner/el-nido.jpg') }}" data-location="Palawan, Philippines"
                        data-title="El Nido Island"
                        data-desc="El Nido is famous for limestone cliffs, turquoise lagoons, white-sand beaches, and island-hopping adventures.">
                        <img class="tour-card__img" src="{{ asset('Images/Banner/el-nido.jpg') }}" alt="El Nido Island">
                        <div class="tour-card__overlay"></div>
                        <div class="tour-card__content">
                            <div class="tour-card__place">Palawan, Philippines</div>
                            <div class="tour-card__name">El Nido Island</div>
                        </div>
                    </div>

                    <div class="tour-card" role="button" tabindex="0" data-image="{{ asset('Images/Banner/mayon.jpg') }}"
                        data-location="Albay, Philippines" data-title="Mayon Volcano"
                        data-desc="Mayon is known for its near-perfect cone, scenic viewpoints, and dramatic landscapes around Albay.">
                        <img class="tour-card__img" src="{{ asset('Images/Banner/mayon.jpg') }}" alt="Mayon Volcano">
                        <div class="tour-card__overlay"></div>
                        <div class="tour-card__content">
                            <div class="tour-card__place">Albay, Philippines</div>
                            <div class="tour-card__name">Mayon Volcano</div>
                        </div>
                    </div>

                    <div class="tour-card is-active" role="button" tabindex="0"
                        data-image="{{ asset('Images/Banner/hills.jpg') }}" data-location="Bohol, Philippines"
                        data-title="Chocolate Hills"
                        data-desc="The Chocolate Hills are conical karst hills formed by marine limestone. In the dry season, the grass turns brown like chocolate.">
                        <img class="tour-card__img" src="{{ asset('Images/Banner/hills.jpg') }}" alt="Chocolate Hills">
                        <div class="tour-card__overlay"></div>
                        <div class="tour-card__content">
                            <div class="tour-card__place">Bohol, Philippines</div>
                            <div class="tour-card__name">Chocolate Hills</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function() {
            const mainImg = document.getElementById('heroMainImage');
            const heroLocation = document.getElementById('heroLocation').querySelector('span');
            const heroTitle = document.getElementById('heroTitle');
            const heroDesc = document.getElementById('heroDesc');
            const cardsWrap = document.getElementById('tourCards');

            function setActive(card) {
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    const nextSrc = card.dataset.image;
                    mainImg.src = nextSrc;
                    const restore = () => {
                        mainImg.style.opacity = '1';
                    };
                    mainImg.onload = restore;
                    setTimeout(restore, 120);
                }, 120);

                heroLocation.textContent = card.dataset.location || '';
                heroTitle.textContent = card.dataset.title || '';
                heroDesc.textContent = card.dataset.desc || '';

                cardsWrap.querySelectorAll('.tour-card').forEach(c => c.classList.remove('is-active'));
                card.classList.add('is-active');
            }

            cardsWrap.addEventListener('click', (e) => {
                const card = e.target.closest('.tour-card');
                if (!card) return;
                setActive(card);
            });

            cardsWrap.addEventListener('keydown', (e) => {
                if (e.key !== 'Enter' && e.key !== ' ') return;
                const card = e.target.closest('.tour-card');
                if (!card) return;
                e.preventDefault();
                setActive(card);
            });
        })();
    </script>
@endpush

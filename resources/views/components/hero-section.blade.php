@props([
    'title' => 'Page Title',
    'subtitle' => null,
    'breadcrumbs' => [],
    'height' => '48vh',
    'image' => asset('Images/default/background.jpg'),
    'icon' => 'fa-solid fa-house',
])

<section class="hero" style="min-height: {{ $height }}">
    <div class="hero__bg-image" style="{{ $image ? 'background-image: url(' . $image . ')' : '' }}"></div>
    <div class="hero__overlay"></div>

    <div class="hero__accent hero__accent--circle"></div>
    <div class="hero__accent hero__accent--line"></div>

    <div class="hero__content">
        @if ($subtitle)
            <div class="hero__eyebrow">
                <span class="hero__eyebrow-dot"></span>
                <span>{{ $subtitle }}</span>
            </div>
        @endif

        <h1 class="hero__title">{!! $title !!}</h1>

        @if (count($breadcrumbs) > 0)
            <nav class="hero__breadcrumb" aria-label="Breadcrumb">
                @foreach ($breadcrumbs as $index => $crumb)
                    @if ($index > 0)
                        <span class="hero__breadcrumb-sep">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    @endif

                    @if (isset($crumb['url']))
                        <a href="{{ $crumb['url'] }}" class="hero__breadcrumb-link">
                            @if ($index === 0)
                                <i class="{{ $icon }}"></i>
                            @endif
                            {{ $crumb['label'] }}
                        </a>
                    @else
                        <span class="hero__breadcrumb-current">
                            @if ($index === 0)
                                <i class="{{ $icon }}"></i>
                            @endif
                            {{ $crumb['label'] }}
                        </span>
                    @endif
                @endforeach
            </nav>
        @endif

    </div>
</section>


<style>
    .hero {
        position: relative;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero__bg-image {
        position: absolute;
        inset: 0;
        background-image: url('/Images/default/background.jpg');
        background-size: cover;
        background-position: center;
        transform: scale(1.04);
        animation: heroZoom 8s ease-out forwards;
    }

    @keyframes heroZoom {
        from {
            transform: scale(1.04);
        }

        to {
            transform: scale(1.00);
        }
    }

    .hero__overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg,
                rgba(15, 10, 40, 0.85) 0%,
                rgba(15, 10, 40, 0.62) 55%,
                rgba(15, 10, 40, 0.25) 100%);
    }

    .hero__accent {
        position: absolute;
        pointer-events: none;
    }

    .hero__accent--circle {
        width: 320px;
        height: 320px;
        border-radius: 50%;
        border: 1px solid rgba(99, 102, 241, 0.15);
        top: -80px;
        right: 12%;
        animation: accentSpin 24s linear infinite;
    }

    .hero__accent--circle::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 1px solid rgba(99, 102, 241, 0.12);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes accentSpin {
        to {
            transform: rotate(360deg);
        }
    }

    .hero__accent--line {
        width: 2px;
        height: 100%;
        top: 0;
        right: 28%;
        background: linear-gradient(to bottom,
                transparent,
                rgba(255, 255, 255, 0.06) 40%,
                rgba(255, 255, 255, 0.06) 60%,
                transparent);
    }

    .hero__content {
        position: relative;
        z-index: 2;
        padding: 72px 48px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        animation: heroFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes heroFadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Georgia', serif;
        font-size: 11px;
        font-weight: 400;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(165, 167, 247, 0.9);
        animation: heroFadeUp 0.7s 0.1s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .hero__eyebrow-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #6366f1;
        box-shadow: 0 0 8px rgba(99, 102, 241, 0.7);
        animation: pulse 2.5s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 8px rgba(99, 102, 241, 0.7);
        }

        50% {
            box-shadow: 0 0 18px rgba(99, 102, 241, 1);
        }
    }

    .hero__title {
        margin: 0;
        font-family: 'Georgia', 'Times New Roman', serif;
        font-size: clamp(36px, 5vw, 54px);
        font-weight: 700;
        line-height: 1.05;
        color: #ffffff;
        letter-spacing: -0.02em;
        animation: heroFadeUp 0.7s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .hero__title em {
        font-style: italic;
        color: #a5b4fc;
    }

    .hero__breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        animation: heroFadeUp 0.7s 0.25s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .hero__breadcrumb-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: rgba(199, 200, 251, 0.75);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .hero__breadcrumb-link:hover {
        color: #ffffff;
    }

    .hero__breadcrumb-link i {
        font-size: 11px;
    }

    .hero__breadcrumb-sep {
        color: rgba(199, 200, 251, 0.35);
        font-size: 10px;
    }

    .hero__breadcrumb-current {
        font-size: 13px;
        color: rgba(199, 200, 251, 0.95);
        font-weight: 500;
    }

    @media (max-width: 640px) {
        .hero__content {
            padding: 60px 24px;
        }

        .hero__accent--circle {
            width: 200px;
            height: 200px;
            right: -40px;
            top: -40px;
        }

        .hero__accent--line {
            display: none;
        }
    }
</style>

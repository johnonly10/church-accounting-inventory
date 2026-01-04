@props([
    'title' => null,
    'createRoute' => null,
    'archiveRoute' => null,
    'createLabel' => 'Add New',
    'archiveLabel' => 'Archive',
    'homeRoute' => null,
    'homeLabel' => '',
])

<div class="row">
    <div class="col-lg-12">
        <div {{ $attributes->merge(['class' => 'white_card card_height_100 mb_30']) }}>
            <div class="white_card_header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="box_header m-0">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end gap-2 button-group-enhanced">
                            @if ($createRoute)
                                <a href="{{ $createRoute }}" class="btn_1 btn-enhanced">
                                    <i class="fas fa-plus icon-enhanced"></i>
                                    <span class="btn-text">{{ $createLabel }} {{ $title }}</span>
                                </a>
                            @endif

                            @if ($homeRoute)
                                <a href="{{ $homeRoute }}" class="btn_1 btn-enhanced">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="btn-text">{{ $homeLabel }} {{ $title }}</span>
                                </a>
                            @endif
                            @if ($archiveRoute)
                                <a href="{{ $archiveRoute }}" class="btn_1 gray_btn btn-enhanced">
                                    <i class="fas fa-archive icon-enhanced"></i>
                                    <span class="btn-text">{{ $archiveLabel }} {{ $title }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body card-body-enhanced">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<style>
    .button-group-enhanced {
        gap: 0.75rem !important;
    }

    .btn-enhanced {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        font-weight: 500;
        font-size: 0.9375rem;
        border-radius: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    .btn-enhanced:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .btn-enhanced:active {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .icon-enhanced {
        font-size: 0.875rem;
        transition: transform 0.3s ease;
    }

    .btn-enhanced:hover .icon-enhanced {
        transform: scale(1.1);
    }

    .btn-text {
        position: relative;
        z-index: 1;
    }

    .btn-enhanced::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-enhanced:hover::before {
        width: 300px;
        height: 300px;
    }

    .card-body-enhanced {
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .button-group-enhanced {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-enhanced {
            justify-content: center;
            width: 100%;
        }
    }

    .btn-enhanced:focus {
        outline: 2px solid currentColor;
        outline-offset: 2px;
    }

    .white_card {
        transition: box-shadow 0.3s ease;
    }

    .white_card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }
</style>

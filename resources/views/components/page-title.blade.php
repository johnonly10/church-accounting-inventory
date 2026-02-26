@props([
    'dashboard' => route('staff.index'),
    'title' => '',
    'active' => null,
    'home' => null,
    'homeRoute' => null,
])

<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
    <div class="page_title_left d-flex align-items-center">
        <h3 class="f_s_25 f_w_700 dark_text mr_30 mb-0">
            {{ $title }}
        </h3>
    </div>

    <div class="page_title_right ms-auto">
        <ol class="breadcrumb page_bradcam mb-0">
            <li class="breadcrumb-item">
                <a href="{{ $dashboard }}">Dashboard</a>
            </li>

            @if (!empty($home) && !empty($homeRoute))
                <li class="breadcrumb-item">
                    <a href="{{ $homeRoute }}">{{ $home }}</a>
                </li>
            @endif

            <li class="breadcrumb-item active">
                {{ $active ?? $title }}
            </li>
        </ol>
    </div>
</div>

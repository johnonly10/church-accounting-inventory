@php
    $logo = \App\Models\Image::query()->where('type', 'logo')->where('is_active', true)->first();
    $logoPath = $logo?->path;
@endphp

<nav class="sidebar">
    <div class="logo d-flex justify-content-between align-items-center">
        <a class="large_logo" href="{{ route('staff.index') }}">
            @if (!empty($logoPath))
                <img src="{{ asset($logoPath) }}" alt="Logo">
            @else
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            @endif

        </a>


        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>

    <ul id="sidebar_menu">
        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/dashboard.svg') }}" alt="Dashboard">
                </div>
                <div class="nav_title">
                    <span>Dashboard </span>
                </div>
            </a>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/17.svg') }}" alt="Brand">
                </div>
                <div class="nav_title">
                    <span>Brand </span>
                </div>
            </a>
            <ul>
                <li><a href="#">Add Brand</a></li>
                <li><a href="#">Brands</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/13.svg') }}" alt="Category">
                </div>
                <div class="nav_title">
                    <span>Category </span>
                </div>
            </a>
            <ul>
                <li><a href="#">Add Category</a></li>
                <li><a href="#">Categories</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/9.svg') }}" alt="Product">
                </div>
                <div class="nav_title">
                    <span>Product </span>
                </div>
            </a>
            <ul>
                <li><a href="#">Add Product</a></li>
                <li><a href="#">Products</a></li>
            </ul>
        </li>

        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/11.svg') }}" alt="Orders">
                </div>
                <div class="nav_title">
                    <span>Orders </span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/6.svg') }}" alt="Sliders">
                </div>
                <div class="nav_title">
                    <span>Sliders </span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/20.svg') }}" alt="Coupons">
                </div>
                <div class="nav_title">
                    <span>Coupons </span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/4.svg') }}" alt="Users">
                </div>
                <div class="nav_title">
                    <span>Users </span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('img/menu-icon/10.svg') }}" alt="Settings">
                </div>
                <div class="nav_title">
                    <span>Settings </span>
                </div>
            </a>
        </li>
    </ul>
</nav>

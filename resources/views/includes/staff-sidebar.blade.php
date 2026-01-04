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
    {{-- 
    {{ route('staff.index') }} Dashboard
    {{ route('staff.users.index') }} Users --}}

    <ul id="sidebar_menu">

        <x-includes.sidebar-item title="Dashboard" route="{{ route('staff.index') }}" icon="fas fa-tachometer-alt" />

        <x-includes.sidebar-item title="Leader" icon="fas fa-user-tie" :hasArrow="true">
            <li><a href="{{ route('staff.leaders.index') }}"> Manage Leaders </a></li>
            <li><a href="{{ route('staff.leaders.create') }}"> Add Leaders</a></li>
        </x-includes.sidebar-item>

        <x-includes.sidebar-item title="Department" icon="fas fa-building" :hasArrow="true">
            <li><a href="{{ route('staff.departments.index') }}">Departments </a></li>
            <li><a href="{{ route('staff.departments.create') }}"> Add Departments</a></li>
        </x-includes.sidebar-item>

        <x-includes.sidebar-item title="Ministry" icon="fas fa-church" :hasArrow="true">
            <li><a href="{{ route('staff.ministries.index') }}">Ministry </a></li>
            <li><a href="{{ route('staff.ministries.create') }}"> Add Ministry</a></li>
        </x-includes.sidebar-item>

        <x-includes.sidebar-item title="Users" icon="fas fa-users" :hasArrow="true">
            <li><a href="{{ route('staff.users.index') }}">Manage Users</a></li>
            <li><a href="{{ route('staff.users.create') }}">Add Users</a></li>
        </x-includes.sidebar-item>

    </ul>
</nav>

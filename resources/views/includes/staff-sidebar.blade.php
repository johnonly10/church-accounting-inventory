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

        <x-includes.sidebar-item title="Dashboard" icon="fas fa-chart-line" :hasArrow="true">
            <li><a href="{{ route('staff.finance-dashboard.index') }}"> Finance Dashboard</a></li>
            {{-- <li><a href="{{ route('staff.leaders.create') }}"> Add Leaders</a></li> --}}
        </x-includes.sidebar-item>

        {{-- <x-includes.sidebar-item title="Department" icon="fas fa-building" :hasArrow="true">
            <li><a href="{{ route('staff.departments.index') }}">Departments </a></li>
            <li><a href="{{ route('staff.departments.create') }}"> Add Departments</a></li>
        </x-includes.sidebar-item> --}}

        <x-includes.sidebar-item title="Categories" icon="fas fa-solid fa-list" :hasArrow="true">
            <li><a href="{{ route('staff.categories.index') }}">Categories </a></li>
            <li><a href="{{ route('staff.categories.create') }}"> Add Category</a></li>
        </x-includes.sidebar-item>

        <x-includes.sidebar-item title="Users" icon="fas fa-users" :hasArrow="true">

            <li><a href="{{ route('staff.leaders.index') }}"> Leaders </a></li>
            <li><a href="{{ route('staff.leaders.create') }}"> Add Leader</a></li>

            <li class="sidebar-divider"></li>

            <li><a href="{{ route('staff.departments.index') }}">Departments </a></li>
            <li><a href="{{ route('staff.departments.create') }}"> Add Department</a></li>

            <li class="sidebar-divider"></li>

            <li><a href="{{ route('staff.ministries.index') }}">Ministries </a></li>
            <li><a href="{{ route('staff.ministries.create') }}"> Add Ministry</a></li>

            <li class="sidebar-divider"></li>

            <li><a href="{{ route('staff.positions.index') }}">Positions </a></li>
            <li><a href="{{ route('staff.positions.create') }}">Add Position</a></li>

            <li class="sidebar-divider"></li>

            <li><a href="{{ route('staff.users.index') }}">Users</a></li>
            <li><a href="{{ route('staff.users.create') }}">Add User</a></li>
        </x-includes.sidebar-item>

        <x-includes.sidebar-item title="Revenue" icon="fas fa-coins" :hasArrow="true">
            <li><a href="{{ route('staff.revenue-types.index') }}"> Revenue Type </a></li>
            <li><a href="{{ route('staff.revenue-types.create') }}"> Add Revenue Type</a></li>

            <li class="sidebar-divider"></li>

            <li><a href="{{ route('staff.revenues.index') }}"> Revenue </a></li>
            <li><a href="{{ route('staff.revenues.create') }}"> Add Revenue </a></li>
        </x-includes.sidebar-item>

        {{-- <x-includes.sidebar-item title="Expenses" icon="fas fa-file-invoice-dollar" :hasArroow="true">
            <li><a href="{{ route('staff.expenses.index') }}"> Expenses</a></li>
            <li><a href="{{ route('staff.revenue-types.create') }}"> Add Revenue Type</a></li>
        </x-includes.sidebar-item> --}}

        <x-includes.sidebar-item title="Expenses" icon="fas fa-solid fa-money-bill" :hasArrow="true">
            <li><a href="{{ route('staff.expenses.index') }}"> Expenses</a></li>
            <li><a href="{{ route('staff.expenses.create') }}"> Add Expense</a></li>
        </x-includes.sidebar-item>

        {{-- <x-includes.sidebar-item title="Expenses" icon="fas fa-file-invoice-dollar" :hasArrow="true">
            <li><a href="{{ route('staff.expense-categories.index') }}">Categories </a></li>
            <li><a href="{{ route('staff.expense-categories.create') }}"> Add Categories</a></li>


            </x-inclues.sidebar-item> --}}




    </ul>
</nav>

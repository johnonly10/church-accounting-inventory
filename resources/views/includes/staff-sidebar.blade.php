@php
    $logo = \App\Models\Image::query()->where('type', 'logo')->where('is_active', true)->first();
    $logoPath = $logo?->path;
    $user = auth()->user();
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



        @if ($user && $user->roletype === 'STAFF')
            <x-includes.sidebar-item title="Dashboard" icon="fas fa-chart-line" :hasArrow="true">
                <li><a href="{{ route('staff.finance-dashboard.index') }}"> Finance Dashboard</a></li>
            </x-includes.sidebar-item>



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

                <li class="sidebar-divider"></li>

                <li><a href="{{ route('staff.revenue-cash-counts.index') }}"> Denominations</a></li>
                <li><a href="{{ route('staff.revenue-cash-counts.create') }}"> Add Denomination </a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Expenses" icon="fas fa-solid fa-money-bill" :hasArrow="true">
                <li><a href="{{ route('staff.expenses.index') }}"> Expenses</a></li>
                <li><a href="{{ route('staff.expenses.create') }}"> Add Expense</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Signatures" icon="fas fa-signature" :hasArrow="true">
                <li><a href="{{ route('staff.signatures.index') }}">Signatures </a></li>
                <li><a href="{{ route('staff.signatures.create') }}"> Add Signature</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Reports" icon="fas fa-file" :hasArrow="true">
                <li><a href="{{ route('staff.expense-reports.index') }}">Expense Report </a></li>
                <li><a href="{{ route('staff.revenue-reports.index') }}"> Revenue Report</a></li>
                <li><a href="{{ route('staff.finance-reports.index') }}"> Finance Report</a></li>

            </x-includes.sidebar-item>
        @endif


        @if ($user->roletype === 'LEADER')
            <x-includes.sidebar-item title="Dashboard" icon="fas fa-chart-line" :hasArrow="true">
                <li><a href="{{ route('leader.dashboard.index') }}">Leader Dashboard</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Events" icon="fas fa-solid fa-calendar" :hasArrow="true">
                <li><a href="{{ route('leader.events.index') }}">Events </a></li>
                <li><a href="{{ route('leader.events.create') }}"> Add Events</a></li>
            </x-includes.sidebar-item>

            {{-- <x-includes.sidebar-item title="Categories" icon="fas fa-tags" :hasArrow="true">
                <li><a href="{{ route('leader.pepsol-categories.index') }}">Categories </a></li>
                <li><a href="{{ route('leader.pepsol-categories.create') }}"> Add Category</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Types" icon="fas fa-layer-group" :hasArrow="true">

            </x-includes.sidebar-item> --}}

            <x-includes.sidebar-item title="Pepsol" icon="fas fa-book-open" :hasArrow="true">
                <li><a href="{{ route('leader.pepsol-categories.index') }}">Categories </a></li>
                <li><a href="{{ route('leader.pepsol-categories.create') }}"> Add Category</a></li>

                <li class="sidebar-divider"></li>

                <li><a href="{{ route('leader.pepsol-types.index') }}">Types </a></li>
                <li><a href="{{ route('leader.pepsol-types.create') }}"> Add Type</a></li>

                <li class="sidebar-divider"></li>

                <li><a href="{{ route('leader.pepsol-names.index') }}">Main Topic Names </a></li>
                <li><a href="{{ route('leader.pepsol-names.create') }}"> Add Main Topic Names</a></li>

                <li class="sidebar-divider"></li>

                <li><a href="{{ route('leader.pepsol.index') }}">Pepsol </a></li>
                <li><a href="{{ route('leader.pepsol.create') }}"> Add Pepsol</a></li>
            </x-includes.sidebar-item>



            <x-includes.sidebar-item title="Pepsol Quiz" icon="fas fa-file-signature" :hasArrow="true">
                <li><a href="{{ route('leader.pepsol-quiz.index') }}">Quiz </a></li>
                <li><a href="{{ route('leader.pepsol-quiz.create') }}"> Add Quiz</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Pepsol Results" icon="fas fa-clipboard-check" :hasArrow="true">
                <li><a href="{{ route('leader.pepsol-results.index') }}">Results </a></li>
                {{-- <li><a href="{{ route('leader.pepsol-quiz.create') }}"> Add Quiz</a></li> --}}
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Images" icon="fas fa-solid fa-image" :hasArrow="true">
                <li><a href="{{ route('leader.images.index') }}">Images </a></li>
                <li><a href="{{ route('leader.images.create') }}"> Add Image</a></li>
            </x-includes.sidebar-item>

            <x-includes.sidebar-item title="Contacts" icon="fas fa-clipboard-check" :hasArrow="true">
                <li><a href="{{ route('leader.contacts.index') }}">Index </a></li>
                {{-- <li><a href="{{ route('leader.contacts.show') }}"> Show</a></li> --}}
            </x-includes.sidebar-item>


            <x-includes.sidebar-item title="Slider" icon="fas fa-solid fa-sliders" :hasArrow="true">
                <li><a href="{{ route('leader.sliders.index') }}">Sliders </a></li>
                <li><a href="{{ route('leader.sliders.create') }}"> Add Slider</a></li>
            </x-includes.sidebar-item>
        @endif


    </ul>
</nav>

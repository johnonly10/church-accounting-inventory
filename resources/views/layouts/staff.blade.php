<!DOCTYPE html>
<html lang="en">

<head>
    {{-- CS --}}
    @include('includes.staff-head')
</head>

<body class="crm_body_bg">

    {{-- Sidebar --}}
    @include('includes.staff-sidebar')


    <section class="main_content dashboard_part large_header_bg">

        {{-- Menu --}}
        @include('includes.staff-menu')


        <div class="main_content_iner overly_inner">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        @include('includes.staff-footer')

    </section>

    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    {{-- JS --}}
    @include('includes.staff-scripts')

</body>

</html>

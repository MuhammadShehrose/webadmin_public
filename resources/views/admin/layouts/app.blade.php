<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('admin.layouts.includes.head')
</head>

<body class="app sidebar-mini">
    <!-- Switcher -->
    @include('admin.layouts.includes.switcher')
    <!-- End Switcher -->

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('assets/admin/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- End Global-loader-->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!--sidebar-->
            @include('admin.layouts.includes.sidebar')
            <!--sidebar closed-->

            <!--app header-->
            @include('admin.layouts.includes.header')
            <!--/app header-->

            <!-- Mian Content-->
            <div class="app-content main-content">
                <div class="side-app">
                    @yield('content')
                </div>
            </div>
        </div>

        <!--Footer-->
        @include('admin.layouts.includes.footer')
        <!-- End Footer-->

    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fe fe-chevron-up"></i></a>

    @include('admin.layouts.includes.scripts')
</body>

</html>

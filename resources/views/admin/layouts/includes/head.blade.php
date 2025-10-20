    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="WebAdmin" name="description">
    <meta content="WebAdmin Team" name="author">

    <!-- Title -->
    <title>@yield('title') | {{ setting('website_name', 'WebAdmin') }}</title>

    <!--Favicon -->
    @if (setting('favicon'))
        <link href="{{ asset('storage/' . setting('favicon')) }}" rel="shortcut icon" type="image/x-icon" />
    @else
        <link rel="icon" href="{{ asset('assets/admin/images/brand/favicon.ico') }}" type="image/x-icon" />
    @endif

    <!--Bootstrap css -->
    <link href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('assets/admin/css/animated.css') }}" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="{{ asset('assets/admin/css/sidemenu.css') }}" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets/admin/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('assets/admin/plugins/icons/icons.css') }}" rel="stylesheet" />


    <!-- Simplebar css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/simplebar/css/simplebar.css') }}">

    <!-- INTERNAL Morris Charts css -->
    <link href="{{ asset('assets/admin/plugins/morris/morris.css') }}" rel="stylesheet" />

    <!-- INTERNAL Select2 css -->
    <link href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- Data table css -->
    <link href="{{ asset('assets/admin/plugins/datatables/DataTables/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/datatables/Buttons/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/datatables/Responsive/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />


    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('assets/admin/colors/color1.css') }}" rel="stylesheet" type="text/css" />

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('assets/admin/switcher/css/switcher.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/switcher/demo.css') }}" rel="stylesheet" />

    {{-- custom css file --}}
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" />

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- INTERNAL File Uploads css -->
    <link href="{{ asset('assets/admin/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

    <!-- INTERNAL File Uploads css -->
    <link href="{{ asset('assets/admin/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />

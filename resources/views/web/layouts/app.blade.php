<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.layouts.includes.head')
</head>

<body>
    <!-- Navbar -->
    @include('web.layouts.includes.navbar')

    @yield('content')

    <!-- Footer -->
    @include('web.layouts.includes.footer')

    @include('web.layouts.includes.scripts')
</body>

</html>

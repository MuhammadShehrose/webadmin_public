    <!-- Jquery js-->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap5 js-->
    <script src="{{ asset('assets/admin/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('assets/admin/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ asset('assets/admin/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!--Sidemenu js-->
    <script src="{{ asset('assets/admin/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('assets/admin/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/p-scrollbar/p-scroll1.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/p-scrollbar/p-scroll.js') }}"></script>


    <!--INTERNAL Flot Charts js-->
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ asset('assets/admin/js/chart.flot.sampledata.js') }}"></script>

    <!-- INTERNAL Chart js -->
    <script src="{{ asset('assets/admin/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Apexchart js -->
    <script src="{{ asset('assets/admin/js/apexcharts.js') }}"></script>

    <!-- INTERNAL File uploads js -->
    <script src="{{ asset('assets/admin/plugins/fileupload/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/filupload.js') }}"></script>

    <!--INTERNAL Moment js-->
    <script src="{{ asset('assets/admin/plugins/moment/moment.js') }}"></script>

    <!--INTERNAL Index js-->
    <script src="{{ asset('assets/admin/js/index1.js') }}"></script>

    <!-- INTERNAL Data tables -->
    <script src="{{ asset('assets/admin/plugins/datatables/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/DataTables/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>

    <!-- Rounded bar chart js-->
    <script src="{{ asset('assets/admin/js/rounded-barchart.js') }}"></script>


    <!-- Custom js-->
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    <!-- Switcher js -->
    <script src="{{ asset('assets/admin/switcher/js/switcher.js') }}"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Oops!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Done!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            Swal.fire({
                title: "Alert!",
                text: "{{ session('warning') }}",
                icon: "warning"
            });
        </script>
    @endif

    @yield('scripts')

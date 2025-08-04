<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>{{ $title }}</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/assets/css/all.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/assets/css/flaticon.css') }} " rel="stylesheet">
    <link href="{{ asset('/assets/css/cryptocoins.css') }} " rel="stylesheet">
    <link href="{{ asset('/assets/css/cryptocoins-colors.css') }} " rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ asset('/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Page Specific CSS (Toastr.css) -->
    <link href="{{ asset('/assets/css/toastr.min.css') }}" rel="stylesheet">
    <!-- Page Specific CSS (Slick Slider.css) -->
    <link href="{{ asset('/assets/css/slick.css') }}" rel="stylesheet">
    <!-- medboard styles -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <!-- medboard styles -->

    <link href="{{ asset('/assets/css/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Page Specific CSS (Morris Charts.css) -->
    <link href="{{ asset('/assets/css/morris.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">

    <!-- Preloader -->
    <x-pre-loader></x-pre-loader>
    <!-- Sidebar Navigation Left -->
    <x-navigation-sidebar></x-navigation-sidebar>
    <!-- Main Content -->
    <main class="body-content">
        <x-navigation-navbar></x-navigation-navbar>
        
        <!-- Body Content Wrapper -->
        {{ $slot }}
    </main>

    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Global Required Scripts End -->
    {{-- <script src="{{ asset('/assets/js/d3.v3.min.js') }}"></script>
    <script src="{{ asset('/assets/js/topojson.v1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/datamaps.all.min.js') }}"></script> --}}

    <!-- Page Specific Scripts Start -->
    <script src="{{ asset('/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('/assets/js/moment.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.webticker.min.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/Chart.bundle.min.js') }}" defer></script> --}}

    <script src="{{ asset('/assets/js/index-chart.js') }}"></script>

    <!-- Page Specific Scripts Finish -->
    {{-- <script src="{{ asset('/assets/js/calendar.js') }}"></script> --}}
    <!-- medboard core JavaScript -->
    <script src="{{ asset('/assets/js/framework.js') }}"></script>
    <!-- Settings -->
    <script src="{{ asset('/assets/js/settings.js') }}"></script>
    @livewireScripts

    <script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/assets/js/toast.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('toast_message'))
                toastr.options.positionClass = "toast-top-right";
                toastr["{{ Session::get('toast_type') }}"]("{{ Session::get('toast_message') }}");
            @endif

            window.addEventListener('toast', event => {

                // Se event.detail for um array, pegamos o primeiro item
                const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;

                const type = data.type || 'info'; // Se `type` for indefinido, usa 'info'
                const message = data.message || 'Mensagem padrão';

                if (typeof toastr[type] === 'function') {
                    toastr.options.positionClass = "toast-top-right";
                    toastr[type](message);
                } else {
                    console.error(`Tipo de toast inválido: ${type}`);
                }
            });
        });
    </script>
</body>

</html>

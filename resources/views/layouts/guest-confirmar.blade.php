<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

<body class="ms-body ms-primary-theme">

    <!-- Main Content -->
    <main class="body-content" style="margin-left: 0; padding: 0;">
        <div class="ms-content-wrapper" style="padding: 15px 0;">
            {{ $slot }}
        </div>
    </main>

    <style>
        @media (max-width: 768px) {
            .ms-panel {
                margin-bottom: 0;
                border-radius: 0;
            }
            
            .ms-panel-header {
                padding: 1rem;
                border-radius: 0;
            }
            
            .ms-panel-body {
                padding: 1rem !important;
            }
            
            .card {
                border-radius: 8px;
            }
            
            .card-title {
                font-size: 1rem !important;
            }
            
            .btn-lg {
                font-size: 1rem;
                padding: 0.75rem 1.5rem;
            }
            
            .material-icons {
                font-size: 20px;
            }
            
            body {
                background-color: #f5f5f5;
            }
            
            .ms-content-wrapper {
                padding: 10px 0 !important;
            }
        }
        
        @media (min-width: 769px) {
            .ms-content-wrapper {
                padding: 30px 0;
            }
        }
    </style>

    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Global Required Scripts End -->

    <!-- Page Specific Scripts Start -->
    <script src="{{ asset('/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('/assets/js/moment.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.webticker.min.js') }}"></script>

    <script src="{{ asset('/assets/js/index-chart.js') }}"></script>

    <!-- Page Specific Scripts Finish -->
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


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | Cheetsi</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/logo/cheetsi_fav.svg') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Cheetsi</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/logo/cheetsi_fav.svg')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/materialdesignicons.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/flag-icons.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/remixicon.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/libs/dropzone/dropzone.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/swiper/swiper.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/select2/select2.css')}}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/pages/cards-statistics.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/css/pages/cards-analytics.css')}}" />
    <!-- Helpers -->
    <script src="{{url('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{url('assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{url('assets/js/config.js')}}"></script>
    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        .bg-menu-theme .menu-item.active>.menu-link:not(.menu-toggle) {
            background-color: #FF6B00;
        }

        .bg-primary {
            background-color: #FF6B00 !important;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #FF6B00;
            border-color: #FF6B00;
        }

        .btn-primary:hover {
            background-color: #FEB900;
            border-color: #FEB900;
        }

        .text-primary {
            color: #FF6B00 !important;
        }

        /* #FF7A4F
#FEB900
*/

    </style>
    @stack('css')
</head>

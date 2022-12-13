    <!--     Fonts and icons     -->
    <link href="{{ asset('backend/assets/css/google-font.css') }}" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{ asset('backend/assets/js/fontawesome.js') }}"></script>
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->

    <link href="{{ asset('backend/assets/css/select2.min.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('backend/assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/dataTables/jquery.dataTables.min.css') }}">
    <style>
        .wrap_longtext {
            white-space: normal;
        }

        .select2-selection--single {
            border: 1px solid #d2d6da !important;
            border-radius: 7px !important;
            height: 42px !important;
            line-height: 32px !important;
            font-size: 0.75rem !important;
        }

        .select2-selection--default {
            border: 1px solid #d2d6da !important;
            border-radius: 7px !important;
            height: 42px !important;
            line-height: 32px !important;
            font-size: 0.75rem !important;
            width: 100% !important;
        }

        .select2-container--below {
            width: 100%;
        }

        .select2-container--default {
            width: 100% !important;
        }

        .select2-container--focus {
            width: 100%;
        }

        .select2-selection__rendered {
            line-height: 42px !important;
        }

        .select2-selection__arrow {
            height: 40px !important;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
    @stack('style')

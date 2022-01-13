<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>{{ Config::get('app.name') }} {{ isset($title) ? " - $title" : "" }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">

    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    {{--
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}"> --}}

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Noto+Sans+Thai:400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
    </script>
    <!--end::Web font -->

    <link href="{{ mix('backend/css/styles.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('backend/css/custom.min.css') }}" rel="stylesheet" />

    <style>
        .preview-video {
            width: 640px;
            height: 380px;
        }
    </style>

    @yield('style')
</head>

<body>
    <div class="app">
        <div class="app-container">

            <!-- START APP CONTENT -->
            <div class="app-content">

                <!-- START PAGE CONTAINER -->
                <div class="container">
                    @yield('content')
                </div>
                <!-- END PAGE CONTAINER -->

            </div>
            <!-- END APP CONTENT -->

        </div>
    </div>

    <script src="{{ mix('backend/js/lib.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
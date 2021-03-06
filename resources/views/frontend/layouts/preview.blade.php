<!DOCTYPE html>
<html lang="">

<head>

    <title>กรมกิจการสตรีและสถาบันครอบครัว</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
             google: {"families":["Sarabun:300;400;500;600;700"]},
                 active: function() {
                     sessionStorage.fonts = true;
                 }
             });
    </script>
    <!--end::Web font -->

    <link rel="stylesheet" href="{{ mix('css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/custom.min.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')

</head>

<body>

    <div class="wrapper">

        {{-- @include('frontend.layouts.header') --}}

        @yield('content')

        {{-- @include('frontend.layouts.footer') --}}

    </div>

    <script src="{{ mix('js/lib.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/main.min.js') }}"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61d6bbe13dd66cd2"></script>

    @yield('scripts')

</body>

</html>
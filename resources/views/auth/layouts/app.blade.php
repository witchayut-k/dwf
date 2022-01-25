<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>{{ Config::get('app.name') }} {{ isset($title) ? " - $title" : "" }}</title>
    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">

    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <!-- END META SECTION -->

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

    <!-- CSS INCLUDE -->
    <link href="{{ mix('backend/css/styles.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('backend/css/auth.min.css') }}" rel="stylesheet" />
    <!-- EOF CSS INCLUDE -->

    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body>

    <!-- APP WRAPPER -->
    <div class="app">

        <!-- START APP CONTAINER -->
        <div class="app-container">

            @yield('content')

        </div>
        <!-- END APP CONTAINER -->

    </div>
    <!-- END APP WRAPPER -->

    <!--
        <div class="modal fade" id="modal-thanks" tabindex="-1" role="dialog">                        
            <div class="modal-dialog modal-sm" role="document">                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
                <div class="modal-content">                    
                    <div class="modal-body">                
                        <p class="text-center margin-bottom-20">
                            <img src="assets/images/smile.png" alt="Thank you" style="width: 100px;">
                        </p>                
                        <h3 id="modal-thanks-heading" class="text-uppercase text-bold text-lg heading-line-below heading-line-below-short text-center"></h3>
                        <p class="text-muted text-center margin-bottom-10">Thank you so much for likes</p>
                        <p class="text-muted text-center">We will do our best to make<br> Boooya template perfect</p>                
                        <p class="text-center"><button class="btn btn-success btn-clean" data-dismiss="modal">Continue</button></p>
                    </div>                    
                </div>
            </div>            
        </div>-->

    <script src="{{ mix('backend/js/lib.min.js') }}"></script>
    <script src="{{ mix('backend/js/app.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
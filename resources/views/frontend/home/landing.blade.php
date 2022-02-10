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

    <div class="landing-section position-relative">
        <div class="slider landing-page">
            @foreach ($landingPageFull as $key => $item)
            <div>
                <img class="img-fluid mx-auto" src="{{ $item->featured_image }}" alt="">
            </div>
            @endforeach
        </div>

        @foreach ($landingPageFull as $key => $item)
        <div class="landing-btn" data-index="{{ $key }}" style="display: {{ $key == 0 ? 'block' : 'none' }}">
            <a class="btn btn-style btn-view extra" href="{{ url('/home') }}">เข้าสู่เว็บไซต์ กรมกิจการสตรีและสถาบันครอบครัว</button>
            @foreach (json_decode($item->buttons) as $button)
            <a class="btn btn-style btn-view extra" href="{{ $button->url }}" target="_blank">{{ $button->title ?: "Button"}}</a>
            @endforeach
        </div>
        @endforeach

       </div>

    {{-- <div class="wrapper">
        <div class="slider slider-landing-page">
            @foreach ($landingPageFull as $item)
            <div>
                <div class="photo-thumb">
                    <div class="photo-parent">
                        <span class="photo" style="background-image: url('{{ $item->featured_image }}')"></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @foreach ($landingPageFull as $key => $item)
        <div class="actions" data-index="{{ $key }}" style="display: {{ $key == 0 ? 'flex' : 'none' }}">
            <div class="action-wrapper">
                <a class="btn" href="#"
                    style="display: inline-block; border-radius: 10px; background-color: pink">เข้าสู่เว็บไซต์</a>
                @foreach (json_decode($item->buttons) as $button)
                @if ($button->title)
                <a class="btn" href="{{ $button->url }}"
                    style="display: inline-block; border-radius: 10px; background-color: pink">{{ $button->title
                    }}</a>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach

    </div> --}}


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-104615033-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-104615033-1');
    </script>


    <script src="{{ mix('js/lib.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('ready', function () {
            $('.landing-page').slick({
                slidesToShow: 1,
                arrows: false,
                dots: false,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 5000
            });
            
            $('.slider-landing-page').slick({
                slidesToShow: 1,
                arrows: false,
                dots: true,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 5000,
            });

            $('.landing-page').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                $('.landing-btn').hide();
                const el = $(`.landing-btn[data-index="${nextSlide}"]`);
                el.show();
            });
        });
    </script>
</body>

</html>
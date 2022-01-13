
var Home = function () {

    return {
        init: function () {
            $('.slider-hero').slick({
                slidesToShow: 1,
                arrows: false,
                dots: true,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 5000,
            });
            $('.slider-menu').slick({
                arrows: true,
                variableWidth: true,
                slidesToShow: 7,
                slidesToScroll: 7
            });

            $('.slider-menu-tab').slick({
                arrows: true,
                slidesPerRow: 3,
                slidesToShow: 1,
                // slidesToShow: 1,
                // slidesToScroll: 1,
                rows: 2
            });

            $('.slider-news').slick({
                arrows: true,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });

            $('.slider-videos').slick({
                arrows: true,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });

            $('.slider-institution').slick({
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                ]
            });
            $('.slider-calendar').slick({
                vertical: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
            });

            $('.slider-landing').owlCarousel({
                loop: true,
                items: 1
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $('.slider-institution').slick('setPosition');
                $('.slider-news').slick('setPosition');
                $('.slider-videos').slick('setPosition');
            })
        }
    }

}();

$(function () {
    Home.init();
});

// show modal landing content
$(window).on('load', function () {
	$('#modalLandingContent').modal('show');
});
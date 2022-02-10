$('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
	if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
	}
	var $subMenu = $(this).next('.dropdown-menu');
	$subMenu.toggleClass('show');


	$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
		$('.dropdown-submenu .show').removeClass('show');
	});


	return false;
});

// function onMenu() {
// 	$(".header").toggleClass('active');
// 	$(".hamburger").toggleClass('active');
// }

$('.btn-display1').click(function () {
	$('.wrapper').removeClass('dark-theme');
	$('.wrapper').removeClass('with-txt-yellow');
});

$('.btn-display2').click(function () {
	$('.wrapper').removeClass('with-txt-yellow');
	$('.wrapper').addClass('dark-theme');
});

$('.btn-display3').click(function () {
	$('.wrapper').addClass('dark-theme with-txt-yellow');
});

$('h1, h2, h3, h4, h5, h6, p:not(.topic-text) .fontsize, .form-control, .service-item-dt, .btn-style, .nav-tabs .nav-link, .check-item, .list-dashed li a, .content-editor, .content-editor > *, .text-by, .board-item > *, .card-custom p > u, .header-top .header-top-group ul li a, .txt-intro, .txt-running, .footer .footer-top h1, .footer .footer-top ul li a').FontSize({
    increaseBtn:'.btn-increase',
    reduceBtn:'.btn-reduce'
});

$(document).on('ready', function () {
    $('body').on('click', '.hamburger', function () {
        $(".header").toggleClass('active');
	    $(".hamburger").toggleClass('active');
    });

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
		rows: 2,
		responsive: [
			{
				breakpoint: 480,
				settings: {
					slidesPerRow: 2,
					rows: 2,
				}
			}
		]
	});

	$('.slider-news').slick({
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

	// $('.service-ic').on('click', function () {
	// 	// $('.slider-menu-tab').slick('slickGoTo', 0);
	// });
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	$('.slider-institution').slick('setPosition');
	$('.slider-news').slick('setPosition');
    $('.slider-menu-tab').slick('setPosition');
})

$(function () {
	$('.item-mh').matchHeight();

	$('[data-toggle="tooltip"]').tooltip();
});


// show modal landing content
$(window).on('load', function () {
	$('#modalLandingContent').modal('show');
});


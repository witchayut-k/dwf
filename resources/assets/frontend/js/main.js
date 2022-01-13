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

function onMenu() {
	$(".header").toggleClass('active');
	$(".hamburger").toggleClass('active');
}

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

(function ($) {
	$.fn.fontResize = function (options) {
		var increaseCount = 0;
		var self = this;

		var changeFont = function (element, amount) {
			var baseFontSize = parseInt(element.css('font-size'), 10);
			var baseLineHeight = parseInt(element.css('line-height'), 10);
			element.css('font-size', (baseFontSize + amount) + 'px');
			element.css('line-height', (baseLineHeight + amount) + 'px');
		};

		options.increaseFontsizeBtn.on('click', function (e) {
			e.preventDefault();
			if (increaseCount === 3) {
				$('.btn-increase').addClass('disible');
				$('.btn-reduce').removeClass('disible');
				return;
			}
			self.each(function (index, element) {
				changeFont($(element), 2);
			});
			increaseCount++;
		});

		options.decreaseFontsizeBtn.on('click', function (e) {
			e.preventDefault();
			if (increaseCount === 0) {
				$('.btn-reduce').addClass('disible');
				$('.btn-increase').removeClass('disible');
				return;
			}
			self.each(function (index, element) {
				changeFont($(element), -2);
			});
			increaseCount--;
		});
	}
})(jQuery);

$(function () {
	$('h1, h2, h3, h4, h5, h6, p:not(.header-top .topic-text, .txt-intro, .txt-running) .fontsize, .form-control, .service-item-dt, .btn-style, .nav-tabs .nav-link, .check-item, .list-dashed li a').fontResize({
		increaseFontsizeBtn: $('.btn-increase'),
		decreaseFontsizeBtn: $('.btn-reduce')
	});
});



$(document).on('ready', function () {
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

	if ($(".daterange").length > 0) {
		$("input.daterange").daterangepicker({
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
	}

	if ($(".bs-datepicker").length > 0) {
		$(".bs-datepicker").datetimepicker({ format: "DD/MM/YYYY" });
	}

});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	$('.slider-institution').slick('setPosition');
	$('.slider-news').slick('setPosition');
	$('.slider-videos').slick('setPosition');
})

$('[data-fancybox="gallery"]').fancybox({

});

$(function () {
	$('.item-mh').matchHeight();

	$('[data-toggle="tooltip"]').tooltip();
});

// show modal landing content
$(window).on('load', function () {
	$('#modalLandingContent').modal('show');
});
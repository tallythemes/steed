jQuery(document).ready(function($){
	$('.ec_s_loader').remove();
	$(".ec_slideshow .owl-carousel").owlCarousel({
		items	: 1,
		loop	: true,
		nav		: true,
		autoplay: true,
		autoplayHoverPause: true,
	});
});
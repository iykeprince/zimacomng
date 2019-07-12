(function($) {
	"use strict";
	
	/*---Owl-carousel----*/
	
	// ______________Owl-carousel-icons
	var owl = $('.owl-carousel-icons');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: true,
		autoplay: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1300: {
				items: 3
			}
		}
	})
	
		
	// ______________Owl-carousel-icons2
	var owl = $('.owl-carousel-icons2');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 25,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 2,
				nav: true
			},
			1300: {
				items: 4,
				nav: true
			}
		}
	})
	
	// ______________Owl-carousel-icons3
	var owl = $('.owl-carousel-icons3');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		dots: false,
		autoplay: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 2
			}
		}
	})
	
	// ______________Owl-carousel-icons4
	var owl = $('.owl-carousel-icons4');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		dots: false,
		autoplay: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 3
			},
			1000: {
				items: 6
			}
		}
	})
	
	// ______________Owl-carousel-icons5
	var owl = $('.owl-carousel-icons5');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 25,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: true,
		nav: false,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 2,
				nav: true
			},
			1300: {
				items: 4,
				nav: true
			}
		}
	})
	
	// ______________Owl-carousel-icons6
	var owl = $('.owl-carousel-icons6');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		dots: false,
		autoplay: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 3
			}
		}
	})
	
	// ______________Testimonial-owl-carousel2
	var owl = $('.testimonial-owl-carousel2');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		autoplay: true,
		dots: false,
		animateOut: 'fadeOut',
		smartSpeed:450,
		responsive: {
			0: {
				items: 1
			}
		}
	})
	
	// ______________Testimonial-owl-carousel3
	var owl = $('.testimonial-owl-carousel3');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		autoplay: true,
		dots: true,
		responsive: {
			0: {
				items: 1
			}
		}
	})
	
	// ______________Testimonial-owl-carousel4
	var owl = $('.testimonial-owl-carousel4');
	owl.owlCarousel({
		margin: 25,
		loop: true,
		nav: false,
		autoplay: true,
		dots: true,
		responsive: {
			0: {
				items: 1
			}
		}
	})
	
	// ______________Testimonial-owl-carousel
	var owl = $('.testimonial-owl-carousel');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 25,
		autoplay: true,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			}
		}
	})
	
	/*---End Owl-carousel----*/
	
	
	
	// ______________Active Class
	$(document).ready(function() {
		$(".horizontalMenu-list li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});
	
	// ______________ Back to Top
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$("#back-to-top").on("click", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	
	
	// ______________Quantity-right-plus
	var quantitiy = 0;
	$('.quantity-right-plus').on('click', function(e) {
		e.preventDefault();
		var quantity = parseInt($('#quantity').val()); 
		$('#quantity').val(quantity + 1); 
	});
	$('.quantity-left-minus').on('click', function(e) {
		e.preventDefault();
		var quantity = parseInt($('#quantity').val());
		if (quantity > 0) {
			$('#quantity').val(quantity - 1);
		}
	});
	
	
	
	// ______________Chart-circle
	if ($('.chart-circle').length) {
		$('.chart-circle').each(function() {
			let $this = $(this);
			$this.circleProgress({
				fill: {
					color: $this.attr('data-color')
				},
				size: $this.height(),
				startAngle: -Math.PI / 4 * 2,
				emptyFill: '#f9faff',
				lineCap: ''
			});
		});
	}
	const DIV_CARD = 'div.card';
	
	
	
	// ______________Tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// ______________Popover
	$('[data-toggle="popover"]').popover({
		html: true
	});
	
	// ______________Card Remove
	$('[data-toggle="card-remove"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});
	
	// ______________Card Collapse
	$('[data-toggle="card-collapse"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	// ______________Card Full Screen
	$('[data-toggle="card-fullscreen"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');
		e.preventDefault();
		return false;
	});
})(jQuery);

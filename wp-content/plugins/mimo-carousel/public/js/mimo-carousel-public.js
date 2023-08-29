(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 var arrayFromPHP = $.parseJSON(mm_car_values),
	 	mmtheidclass = '.mimo-carousel-' + arrayFromPHP.theid;
	 	
	 	//Get all integers variable to parse as integers
	 	var mmautoplaySpeed = parseInt(arrayFromPHP.mm_car_autoplaySpeed),
	 	mminitialSlide = parseInt(arrayFromPHP.mm_car_initialSlide),

	 	mmrows = parseInt(arrayFromPHP.mm_car_rows),
	 	mmslidesPerRow = parseInt(arrayFromPHP.mm_car_slidesPerRow),
	 	mmslidesToShow = parseInt(arrayFromPHP.mm_car_slidesToShow),
	 	mmslidesToScroll = parseInt(arrayFromPHP.mm_car_slidesToScroll),
	 	mmspeed = parseInt(arrayFromPHP.mm_car_speed),
	 	mmedgeFriction = parseInt(arrayFromPHP.mm_car_edgeFriction);


	 	//Parse values: Convert all 'on'-'off' values to true or false
	 	if ( arrayFromPHP.mm_car_dots == 'on' ) { arrayFromPHP.mm_car_dots = true; } else { arrayFromPHP.mm_car_dots = false; };
	 	if ( arrayFromPHP.mm_car_arrows == 'on' ) { arrayFromPHP.mm_car_arrows = true; } else { arrayFromPHP.mm_car_arrows = false; };
	 	if ( arrayFromPHP.mm_car_accessibility == 'on' ) { arrayFromPHP.mm_car_accessibility = true; } else { arrayFromPHP.mm_car_accessibility = false; };
	 	if ( arrayFromPHP.mm_car_adaptiveHeight == 'on' ) { arrayFromPHP.mm_car_adaptiveHeight = true; } else { arrayFromPHP.mm_car_adaptiveHeight = false; };
	 	if ( arrayFromPHP.mm_car_autoplay == 'on' ) { arrayFromPHP.mm_car_autoplay = true; } else { arrayFromPHP.mm_car_autoplay = false; };
	 	if ( arrayFromPHP.mm_car_centerMode == 'on' ) { arrayFromPHP.mm_car_centerMode = true; } else { arrayFromPHP.mm_car_centerMode = false; };
	 	if ( arrayFromPHP.mm_car_draggable == 'on' ) { arrayFromPHP.mm_car_draggable = true; } else { arrayFromPHP.mm_car_draggable = false; };
	 	if ( arrayFromPHP.mm_car_fade == 'on' ) { arrayFromPHP.mm_car_fade = true; } else { arrayFromPHP.mm_car_fade = false; };
	 	if ( arrayFromPHP.mm_car_focusOnSelect == 'on' ) { arrayFromPHP.mm_car_focusOnSelect = true; } else { arrayFromPHP.mm_car_focusOnSelect = false; };
	 	if ( arrayFromPHP.mm_car_infinite == 'on' ) { arrayFromPHP.mm_car_infinite = true; } else { arrayFromPHP.mm_car_infinite = false; };
	 	if ( arrayFromPHP.mm_car_mobileFirst == 'on' ) { arrayFromPHP.mm_car_mobileFirst = true; } else { arrayFromPHP.mm_car_mobileFirst = false; };
	 	if ( arrayFromPHP.mm_car_pauseOnHover == 'on' ) { arrayFromPHP.mm_car_pauseOnHover = true; } else { arrayFromPHP.mm_car_pauseOnHover = false; };
	 	if ( arrayFromPHP.mm_car_pauseOnDotsHover == 'on' ) { arrayFromPHP.mm_car_pauseOnDotsHover = true; } else { arrayFromPHP.mm_car_pauseOnDotsHover = false; };
	 	if ( arrayFromPHP.mm_car_swipe == 'on' ) { arrayFromPHP.mm_car_swipe = true; } else { arrayFromPHP.mm_car_swipe = false; };
	 	if ( arrayFromPHP.mm_car_swipeToSlide == 'on' ) { arrayFromPHP.mm_car_swipeToSlide = true; } else { arrayFromPHP.mm_car_swipeToSlide = false; };
	 	if ( arrayFromPHP.mm_car_touchMove == 'on' ) { arrayFromPHP.mm_car_touchMove = true; } else { arrayFromPHP.mm_car_touchMove = false; };
	 	if ( arrayFromPHP.mm_car_useCSS == 'on' ) { arrayFromPHP.mm_car_useCSS = true; } else { arrayFromPHP.mm_car_useCSS = false; };
	 	if ( arrayFromPHP.mm_car_variableWidth == 'on' ) { arrayFromPHP.mm_car_variableWidth = true; } else { arrayFromPHP.mm_car_variableWidth = false; };
	 	if ( arrayFromPHP.mm_car_vertical == 'on' ) { arrayFromPHP.mm_car_vertical = true; } else { arrayFromPHP.mm_car_vertical = false; };
	 	if ( arrayFromPHP.mm_car_verticalSwiping == 'on' ) { arrayFromPHP.mm_car_verticalSwiping = true; } else { arrayFromPHP.mm_car_verticalSwiping = false; };
	 	if ( arrayFromPHP.mm_car_rtl == 'on' ) { arrayFromPHP.mm_car_rtl = true; } else { arrayFromPHP.mm_car_rtl = false; };


	 $(window).load(function() {
	 	

	 	

	 	

	 	


	 	$(mmtheidclass).slick({
              	accessibility: arrayFromPHP.mm_car_accessibility,
                adaptiveHeight: arrayFromPHP.mm_car_adaptiveHeight,
                arrows: arrayFromPHP.mm_car_arrows,
                asNavFor: arrayFromPHP.mm_car_asNavFor,
                //prevArrow: arrayFromPHP.mm_car_prevArrow,
                //nextArrow: arrayFromPHP.mm_car_nextArrow,
                autoplay: arrayFromPHP.mm_car_autoplay,
                autoplaySpeed: mmautoplaySpeed,
                centerMode: arrayFromPHP.mm_car_centerMode,
                centerPadding: arrayFromPHP.mm_car_centerPadding,
                cssEase: arrayFromPHP.mm_car_cssEase,
                dots: arrayFromPHP.mm_car_dots,
                draggable: arrayFromPHP.mm_car_draggable,
                edgeFriction: mmedgeFriction,
                fade: arrayFromPHP.mm_car_fade,
                focusOnSelect: arrayFromPHP.mm_car_focusOnSelect,
                infinite: arrayFromPHP.mm_car_infinite,
                initialSlide: mminitialSlide,
                lazyLoad: arrayFromPHP.mm_car_lazyLoad,
                mobileFirst: arrayFromPHP.mm_car_mobileFirst,
                pauseOnHover: arrayFromPHP.mm_car_pauseOnHover,
                pauseOnFocus: arrayFromPHP.mm_car_pauseOnFocus,
                pauseOnDotsHover: arrayFromPHP.mm_car_pauseOnDotsHover,
                respondTo: arrayFromPHP.mm_car_respondTo,
                responsive: arrayFromPHP.mm_car_responsive,
                rows: mmrows,
                rtl: arrayFromPHP.mm_car_rtl,
                slide: arrayFromPHP.mm_car_slide,
                slidesPerRow:mmslidesPerRow,
                slidesToShow: mmslidesToShow,
                slidesToScroll: mmslidesToScroll,
                speed: mmspeed,
                swipe: arrayFromPHP.mm_car_swipe,
                swipeToSlide: arrayFromPHP.mm_car_swipeToSlide,
                touchMove: arrayFromPHP.mm_car_touchMove,
                touchThreshold: arrayFromPHP.mm_car_touchThreshold,
                useCSS: arrayFromPHP.mm_car_useCSS,
                variableWidth: arrayFromPHP.mm_car_variableWidth,
                vertical: arrayFromPHP.mm_car_vertical,
                verticalSwiping: arrayFromPHP.mm_car_verticalSwiping,
                responsive: [
						    {
						      breakpoint: 960,
						      settings: {
						        slidesToShow: 3,
						        slidesToScroll: 3,
						        infinite: true,
						        dots: true
						      }
						    },
						    {
						      breakpoint: 760,
						      settings: {
						        slidesToShow: 2,
						        slidesToScroll: 2
						      }
						    },
						    {
						      breakpoint: 480,
						      settings: {
						        slidesToShow: 1,
						        slidesToScroll: 1
						      }
						    }
						    // You can unslick at a given breakpoint now by adding:
						    // settings: "unslick"
						    // instead of a settings object
						  ]
        }).css('opacity','1');

  


  });


})( jQuery );


				
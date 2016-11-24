/**
*	jQuery Document Ready
*/
jQuery( document ).ready( function($) {

	/** AddClass for every single img for avoiding mistakes **/
	$("img").addClass("img-fluid");

	/** Transformicons **/
	transformicons.add('.tcon');

	/** Main Menu **/
	$( "#showRightPush" ).click(function() {
	  $( '.overlay-contentscale' ).toggleClass( "open" );
	});

	/** Progress Bar JS **/
	$(window).scroll(function() {
	    var scroll = $(window).scrollTop();
	    if (scroll > 600) {
	        $(".progress-container, .floatingRecommend").addClass("fixed"); // you don't need to add a "." in before your class name
	        $("header").addClass("whiteBg"); // you don't need to add a "." in before your class name
	    } else {
	        $("header").removeClass("whiteBg");
	        $(".progress-container, .floatingRecommend").removeClass("fixed");
	    }
	    // var screenWidth = window.screen.width;
	    // var progressBarWidth = $('.progressBar').width();
	});

	var getMax = function() {
			return $('.container .articleContent').height();
	}
	var getValue = function(){
			return $(window).scrollTop();
	}
	if('max' in document.createElement('div')){
		// Browser supports progress element
		var progressBar = $('.progressBar');
		// Set the Max attr for the first time
		progressBar.attr({ max: getMax() });
		$(document).on('scroll', function(){
			// On scroll only Value attr needs to be calculated
			progressBar.attr({ value: getValue() });
		});
		$(window).resize(function(){
			// On resize, both Max/Value attr needs to be calculated
			progressBar.attr({ max: getMax(), value: getValue() });
		});
	}
	else {
		var progressBar = $('.progressBar'),
			max = getMax(),
			value, width;

		var getWidth = function(){
			// Calculate width in percentage
			value = getValue();
			width = (value/max) * 100;
			widthCheck = width;
			width = width + '%';
			return width;
		}
		var setWidth = function(){
			progressBar.css({ width: getWidth() });
			if (widthCheck > 80) {
					$('.floatingRecommend').fadeIn(500);
			} else{
					$('.floatingRecommend').fadeOut(500);
			};
		}
		$(document).on('scroll', setWidth);
		$(window).on('resize', function(){
			// Need to reset the Max attr
			max = getMax();
			setWidth();
		});
	}

	/** Hide/Show Menu Footer **/
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('header').outerHeight();
	$(window).scroll(function(event){
	    didScroll = true;
	});
	setInterval(function() {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
	}, 250);
	function hasScrolled() {
    var st = $(this).scrollTop();
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
      // Scroll Down
      $('header').removeClass('appear').addClass('disappear');
      $('.postActionsNav').removeClass('navAppear').addClass('navDisappear');
    } else {
      // Scroll Up
      if(st + $(window).height() < $(document).height()) {
        $('header').removeClass('disappear').addClass('appear');
        $('.postActionsNav').removeClass('navDisappear').addClass('navAppear');
      }
    }
    if ($('header').hasClass('appear')){
        $('.progress-container').css('top', '60px');
    } else if ($('header').hasClass('disappear')){
        $('.progress-container').css('top', '0px');
    }
    lastScrollTop = st;
	}

}); /* Close Document Ready */

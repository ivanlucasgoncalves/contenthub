/**
*	jQuery Document Ready
*/

jQuery( document ).ready( function($) {

	/** ScrollBar **/
	/*var parent = document.getElementById('divscroll');
	var child = document.getElementById('chilscroll');
	child.style.right = child.clientWidth - child.offsetWidth + "px";*/

	/** AddClass for every single img for avoiding mistakes **/
	$("img").addClass("img-fluid");

	/** Transformicons **/
	transformicons.add('.tcon');

	/** Main Menu **/
	$( "#showRightPush" ).click(function() {
	  $( '.overlay-contentscale' ).toggleClass( "open" );
		$( 'body' ).toggleClass( "pos-fixed" );
		$("#masthead").toggleClass("whiteBg");
	});

	/** Login **/
	$( ".userIcon" ).click(function() {
	  $( '.contentscale-login' ).toggleClass( "open" );
		$( 'body' ).toggleClass( "pos-fixed" );
		$("#masthead").toggleClass("whiteBg");
	});

	/** Search **/
	$( ".searchIcon" ).click(function() {
	  $( '.overlay-search' ).addClass( "open" );
		$( 'body' ).addClass( "pos-fixed" );
	});
	$( ".close-search" ).click(function() {
	  $( '.overlay-search' ).removeClass( "open" );
		$( 'body' ).removeClass( "pos-fixed" );
	});

	// Smooth Scroll Anchors
	$('a[href*="#"]:not([href="#"])').on('click', function() {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000, function() {
					$('#masthead').removeClass('appear').addClass('disappear');
		      $('.postActionsNav').removeClass('navAppear').addClass('navDisappear');
					$('.progress-container').css('top', '0px');
			  });
				return false;
			}
		}
	});

	/** Progress Bar JS **/
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll > 542) {
				$(".progress-container, .floatingRecommend").addClass("fixed"); // you don't need to add a "." in before your class name
				$("#masthead").addClass("whiteBg"); // you don't need to add a "." in before your class name
		} else {
				$("#masthead").removeClass("whiteBg");
				$(".progress-container, .floatingRecommend").removeClass("fixed");
		}
	});

	/** Continue Progress Bar **/
	var getMax = function(){
		return $(window).height();
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
	var navbarHeight = $('#masthead').outerHeight();
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
      $('#masthead').removeClass('appear').addClass('disappear');
      $('.postActionsNav').removeClass('navAppear').addClass('navDisappear');
    } else {
      // Scroll Up
      if(st + $(window).height() < $(document).height()) {
        $('#masthead').removeClass('disappear').addClass('appear');
        $('.postActionsNav').removeClass('navDisappear').addClass('navAppear');
      }
    }
    if ($('#masthead').hasClass('appear')){
        $('.progress-container').css('top', '60px');
    } else if ($('#masthead').hasClass('disappear')){
        $('.progress-container').css('top', '0px');
    }
    lastScrollTop = st;
	}



}); /* Close Document Ready */


/**
** Search AJAX **
**/
jQuery(document).on( 'submit', '.search-form', function() {
    var $form = jQuery(this);
    var $input = $form.find('input[name="s"]');
    var query = $input.val();
    var $content = jQuery('#divscroll');
		jQuery("#loader").show();

    jQuery.ajax({
        type: "post",
        url : ajaxurl,
        data : {
            action : 'load_search_results',
            query : query
        },
        beforeSend: function() {
            $input.prop('disabled', true);
        },
        success : function( response ) {
            $input.prop('disabled', false);
						jQuery("#loader").hide();
            $content.html( response );
        }
    });

    return false;
});

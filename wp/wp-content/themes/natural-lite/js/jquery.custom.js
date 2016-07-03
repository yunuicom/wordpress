( function( $ ) {

	function removeNoJsClass() {
		$( 'html:first' ).removeClass( 'no-js' );
	}

	/* Superfish the menu drops ---------------------*/
	function superfishSetup() {
		$('.menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
		});

		// Fix Superfish menu if off screen.
		var sfMainWindowWidth = $(window).width();

		$('ul.menu li, div.menu li').mouseover(function() {

			// Checks if second level menu exists.
			var subMenuExist = $(this).find('.sub-menu, ul.children').length;
			if ( subMenuExist > 0 ) {
				var subMenuWidth = $(this).find('.sub-menu, ul.children').width();
				var subMenuOffset = $(this).find('.sub-menu, ul.children').parent().offset().left;

				// If sub menu is off screen, give new position.
				if ( ( subMenuOffset + subMenuWidth) > sfMainWindowWidth ) {
					$(this).find('.sub-menu, ul.children').css({
						right: 0,
						left: 'auto',
					});
				}
			}

			// Checks if third level menu exists.
			var subSubMenuExist = $(this).find('.sub-menu .sub-menu, ul.children ul.children').length;
			if ( subSubMenuExist > 0 ) {
				var subSubMenuWidth = $(this).find('.sub-menu .sub-menu, ul.children ul.children').width();
				var subSubMenuOffset = $(this).find('.sub-menu .sub-menu, ul.children ul.children').parent().offset().left + subSubMenuWidth;

				// If sub menu is off screen, give new position.
				if ( ( subSubMenuOffset + subSubMenuWidth) > sfMainWindowWidth){
					var newSubSubMenuPosition = subSubMenuWidth + 0;
					$(this).find('.sub-menu .sub-menu, ul.children ul.children').css({
						left: -newSubSubMenuPosition,
						right: 'auto',
					});
				}
			}

		});
	}

	/* Flexslider ---------------------*/
	function flexSliderSetup() {
		if( ($).flexslider) {
			var slider = $('.flexslider');
			slider.fitVids().flexslider({
				slideshowSpeed		: 12000,
				animationDuration	: 600,
				animation			: 'fade',
				video				: false,
				useCSS				: false,
				prevText			: '<i class="fa fa-angle-left"></i>',
				nextText			: '<i class="fa fa-angle-right"></i>',
				touch				: false,
				animationLoop		: true,
				smoothHeight		: true,
				controlsContainer	: ".slideshow",
				controlNav			: true,
				manualControls		: ".flex-control-nav li",

				start: function(slider) {
					slider.removeClass('loading');
					$( ".preloader" ).hide();
				}
			});
		}
	}

	/* Equal Height Columns ---------------------*/
	function equalHeight() {
		var currentTallest 	= 0,
			currentRowStart = 0,
			rowDivs 		= new Array(),
			$el,
			topPosition 	= 0;

		$('.featured-pages .information').each(function() {
			$el = $(this);
			$($el).height('auto')
			topPostion = $el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = $el.height();
				rowDivs.push($el);

			} else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}

	/* Size Featured Image To Content ---------------------*/
	function matchHeight() {
		var maxHeight = -1;

		$('.featured-posts .holder').each(function() {
			maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
		});

		$('.featured-posts .feature-img').each(function() {
			$(this).height(maxHeight);
		});
	}

	function modifyPosts() {

		/* Insert Line Break Before More Links ---------------------*/
		$('<br />').insertBefore('.postarea .more-link');

		/* Hide Comments When No Comments Activated ---------------------*/
		$('.nocomments').parent().css('display', 'none');

		/* Animate Page Scroll ---------------------*/
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
		});

		/* Fit Vids ---------------------*/
		$('.feature-vid, .postarea').fitVids();

	}

	$( document )
	.ready( removeNoJsClass )
	.ready( superfishSetup )
	.ready( matchHeight )
	.ready( modifyPosts )
	.on( 'post-load', modifyPosts );

	$( window )
	.load( flexSliderSetup )
	.load( equalHeight )
	.resize( equalHeight )
	.resize( matchHeight );

})( jQuery );

/**
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	isOpera      = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	isIe         = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

( function() {
	var container, button, menu, links, subMenus, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

/**
 *
 * Custom scripts for custom functionality
 */
( function( $ ) {

	$( document ).ready( function() {

		// Show or hide scroll to top
		$( window ).scroll(function() {
			if ( $( this ).scrollTop() > 100 ) {
				$( '.scroll-to-top' ).fadeIn();
			} else {
				$( '.scroll-to-top' ).fadeOut();
			}
		} );

		// Click event to scroll to top
		$( '.scroll-to-top' ).click( function() {
			$( 'html, body' ).animate( { scrollTop: 0 }, 800 );
			return false;
		} );


		// Show or hide search in nav menu
		$( '#top-navigation .menu-item.search-menu span' ).click( function( event ) {
			$( '#top-navigation .menu-item .search-form' ).slideToggle( 'fast' );
			event.preventDefault();
			event.stopPropagation();
			return false;
		} );

		// Make nav menu fixed
		if ( $( '.header-nav-wrapper.m-fix' ).length && window.innerWidth > 910 ) {

			var nav = $( '.header-nav-wrapper' );
			var header_height = $( '#wpadminbar' ).outerHeight() + $( '#masthead > .logo-wrapper' ).outerHeight() + $( '#masthead > .header-img-wrapper' ).outerHeight();
			header_height = header_height + $( '#masthead .header-top-nav' ).outerHeight() + $( '#masthead > .header-text-wrapper' ).outerHeight();

			$( window ).resize( function() {

				if ( window.innerWidth < 910 ) {
					nav.removeClass( 'fixed' );
				}

				header_height = $( '#wpadminbar' ).outerHeight() + $( '#masthead > .logo-wrapper' ).outerHeight() + $( '#masthead > .header-img-wrapper' ).outerHeight();
				header_height = header_height + $( '#masthead .header-top-nav' ).outerHeight() + $( '#masthead > .header-text-wrapper' ).outerHeight();
			} );

			if ( $(this).scrollTop() > header_height ) {
				nav.addClass( 'fixed' );
			} else {
				nav.removeClass( 'fixed' );
			}

			$( window ).scroll( function () {
				if ( window.innerWidth > 910 && $( this ).scrollTop() > header_height ) {
					nav.addClass( 'fixed' );
				} else {
					nav.removeClass( 'fixed' );
				}
			} );
		}

		// Show or hide dropdown in nav menu
		$( '#site-navigation li.dropdown .dropdown-toggle' ).on( 'click', function ( event ) {
			event.preventDefault();
			event.stopPropagation();
			$( this ).parent( 'li.dropdown' ).toggleClass( 'open' );
		} );

	} );

	$( window ).load( function() {
		// Handles fliexslider 
		if ( $.isFunction( $.fn.flexslider ) ) {
			$( '.flexslider' ).flexslider( {

				animation: 'fade',	//String: Select your animation type, "fade" or "slide"
				easing: 'swing',	//{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
				direction: 'horizontal',//String: Select the sliding direction, "horizontal" or "vertical"
				reverse: false,		//{NEW} Boolean: Reverse the animation direction
				animationLoop: true,	//Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				smoothHeight: true,	//{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
				startAt: 0,		//Integer: The slide that the slider should start on. Array notation (0 = first slide)
				slideshow: true,	//Boolean: Animate slider automatically
				slideshowSpeed: 7000,	//Integer: Set the speed of the slideshow cycling, in milliseconds
				animationSpeed: 600,	//Integer: Set the speed of animations, in milliseconds
				initDelay: 0,		//{NEW} Integer: Set an initialization delay, in milliseconds
				randomize: false,	//Boolean: Randomize slide order
				fadeFirstSlide: true,	//Boolean: Fade in the first slide when animation type is "fade"

				// Usability features
				pauseOnAction: true,	//Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false,	//Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				pauseInvisible: true,	//{NEW} Boolean: Pause the slideshow when tab is invisible, resume when visible. Provides better UX, lower CPU usage.
				useCSS: true,		//{NEW} Boolean: Slider will use CSS3 transitions if available
				touch: true		//{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices

			} );
		}
	} );

} )( jQuery );

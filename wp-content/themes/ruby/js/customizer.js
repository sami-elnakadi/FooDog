/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Site Footer Information( Copyright Text )
	wp.customize( 'ruby_custom_footer_text', function( value ) {
		value.bind( function( to ) {
			$( '#colophon .footer-copyright-text' ).html( to );
		} );
	} );

	// Site Footer Scroll to Top
	wp.customize( 'ruby_scroll_to_top', function( value ) {
		value.bind( function( to ) {
			if ( to ){
				$( '#colophon' ).append( '<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>' );
				$( '#colophon .scroll-to-top' ).show();
			} else {
				$( '#colophon .scroll-to-top' ).remove();
			}
		} );
	} );

	// Site Typography
	wp.customize( 'ruby_main_body_typography_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'font-size': to
			} );
		} );
	} );

	wp.customize( 'ruby_main_body_typography_face', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
					'font-family': to
			} );
		} );
	} );

	wp.customize( 'ruby_main_body_typography_style', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'font-weight': to
			} );
		} );
	} );

	// Site Layout
	wp.customize( 'ruby_default_site_layout', function( value ) {
		value.bind( function( to ) {

		var page = $( '#page' );

			switch( to ) {
				case 'boxed-layout':
					page.addClass( 'container' );
					break;
				case 'wide-layout':
					page.removeClass( 'container' );
					break;
			}
		} );
	} );

	// Sidebar Layout
	wp.customize( 'ruby_default_layout', function( value ) {

		value.bind( function( to ) {

			var sidebar = $( '#secondary' );
			var body = $( 'body' );

			body.removeClass( 'right-sidebar-template left-sidebar-template full-width-template no-sidebar-template' );

			switch( to ) {
				case 'no-sidebar':
					sidebar.hide();
					body.addClass( 'no-sidebar-template' );
					break;
				case 'no-sidebar-full-width':
					sidebar.hide();
					body.addClass( 'full-width-template' );
					break;
				case 'left-sidebar':
					sidebar.show();
					body.addClass( 'left-sidebar-template' );
					break;
				default:
					body.addClass( 'right-sidebar-template' );
					sidebar.show();
			}
		} );
	} );

} )( jQuery );
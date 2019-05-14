/**
 * Scripts within the customizer controls window.
 *
 */

( function( $ ) {
	wp.customize.bind( 'ready', function() {

		// Content excerpt
		wp.customize( 'ruby_excerpts', function( value ) {

			/* This one shows/hides the an option when a checkbox is clicked. */
			$( '#customize-control-ruby_excerpts_length' ).hide();

			value.bind( function( to ) {

				if ( to ){
					$( '#customize-control-ruby_excerpts_length' ).fadeIn( 400 );
				} else {
					$( '#customize-control-ruby_excerpts_length' ).fadeOut( 400 );
				}
			} );

			if ( undefined !== $( '#customize-control-ruby_excerpts input:checked').val() ) {
				$( '#customize-control-ruby_excerpts_length' ).show();
			}
		} );

		// Slider options
		wp.customize( 'ruby_slider_checkbox', function( value ) {

			$( '#sub-accordion-section-ruby_slider_options .customize-control' ).hide();
			$( '#customize-control-ruby_slider_checkbox' ).show();

			value.bind( function( to ) {

				if ( to ){
					$( '#customize-control-ruby_slider_checkbox' ).siblings( '.customize-control' ).fadeIn( 400 );
				} else {
					$( '#customize-control-ruby_slider_checkbox' ).siblings( '.customize-control' ).fadeOut( 400 );
				}
			} );

			if ( undefined !== $( '#customize-control-ruby_slider_checkbox input:checked' ).val() ) {
				$('#customize-control-ruby_slider_checkbox').siblings('.customize-control').show();
			}

		} );

		// Multiple checkbox options save
		$( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

			checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
				function() {
				    return this.value;
				}
			).get().join( ',' );

			$( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
		});

	});

})( jQuery );

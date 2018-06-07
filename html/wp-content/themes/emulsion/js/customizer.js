/**
 * Twenty Fourteen Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-name' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'color': to 
			} );
		} );
	} );

	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'background': to 
			} );
		} );
	} );

	wp.customize( 'default-image', function( value ) {
		value.bind( function( to ) {
			$( '#intro-slider' ).css( {
				'background-image': url(to)
			} );
		} );
	} );
} )( jQuery );
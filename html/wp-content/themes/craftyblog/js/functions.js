( function( $ ) {
	/*
	 * Add dropdown toggle that display child menu items.
	 */
	$( '.main-navigation .page_item_has_children > a, .main-navigation .menu-item-has-children > a' ).append( '<button class="dropdown-toggle" aria-expanded="false"/>' );

	$( '.dropdown-toggle' ).click( function( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'toggle-on' );
		$( this ).parent().next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) == 'false' ? 'true' : 'false');
	} );

	var sidebar_tabbable = $( '#sidebar a, #sidebar button, #sidebar input, #sidebar textarea, #sidebar select, #sidebar iframe, .dropdown-toggle' );

	/*
	 * Add attributes that are helpful for accessibility.
	 */
	$( '#sidebar' ).attr( 'aria-hidden', 'true' );
	$( '.sidebar-toggle' ).attr( 'tabindex', '13' );
	$( sidebar_tabbable ).attr( 'tabindex', '-1' );

	/*
	 * Sidebar toggle.
	 */
	$( '.sidebar-toggle' ).click( function( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'toggle-on' );
		$( 'body' ).toggleClass( 'sidebar-open' );
		$( '#sidebar' ).attr( 'aria-hidden', $( '#sidebar' ).attr( 'aria-hidden' ) == 'false' ? 'true' : 'false');
		$( sidebar_tabbable ).attr( 'tabindex', $( sidebar_tabbable ).attr( 'tabindex' ) == '13' ? '-1' : '13' );
	} );

	/*
	 * Remove page-content on the portfolio page template when it's empty.
	 */
	$( '.page-template-page-templatesportfolio-page-php .page-content' ).each( function() {
		if ( ! $( this ).find( 'img' ).length && $.trim( $( this ).text() ) === '' ) {
			$( this ).remove();
		}
	} );

	/*
	 * Toggle hover class on hover. This is more reliable for iOS.
	 */
	function portfolio_hover() {
		var portfolio_item = $( '.post-type-archive-jetpack-portfolio .hentry, .tax-jetpack-portfolio-type .hentry, .tax-jetpack-portfolio-tag .hentry, .page-template-page-templatesportfolio-page-php .hentry, .project-navigation .hentry' );

		$( portfolio_item ).off( 'mouseenter mouseleave' ).on( 'mouseenter mouseleave', function() {
			$( this ).toggleClass( 'hover' );
		} );

		/*
		 * Make sure the hover style stays when anchors inside are focused with a tab key.
		 */
		$( portfolio_item ).find( 'a:not(.image-link)' ).off( 'focus focusout' ).on( 'focus focusout', function() {
			$( this ).closest( '.hentry' ).toggleClass( 'hover' );
		} );
	}

	/*
	 * Move Sharedaddy after projects on portfolio page template.
	 */
	function move_sharedaddy() {
		$( '.page-template-page-templatesportfolio-page-php .page-content > .sharedaddy' ).wrapAll( '<div class="portfolio-sharedaddy" />' );

		$( '#main' ).append( $( '.portfolio-sharedaddy' ) );
	}

	/*
	 * Add a class to big image and caption >= 1272px.
	 */
	function big_image_class() {
		$( '.jetpack-portfolio .entry-content img, .format-image .entry-content img' ).each( function() {
			var img = $( this ),
				caption = $( this ).closest( 'div' ),
				new_img = new Image();

			new_img.src = img.attr( 'src' );

			$( new_img ).load( function() {
				var img_width = new_img.width;

				if ( img_width >= 1272 ) {
					$( img ).addClass( 'size-big' );
				}

				if ( caption.hasClass( 'wp-caption' ) && img_width >= 1272 ) {
					caption.addClass( 'caption-big' );
				}
			} );
		} );
	}

	function load_fuctions() {
		move_sharedaddy();
		big_image_class();
		portfolio_hover();
	}

	$( window ).load ( load_fuctions );

	$( document ).on( 'post-load', function() {
		portfolio_hover();
		setTimeout ( big_image_class, 500 );
	} );
} )( jQuery );

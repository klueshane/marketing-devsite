<?php
/**
 * The template for displaying the search form.
 *
 * @package enlighten
 */

get_header(); ?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form">
		<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label', 'enlighten' ); ?></label>
	<div class="search-input">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
	</div>

</div>
</form>
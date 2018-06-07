<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package portfolio
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function wp_portfolio_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'wp_portfolio_jetpack_setup' );

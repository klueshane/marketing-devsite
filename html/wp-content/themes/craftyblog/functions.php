<?php
/**
 * Enlighten functions and definitions
 *
 * @package enlighten
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 879; /* pixels */
}

if ( ! function_exists( 'enlighten_setup' ) ) :

function enlighten_setup() {

	load_theme_textdomain( 'enlighten', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'enlighten-featured', 1180, 500, array( 'top', 'left') );
	add_image_size( 'enlighten-post-thumb', 580, 350, true );
	add_image_size( 'enlighten-popular-posts', 180, 100, true );

	// Remove height/width attributes on images so they can be responsive
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

	function remove_thumbnail_dimensions( $html ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'enlighten' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'enlighten_get_featured_posts',
		'max_posts' => 1,
	) );
}
endif; // enlighten_setup
add_action( 'after_setup_theme', 'enlighten_setup' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function enlighten_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Crafty.
	 */
	return apply_filters( 'enlighten_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function enlighten_has_featured_posts() {
	return ! is_paged() && (bool) enlighten_get_featured_posts();
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function enlighten_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'enlighten' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'enlighten_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function enlighten_scripts() {
	wp_enqueue_style( 'enlighten-style', get_stylesheet_uri() );

	wp_enqueue_script( 'enlighten-sidr', get_template_directory_uri() . '/js/sidr.js', array( 'jquery' ), '0.5.0', true );

	wp_enqueue_script( 'enlighten-home', get_template_directory_uri() . '/js/crafty-home.js', array( 'enlighten-sidr' ));

	wp_enqueue_script( 'enlighten-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic|Open+Sans:400,700' );
}
add_action( 'wp_enqueue_scripts', 'enlighten_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}
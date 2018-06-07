<?php
/**
 * mobile-first functions and definitions
 *
 * @package Exhibit
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'exhibit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function exhibit_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mobile-first, use a find and replace
	 * to change 'exhibit' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'exhibit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'gallery', 9999, 416, true );
	add_image_size( 'video', 403, 225, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'exhibit' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

}
endif; // exhibit_setup
add_action( 'after_setup_theme', 'exhibit_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function exhibit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'exhibit' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'exhibit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function exhibit_scripts() {

	wp_enqueue_style( 'exhibit-style', get_stylesheet_uri() );

	wp_enqueue_style( 'exhibit-source-sans-pro', 'http://fonts.googleapis.com/css?family=Open+Sans' );

	wp_enqueue_style( 'exhibit-fonts', get_template_directory_uri() . '/fonts/bitter-fonts.css' );

	wp_enqueue_style( 'exhibit-swipebox-css', get_template_directory_uri() . '/css/jquery.swipebox.css' );

	wp_enqueue_script( 'exhibit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'exhibit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'exhibit-jquery-scrollbar', get_template_directory_uri() . '/js/ps-scrollbar.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'exhibit-scrollbar', get_template_directory_uri() . '/js/scrollbar.js', array(), '', true );

	wp_enqueue_script( 'exhibit-swipebox', get_template_directory_uri() . '/js/jquery.swipebox.min.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'exhibit-scrollbar-init', get_template_directory_uri() . '/js/home.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'exhibit_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Admin functions.
 */
require get_template_directory() . '/admin/admin-functions.php';

/**
 * Load custom post type
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Load attachments plugin custom function
 */
require get_template_directory() . '/inc/attachments-plugin.php';

/**
 * Load meta boxes plugin custom function
 */
require get_template_directory() . '/inc/meta-boxes.php';

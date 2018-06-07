<?php
/**
 * WP Portfolio functions and definitions
 *
 * @package wp-portfolio
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'wp_portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_portfolio_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 */
	load_theme_textdomain( 'portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'home-portfolio', 378, 252, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'portfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
}
endif; // wp_portfolio_setup
add_action( 'after_setup_theme', 'wp_portfolio_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wp_portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar-1', 'portfolio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wp_portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_portfolio_scripts() {
	wp_enqueue_style( 'wp-portfolio-style', get_stylesheet_uri() );
    wp_enqueue_style( 'wp-portfolio-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,700,600,800,400');
	wp_enqueue_script( 'wp-portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'wp-portfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_portfolio_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

 /**
  * Load Dashboard Widget
  */
 require get_template_directory() . '/inc/widgets.php';

/**
 * Add custom post types.
 */
require get_template_directory() . '/inc/post-types.php';

function portfolio_flush_rewrite() {
	flush_rewrite_rules();
}
add_action('switch_theme', 'portfolio_flush_rewrite');

/**
 * Add Meta Boxes.
 */
require get_template_directory() . '/lib/Custom-Meta-Boxes/wpp-meta-boxes.php';

 /**
  * Add Theme Documentation
  */
 require get_template_directory() . '/inc/theme-docs.php';

 function dont_hide_the_help() {
 	wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/inc/css/admin-style.css', false, '1.0.0' );
 	wp_enqueue_style( 'custom_wp_admin_css' );
 }
 add_action( 'admin_enqueue_scripts', 'dont_hide_the_help' );
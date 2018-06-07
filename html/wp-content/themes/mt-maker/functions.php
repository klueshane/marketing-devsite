<?php
/**
 * (mt) Maker Theme functions and definitions
 *
 * @package (mt) Maker Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'the_slug_exists' ) ) :
    function the_slug_exists($post_name) {
        global $wpdb;
        if ( $wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
            return true;
        } else {
            return false;
        }
    }
endif; // the_slug_exists

if ( ! function_exists( 'maker_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maker_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MT Apollo Theme, use a find and replace
		 * to change 'maker-theme' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'maker-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'header-1', 485, 392, true );
		add_image_size( 'header-2', 723, 392, true );
		add_image_size( 'slider', 650, 650, true );
		add_image_size( 'grid', 239, 185, true );
		add_image_size( 'bottom-grid', 345, 254, true );
		add_image_size( 'bio', 274, 274, true );

		add_image_size( 'masonry', 236, 9999 );
		add_image_size( 'full-width', 1038, 576, true );
		add_image_size( 'vertical-gallery', 960, 600, true );
		add_image_size( 'horizontal-gallery', 9999, 603 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
	}
endif; // maker_theme_setup

add_action( 'after_setup_theme', 'maker_theme_setup' );

// Create and set Home page

function does_page_exists( $post_name ) {
	global $wpdb;
	if( $wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A' ) ) {
		return true;
	} else {
		return false;
	}
}
// change the Sample page to the home page
if ( isset( $_GET['activated'] ) && is_admin() ) {
	$home_page_title = 'Home';
	$home_page_content = '';
	$home_page_check = get_page_by_title( $home_page_title );
	$home_page = array(
		'post_type' => 'page',
		'post_title' => $home_page_title,
		'post_content' => $home_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		'ID' => 2,
		'post_slug' => 'home'
	);
	if( !isset( $home_page_check->ID ) && !the_slug_exists( 'home' ) ) {
		$home_page_id = wp_insert_post( $home_page );
	}
}

/**
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'maker_hide_editor' );

function maker_hide_editor() {
	// Get the Post ID.
	$post_id = isset( $_GET['post'] ) ? $_GET['post'] : ( isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : null );
	if( !isset( $post_id ) ) return;

	// Hide the editor on the page titled 'Home'
	$homepgname = get_the_title($post_id);
	if($homepgname == 'Home'){
		remove_post_type_support('page', 'editor');
	}
}

/**
 * Enqueue scripts and styles.
 */
function maker_theme_scripts() {
	wp_enqueue_style( 'maker-theme-style', get_stylesheet_uri() );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons-styles.css', true );

	wp_enqueue_style( 'maker-fonts', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Bitter:400,700' );

	wp_enqueue_script( 'maker-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'maker-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'maker-functions', get_template_directory_uri() . '/js/home.js', array(), '', true );

	wp_enqueue_script( 'maker-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maker_theme_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Meta Boxes
 */
require get_template_directory() . '/lib/cmb/custom-meta-boxes.php';

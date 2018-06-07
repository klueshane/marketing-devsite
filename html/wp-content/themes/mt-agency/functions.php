<?php
/**
 * Agency functions and definitions
 *
 * @package Agency
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'agency_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agency_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agency, use a find and replace
	 * to change 'agency' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'agency', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'agency' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


}
endif; // agency_setup
add_action( 'after_setup_theme', 'agency_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function agency_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'agency' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="col-xs-12 col-sm-6"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'agency_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agency_scripts() {
	
	wp_enqueue_style( 'agency-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,700,300,600,400|Fjalla+One|Oswald:400,300,700' );
	
	wp_enqueue_style( 'agency-font-awesome', get_stylesheet_directory_uri().'/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'agency-bootstrap-style', get_stylesheet_directory_uri().'/css/bootstrap.css' );
	
	wp_enqueue_style( 'agency-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'agency-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'agency-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'agency-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agency_scripts' );

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
 * Register Work Custom Post Type
 */
function agency_work_post_type() {

	$labels = array(
		'name'                => _x( 'Work', 'Post Type General Name', 'agency' ),
		'singular_name'       => _x( 'Work', 'Post Type Singular Name', 'agency' ),
		'menu_name'           => __( 'Work', 'agency' ),
		'parent_item_colon'   => __( 'Parent Item:', 'agency' ),
		'all_items'           => __( 'All Work', 'agency' ),
		'view_item'           => __( 'View Work', 'agency' ),
		'add_new_item'        => __( 'Add New Work', 'agency' ),
		'add_new'             => __( 'Add New', 'agency' ),
		'edit_item'           => __( 'Edit Work', 'agency' ),
		'update_item'         => __( 'Update Work', 'agency' ),
		'search_items'        => __( 'Search Work', 'agency' ),
		'not_found'           => __( 'No Work Found', 'agency' ),
		'not_found_in_trash'  => __( 'No work found in Trash', 'agency' ),
	);
	$args = array(
		'label'               => __( 'work', 'agency' ),
		'description'         => __( 'Work Post Type', 'agency' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', ),
		'taxonomies'          => array( 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'work', $args );

}

// Hook into the 'init' action
add_action( 'init', 'agency_work_post_type', 0 );

/**
 * Add Custom Image Size for Homepage Work Section
 */
add_image_size( 'work_thumbnail', 555, 283, true );

/**
 * Add Custom Exceprt Read More for Homepage Work Section
 */
function new_excerpt_more( $more ) {
	return '<br /><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('MORE ABOUT THIS PROJECT', 'agency') . ' <i class="fa fa-chevron-right"></i></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Add Customizer Tools
 */
require_once( trailingslashit( get_template_directory() ). '/inc/wordpress-theme-customizer-custom-controls/theme-customizer-demo.php' );

/**
 * Add Work Overlay Featured Text Fields
 **/
 
define('WYSIWYG_META_BOX_ID', 'my-editor');
define('WYSIWYG_EDITOR_ID', 'myeditor'); //Important for CSS that this is different
define('WYSIWYG_META_KEY', 'work_feature');

add_action('admin_init', 'wysiwyg_register_meta_box');
function wysiwyg_register_meta_box(){
        add_meta_box(WYSIWYG_META_BOX_ID, __('WYSIWYG Meta Box', 'wysiwyg'), 'wysiwyg_render_meta_box', 'work');
}

function wysiwyg_render_meta_box(){

        global $post;

        $meta_box_id = WYSIWYG_META_BOX_ID;
        $editor_id = WYSIWYG_EDITOR_ID;

        //Add CSS & jQuery goodness to make this work like the original WYSIWYG
        echo "
                <style type='text/css'>
                        #$meta_box_id #edButtonHTML, #$meta_box_id #edButtonPreview {background-color: #F1F1F1; border-color: #DFDFDF #DFDFDF #CCC; color: #999;}
                        #$editor_id{width:100%;}
                        #$meta_box_id #editorcontainer{background:#fff !important;}
                        #$meta_box_id #$editor_id_fullscreen{display:none;}
                </style>

                <script type='text/javascript'>
                        jQuery(function($){
                                $('#$meta_box_id #editor-toolbar > a').click(function(){
                                        $('#$meta_box_id #editor-toolbar > a').removeClass('active');
                                        $(this).addClass('active');
                                });

                                if($('#$meta_box_id #edButtonPreview').hasClass('active')){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                }

                                $('#$meta_box_id #edButtonPreview').click(function(){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                });

                                $('#$meta_box_id #edButtonHTML').click(function(){
                                        $('#$meta_box_id #ed_toolbar').show();
                                });

				//Tell the uploader to insert content into the correct WYSIWYG editor
				$('#media-buttons a').bind('click', function(){
					var customEditor = $(this).parents('#$meta_box_id');
					if(customEditor.length > 0){
						edCanvas = document.getElementById('$editor_id');
					}
					else{
						edCanvas = document.getElementById('content');
					}
				});
                        });
                </script>
        ";

        //Create The Editor
        $content = get_post_meta($post->ID, WYSIWYG_META_KEY, true);
        the_editor($content, $editor_id);

        //Clear The Room!
        echo "<div style='clear:both; display:block;'></div>";
}

add_action('save_post', 'wysiwyg_save_meta');
function wysiwyg_save_meta(){

        $editor_id = WYSIWYG_EDITOR_ID;
        $meta_key = WYSIWYG_META_KEY;

        if(isset($_REQUEST[$editor_id]))
                update_post_meta($_REQUEST['post_ID'], WYSIWYG_META_KEY, $_REQUEST[$editor_id]);

}

// Register Custom Post Type
function register_team_post_type() {

	$labels = array(
		'name'                => _x( 'Team', 'Post Type General Name', 'agency' ),
		'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'agency' ),
		'menu_name'           => __( 'Team', 'agency' ),
		'parent_item_colon'   => __( 'Parent Item:', 'agency' ),
		'all_items'           => __( 'All Items', 'agency' ),
		'view_item'           => __( 'View Item', 'agency' ),
		'add_new_item'        => __( 'Add New Item', 'agency' ),
		'add_new'             => __( 'Add New', 'agency' ),
		'edit_item'           => __( 'Edit Item', 'agency' ),
		'update_item'         => __( 'Update Item', 'agency' ),
		'search_items'        => __( 'Search Item', 'agency' ),
		'not_found'           => __( 'Not found', 'agency' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'agency' ),
	);
	$args = array(
		'label'               => __( 'team', 'agency' ),
		'description'         => __( 'Team Members', 'agency' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'team', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_team_post_type', 0 );
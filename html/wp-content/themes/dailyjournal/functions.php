<?php
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/mt-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/mt-config.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/mt-api.class.php' ) ) {
	require_once( dirname( __FILE__ ) . '/mt-api.class.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/mt-upgrader.class.php' ) ) {
	require_once( dirname( __FILE__ ) . '/mt-upgrader.class.php' );
}

add_action( 'after_setup_theme', 'shaken_setup' );
function shaken_setup() {
	
	// Theme support
		
		add_theme_support( 'automatic-feed-links' );
		
		// Set featured image sizes
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1900, 9000);
		add_image_size('archive', 400, 290, true);
		add_image_size('tablet', 720, 9000);
		
	// Actions
	
		/* Add your nav menus function to the 'init' action hook. */
		add_action( 'init', 'shaken_register_menus' );
	
	// Filters
	
		// Show home link in wp_nav_menu() fallback
		add_filter( 'wp_page_menu_args', 'shaken_page_menu_args' );
		
		// Add featured images to RSS feed
		add_filter('pre_get_posts','shaken_feedFilter');
		
		// Add wmode='transparent' to auto embedded Flash videos
		add_filter('embed_oembed_html', 'add_video_wmode', 10, 3);
}

// --------------  Register Menus -------------- 
function shaken_register_menus(){
	register_nav_menus( array(
		'main_menu' => __( 'Main Menu'),
	) );	
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 */
function shaken_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

// smart jquery inclusion
function shaken_jquery(){
    if (!is_admin()) {
    	wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'shaken_jquery' );

// -------------- Add featured images to RSS feed --------------
function shaken_feedContentFilter($content) {
	$thumbId = get_post_thumbnail_id();

	if($thumbId) {
		$img = wp_get_attachment_image_src($thumbId);
		$image = '<img src="'. $img[0] .'" alt="" width="'. $img[1] .'" height="'. $img[2] .'" />';
		echo $image;
	}
	
	return $content;
}

function shaken_feedFilter($query) {
	if ($query->is_feed) {
		add_filter('the_content', 'shaken_feedContentFilter');
		}
	return $query;
}

// Add wmode=transparent 
if(!function_exists('add_video_wmode')){
function add_video_wmode($html, $url, $attr) {
    if ( strpos( $html, "<embed src=" ) !== false ){ 
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); 
    } elseif ( strpos ( $html, 'feature=oembed' ) !== false ){ 
        return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); 
    } else{ 
        return $html;
    }
}}

/* Scripts and Styles */
function mt_color_picker_script() {
	wp_enqueue_script('farbtastic');
	//wp_enqueue_script( 'jon-admin', get_template_directory_uri() . '/admin/js/admin.js', array( 'farbtastic' ) );
}
function mt_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action('admin_print_scripts-post.php', 'mt_color_picker_script');
add_action('admin_print_styles-post.php', 'mt_color_picker_style');

add_action('admin_print_scripts-post-new.php', 'mt_color_picker_script');
add_action('admin_print_styles-post-new.php', 'mt_color_picker_style');



/* Add Metaboxes */

add_action( 'add_meta_boxes', 'mt_metabox_init' );
function mt_metabox_init() {
	add_meta_box( 'mt-meta', 'Custom Post Options', 'mt_metabox_content', 'post', 'normal', 'high' );
}

function mt_metabox_content( $post ) { 

	$headline_color = get_post_meta( $post->ID, '_headline_color', true );
	$nav_link_color = get_post_meta( $post->ID, '_nav_link_color', true );

	?>
	
	<script type="text/javascript">
	//<![CDATA[
		jQuery(document).ready(function()
		{
			// colorpicker field
			jQuery('.mt-color-field').on('focus', function(){
				var colorFor = jQuery(this).attr('id');
				jQuery(this).next('.mt-colorpicker').slideDown();
			}).on('blur', function(){
    			jQuery(this).next('.mt-colorpicker').slideUp();
			});

			jQuery('.mt-colorpicker').each(function(){
				var $this = jQuery(this),
				id = $this.attr('data-for');

				$this.farbtastic('#' + id);
			});

		});
	//]]>   
	</script>

	<div style="margin-bottom: 15px;">
		<label for="headline_color">Headline color: </label>
		<input type="text" name="headline_color" id="headline_color" class="mt-color-field" value="<?php if( $headline_color ) { echo $headline_color; } else { echo '#'; } ?>" />
		<div class="mt-colorpicker" data-for="headline_color" style="display:none"></div>
	</div>

	<div>
		<label for="nav_link_color">Navigation link color: </label>
		<input type="text" name="nav_link_color" id="nav_link_color" class="mt-color-field" value="<?php if( $nav_link_color ) { echo $nav_link_color; } else { echo '#'; } ?>" />
		<div class="mt-colorpicker" data-for="nav_link_color" style="display:none"></div>
	</div>

<?php }

//hook to save the meta box data
add_action( 'save_post', 'mt_save_meta' );

function mt_save_meta( $post_id ) {
	//verify the metadata is set
	if ( isset( $_POST['headline_color'] ) ) {
		//save the metadata
		update_post_meta( $post_id, '_headline_color', strip_tags( $_POST['headline_color'] ) );
	}

	if ( isset( $_POST['nav_link_color'] ) ) {
		//save the metadata
		update_post_meta( $post_id, '_nav_link_color', strip_tags( $_POST['nav_link_color'] ) );
	}
}

	
//Customize login screen
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login/custom-login.css" />'; 
}
add_action('login_head', 'custom_login');

add_image_size( 'about-img', 480);
?>
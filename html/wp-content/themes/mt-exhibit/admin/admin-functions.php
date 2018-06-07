<?php
/**
 * Exhibit Admin Functions
 *
 * @package Exhibit
 */

// admin area styling
function exhibit_custom_colors() {
	echo '<style type="text/css">
          #setting-error-tgmpa {
			border-left: 4px solid #37b492;
			background: #fff;
			padding: 15px 20px;
			}
		  #setting-error-tgmpa p {
			font-size: 14px;
			font-weight: 300 !important;
			color: #404040;
			margin: 0;
		  }
		  #setting-error-tgmpa p strong {
			font-weight: 300 !important;
		  }
		  #setting-error-tgmpa p strong a {
			font-size: 14px !important;
			text-decoration: none !important;
			color: #37b492 !important;
			font-weight: 600 !important;
		  }

         </style>';
}

add_action('admin_head', 'exhibit_custom_colors');

/**
 * Modern WordPress Help Notice
 */

add_action('admin_notices', 'exhibit_admin_notice');

function exhibit_admin_notice() {
	global $current_user ;
	$user_id = $current_user->ID;
	/* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'exhibit_ignore_notice') ) {
		echo '<div class="updated">';
		printf(__('Need help or customization for your WordPress website? <a style="text-decoration: none;" href="http://modernwp.net" target=_blank">Click here</a> to visit us at Modern WordPress | <a style="text-decoration: none;" href="%1$s">Close</a>'), '?exhibit_nag_ignore=0');
		echo "</p></div>";
	}
}

add_action('admin_init', 'exhibit_nag_ignore');

function exhibit_nag_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset($_GET['exhibit_nag_ignore']) && '0' == $_GET['exhibit_nag_ignore'] ) {
		add_user_meta($user_id, 'exhibit_ignore_notice', 'true', true);
	}
}

/**
 *TGM Plugin activation.
 */
require_once get_template_directory() . '/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'exhibit_recommend_plugin' );
function exhibit_recommend_plugin() {

	$plugins = array(
		// Include plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'Attachments',
			'slug' 		=> 'attachments',
			'required' 	=> false
		),

		array(
			'name'		=> 'Meta Box',
			'slug'		=> 'meta-box',
			'required'	=> false
		)
	);

	tgmpa( $plugins);

}

function exhibit_enqueue_admin_styles() {
	wp_register_style( 'exhibit_admin_css', get_template_directory_uri() . '/admin/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'exhibit_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'exhibit_enqueue_admin_styles' );

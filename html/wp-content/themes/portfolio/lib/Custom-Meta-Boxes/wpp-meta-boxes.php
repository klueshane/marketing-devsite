<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'portfolio_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function portfolio_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['wpp_portfolio_metabox'] = array(
		'id'         => 'wpp_metabox',
		'title'      => __( 'Additional Project Images', 'portfolio' ),
		'pages'      => array( 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Project URL', 'portfolio' ),
				'desc' => __( '', 'portfolio' ),
				'id'   => $prefix . 'project-url',
				'type' => 'text',
			),
			array(
				'name'         => __( 'Multiple Files', 'portfolio' ),
				'desc'         => __( 'Upload or add multiple images.', 'portfolio' ),
				'id'           => $prefix . 'image_list',
				'type'         => 'file_list',
				'preview_size' => array( 300, 300 ), // Default: array( 50, 50 )
			),
		),
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */



function maker_metaboxes( array $meta_boxes ) {
	global $post;

	$prefix = '_maker_';

	// Header Images
	$meta_boxes['header_images'] = array(
		'id'                    => 'maker_header_image_metabox',
		'title'                 => __( 'Header Image(s)', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => array(
			array(
				'id'                => $prefix . 'header_images',
				'name'              => __( 'Add Images', 'cmb' ),
				'type'              => 'image',
				'repeatable'        => true,
				'repeatable_max'    => 2
			)
		),
	);

	// Our Story Section
	$top_section = array(
		array(
			'id' => 'top-section-title',
			'name' => 'Section Title',
			'type' => 'text',
			'cols' => 12
		),
		array(
			'id' => 'top-section-image',
			'name' => 'Left Image',
			'type' => 'image',
			'cols' => 3
		),
		array(
			'id' => 'top-section-content',
			'name' => 'Content',
			'type' => 'wysiwyg',
			'cols' => 9
		),
	);
	$meta_boxes['about_image'] = array(
		'id'                    => 'maker_top_section',
		'title'                 => __( 'Top Section', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $top_section
	);

	$products = array(

		array( 'id' => 'product', 'name' => 'Product', 'type' => 'group', 'cols' => 12, 'repeatable' =>true, 'fields' => array(
			array( 'id' => 'product_image',  'name' => 'Product Image', 'type' => 'image' ),
			array( 'id' => 'product_name',  'name' => 'Name', 'type' => 'text' ),
			array( 'id' => 'product_cost',  'name' => 'Cost', 'type' => 'text' ),

		) ),
	);

	// Product Slider
	$meta_boxes['product_slider'] = array(
		'id'                    => 'maker_products_metabox',
		'title'                 => __( 'Product(s)', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $products,
	);

	// Our Process
	$process = array(
		array(
			'id' => 'process-title',
			'name' => 'Section Title',
			'type' => 'text',
			'cols' => 12
		),
		array(
			'id' => 'process-content',
			'name' => 'Content',
			'type' => 'wysiwyg',
			'cols' => 9
		),
		array(
			'id' => 'process-image',
			'name' => 'Process Images',
			'desc' => __( 'You can have a maximum of 4 images in this section.', 'cmb' ),
			'type' => 'image',
			'repeatable' => true,
			'repeatable_max'=> 4,
			'cols' => 3
		),
	);
	$meta_boxes['process'] = array(
		'id'                    => 'process_section',
		'title'                 => __( 'Process Section', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $process
	);

	// Video

	$video = array(
		array(
			'id' => 'video',
			'name' => 'Video',
			'type' => 'url',
		)
	);
	$meta_boxes['video'] = array(
		'id'                    => 'video',
		'title'                 => __( 'Add a Video', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $video
	);

	// Inspiration
	$inspiration = array(
		array(
			'id' => 'inspiration-title',
			'name' => 'Section Title',
			'type' => 'text',
			'cols' => 12
		),
		array(
			'id' => 'inspiration-content',
			'name' => 'Content',
			'type' => 'wysiwyg',
			'cols' => 9
		),
		array(
			'id' => 'inspiration-image',
			'name' => 'Inspiration Images',
			'desc' => __( 'You can have a maximum of 4 images in this section.', 'cmb' ),
			'type' => 'image',
			'repeatable' => true,
			'repeatable_max'=> 4,
			'cols' => 3
		),
	);
	$meta_boxes['inspiration'] = array(
		'id'                    => 'inspiration_section',
		'title'                 => __( 'Inspiration Section', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $inspiration
	);

	// Stockists

	$stockists = array(

		array( 'id' => 'stockists', 'name' => 'Stockists', 'type' => 'group', 'cols' => 12, 'repeatable' =>true, 'fields' => array(
			array(
				'id' => 'stockists_name',
				'name' => 'Name',
				'type' => 'text',
			),
			array(
				'id' => 'stockists_street_address',
				'name' => 'Street Address',
				'type' => 'text',
			),
			array(
				'id' => 'city_state_zip',
				'name' => 'City, State, Zip',
				'type' => 'text',
			)

		) ),
	);
	$meta_boxes['stockists'] = array(
		'id'                    => 'stockists',
		'title'                 => __( 'Stockists', 'cmb' ),
		'pages'                 => array( 'page' ),
		'context'               => 'advanced',
		'priority'              => 'high',
		'show_names'            => true,
		'fields'                => $stockists
	);


	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'maker_metaboxes' );

// Move all "advanced" metaboxes above the default editor
add_action('edit_form_after_title', function() {
	global $post, $wp_meta_boxes;
	do_meta_boxes(get_current_screen(), 'advanced', $post);
	unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});
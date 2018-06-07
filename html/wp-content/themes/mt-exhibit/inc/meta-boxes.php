<?php
add_filter( 'rwmb_meta_boxes', 'exhibit_register_meta_boxes' );

function exhibit_register_meta_boxes( $meta_boxes ) {
	global $post;

	$prefix = 'ex_';

	$meta_boxes[] = array(
		'id'       => 'contact_info',
		'title'    => 'Photographic and Video Contact Information:',
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',

		'fields' => array(
			array(
				'name'  => 'Name',
				'desc'  => '',
				'id'    => $prefix . 'name',
				'type'  => 'text',
			),
			array(
				'name'  => 'Street Address',
				'desc'  => '',
				'id'    => $prefix . 'street_address',
				'type'  => 'text',
			),
			array(
				'name'  => 'City',
				'desc'  => '',
				'id'    => $prefix . 'city',
				'type'  => 'text',
			),
			array(
				'name'  => 'State',
				'desc'  => '',
				'id'    => $prefix . 'state',
				'type'  => 'text',
			),
			array(
				'name'  => 'Zip Code',
				'desc'  => '',
				'id'    => $prefix . 'zip',
				'type'  => 'text',
			),
			array(
				'name'  => 'Telephone',
				'desc'  => '',
				'id'    => $prefix . 'phone',
				'type'  => 'text',
			),
		)
	);


	$meta_boxes[] = array(
		'id'       => 'videos',
		'title'    => 'Video',
		'pages'    => array( 'videos' ),
		'context'  => 'normal',
		'priority' => 'high',

		'fields' => array(
			array(
				'name'  => 'Video URL',
				'desc'  => '',
				'id'    => $prefix . 'video_url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Featured Image',
				'desc'  => '',
				'id'    => $prefix . 'video_image',
				'type'  => 'image',
			),
			array(
				'name'  => 'Description',
				'desc'  => '',
				'id'    => $prefix . 'video_description',
				'type'  => 'wysiwyg',
			),
		)
	);

	return $meta_boxes;
}
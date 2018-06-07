<?php
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance


function exhibit_attachments( $attachments ) {
	$fields         = array(
		array(
			'name'      => 'title',                         // unique field name
			'type'      => 'text',                          // registered field type
			'label'     => __( 'Image', 'attachments' ),    // label to display
			'default'   => 'title',                         // default value upon selection
		),
		array(
			'name'      => 'caption',                       // unique field name
			'type'      => 'textarea',                      // registered field type
			'label'     => __( 'Caption', 'attachments' ),  // label to display
			'default'   => 'caption',                       // default value upon selection
		),
	);

	$args = array(

		// title of the meta box (string)
		'label'         => 'Add a Gallery',

		// all post types to utilize (string|array)
		'post_type'     => array( 'gallery' ),

		// meta box position (string) (normal, side or advanced)
		'position'      => 'normal',

		// meta box priority (string) (high, default, low, core)
		'priority'      => 'high',

		// allowed file type(s) (array) (image|video|text|audio|application)
		'filetype'      => 'image',  // no filetype limit

		// include a note within the meta box (string)
		'note'          => 'Attach your images here',

		// by default new Attachments will be appended to the list
		// but you can have then prepend if you set this to false
		'append'        => true,

		// text for 'Attach' button in meta box (string)
		'button_text'   => __( 'Attach Images', 'attachments' ),

		// text for modal 'Attach' button (string)
		'modal_text'    => __( 'Attach', 'attachments' ),

		// which tab should be the default in the modal (string) (browse|upload)
		'router'        => 'browse',

		// whether Attachments should set 'Uploaded to' (if not already set)
		'post_parent'   => true,

		// fields array
		'fields'        => $fields,

	);

	$attachments->register( 'exhibit_attachments', $args ); // unique instance name
}

add_action( 'attachments_register', 'exhibit_attachments' );
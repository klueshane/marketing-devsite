<?php
add_action( 'init', 'register_cpt_gallery' );

function register_cpt_gallery() {

	$labels = array(
		'name' => _x( 'Galleries', 'gallery' ),
		'singular_name' => _x( 'Gallery', 'gallery' ),
		'add_new' => _x( 'Add New', 'gallery' ),
		'add_new_item' => _x( 'Add New Gallery', 'gallery' ),
		'edit_item' => _x( 'Edit Gallery', 'gallery' ),
		'new_item' => _x( 'New Gallery', 'gallery' ),
		'view_item' => _x( 'View Gallery', 'gallery' ),
		'search_items' => _x( 'Search Galleries', 'gallery' ),
		'not_found' => _x( 'No galleries found', 'gallery' ),
		'not_found_in_trash' => _x( 'No galleries found in Trash', 'gallery' ),
		'parent_item_colon' => _x( 'Parent Gallery:', 'gallery' ),
		'menu_name' => _x( 'Galleries', 'gallery' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'Create custom galleries to show off your work.',
		'supports' => array( 'title', 'thumbnail' ),
		'taxonomies' => array( 'category', 'post_tag' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-format-gallery',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'gallery', $args );
}

add_action( 'init', 'register_cpt_video' );

function register_cpt_video() {

	$labels = array(
		'name' => _x( 'Videos', 'video' ),
		'singular_name' => _x( 'Video', 'video' ),
		'add_new' => _x( 'Add New', 'video' ),
		'add_new_item' => _x( 'Add New Video', 'video' ),
		'edit_item' => _x( 'Edit Video', 'video' ),
		'new_item' => _x( 'New Video', 'video' ),
		'view_item' => _x( 'View Video', 'video' ),
		'search_items' => _x( 'Search Videos', 'video' ),
		'not_found' => _x( 'No videos found', 'video' ),
		'not_found_in_trash' => _x( 'No videos found in Trash', 'video' ),
		'parent_item_colon' => _x( 'Parent Video:', 'video' ),
		'menu_name' => _x( 'Videos', 'video' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,

		'supports' => array( 'title' ),
		'taxonomies' => array( 'category', 'post_tag' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-video-alt2',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'videos', $args );
}

// Flush rewrite rules so that these will be visible

function exhibit_flush_rewrite() {
	flush_rewrite_rules();
}
add_action('switch_theme', 'exhibit_flush_rewrite');
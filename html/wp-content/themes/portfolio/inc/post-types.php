<?php

// Register Custom Post Type
add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

    $labels = array( 
        'name' => _x( 'Projects', 'portfolio' ),
        'singular_name' => _x( 'Portfolio', 'portfolio' ),
        'add_new' => _x( 'Add New Project', 'portfolio' ),
        'add_new_item' => _x( 'Add New Project', 'portfolio' ),
        'edit_item' => _x( 'Edit Project', 'portfolio' ),
        'new_item' => _x( 'New Project', 'portfolio' ),
        'view_item' => _x( 'View Project', 'portfolio' ),
        'search_items' => _x( 'Search Projects', 'portfolio' ),
        'not_found' => _x( 'No projects found', 'portfolio' ),
        'not_found_in_trash' => _x( 'No projects found in Trash', 'portfolio' ),
        'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio' ),
        'menu_name' => _x( 'Portfolio', 'portfolio' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
        'taxonomies' => array( 'project_category', 'project_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

// Register Custom Taxonomy
function register_project_category() {

	$labels = array(
		'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'portfolio' ),
		'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'portfolio' ),
		'menu_name'                  => __( 'Project Category', 'portfolio' ),
		'all_items'                  => __( 'All Items', 'portfolio' ),
		'parent_item'                => __( 'Parent Item', 'portfolio' ),
		'parent_item_colon'          => __( 'Parent Item:', 'portfolio' ),
		'new_item_name'              => __( 'New Item Name', 'portfolio' ),
		'add_new_item'               => __( 'Add New Item', 'portfolio' ),
		'edit_item'                  => __( 'Edit Item', 'portfolio' ),
		'update_item'                => __( 'Update Item', 'portfolio' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'portfolio' ),
		'search_items'               => __( 'Search Items', 'portfolio' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'portfolio' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'portfolio' ),
		'not_found'                  => __( 'Not Found', 'portfolio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'project_category', array( 'portfolio' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_project_category', 0 );

// Register Custom Taxonomy
function register_project_tags() {

	$labels = array(
		'name'                       => _x( 'Project Tags', 'Taxonomy General Name', 'portfolio' ),
		'singular_name'              => _x( 'Project Tag', 'Taxonomy Singular Name', 'portfolio' ),
		'menu_name'                  => __( 'Project Tags', 'portfolio' ),
		'all_items'                  => __( 'All Items', 'portfolio' ),
		'parent_item'                => __( 'Parent Item', 'portfolio' ),
		'parent_item_colon'          => __( 'Parent Item:', 'portfolio' ),
		'new_item_name'              => __( 'New Item Name', 'portfolio' ),
		'add_new_item'               => __( 'Add New Item', 'portfolio' ),
		'edit_item'                  => __( 'Edit Item', 'portfolio' ),
		'update_item'                => __( 'Update Item', 'portfolio' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'portfolio' ),
		'search_items'               => __( 'Search Items', 'portfolio' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'portfolio' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'portfolio' ),
		'not_found'                  => __( 'Not Found', 'portfolio' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'project_tag', array( 'portfolio' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_project_tags', 0 );
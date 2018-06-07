<?php
/**
 * Enlighten Theme Customizer
 *
 * @package enlighten
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function enlighten_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'enlighten_logo_section' , array(
		'title'             => __( 'Logo', 'enlighten' ),
		'priority'          => 5,
		'description'       => 'Upload your own logo to replace the default logo.  Remove the default logo if you would like to use the default site name and description.',
	) );
	$wp_customize->add_setting( 'enlighten_logo', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'enlighten_logo', array(
			'label'         => __( 'Upload a logo (size 185 x 183 pixels)', 'enlighten' ),
			'section'       => 'enlighten_logo_section',
			'settings'      => 'enlighten_logo',
		)
	));

	// Add Social Media Section
	$wp_customize->add_section( 'social-media' , array(
		'title'             => __( 'Social Media', 'enlighten' ),
		'priority'          => 30,
		'description'       => __( 'Enter the URL to your account for each service for the icon to appear in the header.', 'enlighten' ),
	) );
	// Add Twitter Setting
	$wp_customize->add_setting( 'twitter' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
		'label'             => __( 'Twitter', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'twitter',
		'sanitize_callback' => 'esc_url_raw',
	) ) );
	// Add Facebook Setting
	$wp_customize->add_setting( 'facebook' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
		'label'             => __( 'Facebook', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'facebook',
		'sanitize_callback' => 'esc_url_raw',
	) ) );
	// Add Vimeo Setting
	$wp_customize->add_setting( 'vimeo' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo', array(
		'label'             => __( 'Vimeo', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'vimeo',
		'sanitize_callback' => 'esc_url_raw',
	) ) );
	// Add Youtube Setting
	$wp_customize->add_setting( 'youtube' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube', array(
		'label'             => __( 'YouTube', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'youtube',
	) ) );
	// Add Pinterest Setting
	$wp_customize->add_setting( 'pinterest' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest', array(
		'label'             => __( 'Pinterest', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'pinterest',
		'sanitize_callback' => 'esc_url_raw',
	) ) );
	// Add Instagram Setting
	$wp_customize->add_setting( 'instagram' , array( 'default' => '','sanitize_callback' => 'esc_url_raw', ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram', array(
		'label'             => __( 'Instagram', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'instagram'
	) ) );
	// Add RSS Setting
	$wp_customize->add_setting(
		'rss' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss', array(
		'label'             => __( 'RSS', 'enlighten' ),
		'section'           => 'social-media',
		'settings'          => 'rss'
	) ) );

	// Add the featured content section in case it's not already there.
	$wp_customize->add_section( 'featured_content', array(
		'title'             => __( 'Featured Content', 'enlighten' ),
		'description'       => sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts.', 'enlighten' ),
			esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'enlighten' ), admin_url( 'edit.php' ) ) )
		),
		'priority'          => 130,
	) );

}
add_action( 'customize_register', 'enlighten_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function enlighten_customize_preview_js() {
	wp_enqueue_script( 'enlighten_customizer', get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'enlighten_customize_preview_js' );

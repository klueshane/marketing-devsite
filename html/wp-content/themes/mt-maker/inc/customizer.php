<?php
/**
 * (mt) Maker Theme Theme Customizer
 *
 * @package (mt) Maker Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maker_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add Social Media Section
	$wp_customize->add_section( 'social-media' , array(
		'title' => __( 'Social Media', 'maker' ),
		'priority' => 30,
		'description' => __( 'Enter the URL to your account for each service for the icon to appear in the footer.', '' )
	) );

	// Add Twitter Setting
	$wp_customize->add_setting( 'twitter',
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
		'label' => __( 'Twitter', 'maker' ),
		'section' => 'social-media',
		'settings' => 'twitter',
	) ) );

	// Add Facebook Setting
	$wp_customize->add_setting( 'facebook' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
		'label' => __( 'Facebook', 'maker' ),
		'section' => 'social-media',
		'settings' => 'facebook',
	) ) );

	// Add Instagram Setting
	$wp_customize->add_setting( 'instagram' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'Instagram', array(
		'label' => __( 'Instagram', 'maker' ),
		'section' => 'social-media',
		'settings' => 'instagram',
	) ) );

	// Footer Contact Info
	$wp_customize->add_section( 'contact-info' , array(
		'title' => __( 'Contact Info (in footer)', 'maker' ),
		'priority' => 30,
		'description' => __( '', '' )
	) );

	// Add Twitter Setting
	$wp_customize->add_setting( 'email',
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_email',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'email', array(
		'label' => __( 'Email Address', 'maker' ),
		'section' => 'contact-info',
		'settings' => 'email',
	) ) );

	// Add Facebook Setting
	$wp_customize->add_setting( 'phone' ,
		array(
			'default' => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone', array(
		'label' => __( 'Phone Number', 'maker' ),
		'section' => 'contact-info',
		'settings' => 'phone',
	) ) );
}
add_action( 'customize_register', 'maker_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function maker_theme_customize_preview_js() {
	wp_enqueue_script( 'maker_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'maker_theme_customize_preview_js' );

<?php
/**
 * Agency Theme Customizer
 *
 * @package Agency
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function agency_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_setting( 'header_bg_color' , array(
    'default'     => '#000000',
    'transport'   => 'postMessage',
    
    ) );
    
    /*
     * Logo Uploader
     */
    
    $wp_customize->add_section( 'agency_logo_section' , array(
	    'title'       => __( 'Logo', 'agency' ),
	    'priority'    => 5,
	    'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	
	$wp_customize->add_setting( 'agency_logo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agency_logo', array(
	    'label'    => __( 'Logo (70px by 70px)', 'agency' ),
	    'section'  => 'agency_logo_section',
	    'settings' => 'agency_logo',
	) ) );
	
	/*
     * Accent Color Picker
     */
     
    $wp_customize->add_setting( 'accent_color', array(
		'default' => '#ffc600'
	) );
	
	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => 'Accent Color',
		'section' => 'colors',
		'settings' => 'accent_color',
	) ) );
	
	/*
	 * Default Header Background
	 */
	 
	$wp_customize->add_section( 'agency_header_bg' , array(
	    'title'       => __( 'Default Header BG', 'agency' ),
	    'priority'    => 10,
	    'description' => 'Upload a background image to default to when no Featured Image is present.',
	) );
	
	$wp_customize->add_setting( 'agency_bg' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agency_bg', array(
	    'label'    => __( 'Header Background Image', 'agency' ),
	    'section'  => 'agency_header_bg',
	    'settings' => 'agency_bg',
	) ) );

	
}
add_action( 'customize_register', 'agency_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function agency_customize_preview_js() {
	wp_enqueue_script( 'agency_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'agency_customize_preview_js' );

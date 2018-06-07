<?php
/**
 * Emulsion Customizer support
 *
 */

/**
 * Implement Emulsion Customizer additions and adjustments.
 *
 */
 
function my_customizer_social_media_array() {

  // store social site names in array
  $social_sites = array('Twitter', 'Instagram', 'Facebook');

  return $social_sites;
}

function twentyfourteen_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = '';

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );

      
  $wp_customize->add_setting( 'text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
     array(
        'default' => '#ffffff', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
     ) 
  );      
        
  $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
     $wp_customize, //Pass the $wp_customize object (required)
     'text_color', //Set a unique ID for the control
     array(
        'label' => __( 'Text Color', 'mytheme' ), //Admin-visible name of the control
        'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
        'settings' => 'text_color', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
     ) 
  ) );

  $wp_customize->add_setting( 'background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
     array(
        'default' => '#2d2d2d', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
     ) 
  );      
        
  $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
     $wp_customize, //Pass the $wp_customize object (required)
     'background_color', //Set a unique ID for the control
     array(
        'label' => __( 'Background Color', 'mytheme' ), //Admin-visible name of the control
        'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
        'settings' => 'background_color', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
     ) 
  ) );
   
  $wp_customize->add_section(
      'home_page',
      array(
          'title' => 'Home Page',
          'priority' => 35,
      )
  );

	$wp_customize->add_setting( 'default-image' );
	 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'default-image',
	        array(
	            'label' => 'Default Background Image',
	            'section' => 'home_page',
	            'settings' => 'default-image'
	        )
	    )
	);
	
  $wp_customize->add_section( 'my_social_settings', array(
          'title'          => 'Social Media Icons',
          'priority'       => 35,
  ) );

  $social_sites = my_customizer_social_media_array();
  $priority = 5;

  foreach($social_sites as $social_site) {

      $wp_customize->add_setting( "$social_site", array(
              'default'        => '',
      ) );

      $wp_customize->add_control( $social_site, array(
              'label'   => __( "$social_site URL", 'social_icon' ),
              'section' => 'my_social_settings',
              'type'    => 'text',
              'priority'=> $priority,
      ) );

      $priority = $priority + 5;
  }

  $wp_customize->add_setting( "email_address", array(
          'default'        => '',
  ) );

  $wp_customize->add_control( 'email_address', array(
          'label'   => __( "Contact E-mail Address", 'social_icon' ),
          'section' => 'my_social_settings',
          'type'    => 'text',
          'priority'=> $priority,
  ) );
      
}
add_action( 'customize_register', 'twentyfourteen_customize_register' );

function mytheme_customize_css()
{
    ?>
         <style type="text/css">
             body { color: <?php echo get_theme_mod('text_color'); ?>; }
             
             a { color: <?php echo get_theme_mod('text_color'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');
   
/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_customize_preview_js() {
	wp_enqueue_script( 'twentyfourteen_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140705', true );
}
add_action( 'customize_preview_init', 'twentyfourteen_customize_preview_js' );


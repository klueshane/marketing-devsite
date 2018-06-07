<?php
/**
 * Exhibit Theme Customizer
 *
 * @package Exhibit
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function exhibit_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Top Border Color
	$wp_customize->add_setting( 'exhibit_border_color', array(
		'default'           => '#455a64',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'exhibit_border_color', array(
		'label'	   => 'Top Border Color',
		'section'  => 'colors',
		'settings' => 'exhibit_border_color',
	) ) );

	// Add Custom Image to Home page

	$wp_customize->add_section( 'exhibit_homepage_section' , array(
		'title'       => __( 'Home Page', 'exhibit' ),
		'priority'    => 45,
		'description' => 'Upload and Image for the homepage.',
	) );
	$wp_customize->add_setting( 'exhibit_home_image', array(
		'default'       => get_template_directory_uri() . '/images/ocean.jpg',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'home_image', array(
			'label'      => __( 'Upload an image', 'exhibit' ),
			'section'    => 'exhibit_homepage_section',
			'settings'   => 'exhibit_home_image',
			'description'=> '800px wide recommended. Max width 1040px.'
		)
	));

	$wp_customize->add_setting( 'image_caption', array(
		'default' => 'Venice Beach', 'sanitize_callback' => 'esc_html') );
	$wp_customize->add_control( 'image_caption', array(
		'label'                 => __( 'Image Caption', 'exhibit' ),
		'section'               => 'exhibit_homepage_section',
		'settings'              => 'image_caption',
		'type'                  => 'text',
		'sanitize_callback'     => 'esc_html',
	) );
}
add_action( 'customize_register', 'exhibit_customize_register' );

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function exhibit_sanitize_hex_color( $color ) {
	if ( '' === $color )
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}
/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function exhibit_add_customizer_css() {
	$color = exhibit_sanitize_hex_color( get_theme_mod( 'exhibit_border_color' ) );
	?>
	<!-- WP exhibit customizer CSS -->
	<style>
		.site {
			border-color: <?php echo $color; ?>;
		}
	</style>
<?php }
add_action( 'wp_head', 'exhibit_add_customizer_css' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function exhibit_customize_preview_js() {
	wp_enqueue_script( 'exhibit_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'exhibit_customize_preview_js' );

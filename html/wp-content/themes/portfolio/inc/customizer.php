<?php
/**
 * portfolio Blog Theme Customizer
 *
 * @package portfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfolio_customize_register( $wp_customize ) {
	// Top Border Color
	$wp_customize->add_setting( 'wpp_border_color', array(
		'default'           => '#1085A1',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpp_border_color', array(
		'label'	   => 'Top Border Color',
		'section'  => 'colors',
		'settings' => 'wpp_border_color',
	) ) );

	// Add Custom Logo Section

	$wp_customize->add_section( 'portfolio_logo_section' , array(
		'title'       => __( 'Logo', 'portfolio' ),
		'priority'    => 45,
		'description' => '',
	) );
	$wp_customize->add_setting( 'portfolio_logo', array(
		
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'portfolio_logo', array(
			'label'      => __( 'Upload a logo (size 185 x 183 pixels)', 'portfolio' ),
			'section'    => 'portfolio_logo_section',
			'settings'   => 'portfolio_logo',
		)
	));

	// Add Home page Text Section

	class Example_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}
	$wp_customize->add_setting( 'textarea' );

	$wp_customize->add_section( 'wpp_home_text' , array(
		'title'       => __( 'Homepage Header Text', 'portfolio' ),
		'priority'    => 45,
		'description' => '',
		'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_control(
		new Example_Customize_Textarea_Control(
			$wp_customize,
			'textarea',
			array(
				'label' => '',
				'section' => 'wpp_home_text',
				'settings' => 'textarea'
			)
		)
	);

	// Add Social Media Section
	$wp_customize->add_section( 'social-media' , array(
		'title' => __( 'Social Media', 'portfolio' ),
		'priority' => 30,
		'description' => __( 'Enter the URL to your account for each service for the icon to appear in the header.',
			'portfolio' )
	) );
	// Add Twitter Setting
	$wp_customize->add_setting( 'twitter' , array( 'default' => '' , 'sanitize_callback' => 'esc_url_raw'));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
		'label' => __( 'Twitter', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'twitter',
	) ) );
	// Add Instagram Setting
	$wp_customize->add_setting( 'instagram' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram', array(
		'label' => __( 'Instagram', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'instagram',
	) ) );
	// Add Facebook Setting
	$wp_customize->add_setting( 'facebook' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
		'label' => __( 'Facebook', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'facebook',
	) ) );
	// Add Vimeo Setting
	$wp_customize->add_setting( 'vimeo' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo', array(
		'label' => __( 'Vimeo', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'vimeo',
	) ) );
	// Add Youtube Setting
	$wp_customize->add_setting( 'youtube' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube', array(
		'label' => __( 'YouTube', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'youtube',
	) ) );
	// Add Pinterest Setting
	$wp_customize->add_setting( 'pinterest' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest', array(
		'label' => __( 'Pinterest', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'pinterest',
	) ) );
	// Add Linkedin Setting
	$wp_customize->add_setting( 'linkedin' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin', array(
		'label' => __( 'LinkedIn', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'linkedin',
	) ) );
	// Add RSS Setting
	$wp_customize->add_setting( 'rss' , array( 'default' => '','sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss', array(
		'label' => __( 'RSS', 'portfolio' ),
		'section' => 'social-media',
		'settings' => 'rss',
	) ) );

}
add_action( 'customize_register', 'portfolio_customize_register' );

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function wpp_sanitize_hex_color( $color ) {
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
function wpp_add_customizer_css() {
	$color = wpp_sanitize_hex_color( get_theme_mod( 'wpp_border_color' ) );
	?>
	<!-- WP Portfolio customizer CSS -->
	<style>
		.site {
			border-color: <?php echo $color; ?>;
		}
	</style>
<?php }
add_action( 'wp_head', 'wpp_add_customizer_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolio_customize_preview_js() {
	wp_enqueue_script( 'portfolio_customizer', get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'portfolio_customize_preview_js' );
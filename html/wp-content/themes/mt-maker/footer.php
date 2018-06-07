<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package (mt) Maker Theme
 */
?>

	</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="left">
		<a href="<?php echo esc_url( __( 'http://mediatemple.net/', 'apollo' ) ); ?>" class="hosted">
				<img src="<?php echo get_template_directory_uri();?>/images/mt.png"></a>
	</div>
	<div class="middle">
		<div class="contact-info">
			<span class="email"><?php echo sanitize_email( get_theme_mod( 'email' ) ); ?></span>
			<span class="social"><?php echo maker_social_media();?></span>
			<span class="phone"><?php echo get_theme_mod( 'phone' ); ?></span>
		</div>
	</div>
	<div class="right">
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'apollo' ) ); ?>" class="powered">
			<img src="<?php echo get_template_directory_uri();?>/images/wp.png"></a>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

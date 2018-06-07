<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package portfolio
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p><?php _e( 'Hosted by: ', 'portfolio' );?><a href="<?php echo esc_url( __( 'http://mediatemple.net/', 'portfolio' ) ); ?>">
				<img src="<?php echo get_template_directory_uri();?>/images/mt-logo-wide-black.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Powered by: ', 'portfolio' );?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'portfolio' ) ); ?>">
				<img src="<?php echo get_template_directory_uri();?>/images/wordpress-logo.png"></a></p>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Exhibit
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<span class="hosted">
				<a href="<?php echo esc_url( __( 'http://mediatemple.net/', 'exhibit' ) ); ?>"><img src="<?php echo get_template_directory_uri() . '/images/hosted-by.png';?>"></a>
			</span>
			<span class="powered">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'exhibit' ) );?>"><img src="<?php echo get_template_directory_uri() . '/images/powered-by-wp.png';?>"></a>
			</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package enlighten
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<a href="<?php echo esc_url( __( 'http://mediatemple.net/', 'enlighten' ) ); ?>">
					<img src="<?php echo get_template_directory_uri();?>/images/mt.png"></a> |
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'enlighten' ) ); ?>">
				<img src="<?php echo get_template_directory_uri();?>/images/wp.png"></a>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

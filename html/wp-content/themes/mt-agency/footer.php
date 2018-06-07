<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Agency
 */
?>

	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			
			<div class="row">
				
				<?php get_sidebar(); ?>
				
			</div>
			
			<div class="row">
				
				<div class="col-xs-12">
				
					<div class="site-info">
						<span><?php _e( 'Hosted By: ', 'agency' ); ?> <a href="http://mediatemple.net/" rel="designer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mt-logo.png" alt="Media Temple"></a></span>
						<span><?php _e( 'Powered By: ', 'agency' ); ?> <a href="http://wordpress.org/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/wp-logo.png" alt="WordPress"></a></span>
					</div><!-- .site-info -->
				
				</div>
				
			</div>
			
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

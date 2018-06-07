<?php
/**
 * The template for displaying featured content
 *
 */
?>

<div id="featured-content" class="featured-content">

		<?php
		do_action( 'enlighten_featured_posts_before' );

		$featured_posts = enlighten_get_featured_posts();
		foreach ( (array) $featured_posts as $order => $post ) :
			setup_postdata( $post );

			// Include the featured content template.
			get_template_part( 'content', 'featured-post' );
		endforeach;

		do_action( 'enlighten_featured_posts_after' );

		wp_reset_postdata();
		?>

</div><!-- #featured-content .featured-content -->

<?php
/**
 * The template for displaying featured posts on the front page
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-image">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>">
			<?php
			// Output the featured image.
			if ( has_post_thumbnail() ) : {
					the_post_thumbnail( 'crafty-featured' );
				}
			endif;
			?>
		</a>
	</div>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
		<div class="entry-meta">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more" rel="bookmark"><?php _e( 'Read More', 'enlighten' ); ?></a>
		</div>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
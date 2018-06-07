<?php
/**
 * @package enlighten
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="featured-image">
		<?php the_post_thumbnail( 'crafty-post-thumb' );?>
	</div>
	<div class="post-content">
	<header class="entry-header">

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="category"><?php enlighten_categories(); ?></span><span class="date"><?php
			enlighten_posted_on(); ?></span>
		</div><!-- .entry-meta -->

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php enlighten_trimmed_content();?></p>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'enlighten' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
<?php
/**
 * @package (mt) Maker Theme
 */
?>
<div class="post-content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( !is_front_page() ) { ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</header><!-- .entry-header -->
	<?php }?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'maker-theme' ), 
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php maker_theme_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php maker_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>
<hr class="blog-separator">
<?php
/**
 * @package (mt) Maker Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="featured-image">
		<?php if( function_exists( the_post_thumbnail() ) ) {
			the_post_thumbnail();
		}?>
	</div>

	<?php
	if ( !is_front_page() ) { ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php maker_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php maker_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

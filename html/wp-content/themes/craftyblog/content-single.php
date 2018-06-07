<?php
/**
 * @package enlighten
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php enlighten_categories();?>
			<?php enlighten_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php the_post_thumbnail();?>
	<small class="thumbnail-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt;?></small>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'enlighten' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php enlighten_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php enlighten_count_post_views(get_the_ID());?>

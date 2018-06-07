<?php
/**
 * @package wp-portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="project-entry-content">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<div class="featured-image"><a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark"><?php the_post_thumbnail( 'home-portfolio' );?></a></div>

				<p class="entry-meta"><?php echo get_the_term_list( $post->ID, 'project_category', '', ',', '');?></p>

			<?php the_excerpt();?>
		</div>

</article><!-- #post-## -->

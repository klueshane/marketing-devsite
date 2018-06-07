<?php
/**
 * @package portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="project-entry-content">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<p><?php echo get_the_term_list( $post->ID, 'project_category', '', ',', '');?></p>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php echo $post->post_content;?>
		</div>
		<footer class="entry-footer">
		<?php wp_portfolio_entry_footer(); ?>
	</footer><!-- .entry-footer -->

			<?php
			$url = get_post_meta( $post->ID, '_cmb_project-url', true );
			if ($url != '') {
				$link = sprintf( __( '%s', 'wpp-portfolio' ), esc_url( $url ) );?>
				<p class="project-url"><a href="<?php echo $link;?>"><?php echo $url;?></a></p>
			<?php }
			?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wpp-portfolio' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	</div>

	<div class="project-images">
		<?php
		$images = get_post_meta( $post->ID, '_cmb_image_list', true );
		if($images != '') {
			foreach ( $images as $image ) { ?>
				<img src="<?php echo $image; ?>">
			<?php
			}
		}
		?>
	</div>
</article><!-- #post-## -->

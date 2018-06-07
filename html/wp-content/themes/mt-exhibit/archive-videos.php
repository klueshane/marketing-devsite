<?php
/**
 * The template for displaying video archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Exhibit
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					$post_id        = get_the_ID();
					$video_url      = get_post_meta( $post_id, 'ex_video_url' );
					$image          = wp_get_attachment_image( get_post_meta( $post_id, 'ex_video_image', 1 ), 'video' );
					$description    = get_post_meta( $post_id, 'ex_video_description', true );
					?>
					<?php if( $video_url != '') {?>
					<div class="featured-image">
						<a class="swipebox-video" href="<?php echo $video_url[0];?>">
						<div class="featured-overlay"></div>
						<?php echo $image;?>
						</a>
						<h3 class="post-title"><?php the_title();?></h3>
						<?php if( $description != '' ) {?>
							<div class="content"><?php echo $description;?></div>
						<?php } ?>
					</div>
				<?php } ?>
		</article>
			<?php endwhile; ?>
			<?php exhibit_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

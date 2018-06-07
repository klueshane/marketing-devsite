<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>
	<style type="text/css">
		.footer-content {
			display: none;
		}
	</style>
	<div id="about-page">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post page single" id="post-<?php the_ID(); ?>">
				<div class="wrap">
					<div class="post-content">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="half left">
							<?php the_post_thumbnail( 'about-img' ); ?>
							</div>
						<?php } ?>						
						<div class="about-text half">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
		</div>
		
		<?php endwhile; endif; ?>
	</div>

<?php get_footer(); ?>
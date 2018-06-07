<?php
/**
 * The template for displaying all single posts.
 *
 * @package portfolio
 */

get_header(); ?>

	<div id="primary" class="portfolio-content-area">
		<main id="main" class="site-main" role="main">

				<?php get_template_part( 'content', 'portfolio-single' ); ?>

				<?php //wp_portfolio_post_nav(); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
				?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
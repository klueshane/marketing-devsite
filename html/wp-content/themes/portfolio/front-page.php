<?php
/**
 * The template for displaying the front page (home) of the theme.
 *
 *
 * @package wp-portfolio
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="portfolio-grid">

			<?php echo wpp_homepage_grid();?>

		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

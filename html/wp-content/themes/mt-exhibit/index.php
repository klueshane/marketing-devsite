<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Exhibit
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( get_theme_mod( 'home_image' ) ) {
				esc_html( get_theme_mod( 'home_image' ) );
				 } else {
				echo '<div class="home-image"><img src= "' . get_template_directory_uri() . '/images/ocean.jpg' . '"></div>';
			} ?>

			<?php if ( get_theme_mod( 'image_caption' ) ) {
				echo esc_html( get_theme_mod( 'image_caption' ) );
			} else { ?>

			<div class="home-image-caption"><p><?php _e( 'Venice Beach' );?></p></div>

			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

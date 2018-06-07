<?php
/**
 * The template for displaying the single gallery posts.
 *
 * @package Exhibit
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<h1 class="post-title"><?php the_title();?></h1>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content();?>


		</article>


<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
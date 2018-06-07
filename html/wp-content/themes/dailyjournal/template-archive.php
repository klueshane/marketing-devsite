<?php 
/* Template Name: Archive */
get_header(); ?>
	<div class="single" id="archive">
	<section class="posts wrap">
	    <?php get_template_part( 'loop', 'index' );	?>
	</section>
	</div>

<?php get_footer(); ?>
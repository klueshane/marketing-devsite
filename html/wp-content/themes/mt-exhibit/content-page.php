<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Exhibit
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( 'Edit', 'exhibit' ), '<span class="edit-link">', '</span>' ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'exhibit' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class="featured-image">
		<?php the_post_thumbnail();?>
		<?php exhibit_contact_info();?>
	</div>
</article><!-- #post-## -->

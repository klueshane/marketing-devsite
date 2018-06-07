<?php
/**
 * The template for displaying the single gallery posts.
 *
 * @package Exhibit
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php $attachments = new Attachments( 'exhibit_attachments' ); /* pass the instance name */ ?>
	<div class="horizontal-slider">
	<?php if( $attachments->exist() ) : ?>
		<?php while( $attachments->get() ) : ?>

			<a class="swipebox" href="<?php echo $attachments->src( 'full' ); ?>">
			<?php echo $attachments->image( 'gallery' ); ?>
			</a>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
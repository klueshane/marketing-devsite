<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php $attachments = new Attachments( 'my_attachments' ); ?>
			<?php $count = -1; if( $attachments->exist() ) : ?>
			  <div id="project-list" class="individual-list">
			    <?php while( $attachments->get() ) : $count++; ?>
      			<div class="project-thumb">
      				<a href="#" data-slide="<?php echo $count; ?>">
      					<?php echo $attachments->image( 'portfolio-thumb' ); ?>
      				</a>
      			</div>
			    <?php endwhile; ?>
			  </div>
			<?php endif; ?>
			<?php $attachments = new Attachments( 'my_attachments' ); ?>
			<?php if( $attachments->exist() ) : ?>
			  <ul class="bxslider fullscreen-slider" style="opacity:0;">
			    <?php while( $attachments->get() ) : ?>
			      <li style="background-image:url(<?php echo $attachments->url(); ?>);">
			       <div class="caption">
			        <b><?php the_title(); ?></b> <?php echo $attachments->field( 'caption' ); ?>
			       </div>
			       <a href="#" class="return-sheet">Return to Sheet</a>
			      </li>
			    <?php endwhile; ?>
			  </ul>
			<?php endif; ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>

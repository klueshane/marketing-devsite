<?php get_header(); ?>

	<div id="default-page" class="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post page single" id="post-<?php the_ID(); ?>">
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-content">
          <div class="page-text half left">
  					<?php the_content(); ?>
  				</div>
					<div class="half">
  					<?php the_post_thumbnail( 'full' ); ?>
  					<?php 
  					  $twitter = get_theme_mod( 'Twitter' ); 
  					  $facebook = get_theme_mod( 'Facebook' );
  					  $instagram = get_theme_mod( 'Instagram' );
  					  $contact = get_theme_mod( 'email-address' );
  					 ?>
  					 <?php if ($twitter) { ?>
  					  <a href="<?php echo $twitter ?>" target="_blank" class="social-icon"><i class="fa fa-twitter"></i></a>
  					 <?php } ?>
  					 <?php if ($facebook) { ?>
  					  <a href="<?php echo $facebook ?>" target="_blank" class="social-icon"><i class="fa fa-facebook"></i></a>
  					 <?php } ?>
  					 <?php if ($instagram) { ?>
  					  <a href="<?php echo $instagram ?>" target="_blank" class="social-icon"><i class="fa fa-instagram"></i></a>
  					 <?php } ?>
  					 <?php if ($contact) { ?>
  					  <a href="<?php echo $$contact ?>" target="_blank" class="social-icon"><i class="fa fa-envelope"></i></a>
  					 <?php } ?>
					</div>
				</div>
				<?php } else { ?>		
				<div class="post-content no-image">				
  				<div class="page-text">
  					<?php the_content(); ?>
  				</div>
				</div>
				<?php } ?>
		</div>
		
		<?php endwhile; endif; ?>

	</div>

<?php get_footer(); ?>
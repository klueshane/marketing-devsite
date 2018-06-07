<?php
/**
 * The template for displaying all single posts.
 *
 * @package Agency
 */

get_header(); ?>

<?php if( have_posts() ) : ?>
		<section class="feature">
			
		<?php 
			
		if( has_post_thumbnail() ) : 
		
		the_post_thumbnail();
		
		elseif( get_theme_mod( 'agency_bg' ) ) : 
		
		echo '<img src="'. get_theme_mod( 'agency_bg' ) .'" alt="'. the_title() .'" class="featured-image">';
		
		else : 
		
		echo '<div class="header-spacer"></div>';
		
		endif;
			
		?>
		
		<div class="feature-overlay">
			
			<div class="container">
				
				<div class="row">
					
					<div class="col-xs-12">
			
						<div class="feature-content">
							
							<?php 
								
								$work_feature = get_post_meta( get_the_ID(), 'work_feature', true );
								
								if( ! empty( $work_feature ) ) :
								
								echo $work_feature;
								
								else :
								
								$content_id = get_theme_mod( 'featured_content', 1 );
									
									$args = array(
										'post_type'  		=> 'page',
										'p'					=> $content_id,
										'posts_per_page'	=> 1
									);
									
									$feature_query = new WP_Query( $args );
									
									if( $feature_query->have_posts() ) : while( $feature_query->have_posts() ) : $feature_query->the_post();
									
									the_content();
																		
									endwhile; endif;
									
									rewind_posts();
								
								endif;
								
							?>
							
						</div>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
		
	</section>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
					<?php while ( have_posts() ) : the_post(); ?>
			
						<?php get_template_part( 'content', 'single' ); ?>
			
					<?php endwhile; endif; // end of the loop. ?>
					
					<a href="<?php echo home_url('/'); ?>"><h4 class="back-home"><i class="fa fa-chevron-left"></i><?php _e( 'Back Home', 'agency' ); ?></h4></a>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

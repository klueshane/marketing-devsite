<?php
/**
 * The front page template file.
 *
 * @package Agency
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section id="work" class="work">
				
				<div class="container">
					
					<div class="row">
						
						<div class="col-xs-12">
														
							<?php 
								
							$work_id = get_theme_mod( 'work_page_dropdown' );
							
							$args = array(
							
								'p'					=>  $work_id,
								'post_type'  		=>  'page',
								'posts_per_page'  	=>  6	
							
							);
							
							$work_content_query = new WP_QUERY( $args );
							
							if( $work_content_query->have_posts() ) : while( $work_content_query->have_posts() ) : $work_content_query->the_post();
							
							the_content();
							
							endwhile; endif; 
							
							?>

							<div class="row">
								
								<?php $args = array(
									'post_type'  =>  'work',
									'posts_per_page'  =>  6	
								);
								
								$work_query = new WP_QUERY( $args );
								
								if( $work_query->have_posts() ) : ?>
							
								<?php while( $work_query->have_posts() ) : $work_query->the_post(); ?>
							
								
								<div class="col-xs-12 col-sm-6">
									
									<div <?php post_class( 'work-post' ); ?>>
									
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('work_thumbnail'); ?></a>
										
										<h3 class="-work-title"><?php the_title(); ?></h3>
										
										<?php the_excerpt(); ?>
									
									</div>
									
								</div>
								
								<?php endwhile; ?>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</section>
			
			<?php endif; ?>
			
			<section id="aboutUs" class="about-us">
				
				<div class="container">
					
					<div class="row">
						
						<div class="col-xs-12">
														
							<?php 
								
							$about_id = get_theme_mod( 'about_page_dropdown' );
							
							$args = array(
							
								'p'					=>  $about_id,
								'post_type'  		=>  'page',
								'posts_per_page'  	=>  6	
							
							);
							
							$about_content_query = new WP_QUERY( $args );
							
							if( $about_content_query->have_posts() ) : while( $about_content_query->have_posts() ) : $about_content_query->the_post();
							
							the_content();
							
							endwhile; endif; 
							
							?>
							
						</div>
						
						<?php 
							
						$args = array(
							'post_type'	=> 'team',	
						);
						
						$team_query = new WP_QUERY( $args );
						
						if( $team_query->have_posts() ) : while( $team_query->have_posts() ) : $team_query->the_post();
						
						?>
						
						<div class="col-xs-12 col-sm-6 col-md-3">
							
							<div class="team-item">
							
								<?php 
									
								if( has_post_thumbnail() ) : 
								
								the_post_thumbnail();
								
								endif;
								
								echo '<h4 class="team-title">'. get_the_title() .'</h4>';
								
								the_content();
								
								?>
							
							</div>
							
						</div>
						
						<?php endwhile; endif; ?>
						
					</div>
					
				</div>
				
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

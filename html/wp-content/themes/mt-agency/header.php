<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Agency
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<style>
	.menu a:hover, .current_page_parent a, .current-page-item a {
		color: <?php echo get_theme_mod( 'accent_color', '#ffc600' ); ?>;
	}
	
	.fa {
		color: <?php echo get_theme_mod( 'accent_color', '#ffc600' ); ?>;
	}
	
	button {
		background: <?php echo get_theme_mod( 'accent_color', '#ffc600' ); ?>;
	}
	
	.blog .hentry {
		border-bottom: 15px solid <?php echo get_theme_mod( 'accent_color', '#ffc600' ); ?>;
	}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'agency' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="site-branding">
						<?php if ( get_theme_mod( 'agency_logo' ) ) : ?>
						    <div class='site-logo'>
						        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'agency_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' width="70" height="70"></a>
						    </div>
						<?php else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php endif; ?>
					</div><!-- .site-branding -->
			
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'agency' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->
					<div class="clearfix">
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		
		<?php if( !is_single() ) : ?>
		
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
									
								?>
								
							</div>
						
						</div>
					
					</div>
				
				</div>
			
			</div>
			
		</section>

		<?php endif; ?>
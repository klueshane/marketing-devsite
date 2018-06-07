<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package enlighten
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'skiplinks' ); ?>

<div id="page" class="hfeed site">

<?php apply_filters( 'enlighten_before_header_role', '' ); ?>

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label='<?php _e( 'Primary Menu ', 'enlighten' ); ?>'>
			<h1 class="screen-reader-text"><?php _e( 'Primary Menu', 'enlighten' ); ?></h1>

			<a id="right-menu" class="sidr-menu" href="#right-menu"></a>

				<?php wp_nav_menu( array(
					'theme_location'    => 'primary',
					'container'         => 'div',
					'container_id'      => 'sidr-right',
					'container_class'   => 'sidr right',
					'items_wrap'        => '<ul>%3$s</ul>',
					'fallback_cb'       => 'wp_page_menu',
				) ); ?>


		</nav><!-- #site-navigation -->

			<?php if ( get_theme_mod( 'enlighten_logo' ) ) : ?>
				<div class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( get_theme_mod( 'enlighten_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div>
			<?php else : ?>
				<hgroup class="identity">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php endif; ?>


	</header><!-- #masthead -->

	<div id="content" class="site-content" tabindex="-1">
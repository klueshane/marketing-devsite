<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,<?php bloginfo( 'html_type' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

    ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=2012062" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" type="text/css" media="screen" />

    <?php wp_head(); ?>

    <?php if( is_single() || is_home() ){
        global $post;

        if( is_home() ){
            $posts = get_posts('numberposts=1');
            $post = $posts[0];
        }

        $nav_link_color = get_post_meta($post->ID, '_nav_link_color', true);

        if( $nav_link_color && $nav_link_color != '#' ){ ?>
            <style type="text/css">
                article.single a{
                    color: <?php echo $nav_link_color; ?>;
                }
            </style>
        <?php }
    } ?>

		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<body <?php body_class(); ?>>

    <header class="primary nav">
    		<div class="mobile-only mobile-nav">
    			 <?php wp_nav_menu( array('menu_class' => 'mobile-nav-container', 'container' => 'nav', 'theme_location' => 'main_menu' ) ); ?>
    		</div>
        <div class="wrap">
            <a href="<?php bloginfo('url'); ?>"><h1 class="blog-name"><?php echo bloginfo( 'name' ); ?></h1></a>
						<a href="#" class="mobile-icon mobile-only"><i class="fa fa-bars"></i></a>
            <?php wp_nav_menu( array('menu_class' => 'nav-container', 'container' => 'nav', 'theme_location' => 'main_menu' ) ); ?>
        </div><!-- #wrap -->
    </header>
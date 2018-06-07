<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
		<title>
			<?php if (is_home() || is_front_page()) { echo bloginfo('name');
			} elseif (is_404()) {
			echo '404 Not Found';
			} elseif (is_category()) {
			echo 'Category:'; wp_title('');
			} elseif (is_search()) {
			echo 'Search Results';
			} elseif ( is_day() || is_month() || is_year() ) {
			echo 'Archives:'; wp_title('');
			} else {
			echo wp_title('');
			}
			?>
		</title>

		<meta name="viewport" content="width=device-width">
		<?php if(is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	    <?php }?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!--[if lt IE 9]>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--> 
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
		<style>
			body {background-color:  #<?php $background_color = get_background_color(); echo $background_color; ?>;}
			header.primary {background-color:  #<?php $background_color = get_background_color(); echo $background_color; ?>;}
			#intro-slide {background-image: url(<?php echo esc_url( get_theme_mod( 'default-image' ) ); ?>)};
		</style>
		<?php if ( is_user_logged_in() ) { ?>
		 <style type="text/css">header.primary {top: 32px !important;} .bx-wrapper {top: -32px;}</style>
		<?php } // end if ?>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>> 
		<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<?php if ( is_home() ) { ?>
			<header class="primary transparent">
		<?php } else { ?>
			<header class="primary">
		<?php } ?>
			<div class="mobile-only mobile-nav">
				<div class="mobile-nav-container">
					<ul>
						<?php if ( is_home() ) { ?>
						<li><a href="#" class="scroll" data-section="projects">Projects</a></li>
						<?php } else { ?>
						<li><a href="<?php bloginfo('url'); ?>/#projects">Projects</a></li>
						<?php } ?>
						<?php wp_list_pages('title_li='); ?>
					</ul>
				</div>
			</div>
			<a href="<?php bloginfo('url'); ?>"><b><span class="site-name"><?php bloginfo( 'name' ); ?></span></b> <span class="site-description"><?php bloginfo( 'description' ); ?></span></a>
			<a href="#" class="mobile-icon mobile-only"><i class="fa fa-bars"></i></a>
			<div class="nav-container">
				<ul>
					<?php if ( is_home() ) { ?>
					<li><a href="#" class="scroll" data-section="projects">Projects</a></li>
					<?php } else { ?>
					<li><a href="<?php bloginfo('url'); ?>/#projects" class="transition">Projects</a></li>
					<?php } ?>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</div>
	  </header>

<?php /* Template Name: Home Page */ ?>
<!--

Come be the extra hands we need or if you think you have the skills,
come join our web (app.klue.com) or native mobile app teams!
https://angel.co/klue

-->
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/screen.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets-home2/css-dist/main.css">

        <link href="<?php echo get_template_directory_uri() ?>/assets/css-standalone/plugin.css" rel="stylesheet">
  
<?php
  // Output document title
  if(defined("TITLE") && TITLE) {
    echo '<title>' . htmlentities(TITLE) . '</title>';
  }
  else if(WP_DEBUG && !is_page()) {
    echo "<h1>page needs TITLE</h1>";
  } else {
    echo '<title>';
    wp_title();
    echo '</title>';
  }
?>

<?php
  if(defined("DESCRIPTION")) {
    echo '<meta name="description" content="' . htmlentities(str_replace('"','\'', DESCRIPTION)) . '" />';
  }
?>
        <!-- wp_head -->
        <?php wp_head(); ?>
        <!-- /wp_head -->

        <?php include get_template_directory() . '/template-includes/header-meta-icons.php'; ?>

        <script src="https://use.typekit.net/xui2xju.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>

        <script type="text/javascript">
          setTimeout(function(){var a=document.createElement("script");
          var b=document.getElementsByTagName("script")[0];
          a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0069/2758.js?"+Math.floor(new Date().getTime()/3600000);
          a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
        </script>
    </head>
    <body class="page--home">

        <section class="header">

           
            <div class="header__header-corset">
              <img class="header-corset__header-logo" src="<?php echo get_template_directory_uri(); ?>/assets-home2/img/logo-klue.svg">
              <div class="wrap">
                <ul class="header-corset__header-nav"><li class="header-nav__header-nav-item"><a href="http://app.klue.com" class="button button--nav-item button--green-solid">Get Started</a></li></ul><?php wp_nav_menu( array(menu => 'Main Nav', menu_class => 'header-corset__header-nav')); ?>
               
              </div><!-- .wrap -->
            </div><!-- .navigation-top -->
           
          </div>
          <a href="#" class="button--nav button button--green-solid">Nav</a>

          <h1 class="header__heading">
            <?php if(get_field('home-tagline')): ?><?php the_field('home-tagline'); ?><?php endif; ?>
          </h1>

          <video playsinline autoplay preload muted id="header-video" class="autoplay" video-name="header-video" style="user-select: none">
            <script>
            (function() {
              var fileName = window.innerWidth && window.innerWidth < 800 ? 'header-video-mobile' : 'header-video';
              document.write("<source type='video/mp4' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/" + fileName + ".mp4' />");
              document.write("<source type='video/webm' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/" + fileName + ".webm' />");
            })();
            </script>
          </video>

          <video playsinline autoplay preload muted class="header__background">
            <source type='video/mp4' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/header-background-repeating.mp4' />
            <source type='video/webm' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/header-background-repeating.webm' />
          </video>
          <div class="header__background-bar">
            <video playsinline autoplay preload muted class="background-bar__video">
              <source type='video/mp4' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/header-background-bar.mp4' />
              <source type='video/webm' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/header-background-bar.webm' />
            </video>
          </div>
        </section>

        <section class="three-column">
          <h1 class="subheading">
            <?php if(get_field('home-subheading')): ?><?php the_field('home-subheading'); ?><?php endif; ?>
          </h1>

          <ul class="three-column__column-list">
            <li class="column-list__column-item column-list__column-item--uptodate">
              <h1 class="column-item__column-heading"><?php if(get_field('home-3cols-1-heading')): ?><?php the_field('home-3cols-1-heading'); ?><?php endif; ?></h1>
              <p class="column-item__column-paragraph"><?php if(get_field('home-3cols-1-text')): ?><?php the_field('home-3cols-1-text'); ?><?php endif; ?></p>
            </li>
            <li class="column-list__column-item column-list__column-item--awareness">
              <h1 class="column-item__column-heading"><?php if(get_field('home-3cols-2-heading')): ?><?php the_field('home-3cols-2-heading'); ?><?php endif; ?></h1>
              <p class="column-item__column-paragraph"><?php if(get_field('home-3cols-2-text')): ?><?php the_field('home-3cols-2-text'); ?><?php endif; ?></p>
            </li>
            <li class="column-list__column-item column-list__column-item--oneplace">
              <h1 class="column-item__column-heading"><?php if(get_field('home-3cols-3-heading')): ?><?php the_field('home-3cols-3-heading'); ?><?php endif; ?></h1>
              <p class="column-item__column-paragraph"><?php if(get_field('home-3cols-3-text')): ?><?php the_field('home-3cols-3-text'); ?><?php endif; ?></p>

            </li>
          </ul>
        </section>


        <section class="overlap-panel overlap-panel--worksanywhere">
          <div class="panel">
            <h1 class="heading heading--black"><?php if(get_field('home-anywhere-heading')): ?><?php the_field('home-anywhere-heading'); ?><?php endif; ?></h1>
            <p class="description"><?php if(get_field('home-anywhere-text')): ?><?php the_field('home-anywhere-text'); ?><?php endif; ?></p>
            <a href="http://app.klue.com" class="button button--green">Get Started</a>
          </div>
        </section>

        <section class="one-column">
          <h1 class="subheading subheading--one-column "><?php if(get_field('home-workflow-section-heading')): ?><?php the_field('home-workflow-section-heading'); ?><?php endif; ?></h1>

          <ul class="one-column__column-list">
            <li class="one-column-list__one-column-item one-column-list__column-item--collect">
              <h1 class="one-column-item__column-heading heading heading--black"><?php if(get_field('home-workflow-1-heading')): ?><?php the_field('home-workflow-1-heading'); ?><?php endif; ?></h1>
              <p class="column-list__list-paragraph"><?php if(get_field('home-workflow-1-text')): ?><?php the_field('home-workflow-1-text'); ?><?php endif; ?></p>
            </li>
            <li class="one-column-list__one-column-item one-column-list__column-item--curate">
              <h1 class="one-column-item__column-heading heading heading--black"><?php if(get_field('home-workflow-2-heading')): ?><?php the_field('home-workflow-2-heading'); ?><?php endif; ?></h1>
              <p class="column-list__list-paragraph"><?php if(get_field('home-workflow-2-text')): ?><?php the_field('home-workflow-2-text'); ?><?php endif; ?></p>
            </li>
            <li class="one-column-list__one-column-item one-column-list__column-item--consume">
              <h1 class="one-column-item__column-heading heading heading--black"><?php if(get_field('home-workflow-3-heading')): ?><?php the_field('home-workflow-3-heading'); ?><?php endif; ?></h1>
              <p class="column-list__list-paragraph"><?php if(get_field('home-workflow-3-text')): ?><?php the_field('home-workflow-3-text'); ?><?php endif; ?></p>
            </li>
          </ul>
        </section>


        <section class="secondary-video">
          <h1 class="secondary-video__heading"><?php if(get_field('home-video-text')): ?><?php the_field('home-video-text'); ?><?php endif; ?></h1>
          <video playsinline autoplay loop preload muted id="secondary-video__video" class="autoplay" video-name="secondary-video">
            <source type='video/mp4' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/secondary-video.mp4' />
            <source type='video/webm' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/secondary-video.webm' />
          </video>
          <video playsinline autoplay preload muted class="header__background">
            <source type='video/mp4' src='<?php echo get_template_directory_uri(); ?>/assets-home2/img/header-background-repeating.mp4' />
          </video>

        </section>


        <section class="stretching-combo">
            <div class="stretching-combo__feature stretching-combo--left feature--green">
              <div class="feature__corset feature__corset--left">
                <h1 class="heading corset__heading"><?php if(get_field('home-green-panel-heading')): ?><?php the_field('home-green-panel-heading'); ?><?php endif; ?></h1>
                <p class="description description--feature description--feature--green"><?php if(get_field('home-green-panel-text')): ?><?php the_field('home-green-panel-text'); ?><?php endif; ?></p>
                <a href="http://app.klue.com" class="button button--feature">Get Started</a>
              </div>
            </div>
            <div class="testimonial stretching-combo--right">
              <div class="testimonial__elastic testimonial__elastic--right">
                <?php if(get_field('home-testimo-1-logo')): ?>
                  <?php site_image(get_field('home-testimo-1-logo'),array('w'=>400,'h'=>100,'class'=>"testimonial__logo")); ?>
                <?php endif; ?>
                <p class="elastic__heading"><?php if(get_field('home-testimo-1-tagline')): ?><?php the_field('home-testimo-1-tagline'); ?><?php endif; ?></p>
                <?php if(get_field('home-testimo-1-person')): ?>
                  <?php site_image(get_field('home-testimo-1-person'),array('w'=>200,'h'=>200,'class'=>"testimonial__avatar")); ?>
                <?php endif; ?>
                <p class="elastic__quote">"<?php if(get_field('home-testimo-1-quote')): ?><?php the_field('home-testimo-1-quote'); ?><?php endif; ?>”</p>
                <p class="elastic__attribution"><?php if(get_field('home-testimo-1-cite')): ?><?php the_field('home-testimo-1-cite'); ?><?php endif; ?></p>
              </div>
            </div>
        </section>
        <section class="stretching-combo">
            <div class="stretching-combo__feature stretching-combo--right feature--purple">
              <div class="feature__corset feature__corset--right">
                <h1 class="heading corset__heading"><?php if(get_field('home-purple-panel-heading')): ?><?php the_field('home-purple-panel-heading'); ?><?php endif; ?></h1>
                <p class="description description--feature description--feature--purple"><?php if(get_field('home-purple-panel-text')): ?><?php the_field('home-purple-panel-text'); ?><?php endif; ?></p>
                <a href="http://app.klue.com" class="button button--feature">Get Started</a>
              </div>
            </div>
            <div class="testimonial stretching-combo--left">
              <div class="testimonial__elastic testimonial__elastic--left">
                <?php if(get_field('home-testimo-2-logo')): ?>
                  <?php site_image(get_field('home-testimo-2-logo'),array('w'=>400,'h'=>100,'class'=>"testimonial__logo")); ?>
                <?php endif; ?>
                <p class="elastic__heading"><?php if(get_field('home-testimo-2-tagline')): ?><?php the_field('home-testimo-2-tagline'); ?><?php endif; ?></p>
                <?php if(get_field('home-testimo-2-person')): ?>
                  <?php site_image(get_field('home-testimo-2-person'),array('w'=>200,'h'=>200,'class'=>"testimonial__avatar")); ?>
                <?php endif; ?>
                <p class="elastic__quote">"<?php if(get_field('home-testimo-2-quote')): ?><?php the_field('home-testimo-2-quote'); ?><?php endif; ?>"</p>
                <p class="elastic__attribution"><?php if(get_field('home-testimo-2-cite')): ?><?php the_field('home-testimo-2-cite'); ?><?php endif; ?></p>
              </div>
            </div>
        </section>
        <section class="stretching-combo">
            <div class="stretching-combo__feature stretching-combo--left feature--grey">
              <div class="feature__corset feature__corset--left">
                <h1 class="heading corset__heading"><?php if(get_field('home-grey-panel-heading')): ?><?php the_field('home-grey-panel-heading'); ?><?php endif; ?></h1>
                <p class="description description--feature description--feature--grey"><?php if(get_field('home-grey-panel-text')): ?><?php the_field('home-grey-panel-text'); ?><?php endif; ?></p>
                <a href="http://app.klue.com" class="button button--feature">Get Started</a>
              </div>
            </div>
            <div class="testimonial stretching-combo--right">
              <div class="testimonial__elastic testimonial__elastic--right">
                <?php if(get_field('home-testimo-3-logo')): ?>
                  <?php site_image(get_field('home-testimo-3-logo'),array('w'=>400,'h'=>100,'class'=>"testimonial__logo")); ?>
                <?php endif; ?>
                <p class="elastic__heading"><?php if(get_field('home-testimo-3-tagline')): ?><?php the_field('home-testimo-3-tagline'); ?><?php endif; ?></p>
                <?php if(get_field('home-testimo-3-person')): ?>
                  <?php site_image(get_field('home-testimo-3-person'),array('w'=>200,'h'=>200,'class'=>"testimonial__avatar")); ?>
                <?php endif; ?>
                <p class="elastic__quote">"<?php if(get_field('home-testimo-3-quote')): ?><?php the_field('home-testimo-3-quote'); ?><?php endif; ?>”</p>
                <p class="elastic__attribution"><?php if(get_field('home-testimo-3-cite')): ?><?php the_field('home-testimo-3-cite'); ?><?php endif; ?></p>
              </div>
            </div>
        </section>


        <section class="center-panel center-panel--contact">
          <div class="center-panel__content">
            <?php if(get_field('home-cta-image')): ?>
              <?php site_image(get_field('home-cta-image'),array('w'=>200,'h'=>200, 'class'=>'testimonial__avatar panel__avatar')); ?>
            <?php endif; ?>
            <h1 class="heading heading--black"><?php if(get_field('home-cta-heading')): ?><?php the_field('home-cta-heading'); ?><?php endif; ?></h1>
            <p class="description description--content"><?php if(get_field('home-cta-text')): ?><?php the_field('home-cta-text'); ?><?php endif; ?></p>

            <div class="slideshow">
              <?php while ( have_rows('home-cta-slides') ) : the_row(); ?>
                <?php if(get_sub_field('home-cta-slides-image')): ?>
                  <div><?php site_image(get_sub_field('home-cta-slides-image'),array('w'=>600,'h'=>400)); ?></div>
                <?php endif; ?>
              <?php endwhile; ?>
            </div>

            <form class="form" action="?klue-form=demo&cta=free-battlecard" method="post">
              <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('demo'); ?>">
              <input type="hidden" name="_form" value="Footer Form">
              <input class="form__input" type="text" value="" name="company" placeholder="Company Name">
              <input class="form__input" type="text" value="" name="name" placeholder="Name">
              <input class="form__input" type="email" value="" name="email" placeholder="Email Address">
              <input class="button button--green-solid button--contact" type="submit" value="Request Demo">
            </form>
          </div>
        </section>

<?php get_footer(); ?>

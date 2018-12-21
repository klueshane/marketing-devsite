<!--

Come be the extra hands we need or if you think you have the skills,
come join our web (app.klue.com) or native mobile app teams!
https://angel.co/klue

-->
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<!-- Styles (should be compiled into one) -->
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/stylesheets/screen.css?v=8' type='text/css' media='all' />

<script type="text/javascript">
  setTimeout(function(){var a=document.createElement("script");
  var b=document.getElementsByTagName("script")[0];
  a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0069/2758.js?"+Math.floor(new Date().getTime()/3600000);
  a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>

<script src="https://use.typekit.net/xui2xju.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
  <!-- Icons -->
        <meta name="msapplication-TileColor" content="#414143" />
        <meta name="msapplication-TileImage" content="https://klue.com/content/themes/klue/assets/images/favicon/ms-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="60x60" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="https://klue.com/content/themes/klue/assets/images/favicon/apple-icon-180x180.png" />
        <link rel="icon" type="image/png" sizes="192x192"  href="https://klue.com/content/themes/klue/assets/images/favicon/android-icon-192x192.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="https://klue.com/content/themes/klue/assets/images/favicon/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="https://klue.com/content/themes/klue/assets/images/favicon/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="https://klue.com/content/themes/klue/assets/images/favicon/favicon-16x16.png" />

        <!-- Global site tag (gtag.js) - Google Ads: 925652625 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-925652625"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-925652625'); </script>
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '376052022940493'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
         <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=376052022940493&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
</head>
<body <?php body_class(); ?>>
  <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->


  <section class="header <?php echo /* blog section */is_home() || is_post_type_archive('post') ? 'header--blog' : ''; echo is_singular('post') ? 'header--post' : '';?>" style="background-image: url('<?php $header_background = get_field('header_background'); if( !empty($header_background) ): echo $header_background['url']; endif; ?>');">

    <div class="header__header-sinch">
      <?php $current_path = trim(explode('?', strtolower($_SERVER['REQUEST_URI']))[0], '/'); ?>
      <a href="/"><img class="header-sinch__header-logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-klue.svg"></a>
      <ul class="header-sinch__header-nav">
        <li class="header-nav__header-nav-item <?php echo $current_path == 'about' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/about/">About Us</a></li>
        <li class="header-nav__header-nav-item <?php echo /* blog section */is_home() || is_category() || is_post_type_archive('post') || is_singular('post') ? 'header-nav__header-nav-item--current' : ''; ?>"><a href="/blog/">Blog</a></li>
        <li class="header-nav__header-nav-item <?php echo $current_path == 'competitive-strategy-resources' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/competitive-strategy-resources/">Resources</a></li>
        <li class="header-nav__header-nav-item <?php echo $current_path == 'contact' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/contact/">Contact</a></li>
        <li class="header-nav__header-nav-item header-nav__header-nav-item--login"><a href="https://app.klue.com/">Login</a></li>
        <li class="header-nav__header-nav-item"><a href="https://app.klue.com" class="button button--nav-item button--green-solid button--demo">Get a demo</a></li>
      </ul>
      <?php if(get_field('header_label')): ?><span class="heading__wrapper"><h1 class="header__heading"><?php the_field('header_label'); ?></h1></span><?php endif; ?>
    </div>
    <a href="#" class="button--nav button button--green-solid">Nav</a>

    <?php if (/* blog section */is_home() || is_category() || is_post_type_archive('post') || is_singular('post')) { ?>
      <div class="blognav">
        <ul class="blognav__catlist">
          <?php
            $cat_arguments = array(
                'orderby' => 'name',
                'parent' => 0,
                'exclude' => 45,
                );
              $categories = get_categories($cat_arguments);
              foreach($categories as $category) {
                if($cat != $category->term_id) { echo '<li class="catlist__item"><a class="catlist__link" href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a></li>'; }
                else { echo '<li class="catlist__item"><a class="catlist__link catlist__link--current" href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a></li>'; }
              }?>

        </ul>
        <a href="#" class="button button--green button--subscribe button--subscribe-blog">Subscribe to blog</a>
      </div>
    <? } ?>
  </section>

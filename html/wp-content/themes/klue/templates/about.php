
<?php /* Template Name: About Page */ ?>
<?php get_header(); ?>

<section class="intro">
  <div class="intro__box">

      <?php if(get_field('main_video')):
        $vimeo_value = get_field('main_video');
        $vimeo_video_id = substr($vimeo_value, strrpos($vimeo_value, '/')+1); // get just the id
        $vimeo_xml_file = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_video_id.php")); // get the video data from the API
        $vimeo_video_width = $vimeo_xml_file[0]['width'];
        $vimeo_thumbnail_large = $vimeo_xml_file[0]['thumbnail_large']; // load up one of the image sizes
        if($vimeo_video_width < 1280) {
        	$vimeo_thumbnail = $vimeo_thumbnail_large;
        } else {
        	$vimeo_thumbnail = str_replace('_640.jpg', '_1280.jpg', $vimeo_thumbnail_large); // replace the size with the size we want
        }
      ?>
        <div class="intro__video" data-video="<?php the_field('main_video'); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>//assets/img/icon-play.png), linear-gradient(rgba(87, 80, 106, 0.61),rgba(87, 80, 106, 0.61)), url(<?php echo $vimeo_thumbnail ?>) ;"></div>
      <?php endif; ?>

      <span class="headding__wrapper"><h1 class="intro__heading"><?php if(get_field('about_heading')): ?><?php the_field('about_heading'); ?><?php endif; ?></h1></span>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
  </div>
</section>

<section class="competitors">
  <div class="competitors__box">
    <?php while ( have_rows('competitors') ) : the_row(); ?>
      <h1 class="section__heading section__heading--competitors"><?php if(get_sub_field('headline')): ?><?php the_sub_field('headline'); ?><?php endif; ?></h1>
    <div class="section__columns">
      <?php if(get_sub_field('content')): ?><?php the_sub_field('content'); ?><?php endif; endwhile; ?>
    </div>
  </div>
</section>
<section class="greenbar"></section>
<section class="awards">
  
  <div class="awards__box">
    <h1 class="heading heading--awards">Our Awards</h1>
    <p>Here's a peak at Klue's trophy self. We are humbled to have been selected as the recipient of so many prestigious awards.</p>
   <?php $images = get_sub_field('awards');

  if( $images ): ?>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

  </div>
</section>

<?php while ( have_rows('founders') ) : the_row(); ?>
<section class="overlay" style="background-image: url('<?php $founders_image = get_sub_field('founders_image'); if( !empty($founders_image) ): echo $founders_image['url']; endif; ?>');">
  <h1 class="overlay__heading overlay__heading--founded">Klue was founded by 15+ year industry veterans <em><a href="https://www.linkedin.com/in/onemoresmith/" target="_blank">Jason Smith</a></em> and <em><a href="https://www.linkedin.com/in/sarathyg/" target="_blank">Sarathy Naicker</a></em> in 2015.</h1>
</section>
<?php endwhile; ?>


<section class="team">

  <?php if(get_field('about-team-heading')): ?><h1 class="heading heading--team"><?php the_field('about-team-heading'); ?></h3><?php endif; ?>
  <ul class="team__list">
    <?php while ( have_rows('about_team') ) : the_row(); ?>
    <li class="team__member">
      <?php site_image(get_sub_field('team_image'),array('w'=>300,'h'=>300,'class'=>'team__avatar')); ?>
        <?php if(get_sub_field('team_image')): ?>
          <div class="team-people-profile_image">

            <?php if( ($_SERVER['REMOTE_ADDR'] === '24.80.212.135' || WP_DEBUG) && get_sub_field('team_name') && ($name_slug = strtolower(explode(' ', (string) get_sub_field('team_name'))[0])) && file_exists(get_template_directory() . ($path = '/assets/images/team/' . $name_slug . '-alt.jpg'))): ?>
              <!--img src="<?php echo get_template_directory_uri() . $path; ?>" class="team-people-profile_image_easter" /-->
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if(get_sub_field('team_name')): ?><p class="team__name"><?php the_sub_field('team_name'); ?></p><?php endif; ?>
        <?php if(get_sub_field('team_role')): ?><p class="team__title"><?php the_sub_field('team_role'); ?></p><?php endif; ?>
        <section class="modal">
          <div class="modal__container">
            <div class="modal__info">
              <?php if(get_sub_field('team_name')): ?><h1 class="modal__heading"><?php the_sub_field('team_name'); ?></h1><?php endif; ?>
              <?php if(get_sub_field('team_fun_bio')): ?><p class="modal__description"><?php the_sub_field('team_fun_bio'); ?></p><?php endif; ?>
              <a class="modal__closer" href="#">Close</a>
            </div>
            <?php site_image(get_sub_field('team_fun_image'),array('w'=>600,'h'=>600,'class'=>'modal__image')); ?>
          </div>
        </section>
    </li>
    <?php endwhile; ?>

    <li class="team__member">
      <img class="team__avatar team__avatar--join" src="/wp-content/themes/klue/assets/img/about-join.png">
      <a class="team__join button button--green-solid" href="/jobs/">Join our team</a>
    </li>
  </ul>
</section>

<?php while ( have_rows('investors_block') ) : the_row(); ?>
<section class="overlay" style="background-image: url('<?php $about_investors_background = get_sub_field('investors_image'); if( !empty($about_investors_background) ): echo $about_investors_background['url']; endif; ?>');">

  <h1 class="overlay__heading"><em><?php if(get_sub_field('about_investors_heading')): ?><?php the_sub_field('about_investors_heading'); ?><?php endif; ?></em></h1>
  <ul class="investors__list">
    <?php while ( have_rows('about-investors') ) : the_row(); ?>
      <?php if(get_sub_field('about-invest-image')): ?>
        <li class="investors__item">
          <?php site_image(get_sub_field('about-invest-image'),array('w'=>300,'h'=>150,'class'=>'investors_logo')); ?>
        </li>
      <?php endif; ?>
    <?php endwhile; ?>
  </ul>
</section>
<?php endwhile; ?>

<?php get_template_part( 'template-parts/footer', 'page' ); ?>

<?php get_footer(); ?>

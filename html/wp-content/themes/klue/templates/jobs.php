
<?php /* Template Name: Jobs Page */ ?><?php
define("TITLE", "Klue - Jobs / Careers");
define("DESCRIPTION", "Current Job Openings at Klue");
?>
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

          <?php if(get_field('foo_bar')): ?><h1 class="intro__heading"><?php the_field('foo_bar'); ?></h1><?php endif; ?>
          <?php if(get_field('foo_content')): ?><p><?php the_field('foo_content'); ?></p>
          <?php endif; ?>
        </div>
      </section>

      <ul class="jobsimages">
        <?php while ( have_rows('images_top') ) : the_row(); ?>
          <?php if(get_sub_field('image_top')): ?>
            <li class="jobsimages__item">
              <?php site_image(get_sub_field('image_top'),array('w'=>800,'h'=>380,'class'=>'workingat__image')); ?>
            </li>
          <?php endif; ?>
        <?php endwhile; ?>
      </ul>

      <section class="workingat">
        <div class="workingat__box">
          <?php if( have_rows('jobs-secondary') ): while( have_rows('jobs-secondary') ): the_row(); ?>
          <h1 class="section__heading"><?php if(get_sub_field('jobs_secondary_heading')): ?><?php the_sub_field('jobs_secondary_heading'); ?><?php endif; ?></h1>
          <div class="section__columns">
            <?php if(get_sub_field('jobs_secondary_content')): ?><?php the_sub_field('jobs_secondary_content'); ?><?php endif; ?>
          </div>
        <?php endwhile; endif; ?>
        </div>
      </section>


      <ul class="jobsimages">
        <?php while ( have_rows('images_top') ) : the_row(); ?>
          <?php if(get_sub_field('image_top')): ?>
            <li class="jobsimages__item">
              <?php site_image(get_sub_field('image_top'),array('w'=>800,'h'=>380,'class'=>'workingat__image')); ?>
            </li>
          <?php endif; ?>
        <?php endwhile; ?>
      </ul>

      <div class="jobs__listing">
        <h1 class="section__heading section__heading--jobs">Current Openings</h1>
        <script data-startup="klue" src="https://angel.co/javascripts/embed_jobs.js" id="angellist_embed" async></script>
      </div>


<?php get_footer(); ?>

<?php /* Template Name: Resources Page */ ?>
<?php get_header(); ?>


<section class="intro">
    <div class="intro__box">
      <?php if(get_field('resources-banner-label')): ?><h1 class="intro__heading"><?php the_field('resources-banner-label'); ?></h1><?php endif; ?>
          <?php if(get_field('resources-banner-text')): ?><p><?php the_field('resources-banner-text'); ?></p><?php endif; ?>
     
      <a href="#" class="button button--green button--subscribe button--blogitems" style="left: 0;">Subscribe to Resources</a>
    </div>
  </section>

  <section class="resources">

      <ul class="resources__columns">

        <?php while ( have_rows('resource_items') ) : the_row(); ?>
          <?php while ( have_rows('resource_item') ) : the_row(); ?>

            <li class="<?php if(get_sub_field('resource_type') == "Document"): ?>resources__item<?php else: ?>webinars__item<?php endif; ?>">

              <?php if(get_sub_field('resource_title')): ?><h1 class="section__heading"><?php the_sub_field('resource_title'); ?></h1><?php endif; ?>
              
              <?php if(get_sub_field('resource_label')){ 
                $resource_file = get_sub_field('resource_file'); 
                $resource_link = get_sub_field('resource_link');
                var_dump($resource_link); 
              ?><a class="button 
              <?php if(get_sub_field('resource_label') == "Watch Webinar"){ ?> button--webinar <?php } else { ?> button--ebook <?php }?> button--green-solid" modal-data="" href="#"
              <?php 
              if( $resource_file ){ ?>

                data-location="<?php echo $resource_file['url']; ?>" <?php 
                } elseif( $resource_link )
                { ?>
                  data-location="<?php echo $resource_link['url']; ?>" <?php 
                } ?> data-title="<?php echo the_sub_field('resource_label'); ?>">

                <?php if(get_sub_field('resource_label') == "Watch Webinar"){ ?><i class="fa fa-play-circle" aria-hidden="true"></i><?php } 
                      else { ?><i class="fa fa-download" aria-hidden="true"></i><?php } ?>
              <?php echo the_sub_field('resource_label'); ?></a>
              <?php if(get_sub_field('resource_description')){ ?><?php the_sub_field('resource_description'); ?><?php } 
            }?>
            </li>
          <?php endwhile; ?>
        <?php endwhile; ?>
      </ul>
  </section>


<?php get_footer(); ?>

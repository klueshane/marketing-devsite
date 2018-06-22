<?php /* Template Name: Resources Page */ ?><?php
define("TITLE", "Klue Resources");
define("DESCRIPTION", "Learn More about Klue and Competitive Intelligence");
?>
<?php get_header(); ?>


<section class="intro">
    <div class="intro__box">
      <h1 class="intro__heading">Win rates increase with the right intel.</h1>
      <p>Discover what you've been missing. Learn how to collect, curate, and share with the Klue platform.</p>
      <a href="#" class="button button--green button--subscribe button--blogitems">Subscribe</a>
    </div>
  </section>

  <section class="resources">

      <ul class="resources__columns">

        <?php while ( have_rows('resource_items') ) : the_row(); ?>
          <?php while ( have_rows('resource_item') ) : the_row(); ?>

            <li class="<?php if(get_sub_field('resource_type') == "Document"): ?>resources__item<?php else: ?>webinars__item<?php endif; ?>">
              <?php if(get_sub_field('resource_title')): ?><h1 class="section__heading"><?php the_sub_field('resource_title'); ?></h1><?php endif; ?>
              <?php if(get_sub_field('resource_label')): ?><a class="button button--webinar button--green-solid" modal-data="" href="#" <?php $resource_file = get_sub_field('resource_file'); $resource_link = get_sub_field('resource_link'); if( $resource_file ): ?>data-location="<?php echo $resource_file; ?>" <?php elseif( $resource_link ): ?>data-location="<?php echo $resource_link; ?>" <?php endif; ?>><i class="fa fa-play-circle" aria-hidden="true"></i><?php the_sub_field('resource_label'); ?></a><?php endif; ?>
              <?php if(get_sub_field('resource_description')): ?><?php the_sub_field('resource_description'); ?><?php endif; ?>
            </li>
          <?php endwhile; ?>
        <?php endwhile; ?>
      </ul>
  </section>


<?php get_footer(); ?>

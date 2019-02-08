<?php /* Template Name: Contact Page */ ?>
<?php get_header(); ?>


<section class="intro">
  <div class="intro__box">
    <?php if(get_field('contact-banner-sublabel')): ?><h1 class="intro__heading"><?php the_field('contact-banner-sublabel'); ?></h1><?php endif; ?>
    <?php if(get_field('contact-content')): ?><?php the_field('contact-content'); ?><?php endif; ?>
    <?php if(get_field('contact-intercom-text')): ?><a href="#" js-intercom-trigger class="contact__chat" ><?php the_field('contact-intercom-text'); ?></a><?php endif; ?>
    <?php if(get_field('contact-form-heading')): ?><p class="contact__email"><?php the_field('contact-form-heading'); ?></p><?php endif; ?>
    <p class="contact__message"><a class="button button--green button--message" href="mailto:info@klue.com">Message Us</a></p>
  </div>
</section>

<section class="visit">
  <div class="visit__visit-wrapper">
    <?php if(get_field('contact_text')): ?><h1 class="visit__heading"><?php the_field('contact_text'); ?></h1><?php endif; ?>
    <p class=""><a class="button button--green visit__button" target="_blank" href="<?php if(get_field('map_url')): ?><?php the_field('map_url'); ?><?php endif; ?>">See Map</a></p>
    <?php if(get_field('contact-address')): ?><div class="visit__address"><?php the_field('contact-address'); ?></div><?php endif; ?>
  </div>
</section>


<?php get_footer(); ?>

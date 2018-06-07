<?php /* Template Name: Webinars Page */ ?><?php
define("TITLE", "Klue Webinars");
define("DESCRIPTION", "Win Rates increase with the right intel.");
?>
<?php get_header(); ?>

<main>
  <section class="layout-header slant">
    <div class="container">
      <header>
        <?php if(get_field('webinars-banner-label')): ?><h1 class="header-page-title"><?php the_field('webinars-banner-label'); ?></h1><?php endif; ?>
      </header>
    </div>
    <div class="layout-header-bg" />
  </section>
  <div class="container primary page-content page-webinar p3 sm-p4">
    <section>
      <div class="row">
        <div class="col-xs-12 row-padd-x col-centered-x text-center">
          <?php if(get_field('webinars-heading')): ?><h1><?php the_field('webinars-heading'); ?></h1><?php endif; ?>
          <?php if(get_field('webinars-text')): ?><p><?php the_field('webinars-text'); ?></p><?php endif; ?>
        </div>
        <div class="col-xs-12 row-padd-x col-centered-x">


<form action="?klue-form=demo" novalidate method="post">
  <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('demo'); ?>" />
  <div class="row row-centered">
    <div class="col-xs-12">
      <input type="text" value="" name="name" class="required email form-control" placeholder="Full Name">
    </div>
    <div class="col-xs-12">
      <input type="email" value="" name="email" class="required email form-control" placeholder="Email Address">
    </div>
    <div class="col-xs-12">
      <select name="time" class="required email form-control">
        <option>This Wednesday — 12pm PST</option>
        <option>Next Wednesday — 12pm PST</option>
        <option>Other</option>
      </select>
    </div>
    <div class="col-xs-12">
      <input type="submit" value="Sign Up" class="btn btn-success btn-block">
    </div>
    <input type="hidden" name="_subject" value="New Webinar Demo Request" />
  </div>
</form>



        </div>
      </div>
    </section>
    <hr />
    <section class="mb3">
      <?php if(get_field('webinars-rec-heading')): ?><h2 class="center bold mb4"><?php the_field('webinars-rec-heading'); ?></h2><?php endif; ?>
      <div class="md-flex">
        <div class="md-col-6 px4 flex flex-column justify-center">
          <?php if(get_field('webinars-rec-form')): ?><h4 class="mb2 center"><?php the_field('webinars-rec-form'); ?></h4><?php endif; ?>

<form action="?klue-form=webinar_video" method="post" class="validate" novalidate>
  <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('webinar_video'); ?>" />
  <div class="mc-field-group">
    <input type="email" value="" name="email" placeholder="EMAIL (required)" class="required email" id="mce-EMAIL">
  </div>
  <div class="mc-field-group">
    <input type="text" value="" name="name" placeholder="NAME" class="" id="mce-NAME">
  </div>
  <div class="mc-field-group">
    <input type="text" value="" name="company" placeholder="COMPANY (required)" class="required" id="mce-COMPANY">
  </div>
  <div class="clear"><input type="submit" value="Watch" name="subscribe" id="mc-embedded-subscribe" class="btn"></div>
</form>


        </div>
        <div class="md-col-6 flex px4 flex-column items-center justify-center">
          <?php if(get_field('webinars-rec-text')): ?><h2 class="text-center">
            <?php the_field('webinars-rec-text'); ?>
          </h2><?php endif; ?>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>

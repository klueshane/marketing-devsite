
<?php get_header(); ?>

<main>
  <section class="layout-page-header"></section>
  <div class="container primary page-content page-features">
    <section class="p0">
      <div class="row row-padd-x row-centered">
        <!-- Hero  -->
        <div class="col-xs-12 col-sm-8 col-center-x features-intro ppc-intro text-center">
          <h1>Smart Competitive Intelligence<br />for Product Marketers</h1>
          <h2 class="features-subhead">Get a Quickstart Guide to Online CI and<br />Building Sales Battlecards that Win.</h2>
        </div>
      </div>
      <!-- Divider -->
      <hr>
      <div class="row row-padd-s">
      <!-- The Form  -->
      <div class="col-xs-12 col-sm-6 col-centered-x">
        <div class="col-xs-12 col-sm-10 x-fill">
          <figure class="p0"><img style="max-width: 400px;width: 100%;height: auto;max-height: none" src="<?php echo get_template_directory_uri() ?>/assets/images/ebook-competitive-intel.png"></figure>

        </div>
      </div>
        <div class="col-xs-12 col-sm-6 col-centered">
          <div class="col-xs-12 col-sm-10 x-fill text-center">
            <h2>Sign up and we'll send you our <strong>Product Marketer's Ebook bundle</strong></h2>

            <p class="text-center">Learn how to use Klue's Battlecards like an expert — from the experts. Transform your stale data into up-to-the-minute competitive intel with this free PDF.</p>

<form action="?klue-form=resources_pm_ebook" method="post" novalidate>
  <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('resources_pm_ebook'); ?>" />
  <div class="mc-field-group">
    <input type="email" value="" name="email" placeholder="EMAIL (required)" class="required email">
  </div>
  <div class="mc-field-group">
    <input type="text" value="" name="name" placeholder="NAME" class="" id="mce-NAME">
  </div>
  <div class="mc-field-group">
    <input type="text" value="" name="company" placeholder="COMPANY (required)" class="required">
  </div>
  <div class="clear"><input type="submit" value="Get the ebook" class="btn"></div>
</form>



          </div>
        </div>
      </div>
      <!-- Divider -->
      <hr>
      <!-- Meet Klue - bullet list -->
      <div class="row row-padd">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0 text-center">Better Intel, Better Product,<br />Better Win Rates</h2>
        </div>
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m5"">We'll Show You How</h2>
          <ul class="features-benefits-list">
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Competitor page monitoring in real-time.</li>
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Centralized intel collection, curation and sharing.</li>
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Self-service sales battlecards available on web and mobile.</li>
          </ul>
        </div>
      </div>
      <div class="row row-padd row-centered">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m3 text-center">Klue is your secret weapon to build a better product and edge ahead of the competition</h2>
          <div style="padding-bottom: 60px">
            <a href="<?php echo KLUE_APP_DOMAIN; ?>/signup" class="btn ppc-signup-button" style="display: inline-block;height: auto; padding: 30px 80px;font-size: 20px;line-height: 20px">Request a demo today</a>
          </div>
        </div>
      </div>
      <!-- Inverted Colors Section -->
      <!--
      <div class="row row-padd-s features-inverted features-ccc">
        <div class="col-xs-12 col-sm-4 col-centered">
          <figure><img src="<?php echo get_template_directory_uri() ?>/assets/images/svg/collect-white.svg"></figure>
          <h2>Collect.</h2>
        </div>
        <div class="col-xs-12 col-sm-4 col-centered">
          <figure><img src="<?php echo get_template_directory_uri() ?>/assets/images/svg/collection-white.svg"></figure>
          <h2>Curate.</h2>
        </div>
        <div class="col-xs-12 col-sm-4 col-centered">
          <figure><img src="<?php echo get_template_directory_uri() ?>/assets/images/svg/consume-white.svg"></figure>
          <h2>Consume.</h2>
        </div>
      </div>
      -->
    </section>
  </div>
</main>

<?php get_footer(); ?>

<?php
define("TITLE", "Arm Your Sales Team - Try Klue for Competitive Intel"); # TODO
define("DESCRIPTION", "Don't give your team another tool. Show them the playing field, monitored in real-time"); # TODO
?>
<?php get_header(); ?>

<main>
  <section class="layout-page-header"></section>
  <div class="container primary page-content page-features">
    <section class="p0">
      <div class="row row-padd-x row-centered">
        <!-- Hero  -->
        <div class="col-xs-12 col-sm-8 col-center-x features-intro ppc-intro text-center">
          <h1>Arm Your Sales Team - Try Klue for Competitive Intel.</h1>
          <h2 class="features-subhead"> Don't give your team another tool. Show them the playing field, monitored in real-time.</h2>
        </div>
      </div>
      <!-- Divider -->
      <hr>
      <div class="row row-padd">
        <div class="col-xs-12 col-sm-6 col-centered features-ppc">
          <h2 class="bold">Get the Most from Your Competitive Intel</h2>
          <h2 class="text-center">
            In this short webinar, <strong>How to Streamline Competitive Intelligence</strong>, listen in as Klue founder/CEO, Jason Smith, and Klue customer, Hootsuite, discuss current CI challenges and how Klue helped.
          </h2>
      </div>
      <!-- The Form  -->
      <div class="col-xs-12 col-sm-6 col-centered-x features-ppc text-center">
        <div class="col-xs-12 col-sm-10 x-fill">
        <h2>Sign up for our mailing list for access to our <strong>How to Streamline Competitive Intelligence webinar</strong>.</h2>

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
      </div>
    </div>
      <!-- Meet Klue - bullet list -->
      <div class="row row-padd">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0">Knowledge is Power</h2>
          <h3 class="features-meet-subhead">Klue is your <strong>secret weapon</strong> to build a better product and edge ahead of the competition.</h3>
        </div>
        <div class="col-xs-12 col-sm-6 col-centered">
          <ul class="features-benefits-list">
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Share mobile-friendly Battlecards .</li>
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Monitor and track changes to websites.</li>
            <li><img class="features-checkmark" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/checkmark.svg">Get news alerts from over 3.5M websites.</li>
          </ul>
        </div>
      </div>
      <div class="row row-padd-s row-centered">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0">Try Klue Free</h2>
          <a href="<?php echo KLUE_APP_DOMAIN; ?>/signup" style="display: inline-block;height: auto; padding: 30px 80px;font-size: 20px;line-height: 20px" class="btn ppc-signup-button">Sign Up Today</a>
        </div>
      </div>
      <div class="row row-padd row-centered">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0">Looking for more?</h2>
          <h3 class="features-meet-subhead">Our <a href="/products">products page</a> has all your answers.</h3>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>

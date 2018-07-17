
<?php get_header(); ?>

<main>
  <section class="layout-page-header"></section>
  <div class="container primary page-content page-features">
    <section class="p0">
      <div class="row row-padd-x row-centered">
        <!-- Hero  -->
        <div class="col-xs-12 col-sm-6 col-center-x features-intro ppc-intro">
          <h1>Never Get Blindsided. Turn Competitive Intelligence into Wins.</h1>
          <h2 class="features-subhead">
            Every company has intel.
            But is that data connected in real time and actively working for you?
          </h2>
        </div>
        <!-- The Form  -->
        <div class="col-xs-12 col-sm-6 col-centered-x ppc-intro">
          

<h2 class="bold">Want to see Klue's features in action? <br>Sign up for a demo today.</h2>
<form action="?klue-form=demo" method="post">
  <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('demo'); ?>" />
  <input type="hidden" name="_form" value="Footer Form" />
  <div class="md-flex">
    <div class="xy-fill">
      <input type="email" value="" name="email" class="email" placeholder="Email Address">
    </div>
  </div>
  <div class="md-flex">
    <div class="x-fill">
      <input type="text" value="" name="company" class="email" placeholder="Company">
    </div>
  </div>
  <div class="md-flex">
    <div class="x-fill">
      <input type="submit" value="Request Demo" class="btn btn-success btn-block">
    </div>
  </div>
</form>

        </div>
      </div>
      <!-- Divider -->
      <hr>
      <!-- Meet Klue - bullet list -->
      <div class="row row-padd">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0">Features that Win Deals</h2>
          <h3 class="features-meet-subhead">Your <strong>secret weapon</strong> to build a better product and edge ahead of the competition.</h3>
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
          <a href="https://klue.com/signup"><button class="btn ppc-signup-button">Sign Up Today</button></a>
        </div>
      </div>
      <div class="row row-padd row-centered">
        <div class="col-xs-12 col-sm-6 col-centered">
          <h2 class="features-title m0">Looking for more?</h2>
          <h3 class="features-meet-subhead">Our <a href="/features">features page</a> has all your answers.</h3>
        </div>
      </div>
      <!-- Inverted Colors Section -->
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
    </section>
  </div>
</main>

<?php get_footer(); ?>

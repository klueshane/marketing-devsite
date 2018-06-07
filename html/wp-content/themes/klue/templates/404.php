<?php
define("TITLE", "Klue - Page not found");
define("DESCRIPTION", "Page not found");
?>
<?php get_header(); ?>

<main>
  <section class="layout-header slant">
    <div class="container">
      <header>
        <h1 class="header-page-title">Page not Found</h1>
      </header>
    </div>
    <div class="layout-header-bg" />
  </section>
  <div class="container primary p2 md-p4">
    <section>
      <div class="md-flex">
        <div>
          <h1>Looks like that page doesn't exist!</h1>
          <h2>You can <a href="/">return to the Homepage</a>, check out <a href="/products">Klue's Products</a>, or <a href="/contact">contact us</a> directly.</h2>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>

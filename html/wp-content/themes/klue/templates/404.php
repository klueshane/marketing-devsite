<?php /* Template Name: 404 Page */ ?><?php
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
          <section class="intro">
    <div class="intro__box">
       <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
  </section>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>

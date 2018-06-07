<?php get_header(); ?>

<main>
  <section class="layout-header slant">
    <div class="container">
      <header>
        <h1 class="header-page-title"><?php the_title(); ?></h1>
      </header>
    </div>
    <div class="layout-header-bg" />
  </section>
  <div class="container primary p2 md-p4">
    <section>
      <div class="md-flex">
        <div>

          <?php the_content(); ?>

        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>

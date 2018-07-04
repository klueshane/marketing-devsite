<?php /* Template Name: Resources Page */ ?><?php
define("TITLE", "Klue Resources");
define("DESCRIPTION", "Learn More about Klue and Competitive Intelligence");
?>
<?php get_header(); ?>


<section class="intro">
    <div class="intro__box">
      <h1 class="intro__heading">Win rates increase with the right intel.</h1>
      <p>Discover what you've been missing. Learn how to collect, curate, and share with the Klue platform.</p>
      <a href="#" class="button button--green button--subscribe button--blogitems" style="left: 0;">Subscribe</a>
    </div>
  </section>

  <section class="resources">

      <ul class="resources__columns">

        <?php while ( have_rows('resource_items') ) : the_row(); ?>
          <?php while ( have_rows('resource_item') ) : the_row(); ?>

            
          <?php endwhile; ?>
        <?php endwhile; ?>
      </ul>
  </section>


<?php get_footer(); ?>

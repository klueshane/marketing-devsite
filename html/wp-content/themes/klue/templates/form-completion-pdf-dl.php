<?php /* Template Name: Form Success Page: PDF/Ebook */ ?><?php
define("TITLE", "Klue - Thanks");
?>
<?php get_header(); ?>

<!-- contains new styling used by this page -->
<link href="<?php echo get_template_directory_uri() ?>/assets/css-standalone/contact-section.css" rel="stylesheet">

<!-- offset the header -->
<div style="padding-top: 180px"></div>


<div class="form-resources-wrapper">
  <div class="text-center mb3">
    <?php if(get_field('ebook-form-success-heading')): ?><div class="support-box-heading mb1"><?php the_field('ebook-form-success-heading'); ?></div><?php endif; ?>
    <?php if(get_field('ebook-form-success-text')): ?><div class="support-box-subheading" style="max-width: 400px; margin: 0 auto"><?php the_field('ebook-form-success-text'); ?></div><?php endif; ?>
  </div>

  <div class="form-resources-layout">
    <div class="form-resources-layout_item">
      <img src="<?php echo get_template_directory_uri() ?>/assets/images/ebook-win-loss.jpg" />
      <?php if(get_field('ebook-form-success-dl1-heading')): ?><div class="mb1 mt1"><strong><?php the_field('ebook-form-success-dl1-heading'); ?></strong></div><?php endif; ?>
      <div class="mb1"><a href="/content/uploads/2017/02/WinLoss_Interview_Checklist_Klue-1.pdf" class="support-button">Download PDF</a></div>
      <?php if(get_field('ebook-form-success-dl1-text')): ?><p><?php the_field('ebook-form-success-dl1-text'); ?></p><?php endif; ?>

    </div>
    <div class="form-resources-layout_item">
      <img src="<?php echo get_template_directory_uri() ?>/assets/images/ebook-competitive-intel.png" />
      <?php if(get_field('ebook-form-success-dl2-heading')): ?><div class="mb1 mt1"><strong><?php the_field('ebook-form-success-dl2-heading'); ?></strong></div><?php endif; ?>
      <div class="mb1"><a href="/content/uploads/2017/01/Klue-Ebook-Bundle-for-Product-Marketers.pdf" class="support-button">Download PDF</a></div>
      <?php if(get_field('ebook-form-success-dl2-text')): ?><p><?php the_field('ebook-form-success-dl2-text'); ?></p><?php endif; ?>
    </div>
    <div class="form-resources-layout_item">
      <div class="mb3 text-center">
        <div class="mb1 mt1"><strong>Join our webinar</strong></div>
        <div class="mb1"><a href="/webinars/" class="support-button">Join Webinar</a></div>
      </div>
      <hr />
      <div class="mt3 text-center">
        <div class="mb1 mt1"><strong>Request access to Klue</strong></div>
        <div class="mb1"><a href="/contact/" class="support-button">Contact for Access</a></div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>

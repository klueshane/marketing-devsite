<?php get_header(); ?>

<?php query_posts('posts_per_page=1'); ?>
<?php get_template_part( 'loop', 'single' ); ?>

<?php get_footer(); ?>
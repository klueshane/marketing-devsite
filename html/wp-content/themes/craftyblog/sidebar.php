<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package enlighten
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php enlighten_social_media();?>
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->

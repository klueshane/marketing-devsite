<?php

class Popular_Posts_Widget extends WP_Widget
{
	function Popular_Posts_Widget()
	{
		$widget_ops = array('classname' => 'Popular_Posts_Widget', 'description' => 'Displays popular posts with
		thumbnail' );
		$this->WP_Widget('Popular_Posts_Widget', 'Popular Posts', $widget_ops);
	}

	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		if (!empty($title))
			echo $before_title . $title . $after_title;;

		?>
		<div class="popular-posts">
			<?php
			$popularpost = new WP_Query(
				array(
				'posts_per_page' => 4,
				'meta_key' => 'enlighten_post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				) );
			while ( $popularpost->have_posts() ) : $popularpost->the_post();?>

				<div class="post">
					<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'crafty-popular-posts' ); ?>
					<?php endif; ?>
					<p><?php the_title();?></p>
						</a>
				</div>
			<?php endwhile;
			wp_reset_postdata()?>
		</div>
		<?php

		echo $after_widget;
	}

}

// register Popular_Posts_Widget
function enlighten_register_popular_posts_widget() {
	register_widget( 'Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'enlighten_register_popular_posts_widget' );
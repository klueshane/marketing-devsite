<?php
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function example_add_dashboard_widgets() {

	wp_add_dashboard_widget(
		'example_dashboard_widget',         // Widget slug.
		'Portfolio Theme Setup Help',         // Title.
		'example_dashboard_widget_function' // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function example_dashboard_widget_function() {?>
	<?php  _e( 'Check out the "Theme Help" section in the sidebar right above the Appearance tab.', 'portfolio' );?>

		<?php
}
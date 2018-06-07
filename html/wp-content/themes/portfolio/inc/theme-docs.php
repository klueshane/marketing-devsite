<?php
/** Step 2 (from text above). */
add_action( 'admin_menu', 'wpp_theme_help_menu' );

/** Step 1. */
function wpp_theme_help_menu() {

	add_menu_page( 'Theme Help', 'Theme Help', 'manage_options', 'theme-help-page', 'top_level_theme_help_page','dashicons-lightbulb', 59 );
	add_submenu_page("theme-help-page", "Portfolio Page", "Portfolio Page", 'manage_options', "portfolio-theme-help", "portfolio_theme_help_page");
	add_submenu_page("theme-help-page", "News Page", "News Page", 'manage_options', "news-theme-help", "news_theme_help_page");
}

function top_level_theme_help_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'portfolio' ) );
	}?>
	<div class="wrap">
		<h1>Portfolio Theme Help</h1>

		<ul>
			<li>Portfolio Page</li>
			<li>News Page</li>
		</ul>
	</div>
<?php }

function portfolio_theme_help_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'portfolio' ) );
	}?>
	<div class="wrap">
	<h1>Portfolio Page</h1>

	<h2>Add your Portfolio Page to the Menu</h2>

	<p>You can find your 'Portfolio' page <a href="<?php echo get_site_url(); ?>/portfolio">here</a>.</p>
	<p>To add the portfolio page to the site menu you'll need to create a custom menu.</p>

	<h3>To Create the Custom Menu:</h3>
	<ol>
		<li>Go to <a href="<?php echo get_site_url(); ?>/wp-admin/nav-menus.php">Appearance → Menus</a> in your dashboard</li>
		<li>Click the create a new menu link</li>
		<li>Type in a Menu Name</li>
		<li>Click the Create Menu button.</li>
	</ol>
		<hr>

	<h3>To add the Portfolio Page to the Menu:</h3>
	<ol>
		<li>Open the Custom Links tab on the left</li>
		<li>Type in the url for your portfolio page</li>
		<li>Type 'Portfolio' in the 'Link Text' Box</li>
		<li>Click the Add to Menu button</li>
	</ol>
	<img src="<?php echo get_template_directory_uri();?>/images/custom-links.png"/>
	<h4>Important!</h4>
	<p><strong>Be sure to click blue the "Save Menu" button to save your changes.</strong></p>
	<img style="border: 1px solid #DFDFDF;" src="<?php echo get_template_directory_uri();?>/images/menus_save-menu-button.png"/>
	</div>
	<?php }


function news_theme_help_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'portfolio' ) );
	}?>
	<div class="wrap">

		<h2>Add a News Page to the Menu</h2>

		<h3>To create the News section for the Portfolio Theme we simply created a category called "News".</h3>
		<ol>
			<li>Go to <a href="<?php echo get_site_url(); ?>/wp-admin/edit-tags.php?taxonomy=category">Posts -> Categories</a> in your dashboard.</li>
			<li>Add the "News" category by filling out the category name field to say "News"</li>
		</ol>
		<img style="border: 1px solid #DFDFDF;" src="<?php echo get_template_directory_uri();?>/images/add-new-category.png"/>
		<h4>Important!</h4>
		<p><strong>Be sure to click blue the "Add New Category" button to save your changes.</strong></p>
		<hr>
		<h3>Follow these steps to add the Category page to your custom menu.</h3>
		<ol>
			<li>Go to <a href="<?php echo get_site_url(); ?>/wp-admin/nav-menus.php">Appearance → Menus</a> in your dashboard</li>
			<li>Open the Categories tab instead of the links tab and check the box next to "News"</li>
			<li>Click the Add to Menu button</li>
			</ol>
		<img src="<?php echo get_template_directory_uri();?>/images/categories-menu-section.png"/>

		<h4>Important!</h4>
		<p><strong>Be sure to click blue the "Save Menu" button to save your changes.</strong></p>
		<img style="border: 1px solid #DFDFDF;" src="<?php echo get_template_directory_uri();?>/images/menus_save-menu-button.png"/>


		<p><strong>PLEASE NOTE: Only categories with at least one published post in them will appear in the list.</strong></p>
	</div>
<?php
}

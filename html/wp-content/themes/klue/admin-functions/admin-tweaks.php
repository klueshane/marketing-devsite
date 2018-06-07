<?php

// options page

$option_args = array(

  /* (string) The title displayed on the options page. Required. */
  'page_title' => 'Site-Wide Content',

  /* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
  'menu_title' => '',

  /* (string) The slug name to refer to this menu by (should be unique for this menu).
  Defaults to a url friendly version of menu_slug */
  'menu_slug' => 'content-global',

  /* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
  Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
  'capability' => 'edit_posts',

  /* (int|string) The position in the menu order this menu should appear.
  WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
  Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
  Defaults to bottom of utility menu items */
  'position'		=> '20',

  /* (string) The slug of another WP admin page. if set, this will become a child page. */
  'parent_slug' => '',

  /* (string) The icon class for this menu. Defaults to default WordPress gear.
  Read more about dashicons here: https://developer.wordpress.org/resource/dashicons/ */
  'icon_url' => 'dashicons-welcome-widgets-menus',

  /* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
  If set to false, this parent page will appear alongside any child pages. Defaults to true */
  'redirect' => true,

  /* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
  Defaults to 'options'. Added in v5.2.7 */
  'post_id' => 'options',

  /* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
  Defaults to false. Added in v5.2.8. */
  'autoload' => false,

);

if(function_exists('acf_add_options_page')) {
  acf_add_options_page( $option_args );
}


/*
Plugin Name: Admin Panel Cleanup
Plugin URI:
Description:
Version: 1.0
Author: Paul Collett
Author URI: http://paulcollett.com
License:
*/

class admin_cleanup {

  function __construct() {
    if(!is_admin()) return;

    add_action('load-index.php', array( &$this,'dashboard_Redirect'));
    add_filter('admin_footer_text', array( &$this,'admin_footer_text_output')); //left side
    add_filter('update_footer', array( &$this,'admin_footer_text_output'), 11); //right side
    add_action( 'admin_init', array( &$this,'my_remove_menu_pages') );
    add_filter('acf/fields/wysiwyg/toolbars', array( &$this,'acf_wysiwyg_toolbars'));

    //set default color scheme (and dissallow changing it)
    add_action('user_register', array( &$this,'set_default_admin_color'));

    // Move Yoast to bottom
    add_filter( 'wpseo_metabox_prio', array( &$this,'move_yoast_to_bottom'));
  }

  function my_remove_menu_pages() {
    //some calls like ajax dont have a menu
    if(!isset($GLOBALS['menu'])) return;

    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');

    remove_action( 'admin_notices', 'update_nag', 3 );//remove update notice
    remove_menu_page('themes.php');
  }

  function disable_user_deleting_pages(){
    //manage_categories
    $role = get_role( 'editor' );
    $role->remove_cap( 'publish_pages' );
    $role->remove_cap( 'delete_published_pages' );

  }

  function dashboard_Redirect(){
    wp_redirect(admin_url('edit.php?post_type=page'));
  }

  function admin_footer_text_output($text) {
      return '';
  }

  function my_login_css() {
    wp_enqueue_style( 'custom-login', plugins_url('login.css  ', __FILE__) );
  }

  function set_custom_options_page() {
    acf_add_options_page(array(
      'page_title' 	=> 'Other Content',
      'menu_title'	=> 'Other Content',
      'menu_slug' 	=> 'acf-other-content',
      'capability'	=> 'edit_posts',
      'parent_slug'	=> '',
      'position'		=> false,
      'icon_url'		=> false,
    ));
    //acf_add_options_page();
    //acf_add_options_sub_page('Header');
  }

  function acf_wysiwyg_toolbars($toolbars){
    // hr, outdent, indent, alignleft, aligncenter, alignright
    $toolbars['Format/Bold/Italic/List/Link/Quote'][1] = apply_filters('teeny_mce_buttons',array('formatselect','bold' , 'italic' , 'bullist' , 'numlist' , 'link' , 'unlink', 'blockquote' ));
    $toolbars['Bold/Italic/List/Link/Quote'][1] = apply_filters('teeny_mce_buttons',array('bold' , 'italic' , 'bullist' , 'numlist' , 'link' , 'unlink', 'blockquote' ));
    $toolbars['Bold/Italic/List/Link'][1] = apply_filters('teeny_mce_buttons',array('bold' , 'italic' , 'bullist' , 'numlist' , 'link' , 'unlink' ));
    $toolbars['Bold/Italic/Link'][1] = apply_filters('teeny_mce_buttons',array('bold' , 'italic' , 'link' , 'unlink' ));
    $toolbars['Bold/Italic'][1] = apply_filters('teeny_mce_buttons',array('bold' , 'italic'));
    $toolbars['Bold'][1] = apply_filters('teeny_mce_buttons',array('bold'));
    return $toolbars;
  }

  function move_yoast_to_bottom() {
    return 'low';
  }

}

new admin_cleanup();


class front_end_cleanup
{

  function __construct(){
    add_action( 'init', array(&$this,'clean_head') );
    $this->disable_api();

    // Remove All Yoast HTML Comments
    // https://gist.github.com/paulcollett/4c81c4f6eb85334ba076
    if (defined('WPSEO_VERSION')){
      add_action('get_header',function (){ ob_start(function ($o) {
      return preg_replace('/^<!--.*?[Y]oast.*?-->$/mi','',$o); }); });
      add_action('wp_head',function (){ ob_end_flush(); }, 999);
    }
  }

  function disable_api(){
    // Filters for WP-API version 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');

    // Filters for WP-API version 2.x
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');

    // Remove meta tags
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
  }

  function clean_head(){
    add_filter('show_admin_bar', '__return_false');

    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    //remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    //remove_action('wp_head', 'start_post_rel_link', 10, 0);
    //remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link' );
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3 );// category feeds
    remove_action('wp_head', 'feed_links', 2 );// post and comment feeds
    wp_deregister_script( 'wp-embed' );

    remove_action('wp_head', array($GLOBALS['wp_widget_factory']->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

    // remove emoji
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    add_filter( 'emoji_svg_url', '__return_false' );
  }
}

new front_end_cleanup();

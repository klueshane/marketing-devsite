<?php

/**
 * This file catches all non- wordpress page requests.
 * We route them to the correct template corresponding with the URL slug,
  * otherwise just show the 404.php page
 */

// Accessed directly
if(!defined('ABSPATH')) {
  header('location: /'); die;
}

$path = trim(explode('?', strtolower($_SERVER['REQUEST_URI']))[0], '/');

if($path == '') {
  $path = 'home';
}

$filepath = dirname(__FILE__) . '/templates/' . $path . '.php';
$valid_path = preg_match('/^[\/a-z0-9-_]+$/', $path);
$page_exists = $valid_path && file_exists($filepath);


$blog_section = is_home() || is_category() || is_post_type_archive('post') || is_singular('post');

if(/* blog section */$blog_section) {
  if(is_single()) {
    include 'blog/single.php';
  }
  else {
    include 'blog/listing.php';
  }
}
else if(is_page()) {
  include 'templates/default-cms-page.php';
} else if($page_exists) {
  status_header(200);
  include $filepath;
}
else {
  // handle any redirect if needed
  include '_redirects.php';

  // otherwise return the 404 page
  status_header(404);
  if(WP_DEBUG) {
    if($valid_path) {
      echo "<!-- looking for template: templates/{$path}.php -->";
    }
    else {
      echo "<!-- invalid path: {$path} (should only contain /a-z0-9-_) -->";
    }
  }

  include 'templates/404.php';
}

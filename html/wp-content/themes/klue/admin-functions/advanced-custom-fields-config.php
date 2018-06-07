<?php

// customize ACF dir
add_filter('acf/settings/path', function() {
  return get_stylesheet_directory() . '/admin-functions/advanced-custom-fields-pro/';
});

add_filter('acf/settings/dir', function() {
  return get_stylesheet_directory_uri() . '/admin-functions/advanced-custom-fields-pro/';
});

// Locate the dir that stores info about the fields
add_filter('acf/settings/save_json', function() {
  return get_stylesheet_directory() . '/admin-functions/fields-json-db';
});

add_filter('acf/settings/load_json', function() {
  return array( get_stylesheet_directory() . '/admin-functions/fields-json-db' );
});

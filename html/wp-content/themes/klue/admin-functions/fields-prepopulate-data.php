<?php

//
// Allow specific editing fields (in the Advance Custom Fields Plugin)
// when a page has the same URL as a template
//
/*
$templates = wp_get_theme()->get_post_templates();
$klue_page_templates = isset($templates['page']) ? $templates['page'] : array();

if(class_exists('acf_location')) {
  class acf_location_klue_slug extends acf_location {
    function initialize() {
      $this->category = 'post';
      $this->name = 'klue-slug';
      $this->label = 'Slug (Klue Added)';
    }

    function rule_match( $result, $rule, $screen ) {
      $post_id = acf_maybe_get( $screen, 'post_id' );
      if( !$post_id ) return false;
      $post = get_post( $post_id );
      $post_path = str_replace( home_url(), "", get_permalink($post_id) );

      $match = $post_path == $rule['value'];

      var_dump('here',$match);

      // reverse if 'not equal to'
      if( $rule['operator'] === '!=' ) $match = !$match;

      return $match;
    }

    function rule_values( $choices, $rule ) {
      global $klue_page_templates;

      $rules = array();

      foreach ($klue_page_templates as $page => $page_name) {
        $slug = str_replace('.php', '', basename($page));
        if($slug == 'home') {
          $rules['/'] = '/ (home)';
        }
        else {
          $rules['/' . $slug . '/'] = '/'. $slug . '/ (' . $page_name . ')';
        }
      }

      $rules['(none)'] = '(None of the above)';

      return $rules;
    }
  }

  acf_register_location_rule('acf_location_klue_slug');
}*/

//
// Add our default text to show up inside of the admin panel
// and afc_get_field helper
//

function klue_get_default_field_values() {
  $field_defaults = array();

  //foreach($default_files as $file) {
    $fields = array();

    include  get_template_directory() . '/templates/_default-field-data.php';

    if(count($fields) > 0) {
      $field_defaults = $fields;
    }
  //}

  return $field_defaults;
}

$field_defaults = klue_get_default_field_values();


function _klue_handle_raw_value($default_value, $sub_fields = false) {
  // handle repeater fields
  if(is_array($default_value) && $sub_fields) {
    return _sub_fields_swapping_names_with_key($sub_fields, $default_value);

  // handle of uploading images to db
  } else if(is_string($default_value) && isset($default_value[0]) && $default_value[0] == '/') {

    $asset = get_template_directory() . $default_value;
    $asset_new_path = wp_upload_dir()['path'] . '/' . basename($default_value);

    if(!file_exists($asset_new_path)) copy($asset, $asset_new_path);

    $attach_id = wp_insert_attachment(array('post_mime_type' => 'image/image',
      'post_title'     => 'theme image',
      'post_content'   => '',
      'post_status'    => 'inherit'), $asset_new_path);

    return $attach_id;

  // default text
  } else {
    return $default_value;
  }
}

// Add our default text to show up inside of the admin panel
if(is_admin()) { // ..if is admin section
  foreach($field_defaults as $key => $default_value) {
    add_filter('acf/load_value/name=' . $key, function($current_field_value, $post_id, $field) use ($default_value) {
      $raw_value = acf_get_metadata( $post_id, $field['name'] );

      if($raw_value === null) { //
        return _klue_handle_raw_value($default_value, isset($field['sub_fields']) ? $field['sub_fields'] : false);
      }
      else {
        return $current_field_value;
      }
    }, 10, 3);
  }
}

function _sub_fields_swapping_names_with_key($sub_fields, $new_data_array) {
  $new_data = array();
  $map_of_name_to_key = array();
  $map_of_keys_to_subfields = array();

  foreach($sub_fields as $field) {
    $map_of_name_to_key[$field['name']] = $field['key'];
    $map_of_keys_to_subfields[$field['key']] = isset($field['sub_fields']) ? $field['sub_fields'] : null;
  }

  foreach($new_data_array as $row_index => $row) {

    if(!is_array($row)) continue;// ..bad default data

    foreach($row as $key => $value) {
      if(!isset($map_of_name_to_key[$key])) { // Skip legacy data that doesn't match up to new
        continue;
      }

      $key = $map_of_name_to_key[$key];

      //if(is_array($value) && isset($map_of_keys_to_subfields[$key])) {
      //  $value = sub_fields_swapping_names_with_key($map_of_keys_to_subfields[$key], $value);
      //}

      $new_data[$row_index][$key] = _klue_handle_raw_value(
        $value,
        isset($map_of_keys_to_subfields[$key]) ? $map_of_keys_to_subfields[$key] : false
      );
    }
  }

  return $new_data;
}

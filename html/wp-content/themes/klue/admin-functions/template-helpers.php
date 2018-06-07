<?php

include 'vendor/aq-image-resizer.php';

// image

//
// Helper functions which provide fallbacks to default data
//

/*
function klue_get_field($field_name, $post_id = false, $encoded = false) {
  $field = get_field($field_name, $post_id, $encoded); // get_field is the acf plugin

  return $field;
}

function klue_the_field($field_name, $post_id = false) {
  $value = klue_get_field($field_name, $post_id, true);

  echo !$value ? '' : $value;
}
*/
/*
function klue_has_sub_fields( $field_name, $post_id = null ) {
  if(function_exists('has_sub_fields')) {
    $match = has_sub_fields( $field_name, $post_id );
  } else {
    $match = false;
  }

  if(!$match) {
    $match = _klue_has_sub_field($field_name);
  }

  return $match;
}

function klue_get_sub_field($field_name) {
  if(function_exists('get_sub_field')) {
    $field = get_sub_field($field_name); // get_field is the acf plugin
  }
  else {
    $field = null;
  }

  if($field == null) {
    $field = _klue_get_sub_field($field_name);
  }

  return $field;
}
*/

//
// Replicate ACF plugin interface for handling default data
//
/*
$_faux_loop_dataset_i = -1;
$_faux_loop_dataset = array();
$_faux_loop_dataset_row_i  = array();

$cap = 0;

function _klue_has_sub_field($field_name) {
  global $_faux_loop_dataset_i, $_faux_loop_dataset, $_faux_loop_dataset_row_i, $cap;

  if($_faux_loop_dataset_i < 0) {
    $rows = klue_get_default_field_value($field_name);

    if(is_array($rows)) {
      $_faux_loop_dataset_i = 0;
      $_faux_loop_dataset = array($rows);
      $_faux_loop_dataset_row_i = array(-1);
    }
  }
  else if(isset($_faux_loop_dataset[$_faux_loop_dataset_i][$field_name])) {
    if(is_array($_faux_loop_dataset[$_faux_loop_dataset_i][$field_name])) {
      $_faux_loop_dataset_i++;
      $_faux_loop_dataset[] = $_faux_loop_dataset[$_faux_loop_dataset_i][$field_name];
      $_faux_loop_dataset_row_i[] = -1;
    }
  }

  $row_i = isset($_faux_loop_dataset_row_i[$_faux_loop_dataset_i]) ? ++$_faux_loop_dataset_row_i[$_faux_loop_dataset_i] : -1;
  $has_next_row = isset($_faux_loop_dataset[$_faux_loop_dataset_i][$row_i]);

  var_dump('yo', $_faux_loop_dataset[$_faux_loop_dataset_i][$row_i]);

  return ++$cap < 10;

  if(!$has_next_row) {
    $_faux_loop_dataset_i--; // reset
  }

  return $has_next_row;
}

function _klue_get_sub_field($field_name) {
  global $_faux_loop_dataset_i, $_faux_loop_dataset, $_faux_loop_dataset_row_i;

  if(isset($_faux_loop_dataset_row_i[$_faux_loop_dataset_i])) {
    $row = $_faux_loop_dataset[$_faux_loop_dataset_i][$_faux_loop_dataset_row_i[$_faux_loop_dataset_i]];

    if(isset($row[$field_name])) {
      return $row[$field_name];
    }
  }

  return null;
}
*/

// site_image
// allows "on-the-fly" image generation
// @uses aq_resizer class

function get_site_image($image,$options = array()){
	$options['return'] = true;
	return site_image($image,$options);
}

function site_image($image,$options = array()){

	$options = array_merge(array(
		'w' => 300,
		'h' => 300,
		'crop' => false,
		'wrapper' => isset($options['class']) ? ('<img src="%s" class="' . $options['class'] . '" />') : '<img src="%s" alt="%s" />',
		'default' => -1,
		'return' => false,
		'upscale' => false,
	),$options);

	if(isset($image['url'])){
		$original = $image['url'];
		$alt = $image['alt'];
	}else{
		$original = $image;
		$alt = '';
	}

	if(!function_exists('aq_resize')){
		include __DIR__ . '/vendor/aq-image-resizer.php';
	}

	//resize on the fly or pull from cache
	if($original){
		$resized_url = aq_resize(
			$original,
			$options['w'],
			$options['h'],
			$options['crop'],
			$return = true,
			$options['upscale']
		);
	}else{
		$resized_url = false;
	}

	if(!is_string($options['default'])){
		if($options['crop']){
			$size_percent = ($options['h']/$options['w'])*100;
			$options['default'] = '<div style="padding-bottom:' . $size_percent . '%"><!--no img--></div>';
		}else{
			$options['default'] = '<!--no img-->';
		}
	}

	if($options['return']){
		return $resized_url;
	}else{
		echo $resized_url ? sprintf($options['wrapper'],$resized_url,$alt) : $options['default'];
	}

}

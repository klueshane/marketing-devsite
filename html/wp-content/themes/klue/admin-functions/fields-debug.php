<?php
/*
Plugin Name: Pauls Debug - 2015
Description:Provides forced error reporting, auto reload snippet, ACF field names interface (?debug=fields)
Plugin URI:
*/

// Force debug info
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_GET['debug']) && $_GET['debug'] == 'fields'){
	output_acf_json_field_names();
	output_reference();
	die;
}

function debug_out_code($code){
	echo "\t<span style=color:#888>" . htmlentities($code) . '</span>';
}

function walk_acf_fields($fields,$depth = 1){

	if(!$fields){
		echo '(NULL FIELDS)' . PHP_EOL;
		return;
	}

	foreach ($fields as $value) {

		if($value['type'] == 'message') continue;

		$indent = "\n" . implode('',array_fill(0,$depth,"\t"));

		echo $indent . $value['type'] . ': ' . $value['name'];



		if($value['type'] !== 'flexible_content' && $value['type'] !== 'repeater'){
			$fun = $depth == 1 ? 'the_field' : 'the_sub_field';
			$fun2 = $depth == 1 ? 'get_field' : 'get_sub_field';
			if($value['type'] == 'image'){
				$code3 = "<?php site_image($fun2('{$value['name']}'),array('w'=>300,'h'=>300)); ?>";
			}else{
				$code3 = "<?php $fun('{$value['name']}'); ?>";
			}
			debug_out_code("<?php if($fun2('{$value['name']}')): ?>$code3<?php endif; ?>");
		}

		if(isset($value['choices'])){
			$choices = array_keys($value['choices']);
			echo $indent . "\t&rarr; " . implode(',' , $choices);
		}

		if($value['type'] == 'flexible_content' || $value['type'] == 'repeater'){
			debug_out_code("<?php while ( have_rows('{$value['name']}') ) : the_row(); ?><?php endwhile; ?>");
		}

		if(isset($value['layouts'])) foreach ($value['layouts'] as $layout){
			echo $indent . "\t" . $layout['name'];
			debug_out_code("<?php elseif( get_row_layout() == '{$layout['name']}' ): ?>");
			if(isset($layout['sub_fields'])) walk_acf_fields($layout['sub_fields'],$depth + 2);
		}

		if($value['type'] == 'repeater'){
			if(isset($value['sub_fields'])) walk_acf_fields($value['sub_fields'],$depth + 1);
		}

	}
}

function output_acf_json_field_names(){

	echo '<pre>';

	//$files = glob(get_template_directory() . '/acf-json/*');
  $files = glob(__DIR__ . '/fields-json-db/*');

	if(!$files) die('no acf-json files');

	foreach ($files as $file) {
		//var_dump($file);
		$data = json_decode(file_get_contents($file),true);
		//print_r($data);
		$filename = basename($file);

		echo "\n\n<span title=\"$filename\">{$data['title']}</span>";

		walk_acf_fields($data['fields']);

	}

	echo '</pre>';
}

function output_reference(){

	echo '<hr /><pre>' . "\n\n\n";

	if(file_exists($file = __DIR__ . '/reference.html')) echo htmlentities(file_get_contents($file));

	echo "\n\n\n" . '</pre>';

}

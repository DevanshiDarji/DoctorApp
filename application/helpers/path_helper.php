<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_path(){
	$CI =& get_instance();
	foreach($CI->config as $key=>&$value)
	{
		
		echo "<pre>";
		print_r($value)   ;
		echo "<br>";

	}

	print_r($CI->config);
	exit;
	/*$data['base_url'] 		= $CI->config->item('base_url');
	$urls['base_css'] 		= $CI->config->item('base_css');
	$urls['base_js'] 		= $CI->config->item('base_js');
	*/
	return $data;
}		
?>
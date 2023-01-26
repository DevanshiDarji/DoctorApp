<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */


if ( ! function_exists('getGeneralVar')){
    function getGeneralVar(){
        $CI=& get_instance();
        $CI->load->database();  

        $CI->db->select('');
        $CI->db->from('configurations');
        $CI->db->where('eStatus','Active');
        $row = $CI->db->get()->result(); 
        for($i=0;$i<count($row);$i++){
    		$vName  = $row[$i]->vName;
    		$vValue  = $row[$i]->vValue;
    		$GLOBALS['Configration_value'][$vName] = $vValue;
    		$$vName=$vValue;
        }  
    }
}

if ( ! function_exists('getstaticpages')){
    function getstaticpages(){
        $CI=& get_instance();
        $CI->load->database();  
        $CI->db->select('');
        $CI->db->from('static_pages');
        $CI->db->where('eStatus','Active');
        $row = $CI->db->get()->result(); 
        for($i=0;$i<count($row);$i++){
            $vPageTitle  = $row[$i]->vPageTitle;
            $vValue  = $row[$i]->tContent_en;
            $GLOBALS['Staticpage_value'][$vPageTitle] = $vValue;
            $$vPageTitle=$vValue;
        }  
    }
}
?>
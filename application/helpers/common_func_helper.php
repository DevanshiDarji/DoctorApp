<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if ( ! function_exists('field_enums')){
        function field_enums($table = '', $field = ''){
            $enums = array();
            if ($table == '' || $field == '') return $enums;
            $CI =& get_instance();
            preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
            foreach ($matches[1] as $key => $value) {
                $enums[$key] = $value; 
            }
            return $enums;
        }  
    }


    if ( ! function_exists('get_dropdown')){
        function get_array($table = '', $field = '')
        {
            //echo $table . $field;exit;
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->from($table);
            $query = $CI->db->get();
            $data = $query->result_array();
            return  $data;
        }  
    }

    if ( ! function_exists('encrypt')){
        function encrypt($data){
            for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
                $c = 255 & ($key ^ ($c << 1));
                $table[$key] = $c;
                $key = 255 & ($key + 1);
            }
            $len = strlen($data);
            for($i = 0; $i < $len; $i++){
                $data[$i] = chr($table[ord($data[$i])]);
            }
            return base64_encode($data);
        }
    }

    if ( ! function_exists('generatePassword')){
        function generatePassword($length = 8){
            $password = "";
            $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
            $maxlength = strlen($possible);
            if ($length > $maxlength) { $length = $maxlength; }
            $i = 0;
            while ($i < $length){ 
                $char = substr($possible, mt_rand(0, $maxlength-1), 1);
                if (!strstr($password, $char)){
                    $password .= $char;
                    $i++;
                }
            }
            return $password;
        }     
    } 
    
    if ( ! function_exists('rand_str')){
        function rand_str($length = 15, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'){
            $chars_length = (strlen($chars) - 1);
            $string = $chars{rand(0, $chars_length)};
            for ($i = 1; $i < $length; $i = strlen($string)){
                $r = $chars{rand(0, $chars_length)};
                if ($r != $string{$i - 1}) $string .=  $r;
            }
            return $string;
        }
    }
    
    
?>
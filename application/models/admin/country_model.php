<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Country_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
    function count_country() {
        return $this->db->count_all("country");
    }
   
    function get_country_details($iCountryId) {
        $this->db->select('');
        $this->db->from('country');
        $this->db->where('iCountryId', $iCountryId);
        $query = $this->db->get();
        return $query->row_array();
    }
  
    function edit_country($data) {
        $this->db->update("country", $data, array('iCountryId' => $data['iCountryId']));
        return $this->db->affected_rows();
    }
    function add_country($data) {
        $this->db->insert('country', $data);
        return $this->db->insert_id();
    }
   
    function get_all_country() {
        $this->db->select('');
        $this->db->from('country');
        $this->db->order_by('iCountryId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function country_exists($country) {
        // $country =  urldecode($country);
        $this->db->select('');
        $this->db->from('country');
        $this->db->like('vCountry', $country);
        $query = $this->db->get();
        return $query->result_array();
    }
    function countryCode_exists($code) {
        $this->db->select('');
        $this->db->from('country');
        $this->db->like('vCountryCode', $code);
        $query = $this->db->get();
        return $query->result_array();
    }
    function countryISDCode_exists($Isdcode) {
        $this->db->select('');
        $this->db->from('country');
        $this->db->like('vIsdCode', $Isdcode);
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());exit;
        return $query->result_array();
    }
     function checkEmailExistFromCountry($vCountry){
        $this->db->select('vCountry');
        $this->db->from('country');
        $this->db->where('vCountry',$vCountry);
        $query = $this->db->get();
        $row=$query->num_rows();
        if($row > 0){
            return 'YES';
        }else{
            return 'NO';
        } 
    }
}
?>
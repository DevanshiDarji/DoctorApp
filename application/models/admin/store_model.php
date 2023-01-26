<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllStoreList(){
        $this->db->select('u.*');
        $this->db->from('store as u');
        $this->db->order_by('u.iStoreId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }

 
    function getDetails($table,$where) {
        $this->db->select('');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    } 
 
    function singleJoinDetails($query=array()) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition']);        
         $this->db->where($query['where']);
        $query = $this->db->get();
         return $query->result_array();
    }
    
}
?>
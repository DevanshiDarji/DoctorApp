<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllOfferList(){
        $this->db->select('u.*');
        $this->db->from('offer as u');
        $this->db->order_by('u.iOfferId','desc');
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
    function tripleJoinDetails($query=array()) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition1']);
        $this->db->join($query['table3'], $query['joinCondition2']);        
         $this->db->where($query['where']);
        $query = $this->db->get();
         return $query->result_array();
    }
    
}
?>
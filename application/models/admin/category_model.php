<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function getCategoryDetails(){
    	$this->db->select('');
        $this->db->from('category');
        $this->db->order_by('iCategoryId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function save($Data){
        $this->db->insert('category',$Data);
        return $this->db->insert_id();
    }

    function get_category_details($iCategoryId){
        $this->db->select('');
        $this->db->from('category');
        $this->db->where('iCategoryId', $iCategoryId);
        $query = $this->db->get();
        return $query->row_array();
    }

    function edit_category($data){
        $this->db->update("category", $data, array('iCategoryId' => $data['iCategoryId']));
        return $this->db->affected_rows();
    }
    function delete_categoryimage($iProductImageid){
        $this->db->where('iCategoryId',$iProductImageid);
        $this->db->delete('category');
    }

    
}
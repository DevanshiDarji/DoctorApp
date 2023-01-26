<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staticpage_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function count_staticpage() {
        return $this->db->count_all("static_pages");
    }
    function count_all() {
        $this->db->select("COUNT('iSPageId') AS tot");
        $this->db->from('static_pages');
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_staticpage() {
        $this->db->select('iSPageId,vPageName,tContent_en,iOrderNo,vPageTitle,eStatus');
        $this->db->select("DATE_FORMAT(dAddedDate,'%Y %M %d') As dAddedDate", FALSE);
        $this->db->from('static_pages');
        $this->db->order_by('iSPageId', 'desc');
        //$this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    function add_staticpage($data) {
        $this->db->insert('static_pages', $data);
        return $this->db->insert_id();
    }
    function edit_staticpage($data) {
        $this->db->update("static_pages", $data, array('iSPageId' => $data['iSPageId']));
        return $this->db->affected_rows();
    }
    function get_staticpage_details($iSPageId) {
        $this->db->select('iSPageId,vPageName,tContent_en,iOrderNo,vPageTitle,dAddedDate,eStatus');
        $this->db->from('static_pages');
        $this->db->where('iSPageId', $iSPageId);
        $query = $this->db->get();
        return $query->row_array();
    }
}
?>
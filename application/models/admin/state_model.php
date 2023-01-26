<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class State_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function count_state() {
        return $this->db->count_all("state");
    }
    function get_state($limit, $start) {
        $this->db->select('s.iStateId,s.iCountryId,s.vState,s.eStatus,c.vCountry');
        $this->db->from('state as s');
        $this->db->join('country as c', 's.iCountryId =c.iCountryId');
        $this->db->limit($limit, $start);
        $this->db->order_by('iStateId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function edit_state($data) {
        $this->db->update("state", $data, array('iStateId' => $data['iStateId']));
        return $this->db->affected_rows();
    }
    function add_state($data) {
        $this->db->insert('state', $data);
        return $this->db->insert_id();
    }
    function get_all_state() {
        $this->db->select('s.iStateId,s.iCountryId,s.vState,s.eStatus,c.vCountry');
        $this->db->from('state as s');
        $this->db->join('country as c', 's.iCountryId =c.iCountryId');
        $this->db->order_by('s.iStateId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_state_details($iStateId) {
        $this->db->select('');
        $this->db->from('state');
        $this->db->where('iStateId', $iStateId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_allstates($iCountryId) {
        $this->db->select('s.iStateId,s.iCountryId,s.vState');
        $this->db->from('state as s');
        $this->db->where('s.iCountryId', $iCountryId);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
    function state_exists($state) {
        $state = urldecode($state);
        $this->db->select('');
        $this->db->from('state');
        $this->db->like('vState', $state);
        $query = $this->db->get();
        return $query->result_array();
    }
    function stateCode_exists($code) {
        $this->db->select('');
        $this->db->from('state');
        $this->db->like('vStatecode', $code);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getStateCount() {
        $this->db->select('s.iStateId,s.iCountryId,s.vState,s.eStatus,c.vCountry');
        $this->db->from('state as s');
        $this->db->join('country as c', 's.iCountryId =c.iCountryId');
        $this->db->order_by('s.iStateId desc');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getAllStateDetails() {
        $this->db->select('s.iStateId,s.iCountryId,s.vState,s.eStatus,c.vCountry');
        $this->db->from('state as s');
        $this->db->join('country as c', 's.iCountryId =c.iCountryId');
        $this->db->order_by('s.iStateId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function checkStateExistFromState($vState){
        $this->db->select('vState');
        $this->db->from('state');
        $this->db->where('vState',$vState);
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
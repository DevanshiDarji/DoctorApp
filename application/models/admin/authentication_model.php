<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /* Check Authentication */
    function check_auth($vEmail, $vPassword) {
        $this->db->select('a.*,at.vType,at.iAdminTypeId');
        $this->db->from('admin as a');
        $this->db->join("admintype as at",'a.iAdminTypeId=at.iAdminTypeId');
        $this->db->where('a.eStatus', 'Active');
        $this->db->where('at.eStatus', 'Active');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('vPassword', $vPassword);
        $query = $this->db->get();
        return $query->row_array();
    }
    
     function get_adminActivationcode($vActivationCode) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('vActivationCode', $vActivationCode);
        $query = $this->db->get();
        return $query->row_array();
    }
    function getStatusLogin($table,$iAdminId) {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('iAdminId', $iAdminId);
        $this->db->where('eStatus', 'Active');
        return $this->db->get()->num_rows();
    }

    function change_password($data) {
        $this->db->update("admin", $data, array('vActivationCode' => $data['vActivationCode']));
        return $this->db->affected_rows();
    }
    //get login detail
    function checkadmin_mail($email) {
        $this->db->select('vEmail,vPassword,vFirstName,vLastName');
        $this->db->from('admin');
        $this->db->where('vEmail', $email);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    } 

    function getUserRecord($vEmail) {
        $this->db->select('iUserId,vEmail');
        $this->db->from('users');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    }  

    function getAdminRecord($vEmail) {
        $this->db->select('iAdminId,vEmail');
        $this->db->from('admin');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    }  

    function updatecode($data){
        $this->db->update("admin", $data, array('vEmail'=>$data['vEmail']));
        return $this->db->affected_rows();     
    }
}
?>
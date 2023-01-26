<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alert_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
 
    function getAllUserList(){
        $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->order_by('u.iUserId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
     function getDetails($table,$where){
        $this->db->select('');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
 
     function edit_user($data) {
        $this->db->update("user", $data, array('iUserId' => $data['iUserId']));
        return $this->db->affected_rows();
    }
    
    function add_user($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
 
    function users_exists($vEmail) {
        $this->db->select('');
        $this->db->from('user');
        $this->db->where('vEmail', $vEmail);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function checkEmailExistFromUser($vEmail){
        $this->db->select('vEmail');
        $this->db->from('user');
        $this->db->where('vEmail',$vEmail);
        $query = $this->db->get();
        $row=$query->num_rows();
        if($row > 0){
            return 'YES';
        }else{
            return 'NO';
        } 
    }

    function checkUserExist($vEmail){
        $this->db->select('u.vEmail,u.iUserId');
        $this->db->from('user as u');
        $this->db->where('u.vEmail',$vEmail);
        $query = $this->db->get();
        return $query->row_array();

    }

    function get_user_details($iUserId) {
        $this->db->select('');
        $this->db->from('user as u');
         $this->db->order_by('u.iUserId','desc');
        $this->db->where('u.iUserId', $iUserId);
        $query = $this->db->get();
        return $query->row_array();
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
    function singleJoinDetails($query=array()) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition']);        
         $this->db->where($query['where']);
        $query = $this->db->get();
         return $query->result_array();
    }
    function add_pushNotificationUser($data){
        $this->db->insert('push_notification_users',$data);
        return $this->db->insert_id();    
    }
     
}
?>
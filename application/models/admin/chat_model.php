<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class chat_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function chatlist($vFirstName){
    	$this->db->select('user.vFirstName');
        $this->db->from('user');
       // $this->db->join('user','user.iUserId=chat.iToUserid','inner');
        $this->db->where('user.iUserId',1); 
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
     public function selectGenralMultipleRow($field,$table,$Where){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    } 


    public function ChatLists($vFirstName){
        $this->db->select('u.vFirstName,c.iFromId,c.iToUserId');
        $this->db->from('chat as c');
        $this->db->join('user as u','c.iFromId=u.iUserId or c.iToUserId=u.iUserId');
        //$this->db->where('c.iFromId=$iFromId and c.iToUserId=$iToUserId or c.iFromId=$iToUserId and c.iToUserId=$iFromId');
        $this->db->where();
        //$this->db->where('u.iUserId=c.iToUserId',$vFirstName);
        $this->db->group_by(array('iFromId','iToUserId'));
        $query = $this->db->get();
       //echo $this->db->last_query();exit;
        return $query->result_array();
    } 
        
}
 ?>
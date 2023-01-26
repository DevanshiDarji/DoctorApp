<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class History_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

  function getAllChatList($whereconditon=array()){
        $this->db->select('us.iUserId as dUserid, uc.iUserId as pUserid, us.vFirstName as dFirstName, uc.vFirstName as pFirstName, us.vLastName as dLastName, uc.vLastName as pLastName');
        $this->db->from('chat as c');
        $this->db->join('user as us','us.iUserId=c.iFromId');
        $this->db->join('user as uc','uc.iUserId=c.iToUserId');
        $this->db->where($whereconditon)->group_by(['c.iFromId', 'c.iToUserId']);
        $this->db->order_by('us.iUserId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getChatDetails($whereconditon=array()){
        $this->db->select('vFirstName,vLastName,eUserType,tMessage,iChatId');
        $this->db->from('chat as c');
        $this->db->join('user as u','c.iFromId=u.iUserId');
        $this->db->where($whereconditon);
        $this->db->order_by('c.iChatId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
     
}
?>
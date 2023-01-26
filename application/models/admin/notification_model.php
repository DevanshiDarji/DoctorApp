<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function getAllNotificationList(){
        //echo "hii";exit;
        $this->db->select('u.vFirstName,u.vLastName,p.tMessage,p.eDateTime');
        $this->db->from('user as u ');
        $this->db->join('push_notification_users as p','u.iUserId=p.iUserId','inner');
        $this->db->order_by('u.iUserId',$iUserId);
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result_array();
    }
}
?>
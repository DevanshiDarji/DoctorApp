<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class notificationtemplate_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   function count_notificationtemplate() {
        $this->db->select('e.iPushNotificationId, e.tText');
        $this->db->from('push_notification_text as e');
        $this->db->order_by('e.iPushNotificationId	 desc');
        return $this->db->count_all_results();
    }
    function get_notificationtemplate() {
        //echo "hii";exit;
        $this->db->select('e.iPushNotificationId, e.tText');
        $this->db->from('push_notification_text as e');
        $this->db->order_by('e.iPushNotificationId	 desc');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
   function add_notificationtemplate($data) {
        $query = $this->db->insert('push_notification_text', $data);
        return $this->db->insert_id();
    }
    function edit_notificationtemplate($data) {
        //echo '<pre>';print_r($data);exit;
        $this->db->update("push_notification_text", $data, array('iPushNotificationId' => $data['iPushNotificationId']));
        return $this->db->affected_rows();
    }
    function get_notificationtemplate_details($iPushNotificationId) {
        $this->db->select('e.iPushNotificationId,e.tText');
        $this->db->from('push_notification_text as e');
        $this->db->where('e.iPushNotificationId	', $iPushNotificationId	);
        $query = $this->db->get();
        return $query->row_array();
    }
}
?>
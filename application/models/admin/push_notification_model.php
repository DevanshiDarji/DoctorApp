<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Push_notification_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllUsers($iBranchId){
        $this->db->select('u.*,pu.tText,ut.vType,pu.iNotificationId');
        $this->db->from('push_notification_users as pu');
        $this->db->join('user as u','pu.iUserId=u.iUserId');
        $this->db->join('eUserType as ut','u.eUserType=ut.eUserType');
        $this->db->order_by('u.iUserId','desc');
        $query = $this->db->get();
        echo $this->db->last_query();exit;
        $result=$query->result_array();
        $masterArray=array();
        foreach ($result as $key => $value) {
            $this->db->select('vFirstName,vLastName');
            $this->db->from('user');
            $this->db->where('iUserId',$value['iUserId']);
            $query = $this->db->get();
            $userdata=$query->row_array();
            $masterArray[]=array_merge($value,$userdata);
        }
        return $masterArray;
        
    }
    /*function getAllUsersAdmin($iSchoolId){
        $this->db->select('u.*,pu.tText,ut.vType,pu.iNotificationId');
        $this->db->from('push_notification_users as pu');
        $this->db->join('users as u','pu.iUserId=u.iUserId');
        $this->db->join('usertype as ut','u.iUserTypeId=ut.iUserTypeId');
        $this->db->join('branch as b','b.iBranchId=u.iBranchId');
        $this->db->where('b.iSchoolId',$iSchoolId);
        $this->db->order_by('u.iUserId','desc');
        $query = $this->db->get();
        $result=$query->result_array();
        $masterArray=array();
        foreach ($result as $key => $value) {
            $table='';
            if($value['vType']=='Driver'){
                $table="driver";
            }elseif($value['vType']=='Supervisor'){
                $table="supervisor";
            }elseif($value['vType']=='Parent'){
                $table="parent";
            }
            $this->db->select('vFirstName,vLastName');
            $this->db->from($table);
            $this->db->where('iUserId',$value['iUserId']);
            $query = $this->db->get();
            $userdata=$query->row_array();
            $masterArray[]=array_merge($value,$userdata);
        }
        return $masterArray;
        
    }
     
     function getAllNotificationDetails($iNotificationId){
        $this->db->select('ut.vType,pu.*');
        $this->db->from('push_notification_users as pu');
        $this->db->join('users as u','pu.iUserId=u.iUserId');
        $this->db->join('usertype as ut','u.iUserTypeId=ut.iUserTypeId');
        $this->db->where('iNotificationId',$iNotificationId);
        $query = $this->db->get();
        $result=$query->result_array();
        
        $masterArray=array();
        foreach ($result as $key => $value) {
            $table='';
            if($value['vType']=='Driver'){
                $table="driver";
            }elseif($value['vType']=='Supervisor'){
                $table="supervisor";
            }elseif($value['vType']=='Parent'){
                $table="parent";
            }
            $this->db->select('vFirstName,vLastName');
            $this->db->from($table);
            $this->db->where('iUserId',$value['iUserId']);
            $query = $this->db->get();
            $userdata=$query->row_array();
            $masterArray=array_merge($value,$userdata);
        }
        
        return $masterArray;

    }

    function getAllGeneralNotification(){
        $this->db->select('*');
        $this->db->from('push_notification_general');
        $query = $this->db->get();
        return $query->result_array();

    }
     function getAllGeneralNotificationAdmin($iSchoolId){
        $this->db->select('*');
        $this->db->from('push_notification_general p');
        $this->db->join('branch as b','b.iBranchId=p.iBranchId');
        $this->db->where('b.iSchoolId',$iSchoolId);
        $query = $this->db->get();
        return $query->result_array();

    }

    function getAllUsersType(){
        $this->db->select('iUserTypeId,vType,eStatus');
        $this->db->from('usertype');
        $this->db->where('eStatus','Active');
        $query = $this->db->get();
        return $query->result_array();
    }*/

    function get_device_details($userType){
        $this->db->select('u.iUserId,u.tDevicekey');
        $this->db->from('users as u');
        if ($userType != 'all') {
            $this->db->join('usertype as ut','u.iUserTypeId=ut.iUserTypeId');
            $this->db->where('ut.iUserTypeId',$userType);
        }
        $this->db->where('u.eStatus','Active');
        $query = $this->db->get();
        return $query->result_array();
    }
     function get_userType($userType){
        $this->db->select('*');
        $this->db->from('usertype');
        $this->db->where('iUserTypeId',$userType);
        $this->db->where('eStatus','Active');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_pushNotification($data){
        $this->db->insert('push_notification_text',$data);
        return $this->db->insert_id();
    }
    function addGeneralNotification($data){
        $this->db->insert('push_notification_general',$data);
        return $this->db->insert_id();
    }

    function add_pushNotificationUser($data){
        $this->db->insert('push_notification_users',$data);
        return $this->db->insert_id();   
    }*/

}
?>
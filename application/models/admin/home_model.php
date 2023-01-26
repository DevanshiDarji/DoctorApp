<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class home_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function today_signup_user() {
        $today = date("Y-m-d");
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,eStatus,dCreatedDate,vPhone');
        $this->db->from('users');
        $this->db->where('dCreatedDate', $today);
        $this->db->order_by('iUserId','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    function numberOfRecords($table, $where){
        $this->db->select('');
        $this->db->from($table);
         $this->db->where($where);
         $query = $this->db->get();
        return $query->num_rows();
    }
    function totalTrips($iAdminId){
        $this->db->select('iTripId');
        $this->db->from('tripheader');
        $this->db->where('bDeleted', 0);
        $this->db->where('iCreatedBy', $iAdminId);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function numberOfStudents($iAdminId){
        $this->db->select('iStudentId');
        $this->db->from('student');
        $this->db->where('eStatus', 'Active');
        $this->db->where('iCreatedBy', $iAdminId);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function totalSupervisors($iAdminId){
        $this->db->select('s.iSupervisorId');
        $this->db->from('supervisor as s');
        $this->db->join('users as u','s.iUserId=u.iUserId');
        $this->db->where('u.iCreatedBy', $iAdminId);
        $this->db->where('u.eStatus', 'Active');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function totalStudent($iAdminId){
        $this->db->select('ah.iAttendanceId,t.vTripNum, ad.eAttendance ,s.vStudentName');
        $this->db->from('attandanceheader as ah');
        $this->db->join('attendancedetail as ad','ah.iAttendanceId=ad.iAttendanceId');
        $this->db->join('student as s  ','ad.iStudentId=s.iStudentId');
        $this->db->join('tripheader as t','ah.iTripId=t.iTripId');
        $this->db->where('ah.iCreatedBy', $iAdminId);
        $this->db->where(array('dAttendanceDate >=' =>date("Y-m-d")));
        $this->db->where('t.bDeleted',0);
        $query = $this->db->get();
        return $query->result_array();
    }
      
    function get_currency(){
        $this->db->select('vValue');
        $this->db->from('configurations');
        $this->db->where('vName','CURRENCY');
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['vValue'];
    }

    function get_allstates() {
        $this->db->select('iStateId,vState');
        $this->db->from('state');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_country() {
        $this->db->select('iCountryId,vCountry');
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result_array();
    }

    function change_password($data) {
        $this->db->update("administrator", $data, array('iAdminId' => $data['iAdminId']));
        return $this->db->affected_rows();
    } 
}
?>
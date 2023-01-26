<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function check_auth($vEmail, $vPassword){
		$this->db->select('');
        $this->db->from('users');
        $this->db->where('eStatus', 'Active');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('vPassword', $vPassword);
        $query = $this->db->get();
        return $query->row_array();
	}

	function save($tablename,$Data){
        $this->db->insert($tablename,$Data);
        return $this->db->insert_id();
    }

    function save_subscribe($Data){
    	$this->db->insert('subscribe',$Data);
        return $this->db->insert_id();	
    }

    function save_comments($Data){
    	$this->db->insert('comments',$Data);
        return $this->db->insert_id();		
    }

    function save_requestafreecatalogue($Data){
    	$this->db->insert('request_catalogue',$Data);
        return $this->db->insert_id();		
    }

    function save_copyrightpermission($Data){
    	$this->db->insert('copyrightpermission',$Data);
        return $this->db->insert_id();		
    }

    

	// USE FOR DELETE IMAGE
	function list_sysemaildata($EmailCode) {
		$this->db->select('');
		$this->db->from('emailtemplate');
		$this->db->where('vEmailCode', $EmailCode);
		return $this->db->get();
	}

	// update the status of record (single or multiple)
	function get_update_all($ids, $action, $tableData) {
        $data = array('eStatus' => $action);
		$this->db->where_in($tableData['update_field'], $ids);
		$this->db->update($tableData['tablename'], $data);
		return $this->db->affected_rows();
	}

	// USE FOR GET ALL CATEGORIE'S IMAGE
	function get_category_details($fieldId, $tableData) {
		$this->db->select($tableData['image_field']);
		$this->db->from($tableData['tablename']);
		$this->db->where($tableData['update_field'], $fieldId);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// USE FOR DELETE RECORDS
	function delete_record($ids, $tableData) {
		$this->db->where_in($tableData['update_field'], $ids);
		$this->db->delete($tableData['tablename']);
	}

	// USE FOR DELETE IMAGE
	function delete_image($tableData) {
		$this->db->where($tableData['update_field'], $tableData['field_id']);
		return $this->db->delete($tableData['tablename']);
	}

	function update_record($tableData) {
		$imagefield=$tableData['image_field'];
		$updatedata[$imagefield]='';
		$this->db->where($tableData['update_field'], $tableData['field_id']);
		return $this->db->update($tableData['tablename'],$updatedata);
	}

	// USE FOR DELETE IMAGE
	function get_admin_details($iAdminId,$eUserType) {
		if($eUserType != ''){
            $this->db->select('iAdminId,vFirstName,vLastName,vEmail,vPhone,dCreatedDate,eStatus');
            $this->db->from('admin');
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
        else{
            $this->db->select('iAdminId,vFirstName,vLastName,vEmail,vPhone,dCreatedDate,eStatus');
            $this->db->from('admin');
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
	}


	function get_country_code($iCountryId) {
		$this->db->select('vCountryMobileCode');
		$this->db->from('country');
		$this->db->where('iCountryId', $iCountryId);
		$query = $this->db->get()->row_array();
		return $query['vCountryMobileCode'];
	}

	// Add Contact Us
	function add_contact_us($data) {
		$query = $this->db->insert('contact_us', $data);
		return $this->db->insert_id();
	}

    public function selectGenralSingleRow($field,$table,$Where){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        $query = $this->db->get();
        return $query->row_array();
    } 
    public function selectGenralMultipleRow($field,$table,$Where,$exceptionwhere=''){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        if($exceptionwhere!=''){
            $this->db->where($exceptionwhere);
        }
        $query = $this->db->get();
        /*echo $this->db->last_query();exit;*/
        return $query->result_array();
    }
	


    function get_adminper_details($iAdminId,$eRole){ 
        if($eRole != ''){
            $this->db->select('a.*,aa.*');
            $this->db->select('a.iAdminId as iAdminId');
            $this->db->from('admin as a');
            $this->db->join('acc_mod_per_admin as aa','aa.iAdminId=a.iAdminId','left');
            $this->db->where('a.iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
        else{
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    
    function getmoduleid($vPath){
        $this->db->select('iModuleId,iParentId');
        $this->db->from('admin_modules');
        $this->db->where('eStatus','Active');
        $this->db->where('vPath',$vPath);
        return $this->db->get()->row_array();
    }

  	function get_image_details($fieldId, $tableData) {
        $this->db->select($tableData['image_field']);
        $this->db->from($tableData['tablename']);
        $this->db->where($tableData['update_field'], $fieldId);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    // USE FOR DELETE IMAGE
    function delete_images($tableData) {
        $data[$tableData['image_field']] = '';
        $this->db->where($tableData['update_field'], $tableData['field_id']);
        return $this->db->update($tableData['tablename'], $data);
    }  

    function update_imagetype($tableData){
    	$data[$tableData['image_type']] = 'withouturl';
        $this->db->where($tableData['update_field'], $tableData['field_id']);
        return $this->db->update($tableData['tablename'], $data);
    }

    function getUserIdByHashCode($hashcode){
  		$this->db->select('iUserId');
        $this->db->from('users');
        $this->db->where('vHashCode', $hashcode);
        $query = $this->db->get();
        return $query->row_array();  	
    }
 
 

    function getUsersDataFromUserId($iUserId){
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,vPhone,dCreatedDate,eStatus');
        $this->db->from('users');
        $this->db->where('iUserId', $iUserId);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();     
    } 

    function editResetPassword($data){
    	$this->db->update("users", $data, array('iUserId' => $data['iUserId']));
        return $this->db->affected_rows();
    }

    function saveRecords($tablename,$data){
  		$this->db->insert($tablename, $data);
        return $this->db->insert_id(); 	
    }
 
  
}
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_management extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_management_model', '', TRUE);
        $this->smarty->assign("data", $this->data);
        if (!isset($this->session->userdata['happy_admin_info'])) {
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
        $slug = $this->session->userdata['language_slug'];
        if ($slug == 'english') {
            $this->lang->load('en', trim($slug));
        }
        if ($slug == 'arabic') {
            $this->lang->load('sa', trim($slug));
        }
        $this->data['slug'] = $slug;
        $this->data['language_label'] = $this->lang->language;
    }
    
    function index() {
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $this->data['menuAction'] = 'Administrator';
        $this->data['adminlist']=$this->admin_management_model->getalladmin('Admin',$iAdminId);
        //echo "<pre>";print_r($this->data['adminlist']);
        $this->data['tpl_name'] = "admin/admin_management/view_admin.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    function action_update() {
        $this->data['menuAction'] = 'Administrator';
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'admin';
        $tableData['update_field'] = 'iAdminId';
        $count = $this->update_status($ids, $action, $tableData);
        if ($action == 'Delete') {
            $count = count($ids);
        } else {
            $count = $count;
        }
        $recordtitle = '';
        if ($count > 1) {
            $recordtitle = 'Records';
        } else {
            $recordtitle = 'Record';
        }
        if ($action == 'Delete') {
            $this->session->set_flashdata('message', $this->data['language_label']['Record_Deleted_Successfully']);
        } else {
            $this->session->set_flashdata('message', $this->data['language_label']['Record_Updated_Successfully']);
        }
        redirect($this->data['admin_url'] . 'admin_management');
    }

    function create() {
        $this->data['menuAction'] = 'Administrator';
        $eStatuses = field_enums('admin', 'eStatus');
        $eRole = $this->admin_management_model->getUserType();
        $this->data['admintype'] = $this->admin_management_model->admintype();
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            $admin_detail = $this->input->post();
            $password = $this->input->post('vPassword');
            $admin_detail['vPassword'] = encrypt($this->input->post('vPassword'));
            $admin_detail['dCreatedDate'] = date('Y-m-d');
            $iAdminId = $this->admin_management_model->add_admin($admin_detail);
            $this->session->set_flashdata('message',$this->data['language_label']['Administrator_Added_Successfully']);
            redirect($this->data['admin_url'].'admin_management');
            exit;
        }
        $this->data['tpl_name'] = "admin/admin_management/add_edit_admin.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eRole', $eRole);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    function update() {
        $this->data['menuAction'] = 'Administrator';
        $eStatuses = field_enums('admin', 'eStatus');
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $iAdminId = $this->uri->segment(4);
        $superAdminType = $this->data['happy_admin_info']['vType'];
        $this->data['admin'] = $this->admin_management_model->get_admin_details($iAdminId);
        $this->data['admintype'] = $this->admin_management_model->admintype();
        
        if ($this->input->post()) {
            $admin_detail['iAdminId'] = $this->input->post('iAdminId');
            $admin_detail['vFirstName'] = $this->input->post('vFirstName');
            $admin_detail['vLastName'] = $this->input->post('vLastName');
            $admin_detail['vEmail'] = $this->input->post('vEmail');
            $admin_detail['vPhone'] = $this->input->post('vPhone');
            $admin_detail['tAddress'] = $this->input->post('tAddress');
            $admin_detail['eStatus'] = $this->input->post('eStatus');
            $admin_detail['dModifiedDate'] = date('Y-m-d');
            $iAdminId = $this->admin_management_model->edit_admin($admin_detail);
            $this->session->set_flashdata('message', $this->data['language_label']['Admin_Profile_Details_Updated_Successfully']);
            redirect($this->data['admin_url'] . 'admin_management');
            exit;
        }
        $this->data['iAdminId'] = $iAdminId;
        $this->data['tpl_name'] = "admin/admin_management/add_edit_admin.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('vType', $superAdminType);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function update_profile() {
        $this->data['menuAction'] = 'Administrator';
        $eStatuses = field_enums('admin', 'eStatus');
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $iAdminId = $this->uri->segment(4);
        $this->data['admin_detail'] = $this->admin_management_model->get_admin_details($iAdminId);
        if ($this->input->post()) {
            $admin_detail['iAdminId'] = $this->input->post('iAdminId');
            $admin_detail['vFirstName'] = $this->input->post('vFirstName');
            $admin_detail['vLastName'] = $this->input->post('vLastName');
            $admin_detail['vEmail'] = $this->input->post('vEmail');
            $admin_detail['vPhone'] = $this->input->post('vPhone');
            $admin_detail['tAddress'] = $this->input->post('tAddress');
            $admin_detail['dModifiedDate'] = date('Y-m-d');
            $admin_detail['eStatus'] = 'Active';
            $iAdminId = $this->admin_management_model->edit_admin($admin_detail);
            $this->session->set_flashdata('message',  $this->data['language_label']['Admin_Profile_Details_Updated_Successfully']);
            redirect($this->data['admin_url'] . 'admin_management/update_profile/'.$admin_detail['iAdminId']);
            exit;
        }
        $this->data['iAdminId'] = $iAdminId;
        $this->data['tpl_name'] = "admin/admin_management/add_edit_admin_profile.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eRole', $eRole);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function edit(){
        $this->data['menuAction'] = 'Administrator';
        if($this->input->post()){
            $ListingiId = $this->input->post('ListingiId');
            $AddiId = $this->input->post('AddiId'); 
            $UpdateiId = $this->input->post('UpdateiId');
            $DeleteiId = $this->input->post('DeleteiId');
            $ActiveiId = $this->input->post('ActiveiId');
            $InactiveiId = $this->input->post('InactiveiId');
            $iAdminId = $this->input->post('iAdminId');
            
            $Data['iAdminId'] = $iAdminId;
            if(count($ListingiId) > 0){
                $Data['tListing'] = @implode(",",$ListingiId);
            }else{
                $Data['tListing'] = "";
            }
            if(count($AddiId) > 0){
                $Data['tAdd'] = @implode(",",$AddiId);
            }else{
                $Data['tAdd'] = "";
            }
            if(count($UpdateiId) > 0){
                $Data['tUpdate'] = @implode(",",$UpdateiId);
            }else{
                $Data['tUpdate'] = "";
            }
            if(count($DeleteiId) > 0){
                $Data['tDelete'] = @implode(",",$DeleteiId);
            }else{
                $Data['tDelete'] = "";
            }
            if(count($ActiveiId) > 0){
                $Data['tActive'] = @implode(",",$ActiveiId);
            }else{
                $Data['tActive'] = "";
            }
            if(count($InactiveiId) > 0){
                $Data['tInactive'] = @implode(",",$InactiveiId);
            }else{
                $Data['tInactive'] = "";
            }

            if($iAdminId){
                $resultArr =  $this->admin_management_model->checkmodules($iAdminId);
                if(count($resultArr) > 0){
                    $this->admin_management_model->deletemodules($iAdminId);                   
                }
                $id = $this->admin_management_model->save($Data);      
                $this->session->set_flashdata('message',"Access Permission Updated Successfully.");
                redirect($this->data['admin_url'].'admin_management');
           }
        }
    }

    function checkEmailExist(){
        $iAdminId=$this->uri->segment(4);
        $oldAdminEmail=$this->admin_management_model->getAdminEmailDetailsByAdminId($iAdminId);
        if ($oldAdminEmail['vEmail'] == $_REQUEST['vEmail']) {
            echo json_encode(array('valid' => true));
        }
        else{
            $chekemailfromAdmin=$this->admin_management_model->checkEmailExistFromAdmin($this->input->post('vEmail'));
            if($chekemailfromAdmin == 'YES'){
                echo json_encode(array('valid' => false)); 
            }
            else{ 
                echo json_encode(array('valid' => true));
            }
        }  
    }

    function check_email_exist() {
        $this->data['menuAction'] = 'Administrator';
        $vEmail = $this->input->get('email');
        $db_admin_email = $this->input->get('oldemail');
        if ($vEmail == $db_admin_email) {
            echo "sucess";
        } else {
            $checkexist = $this->admin_management_model->admin_exists($vEmail);
            if ($checkexist != 0) {
                echo "exitst";
            } else {
                echo "Not exitst";
            }
            exit;
        }
    }

    function changepassword(){
        $this->data['menuAction'] = 'Administrator';
        $iAdminId = $this->uri->segment(4);
        /*$this->data['adminlist']=$this->admin_management_model->getalladmin('Admin',$iAdminId);*/

        if ($this->input->post()) {
            $new_password = $this->input->post('vPassword');
            $user['vPassword'] = $this->encrypt($this->input->post('vPassword'));
            $user['iAdminId'] = $this->input->post('iAdminId');
            $user['dModifiedDate'] = date('Y-m-d');
            $this->admin_management_model->change_password($user);
            redirect($this->data['admin_url'].'home');
        }
        $this->data['tpl_name'] = "admin/home/changepassword.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
        $this->smarty->assign('iAdminId', $iAdminId);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
}
?>
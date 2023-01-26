<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_model', '', TRUE);
        $this->load->model('admin/common_model', '', TRUE);
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
        $this->smarty->assign("data", $this->data);
    }
    
    //load user listing
    function index() {
        $this->data['menuAction'] = $this->input->get('eUserType');
        $Where = array('eUserType'=>$this->input->get('eUserType'));
        $this->data['userlist'] = $this->user_model->getAllUserList($Where);
        $this->data['tpl_name'] = "admin/user/view_user.tpl";
        $this->data['eUserType'] = $this->input->get('eUserType');
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function parentRequest(){
        $this->data['menuAction'] = 'parentRequest';
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $branchInfo =$this->user_model->getAllBranchInfo($iAdminId);
        /*echo "<pre>";print_r($iAdminId);exit;*/
        $this->data['parentlist'] = $this->user_model->getAllParentListRequest($iAdminId);
        $this->data['tpl_name'] = "admin/user/view_requests.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    //create user
    function create() {
        $this->data['menuAction'] = 'Doctor';
        $eStatuses = field_enums('user', 'eStatus');
        $eGender = field_enums('user', 'eGender');
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) { 
            $userData['vFirstName'] = $this->input->post('vFirstName');
            $userData['vLastName'] = $this->input->post('vLastName');
            $userData['vEmail'] = $this->input->post('vEmail');
            $userData['vPassword'] = encrypt($this->input->post('vPassword'));
            $userData['eGender'] = $this->input->post('eGender');
            $userData['eUserType'] = "Doctor";
            $userData['vDegree']=$this->input->post('vDegree');
            $userData['tClinic']=$this->input->post('tClinic');
            $userData['vPhone'] = $this->input->post('vPhone');
            $userData['tAddress'] = $this->input->post('tAddress');
            $userData['dCreatedTime'] = date('Y-m-d');
             $iUserId = $this->user_model->add_user($userData);
            if($_FILES['vImage']['name']!=''){
                    $size['width']=$this->input->post('width')*0.25;
                    $size['height']=$this->input->post('height')*0.25;
                    $fileuploded=$this->do_upload_img($iUserId,'user','vImage',$size);
                    $userdata['vImage']=$fileuploded;
                    $userdata['iUserId']=$iUserId;
                    
                    $Where=[];
                    $Where1['iUserId']=$iUserId;
                    $this->user_model->edit_user($userdata);
                }
            $bodyArr = array("#NAME#", "#EMAIL#", "#Password#");
            $postArr = array($userData['vFirstName'], $this->input->post('vEmail'),$userData['vPassword']);
            $sendAdmin = $this->Send("REGISTER_DOCTOR", $this->input->post('vEmail'), $bodyArr, $postArr);
            $this->session->set_flashdata('message', $this->data['language_label']['User_added_successfully']);
            redirect($this->data['admin_url'] . 'user?eUserType=Doctor');
            exit;
        }
        $this->data['tpl_name'] = "admin/user/add_edit_user.tpl";
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eGender', $eGender);
        $this->smarty->assign('getCountry', $getCountry);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function get_states() {
        $iCountryId = $this->uri->segment(4);
        $states = $this->common_model->get_allstates($iCountryId);
        $options = '';
        if (count($states) > 0) {
            $options.= '<option value="">-- Select State--</option>';
            for ($i = 0;$i < count($states);$i++) {
                $options.= '<option value="' . $states[$i]['iStateId'] . '">' . $states[$i]['vState'] . '</option>';
            }
        } else {
            $options.= '<option value="">-- Select State--</option>';
        }
        $json_lang = json_encode($options);
        print $json_lang;
        exit;
    }

    function get_city() {
        $iStateId = $this->uri->segment(4);
        $states = $this->common_model->get_allcities($iStateId);
         $options= '<option value="">-- Select City--</option>';
         if (count($states) > 0) {
            for ($i = 0;$i < count($states);$i++) {
                $options.= '<option value="' . $states[$i]['iCityId'] . '">' . $states[$i]['vCity'] . '</option>';
            }
        }  
        $json_lang = json_encode($options);
        print $json_lang;
        exit;
    }

    //Parent Update
    function update() {
        $this->data['menuAction'] = 'user';
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $eStatuses = field_enums('user', 'eStatus');
        $eGender = field_enums('user', 'eGender');
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $iUserId = $this->uri->segment(4);
        $this->data['user_detail'] = $this->user_model->get_user_details($iUserId);
        if ($this->input->post()) {
            $iUserId = $this->input->post('iUserId');
            $userData['iUserId'] = $iUserId;
            $userData['vFirstName'] = $this->input->post('vFirstName');
            $userData['vLastName'] = $this->input->post('vLastName');
            $userData['vEmail'] = $this->input->post('vEmail');
            $userData['vPhone'] = $this->input->post('vPhone');
            $userData['vDegree']=$this->input->post('vDegree');
            $userData['tClinic']=$this->input->post('tClinic');
            if ($this->input->post('vPassword')) {
                $userData['vPassword'] = encrypt($this->input->post('vPassword'));
            }
            $userData['eGender'] = $this->input->post('eGender');
            $userData['eStatus'] = $this->input->post('eStatus');
            $userData['tAddress'] = $this->input->post('tAddress');
            $userData['dUpdatedTime'] = date('Y-m-d');
            $this->user_model->edit_user($userData);
            if($_FILES['vImage']['name']!=''){
                $size['width']=$this->input->post('width')*0.25;
                $size['height']=$this->input->post('height')*0.25;
                $fileuploded=$this->do_upload_img($iUserId,'user','vImage',$size);
                $Imagedatastore['vImage']=$fileuploded;
                $Imagedatastore['iUserId']=$iUserId;
                $Where['iUserId']=$this->input->post('iUserId');
                $profileExists=$this->user_model->edit_user($Where);
               if(count($profileExists)>0){
                    $this->user_model->edit_user($Imagedatastore,$Where);
                }else{
                    $this->user_model->add_user($Imagedatastore);
                }
            }
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $this->session->set_flashdata('message', $this->data['language_label']['User_updated_successfully']);
            redirect($this->data['admin_url'] . 'user?eUserType=Doctor');
            exit;
        }
        $this->data['tpl_name'] = "admin/user/add_edit_user.tpl";
        $this->smarty->assign('getCountry', $getCountry); 
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eGender', $eGender);
        $this->smarty->assign('iUserId', $iUserId);
        $this->smarty->view('admin/admin-template.tpl');
    }

 
 //load Trip Details
    function detail(){
        $this->data['menuAction'] = 'user';
        $iUserId = $this->uri->segment(4);
        $this->data['user_info']=$this->user_model->get_user_details($iUserId);
        $this->data['tpl_name'] = "admin/user/user_detail.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    //update status
    function action_update() {
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $eUserType = $this->input->post('eUserType');
        $tableData['tablename'] = 'user';
        $tableData['update_field'] = 'iUserId';
        $count = $this->update_status($ids, $action, $tableData);
        if ($action == 'Delete') {
            $count = count($ids);
        } else {
            $count = $count;
        }
        $recordtitle= ($count>1)? $this->uri->segment(4).'s':$this->uri->segment(4);
        if ($action == 'Delete') {
            $this->session->set_flashdata('message', $this->data['language_label']['Record_Deleted_Successfully']);
        } else {
            $this->session->set_flashdata('message',  $this->data['language_label']['Record_Updated_Successfully']);
        }
        redirect($this->data['admin_url'] . 'user?eUserType='.$eUserType);
    }

    function sendNotification(){
        $id = explode(',', $this->input->post('iIdval'));
        $vMsg = $this->input->post('notificationMsg');
        $action = $this->input->post('action');
        $count = count($id);

        for ($i=0; $i < $count; $i++) { 
            $getUserDetail = $this->user_model->getUserDetailById($id[$i], $this->input->post('vType'), $action);
            $notifyData['tDevicekey'] = $getUserDetail['tDevicekey'];
            $notifyData['tMessage'] = $vMsg;
            $sendMsg = $this->PushNotification($notifyData);
            $pushData['iUserId'] = $getUserDetail['iUserId'];
            $pushData['tText'] = $vMsg;
            $pushData['eRead'] = 'UR';
            $pushData['eDateTime'] = date('Y-m-d H:i:s');
            $this->user_model->add_pushNotificationUser($pushData);
        }
        $this->session->set_flashdata('message',$this->data['language_label']['Notification_send_successfully']);
        redirect($this->data['admin_url'] . 'user/'.$action);
        exit;

    }

	/* Implement By :  Hardik*/
    function changRequestNotification($iUserId,$vMsg){
        $getUserDetail = $this->user_model->GetUsertabledetails($iUserId);
        $notifyData['tDevicekey'] = $getUserDetail['tDevicekey'];
        $notifyData['tMessage'] = $vMsg;
        $sendMsg = $this->PushNotification($notifyData);
        $pushData['iUserId'] = $getUserDetail['iUserId'];
        $pushData['tText'] = $vMsg;
        $pushData['eRead'] = 'UR';
        $pushData['eDateTime'] = date('Y-m-d H:i:s');
        $this->user_model->add_pushNotificationUser($pushData);
        exit;
    }

    function check_Email() {
        
        if (trim($_REQUEST['vEmail']) == trim($_REQUEST['email'])) {
            echo json_encode(array('valid' => true));
        }else{
            $getUserDetail = $this->user_model->checkEmailExistFromUser($_REQUEST['vEmail']);
           
            if ($getUserDetail == 'YES') {
                echo json_encode(array('valid' => false));
            } else {
                echo json_encode(array('valid' => true));
            }
        }
    }

    function checkEmailExist(){
        $iAdminId=$this->uri->segment(4);
        $oldAdminEmail=$this->admin_management_model->getAdminEmailDetailsByAdminId($iAdminId);
        if ($oldAdminEmail['vEmail'] == $_REQUEST['vEmail']) {
            echo json_encode(array('valid' => true));
        }else{
            $chekemailfromAdmin=$this->admin_management_model->checkEmailExistFromAdmin($this->input->post('vEmail'));
            if($chekemailfromAdmin == 'YES'){
                echo json_encode(array('valid' => false)); 
            }
            else{ 
                echo json_encode(array('valid' => true));
            }
        }  
    }
}
/* End of file user.php */
/* Location: ./application/controllers/user.php */
?>
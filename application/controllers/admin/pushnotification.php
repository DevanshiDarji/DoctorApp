<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pushnotification extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/push_notification_model', '', TRUE);
        $this->load->model('admin/user_model', '', TRUE);
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
        $this->data['menuAction'] = 'Push Notification';
        $vType = $this->data['happy_admin_info']['vType'];

        $this->data['notificationlist'] = $this->push_notification_model->getAllUsers();
        
        $this->data['tpl_name'] = "admin/Notification/view_Notification.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    /* function detail() {
        $this->data['menuAction'] = 'Notification';
        $iNotificationId = $this->uri->segment(4);
        $this->data['notificationDetails'] = $this->push_notification_model->getAllNotificationDetails($iNotificationId);
        $this->data['tpl_name'] = "admin/Notification/notification_detail.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
*/
    function create() {
        $this->data['menuAction'] = 'Pushnotification';
        $userType = $this->push_notification_model->getAllUsersType();
        //echo "<pre>";print_r($this->data['branchinfo']);exit;
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            $userType = $this->input->post('userType');
            $tTitle = $this->input->post('tTitle');
            $tMessage = $this->input->post('tMessage');
            $device_details = $this->push_notification_model->get_device_details($userType);
            foreach ($device_details as $value) {
                $data['tDevicekey'] = $value['tDevicekey'];
                $data['tTitle'] = $tTitle;
                $data['tMessage'] = $tMessage;
                $datapush = $this->PushNotification($data);
                $pushData['iUserId'] = $value['iUserId'];
                $pushData['tText'] = $tMessage;
                $pushData['eRead'] = 'UR';
                $pushData['eDateTime'] = date('Y-m-d H:i:s');
                $this->user_model->add_pushNotificationUser($pushData);
            }
            
           $genrelnotification['iAdminId']=$this->session->userdata['happy_admin_info']['iAdminId'];
           if($userType=='all'){
            $userType='All';
           }else{
            $result=$this->push_notification_model->get_userType($userType);
            $userType=$result[0]['vType'];
           } 
            $genrelnotification['iBranchId'] = $this->input->post('iBranchId');
            $genrelnotification['userType'] = $userType;
            $genrelnotification['tMessage'] = $tMessage;
            $genrelnotification['vTitle'] = $tTitle;
            $result=$this->push_notification_model->addGeneralNotification($genrelnotification);
            redirect($this->data['admin_url'].'pushnotification');
            exit;
            
        }
        $this->data['tpl_name'] = "admin/Notification/send_pushnotification.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('userType', $userType);
        $this->smarty->view('admin/admin-template.tpl');
    }


   /* function getAllUserByType(){
        $userType = $_REQUEST['userType'];
        $states = $this->push_notification_model->getallstates($iCountryId);
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
    }*/
    
}
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class notificationtemplate extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/notificationtemplate_model', '', TRUE);
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
    
    //notification templated listing
    function index() {
        $this->data['menuAction'] = 'notificationTemplate';

        $this->data['all_notificationtemplate'] = $this->notificationtemplate_model->get_notificationtemplate();
             //echo "hii";exit;
        $this->data['tpl_name'] = "admin/notificationtemplate/view-notificationtemplate.tpl";
        
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    //notification templated listing
    function create() {
        $this->data['menuAction'] = 'notificationTemplate';
        $eStatuses = field_enums('notificationtemplate', 'eStatus');
        $eSendTypes = field_enums('notificationtemplate', 'eSendType');
        $this->data['action'] = 'create';
        if ($this->input->post()) {
            $notificationtemplate = $this->input->post();
            $iPushNotificationId = $this->notificationtemplate_model->add_notificationtemplate($notificationtemplate);
            $this->session->set_flashdata('message', $this->data['language_label']['notification_Template_Added_Successfully']);
            redirect($this->data['admin_url'] . 'notificationtemplate');
            exit;
        }
        $this->data['tpl_name'] = "admin/notificationtemplate/add-edit-notificationtemplate.tpl";
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eSendTypes', $eSendTypes);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    //update notification template data.
    function update() {
        $this->data['menuAction'] = 'notificationTemplate';
        $iPushNotificationId = $this->uri->segment(4);
        $this->data['action'] = 'update';
        $this->data['all_notificationtemplate'] = $this->notificationtemplate_model->get_notificationtemplate_details($iPushNotificationId);
        if ($this->input->post()) {
            $notificationtemplate = $this->input->post();
            $iPushNotificationId = $this->notificationtemplate_model->edit_notificationtemplate($notificationtemplate);
            $this->session->set_flashdata('message', 'Notification text updated successfully');
            redirect($this->data['admin_url'] . 'notificationtemplate');
            exit;
        }
        $this->data['tpl_name'] = "admin/notificationtemplate/add-edit-notificationtemplate.tpl";
        $this->smarty->assign('data', $this->data);
         $this->smarty->view('admin/admin-template.tpl');
    }
    
    //update template status
    function action_update() {
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'notificationtemplate';
        $tableData['update_field'] = 'iPushNotificationId';
        if ($action == 'Delete') {
            $count = count($ids);
            $countId = $this->update_status($ids, $action, $tableData);
            $recordtitle = '';
            if ($count >1) {
                $recordtitle = 'Records';
            } else {
                $recordtitle = 'Record';
            }
            $this->session->set_flashdata('message', $this->data['language_label']['Record_Deleted_Successfully']);
        } else {
            $count = $this->update_status($ids, $action, $tableData);
            $recordtitle = '';
            if ($count >1) {
                $recordtitle = 'Records';
            } else {
                $recordtitle = 'Record';
            }
            $this->session->set_flashdata('message', $this->data['language_label']['Record_Updated_Successfully']);
        }
        redirect($this->data['admin_url'] . 'notificationtemplate');
    }
}
/* End of file notificationtemplate.php */
/* Location: ./application/controllers/notificationtemplate.php */
?>
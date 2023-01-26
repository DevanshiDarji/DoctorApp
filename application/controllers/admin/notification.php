<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/Notification_model', '', TRUE);
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
        $this->data['menuAction'] = 'notification';
        $this->data['notificationmsglist'] = $this->Notification_model->getAllNotificationList();
        $this->data['tpl_name'] = "admin/Notification/view_Notification.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
}
?>
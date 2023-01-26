<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class home extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/home_model', '', TRUE);
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
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign("data", $this->data);
    }

    //load dashboard
    function index() {
        $this->data['menuAction'] = 'home'; 
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
        $this->data['tpl_name'] = "admin/home/homes.tpl"; 
        $this->data['doctor'] = $this->home_model->numberOfRecords('user',array('eStatus'=>'Active','eUserType'=>'Doctor'));
        $this->data['patient'] = $this->home_model->numberOfRecords('user',array('eStatus'=>'Active','eUserType'=>'Patient'));
        $this->data['question'] = $this->home_model->numberOfRecords('question',array());
        //$this->data['category'] = $this->home_model->numberOfRecords('category',array('eStatus'=>'Active'));
        //$this->data['offer'] = $this->home_model->numberOfRecords('offer',array('eStatus'=>'Active'));
        //$this->data['store'] = $this->home_model->numberOfRecords('store',array('eStatus'=>'Active'));
        //$this->data['storeuser'] = $this->home_model->numberOfRecords('user',array('eStatus'=>'Active','eUserType'=>'Staff'));
        //$this->data['customer'] = $this->home_model->numberOfRecords('user',array('eStatus'=>'Active','eUserType'=>'Customer'));
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function changepassword() {
        $this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
        $this->data['tpl_name'] = "admin/home/changepassword.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
        if ($this->input->post('vPassword')) {
            $new_password = $this->input->post('vPassword');
            $user['vPassword'] = encrypt($this->input->post('vPassword'));
            $user['iAdminId'] = $this->data['e2l_admin_info']['iAdminId'];
            $this->home_model->change_password($user);
            redirect($this->data['admin_url']);
        }
    }
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */
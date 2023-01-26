<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class history extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/history_model', '', TRUE);
       // $this->load->model('admin/common_model', '', TRUE);
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
    public function historyList() {
        $this->data['menuAction'] = 'history';
        $iUserId = $this->uri->segment(4);
        $this->data['tpl_name'] = "admin/history/chatList.tpl";
        $this->data['chatlist'] = $this->history_model->getAllChatList($whereconditon=array('us.iUserId'=>$iUserId));
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    public function detail(){
        $this->data['menuAction'] = 'history';
        $iFromId = $this->uri->segment(4);
        $iToUserId = $this->uri->segment(5);
        $where="(c.iFromId=$iFromId and c.iToUserId=$iToUserId) or (c.iFromId=$iToUserId and c.iToUserId=$iFromId)";
        $this->data['chatDetail'] = $this->history_model->getChatDetails($where);
        $this->data['tpl_name'] = "admin/history/chatDetail.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
}
?>
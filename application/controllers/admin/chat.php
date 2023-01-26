<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class chat extends Admin_Controller {
	  function __construct() {
       parent::__construct();
       	$this->load->model('admin/chat_model', '', TRUE);

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
    
    function index(){
      $this->data['menuAction'] = 'chat'; 
      $this->data['tpl_name'] = "admin/chat/chatList.tpl";
      $iFromId = $this->input->post('iFromId');
      // $iToUserId = $this->input->post('iToUserId');
      //$where="(iFromId=$iFromId and iToUserId=$iToUserId) or (iFromId=$iToUserId and iToUserId=$iFromId)";
	     //$this->data['chatlist']=$this->chat_model->ChatLists($vFirstName);
       /*$this->data['userlist']=$this->chat_model->selectGenralMultipleRow('vFirstName,vLastName','user',array('iUserid'=>1),$where);*/
	     $this->smarty->assign('data', $this->data);
       $this->smarty->view('admin/admin-template.tpl');
    }
}
?>
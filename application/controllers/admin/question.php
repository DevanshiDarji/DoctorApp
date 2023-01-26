<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class question extends Admin_Controller {
  function __construct() {
        parent::__construct();
       	$this->load->model('admin/question_model', '', TRUE);
       	//$this->load->model('admin/home_model', '', TRUE);
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
		$this->data['menuAction'] = 'question'; 
       	$this->data['tpl_name'] = 'admin/question/question_list.tpl';
       	$this->data['questionlist']= $this->question_model->questionlist();
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
	function detail(){
        $this->data['menuAction'] = 'question';
        $iQuestionId = $this->uri->segment(4);
        $this->data['question'] = $this->question_model->get_question_details($iQuestionId);
        $this->data['answer'] = $this->question_model->get_answer($iQuestionId);
        $this->data['tpl_name'] = 'admin/question/question_detail.tpl';
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function action_delete(){
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'question';
        $tableData['update_field'] = 'iQuestionId';
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
        redirect($this->data['admin_url'] . 'question');
    }
}
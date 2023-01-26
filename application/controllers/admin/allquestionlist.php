<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class allquestionlist extends Admin_Controller {
    function __construct() {
        parent::__construct();
       	$this->load->model('admin/allquestion_model', '', TRUE);
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
		$this->data['menuAction'] = 'allquestionlist'; 
       	$this->data['tpl_name'] = 'admin/question/question_list.tpl';
       	$this->data['questionlist']= $this->allquestion_model->questionlist();
       	//echo "<pre>";
       	//print_r($this->data['questionlist']);exit;
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
	function detail(){
    	$this->data['menuAction'] = 'allquestionlist';
		$iQuestionId = $this->uri->segment(4);
		//echo "<pre>";
        //print_r($iUserid);exit;
       
		$this->data['user_info'] = $this->allquestion_model->get_question_details($iQuestionId);
		 
        //echo "<pre>";
       //print_r($this->data['user_info']);exit;
       $this->data['tpl_name'] = 'admin/question/question_detail.tpl';
        $this->smarty->assign('data', $this->data);
    	$this->smarty->view('admin/admin-template.tpl');
    	 
    }
  }
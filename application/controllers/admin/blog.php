<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class blog extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/blog_model', '', TRUE);
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
        $this->data['menuAction'] = 'blog';
        $this->data['bloglist'] = $this->blog_model->getAllBlogList($iBlogId);
        $this->data['tpl_name'] = "admin/blog/view_Blog.tpl";
         //echo "hii";exit;
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function create1() {

        $this->data['menuAction'] = 'blog';
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        $blogData['BlogLink'] = $this->input->post('BlogLink');
        
        $this->data['blogdata'] = $this->blog_model->add_blog($blogData);
        $this->data['tpl_name'] = "admin/blog/add_edit_blog.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
       
    }

    function create() {
        $this->data['menuAction'] = 'blog';
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) { 
            
            $blogData['BlogLink'] = $this->input->post('BlogLink');
            $this->data['blogdata'] = $this->blog_model->add_blog($blogData);
            $this->session->set_flashdata('message', $this->data['language_label']['User_added_successfully']);
            redirect($this->data['admin_url'] . 'blog');
            exit;
        }
        $this->data['tpl_name'] = "admin/blog/add_edit_blog.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function update() {
        $this->data['menuAction'] = 'blog';
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $iBlogId = $this->uri->segment(4);

        $this->data['blog_detail'] = $this->blog_model->get_blog_details($iBlogId);
        if ($this->input->post()) {
            $iBlogId = $this->input->post('iBlogId');
           // print_r($iBlogId);exit;
            $blogData['BlogLink'] = $this->input->post('BlogLink');
            $this->blog_model->edit_blog($blogData);
        
        $this->session->set_flashdata('message', $this->data['language_label']['Blog_updated_successfully']);
        redirect($this->data['admin_url'] . 'blog');
        exit;
        }
        $this->data['tpl_name'] = "admin/blog/add_edit_blog.tpl";
        
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('iBlogId', $iBlogId);
        $this->smarty->view('admin/admin-template.tpl');
    }


    function action_update() {
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        //$eUserType = $this->input->post('eUserType');
        $tableData['tablename'] = 'blog';
        $tableData['update_field'] = 'iBlogId';
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
        redirect($this->data['admin_url'] . 'blog');
    }

}
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/category_model', '', TRUE);
      
        if (!isset($this->session->userdata['happy_admin_info'])) {
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
        $this->smarty->assign("data", $this->data);
    }
    //load dashboard
    function index() {
        $this->data['menuAction'] = 'category';
        $this->data['categorylist']=$this->category_model->getCategoryDetails();
        $this->data['signupUsers'] = $newUsers;
        $this->data['paging_message'] = 'No Records Found';
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['e2l_admin_info'] = $this->session->userdata['e2l_admin_info'];
        $this->data['tpl_name'] = "admin/category/view_category.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function create(){
        $this->data['menuAction'] = 'category';
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            $category = $this->input->post();
            $iCategoryId = $this->category_model->save($category);
             $this->session->set_flashdata('message', "Category added successfully");
            redirect($this->data['admin_url'] . 'category');
            exit;
        }
        $this->data['tpl_name'] = "admin/category/add_edit_category.tpl";
        $this->smarty->assign('eStatus', $eStatus);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    //update 
    function update() {
        $this->data['menuAction'] = 'Category';
        $iCategoryId = $this->uri->segment(4);
        $this->data['action'] = 'update';
        $this->data['label'] = 'Update';
        $this->data['category'] = $this->category_model->get_category_details($iCategoryId);
        if ($this->input->post()) {
            $category = $this->input->post();
             $iCategoryId = $this->category_model->edit_category($category);
            $this->session->set_flashdata('message', "Category Updated Successfully");
            redirect($this->data['admin_url'] . 'category');
            exit;
        }
        $this->data['tpl_name'] = "admin/category/add_edit_category.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    //Delete
    function action_update() {
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'category';
        $tableData['update_field'] = 'iCategoryId';
        $tableData['folder_name'] = 'category';
        $count = $this->update_status($ids, $action, $tableData);
        if ($action == 'Delete') {
            $count = count($ids);
        } else {
            $count = $count;
        }
        if ($action == 'Delete') {
            $this->session->set_flashdata('message', "Records Deleted Successfully");
        } else {
            $this->session->set_flashdata('message', "Record Updated Successfully");
        }
        redirect($this->data['admin_url'] . 'category');
    }

    //delete images
    function deleteicon() {
        $upload_path = $this->config->item('base_path');
        $iCategoryId = $this->uri->segment(4);
        $categoryField = $this->uri->segment(5);
        $crop_imag = array();
        $tableData['tablename'] = 'category';
        $tableData['update_field'] = 'iCategoryId';
        $tableData['image_field'] = $categoryField;
        $tableData['crop_image'] = $crop_imag;
        $tableData['folder_name'] = 'category';
        $tableData['field_id'] = $iCategoryId;
        $deleteImage = $this->delete_image($tableData);
        redirect($this->data['admin_url'] . 'category/update/' . $iCategoryId);
    }
}
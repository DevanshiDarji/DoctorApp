<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Static_page extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/staticpage_model', '', TRUE);
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

    function index() {
        $this->data['menuAction'] = 'CMS Pages';
        $this->data['AllPages'] = $this->staticpage_model->get_staticpage();
        $this->data['tpl_name'] = "admin/static_page/view-staticpage.tpl";
        $upload_path = $this->config->item('base_path');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function action_update() {
        $this->data['menuAction'] = 'CMS Pages';
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'static_pages';
        $tableData['update_field'] = 'iSPageId';
        $count = $this->update_status($ids, $action, $tableData);
        if ($action == 'Delete') {
            $count = count($ids);
        } else {
            $count = $count;
        }
        $recordtitle = '';
        if ($count > 1) {
            $recordtitle = 'Records';
        } else {
            $recordtitle = 'Record';
        }
        if ($action == 'Delete') {
            $this->session->set_flashdata('message', "Total  ($count) " . $recordtitle . " Deleted Successfully");
        } else {
            $this->session->set_flashdata('message', "Total  ($count) " . $recordtitle . " Updated Successfully");
        }
        redirect($this->data['admin_url'] . 'static_page');
    }

    function create() {
        $this->data['menuAction'] = 'CMS Pages';
        $eStatuses = field_enums('static_pages', 'eStatus');
        $totalRec = $this->staticpage_model->count_all();
        $this->data['totalRec'] = $totalRec['tot'];
        $this->data['initOrder'] = 1;
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            $spage = $this->input->post();
            $spageData['vPageName'] = $spage['vPageName'];
            $spageData['vPageTitle'] = strtoupper(str_replace(' ', '', $spage['vPageName']));
            $spageData['eStatus'] = $spage['eStatus'];
            $spageData['tContent_en'] = stripslashes($spage['tContent']);
            $spageData['dAddedDate'] = date("Y-m-d");
            $iSPageId = $this->staticpage_model->add_staticpage($spageData);
            $this->session->set_flashdata('message', "Static Page Added Successfully");
            redirect($this->data['admin_url'] . 'static_page');
            exit;
        }
        $this->data['tpl_name'] = "admin/static_page/static_page.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function update() {
        $this->data['menuAction'] = 'CMS Pages';
        $eStatuses = field_enums('static_pages', 'eStatus');
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $iSPageId = $this->uri->segment(4);
        $totalRec = $this->staticpage_model->count_all();
        $this->data['totalRec'] = $totalRec['tot'];
        $this->data['initOrder'] = 1;
        $this->data['page'] = $this->staticpage_model->get_staticpage_details($iSPageId);
        if ($this->input->post()) {
            $spage = $this->input->post();
            $spageData['vPageName'] = $spage['vPageName'];
            $spageData['vPageTitle'] = strtoupper(str_replace(' ', '', $spage['vPageName']));
            $spageData['eStatus'] = $spage['eStatus'];
            $spageData['tContent_en'] = stripslashes($spage['tContent']);
            $spageData['iSPageId'] = $this->input->post('iSPageId');
            $iSPageId = $this->staticpage_model->edit_staticpage($spageData);
            $this->session->set_flashdata('message', "Static Page Updated Successfully");
            redirect($this->data['admin_url'] . 'static_page');
            exit;
        }
        $this->data['tpl_name'] = "admin/static_page/static_page.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->view('admin/admin-template.tpl');
    }
}
/* End of file static_page.php */
/* Location: ./application/controllers/static_page.php */
?>
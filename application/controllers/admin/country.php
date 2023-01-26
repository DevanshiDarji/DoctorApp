<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Country extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/country_model', '', TRUE);
        $this->load->model('admin/common_model', '', TRUE);
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
    
    //load country listing
    function index() {
        $this->data['menuAction'] = 'Country';
        $this->data['countrylist'] = $this->common_model->getCountryList();
        $this->data['tpl_name'] = "admin/country/view_country.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

   
    //create country
    function create() {
        $this->data['menuAction'] = 'Country';
        $eStatuses = field_enums('country', 'eStatus');
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $vType = $this->data['happy_admin_info']['vType'];
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            
            $countryData['vCountry'] = $this->input->post('vCountry');
            $countryData['eStatus'] = $this->input->post('eStatus');
            
            $iCountryId = $this->country_model->add_country($countryData);
            
            $this->session->set_flashdata('message', 'Country Added Successfully');
            redirect($this->data['admin_url'] . 'country');
            exit;
        }

        $this->data['tpl_name'] = "admin/country/add_edit_country.tpl";
        $this->smarty->assign('eStatuses', $eStatuses);
         $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

  

    //Country Update
    function update() {
        $this->data['menuAction'] = 'Country';
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $eStatuses = field_enums('country', 'eStatus');
        $eGender = field_enums('country', 'eGender');
        $iAdminId = $this->data['happy_admin_info']['iAdminId'];
        $vType = $this->data['happy_admin_info']['vType'];
        $iCountryId = $this->uri->segment(4);
        $this->data['country_detail'] = $this->country_model->get_country_details($iCountryId);
        if ($this->input->post()) {
           
            $countryData['vCountry'] = $this->input->post('vCountry');
            $countryData['iCountryId'] = $this->input->post('iCountryId');
             $countryData['eStatus'] = $this->input->post('eStatus');
            
            $this->country_model->edit_country($countryData);
            
            $this->session->set_flashdata('message', 'Country Updated Successfully');
            redirect($this->data['admin_url'] . 'country');
            exit;
        }
         $this->data['tpl_name'] = "admin/country/add_edit_country.tpl";
         $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
         $this->smarty->view('admin/admin-template.tpl');
    }

  
    //update status
    function action_update() {
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'country';
        $tableData['update_field'] = 'iCountryId';
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
        redirect($this->data['admin_url'] . 'country');
    }

    
 
    function check_Country() {

        if (trim($_REQUEST['vCountry']) == trim($_REQUEST['email'])) {
            echo json_encode(array('valid' => true,));exit;
        }else{
            $getCountryDetail = $this->country_model->checkEmailExistFromCountry($this->input->post('vCountry'));
            if ($getCountryDetail=='YES') {
                echo json_encode(array('valid' => false,));exit;
            } else {
                echo json_encode(array('valid' => true,));exit;
            }
        }
    }

}
/* End of file country.php */
/* Location: ./application/controllers/country.php */
?>
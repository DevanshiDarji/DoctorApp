<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class configuration extends Admin_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('admin/configuration_model', '', TRUE);
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
		$this->data['happy_admin_info'] = $this->session->userdata['happy_admin_info'];
		$this->smarty->assign("data", $this->data);
	}
	//load configuration data
	function index() {
		$this->data['menuAction'] = 'Configuration';
		$this->data['Site_Url'] = $this->data['base_url'];
		$db_config = $this->configuration_model->loadcofig()->result();
		$this->smarty->assign("db_config", $db_config);
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['tpl_name'] = "admin/configuration/edit-configuration.tpl";
		$this->smarty->assign('data', $this->data);
		$this->smarty->view('admin/admin-template.tpl');
	}
	
	//update configuration data.
	function update() {
		if ($this->input->post()) {
			$Data = $this->input->post('Data');
			foreach ($Data as $key => $val) {
				$Value = array('vValue' => $val);
				$where = ' vName  = "' . $key . '"';
				$result = $this->configuration_model->update($Value, $key);
			}
			$this->session->set_flashdata('message', $this->data['language_label']['Settings_Updated_Successfully']);
			redirect($this->data['admin_url'] . 'configuration');
			exit;
		}
		$this->data['tpl_name'] = "admin/configuration/edit-configuration.tpl";
		$this->smarty->assign('data', $this->data);
		$this->smarty->view('admin/admin-template.tpl');
	}
}
/* End of file configuration.php */
/* Location: ./application/controllers/configuration.php */
?>
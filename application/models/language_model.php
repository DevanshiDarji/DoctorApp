<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Language_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function getAllLanguage(){
		$this->db->select('');
        $this->db->from('languages');
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->result_array();
	}
}
?>
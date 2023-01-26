<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Configuration_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function loadcofig() {
        $this->db->order_by('iOrderNo', 'ASC');
        return $this->db->get('configurations');
    }
    function update($data, $key) {
        $this->db->where('vName', $key);
        $query = $this->db->update('configurations', $data);
        return $query;
    }
}
?>
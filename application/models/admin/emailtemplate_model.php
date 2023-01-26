<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class emailtemplate_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function count_emailtemplate() {
        $this->db->select('e.iEmailTemplateId,e.vEmailCode,e.vEmailTitle,e.vFromName,e.vFromEmail,e.eEmailFormat,e.vEmailSubject,e.tEmailMessage,e.vEmailFooter,e.eStatus,e.eSendType');
        $this->db->from('emailtemplate as e');
        $this->db->order_by('e.iEmailTemplateId desc');
        return $this->db->count_all_results();
    }
    function get_emailtemplate() {
        $this->db->select('e.iEmailTemplateId,e.vEmailCode,e.vEmailTitle,e.vFromName,e.vFromEmail,e.eEmailFormat,e.vEmailSubject,e.tEmailMessage,e.vEmailFooter,e.eStatus,e.eSendType');
        $this->db->from('emailtemplate as e');
        $this->db->order_by('e.iEmailTemplateId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function add_emailtemplate($data) {
        $query = $this->db->insert('emailtemplate', $data);
        return $this->db->insert_id();
    }
    function edit_emailtemplate($data) {
        $this->db->update("emailtemplate", $data, array('iEmailTemplateId' => $data['iEmailTemplateId']));
        return $this->db->affected_rows();
    }
    function get_emailtemplate_details($iEmailTemplateId) {
        $this->db->select('e.iEmailTemplateId,e.vEmailCode,e.vEmailTitle,e.vFromName,e.vFromEmail,e.eEmailFormat,e.vEmailSubject,e.tEmailMessage,e.vEmailFooter,e.eStatus,e.eSendType');
        $this->db->from('emailtemplate as e');
        $this->db->where('iEmailTemplateId', $iEmailTemplateId);
        $query = $this->db->get();
        return $query->row_array();
    }
}
?>
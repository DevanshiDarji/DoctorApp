<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function getAllBlogList($iBlogId){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->order_by('iBlogId',$iBlogId);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }

     function add_blog($data) {
        $this->db->insert('blog', $data);
       //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    function edit_blog($data) {
        $this->db->update("blog", $data, array('iBlogId' => $this->input->post('iBlogId')));
       //echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    function get_blog_details($iBlogId) {
        $this->db->select('');
        $this->db->from('blog as b');
         $this->db->order_by('b.iBlogId','desc');
        $this->db->where('b.iBlogId', $iBlogId);
        $query = $this->db->get();
       
        return $query->row_array();
    }
}
?>
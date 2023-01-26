<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class question_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function questionlist(){
        $this->db->select('question.*,user.vFirstName');
        $this->db->from('question');
        $this->db->join('user','user.iUserId=question.iUserId','inner'); 
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    function get_question_details($iQuestionId) {

        $this->db->select('user.vImage,question.*,user.vFirstName');
        $this->db->from('question');
        $this->db->join('user','user.iUserId=question.iUserId','inner'); 
        $this->db->where('question.iQuestionId',$iQuestionId);
        $query = $this->db->get();
            //echo $this->db->last_query();exit;
        return $query->row_array();
    }
    function get_answer($iQuestionId){
        $this->db->select('answer.*,user.vImage,user.vFirstName');
        $this->db->from('answer');
        $this->db->join('user','user.iUserId=answer.iUserId','inner');
        $this->db->where('answer.iQuestionId',$iQuestionId);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
   
}
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class allquestion_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }


/* public function questionlist($wherecondition=array()){
    //echo "hii";exit;
        $this->db->select('user,question.*');
        $this->db->from('question');
        $this->db->join('user','user.iUserid=question.iUserid','inner'); 
        $this->db->where($wherecondition); 
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }*/
     public function questionlist(){
        $this->db->select('question.*,user.vFirstName');
        $this->db->from('question');
        $this->db->join('user','user.iUserid=question.iUserid','inner'); 

        
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    function get_question_details($iQuestionId) {
       $this->db->select('user.vImage,user.vFirstName,question.*');
        $this->db->from('question');
        $this->db->join('user','user.iUserid=question.iUserid','inner'); 
       $this->db->where('question.iQuestionId',$iQuestionId);
        $query = $this->db->get();
       //echo $this->db->last_query();exit;
        return $query->row_array();
    }
}

?>
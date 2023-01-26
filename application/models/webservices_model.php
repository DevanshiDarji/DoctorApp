<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Webservices_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function selectGenralSingleRow($field,$table,$Where){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        $query = $this->db->get();
        return $query->row_array();
    } 

    public function selectGenralMultipleRow($field,$table,$Where){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        if($exceptionwhere!=''){
            $this->db->where($exceptionwhere);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function selectUserMultipleRow($field,$table,$Where,$exceptionwhere){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        $this->db->where_in('eUserStatus', $exceptionwhere);
        $query = $this->db->get();
        return $query->result_array();
    }

    function singleJoinRowDetails($query=array()) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition']); 
        $likeString='';
        if($like!=''){
           $likeString="and (user.vFirstName like '%".$like."%' or user.vLastName like '%".$like."%')"; 
        }       
        $this->db->where($query['where']);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function ChatLists($iFromId,$vFirstName, $number, $size){
        $likeString='';
        if($vFirstName!=''){
            $likeString="and (user.vFirstName like '%".$vFirstName."%')"; 
        }
        $query1 = "SELECT DISTINCT CASE WHEN chat.iFromId = $iFromId THEN chat.iToUserId ELSE chat.iFromId END iUserId FROM chat join user on chat.iToUserId=user.iUserId or chat.iFromId=user.iUserId  WHERE $iFromId IN (chat.iFromId,chat.iToUserId) and user.iUserId!=$iFromId and iDeleteId!=$iFromId $likeString order by chat.iChatId desc  LIMIT $number, $size";
        $query = $this->db->query($query1);
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }

     public function lastMessage($iFromId,$iToUserId){
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where("(iFromId=$iFromId and iToUserId=$iToUserId) or (iFromId=$iToUserId and iToUserId=$iFromId)");
        $this->db->order_by('iChatId',DESC);
        $this->db->limit(1, 0);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->row_array();
    } 
    
    function singleJoinResultDetails($query=array()) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition']);        
        $this->db->where($query['where']);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    function getAnsweredQuestion($iUserId) {
        $this->db->select('iQuestionId');
        $this->db->from('answer as a');
        $this->db->where(array('a.iUserId'=>$iUserId));
        $this->db->group_by('a.iQuestionId'); 

        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllNotificationList($iUserId,$limit,$index){
        $this->db->select('u.vFirstName,u.vLastName,u.vImage,p.tMessage,p.eDateTime,p.iNotificationId');
        $this->db->from('user as u');
        $this->db->join('push_notification_users as p','u.iUserId=p.iFromId','inner');
        $this->db->where('p.iUserId',$iUserId);
        $this->db->limit($limit,$index);
        $this->db->order_by('iNotificationId','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    public function Update($table,$data,$where){

        $this->db->update($table,$data,$where);
        //echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
    
    public function delete($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }
    
    public function insertRecord($table,$data) {
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();
    } 
      
    public function getPushMessage($messageCode){
        $this->db->select('');
        $this->db->from('push_notification_text');
        $this->db->where("vMsgCode", $messageCode);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function numOfRecord($table,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->num_rows();
    }

    public function isThisBlock($iFromId,$iToUserId){
        $this->db->select('');
        $this->db->from('blockunblock');
        $this->db->where("((iFromId=$iFromId and iToUserId=$iToUserId) or (iFromId=$iToUserId and iToUserId=$iFromId))");
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->num_rows();
    }

    public function selectLike($tQuestion,$limit,$index,$wherecondition=array()){
        $this->db->select('user.vImage,question.*');
        $this->db->from('question');
        $this->db->join('user','user.iUserId=question.iUserId','inner'); 
        $this->db->where($wherecondition); 
        if($tQuestion!=''){
            $this->db->like($tQuestion);
        }
        $this->db->limit($limit,$index);
        $this->db->order_by('iQuestionId','DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function selectlimit($field,$table,$limit,$index){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->limit($limit,$index);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function isThisBlockFrom($iFromId,$iToUserId){
        $this->db->select('');
        $this->db->from('blockunblock');
       /* $this->db->where("((iFromUserId=$iFromUserId and iToUserId=$iToUserId) or (iFromUserId=$iToUserId and iToUserId=$iFromUserId))");*/
        $this->db->where("iFromId", $iFromId);
        $this->db->where("iToUserId",$iToUserId);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function userList($field1,$table1,$Where1,$search,$limit,$index){
        $this->db->select($field1);
        $this->db->from($table1);
        $this->db->where($Where1);
    
        if($search!=''){
            $this->db->like($search);
        }
        $this->db->order_by('iUserId','DESC');
        $this->db->limit($limit,$index);
        $query = $this->db->get();
       // echo $this->db->last_query();exit; 
        return $query->result_array();
    }

    public function chatList($field,$table,$limit,$index,$where,$Where){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->limit($limit,$index);
        $this->db->where($where);
       
        $this->db->order_by('iChatId','DESC');
        $query = $this->db->get();
      // echo $this->db->last_query();exit; 
        return $query->result_array();
    }

    public function selectchatUser($field,$table,$Where,$search){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($Where);
        if($search!=''){
            $this->db->like($search);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->row_array();   
    }

    public function insertNotification($table,$where,$data) {
        $this->db->insert($table);
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->row_array();
    } 

    public function getAlldoctorQuesList($iUserId,$limit,$index){
        $this->db->select('answer.*,question.*,user.vImage');
        $this->db->from('question');
        $this->db->join('answer','answer.iQuestionId=question.iQuestionId'); 
        $this->db->join('user','user.iUserId=question.iUserId');
        $this->db->where('answer.iUserId',$iUserId); 
        $this->db->limit($limit,$index);
        $this->db->order_by('iAnswerId','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    function getCustomerStoreProductNotification($iUserId) {
        $this->db->select('');
        $this->db->from('alert as a');
        $this->db->join('offer as o','o.iProductId=a.iProductId'); 
        $this->db->join('product as p','a.iProductId=p.iProductId');           
        $this->db->where(array('a.eStatus'=>'Active','a.iUserId'=>$iUserId));
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getAllBlogList($iBlogId){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->order_by('iBlogId',$iBlogId);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }

   
    function singleJoinDetails($query=array(),$limit,$index) {
        $this->db->select($query['select']);
        $this->db->from($query['table1']);
        $this->db->join($query['table2'], $query['joinCondition']);        
        $this->db->where($query['where']);
        $this->db->limit($limit,$index);
        $this->db->order_by('iQuestionId','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function selectDeleteId($field,$table){
        $this->db->select($field);
        $this->db->from($table);
      //  $this->db->where($Where);
        $query = $this->db->get();
        return $query->row_array();
    } 


}?>
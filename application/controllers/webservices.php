
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//date_default_timezone_set("Asia/Dubai"); 
error_reporting(1);
header('Content-Type: text/html; charset=UTF-8');
class Webservices extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Webservices_model','',true);
    }

   function GetPushMessage($messageCode){
        $message=$this->Webservices_model->getPushMessage($messageCode);
        return $message['tText'];
    }
    
    function logout(){
        if($this->input->post('iUserId')){
            $table='user';
            $where['iUserId']=$this->input->post('iUserId');
            $updatedata['tDevicekey']="";
            $updatedata['vLoginToken']="";
            $this->Webservices_model->Update($table,$updatedata,$where);

            $data['msg'] = "Logout successfully";
            $data['status'] = "1";// inactive
            $data['data'] = [];
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
     function pushNotification($singleID,$tMessage,$payload, $vDeviceType){
        define( 'API_ACCESS_KEY', 'AAAADlJdlOg:APA91bEvBjH6qlRhho4bWZgF24v_-WSu1Wf0NFBpRd2j6NOuzMudYYCV6YrnFPRW4zxponoPJF02KkfUP28qtdNgypSqVkDh-dOAHSrIWet8MV1U7G_VAcZADWuhOVtpLMIjuCR_BgRA3b3iNvpnB54PgFOZi0L8Ew');
       // $singleID = 'f1EkSnZrPEc:APA91bExCuaQnopQ-BvOngFu633yIiALyDHivd5e0-PvujM5FTwqoRseUIdDVN9uDnYe6iJ2UHV632iReqZu0r1UjfBHBtDHH_6_4vYrV929mGeyNv4z8B9seAqOw-4EKID00yI4Q9sHWHSlLpWIPUxUR09INn-FLA';
         //print_r($singleID);exit;
        $icon= $this->data['base_url']."assets/appLogo.png";
        $fcmMsg = array(
            'body' => $tMessage,
            //'title' => 'DoctorApp',
            //'sound' => 'default',
            'content_available'=> 'true',
           // 'icon' =>   $icon,
            //'color' => '#203E78',
        ); 

         $fcmFields = array(
            'to' => $singleID ,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => $payload
        );
    
        $headers = array(
            'Authorization: key=' .API_ACCESS_KEY ,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fcmFields) );
          $result = curl_exec($ch);
        curl_close( $ch );
        // $this->login_history($singleID,$payload,$result);
    }
 

    function forgotpassword(){
        if($this->input->post('vEmail')){
            $field="iUserId,vFirstName,vLastName";
            $table='user';
            $where['vEmail']=$this->input->post('vEmail');
            $user_check_info = $this->Webservices_model->selectGenralSingleRow($field,$table,$where);
            if(count($user_check_info)>0){
                $where=[];$field="";$table="";
                $table='user';
                $where['iUserId']=$user_check_info['iUserId'];
                $password=$this->generateRandomString(6);
                $updatedata['vPassword']=$this->encrypt($password);
                $this->Webservices_model->Update($table,$updatedata,$where);
                //email send
                $name=$user_check_info['vFirstName'].' '.$user_check_info['vLastName'];
            
                $bodyArr = array("#NAME#", "#EMAIL#", "#Password#");
                $postArr = array($name, $this->input->post('vEmail'),$password);
                $sendAdmin = $this->Send("RESET_PASSWORD", $this->input->post('vEmail'), $bodyArr, $postArr);

                $data['msg'] = "Password has been sent successfully to your registered email";
                $data['status'] = "1";
                $data['data'] = [];
            }else{
                $data['msg'] = "User does not exists in our system";
                $data['status'] = "0";
                $data['data'] = [];
            }
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
    function getProfile(){
       $this->checkToken($this->input->post('vLoginToken'));
       if($this->input->post('iUserId') !=''){
        $Where = array('iUserId'=>$this->input->post('iUserId'));
            $data['msg'] = "get user profile successfully";
            $data['status'] = "1";
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['data'] = $this->Webservices_model->selectGenralSingleRow('*','user',$Where);
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    function updateuserprofile(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId')){
            $iUserId=$this->input->post('iUserId');
            $updatedata=[];
            if($this->input->post('vFirstName')!=''){
                $updatedata['vFirstName']=$this->input->post('vFirstName');
            }
            if($this->input->post('vLastName')!=''){
                $updatedata['vLastName']=$this->input->post('vLastName');
            }
            if($this->input->post('vPhone')!=''){
                $updatedata['vPhone']=$this->input->post('vPhone');
            }
            if($this->input->post('tAddress')!=''){
                $updatedata['tAddress']=$this->input->post('tAddress');
            }
            if($this->input->post('vLat')!=''){
                $updatedata['vLat']=$this->input->post('vLat');
            }
            if($this->input->post('vLong')!=''){
                $updatedata['vLong']=$this->input->post('vLong');
            }
            if($this->input->post('eGender')!=''){
                $updatedata['eGender']=$this->input->post('eGender');
            }
            if($this->input->post('vDegree')!=''){
                $updatedata['vDegree']=$this->input->post('vDegree');
            }
            if($this->input->post('tClinic')!=''){
                $updatedata['tClinic']=$this->input->post('tClinic');
            }
            if($this->input->post('tDiseases')!=''){
                $updatedata['tDiseases']=$this->input->post('tDiseases');
            }
            if(count($updatedata)>0){
                $where['iUserId']=$this->input->post('iUserId');
                $this->Webservices_model->Update('user',$updatedata,$where);
            }
            
            if($_FILES['vImage']['name']!=''){
                $size['width']=$this->input->post('width')*0.25;
                $size['height']=$this->input->post('height')*0.25;
                $fileuploded=$this->do_upload_img($iUserId,'user','vImage',$size);
                $Imagedatastore['vImage']=$fileuploded;
                $Imagedatastore['iUserId']=$iUserId;
                $Where['iUserId']=$this->input->post('iUserId');

                $profileExists=$this->Webservices_model->selectGenralSingleRow('iUserId','user',$Where);
               if(count($profileExists)>0){
                    $this->Webservices_model->update('user',$Imagedatastore,$Where);
                }else{
                    $this->Webservices_model->insertRecord('user',$Imagedatastore);
                }
            }
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['data'] = $this->Webservices_model->selectGenralSingleRow('*','user',array('iUserId'=>$iUserId));
            
            $data['msg'] = "Profile details updated successfully";
            $data['status'] = "1";
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
    function addAnswer(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId') != '' && $this->input->post('iQuestionId')!=''&& $this->input->post('tAnswer')!='' ){
            $datainsert['tAnswer'] = $this->input->post('tAnswer');
            $datainsert['iUserId'] = $this->input->post('iUserId');
            $datainsert['iQuestionId'] = $this->input->post('iQuestionId');
            $iAnswerId=$this->Webservices_model->insertRecord('answer',$datainsert);
            $Where['iUserId']=$this->input->post('iUserId');
            $user=$this->Webservices_model->selectGenralSingleRow('vImage','user',$Where);
            
            $query=array(
                'select'=>'user.tDevicekey,user.vDeviceType,user.vFirstName,user.iUserId,user.vLastName,question.iQuestionId',
                'table1'=>'user',
                'table2'=>'question',
                'joinCondition'=>'question.iUserId = user.iUserId',
                'where'=>array('question.iQuestionId'=>$this->input->post('iQuestionId')),
            );            
            
            $reciver = $this->Webservices_model->singleJoinResultDetails($query);
            if($reciver[0]['tDevicekey']!=''){
                
                 $message=array('receiverid'=>$this->input->post('iUserId'),'reciver'=>$reciver, 'type'=>'Ans', 'answer'=>$this->input->post('tAnswer'), 'message'=>$this->input->post('tAnswer'), 'base_url'=>$this->data['base_url'].'uploads/user/');
                 $this->pushNotification($reciver[0]['tDevicekey'],$message['message'],$message,$reciver[0]['vDeviceType']);
                 //$where = array($reciver[0]=>'iUserId');

                $notification['iUserId'] = $reciver[0]['iUserId'];
                $notification['iFromId'] = $this->input->post('iUserId');
                $notification['tMessage'] = $this->input->post('tAnswer');
                $notification['eDateTime'] = $this->input->post('dChatTime');
                $this->Webservices_model->insertRecord('push_notification_users',$notification);
            }    

            $data['msg'] = "Answer Added Successfully";
            $data['status'] = "1";
            $data['data'] = array(
                'iUserId' => $datainsert['iUserId'],
                'iQuestionId' => $datainsert['iQuestionId'] ,
                'tAnswer' => $datainsert['tAnswer'], 
                'vImage' => $user['vImage'], 
                'vFirstName' => $reciver[0]['vFirstName'], 
                'vLastName' => $reciver[0]['vLastName'], 
                'iAnswerId' => $iAnswerId
            );
            $data['base_url'] = $this->data['base_url'].'uploads/user/';

        }else{
            $data['msg'] = "Not enough data passed";
            $data['status'] = "1";
            $data['data'] = [];
        }
         header('Content-type:application/json');
            $callback='';
            if (isset($_REQUEST['callback'])){
                $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
            }
            $main = json_encode($data);
            echo $callback . ''.$main.'';
          exit;
    }

    function viewAnswer(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iQuestionId') !=''){
            $query=array(
                'select'=>'answer.*,user.vImage,user.vFirstName,user.vLastName,user.vEmail,user.eGender,user.vPhone,user.vDegree,user.tClinic',
                'table1'=>'answer',
                'table2'=>'user',
                'joinCondition'=>'user.iUserId = answer.iUserId',
                'where'=>array('answer.iQuestionId'=>$this->input->post('iQuestionId')),
            );
            //print_r($query);exit;
            $query1=array(
                'select'=>'question.*,user.vImage',
                'table1'=>'question',
                'table2'=>'user',
                'joinCondition'=>'user.iUserId = question.iUserId',
                'where'=>array('question.iQuestionId'=>$this->input->post('iQuestionId')),
                );
            
            $tAnswer = $this->input->post('tAnswer');
            
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['msg'] = "Question List";
            $data['status'] = "1";
            $data['data']['question'] = $this->Webservices_model->singleJoinResultDetails($query1);
            //$data['data']['answer'] = $this->Webservices_model->selectGenralMultipleRow('*','answer',$Where);
            $data['data']['answer'] = $this->Webservices_model->singleJoinRowDetails($query);
            $conversation=array();
            foreach ($data['data']['answer'] as $key => $value) {
                $table = 'blockunblock';
                $iFromId=$value['iUserId'];
                $iToUserId=$data['data']['question'][0]['iUserId'];
               // $iFromId=$value['iUserId'];
              //  $data['data']['question']['eBlockStatus']=$this->Webservices_model->isThisBlock($iFromId,$iToUserId);
                $data['data']['answer'][$key]['eBlockStatus']=$this->Webservices_model->isThisBlock($iFromId,$iToUserId);
                }
            }else{
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    function Questions(){
        $this->checkToken($this->input->post('vLoginToken'));
           if($this->input->post('iUserId') !='' || $this->input->post('limit') != '' || $this->input->post('index')!=''){
            $questionIds=$this->Webservices_model->getAnsweredQuestion($this->input->post('iUserId'));
            
            $condition="user.eStatus ='Active'";
            foreach ($questionIds as $key => $value) {
               $condition=$condition." and question.iQuestionId !=".$value['iQuestionId']; 
            }
            //echo "<pre>";print_r($condition);
            $query=array(
                'select'=>'question.*,user.vImage',
                'table1'=>'question',
                'table2'=>'user',
                'joinCondition'=>'question.iUserId = user.iUserId',
                'where'=>$condition,
            );
            //print_r($query);exit;
            $limit = $this->input->post('limit');
            //print_r($limit);exit;
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
           //print_r($index);exit;
            $data['msg'] = "Question  List";
            $data['status'] = "1";// inactive
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['condition'] = $condition;
            $data['data'] = $this->Webservices_model->singleJoinDetails($query,$limit,$index);
             $this->sort_array_of_array1($data['data'], 'iQuestionId');
           //print_r($data['data']);exit;

        }else {
                $data['msg'] = "Not enough data passed";
                $data['status'] = "0";// inactive
                $data['data'] = [];
            }
            header('Content-type:application/json');
            $callback='';
            if (isset($_REQUEST['callback'])){
                $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
            }
            $main = json_encode($data);
            echo $callback . ''.$main.'';
            exit;
    }

    function addquetion(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId') != ''){
            $datainsert['tQuestion']=$this->input->post('tQuestion');
            $datainsert['iUserId']=$this->input->post('iUserId');
            $eUserType=$this->input->post('eUserType');
            $iQuestionId=$this->Webservices_model->insertRecord('question',$datainsert);
            $data['msg'] = "Question Added Successfully";
            $data['status'] = "1";// inactive
            $data['data'] = array('iUserId' => $datainsert['iUserId'], 'tQuestion' => $datainsert['tQuestion'], 'iQuestionId' => $iQuestionId);
        
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type:application/json');
        $callback='';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    function AllquestionList(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('limit') !='' ||  $this->input->post('index') !=''){
            if($this->input->post('iUserId')){
                $Where = array('question.iUserId'=>$this->input->post('iUserId')); 
            }else{
                $Where = array();
            }

            $tQuestion ="";
            if($this->input->post('tQuestion')){
                $tQuestion = array('question.tQuestion'=>$this->input->post('tQuestion'));
            }
            $limit = $this->input->post('limit');
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
        
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['msg'] = "Question List";
            $data['status'] = "1";
           // $data['data'] = $this->Webservices_model->selectGenralMultipleRow('*','question',$Where);
            $data['data'] = $this->Webservices_model->selectLike($tQuestion,$limit,$index,$Where);      
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    public function doctorAnswer(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId') !=''){ 
            $iUserId = $this->input->post('iUserId');
            $questionIds=$this->Webservices_model->getAnsweredQuestion($iUserId);
            $condition='question.iQuestionId !=0';
            foreach ($questionIds as $key => $value) {
               $condition=$condition.' or question.iQuestionId =' .$value['iQuestionId']; 
            }
            $query=array(
                'select'=>'question.*,user.vImage',
                'table1'=>'question',
                'table2'=>'user',
                'joinCondition'=>'question.iUserId = user.iUserId',
                'where'=>$condition,
            );
            $limit = $this->input->post('limit');
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit'); 
            $data['data'] = $this->Webservices_model->singleJoinDetails($query,$limit,$index);
            foreach ($data['data'] as $key => $value) {
                $data['data'][$key]['answers']=$this->Webservices_model->selectGenralMultipleRow('*','answer',array('iUserId'=>$iUserId,'iQuestionId'=>$value['iQuestionId']));
            } 
            $data['base_url'] = $this->data['base_url'].'uploads/user/';
            $data['msg'] = "Question list ";
            $data['status'] = "1";
         }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    public function Blog(){
        $this->checkToken($this->input->post('vLoginToken'));
            if($this->input->post('iBlogId')!=''){
        
            $data['msg'] = "Blog list ";
            $data['status'] = "1";
            $data['data'] = $this->Webservices_model->getAllBlogList($iBlogId);
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    public function notificationList(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId')!= '' && $this->input->post('index') && $this->input->post('limit')){
            $iUserId = $this->input->post('iUserId');
            $limit = $this->input->post('limit');
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
               
            $data['msg'] = "Notification list ";
            $data['status'] = "1";
            $data['data'] = $this->Webservices_model->getAllNotificationList($iUserId,$limit,$index);
        
            foreach($data['data'] as $key => $value) {
            $diff=$this->dateDifference($data['data'][$key]['eDateTime'] , date("Y-m-d h:i:sa"));
                if($diff->y){
                   $data['data'][$key]['eDateTime']= $diff->y.' year ago';
                }else if($diff->m){
                    $data['data'][$key]['eDateTime']= $diff->m.' month ago';
                }else if($diff->d){
                    $data['data'][$key]['eDateTime']= $diff->d.' days ago';
                }
                else if($diff->h){
                    $data['data'][$key]['eDateTime']= $diff->h.' hours ago';
                }
                else if($diff->i){
                    $data['data'][$key]['eDateTime']= $diff->i.' minutes ago';
                }
                else if($diff->s){
                    $data['data'][$key]['eDateTime']= $diff->s.' seconds ago';
                }
            } 
            $this->sort_array_of_array1($data['data'], 'iNotificationId');
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    public function chat(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iToUserId') !='' && $this->input->post('iFromId') !='' && $this->input->post('tMessage') !=''){
            $block=$this->Webservices_model->isThisBlock($this->input->post('iFromId'),$this->input->post('iToUserId'));
            if($block==0){
                $datainsert['iToUserId']=$this->input->post('iToUserId');
                $datainsert['iFromId']=$this->input->post('iFromId');
                $datainsert['tMessage']=$this->input->post('tMessage');
                date_default_timezone_set('Asia/kolkata');
                $datainsert['dChatTime'] = date('Y-m-d H:i:s');
                
                $data['data']=$this->Webservices_model->insertRecord('chat',$datainsert);
                
                $sender = $this->Webservices_model->selectGenralSingleRow('vFirstName,vLastName,vImage','user',array('iUserId'=>$this->input->post('iFromId')));
                $reciver = $this->Webservices_model->selectGenralSingleRow('vFirstName,vLastName,tDevicekey,vDeviceType','user',array('iUserId'=>$this->input->post('iToUserId'))); 
              
                if($reciver['tDevicekey']!=''){
                    $message=array('senderid'=>$this->input->post('iFromId'),'receiverid'=>$this->input->post('iToUserId'),'sender'=>$sender, 'reciver'=>$reciver, 'type'=>'CHAT', 'message'=>$this->input->post('tMessage'), 'base_url'=>$this->data['base_url'].'uploads/user/');
                    $this->pushNotification($reciver['tDevicekey'],$message['message'],$message,$reciver['vDeviceType']);
                    $notification['iUserId'] = $this->input->post('iToUserId');
                    $notification['iFromId'] = $this->input->post('iFromId');
                    $notification['tMessage'] = $this->input->post('tMessage');
                    //date_default_timezone_set('Asia/kolkata');
                    $notification['eDateTime'] = date('Y-m-d H:i:s');
                }    

                $data['msg'] = "Message Added Successfully";
                $data['status'] = "1";
                $table='chat';
                date_default_timezone_set('Asia/kolkata');
                $dChatTime = date('h:ia');
                $data['data'] = array('iToUserId' => $datainsert['iToUserId'],'iFromId' => $datainsert['iFromId'],'tMessage' => $datainsert['tMessage'],'eDateTime'=>$dChatTime);           
            }else{
                    $data['msg'] = "You are blocked so can't do chat.";
                    $data['status'] = "0";// inactive
                    $data['data'] = [];
                }
        } else {
                $data['msg'] = "Not enough data passed";
                $data['status'] = "0";
                $data['data'] = [];
        }
        header('Content-type:application/json');
        $callback='';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
 
     function Delete_Chat(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iToUserId') != '' && $this->input->post('iFromId') !='' ){
            $iDeleteId=$this->input->post('iFromId');
            $toid=json_decode($this->input->post('iToUserId'));
            foreach ($toid as $key => $iToUserId) {
                 $this->Webservices_model->delete('chat',"iDeleteId  >0  and ((iFromId = $iDeleteId and iToUserId = $iToUserId ) or (iToUserId = $iDeleteId and iFromId = $iToUserId ))"); 
                $datadelete['iDeleteId'] = $this->input->post('iFromId');
                $where = "((iFromId = $iDeleteId and iToUserId = $iToUserId ) or (iToUserId = $iDeleteId and iFromId = $iToUserId ))";
                $data['data'] = $this->Webservices_model->Update('chat',$datadelete,$where);
            }
            $data['msg'] = "Youre chat deleted.";
            $data['status'] = "1";
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type:application/json');
        $callback='';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;   
    }

    function conversation(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iToUserId') !='' && $this->input->post('iFromId') !='' && $this->input->post('limit') !='' && $this->input->post('index')!='' ){ 
                $vEmail = $this->input->post('vEmail');
                $field='iChatId, iToUserId, iFromId,tMessage,dChatTime';
                $table='chat';
                $iToUserId = $this->input->post('iToUserId');
                $iDeleteId = $this->input->post('iFromId');
                $datadelete['iDeleteId'] = $this->input->post('iFromId');
                $where = "((iFromId = $iDeleteId and iToUserId = $iToUserId )or(iFromId = $iToUserId and iToUserId = $iDeleteId)) and iDeleteId !=$iDeleteId";
                $limit = $this->input->post('limit');
                $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
                $data['msg'] = "Chat";
                $data['status'] = "1";
                $data['data']= $this->Webservices_model->chatList($field,$table,$limit,$index,$where);
                $chatArray=array();
                $prevDate=date('Y-m-d', strtotime($data['data'][0]['dChatTime']));
                $chatdata=array();
                $this->sort_array_of_array1($data['data'] , 'iChatId');

                foreach ($data['data'] as $key => $value) {

                	if($prevDate !=date('Y-m-d', strtotime($value['dChatTime']))){
	                	$chatArray['data'][]=array('day'=>$day,'data'=>$chatdata);
	                	$chatdata=array(); 		 
                	}

                 	if(date('Y-m-d', strtotime($value['dChatTime']))==date("Y-m-d")){
                       $value['day']= 'Today';
                    }else if(date('Y-m-d',strtotime("-1 days"))==date('Y-m-d', strtotime($value['dChatTime']))){
                        $value['day']= 'Yesterday';
                    }else{
                        $value['day']= date('Y-m-d', strtotime($value['dChatTime']));
                    }
                    $value['time']=date('h:ia', strtotime($value['dChatTime']));
                    $day=$value['day'];
                	$chatdata[]=$value;

                    $prevDate=date('Y-m-d', strtotime($value['dChatTime']));
                }
                if(count($chatdata)){
                	$chatArray['data'][]=array('day'=>$day,'data'=>$chatdata);
                }
                $data['data']=$chatArray['data'];
            }else {
                $data['msg'] = "Not enough data passed";
                $data['status'] = "0";
                $data['data'] = [];
            }
            header('Content-type: application/json');
            $callback = '';
            if (isset($_REQUEST['callback'])){
                $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
            }
            $main = json_encode($data);
            echo $callback . ''.$main.'';
            exit;
    }

    function userList(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('eUserType')!='' || $this->input->post('limit')!='' || $this->index->post('index')!='' || $this->input->post('iFromId') || $this->input->post('iToUserId')){ 
            $field1 = '*';
            $table1 = 'user';
            $Where1 = array('eUserType'=>$this->input->post('eUserType'));
            $eUserType = $this->input->post('eUserType');
            $limit = $this->input->post('limit');
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
            $search = array('vFirstName'=>$this->input->post('vFirstName'));
            $data['data'] = $this->Webservices_model->userList($field1,$table1,$Where1,$search,$limit,$index);
            $conversation=array();
            foreach($data['data'] as $key => $value){
                $iToUserId = $this->input->post('iUserId');
                $iFromId = $value['iUserId'];
                $where = "iToUserId = $iToUserId and iFromId = $iFromId";
                $data['data'][$key]['eBlockStatus'] = $this->Webservices_model->numOfRecord('blockunblock',$where); 
            }
            $this->sort_array_of_array1($data['data'], 'iUserId');
            $data['msg'] = "User List";
            $data['status'] = "1";
            }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
    function chatList(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iFromId')){
            $table = 'blockunblock';
            $iFromId=$this->input->post('iFromId');
            $vFirstName = $this->input->post('vFirstName');
            $size = $this->input->post('limit');
            $index = ($this->input->post('limit')*$this->input->post('index'))-$this->input->post('limit');
            $chatsWith=$this->Webservices_model->ChatLists($iFromId, $vFirstName, $index, $size);
            
            $conversation=array();
            foreach ($chatsWith as $key => $value) {
                $conversation[$key]['iFromId']=$iFromId;
                $user2=$this->Webservices_model->selectGenralSingleRow('vFirstName,vLastName,vImage','user',array('iUserId'=>$value['iUserId']));
                $conversation[$key]['vFirstName']=$user2['vFirstName'];
                $conversation[$key]['vLastName']=$user2['vLastName'];
                $conversation[$key]['iToUserId']=$value['iUserId'];
                $lastMessage=$this->Webservices_model->lastMessage($iFromId,$value['iUserId']);
                $iToUserId = $value['iUserId'];
                $where = "(iToUserId = $iToUserId and iFromId = $iFromId)or(iToUserId = $iFromId and iFromId = $iToUserId)";
                $conversation[$key]['to_name']=$user2['vFirstName'].' '.$user2['vLastName'];
                $conversation[$key]['tMessage']=$lastMessage['tMessage'];
                $conversation[$key]['iChatId']=$lastMessage['iChatId'];
                $conversation[$key]['vImage']=$user2['vImage'];
                $conversation[$key]['vFirstName']=$vFirstName;
                //$conversation[$key]['eBlockStatus']=$this->Webservices_model->isThisBlockFrom($iFromUserId,$value['userID']);
                $conversation[$key]['eBlockStatus']=$this->Webservices_model->numOfRecord($table,$where);
            
                $diff=$this->dateDifference($lastMessage['dChatTime'] , date("Y-m-d h:i:sa"));
                
                if($diff->y){
                    $conversation[$key]['dChatTime']= $diff->y.' year ago';
                }else if($diff->m){
                    $conversation[$key]['dChatTime']= $diff->m.' month ago';
                }else if($diff->d){
                    $conversation[$key]['dChatTime']= $diff->d.' days ago';
                }
                else if($diff->h){
                    $conversation[$key]['dChatTime']= $diff->h.' hours ago';
                }
                else if($diff->i){
                    $conversation[$key]['dChatTime']= $diff->i.' minutes ago';
                }
                else if($diff->s){
                    $conversation[$key]['dChatTime']= $diff->s.' seconds ago';
                } 
               }
                $this->sort_array_of_array1($conversation, 'iChatId');

                $data['base_url'] = $this->data['base_url'].'uploads/user/';
                $data['msg'] = "Chat lists";
                $data['status'] = "1";// inactive
                $data['data'] = $conversation;
        } else {
                $data['msg'] = "not enough data passed";
                $data['status'] = "0";// inactive
                $data['data'] = [];
            }
                header('Content-type: application/json');
                $callback = '';
                if (isset($_REQUEST['callback'])){
                    $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
                }
                $main = json_encode($data);
                echo $callback . ''.$main.'';
                exit;
    }

    function blockUnblockuser(){
        $this->checkToken($this->input->post('vLoginToken'));
       if($this->input->post('iFromId') && $this->input->post('iToUserId') && $this->input->post('eBlockStatus')){
            if($this->input->post('eBlockStatus')==1){
                $table='blockunblock';
                $insertRecord['iFromId']=$this->input->post('iFromId');
                $insertRecord['iToUserId']=$this->input->post('iToUserId');
                //$insertRecord['dDateTime']=date('Y-m-d H:i:s');
                $this->Webservices_model->insertRecord($table,$insertRecord);
                $data['msg'] = "Blocked successfully";
            }else{
                $table='blockunblock';
                $where=array('iFromId'=>$this->input->post('iFromId'),'iToUserId'=>$this->input->post('iToUserId'));
                $this->Webservices_model->delete($table,$where);
                $data['msg'] = "Unblocked Successfully";
            }
            $data['status'] = "1";// inactive
            $data['data'] = [];
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
    function removeNotification(){
        $this->checkToken($this->input->post('vLoginToken'));
       if($this->input->post('iNotificationId')){ 
            $iNotificationId=json_decode($this->input->post('iNotificationId'));
            foreach ($iNotificationId as $key => $value) {
                $this->Webservices_model->delete('push_notification_users',array('iNotificationId'=>$value));
            }
            $data['msg'] = "Notification Deleted Successfully";
            $data['status'] = "1";// inactive
            $data['data'] = [];
        }else{
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }
    
    function login(){  
        // Normal login
        if($this->input->post('vEmail') != '' && $this->input->post('vPassword') != '' && $this->input->post('tDevicekey')!= ''){    
            $vEmail = $this->input->post('vEmail');
            $vPassword = $this->encrypt($this->input->post('vPassword'));
            $field="iUserId,vLoginToken,eUserType,tAddress,vPhone,vFirstName,vLastName,vDegree,tClinic,vDeviceType,tDevicekey,vEmail,vImage,eGender,vLat,vLong,eStatus";
            $table='user';
            $where['vEmail']=$vEmail;
            $where['vPassword']=$vPassword;
            $user_check_info = $this->Webservices_model->selectGenralSingleRow($field,$table,$where);
                if(count($user_check_info)>0){
                    if($user_check_info['eStatus']=='Active'){
                        $user_check_info['base_url']=$this->data['base_url'].'uploads/user/';
                        if($user_check_info['vImage']!=''){
                            $user_check_info['vThumbnail']='thumbnail_'.$user_check_info['vImage'];
                        }else{
                            $user_check_info['vThumbnail']='';
                        }
                        if($user_check_info['vCoverImage']!=''){
                            $user_check_info['vThumbnail_cover']='thumbnail_'.$user_check_info['vCoverImage'];
                        }else{
                            $user_check_info['vThumbnail_cover']='';
                        }
                        $where=[];$field="*";$table="user";
                        $where['iUserId']=$user_check_info['iUserId'];
                        $dataupdate['vLoginToken']=$this->generateRandomString();
                        $dataupdate['tDevicekey']=$this->input->post('tDevicekey');
                        $dataupdate['vLat']=$this->input->post('vLat');
                        $dataupdate['vLong']=$this->input->post('vLong');
                        $table='user';
                        $this->Webservices_model->Update($table,$dataupdate,$where);
                    
                        $user_check_info['vLoginToken']=$dataupdate['vLoginToken'];
                        $user_check_info['tDevicekey']=$dataupdate['tDevicekey'];
                        
                        $data['msg'] = "Login successfully.";
                        $data['status'] = "1";
                        $data['data'] = $user_check_info;
                    }else{
                        $data['msg'] = "Your profile has been deactivated by admin please contact admin.";
                        $data['status'] = "3";// inactive
                        $data['data'] = [];
                    }
                }else {
                    $data['msg'] = "User does not exists or please check your credentials.";
                    $data['status'] = "0";
                    $data['data'] = [];
                }
            }else {
                $data['msg'] = "Not enough data passed";
                $data['status'] = "0";
                $data['data'] = [];
            }
        
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        /*$this->login_history($action,$_REQUEST,$data);*/
        exit;
    }
    
    function register(){
        if($this->input->post('vFirstName') && $this->input->post('vEmail') && $this->input->post('vPhone') && $this->input->post('vPassword')&& $this->input->post('tDevicekey') ){
            
            $Where['vEmail']=$this->input->post('vEmail');
            $table='user';
            $field='iUserId';
            $checkUserExists=$this->Webservices_model->selectGenralSingleRow($field,$table,$Where);
            if(count($checkUserExists)==0){
                $datainsert['vFirstName']=$this->input->post('vFirstName');
                $datainsert['vLastName']=$this->input->post('vLastName');
                $datainsert['vEmail']=$this->input->post('vEmail');
                $datainsert['vPhone']=$this->input->post('vPhone');
                $datainsert['vPassword']=$this->encrypt($this->input->post('vPassword'));
                $datainsert['tAddress']=$this->input->post('tAddress');
                $datainsert['vLoginToken']=$this->generateRandomString();
                //$datainsert['vDegree']=$this->input->post('vDegree');
                //$datainsert['tClinic']=$this->input->post('tClinic');
                $datainsert['vLat']=$this->input->post('vLat');
                $datainsert['vLong']=$this->input->post('vLong');
                $datainsert['eStatus']='Active';
                $datainsert['eGender']=$this->input->post('eGender');
                $datainsert['eUserType']=$this->input->post('eUserType');
                $datainsert['tDevicekey']=$this->input->post('tDevicekey');
                $datainsert['vDeviceType']=$this->input->post('vDeviceType');
                $datainsert['dCreatedTime']=date('Y-m-d');
                $datainsert['dUpdatedTime']=date('Y-m-d');

                $iUserId=$this->Webservices_model->insertRecord('user',$datainsert);
                
                if($_FILES['vImage']['name']!=''){
                    $size['width']=$this->input->post('width')*0.25;
                    $size['height']=$this->input->post('height')*0.25;
                    $fileuploded=$this->do_upload_img($iUserId,'user','vImage',$size);
                    $Imagedatastore['vImage']=$fileuploded;
                    $Imagedatastore['iUserId']=$iUserId;
                    
                    $Where=[];
                    $Where1['iUserId']=$iUserId;
                    $this->Webservices_model->update('user',$Imagedatastore,$Where1);
                }
                $w['iUserId']=$iUserId;
                $du['vLoginToken']=$this->generateRandomString();
                $du['tDevicekey']=$this->input->post('tDevicekey');
                $du['vDeviceType']=$this->input->post('vDeviceType');
                               
                $table='user';
                $field='iUserId,vLoginToken,vPassword,eUserType,tAddress,vPhone,vFirstName,vLastName,vEmail,vImage,eGender,vDegree,tClinic,vLat,vLong,eStatus,tDevicekey,vDeviceType';
                $user_info=$this->Webservices_model->selectGenralSingleRow($field,$table,$w,$du);

                $name=$datainsert['vFirstName'].' '.$datainsert['vLastName'];
                $bodyArr = array("#NAME#", "#EMAIL#", "#Password#");
                $postArr = array($name, $this->input->post('vEmail'),$this->input->post('vPassword'));
                $sendAdmin = $this->Send("REGISTER", $this->input->post('vEmail'), $bodyArr, $postArr);
                $data['msg'] = "Register successfully";
                $data['status'] = "1";
                $data['data'] = $user_info;
            }else{
                $data['msg'] = "Email id already exists please try with another.";
                $data['status'] = "0";
                $data['data'] = [];    
            }    
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

   function login_history($action,$request,$data){
        $this->Webservices_model->add_history($action,json_encode($request),json_encode($data));
        return true;
    }

    function ChangePassword(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('iUserId') && $this->input->post('vPasswordOld') && $this->input->post('vPassword')){
            $field="iUserId";
            $table='user';
            $where['iUserId']=$this->input->post('iUserId');
            $where['vPassword']=$this->encrypt($this->input->post('vPasswordOld'));
            $passexist=$this->Webservices_model->selectGenralSingleRow($field,$table,$where);
            if(count($passexist)>0){
                $updatewhere['iUserId']=$this->input->post('iUserId');
                $updatedata['vPassword']=$this->encrypt($this->input->post('vPassword'));
                $updatedata['dUpdatedTime']=date('Y-m-d H:i:s');
                $passexist=$this->Webservices_model->Update('user',$updatedata,$updatewhere);
                $data['msg'] = "Password updated successfully";
                $data['status'] = "1";
                $data['data'] = [];
            }else{
                $data['msg'] = "Wrong password";
                $data['status'] = "0";
                $data['data'] = [];
            }
        }else {
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        exit;
    }

    function customerNotificationList(){
        $this->checkToken($this->input->post('vLoginToken'));
        if($this->input->post('vLoginToken')){
              //push notification code
            $data['msg'] = "All Offers ";
            $data['status'] = "1";// inactive
             
            $qry=array(
                'select'=>'',
                'table1'=>'offer as o',
                'table2'=>'product as p',
                'joinCondition'=> "o.iProductId = p.iProductId",
                'where'=>array('o.eStatus'=>'Active'),
             );
            $data['data'] =$this->Webservices_model->singleJoinResultDetails($qry);
        }
        else{
            $data['msg'] = "Not enough data passed";
            $data['status'] = "0";// inactive
            $data['data'] = [];
        }
        header('Content-type: application/json');
        $callback = '';
        if (isset($_REQUEST['callback'])){
            $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
        }
        $main = json_encode($data);
        echo $callback . ''.$main.'';
        //$this->login_history($action,$_REQUEST,$data);
        exit;
    }
    
    function distance($lat1, $lon1, $lat2, $lon2, $unit='M') {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    function sort_array_of_array(&$array, $subfield)
    {
        $sortarray = array();
        foreach ($array as $key => $row)
        {
            $sortarray[$key] = $row[$subfield];
        }

        array_multisort($sortarray, SORT_ASC, $array);
    }
    function sort_array_of_array1(&$array, $subfield)
    {
        $sortarray = array();
        foreach ($array as $key => $row)
        {
            $sortarray[$key] = $row[$subfield];
        }

        array_multisort($sortarray, SORT_DESC, $array);
    }

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval;
        
    }
    function testPush(){
        define( 'API_ACCESS_KEY', 'AAAABOl0Xv4:APA91bH3NIJ3ajQsuH-26nvBHmXBILB8y2iOrsoqbkOw9JwEENG_WiElzgb9qKJQRtrLmC3Pefxa-xFa2PpIKh6q370ec7Vp6GC2Y7AdOl_8QSbvO1jppvG0DzJGtsoUURYbG87fV2XO' );
        $singleID = 'fspv1Zz_ig8:APA91bF-jxXrXrFSXR7DcuCHJIYC_4ZIdhHlLhwgN0GcX0lDcgcqaTOmpn0J_HP236J846V8KLv35NSxKivuBgAjtboJYASEQOymJLhEypfvZCd1w9NMuIfb5TvvJPVutPIx4do-5ZOu';
        $icon= $this->data['base_url']."assets/appLogo.png";
        $fcmMsg = array(
            'body' => 'bhasdvbjhabsdva bhavin shah',
            'title' => 'BusApp',
            'sound' => "default",
            'icon' =>$icon,
            'color' => "#203E78",
        );
        $dataPayload = array('type' => 'Chat');
        $fcmFields = array(
            'to' => $singleID ,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => $dataPayload

        );

        $headers = array(
            'Authorization: key=' .API_ACCESS_KEY ,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
        $result = curl_exec($ch);
        curl_close( $ch );
        echo $result . "\n\n";
    }

   function checkToken($token){
        $field='vLoginToken';
        $table="user";
        $Where['vLoginToken']=$token;
        $record=$this->Webservices_model->selectGenralSingleRow($field,$table,$Where);
        /*if(count($record)==0 || $token==''){
            $data['msg'] = "Token Mismatch";
            $data['status'] = "2";
            $data['data'] = [];
            header('Content-type: application/json');
            $callback = '';
            if (isset($_REQUEST['callback'])){
                $callback = filter_var($_REQUEST['callback'], FILTER_SANITIZE_STRING);
            }
            $main = json_encode($data);
            echo $callback . ''.$main.'';
            exit;
        }*/
    }
    function sendsms($msg='test',$numbers)
    {
        $url = "http://smsapi.echances.net/Handler/SendHandler.ashx";
        $domainName = $_SERVER['SERVER_NAME'];
        //$stringToPost = "msg=".$msg."&numbrs=".$numbers."&cmb=966555111123&cp=H0505&sn=ZAINA";       
        $stringToPost = "msg=".$msg."&numbrs=".$numbers."&cmb=966558588600&cp=bass0505&sn=BaasApp";       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $result = curl_exec($ch);
        if(trim($result)=="Sended Successfully.")
        {
            return 1;
        }
        return 0;
    }
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>
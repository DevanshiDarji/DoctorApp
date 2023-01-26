<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/authentication_model', '', TRUE);
        $this->smarty->assign("data", $this->data);
        $this->smarty->assign("Name", "Welcome To Happy Occasion Admin Panel");
    }

    // check authentication
    public function index() {

        /*echo "<pre>";print_r($this->data);exit;*/
        $this->data['message'] = $this->session->flashdata('message');
        if (isset($this->session->userdata['happy_admin_info'])) {
            redirect($this->data['base_url'] . 'admin/home');
        }else if ($this->input->post()) {
            $vEmail = $this->input->post('vEmail');
            $slug = $this->input->post('slug');
            $vPassword = $this->encrypt($this->input->post('vPassword'));
            $auth_exists = $this->authentication_model->check_auth($vEmail, $vPassword);
            if ($auth_exists) {
                $auth_exists['logged_in'] = TRUE;
                $datestring = "%Y-%m-%d  %h:%i:%s";
                $time = time();
                $dLoginDate = mdate($datestring, $time);
                $logindata['iAdminId'] = $auth_exists['iAdminId'];
                $logindata['vFirstName'] = $auth_exists['vFirstName'];
                $logindata['vLastName'] = $auth_exists['vLastName'];
                $logindata['vEmail'] = $auth_exists['vEmail'];
                $logindata['vIP'] = $this->input->ip_address();
                $logindata['dLoginDate'] = $dLoginDate;
                $logindata['iLoginLogId'] = $iLoginLogId;
                $logindata['vType'] = $auth_exists['vType'];

                $dLoginDate = mdate($datestring, $time);
                $this->session->set_userdata('language_slug', $slug);
                $this->session->set_userdata('happy_admin_info', $logindata);
                redirect($this->data['admin_url']);
                exit;
			}else{
                $this->session->set_flashdata('message', $this->data['language_label']['Sorry_Email_Id_or_Password_seems_to_be_wrong']);
                redirect($this->data['admin_url'] . 'authentication');
                exit;
            }
        } else {
            $this->data['language'] = $this->language_model->getAllLanguage();
            $this->data['tpl_name'] = "admin/login.tpl";
            $this->smarty->assign('data', $this->data);
            //echo "<pre>";print_r($this->data);exit;
            $this->smarty->view('admin/login.tpl');
        }
    }

    // forgot passward
    function forgotpassword() {
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "admin/forgotpassword.tpl";
        if ($this->input->post()) {
            $vEmail = $this->input->post('vEmail');
            if ($vEmail) {
                $check_admin_email = $this->authentication_model->getAdminRecord($vEmail);
                if ($check_admin_email['iAdminId']!='') {
                    $name1 = $check_admin_email['vFirstName'] . ' ' . $check_admin_email['vLastName'];
                     $name = ucfirst($name1);
                     $siteurl = $this->config->item('base_url');
                     $MailFooter = $this->data['MAIL_FOOTER'];
                    $siteName = '';
                    if ($_SERVER["HTTP_HOST"] == '') {
                        $baseurl = '';
                    }
                     $image_url = $baseurl;
                    $this->data['COMPANY_NAME'] = '';
                    $vActivationCode = random_string('alnum',10);
                    $link = $siteurl . 'admin/authentication/reset_password/'.$vActivationCode;
                    $forgotdata['vActivationCode'] = $vActivationCode;
                    $forgotdata['vEmail'] = $vEmail;
                    $iUserId = $this->authentication_model->updatecode($forgotdata);
                    $bodyArr = array("#NAME#", "#EMAIL#", "#SITEURL#", "#MAILFOOTER#", "#LINK#", "#SITE_NAME#", "#IMAGE_URL#");
                    $postArr = array($name, $vEmail, $siteurl, $MailFooter, $link, $siteName, $image_url);
                    $sendAdmin = $this->Send("FORGOT_PASSWORD", $vEmail, $bodyArr, $postArr);
                    $this->session->set_flashdata('message', 'Link to reset Password is sent to your email');
                    $this->smarty->assign('data', $this->data);
                    redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                    exit;
                }else{
                    $this->session->set_flashdata('message','Sorry Email doese not exist');
                    $this->smarty->assign('data', $this->data);
                    redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                    exit;
                }
            }else{
                $this->session->set_flashdata('message','Please Enter valid email');
                $this->smarty->assign('data', $this->data);
                redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                exit;
            }
        }
        $this->data['path'] = $this->config->item('base_url');
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/forgotpassword.tpl');     
    }

    function reset_password(){
        $vActivationCode = $this->uri->segment(4);
        if ($this->input->post()) {
            $new_password = $this->input->post('vPassword');
            $user['vPassword'] = $this->encrypt($this->input->post('vPassword'));
            $user['vActivationCode'] = $this->input->post('vActivationCode');
            $this->authentication_model->change_password($user);
            redirect($this->data['admin_url']);
        }else{
            $this->data['adminlist']=$this->authentication_model->get_adminActivationcode($vActivationCode);
            if(count($this->data['adminlist'])== 0){
                redirect($this->data['admin_url']);
            }
        }
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('vActivationCode', $vActivationCode);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/resetpassword.tpl');

    }

    // check email of admin fogot passward ans mail to admin
    function checkemail() {
        if ($this->input->post()) {
            $fpass = $this->input->post();
            $emailid = $fpass['vEmail'];
            $getadminDetail = $this->client_model->checkadmin_mail($emailid);
            if (count($getadminDetail) > 0) {
                $vActivationCode = random_string('alnum', 10);
                $forgotdata['vPassword'] = $this->encrypt($vActivationCode);
                $forgotdata['vEmail'] = $getadminDetail['vEmail'];
                $iUserId = $this->client_model->updatecode($forgotdata);
                //$getadminDetail['vPassword']=$this->decrypt($getadminDetail['vPassword']);
                $name1 = $getadminDetail['vFirstName'] . ' ' . $getadminDetail['vLastName'];
                $name = ucfirst($name1);
                $siteurl = $this->config->item('base_url');
                $MailFooter = $this->data['MAIL_FOOTER'];
                $siteName = '';
                $this->data['COMPANY_NAME'] = '';
                $link = $siteurl . 'admin/authentication';
                //echo '<pre>';print_r($link);exit;
                if ($_SERVER["HTTP_HOST"] == '') {
                    $baseurl = '';
                }
                $image_url = $baseurl;
                $bodyArr = array("#NAME#", "#PASSWORD#", "#EMAIL#", "#SITEURL#", "#MAILFOOTER#", "#LINK#", "#SITE_NAME#", "#IMAGE_URL#");
                $postArr = array($name, $vActivationCode, $forgotdata['vEmail'], $siteurl, $MailFooter, $link, $siteName, $image_url);
                 $sendAdmin = $this->Send("FORGOTPASSWORD", "Admin", $forgotdata['vEmail'], $bodyArr, $postArr);exit;
                $this->session->set_flashdata('message', "We have sent you a New Password Kindly check your Email ID!");
                if($sendAdmin){
                    redirect($this->data['admin_url'] . 'authentication');
                }
                
                exit;
            } else {
                $this->session->set_flashdata('message', $this->data['language_label']['Please_Enter_valid_Email_ID']);
                redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                exit;
            }
        } else {
            $this->session->set_flashdata('message', $this->data['language_label']['Please_Enter_valid_Email_ID']);
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
    }

    //destroy session data and redirect to login page.
    function logout() {
        $datestring = "%Y-%m-%d  %h:%i:%s";
        $time = time();
        $dLogoutDate = mdate($datestring, $time);
        $logindata['iLoginLogId'] = $this->data['happy_admin_info']['iLoginLogId'];
        $logindata['dLogoutDate'] = $dLogoutDate;
        $this->session->unset_userdata("happy_admin_info");
        $this->session->unset_userdata("e2l_adminuser_info");
        redirect($this->data['admin_url'] . 'authentication');
        exit();
    }
}
/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */
?>
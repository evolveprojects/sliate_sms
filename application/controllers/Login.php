<?php

class Login extends CI_controller {

function login() {
	parent::__construct();
	$this->load->model('login_model');
	$this->load->model('Dashboard_model');
        $this->load->model('company_model');
        $this->load->model('Forgot_password_model');
}

function index() {
        $data['online_reg_flag'] = $this->company_model->get_online_registration_flag();
	$data['main_content'] = 'login_view.php';
	$data['title'] = 'LOGIN';
	$this->load->view('login_view',$data);
}

function loginSubmit()
{
	$result = $this->login_model->authenticateLogin();
	date_default_timezone_set('Asia/Colombo');
	
	if(!empty($result))
	{	
            $now = date('Y-m-d H:i:s');
            $ip = $this->input->ip_address();
            $data = array(
            'u_id' => $this->session->userdata('u_id'),
            'u_name' => $this->session->userdata('u_name'),
                    'center_name' => $this->session->userdata('u_branch'),
                    'last_login_ip' => $this->input->ip_address('ip'),
                    'last_login_date_time' => $now
            );

            $this->Dashboard_model->last_login($data);
            redirect('dashboard');
	}
	else
	{
		redirect('login?login=invalid');
	}
}

function logout()
{
/* 	date_default_timezone_set('Asia/Colombo');
		$now = date('Y-m-d H:i:s');
		$ip = $this->input->ip_address();
		$data = array(
            'u_id' => $this->session->userdata('u_id'),
            'u_name' => $this->session->userdata('u_name'),
			'center_name' => $this->session->userdata('u_branch'),
			'last_login_ip' => $this->input->ip_address('ip'),
			'last_login_date_time' => $now
            );
	
		$this->Dashboard_model->last_login($data); */
		
		$this->session->userdata = array();
		$this->session->sess_destroy();
                //$this->delete_expire_session_files();
		redirect('login?login=logout');
}

    function delete_expire_session_files()
    {
        $files = glob(BASEPATH  . 'cache/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)){
            $yesterday = date('Y-m-d',strtotime("-1 days"));
            $changedDate = date("Y-m-d", filectime($file));
                if($changedDate <= $yesterday){
                    unlink($file); //delete file
                }
            }
        }
    }

    function forgot_password (){
        
        $data['main_content'] = 'forgot_password';
        $data['title'] = 'Forgot Password';

        $this->load->view('forgot_password_view',$data);

    }
    
    function forget_password_submit () {
        
        $username =  $this->input->post('username');
        $email= $this->input->post('email');
        
        $result = $this->Forgot_password_model->check_username_and_mail($username, $email);
        
        $adminDetails = $this->Forgot_password_model->get_admin_details();
        
        if($result == 'invalid_data'){
            redirect('login/forgot_password?submit=invalid_user');
        } else if ($result == 'no_reg_email'){
            redirect('login/forgot_password?submit=no_reg');
        } else if ($result == 'invalid_email'){
            redirect('login/forgot_password?submit=invalid_mail');
        } else {
            $config = Array(
                    'protocol' => 'HTTP',
                    'smtp_host' => 'ssl://smtp.gmail.com',   //smtp.gmail.com
                    'smtp_port' => 465,
                    'auth' => true,
                    'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
                    'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                );
            
            $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">User Forgot Password!</h2></div>';
            $htmlContent .= '<p>Dear Admin,</p>';
            $htmlContent .= '<p>The following user has requested to reset password by submitting forgot password request.</p>';
            $htmlContent .= 'User Name : ' . $username . '<br/>';
            $htmlContent .= 'Email : ' . $email . '<br/>';
            $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';
            $this->load->library('Email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('sms@sliate.ac.lk'); // change it to yours
            $this->email->to($adminDetails['user_email']);// change it to yours //$adminDetails['user_email']
            $this->email->bcc('student.sliate.ac.lk@gmail.com');
            $this->email->subject('Request for reset password!');
            $this->email->message($htmlContent);
            
            if ($this->email->send()) {
                redirect('login/?login=sent');
            } else {
                redirect('login/forgot_password?submit=fail');
            }
        }
         
      
    }
    
}
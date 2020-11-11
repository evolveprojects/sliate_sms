<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_controller 
{
    function __construct() 
    {
        parent::__construct();

        $this->load->model('Setting_model');
    }

    function users() 
    {
        $data['records'] = $this->Setting_model->get_users();
        $data['main_content'] = 'app_users';
        $data['title'] = 'Users';
        $this->load->view('includes/new_dash/dash_template', $data);
    }

    function save_user()
    {
        $password = $this->input->post('password');
        $hashed_password = hash('sha512',$password);

        $data['user_name'] = $this->input->post('name');
        $data['user_email'] = $this->input->post('email');
        $data['user_password'] = $hashed_password;
        $data['user_type'] = $this->input->post('user_type');
        $data['user_branch'] = $this->input->post('center');
        $data['created_datetime'] = date("Y-m-d h:i:s", now());
        $u_id = $this->input->post('user_id');

        $result = $this->Setting_model->store_user($data, $u_id);

        exit(json_encode($result));
    }
    
}

?>
<?php

class User extends CI_controller {


function user() {
	parent::__construct();
	$this->load->model('user_model');
	$this->load->model('company_model');
        $this->load->model('util_model');
}

function index() 
{
	$data['groups'] = $this->user_model->get_user_groups();
	$data['users']  = $this->user_model->get_users_list();

	$data['main_content'] = 'user_view';
	$data['title'] = 'USER';
	$this->load->view('includes/template',$data);
}

function  get_user_groups_lookup(){
       
    echo json_encode($this->user_model->get_user_groups_lookup());
}

function system_user(){	

        $data['groups'] = $this->user_model->get_user_groups();
       	//$data['users']  = $this->user_model->get_users_list();
        $data['users'] = array();
	$data['branches']  = $this->user_model->get_branch_list();
	
	$data['main_content'] = 'user_view';
	$data['title'] = 'USER';
	$this->load->view('includes/template',$data);
	
}

function save_user(){
	
	$resultuser = $this->user_model->save_user();
	//if($resultuser){
	
	redirect('user/system_user');
		
	//}
	//else{
		
	
		
	//}

}

function usergroup_view() 
{
	$data['groups']  = $this->user_model->get_user_groups();
	$data['company'] = $this->company_model->get_grp_info();
        $data['branches']  = $this->user_model->get_branch_list();

	$data['main_content'] = 'hgc_usergroup_view';
	$data['title'] = 'USER GROUP';
	$this->load->view('includes/template',$data);
}

function save_usergroup()
{
	$this->user_model->save_usergroup();

	redirect('user/usergroup_view');
}

function delet_user_group()
{
    $ug_id = $this->input->post('ug_id');
    $this->user_model->delet_user_group($ug_id);
}

function reset_user()
{
	echo json_encode($this->user_model->reset_user());
}

function update_status()
{
	echo json_encode($this->user_model->update_status());	
}

function delete_user()
{
	echo json_encode($this->user_model->delete_user());	
}

function check_user_group(){
    echo json_encode($this->user_model->check_user_group());
}

function check_duplicate_user(){
    echo json_encode($this->user_model->check_duplicate_user());
}

function get_user_group_branch(){
    echo json_encode($this->user_model->get_user_group_branch());
}

function backup_view(){
  	//$data['groups'] = $this->user_model->get_user_groups();
	//$data['users']  = $this->user_model->get_users_list();
	//$data['branches']  = $this->user_model->get_branch_list();
	
	$data['main_content'] = 'system_user_backup_view';
	$data['title'] = 'BACKUP';
	$this->load->view('includes/template',$data);  
}
function load_center_course_list()
    {
        echo json_encode($this->user_model->load_center_course_list());
    }
}
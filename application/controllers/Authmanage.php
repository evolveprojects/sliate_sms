<?php
class Authmanage extends CI_Controller {

function authmanage() {
	parent::__construct();
	$this->load->model('authmanage_model');
	$this->load->model('user_model');
	$this->load->model('company_model');
	$this->load->model('Faculty_model');
}

function register_function()
{
	if(isset($this->uri->segments[3]))
		$data['function_id'] = $this->uri->segments[3];
	else
		$data['function_id'] = "";

	$data['pre_data'] = $this->authmanage_model->get_pre_data();

	$data['main_content'] = 'regfunction_view';
	$data['title'] = 'REGISTER FUNCTION';
	$this->load->view('includes/template',$data);
}

function load_function_data()
{
	echo json_encode($this->authmanage_model->get_function_info());
}

function load_submodule()
{
	echo json_encode($this->authmanage_model->load_submodule());
}

function update_function_details()
{
	$save_funct = $this->authmanage_model->update_function_details();

	redirect('dashboard');
}

function accessrights_view()
{
	// $data['authbranch'] = $this->auth->get_accessbranch();
	$data['pre_data'] = $this->authmanage_model->get_pre_data();
	$data['groups'] = $this->user_model->get_user_groups();
	$data['company'] = $this->company_model->get_grp_info();
	//$data['faculties'] = $this->Faculty_model->get_all_faculties();

	$data['main_content'] = 'accessrights_view';
	$data['title'] = 'ACCESS RIGHTS';
	$this->load->view('includes/template',$data);
}

function search_right()
{
	echo json_encode($this->authmanage_model->search_right());
}

function set_rights()
{
	$save_rgts = $this->authmanage_model->set_rights();

	if($save_rgts)
	{
		$this->session->set_flashdata('flashSuccess', 'Rights assigned successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to assign rights. Retry.');
	}

	redirect('authmanage/accessrights_view');
}


function load_user_right_data()
{
	echo json_encode($this->authmanage_model->load_user_right_data());
}


}
<?php

class Hci_config extends CI_controller {

function hci_config() {
	parent::__construct();
	$this->load->model('hci_config_model');
}

function department_view() 
{
	$data['deptinfo']  = $this->hci_config_model->get_deptinfo();

	$data['main_content'] = 'hci_department_view';
	$data['title'] = 'DEPARTMENT';
	$this->load->view('includes/template',$data);
}

function save_department()
{
	$save_dept = $this->hci_config_model->save_department();

	if($save_dept)
	{
		$this->session->set_flashdata('flashSuccess', 'Department saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save department. Retry.');
	}

	redirect('hci_config/department_view');
}

function change_deptstatus()
{
	echo json_encode($this->hci_config_model->change_deptstatus());
}

function designation_view() 
{
	$data['desiginfo']  = $this->hci_config_model->get_desiginfo();

	$data['main_content'] = 'hci_designation_view';
	$data['title'] = 'DESIGNATION';
	$this->load->view('includes/template',$data);
}

function save_designation()
{
	$save_dept = $this->hci_config_model->save_designation();

	if($save_dept)
	{
		$this->session->set_flashdata('flashSuccess', 'Designation saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save designation. Retry.');
	}

	redirect('hci_config/designation_view');
}

function change_desigstatus()
{
	echo json_encode($this->hci_config_model->change_desigstatus());
}
}
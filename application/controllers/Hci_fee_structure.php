<?php

class Hci_fee_structure extends CI_controller {

function hci_fee_structure() {
	parent::__construct();
	$this->load->model('hci_feestructure_model');
	$this->load->model('hci_grade_model');
}

function index() 
{
	$data['fees']  = $this->hci_feestructure_model->get_feecats();
	$data['grd_info']  = $this->hci_grade_model->get_grd_info();
	$data['fss'] = $this->hci_feestructure_model->load_active_feestructures();
	$data['temps'] = $this->hci_feestructure_model->load_fee_templates();

	$data['main_content'] = 'hci_feestructure_view';
	$data['title'] = 'FEE STRUCTURE';
	$this->load->view('includes/template',$data);
}

function save_fee()
{
	$save_fee = $this->hci_feestructure_model->save_fee();

	if($save_fee)
	{
		$this->session->set_flashdata('flashSuccess', 'fee category saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save fee category. Retry.');
	}

	redirect('hci_fee_structure/fee_cat_view');
}

function load_fee_structure()
{
	$data['fees']  = $this->hci_feestructure_model->get_feecats();
	$data['grd_info']  = $this->hci_grade_model->get_grd_info();
	$data['fee_structure'] = $this->hci_feestructure_model->load_fee_structure();

	echo json_encode($data);
}

function save_fee_structure()
{
	$save_fee = $this->hci_feestructure_model->save_fee_structure();

	if($save_fee)
	{
		$this->session->set_flashdata('flashSuccess', 'fee structure saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save fee structure. Retry.');
	}

	redirect('hci_fee_structure');
}

function load_fee_terms()
{
	echo json_encode($this->hci_feestructure_model->load_fee_terms());
}

function save_feegroups()
{
	$save_grp = $this->hci_feestructure_model->save_feegroups();

	if($save_grp)
	{
		$this->session->set_flashdata('flashSuccess', 'Fee group saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Fee group. Retry.');
	}

	redirect('hci_fee_structure');
}

function load_feestructure_data()
{
	echo json_encode($this->hci_feestructure_model->load_feestructure_data());
}

function fee_cat_view()
{
	$data['fees']  = $this->hci_feestructure_model->get_feecats();

	$data['main_content'] = 'hci_feecategory_view';
	$data['title'] = 'FEE CATEGORY';
	$this->load->view('includes/template',$data);
}

function load_feetemp_amounts()
{
	echo json_encode($this->hci_feestructure_model->load_feetemp_amounts());
}

function payment_plan_view()
{
	$data['plans'] = $this->hci_feestructure_model->load_payment_plans();
	$data['fees']  = $this->hci_feestructure_model->get_feecats();
	$data['main_content'] = 'hci_paymentplan_view';
	$data['title'] = 'PAYMENT PLAN';
	$this->load->view('includes/template',$data);
}

function save_paymentplan()
{
	$save_pplan = $this->hci_feestructure_model->save_paymentplan();

	if($save_pplan)
	{
		$this->session->set_flashdata('flashSuccess', 'Payment Plan saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Payment Plan. Retry.');
	}

	redirect('hci_fee_structure/payment_plan_view');
}

function edit_pay_plan()
{
	echo json_encode($this->hci_feestructure_model->edit_pay_plan());
}

}
<?php

class Hci_accounts extends CI_controller {

function hci_accounts() {
	parent::__construct();
	$this->load->model('hci_accounts_model');
	$this->load->model('hci_feestructure_model');
}

function index() 
{
	// $data['comp_info'] = $this->company_model->get_comp_info();
	// $data['grp_info']  = $this->company_model->get_grp_info();
	// $data['fy_info']  = $this->company_model->get_fy_info();
	// $data['ay_info']  = $this->company_model->get_ay_info();

	// $data['main_content'] = 'company_view';
	// $data['title'] = 'COMPANY';
	// $this->load->view('includes/template',$data);
}

function invoice_view() 
{
	$data['invs']  = $this->hci_accounts_model->get_invoices();
	$data['main_content'] = 'hci_invoice_view';
	$data['title'] = 'Invoice';
	$this->load->view('includes/template',$data);
}

function adjusment_view()
{
	$this->load->model('hci_studentreg_model');
	$this->load->model('hci_grade_model');
	
	$data['reg_stu'] = $this->hci_studentreg_model->registeed_Stu();
	$data['adjs'] = $this->hci_accounts_model->load_adjusment();
	$data['fss'] = $this->hci_feestructure_model->load_active_feestructures();
	$data['fees']  = $this->hci_feestructure_model->get_feecats();
	$data['grd_info']  = $this->hci_grade_model->get_grd_info();
	$data['main_content'] = 'hci_feestructureadjusments_view';
	$data['title'] = 'FEE STRUCTURE ADJUSMENTS';
	$this->load->view('includes/template',$data);
}

function save_adjusment()
{
	$adj_save = $this->hci_accounts_model->save_adjusment();

	if($adj_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Data saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Data. Retry.');
	}

	redirect('hci_accounts/adjusment_view');
}

function edit_pay_plan()
{
	echo json_encode($this->hci_feestructure_model->edit_pay_plan());
}

function load_invoicefees()
{
	$inv = $this->input->post('id');
	echo json_encode($this->hci_accounts_model->load_invoicefees($inv));
}

function config_adjusments()
{
	$conf_save = $this->hci_accounts_model->config_adjusments();

	if($conf_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Configured successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to Configure. Retry.');
	}

	redirect('hci_accounts/adjusment_view');
}

function print_invoice()
{
   $invlist = $this->input->post('print_docs');

	$data['invlist'] = array();

	foreach ($invlist as $inv) 
	{
		$data['invlist'][] = $this->hci_accounts_model->load_invoicefees($inv);
	}
        
    $html = $this->load->view( 'hci_invoice_printview' ,$data,true);
   	echo base64_encode($html);
}

function process_invoice()
{
	echo json_encode($this->hci_accounts_model->erp_integration());
}

}
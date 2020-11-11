<?php

class Dashboard extends CI_controller {

function dashboard() {
	parent::__construct();
	$this->load->model('Dashboard_model');
	$this->load->model('Event_model');
	$this->load->model('News_model');
}

function index()
{
	$usergroup = $this->session->userdata('u_ugroup');
	$stud = $this->session->userdata('u_emp');
	$data['res'] = $this->Dashboard_model->get_login();

	if($usergroup=='6')
	{
		redirect(base_url("hci_student/load_stuprofview?id=".$stud."&rt=d"));
	}
	else
	{
		$data['news'] = $this->News_model->getNews();		
		$data['posts'] = $this->Event_model->getPosts();
		$data['main_content'] = 'dashboard_view.php';
		$data['title'] = 'DASHBOARD';
		$this->load->view('includes/template',$data);

	}
}

function sub()
{
	$data['main_content'] = 'sub_view.php';
	$data['title'] = 'Sub';
	$this->load->view('includes/template',$data);
}


}

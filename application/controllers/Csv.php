<?php
class Csv extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('csv_model');
    }
    function index()
    {
		$data['main_content'] = 'uploadCsvView';
	$data['title'] = 'SUBJECT';
	$this->load->view('includes/template',$data);	
	
        
    }
    function uploadData()
    {
        $this->csv_model->uploadData();
        redirect('csv');
    }
}
?>
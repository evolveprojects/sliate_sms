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
        $this->load->view('uploadCsvView',$data);
    }
    function uploadData()
    {
        $this->csv_model->uploadData();
        redirect('csv');
    }
}
?>
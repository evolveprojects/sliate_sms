<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

    public function _construct() {
        parent::__construct();
    }

    public function index() {

        $data['main_content'] = 'assignment_view';
        $data['title'] = 'ASSIGNMENT';
        $this->load->view('includes/template', $data);
    }
    
    public function assignment_marks() {

        $data['main_content'] = 'assignment_result_view';
        $data['title'] = 'ASSIGNMENT MARKS';
        $this->load->view('includes/template', $data);
    }

}

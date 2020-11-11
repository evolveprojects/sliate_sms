<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {
    public function app() {
//        parent::__construct();
        $this->load->model('Application_model');
    }
    
    public function index() {
        $data['main_content'] = 'application_view';
        $data['title'] = 'Online Application';
        $this->load->view('includes/app_template', $data);
    }
}
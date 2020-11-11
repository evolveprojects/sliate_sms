<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aptitude_test extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('App_model');
        $this->load->model('Aptitude_test_model');
        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index() {
        //$this->load->helper('url');
        $data['al_subject_streams'] = $this->App_model->get_al_subject_streams();
        $data['al_grade'] = $this->App_model->get_subject_al_result_grade();
        $data['ol_grade'] = $this->App_model->get_subject_ol_result_grade();
        $data['districts'] = $this->App_model->load_districts();
        $data['titles'] = $this->App_model->load_titles();
        $data['next_value'] = $this->App_model->get_next_value();

        $data['centers'] = $this->App_model->get_center();

        $data['main_content'] = 'dummy'; //application_view
        $this->load->view('includes/app_template', $data);
    }


    // Aptitude Test Marks - added by Anuruddha - 28/05/2020
    function aptitude_test_marks() {

        $data['centers'] = $this->App_model->get_center();
    
        $data['results'] = $this->Aptitude_test_model->online_registered_students();

        $data['main_content'] = 'app_dash_aptitude_test';
        $this->load->view('includes/new_dash/dash_template', $data);
    }
    

    function search_apt_students() {
            
        $data['year'] = $this->input->post('year');
        $data['center'] = $this->input->post('priority1_center');
        $data['course'] = $this->input->post('course');

        //add data to the siession
        $this->session->set_userdata('center_submited', $data['center']);
        $this->session->set_userdata('course_submited', $data['course']);

        $data['centers'] = $this->App_model->get_center();
        
        $data['results'] = $this->Aptitude_test_model->search_online_student($data);
        //$data['results'] = $this->Aptitude_test_model->online_registered_students();

        //echo json_encode($data['results']);
        $data['main_content'] = 'app_dash_aptitude_test';
        $this->load->view('includes/new_dash/dash_template', $data);
    }


    function save_apt_mark() {
        
        $entries = $this->input->post('rec');
        
        //save data
        $this->Aptitude_test_model->save_apt_mark($entries);
        echo 'Successfull!';
    }

}
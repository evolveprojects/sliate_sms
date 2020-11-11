<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
    
    
    public function __construct() 
    {
        parent::__construct();

        $this->load->model('course_model');
        $this->load->model('Master_model');
        $this->load->library("pagination");
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        //$this->load->model('faculty_model');
        $this->load->model('Semester_model');
        $this->load->model('company_model');
        $this->load->model('Util_model');
        $this->load->model('Student_model');
        $this->load->model('batch_model');
    }


    function courses() 
    {
        $data['all_courses'] = $this->Master_model->get_all_courses();
        $data['main_content'] = 'app_courses';
        $data['title'] = 'COURSE';
        $this->load->view('includes/new_dash/dash_template', $data);
    }


    function save_course() 
    {
        $id = $this->input->post('c_id');

        $data['course_code'] = $this->input->post('c_code');
        $data['course_name'] = $this->input->post('c_name');
        $data['total_creadit'] = $this->input->post('c_credit');
        $data['description'] = $this->input->post('c_desc');
        $data['added_by'] = $this->session->userdata('u_id');
        $data['added_on'] = date("Y-m-d h:i:s", now());
        $data['selection_type'] = $this->input->post('c_sel_type');

        $result = $this->Master_model->save_course($id, $data);

        exit(json_encode($result));
    }

    //delete course
    function change_course_status() 
    {
        //post values
        $data['course_id'] = $this->input->post('course_id');
        $data['course_code'] = $this->input->post('course_code');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $exists = $this->course_model->is_existing_course_code($data['course_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same Course Code record exists. Cannot activate this record.');
            } else {
                echo json_encode($this->course_model->update_course_status($data));
            }
        } else {
            echo json_encode($this->course_model->update_course_status($data));
        }
    }
    

    function center_courses()
    {
        $data['all_courses'] = $this->Master_model->get_all_courses();
        $data['each_center_course'] = $this->course_model->get_center_course();
        $data['main_content'] = 'app_center_course';
        $data['title'] = 'CENTER COURSE';
        $this->load->view('includes/new_dash/dash_template', $data);
    }

    
    function save_centercourse()
    {
        // $isFulltime = ($this->input->post('full_time'))?1:0;
        // $isParttime = ($this->input->post('part_time'))?1:0;
        $cc_id = $this->input->post('cc_id');

        $data['center_id'] = $this->input->post('center');
        $data['course_id'] = $this->input->post('course');
        $data['added_on'] = date('Y-m-d H:i:s');
        $data['added_by'] = $this->session->userdata('u_id');
        $data['full_time'] = $this->input->post('full_time');
        $data['part_time'] = $this->input->post('part_time');

        $result = $this->Master_model->save_cc($data, $cc_id);

        exit(json_encode($result));
    }


    //delete center course
    function change_center_course_status()
    {
        $cc_id = $this->input->post('cc_id');

        $this->Master_model->change_cc_status($cc_id);
    }
}


?>
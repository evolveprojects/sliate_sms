<?php

class Year extends CI_Controller {

    function year() {
        parent::__construct();
        $this->load->model('Year_model');
        $this->load->model('Util_model');
        $this->load->model('Staff_model');
    }

    function year_view() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            //get All students
            $data['centers'] = $this->Year_model->get_all_centers();
            $data['all_courses'] = $this->Year_model->load_course_programs();
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 2){ // 
            $data['centers'] = $this->Year_model->get_center_admin_login_centers();
            $data['all_courses'] = $this->Year_model->load_course_programs_by_centers();
            //$data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Year_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Year_model->load_course_programs_by_centers();
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Year_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Year_model->load_course_programs_by_centers();
            $data['ug_level'] = $this->Util_model->check_access_level();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['centers'] = $this->Year_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Year_model->load_course_programs_by_centers();
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        
        
       // $data['all_faculties'] = $this->auth->get_accessfaculties();
        //$data['all_courses'] = $this->Year_model->load_course_programs();
        $data['degyear'] = $this->Year_model->get_course_year();
        $data['deg_result'] = $this->Year_model->load_course();
        $data['main_content'] = 'year_view.php';
        $data['title'] = 'Course Year';
        $this->load->view('includes/template', $data);
    }

    function update_year_status() {
        //post values
        $data['course_id'] = $this->input->post('course_id');
         $data['year_id'] = $this->input->post('year_id');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $exists = $this->Year_model->is_existing_year($data['course_id']);
            if ($exists) {
                $this->session->set_flashdata('flashError', 'Record Exists. Cannot Activate Record.');
            } else {
                 echo json_encode($this->Year_model->update_year_status($data));
            }
        } else {
             echo json_encode($this->Year_model->update_year_status($data));
        }
    }

    function course_year_save() {
        $this->load->model('Year_model');
        //post values
        $data['year_id'] = $this->input->post('year_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['no_of_year'] = $this->input->post('no_of_year');

        $exists = $this->Year_model->is_existing_year($data['course_id']);

        if (empty($data['year_id'])) {
            if ($exists) {
                $this->session->set_flashdata('flashError', 'Course Years exists.Cannot insert record.');
            } else {
                //insert
                $result = $this->Year_model->course_year_save($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Course Years saved successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Course Years. Retry.');
                }
            }
        } else {
            //update
            $result = $this->Year_model->course_year_save($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Course Years updated successfully.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update Course Years. Retry.');
            }
        }
        
        redirect('year/year_view');
    }

    function edit_course_year() {
        $year_id = $this->input->post('year_id');
        echo json_encode($this->Year_model->edit_course_year($year_id));
    }
    
    function load_course_programs(){
//        $faculty_id = $this->input->post('faculty_id');
        //$courses = $this->Year_model->load_course_programs($faculty_id);
        //echo json_encode($this->Year_model->load_course_programs());
        echo json_encode($this->Year_model->load_exam_mark_course_list());   
    }
    

}

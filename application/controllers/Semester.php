<?php

class Semester extends CI_controller {

    function semester() {
        parent::__construct();
        $this->load->model('semester_model');
        $this->load->model('course_model');
        $this->load->model('year_model');
        $this->load->model('faculty_model');
        $this->load->model('Util_model');
    }

    function semester_view() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            //get All students
            $data['centers'] = $this->semester_model->get_all_centers();
            $data['all_courses'] = $this->semester_model->load_course();
            //$data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 2){ // 
            //$data['all_courses'] = $this->semester_model->load_course();
            $data['centers'] = $this->semester_model->get_center_admin_login_centers();
            $data['all_courses'] = $this->semester_model->load_course_by_center();
            
            //$data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            //$data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->semester_model->get_login_user_centers();
            $data['all_courses'] = $this->semester_model->load_course_by_center();
            //$data['ug_level'] = $this->Util_model->check_access_level();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->semester_model->get_login_user_centers();
            $data['all_courses'] = $this->semester_model->load_course_by_center();
            //$data['ug_level'] = $this->Util_model->check_access_level();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['centers'] = $this->semester_model->get_login_user_centers();
            $data['all_courses'] = $this->semester_model->load_course_by_center();
            //$data['ug_level'] = $this->Util_model->check_access_level();
        }
        
        
        
        //$data['all_faculties'] = $this->auth->get_accessfaculties();
        // $data['courses'] = $this->semester_model->load_course();
        //$data['all_courses'] = $this->semester_model->load_course();
        $data['sem_view'] = $this->semester_model->view_semester();
        $data['main_content'] = 'semester_view.php';
        $data['title'] = 'Semester';
        $this->load->view('includes/template', $data);
    }

    function link_course() {
        $course_id = $this->input->post('id');
        echo json_encode($this->semester_model->link_course_year($course_id));
    }

    function save_semester() {
        //post values
        $data['semester_id'] = $this->input->post('semester_id');
        $data['course_id'] = $this->input->post('load_Dcode');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['year_no'] = $this->input->post('no_year');
        $data['no_of_semester'] = $this->input->post('no_of_semester');

        if (empty($data['semester_id'])) {
            $data['course_id'] = $this->input->post('load_Dcode');
        } else {
            $data['course_id'] = $this->input->post('course_id');
        }

        $semester_exists = $this->semester_model->exists_semester_records($data['course_id'], $data['year_no']);

        if (empty($data['semester_id'])) {
            if ($semester_exists != NULL) {
                $this->session->set_flashdata('flashError', 'Record Exists.');
            } else {
                //insert
                $result = $this->semester_model->save_semester($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Course Semester saved successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Course Semester. Retry.');
                }
            }
        } else {
            //update
            $result = $this->semester_model->save_semester($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Course Semester updated successfully.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update Course Semester. Retry.');
            }
        }
        redirect('semester/semester_view');
    }

    function update_semester_status() {
        $this->load->model('semester_model');
        //post values
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_id'] = $this->input->post('semester_id');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $semester_exists = $this->semester_model->exists_semester_records($data['course_id'], $data['year_no']);
            if ($semester_exists != NULL) {
                $this->session->set_flashdata('flashError', 'Record Exists. Cannot Activate Record.');
            } else {
                echo json_encode($this->semester_model->update_semester_status($data));
            }
        } else {
            echo json_encode($this->semester_model->update_semester_status($data));
        }
    }

}

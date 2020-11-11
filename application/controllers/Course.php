<?php

class Course extends CI_Controller {

    public function course() {
        parent::__construct();
        $this->load->model('course_model');
        //$this->load->model('faculty_model');
        $this->load->model('hall_model');
        $this->load->model('year_model');
        $this->load->model('Semester_model');
        $this->load->model('batch_model');
        $this->load->model('company_model');
        $this->load->model('Util_model');
        $this->load->model('Student_model');
        
    }

    function course_view() {
//        $data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['all_courses'] = $this->course_model->get_all_courses();
        $data['main_content'] = 'course_view';
        $data['title'] = 'COURSE';
        $this->load->view('includes/template', $data);
    }

    function center_course() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            //get All students
            $data['centers'] = $this->course_model->load_courses_complete();
            $data['all_courses'] = $this->course_model->load_course_programs();
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 2){ // 
            //$data['all_courses'] = $this->semester_model->load_course();
            $data['centers'] = $this->course_model->get_center_admin_login_centers();
            $data['all_courses'] = $this->course_model->load_course_programs_centerwise();
            //$data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->course_model->get_login_user_centers();
            $data['stf_view_all'] = $this->semester_model->load_course_programs_centerwise();
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->semester_model->get_login_user_centers();
            $data['stf_view_all'] = $this->semester_model->load_course_programs_centerwise();
            $data['ug_level'] = $this->Util_model->check_access_level();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['centers'] = $this->semester_model->get_login_user_centers();
            $data['stf_view_all'] = $this->semester_model->load_course_programs_centerwise();
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        
        
        
        
        //$data['all_courses'] = $this->course_model->load_courses_complete();
        $data['study_seasons'] = $this->company_model->get_all_study_seasons();
        //batch
        $data['batches'] = $this->batch_model->all_batch_data();
        //center years
        $data['course_years'] = $this->course_model->get_center_course();
        //center semesters
        $data['course_semesters'] = $this->course_model->get_center_course_years_all();
        $data['main_content'] = 'branch_course_view';
        $data['title'] = 'CENTER COURSE';
        $this->load->view('includes/template', $data);
    }

    function save_course() {
        //post values
        $data['course_id'] = $this->input->post('course_id');
       // $data['faculty_id'] = $this->input->post('faculty');
        $data['d_code'] = $this->input->post('d_code');
        $data['d_name'] = $this->input->post('d_name');
        $data['t_creadit'] = $this->input->post('t_creadit');
        $data['des'] = $this->input->post('des');

        //query
        $exists = $this->course_model->is_existing_course_code($data['d_code']);

        if (empty($data['course_id'])) {
            //insert
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Course Code Exists.Cannot insert record.');
            } else {
                $result = $this->course_model->save_course($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Course saved successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Course. Retry.');
                }
            }
        } else {
            //update
            if ($exists != NULL && $exists != $data['course_id']) {
                $this->session->set_flashdata('flashError', 'Course Code exists. Cannot update record.');
            } else {
                $result = $this->course_model->save_course($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Course updated successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update Course. Retry.');
                }
            }
        }
        redirect('course/course_view');
    }

    function change_course_status() {
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

    function get_course() {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if($ug_level == 1){ //Admin
            //get All students
            echo json_encode($this->course_model->get_course());

        }
        else if($ug_level == 2){ //
            echo json_encode($this->course_model->get_course());
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->course_model->get_course());

        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->course_model->get_course());

            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records.
            echo json_encode($this->course_model->get_course_student($this->session->userdata('user_ref_id')));
        }

    }

    function load_course_programs() {
        //$faculty_id = $this->input->post('faculty_id');
        echo json_encode($this->course_model->load_course_programs());
    }

    function get_year_semesters() {
        
        //post values
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');

        echo json_encode($this->Semester_model->get_year_semesters($course_id, $year_no));
    }

    function save_center_course_years() {
        //post values
        $data['center_course_id'] = $this->input->post('center_course_id');

        $data['center_id'] = $this->input->post('center');
        $data['batch_id'] = $this->input->post('yr_Bcode');
        $data['course_id'] = $this->input->post('year_Dcode');

        $data['total_years'] = $this->input->post('y_years');
        $data['year_start'] = $this->input->post('year_start');
        $data['year_end'] = $this->input->post('year_end');
        
        echo json_encode($this->course_model->save_center_course_years($data));
    }

    function save_center_course_semesters() {
        //post values
        $data['center_year_id'] = $this->input->post('center_year_id');
        $data['center_id'] = $this->input->post('sem_center');
        $data['batch_id'] = $this->input->post('sem_Bcode');
        $data['course_id'] = $this->input->post('se_Dcode');
        $data['total_years'] = $this->input->post('total_years');
        $data['year_no'] = $this->input->post('s_years');
        
        $data['total_semesters'] = $this->input->post('total_semesters');
        $data['semester_start'] = $this->input->post('semester_start');
        $data['semester_end'] = $this->input->post('semester_end');

        echo json_encode($this->course_model->save_center_course_semesters($data));
    }

    function get_center_course_years() {
        $center_course_id = $this->input->post('center_course_id');
        echo json_encode($this->course_model->get_center_course_years($center_course_id));
    }
    
    function change_center_year_status(){
        $data['center_course_id'] = $this->input->post('center_course_id');
        $data['new_status'] = $this->input->post('new_status');
        
        echo json_encode($this->course_model->change_center_year_status($data));
    }

    function get_center_course_semesters(){
        $center_year_id = $this->input->post('center_year_id');
        echo json_encode($this->course_model->get_center_course_semesters($center_year_id));
    }
    
    function change_center_semester_status(){
        $data['center_year_id'] = $this->input->post('center_year_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->course_model->change_center_semester_status($data));
    }

    // function load_faculty_bybranch()
    // {
    //     $branch = $this->input->post('id');
    //     echo json_encode($this->auth->get_accessfaculties(array($branch)));
    // }
    
    
    function get_course_for_repeat_stu() {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if($ug_level == 1){ //Admin
            //get All students
            echo json_encode($this->course_model->get_course_for_repeat());

        }
        else if($ug_level == 2){ //
            echo json_encode($this->course_model->get_course_for_repeat());
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->course_model->get_course_for_repeat());

        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->course_model->get_course_for_repeat());

            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records.
            echo json_encode($this->course_model->get_course_for_repeat_student($this->session->userdata('user_ref_id')));
        }

    }
    
    
    function get_course_for_repeat_stu_mark() {
            echo json_encode($this->course_model->get_course_for_repeat_stu_mark());
    }
    
    
    function load_course_list()
    {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];
        $ug_course = $access_level[0]['ug_course'];

        if ($ug_level == 1) { //Admin
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 2) { 
            if($ug_course == null || $ug_course == ''){ //dir
                echo json_encode($this->Student_model->load_course_list());
            } else { //hod
                echo json_encode($this->course_model->load_course_list_for_hod($ug_course));
            }
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_course_list());
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->Student_model->load_course_list_student_add_student());           
            //echo json_encode($this->Student_model->load_student_courses());  
        }
    }
    
}

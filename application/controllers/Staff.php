<?php

class Staff extends CI_controller {

    function Staff() {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->load->model('Subject_model');
        $this->load->model('Faculty_model');
        $this->load->model('hall_model');
        $this->load->model('course_model');
        $this->load->model('Student_model');
        $this->load->model('Util_model');
        $this->load->model('User_model');
    }
   

    function stf_lookup() 
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            //get All students
            $data['centers'] = $this->Staff_model->get_all_centers();
            $data['stf_view_all'] = $this->Staff_model->view_staff_all();
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 2){ // 
            $data['centers'] = $this->Staff_model->get_center_admin_login_centers();
            $data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Staff_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Staff_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['centers'] = $this->Staff_model->get_login_user_centers();
            $data['stf_view_all'] = $this->Staff_model->view_staff_by_center($data['centers'][0]['br_id']);
            $data['ug_level'] = $this->Util_model->check_access_level();
        }
        
        //$data['stf_view_all'] = $this->Staff_model->view_staff_all();
        $data['main_content'] = 'staff_view.php';
        $data['title'] = 'Staff';
        $this->load->view('includes/template', $data);
    }
    
    function view_staff_by_center()
    {
        $center_id = $this->input->post('center_id');
        $result = $this->Staff_model->view_staff_by_center($center_id);
        echo json_encode($result);
    }

    function qualifications() {
        $data['qualifications'] = $this->Staff_model->get_all_qualifications();
        $data['main_content'] = 'qualification_view.php';
        $data['title'] = 'Add Qualification';
        $this->load->view('includes/template', $data);
    }

    function save_qualification() {
        //post values
        $data['qualification_id'] = $this->input->post('qualification_id');
        $data['qualification'] = $this->input->post('qualification');
        $data['description'] = $this->input->post('description');

        if (empty($data['qualification_id'])) {
            //insert
            $result = $this->Staff_model->save_qualification($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Qualification saved successfully.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to save qualification. Retry.');
            }
        } else {
            //update
            $result = $this->Staff_model->save_qualification($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Qualification updated successfully.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update qualification. Retry.');
            }
        }
        redirect('staff/qualifications');
    }

    function change_qualification_status() {
        //post values
        $data['qualification_id'] = $this->input->post('qualification_id');
        $data['qualification'] = $this->input->post('qualification');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->Staff_model->update_qualification_status($data));
    }

    function assign() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $ug_course = $access_level[0]['ug_course'];
        
        $center = $this->session->userdata('user_branch');
        
        if($ug_level == 1){ //Admin
            //get All students
            $data['stf_view'] = $this->Staff_model->view_staff();
            $data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects();
            $data['centers'] = $this->Staff_model->get_all_centers();
            $data['view'] = 'admin_view';
        }
        else if($ug_level == 2){ // 
            $data['stf_view'] = $this->Staff_model->view_staff_by_center($center);
            $data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects_by_center($ug_course);
            if($ug_level == 2 && $ug_course != null && $ug_course != ''){
                $data['view'] = 'hod_view';
            } 
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['stf_view'] = $this->Staff_model->view_staff_by_center($center);
            $data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects_by_center($ug_course);
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['stf_view'] = $this->Staff_model->view_staff_by_center($center);
            $data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects_by_center($ug_course);
        }
        else // Student
        {
            //get only logged in user records. 
            $data['stf_view'] = $this->Staff_model->view_staff_by_center($center);
            $data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects_by_center($ug_course);
        }
        
        
        //$data['stf_view'] = $this->Staff_model->view_staff();
        $data['ug_level'] = $ug_level;
        $data['qualifications'] = $this->Staff_model->get_all_qualifications();
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        //$data['lecture_subjects'] = $this->Staff_model->get_all_staff_with_subjects();
        $data['main_content'] = 'assign_view.php';
        $data['title'] = 'Assign';
        $this->load->view('includes/template', $data);
    }

    function save_assign() {
        //post values
        $data['assign_id'] = $this->input->post('assign_id');
        $data['lecturer_id'] = $this->input->post('lecturer');
        if ($data['lecturer_id'] == null) {
            $data['lecturer_id'] = $this->input->post('lecturer_id');
        }
//        $data['qualifications'] = $this->input->post('qualifications');
        $data['subject_ids'] = $this->input->post('subjects');
        $data['hourly_rate'] = $this->input->post('hourly_rate');
        $data['course_id'] = $this->input->post('subject_course');
        if ($data['course_id'] == null) {
            $data['course_id'] = $this->input->post('course_id');
        }

        if (empty($data['assign_id'])) {
            //insert
            $exists = $this->Staff_model->is_lecturer_assigned($data['lecturer_id'],$data['course_id']);
            if ($exists) {
                $this->session->set_flashdata('flashError', 'Already assigned to this staff member.');
                $this->logger->systemlog('Save Assign', 'Failure', 'Already assigned to this staff member.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $result = $this->Staff_model->save_staff_assign($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Staff assign saved successfully.');
                    $this->logger->systemlog('Save Assign', 'Success', 'Staff assign saved successfully.', date("Y-m-d H:i:s", now()),$data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save staff assign. Retry.');
                    $this->logger->systemlog('Save Assign', 'Success', 'Failed to save staff assign.', date("Y-m-d H:i:s", now()),$data);
                }
            }
        } else {
            //update
            print_r('update');
            $result = $this->Staff_model->save_staff_assign($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Staff assign updated successfully.');
                $this->logger->systemlog('Save Assign', 'Success', 'Staff assign updated successfully.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update staff assign. Retry.');
                $this->logger->systemlog('Save Assign', 'Success', 'Failed to update staff assign.', date("Y-m-d H:i:s", now()),$data);
            }
        }
        redirect('staff/assign');
    }

    function lecturer_attendance() {
        $data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['main_content'] = 'lecturer_attendence_view.php';
        $data['title'] = 'Attendance';
        $this->load->view('includes/template', $data);
    }

    function stf_reg_view() {
        $data['title_new'] = $this->Staff_model->get_title();
        $data['faculties'] = $this->auth->get_accessfaculties();
        $data['designation'] = $this->Staff_model->get_designation();
        $data['user_group'] = $this->User_model->get_user_groups_for_examiner();
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        if($ug_level == 1){ //Admin
            //get All students
            $data['centers'] = $this->Staff_model->get_all_centers();
        }
        else if($ug_level == 2){ // 
            $data['centers'] = $this->Staff_model->get_center_admin_login_centers();
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Staff_model->get_login_user_centers();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Staff_model->get_login_user_centers();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['centers'] = $this->Staff_model->get_login_user_centers();
        }
        $data['stf_data'] = null;
        $data['main_content'] = 'staff_reg_view.php';
        $data['title'] = 'staff_registration';
        $this->load->view('includes/template', $data);
        
    }

    function stf_update_view() {
        
        $staff_id = urldecode(base64_decode($_GET['id']));
        if (isset($staff_id)) {
            $data['stu'] = $staff_id;
        } else {
            $data['stu'] = null;
        }
        $data['stf_data'] = $this->Staff_model->edit_staff($data['stu']);
        //$data['faculties'] = $this->auth->get_accessfaculties();
        $data['title_new'] = $this->Staff_model->get_title();
        $data['main_content'] = 'staff_reg_view.php';
        $data['title'] = 'staff_registration';
        $this->load->view('includes/template', $data);
    }

    function staffprof_view() {

        $staff_id = urldecode(base64_decode($_GET['id']));
        if (isset($staff_id)) {
            $data['stf'] = $staff_id;
        } else {
            $data['stf'] = null;
        }
        
        if (isset($_GET['type'])) {
            $data['type'] = $_GET['type'];
        } else {
            $data['type'] = null;
        }
        
        $function1 = $this->uri->segment(1);
        $function2 = $this->uri->segment(2);
  
        $final_func = $function1."/".$function2;
        
        if(($data['type'] != null) && ($data['type'] == 'sfaff_approval')){
            $data['access_function'] = $this->Student_model->get_user_access_right($final_func);
        }
        
        if(($data['type'] != null) && ($data['type'] == 'staff_approval')){
            $data['access_staff_approval'] = $this->Student_model->get_user_access_right_for_sub_menu($final_func);
        }

        $data['stf_prof'] = $this->Staff_model->view_stf_prof($data['stf']);
        $data['qualifications'] = $this->Staff_model->view_stf_qualifications($data['stf']);
        $data['subjects'] = $this->Staff_model->view_stf_subjects($data['stf']);
        $data['main_content'] = 'staffprof_view';
        $data['title'] = 'Staff Profile';
        $this->load->view('includes/template', $data);
    }

    function save_staff() {
        //data['stf_data'] = $this->db->get_where('sta_lecturer_details',array('stf_id' => $_SESSION['sessionstf']))->row_array();
        //post values
        $data['center_id'] = $this->input->post('center_id');
        $data['stf_id'] = $this->input->post('stf_id');
        
        $data['tit_name'] = $this->input->post('tit_name');
//        var_dump($data['tit_name']);
        $data['stf_fname'] = $this->input->post('stf_fname');
        $data['stf_lname'] = $this->input->post('stf_lname');
        $data['stf_address'] = $this->input->post('stf_address');
        $data['nic'] = $this->input->post('nic');
        
        $data['designation'] = $this->input->post('designation');
        $data['qualification'] = $this->input->post('qualification');
        
        //$data['stf_acc'] = $this->input->post('stf_acc');
        $data['stf_faculty'] = $this->input->post('stf_faculty');
        $data['stf_mobi'] = $this->input->post('stf_mobi');
        $data['stf_home'] = $this->input->post('stf_home');
        $data['stf_email'] = $this->input->post('stf_email');
        //$data['stf_national'] = $this->input->post('stf_national');
        $data['stf_marital'] = $this->input->post('stf_marital');
        $data['research_interest'] = $this->input->post('research_interest');
        //$data['publications_achive'] = $this->input->post('publications_achive');
        //$data['awards_achive'] = $this->input->post('awards_achive');
        //$data['memberships_achive'] = $this->input->post('memberships_achive');
        //$data['public_achievements'] = $this->input->post('public_achievements');
        $data['aca_status'] = $this->input->post('aca_status');
        $data['user_group'] = null;
        if ($data['aca_status'] == 0) {
            $data['user_group'] = $this->input->post('user_group');
        }
        
        if (empty($data['stf_id'])) {
            //insert
            $result = $this->Staff_model->save_staff($data);
            if (isset($result['result'])) {
                if( $result['email_result'] == 'none' || $result['email_result'] == true){
                   $this->session->set_flashdata('flashSuccess', 'Added Staff saved successfully.');
                } else {
                    $this->session->set_flashdata('flashSuccess', 'Added Staff saved successfully.<span style="color:red;"><b> Email Could Not Sent.</b></span>');
                }
            } else {
                $this->session->set_flashdata('flashError', 'Failed to save Added Staff. Retry.');
            }
        } else {
            //update
            $result = $this->Staff_model->save_staff($data);
            if (isset($result['result']) && $result['result'] == true) {
               $this->session->set_flashdata('flashSuccess', 'Staff Details updated successfully.');
            } else {
               $this->session->set_flashdata('flashError', 'Failed to update Staff Details. Retry.');
            }
        }
        redirect('staff/stf_lookup');
    }
    
    function check_duplicate_nic_no_for_staff(){
        echo json_encode($this->Staff_model->check_duplicate_nic_no_for_staff());
    }

    function update_staff_status() {
        //post values
        $data['stf_id'] = $this->input->post('stf_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->Staff_model->update_staff_status($data));
    }

    function edit_assign_load() {
        $assign_id = $this->input->post('assign_id');
        $lecturer_id = $this->input->post('lecturer_id');
        $course_id = $this->input->post('course_id');
        $ug_data = $this->Util_model->check_access_level();
        echo json_encode($this->Staff_model->edit_assign_load($assign_id, $lecturer_id,$ug_data[0],$course_id));
    }

    function change_assign_status() {
        //post values
        $data['assign_id'] = $this->input->post('assign_id');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->Staff_model->change_assign_status($data));
    }

    function load_lecturers_by_date() {
        $data['center_id'] = $this->input->post('center_id');
        $data['faculty_id'] = $this->input->post('faculty_id');
        $data['lecturer_id'] = $this->input->post('lecturer_id');
        $data['att_date'] = $this->input->post('att_date');
        $data['dayofweek'] = date('l', strtotime($data['att_date']));
        echo json_encode($this->Staff_model->load_lecturers_by_date($data));
    }

    function get_staff_by_faculty() {
        $faculty_id = $this->input->post('faculty_id');

        echo json_encode($this->Staff_model->get_staff_by_faculty($faculty_id));
    }

    function save_lecturer_attendance() {
        $data['center_id'] = $this->input->post('center_id');
        $data['faculty_id'] = $this->input->post('faculty_id');
        $data['lecturer_id'] = $this->input->post('lecturer_id');
        $data['att_date'] = $this->input->post('att_date');
        $data['dayofweek'] = date('l', strtotime($data['att_date']));
        $data['actual_ls_time'] = $this->input->post('actual_ls_time');
        $data['actual_le_time'] = $this->input->post('actual_le_time');
        $data['is_checked'] = $this->input->post('is_checked');
        $data['no_of_breaks'] = $this->input->post('no_of_breaks');
        $data['worked_hours'] = $this->input->post('worked_hours');
        echo json_encode($this->Staff_model->save_lecturer_attendance($data));
    }

    function view_lecturer_attendance() {
        $data['att_date'] = $this->input->post('att_date');
        $data['staff_member'] = $this->input->post('staff_member');

        echo json_encode($this->Staff_model->view_lecturer_attendance($data));
    }

    function update_staff_attendance_status() {
        $data['lec_att_id'] = $this->input->post('lec_att_id');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->Staff_model->update_staff_attendance_status($data));
    }
    
    function load_data_for_update_staff_attendance(){
        $data['attendance_id'] = $this->input->post('attendance_id');
        $data['lecturer_id'] = $this->input->post('lecturer_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['attendance_date'] = $this->input->post('attendance_date');
        
        echo json_encode($this->Staff_model->load_data_for_update_staff_attendance($data));
    }

    function update_attendance_data()
    {
        echo json_encode($this->Staff_model->update_attendance_data());
    }

    
    
    function set_staffdatasession()
    {
        $this->session->set_userdata('sessionstf',$_POST['id']);

        echo true;
    }
    
    function staffeditview(){
        
        $data['designation'] = $this->Staff_model->get_designation();
        //if(isset($_SESSION['sessionstf']))
        //{   
        $data['title_new'] = $this->Staff_model->get_title();
        $staff_id = urldecode(base64_decode($_GET['id']));
        $data['centers'] = $this->Student_model->get_all_centers();
        $data['user_group'] = $this->User_model->get_user_groups();
        $data['stf_data'] = $this->db->get_where('sta_lecturer_details',array('stf_id' => $staff_id))->row_array();
        $data['main_content'] = 'staff_reg_view';//'hci_studentedit_view';
        $data['title'] = 'Staff Edit';
        $this->load->view('includes/template', $data);
        //}
        //else
        //{
            //$this->session->set_flashdata('flashError', 'Session Expired. Login to continue');
            //redirect('staff/staff_view');
        //}
    }
    
    
    function load_staff_details(){
        //if(isset($_SESSION['sessionstf']))
        //{
            $stf_id = $this->input->post('stf_id');
            
          //  $this->db->select('*');
         //   $this->db->join('');
            $data = $this->db->get_where('sta_lecturer_details',array('stf_id' => $stf_id))->row_array();
            if($data['academic_status'] == 0){
                $user_data = $this->db->get_where('ath_user',
                        array(
                            'user_name' => $data['staffindex'],
                            'user_status' => 'A'
                        )
                        )->row_array();
                $data['user_data'] = $user_data;
            } 
            
            echo json_encode($data);
            
            
           // $data['main_content'] = 'hci_studentreg_view';//'hci_studentedit_view';
           // $data['title'] = 'Student Edit';
          //  $this->load->view('includes/template', $data);
        //}
        //else
        //{
            //$this->session->set_flashdata('flashError', 'Session Expired. Login to continue');
            //redirect('staff/staff_view');
        //}
    }
    
    
    function search_staff_lookup()
    {
        $data['center_id']      = $this->input->post('center_id');
        $data['subject_id']     = $this->input->post('subject_id');
        
        echo json_encode($this->Staff_model->search_staff_lookup($data));
    }
    
    function check_duplicate_qualification(){
        echo json_encode($this->Staff_model->check_duplicate_qualification($this->input->post('qualification')));
    }
    
    function load_course_list()
    {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];
        $ug_course = $access_level[0]['ug_course'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 2) { //
            if($ug_course == NULL || $ug_course == ''){
                echo json_encode($this->Student_model->load_course_list());
            } else {
                echo json_encode($this->Student_model->load_course_list_hod($ug_course));
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
            //echo json_encode($this->Student_model->load_course_list_student_add_student());           
            echo json_encode($this->Student_model->load_student_courses());  
        }


    }
    
    function load_lecturers_for_center(){
        $center_id = $this->input->post('center_id');
        echo json_encode($this->Staff_model->load_lecturers_for_center($center_id));  
    }
    
    function load_subjectss_for_course_details(){
        $course_id = $this->input->post('course_id');
        echo json_encode($this->Staff_model->load_subjectss_for_course_details($course_id));  
    }
    
    function load_subjects_lecturers(){
        $center_id = $this->input->post('center_id');
        $lecturer_id = $this->input->post('lecturer_id');
        echo json_encode($this->Staff_model->load_subjectss_lecturers($center_id,$lecturer_id));  
    }
    
    function load_subjects_to_assign_staff(){
        $data['course_id'] = $this->input->post('course_id');
        $data['year_id'] = $this->input->post('year_id');
        $data['semester_id'] = $this->input->post('semester_id');
        
        echo json_encode($this->Staff_model->load_subjects_to_assign_staff($data));  
    }
    
    function save_assign_dummy() {
        //post values
        $data['assign_id'] = $this->input->post('assign_id');
        $data['lecturer_id'] = $this->input->post('lecturer');
        if ($data['lecturer_id'] == null) {
            $data['lecturer_id'] = $this->input->post('lecturer_id');
        }
//        $data['qualifications'] = $this->input->post('qualifications');
        $data['teach_type_ids'] = $this->input->post('lecture_type_input');
        $data['subject_ids'] = $this->input->post('subject_input');
//        $data['hourly_rate'] = $this->input->post('hourly_rate');
        $data['course_id'] = $this->input->post('subject_course');
        if ($data['course_id'] == null) {
            $data['course_id'] = $this->input->post('course_id');
        }

        if (empty($data['assign_id'])) {
            //insert
            $exists = $this->Staff_model->is_lecturer_assigned_dummy($data['lecturer_id'],$data['course_id']);
            if ($exists) {
                $this->session->set_flashdata('flashError', 'Already assigned to this staff member.');
                $this->logger->systemlog('Save Assign', 'Failure', 'Already assigned to this staff member.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $result = $this->Staff_model->save_staff_assign_dummy($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Staff assign saved successfully.');
                    $this->logger->systemlog('Save Assign', 'Success', 'Staff assign saved successfully.', date("Y-m-d H:i:s", now()),$data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save staff assign. Retry.');
                    $this->logger->systemlog('Save Assign', 'Success', 'Failed to save staff assign.', date("Y-m-d H:i:s", now()),$data);
                }
            }
        } else {
            //update
            print_r('update');
            $result = $this->Staff_model->save_staff_assign_dummy($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Staff assign updated successfully.');
                $this->logger->systemlog('Save Assign', 'Success', 'Staff assign updated successfully.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update staff assign. Retry.');
                $this->logger->systemlog('Save Assign', 'Success', 'Failed to update staff assign.', date("Y-m-d H:i:s", now()),$data);
            }
        }
        redirect('staff/assign');
    }
}

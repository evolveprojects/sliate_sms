<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function student() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('hall_model');
        $this->load->model('course_model');
        $this->load->model('faculty_model');
        $this->load->model('batch_model');
        $this->load->model('company_model');
        $this->load->model('timetable_model');
        $this->load->model('Util_model');
        $this->load->model('Subject_model');
        $this->load->model('Approval_model');

        //$this->load->helper('download');
        $this->CI = & get_instance();
    }

    function student_view() {
        /*  $data['va']= $this->Student_model->edit_student();

          $data['main_content'] = 'add_student_view';

          $data['title'] = 'STUDENT';
          $this->load->view('includes/template', $data); */


        /* if(isset($_GET['student_id']))
          {
          $data['stu'] = $_GET['p'];
          }
          else
          {
          $data['stu'] = null;
          }

          print_r( $data['stu']); */
        //$data['edit_stu'] =$this->Student_model->edit_student();
        //$data['stu_data']['stu_data'] = array();
        //get files from database
        $data['files'] = $this->Student_model->getRows();
        //$data['centers'] = $this->Student_model->get_all_centers();
        $data['districts'] = $this->Student_model->load_districts();
        $data['stream'] = $this->Student_model->get_subject_stream();
        $data['ol_grade'] = $this->Student_model->get_subject_ol_result_grade();
        $data['al_grade'] = $this->Student_model->get_subject_al_result_grade();
        $data['student_reg_range'] = $this->Student_model->load_student_reg_range();

        $data['title_list'] = $this->Student_model->get_title();

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['centers'] = $this->Student_model->get_all_centers();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Student_model->get_center_admin_login_centers();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Student_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Student_model->get_login_user_centers();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['centers'] = $this->Student_model->get_login_user_centers();
        }

        $data['stu_data'] = null;
        $data['main_content'] = 'hci_studentreg_view';
        //$data['title_list'] = $this->Student_model->get_title();
        //$data['main_content'] = 'final_application';
        $data['title'] = 'student profile';

        $this->load->view('includes/template', $data);
    }

//    function save_student() {
//
//        $stu_id = $this->input->post('stu_id');
//        $apply_mahapola = $this->input->post('apply_mahapola');
//        $reg_no = $this->input->post('reg_no_part1').$this->input->post('reg_no_part2');
//        
//        if(!empty($_FILES['stuprof_pic']['name']))
//        {
//            $name_img = $_FILES['stuprof_pic']['name'];
//            $temp_info = explode('.', $name_img);
//            $ary_len = count($temp_info);
//
//            $config['upload_path']          = './uploads/studentprofile/';
//            $config['allowed_types']        = 'jpg|jpeg|gif|png';
//            $config['max_size']             = 100000;
//            $config['overwrite']            = TRUE;
//            $config['file_name']            = $reg_no;
//
//            $this->load->library('upload', $config);
//
//            if ( ! $this->upload->do_upload('stuprof_pic'))
//            {
//                $error = array('error' => $this->upload->display_errors());
//                $img_save_data = null;
//            }
//            else
//            {
//                $image_data = $this->upload->data();
//                $img_save_data = 'uploads/studentprofile/'.$image_data['file_name'];
//            }
//        }
//        else
//        {
//            $img_save_data = null;
//        }
//        
//        $savestu['reg_no']            = $this->input->post('reg_no_part1').$this->input->post('reg_no_part2');
//        $savestu['profileimage']      = $img_save_data;
//        $savestu['admission_no']      = $this->input->post('admission_no');
//        $savestu['center_id']         = $this->input->post('center_id');
//        $savestu['first_name']        = $this->input->post('first_name');
//        $savestu['last_name']         = $this->input->post('last_name');
//        $savestu['civil_status']      = $this->input->post('civil_status');
//        $savestu['sex']               = $this->input->post('sex');
//        $savestu['nic_no']            = $this->input->post('nic_no');
//        $savestu['birth_date']        = $this->input->post('birth_date');
//        
//        $savestu['age_year']        = $this->input->post('txtAgeYear');
//        $savestu['age_month']        = $this->input->post('txtAgeMonth');
//        $savestu['age_days']        = $this->input->post('txtAgeDays');
//        
//        $savestu['place_birth']       = $this->input->post('place_birth');
//        $savestu['religion']          = $this->input->post('religion');
//        $savestu['mobile_no']         = $this->input->post('mobile_no');
//        $savestu['fixed_tp']          = $this->input->post('fixed_tp');
//        $savestu['email']             = $this->input->post('email');
//        $savestu['permanent_address'] = $this->input->post('permanent_address');
//        $savestu['district']          = $this->input->post('district');
//        
//        //AL result se tion
//        $savestu['al_year']         = $this->input->post('al_year');
//        $savestu['al_index_no']       = $this->input->post('al_index_no');
//        $savestu['al_medium']         = $this->input->post('al_medium');
//        $savestu['al_stream']         = $this->input->post('al_stream');
//        $savestu['al_subject1']         = $this->input->post('al_subject1');
//        $savestu['al_subject2']         = $this->input->post('al_subject2');
//        $savestu['al_subject3']         = $this->input->post('al_subject3');
//        $savestu['al_subject4']         = $this->input->post('al_subject4');
//        $savestu['al_subject1_grade']         = $this->input->post('al_subject1_grade');
//        $savestu['al_subject2_grade']         = $this->input->post('al_subject2_grade');
//        $savestu['al_subject3_grade']         = $this->input->post('al_subject3_grade');
//        $savestu['al_subject4_grade']         = $this->input->post('al_subject4_grade');
//        $savestu['common_gen_paper']         = $this->input->post('com_gen_paper');
//  
//        $savestu['al_z_core']         = $this->input->post('al_score_mode').$this->input->post('al_z_core');
//
//        
//        //OL result section
//        $savestu['ol_year']        = $this->input->post('ol_year');
//        $savestu['ol_index_no']        = $this->input->post('ol_index_no');
//        $savestu['ol_medium']        = $this->input->post('ol_medium');
//        
//        $savestu['ol_maths_grade']        = $this->input->post('ol_Sub1_grade');
//        $savestu['ol_english_grade']        = $this->input->post('ol_Sub2_grade');
//        
//        //Part Time course Details.
//        $savestu['course_type']        = $this->input->post('course_type');
//        $savestu['employment']        = $this->input->post('prt_Present_emp');
//        $savestu['position']        = $this->input->post('prt_post');
//        $savestu['epf_no']        = $this->input->post('prt_EPF');
//        $savestu['work_place_address']        = $this->input->post('prt_address');
//        $savestu['appointment_date']        = $this->input->post('prt_app_date');
//        $savestu['business_reg_no']        = $this->input->post('prt_br');
//        $savestu['business_reg_date']        = $this->input->post('prt_date_br');
//        
//        //genaral section
//        $savestu['current_year']        = $this->input->post('faculty_id');
//        $savestu['current_semester']        = $this->input->post('faculty_id');
//        $savestu['faculty_id']        = $this->input->post('faculty_id');
//        $savestu['batch_id']          = $this->input->post('batch_id');
//        $savestu['course_id']         = $this->input->post('course_id');
//        $savestu['approved'] = 0;
//        $savestu['apply_mahapola'] = $apply_mahapola;
//        
//
//        $this->db->where('id',$savestu['batch_id']);
//        $batchinfo = $this->db->get('edu_batch')->row_array();
//
//        $savestu['current_year']      = $batchinfo['current_year'];
//        $savestu['current_semester']  = $batchinfo['current_semester'];
//        // $savestu['lastupgradeid']     = $batchinfo[''];
//
//        if ($stu_id == '') {
//            $savestu['create_by']        = $this->session->userdata('u_id');
//            $savestu['created_date']        = date("Y-m-d h:i:s", now());
//            //insert
//            $result = $this->db->insert('stu_reg',$savestu);
//            $insert_id = $this->db->insert_id();
//            if ($result) {
//                $this->session->set_flashdata('flashSuccess', 'student saved successfully. ');
//                $this->session->set_flashdata('insert_id', $insert_id);
//            } else {
//                $this->session->set_flashdata('flashError', 'Failed to save student. Retry.');
//            }
//        } else {
//            $savestu['updated_by']        = $this->session->userdata('u_id');
//            $savestu['updated_on']        = date("Y-m-d h:i:s", now());
//            //update
//            $this->db->where('stu_id',$stu_id);
//            $result = $this->db->update('stu_reg',$savestu);
//            if ($result) {
//                $this->session->set_flashdata('flashSuccess', 'student updated successfully.');
//                $this->session->set_flashdata('insert_id', $stu_id);
//            } else {
//                $this->session->set_flashdata('flashError', 'Failed to update student. Retry.');
//            }
//        }
//        
//        if($apply_mahapola){
//            redirect('student/mahapola_application_view');
//        } else {
//            redirect('student/student_lookup');
//        }
//        
//    }

    function save_student() {
        $this->Student_model->save_student();
    }

    function mahapola_application_view() {

        if (isset($_GET['type'])) {
            $data['type'] = $_GET['type'];
        } else {
            $data['type'] = null;
        }

        $function1 = $this->uri->segment(1);
        $function2 = $this->uri->segment(2);

        $final_func = $function1 . "/" . $function2;

        if (($data['type'] != null) && ($data['type'] == 'mahapola_approval')) {
            $data['access_mahapola'] = $this->Student_model->get_user_access_right_for_sub_menu($final_func);
        }

        $data['title_list'] = $this->Student_model->get_title();
        $data['districts'] = $this->Student_model->load_districts();
        $data['main_content'] = 'final_application';
        $data['title'] = 'Mahapola Application';
        //$data['stu_id'] = $insert_id;
        $this->load->view('includes/template', $data);
    }

    function load_mahapola_details() {
        echo json_encode($this->Student_model->load_all_data());
    }

    function save_student_mahapola() {

        //save_student_mahapola
        $result = $this->Student_model->save_student_mahapola();
        echo json_encode($result);
    }

    function set_studentdatasession() {
        $this->session->set_userdata('sessionstu', $_POST['id']);

        echo true;
    }

    function load_stueditview() {
        if (isset($_SESSION['sessionstu'])) {
            $data['centers'] = $this->Student_model->get_all_centers();
            $data['districts'] = $this->Student_model->load_districts();
            $data['courses'] = $this->Student_model->load_course_list();
            $data['stream'] = $this->Student_model->get_subject_stream();
            $data['ol_grade'] = $this->Student_model->get_subject_ol_result_grade();
            $data['al_grade'] = $this->Student_model->get_subject_al_result_grade();
            $data['student_reg_range'] = $this->Student_model->load_student_reg_range();
            $data['stu_data'] = $this->db->get_where('stu_reg', array('stu_id' => $_SESSION['sessionstu']))->row_array();
            $data['main_content'] = 'hci_studentreg_view'; //'hci_studentedit_view';
            $data['title'] = 'Student Edit';
            $this->load->view('includes/template', $data);
        } else {
            $this->session->set_flashdata('flashError', 'Session Expired. Login to continue');
            redirect('student/student_lookup');
        }
    }

    function load_student_details() {
        if (isset($_SESSION['sessionstu'])) {
            $stu_id = $this->input->post('stu_id');
            $data = $this->db->get_where('stu_reg', array('stu_id' => $stu_id))->row_array();
            echo json_encode($data);
            // $data['main_content'] = 'hci_studentreg_view';//'hci_studentedit_view';
            // $data['title'] = 'Student Edit';
            //  $this->load->view('includes/template', $data);
        } else {
            $this->session->set_flashdata('flashError', 'Session Expired. Login to continue');
            redirect('student/student_lookup');
        }
    }

    function change_student_status() {
        //post values
        $data['student_id'] = $this->input->post('student_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->Student_model->update_student_status($data));
    }

    function stu_update_view() {

        if (isset($_GET['id'])) {
            $data['stu'] = $_GET['id'];
        } else {
            $data['stu'] = null;
        }


        $data['edit_stu'] = $this->Student_model->edit_student($data['stu']);

        //$data['title_new'] = $this->Student_model->get_title();
        $data['main_content'] = 'student_update_view.php';
        $data['title'] = 'staff_registration';
        $this->load->view('includes/template', $data);
    }

    function stuprof_view() {

        $id = urldecode(base64_decode($_GET["id"]));
        if (isset($id)) {
            $data['stu_id'] = $id;
        } else {
            $data['stu_id'] = null;
        }

        if (isset($_GET['type'])) {
            $data['type'] = $_GET['type'];
        } else {
            $data['type'] = null;
        }

        $function1 = $this->uri->segment(1);
        $function2 = $this->uri->segment(2);

        $final_func = $function1 . "/" . $function2;

        if (($data['type'] != null) && ($data['type'] == 'approval')) {
            $data['access_function'] = $this->Student_model->get_user_access_right($final_func);
        }

        if (($data['type'] != null) && ($data['type'] == 'mahapola_approval')) {
            $data['access_mahapola'] = $this->Student_model->get_user_access_right_for_sub_menu($final_func);
        }

        $data['stu_data'] = $this->Student_model->view_stu_prof($data['stu_id']);
        $data['stu_subjects'] = $this->Student_model->get_current_subjects($data['stu_id']);
        $data['main_content'] = 'student_profile.php';
        $data['title'] = 'Student Profile';
        $this->load->view('includes/template', $data);
    }

    function student_lookup() {

        $data['centers'] = $this->hall_model->get_all_centers();
        //$data['all_faculties'] = $this->auth->get_accessfaculties();
        $access_level = $this->Util_model->check_access_level();
        //print_r($access_level);
        $ug_level = $access_level[0]['ug_level'];
        $data['result_array'] = null;
        if ($ug_level == 1) { //Admin
            //get All students
            //$data['result_array'] = $this->Student_model->get_all_students();
        } else if ($ug_level == 2) { //
            //$data['result_array'] = $this->Student_model->get_center_students();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            //$data['result_array'] = $this->Student_model->get_center_students();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            //$data['result_array'] = $this->Student_model->get_center_students();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_student();
        }

        //get all permission to user group
        //$sessi = $this->Util_model->check_rights();
        //print_r($sessi);
        //print_r($this->session->userdata);
        $data['ug_level'] = $ug_level;
        $data['main_content'] = 'student_lookup_view';
        $data['title'] = 'STUDENT LOOKUP';
        $this->load->view('includes/template', $data);
    }

    function student_profile() {

        $data['main_content'] = 'student_profile_view';
        $data['title'] = 'STUDENT PROFILE';
        $this->load->view('includes/template', $data);
    }

    function subject_selection() {


        $data['all_courses'] = $this->course_model->load_courses_complete();
        //$data['centers'] = $this->hall_model->get_all_centers();
//        $data['all_faculties'] = $this->auth->get_accessfaculties();

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['centers'] = $this->Student_model->get_all_centers();
            $data['all_courses'] = $this->course_model->load_courses_complete();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Student_model->get_center_admin_login_centers();
            $data['all_courses'] = $this->course_model->load_courses_complete();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Student_model->get_login_user_centers();
            $data['all_courses'] = $this->course_model->load_courses_complete();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Student_model->get_login_user_centers();
            $data['all_courses'] = $this->course_model->load_courses_complete();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['centers'] = $this->Student_model->get_login_user_centers();
            $data['all_courses'] = $this->Student_model->load_courses_complete();
        }

        $data['main_content'] = 'student_subject_selection_view';
        $data['title'] = 'STUDENT SUBJECTS SELECTION';
        $this->load->view('includes/template', $data);
    }

    function semester_upgrade() {
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info'] = $this->company_model->get_ay_info();
        $data['main_content'] = 'student_semester_upgrade_view';
        $data['title'] = 'STUDENT UPGRADE';
        $this->load->view('includes/template', $data);
    }

    function student_attendance() {

        $data['main_content'] = 'student_attendance_view';
        $data['title'] = 'STUDENT ATTENDANCE';
        $this->load->view('includes/template', $data);
    }

    function get_student_list() {
        $batch_id = $this->input->post('batch_id');
        $branch = $this->input->post('branch');
        $year = $this->input->post('year');
        $semester = $this->input->post('semester');
        $status = $this->input->post('status');

        //$faculty = $this->input->post('faculty');
        echo json_encode($this->Student_model->get_students_by_batch($batch_id, $branch, $year, $semester, $status));
    }

    function get_student_list_by_level() {
        $batch_id = $this->input->post('batch_id');
        $branch = $this->input->post('branch');
        $year = $this->input->post('year');
        $semester = $this->input->post('semester');
        $status = $this->input->post('status');

        //$faculty = $this->input->post('faculty');
        //echo json_encode($this->Student_model->get_students_by_batch($batch_id,$branch,$year,$semester,$status));

        $access_level = $this->Util_model->check_access_level();
        $sessi_uid = $this->CI->session->userdata('user_ref_id');


        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->get_students_by_batch($batch_id, $branch, $year, $semester, $status));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->get_students_by_batch($batch_id, $branch, $year, $semester, $status));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->get_students_by_batch($batch_id, $branch, $year, $semester, $status));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->get_students_by_batch($batch_id, $branch, $year, $semester, $status));
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            echo json_encode($this->Student_model->get_students_by_batch_student_id($sessi_uid, $batch_id, $branch, $year, $semester, $status));
        }
    }

    function get_semester_subjects() {
        $data['course_id'] = $this->input->post('course_id');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');

        echo json_encode($this->Student_model->get_semester_subjects($data));
    }

    function save_student_subjects() {
        //post values
        $data['center'] = $this->input->post('center');
        //$data['faculty'] = $this->input->post('faculty');
        $data['course_id'] = $this->input->post('Dcode');
        $data['batch_id'] = $this->input->post('Bcode');
        $data['student_id'] = $this->input->post('student');
        $data['year_no'] = $this->input->post('no_year');
        $data['semester_no'] = $this->input->post('no_semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['subj_group'] = $this->input->post('subj_group');

        if (isset($_POST['c_subject'])) {
            $data['core_subjects'] = $this->input->post('c_subject');
            $data['c_subject_version'] = $this->input->post('c_subject_version');
        }
        if (isset($_POST['e_subject'])) {
            $data['elective_subjects'] = $this->input->post('e_subject');
            $data['e_subject_version'] = $this->input->post('e_subject_version');
        }

        $access_level = $this->Util_model->check_access_level();
        $data['ug_level'] = $access_level[0]['ug_level'];


        echo json_encode($this->Student_model->save_student_subjects($data));
    }

    function filter_students_subject_selection() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');


        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->filter_students_subject_selection($data));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->filter_students_subject_selection($data));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->filter_students_subject_selection($data));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->filter_students_subject_selection($data));
            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Student_model->filter_students_subject_selection_student_id($data));
        }
    }

    function filter_students_batch_lookup() {
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');

        echo json_encode($this->Student_model->filter_students_batch_lookup($data));
    }

    function update_student_subject_status() {
        $data['stu_co_id'] = $this->input->post('stu_co_id');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->Student_model->update_student_subject_status($data));
    }

    function get_student_subject_list() {
        $stu_co_id = $this->input->post('stu_co_id');
        echo json_encode($this->Student_model->get_student_subject_list($stu_co_id));
    }

    function students_without_subject() {
        $data['center_id'] = $this->input->post('center_id');
        //$data['faculty_id'] = $this->input->post('faculty_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');


        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->students_without_subject($data));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->students_without_subject($data));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->students_without_subject($data));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->students_without_subject($data));
            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Student_model->students_without_subject_student_id($data));
        }
    }

    //promote student ( anually and semesterwise )
    function student_promote_view() {
        // $data['all_faculties'] = $this->faculty_model->all_active_faculties();
        // $data['result_array'] = $this->Student_model->get_all_students();
        $data['main_content'] = 'student_promote_view';
        $data['title'] = 'PROMOTE STUDENT';
        $this->load->view('includes/template', $data);
    }

    function load_student_list() {
        echo json_encode($this->Student_model->load_student_list());
    }

    function load_times_slots() {
        echo json_encode($this->Student_model->load_times_slots());
    }

    function update_attendance() {
        echo json_encode($this->Student_model->update_attendance());
    }

    function load_student_for_apply_exam() {
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['branch'] = $this->input->post('branch');
        $data['sem_exam_id'] = $this->input->post('sem_exam_id');

        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->students_for_apply_exam($data, $batch_details));
    }

    function load_student_applied_exam() {
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['branch'] = $this->input->post('branch');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->applied_exam_students($data, $batch_details));
    }

    function load_student_approved_exam() {
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['branch'] = $this->input->post('branch');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->approved_exam_students($data, $batch_details));
    }

    function load_student_current_subjects() {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->load_student_current_subjects($data, $batch_details));
    }

    function apply_exam() {
        $data['exam_id'] = $this->input->post('exam1');
        $data['apply_exam'] = $this->input->post('apply_exam');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course'] = $this->input->post['course'];
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->apply_for_exam($data, $batch_details));
    }

    function apply_repeat_exam_request() {
        $data['exam_id'] = $this->input->post('rpt_exam');
        $data['rpt_apply_exam_request'] = $this->input->post('rpt_apply_exam_request');
        $data['batch_id'] = $this->input->post('rpt_batch');
        $data['course'] = $this->input->post['rpt_course'];
        $data['year_no'] = $this->input->post('rpt_year');
        $data['semester_no'] = $this->input->post('rpt_semester');
        $data['repeat_apply_type'] = $this->input->post('repeat_apply_type');

        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Student_model->apply_repeat_exam_request($data, $batch_details));
    }

    function check_repeat_attempts() {
        $data['rpt_apply_exam_request'] = $this->input->post('rpt_apply_exam_request');
        echo json_encode($this->Student_model->check_repeat_attempts($data));
    }

    function load_student_for_exam_marks() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $user_level = $this->input->post('user_level');
        // if($user_level=='lec')
        switch ($user_level) {
            case 'ca_mark':
                echo json_encode($this->Student_model->load_student_for_exam_marks_ca($data));
                break;
            case 'se_mark':
                echo json_encode($this->Student_model->load_student_for_exam_marks_se($data));
                break;
            case 'hod':
                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_hod_ca($data));
                break;
            case 'dir':
                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_dir_ca($data));
                break;
            case 'ex_dir':
                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_dir_se($data));
                break;

            default:
                $message_403 = "request failed!!!";
                show_error($message_403, 403);
        }

        //echo json_encode($this->Student_model->load_student_for_exam_marks_hod($data));
    }

    function load_rpt_student_for_exam_marks() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $user_level = $this->input->post('user_level');
        // if($user_level=='lec')
        switch ($user_level) {
            case 'ca_mark':
                echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_ca($data));
                break;
            case 'se_mark':
                echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_se($data));
                break;
            case 'hod':
                echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_approval_hod_ca($data));
                break;
            case 'dir':
                echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_approval_dir_ca($data));
                break;
            case 'ex_dir':
                echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_approval_dir_se($data));
                break;

            default:
                $message_403 = "request failed!!!";
                show_error($message_403, 403);
        }

        //echo json_encode($this->Student_model->load_student_for_exam_marks_hod($data));
    }

    function load_student_for_exam_marks_training() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->Student_model->load_student_for_exam_marks_training($data));
    }

    function load_rpt_student_for_exam_marks_training() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->Student_model->load_rpt_student_for_exam_marks_training($data));
    }

    function load_student_exam_marks() {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['repeat'] = $this->input->post('repeat');
        echo json_encode($this->Student_model->load_student_exam_marks($data));
    }

    function load_student_for_semester_update() {
        $data['center_id'] = $this->input->post('center');
        $data['course_id'] = $this->input->post('course');
        $data['s_season_id'] = $this->input->post('s_season');
        $data['batch_id'] = $this->input->post('batch_code');
        print_r($data);
        echo json_encode($this->Student_model->load_student_for_semester_update($data));
    }

    function load_student_reg_range() {

        echo json_encode($this->Student_model->load_student_reg_range());
    }

    function load_batchesforupgrade() {
        echo json_encode($this->Student_model->load_batchesforupgrade());
    }

    function load_batch_student() {
        echo json_encode($this->Student_model->load_batch_student());
    }

    function upgrade_students() {
        echo json_encode($this->Student_model->upgrade_students());
    }

    function load_batches() {
        echo json_encode($this->Student_model->load_batches());
    }

    function load_districts() {
        $districts = $this->Student_model->load_districts();
        echo json_encode($districts);
    }

    function load_course_list_add_student() {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_course_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Student_model->load_course_list_student_add_student());
            //echo json_encode($this->Student_model->load_student_courses());  
        }
    }

    function load_course_list() {


        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_course_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            //echo json_encode($this->Student_model->load_course_list_student_add_student());           
            echo json_encode($this->Student_model->load_student_courses());
        }
    }

    function load_subject_selection_course_list() {
        $access_level = $this->Util_model->check_access_level();
        //print_r($access_level);
        $ug_level = $access_level[0]['ug_level'];
        $stu_id = 0;
        $course_id = 0;
        if ($ug_level == 5) {
            $stu_id = $this->CI->session->userdata('user_ref_id');

            $data_stu = $this->Student_model->edit_student($stu_id);
            // print_r($data_stu);
            $course_id = $data_stu[0]['course_id'];
        }
        echo json_encode($this->Student_model->load_subject_selection_course_list($ug_level, $course_id));
    }

    function load_al_subject_list() {
        echo json_encode($this->Student_model->load_al_subject_list());
    }

    function load_year_list() {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_year_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records.       
            echo json_encode($this->Student_model->load_year_list_for_request());
        }
    }

    function load_year_list_for_request() {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) {
            //Admin
            //get All students
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 2) {
            //Directors
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 3) {
            // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_year_list());
        } else if ($ug_level == 4) {
            // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_year_list());
            //get access rights to that user
        } else {
            // Student
            //get only logged in user records.       
            echo json_encode($this->Student_model->load_year_list_for_request());
        }
    }

    function load_batch_list() {
        echo json_encode($this->Student_model->load_batch_list());
    }

    function load_semesters() {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_semesters());
        } else if ($ug_level == 2) { //Directors
            echo json_encode($this->Student_model->load_semesters());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_semesters());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_semesters());
            //get access rights to that user
        } else { // Student
            //get only logged in user records.       
            echo json_encode($this->Student_model->load_semester_list_for_request());
        }
    }

    function load_semesters_from_year() {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Student_model->load_semesters_from_year());
        } else if ($ug_level == 2) { //Directors
            echo json_encode($this->Student_model->load_semesters_from_year());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Student_model->load_semesters_from_year());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Student_model->load_semesters_from_year());
            //get access rights to that user
        } else { // Student
            //get only logged in user records.       
            // echo json_encode($this->Student_model->load_semester_list_from_years());  
            echo json_encode($this->Student_model->load_semesters_from_year());
        }
    }

    function search_students_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');

        echo json_encode($this->Student_model->search_students_lookup($data));
    }

    public function download($id) {

        if (!empty($id)) {
            //load download helper
            $this->load->helper('download');

            //get file info from database
            $fileInfo = $this->Student_model->getRows(array('id' => $id));

            //file path
            $file = $fileInfo['profileimage'];

            //download file from directory
            force_download($file, NULL);
        }
    }

    function check_student_reg_no() {

        echo json_encode($this->Student_model->check_student_reg_no());
    }

    function load_initial_batch_list() {
        echo json_encode($this->Student_model->load_batch_list());
    }

    function load_stu_initial_batch_assign() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['intake_type'] = $this->input->post('intake_type');

        echo json_encode($this->Student_model->load_stu_initial_batch_assign($data));
    }

    function initial_batch_assign() {
        echo json_encode($this->Student_model->initial_batch_assign());
    }

    function load_remove_student_list() {
        echo json_encode($this->Student_model->load_remove_student_list());
    }

    function transfer_student() {
        $data['centers'] = $this->hall_model->get_all_centers();
        //$data['all_faculties'] = $this->auth->get_accessfaculties();
        $access_level = $this->Util_model->check_access_level();
        //print_r($access_level);
        $ug_level = $access_level[0]['ug_level'];
        if ($ug_level == 1) { //Admin
            //get All students
            $data['reg_no_list'] = $this->Student_model->load_reg_no_list_transfer();
            $data['nic_no_list'] = $this->Student_model->load_nic_no_list_transfer();
            $data['removed_student_list'] = $this->Student_model->load_remove_student_list();
            $data['reg_no_list_remove'] = $this->Student_model->load_reg_no_list_remove();
            $data['nic_no_list_remove'] = $this->Student_model->load_nic_no_list_remove();
        } else if ($ug_level == 2) { //
            $data['reg_no_list'] = $this->Student_model->load_reg_no_list_by_center_transfer();
            $data['reg_no_list_remove'] = $this->Student_model->load_reg_no_list_by_center_remove();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['reg_no_list'] = $this->Student_model->load_reg_no_list_by_center_transfer();
            $data['reg_no_list_remove'] = $this->Student_model->load_reg_no_list_by_center_remove();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['reg_no_list'] = $this->Student_model->load_reg_no_list_by_center_transfer();
            $data['reg_no_list_remove'] = $this->Student_model->load_reg_no_list_by_center_remove();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['reg_no_list'] = $this->Student_model->get_student();
        }
        $data['courses'] = $this->Student_model->get_courses();

        //$data['reg_no_list'] = $this->Student_model->load_reg_no_list();
        $data['student_reg_range'] = $this->Student_model->load_student_reg_range();
        $data['main_content'] = 'transfer_student_view';
        $data['title'] = 'TRANSFER STUDENT';
        $this->load->view('includes/template', $data);
    }

    function get_student_reg_id() {
        echo json_encode($this->Student_model->get_student_reg_id());
    }

    function save_transfer_student() {
        $this->Student_model->save_transfer_student();
    }

    function remove_student() {
        /* previous */
        //$reg_no = $this->input->post('reg_no');
        //echo json_encode($this->Student_model->remove_student($reg_no));
        /* previous */


        $reg_no = $this->input->post('reg_no');
        $search_type_remove = $this->input->post('search_type_remove');
        echo json_encode($this->Student_model->remove_student($reg_no, $search_type_remove));
    }

    function update_mahapola_eligible_status() {
        $mpyear = $this->input->post('mpyear');

        $sessi = $this->Util_model->check_function_rights('Student :: update_mahapola_eligible_status');
        //print_r($sessi);
        //echo json_encode($sessi);
        if (isset($sessi[0]['func_status'])) {
            if ($sessi[0]['func_status'] == "A") {
                $this->Student_model->update_mahapola_eligible_status($mpyear);
            } else {
                echo json_encode('denied');
            }
        } else {
            echo json_encode('denied');
        }
    }

    function check_duplicate_nic_no() {
        echo json_encode($this->Student_model->check_duplicate_nic_no());
    }

    function check_duplicate_nic_no_online_reg() {
        echo json_encode($this->Student_model->check_duplicate_nic_no_online_reg());
    }

    function save_student_subjects_support() {
        //post values
        $data['center'] = $this->input->post('center');
        //$data['faculty'] = $this->input->post('faculty');
        $data['course_id'] = $this->input->post('Dcode');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('no_year');
        $data['semester_no'] = $this->input->post('no_semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['subj_group'] = $this->input->post('subj_group');

        $core_subjects_array = $this->Subject_model->get_group_core_subjects($data['subj_group']);
        $c_subject_version_array = $this->Subject_model->get_group_core_subject_version($data['subj_group']);//

        $data['core_subjects'] = array();
        $data['c_subject_version'] = array();
        foreach ($core_subjects_array as $core_sub) {
            $data['core_subjects'][] = $core_sub['id'];
        }
        foreach ($c_subject_version_array as $core_version) {
            $data['c_subject_version'][] = $core_sub['id'];
        }
        echo json_encode($this->Student_model->save_student_subjects_support($data));
    }

    function online_registration() {
        $data['centers'] = $this->Student_model->get_all_centers();
        $data['districts'] = $this->Student_model->load_districts();
        $data['stream'] = $this->Student_model->get_subject_stream();
        $data['ol_grade'] = $this->Student_model->get_subject_ol_result_grade();
        $data['al_grade'] = $this->Student_model->get_subject_al_result_grade();
        $data['student_reg_range'] = $this->Student_model->load_student_reg_range();

        $data['title_list'] = $this->Student_model->get_title();

        $data['stu_data'] = null;
        $data['main_content'] = 'student_online_reg';
        $data['title'] = 'Student Online Registration';

        $this->load->view('student_online_reg', $data);
    }

    function save_online_registration() {
        $this->Student_model->save_online_registration();
    }

    function load_courses_for_center() {
        echo json_encode($this->Student_model->load_course_list());
    }

    function check_student_approved_status() {

        $data['centers'] = $this->hall_model->get_all_centers();
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        echo json_encode($this->Student_model->check_student_approved_status($ug_level));
    }

    function search_terminate_batch_lookup() {
        $data['tb_course_id'] = $this->input->post('tb_course_id');


        echo json_encode($this->Student_model->search_terminate_batch_lookup($data));
    }

    function update_batch_terminate_status() {
        $data['batch_id'] = $this->input->post('batch_id');
        echo json_encode($this->Student_model->update_batch_terminate_status($data));
    }

    function dummy_update_subjects() {
        $data['center'] = $this->input->post('subj_center');
        $data['course_id'] = $this->input->post('subj_course');
        $data['batch_id'] = $this->input->post('subj_batch');
        $data['year_no'] = $this->input->post('subj_year');
        $data['semester_no'] = $this->input->post('subj_semester');
        
        //$data['subj_group'] = $this->input->post('subj_group');
        //$data['c_subject_version'] = $this->input->post('c_subject_version');
        //$data['e_subject_version'] = $this->input->post('e_subject_version');
        //$data['student_id'] = $this->input->post('student');
        
        //print_r($data);
        
        
        $obj = json_decode($_POST["myData"],true);
        echo json_encode($this->Student_model->dummy_update_subjects($data,$obj));
        

    }
    /*
    function dummy_upload(){
        $config['upload_path']          = './img/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('userfile')){
            //$error = array('error' => $this->upload->display_errors());

            $this->load->view('exam_marks_view');
        }else{
            //$data = array('upload_data' => $this->upload->data());

            $this->load->view('exam_marks_view');
        }
    }
    */
    
    function do_upload(){
        $config['upload_path']     = './uploads/';
        $config['allowed_types']   = 'xlsx|xls';
        $config['max_size']        = '2048000000';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('transfer_student_view', $error);
        }else{
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('transfer_student_view', $data);
        }
        
    }
    
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    function get_relevent_marking_details(){
        
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');
        $sem_no = $this->input->post('sem_no');
        $batch_no = $this->input->post('batch_no');
        $subject_id = $this->input->post('subject_id');
        
        echo json_encode($this->Student_model->get_relevent_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id));
    }
    
}

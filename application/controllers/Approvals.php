<?php

class Approvals extends CI_Controller
{

    public function _remap($method, $args = array())
    {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            //$this->index($method,$args);
            show_404();
        }
    }


    public function Approvals()
    {
        parent::__construct();
        $this->load->model('Approval_model');
        $this->load->model('Util_model');
        $this->load->model('Student_model');
        $this->load->model('batch_model');
        $this->CI =& get_instance();

    }

    function student_approvals()
    {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

//        if ($ug_level == 1) { //Admin
//            //get All students
//            $data['result_array'] = $this->Approval_model->get_all_approval_students();
//            $data['reject_array'] = $this->Approval_model->get_all_rejected_students();
//        } else if ($ug_level == 2) { //
//            $data['result_array'] = $this->Approval_model->get_center_approval_students();
//            $data['reject_array'] = $this->Approval_model->get_center_rejected_students();
//        } else if ($ug_level == 3) { // Registrar
//            //get the only Logged in user center Students details.
//            $data['result_array'] = $this->Approval_model->get_center_approval_students();
//            $data['reject_array'] = $this->Approval_model->get_center_rejected_students();
//        } else if ($ug_level == 4) { // Lecturer
//            $data['result_array'] = $this->Approval_model->get_center_approval_students();
//            $data['reject_array'] = $this->Approval_model->get_center_rejected_students();
//            //get the only Logged in user center Students details and send rights to the controls like buttons.
//            //get access rights to that user
//        } else // Student
//        {
//            //get only logged in user records. 
//            $data['result_array'] = $this->Student_model->get_student();
//        }
        $data['year_list'] = $this->Approval_model->get_mahapola_applied_years();
        
        $data['ug_level'] = $ug_level;
        $data['main_content'] = 'student_approval_view';
        $data['title'] = 'STUDENT APPROVALS';
        $this->load->view('includes/template', $data);
    }
    
    function get_student_approval_data(){
        $year = $this->input->post('year');
        
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['result_array'] = $this->Approval_model->get_all_approval_students($year);
            $data['reject_array'] = $this->Approval_model->get_all_rejected_students($year);
        } else if ($ug_level == 2) { //
            $data['result_array'] = $this->Approval_model->get_center_approval_students($year);
            $data['reject_array'] = $this->Approval_model->get_center_rejected_students($year);
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Approval_model->get_center_approval_students($year);
            $data['reject_array'] = $this->Approval_model->get_center_rejected_students($year);
        } else if ($ug_level == 4) { // Lecturer
            $data['result_array'] = $this->Approval_model->get_center_approval_students($year);
            $data['reject_array'] = $this->Approval_model->get_center_rejected_students($year);
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_student();
        }
        
//        $data['approve_array'] = $this->Approval_model->get_center_approval_students_by_year($year);
//        $data['reject_array'] = $this->Approval_model->get_center_reject_students_by_year($year);
        echo json_encode($data);
    }

    function mahapola_approvals()
    {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin //get all students
            $data['result_array'] = $this->Approval_model->get_all_approval_mahapola_students();
            $data['reject_array'] = $this->Approval_model->get_all_rejected_mahapola_students();
        } else if ($ug_level == 2) { //
            $data['result_array'] = $this->Approval_model->get_center_approval_mahapola_students();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_mahapola_students();
        } else if ($ug_level == 3) { // Registrar
            $data['result_array'] = $this->Approval_model->get_center_approval_mahapola_students();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_mahapola_students();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            //get access rights to that user
            $data['result_array'] = $this->Approval_model->get_center_approval_mahapola_students();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_mahapola_students();
        } else // Student
        {
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_mahapola_student();
        }

        $data['ug_level'] = $ug_level;
        $data['mpyear_list'] = $this->Approval_model->get_mahapola_applied_years();

        $data['main_content'] = 'mahapola_approvals';
        $data['title'] = 'Mahapola Approvals';
        $this->load->view('includes/template', $data);
    }

    function staff_approvals()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin //get all students
            $data['result_array'] = $this->Approval_model->get_all_approval_staff();
            $data['reject_array'] = $this->Approval_model->get_all_rejected_staff();

        } else if ($ug_level == 2) { //
            $data['result_array'] = $this->Approval_model->get_center_approval_staff();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_staff();

        } else if ($ug_level == 3) { // Registrar
            $data['result_array'] = $this->Approval_model->get_center_approval_staff();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_staff();

        } else if ($ug_level == 4) { // Lecturer
            $data['result_array'] = $this->Approval_model->get_center_approval_staff();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_staff();

            //get the only Logged in user center Students details and send rights to the controls like buttons.

            //get access rights to that user
        } else // Student
        {
            $data['result_array'] = $this->Approval_model->get_center_approval_staff();
            $data['reject_array'] = $this->Approval_model->get_center_rejected_staff();

        }

        $data['ug_level'] = $ug_level;
        $data['main_content'] = 'staff_approvals';
        $data['title'] = 'Staff Approvals';
        $this->load->view('includes/template', $data);
    }

    function director_approval()
    {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $ug_branch = $access_level[0]['ug_branch'];
        $ug_course = $access_level[0]['ug_course'];
        $br_code = $access_level[0]['br_code'];
        $br_name = $access_level[0]['br_name'];

        $data['ug_level'] = $ug_level;
        $data['ug_branch'] = $ug_branch;
        $data['ug_course'] = $ug_course;
        $data['br_code'] = $br_code;
        $data['br_name'] = $br_name;

        $data['user_type'] = '';
        
        if($ug_level == 1){
            $data['user_type'] = 'admin';
            $data['courses'] = $this->Approval_model->get_all_courses_list();
        } else if($ug_level == 2){
            if($ug_course == null || $ug_course == ''){
                
                $data['user_type'] = 'dir';
            } else {
                $data['user_type'] = 'hod';
            }
        }
        
        $data['courses'] = $this->Approval_model->get_all_courses_list();
        $data['mpyear_list'] = $this->Approval_model->get_mahapola_applied_years();

        $query = $this->Approval_model->get_postpone();
        $data['POSTPONE'] = array();
        if ($query) {
            $data['POSTPONE'] = $query;
        }
        
        $data['lecture_ttbl'] = $this->Approval_model->get_exam_timetable();
        $data['lecture_ttbl_reject'] = $this->Approval_model->get_exam_timetable_reject();
            
        $data['main_content'] = 'director_approval_view';
        $data['title'] = 'DIRECTOR APPROVAL';
        $this->load->view('includes/template', $data);
    }

    function student_upgade_approvals()
    {

        $data['result_array'] = $this->Approval_model->get_all_approval_update_students();
        $data['reject_array'] = $this->Approval_model->get_all_rejected_update_students();

        $data['main_content'] = 'student_upgade_approvals_view';
        $data['title'] = 'STUDENT UPGADE APPROVALS';
        $this->load->view('includes/template', $data);
    }

    function change_student_approval_status()
    {
        //post values   
        $data['student_id'] = $this->input->post('student_id');
        $data['approved'] = $this->input->post('approved');
        $data['reg_no'] = $this->input->post('reg_no');
        $data['nic'] = $this->input->post('nic');
        $data['branch'] = $this->input->post('branch');
        $data['email'] = $this->input->post('email');
        $data['email_status'] = $this->input->post('email_sent_status');

        $reslt = $this->Approval_model->update_student_approval_status($data);

        if ($reslt) {
            if ($data['approved'] == 1) {
                if ($data['email_status'] == 0) {
                    $stu_id = $this->input->post('student_id');
                    $email_reslt = $this->Approval_model->get_student_email($stu_id);

                    $email = strtolower($email_reslt['email']);
                    //                $res == 'valid'

                    $config = Array(
                        'protocol' => 'HTTP',
                        'smtp_host' => 'ssl://smtp.gmail.com',   //smtp.gmail.com
                        'smtp_port' => 465,
                        'auth' => true,
                        'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
                        'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );

                    $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">Student Registered Successfully!</h2></div>';
                    $htmlContent .= '<p>' . $email_reslt['first_name'] . ',</p>';
                    $htmlContent .= '<h2>CONGRATULATIONS!</h2>';
                    $htmlContent .= '<p>You have successfully completed your online registration at SLIATE-SMS for the course of ' . $email_reslt['course_name'] . ' at Advanced Technological Institute - ' . $email_reslt['br_name'] . '. We warmly welcome you to the  SLIATE Family. Your student profile has been created and the login information is as follows:</p>';
                    $htmlContent .= 'Link : <a href="http://student.sliate.ac.lk/">student.sliate.ac.lk</a><br/>';
                    $htmlContent .= 'User Name : ' . $email_reslt['reg_no'] . '<br/>';
                    $htmlContent .= 'Passoword : ' . $email_reslt['nic_no'];
                    $htmlContent .= '<br/><br/>We wish you all the best for your future endeavours.<br/>';
                    $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';
                    //                    $message = 'Dear ' +$email_reslt['first_name']+ '! <br/> You have registered successfully for “Course Name” in “Center Name”.';
                    $this->load->library('Email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('sms@sliate.ac.lk'); // change it to yours
                    $this->email->to($email);// change it to yours
                    $this->email->bcc('student.sliate.ac.lk@gmail.com');
                    $this->email->subject('Auto reply at student registration !');
                    $this->email->message($htmlContent);

                    if (!$this->email->send()) {
                        $this->session->set_flashdata('flashSuccess', 'Student Approved.<span style="color:red;"><b> Email Could Not Sent.</b></span>.');
                        $this->logger->systemlog('Student Approval', 'Success', 'Student Approved.Email not sent', date("Y-m-d H:i:s", now()), $data);
                        //show_error($this->email->print_debugger());
                    } else {
                        $this->Approval_model->update_email_status($email_reslt['reg_no']);
                        $this->session->set_flashdata('flashSuccess', 'Student Approved Successfully. Email Sent.');
                        $this->logger->systemlog('Student Approval', 'Success', 'Student Approved Successfully. Email Sent.', date("Y-m-d H:i:s", now()), $data);
                    }
                } else {
                    $this->session->set_flashdata('flashSuccess', 'Student Approved Successfully.');
                    $this->logger->systemlog('Student Approval', 'Success', 'Student Approved Successfully.', date("Y-m-d H:i:s", now()), $data);
                }
            }
            if ($data['approved'] == 3) {
                $this->session->set_flashdata('flashSuccess', 'Student Rejected Successfully.');
                $this->logger->systemlog('Student Approval', 'Success', 'Student Rejected Successfully.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        echo json_encode($reslt);
    }

    function apprvstuprof_view()
    {

        if (isset($_GET['id'])) {
            $data['stu_id'] = $_GET['id'];
        } else {
            $data['stu_id'] = null;
        }

        $data['stu_data'] = $this->Approval_model->view_stu_prof($data['stu_id']);
        $data['stu_subjects'] = $this->Approval_model->get_current_subjects($data['stu_id']);
        $data['main_content'] = 'apprv_stu_prof_view.php';
        $data['title'] = 'Student Profile';
        $this->load->view('includes/template', $data);
    }

    function change_staff_approval_status()
    {
        //post values   
        $data['stf_id'] = $this->input->post('stf_id');
        $data['approved'] = $this->input->post('approved');
        $data['staffindex'] = $this->input->post('staffindex');
        $data['nic'] = $this->input->post('nic');
        $data['center_id'] = $this->input->post('center_id');
        $data['stf_email'] = $this->input->post('stf_email');
        $data['stf_email_status'] = $this->input->post('stf_email_status');

        $reslt = $this->Approval_model->update_staff_approval_status($data);

        if ($reslt) {
            if ($data['approved'] == 1) {
                if ($data['stf_email_status'] == 0) {
                    $stf_id = $this->input->post('stf_id');
                    $email_reslt = $this->Approval_model->get_staff_email($stf_id);

                    $email = strtolower($email_reslt['stf_email']);
                    //                $res == 'valid'

                    $config = Array(
                        'protocol' => 'HTTP',
                        'smtp_host' => 'ssl://smtp.gmail.com',   //smtp.gmail.com
                        'smtp_port' => 465,
                        'auth' => true,
                        'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
                        'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );

                    $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">Staff Registered Successfully!</h2></div>';
                    $htmlContent .= '<p>' . $email_reslt['title_name'] . ' ' . $email_reslt['stf_fname'] . ',</p>';
                    $htmlContent .= '<h2>CONGRATULATIONS!</h2>';
                    $htmlContent .= '<p>You have successfully completed your online registration at SLIATE-SMS at Advanced Technological Institute - ' . $email_reslt['br_name'] . '. We warmly welcome you to the  SLIATE Family. Your staff profile has been created and the login information is as follows:</p>';
                    $htmlContent .= 'Link : <a href="http://student.sliate.ac.lk/">student.sliate.ac.lk</a><br/>';
                    $htmlContent .= 'User Name : ' . $email_reslt['staffindex'] . '<br/>';
                    $htmlContent .= 'Passoword : ' . $email_reslt['nic'];
                    $htmlContent .= '<br/><br/>We wish you all the best for your future endeavours.<br/>';
                    $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';
                    //                    $message = 'Dear ' +$email_reslt['first_name']+ '! <br/> You have registered successfully for “Course Name” in “Center Name”.';
                    $this->load->library('Email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('sms@sliate.ac.lk'); // change it to yours
                    $this->email->to($email);// change it to yours
                    $this->email->bcc('student.sliate.ac.lk@gmail.com');
                    $this->email->subject('Auto reply at staff registration !');
                    $this->email->message($htmlContent);

                    if (!$this->email->send()) {
                        $this->session->set_flashdata('flashSuccess', 'Staff Member Approved.<span style="color:red;"><b> Email Could Not Sent.</b></span>.');
                        $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Approved.Email not sent.', date("Y-m-d H:i:s", now()), $data);
                        //show_error($this->email->print_debugger());
                    } else {
                        $this->session->set_flashdata('flashSuccess', 'Staff Member Approved Successfully. Email Sent.');
                        $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Approved Successfully. Email Sent.', date("Y-m-d H:i:s", now()), $data);
                    }
                } else {
                    $this->session->set_flashdata('flashSuccess', 'Staff Member Approved Successfully.');
                    $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Approved Successfully.', date("Y-m-d H:i:s", now()), $data);
                }
            }
            if ($data['approved'] == 3) {
                $this->session->set_flashdata('flashSuccess', 'Staff Member Rejected Successfully.');
                $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Rejected Successfully.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        echo json_encode($reslt);
    }

    function exam_approvals()
    {
        $data['main_content'] = 'exam_approval_view';
        $data['title'] = 'EXAM APPROVALS';
        $this->load->view('includes/template', $data);
    }

    function load_course_list()
    {
        echo json_encode($this->Approval_model->load_course_list());
    }

    function load_batch_list()
    {
        echo json_encode($this->Approval_model->load_batch_list());
    }

    function search_students_lookup()
    {
        echo json_encode($this->Approval_model->search_students_lookup());
    }

    function change_student_mahapola_approval_status()
    {

        $data['student_id'] = $this->input->post('student_id');
        $data['approved'] = $this->input->post('approved');
        $data['reg_no'] = $this->input->post('reg_no');
        $data['nic'] = $this->input->post('nic');
        $data['branch'] = $this->input->post('branch');
        $data['email_sent_status'] = $this->input->post('email_sent_status');

        $this->Approval_model->change_student_mahapola_approval_status($data);


    }

    function load_mahapola_course_list()
    {
        echo json_encode($this->Approval_model->load_mahapola_course_list());
    }

    function search_mahapola_approve_students_lookup()
    {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['status'] = $this->input->post('status');
        $data['mahapola_year'] = $this->input->post('mahapola_year');

        echo json_encode($this->Approval_model->search_mahapola_approve_students_lookup($data));
    }

    function search_mahapola_director_approval_list()
    {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['mp_year'] = $this->input->post('mp_year');

        echo json_encode($this->Approval_model->search_mahapola_director_approval_list($data));
    }

    function search_staff_tobe_approve()
    {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['status'] = $this->input->post('status');

        echo json_encode($this->Approval_model->search_staff_tobe_approve($data));
    }

    function update_stu_apprv_sem_upgrade_status()
    {
        //post values
        $data['stu_id'] = $this->input->post('stu_id');
        $data['approved_status'] = $this->input->post('approved_status');
        $data['up_year'] = $this->input->post('up_year');
        $data['up_semester'] = $this->input->post('up_semester');
        $data['up_id'] = $this->input->post('up_id');


        echo json_encode($this->Approval_model->update_stu_apprv_sem_upgrade_status($data));
    }

    function bulk_approve_mahapola_students()
    {

        $data['approve_array'] = $this->input->post('approve_array');

        // var_dump($data);
        echo json_encode($this->Approval_model->bulk_approve_mahapola_students($data));
    }

    function request_approvals()
    {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students

           // $data['POSTPONE'] = $this->Approval_model->get_postpone();

            $data['lecture_ttbl'] = $this->Approval_model->get_exam_timetable();
            $data['lecture_ttbl_reject'] = $this->Approval_model->get_exam_timetable_reject();
            $data['centers'] = $this->Approval_model->get_all_centers();

        } else if ($ug_level == 2) { //
            //$data['POSTPONE'] = $this->Student_model->get_center_students();

        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Student_model->get_center_students();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['result_array'] = $this->Student_model->get_center_students();
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_student();
        }
        $data['main_content'] = 'request_approvals';
        $data['title'] = 'APPLY EXAM';


        $query = $this->Approval_model->get_postpone();
        $data['POSTPONE'] = array();
        if ($query) {
            $data['POSTPONE'] = $query;
        }
        $this->load->view('includes/template', $data);


    }

    function exam_mark_approvals($user_level)
    {


        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin

            $data['POSTPONE'] = $this->Approval_model->get_postpone();


        } else if ($ug_level == 2) { //
            $data['POSTPONE'] = $this->Student_model->get_center_students();

        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Student_model->get_center_students();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['result_array'] = $this->Student_model->get_center_students();
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            $data['result_array'] = $this->Student_model->get_student();
        }
        if (isset($user_level[0])) {
            $data['user_level'] = $user_level[0];
            $data['main_content'] = 'exam_mark_approval';
            $data['title'] = 'EXAM MARK APPROVALS';
            $this->load->view('includes/template', $data);
        } else {
            $message_403 = "You don't have access to the url you where trying to reach.";
            show_error($message_403, 403);
        }


    }

    //Postpone
    function update_approval_status()
    {
        $data['request_id'] = $this->input->post('request_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['status'] = $this->input->post('status');
        echo json_encode($this->Approval_model->update_approval_status($data));
    }
    
    function update_graduation_approval_status(){
        
        $data['request_id'] = $this->input->post('request_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['status'] = $this->input->post('status');
        
        echo json_encode($this->Approval_model->update_graduation_approval_status($data));
    }

    function update_examtime_status()
    {
        //post values
        $data['ttbl_id'] = $this->input->post('ttbl_id');
        $data['approved'] = $this->input->post('approved');
        echo json_encode($this->Approval_model->update_examtime_status($data));
    }

    function update_exam_status()
    {
        $result = array();


        $req_subjects = $this->input->post('req_subjects');
        $rej_subjects = $this->input->post('rej_subjects');
        $rejected_reason = $this->input->post('rejected_reason');

        $temp = 0;
        //$data=array();
        for ($req_sub = 0; $req_sub < sizeof($req_subjects); $req_sub++) {
            $data[$temp]['stu_id'] = $this->input->post('stu_id');
            $data[$temp]['semester_id'] = $this->input->post('semester_id');
            $data[$temp]['subject_id'] = $req_subjects[$req_sub];
            $data[$temp]['is_approved'] = 2;

            $temp++;
        }
        for ($rej_sub = 0; $rej_sub < sizeof($rej_subjects); $rej_sub++) {
            $data[$temp]['stu_id'] = $this->input->post('stu_id');
            $data[$temp]['semester_id'] = $this->input->post('semester_id');
            $data[$temp]['subject_id'] = $rej_subjects[$rej_sub];
            $data[$temp]['is_approved'] = 3;
            $data[$temp]['rejected_reason'] = $rejected_reason[$rej_sub];

            $temp++;
        }
        if(isset($data) && !empty($data)){
            echo json_encode(json_encode($this->Approval_model->update_exam_approval_level2($data)));
        }
    }

    function update_exam_approval_status()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_id'] = $this->input->post('semester_id');
        $data['is_approved'] = $this->input->post('is_approved');
        echo json_encode($this->Approval_model->update_exam_status($data));
    }

    function update_exam_rej_status()
    {
        //$data['id'] = $this->input->post('id');
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_id'] = $this->input->post('semester_id');
        $data['is_approved'] = $this->input->post('is_approved');
        $data['rejected_reason'] = $this->input->post('reject_reason');
        echo json_encode($this->Approval_model->update_exam_rej_status($data));
    }

    function load_student_approval_subjects()
    {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');


        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Approval_model->load_student_approval_subjects($data));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Approval_model->load_student_approval_subjects($data));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Approval_model->load_student_approval_subjects($data));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Approval_model->load_student_approval_subjects($data));
            //get access rights to that user
        }


    }
    
    
    function load_student_request_approval_subjects(){
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        
        echo json_encode($this->Approval_model->load_student_request_approval_subjects($data));
        
    }
    
    

    function approve_student_subject()
    {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['stu_id'] = $this->input->post('stu_id');
        $data['subj_group'] = $this->input->post('subj_group');
        $data['stu_subj_id'] = $this->input->post('stu_subj_id');


        if (isset($_POST['c_subject'])) {
            $data['core_subjects'] = $this->input->post('c_subject');
            $data['c_subject_version'] = $this->input->post('c_subject_version');
        }
        if (isset($_POST['e_subject'])) {
            $data['elective_subjects'] = $this->input->post('e_subject');
            $data['e_subject_version'] = $this->input->post('e_subject_version');

        }

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Approval_model->approve_student_subject($data));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Approval_model->approve_student_subject($data));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Approval_model->approve_student_subject($data));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Approval_model->approve_student_subject($data));
            //get access rights to that user
        }


    }

    function load_exam_list()
    {
        $data['year_no'] = $this->input->post('year_no');
        $data['sel_semester_id'] = $this->input->post('semester_no');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');

        echo json_encode($this->Approval_model->load_exam_list($data));
    }

    function search_students_lookup1()
    {
        $data['course_id'] = $this->input->post('course_id');
        //$data['batch_id']       = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        //$data['exam_id']        = $this->input->post('exam_id');

        echo json_encode($this->Approval_model->search_students_lookup1($data));
    }

    function mark_approve_status()
    {
        $data['stu_id'] = $this->input->post('student_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['total_mark'] = $this->input->post('total_mark');
        $data['overall_grade'] = $this->input->post('overall_grade');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['persentage'] = $this->input->post('persentage');
        $data['type_id'] = $this->input->post('type_id');
        $data['subject_mark'] = $this->input->post('subject_mark');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['status'] = $this->input->post('status');
        $data['page'] = $this->input->post('page');
        $data['gpa_value'] = $this->input->post('gpa_value');
       // $data['repeat_status'] = $this->input->post('repeat_status');
        $data['repeat_val'] = $this->input->post('repeat_status');
        
        if ($this->input->post('page') == "hod") {
            echo json_encode($this->Approval_model->mark_approve_status_hod($data));
        } else if ($this->input->post('page') == "dir") {
            echo json_encode($this->Approval_model->mark_approve_status_dir($data));
        } else if ($this->input->post('page') == "ex_dir") {
            echo json_encode($this->Approval_model->mark_approve_status_ex_dir($data));
        }

    }

    function update_exam_approval_status1()
    {
        $data['exam_id'] = $this->input->post('exam_id');
        $data['is_approved'] = $this->input->post('is_approved');
        echo json_encode($this->Approval_model->update_exam_approval_status1($data));
    }

    function load_year_list()
    {
        echo json_encode($this->Approval_model->load_year_list());
    }

    function load_semesters()
    {
        echo json_encode($this->Approval_model->load_semesters());
    }

    function load_semester_subjects()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Approval_model->load_semester_subjects($data, $batch_details));
    }
    
    
    
    function load_semester_subjects_deferement(){
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        echo json_encode($this->Approval_model->load_semester_subjects_deferement($data));
    }
   
    

    function load_student_who_absent_exam()
    {
//        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');


        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Approval_model->load_student_who_absent_exam($data, $batch_details));
    }
    
    
    
    function load_student_who_absent_exam_repeat(){
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');


        //$batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Approval_model->load_student_who_absent_exam_repeat($data));
        
    }

    function deferement_approval()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');


        echo json_encode($this->Approval_model->deferement_approval($data));
    }
    
    
    function deferement_approval_repeat(){
        
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');


        echo json_encode($this->Approval_model->deferement_approval_repeat($data));
        
    }
    
    

    function deferement_reject()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');


        echo json_encode($this->Approval_model->deferement_reject($data));
    }
    

    function deferement_reject_repeat()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');


        echo json_encode($this->Approval_model->deferement_reject_repeat($data));
    }

    function view_gpa_results()
    {
        $data['stu_id'] = $this->input->post('stu_id');

        echo json_encode($this->Approval_model->view_gpa_results($data));
    }

    function load_recorrection_students_to_approve()
    {
        echo json_encode($this->Approval_model->load_recorrection_students_to_approve());
    }

    function update_recorrection_status()
    {
        $data['student_id'] = $this->input->post('student_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['status'] = $this->input->post('status');
        $data['mark_id'] = $this->input->post('mark_id');
        echo json_encode($this->Approval_model->update_recorrection_status($data));
    }

    function load_recorrect_course_list()
    {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Approval_model->load_recorrect_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Approval_model->load_recorrect_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Approval_model->load_recorrect_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Approval_model->load_recorrect_course_list());
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.          
            echo json_encode($this->Approval_model->load_recorrect_course_student());
        }
    }

    function load_recorrect_batches()
    {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Approval_model->load_recorrect_batches($course_id));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Approval_model->load_recorrect_batches($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Approval_model->load_recorrect_batches($course_id));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Approval_model->load_recorrect_batches($course_id));
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->Approval_model->load_recorrect_batches_student($course_id, $this->session->userdata('user_ref_id')));

        }
    }

    function load_recorrect_exam()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->Approval_model->load_batch_details_by_id($data['batch_id']);

        echo json_encode($this->Approval_model->load_recorrect_exam($data, $batch_details));
    }

    function rpt_reject_student()
    {
       // $data['exam_id'] = $this->input->post('rpt_exam_apply');
       // $data['course_id'] = $this->input->post('rpt_exam_course');
       // $data['center_id'] = $this->input->post('rpt_exam_centre');
        $data['exam_id'] = $this->input->post('rpt_exam_apply');
        $data['course_id'] = $this->input->post('rpt_exam_course');
        $data['center_id'] = $this->input->post('rpt_exam_centre');
        $data['batch_id'] = $this->input->post('rpt_exam_batch');
        $data['year_id'] = $this->input->post('rpt_exam_no_year');
        $data['semester_id'] = $this->input->post('rpt_exam_no_semester');
        $data['apply_exam'] = $this->input->post(['apply_exam']);


        echo json_encode($this->Approval_model->rpt_reject_student($data));
    }
    
    
    function rpt_approve_student()
    {
        $data['exam_id'] = $this->input->post('rpt_exam_apply');
        $data['course_id'] = $this->input->post('rpt_exam_course');
        $data['center_id'] = $this->input->post('rpt_exam_centre');
        $data['batch_id'] = $this->input->post('rpt_exam_batch');
        $data['year_id'] = $this->input->post('rpt_exam_no_year');
        $data['semester_id'] = $this->input->post('rpt_exam_no_semester');
        $data['apply_exam'] = $this->input->post(['apply_exam']);


        echo json_encode($this->Approval_model->rpt_approve_student($data));
    }
    
    
    function get_exam_reject_reason()
    {
        $reject_reason = $this->Approval_model->get_exam_reject_reason();
        echo json_encode($reject_reason);
    }
    
    function bulk_dir_mark_approval() 
    {
        $data = array();
        $existDataFlag = false;
        $recorrectionFlag = false;
        $result = false;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $user_level = $this->input->post('user_level');
        // if($user_level=='lec')
        switch ($user_level) {
            case 'dir':
                $result_data = $this->Student_model->load_student_for_exam_marks_approval_dir_ca($data);
                break;
            case 'ex_dir':
                $result_data = $this->Student_model->load_student_for_exam_marks_approval_dir_se($data);
                break;

            default:
                $message_403 = "request failed!!!";
                show_error($message_403, 403);
                break;
        }
        
    if (isset($result_data) && !empty($result_data)) {
        foreach ($result_data as $stuData){
            if (isset($stuData['exam_mark']) && !empty($stuData['exam_mark'])) {
                foreach ($stuData['exam_mark'] as $markData){
                    
                    if($markData['is_recorrection_approved'] == 1){
                        $recorrectionFlag = true;
                    }
                    
                    $existDataFlag = true;
                    $result = $this->Approval_model->bulk_dir_mark_approval($markData['id'], $user_level,$stuData['stu_id'],$data,$recorrectionFlag);
                }
            }
        }
        
    }
    echo json_encode(array('result'=>$result,'dataFlag'=>$existDataFlag));
    }
    
    function bulk_rpt_dir_mark_approval() 
    {
        $data = array();
        $existDataFlag = false;
        $recorrectionFlag = false;
        $result = false;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $user_level = $this->input->post('user_level');
        switch ($user_level) {
            case 'dir':
                $result_data = $this->Student_model->load_rpt_student_for_exam_marks_approval_dir_ca($data);
                break;
            case 'ex_dir':
                $result_data = $this->Student_model->load_rpt_student_for_exam_marks_approval_dir_se($data);
                break;

            default:
                $message_403 = "request failed!!!";
                show_error($message_403, 403);
                break;
        }
        
    if (isset($result_data) && !empty($result_data)) {
        foreach ($result_data as $stuData){
            if (isset($stuData['exam_mark']) && !empty($stuData['exam_mark'])) {
                foreach ($stuData['exam_mark'] as $markData){
                    
                    if(($markData['is_recorrection_approved'] == 1) && ($markData['sem_exam_id'] == $data['exam_id'])){
                        $recorrectionFlag = true;
                    }
                    
                    $existDataFlag = true;
                    $result = $this->Approval_model->bulk_rpt_dir_mark_approval($markData['id'], $user_level,$stuData['stu_id'],$data,$recorrectionFlag);
                }
            }
        }
        
    }
    echo json_encode(array('result'=>$result,'dataFlag'=>$existDataFlag));
    }
    
    function cancel_postpone_status()
    {
        $data['request_id'] = $this->input->post('request_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['status'] = $this->input->post('status');
        echo json_encode($this->Approval_model->cancel_postpone_status($data));
    }
    
    function student_course_wise_details() {
        $data['type'] = $this->input->post('type_val');
        $data['post_center'] = $this->input->post('post_center');
        $data['post_course'] = $this->input->post('post_course');
        $data['post_batch'] = $this->input->post('post_batch');
            
        echo json_encode($this->Approval_model->get_postpone_graduation_student_data($data));
        
    }
    
    function exam_request_bulk_approval(){
        
        $result = false;
        $approve_stu_ids = Array();
        $approve_stu_ids = $this->input->post('approve_stu_ids');
        if(count($approve_stu_ids) > 0){
            $data['batch_id'] = $this->input->post('batch');
            $data['branch'] = $this->input->post('center');
            $data['course'] = $this->input->post('course');


            $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
            $access_level = $this->Util_model->check_access_level();
            $ug_level = $access_level[0]['ug_level'];
            $data['access_level'] = $ug_level;
            $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);

            $stu_data_all = $this->Student_model->approved_exam_students($data, $batch_details);
            foreach ($stu_data_all as $stu_data) {
                if (in_array($stu_data['stu_id'], $approve_stu_ids)) {
                    $temp_data['stu_id'] = $stu_data['stu_id'];
                    $temp_data['semester_exam_id'] = $stu_data['semester_exam_id'];
                    $result = $this->Approval_model->update_exam_status_bulk($temp_data);
                }
            }
            echo json_encode(array('result'=>$result));
        } 
    }
    
    function academic_exam_request_bulk_approval(){
        $result = false;
        $approve_stu_ids = Array();
        $approve_stu_ids = $this->input->post('approve_stu_ids');
        if(count($approve_stu_ids) > 0){
            $data['batch_id'] = $this->input->post('batch');
            $data['branch'] = $this->input->post('center');
            $data['course'] = $this->input->post('course');

            $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
            $access_level = $this->Util_model->check_access_level();
            $ug_level = $access_level[0]['ug_level'];
            $data['access_level'] = $ug_level;
            $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);

            $stu_data_all = $this->Student_model->applied_exam_students_approval($data, $batch_details);
            
            foreach ($stu_data_all as $stu_data) {
                $temp_data = Array();
                if (in_array($stu_data['stu_id'], $approve_stu_ids)) {
                    $index = 0;
                    for ($i = 0; $i < count($stu_data['selected_subjects']); $i++) {
                        $temp_data[$index]['stu_id'] = $stu_data['stu_id'];
                        $temp_data[$index]['semester_exam_id'] = $stu_data['semester_exam_id'];
                        $temp_data[$index]['subject_id'] = $stu_data['selected_subjects'][$i]['subject_id'];
                        $temp_data[$index]['is_approved'] = 2;
                        $index++;
                    }
                    $result = $this->Approval_model->academic_exam_request_bulk_approval($temp_data);
                }
            }
            
            echo json_encode(array('result'=>$result));
        }
    }
    
    
    function training_exam_mark_approval (){
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

//        if ($ug_level == 1) { //Admin
//            //get All students
//            $data['all_courses'] = $this->course_model->load_courses_complete();
//        } else if ($ug_level == 2) { //
//            $data['all_courses'] = $this->Subject_model->load_courses_complete_by_center();
//        } else if ($ug_level == 3) { // Registrar
//            //get the only Logged in user center Students details.
//            $data['all_courses'] = $this->Student_model->get_login_user_centers();
//        } else if ($ug_level == 4) { // Lecturer
//            //get the only Logged in user center Students details and send rights to the controls like buttons.
//            $data['all_courses'] = $this->Student_model->get_login_user_centers();
//            //get access rights to that user
//        } else // Student
//        {
//            //get only logged in user records. 
//            $data['all_courses'] = $this->Student_model->get_login_user_centers();
//        }
        
        $data['main_content'] = 'training_exam_mark_approval_view';
        $data['title'] = 'TRAINING EXAM MARK APPROVAL';
        $this->load->view('includes/template', $data);
    }
    
    
    function bulk_mark_approval_training() 
    {
        $data = array();
        $existDataFlag = false;
        $result = false;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        
        $result_data = $this->Student_model->load_student_for_exam_marks_training($data);
        
        if (isset($result_data) && !empty($result_data)) {
            foreach ($result_data as $stuData){
                if (isset($stuData['exam_mark']) && !empty($stuData['exam_mark'])) {
                    foreach ($stuData['exam_mark'] as $markData){
                        $existDataFlag = true;
                        $result = $this->Approval_model->bulk_mark_approval_training($markData['id'],$stuData['stu_id'],$data);
                    }
                }
            }

        }
        echo json_encode(array('result'=>$result,'dataFlag'=>$existDataFlag));
    }
    
    
    function rpt_bulk_mark_approval_training()
    {
        $data = array();
        $existDataFlag = false;
        $result = false;
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        
        $result_data = $this->Student_model->load_rpt_student_for_exam_marks_training($data);
        
        if (isset($result_data) && !empty($result_data)) {
            foreach ($result_data as $stuData){
                if (isset($stuData['exam_mark']) && !empty($stuData['exam_mark'])) {
                    foreach ($stuData['exam_mark'] as $markData){
                        $existDataFlag = true;
                        $result = $this->Approval_model->rpt_bulk_mark_approval_training($markData['id'],$stuData['stu_id'],$data);
                    }
                }
            }

        }
        echo json_encode(array('result'=>$result,'dataFlag'=>$existDataFlag));
    }

}


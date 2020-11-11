<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller
{

    public function subject()
    {
        parent::__construct();
        $this->load->model('Subject_model');
        $this->load->model('faculty_model');
        $this->load->model('course_model');
        $this->load->model('grading_model');
        $this->load->model('marking_model');
        $this->load->model('company_model');
        $this->load->model('batch_model');
        $this->load->model('Util_model');
        $this->load->model('Exam_model');

    }

    function subject_view()
    {
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['versions'] = $this->Subject_model->get_all_subject_version();
        $data['main_content'] = 'subject_view';
        $data['title'] = 'SUBJECT';
        $this->load->view('includes/template', $data);
    }

    function subject_groups()
    {
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['subject_group'] = $this->Subject_model->get_all_subject_groups();
        $data['main_content'] = 'subject_group_view';
        $data['title'] = 'SUBJECT GROUP';
        $this->load->view('includes/template', $data);
    }

    function semester_subjects()
    {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['all_courses'] = $this->course_model->load_courses_complete();
        } else if ($ug_level == 2) { //
            $data['all_courses'] = $this->Subject_model->load_courses_complete_by_center();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['all_courses'] = $this->Student_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['all_courses'] = $this->Student_model->get_login_user_centers();
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records. 
            $data['all_courses'] = $this->Student_model->get_login_user_centers();
        }


        //$data['all_courses'] = $this->course_model->load_courses_complete();
        $data['study_seasons'] = $this->company_model->get_all_study_seasons();
        $data['semester_subjects'] = $this->Subject_model->get_all_semester_subjects();
        $data['active_groups'] = $this->Subject_model->get_all_active_subject_groups();
        //$data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['main_content'] = 'semester_subjects_view';
        $data['title'] = 'SEMESTER SUBJECTS';
        $this->load->view('includes/template', $data);
    }

    function save_subject()
    {

        //post values
        $data['subject_id'] = $this->input->post('subject_id');
        $data['subject_code'] = $this->input->post('subject_code');
        $data['subject_name'] = $this->input->post('subject_name');
        $data['subject_box_id'] = $this->input->post('subject_name');
        $data['component_type_id'] = 1;//$this->input->post('component_type');
        $data['subject_type_id'] = $this->input->post('subject_type');
        $data['subject_credit'] = $this->input->post('subject_credit');
        $data['subject_version'] = $this->input->post('subject_version');
        $data['subject_old_version'] = $this->input->post('subject_old_version');
        
        if($this->input->post('chk_is_gpa_apply') == 'Yes')
            $data['is_gpa_apply'] = 1;
        else
            $data['is_gpa_apply'] = 0;
        
        //chk_is_training_apply
        if($this->input->post('chk_is_training_apply') == 'Yes')
            $data['is_training_apply'] = 1;
        else
            $data['is_training_apply'] = 0;
        
        if ($data['subject_old_version'] != $data['subject_version'])
            $data['update_subject_version'] = "1";
        else
            $data['update_subject_version'] = "0";
        //query
        $exists = $this->Subject_model->existing_subject_code($data['subject_code']);

        if (empty($data['subject_id'])) {
            //insert
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Subject Code Exists.Cannot insert record.');
                $this->logger->systemlog('Save Subject', 'Faliure', 'Subject Code Exists.Cannot insert record.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $result = $this->Subject_model->save_subject($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Subject saved successfully.');
                    $this->logger->systemlog('Save Subject', 'Faliure', 'Subject saved successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Subject. Retry.');
                    $this->logger->systemlog('Save Subject', 'Faliure', 'Failed to save Subject.', date("Y-m-d H:i:s", now()), $data);
                }
            }
        } else {
            //update
            if ($exists != NULL && $exists != $data['subject_id']) {
                $this->session->set_flashdata('flashError', 'Subject Code exists. Cannot update record.');
                $this->logger->systemlog('Update Subject', 'Faliure', 'Subject Code exists. Cannot update record.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $result = $this->Subject_model->save_subject($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Subject updated successfully.');
                    $this->logger->systemlog('Update Subject', 'Success', 'Subject updated successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update Subject. Retry.');
                    $this->logger->systemlog('Update Subject', 'Faliure', 'Failed to save Subject.', date("Y-m-d H:i:s", now()), $data);
                }
            }
        }
        redirect('subject/subject_view');
    }

    function change_subject_status()
    {
        //post values
        $data['subject_id'] = $this->input->post('subject_id');
        $data['new_status'] = $this->input->post('new_status');
        $data['subject_code'] = $this->input->post('subject_code');

        if ($data['new_status'] == "0") {
            //checking if subject code already exists or not
            $exists = $this->Subject_model->existing_subject_code($data['subject_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same Subject Code record exists. Cannot activate this record.');
                $this->logger->systemlog('Subject Status', 'Faliure', 'Same Subject Code record exists.', date("Y-m-d H:i:s", now()), $data);
            } else {
                echo json_encode($this->Subject_model->update_subject_status($data));
            }
        } else {
            echo json_encode($this->Subject_model->update_subject_status($data));
        }
    }

    function save_subject_group()
    {
        //post values
        $data['group_id'] = $this->input->post('group_id');
        $data['group_name'] = $this->input->post('group_name');

        $subject = $this->input->post('subject_code');

        $res = [];
        $i = 0;
        foreach ($subject as $sub) {

            if ($sub != null) {
                $subject_split = explode('-', $sub);

                $data['subject_code'][$i] = $subject_split[0];
                $data['subject_version'][$i] = $subject_split[1];
                $i++;
            }
        }


        //$data['subject_code'] = $this->input->post('subject_code');
        $data['subject_name'] = $this->input->post('subject_name');
        $data['subject_rowid'] = $this->input->post('subrowid');

        echo json_encode($this->Subject_model->save_subject_group($data));

    }

    function edit_group_load()
    {
        $group_id = $this->input->post('group_id');
        echo json_encode($this->Subject_model->edit_group_load($group_id));
    }

    function change_subject_group_status()
    {
        //post values
        $data['group_id'] = $this->input->post('group_id');
        $data['new_status'] = $this->input->post('new_status');
        $data['group_name'] = $this->input->post('group_name');

        if ($data['new_status'] == "0") {
            $exists = $this->Subject_model->existing_subject_group_name($data['group_name']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same group name record exists. Cannot activate this record.');
                $this->logger->systemlog('Subject Group Status', 'Faliure', 'Same group name record exists.', date("Y-m-d H:i:s", now()), $data);
            } else {
                echo json_encode($this->Subject_model->update_subject_group_status($data));
            }
        } else {
            echo json_encode($this->Subject_model->update_subject_group_status($data));
        }
    }

    function load_subject_credit()
    {
        //post values
        $subject_id = $this->input->post('subject_id');
        echo json_encode($this->Subject_model->load_subject_credit($subject_id));
    }

    function get_course()
    {
        echo json_encode($this->course_model->get_course());
    }

    function get_group_details()
    {
        $group_id = $this->input->post('group_id');
        $data['group_details'] = $this->Subject_model->get_group_details($group_id);
        $data['grading_methods'] = $this->grading_model->load_grading_methods();
        $data['marking_methods'] = $this->marking_model->load_marking_methods();
        $data['versions'] = $this->Subject_model->get_all_subject_version();
        echo json_encode($data);
    }

    function get_sem_subject_details()
    {
        //post values
        $sem_subject_id = $this->input->post('se_subject_id');
        $subject_group_id = $this->input->post('subject_group_id');
        //queries
//      $data['group_details'] = $this->Subject_model->get_group_details($subject_group_id);
        $data['versions'] = $this->Subject_model->get_all_subject_version();
        $data['sem_subject_details'] = $this->Subject_model->get_sem_subject_details($sem_subject_id);
        $data['grading_methods'] = $this->grading_model->load_grading_methods();
        $data['marking_methods'] = $this->marking_model->load_marking_methods();

        echo json_encode($data);
    }

    function save_semester_subjects()
    {
        //post values
        $data['se_subject_id'] = $this->input->post('se_subject_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('no_year');
        $data['semester_no'] = $this->input->post('no_semester');
        $data['batch_code'] = $this->input->post('batch_code');
        $data['s_season'] = $this->input->post('s_season');
        $data['group_id'] = $this->input->post('subject_group');

        $data['new_credits'] = $this->input->post('c_credit');
        $data['g_method'] = $this->input->post('g_method');
        $data['m_method'] = $this->input->post('m_method');
        $data['v_method'] = $this->input->post('v_method');

        $exists = $this->Subject_model->is_exist_semester_subjects($data);
        if (empty($data['se_subject_id'])) {
            //insert
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Record Exists. Please check in Lookup view.');
                $this->logger->systemlog('Save Semester Subjects', 'Faliure', 'Record Exists.', date("Y-m-d H:i:s", now()), $data);
                
            } else {
                $result = $this->Subject_model->save_semester_subject($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Year subjects saved successfully.');
                    $this->logger->systemlog('Save Semester Subjects', 'Success', 'Year subjects saved successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save year subjects. Retry.');
                    $this->logger->systemlog('Save Semester Subjects', 'Faliure', 'Failed to save year subjects.', date("Y-m-d H:i:s", now()), $data);
                }
            }
        } else {
            //update
            $result = $this->Subject_model->save_semester_subject($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Year subjects updated successfully.');
                $this->logger->systemlog('Update Semester Subjects', 'Success', 'Year subjects updated successfully.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update year subjects. Retry.');
                $this->logger->systemlog('Update Semester Subjects', 'Faliure', 'Failed to update year subjects.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        redirect('subject/semester_subjects');
    }

    function edit_semester_subject()
    {
        $se_subject_id = $this->input->post('se_subject_id');
        echo json_encode($this->Subject_model->edit_semester_subjects($se_subject_id));
    }

    function update_year_subject_status()
    {
        //post values
        $data['faculty_id'] = $this->input->post('faculty');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('no_year');
        $data['semester_no'] = $this->input->post('no_semester');
        $data['se_subject_id'] = $this->input->post('se_subject_id');
        $data['new_status'] = $this->input->post('new_status');

        if ($data['new_status'] == "0") {
            $exists = $this->Subject_model->is_exist_semester_subjects($data);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Record Exists. Cannot Activate Record.');
                $this->logger->systemlog('Update Year Subject Status', 'Faliure', 'Record Exists.', date("Y-m-d H:i:s", now()), $data);
            } else {
                echo json_encode($this->Subject_model->update_year_subject_status($data));
            }
        } else {
            echo json_encode($this->Subject_model->update_year_subject_status($data));
        }
    }

    function load_semesters()
    {
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Subject_model->load_semesters($course_id, $year_no));

        } else if ($ug_level == 2) { //
            echo json_encode($this->Subject_model->load_semesters($course_id, $year_no));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Subject_model->load_semesters($course_id, $year_no));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Subject_model->load_semesters($course_id, $year_no));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->Subject_model->load_semesters_student($course_id, $year_no, $this->session->userdata('user_ref_id')));
        }


    }

    function load_semester_subjects()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Subject_model->load_semester_subjects($data, $batch_details));
    }

    function semester_subjects_by_semester()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        echo json_encode($this->Subject_model->semester_subjects_by_semester($data));
    }
    
    
    function load_rpt_semester_subjects_by_semester()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        echo json_encode($this->Subject_model->load_rpt_semester_subjects_by_semester($data));
    }

    function check_duplicate_semester_subjects()
    {
        $data['course'] = $this->input->post('course');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['s_season'] = $this->input->post('s_season');
        $data['batch_code'] = $this->input->post('batch_code');

        echo json_encode($this->Subject_model->check_duplicate_semester_subjects($data));
    }

//    function check_duplicate_marking_codes(){
//        $data['marking_code'] = $this->input->post('marking_code');
//        
//        echo json_encode($this->marking_model->check_duplicate_marking_codes($data));
//    }

    function check_duplicate_grading_codes()
    {
        $data['grading_code'] = $this->input->post('grading_code');

        echo json_encode($this->grading_model->check_duplicate_grading_codes($data));
    }

    function check_duplicate_subject_group()
    {
        $data['subject_group'] = $this->input->post('subject_group');

        echo json_encode($this->Subject_model->existing_subject_group_name($data['subject_group']));
    }

    function load_edit_student_subjects()
    {

        echo json_encode($this->Subject_model->load_edit_student_subjects());
    }
    
    function load_semesters_for_repeat_stu()
    {
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Subject_model->load_semesters_for_repeat($course_id, $year_no));

        } else if ($ug_level == 2) { //
            echo json_encode($this->Subject_model->load_semesters_for_repeat($course_id, $year_no));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Subject_model->load_semesters_for_repeat($course_id, $year_no));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Subject_model->load_semesters_for_repeat($course_id, $year_no));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->Subject_model->load_semesters_for_repeat_student($course_id, $year_no, $this->session->userdata('user_ref_id')));
        }


    }
    
    function load_semesters_for_repeat_stu_mark_report()
    {
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');
        $year_id = $this->input->post('year_id');
            
        echo json_encode($this->Subject_model->load_semesters_for_repeat_mark($course_id, $year_no, $year_id));
    }
    
    
    
//    
//    function dummy_save_exam_marks(){
//        $get_remarks =  $this->get_remarks_table();
//        echo '<pre>';
//        print_r($get_remarks);
//        echo '</pre>';
//        die();
//        $data['center_id'] = $this->input->post('upload_centre');
//        $data['course_id'] = $this->input->post('upload_course');
//        $data['year_id'] = $this->input->post('upload_year');
//        $data['semester_id'] = $this->input->post('upload_semester');
//        $data['batch_id'] = $this->input->post('upload_batch');
//        $data['exam_id'] = $this->input->post('upload_exam');
//        
//        
//        $insert_exm_mark_array = array(
//            array( 
//                'student_id' => 111,
//                'course_id' => 7,
//                'year_no' => 1,
//                'semester_no' => 1,
//                'batch_id' => 8,
//                'sem_exam_id' => 4,
//                'subject_id' => 31,
//                'mark' => 40,
//                'exam_type_id' => 1,
//                'deferement' => 'AB',
//                /* 'overall_grade' => $data['overall_grade'], */
//                /* 'grade_point' => $data['grade_point'], */
//                /* 'subject_credit' => $data['subject_point'], */
//                /* 'result' => $data['result_grade'], */
//                'is_repeat_approve' => 0,
//                'is_repeat_mark' => 0,
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                
//                //'student_id' => 11111,
//                //'course_id' => 22,
//                //'year_no' => 1,
//                //'semester_no' => 2,
//                //'batch_id' => 23,
//                //'sem_exam_id' => 32,
//                //'subject_id' => 182,
//                //'exam_type_id' => 'CA',
//                //'mark' => 40,
//            ),
//            array(
//                'student_id' => 111,
//                'course_id' => 7,
//                'year_no' => 1,
//                'semester_no' => 1,
//                'batch_id' => 8,
//                'sem_exam_id' => 4,
//                'subject_id' => 31,
//                'mark' => 20,
//                'exam_type_id' => 2,
//                'deferement' => 2,
//                /* 'overall_grade' => $data['overall_grade'], */
//                /* 'grade_point' => $data['grade_point'], */
//                /* 'subject_credit' => $data['subject_point'], */
//                /* 'result' => $data['result_grade'], */
//                'is_repeat_approve' => 0,
//                'is_repeat_mark' => 0,
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                
//                
//                //'student_id' => 11111,
//                //'course_id' => 22,
//                //'year_no' => 1,
//                //'semester_no' => 2,
//                //'batch_id' => 23,
//                //'sem_exam_id' => 32,
//                //'subject_id' => 182,
//                //'exam_type_id' => 'SE',
//                //'mark' => 30,
//            ),
//            array( 
//                'student_id' => 222,
//                'course_id' => 7,
//                'year_no' => 1,
//                'semester_no' => 1,
//                'batch_id' => 8,
//                'sem_exam_id' => 4,
//                'subject_id' => 31,
//                'mark' => 50,
//                'exam_type_id' => 1,
//                'deferement' => 3,
//                /* 'overall_grade' => $data['overall_grade'], */
//                /* 'grade_point' => $data['grade_point'], */
//                /* 'subject_credit' => $data['subject_point'], */
//                /* 'result' => $data['result_grade'], */
//                'is_repeat_approve' => 0,
//                'is_repeat_mark' => 0,
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                //'student_id' => 22222,
//                //'course_id' => 22,
//                //'year_no' => 1,
//                //'semester_no' => 2,
//                //'batch_id' => 23,
//                //'sem_exam_id' => 32,
//                //'subject_id' => 182,
//                //'exam_type_id' => 'CA',
//                //'mark' => 66,
//            ),
//            array(
//                'student_id' => 222,
//                'course_id' => 7,
//                'year_no' => 1,
//                'semester_no' => 1,
//                'batch_id' => 8,
//                'sem_exam_id' => 4,
//                'subject_id' => 31,
//                'mark' => 30,
//                'exam_type_id' => 2,
//                'deferement' => 4,
//                /* 'overall_grade' => $data['overall_grade'], */
//                /* 'grade_point' => $data['grade_point'], */
//                /* 'subject_credit' => $data['subject_point'], */
//                /* 'result' => $data['result_grade'], */
//                'is_repeat_approve' => 0,
//                'is_repeat_mark' => 0,
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                
//                
//                
//                //'student_id' => 22222,
//                //'course_id' => 22,
//                //'year_no' => 1,
//                //'semester_no' => 2,
//                //'batch_id' => 23,
//                //'sem_exam_id' => 32,
//                //'subject_id' => 182,
//                //'exam_type_id' => 'SE',
//                //'mark' => 22,
//            ),
//        );
//        
//        
//        foreach($insert_exm_mark_array as $row){
//            $check_id_exist = $this->check_id_exist_table($row);
//            
//            
//            $get_percentage = $this->get_percentage_table($row);
//            //$get_grade      = $this->get_grade_table($row);
//            
//            
////            if($row['deferement'] == 'AB' && $row['exam_type_id'] == 1){
////                $row['mark'] = 0;
////            }else if($row['deferement'] == 'AB' && $row['exam_type_id'] == 2){
////                $row['mark'] = 0;
////            }
//            
//            
//            $insert_student_marks = array(
//                'student_id' => $row['student_id'],
//                'course_id' => $row['course_id'],
//                'year_no' => $row['year_no'],
//                'semester_no' => $row['semester_no'],
//                'batch_id' => $row['batch_id'],
//                'sem_exam_id' => $row['sem_exam_id'],
//                'subject_id' => $row['subject_id'],
//                'total_marks' => $row['mark']*($get_percentage/100),
//                /* 'overall_grade' => $data['overall_grade'], */
//                /* 'grade_point' => $data['grade_point'], */
//                /* 'subject_credit' => $data['subject_point'], */
//                /* 'result' => $data['result_grade'], */
//                'is_repeat_approve' => 0,
//                'is_repeat_mark' => 0,
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                
//                
//                //'student_id' => $row['student_id'],
//                //'subject_id' => $row['subject_id'],
//                //'total_marks' => $row['mark'],
//            );
//            
//            if($check_id_exist == NULL){
//                $this->db->insert('zz_tot_marks', $insert_student_marks);
//            }else{
//                $check_id_update_totmarks = $this->check_id_update_totmarks_table($row);
//                
//                if($check_id_update_totmarks !== NULL){
//                    $this->db->set('total_marks', $check_id_update_totmarks + ($row['mark'] *($get_percentage/100)));
//                    $this->db->where('student_id', $row['student_id']);
//                    $this->db->update('zz_tot_marks');
//                }
//                
//            }
//            $max_exam_mark_id = $this->get_max_exam_mark_id_table($row);
//            
//            //$get_percentage = $this->get_percentage_table($row);
//            
//            
////            $this->db->set('total_marks', ($get_percentage/100) * $row['mark']);
////            $this->db->where('student_id', $row['student_id']);
////            $this->db->where('course_id', $row['course_id']);
////            $this->db->where('year_no', $row['year_no']);
////            $this->db->where('semester_no', $row['semester_no']);
////            $this->db->where('batch_id', $row['batch_id']);
////            $this->db->where('sem_exam_id', $row['sem_exam_id']);
////            $this->db->where('subject_id', $row['subject_id']);
////            $this->db->update('zz_tot_marks');
//            
//            
//            $insert_student_marks_details = array(
//                'exam_mark_id' => $max_exam_mark_id,
//                'exam_type_id' => $row['exam_type_id'],
//                'persentage' => $get_percentage,
//                'mark' => $row['mark'],
//                'added_by' => $this->session->userdata('u_id'),
//                'added_on' => date("Y-m-d h:i:s", now())
//                
//                //'zz_mark_id' => $max_exam_mark_id,
//                //'exam_type' => $row['exam_type_id'],
//                //'exam_mark' => $row['mark'],
//            );
//            $this->db->insert('zz_mark_details', $insert_student_marks_details);
//            
//            
//            
//            
//            //echo '<pre>';
//            //var_dump($row['student_id']);
//            //echo '</pre>';
//        }
//        
//        foreach($insert_exm_mark_array as $mark){
//            
//            $get_tot_mark = $this->get_tot_mark($mark);
//            $get_grade =  $this->get_grade_table($mark,$get_tot_mark);
//            $get_point =  $this->get_point_table($mark,$get_tot_mark);
//            $get_credits =  $this->get_credits_table($mark,$get_tot_mark,$max_exam_mark_id);
//            //$get_remarks =  $this->get_remarks_table($mark,$get_tot_mark);
//            
//            
//            $this->db->set('overall_grade', $get_grade);
//            $this->db->set('grade_point', $get_point);
//            $this->db->set('subject_credit', $get_credits['cre']);
//            $this->db->where('student_id', $mark['student_id']);
//            $this->db->where('subject_id', $mark['subject_id']);
//            $this->db->update('zz_tot_marks');
//            
//            $max_exam_mark_id = $this->get_max_exam_mark_id_table($mark);
//            $get_remarks =  $this->get_remarks_table($mark,$max_exam_mark_id);
//            
//            
//            
////            if($mark['deferement'] == "AB" || $mark['deferement'] == "AB"){
////                $get_remarks =  $this->get_remarks_table($mark,$max_exam_mark_id);
////                $this->db->set('result', $get_remarks);
////                $this->db->where('student_id', $mark['student_id']);
////                $this->db->where('subject_id', $mark['subject_id']);
////                $this->db->update('zz_tot_marks');
////            }else{
////                $this->db->set('result', $get_grade);
////                $this->db->where('student_id', $mark['student_id']);
////                $this->db->where('subject_id', $mark['subject_id']);
////                $this->db->update('zz_tot_marks');
////            }
//            
//        }
//        //print_r($insert_exm_mark_array);
//        
//        //$data = array(
//        //    'username' => $this->input->post('name'),
//        //    'pwd'=>$this->input->post('email')
//        //);
//        
//        //echo json_encode($this->Subject_model->dummy_save_exam_marks($data));
//    }
//    
    
    function check_id_exist_table($row){
        $this->db->select('*');
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('course_id', $row['course_id']);
        $this->db->where('year_no', $row['year_no']);
        $this->db->where('semester_no', $row['semester_no']);
        //$this->db->where('batch_id', $batch);
        $this->db->where('subject_id', $row['subject_id']);
        $this->db->where('deleted', 0);
        
        $result_array = $this->db->get('zz_tot_marks')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['id'];
            //}
        } else {
            return NULL;
        }
    }
    
    function check_id_update_totmarks_table($row){
        $this->db->select('*');
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('course_id', $row['course_id']);
        $this->db->where('year_no', $row['year_no']);
        $this->db->where('semester_no', $row['semester_no']);
        //$this->db->where('batch_id', $batch);
        $this->db->where('subject_id', $row['subject_id']);
        $this->db->where('deleted', 0);
        
        $result_array = $this->db->get('zz_tot_marks')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['total_marks'];
            //}
        } else {
            return NULL;
        }
    }
    
    function get_max_exam_mark_id_table($row){
        $this->db->select('max(id)');
        $this->db->from('zz_tot_marks');
        $result = $this->db->get()->result_array();
        foreach ($result as $row) {
            return $row['max(id)'];
        }
    }
    
    function get_percentage_table($row){
        $this->db->select('*');
        $this->db->join('mod_marking_method mmm', 'mmm.id = mmd.marking_method_id');
        $this->db->join('mod_marking_types mmt', 'mmt.id = mmd.type_id');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.marking_method_id = mmm.id');
        $this->db->join('mod_semester_subject mss', 'mss.id = mssd.semester_subject_id');
        
        
        
        $this->db->where('mss.semester_no', $row['semester_no']);
        $this->db->where('mss.batch_id', $row['batch_id']);
        $this->db->where('mssd.subject_id', $row['subject_id']);
        $this->db->where('mmd.type_id', $row['exam_type_id']);
        //$this->db->where('deleted', 0);
        
        $result_array = $this->db->get('mod_marking_details mmd')->row_array();
        
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['percentage'];
            //}
        } else {
            return NULL;
        }
    }
    
    function get_grade_table($mark, $get_tot_mark){
        
        $this->db->select('mgd.grade_mark as gg, mgd.grade as grade, mgd.grade_rate as point');
        $this->db->join('mod_grading_method mgm', 'mgm.id = mgd.grading_method_id');
        $this->db->join('mod_grading_criteria mgc', 'mgc.id = mgd.grade_group');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.grading_method_id = mgm.id');
        $this->db->join('zz_tot_marks em', 'em.subject_id = mssd.subject_id');
        $this->db->join('mod_subject ms', 'ms.id = mssd.subject_id');
        
        $this->db->where('mgm.deleted', 0);
        $this->db->where('mgd.deleted', 0);
        $this->db->where('mssd.deleted', 0);
        $this->db->where('em.deleted', 0);
        
        $this->db->where('em.student_id', $mark['student_id']);
        $this->db->where('em.subject_id', $mark['subject_id']);
        $result_array = $this->db->get('mod_grading_details mgd')->result_array();
        
        //sort($result_array);
        
        for($i = 0; $i < count($result_array); $i++) {
            if ( $get_tot_mark >= $result_array[$i]['gg']){
                return $result_array[$i]['grade'];
            }
            
            
//            echo '<pre>';
//            print_r($result_array);
//            echo '</pre>';
        }
        
        
        
//        foreach($result_array as $result) {
//            echo '<pre>';
//            print_r($result);
//            echo '</pre>';
//        }
        
        
        
//        $this->db->select('*');
//        $this->db->join('mod_grading_method mgm', 'mgm.id = mgd.grading_method_id');
//        $this->db->join('mod_grading_criteria mgc', 'mgc.id = mgd.grade_group');
//        $this->db->join('mod_semester_subject_details mssd', 'mssd.grading_method_id = mgm.id');
//        $this->db->join('exm_mark em', 'em.subject_id = mssd.subject_id');
//        
//        
//        //$this->db->where('mgm.deleted', 0);
//        $this->db->where('mgm.deleted', 0);
//        //$this->db->where('mgc.deleted', 0);
//        $this->db->where('mgd.deleted', 0);
//        $this->db->where('mssd.deleted', 0);
//        $this->db->where('mssd.subject_id', 18);
//        $this->db->where('em.subject_id', 18);
//        $this->db->where('em.student_id', 4390);
//        
//
//
//        
//        $result_array = $this->db->get('mod_grading_details mgd')->result_array();
//        
//        echo '<pre>';
//            var_dump($result_array);
//        echo '</pre>';
        //print_r($result_array);
        
//        foreach ($result_array as $result){
//            echo '<pre>';
//            var_dump($result);
//        echo '</pre>';
//            
//        }
        
        
        
        /*
        $this->db->select('*');
        $this->db->join('mod_marking_method mmm', 'mmm.id = mmd.marking_method_id');
        $this->db->join('mod_marking_types mmt', 'mmt.id = mmd.type_id');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.marking_method_id = mmm.id');
        $this->db->join('mod_semester_subject mss', 'mss.id = mssd.semester_subject_id');
        
        $this->db->where('mss.semester_no', 1);
        $this->db->where('mss.batch_id', 8);
        $this->db->where('mssd.subject_id', 31);
        //$this->db->where('mmd.type_id', $row['exam_type_id']);
        //$this->db->where('deleted', 0);
        
        $result_array = $this->db->get('mod_marking_details mmd')->row_array();
        
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['percentage'];
            //}
        } else {
            return NULL;
        }
        */
        /*
        $this->db->select('*');
        $this->db->join('mod_grading_method mgm', 'mgm.id = mgd.grading_method_id');
        $this->db->join('mod_grading_criteria mgc', 'mgc.id = mgd.grading_group');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.grading_method_id = mgm.id');
        $this->db->join('mod_marking_method mssd', 'mssd.grading_method_id = mgm.id');
        
        
        $this->db->join('mod_marking_method mmm', 'mmm.id = mmd.marking_method_id');
        $this->db->join('mod_marking_types mmt', 'mmt.id = mmd.type_id');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.marking_method_id = mmm.id');
        $this->db->join('mod_semester_subject mss', 'mss.id = mssd.semester_subject_id');
        
        $this->db->join('mod_grading_method mgm', 'mgm.id = mssd.grading_method_id');
        $this->db->join('mod_grading_details mgd', 'mgd.grading_method_id = mgm.id');
        $this->db->join('mod_grading_criteria mgc', 'mgc.id = mgd.grade_group');
        
        
        
        $this->db->where('mss.semester_no', 1);
        $this->db->where('mss.batch_id', 8);
        $this->db->where('mssd.subject_id', 31);
        //$this->db->where('mmd.type_id', $row['exam_type_id']);
        //$this->db->where('deleted', 0);
        
        $result_array = $this->db->get('mod_grading_details mgd')->row_array();
        
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['grade'];
            //}
        } else {
            return NULL;
        }
        //$result_array = $this->db->get('mod_marking_details mmd')->row_array();
        //$result_array = $this->db->get('mod_grading_details gd')->result_array();
        */
    }
    
    function get_tot_mark($mark){
        $this->db->select('*');
        $this->db->where('student_id', $mark['student_id']);
        $this->db->where('course_id', $mark['course_id']);
        $this->db->where('year_no', $mark['year_no']);
        $this->db->where('semester_no', $mark['semester_no']);
        //$this->db->where('batch_id', $batch);
        $this->db->where('subject_id', $mark['subject_id']);
        $this->db->where('deleted', 0);
        
        $result_array = $this->db->get('zz_tot_marks')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['total_marks'];
            //}
        } else {
            return NULL;
        }
    }
    
    function get_point_table($mark, $get_tot_mark){
        $this->db->select('mgd.grade_mark as gg, mgd.grade as grade, mgd.grade_rate as point');
        $this->db->join('mod_grading_method mgm', 'mgm.id = mgd.grading_method_id');
        $this->db->join('mod_grading_criteria mgc', 'mgc.id = mgd.grade_group');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.grading_method_id = mgm.id');
        $this->db->join('zz_tot_marks em', 'em.subject_id = mssd.subject_id');
        
        $this->db->where('mgm.deleted', 0);
        $this->db->where('mgd.deleted', 0);
        $this->db->where('mssd.deleted', 0);
        $this->db->where('em.deleted', 0);
        
        $this->db->where('em.student_id', $mark['student_id']);
        $this->db->where('em.subject_id', $mark['subject_id']);
        $result_array = $this->db->get('mod_grading_details mgd')->result_array();
        
        //sort($result_array);
        
        for($i = 0; $i < count($result_array); $i++) {
            if ( $get_tot_mark >= $result_array[$i]['gg']){
                return $result_array[$i]['point'];
            }
            
            
//            echo '<pre>';
//            print_r($result_array);
//            echo '</pre>';
        }
    }
    
    function get_credits_table($mark){
        $this->db->select('ms.credits as cre');
        $this->db->join('mod_subject ms', 'ms.id = ztm.subject_id');
//        
        $this->db->where('ztm.student_id',$mark['student_id']);
        $this->db->where('ztm.course_id',$mark['course_id']);
        $this->db->where('ztm.year_no',$mark['year_no']);
        $this->db->where('ztm.semester_no',$mark['semester_no']);
        $this->db->where('ztm.sem_exam_id',$mark['sem_exam_id']);
//        //$this->db->where('batch_id', $batch);
        $this->db->where('ztm.subject_id',$mark['subject_id']);
        //$this->db->where('deleted', 0);
        
        $result_array = $this->db->get('zz_tot_marks ztm')->row_array();
        
        //sort($result_array);
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array;
            //}
        } else {
            return NULL;
        }
        
        
        
    }
    
    //$mark,$get_tot_mark,$max_exam_mark_id
    function get_remarks_table(){
        $this->db->select('*');
        $this->db->where('exam_mark_id', 106);
        //$this->db->where('student_id', $mark['student_id']);
        //$this->db->where('course_id', $mark['course_id']);
        //$this->db->where('year_no', $mark['year_no']);
        //$this->db->where('semester_no', $mark['semester_no']);
        ////$this->db->where('batch_id', $batch);
        //$this->db->where('subject_id', $mark['subject_id']);
        //$this->db->where('exam_type_id', $mark['exam_type_id']);
        //$this->db->where('deleted', 0);
        
        $result_array = $this->db->get('zz_mark_details zmd')->result_array();
        
        for($i = 0; $i < count($result_array); $i++){
            $remark_desc = $result_array[$i]['mark'];
            if($result_array[$i]['exam_type_id'] == 1 && $result_array[$i]['mark'] == 0){
                $remark_desc = 'AB';
            }else if($result_array[$i]['exam_type_id'] == 1 && $result_array[$i]['mark'] == NULL){
                $remark_desc = 'DFR';
            }else if($result_array[$i]['exam_type_id'] == 2 && $result_array[$i]['mark'] == 0){
                $remark_desc = 'AB';
            }else if($result_array[$i]['exam_type_id'] == 2 && $result_array[$i]['mark'] == NULL){
                $remark_desc = 'DFR';
            }
        }
        
        echo '<pre>';
        print_r($result_array);
        echo '<pre>';
        //print_r($remark_desc);
//        foreach($result_array as $result){
//            $remark_desc = $result['exam_type_id'];
//            return $remark_desc;
//        }
        
        //return $result_array;
        
        
//        for($i = 0; $i < count($result_array); $i++){
//            return $result_array;
//            
////            if($result_array[$i]['exam_type_id'] == 1 && $result_array[$i]['mark'] == 0){
////                $remark_desc = 'AB';
////            }else if($result_array[$i]['exam_type_id'] == 1 && $result_array[$i]['mark'] == NULL){
////                $remark_desc = 'DFR';
////            }else if($result_array[$i]['exam_type_id'] == 2 && $result_array[$i]['mark'] == 0){
////                $remark_desc = 'AB';
////            }else if($result_array[$i]['exam_type_id'] == 2 && $result_array[$i]['mark'] == NULL){
////                $remark_desc = 'DFR';
////            }
//        }
        
        //return $remark_desc;
//        if (!empty($result_array)) {
//            //foreach ($result_array as $row) {
//                return $result_array['total_marks'];
//            //}
//        } else {
//            return NULL;
//        }
    }
    
    
    
    
    
    
    function dummy_save_exam_marks(){
        $data['center_id'] = $this->input->post('upload_centre');
        $data['course_id'] = $this->input->post('upload_course');
        $data['year_id'] = $this->input->post('upload_year');
        $data['semester_id'] = $this->input->post('upload_semester');
        $data['batch_id'] = $this->input->post('upload_batch');
        $data['exam_id'] = $this->input->post('upload_exam');
        
        
        $insert_exm_mark_array = array(
            array( 
                'student_id' => 111,
                'course_id' => 7,
                'year_no' => 1,
                'semester_no' => 1,
                'batch_id' => 8,
                'sem_exam_id' => 4,
                'subject_id' => 31,
                'mark' => 40,
                'exam_type_id' => 1,
                'deferement' => 'AB',
                /* 'overall_grade' => $data['overall_grade'], */
                /* 'grade_point' => $data['grade_point'], */
                /* 'subject_credit' => $data['subject_point'], */
                /* 'result' => $data['result_grade'], */
                'is_repeat_approve' => 0,
                'is_repeat_mark' => 0,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
                
                //'student_id' => 11111,
                //'course_id' => 22,
                //'year_no' => 1,
                //'semester_no' => 2,
                //'batch_id' => 23,
                //'sem_exam_id' => 32,
                //'subject_id' => 182,
                //'exam_type_id' => 'CA',
                //'mark' => 40,
            ),
            array(
                'student_id' => 111,
                'course_id' => 7,
                'year_no' => 1,
                'semester_no' => 1,
                'batch_id' => 8,
                'sem_exam_id' => 4,
                'subject_id' => 31,
                'mark' => 20,
                'exam_type_id' => 2,
                'deferement' => 2,
                /* 'overall_grade' => $data['overall_grade'], */
                /* 'grade_point' => $data['grade_point'], */
                /* 'subject_credit' => $data['subject_point'], */
                /* 'result' => $data['result_grade'], */
                'is_repeat_approve' => 0,
                'is_repeat_mark' => 0,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
                
                
                //'student_id' => 11111,
                //'course_id' => 22,
                //'year_no' => 1,
                //'semester_no' => 2,
                //'batch_id' => 23,
                //'sem_exam_id' => 32,
                //'subject_id' => 182,
                //'exam_type_id' => 'SE',
                //'mark' => 30,
            ),
            array( 
                'student_id' => 222,
                'course_id' => 7,
                'year_no' => 1,
                'semester_no' => 1,
                'batch_id' => 8,
                'sem_exam_id' => 4,
                'subject_id' => 31,
                'mark' => 50,
                'exam_type_id' => 1,
                'deferement' => 3,
                /* 'overall_grade' => $data['overall_grade'], */
                /* 'grade_point' => $data['grade_point'], */
                /* 'subject_credit' => $data['subject_point'], */
                /* 'result' => $data['result_grade'], */
                'is_repeat_approve' => 0,
                'is_repeat_mark' => 0,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
                //'student_id' => 22222,
                //'course_id' => 22,
                //'year_no' => 1,
                //'semester_no' => 2,
                //'batch_id' => 23,
                //'sem_exam_id' => 32,
                //'subject_id' => 182,
                //'exam_type_id' => 'CA',
                //'mark' => 66,
            ),
            array(
                'student_id' => 222,
                'course_id' => 7,
                'year_no' => 1,
                'semester_no' => 1,
                'batch_id' => 8,
                'sem_exam_id' => 4,
                'subject_id' => 31,
                'mark' => 30,
                'exam_type_id' => 2,
                'deferement' => 4,
                /* 'overall_grade' => $data['overall_grade'], */
                /* 'grade_point' => $data['grade_point'], */
                /* 'subject_credit' => $data['subject_point'], */
                /* 'result' => $data['result_grade'], */
                'is_repeat_approve' => 0,
                'is_repeat_mark' => 0,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
                
                
                
                //'student_id' => 22222,
                //'course_id' => 22,
                //'year_no' => 1,
                //'semester_no' => 2,
                //'batch_id' => 23,
                //'sem_exam_id' => 32,
                //'subject_id' => 182,
                //'exam_type_id' => 'SE',
                //'mark' => 22,
            ),
        );
        
        
        foreach($insert_exm_mark_array as $row){
            $flag = null;
            $ca_mark = null;
            $se_mark = null;
            $se_percentage = null;
            $id = $row['student_id']; 
            
            if($row['exam_type_id'] == 1){
                $flag == TRUE;
                $ca_mark = $row['mark'];
                $ca_percentage = $this->get_percentage_table($row);
                $assignment_only = 0;
            }else{
                $flag == FALSE;
                $se_mark = $row['mark'];
                $se_percentage = $this->get_percentage_table($row);
            }
            
            //is_attend
            $is_attend = $this->get_is_attend($row);
            
            //absent_reson_approve
            $absent_reson_approve = $this->absent_reson_approve($row);
            
            
            $this->generateResultAndGrade($ca_mark,$se_mark,$ca_percentage,$se_percentage,$is_attend,$absent_reson_approve,$id,$flag,$assignment_only,$row);
            
        }
        
        
        
    }
    
    function generateResultAndGrade($ca_mark,$se_mark,$ca_percentage,$se_percentage,$is_attend,$absent_reson_approve,$id,$flag,$assignment_only,$row) {
       
        /* For flag send true if a CA mark,else send false.
         * For percentage if flag is true send CA percentage, else if flag is flase send SE percentage.
         * If assignment only subject then pass 1 as parameter.
         * When calculating result for SE, if CA mark is already saved in exm_mark_detail table retrieve it from table and pass to this functionto calculate total grade.
         * $absent_reson_approve and $is_attend parameters can retrieve by exm_semester_exam_details table and pass those values to this function to calculate result grade.        
         */
          
        $totalmarks = 0;
        $grade = null;
        $grade_point = null;
        $result_grade = null;
        
        $marking_details = $this->get_relevent_marking_details($row['course_id'], $row['year_no'], $row['semester_no'], $row['batch_id'], $row['subject_id']);
        
        $gradeing_details = $this->Grading_model->get_grades($marking_details['grading_id']);
            

        if ($flag) { 
            //----CALCULATE CA RESULT-----                              
            if($ca_mark<=100 && $ca_mark != null && $ca_mark != ''){               
                $totalmarks = ((parsefloat(($ca_mark*($ca_percentage/100)))).toFixed(2)).split('.');                        
            }
            //----FOR ASSIGNMENT(CA) ONLY SUBJECTS----
            if($assignment_only == 1){
                if($ca_mark<=100 && $ca_mark != null && $ca_mark != ''){
                    $ca_total_rounded_marks = Math.ceil($totalmarks);                        
                    $grade = overall_grade('NE',$ca_mark,$ca_total_rounded_marks,$gradeing_details,false);
                    $grade_point = overall_grade('NE',$ca_mark,$ca_total_rounded_marks,$gradeing_details,true);
                }
                else{
                    $ca_total_rounded_marks = $ca_mark;
                }
                $result_grade = result_grades($is_attend,$absent_reson_approve,'NE',$ca_mark,$ca_total_rounded_marks,$gradeing_details);              
            }         
            
        } else {
            //----CALCULATE SE RESULT----- 
            $total_rounded_marks = 0;
            $se_mark_for_total = 0;
            $ca_mark_for_total = 0;

            if($se_mark === '' || $se_mark === null){
                $se_mark_for_total=0;
            } else {
                $se_mark_for_total = $se_mark;
            }

            if($ca_mark === '' || $ca_mark === null){
                $ca_mark_for_total = 0;
            } else {
                $ca_mark_for_total = $ca_mark;
            }

            if($se_mark<=100 || $se_mark==0 ) {
                $totalmarks = ((parsefloat($se_mark_for_total) * (1 - $se_percentage / 100)) + (parsefloat($ca_mark_for_total) * ($ca_percentage / 100))).toFixed(2);
                $total_rounded_marks = Math.ceil($totalmarks);

                //$grade = overall_grade($se_mark,$totalmarks,$total_rounded_marks,$gradeing_details,false);
                //$grade_point = overall_grade($se_mark,$ca_mark,$total_rounded_marks,$gradeing_details,true);
                //$result_grade = result_grades($is_attend,$absent_reson_approve,$se_mark,$ca_mark,$total_rounded_marks,$gradeing_details);
            }
            else{
                $totalmarks=0;
            }                       
        }
        
        $get_percentage = $this->get_percentage_table($row);
        
        $result_array = array(
            'student_id' => $row['student_id'],
            'subject_id' => $row['subject_id'],
            'totalmarks' => 90,
            'overall_grade' => "A",
            'result_grade' => "A",
            'course_id' => $row['course_id'],
            'year_no' => $row['year_no'],
            'semester_no' => $row['semester_no'],
            'batch_id' => $row['batch_id'],
            'persentage' => $get_percentage,
            'type_id' => $row['exam_type_id'],
            'subject_mark' => $row['mark'],
            'exam_id' => $row['sem_exam_id'],
            'grade_point' => 3.0,
            //'subject_point' => $row['subject_point'],
            //'repeat_val' => $row['repeat_val'],
            //'mark_type' => $row['mark_type'],
            
            
            
            
            //'totalmarks' => $totalmarks,
            //'grade' => $grade,
            //'grade_point' => $grade_point,
            //'result_grade' => $result_grade   
        );        
        
        echo json_encode($this->save_exam_marks($result_array,true));
        //return $result_array;
    }
    
    function get_is_attend($row){
        $this->db->select('is_attend');
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('subject_id', $row['subject_id']);
        
        $get_attend = $this->db->get('exm_semester_exam_details')->result_array();
        
        return $get_attend;
        
    }
    
    function absent_reson_approve($row){
        $this->db->select('is_absent_approve');
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('subject_id', $row['subject_id']);
        
        $get_absent_approve = $this->db->get('exm_semester_exam_details')->result_array();
        
        return $get_absent_approve;
    }
    
    function get_relevent_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id)
    {
        $sem_id = $this->get_semester_id($course_id, $year_no);
        $this->db->select('*, mt.type as type');
        $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
        $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
        $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
        $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
        $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
        $this->db->join('mod_subject ms', 'ms.id = scd.subject_id');
        $this->db->where('sem.id', $sem_id);
        $this->db->where('sc.semester_no', $sem_no);
        $this->db->where('sc.batch_id', $batch_no);
        $this->db->where('scd.subject_id', $subject_id);
        $this->db->where('ms.is_training_apply', 0);
        $this->db->where('sc.deleted', 0);
        $this->db->where('scd.deleted', 0);
        $this->db->where('md.deleted', 0);
        $this->db->group_by('md.type_id');
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }
    
    function get_semester_id($course_id, $year_no)
    {
        $this->db->select('se.id as sem_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('edu_course de', 'de.id = yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $this->db->where('yr.deleted', 0);
        $this->db->where('de.deleted', 0);
        $this->db->where('se.deleted', 0);
        $row_array = $this->db->get('edu_semester se')->row_array();

        if (!empty($row_array)) {
            return $row_array['sem_id'];
        } else {
            return NULL;
        }
    }
    
    function get_grades($marking_details) {
        $this->db->select('gd.grade_mark,gd.grade,gd.grade_rate,gc.criteria');
        $this->db->join('mod_grading_criteria gc', 'gc.id=gd.grade_group');
        $this->db->where('gd.grading_method_id', $marking_details);
        $this->db->where('gd.deleted', 0);
        $this->db->where('gc.status', 1);
        $result_array = $this->db->get('mod_grading_details gd')->row_array();
        return $result_array;

    }
    
    function save_exam_marks($result_array,$flag){
        $res = [];

        if($flag)
        //$this->db->trans_begin();
        $mark_id = $this->check_subject_mark_exists($result_array);
       // $sem_exam_id = $this->get_semester_exam_id($data);
        $sem_exam_id = $data['exam_id'];
        if ($sem_exam_id == NULL) {
            if($flag)
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Please Register Semester Exam and Retry.';
            $this->logger->systemlog('Save Subject Marks', 'Failure', 'Please Register Semester Exam', date("Y-m-d H:i:s", now()),$data);

            //return $res;
        } else {
            if ($mark_id == NULL) {
                //insert
                //insert to exm_exam_mark
                $insert_exam_mark = array(
                    'student_id' => $result_array['student_id'],
                    'course_id' => $result_array['course_id'],
                    'year_no' => $result_array['year_no'],
                    'semester_no' => $result_array['semester_no'],
                    'batch_id' => $result_array['batch_id'],
                    'sem_exam_id' => $sem_exam_id,
                    'subject_id' => $result_array['subject_id'],
                    'total_marks' => $result_array['total_mark'],
                    'overall_grade' => $result_array['overall_grade'],
                    'grade_point' => $result_array['grade_point'],
                    'subject_credit' => $result_array['subject_point'],
                    'result' => $result_array['result_grade'], 
                    'is_repeat_approve' => 0,
                    'is_repeat_mark' => 0,
                    //'added_by' => $this->session->userdata('u_id'),
                    //'added_on' => date("Y-m-d h:i:s", now())                    
                );
                $this->db->insert('exm_mark', $insert_exam_mark);
                $max_exam_mark_id = $this->get_max_exam_mark_id();

                //insert to exm_exam_mark_details
                for ($i = 0; $i < count($data['persentage']); $i++) {
                    if ($data['subject_mark'][$i] == '') {
                        $mark = null;
                    } else {
                        $mark = $data['subject_mark'][$i];
                    }
                    
                    $insert_mark_details = array(
                        'exam_mark_id' => $max_exam_mark_id,
                        'exam_type_id' => $data['type_id'][$i],
                        'persentage' => $data['persentage'][$i],
                        'mark' => $mark,
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $this->db->insert('exm_mark_details', $insert_mark_details);
                }
                if($flag){
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $res['status'] = 'Failed';
                        $res['message'] = 'Failed to save Subject marks';
                        $this->logger->systemlog('Save Subject Marks', 'Failure', 'Failed to save Subject marks', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                    } else {
                        $this->db->trans_commit();
                        $res['status'] = 'success';
                        $res['message'] = 'Subject marks saved successfully.';
                        $this->logger->systemlog('Save Subject Marks', 'Success', 'Subject marks saved successfully', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                    }
                //return $res;               
                }
            }
            
        }
    }
    
    function check_subject_mark_exists($data)
    {
//        if($data['repeat_val'] == 1){
//            
//            $rpt_batch = $this->db->query('SELECT es.batch_id FROM `exm_semester_examyy` `es` JOIN `exm_semester_exam_details` `er` ON `er`.`semester_exam_id` = `es`.`id` WHERE `er`.`student_id` = '.$data['stu_id'].' AND `er`.`subject_id` = '.$data['subject_id'].' AND `es`.`course_id` = '.$data['course_id'].' AND `es`.`year_no` = '.$data['year_no'].' AND `es`.`semester_no` = '.$data['semester_no'].' AND `es`.`deleted` =0 AND `er`.`deleted` =0')->row_array();
//
//            if ($rpt_batch) {
//                $batch = $rpt_batch['batch_id'];
//            } 
//        }
//        else{
//            $batch = $data['batch_id'];
//        }
        
        $this->db->select('*');
        $this->db->where('student_id', $data['student_id']);
        $this->db->where('course_id', $data['course_id']);
        $this->db->where('year_no', $data['year_no']);
        $this->db->where('semester_no', $data['semester_no']);
        //$this->db->where('batch_id', $batch);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('exm_mark')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['id'];
            //}
        } else {
            return NULL;
        }
    }
    
    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    
    function get_student_details_for_excel_file_upload(){
        $data['student_registration_number'] = $this->input->post('student_registration_number'); 
        $data['subject_code'] = $this->input->post('subject_code');  
        
        echo json_encode($this->Subject_model->get_student_details_for_excel_file_upload_from_db($data));  
    }
    
    function get_is_attend_and_absent_reson_approve(){
        $data['student_id'] = $this->input->post('student_id');
        $data['subject_id'] = $this->input->post('subject_id');  
        echo json_encode($this->Subject_model->get_is_attend_and_absent_reson_approve($data));       
    }
}
 
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {
    public  function _remap($method,$args=array())
    {

        if (method_exists($this, $method))
        {
            $this->$method($args);
        }
        else
        {
            //$this->index($method,$args);
            show_404();
        }
    }
    public function exam() {
        parent::__construct();
        $this->load->model('exam_model');
        $this->load->model('hall_model');
        $this->load->model('faculty_model');
        $this->load->model('company_model');
        $this->load->model('batch_model');
        $this->load->model('timetable_model');
        $this->load->model('course_model');
        $this->load->model('Year_model');
        $this->load->model('Util_model');
        $this->load->model('Student_model');
        $this->load->model('Approval_model');
        $this->load->model('Subject_model');
        $this->CI =& get_instance();
    }

    public function exam_view() {
        
        $data['semester_exams'] = $this->exam_model->get_all_semester_exams();
        $data['study_seasons'] = $this->company_model->get_all_study_seasons();
        $data['centers'] = $this->hall_model->get_all_centers();
        $data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['exam_courses'] = $this->course_model->load_courses_complete();
        $data['exams_list'] = $this->exam_model->get_all_exams();
        $data['all_exam_courses'] = $this->exam_model->load_exam_course_programs();
        $data['main_content'] = 'exam_view';
        $data['title'] = 'EXAM';
        $this->load->view('includes/template', $data);
    }

    function paper_setter_moderator (){
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
        
        $data['main_content'] = 'paper_setter_moderator_view';
        $data['title'] = 'PAPER SETTER AND MODERATOR';
        $this->load->view('includes/template', $data);
    }

    function get_exam_name_by_id() {
        $exam_id = $this->input->post('exam_id');
        echo json_encode($this->exam_model->get_exam_name_by_id($exam_id));
    }

    function load_course_programs(){
        echo json_encode($this->exam_model->load_exam_course_programs());   
    }
    
    function save_exam() {
        //post values
        $data['exam_id'] = $this->input->post('exam_id');
        $data['e_code'] = $this->input->post('e_code');
        $data['e_name'] = $this->input->post('e_name');
        $data['des'] = $this->input->post('des');

        if (empty($data['exam_id'])) {
            //insert
            $result = $this->exam_model->save_exam($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Exam saved successfully.');
                $this->logger->systemlog('Save Exam', 'Success', 'Exam saved successfully.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to save exam. Retry.');
                $this->logger->systemlog('Save Exam', 'Failure', 'Failed to save exam.', date("Y-m-d H:i:s", now()),$data);
            }
        } else {
            //update
            $result = $this->exam_model->save_exam($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Exam updated successfully.');
                $this->logger->systemlog('Update Exam', 'Success', 'Exam updated successfully.', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update exam. Retry.');
                $this->logger->systemlog('Update Exam', 'Failure', 'Failed to update exam.', date("Y-m-d H:i:s", now()),$data);   
            }
        }
        redirect('exam/exam_view');
    }

    function change_exam_status() {
        //post values
        $data['exam_id'] = $this->input->post('exam_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->exam_model->change_exam_status($data));
    }

    public function exam_marks($user_level) {
      //  $data['all_faculties'] = $this->faculty_model->all_active_faculties();
        $access_level = $this->Util_model->check_access_level();
        //print_r($access_level);
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            if(isset($user_level[0])){
                $data['user_level'] = $user_level[0];
                $data['main_content'] = 'exam_marks_view';
                $data['title'] = 'EXAM MARKS';
                $this->load->view('includes/template', $data);
            }
            else{
                $message_403 = "You don't have access to the url you where trying to reach.";
                show_error($message_403 , 403 );
            }
        }
        else if($ug_level == 2){
            if(isset($user_level[0])){
                $data['user_level'] = $user_level[0];
                $data['main_content'] = 'exam_marks_view';
                $data['title'] = 'EXAM MARKS';
                $this->load->view('includes/template', $data);
            }
            else{
                $message_403 = "You don't have access to the url you where trying to reach.";
                show_error($message_403 , 403 );
            }
        }
        else if($ug_level == 3){ 
            
        }
        else if($ug_level == 4){ 
            
            if(isset($user_level[0])){
                $data['user_level'] = $user_level[0];
                $data['main_content'] = 'exam_marks_view';
                $data['title'] = 'EXAM MARKS';
                $this->load->view('includes/template', $data);
            }
            else{
                $message_403 = "You don't have access to the url you where trying to reach.";
                show_error($message_403 , 403 );
            }
        }
    }

    public function exam_timetable() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            //get All students
            //$data['centers'] = $this->Staff_model->get_all_centers();
            //$data['POSTPONE'] = $this->Approval_model->get_postpone();
            $data['lecture_ttbl'] = $this->exam_model->get_lecture_timetable();
            //$data['exam_ttbl'] = $this->Approval_model->get_exam_timetable();
        }
        else if($ug_level == 2){ // 
            //$data['POSTPONE'] = $this->Student_model->get_center_students();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Student_model->get_center_students();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['result_array'] = $this->Student_model->get_center_students();
            //get access rights to that user
        }
        else // Student
        {
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_student();
        }
        
        
        //$data['faculties'] = $this->auth->get_accessfaculties();
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info'] = $this->company_model->get_ay_info();
        $data['main_content'] = 'exam_time_table_view';
        $data['title'] = 'EXAM TIMETABLE';
        $this->load->view('includes/template', $data);
    }

    public function apply_exam() {
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
//         $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
       // $data['ug_level'] = $ug_level;
        
        if($ug_level == 1){ //Admin
            
            //$data['all_faculties'] = $this->faculty_model->all_active_faculties();
            $data['ay_info'] = $this->exam_model->get_ay_info();
            $data['exam_course'] = $this->course_model->load_courses_complete();
            $data['centers'] = $this->exam_model->get_all_centers();
            $data['deferment'] = $this->exam_model->get_deferment_options();
            
            //get All students
            //$data['centers'] = $this->Staff_model->get_all_centers();
            //$data['POSTPONE'] = $this->Approval_model->get_postpone();
            $data['lecture_ttbl'] = $this->exam_model->get_lecture_timetable();
            //$data['exam_ttbl'] = $this->Approval_model->get_exam_timetable();
        }
        else if($ug_level == 2){ 
            //$data['all_faculties'] = $this->exam_model->all_active_faculties_by_center();
            $data['exam_course'] = $this->exam_model->load_courses_complete_by_center();
            $data['centers'] = $this->exam_model->get_all_centers();
            $data['deferment'] = $this->exam_model->get_deferment_options();
            
            //$data['POSTPONE'] = $this->Student_model->get_center_students();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Student_model->get_center_students();
            $data['centers'] = $this->exam_model->get_all_centers();
            $data['deferment'] = $this->exam_model->get_deferment_options();
            $data['exam_course'] = $this->exam_model->load_courses_complete_student();
        }
        else if($ug_level == 4){ // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['result_array'] = $this->Student_model->get_center_students();
            $data['centers'] = $this->exam_model->get_all_centers();
            $data['deferment'] = $this->exam_model->get_deferment_options();
            $data['exam_course'] = $this->exam_model->load_courses_complete_student();
            //get access rights to that user
        }
        else // Student
        {
            //$data['all_faculties'] = $this->faculty_model->all_active_faculties();
            //$data['exam_course'] = $this->course_model->load_courses_complete();
            $data['exam_course'] = $this->exam_model->load_courses_complete_student();
            $data['centers'] =  $this->Student_model->get_student();
            $data['deferment'] = $this->exam_model->get_deferment_options();
            
            //get only logged in user records. 
          //  $data['result_array'] = $this->Student_model->get_student();
        }
        
        
        //$data['all_faculties'] = $this->faculty_model->all_active_faculties();
        //$data['exam_course'] = $this->course_model->load_courses_complete();
        $data['main_content'] = 'apply_exam_view';
        $data['title'] = 'APPLY EXAM';
        $this->load->view('includes/template', $data);
    }

    function save_semester_exam() {
        $data['s_exam_id'] = $this->input->post('s_exam_id');
        //$data['faculty_id'] = $this->input->post('l_faculty');
        $data['course_id'] = $this->input->post('l_Dcode');
        $data['year_no'] = $this->input->post('l_no_year');
        $data['semester_no'] = $this->input->post('l_no_semester');
        $data['season_id'] = $this->input->post('s_season');
        $data['batch_id'] = $this->input->post('l_Bcode');
        $data['s_des'] = $this->input->post('s_des');
        $data['exam_id'] = $this->input->post('l_exam_name');

        echo json_encode($this->exam_model->save_semester_exam($data));
    }

    function change_semester_exam_status() {
        $data['sem_exam_id'] = $this->input->post('sem_exam_id');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->exam_model->change_semester_exam_status($data));
    }

    function load_sem_exam_data() {
        echo json_encode($this->exam_model->get_all_semester_exams());
    }

    function load_sem_exam_by_id() {
        $sem_exam_id = $this->input->post('sem_exam_id');
        echo json_encode($this->exam_model->load_sem_exam_by_id($sem_exam_id));
    }

    function load_semester_exam() {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);

        echo json_encode($this->exam_model->get_semester_exam($data, $batch_details));
    }
    
    
    function load_mark_semester_exam() {
        $data['mrk_course'] = $this->input->post('mrk_course');
        $data['mrk_year'] = $this->input->post('mrk_year');
        $data['mrk_semester'] = $this->input->post('mrk_semester');
        $data['mrk_batch'] = $this->input->post('mrk_batch');

        echo json_encode($this->exam_model->load_mark_semester_exam($data));
    }
    
    
    function load_mark_semester_exam_repeat() {
        $data['mrk_course'] = $this->input->post('mrk_course');
        $data['mrk_year'] = $this->input->post('mrk_year');
        $data['mrk_semester'] = $this->input->post('mrk_semester');
        $data['mrk_batch'] = $this->input->post('mrk_batch');

        echo json_encode($this->exam_model->load_mark_semester_exam_repeat($data));
    }

    function save_exam_marks() {
        //post values and arrays
        $data['stu_id'] = $this->input->post('student_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['total_mark'] = $this->input->post('total_mark');
        $data['overall_grade'] = $this->input->post('overall_grade');
        $data['result_grade'] = $this->input->post('result_grade');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['persentage'] = $this->input->post('persentage');
        $data['type_id'] = $this->input->post('type_id');
        $data['subject_mark'] = $this->input->post('subject_mark');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['grade_point'] = $this->input->post('grade_point');
        $data['subject_point'] = $this->input->post('subject_point');       
        $data['repeat_val'] = $this->input->post('repeat_val');
        $data['mark_type'] = $this->input->post('mark_type');

       echo json_encode($this->exam_model->save_exam_marks($data,true));
    }
    
    function process_bulk_result()
    {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $excelRows = $this->input->post('excelRows');
        $data['user_level'] = $this->input->post('user_level');
        
        //1. Student/load_student_for_exam_marks
        //2. foreach in excel rows..
            //3. subject/get_student_details_for_excel_file_upload
            //4. generateResultAndGrade(
                // For flag send true if a CA mark,else send false.
                // For percentage if flag is true send CA percentage, else if flag is flase send SE percentage.
                // If assignment only subject then pass 1 as parameter.
                // When calculating result for SE, if CA mark is already saved in exm_mark_detail table retrieve- 
                // it from table and pass to this functionto calculate total grade.
                // $absent_reson_approve and $is_attend parameters can retrieve by exm_semester_exam_details table and pass-
                // those values to this function to calculate result grade.             
            //5. Student/get_relevent_marking_details
            //6. Grading_method/get_grades
            //7. check CA or SE exam marks.. if CA calculate  the result according to grades and save to DB
            //8. IF  SE, take student data from load_student_for_exam_marks funtion and calculate result Save in to DB.
        
        
        //1. Student/load_student_for_exam_marks
        //$studet_exm_mark_details = $this->Student_model->load_student_for_exam_marks_se($Stu_data);
        
        //2. foreach in excel rows..
        foreach ($excelRows as $key => $value) 
        {
            $flag = null;
            $marks = 0;
            $SubjectName = "";
            $ca_mark = null;
            $se_mark = null;
            $assignment_only = 0;
            $remarks = "";
            if(!empty($value['Marks'])){
                $marks = $value['Marks'];
            }
            $SubjectName = $value['SubjectName'];
            if($value['ExamType'] == 'CA'){
                //for CA marks
                $flag = true;
                $ca_mark = $marks;           
            }else{
                //for SE marks
                $flag = false;
                $se_mark = $marks;
            }
            
            if(!empty($value['Remarks'])){
                $remarks = $value['Remarks'];
            }
            $StudentRegNo= $value['StudentRegNo'];
            //3. subject/get_student_details_for_excel_file_upload
            $get_data['student_registration_number'] = $StudentRegNo; 
            $get_data['subject_code'] = $SubjectName;  
            //echo $get_data['student_registration_number'] . "   " . $get_data['subject_code'];
            $stu_subject_data = $this->Subject_model->get_student_details_for_excel_file_upload_from_db($get_data);
            //echo 'stu:';
            print_r($stu_subject_data);
            //4. generateResultAndGrade(
            
            $totalmarks = 0;
            $grade = "";
            $grade_point = "";
            $result_grade = "";
            $gradeing_details = "";
            $absent_reson_approve = "";
            $is_attend = "";
            $se_percentage = 0;
            $subject_credits = 0;
            $ca_percentage = 0;
            $ca_type = 0;
            $se_type = 0;
            $mark_type = "";
            $persentage = [];
            $type_id = [];
            $subject_mark = [];
            $ca_type_in_db = 0;
            $ca_percentage_in_db = 0;
            //4.1 Student/get_relevent_marking_details
            $course_id = $this->input->post('center_id');
            $year_no = $this->input->post('year');
            $sem_no = $this->input->post('semester');
            $batch_no = $this->input->post('batch_id');
            $subject_id = $stu_subject_data['subject_id'];
            echo $course_id. "--" . $year_no. "--" . $year_no. "--" . $sem_no. "--" . $batch_no . "--" . $subject_id;
            $relevent_marking_details = $this->Student_model->get_relevent_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id);
            //echo 'subj';
            print_r($relevent_marking_details);
        }
        //echo json_encode("success");
    }
	
    function save_postpone(){
        $result = $this->exam_model->save_postpone();
        redirect('exam/apply_exam');
    }

    function load_examtypes() {
        echo json_encode($this->exam_model->load_examtypes());
    }

    function load_exams() {   
        echo json_encode($this->exam_model->load_exams());
    }
    

    function load_exams_deferement_approval() {   
        echo json_encode($this->exam_model->load_exams_deferement_approval());
    }
    
    function load_exams_deferement() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['course'] = $this->input->post('course');
        $data['center'] = $this->input->post('center');
        //$batch_details = $this->exam_model->load_batch_details_deferement($data['batch_id']);

        //echo json_encode($this->exam_model->load_exams_deferement($data, $batch_details));
        echo json_encode($this->exam_model->load_exams_deferement($data));
    }

    function savetimetbl() {
        echo json_encode($this->exam_model->savetimetbl());
    }

    function load_timetable_data() {
        echo json_encode($this->exam_model->load_timetable_data());
    }
    
    function edit_change_approval_status(){
        $data['ttbl_id'] = $this->input->post('ttbl_id');
        echo json_encode($this->exam_model->edit_change_approval_status($data));
    }

    function save_schedule() {
        echo json_encode($this->exam_model->save_schedule());
    }

    function load_savedschedules() {
        echo json_encode($this->exam_model->load_savedschedules());
    }

    function load_scheduledata() {
        echo json_encode($this->exam_model->load_scheduledata());
    }

    function delete_schedule() {
        echo json_encode($this->exam_model->delete_schedule());
    }

    function load_exam_timetables() {
        echo json_encode($this->exam_model->load_exam_timetables());
    }

    function verify_timetable() {
        echo json_encode($this->exam_model->verify_timetable());
    }

    function confirm_timetable() {
        echo json_encode($this->exam_model->confirm_timetable());
    }

    function delete_timetable() {
        echo json_encode($this->exam_model->delete_timetable());
    }


    function applied_exams_for_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['faculty_id'] = $this->input->post('l_faculty');
        $data['course_id'] = $this->input->post('l_course');
        $data['batch_id'] = $this->input->post('l_batch');

        echo json_encode($this->exam_model->applied_exams_for_lookup($data));
    }

    function load_applied_students()
    {
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['sem_exam_id'] = $this->input->post('sem_exam_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['branch'] = $this->input->post('branch');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        echo json_encode($this->exam_model->load_applied_students($data));
    }

    public function config_exam_halls() {
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info']  = $this->company_model->get_ay_info();
        $data['main_content'] = 'config_examHall_view.php';
        $data['title'] = 'EXAM HALL';
        $this->load->view('includes/template', $data);
    }

    function load_schedules()
    {
        echo json_encode($this->exam_model->load_schedules());
    }

    function load_hallstudent_list()
    {
        echo json_encode($this->exam_model->load_hallstudent_list());
    }

    function load_nohallstudents()
    {
        //$eh_semester = $this->input->post('eh_semester');
        $eh_branch = $this->input->post('eh_branch');
        $eh_exam = $this->input->post('eh_exam');
        $subject = $this->input->post('subject');
        echo json_encode($this->exam_model->load_nohallstudents($eh_exam,$subject, $eh_branch));
    }

    function update_hall_students()
    {
        echo json_encode($this->exam_model->update_hall_students());
    }

    function remove_hall()
    {
        echo json_encode($this->exam_model->remove_hall());
    }

    function remove_hall_student()
    {
        echo json_encode($this->exam_model->remove_hall_student());
    }

    public function exam_attendance() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 1){ //Admin
            
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info']  = $this->company_model->get_ay_info();
            
            
//            //$data['all_faculties'] = $this->faculty_model->all_active_faculties();
//            $data['exam_course'] = $this->course_model->load_courses_complete();
//            //get All students
//            //$data['centers'] = $this->Staff_model->get_all_centers();
//            //$data['POSTPONE'] = $this->Approval_model->get_postpone();
//            $data['lecture_ttbl'] = $this->exam_model->get_lecture_timetable();
//            //$data['exam_ttbl'] = $this->Approval_model->get_exam_timetable();
        }
        else if($ug_level == 2){ 
            //$data['all_faculties'] = $this->exam_model->all_active_faculties_by_center();
            $data['exam_course'] = $this->exam_model->load_courses_complete_by_center();
            
            //$data['POSTPONE'] = $this->Student_model->get_center_students();
            
        }
        else if($ug_level == 3){ // Registrar
            //get the only Logged in user center Students details.
            $data['result_array'] = $this->Student_model->get_center_students();
        }
        else if($ug_level == 4){ // Lecturer
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info']  = $this->company_model->get_ay_info();
            //get the only Logged in user center Students details and send rights to the controls like buttons.
//            $data['result_array'] = $this->Student_model->get_center_students();
            //get access rights to that user
        }
        else // Student
        {
            //$data['all_faculties'] = $this->faculty_model->all_active_faculties();
            //$data['exam_course'] = $this->course_model->load_courses_complete();
            $data['exam_course'] = $this->exam_model->load_courses_complete_student();
            
            //get only logged in user records. 
            $data['result_array'] = $this->Student_model->get_student();
        }
        
        $data['courses'] = $this->timetable_model->load_courses();
        $data['ay_info']  = $this->company_model->get_ay_info();
        $data['main_content'] = 'exam_attendance_view.php';
        $data['title'] = 'EXAM ATTENDANCE';
        $this->load->view('includes/template', $data);
    }

    function load_hallstudents()
    {
        $id = $this->input->post('id');

        echo json_encode($this->exam_model->load_hallstudents($id));
    }
    
    function load_student_subjectwise(){
        $id = $this->input->post('id');
        $exam_id = $this->input->post('exam_id');
        $center_id = $this->input->post('center_id');
        $batch_id = $this->input->post('batch_id');
         

        echo json_encode($this->exam_model->load_student_subjectwise($id,$exam_id, $center_id, $batch_id));
    }
    
    function load_repeat_student_subjectwise(){
        $id = $this->input->post('id');
        $exam_id = $this->input->post('exam_id');
        $center_id = $this->input->post('center_id');
        $batch_id = $this->input->post('batch_id');
         

        echo json_encode($this->exam_model->load_repeat_student_subjectwise($id,$exam_id, $center_id, $batch_id));
    }
    
    

    function update_exam_attendance()
    {
        echo json_encode($this->exam_model->update_exam_attendance());
    }
    
    function load_repeat_semester_exam()
    {
        echo json_encode($this->exam_model->load_repeat_semester_exam());
    }
       
    function load_repeat_exam_to_apply_exam()
    {
        echo json_encode($this->exam_model->load_repeat_exam_to_apply_exam());
    }
    
    function load_repeat_students()
    {
        echo json_encode($this->exam_model->load_repeat_students());
    }

    function rpt_load_students()
    {
        echo json_encode($this->exam_model->rpt_load_students());
    }

    function load_recorrection_student_data()
    {
        echo json_encode($this->exam_model->load_recorrection_student_data());
    }
    
    
    function load_recorrection_student_data_for_recorrection_apply()
    {
        echo json_encode($this->exam_model->load_recorrection_student_data_for_recorrection_apply());
    }
       
    function save_recorrection_student_attempt()
    {
        echo json_encode($this->exam_model->save_recorrection_student_attempt());
    }
    
    function check_duplicate_exam_code(){
        $exm_code = $this->input->post('exam_code');
        
        echo json_encode($this->exam_model->check_duplicate_exam_code($exm_code));
    }
    
    function load_course_list()
    {
        echo json_encode($this->exam_model->load_course_list());
    }
    
    function check_duplicate_semester_exam()
    {
        echo json_encode($this->exam_model->check_duplicate_semester_exam());
    }
    

    function temp()
    {
        // $this->db->where('func_id >',162);
        // $old = $this->db->get('ath_authfunction')->result_array();

        // foreach ($old as $o) {

        //     $t['func_name'] = $o['func_name'];
        //     $t['func_module'] = $o['func_module'];
        //     $t['func_submodule'] = $o['func_submodule'];
        //     $t['func_url'] = $o['func_url'];
        //     $t['func_description'] = $o['func_description'];
        //     $t['func_developer'] = $o['func_developer'];
        //     $t['func_status'] = $o['func_status'];
        //     $t['func_type'] = $o['func_type'];
        //     $t['func_isedit'] = $o['func_isedit'];
        //     $t['func_uitype'] = $o['func_uitype'];

        //     $this->db->insert('ath_authfunction1',$t);

        // }
    }
    
    
   function edit_exam_timetable() {
        $ttbl_id = $this->input->post('tt_course');
        echo json_encode($this->exam_model->edit_exam_timetable($ttbl_id));
    }

    function timetable_check_duplicate(){
         $data['exam_id'] = $this->input->post('exam_id');
         $data['subject_id'] = $this->input->post('subject_id');
         $data['exam_type'] = $this->input->post('exam_type');

        echo json_encode($this->exam_model->timetable_check_duplicate($data));
    }
    
    
    
    function search_exam_absent_students_data() {

        $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->exam_model->search_exam_absent_students_data($data));
    }
    
    
    function load_absented_subjects(){
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details=$this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Subject_model->load_semester_subjects($data, $batch_details));
    } 
    
    
    
    
    function load_semester_subjects(){
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details=$this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->exam_model->load_semester_subjects($data, $batch_details));
    }
    
    
    function load_semester_subjects_deferement_repeat(){
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        echo json_encode($this->exam_model->load_semester_subjects_deferement_repeat($data));
    }
    
    
    function load_student_who_absent_exam()
    {
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
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
        echo json_encode($this->exam_model->load_student_who_absent_exam($data, $batch_details));
    }
    
    
    function load_student_who_absent_exam_repeat(){
        
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        
        echo json_encode($this->exam_model->load_student_who_absent_exam_repeat($data));
    }
    
    
    

    function deferement_approve()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');
        $data['defer_option'] = $this->input->post('defer_option');
//        $data['other_reason'] = $this->input->post('other_reason');
       
        echo json_encode($this->exam_model->deferement_approve($data));
    }
    
        
    function deferement_approve_repeat()
    {
        $data['stu_id'] = $this->input->post('stu_id');
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subjects'] = $this->input->post('subjects');
        $data['defer_option'] = $this->input->post('defer_option');
//        $data['other_reason'] = $this->input->post('other_reason');
       
        echo json_encode($this->exam_model->deferement_approve_repeat($data));
    }
    
    
     function load_course_list_recorrection()
    {
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->exam_model->load_course_list_recorrection());
        } else if ($ug_level == 2) { //
            echo json_encode($this->exam_model->load_course_list_recorrection());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->exam_model->load_course_list_recorrection());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->exam_model->load_course_list_recorrection());
            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.          
            echo json_encode($this->exam_model->load_course_list_recorrection_student());  
        }
    }
    
    
    function load_batches_recorrection()
    {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->exam_model->load_batches_recorrection($course_id));

        } else if ($ug_level == 2) { //
            echo json_encode($this->exam_model->load_batches_recorrection($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->exam_model->load_batches_recorrection($course_id));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->exam_model->load_batches_recorrection($course_id));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->exam_model->load_batches_recorrection_student($course_id, $this->session->userdata('user_ref_id')));

        }
    }
    
    function load_semester_exam_recorrection() {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->exam_model->load_batch_details_recorrection($data['batch_id']);

        echo json_encode($this->exam_model->load_semester_exam_recorrection($data, $batch_details));
    }
    
    
    function load_semester_exam_recorrection_marks() {
        $data['mrk_batch'] = $this->input->post('mrk_batch');
        $data['mrk_course'] = $this->input->post('mrk_course');
        $data['mrk_year'] = $this->input->post('mrk_year');
        $data['mrk_semester'] = $this->input->post('mrk_semester');

        echo json_encode($this->exam_model->load_semester_exam_recorrection_marks($data));
    }
    
    function search_post_something(){
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        
        echo json_encode($this->exam_model->search_post_something($data));
    }
    
    function search_differ_something(){
        $data['stu_id'] = $this->CI->session->userdata('user_ref_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $data['access_level'] = $ug_level;
        
        echo json_encode($this->exam_model->search_differ_something($data));
    }
    
    
    function load_exams_repeat_deferment() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['course'] = $this->input->post('course');
        $data['center'] = $this->input->post('center');
        //$batch_details = $this->exam_model->load_batch_details_deferement($data['batch_id']);

        //echo json_encode($this->exam_model->load_exams_repeat_deferment($data, $batch_details));
        echo json_encode($this->exam_model->load_exams_repeat_deferment($data));
    }
    
    
    function load_exams_repeat_deferment_approval() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['course'] = $this->input->post('course');
        $data['center'] = $this->input->post('center');
        //$batch_details = $this->exam_model->load_batch_details_deferement($data['batch_id']);

        //echo json_encode($this->exam_model->load_exams_repeat_deferment($data, $batch_details));
        echo json_encode($this->exam_model->load_exams_repeat_deferment_approval($data));
    }
    
    
    //GRADUATION
    function load_graduation_eligibility(){
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $data['stu_id'] = NULL;
        
        if($ug_level == 5){
            $data['stu_id'] = $this->session->userdata('user_ref_id');
        }
        echo json_encode($this->exam_model->load_graduation_eligibility($data));
    }
    
    function save_graduation_request(){
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $data['stu_id'] = NULL;
        
        if($ug_level == 5){
            $data['stu_id'] = $this->session->userdata('user_ref_id');
        }
        echo json_encode($this->exam_model->save_graduation_request($data));
    }
    
 
    //GRADUATION APPROVAL
    function load_graduation_eligibility_for_approval(){
        
        $data['stu_id'] = $this->input->post('stu_id');
        
        echo json_encode($this->exam_model->load_graduation_eligibility_for_approval($data));
    }

    function save_paper_setter_and_moderator (){
        //post values
        $data['paper_setter_id'] = $this->input->post('paper_setter_id');
        $data['semester_exam_id'] = $this->input->post('exam_code');
        $data['subject_id'] = $this->input->post('sub_code');
        $data['setter_lecturer_id'] = $this->input->post('paper_setter');
        $data['moderator_lecturer_id'] = $this->input->post('paper_moderator');
        

        if (empty($data['paper_setter_id'])) {
            //insert
                $result = $this->exam_model->save_paper_setter_and_moderator($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Paper Setter and Moderator saved successfully.');
                    $this->logger->systemlog('Paper Setter and Moderator', 'Success', 'Paper Setter and Moderator saved successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Paper Setter and Moderator . Retry.');
                    $this->logger->systemlog('Paper Setter and Moderator ', 'Faliure', 'Failed to save Paper Setter and Moderator .', date("Y-m-d H:i:s", now()), $data);
                }
        } else {
            //update
                $result = $this->exam_model->save_paper_setter_and_moderator($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Paper Setter and Moderator updated successfully.');
                    $this->logger->systemlog('Paper Setter and Moderator', 'Success', 'Paper Setter and Moderator updated successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update Paper Setter and Moderator . Retry.');
                    $this->logger->systemlog('Paper Setter and Moderator ', 'Faliure', 'Failed to update Paper Setter and Moderator .', date("Y-m-d H:i:s", now()), $data);
                }
        }
        redirect('exam/paper_setter_moderator');
    }
    
    function check_duplicate_setter_moderator ()
    {
        $data['semester_exam_id'] = $this->input->post('semester_exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['setter_lecturer_id'] = $this->input->post('setter_lecturer_id');
        $data['moderator_lecturer_id'] = $this->input->post('moderator_lecturer_id');
        
        echo json_encode($this->exam_model->check_duplicate_setter_moderator($data));
        
    }

    
    function training_exam_mark (){
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
        
        $data['main_content'] = 'training_exam_mark_view';
        $data['title'] = 'TRAINING EXAM MARK';
        $this->load->view('includes/template', $data);
    }
    
    
    function bulk_save_training_marks(){

        $data['repeat_val'] = $this->input->post('repeat_val');
        
        if($data['repeat_val'] == 1){
            $data['exam_id'] = $this->input->post('rpt_exam');
            $data['training_exam_mark'] = $this->input->post('rpt_training_exam_mark');
            $data['batch_id'] = $this->input->post('rpt_batch');
            $data['course_id'] = $this->input->post('rpt_course');
            $data['year_no'] = $this->input->post('rpt_year');
            $data['semester_no'] = $this->input->post('rpt_semester');
        }
        else{
            $data['exam_id'] = $this->input->post('exam');
            $data['training_exam_mark'] = $this->input->post('training_exam_mark');
            $data['batch_id'] = $this->input->post('batch');
            $data['course_id'] = $this->input->post('course');
            $data['year_no'] = $this->input->post('year');
            $data['semester_no'] = $this->input->post('semester'); 
        }
                
        echo json_encode($this->exam_model->bulk_save_training_marks($data));
    }
    
    function calculate_student_gpa()
    {
        $data['gpa_center'] = $this->input->post('gpa_center');
        $data['gpa_course'] = $this->input->post('gpa_course');
        $data['gpa_year'] = $this->input->post('gpa_year');
        $data['gpa_semester'] = $this->input->post('gpa_semester');
        $data['gpa_batch'] = $this->input->post('gpa_batch');
        $data['gpa_sem_exam_id'] = $this->input->post('gpa_sem_exam_id');
        $result = $this->exam_model->calculate_student_gpa($data);
        echo json_encode($result);
    }
}

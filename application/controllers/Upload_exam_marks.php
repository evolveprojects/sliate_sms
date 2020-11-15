<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_exam_marks extends CI_Controller
{

    public function Upload_exam_marks()
    {
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
        //$this->load->model('Exam_mark_upload_model');
        $this->load->model('Grading_model');
        $this->load->model('exam_model');

        //$this->load->helper('download');
        $this->CI = &get_instance();
    }


    function get_student_details_for_excel_file_upload()
    {
        //kasun
        try {
            $ca_student_count=0;
            $se_student_count=0;
            $failed_ca_student_count=0;
            $failed_se_student_count=0;
            $invalid_student=0;



            $totalmarks = 0;
            $grade = '';
            $grade_point = '';
            $result_grade = '';
            $gradeing_details = '';
            $absent_reson_approve = '';
            $is_attend = 0;
            $se_percentage = 0;
            $subject_credits = 0;
            $ca_percentage = 0;
            $ca_type = 0;
            $se_type = 0;
            $mark_type = '';
            $persentage = [];
            $type_id = [];
            $subject_mark = [];
            $ca_type_in_db = 0;
            $ca_percentage_in_db = 0;

            $excelRows = $this->input->post('excelRows');
            $data['batch_id'] = $this->input->post('batch_id');
            $data['course_id'] = $this->input->post('course_id');
            $data['year_no'] = $this->input->post('year_no');
            $data['semester_no'] = $this->input->post('semester_no');
            $data['sem_exam_id'] = $this->input->post('sem_exam_id');
            $data['center_id'] = $this->input->post('center_id');
            //print_r($excelRows);
            foreach ($excelRows as $row) {
                $ca_mark = '';
                $se_mark = '';
                if (($row['Marks'] != '') && (!empty($row['SubjectName'])) && (!empty($row['StudentRegNo'])) && (!empty($row['ExamType']))) {
                    $data['StudentRegNo'] = $row['StudentRegNo'];
                    $data['SubjectName'] = $row['SubjectName'];
                    $data['CourseCode'] = $row['CourseCode'];
                    $data['Marks'] = $row['Marks'];
                    $data['ExamType'] = $row['ExamType'];
                   
                    $students_data = $this->Subject_model->get_student_details_and_upload($data);

                    $course_id = $data['course_id'];
                    $year_no = $data['year_no'];
                    $sem_no = $data['semester_no'];
                    $batch_no = $data['batch_id'];
                    $subject_id = $students_data['subject_id'];
                    $student_id = $students_data['student_id'];
                    if($student_id != null)
                    {       
                        if ($data['ExamType'] == 'CA') {
                            $examTypeId = 2;
                        }
                        if ($data['ExamType'] == 'SE') {
                            $examTypeId = 1;
                        }
                        $markingDetails = $this->Student_model->get_relevent_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id,$examTypeId);

                        if (!empty($markingDetails)) {
                            foreach ($markingDetails as $markingDetail) {
                                $grading_id['grading_id'] = $markingDetail['grading_method_id'];
                                $subject_credits = $markingDetail['new_credits'];
                                $typeId[0] = $markingDetail['type_id'];

                                $gradeing_details = $this->Grading_model->get_grades($grading_id);

                                $check_is_attend_data['student_id'] = $student_id;
                                $check_is_attend_data['subject_id'] = $subject_id;
                              //  $isAttendAbsentApprove = $this->Subject_model->get_is_attend_and_absent_reson_approve($check_is_attend_data);

                              /*  if (!empty($isAttendAbsentApprove)) {
                                    $is_attend = $isAttendAbsentApprove['is_attend'];
                                    $absent_reson_approve = $isAttendAbsentApprove['is_absent_approve'];
                                }*/ //this function disable because some attendance are not entered (disable emergency purposes ) 
                                $is_attend =1;//temp variable
                                $absent_reson_approve='';//temp variable

                                if (($data['ExamType'] == 'CA') && ($markingDetail['type_id'] == 2)) {
                                    //for CA marks
                                    $flag = 1;
                                    $ca_mark = $data['Marks'];
                                    $mark_type = "ca_mark";
                                    $ca_percentage = $markingDetail['percentage'];

                                    if (($ca_mark <=100) && ($ca_mark != null) && ($ca_mark != '')) {
                                        $totalmarks = ($ca_mark * $ca_percentage/100);
                                        $persentage[0] = $ca_percentage;
                                        $subject_mark[0] = $ca_mark;

                                        $overall_grade=  $this->subjectgrade->overall_grade($markingDetail['grading_method_id'],$totalmarks,false);//$grade_method__id, $mark, $is_rate
                                        $grade_point=  $this->subjectgrade->overall_grade($markingDetail['grading_method_id'],$totalmarks,true);
                                        $result_grade=  $this->subjectgrade->result_grades($is_attend,$absent_reson_approve,0,$ca_mark,$totalmarks);//$is_attend,$absent_reson_approve,$se_mark,$ca_mark,$tot
                                        
                                        try {
                                            $saveData['stu_id'] = $student_id;
                                            $saveData['subject_id'] = $subject_id;
                                            $saveData['total_mark'] = $totalmarks;
                                            $saveData['overall_grade'] = $overall_grade;
                                            $saveData['result_grade'] = $result_grade;
                                            $saveData['course_id'] = $course_id;
                                            $saveData['year_no'] = $year_no;
                                            $saveData['semester_no'] = $sem_no;
                                            $saveData['batch_id'] = $batch_no;
                                            $saveData['persentage'] = $persentage;
                                            $saveData['type_id'] = $typeId;
                                            $saveData['subject_mark'] = $subject_mark;
                                            $saveData['exam_id'] = $data['sem_exam_id'];
                                            $saveData['grade_point'] = $grade_point;
                                            $saveData['subject_point'] = $subject_credits;
                                            $saveData['repeat_val'] = '0';
                                            $saveData['mark_type'] = $mark_type;
                                            $this->exam_model->save_exam_marks($saveData,true);

                                            $saveData['status'] = 1;
                                            $this->Approval_model->bulk_ca_mark_approval_level1($saveData);
                                            $this->Approval_model->bulk_ca_mark_approval_level2($saveData);
                                            
                                            

                                            $ca_student_count++;
                                        } catch (\Exception $e) {
                                            //
                                            $failed_ca_student_count++;
                                        }
                                    }
                                }
                                if (($data['ExamType'] == 'SE') && ($markingDetail['type_id'] == 1)) {
                                    try {
                                        //for SE marks
                                        $mark_type = "se_mark";
                                        $flag = 0;
                                        $se_percentage = $markingDetail['percentage'];
                                        $se_mark = $data['Marks'];
                                        $total_rounded_marks = 0;
                                        $se_mark_for_total = 0;
                                        $ca_mark_for_total = 0;
                                        $loadData['batch_id'] = $batch_no;
                                        $loadData['year_no'] = $year_no;
                                        $loadData['semester_no'] = $sem_no;
                                        $loadData['course_id'] = $course_id;
                                        $loadData['center_id'] = $data['center_id'];
                                        $loadData['exam_id'] = $data['sem_exam_id'];
                                        $loadData['student_id'] = $student_id;
                                        $loadData['subject_id'] = $subject_id;
                                        $load_student_wise_exam_marks = $this->Student_model->load_student_wise_exam_marks_for_file_upload($loadData);
                                        //var_dump($load_student_wise_exam_marks);
                                        if (!empty($load_student_wise_exam_marks)) {
                                            foreach ($load_student_wise_exam_marks as $exammark) {
                                                foreach ($exammark['exam_mark'] as $marks) {

                                                    if ($marks['exam_type_id'] == 2) {
                                                        $ca_type_in_db = $marks['exam_type_id'];
                                                        $ca_percentage_in_db = $marks['persentage'];
                                                        $ca_mark_for_total = $marks['mark'];
                                                    }
                                                }
                                            }
                                        }
                                        if ($se_mark != '') {
                                            $se_mark_for_total = $se_mark;
                                        } else {
                                            $se_mark_for_total = 0;
                                        }
                                        $persentage[0] = $se_percentage;
                                        $subject_mark[0] = $se_mark;

                                        if (($se_mark <= 100) || ($se_mark ==0)) 
                                        {
                                            $totalmarks = (($se_mark_for_total/100) * $se_percentage) + ($ca_percentage_in_db * ($ca_mark_for_total/100));


                                            $overall_grade=  $this->subjectgrade->overall_grade($markingDetail['grading_method_id'],$totalmarks,false);//$grade_method__id, $mark, $is_rate
                                            $grade_point=  $this->subjectgrade->overall_grade($markingDetail['grading_method_id'],$totalmarks,true);
                                            $result_grade=  $this->subjectgrade->result_grades($is_attend,$absent_reson_approve,$se_mark_for_total,$ca_mark_for_total,$totalmarks);//$is_attend,$absent_reson_approve,$se_mark,$ca_mark,$tot
                                         

                                            try {
                                                $saveData['stu_id'] = $student_id;
                                                $saveData['subject_id'] = $subject_id;
                                                $saveData['total_mark'] = $totalmarks;
                                                $saveData['overall_grade'] = $overall_grade;
                                                $saveData['result_grade'] = $result_grade;
                                                $saveData['course_id'] = $course_id;
                                                $saveData['year_no'] = $year_no;
                                                $saveData['semester_no'] = $sem_no;
                                                $saveData['batch_id'] = $batch_no;
                                                $saveData['persentage'] = $persentage;
                                                $saveData['type_id'] = $typeId;
                                                $saveData['subject_mark'] = $subject_mark;
                                                $saveData['exam_id'] = $data['sem_exam_id'];
                                                $saveData['grade_point'] = $grade_point;
                                                $saveData['subject_point'] = $subject_credits;
                                                $saveData['repeat_val'] = '0';
                                                $saveData['mark_type'] = $mark_type;
                                                $this->exam_model->save_exam_marks($saveData,true);

                                                $saveData['status'] = 1;
                                               $this->Approval_model->bulk_se_mark_approval_level_1($saveData);
                                                $se_student_count++;
                                            } 
                                            catch (\Exception $e) {
                                                //
                                                $failed_se_student_count++;
                                                log_message('error', $e->getMessage());
                                            }


                                        }else{
                                            //invalid mark
                                        }

                                        //if(se_mark<=100 || se_mark==0 ) {
    
    
                                             // grade = overall_grade(se_mark,totalmarks,total_rounded_marks,gradeing_details,false);
                                             // grade_point = overall_grade(se_mark,ca_mark_for_total,total_rounded_marks,gradeing_details,true);
                                            // result_grade = result_grades(is_attend,absent_reson_approve,se_mark,ca_mark_for_total,total_rounded_marks,gradeing_details);
    
                                            //save_exam_marks_to_db(row, totalmarks, grade, result_grade, persentage, type_id, subject_mark, grade_point, subject_credits, mark_type);
                                            //                                    }


                                    } catch (\Exception $e) {
                                        //
                                        log_message('error', $e->getMessage());
                                    }


                                }
                            }
                        }
                    }else{
                        //student is invalid 
                        $invalid_student++;
                    }
                }

            }

             $res['status'] = 'success';
             $res['invalid_student'] = $invalid_student;
             $res['se_student_count'] = $se_student_count;
             $res['failed_se_student_count'] = $failed_se_student_count;
             $res['ca_student_count'] = $ca_student_count;
             $res['failed_ca_student_count'] = $failed_ca_student_count;
            // return $res;

           // return $res['status'] = 'success';

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
             $res['status'] = 'Failed';
            return $res;
        }
//        $data['student_registration_number'] = $this->input->post('student_registration_number');
//        $data['subject_code'] = $this->input->post('subject_code');
        return json_encode($res);

    }
}
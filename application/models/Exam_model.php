<?php

class Exam_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Subject_model');
        $this->load->model('Student_model');
    }

    function save_exam($data)
    {
        $insert_data = array(
            'exam_code' => $data['e_code'],
            'exam_name' => $data['e_name'],
            'description' => $data['des'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'exam_code' => $data['e_code'],
            'exam_name' => $data['e_name'],
            'description' => $data['des'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['exam_id'])) {
            
            $result = $this->db->insert('exm_exam', $insert_data);
            //$this->logger->systemlog('Manage Exam', 'Success', 'Exam Added successfully', date("Y-m-d H:i:s", now()),$insert_data);
        } else {
            $this->db->where('id', $data['exam_id']);
            $result = $this->db->update('exm_exam', $update_data);
            //$this->logger->systemlog('Manage Exam', 'Success', 'Exam Updated successfully', date("Y-m-d H:i:s", now()),$update_data);
        }

        return $result;
    }

    function get_all_exams()
    {
        $this->db->select('*');
        //$this->db->join('exm_semester_exam ese', 'ese.exam_id = ee.id');
        //$this->db->where('is_approved', 0);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('exm_exam ee')->result_array();
        return $result_array;
    }

    function get_exam_name_by_id($exam_id)
    {
        $this->db->select('*');
        $this->db->where('id', $exam_id);
        $result = $this->db->get('exm_exam')->row_array();
        return $result;
    }

    function change_exam_status($data)
    {
        if ($data['new_status'] == 0) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
        }
        $this->db->where('id', $data['exam_id']);
        $result = $this->db->update('exm_exam', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Exam Deactivated Successfully.');
                $this->logger->systemlog('Update Exam Status', 'Success', 'Exam Deactivated Successfully', date("Y-m-d H:i:s", now()),$update_data);
            } else {
                $this->session->set_flashdata('flashSuccess', 'Exam Activated Successfully.');
                $this->logger->systemlog('Update Exam Status', 'Success', 'Exam Activated Successfully', date("Y-m-d H:i:s", now()),$update_data);
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate Exam. Retry.');
                $this->logger->systemlog('Update Exam Status', 'Failure', 'Failed to Deactivate Exam', date("Y-m-d H:i:s", now()),$update_data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate Exam. Retry.');
                $this->logger->systemlog('Update Exam Status', 'Failure', 'Failed to Activate Exam', date("Y-m-d H:i:s", now()),$update_data);
            }
        }
    }

    function save_semester_exam($data)
    {
        $this->db->trans_begin();
        if (empty($data['s_exam_id'])) {
            //insert
            $insert_array = array(
                'exam_id' => $data['exam_id'],
                'course_id' => $data['course_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'study_season_id' => $data['season_id'],
                'batch_id' => $data['batch_id'],
                'description' => $data['s_des'],
                //'exam_id' => $data['exam_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->insert('exm_semester_exam', $insert_array);
        } else {
            //update  
            $update_array = array(
                'exam_id' => $data['exam_id'],
                'course_id' => $data['course_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'study_season_id' => $data['season_id'],
                'batch_id' => $data['batch_id'],
                'description' => $data['s_des'],
                //'exam_id' => $data['exam_id'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('id', $data['s_exam_id']);
            $this->db->update('exm_semester_exam', $update_array);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save Semester exam';
            $this->logger->systemlog('Manage Semester Exam', 'Failure', 'Failed to Save Semester Exam', date("Y-m-d H:i:s", now()),$data);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Successfully the semester exam saved for approval.';
            $this->logger->systemlog('Manage Semester Exam', 'Success', 'Semester Exam Successfully Saved', date("Y-m-d H:i:s", now()),$data);
        }
        return $res;
    }

    function get_all_semester_exams()
    {

        // $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,se.id as sem_exam_id,se.deleted as s_e_deleted');
        $this->db->join('edu_course de', 'de.id = se.course_id');
        $this->db->join('edu_batch ba', 'ba.id = se.batch_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        
        $this->db->where('se.is_approved',1);
        //$this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('exm_semester_exam se')->result_array();

        return $result_array;
    }

    function change_semester_exam_status($data)
    {
        $this->db->trans_begin();
        if ($data['new_status'] == 0) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
        }
        $this->db->where('id', $data['sem_exam_id']);
        $this->db->update('exm_semester_exam', $update_data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($data['new_status']) {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Deactivate Exam. Retry.';
                $this->logger->systemlog('Update Exam Status', 'Failure', 'Failed to Semester Deactivate Exam', date("Y-m-d H:i:s", now()),$update_data);
            } else {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Activate Exam. Retry.';
                $this->logger->systemlog('Update Exam Status', 'Failure', 'Failed to Activate Exam', date("Y-m-d H:i:s", now()),$update_data);
            }
        } else {
            $this->db->trans_commit();
            if ($data['new_status']) {
                $res['status'] = 'success';
                $res['message'] = 'Exam Deactivated Successfully.';
                $this->logger->systemlog('Update Exam Status', 'Success', 'Exam Deactivated Successfully', date("Y-m-d H:i:s", now()),$update_data);
            } else {
                $res['status'] = 'success';
                $res['message'] = 'Exam Activated Successfully.';
                $this->logger->systemlog('Update Exam Status', 'Success', 'Exam Activated Successfully', date("Y-m-d H:i:s", now()),$update_data);
            }
        }
        return $res;
    }

    function load_sem_exam_by_id($sem_exam_id)
    {
        $this->db->select('*,de.id as course_id,ba.id as batch_id,ex.id as exam_id, se.description as s_des');
        $this->db->join('edu_course de', 'de.id = se.course_id');
        $this->db->join('edu_batch ba', 'ba.id = se.batch_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.id', $sem_exam_id);
        $result_array = $this->db->get('exm_semester_exam se')->row_array();
        return $result_array;
    }

    function get_semester_exam($data, $batch_details)
    {
        $this->db->select('*, se.id as sem_exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('se.semester_no', $batch_details['current_semester']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    

    function load_mark_semester_exam($data)
    {
        $this->db->select('*, se.id as sem_exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['mrk_course']);
        $this->db->where('se.year_no', $data['mrk_year']);
        $this->db->where('se.semester_no', $data['mrk_semester']);
        $this->db->where('se.batch_id', $data['mrk_batch']);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    
    function load_mark_semester_exam_repeat($data)
    {
        $this->db->select('*, ese.id as sem_exam_id');
        $this->db->join('exm_exam ex', 'ex.id = eser.applying_exam');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id = eser.applying_exam');
        $this->db->where('ese.course_id', $data['mrk_course']);
        $this->db->where('eser.applying_year', $data['mrk_year']);
        $this->db->where('eser.applying_semester', $data['mrk_semester']);
        $this->db->where('eser.applying_batch', $data['mrk_batch']);
        $this->db->where('ese.is_approved', 1);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('eser.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ex.deleted', 0);
        $this->db->group_by('ese.id');
        
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();
        return $result_array;
    }

    function load_examtypes()
    {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_subject = $this->input->post('tt_subject');
        $tt_season = $this->input->post('tt_season');

        $this->db->select('mod_semester_subject_details.*');
        $this->db->join('mod_semester_subject', 'mod_semester_subject.id=mod_semester_subject_details.semester_subject_id');
        $this->db->join('edu_semester', 'edu_semester.id=mod_semester_subject.semester_id');
        $this->db->join('edu_year', 'edu_year.id=edu_semester.year_id');
        $this->db->where('mod_semester_subject_details.subject_id', $tt_subject);
        $this->db->where('mod_semester_subject.study_season_id', $tt_season);
        $this->db->where('mod_semester_subject.semester_no', $tt_semester);
        $this->db->where('edu_semester.year_no', $tt_year);
        $this->db->where('edu_year.course_id', $tt_course);
        $this->db->where('mod_semester_subject_details.deleted', 0);
        $markingmeths = $this->db->get('mod_semester_subject_details')->row_array();

        $this->db->where('md.marking_method_id', $markingmeths['marking_method_id']);
        $this->db->where('md.deleted', 0);
        $results['details'] = $this->db->get('mod_marking_details md')->result_array();

        $this->db->select('msv.old_version_id,csv.version_name');
        $this->db->join('cfg_subject_version csv', 'msv.old_version_id=csv.version_id');
        $this->db->where('msv.mod_subject_id', $tt_subject);
        $results['subject_versions'] = $this->db->get('mod_subject_version msv')->result_array();

        return $results;
    }

    function load_exams()
    {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_batch = $this->input->post('tt_batch');
        

        $this->db->select('exm_exam.*');
        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
        if (!empty($tt_batch)) {
            $this->db->where('exm_semester_exam.batch_id', $tt_batch);
        }
        if (!empty($tt_semester)) {
            $this->db->where('exm_semester_exam.semester_no', $tt_semester);
        }
        $this->db->where('exm_semester_exam.year_no', $tt_year);
        $this->db->where('exm_semester_exam.course_id', $tt_course);
        $this->db->where('exm_semester_exam.is_approved', 1);
        
        $exams = $this->db->get('exm_semester_exam')->result_array();

        return $exams;
    }
    
    //function load_exams_deferement($data, $batch_details)
    function load_exams_deferement($data)
    {
//        $this->db->select('*, ex.id as exam_id');
//        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
//        $this->db->where('se.course_id', $batch_details['course_id']);
//        $this->db->where('se.year_no', $batch_details['current_year']);
//        $this->db->where('se.semester_no', $batch_details['current_semester']);
//        $this->db->where('se.batch_id', $data['batch_id']);
//        $this->db->where('se.is_approved', 1);
        
        $this->db->select('*, ex.id as exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['course']);
        $this->db->where('se.year_no', $data['year']);
        $this->db->where('se.semester_no', $data['semester']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    
    function load_exams_deferement_approval()
    {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_batch = $this->input->post('tt_batch');
        $tt_center = $this->input->post('tt_center');
        
        $this->db->select('*, ex.id as exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $tt_course);
        $this->db->where('se.year_no', $tt_year);
        $this->db->where('se.semester_no', $tt_semester);
        $this->db->where('se.batch_id', $tt_batch);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    

    function savetimetbl()
    {
        $tt_description = $this->input->post('tt_description');
        $tt_exam = $this->input->post('tt_exam');
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_id = $this->input->post('tt_id');
        $tt_action = $this->input->post('tt_action');
        $tt_clonett = $this->input->post('tt_clonett');
        $tt_season = $this->input->post('tt_season');
        $tt_faculty = $this->input->post('tt_faculty');

        $tblsave['ttbl_season'] = $tt_season;
        $tblsave['ttbl_description'] = $tt_description;
        $tblsave['ttbl_exam'] = $tt_exam;
        $tblsave['ttbl_course'] = $tt_course;
        $tblsave['ttbl_year'] = $tt_year;
        $tblsave['ttbl_semester'] = $tt_semester;
        $tblsave['ttbl_status'] = 'A';
        $tblsave['ttbl_isverified'] = 0;
        $tblsave['ttbl_isconfirmed'] = 0;
        $tblsave['approved'] = 0;
        $tblsave['ttbl_faculty'] = $tt_faculty;
         if (empty($tt_id)) {
             $SQL = "SELECT
                    COUNT(tta_examtimetable.ttbl_id) as is_check
                    FROM
                    tta_examtimetable
                    WHERE
                    tta_examtimetable.ttbl_year = " . $tt_year . " 
                    AND tta_examtimetable.ttbl_semester = " . $tt_semester . " 
                    AND tta_examtimetable.ttbl_course = " . $tt_course . " 
                    AND tta_examtimetable.ttbl_exam = " . $tt_exam . " ";
             $query = $this->db->query($SQL);

             $is_check = $query->result_array();
             // return $is_check;
             foreach ($is_check as $row) {
                 $is_checkvalue = $row['is_check'];
             }
          }else{
             $is_checkvalue="0";
                 }

        if ($is_checkvalue == "0") {
            if (empty($tt_id)) {
                $tblsave['ttbl_code'] = $this->sequence->generate_sequence('ETT' . date('y'), 3);
                $tblsave['ttbl_addedon'] = date("Y-m-d H:i:s", now());
                $tblsave['ttbl_addedby'] = $this->session->userdata('u_id');
                $tblsave['ttbl_addeduname'] = $this->session->userdata('u_name');
                $result = $this->db->insert('tta_examtimetable', $tblsave);
                $tt_id = $this->db->insert_id();

                if ($tt_action == 'clone') {
                    // $this->db->where('ttlc_timetable',$tt_clonett);
                    // $Schedules = $this->db->get('hc_timetableSchedule')->result_array();
                    // foreach ($Schedules as $lect)
                    // {
                    //     $schsave['ttlc_timetable']     = $tt_id;
                    //     $schsave['ttlc_subject']       = $lect['ttlc_subject'];
                    //     $schsave['ttlc_hall']          = $lect['ttlc_hall'];
                    //     $schsave['ttlc_Scheduler']      = $lect['ttlc_Scheduler'];
                    //     $schsave['ttlc_starttime']     = $lect['ttlc_starttime'];
                    //     $schsave['ttlc_endtime']       = $lect['ttlc_endtime'];
                    //     $schsave['ttlc_status']        = 'A';
                    //     $schsave['ttlc_weekday']       = $lect['ttlc_weekday'];
                    //     $schsave['ttlc_addedon']       = date("Y-m-d H:i:s", now());
                    //     $schsave['ttlc_addedby']       = $this->session->userdata('u_id');
                    //     $schsave['ttlc_addeduname']    = $this->session->userdata('u_name');
                    //     $result = $this->db->insert('hc_timetableSchedule',$schsave);
                    // }
                }

                if ($result) {
                    $res['message'] = 'Time Table Created successfully';
                    $this->logger->systemlog('Create Time Table', 'Success', 'Time Table Created successfully : ' . $tblsave['ttbl_description'], date("Y-m-d H:i:s", now()),$tblsave);
                    $res['status'] = 'success';
                } else {
                    $res['message'] = 'Failed to create Time Table';
                    $this->logger->systemlog('Create Time Table', 'Failure', 'Failed to create Time Table : ' . $tblsave['ttbl_description'], date("Y-m-d H:i:s", now()),$tblsave);
                    $res['status'] = 'Failed';
                }
            } else {
                $tblsave['ttbl_updatedby'] = $this->session->userdata('u_id');
                $tblsave['ttbl_updateduname'] = $this->session->userdata('u_name');
                $this->db->where('ttbl_id', $tt_id);
                $result = $this->db->update('tta_examtimetable', $tblsave);

                if ($result) {
                    $res['message'] = 'Time Table Updated successfully';
                    $this->logger->systemlog('Update Time Table', 'Success', 'Time Table Updated successfully : ' . $tblsave['ttbl_description'], date("Y-m-d H:i:s", now()),$tblsave);
                    $res['status'] = 'success';
                } else {
                    $res['message'] = 'Failed to update Time Table';
                    $this->logger->systemlog('Update Time Table', 'Failure', 'Failed to update Time Table : ' . $tblsave['ttbl_description'], date("Y-m-d H:i:s", now()),$tblsave);
                    $res['status'] = 'Failed';
                }
            }

        } else {
            $res['message'] = 'Already Exists This Time Table';
            //$this->logger->systemlog('Add Schedule', 'Failure', 'Failed to add Schedule : ' . $displaytxt, date("Y-m-d H:i:s", now()));
            $res['status'] = 'Failed';
        }
        $res['tt_id'] = $tt_id;
        return $res;
    }

    function load_timetable_data()
    {
        $id = $this->input->post('id');

        $this->db->where('ttbl_id', $id);
        $tbl = $this->db->get('tta_examtimetable')->row_array();

        return $tbl;
    }

    function save_schedule()
    {
        $this->db->trans_begin();
        $tt_date = $this->input->post('tt_date');
        $tt_starttime = $this->input->post('tt_starttime');
        $tt_endtime = $this->input->post('tt_endtime');
        $tt_subject = $this->input->post('tt_subject');
        $tt_extype = $this->input->post('tt_extype');
        $tt_id = $this->input->post('tt_id');
        $tt_schedid = $this->input->post('tt_schedid');
        $displaytxt = $this->input->post('displaytxt');

        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_exam = $this->input->post('tt_exam');
        $subject_version_selected = $this->input->post('subject_version_selected');
        $subject_version = $this->input->post('subject_version');
        
        $editFlag = $this->input->post('editFlag');


        $time_temp = strtotime($tt_starttime);
        $format_starttime = date('H:i:s', $time_temp);
        $time_temp_end = strtotime($tt_endtime);
        $format_endtime = date('H:i:s', $time_temp_end);
        // $schsave['']             =
        $schsave['esch_timetable'] = $tt_id;
        $schsave['esch_subject'] = $tt_subject;
        $schsave['esch_examtype'] = $tt_extype;
        $schsave['esch_date'] = $tt_date;
        $schsave['esch_stime'] = $format_starttime;
        $schsave['esch_etime'] = $format_endtime;
        $schsave['esch_status'] = 'A';
        
        $this->db->select('type');
        $this->db->where('id', $tt_subject);
        $sub_type = $this->db->get('mod_subject')->row_array();

            /// check duplicates kasun 2018-07-16============================
        $is_checkvalue = "0";
            if($editFlag == 0){
                if($sub_type['type'] == 1) { //core subject
                    $this->db->select('count(esch_id) as is_check');
                    $this->db->join('tta_examtimetable ', 'tta_examtimetable.ttbl_id=exm_schedule.esch_timetable');
                    $this->db->where('tta_examtimetable.ttbl_exam', $tt_exam);
                    $this->db->where('exm_schedule.esch_date', $tt_date);
                    $this->db->where('exm_schedule.esch_etime > ',  $format_starttime);
                    $is_check_result = $this->db->get('exm_schedule')->row_array();
                    $is_checkvalue = $is_check_result['is_check'];
                } 
            }
            else{
                if($sub_type['type'] == 1) { //core subject
                    $this->db->select('count(esch_id) as is_check');
                    $this->db->join('tta_examtimetable ', 'tta_examtimetable.ttbl_id=exm_schedule.esch_timetable');
                    $this->db->where('tta_examtimetable.ttbl_exam', $tt_exam);
                    $this->db->where('exm_schedule.esch_date', $tt_date);
                    $this->db->where('exm_schedule.esch_etime > ',  $format_starttime);
                    $this->db->where('NOT(exm_schedule.esch_id = '.$tt_schedid.')');
                    $is_check_result = $this->db->get('exm_schedule')->row_array();
                    $is_checkvalue = $is_check_result['is_check'];
                } 
            }
        //====================================================
        if ($is_checkvalue == "0") {
            if (empty($tt_schedid)) {
                $schsave['esch_addedon'] = date("Y-m-d H:i:s", now());
                $schsave['esch_addedby'] = $this->session->userdata('u_id');
                $schsave['esch_addeduname'] = $this->session->userdata('u_name');
                $result = $this->db->insert('exm_schedule', $schsave);

                if ($result) {
                    $tt_schedid = $this->db->insert_id();
                    //save subject version
                    for($a=0;$a<sizeof($subject_version_selected);$a++){
                        $sub_ver_save['version_id'] = $subject_version_selected[$a];
                        $sub_ver_save['esch_id'] = $tt_schedid;
                        $this->db->insert('exm_schedule_subject_version', $sub_ver_save);
                    }
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $res['message'] = 'Failed to add Schedule';
                        $this->logger->systemlog('Add Schedule', 'Failure', 'Failed to add Schedule : ' . $displaytxt, date("Y-m-d H:i:s", now()),$schsave);
                        $res['status'] = 'Failed';
                    }else{
                        $this->db->trans_commit();
                    $res['message'] = 'Schedule added successfully';
                    $this->logger->systemlog('Add Schedule', 'Success', 'Schedule added successfully : ' . $displaytxt, date("Y-m-d H:i:s", now()),$schsave);
                    $res['status'] = 'success';}
                } else {
                    $res['message'] = 'Failed to add Schedule';
                    $this->logger->systemlog('Add Schedule', 'Failure', 'Failed to add Schedule : ' . $displaytxt, date("Y-m-d H:i:s", now()),$schsave);
                    $res['status'] = 'Failed';
                }
            } else {
                $schsave['esch_updatedby'] = $this->session->userdata('u_id');
                $schsave['esch_updateduname'] = $this->session->userdata('u_name');
                $this->db->where('esch_id', $tt_schedid);
                $result = $this->db->update('exm_schedule', $schsave);

                $this->db->where('esch_id', $tt_schedid);
                $this->db->delete('exm_schedule_subject_version');

                for($a=0;$a<sizeof($subject_version_selected);$a++){
                    $sub_ver_save['version_id'] = $subject_version_selected[$a];
                    $sub_ver_save['esch_id'] = $tt_schedid;
                    $this->db->insert('exm_schedule_subject_version', $sub_ver_save);
                }
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $res['message'] = 'Failed to Edit Schedule';
                    $this->logger->systemlog('Edit Schedule', 'Failure', 'Failed to Edit Schedule : ' . $displaytxt, date("Y-m-d H:i:s", now()),$schsave);
                    $res['status'] = 'Failed';

                } else {
                    $this->db->trans_commit();
                    $res['message'] = 'Schedule Edited successfully';
                    $this->logger->systemlog('Edit Schedule', 'Success', 'Schedule Edited successfully : ' . $displaytxt, date("Y-m-d H:i:s", now()),$schsave);
                    $res['status'] = 'success';

                }
            }
        } else {
            $res['message'] = 'This time period already exists';
            //$this->logger->systemlog('Add Schedule', 'Failure', 'Failed to add Schedule : ' . $displaytxt, date("Y-m-d H:i:s", now()));
            $res['status'] = 'Failed';
        }
        return $res;
    }

    function load_savedschedules()
    {
        $this->db->select('exm_schedule.*,mod_marking_details.name,,cfg_subject_version.version_name');
        $this->db->join('mod_marking_details', 'mod_marking_details.id=exm_schedule.esch_examtype');
        $this->db->join('mod_subject', 'exm_schedule.esch_subject=mod_subject.id');
        $this->db->join('cfg_subject_version', 'mod_subject.version_id =cfg_subject_version.version_id');
        $this->db->where('esch_timetable', $this->input->post('id'));
        $this->db->where('esch_status', 'A');
        $this->db->order_by('esch_date');
        $schedules = $this->db->get('exm_schedule')->result_array();




        for ($i = 0; $i < count($schedules); $i++) {
            $this->db->select('csv.version_name,essv.version_id');
            $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
            $this->db->where('essv.esch_id', $schedules[$i]['esch_id']);
            $schedules[$i]['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();
            //$result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }


        return $schedules;
    }

    function load_scheduledata()
    {
        $this->db->where('esch_id', $this->input->post('id'));
        $schedule = $this->db->get('exm_schedule')->row_array();

            $this->db->select('csv.version_name,essv.version_id');
            $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
            $this->db->where('essv.esch_id', $schedule['esch_id']);
            $schedule['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();
            //$result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();


        return $schedule;
    }

    function delete_schedule()
    {
        $id = $this->input->post('id');

        $this->db->where('esch_id', $id);
        $result = $this->db->delete('exm_schedule');
        
        $this->db->select('*');
        $this->db->where('esch_id', $id);
        $result_array = $this->db->get('exm_schedule')->row_array();

        if ($result) {
            $res['message'] = 'Schedule Removed successfully';
            $this->logger->systemlog('Remove Schedule', 'Success', 'Schedule : ' . $id . ' removed successfully', date("Y-m-d H:i:s", now()),$result_array);
            $res['status'] = 'success';
        } else {
            $res['message'] = 'Failed to Remove Schedule';
            $this->logger->systemlog('Remove Schedule', 'Failure', 'Failed to remove Schedule : ' . $id, date("Y-m-d H:i:s", now()),$result_array);
            $res['status'] = 'Failed';
        }

        return $res;
    }

    function load_exam_timetables()
    {
        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

        $this->db->select('tta_examtimetable.*,edu_course.course_code,edu_course.course_name,cfg_academicyears.ac_startdate,cfg_academicyears.ac_enddate,exm_exam.exam_code,exm_exam.exam_name');
        $this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
        $this->db->join('cfg_academicyears', 'cfg_academicyears.es_ac_year_id=tta_examtimetable.ttbl_season');
        $this->db->join('exm_exam', 'exm_exam.id=tta_examtimetable.ttbl_exam');
        $this->db->order_by('tta_examtimetable.ttbl_addedon', 'DESC');
//        $this->db->where_in('tta_examtimetable.approved', 1);
        $timetables = $this->db->get('tta_examtimetable')->result_array();

        return $timetables;
    }

    function verify_timetable()
    {
        $id = $this->input->post('id');
        $desc = $this->input->post('desc');

        $this->db->where('ttbl_id', $id);
        $result = $this->db->update('tta_examtimetable', array('ttbl_isverified' => 1));

        if ($result) {
            $res['message'] = 'Time Table verified successfully';
            $this->logger->systemlog('Verify Timetable', 'Success', 'Time Table : ' . $desc . ' verified successfully', date("Y-m-d H:i:s", now()), array('time_table'=>$id, 'description'=>$dec));
            $res['status'] = 'success';
        } else {
            $res['message'] = 'Failed to verify Time Table';
            $this->logger->systemlog('Verify Timetable', 'Failure', 'Failed to verify Time Table : ' . $desc, date("Y-m-d H:i:s", now()),array('time_table'=>$id, 'description'=>$dec));
            $res['status'] = 'Failed';
        }

        return $res;
    }

    function confirm_timetable()
    {
        $id = $this->input->post('id');
        $desc = $this->input->post('desc');

        $this->db->where('ttbl_id', $id);
        $result = $this->db->update('tta_examtimetable', array('ttbl_isconfirmed' => 1));

        if ($result) {
            $res['message'] = 'Time Table confirmed successfully';
            $this->logger->systemlog('Confirm Timetable', 'Success', 'Time Table : ' . $desc . ' confirmed successfully', date("Y-m-d H:i:s", now()),array('time_table'=>$id, 'description'=>$dec));
            $res['status'] = 'success';
        } else {
            $res['message'] = 'Failed to confirm Time Table';
            $this->logger->systemlog('Confirm Timetable', 'Failure', 'Failed to confirm Time Table : ' . $desc, date("Y-m-d H:i:s", now()),array('time_table'=>$id, 'description'=>$dec));
            $res['status'] = 'Failed';
        }

        return $res;
    }

    function delete_timetable()
    {
        $id = $this->input->post('id');
        $desc = $this->input->post('desc');

        $this->db->where('esch_timetable', $id);
        $result = $this->db->delete('exm_schedule');

        $this->db->where('ttbl_id', $id);
        $result = $this->db->delete('tta_examtimetable');

        if ($result) {
            $res['message'] = 'Time Table Deleted successfully';
            $this->logger->systemlog('Delete Timetable', 'Success', 'Time Table : ' . $desc . ' Deleted successfully', date("Y-m-d H:i:s", now()),array('time_table'=> $id, 'description'=>$desc));
            $res['status'] = 'success';
        } else {
            $res['message'] = 'Failed to confirm Time Table';
            $this->logger->systemlog('Delete Timetable', 'Failure', 'Failed to Delete Time Table : ' . $desc, date("Y-m-d H:i:s", now()),array('time_table'=> $id, 'description'=>$desc));
            $res['status'] = 'Failed';
        }

        return $res;
    }

    function save_exam_marks($data,$flag)
    {
        $res = [];
        
        if($flag)
        $this->db->trans_begin();
        $mark_id = $this->check_subject_mark_exists($data);
        
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
                    'student_id' => $data['stu_id'],
                    'course_id' => $data['course_id'],
                    'year_no' => $data['year_no'],
                    'semester_no' => $data['semester_no'],
                    'batch_id' => $data['batch_id'],
                    'sem_exam_id' => $sem_exam_id,
                    'subject_id' => $data['subject_id'],
                    'total_marks' => $data['total_mark'],
                    'overall_grade' => $data['overall_grade'],
                    'grade_point' => $data['grade_point'],
                    'subject_credit' => $data['subject_point'],
                    'result' => $data['result_grade'], 
                    'is_repeat_approve' => 0,
                    'is_repeat_mark' => 0,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())                    
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

                    if ($mark != null) {
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

                }
                if($flag){
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $res['status'] = 'Failed';
                        $res['message'] = 'Failed to save Subject marks';
                        //$this->logger->systemlog('Save Subject Marks', 'Failure', 'Failed to save Subject marks', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                    } else {
                        $this->db->trans_commit();
                        $res['status'] = 'success';
                        $res['message'] = 'Subject marks saved successfully.';
                        //$this->logger->systemlog('Save Subject Marks', 'Success', 'Subject marks saved successfully', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                    }
                //return $res;               
                }
            } else {
                //repeat delete and insert
                if($data['repeat_val'] == 1) {
                    
                    $rpt_mark_exists = $this->check_repeat_subject_exists($data);
                    
                    $is_repeat = $this->check_repeat_approve_status($data);
                    
                    if($rpt_mark_exists == NULL){
                        $mark_data = $this->get_exam_mark_details($mark_id, $data['subject_id']);
                        
                        if($data['mark_type'] == "ca_mark") {
                            $exam_mark_hod = 0;
                            $exam_mark_director = 0;

                            $exam_mark_detail_hod = 0;
                            $exam_mark_detail_hod_approve_by = 0;
                            $exam_mark_detail_hod_approve_date = "";

                            $exam_mark_detail_director = 0;
                            $exam_mark_detail_director_approve_by = 0;
                            $exam_mark_detail_director_approve_date = "";      
                        }
                        else {
                            $exam_mark_hod = $mark_data[0]['mark_hod_mark_aproved'];
                            $exam_mark_director = $mark_data[0]['mark_director_mark_approved'];
                        }
                    
                        //delete
                        $mark_delete = array(
                            'deleted' => 1,
                            'deleted_by' => $this->session->userdata('u_id'),
                            'deleted_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->where('id', $mark_id);
                        $this->db->update('exm_mark', $mark_delete);


                        $mark_detail_delete = array(
                            'deleted' => 1,
                            'deleted_by' => $this->session->userdata('u_id'),
                            'deleted_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->where('exam_mark_id', $mark_id);
                        $this->db->update('exm_mark_details', $mark_detail_delete);

                        //insert
                        //insert to exm_exam_mark
                        $insert_exam_mark = array(
                            'student_id' => $data['stu_id'],
                            'course_id' => $data['course_id'],
                            'year_no' => $data['year_no'],
                            'semester_no' => $data['semester_no'],
                            'batch_id' => $data['batch_id'],
                            'sem_exam_id' => $sem_exam_id,
                            'subject_id' => $data['subject_id'],
                            'total_marks' => $data['total_mark'],
                            'overall_grade' => $data['overall_grade'],
                            'grade_point' => $data['grade_point'],
                            'subject_credit' => $data['subject_point'],
                            'result' => $data['result_grade'],                       
                            'is_recorrection' => 0,
                            'is_recorrection_approved' => 0,
                            'recorrection_approved_by' => 0,
                            'recorrection_approved_on' => "",
                            'is_hod_mark_aproved' => $exam_mark_hod,
                            'is_director_mark_approved' => $exam_mark_director,
                            'is_ex_director_mark_approved' => 0,
                            'exam_status' => $mark_data[0]['mark_exam_status'],
                            'is_repeat_approve' => $is_repeat,
                            'is_repeat_mark' => 1,                        
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->insert('exm_mark', $insert_exam_mark);
                        $max_exam_mark_id = $this->get_max_exam_mark_id();

                        //insert to exm_exam_mark_details
                        for ($i = 0; $i < count($data['persentage']); $i++) {
                            
                            if($data['mark_type'] == "se_mark"){
                                $exam_mark_detail_hod = $mark_data[$i]['is_hod_mark_aproved'];
                                $exam_mark_detail_hod_approve_by = $mark_data[$i]['hod_mark_aproved_by'];
                                $exam_mark_detail_hod_approve_date = $mark_data[$i]['hod_mark_aproved_date'];

                                $exam_mark_detail_director = $mark_data[$i]['is_director_mark_approved'];
                                $exam_mark_detail_director_approve_by = $mark_data[$i]['director_mark_approved_by'];
                                $exam_mark_detail_director_approve_date = $mark_data[$i]['director_mark_approved_date']; 
                            }                                                                            
                            
                            if($data['subject_mark'][$i] == '' || $data['subject_mark'][$i] == null || $data['overall_grade'] == 'AB'){
                                $save_mark = null;
                            } else {
                                $save_mark = $data['subject_mark'][$i];
                            }

                            $insert_mark_details = array(
                                'exam_mark_id' => $max_exam_mark_id,
                                'exam_type_id' => $data['type_id'][$i],
                                'persentage' => $data['persentage'][$i],
                                'mark' => $save_mark,                            
                                'is_hod_mark_aproved' => $exam_mark_detail_hod,
                                'hod_mark_aproved_by' => $exam_mark_detail_hod_approve_by,
                                'hod_mark_aproved_date' => $exam_mark_detail_hod_approve_date,
                                'is_director_mark_approved' => $exam_mark_detail_director,
                                'director_mark_approved_by' => $exam_mark_detail_director_approve_by,
                                'director_mark_approved_date' => $exam_mark_detail_director_approve_date,
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
                                log_message("1");
                                //$this->logger->systemlog('Save Subject Marks', 'Failure', 'Failed to update Repeat Subject marks', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                            } else {
                                $this->db->trans_commit();
                                $res['status'] = 'success';
                                $res['message'] = 'Subject marks saved successfully.';
                                log_message("1");
                                //$this->logger->systemlog('Save Subject Marks', 'Success', 'Repeat Subject marks updated successfully', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                            }
                        //return $res;
                        }
                    }
                    else{
                        $res = $this->update_mark_data($data, $mark_id, $sem_exam_id, true);
                    }  
                } else {
                    $res = $this->update_mark_data($data, $mark_id, $sem_exam_id, true);
                }
            }
        }
        return $res;
    }
    
    
    function update_mark_data($data, $mark_id, $sem_exam_id, $flag){

        //update 
        //exm_exam_mark
        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $sem_exam_id,
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'grade_point' => $data['grade_point'],
            'subject_credit' => $data['subject_point'],
            'result' => $data['result_grade'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        //update hc_mark_details
        $existing_detail_ids = $this->get_mark_detail_to_save_mark($mark_id,$data['type_id'][0]);


        if(sizeof($existing_detail_ids) >0)
        {
            foreach ($existing_detail_ids as $existing_detail_id) {
               // if ($existing_detail_id['exam_type_id'] == $data['type_id'][0] ) {
                    for ($i = 0; $i < count($data['persentage']); $i++) {
                        if($data['subject_mark'][$i] == '' || $data['subject_mark'][$i] == null || $data['overall_grade'] == 'AB'){
                            $save_mark = null;
                        } else {
                            $save_mark = $data['subject_mark'][$i];
                        }
                        $update_mark_details = array(
                            'exam_mark_id' => $mark_id,
                            'exam_type_id' => $data['type_id'][$i],
                            'persentage' => $data['persentage'][$i],
                            'mark' => $save_mark,
                            'updated_by' => $this->session->userdata('u_id'),
                            'updated_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->where('id', $existing_detail_id['id']);
                        $this->db->update('exm_mark_details', $update_mark_details);
                    }
               // } 
            }
        }else {
            for ($i = 0; $i < count($data['persentage']); $i++) {
                if($data['subject_mark'][$i] == '' || $data['subject_mark'][$i] == null || $data['overall_grade'] == 'AB'){
                    $save_mark = null;
                } else {
                    $save_mark = $data['subject_mark'][$i];
                }

                if ($save_mark != '') {
                    $insert_mark_details = array(
                        'exam_mark_id' => $mark_id,
                        'exam_type_id' => $data['type_id'][$i],
                        'persentage' => $data['persentage'][$i],
                        'mark' => $save_mark,
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $this->db->insert('exm_mark_details', $insert_mark_details);
                }
            }
        }


        if($flag){
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to update Subject marks';
                //$this->logger->systemlog('Subject Mark Update', 'Failure', 'Failed to update Subject marks', date("Y-m-d H:i:s", now()),$update_exam_mark);
            } else {
                $this->db->trans_commit();
                $res['status'] = 'success';
                $res['message'] = 'Subject marks updated successfully.';
                //$this->logger->systemlog('Subject Mark Update', 'Success', 'Subject marks updated successfully', date("Y-m-d H:i:s", now()),$update_exam_mark);
            }
            return $res;        
        }
    }
    
    
    

    function get_mark_detail_id_by_mark_id($exam_mark_id)
    {
        $this->db->select('count(id)');
        $this->db->where('exam_mark_id', $exam_mark_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get('exm_mark_details')->row_array();
        return $result;
    }
    function get_mark_detail_to_save_mark($exam_mark_id,$exam_type_id)
    {
        $this->db->select('*');
        $this->db->where('exam_mark_id', $exam_mark_id);
        $this->db->where('exam_type_id', $exam_type_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get('exm_mark_details')->result_array();
        return $result;
    }
    
    function get_exam_mark_details($mark_id, $subject_id){
        $this->db->select('em.id as mark_id, em.is_recorrection as mark_recorrection, em.is_recorrection_approved as mark_recorrection_approved, em.recorrection_approved_by as mark_recorrection_approve_by, em.recorrection_approved_on as mark_recorrection_approve_on,'
                . 'em.is_hod_mark_aproved as mark_hod_mark_aproved, em.is_director_mark_approved as mark_director_mark_approved, em.is_ex_director_mark_approved as mark_ex_director_mark_approved,'
                . 'em.exam_status as mark_exam_status, em.is_repeat_approve as mark_repeat_approve, emd.*');
        $this->db->join('exm_mark_details emd', 'emd.exam_mark_id = em.id');
        $this->db->where('em.id', $mark_id);
        $this->db->where('em.subject_id', $subject_id);
        $this->db->where('em.deleted', 0);
        $this->db->where('emd.deleted', 0);
        $result = $this->db->get('exm_mark em')->result_array();
        return $result;
    }

    function get_ids__mark_detail_id_by_mark_id($exam_mark_id)
    {
        $this->db->select('id');
        $this->db->where('exam_mark_id', $exam_mark_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get('exm_mark_details')->result_array();
        return $result;
    }

    function get_max_exam_mark_id()
    {
        $this->db->select('max(id)');
        $this->db->from('exm_mark');
        $result = $this->db->get()->result_array();
        foreach ($result as $row) {
            return $row['max(id)'];
        }
    }

    function get_semester_exam_id($data)
    {
        $this->db->select('*');
       $this->db->where('exam_id', $data['exam_id']);
        //$this->db->where('id', $data['exam_id']);
        $this->db->where('course_id', $data['course_id']);
        $this->db->where('year_no', $data['year_no']);
        $this->db->where('semester_no', $data['semester_no']);
        $this->db->where('batch_id', $data['batch_id']);
        $row_array = $this->db->get('exm_semester_exam')->row_array();
        if (!empty($row_array)) {
            return $row_array['id'];
        } else {
            return NULL;
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
        $this->db->where('student_id', $data['stu_id']);
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
    
    
    function check_repeat_subject_exists($data){
        $this->db->select('*');
        $this->db->where('student_id', $data['stu_id']);
        $this->db->where('course_id', $data['course_id']);
        $this->db->where('year_no', $data['year_no']);
        $this->db->where('semester_no', $data['semester_no']);
        $this->db->where('batch_id', $data['batch_id']);
        $this->db->where('sem_exam_id', $data['exam_id']);
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
    
    
    function check_repeat_approve_status($data){
        $this->db->select('*');
        $this->db->where('esr.stu_id', $data['stu_id']);
        $this->db->where('esr.subject_id', $data['subject_id']);
        $this->db->where('esr.semester_exam_id', $data['exam_id']);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('exm_semester_exam_details_repeat esr')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
                return $result_array['is_repeat_approved'];
            //}
        } else {
            return NULL;
        }
    }
    
    

    function applied_exams_for_lookup($data)
    {

        $this->db->select('*, se.deleted as sem_ex_deleted, se.id as sem_ex_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['course_id']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.deleted', 0);
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }

    function load_applied_students($data)
    {
        $this->db->select('*, sed.is_approved as exam_approved');
        $this->db->join('stu_reg stu', 'stu.stu_id = sed.student_id');
        $this->db->join('mod_subject co', 'co.id = sed.subject_id');
        $this->db->where('sed.semester_exam_id', $data['sem_exam_id']);
        $this->db->where('stu.center_id', $data['branch']);
        if ($data['access_level'] == 5)
            $this->db->where('stu.stu_id', $data['stu_id']);
        $result_array = $this->db->get('exm_semester_exam_details sed')->result_array();
//        print_r($result_array);
        return $result_array;
    }

    function load_schedules()
    {
        $final_schedules = [];
        
        $eh_course = $this->input->post('eh_course');
        $eh_year = $this->input->post('eh_year');
        $eh_semester = $this->input->post('eh_semester');
        $eh_exam = $this->input->post('eh_exam');
        $eh_batch = $this->input->post('eh_batch');
        $eh_season = $this->input->post('eh_season');
        $eh_branch = $this->input->post('eh_branch');
        $selected_type = $this->input->post('selected_type');

        $this->db->select('*');
        $this->db->where('ttbl_exam', $eh_exam);
        $this->db->where('ttbl_course', $eh_course);
        $this->db->where('ttbl_season', $eh_season);
        $this->db->where('ttbl_year', $eh_year);
        $this->db->where('ttbl_semester', $eh_semester);
        $this->db->where('ttbl_status', 'A');
        $this->db->where('approved', 1);
        //$this->db->where('ttbl_isverified', 1);
        //$this->db->where('ttbl_isconfirmed', 1);
        //$this->db->where('ttbl_faculty', $eh_faculty);
        $timetables = $this->db->get('tta_examtimetable')->result_array();

        $x = 0;
        foreach ($timetables as $tbl) {   
            
            $this->db->select('exm_schedule.*,mod_marking_details.name,mod_subject.code,mod_subject.subject, mod_marking_details.marking_method_id');
            $this->db->join('mod_subject', 'mod_subject.id=exm_schedule.esch_subject');
            $this->db->join('mod_marking_details', 'mod_marking_details.id=exm_schedule.esch_examtype');
            $this->db->where('esch_timetable', $tbl['ttbl_id']);
            $this->db->where('esch_status', 'A');
            $this->db->order_by('esch_date');
            $schedules = $this->db->get('exm_schedule')->result_array();
            
            $z = 0;
            foreach ($schedules as $sch) {
                $marking_methods = $this->get_timetable_subj_marking_details($sch['marking_method_id']);

                if($selected_type == 1){
                    if(count($marking_methods) == 1 && $marking_methods[0]['type_id'] == 2){
                        $final_schedules[$z] = $sch;
                        $z++;
                    }
                }
                else{
                    if(count($marking_methods) > 1){
                        $final_schedules[$z] = $sch;
                        $z++;
                    }
                }
            }

            if (isset($_POST['reqby']) && $_POST['reqby'] == 'attendance') {
                $y = 0;
                foreach ($final_schedules as $sched) {
                    $halls = $this->load_halls($eh_branch, $eh_season, $eh_course, $eh_year, $eh_semester, $eh_exam, $sched['esch_id']);
                    $final_schedules[$y]['halls'] = $halls;
                    $y++;
                }
            }

            $timetables[$x]['schedules'] = $final_schedules;
            $x++;
        }

        return $timetables;
    }
    
    
    function get_timetable_subj_marking_details($mrk_method_id)
    {
        $this->db->select('id,type_id,marking_method_id');
        $this->db->where('marking_method_id',$mrk_method_id);
        $this->db->where('deleted',0);
        $result_array = $this->db->get('mod_marking_details')->result_array();
        return $result_array;
    }
    

    function load_hallstudent_list()
    {
        $eh_course = $this->input->post('eh_course');
        $eh_year = $this->input->post('eh_year');
        $eh_semester = $this->input->post('eh_semester');
        $eh_exam = $this->input->post('eh_exam');
        $eh_season = $this->input->post('eh_season');
        $eh_branch = $this->input->post('eh_branch');
        $id = $this->input->post('id');
        $subject = $this->input->post('subject');
        //$eh_faculty = $this->input->post('eh_faculty');

        $halls = $this->load_halls($eh_branch, $eh_season, $eh_course, $eh_year, $eh_semester, $eh_exam, $id, $subject);

        $x = 0;
        foreach ($halls as $hall) {
            $halls[$x]['hallstu'] = $this->load_hallstudents($hall['ehall_id']);
            $x++;
        }

        $nohallstulist = $this->load_nohallstudents($eh_exam, $subject, $eh_branch);
        
        $all = array(
            "halls" => $halls,
            "nohallstulist" => $nohallstulist
        );

        return $all;
    }

    function load_halls($eh_branch, $eh_season, $eh_course, $eh_year, $eh_semester, $eh_exam, $id)
    {
        $this->db->select('exm_hall.*,cfg_hall.hall_name');
        $this->db->join('cfg_hall', 'cfg_hall.id=exm_hall.ehall_hall');
        $this->db->where('ehall_branch', $eh_branch);
        $this->db->where('ehall_season', $eh_season);
        $this->db->where('ehall_course', $eh_course);
        $this->db->where('ehall_year', $eh_year);
        $this->db->where('ehall_semester', $eh_semester);
        $this->db->where('ehall_exam', $eh_exam);
        $this->db->where('ehall_schedule', $id);
        $this->db->where('ehall_status', 'A');
        $halls = $this->db->get('exm_hall')->result_array();

        return $halls;
    }

    function load_hallstudents($hall)
    {
        //exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name
        $this->db->select('*,exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name');
        $this->db->join('stu_reg','stu_reg.stu_id=exm_semester_exam_details.student_id');
        $this->db->where('hall_id', $hall);
        $this->db->where('is_attend',0);
        // $this->db->where('subject_id',$subject);
        $stulist = $this->db->get('exm_semester_exam_details')->result_array();

        return $stulist;
    }
    
    function load_student_subjectwise($id,$exam_id, $center_id,$batch_id){
        //exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name
        $this->db->select('*,exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name');
        $this->db->join('stu_reg','stu_reg.stu_id=exm_semester_exam_details.student_id');
        $this->db->join('exm_semester_exam','exm_semester_exam.id = exm_semester_exam_details.semester_exam_id');
        
        $this->db->where('stu_reg.center_id',$center_id);
        $this->db->where('exm_semester_exam_details.subject_id', $id);
        $this->db->where('exm_semester_exam.batch_id', $batch_id);
        $this->db->where('exm_semester_exam.exam_id', $exam_id);
        $this->db->where('exm_semester_exam_details.is_approved',2);
        //JOIN `exm_semester_exam` ON `exm_semester_exam`.`id` = `exm_semester_exam_details`.semester_exam_id
        $this->db->where('exm_semester_exam_details.is_attend',0);
        $this->db->where('stu_reg.deleted',0);
        // $this->db->where('subject_id',$subject);
        $stulist = $this->db->get('exm_semester_exam_details')->result_array();

        return $stulist;
    }
    
    
    function load_repeat_student_subjectwise($id,$exam_id, $center_id,$batch_id){
        //exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name
        $this->db->select('*,eser.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name');
        $this->db->join('stu_reg','stu_reg.stu_id=eser.stu_id');
        $this->db->join('exm_semester_exam','exm_semester_exam.exam_id = eser.semester_exam_id');
        
        $this->db->where('stu_reg.center_id',$center_id);
        $this->db->where('eser.subject_id', $id);
        $this->db->where('exm_semester_exam.batch_id', $batch_id);
        $this->db->where('eser.semester_exam_id', $exam_id);
        $this->db->where('eser.is_repeat',1);
        $this->db->where('eser.is_repeat_approved',1);
        //JOIN `exm_semester_exam` ON `exm_semester_exam`.`id` = `exm_semester_exam_details`.semester_exam_id
        $this->db->where('eser.is_attend',0);
        $this->db->where('eser.deleted',0);
        $this->db->where('stu_reg.deleted',0);
        // $this->db->where('subject_id',$subject);
        $this->db->order_by('stu_reg.reg_no', 'ASC');
        
        $stulist = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        return $stulist;
    }

    function load_nohallstudents($eh_exam, $subject, $eh_branch)
    {
        //exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name
        $this->db->select('*,exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name');
        $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
        $this->db->join('exm_semester_exam', 'exm_semester_exam.id = exm_semester_exam_details.semester_exam_id');
                
        $this->db->where('exm_semester_exam.exam_id', $eh_exam);
        $this->db->where('center_id', $eh_branch);
        $this->db->where('subject_id', $subject);
        $this->db->where('hall_id');
        $nohallstulist = $this->db->get('exm_semester_exam_details')->result_array();

        return $nohallstulist;
    }

    function update_hall_students()
    {
        $eh_course = $this->input->post('eh_course');
        $eh_year = $this->input->post('eh_year');
        $eh_semester = $this->input->post('eh_semester');
        $eh_exam = $this->input->post('eh_exam');
        $eh_season = $this->input->post('eh_season');
        $eh_branch = $this->input->post('eh_branch');
        $id = $this->input->post('eh_schedule');
        $eh_hall = $this->input->post('eh_hall');
        $hallstudent = $this->input->post('hallstudent');
        $eh_subject = $this->input->post('eh_subject');

        $this->db->trans_begin();

        $this->db->where('ehall_branch', $eh_branch);
        $this->db->where('ehall_season', $eh_season);
        $this->db->where('ehall_course', $eh_course);
        $this->db->where('ehall_year', $eh_year);
        $this->db->where('ehall_semester', $eh_semester);
        $this->db->where('ehall_exam', $eh_exam);
        $this->db->where('ehall_schedule', $id);
        $this->db->where('ehall_hall', $eh_hall);
        $hallexist = $this->db->get('exm_hall')->row_array();

        $ehallsave['ehall_status'] = 'A';

        if (empty($hallexist)) {
            $ehallsave['ehall_branch'] = $eh_branch;
            $ehallsave['ehall_season'] = $eh_season;
            $ehallsave['ehall_course'] = $eh_course;
            $ehallsave['ehall_year'] = $eh_year;
            $ehallsave['ehall_semester'] = $eh_semester;
            $ehallsave['ehall_exam'] = $eh_exam;
            $ehallsave['ehall_schedule'] = $id;
            $ehallsave['ehall_hall'] = $eh_hall;
            $ehallsave['ehall_addedon'] = date("Y-m-d H:i:s", now());
            $ehallsave['ehall_addedby'] = $this->session->userdata('u_id');
            $ehallsave['ehall_addeduname'] = $this->session->userdata('u_name');

            $this->db->insert('exm_hall', $ehallsave);
            $ehall_id = $this->db->insert_id();
        } else {
            $ehallsave['ehall_updatedby'] = $this->session->userdata('u_id');
            $ehallsave['ehall_updateduname'] = $this->session->userdata('u_name');

            $this->db->where('ehall_id', $hallexist['ehall_id']);
            $this->db->update('exm_hall', $ehallsave);
            $ehall_id = $hallexist['ehall_id'];
        }

        foreach ($hallstudent as $stu) {
            $this->db->where('id', $stu);
            $this->db->update('exm_semester_exam_details', array('hall_id' => $ehall_id));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save exam hall';
            //$this->logger->systemlog('Config Exam Hall', 'Failure', 'Failed to save exam hall', date("Y-m-d H:i:s", now()),$ehallsave);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Exam hall saved successfully.';
            //$this->logger->systemlog('Config Exam Hall', 'Success', 'Exam hall saved successfully.', date("Y-m-d H:i:s", now()),$ehallsave);
        }
        return $res;
    }

    function remove_hall()
    {
        $id = $this->input->post('id');

        $this->db->trans_begin();

        $this->db->where('hall_id', $id);
        $this->db->update('exm_semester_exam_details', array('hall_id' => NULL));

        $this->db->where('ehall_id', $id);
        $this->db->update('exm_hall', array('ehall_status' => 'D'));
        
        $this->db->select('*');
        $this->db->where('ehall_id', $id);
        $row_array = $this->db->get('exm_hall')->row_array();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Remove Exam Hall';
            //$this->logger->systemlog('Remove Exam Hall', 'Failure', 'Failed to remove exam hall', date("Y-m-d H:i:s", now()),$row_array);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Exam hall Removed successfully.';
            //$this->logger->systemlog('Remove Exam Hall', 'Success', 'Exam hall Removed successfully.', date("Y-m-d H:i:s", now()),$row_array);
        }
        return $res;
    }

    function remove_hall_student()
    {
        $id = $this->input->post('id');

        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->update('exm_semester_exam_details', array('hall_id' => NULL));
        
        $this->db->select('*');
        $this->db->where('id', $id);
        $row_array = $this->db->get('exm_semester_exam_details')->row_array();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Remove Student from Exam Hall';
            //$this->logger->systemlog('Remove Student from Exam Hall', 'Failure', 'Failed to remove Student from exam hall', date("Y-m-d H:i:s", now()),$row_array);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Student Removed from Exam hall successfully.';
            //$this->logger->systemlog('Remove Student from Exam Hall', 'Success', 'Student Removed from Exam hall successfully.', date("Y-m-d H:i:s", now()),$row_array);
        }
        return $res;
    }

    function update_exam_attendance()
    {
        $id = $this->input->post('ehall');
        //$subject_id = $this->input->post('subject_id');
        $stulist = $this->input->post('hallstudent');       
        $is_repeat = $this->input->post('is_repeat');
        
        $subj_id = $this->input->post('subj');
        $exm_id = $this->input->post('exm');

        $this->db->trans_begin();

        //$this->db->where('hall_id', $id);
        //$this->db->update('exm_semester_exam_details', array('is_attend' => 0));

        $studentIDs = '';
        foreach ($stulist as $stu) {
            
            if($is_repeat == 1){
                $this->db->where('exm_semester_exam_details_repeat_id', $stu);
                $this->db->update('exm_semester_exam_details_repeat', array('is_attend' => 1));
                
                $this->db->where('semester_exam_id', $exm_id);
                //$this->db->where('subject_id', $subj_id);
                $this->db->update('exm_semester_exam_details_repeat', array('is_exam_held' => 1));
            }
            else{
                $this->db->where('id', $stu);
                $this->db->update('exm_semester_exam_details', array('is_attend' => 1));
                
                $this->db->select('id');
                $this->db->where('exam_id', $exm_id);
                $exm_sem_exm_data = $this->db->get('exm_semester_exam')->row_array();
                if (!empty($exm_sem_exm_data)) {
                    //foreach ($result_array as $row) {
                        $exm_sem_exm_id = $exm_sem_exm_data['id'];
                    //}
                } 
           
                $this->db->where('semester_exam_id', $exm_sem_exm_id);
                //$this->db->where('subject_id', $subj_id);
                $this->db->update('exm_semester_exam_details', array('is_exam_held' => 1));
            }
            $studentIDs .= $stu;
        }

        $return_array = array ('Student IDs'=>$studentIDs,'Hall ID' =>$id,'is Attend'=>1);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            //$res['subject_id'] = $subject_id;
            $res['message'] = 'Failed to update attendance';
            //$this->logger->systemlog('Update Exam Attendance', 'Failure', 'Failed to update exam attendance!', date("Y-m-d H:i:s", now()),$return_array);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            //$res['subject_id'] = $subject_id;
            $res['message'] = 'Exam Attendance updated successfully.';
            //$this->logger->systemlog('Update Exam Attendance', 'Success', 'Exam Attendance updated successfully!', date("Y-m-d H:i:s", now()),$return_array);
        }
        return $res;
    }


    function load_repeat_semester_exam()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $this->db->select('*, ee.id as exmid, em.id as mark_id');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id=em.sem_exam_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');
        
        $this->db->where_in('em.result', array('C-','D+','D','E', 'DFR','I(SE)','I(CA)','INC','AB','N/E'));
        if($ug_level == 5){
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        
        $this->db->where('em.batch_id', $this->input->post('rptbatch'));
        $this->db->where('em.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ee.deleted', 0);
        $this->db->where('ese.release_result', 1);
        $this->db->group_by('em.sem_exam_id');
        $exams = $this->db->get('exm_mark em')->result_array();
        if ($exams) {
            return $exams;
        } else {
            return NULL;
        }
    }
    
    
    
    function load_repeat_exam_to_apply_exam()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
//        $this->db->select('esed.no_of_attempts, ee.id as examid, ee.exam_code, ee.exam_name');
//        $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
//        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');
//        if($ug_level == 5){
//            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
//        }
//        
//        //$this->db->where('em.batch_id', $this->input->post('rptbatch'));
//        $this->db->where('ese.year_no', $this->input->post('rptyear'));
//        $this->db->where('ese.semester_no', $this->input->post('rptsemester'));
//        $this->db->where('ese.deleted', 0);
//        $this->db->where('ee.deleted', 0);
//        $this->db->where('ese.release_result', 1);
//        $this->db->group_by('ee.id');
//        $stu_exam_data = $this->db->get('exm_semester_exam_details esed')->result_array();
//        
//        
//        
//        //---------
        
        $this->db->select('*, ee.id as exmid, em.id as mark_id');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id=em.sem_exam_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');
        
        $this->db->where_in('em.result', array('C-','D+','D','E', 'DFR','I(SE)','I(CA)','INC','AB','N/E','Fail'));
        if($ug_level == 5){
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        
        //$this->db->where('em.batch_id', $this->input->post('rptbatch'));
        $this->db->where('ese.year_no', $this->input->post('rptyear'));
        $this->db->where('ese.semester_no', $this->input->post('rptsemester'));
        $this->db->where('em.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ee.deleted', 0);
        $this->db->where('ese.release_result', 1);
        $this->db->group_by('em.sem_exam_id');
        $exams = $this->db->get('exm_mark em')->result_array();
        if ($exams) {
            return $exams;
        } else {
            return NULL;
        }
    }
    
    
    function rpt_load_students()
    {
        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('stu_reg sr', 'sr.stu_id=esedr.stu_id');
        $this->db->join('exm_semester_exam_details esed', 'esedr.exm_semester_exam_details=esed.id');
        $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.course_id', $this->input->post('rptCourse'));
        $this->db->where('esedr.applying_year', $this->input->post('rptYear'));
        $this->db->where('esedr.applying_semester', $this->input->post('rptSemester'));
        $this->db->where('esedr.applying_batch', $this->input->post('rptBatch'));
       // $this->db->where('em.sem_exam_id', $this->input->post('rptExam'));
        $this->db->where('sr.center_id', $this->input->post('rptCenter'));
        //$this->db->where('co.is_training_apply', 0);
        $this->db->where('esedr.is_repeat', 0);
        $this->db->where('esedr.is_repeat_approved', 0);
        $this->db->where('esedr.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('esed.deleted', 0);

       // $this->db->where_in('em.result', array('C-','D','D-','E','DFR'));
        $this->db->where('sr.deleted', 0);   
       // $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = em.student_id and is_repeat = 1))');
       // $this->db->where('NOT(EXISTS(select stu_id from exm_semester_exam_details_repeat where stu_id = em.student_id and deleted = 0))');
        $this->db->group_by('sr.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $exams = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();

        //===============================load semester subjects ======================================

        $this->db->select('esedr.subject_id,co.`code`,co.`subject`');
        $this->db->join('exm_semester_exam_details esed', 'esedr.exm_semester_exam_details=esed.id');
        $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
        $this->db->join('mod_subject co', 'co.id = esedr.subject_id');
        $this->db->where('ese.course_id', $this->input->post('rptCourse'));
        $this->db->where('esedr.applying_year', $this->input->post('rptYear'));
        $this->db->where('esedr.applying_semester', $this->input->post('rptSemester'));
        $this->db->where('esedr.applying_batch', $this->input->post('rptBatch'));
        //$this->db->where('co.is_training_apply', 0);
        $this->db->where('esedr.is_repeat', 0);
        $this->db->where('esedr.is_repeat_approved', 0);
        $this->db->where('esedr.deleted', 0);
        $this->db->group_by('esedr.subject_id');
        $temp = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();

        //===============================End load semester subjects ======================================

        for ($i = 0; $i < count($exams); $i++) {  //put only all subjects to one array..
            $this->db->select('*');
            $this->db->where('esedr.stu_id', $exams[$i]['student_id']);
            $this->db->where('esedr.is_repeat', 0);
            $this->db->where('esedr.is_repeat_approved', 0);
            $this->db->where('esedr.deleted', 0);
            $exams[$i]['repeat_subject']=$this->db->get('exm_semester_exam_details_repeat esedr')->result_array();




            /*$this->db->select('em.subject_id,em.overall_grade,esed.no_of_attempts');
            $this->db->join('exm_semester_exam_details esed', 'esed.subject_id=em.subject_id');
            $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
            $this->db->where('em.student_id', $exams[$i]['student_id']);
            $this->db->where('esed.student_id', $exams[$i]['student_id']);
            $this->db->where('em.course_id', $this->input->post('rptCourse'));
            $this->db->where('ese.course_id', $this->input->post('rptCourse'));
            $this->db->where('em.year_no', $this->input->post('rptYear'));
            $this->db->where('ese.year_no', $this->input->post('rptYear'));
            $this->db->where('em.semester_no', $this->input->post('rptSemester'));
            $this->db->where('ese.semester_no', $this->input->post('rptSemester'));
            $this->db->where('em.batch_id', $this->input->post('rptBatch'));
            $this->db->where('ese.batch_id', $this->input->post('rptBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('rptExam'));
            $this->db->where('ese.exam_id', $this->input->post('rptExam'));
            $this->db->where('esed.deleted', 0);
            $exams[$i]['subject_maks']=$this->db->get('exm_mark em')->result_array();*/


        }
        
        
        
        
        if ($exams) {

            return array('students'=>$exams,'sem_sub'=>$temp);
        } else {
            return NULL;
        }
    }

    function load_repeat_students()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $rcenter = $this->input->post('rptCenter');
        $rcourse = $this->input->post('rptCourse');
        $ryear = $this->input->post('rptYear');
        $rsemester = $this->input->post('rptSemester');
        $rbatch = $this->input->post('rptBatch');
        $rexam = $this->input->post('rptExam');        
        
        $this->db->select('*');
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->where('em.course_id', $rcourse);
        $this->db->where('em.year_no', $ryear);
        $this->db->where('em.semester_no', $rsemester);
    //    $this->db->where('em.batch_id', $rbatch);
        $this->db->where('em.sem_exam_id', $rexam);
        $this->db->where('sr.center_id', $rcenter);
        $this->db->where_in('em.result', array('C-','D+','D','E', 'DFR','I(SE)','I(CA)','INC','AB','N/E','Fail'));
        $this->db->where('sr.deleted', 0); 
        $this->db->where('sr.approved', 1); 
        $this->db->where('em.deleted', 0); 
        if($ug_level == 5){
            $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->where('NOT(EXISTS(select stu_id from exm_semester_exam_details_repeat where stu_id = `em`.`student_id` and deleted = 0 and subject_id = em.subject_id and applying_batch = '.$rbatch.' and applying_year = '.$ryear.' and applying_semester = '.$rsemester.' and applying_exam = '.$rexam.'))');
       // $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = em.student_id and is_repeat = 1))');
       // $this->db->where('NOT(EXISTS(select stu_id from exm_semester_exam_details_repeat where stu_id = em.student_id and deleted = 0))');
        //$this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = `em`.`student_id` and subject_id = em.subject_id and (is_repeat = 1 or is_repeat = 3)))');      
        //$this->db->where('IF(em.result = "AB", EXISTS(select student_id from exm_semester_exam_details where student_id = em.student_id and (is_absent = 1 and is_absent_approve = 0 or is_absent = 0) and subject_id = em.subject_id), null)');
        $this->db->group_by('em.student_id');
        $exams = $this->db->get('exm_mark em')->result_array();

//===============================load semester subjects ======================================
        $data['batch_id'] = $this->input->post('rptBatch');
        $data['year_no'] = $this->input->post('rptYear');
        $data['semester_no'] = $this->input->post('rptSemester');
        $data['course_id'] = $this->input->post('rptCourse');
        $temp= $this->Subject_model->semester_subjects_by_semester($data);
          
        for ($j = 0; $j < (count($temp)-1); $j++) {
            $this->db->select('is_training_apply, id');
            $this->db->where('id', $temp[$j]['subject_id']);
            $subject_apply_data = $this->db->get('mod_subject')->row_array();
            
            if($subject_apply_data['is_training_apply'] == 1){
                $temp[$j]['marking_details'] = $this->get_relevent_training_marking_details($data['course_id'], $data['year_no'], $data['semester_no'], $data['batch_id'], $temp[$j]['subject_id']);
            }
            else{
                $temp[$j]['marking_details'] = $this->Student_model->get_relevent_marking_details($data['course_id'], $data['year_no'], $data['semester_no'], $data['batch_id'], $temp[$j]['subject_id']);
            }

        }
               
//===============================End load semester subjects ======================================

        for ($i = 0; $i < count($exams); $i++) { //put only all subjects to one array..
            $this->db->select('*,(SELECT id FROM exm_semester_exam_details WHERE student_id=em.student_id AND subject_id =em.subject_id AND deleted=0) as sem_exam_detail_id');
            $this->db->where('em.student_id', $exams[$i]['student_id']);
            $this->db->where('em.course_id', $this->input->post('rptCourse'));
            $this->db->where('em.year_no', $this->input->post('rptYear'));
            $this->db->where('em.semester_no', $this->input->post('rptSemester'));
        //    $this->db->where('em.batch_id', $this->input->post('rptBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('rptExam'));
            $this->db->where_in('em.result', array('C-','D+','D','E', 'DFR','I(SE)','I(CA)','INC','AB','N/E','Fail'));
            
            $this->db->where('NOT(EXISTS(select stu_id from exm_semester_exam_details_repeat where stu_id = `em`.`student_id` and deleted = 0 and subject_id = em.subject_id and applying_batch = '.$rbatch.' and applying_year = '.$ryear.' and applying_semester = '.$rsemester.' and applying_exam = '.$rexam.'))');
            //$this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = `em`.`student_id` and subject_id = em.subject_id and (is_repeat = 1 or is_repeat = 3)))');
            //$this->db->where('NOT(EXISTS(select stu_id from exm_semester_exam_details_repeat where stu_id = `em`.`student_id` and deleted = 0 and subject_id = em.subject_id))');
            //$this->db->where('EXISTS(select student_id from exm_semester_exam_details where student_id = em.student_id and (is_absent = 1 and is_absent_approve = 0 or is_absent = 0) and subject_id = em.subject_id)');
            $this->db->where('em.deleted', 0);
            $exams[$i]['repeat_subject']=$this->db->get('exm_mark em')->result_array();           
            
            if(count($exams[$i]['repeat_subject']) == 0){
                $this->db->select('em.subject_id,em.overall_grade,esed.no_of_attempts,em.result');
                $this->db->join('exm_semester_exam_details esed', 'esed.subject_id=em.subject_id');
                $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
                $this->db->where('em.student_id', $exams[$i]['student_id']);
                $this->db->where('esed.student_id', $exams[$i]['student_id']);
                $this->db->where('em.course_id', $this->input->post('rptCourse'));
                $this->db->where('ese.course_id', $this->input->post('rptCourse'));
                $this->db->where('em.year_no', $this->input->post('rptYear'));
                $this->db->where('ese.year_no', $this->input->post('rptYear'));
                $this->db->where('em.semester_no', $this->input->post('rptSemester'));
                $this->db->where('ese.semester_no', $this->input->post('rptSemester'));
                $this->db->where('em.batch_id', $this->input->post('rptBatch'));
                $this->db->where('ese.batch_id', $this->input->post('rptBatch'));
                $this->db->where('em.sem_exam_id', $this->input->post('rptExam'));
                $this->db->where('ese.exam_id', $this->input->post('rptExam'));
                $this->db->where('esed.deleted', 0);
                $this->db->where('ese.release_result', 1);
                $exams[$i]['subject_maks']=$this->db->get('exm_mark em')->result_array();
            }
            else{
                $this->db->select('em.subject_id,em.overall_grade,esed.no_of_attempts,em.result');
                $this->db->join('exm_semester_exam_details esed', 'esed.subject_id=em.subject_id and esed.student_id=em.student_id');
                $this->db->join('exm_semester_exam ese', 'ese.exam_id=em.sem_exam_id');
                $this->db->where('em.student_id', $exams[$i]['student_id']);
                $this->db->where('esed.student_id', $exams[$i]['student_id']);
                $this->db->where('em.course_id', $this->input->post('rptCourse'));
                $this->db->where('ese.course_id', $this->input->post('rptCourse'));
                $this->db->where('em.year_no', $this->input->post('rptYear'));
                $this->db->where('ese.year_no', $this->input->post('rptYear'));
                $this->db->where('em.semester_no', $this->input->post('rptSemester'));
                $this->db->where('ese.semester_no', $this->input->post('rptSemester'));
                //$this->db->where('em.batch_id', $this->input->post('rptBatch'));
                //$this->db->where('ese.batch_id', $this->input->post('rptBatch'));
                //$this->db->where('em.sem_exam_id', $this->input->post('rptExam'));
                //$this->db->where('ese.exam_id', $this->input->post('rptExam'));
                $this->db->where('em.deleted', 0);
                $this->db->where('esed.deleted', 0);
                $this->db->where('ese.release_result', 1);
                $exams[$i]['subject_maks']=$this->db->get('exm_mark em')->result_array();
            }

        }

        if ($exams) {

            return array('students'=>$exams,'sem_sub'=>$temp);
        } else {
            return NULL;
        }
    }


    function load_exam_course_programs()
    {
        $this->db->select('de.*, de.id as course_id');
        $this->db->where('de.deleted', 0);
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }

    function check_duplicate_exam_code($exm_code)
    {
        $this->db->select('COUNT(id) as exam_count');
        $this->db->where('exam_code', $exm_code);
        $exam_count = $this->db->get('exm_exam')->row_array();
        return $exam_count;
    }

    function load_course_list()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function check_duplicate_semester_exam()
    {

        $this->db->select('COUNT(id) as count, id as sem_exam_id');
        $this->db->where('course_id', $this->input->post('course'));
        $this->db->where('year_no', $this->input->post('year'));
        $this->db->where('semester_no', $this->input->post('semester'));
//        $this->db->where('study_season_id', $this->input->post('stdy_season'));
        $this->db->where('batch_id', $this->input->post('batch'));
//        $this->db->where('exam_id', $this->input->post('exam_code'));
        $subj_duplicate = $this->db->get('exm_semester_exam')->row_array();

        return $subj_duplicate;

    }

    function save_postpone()
    {

        $center_id = $this->input->post('center_id');
        $course_id = $this->input->post('course_id');
        $l_Bcode = $this->input->post('l_Bcode');
        $l_no_year = $this->input->post('l_no_year');
        $l_no_semester = $this->input->post('l_no_semester');
        $resn = $this->input->post('resn');
        $nxt = $this->input->post('nxt');
        $u_id = $this->session->userdata('user_ref_id');
        $reqs_ty = $this->input->post('reqs_ty');

        $this->db->where('student_id',$u_id);
        $q = $this->db->get('stu_requests');
        
        
        if ( $q->num_rows() > 0 ) {
            $this->session->set_flashdata('flashError', 'Postpone Request Already Applied.');
            //$this->logger->systemlog('Save Postpone', 'Failure', 'Postpone Request Already Applied.', date("Y-m-d H:i:s", now()),$q);
        }else{
            $insert_data = array(
                'student_id' => $u_id,
                'center_id' => $center_id,
                'course_id' => $course_id,
                'batch_id' => $l_Bcode,
                'year_id' => $l_no_year,
                'semester_id' => $l_no_semester,
                'reason' => $resn,
                'next_join' => $nxt,
                'request_type' => $reqs_ty,
            ); 
            
            $result = $this->db->insert('stu_requests', $insert_data);
            $this->session->set_flashdata('flashSuccess', 'Postpone Request Saved Successfully.');
            //$this->logger->systemlog('Save Postpone', 'Success', 'Postpone Request Saved Successfully.', date("Y-m-d H:i:s", now()),$insert_data);

        }

        

//        if ($result) {
//            $this->session->set_flashdata('flashSuccess', 'Postpone saved successfully.');
//        } else {
//            $this->session->set_flashdata('flashSuccess', 'Postpone not saved.');
//        }
    }

    function get_lecture_timetable()
    {
        $this->db->select('*');
        $this->db->join('exm_exam ee', 'ee.id=te.ttbl_exam');

        //$this->db->join('edu_course ec','ec.id=te.ttbl_course');
        //$this->db->join('edu_semester es','es.id=te.ttbl_semester');
        //$this->db->join('exm_exam ee','ee.id=te.ttbl_exam');
        $this->db->join('edu_center_course_year eccy', 'eccy.id=te.ttbl_year');
        $this->db->join('edu_center_course_semester eccs', 'eccs.id=te.ttbl_semester');

        $this->db->where('approved', 1);

        $lec_time_tbl_view = $this->db->get('tta_examtimetable te')->result_array();

        return $lec_time_tbl_view;
    }

    function all_active_faculties_by_center()
    {

        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

        $this->db->select('*');
        $this->db->where_in('id', $faclist);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_faculty')->result_array();
        return $result_array;
    }

    function load_courses_complete_by_center()
    {

        $this->db->select('de.*, de.id as course_id, yr.no_of_year');
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $this->db->where('se.deleted', 0);
        $this->db->distinct();
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }


    function edit_exam_timetable($ttbl_id)
    {
        $this->db->select('*');
        $this->db->join('edu_course ec', 'ec.id=te.ttbl_course');
        //$this->db->join('mod_subject_group cg', 'cg.id=yc.subject_group_id');
        //$this->db->join('edu_semester se', 'se.id=yc.semester_id');
        //$this->db->join('edu_year yr', 'yr.id=se.year_id');
        //$this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('ttbl_id', $ttbl_id);
        $result_array = $this->db->get('tta_examtimetable te')->row_array();
        return $result_array;
    }

    function load_courses_complete_student()
    {
        $this->db->select('de.*, de.id as course_id, yr.no_of_year');
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $this->db->where('se.deleted', 0);
        $this->db->distinct();
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    function timetable_check_duplicate($data)
    {

        $this->db->select('count(esch_id) as is_check');
        $this->db->join('tta_examtimetable ', 'tta_examtimetable.ttbl_id=exm_schedule.esch_timetable');
        $this->db->where('tta_examtimetable.ttbl_exam', $data['exam_id']);
        $this->db->where('exm_schedule.esch_subject',  $data['subject_id']);
        $this->db->where('exm_schedule.esch_examtype',  $data['exam_type']);
        $courses = $this->db->get('exm_schedule ')->row_array();
        return $courses;
    }
    
    
    function get_ay_info() {
        $this->db->select('*');
        $range_res = $this->db->get('cfg_academicyears')->result_array();

        return $range_res;
    }
    
    function search_exam_absent_students_data($data) {

        $this->db->select('*');

        $this->db->join('exm_semester_exam_details', 'exm_semester_exam_details.semester_exam_id = exm_semester_exam.id');
        $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
        $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details.subject_id');

        $this->db->where('study_season_id', $data['study_season_id']);
        $this->db->where('stu_reg.center_id', $data['center_id']);
        $this->db->where('exm_semester_exam.course_id', $data['course_id']);
        $this->db->where('exm_semester_exam.year_no', $data['year_no']);
        $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
        $this->db->where('exam_id', $data['exam_id']);

        $this->db->where('exm_semester_exam_details.is_attend', 0);


        //$this->db->group_by('student_id');
        //$this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');

        $timetables = $this->db->get('exm_semester_exam')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.student_id', $rw['student_id']);
//
//            //$this->db->where('ss.is_attend', 1);
//
//            $this->db->where('ms.deleted', 0);
//
//            $this->db->join('mod_subject ms', 'ms.id = ss.subject_id');
//            $this->db->where('ss.is_attend', 0);
//
//            $timetables[$count]['subjectsatt'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }




        return $timetables;
    }
    
    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }
    
    function load_semester_subjects($data, $batch_details){
        $this->db->select('*,co.type as subject_type');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        $this->db->where('yr.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
//        $this->db->order_by("co.type", "asc");
//        $this->db->order_by("co.code", "asc");
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }
    
    
    function load_semester_subjects_deferement_repeat($data){
        $this->db->select('*,co.type as subject_type');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        $this->db->where('yr.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
//        $this->db->order_by("co.type", "asc");
//        $this->db->order_by("co.code", "asc");
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }
    
    
    function load_student_who_absent_exam($data, $batch_details)
    {

        $this->db->select('*');
        
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject md', 'md.id = esed.subject_id');
        
        
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('esed.is_absent', 0);
        $this->db->where('esed.is_approved', 2);
        $this->db->where('esed.is_exam_held', 1);       
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        if ($data['access_level'] == 5){
           $this->db->where('esed.student_id', $data['stu_id']);
        }
        // else
        $this->db->group_by('sr.stu_id');
        
        $result_array = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
////        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
////        $this->db->join('mod_subject co', 'co.id = fc.subject_id');
//        $this->db->where('sc.course_id', $batch_details['course_id']);
//        $this->db->where('sc.year_no', $batch_details['current_year']);
//        $this->db->where('sc.semester_no', $batch_details['current_semester']);
////        $this->db->where('sc.batch_id', $data['batch_id']);
////        $this->db->where('stu.current_year', $data['current_year']);
////        $this->db->where('stu.current_semester', $data['batch_id']);
//        $this->db->where('stu.deleted', 0);
//        $this->db->where('sc.is_Approved', 1);
//
//        $this->db->where('stu.batch_id', $data['batch_id']);
//        $this->db->where('stu.center_id', $data['center_id']);
//        if ($data['access_level'] == 5)
//            $this->db->where('stu.stu_id', $data['stu_id']);
//        //and stu.stu_id=118
//        $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = stu.stu_id))');
//        $result_array = $this->db->get('stu_reg stu')->result_array();

        // if($status == 0){

        // }


        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, sc.is_approved as subj_apprv');
//            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('exm_semester_exam ese', 'ese.id = sc.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('ese.course_id', $data['course_id']);
            $this->db->where('ese.batch_id', $data['batch_id']);
            $this->db->where('ese.year_no', $data['year_no']);
            $this->db->where('ese.semester_no', $data['semester_no']);
            $this->db->where('ese.exam_id', $data['exam_id']);
            //$this->db->where('sc.is_attend', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('exm_semester_exam_details sc')->result_array();
        }
        return $result_array;
    }
    

    function load_student_who_absent_exam_repeat($data)
    {

        $this->db->select('*, esed.semester_exam_id as semester_exam_id_rpt');
        
        $this->db->join('exm_semester_exam_details es', 'es.id = esed.exm_semester_exam_details');
        $this->db->join('exm_semester_exam ese', 'ese.id = es.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject md', 'md.id = esed.subject_id');
        
        
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('esed.semester_exam_id', $data['exam_id']);
        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('esed.is_absent', 0);
        $this->db->where('esed.is_repeat_approved', 1);
        $this->db->where('esed.is_exam_held', 1);       
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        if ($data['access_level'] == 5){
           $this->db->where('esed.stu_id', $data['stu_id']);
        }
        // else
        $this->db->group_by('sr.stu_id');
        
        $result_array = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();


        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, sc.is_repeat as rpt_subj_apprv');
            $this->db->join('mod_subject co', 'co.id = sc.subject_id');
            $this->db->where('sc.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('sc.is_attend', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('exm_semester_exam_details_repeat sc')->result_array();
        }
        return $result_array;
    }
    
    
    
    function get_deferment_options() {

        $this->db->select('*');
        $deferment_opt = $this->db->get('cfg_absent_deferement')->result_array();

        return $deferment_opt;
    }
    
    
    
    function deferement_approve($data)
    {
        $this->db->trans_begin();

        for($i=0;$i<sizeof($data['subjects']);$i++){
            $this->db->where('student_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $this->db->update('exm_semester_exam_details', array(
            'absent_deferement' => $data['defer_option'],
            'is_absent' => 1,
//            'other_reason' => $data['other_reason'],
            'absent_request_date' => date("Y-m-d H:i:s", now()),
           
            
        ));
        }
        // $this->db->where('subject_id', $data['subject_id']);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Request saving failed.';
            //$this->logger->systemlog('Deferement Approve', 'Failure', 'Deferement Approve Request Failed.', date("Y-m-d H:i:s", now()),$data);
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Request successfully saved.';
            //$this->logger->systemlog('Deferement Approve', 'Success', 'Deferement Approve Request successfully saved.', date("Y-m-d H:i:s", now()),$data);
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
        }
        return $res;

    }
    
    
    function deferement_approve_repeat($data)
    {
        $this->db->trans_begin();

        for($i=0;$i<sizeof($data['subjects']);$i++){
            $this->db->where('stu_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $this->db->update('exm_semester_exam_details_repeat', array(
            'absent_deferement' => $data['defer_option'],
            'is_absent' => 1,
//            'other_reason' => $data['other_reason'],
            'absent_request_date' => date("Y-m-d H:i:s", now()),
           
            
        ));
        }
        // $this->db->where('subject_id', $data['subject_id']);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Repeat Deferement Request saving failed.';
            //$this->logger->systemlog('Repeat Deferement Approve', 'Failure', 'Repeat Deferement Approve Request Failed.', date("Y-m-d H:i:s", now()),$data);
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Repeat Deferement Request Successfully Saved.';
            //$this->logger->systemlog('Repeat Deferement Approve', 'Success', 'Repeat Deferement Approve Request Successfully Saved.', date("Y-m-d H:i:s", now()),$data);
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
        }
        return $res;

    }
    
    
    
    function load_recorrection_student_data()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $this->db->select('sr.stu_id, sr.reg_no, sr.first_name');
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
        $this->db->where('em.course_id', $this->input->post('recorectCourse'));
        $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
        $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
        $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
        if($ug_level == 5){
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('em.deleted', 0);
        $this->db->where('esed.is_approved', 2);
        $this->db->group_by('em.student_id');

        $exams_students = $this->db->get('exm_mark em')->result_array();
  
        for ($i = 0; $i < count($exams_students); $i++) {  //put only all subjects to one array..
            $this->db->select('ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->where('em.course_id', $this->input->post('recorectCourse'));
            $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
            $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('esed.is_approved', 2);

            $exams_students[$i]['subjects'] = $this->db->get('exm_mark em')->result_array();
        }
        if ($exams_students) {
            return $exams_students;
        } else {
            return NULL;
        }
    }
    
    
    function load_recorrection_student_data_for_recorrection_apply()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $this->db->select('sr.stu_id, sr.reg_no, sr.first_name,');
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
        $this->db->where('em.course_id', $this->input->post('recorectCourse'));
        //$this->db->where('em.batch_id', $this->input->post('recorectBatch'));
        $this->db->where('sr.batch_id', $this->input->post('recorectBatch'));
        $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
        $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
        if($ug_level == 5){
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('em.deleted', 0);
        $this->db->where('esed.is_approved', 2);
        $this->db->group_by('em.student_id');

        $exams_students = $this->db->get('exm_mark em')->result_array();
          
        for ($i = 0; $i < count($exams_students); $i++) {  //put only all subjects to one array..
            $x = 0;
            $this->db->select('ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection, esed.is_repeat, em.year_no, em.semester_no');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->where('em.course_id', $this->input->post('recorectCourse'));
            $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
            $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('ms.is_training_apply', 0);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('esed.is_approved', 2);
            $this->db->where('esed.is_repeat', 0);

            $exams_students[$i]['subjects'][$x] = $this->db->get('exm_mark em')->result_array();;
            
            //To load repeat exam marks
            $this->db->select('eser.exm_semester_exam_details_repeat_id, eser.stu_id, eser.subject_id, eser.semester_exam_id, eser.applying_year, eser.applying_semester, eb.id as batch_id, eb.current_year, eb.current_semester, eser.semester_exam_id');
            $this->db->join('exm_semester_exam es', 'es.exam_id=eser.semester_exam_id');
            $this->db->join('edu_batch eb', 'es.batch_id=eb.id');
            $this->db->where('eser.stu_id', $exams_students[$i]['stu_id']);
            $this->db->where('eser.deleted', 0);
            $this->db->where('eser.is_repeat_approved', 1);
            $repeat_subjs = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();          

            if(count($repeat_subjs) > 0){
                for ($k = 0; $k < count($repeat_subjs); $k++) { 
                    if($repeat_subjs[$k]['applying_year'] == $repeat_subjs[$k]['current_year']){
                        if($repeat_subjs[$k]['applying_semester'] == $repeat_subjs[$k]['current_semester']){

                            $this->db->select('ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection, esed.is_repeat, em.year_no, em.semester_no');
                            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
                            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
                            $this->db->join('exm_semester_exam_details_repeat esed', 'em.student_id = esed.stu_id AND em.subject_id = esed.subject_id');
                            $this->db->where('em.course_id', $this->input->post('recorectCourse'));
                            $this->db->where('em.batch_id', $repeat_subjs[$k]['batch_id']);
                            $this->db->where('em.sem_exam_id', $repeat_subjs[$k]['semester_exam_id']);
                            $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
                            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
                            $this->db->where('em.is_hod_mark_aproved', 1);
                            $this->db->where('em.is_director_mark_approved', 1);
                            $this->db->where('em.is_ex_director_mark_approved', 1);
                            $this->db->where('ms.is_training_apply', 0);
                            $this->db->where('sr.deleted', 0);
                            $this->db->where('em.deleted', 0);
                            $this->db->where('esed.is_repeat_approved', 1);

                            $exams_students[$i]['subjects'][$x+1] = $this->db->get('exm_mark em')->result_array();
                        }
                    }
                }
            }
            
            $x++;
            
        }
        if ($exams_students) {
            return $exams_students;
        } else {
            return NULL;
        }
    }
    
    
    function save_recorrection_student_attempt(){
        
        $this->db->trans_begin();
        $update_data = array(
            'is_recorrection' => 1
        );
        $this->db->where('student_id', $this->input->post('student_id'));
        $this->db->where('sem_exam_id', $this->input->post('exam_id'));
        $this->db->where('subject_id', $this->input->post('subject_id'));
        $this->db->where('deleted', 0);
        $this->db->update('exm_mark', $update_data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Update Student. Retry.';
        } else {
            $this->db->trans_commit();
                $res['status'] = 'success';
                $res['message'] = 'Student Updated Successfully';
        }
        return $res;
    }
    
    
    function load_course_list_recorrection()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
    
    function load_course_list_recorrection_student()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->join('stu_reg sr', 'cr.id=sr.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');
        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
    
    function load_batches_recorrection($course_id)
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }
    
    function load_batches_recorrection_student($course_id, $id)
    {
        $this->db->select('*');
        $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
        $this->db->where('edu_batch.deleted', 0);
        $this->db->where('edu_batch.course_id', $course_id);
        $this->db->where('stu_reg.stu_id', $id);
        $result = $this->db->get('stu_reg')->result_array();

        return $result;
    }
    
    function load_semester_exam_recorrection($data, $batch_details)
    {
        $this->db->select('*, ex.id as exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('se.semester_no', $batch_details['current_semester']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.is_approved', 1);
        $this->db->where('se.release_result', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    
    function load_semester_exam_recorrection_marks($data)
    {
        $this->db->select('*, ex.id as exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['mrk_course']);
        $this->db->where('se.year_no', $data['mrk_year']);
        $this->db->where('se.semester_no', $data['mrk_semester']);
        $this->db->where('se.batch_id', $data['mrk_batch']);
        $this->db->where('se.is_approved', 1);
        $this->db->where('se.release_result', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    
    function load_batch_details_recorrection($batch_id)
    {
        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_batch')->row_array();
        return $result_array;
    }   
    
    
    function load_batch_details_deferement($batch_id)
    {
        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_batch')->row_array();
        return $result_array;
    } 
    
    function search_post_something($data){
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = stu_req.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = stu_req.center_id');
        $this->db->join('edu_batch eb', 'eb.id = stu_req.batch_id');
        
        $this->db->where('stu_req.center_id', $data['center_id']);
        $this->db->where('stu_req.course_id', $data['course_id']);
        $this->db->where('stu_req.batch_id', $data['batch_id']);
        
        $this->db->where('stu_req.request_type', 1);
        //$this->db->where('stu_req.status', 0);
        if ($data['access_level'] == 5)
            $this->db->where('sr.stu_id', $data['stu_id']);
        //$this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")
        
        $timetables = $this->db->get('stu_requests stu_req')->result_array();
        return $timetables;
    }
    
    function search_differ_something($data){
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('cfg_absent_deferement cad', 'cad.absent_defered_id = esed.absent_deferement');
        
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.absent_deferement !=', 0);
        
//        $this->db->where('stu_req.request_type', 1);
//        $this->db->where('stu_req.status !=', NULL);
        if ($data['access_level'] == 5)
            $this->db->where('sr.stu_id', $data['stu_id']);
        $this->db->group_by('sr.stu_id');
        
        
        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();
        
        $count = 0;
        foreach ($timetables as $rw) {
            $this->db->select('*');
            
            $this->db->join('mod_subject ms', 'ms.id = ss.subject_id');
            $this->db->join('exm_semester_exam ese', 'ese.id = ss.semester_exam_id');
            $this->db->join('cfg_absent_deferement cad', 'cad.absent_defered_id = ss.absent_deferement');
            
            $this->db->where('ss.student_id', $rw['stu_id']);
            $this->db->where('ss.is_attend', 0);
            $this->db->where('ss.absent_deferement !=', 0);
            
//            $this->db->where('sfs.deleted', 0);
//            $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            
            
        
            $timetables[$count]['subjects'] = $this->db->get('exm_semester_exam_details ss')->result_array();
            $count++;
        }

        return $timetables;
        //$this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")
        
        
        return $timetables;
    }
    
    function edit_change_approval_status($data)
    {
        $update_array = array (
            'approved' => 0,
            'approved_by' => null,
            'approved_datetime' => null
        );
        $this->db->where('ttbl_id', $data['ttbl_id']);
        $result = $this->db->update('tta_examtimetable',$update_array);
        return $result;
    }
    
    
    function load_exams_repeat_deferment($data)
    {
        $this->db->distinct();
        $this->db->select('ex.id as exam_id, ex.exam_code, ex.exam_name');
        $this->db->join('exm_semester_exam_details exd', 'se.exm_semester_exam_details = exd.id');
        $this->db->join('exm_semester_exam exs', 'exd.semester_exam_id = exs.id');
        $this->db->join('exm_exam ex', 'se.semester_exam_id = ex.id');
        $this->db->where('exs.course_id', $data['course']);
        $this->db->where('se.applying_year', $data['year']);
        $this->db->where('se.applying_semester', $data['semester']);
        $this->db->where('se.applying_batch', $data['batch_id']);
        $this->db->where('se.is_repeat_approved', 1);
        $this->db->where('se.is_attend', 0);
        $this->db->where('se.is_exam_held', 1);
        $this->db->where('se.deleted', 0);
        
        $result_array = $this->db->get('exm_semester_exam_details_repeat se')->result_array();
        return $result_array;
    }
    
    
    function load_exams_repeat_deferment_approval($data)
    {
        $this->db->select('ex.id as exam_id, ex.exam_code, ex.exam_name');
        $this->db->join('exm_semester_exam_details exd', 'se.exm_semester_exam_details = exd.id');
        $this->db->join('exm_semester_exam exs', 'exd.semester_exam_id = exs.id');
        $this->db->join('exm_exam ex', 'se.semester_exam_id = ex.id');
        $this->db->where('exs.course_id', $data['course']);
        $this->db->where('se.applying_year', $data['year']);
        $this->db->where('se.applying_semester', $data['semester']);
        $this->db->where('se.applying_batch', $data['batch_id']);
        $this->db->where('se.is_repeat_approved', 1);
        $this->db->where('se.is_attend', 0);
        $this->db->where('se.is_exam_held', 1);
        $this->db->where('se.deleted', 0);
        
        $result_array = $this->db->get('exm_semester_exam_details_repeat se')->result_array();
        return $result_array;
    }
    
    
    //GRADUATION
    function load_graduation_eligibility($data){
        
        $result_array = [];
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if($ug_level == 5){
            $this->db->select('student_id');
            $this->db->where('student_id', $data['stu_id']);
            $stu_exist = $this->db->get('stu_requests')->row_array();

            if($stu_exist){
                $result_array = 1;
            }
            else{
                $this->db->select('stu_id, course_id, batch_id, current_year, current_semester, center_id');
                $this->db->where('stu_id', $data['stu_id']);
                $this->db->where('deleted', 0);
                $stu_data_array = $this->db->get('stu_reg')->result_array();

                $this->db->select('ey.no_of_year, , es.no_of_semester, es.year_id, es.year_no');
                $this->db->join('edu_semester es', 'ey.id = es.year_id AND ey.no_of_year = es.year_no');
                $this->db->where('ey.course_id', $stu_data_array[0]['course_id']);
                $this->db->where('ey.deleted', 0);
                $this->db->where('es.deleted', 0);
                $course_data_array = $this->db->get('edu_year ey')->result_array();

                if($course_data_array[0]['year_no'] == $stu_data_array[0]['current_year']){
                    if($course_data_array[0]['no_of_semester'] == $stu_data_array[0]['current_semester']){
                        
                        

                        $this->db->select('course_id, year_no, semester_no, batch_id, release_result');
                        $this->db->where('course_id', $stu_data_array[0]['course_id']);
                        $this->db->where('year_no', $stu_data_array[0]['current_year']);
                        $this->db->where('semester_no', $stu_data_array[0]['current_semester']);
                        $this->db->where('batch_id', $stu_data_array[0]['batch_id']);
                        $results_data_array = $this->db->get('exm_semester_exam')->result_array();

                        if($results_data_array){
                            if($results_data_array[0]['release_result'] == 1){

                                $result_array = $this->load_student_exam_results_each_yr_sem($stu_data_array, $course_data_array);
                            }
                            else{
                                $result_array = NULL;
                            }
                        }
                    }
                    else{
                       $result_array = NULL;  
                    }
                }
                else{
                   $result_array = NULL; 
                }
            }
        }
        else{
            $result_array = NULL;
        } 
        return $result_array;
    }
    
    
    function load_student_exam_results_each_yr_sem($student_data, $year_sem_data)
    {       
        $this->db->select('ey.no_of_year, , es.no_of_semester, es.year_id, es.year_no');
        $this->db->join('edu_semester es', 'ey.id = es.year_id');
        $this->db->where('ey.course_id', $student_data[0]['course_id']);
        $this->db->where('ey.deleted', 0);
        $this->db->where('es.deleted', 0);
        $year_array = $this->db->get('edu_year ey')->result_array();
        
        $g = 0;
        $graduation_data_array = [];
        for($y=0; $y<$year_array[0]['no_of_year']; $y++){
            for($s=0; $s<$year_array[$y]['no_of_semester']; $s++){
                
                $this->db->select('exam_id, course_id, batch_id, year_no, semester_no, release_result');
                $this->db->where('course_id', $student_data[0]['course_id']);
                $this->db->where('year_no', $y+1);
                $this->db->where('semester_no', $s+1);
                $this->db->where('batch_id', $student_data[0]['batch_id']);
                $this->db->where('is_approved', 1);
                $this->db->where('release_result', 1);
                $this->db->where('deleted', 0);
                $exam_array = $this->db->get('exm_semester_exam')->result_array();
                
                if($exam_array){
                    //GET SUDENT RESULTS OF EACH YEAR AND SEMESTER
                    $result_array = [];
                       
                    $result_array['gpa'] = $this->get_student_sgpa($student_data[0]['stu_id'], $y+1, $s+1); 

                    $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,
        em.sem_exam_id,es.exam_id,co.type as subject_type, co.code as subject_code, co.id, co.subject, es.release_result, co.is_training_apply');
                    $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
                    $this->db->join('mod_subject co', 'co.id = em.subject_id');
                    $this->db->where('em.course_id', $student_data[0]['course_id']);
                    $this->db->where('em.year_no', $y+1);
                    $this->db->where('em.semester_no', $s+1);
                    $this->db->where('em.student_id', $student_data[0]['stu_id']);
                    $this->db->where('em.deleted', 0);
                    $this->db->where('es.is_approved', 1);
                    $this->db->where('es.deleted', 0);
                    $result_array['exam_mark'] = $this->db->get('exm_mark em')->result_array();
                }
                
                $graduation_data_array[$g]['year'] = $y+1;
                $graduation_data_array[$g]['semester'] = $s+1;
                $graduation_data_array[$g]['graduate_data'] = $result_array;
                $g++;
            }
        }
        return $graduation_data_array;
    
    }
    
    
    function get_student_sgpa($student_id, $year_no, $semester_no){
         $this->db->select('*'); 
         $this->db->where('stu_id', $student_id);
         $this->db->where('year', $year_no);
         $this->db->where('semester', $semester_no);
         
         $stu_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();
         return $stu_gpa['gpa'];
         
    }
    
    function save_graduation_request($data){
        
        $this->db->trans_begin();
        
        $res = [];
        
        $this->db->select('student_id');
        $this->db->where('student_id', $data['stu_id']);
        $stu_exist = $this->db->get('stu_requests')->row_array();
        
        if($stu_exist){
            $res['status'] = 'sent';
            $res['message'] = 'Graduation Request Already Sent. Cannot Request Again.';
        }
        else{
            $this->db->select('stu_id, course_id, batch_id, current_year, current_semester, center_id');
            $this->db->where('stu_id', $data['stu_id']);
            $stu_array = $this->db->get('stu_reg')->row_array();

            $insert_array = array(
                'student_id' => $data['stu_id'],
                'center_id' => $stu_array['center_id'],
                'course_id' => $stu_array['course_id'],
                'batch_id' => $stu_array['batch_id'],
                'request_type' => 2
            );
            $this->db->insert('stu_requests', $insert_array);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                    $res['status'] = 'failed';
                    $res['message'] = 'Failed to Request for Graduation. Retry.';

                    //$this->logger->systemlog('Apply Graduation Request', 'Fail', 'Graduation Request Failed to Sent.', date("Y-m-d H:i:s", now()),$insert_array);
            } else {
                $this->db->trans_commit();
                    $res['status'] = 'success';
                    $res['message'] = 'Graduation Request Sent Successfully.';

                    //$this->logger->systemlog('Apply Graduation Request', 'Success', 'Graduation Request Sent Successfully.', date("Y-m-d H:i:s", now()),$insert_array);
            }
        }
                
        return $res;
        
    }
    
    //GRADUATION APPROVAL
    function load_graduation_eligibility_for_approval($data){
        
        $result_array = [];
        
        
        $this->db->select('stu_id, course_id, batch_id, current_year, current_semester, center_id');
        $this->db->where('stu_id', $data['stu_id']);
        $stu_data_array = $this->db->get('stu_reg')->result_array();

        $this->db->select('ey.no_of_year, , es.no_of_semester, es.year_id, es.year_no');
        $this->db->join('edu_semester es', 'ey.id = es.year_id AND ey.no_of_year = es.year_no');
        $this->db->where('ey.course_id', $stu_data_array[0]['course_id']);
        $course_data_array = $this->db->get('edu_year ey')->result_array();

        if($course_data_array[0]['year_no'] == $stu_data_array[0]['current_year']){
            if($course_data_array[0]['no_of_semester'] == $stu_data_array[0]['current_semester']){

                $this->db->select('course_id, year_no, semester_no, batch_id, release_result');
                $this->db->where('course_id', $stu_data_array[0]['course_id']);
                $this->db->where('year_no', $stu_data_array[0]['current_year']);
                $this->db->where('semester_no', $stu_data_array[0]['current_semester']);
                $this->db->where('batch_id', $stu_data_array[0]['batch_id']);
                $results_data_array = $this->db->get('exm_semester_exam')->result_array();

                if($results_data_array){
                    if($results_data_array[0]['release_result'] == 1){

                        $result_array = $this->load_student_exam_results_each_yr_sem($stu_data_array, $course_data_array);
                    }
                    else{
                        $result_array = NULL;
                    }
                }
            }
            else{
               $result_array = NULL;  
            }
        }
        else{
           $result_array = NULL; 
        }
        
        
        return $result_array;
    }
    
    function save_paper_setter_and_moderator($data)
    {
        
        if(empty($data['paper_setter_id'])){
            $insert_data = array(
                'semester_exam_id'=> $data['semester_exam_id'],
                'subject_id'=> $data['subject_id'],
                'setter_lecturer_id'=> $data['setter_lecturer_id'],
                'moderator_lecturer_id'=> $data['moderator_lecturer_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            
            $result = $this->db->insert('exm_semester_exam_paper_setter', $insert_data);
        } else {
            $update_data = array(
                'semester_exam_id'=> $data['semester_exam_id'],
                'subject_id'=> $data['subject_id'],
                'setter_lecturer_id'=> $data['setter_lecturer_id'],
                'moderator_lecturer_id'=> $data['moderator_lecturer_id'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );
            
            $this->db->where('id', $data['paper_setter_id']);
            $result = $this->db->update('exm_semester_exam_paper_setter', $update_data);
        }

        return $result;
    }
    
    function check_duplicate_setter_moderator ($data) {
        
        $this->db->select('id as paper_setter_id');
        $this->db->where('semester_exam_id', $data['semester_exam_id']);
        $this->db->where('subject_id', $data['subject_id']);
//        $this->db->where('setter_lecturer_id', $data['setter_lecturer_id']);
//        $this->db->where('moderator_lecturer_id', $data['moderator_lecturer_id']);
        $duplicate = $this->db->get('exm_semester_exam_paper_setter')->row_array();

        return $duplicate;
    }
    
    
    function bulk_save_training_marks($data){

        $res = [];
        
        $this->db->trans_begin();
        
        $student_array = array();
        $grade_array = array();
        
        while (list($key, $val) = each($data['training_exam_mark'])) {
            $student_array[] = $key;
            $grade_array[] = $val;
        }

        for ($j = 0; $j < count($student_array); $j++) {

            $subject_ids=explode("_",$student_array[$j]);

            $student_id[$j] = $subject_ids[0];
            $subject_id[$j] = $subject_ids[1];

            $data['stu_id'] = $student_id[$j];
            $data['subject_id'] = $subject_id[$j];
            $sem_exam_id = $data['exam_id'];

            $mark_id = $this->check_subject_mark_exists($data);

            if ($mark_id == NULL) {
                //insert
                //insert to exm_exam_mark
                $insert_exam_mark = array(
                    'student_id' => $student_id[$j],
                    'course_id' => $data['course_id'],
                    'year_no' => $data['year_no'],
                    'semester_no' => $data['semester_no'],
                    'batch_id' => $data['batch_id'],
                    'sem_exam_id' => $sem_exam_id,
                    'subject_id' => $subject_id[$j],
                    'total_marks' => 0,
                    'overall_grade' => "-",
                    'grade_point' => 0,
                    'subject_credit' => 0,
                    'result' => $grade_array[$j], 
                    'is_repeat_approve' => 0,
                    'is_repeat_mark' => 0,
                    'is_hod_mark_aproved' => 1,
                    'is_director_mark_approved' => 1,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())                    
                );
                $this->db->insert('exm_mark', $insert_exam_mark);
                $max_exam_mark_id = $this->get_max_exam_mark_id();

                $marking_method_array = $this->get_relevent_training_marking_details($data['course_id'], $data['year_no'], $data['semester_no'], $data['batch_id'], $subject_id[$j]);

                //insert to exm_exam_mark_details
                for ($i = 0; $i < count($marking_method_array); $i++) {

                    $insert_mark_details = array(
                        'exam_mark_id' => $max_exam_mark_id,
                        'exam_type_id' => $marking_method_array[$i]['type_id'],
                        'persentage' => $marking_method_array[$i]['percentage'],
                        'mark' => 0,
                        'is_hod_mark_aproved' => 1,
                        'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                        'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
                        'is_director_mark_approved' => 1,
                        'director_mark_approved_by' => $this->session->userdata('u_id'),
                        'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $this->db->insert('exm_mark_details', $insert_mark_details);
                }
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $res['status'] = 'Failed';
                    $res['message'] = 'Failed to save Training Subject marks';
                    //$this->logger->systemlog('Save Training Subject Marks', 'Failure', 'Failed to save Training Subject marks', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                } else {
                    $this->db->trans_commit();
                    $res['status'] = 'success';
                    $res['message'] = 'Training Subject marks saved successfully.';
                    //$this->logger->systemlog('Save Training Subject Marks', 'Success', 'Training Subject marks saved successfully', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                } 
            }
            else{
                //repeat delete and insert
                if($data['repeat_val'] == 1) {
                    
                    $rpt_mark_exists = $this->check_repeat_subject_exists($data);
                    
                    $is_repeat = $this->check_repeat_approve_status($data);
                    
                    if($rpt_mark_exists == NULL){
                        $mark_data = $this->get_exam_mark_details($mark_id, $data['subject_id']);
                    
                        //delete
                        $mark_delete = array(
                            'deleted' => 1,
                            'deleted_by' => $this->session->userdata('u_id'),
                            'deleted_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->where('id', $mark_id);
                        $this->db->update('exm_mark', $mark_delete);


                        $mark_detail_delete = array(
                            'deleted' => 1,
                            'deleted_by' => $this->session->userdata('u_id'),
                            'deleted_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->where('exam_mark_id', $mark_id);
                        $this->db->update('exm_mark_details', $mark_detail_delete);

                        //insert
                        //insert to exm_exam_mark
                        $insert_exam_mark = array(
                            'student_id' => $student_id[$j],
                            'course_id' => $data['course_id'],
                            'year_no' => $data['year_no'],
                            'semester_no' => $data['semester_no'],
                            'batch_id' => $data['batch_id'],
                            'sem_exam_id' => $sem_exam_id,
                            'subject_id' => $subject_id[$j],
                            'total_marks' => 0,
                            'overall_grade' => "-",
                            'grade_point' => 0,
                            'subject_credit' => 0,
                            'result' => $grade_array[$j],                       
                            'is_recorrection' => 0,
                            'is_recorrection_approved' => 0,
                            'recorrection_approved_by' => 0,
                            'recorrection_approved_on' => "",
                            'is_hod_mark_aproved' => 1,
                            'is_director_mark_approved' => 1,
                            'is_ex_director_mark_approved' => 0,
                            'exam_status' => $mark_data[0]['mark_exam_status'],
                            'is_repeat_approve' => $is_repeat,
                            'is_repeat_mark' => 1,                        
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->insert('exm_mark', $insert_exam_mark);
                        $max_exam_mark_id = $this->get_max_exam_mark_id();

                        $marking_method_array = $this->get_relevent_training_marking_details($data['course_id'], $data['year_no'], $data['semester_no'], $data['batch_id'], $subject_id[$j]);

                        //insert to exm_exam_mark_details
                        for ($i = 0; $i < count($marking_method_array); $i++) {  
                            $insert_mark_details = array(
                                'exam_mark_id' => $max_exam_mark_id,
                                'exam_type_id' => $marking_method_array[$i]['type_id'],
                                'persentage' => $marking_method_array[$i]['percentage'],
                                'mark' => 0,                            
                                'is_hod_mark_aproved' => 1,
                                'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                                'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
                                'is_director_mark_approved' => 1,
                                'director_mark_approved_by' => $this->session->userdata('u_id'),
                                'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
                                'added_by' => $this->session->userdata('u_id'),
                                'added_on' => date("Y-m-d h:i:s", now())
                            );
                            $this->db->insert('exm_mark_details', $insert_mark_details);
                        }
                        
                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $res['status'] = 'Failed';
                            $res['message'] = 'Failed to save Repeat Training Subject marks';
                            //$this->logger->systemlog('Save Repeat Training Subject Marks', 'Failure', 'Failed to save Repeat Training Subject marks', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                        } else {
                            $this->db->trans_commit();
                            $res['status'] = 'success';
                            $res['message'] = 'Repeat Training Subject marks saved successfully.';
                            //$this->logger->systemlog('Save Repeat Training Subject Marks', 'Success', 'Repeat Training Subject marks saved successfully', date("Y-m-d H:i:s", now()),$insert_exam_mark);
                        } 
                    }
                    else{
                        $res = $this->update_training_mark_data($data, $mark_id, $sem_exam_id, $student_array[$j], $grade_array[$j]);
                    }  
                }
                else{
                    $res = $this->update_training_mark_data($data, $mark_id, $sem_exam_id, $student_array[$j], $grade_array[$j]);
                }
            }   
        }
        return $res; 
    }
    
    
    function get_relevent_training_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id)
    {
        $sem_id = $this->get_training_semester_id($course_id, $year_no);
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
        $this->db->where('ms.is_training_apply', 1);
        $this->db->where('sc.deleted', 0);
        $this->db->where('scd.deleted', 0);
        $this->db->where('md.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }
    
    function get_training_semester_id($course_id, $year_no)
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
    
    
    function update_training_mark_data($data, $mark_id, $sem_exam_id, $student_array, $grade_array){

        $subject_ids=explode("_",$student_array);

        $student_id = $subject_ids[0];
        $subject_id = $subject_ids[1];

        $data['stu_id'] = $student_id;
        $data['subject_id'] = $subject_id;

        //update 
        //exm_exam_mark
        $update_exam_mark = array(
            'student_id' => $student_id,
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $sem_exam_id,
            'subject_id' => $subject_id,
            'total_marks' => 0,
            'overall_grade' => "-",
            'grade_point' => 0,
            'subject_credit' => 0,
            'result' => $grade_array, 
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        $marking_method_array = $this->get_relevent_training_marking_details($data['course_id'], $data['year_no'], $data['semester_no'], $data['batch_id'], $subject_id);

        //update hc_mark_details
        $update_mark_details = array(
            'mark' => 0,
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark_details', $update_mark_details);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to update Training Subject marks';
            //$this->logger->systemlog('Training Subject Mark Update', 'Failure', 'Failed to update Training Subject marks', date("Y-m-d H:i:s", now()),$update_exam_mark);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Training Subject marks updated successfully.';
            //$this->logger->systemlog('Training Subject Mark Update', 'Success', 'Training Subject marks updated successfully', date("Y-m-d H:i:s", now()),$update_exam_mark);
        }
        return $res;
    }
    
    function calculate_student_gpa($data)
    {
        $this->db->trans_begin();
        
        $this->db->distinct()->select('em.student_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
        $this->db->where('em.course_id', $data['gpa_course']);
        $this->db->where('em.year_no', $data['gpa_year']);
        $this->db->where('em.semester_no', $data['gpa_semester']);
        $this->db->where('em.batch_id', $data['gpa_batch']);
        $this->db->where('em.sem_exam_id', $data['gpa_sem_exam_id']);
        $this->db->where('sr.center_id', $data['gpa_center']);
        $this->db->where('em.deleted', 0);
        $this->db->where('sr.deleted', 0);
        //$this->db->group_by('em.student_id');
        $stu_data = $this->db->get('exm_mark em')->result_array();
        //1. get student SE student IDs from DB according to exam..
        foreach ($stu_data as $key => $stu) 
        {
            //2. calculate GPA and  overall GPA for each students.
            $student_id = $stu['student_id'];
            
            ///// get total credits..
            $this->db->select('SUM(credits) as total_credits');
            $this->db->join('stu_follow_subject sfs', 'sfs.subject_id = ms.id');
            $this->db->join('stu_subject ss', 'sfs.student_subject_id = ss.id');
            $this->db->where('ss.student_id', $student_id);
            $this->db->where('ss.course_id', $data['gpa_course']);
            $this->db->where('ss.batch_id', $data['gpa_batch']);
            $this->db->where('ss.year_no', $data['gpa_year']);
            $this->db->where('ss.semester_no', $data['gpa_semester']);
            $this->db->where('ms.deleted', 0);
            $this->db->where('sfs.deleted', 0);
            $this->db->where('ss.deleted', 0);
            $credits = $this->db->get('mod_subject ms')->row_array();
            
            // get the GPA value
            $this->db->select('ROUND((SUM(em.grade_point*em.subject_credit)/'.$credits['total_credits'].'), 2) as gpa');
            $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
            $this->db->where('em.student_id', $student_id);
            $this->db->where('em.sem_exam_id', $data['gpa_sem_exam_id']);
            $this->db->where('em.year_no', $data['gpa_year']);
            $this->db->where('em.semester_no', $data['gpa_semester']);
            $this->db->where_not_in('em.result', array('DFR','I(SE)','I(CA)','INC','AB','N/E'));
            $this->db->where('ms.is_gpa_apply !=', 0);
            $gpa = $this->db->get('exm_mark em')->row_array();
            
            //3. Save  GPA and Overall GPA in to DB.
            //=================================insert GPA values ==============================================

            //Calculate Overall GPA

            $gpa_total = 0;

            $this->db->select('stu_id, gpa');
            $this->db->where('stu_id', $student_id);

            $gpa_data = $this->db->get('exm_mark_stu_gpa')->result_array();

            $prev_gpa_count = count($gpa_data) + 1;

            for ($g = 0; $g < count($gpa_data); $g++) {
                $gpa_total += $gpa_data[$g]['gpa'];
            }

            $pre_overall_gpa = (($gpa_total + $gpa['gpa']) / $prev_gpa_count);
            $overall_gpa = round($pre_overall_gpa, 2); 


            //insert gpa values
            $this->db->select('count(stu_id) as gpa_count');
            $this->db->where('stu_id', $student_id);
            $this->db->where('year', $data['gpa_year']);
            $this->db->where('semester', $data['gpa_semester']);

            $is_available_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();
            
            if($is_available_gpa['gpa_count']==0){
            $insert_gpa = array(
                'stu_id' => $student_id,
                'year' => $data['gpa_year'],
                'semester' => $data['gpa_semester'],
                'gpa' => $gpa['gpa'],
                'overall_gpa' => $overall_gpa,
                'created_by' => $this->session->userdata('u_id'),
                'created_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->insert('exm_mark_stu_gpa', $insert_gpa);
            }else{
                $update_gpa = array(
                    'gpa' => $gpa['gpa'],
                    'overall_gpa' => $overall_gpa,
                    'update_by' => $this->session->userdata('u_id'),
                    'update_on' => date("Y-m-d h:i:s", now())
                );

                $this->db->where('stu_id', $student_id);
                $this->db->where('year', $data['gpa_year']);
                $this->db->where('semester', $data['gpa_semester']);
                $this->db->update('exm_mark_stu_gpa', $update_gpa);
            }
            //=================================End insert GPA values ==============================================
            
        }
        $update_exam_mark = array(
            'gpa' => $gpa['gpa'],
            'overall_gpa' => $overall_gpa,
            'created_by' => $this->session->userdata('u_id'),
            'created_on' => date("Y-m-d h:i:s", now())
        );
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Bulk student GPA updated failed!';
            //$this->logger->systemlog('Bulk student GPA updated failed!', 'Faliure', 'Bulk student GPA updated failed.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Bulk student GPA updated successfully!';
            //$this->logger->systemlog('Bulk student GPA updated successfully!', 'Success', 'Bulk student GPA updated successfully.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        }
        return $res;
        
        
    }
    
}
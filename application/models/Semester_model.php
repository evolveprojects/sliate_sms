<?php

class Semester_model extends CI_Model {

    function load_course() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $this->db->where('yr.deleted', 0);
        $deg_result = $this->db->get('edu_year yr')->result_array();

        return $deg_result;
    }

    function link_course_year($course_id) {
        $this->db->select('yr.*,de.course_code,de.course_code');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('yr.course_id', $course_id);
        $years = $this->db->get('edu_year yr')->row_array();

        return $years;
    }

    function save_semester($data) {
        $year_id = $this->get_course_year($data['course_id']);
        if (empty($data['semester_id'])) {
            $insert_semester = array(
                'year_id' => $year_id,
                'year_no' => $data['year_no'],
                'no_of_semester' => $data['no_of_semester'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $result = $this->db->insert('edu_semester', $insert_semester);
            $this->logger->systemlog('Manage Semester', 'Success', 'Semester Inserted Successfully.', date("Y-m-d H:i:s", now()));
        } else {
            $update_semester = array(
                'no_of_semester' => $data['no_of_semester'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('id', $data['semester_id']);
            $result = $this->db->update('edu_semester', $update_semester);
            $this->logger->systemlog('Manage Semester', 'Success', 'Semester Updated Successfully.', date("Y-m-d H:i:s", now()));
        }
        return $result;
    }

    function view_semester() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('sem.*,sem.id as semester_id,sem.deleted as semester_deleted, yr.*, dre.*, dre.id as course_id');
        $this->db->join('edu_year yr', 'yr.id=sem.year_id');
        $this->db->join('edu_course dre', 'dre.id=yr.course_id');
//        $this->db->join('edu_faculty fa', 'fa.id=dre.faculty_id');
//        $this->db->where_in('dre.faculty_id',$faclist);
//        $this->db->where('fa.deleted', 0);
        $result = $this->db->get('edu_semester sem')->result_array();

        return $result;
    }

//    function edit_semester($semester_id) {
//        //$this->db->where('deleted', '0');
////        $this->db->where('id', $semester_id);
////        $edit_sem = $this->db->get('semester')->row_array();
////
////        return $edit_sem;
//
//        $this->db->select('*, de.id as course_id');
//        $this->db->where('se.id', $semester_id);
//        $this->db->join('year yr', 'yr.id=se.year_id');
//        $this->db->join('edu_course de', 'de.id=yr.course_id');
//        $semesters = $this->db->get('semester se')->row_array();
//
//        $this->db->where('sd.semester_id', $semester_id);
//        $this->db->where('sd.deleted', 0);
//        $this->db->join('semester s', 's.id=sd.semester_id');
//        $semester_details = $this->db->get('semester_details sd')->result_array();
//
//        $all = array(
//            "semesters" => $semesters,
//            "semester_details" => $semester_details
//        );
//
//        return $all;
//    }

    function update_semester_status($data) {

        $update_data = array(
            'deleted' => $data['new_status'],
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $data['semester_id']);
        $result = $this->db->update('edu_semester', $update_data);

        if (count($result) > 0) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Course Semester Deactivated Successfully.');
                $this->logger->systemlog('Update Course Status', 'Success', 'Course Semester Deactivated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Course Semester Activated Successfully.');
                $this->logger->systemlog('Update Course Status', 'Success', 'Course Semester Activated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate Course Semester. Retry.');
                $this->logger->systemlog('Update Course Status', 'Failure', 'Failed to Deactivate Course Semester.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate Course Semester. Retry.');
                $this->logger->systemlog('Update Course Status', 'Failure', 'Failed to Activate Course Semester.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            }
        }
    }

    function get_course_year($course_id) {
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_year')->row()->id;
        
//        foreach ($result as $row) {
//            return $row['id'];
//        }
        return $result;
    }

//    function delete_semester_details($semester_id) {
//        $update_data = array(
//            'deleted' => 1,
//            'deleted_by' => $this->session->userdata('u_id'),
//            'deleted_on' => date("Y-m-d h:i:s", now())
//        );
//        $this->db->where('semester_id', $semester_id);
//        $result = $this->db->update('semester_details', $update_data);
//        return $result;
//    }
//    function semester_details($semeter_id) {
//        $this->db->select('*');
//        $this->db->where('semester_id', $semeter_id);
//        $this->db->where('deleted', 0);
//        $result = $this->db->get('semester_details')->result_array();
//
//        return $result;
//    }

    function exists_semester_records($course_id, $year_no) {
        $this->db->select('sem.id');
        $this->db->join('edu_year yr', 'yr.id=sem.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('sem.year_no', $year_no);
        $this->db->where('de.id', $course_id);
        $this->db->where('sem.deleted', 0);
//        $this->db->where('yr.deleted', 0);
//        $this->db->where('de.deleted', 0);
        $result = $this->db->get('edu_semester sem')->row_array();

        if (count($result) > 0) {
            return $result['id'];
        } else {
            return NULL;
        }
    }

    function get_year_semesters($course_id, $year_no) {

        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('sem.no_of_semester');
        $this->db->join('edu_year yr', 'yr.id=sem.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('sem.year_no', $year_no);
        $this->db->where('de.id', $course_id);
        //$this->db->where_in('de.faculty_id', $faclist);
        $this->db->where('sem.deleted', 0);
        $result = $this->db->get('edu_semester sem')->row_array();

        if ($result) {
            
                return $result['no_of_semester'];

        } else {
            return NULL;
        }
    }
    
    
    
    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }
    
    
    function load_course_programs() {
        $this->db->select('de.*, de.id as course_id');
        $this->db->where('de.deleted', 0);
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    
    
    function load_course_programs_by_centers(){
        
        $this->db->select('*');
        $this->db->join('edu_center_course edc', 'ec.id=edc.course_id');
        $this->db->where('edc.center_id',$this->session->userdata('user_branch'));
        $this->db->where('ec.deleted', 0);
        $deg_result = $this->db->get('edu_course ec')->result_array();

        return $deg_result;
    }

    
    function get_center_admin_login_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');
        
        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();
        
        return $user_centers;
    }
    
    
    function get_login_user_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');
        
        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }
    
     function load_course_by_center() {

        $this->db->select('*');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->join('edu_center_course ecde', 'de.id=ecde.course_id');
        $this->db->where('yr.deleted', 0);
        $this->db->where('ecde.center_id', $this->session->userdata('user_branch'));
        $this->db->group_by('ecde.center_id');
        $deg_result = $this->db->get('edu_year yr')->result_array();

        return $deg_result;
    }
    
}

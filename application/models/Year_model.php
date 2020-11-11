<?php

class Year_model extends CI_Model {

    function load_course() {
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        $this->db->select('*');
//        $this->db->where_in('faculty_id',$faclist);
        $this->db->where('deleted', 0);
        $deg_result = $this->db->get('edu_course')->result_array();

        return $deg_result;
    }

    function course_year_save($data) {

        $insert_data = array(
            'course_id' => $data['course_id'],
            'no_of_year' => $data['no_of_year'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'no_of_year' => $data['no_of_year'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['year_id'])) {
            $result = $this->db->insert('edu_year', $insert_data);
            $this->logger->systemlog('Manage Education Year', 'Success', 'Education Year Added successfully', date("Y-m-d H:i:s", now()));
        } else {
            $this->db->where('id', $data['year_id']);
            $result = $this->db->update('edu_year', $update_data);
            $this->logger->systemlog('Manage Education Year', 'Success', 'Education Year Updated successfully', date("Y-m-d H:i:s", now()));
        }

        return $result;
    }

    function get_course_year() {
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
//        $this->db->select('yr.*,de.course_code,de.course_code,de.description,fa.faculty_code,fa.id as faculty_id');
        $this->db->select('yr.*,de.course_code,de.course_code,de.course_name,de.description,yr.id as year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $this->db->where('de.deleted', 0);
        $degyear = $this->db->get('edu_year yr')->result_array();

        return $degyear;
    }

    function update_year_status($data) {

        $update_data = array(
            'deleted' => $data['new_status'],
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $data['year_id']);
        $result = $this->db->update('edu_year', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Course Year Deactivated Successfully.');
                $this->logger->systemlog('Course Status Update', 'Success', 'Course Year Deactivated Successfully', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Course Year Activated Successfully.');
                $this->logger->systemlog('Course Status Update', 'Success', 'Course Year Activated Successfully', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate Course Year. Retry.');
                $this->logger->systemlog('Course Status Update', 'Failure', 'Failed to Deactivate Course Year', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate Course Year. Retry.');
                $this->logger->systemlog('Course Status Update', 'Failure', 'Failed to Activate Course Year', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            }
        }
    }

    function edit_course_year($year_id) {
        $this->db->select('yr.id as year_id, de.id as course_id,yr.no_of_year');
//        $this->db->select('yr.id as year_id, de.id as course_id, fa.id as faculty_id,yr.no_of_year');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where('de.deleted', 0);
//        $this->db->where('fa.deleted', 0);
        $this->db->where('yr.id', $year_id);
        $edit_year = $this->db->get('edu_year yr')->row_array();

        return $edit_year;
    }

    function is_existing_year($course_id) {
        $this->db->select('*');
        $this->db->where('course_id', $course_id);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_year')->result_array();
        if (!empty($result_array)) {
            return true;
        } else {
            return false;
        }
    }

    function load_course_programs() {
        $this->db->select('de.*, de.id as course_id');
        $this->db->where('de.deleted', 0);
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    
    function load_exam_mark_course_list()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
    
    
    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
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
    
}

<?php

class Course_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_course($data) {

        $insert_data = array(
            // 'faculty_id' => $data['faculty_id'],
            'course_code' => $data['d_code'],
            'course_name' => $data['d_name'],
            'total_creadit' => $data['t_creadit'],
            'description' => $data['des'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            // 'faculty_id' => $data['faculty_id'],
            'course_code' => $data['d_code'],
            'course_name' => $data['d_name'],
            'total_creadit' => $data['t_creadit'],
            'description' => $data['des'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['course_id'])) {
            $result = $this->db->insert('edu_course', $insert_data);
            $this->logger->systemlog('Manage Course Programs', 'Success', 'Created Course Successfully.', date("Y-m-d H:i:s", now()));
        } else {
            $this->db->where('id', $data['course_id']);
            $result = $this->db->update('edu_course', $update_data);
            $this->logger->systemlog('Manage Course Programs', 'Success', 'Updated Course Successfully.', date("Y-m-d H:i:s", now()));
        }

        return $result;
    }

    function get_all_courses() {
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        // $this->db->select('de.*, fa.*, de.deleted as course_deleted, de.id as course_id ');
        // $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        // $this->db->where_in('de.faculty_id',$faclist);
        // $this->db->where('fa.deleted', 0);
        $this->db->select('de.*, de.deleted as course_deleted, de.id as course_id ');
        $result_array = $this->db->get('edu_course de')->result_array();
        return $result_array;
    }

    function update_course_status($data) {
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
        $this->db->where('id', $data['course_id']);
        $result = $this->db->update('edu_course', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Course Deactivated Successfully.');
                $this->logger->systemlog('Update Course Status', 'Success', 'Course Deactivated Successfully.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Course Activated Successfully.');
                $this->logger->systemlog('Update Course Status', 'Success', 'Course Activated Successfully.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate course. Retry.');
                $this->logger->systemlog('Update Course Status', 'Failure', 'Failed to Deactivate course.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate course. Retry.');
                $this->logger->systemlog('Update Course Status', 'Failure', 'Failed to Activate course.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            }
        }
        return $result;
    }

    function is_existing_course_code($course_code) {
        $this->db->select('id');
        $this->db->where('deleted', 0);
        $this->db->where('course_code', $course_code);
        $result = $this->db->get('edu_course')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function load_course_programs() {
        $this->db->select('de.*, de.id as course_id, yr.no_of_year');
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }

    function get_course() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('de.*, de.description as d_des,yr.id as year_id, yr.*,se.*');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $course_id = $this->db->get('edu_course de')->row_array();

        return $course_id;
    }

    function get_course_student($id) {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*');
        $this->db->where('stu_id', $id);

        $course_id = $this->db->get('stu_reg')->row_array();

        return $course_id;
    }

    function save_center_course_years($data) {
        $this->db->trans_begin();

        $this->db->where('center_id', $data['center_id']);
        $this->db->where('batch_id', $data['batch_id']);
        $this->db->where('course_id', $data['course_id']);

        $q = $this->db->get('edu_center_course');
        
        if ($q->num_rows() > 0) {
            
            $res['status'] = 'Failed';
            $res['message'] = 'Batch Already Exists';
        } else {
            if (empty($data['center_course_id'])) {
                //insert
                $insert_center_course = array(
                    'center_id' => $data['center_id'],
                    'course_id' => $data['course_id'],
                    'batch_id' => $data['batch_id'],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->insert('edu_center_course', $insert_center_course);

                $max_center_course_id = $this->get_max_center_course_id();
                for ($i = 0; $i < $data['total_years']; $i++) {
                    $insert_course_years = array(
                        'center_course_id' => $max_center_course_id,
                        'year_no' => $i + 1,
                        'year_start' => $data['year_start'][$i],
                        'year_end' => $data['year_end'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $this->db->insert('edu_center_course_year', $insert_course_years);
                }
            } else {
                //update
                $update_center_course = array(
                    'batch_id' => $data['batch_id'],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now())
                );

                $this->db->where('id', $data['center_course_id']);
                $this->db->update('edu_center_course', $update_center_course);

                for ($i = 0; $i < $data['total_years']; $i++) {
                    $c_d_year_id = $this->get_center_year_id($data['center_course_id'], ($i + 1));
                    $update_center_years = array(
                        'center_course_id' => $data['center_course_id'],
                        'year_no' => $i + 1,
                        'year_start' => $data['year_start'][$i],
                        'year_end' => $data['year_end'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );

                    if ($c_d_year_id != NULL) {
                        $this->db->where('id', $c_d_year_id);
                        $this->db->update('edu_center_course_year', $update_center_years);
                    } else {
                        $this->db->insert('edu_center_course_year', $update_center_years);
                    }
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to save subjects';
            } else {
                $this->db->trans_commit();
                $res['status'] = 'success';
                $res['message'] = 'Course Years saved successfully.';
            }
        }

        return $res;
    }

    function save_center_course_semesters($data) {
        $this->db->trans_begin();
        if (empty($data['center_year_id'])) {
            //insert
            $center_course_id = $this->get_center_course_id($data['center_id'], $data['course_id'], $data['batch_id']);
            if ($center_course_id != NULL) {
                $center_year_id = $this->get_center_year_id($center_course_id, $data['year_no']);

                for ($i = 0; $i < $data['total_semesters']; $i++) {
                    $insert_course_semesters = array(
                        'center_year_id' => $center_year_id,
                        'semester_no' => $i + 1,
                        'semester_start' => $data['semester_start'][$i],
                        'semester_end' => $data['semester_end'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $result = $this->db->insert('edu_center_course_semester', $insert_course_semesters);
                }
            } else {
                $this->db->trans_rollback();
                $res['status'] = 'Warning';
                $res['message'] = 'Please Enter Relevent Center Year Before Enter Semester';
                return $res;
            }
        } else {
            //update
            for ($i = 0; $i < count($data['semester_start']); $i++) {
                $center_semester_id = $this->get_center_semester_id($data['center_year_id'], ($i + 1));
                $update_course_semesters = array(
                    'semester_start' => $data['semester_start'][$i],
                    'semester_end' => $data['semester_end'][$i],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->where('id', $center_semester_id);
                $result = $this->db->update('edu_center_course_semester', $update_course_semesters);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save subjects';
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Subjects saved successfully.';
        }
        return $res;
    }

    function get_center_semester_id($center_year_id, $semester_no) {
        $where_array = array(
            'center_year_id' => $center_year_id,
            'semester_no' => $semester_no
        );
        $this->db->select('id');
        $this->db->where($where_array);
        $result = $this->db->get('edu_center_course_semester')->row_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function get_max_center_course_id() {
        $this->db->select('MAX(id) as id');
        $result = $this->db->get('edu_center_course')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function get_center_course() {

        $branchlist = $this->auth->get_accessbranch();
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cd.deleted as c_d_deleted, cd.id as center_course_id');
        $this->db->join('edu_course de', 'de.id=cd.course_id');
        $this->db->join('cfg_branch br', 'br.br_id=cd.center_id');
        $this->db->join('edu_batch ba', 'ba.id=cd.batch_id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where_in('cd.center_id', $branchlist);
//        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_course cd')->result_array();
        return $result_array;
    }

    function get_center_course_years_all() {

        $branchlist = $this->auth->get_accessbranch();
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('cd.*,de.*,br.*,ba.*,dy.*,ds.deleted as c_d_s_deleted, dy.id as center_year_id');
        $this->db->join('edu_center_course_semester ds', 'dy.id=ds.center_year_id');
        $this->db->join('edu_center_course cd', 'cd.id=dy.center_course_id');
        $this->db->join('edu_course de', 'de.id=cd.course_id');
        $this->db->join('cfg_branch br', 'br.br_id=cd.center_id');
        $this->db->join('edu_batch ba', 'ba.id=cd.batch_id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where_in('cd.center_id', $branchlist);
//        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_course_year dy')->result_array();
        return array_unique($result_array, SORT_REGULAR);
    }

    function get_center_course_years($center_course_id) {

        $branchlist = $this->auth->get_accessbranch();
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*');
        $this->db->join('edu_center_course_year cy', 'cy.center_course_id=cd.id');
        $this->db->join('edu_course de', 'de.id=cd.course_id');
        $this->db->where('cd.id', $center_course_id);
        $this->db->where_in('cd.center_id', $branchlist);
//        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_course cd')->result_array();
        return $result_array;
    }

    function get_center_course_id($center_id, $course_id, $batch_id) {
        $this->db->select('id as center_course_id');
        $this->db->where('center_id', $center_id);
        $this->db->where('course_id', $course_id);
        $this->db->where('batch_id', $batch_id);
        $result_array = $this->db->get('edu_center_course')->result_array();
        if ($result_array) {
            foreach ($result_array as $row) {
                return $row['center_course_id'];
            }
        } else {
            return NULL;
        }
    }

    function get_center_year_id($center_course_id, $year_no) {
        $this->db->select('id as center_course_year_id');
        $this->db->where('center_course_id', $center_course_id);
        $this->db->where('year_no', $year_no);
        $result_array = $this->db->get('edu_center_course_year ')->result_array();
        if ($result_array) {
            foreach ($result_array as $row) {
                return $row['center_course_year_id'];
            }
        } else {
            return NULL;
        }
    }

    function change_center_year_status($data) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

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
        $this->db->where('id', $data['center_course_id']);
        $this->db->where_in('center_id', $branchlist);
        $result = $this->db->update('edu_center_course', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Center Course Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Center Course Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate center course. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate center course. Retry.');
            }
        }
        return $result;
    }

    function get_center_course_semesters($center_year_id) {

        $branchlist = $this->auth->get_accessbranch();
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cy.id as center_year_id');
        $this->db->join('edu_center_course_semester cs', 'cs.center_year_id=cy.id');
        $this->db->join('edu_center_course cd', 'cy.center_course_id=cd.id');
        $this->db->join('edu_course de', 'de.id=cd.course_id');
        $this->db->where('cy.id', $center_year_id);
        $this->db->where_in('cd.center_id', $branchlist);
//        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_course_year cy')->result_array();
        return $result_array;
    }

    function change_center_semester_status($data) {
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

        $center_semester_ids = $this->get_semester_by_center_id($data['center_year_id']);
        for ($i = 0; $i < count($center_semester_ids); $i++) {
            $this->db->where('id', $center_semester_ids[$i]['id']);
            $result = $this->db->update('edu_center_course_semester', $update_data);
        }

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Center Course Semster Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Center Course Semster Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate center course semester. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate center course semester. Retry.');
            }
        }
        return $result;
    }

    function get_semester_by_center_id($center_year_id) {
        $this->db->select('id');
        $this->db->where('center_year_id', $center_year_id);
        $result_array = $this->db->get('edu_center_course_semester')->result_array();
        return $result_array;
    }

    function load_courses_complete() {
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

    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }

    function get_center_admin_login_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }

    function load_course_programs_by_centers() {

        $this->db->select('*');
        $this->db->join('edu_center_course edc', 'ec.id=edc.course_id');
        $this->db->where('edc.center_id', $this->session->userdata('user_branch'));
        $this->db->where('ec.deleted', 0);
        $deg_result = $this->db->get('edu_course ec')->result_array();

        return $deg_result;
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

    function load_course_programs_centerwise() {
        $this->db->select('de.*, de.id as course_id, yr.no_of_year');
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_center_course ecde', 'de.id=ecde.course_id');
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $this->db->where('ecde.center_id', $this->session->userdata('user_branch'));
        $this->db->group_by('ecde.center_id');
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    
    
    function get_course_for_repeat() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('yr.id as year_id, yr.no_of_year as no_of_year');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $course_id = $this->db->get('edu_course de')->row_array();

        return $course_id;
    }

    function get_course_for_repeat_student($id) {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*, stu_reg.current_year as no_of_year');
        $this->db->where('stu_id', $id);

        $course_id = $this->db->get('stu_reg')->row_array();

        return $course_id;
    }
    
    
     function get_course_for_repeat_stu_mark() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('yr.id as year_id, yr.no_of_year as no_of_year');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $course_id = $this->db->get('edu_course de')->row_array();

        return $course_id;
    }

    
    function load_course_list_for_hod($ug_course) 
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        
        if($ug_course != NULL && $ug_course != ''){
            $this->db->where('cr.id', $ug_course);
        }
        
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
}

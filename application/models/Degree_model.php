<?php

class Degree_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_degree($data) {

        $insert_data = array(
            'faculty_id' => $data['faculty_id'],
            'degree_code' => $data['d_code'],
            'degree_name' => $data['d_name'],
            'total_creadit' => $data['t_creadit'],
            'description' => $data['des'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'faculty_id' => $data['faculty_id'],
            'degree_code' => $data['d_code'],
            'degree_name' => $data['d_name'],
            'total_creadit' => $data['t_creadit'],
            'description' => $data['des'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['degree_id'])) {
            $result = $this->db->insert('edu_degree', $insert_data);
        } else {
            $this->db->where('id', $data['degree_id']);
            $result = $this->db->update('edu_degree', $update_data);
        }

        return $result;
    }

    function get_all_degree() {
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('de.*, fa.*, de.deleted as degree_deleted, de.id as degree_id ');
        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where_in('de.faculty_id',$faclist);
        $this->db->where('fa.deleted', 0);
        $result_array = $this->db->get('edu_degree de')->result_array();
        return $result_array;
    }

    function update_degree_status($data) {
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
        $this->db->where('id', $data['degree_id']);
        $result = $this->db->update('edu_degree', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Degree Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Degree Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate degree. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate degree. Retry.');
            }
        }
        return $result;
    }

    function is_existing_degree_code($degree_code) {
        $this->db->select('id');
        $this->db->where('deleted', 0);
        $this->db->where('degree_code', $degree_code);
        $result = $this->db->get('edu_degree')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function load_degree_programs($faculty_id) {
        $this->db->select('fa.*,de.*, de.id as degree_id, yr.no_of_year');
        $this->db->join('edu_degree de', 'de.faculty_id=fa.id');
        $this->db->join('edu_year yr', 'de.id=yr.degree_id');
        $this->db->where('de.faculty_id', $faculty_id);
        $this->db->where('fa.deleted', 0);
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $degrees = $this->db->get('edu_faculty fa')->result_array();
        return $degrees;
    }

    function get_degree() {

        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('de.*, de.description as d_des,yr.id as year_id, yr.*,se.*');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.degree_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
        $this->db->where_in('de.faculty_id',$faclist);
        $degree_id = $this->db->get('edu_degree de')->row_array();

        return $degree_id;
    }

    function save_center_degree_years($data) {
        $this->db->trans_begin();
        if (empty($data['center_degree_id'])) {
            //insert
            $insert_center_degree = array(
                'center_id' => $data['center_id'],
                'degree_id' => $data['degree_id'],
                'batch_id' => $data['batch_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->insert('edu_center_degree', $insert_center_degree);

            $max_center_degree_id = $this->get_max_center_degree_id();
            for ($i = 0; $i < $data['total_years']; $i++) {
                $insert_degree_years = array(
                    'center_degree_id' => $max_center_degree_id,
                    'year_no' => $i + 1,
                    'year_start' => $data['year_start'][$i],
                    'year_end' => $data['year_end'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
               $this->db->insert('edu_center_degree_year', $insert_degree_years);
            }
        } else {
            //update
            $update_center_degree = array(
                'batch_id' => $data['batch_id'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );

            $this->db->where('id', $data['center_degree_id']);
            $this->db->update('edu_center_degree', $update_center_degree);

            for ($i = 0; $i < $data['total_years']; $i++) {
                $c_d_year_id = $this->get_center_year_id($data['center_degree_id'], ($i + 1));
                $update_center_years = array(
                    'center_degree_id' => $data['center_degree_id'],
                    'year_no' => $i + 1,
                    'year_start' => $data['year_start'][$i],
                    'year_end' => $data['year_end'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );

                if ($c_d_year_id != NULL) {
                    $this->db->where('id', $c_d_year_id);
                    $this->db->update('edu_center_degree_year', $update_center_years);
                } else {
                    $this->db->insert('edu_center_degree_year', $update_center_years);
                }
            }
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save courses';
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Courses saved successfully.';
        }
        return $res;
    }

    function save_center_degree_semesters($data) {
        $this->db->trans_begin();
        if (empty($data['center_year_id'])) {
            //insert
            $center_degree_id = $this->get_center_degree_id($data['center_id'], $data['degree_id'], $data['batch_id']);
            if ($center_degree_id != NULL) {
                $center_year_id = $this->get_center_year_id($center_degree_id, $data['year_no']);
                
                for ($i = 0; $i < $data['total_semesters']; $i++) {
                    $insert_degree_semesters = array(
                        'center_year_id' => $center_year_id,
                        'semester_no' => $i + 1,
                        'semester_start' => $data['semester_start'][$i],
                        'semester_end' => $data['semester_end'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $result = $this->db->insert('edu_center_degree_semester', $insert_degree_semesters);
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
                $update_degree_semesters = array(
                    'semester_start' => $data['semester_start'][$i],
                    'semester_end' => $data['semester_end'][$i],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->where('id', $center_semester_id);
                $result = $this->db->update('edu_center_degree_semester', $update_degree_semesters);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save courses';
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Courses saved successfully.';
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
        $result = $this->db->get('edu_center_degree_semester')->row_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function get_max_center_degree_id() {
        $this->db->select('id');
        $result = $this->db->get('edu_center_degree')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function get_center_degree() {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cd.deleted as c_d_deleted, cd.id as center_degree_id');
        $this->db->join('edu_degree de', 'de.id=cd.degree_id');
        $this->db->join('cfg_branch br', 'br.br_id=cd.center_id');
        $this->db->join('edu_batch ba', 'ba.id=cd.batch_id');
        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where_in('cd.center_id',$branchlist);
        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_degree cd')->result_array();
        return $result_array;
    }

    function get_center_degree_years_all() {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('cd.*,de.*,br.*,ba.*,fa.*,dy.*,ds.deleted as c_d_s_deleted, dy.id as center_year_id');
        $this->db->join('edu_center_degree_semester ds', 'dy.id=ds.center_year_id');
        $this->db->join('edu_center_degree cd', 'cd.id=dy.center_degree_id');
        $this->db->join('edu_degree de', 'de.id=cd.degree_id');
        $this->db->join('cfg_branch br', 'br.br_id=cd.center_id');
        $this->db->join('edu_batch ba', 'ba.id=cd.batch_id');
        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->where_in('cd.center_id',$branchlist);
        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_degree_year dy')->result_array();
        return array_unique($result_array,SORT_REGULAR);
    }

    function get_center_degree_years($center_degree_id) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*');
        $this->db->join('edu_center_degree_year cy', 'cy.center_degree_id=cd.id');
        $this->db->join('edu_degree de', 'de.id=cd.degree_id');
        $this->db->where('cd.id', $center_degree_id);
        $this->db->where_in('cd.center_id',$branchlist);
        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_degree cd')->result_array();
        return $result_array;
    }

    function get_center_degree_id($center_id, $degree_id, $batch_id) {
        $this->db->select('id as center_degree_id');
        $this->db->where('center_id', $center_id);
        $this->db->where('degree_id', $degree_id);
        $this->db->where('batch_id', $batch_id);
        $result_array = $this->db->get('edu_center_degree')->result_array();
        if ($result_array) {
            foreach ($result_array as $row) {
                return $row['center_degree_id'];
            }
        } else {
            return NULL;
        }
    }

    function get_center_year_id($center_degree_id, $year_no) {
        $this->db->select('id as center_degree_year_id');
        $this->db->where('center_degree_id', $center_degree_id);
        $this->db->where('year_no', $year_no);
        $result_array = $this->db->get('edu_center_degree_year ')->result_array();
        if ($result_array) {
            foreach ($result_array as $row) {
                return $row['center_degree_year_id'];
            }
        } else {
            return NULL;
        }
    }

    function change_center_year_status($data) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

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
        $this->db->where('id', $data['center_degree_id']);
        $this->db->where_in('center_id',$branchlist);
        $result = $this->db->update('edu_center_degree', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Center Degree Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Center Degree Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate center degree. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate center degree. Retry.');
            }
        }
        return $result;
    }

    function get_center_degree_semesters($center_year_id) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cy.id as center_year_id');
        $this->db->join('edu_center_degree_semester cs', 'cs.center_year_id=cy.id');
        $this->db->join('edu_center_degree cd', 'cy.center_degree_id=cd.id');
        $this->db->join('edu_degree de', 'de.id=cd.degree_id');
        $this->db->where('cy.id', $center_year_id);
        $this->db->where_in('cd.center_id',$branchlist);
        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get('edu_center_degree_year cy')->result_array();
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
            $result = $this->db->update('edu_center_degree_semester', $update_data);
        }

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Center Degree Semster Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Center Degree Semster Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate center degree semester. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate center degree semester. Retry.');
            }
        }
        return $result;
    }

    function get_semester_by_center_id($center_year_id) {
        $this->db->select('id');
        $this->db->where('center_year_id', $center_year_id);
        $result_array = $this->db->get('edu_center_degree_semester')->result_array();
        return $result_array;
    }

}

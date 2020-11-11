<?php

class Faculty_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_faculties() 
    {
        $this->db->select('*');
        $result_array = $this->db->get('edu_faculty')->result_array();
        return $result_array;
    }

    function is_existing_faculty_code($faculty_code) {
        $this->db->select('id');
        $this->db->where('deleted', 0);
        $this->db->where('faculty_code', $faculty_code);
        $result = $this->db->get('edu_faculty')->result_array();
        if ($result) {
            foreach ($result as $row){
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function save_faculty($data) {
        $insert_data = array(
            'faculty_code' => $data['faculty_code'],
            'faculty_name' => $data['faculty_name'],
            'description' => $data['faculty_des'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'faculty_code' => $data['faculty_code'],
            'faculty_name' => $data['faculty_name'],
            'description' => $data['faculty_des'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['faculty_id'])) {
            $result = $this->db->insert('edu_faculty', $insert_data);
        } else {
            $this->db->where('id', $data['faculty_id']);
            $result = $this->db->update('edu_faculty', $update_data);
        }

        return $result;
    }

    function update_faculty_status($data) {
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
        $this->db->where('id', $data['faculty_id']);
        $result = $this->db->update('edu_faculty', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Faculty Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Faculty Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate faculty. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate faculty. Retry.');
            }
        }
        return $result;
    }
    function all_active_faculties(){

        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*');
        $this->db->where_in('id', $faclist);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_faculty')->result_array();
        return $result_array;
    }
}

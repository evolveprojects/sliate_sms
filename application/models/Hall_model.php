<?php

class Hall_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_hall($data) {
        $insert_data = array(
           'center_id' => $data['c_name'],
            'hall_name' => $data['h_name'],
            'lecture_capacity' => $data['l_capacity'],
            'exam_capacity' => $data['e_capacity'],
            'description' => $data['des'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'center_id' => $data['c_name'],
            'hall_name' => $data['h_name'],
            'lecture_capacity' => $data['l_capacity'],
            'exam_capacity' => $data['e_capacity'],
            'description' => $data['des'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

      if (empty($data['hall_id'])) {
            $result = $this->db->insert('cfg_hall', $insert_data);
            $this->logger->systemlog('Manage Halls', 'Success', 'Hall Inserted successfully.', date("Y-m-d H:i:s", now()));
        } else {
            $this->db->where('id', $data['hall_id']);
            $result = $this->db->update('cfg_hall', $update_data);
            $this->logger->systemlog('Manage Halls', 'Success', 'Hall Updated successfully.', date("Y-m-d H:i:s", now()));
        }

        return $result;
    }

    function get_all_halls() {
        $this->db->select('*,ha.id as hall_id');
        $this->db->join('cfg_branch ce','ce.br_id = ha.center_id');

        $result_array = $this->db->get('cfg_hall ha')->result_array();
        return $result_array;
		
    }

    function get_all_centers() {
        $this->db->select('*');
        $result_array = $this->db->get('cfg_branch')->result_array();
        return $result_array;

    }
	
	function load_center()
{
	$this->db->select('*');
	$this->db->where('center',$this->input->post('c_id'));
	$center = $this->db->get('cfg_hall')->result_array();

	return $center;
}
    function update_subject_status($data) {
        $update_data = array(
            'deleted' => $data['new_status'],
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $data['hall_id']);
        $result = $this->db->update('cfg_hall', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess','Hall Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess','Hall Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError','Hall Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashError','Hall Activated Successfully.');
            }
        }
    }


}

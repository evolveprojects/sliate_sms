<?php

class Marking_model extends CI_Model {

    function load_marking_methods() {
        $this->db->select('*');
        $this->db->where('deleted',0);
        $result_array = $this->db->get('mod_marking_method')->result_array();
        return $result_array;
    }
    
    function load_marking_lookup() {

        $this->db->select('*');
        $marking_data = $this->db->get('mod_marking_method')->result_array();

        return $marking_data;
    }

    function get_all_marking_types() {
        $this->db->select('*');
        $this->db->where('status', 1);
        $result_array = $this->db->get('mod_marking_types')->result_array();
        return $result_array;
    }

    function max_marking_id() {
        $this->db->select('max(id)');
        $this->db->from('mod_marking_method');
        $result = $this->db->get()->row_array();
            return $result['max(id)'];
    }

    function count_marking_methods($id) {
        $this->db->select('count(id)');
        $this->db->from('mod_marking_details');
        $this->db->where('marking_method_id', $id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->row_array();
        if ($result) {
            return $result['count(id)'];
        } else {
            return NULL;
        }
//        foreach ($result as $row) {
            
//        }
    }

    function get_marking_method_ids($marking_method_id) {
        $this->db->select('*');
        $this->db->from('mod_marking_details');
        $this->db->where('marking_method_id', $marking_method_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function existing_marking_code($marking_code) {
        $this->db->select('*');
        $this->db->where('marking_code', $marking_code);
        $this->db->where('deleted', 0);
        $result = $this->db->get('mod_marking_method')->row_array();
        if ($result) {
            return $result['id'];
        } else {
            return NULL;
        }
    }

    function save_marking_method($data) {
        $this->db->trans_begin();
        $exists = $this->marking_model->existing_marking_code($data['m_code']);
        if (empty($data['marking_id'])) {
            if ($exists != NULL) {
                $this->db->trans_rollback();
                $res['status'] = 'Warning';
                $res['message'] = 'Marking Method Code Already Exists.';
                return $res;
            } else {
                $insert_marking_method = array(
                    'marking_code' => $data['m_code'],
                    'marking_name' => $data['m_name'],
                    'description' => $data['m_des'],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );

                $this->db->insert('mod_marking_method', $insert_marking_method);

                $max_id = $this->max_marking_id();
                for ($i = 0; $i < count($data['m_type']); $i++) {
                    $insert_marking_details = array(
                        'marking_method_id' => $max_id,
                        'type_id' => $data['m_type'][$i],
                        'name' => $data['mt_comment'][$i],
                        'percentage' => $data['mt_percentage'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $this->db->insert('mod_marking_details', $insert_marking_details);
                }
            }
        } else {
            if ($exists != NULL && $exists != $data['marking_id']) {
                $this->db->trans_rollback();
                $res['status'] = 'Warning';
                $res['message'] = 'Marking Method Code Already Exists.';
                return $res;
            } else {
                $update_marking_method = array(
                    'marking_code' => $data['m_code'],
                    'marking_name' => $data['m_name'],
                    'description' => $data['m_des'],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now())
                );

                $this->db->where('id', $data['marking_id']);
                $this->db->update('mod_marking_method', $update_marking_method);

                $num_of_methods = $this->count_marking_methods($data['marking_id']);

                if ($num_of_methods == count($data['m_type'])) {
                    for ($i = 0; $i < count($data['m_type']); $i++) {
                        $id_list = $this->get_marking_method_ids($data['marking_id']);
                        $update_marking_details = array(
                            'marking_method_id' => $data['marking_id'],
                            'type_id' => $data['m_type'][$i],
                            'name' => $data['mt_comment'][$i],
                            'percentage' => $data['mt_percentage'][$i],
                            'updated_by' => $this->session->userdata('u_id'),
                            'updated_on' => date("Y-m-d h:i:s", now())
                        );

                        //update
                        $this->db->where('id', $id_list[$i]['id']);
                        $this->db->update('mod_marking_details', $update_marking_details);
                    }
                } else {
                    $delete_marking_details = $this->delete_markings($data['marking_id']);
                    for ($i = 0; $i < count($data['m_type']); $i++) {
                        $insert_marking_details = array(
                            'marking_method_id' => $data['marking_id'],
                            'type_id' => $data['m_type'][$i],
                            'name' => $data['mt_comment'][$i],
                            'percentage' => $data['mt_percentage'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now())
                        );
                        $this->db->insert('mod_marking_details', $insert_marking_details);
                    }
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save Marking Method';
            $this->logger->systemlog('Marking Method Submission', 'Failure', 'Failed to save Marking Method', date("Y-m-d H:i:s", now()),$data);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Marking Method saved successfully.';
            $this->logger->systemlog('Marking Method Submission', 'Success', 'Marking Method saved successfully', date("Y-m-d H:i:s", now()),$data);
        }
        return $res;
        redirect('marking_method/marking_view');
    }

    function delete_markings($id) {
        $update_data = array(
            'deleted' => 1,
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('marking_method_id', $id);
        $result = $this->db->update('mod_marking_details', $update_data);
        return $result;
    }

    function change_marking_status($data) {
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

        $this->db->where('id', $data['marking_id']);
        $result = $this->db->update('mod_marking_method', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Marking Method Deactivated Successfully.');
                $this->logger->systemlog('Marking Method Status Update', 'Success', 'Marking Method Deactivated Successfully', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashSuccess', 'Marking Method Activated Successfully.');
                $this->logger->systemlog('Marking Method Status Update', 'Success', 'Marking Method Activated Successfully', date("Y-m-d H:i:s", now()),$data);
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate Marking Method. Retry.');
                $this->logger->systemlog('Marking Method Status Update', 'Failure', 'Failed to Deactivate Marking Method', date("Y-m-d H:i:s", now()),$data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate Marking Method. Retry.');
                $this->logger->systemlog('Marking Method Status Update', 'Failure', 'Failed to Activate Marking Method', date("Y-m-d H:i:s", now()),$data);
            }
        }
        return $result;
    }
    
    function check_duplicate_marking_codes($data){
        
        $this->db->select('COUNT(id) as code_count');
        $this->db->where('marking_code', $data['marking_code']);
        $markcode_duplicate = $this->db->get('mod_marking_method')->row_array();
        
        return $markcode_duplicate;
    }

}

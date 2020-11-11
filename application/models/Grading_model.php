<?php

class Grading_model extends CI_Model {

    function load_grname() {

        $this->db->select('*');
        $grname = $this->db->get('mod_grading_method')->result_array();

        return $grname;
    }

    function load_grading_criteria() {
        $this->db->select('*');
        $this->db->from('mod_grading_criteria');
        $result_array = $this->db->get()->result_array();
        return $result_array;
    }
    
    function load_grading_methods() {
        $this->db->select('*');
        $this->db->from('mod_grading_method');
        $this->db->where('deleted',0);
        $result_array = $this->db->get()->result_array();
        return $result_array;
    }

    function save_grade($data) {
        if (empty($data['id'])) {
            $insert_grading_method = array(
                'grade_code' => $data['grcode'],
                'grade_name' => $data['grname'],
                'description' => $data['grdes'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );

            $result = $this->db->insert('mod_grading_method', $insert_grading_method);

            $next_id = $this->max_method_id();
            for ($i = 0; $i < count($data['grmethod']); $i++) {
                $insert_grading_details = array(
                    'grading_method_id' => $next_id,
                    'grade_group' => $data['grmethod'][$i],
                    'grade_mark' => $data['grmark'][$i],
                    'grade' => $data['grade'][$i],
                    'grade_rate' => $data['grrate'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $result2 = $this->db->insert('mod_grading_details', $insert_grading_details);
            }
        } else {
            $update_grdaing_method = array(
                'grade_code' => $data['grcode'],
                'grade_name' => $data['grname'],
                'description' => $data['grdes'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );

            $this->db->where('id', $data['id']);
            $result = $this->db->update('mod_grading_method', $update_grdaing_method);

            $num_of_methods = $this->count_methods($data['id']);

            if ($num_of_methods == count($data['grmethod'])) {
                for ($i = 0; $i < count($data['grmethod']); $i++) {
                    $id_list = $this->get_grading_method_ids($data['id']);
                    $update_grading_details = array(
                        'grading_method_id' => $data['id'],
                        'grade_group' => $data['grmethod'][$i],
                        'grade_mark' => $data['grmark'][$i],
                        'grade' => $data['grade'][$i],
                        'grade_rate' => $data['grrate'][$i],
                        'updated_by' => $this->session->userdata('u_id'),
                        'updated_on' => date("Y-m-d h:i:s", now())
                    );

                    //update
                    $this->db->where('id', $id_list[$i]['id']);
                    $result2 = $this->db->update('mod_grading_details', $update_grading_details);
                }
            } else {
                $delete_grading_details = $this->delete_gradings($data['id']);
                for ($i = 0; $i < count($data['grmethod']); $i++) {
                    $insert_grade_details = array(
                        'grading_method_id' => $data['id'],
                        'grade_group' => $data['grmethod'][$i],
                        'grade_mark' => $data['grmark'][$i],
                        'grade' => $data['grade'][$i],
                        'grade_rate' => $data['grrate'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $result2 = $this->db->insert('mod_grading_details', $insert_grade_details);
                }
            }
        }
        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }

    function max_method_id() {
        $this->db->select('max(id)');
        $this->db->from('mod_grading_method');
        $result = $this->db->get()->row_array();
        foreach ($result as $row) {
            return $row['id'];
        }
    }

    function count_methods($id) {
        $this->db->select('count(id)');
        $this->db->from('mod_grading_details');
        $this->db->where('grading_method_id', $id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->row_array();
        foreach ($result as $row) {
            return $row['count(id'];
        }
    }

    function load_deg_method() {

        $this->db->select('gd.*,gm.id,gm.grade_name');
        $this->db->join('mod_grading_method gm', 'gm.id=gd.grading_method_id');
        $method = $this->db->get('mod_grading_details gd')->result_array();

        return $method;
    }

    function load_lookup() {

        $this->db->select('*');
        $gr_name = $this->db->get('mod_grading_method')->result_array();

        return $gr_name;
    }

    function edit_grading_method($id) {

        $this->db->where('id', $id);
        $method_gr = $this->db->get('mod_grading_method')->row_array();

        $this->db->where('grading_method_id', $id);
        $this->db->where('deleted', 0);
        $gr_details = $this->db->get('mod_grading_details')->result_array();

        $all = array(
            "method_gr" => $method_gr,
            "gr_details" => $gr_details
        );

        return $all;
    }

    function get_grading_method_ids($id) {
        $this->db->select('*');
        $this->db->from('mod_grading_details');
        $this->db->where('grading_method_id', $id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function delete_gradings($id) {
        $update_data = array(
            'deleted' => 1,
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('grading_method_id', $id);
        $result = $this->db->update('mod_grading_details', $update_data);
        return $result;
    }

    function update_grading_method_status($data) {
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

        $this->db->where('id', $data['id']);
        $result = $this->db->update('mod_grading_method', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Grading method Deactivated Successfully.');
                $this->logger->systemlog('Grading Method Status', 'Success', 'Grading method Deactivated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data,$update_data));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Grading method Activated Successfully.');
                $this->logger->systemlog('Grading Method Status', 'Success', 'Grading method Activated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data,$update_data));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate grading method. Retry.');
                $this->logger->systemlog('Grading Method Status', 'Faliure', 'Failed to Deactivate grading method.', date("Y-m-d H:i:s", now()), array_merge($data,$update_data));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate grading method. Retry.');
                $this->logger->systemlog('Grading Method Status', 'Faliure', 'Failed to Activate grading method.', date("Y-m-d H:i:s", now()), array_merge($data,$update_data));
            }
        }
        return $result;
    }
    
    function existing_grading_code($grading_code) {
        $this->db->select('id');
        $this->db->where('grade_code', $grading_code);
        $this->db->where('deleted', 0);
        $result = $this->db->get('mod_grading_method')->row_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function get_grade_by_marks($data) {
        $this->db->select('*');
        $this->db->join('mod_grading_criteria gc', 'gc.id=gd.grade_group');
        $this->db->where('gd.grading_method_id', $data['grading_id']);
        $this->db->where('gd.deleted', 0);
        $result_array = $this->db->get('mod_grading_details gd')->result_array();
        for ($i = 0; $i < count($result_array); $i++) {
            if ($result_array[$i]['criteria'] == '>') {
                if ($data['total_marks'] > $result_array[$i]['grade_mark']) {
                    return $result_array[$i]['grade'];
                }
            } else if ($result_array[$i]['criteria'] == '<') {
                if ($data['total_marks'] < $result_array[$i]['grade_mark']) {
                    return $result_array[$i]['grade'];
                }
            } else if ($result_array[$i]['criteria'] == '>=') {
                if ($data['total_marks'] >= $result_array[$i]['grade_mark']) {
                    return $result_array[$i]['grade'];
                }
            } else if ($result_array[$i]['criteria'] == '<=') {
                if ($data['total_marks'] <= $result_array[$i]['grade_mark']) {
                    return $result_array[$i]['grade'];
                }
            } else {
                if ($data['total_marks'] == $result_array[$i]['grade_mark']) {
                    return $result_array[$i]['grade'];
                }
            }
        }
    }

    function get_grades($data) {
        $this->db->select('gd.grade_mark,gd.grade,gd.grade_rate,gc.criteria');
        $this->db->join('mod_grading_criteria gc', 'gc.id=gd.grade_group');
        $this->db->where('gd.grading_method_id', $data['grading_id']);
        $this->db->where('gd.deleted', 0);
        $this->db->where('gc.status', 1);
        $result_array = $this->db->get('mod_grading_details gd')->result_array();
        return $result_array;

    }

    
    function check_duplicate_grading_codes($data){
        
        $this->db->select('COUNT(id) as grade_count');
        $this->db->where('grade_code', $data['grading_code']);
        $gradecode_duplicate = $this->db->get('mod_grading_method')->row_array();
        
        return $gradecode_duplicate;
    }

}

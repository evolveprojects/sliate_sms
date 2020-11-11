<?php

class Subject_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
    }

    function save_subject($data)
    {
        $insert_data = array(
            'code' => $data['subject_code'],
            'subject' => $data['subject_name'],
            'component' => $data['component_type_id'],
            'type' => $data['subject_type_id'],
            'credits' => $data['subject_credit'],
            'version_id' => $data['subject_version'],
            'is_gpa_apply'=> $data['is_gpa_apply'],
            'is_training_apply'=> $data['is_training_apply'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'code' => $data['subject_code'],
            'subject' => $data['subject_name'],
            'component' => $data['component_type_id'],
            'type' => $data['subject_type_id'],
            'credits' => $data['subject_credit'],
            'version_id' => $data['subject_version'],
            'is_gpa_apply'=> $data['is_gpa_apply'],
            'is_training_apply'=> $data['is_training_apply'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $insert_version_data = array(
            'mod_subject_id' => $data['subject_id'],
            'old_version_id' => $data['subject_old_version'],
            'update_by' => $this->session->userdata('u_id'),
            'update_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['subject_id'])) {
            $result = $this->db->insert('mod_subject', $insert_data);
        } else {

            $this->db->where('id', $data['subject_id']);
            $result = $this->db->update('mod_subject', $update_data);
            if ($data['update_subject_version'] == "1")
                $this->db->insert('mod_subject_version', $insert_version_data);
        }

        return $result;
    }

    function get_all_subjects()
    {
        $this->db->select('*');
        //$this->db->join('cfg_subject_version csv','csv.version_id = mod_subject.version_id');  
        $this->db->where('deleted', 0);
        $this->db->order_by('code', 'ASC');
        $result_array = $this->db->get('mod_subject')->result_array();

        return $result_array;
    }

    function get_all_subject_version()
    {
        $this->db->select('*');
        $this->db->where('status', 0);
        $result_array = $this->db->get('cfg_subject_version')->result_array();
        return $result_array;
    }

    function update_subject_status($data)
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

        $this->db->where('id', $data['subject_id']);
        $result = $this->db->update('mod_subject', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Subject Deactivated Successfully.');
                $this->logger->systemlog('Update Subject Status', 'Success', 'Subject Deactivated Successfully.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashSuccess', 'Subject Activated Successfully.');
                $this->logger->systemlog('Update Subject Status', 'Success', 'Subject Activated Successfully.', date("Y-m-d H:i:s", now()), $data);
                
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate subject. Retry.');
                $this->logger->systemlog('Update Subject Status', 'Faliure', 'Failed to Deactivate subject.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate subject. Retry.');
                $this->logger->systemlog('Update Subject Status', 'Faliure', 'Failed to Activate subject.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        return $result;
    }

    function get_all_subject_groups()
    {
        $this->db->select('*');
        $result_array = $this->db->get('mod_subject_group')->result_array();
        return $result_array;
    }

    function get_all_active_subject_groups()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('mod_subject_group')->result_array();
        return $result_array;
    }

    function save_subject_group($data)
    {

        $u_used = 'false';
        $u_used_subjects = [];
        $delete_subjects = '';
        $msg = false;
        $del_msg = false;
        $y = 0;
        $ne = '';
        $z = 0;
        $subj_name = [];
        $del_msg = 'false';

        $this->db->trans_begin();
        $exists = $this->existing_subject_group_name($data['group_name']);
        if (empty($data['group_id'])) {
            if ($exists != NULL) {
                $this->db->trans_rollback();
                //$res['status'] = 'Warning';
                //$res['message'] = 'Group Name Already Exists.';
                //return $res;
            } else {
                $insert_subject_group = array(
                    'group_name' => $data['group_name'],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );

                $this->db->insert('mod_subject_group', $insert_subject_group);

                $next_id = $this->max_subject_group_id();
                //for ($i = 0; $i < count($data['subject_name']); $i++) {
                for ($i = 0; $i < count($data['subject_code']); $i++) {
                    $insert_group_subject = array(
                        'subject_group_id' => $next_id,
                        //'subject_id' => $data['subject_name'][$i],
                        'subject_id' => $data['subject_code'][$i],
                        'subject_version' => $data['subject_version'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );

                    $this->db->insert('mod_subject_group_subject', $insert_group_subject);
                }
            }
        } else {
            if ($exists != NULL && $exists != $data['group_id']) {
                $this->db->trans_rollback();
                // $res['status'] = 'Warning';
                // $res['message'] = 'Group Name Already Exists.';
                //return $res;
            } else {
                $update_subject_group = array(
                    'group_name' => $data['group_name'],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->where('id', $data['group_id']);
                $this->db->update('mod_subject_group', $update_subject_group);

                $num_of_subjects = $this->count_subjects($data['group_id']);

                if ($num_of_subjects <= count($data['subject_code'])) {
                    for ($i = 0; $i < count($data['subject_code']); $i++) {
                        $cgrp_has_cid = $this->get_subject_group_has_subject_id($data['group_id'], $data['subject_code'][$i]);

                        $is_subj_used = $this->get_subject_is_used($data['subject_rowid'][$i], $data['subject_code'][$i], $data['subject_version'][$i], $data['group_id']);

                        $update_group_subject = array(
                            'subject_id' => $data['subject_code'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now())
                        );

                        $insert_group_subject = array(
                            'subject_group_id' => $data['group_id'],
                            'subject_id' => $data['subject_code'][$i],
                            'subject_version' => $data['subject_version'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now())
                        );
                        if ($cgrp_has_cid == NULL) {
                            if ($data['subject_rowid'][$i] == "") {
                                //insert
                                $this->db->insert('mod_subject_group_subject', $insert_group_subject);
                            } else {
                                //update
                                //$this->db->where('id', $cgrp_has_cid);
                                if ($is_subj_used == "0") {
                                    $this->db->where('subject_group_id', $data['group_id']);
                                    $this->db->where('id', $data['subject_rowid'][$i]);
                                    $this->db->update('mod_subject_group_subject', array('subject_id' => $data['subject_code'][$i]));
                                } else {
                                    $msg = true;
                                    $u_used_subjects[$y] = $data['subject_rowid'][$i];
//                                    
                                    $y++;
                                }
                            }

                        } else {
                            //update
                            if ($is_subj_used == "0") {
                                $this->db->where('id', $cgrp_has_cid);
                                $this->db->update('mod_subject_group_subject', $update_group_subject);
                            }
                        }
                    }
                } else {
                    $delete_subjects = $this->delete_group_subjects($data['group_id'], $data['subject_rowid']);

                    // for ($i = 0; $i < count($data['subject_code']); $i++) {

                    //  if(array_key_exists($data['subject_code'][$i],$delete_subjects['d_used_subjects']))
                    //  {
                    //var_dump("Key exists!");
                    // }
                    // else
                    //  {
                    //var_dump("Key does not exist!");
                    //
                    //$insert_group_subject = array(
                    //    'subject_group_id' => $data['group_id'],
                    //    'subject_id' => $data['subject_code'][$i],
                    //    'subject_version' => $data['subject_version'][$i],
                    //    'added_by' => $this->session->userdata('u_id'),
                    //    'added_on' => date("Y-m-d h:i:s", now())
                    //);

                    //$this->db->insert('mod_subject_group_subject', $insert_group_subject);
                    //  }

                    // }
                    //  }
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            //$res['status'] = 'Failed';
            //$res['message'] = 'Failed to save Subject Group';
            $this->session->set_flashdata('flashError', 'Failed to save Subject Group.');
            $this->logger->systemlog('Save Subject Group', 'Faliure', 'Failed to save Subject Group.', date("Y-m-d H:i:s", now()), $data);
        } else {
            $this->db->trans_commit();
            if ($msg == 'true') {

                foreach ($u_used_subjects as $usubj) {
                    $this->db->select('subject_id');
                    $this->db->where('id', $usubj);
                    $su = $this->db->get('mod_subject_group_subject')->row_array();

                    $this->db->select('subject');
                    $this->db->where('id', $su['subject_id']);
                    $subj_name[$z] = $this->db->get('mod_subject')->row_array();

                    $ne .= $subj_name[$z]['subject'] . ", ";
                    //$ne = implode(",", $subj_name[$z]);

                    $z++;
                }

                $ne = rtrim($ne, ', ');

                $this->session->set_flashdata('flashSuccess', 'Subject Group saved successfully. <span style="color:red;">But ' . $ne . ' already used. Cannot be updated. </span>');
                $this->logger->systemlog('Save Subject Group', 'Success', 'Subject Group saved successfully.But ' . $ne . ' already used. Cannot be updated.', date("Y-m-d H:i:s", now()), $data);

                //$res['status'] = 'success';
                //$res['message'] = 'Subject Group saved successfully. <span style="color:red;">But '.$ne.' already used. Cannot be updated. </span>';
            } else {

                $this->session->set_flashdata('flashSuccess', 'Subject Group saved successfully.');
                $this->logger->systemlog('Save Subject Group', 'Success', 'Subject Group saved successfully.', date("Y-m-d H:i:s", now()), $data);
                //$res['status'] = 'success';
                //$res['message'] = 'Subject group saved successfully.';
            }

            if ($delete_subjects) {
                if ($delete_subjects['del_msg'] == 'true') {
                    // $this->db->select('subject');
                    // $subj_name = $this->db->where('id', $delete_subjects['d_used_subjects']);
                    foreach ($delete_subjects['d_used_subjects'] as $dsubj) {
                        $this->db->select('subject_id');
                        $this->db->where('id', $dsubj);
                        $d_su = $this->db->get('mod_subject_group_subject')->row_array();

                        $this->db->select('subject');
                        $this->db->where('id', $d_su['subject_id']);
                        $subj_name[$z] = $this->db->get('mod_subject')->row_array();

                        $ne .= $subj_name[$z]['subject'] . ", ";
                        //$ne = implode(",", $subj_name[$z]);

                        $z++;
                    }

                    $ne = rtrim($ne, ', ');

                    $this->session->set_flashdata('flashSuccess', 'Subject Group saved successfully. <span style="color:red;">But ' . $ne . ' already used. Cannot be deleted. </span>');
                    $this->logger->systemlog('Save Subject Group', 'Success', 'Subject Group saved successfully.But ' . $ne . ' already used. Cannot be deleted.', date("Y-m-d H:i:s", now()), $data);

                    //$res['status'] = 'success';
                    //$res['message'] = 'Subject Group saved successfully. <span style="color:red;">But  is already used. Cannot be deleted. </span>';
                } else {
                    $this->session->set_flashdata('flashSuccess', 'Subject Group saved successfully.');
                    $this->logger->systemlog('Save Subject Group', 'Success', 'Subject Group saved successfully.', date("Y-m-d H:i:s", now()), $data);


                    //$res['status'] = 'success';
                    //$res['message'] = 'Subject group saved successfully.';
                }
            }
        }
        //return $res;
    }

    function max_subject_group_id()
    {
        $this->db->select('max(id)');
        $this->db->from('mod_subject_group');
        $result = $this->db->get()->row_array();
        //foreach ($result as $row) {
        //   return $row['max(id)'];
        //}
        return $result['max(id)'];
    }

    function get_subject_group_has_subject_id($group_id, $subject_id)
    {
        $where_array = array(
            'subject_group_id' => $group_id,
            'subject_id' => $subject_id);
        $this->db->select('*');
        $this->db->from('mod_subject_group_subject');
        $this->db->where($where_array);

        //edit if need
        $this->db->where('deleted', 0);
        $result = $this->db->get()->row_array();
        if (!empty($result)) {
            //foreach ($result as $row) {
            //    return $row['id'];
            //}
            return $result['id'];
        } else {
            return NULL;
        }
    }

    function get_subject_is_used($row_id, $subject, $version, $group)
    {

        $this->db->select('subject_id');
        $this->db->where('id', $row_id);
        $subj_code = $this->db->get('mod_subject_group_subject')->row_array();


        $this->db->select('count(id)');
        $this->db->from('stu_follow_subject');
        $this->db->where('subject_id', $subj_code['subject_id']);
        $this->db->where('subj_group', $group);
        $this->db->where('version_id', $version);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->row_array();

        return $result['count(id)'];
    }

    function count_subjects($group_id)
    {
        $this->db->select('count(id)');
        $this->db->from('mod_subject_group_subject');
        $this->db->where('subject_group_id', $group_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->row_array();
        //foreach ($result as $row) {
        //    return $row['count(id)'];
        //}
        return $result['count(id)'];
    }

    function edit_group_load($group_id)
    {
        $this->db->where('id', $group_id);
        $groups = $this->db->get('mod_subject_group')->row_array();

        $this->db->select('*, cg.id as subj_row_id');
        $this->db->where('cg.subject_group_id', $group_id);
        $this->db->where('cg.deleted', 0);
        $this->db->join('mod_subject c', 'c.id=cg.subject_id');
        $subjects = $this->db->get('mod_subject_group_subject cg')->result_array();

        $all = array(
            "group" => $groups,
            "subjects" => $subjects
        );

        return $all;
    }

    function update_subject_group_status($data)
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

        $this->db->where('id', $data['group_id']);
        $result = $this->db->update('mod_subject_group', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Subject Group Deactivated Successfully.');
                $this->logger->systemlog('Subject Group Status', 'Success', 'Subject Group Deactivated Successfully.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashSuccess', 'Subject Group Activated Successfully.');
                $this->logger->systemlog('Subject Group Status', 'Success', 'Subject Group Activated Successfully.', date("Y-m-d H:i:s", now()), $data);
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate subject group. Retry.');
                $this->logger->systemlog('Subject Group Status', 'Faliure', 'Failed to Deactivate subject group.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate subject group. Retry.');
                $this->logger->systemlog('Subject Group Status', 'Faliure', 'Failed to Activate subject group.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        return $result;
    }

    function delete_group_subjects($group_id, $rowid)
    {

        $del_msg = 'false';
        $d_used_subjects = [];
        $result = [];
        $x = 0;

        $this->db->select('*');
        $this->db->where('subject_group_id', $group_id);
        $this->db->where('deleted', 0);
        $subj_in_group = $this->db->get('mod_subject_group_subject')->result_array();

        foreach ($subj_in_group as $row) {
            $array[] = $row['id']; // add each user id to the array
        }

        $result = array_diff($array, $rowid);

        $key = key($result);
        // print_r($result);die();

        //for($s = 0; $s < count($subj_in_group); $s++){

        $is_subj_used = $this->get_subject_is_used($result[$key], $subj_in_group[$key]['subject_id'], $subj_in_group[$key]['subject_version'], $group_id);

        //print_r("used = ".$is_subj_used." row id = ".$subj_in_group[$s]['id']."subj id = ".$subj_in_group[$s]['subject_id']);
        if ($is_subj_used == "0") {
            $update_data = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('subject_group_id', $group_id);
            $this->db->where('subject_id', $subj_in_group[$key]['subject_id']);
            $result['result'] = $this->db->update('mod_subject_group_subject', $update_data);
            $result['del_msg'] = 'false';
        } else {
            $result['del_msg'] = 'true';
            $result['d_used_subjects'][$x] = $subj_in_group[$key]['subject_id'];
        }

        $x++;
        //}

//        $use = array(
//                "d_used" => $d_used,
//                "d_used_subjects" => $d_used_subjects,
//                "result" => $result
//            );

        //var_dump($result);die();

        return $result;
    }

    function existing_subject_code($subject_code)
    {
        $this->db->select('id');
        $this->db->where('code', $subject_code);
        $this->db->where('deleted', 0);
        $result = $this->db->get('mod_subject')->row_array();

        //  print_r($result);
        if ($result) {
            //foreach ($result as $row) {
            //            print_r($row['id']);

            //    return $row['id'];
            return $result['id'];
        } else {
            return NULL;
        }
    }

    function existing_subject_group_name($group_name)
    {
        $this->db->select('id');
        $this->db->where('group_name', $group_name);
        $this->db->where('deleted', 0);
        $result = $this->db->get('mod_subject_group')->row_array();

        if ($result) {
            //  foreach ($result as $row) {
            //return $row['id'];
            return $result['id'];
            // }
        } else {
            return NULL;
        }
    }

    function load_subject_credit($subject_id)
    {
        $this->db->select('credits');
        $this->db->where('id', $subject_id);
        $result = $this->db->get('mod_subject')->row_array();

        return $result['credits'];

    }

    function get_group_details($group_id)
    {
        $this->db->select('*');
        $this->db->join('mod_subject_group cg', 'cg.id=gc.subject_group_id');
        $this->db->join('mod_subject hc', 'hc.id=gc.subject_id');
        $this->db->where('cg.id', $group_id);
        $this->db->where('hc.deleted', 0);
        $this->db->where('gc.deleted', 0);
        $result_array = $this->db->get('mod_subject_group_subject gc')->result_array();
        return $result_array;
    }

    function get_sem_subject_details($sem_subject_id)
    {
        $this->db->select('*');
        $this->db->join('mod_subject hc', 'hc.id=scd.subject_id');
        $this->db->where('scd.semester_subject_id', $sem_subject_id);
        $this->db->where('scd.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject_details scd')->result_array();
        return $result_array;
    }

    function save_semester_subject($data)
    {
        $subject_details = $this->get_group_details($data['group_id']);
        if (empty($data['se_subject_id'])) {
            $sem_id = $this->get_course_semester_id($data['course_id'], $data['year_no']);
            //insert
            //insert mod_semester_subject
            $insert_array = array(
                'semester_id' => $sem_id,
                'semester_no' => $data['semester_no'],
                'batch_id' => $data['batch_code'],
                'study_season_id' => $data['s_season'],
                'subject_group_id' => $data['group_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $result = $this->db->insert('mod_semester_subject', $insert_array);
            $max_s_subject_id = $this->get_max_semester_subject_id();
            //insert mod_semester_subject_details
            for ($i = 0; $i < count($subject_details); $i++) {
                $insert_details_array = array(
                    'semester_subject_id' => $max_s_subject_id,
                    'subject_id' => $subject_details[$i]['subject_id'],
                    'new_credits' => $data['new_credits'][$i],
                    'version_id' => $data['v_method'][$i],
                    'grading_method_id' => $data['g_method'][$i],
                    'marking_method_id' => $data['m_method'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $result = $this->db->insert('mod_semester_subject_details', $insert_details_array);
            }
        } else {
            //delete previous subject details in c_semester_subject_details
            $this->delete_semester_subject_details($data['se_subject_id']);
            //update
            //update mod_semester_subject
            $update_data = array(
                'subject_group_id' => $data['group_id'],
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('id', $data['se_subject_id']);
            $result = $this->db->update('mod_semester_subject', $update_data);
            //update mod_semester_subject_details
            for ($i = 0; $i < count($subject_details); $i++) {
                $update_details_array = array(
                    'semester_subject_id' => $data['se_subject_id'],
                    'subject_id' => $subject_details[$i]['subject_id'],
                    'new_credits' => $data['new_credits'][$i],
                    'version_id' => $data['v_method'][$i],
                    'grading_method_id' => $data['g_method'][$i],
                    'marking_method_id' => $data['m_method'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $result = $this->db->insert('mod_semester_subject_details', $update_details_array);
            }
        }
        return $result;
    }

    function delete_semester_subject_details($semester_subject_id)
    {
        $update_array = array(
            'deleted' => 1,
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('semester_subject_id', $semester_subject_id);
        $result = $this->db->update('mod_semester_subject_details', $update_array);
        return $result;
    }

    function get_max_semester_subject_id()
    {
        $this->db->select('max(id)');
        $result = $this->db->get('mod_semester_subject')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['max(id)'];
            }
        } else {
            return NULL;
        }
    }

    function get_course_semester_id($course_id, $year_no)
    {
        $this->db->select('se.id as semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $result_array = $this->db->get('edu_semester se')->result_array();
        if ($result_array) {
            foreach ($result_array as $row) {
                return $row['semester_id'];
            }
        } else {
            return NULL;
        }
    }

    function get_all_semester_subjects()
    {
        $this->db->select('*,sc.deleted as y_c_deleted, sc.id as se_subject_id');
        $this->db->join('mod_subject_group cg', 'cg.id=sc.subject_group_id');
        $this->db->join('edu_semester se', 'se.id=sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->join('cfg_academicyears ac', 'ac.es_ac_year_id=sc.study_season_id');
        $this->db->join('edu_batch ba', 'ba.id=sc.batch_id');
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    function edit_semester_subjects($se_subject_id)
    {
        $this->db->select('*, cg.id as group_id');
        $this->db->join('mod_subject_group cg', 'cg.id=yc.subject_group_id');
        $this->db->join('edu_semester se', 'se.id=yc.semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('yc.id', $se_subject_id);
        $result_array = $this->db->get('mod_semester_subject yc')->row_array();
        return $result_array;
    }

    function update_year_subject_status($data)
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

        $this->db->where('id', $data['se_subject_id']);
        $result = $this->db->update('mod_semester_subject', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Year Subjects Deactivated Successfully.');
                $this->logger->systemlog('Year Subject Status', 'Success', 'Year Subjects Deactivated Successfully.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashSuccess', 'Year Subjects Activated Successfully.');
                $this->logger->systemlog('Year Subject Status', 'Success', 'Year Subjects Activated Successfully.', date("Y-m-d H:i:s", now()), $data);
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate year subjects. Retry.');
                $this->logger->systemlog('Year Subject Status', 'Faliure', 'Failed to Deactivate year subjects.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate year subjects. Retry.');
                $this->logger->systemlog('Year Subject Status', 'Faliure', 'Failed to Activate year subjects.', date("Y-m-d H:i:s", now()), $data);
            }
        }
        return $result;
    }

    function is_exist_semester_subjects($data)
    {
        $semester_id = $this->get_course_semester_id($data['course_id'], $data['year_no']);
        $this->db->select('id');
        $this->db->where('semester_no', $data['semester_no']);
        $this->db->where('semester_id', $semester_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get('mod_semester_subject')->row_array();
        if ($result) {
            return $row['id'];
        } else {
            return NULL;
        }
    }

    function load_semesters($course_id, $year_no)
    {
        $this->db->select('se.no_of_semester');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $result = $this->db->get('edu_semester se')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
    }

    function load_semesters_student($course_id, $year_no, $id)
    {
        $this->db->select('*');
        $this->db->where('stu_id', $id);
        $result = $this->db->get('stu_reg ')->row_array();
        if ($result) {
            return $result['current_semester'];
        } else {
            return NULL;
        }
    }

    function load_semester_subjects($data, $batch_details)
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        $this->db->select('*,co.type as subject_type');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        
        if($ug_level == 4){
            $this->db->join('sta_lecturer_subject ss', 'co.id = ss.subject_id');
            $this->db->where('ss.lecturer_id', $this->session->userdata('user_ref_id'));
            $this->db->where('ss.deleted', 0);
        }
        
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

    function semester_subjects_by_semester($data)
    {
        //$user_id = $this->session->userdata('u_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $sem_subjects_code = [];
                
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
        $this->db->where('sc.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
  
        foreach ($result_array as $subject) {
            $sem_subjects[] = $subject['subject_id'];
            $sem_subjects_code[] = array('subject_id' => $subject['subject_id'], 'code' => $subject['code'], 'subject' => $subject['subject']);
        }
       
        if($this->session->userdata('user_ref_id')!= null) {
            if($ug_level=='2'){
                $result_array[]['lecturer_subject'] = $sem_subjects_code;
            }
            else if($ug_level=='4')
                {
                $this->db->select('sls.subject_id,msb.code,msb.subject,sls.deleted');
                $this->db->join('mod_subject msb', 'msb.id = sls.subject_id');
                $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
                $this->db->where_in('sls.subject_id', $sem_subjects);
                $this->db->where('sld.stf_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sls.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject sls')->result_array();               
            }
            else {
                $this->db->select('sfs.subject_id,ms.code,ms.subject');
                $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
                $this->db->join('stu_subject sts', 'sts.id = sfs.student_subject_id');
                $this->db->where_in('sfs.subject_id', $sem_subjects);
                $this->db->where('sts.student_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sfs.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('stu_follow_subject sfs')->result_array(); 
            }
             
        }else{
            if($ug_level=='1' || $ug_level=='2' || $ug_level=='3'){
               $result_array[]['lecturer_subject'] = $sem_subjects_code;
            }          
            else{
                $result_array[]['lecturer_subject']=null;
            }
        }
 
        return $result_array;
    }
    
    
    function load_rpt_semester_subjects_by_semester($data)
    {
        //$user_id = $this->session->userdata('u_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $sem_subjects_code = [];
                
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
        $this->db->where('sc.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
  
        foreach ($result_array as $subject) {
            $sem_subjects[] = $subject['subject_id'];
            $sem_subjects_code[] = array('subject_id' => $subject['subject_id'], 'code' => $subject['code'], 'subject' => $subject['subject']);
        }
       
        if($this->session->userdata('user_ref_id')!= null) {
            if($ug_level=='2'){
                $result_array[]['lecturer_subject'] = $sem_subjects_code;
            }
            else if($ug_level=='4'){
    //             $this->db->select('sta_lecturer_subject.subject_id,mod_subject.code,mod_subject.subject');
    //             $this->db->join('mod_subject', 'mod_subject.id = sta_lecturer_subject.subject_id');
    //             $this->db->where_in('sta_lecturer_subject.subject_id', $sem_subjects);
    //             $this->db->where('lecturer_id', $this->session->userdata('user_ref_id'));
    //
    //             $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject')->result_array();
                
                $this->db->select('sls.subject_id,msb.code,msb.subject');
                $this->db->join('mod_subject msb', 'msb.id = sls.subject_id');
                $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
                $this->db->where_in('sls.subject_id', $sem_subjects);
                $this->db->where('sld.stf_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sls.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject sls')->result_array();               
            }
            else {
                $this->db->select('sfs.subject_id,ms.code,ms.subject');
                $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
                $this->db->join('stu_subject sts', 'sts.id = sfs.student_subject_id');
                $this->db->where_in('sfs.subject_id', $sem_subjects);
                $this->db->where('sts.student_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sfs.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('stu_follow_subject sfs')->result_array(); 
            }
             
        }else{
            if($ug_level=='1' || $ug_level=='2' || $ug_level=='3'){
               $result_array[]['lecturer_subject'] = $sem_subjects_code;
            }          
            else{
                $result_array[]['lecturer_subject']=null;
            }
        }
 
        return $result_array;
    }
    

    function semester_subjects_by_semester_mark($data)
    {
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
        $this->db->where('sc.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        foreach ($result_array as $subject) {
            $sem_subjects[] = $subject['subject_id'];
            $sem_subjects_code[] = array('subject_id' => $subject['subject_id'], 'code' => $subject['code']);
        }
         if($this->session->userdata('user_ref_id')!= null) {
             $this->db->select('sta_lecturer_subject.subject_id,mod_subject.code');
             $this->db->join('mod_subject', 'mod_subject.id = sta_lecturer_subject.subject_id');
             $this->db->where_in('sta_lecturer_subject.subject_id', $sem_subjects);
             $this->db->where('lecturer_id', $this->session->userdata('user_ref_id'));
             $this->db->where('sta_lecturer_subject.deleted', 0);

             $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject')->result_array();
         }else{
             if($this->session->userdata('u_id')=='1')
             $result_array[]['lecturer_subject'] = $sem_subjects_code;
             else
                 $result_array[]['lecturer_subject']=null;
         }
        return $result_array;
    }

    function check_duplicate_semester_subjects($data)
    {

        $sem_id = $this->get_course_semester_id($data['course'], $data['year']);

        $this->db->select('COUNT(id) as count');
        $this->db->where('semester_id', $sem_id);
        $this->db->where('semester_no', $data['semester']);
        $this->db->where('study_season_id', $data['s_season']);
        $this->db->where('batch_id', $data['batch_code']);
        $subj_duplicate = $this->db->get('mod_semester_subject')->row_array();

        return $subj_duplicate;

    }

    function load_edit_student_subjects()
    {

        $this->db->select('*, sc.id as stu_subj_id');
        $this->db->join('stu_reg reg', 'sc.student_id=reg.stu_id');
        $this->db->where('sc.id', $this->input->post('id'));
        $this->db->where('sc.year_no', $this->input->post('year_no'));
        $this->db->where('sc.semester_no', $this->input->post('semester_no'));
        $this->db->where('sc.deleted', 0);
        $result_array['stu_data'] = $this->db->get('stu_subject sc')->result_array();

        $data['course_id'] = $result_array['stu_data'][0]['course_id'];
        $data['semester_no'] = $result_array['stu_data'][0]['semester_no'];
        $data['batch_id'] = $result_array['stu_data'][0]['batch_id'];
        $data['year_no'] = $result_array['stu_data'][0]['year_no'];

        $result_array['all_subjects'] = $this->Student_model->get_semester_subjects($data);

        $this->db->select('*');
        $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id=sc.id');
        $this->db->where('sc.id', $this->input->post('id'));
        $this->db->where('sfs.deleted', 0);
        $result_array['follow_subject'] = $this->db->get('stu_subject sc')->result_array();

        return $result_array;

    }


    function load_courses_complete_by_center()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('*,de.*, de.id as course_id, yr.no_of_year');

        $this->db->join('edu_center_course ecc', 'ecc.course_id = de.id');
        //$this->db->join('cfg_branch br', 'br.br_id = ecc.center_id');
        $this->db->join('edu_year yr', 'de.id = yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id = yr.id');

        $this->db->where('ecc.center_id', $user_branch);
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $this->db->where('se.deleted', 0);
        $this->db->group_by('course_code');
        //$this->db->distinct();
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }


//    function edit_subject_load(){
//        $this->db->select('*');
//        $this->db->where('version_id', $this->input->post('version_id'));
//        $version_data = $this->db->get('cfg_subject_version')->row_array();
//
//        return $version_data;
//    }
    
    function get_group_core_subjects($group_id)
    {
        $this->db->select('hc.id');
        $this->db->join('mod_subject_group cg', 'cg.id=gc.subject_group_id');
        $this->db->join('mod_subject hc', 'hc.id=gc.subject_id');
        $this->db->where('cg.id', $group_id);
        $this->db->where('hc.type', 1);
        $this->db->where('hc.deleted', 0);
        $this->db->where('gc.deleted', 0);
        $result_array = $this->db->get('mod_subject_group_subject gc')->result_array();
        return $result_array;
    }

    function get_group_core_subject_version($group_id)
    {
        $this->db->select('hc.version_id');
        $this->db->join('mod_subject_group cg', 'cg.id=gc.subject_group_id');
        $this->db->join('mod_subject hc', 'hc.id=gc.subject_id');
        $this->db->where('cg.id', $group_id);
        $this->db->where('hc.type', 1);
        $this->db->where('hc.deleted', 0);
        $this->db->where('gc.deleted', 0);
        $result_array = $this->db->get('mod_subject_group_subject gc')->result_array();
        return $result_array;
    }
    
    
     function load_semesters_for_repeat($course_id, $year_no)
    {
        $this->db->select('se.no_of_semester');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $result = $this->db->get('edu_semester se')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
    }

    function load_semesters_for_repeat_student($course_id, $year_no, $id)
    {
        $this->db->select('*');
        $this->db->where('stu_id', $id);
        $result = $this->db->get('stu_reg ')->row_array();
        if ($result) {
            return $result['current_semester'];
        } else {
            return NULL;
        }
    }
    
    
    
     function load_semesters_for_repeat_mark($course_id, $year_no, $year_id)
    {
        $this->db->select('se.no_of_semester');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $this->db->where('se.year_id', $year_id);
        $result = $this->db->get('edu_semester se')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
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
    
    function dummy_save_exam_marks($data){
        /*
        $insert_exm_mark_array = array(
            array( 
                'student_id' => 11111,
                'course_id' => 22,
                'year_no' => 1,
                'semester_no' => 2,
                'batch_id' => 23,
                'sem_exam_id' => 32,
                'subject_id' => 182,
            ),
            array( 
                'student_id' => 22222,
                'course_id' => 22,
                'year_no' => 1,
                'semester_no' => 2,
                'batch_id' => 23,
                'sem_exam_id' => 32,
                'subject_id' => 182,
            ),
        );
        */
        /*
        foreach($insert_exm_mark_array as $row){
            $this->db->insert('exm_mark', $row);
            $max_exam_mark_id = $this->get_max_exam_mark_id();
            
            $insert_exm_mark_details_array = array(
                array(
                    'exam_mark_id' => $max_exam_mark_id,
                    'exam_type_id' => 1,
                    'persentage' => 50,
                    'mark' => 64,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                ),
                array(
                    'exam_mark_id' => $max_exam_mark_id,
                    'exam_type_id' => 2,
                    'persentage' => 50,
                    'mark' => 50,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                ),
            );
            
            foreach($insert_exm_mark_details_array as $v){
                $this->db->insert('exm_mark_details', $v);
            }
        }
         */
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    
    function get_student_details_for_excel_file_upload_from_db($data){
               
        $data['student_registration_number'] = $this->input->post('student_registration_number'); 
        $data['subject_code'] = $this->input->post('subject_code');  
     
        $this->db->select('stu_id');
        $this->db->where('reg_no', $data['student_registration_number']);
        $this->db->where('deleted', 0);       
        $student_details = $this->db->get('stu_reg')->row_array(); 
        
        $this->db->select('id');
        $this->db->where('code', $data['subject_code']);
        $this->db->where('deleted', 0);       
        $subject_details = $this->db->get('mod_subject')->row_array(); 

        $result = array(
            'student_id' => $student_details['stu_id'],
            'subject_id' => $subject_details['id']
        );        
        return $result; 
    }
     function get_is_attend_and_absent_reson_approve($row){
         
        $this->db->select('is_attend, is_absent_approve');
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('subject_id', $row['subject_id']);
        
        $attend_details = $this->db->get('exm_semester_exam_details')->row_array();        
        return $attend_details;       
    }


    //START - MARKS UPLOAD
    function get_student_details_and_upload($data){

//        $data['StudentRegNo'] = $this->input->post('StudentRegNo');
//        $data['SubjectName'] = $this->input->post('SubjectName');

        $this->db->select('stu_id');
        $this->db->where('reg_no', $data['StudentRegNo']);
        $this->db->where('deleted', 0);
        $student_details = $this->db->get('stu_reg')->row_array();

        $this->db->select('id');
        $this->db->where('code', $data['SubjectName']);
        $this->db->where('deleted', 0);
        $subject_details = $this->db->get('mod_subject')->row_array();

        $result = array(
            'student_id' => $student_details['stu_id'],
            'subject_id' => $subject_details['id']
        );
        return $result;
    }
    //END - MARKS UPLOAD



}

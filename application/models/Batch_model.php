<?php

class Batch_model extends CI_Model
{

    public function saveBatch($data)
    {

        $this->db->insert('batch', $data);
        $b_id = $this->db->insert_id();

        parent::__construct();
        $this->load->model('Batch_model');
        $this->load->helper(array('form', 'url'));
    }

    function all_batch_data()
    {
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        $this->db->select('*, ba.deleted as batch_deleted, ba.id as batch_id');
        $this->db->join('edu_course de', 'ba.course_id=de.id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->from('edu_batch ba');
//        $this->db->where_in('de.faculty_id',$faclist);
        $result_array = $this->db->get()->result_array();
        return $result_array;
    }

    function is_existing_batch_code($batch_code)
    {
        $this->db->select('id');
        $this->db->where('deleted', 0);
        $this->db->where('batch_code', $batch_code);
        $result = $this->db->get('edu_batch')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['id'];
            }
        } else {
            return NULL;
        }
    }

    function save_batch($data)
    {
        $this->db->trans_begin();
        $insert_data = array(
            'course_id' => $data['course_id'],
            'batch_code' => $data['batch_code'],
            'start_date' => $data['start_date'],
            'study_season_id' => $data['s_season_id'],
            'current_year' => 1,
            'current_semester' => 1,
            'description' => $data['description'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'course_id' => $data['course_id'],
            'batch_code' => $data['batch_code'],
            'start_date' => $data['start_date'],
            'study_season_id' => $data['s_season_id'],
            'description' => $data['description'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        $exists = $this->is_existing_batch_code($data['batch_code']);

        if (empty($data['batch_id'])) {
            if ($exists != NULL) {
                $this->db->trans_rollback();
                $res['status'] = 'Warning';
                $res['message'] = 'Batch Code Exists.Cannot insert record.';
                return $res;
            } else {
                $this->db->insert('edu_batch', $insert_data);
            }
        } else {
            if ($exists != NULL && $exists != $data['batch_id']) {
                $this->db->trans_rollback();
                $res['status'] = 'Warning';
                $res['message'] = 'Batch Code Exists.Cannot insert record.';
                return $res;
            } else {
                $this->db->where('id', $data['batch_id']);
                $this->db->update('edu_batch', $update_data);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save batch';
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Batch saved successfully.';
        }
        return $res;
    }

    function load_batch_edit($batch_id)
    {
//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*, ba.deleted as batch_deleted, ba.id as batch_id, ba.description as b_description');
        $this->db->join('edu_course de', 'ba.course_id=de.id');
//        $this->db->join('edu_faculty fa', 'fa.id=de.faculty_id');
        $this->db->join('edu_year yr', 'yr.course_id=de.id');
        $this->db->where('ba.id', $batch_id);
//        $this->db->where_in('de.faculty_id',$faclist);
        $result = $this->db->get('edu_batch ba')->row_array();

        return $result;
    }

    function update_batch_status($data)
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
        $this->db->where('id', $data['batch_id']);
        $result = $this->db->update('edu_batch', $update_data);
        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Batch Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Batch Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate batch. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate batch. Retry.');
            }
        }
        return $result;
    }

    function load_batches($course_id)
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }

    function load_batches_for_rpt_apply( $course_id, $stu_id, $rpt_selected_batch)
    {
        if ($stu_id != '') {
            $this->db->select('*');
            $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
            $this->db->where('edu_batch.deleted', 0);
            $this->db->where('edu_batch.course_id', $course_id);
            $this->db->where_not_in('edu_batch.id', $rpt_selected_batch);
            //$this->db->where('edu_batch.id > ', $batch_id);
            $this->db->where('stu_reg.stu_id', $stu_id);
            $result = $this->db->get('stu_reg')->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('deleted', 0);
           // $this->db->where('id >', $batch_id);           
            $this->db->where('course_id', $course_id);
            $this->db->where_not_in('id', $rpt_selected_batch);
            $result = $this->db->get('edu_batch')->result_array();

        }

        return $result;
    }

    function load_batches_student($course_id, $id)
    {
        $this->db->select('*');
        $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
        $this->db->where('edu_batch.deleted', 0);
        $this->db->where('edu_batch.course_id', $course_id);
        $this->db->where('stu_reg.stu_id', $id);
        $result = $this->db->get('stu_reg')->result_array();

        return $result;
    }

    function load_batches_by_season($study_season_id, $course_id)
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('study_season_id', $study_season_id);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }

    function batch_details_by_id($batch_id)
    {
        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_batch')->row_array();
        return $result_array;
    }

    
    function load_batches_for_rpt_approve( $course_id, $stu_id, $rpt_selected_batch, $rptYear, $rptSemester)
    {
        if ($stu_id != '') {
            $this->db->select('*');
            $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
            $this->db->where('edu_batch.deleted', 0);
            $this->db->where('edu_batch.course_id', $course_id);
            $this->db->where('edu_batch.current_year', $rptYear);
            $this->db->where('edu_batch.current_semester', $rptSemester);
            //--$this->db->where_not_in('edu_batch.id', $rpt_selected_batch);
            //$this->db->where('edu_batch.id > ', $batch_id);
            $this->db->where('stu_reg.stu_id', $stu_id);
            $result = $this->db->get('stu_reg')->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('deleted', 0);
           // $this->db->where('id >', $batch_id);           
            $this->db->where('course_id', $course_id);
            $this->db->where('current_year', $rptYear);
            $this->db->where('current_semester', $rptSemester);
            //--$this->db->where_not_in('id', $rpt_selected_batch);
            $this->db->where('id >', $rpt_selected_batch);
            $result = $this->db->get('edu_batch')->result_array();

        }
 
        return $result;
    }
    
    function get_course_batches($course_id)
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('iscompleted', 0);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }
    
    function get_exams_for_batches($batch_id,$year_no,$sem_no)
    {
        $this->db->select('*,ese.id as semester_exam_id');
        $this->db->join('exm_semester_exam ese ', 'ee.id=ese.exam_id');
        $this->db->where('ese.deleted', 0);
        $this->db->where('ee.deleted', 0);
        $this->db->where('ese.batch_id', $batch_id);
        $this->db->where('ese.year_no', $year_no);
        $this->db->where('ese.semester_no', $sem_no);
        $result = $this->db->get('exm_exam ee')->result_array();

        return $result;
    }
    
    function get_sem_exam_subjects ($sem_exam_id)
    {
        $this->db->select('*');
        $this->db->join('exm_semester_exam ese ', 'ese.id=esed.semester_exam_id');
        $this->db->join('mod_subject ms ', 'ms.id=esed.subject_id');
        $this->db->where('ese.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.id', $sem_exam_id);
        $this->db->group_by('esed.subject_id');
        $result = $this->db->get('exm_semester_exam_details esed')->result_array();

        return $result;
    }
    
    function get_assigned_lecturer ($subject_id)
    {
        $this->db->select('*');
        $this->db->join('sta_lecturer_details sld ', 'sld.stf_id=sls.lecturer_id');
        $this->db->join('com_title ct ', 'ct.id=sld.tit_name');
        $this->db->where('sld.deleted', 0);
        $this->db->where('sls.deleted', 0);
        $this->db->where('sls.subject_id', $subject_id);
        $result = $this->db->get('sta_lecturer_subject sls')->result_array();

        return $result;
    }
}

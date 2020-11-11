<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller
{

    public function Batch()
    {
        parent::__construct();
        $this->load->model('batch_model');
        $this->load->model('Util_model');
    }

    function save_batch()
    {
        //post values
        $data['batch_id'] = $this->input->post('batch_id');
        if (empty($data['batch_id'])) {
            $data['course_id'] = $this->input->post('load_Dcode');
        } else {
            $data['course_id'] = $this->input->post('course_id');
        }

        $data['batch_code'] = $this->input->post('batch_code');
        $data['start_date'] = $this->input->post('start_date');
        $data['s_season_id'] = $this->input->post('s_season');
        $data['description'] = $this->input->post('Bdes');

        echo json_encode($this->batch_model->save_batch($data));
    }

    function load_batch_edit()
    {
        $batch_id = $this->input->post('batch_id');
        echo json_encode($this->batch_model->load_batch_edit($batch_id));
    }

    function change_batch_status()
    {
        //post values
        $data['batch_id'] = $this->input->post('batch_id');
        $data['batch_code'] = $this->input->post('batch_code');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $exists = $this->batch_model->is_existing_batch_code($data['batch_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same Batch Code record exists. Cannot activate this record.');
            } else {
                echo json_encode($this->batch_model->update_batch_status($data));
            }
        } else {
            echo json_encode($this->batch_model->update_batch_status($data));
        }
    }

    function load_batches()
    {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->batch_model->load_batches($course_id));

        } else if ($ug_level == 2) { //
            echo json_encode($this->batch_model->load_batches($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->batch_model->load_batches($course_id));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->batch_model->load_batches($course_id));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->batch_model->load_batches_student($course_id, $this->session->userdata('user_ref_id')));

        }


    }

    function load_batches_for_rpt_apply()
    {
        $course_id = $this->input->post('course_id');
        $rpt_selected_batch = $this->input->post('rpt_selected_batch');
       // $batch_id = $this->input->post('batch_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->batch_model->load_batches_for_rpt_apply( $course_id, '', $rpt_selected_batch));

        } else if ($ug_level == 2) { //
            echo json_encode($this->batch_model->load_batches_for_rpt_apply( $course_id, '', $rpt_selected_batch));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->batch_model->load_batches_for_rpt_apply( $course_id, '', $rpt_selected_batch));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->batch_model->load_batches_for_rpt_apply( $course_id, '', $rpt_selected_batch));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            echo json_encode($this->batch_model->load_batches_for_rpt_apply( $course_id, $this->session->userdata('user_ref_id'), $rpt_selected_batch));

        }


    }

    function load_batches_by_season()
    {
        $study_season_id = $this->input->post('study_season_id');
        $course_id = $this->input->post('course_id');
        echo json_encode($this->batch_model->load_batches_by_season($study_season_id, $course_id));
    }
    
    function get_batch_details()
    {
        $batch_id = $this->input->post('batch_id');
        echo json_encode($this->batch_model->batch_details_by_id($batch_id));
    }
    
    
    function load_batches_for_rpt_approve()
    {
        $course_id = $this->input->post('course_id');
        $rptYear = $this->input->post('rptYear');
        $rptSemester = $this->input->post('rptSemester');
        $rpt_selected_batch = $this->input->post('rpt_selected_batch');
       // $batch_id = $this->input->post('batch_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->batch_model->load_batches_for_rpt_approve( $course_id, '', $rpt_selected_batch, $rptYear, $rptSemester));

        } else if ($ug_level == 2) { //
            echo json_encode($this->batch_model->load_batches_for_rpt_approve( $course_id, '', $rpt_selected_batch, $rptYear, $rptSemester));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->batch_model->load_batches_for_rpt_approve( $course_id, '', $rpt_selected_batch, $rptYear, $rptSemester));

        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->batch_model->load_batches_for_rpt_approve( $course_id, '', $rpt_selected_batch, $rptYear, $rptSemester));

            //get access rights to that user
        } else // Student
        {
            //get only logged in user records.
            //echo json_encode($this->batch_model->load_batches_for_rpt_approve( $course_id, $this->session->userdata('user_ref_id'), $rpt_selected_batch));

        }


    }
    
    function get_course_batches () {
        
        $course_id = $this->input->post('course_id');
        echo json_encode($this->batch_model->get_course_batches($course_id));

    }
    
    function get_exams_for_batches () {
        
        $batch_id = $this->input->post('batch_id');
        $year_no = $this->input->post('year_no');
        $sem_no = $this->input->post('sem_no');
        echo json_encode($this->batch_model->get_exams_for_batches($batch_id,$year_no,$sem_no));

    }
    
    function get_sem_exam_subjects (){
        $sem_exam_id = $this->input->post('sem_exam_id');
        echo json_encode($this->batch_model->get_sem_exam_subjects($sem_exam_id));
    }
    
    function get_assigned_lecturer(){
        $sub_id =  $this->input->post('sub_id');
        echo json_encode($this->batch_model->get_assigned_lecturer($sub_id));
    }

}

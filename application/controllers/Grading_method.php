<?php

class Grading_method extends CI_Controller {

    function grading_method() {
        parent::__construct();
        $this->load->model('Grading_model');
    }

    function grading_view() {
        $data['gr_criteria'] = $this->Grading_model->load_grading_criteria();
        $data['gr_name'] = $this->Grading_model->load_lookup();
        $data['grname'] = $this->Grading_model->load_grname();
        $data['main_content'] = 'grading_view';
        $data['title'] = 'GRADING METHOD';
        $this->load->view('includes/template', $data);
    }

    function update_method_status() {
        //post values
        $data['id'] = $this->input->post('id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->Grading_model->update_method_status($data));
    }

    function save_grade() {
        //post values
        $data['id'] = $this->input->post('grading_id');
        $data['grcode'] = $this->input->post('grcode');
        $data['grname'] = $this->input->post('grname');
        $data['grdes'] = $this->input->post('grdes');

        $data['grmethod'] = $this->input->post('grmethod');
        $data['grmark'] = $this->input->post('grmark');
        $data['grade'] = $this->input->post('grade');
        $data['grrate'] = $this->input->post('grrate');

        //query
        $exists = $this->Grading_model->existing_grading_code($data['grcode']);

        if (empty($data['id'])) {
            //insert
            if ($exists != NULL) {
                //$this->session->set_flashdata('flashError', 'Grading Code Exists.Cannot insert record.');
            } else {
                $result = $this->Grading_model->save_grade($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Grading Method saved successfully.');
                    $this->logger->systemlog('Grading Method', 'Success', 'Grading Method saved successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save grdading method. Retry.');
                    $this->logger->systemlog('Grading Method', 'Success', 'Failed to save grdading method.', date("Y-m-d H:i:s", now()), $data);
                }
            }
        } else {
            //update
            if ($exists != NULL && $exists != $data['id']) {
                //$this->session->set_flashdata('flashError', 'Grading Code exists. Cannot update record.');
            } else {
                $result = $this->Grading_model->save_grade($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Grading method updated successfully.');
                    $this->logger->systemlog('Grading Method', 'Success', 'Grading method updated successfully.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update grdading method. Retry.');
                    $this->logger->systemlog('Grading Method', 'Success', 'Failed to update grdading method.', date("Y-m-d H:i:s", now()), $data);
                }
            }
        }
        redirect('grading_method/grading_view');
    }

    function edit_grading_method() {
        $id = $this->input->post('id');
        echo json_encode($this->Grading_model->edit_grading_method($id));
    }

    function update_grading_method_status() {
        //post values
        $data['id'] = $this->input->post('id');
        $data['new_status'] = $this->input->post('new_status');

        echo json_encode($this->Grading_model->update_grading_method_status($data));
    }

    function get_grade_by_marks(){
        //post values
        $data['grading_id'] = $this->input->post('grading_id');
        $data['total_marks'] = $this->input->post('totalmarks');
        echo json_encode($this->Grading_model->get_grade_by_marks($data));
    }

    function get_grades(){
        //post values
        $data['grading_id'] = $this->input->post('grading_id');
        echo json_encode($this->Grading_model->get_grades($data));
    }
}

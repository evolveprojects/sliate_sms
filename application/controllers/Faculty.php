<?php

class Faculty extends CI_Controller {

    public function Faculty() {
        parent::__construct();
        $this->load->model('Faculty_model');
    }

    function faculty_view() {
        $data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['main_content'] = 'faculty_view';
        $data['title'] = 'FACULTY';
        $this->load->view('includes/template', $data);
    }
    
    function save_faculty(){
        
        //post values
        $data['faculty_id'] = $this->input->post('faculty_id');
        $data['faculty_code'] = $this->input->post('faculty_code');
        $data['faculty_name'] = $this->input->post('faculty_name');
        $data['faculty_des'] = $this->input->post('faculty_des');

        //query
        $exists = $this->Faculty_model->is_existing_faculty_code($data['faculty_code']);
        if (empty($data['faculty_id'])) {
            //insert
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Faculty Code Exists.Cannot insert record.');
            } else {
                $result = $this->Faculty_model->save_faculty($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Faculty saved successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Faculty. Retry.');
                }
            }
        } else {
            //update
            if ($exists != NULL && $exists != $data['faculty_id']) {
                $this->session->set_flashdata('flashError', 'Faculty Code exists. Cannot update record.');
            } else {
                $result = $this->Faculty_model->save_faculty($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Faculty updated successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update Faculty. Retry.');
                }
            }
        }
        redirect('faculty/faculty_view');
    }
    
    function change_faculty_status() {
        //post values
        $data['faculty_id'] = $this->input->post('faculty_id');
        $data['faculty_code'] = $this->input->post('faculty_code');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $exists = $this->Faculty_model->is_existing_faculty_code($data['faculty_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same Faculty Code record exists. Cannot activate this record.');
            } else {
                echo json_encode($this->Faculty_model->update_faculty_status($data));
            }
        } else {
            echo json_encode($this->Faculty_model->update_faculty_status($data));
        }
    }

}

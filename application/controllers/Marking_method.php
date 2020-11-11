<?php

class Marking_method extends CI_Controller {

    function marking_method() {
        parent::__construct();
        $this->load->model('marking_model');
    }

    function marking_view() {
        $data['marking_types'] = $this->marking_model->get_all_marking_types();
        $data['marking_data'] = $this->marking_model->load_marking_lookup();
        $data['main_content'] = 'marking_view';
        $data['title'] = 'MARKING METHOD';
        $this->load->view('includes/template', $data);
    }

    function save_marking_method() {
        //post values
        $data['marking_id'] = $this->input->post('marking_id');
        $data['m_code'] = $this->input->post('m_code');
        $data['m_name'] = $this->input->post('m_name');
        $data['m_des'] = $this->input->post('m_des');
        $data['m_type'] = $this->input->post('m_type');
        $data['mt_comment'] = $this->input->post('mt_comment');
        $data['mt_percentage'] = $this->input->post('mt_percentage');

        echo json_encode($this->marking_model->save_marking_method($data));
      //  redirect('marking_method/marking_view');
        //redirect('company?tab_id=company');
        //redirect('marking_method?', 'refresh');
    }

    function change_marking_status() {
        //post values
        $data['marking_id'] = $this->input->post('marking_id');
        $data['new_status'] = $this->input->post('new_status');
        $data['m_code'] = $this->input->post('m_code');

        if ($data['new_status'] == "0") {
            //checking if marking code already exists or not
            $exists = $this->marking_model->existing_marking_code($data['m_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same marking code record exists. Cannot activate this record.');
                $this->logger->systemlog('Update Marking Method Status', 'Faliure', 'Same marking code record exists. Cannot activate this record.', date("Y-m-d H:i:s", now()), $data);

            } else {
                echo json_encode($this->marking_model->change_marking_status($data));
            }
        } else {
            echo json_encode($this->marking_model->change_marking_status($data));
        }
    }

    function edit_load_marking_method() {
        $marking_id = $this->input->post('marking_id');

        echo json_encode($this->marking_model->get_marking_method_ids($marking_id));
    }

}

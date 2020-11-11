<?php

class Hall extends CI_Controller {

    function hall() {
        parent::__construct();
        $this->load->model('Hall_model');
    }

    function hall_view() {
        $data['centers'] = $this->Hall_model->get_all_centers();
        $data['halls'] = $this->Hall_model->get_all_halls();
        $data['main_content'] = 'hall_view';
        $data['title'] = 'HALL';
        $this->load->view('includes/template', $data);
    }

    function save_hall() {
        //post values
        $data['hall_id'] = $this->input->post('hall_id');
        $data['c_name'] = $this->input->post('c_name');
        $data['h_name'] = $this->input->post('h_name');
        $data['l_capacity'] = $this->input->post('l_capacity');
        $data['e_capacity'] = $this->input->post('e_capacity');
        $data['des'] = $this->input->post('des');


        if (empty($data['hall_id'])) {
            //insert
            $result = $this->Hall_model->save_hall($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess','Saved successfully.');
            } else {

                $this->session->set_flashdata('flashError');
            }
        } else {
            //update
            $result = $this->Hall_model->save_hall($data);
            if ($result) {
                $this->session->set_flashdata('flashSuccess','Changes saved successfully.');
            } else {
                $this->session->set_flashdata('flashError');
            }
        }
        redirect('company?tab_id=hall');
    }

    function load_center() {
        echo json_encode($this->Hall_model->load_center());
    }

    function change_subject_status() {
        //post values
        $data['hall_id'] = $this->input->post('hall_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->Hall_model->update_subject_status($data));
    }

}

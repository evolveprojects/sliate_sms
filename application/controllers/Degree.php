<?php

class Degree extends CI_Controller {

    public function degree() {
        parent::__construct();
        $this->load->model('degree_model');
        $this->load->model('faculty_model');
        $this->load->model('hall_model');
        $this->load->model('year_model');
        $this->load->model('Semester_model');
        $this->load->model('batch_model');
        $this->load->model('company_model');
    }

    function degree_view() {
        $data['all_faculties'] = $this->auth->get_accessfaculties();
        $data['all_degree'] = $this->degree_model->get_all_degree();
        $data['main_content'] = 'degree_view';
        $data['title'] = 'DEGREE';
        $this->load->view('includes/template', $data);
    }

    function center_degree() {
        $data['all_faculties'] = $this->auth->get_accessfaculties();
        // $data['centers'] = $this->hall_model->get_all_centers();
        $data['study_seasons'] = $this->company_model->get_all_study_seasons();
        //batch
        $data['batches'] = $this->batch_model->all_batch_data();
        //center years
        $data['degree_years'] = $this->degree_model->get_center_degree();
        //center semesters
        $data['degree_semesters'] = $this->degree_model->get_center_degree_years_all();
        $data['main_content'] = 'branch_degree_view';
        $data['title'] = 'CENTER DEGREE';
        $this->load->view('includes/template', $data);
    }

    function save_degree() {
        //post values
        $data['degree_id'] = $this->input->post('degree_id');
        $data['faculty_id'] = $this->input->post('faculty');
        $data['d_code'] = $this->input->post('d_code');
        $data['d_name'] = $this->input->post('d_name');
        $data['t_creadit'] = $this->input->post('t_creadit');
        $data['des'] = $this->input->post('des');

        //query
        $exists = $this->degree_model->is_existing_degree_code($data['d_code']);

        if (empty($data['degree_id'])) {
            //insert
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Degree Code Exists.Cannot insert record.');
            } else {
                $result = $this->degree_model->save_degree($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Degree saved successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to save Degree. Retry.');
                }
            }
        } else {
            //update
            if ($exists != NULL && $exists != $data['degree_id']) {
                $this->session->set_flashdata('flashError', 'Degree Code exists. Cannot update record.');
            } else {
                $result = $this->degree_model->save_degree($data);
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Degree updated successfully.');
                } else {
                    $this->session->set_flashdata('flashError', 'Failed to update Degree. Retry.');
                }
            }
        }
        redirect('degree/degree_view');
    }

    function change_degree_status() {
        //post values
        $data['degree_id'] = $this->input->post('degree_id');
        $data['degree_code'] = $this->input->post('degree_code');
        $data['new_status'] = $this->input->post('new_status');
        if ($data['new_status'] == "0") {
            $exists = $this->degree_model->is_existing_degree_code($data['degree_code']);
            if ($exists != NULL) {
                $this->session->set_flashdata('flashError', 'Same Degree Code record exists. Cannot activate this record.');
            } else {
                echo json_encode($this->degree_model->update_degree_status($data));
            }
        } else {
            echo json_encode($this->degree_model->update_degree_status($data));
        }
    }

    function get_degree() {
        echo json_encode($this->degree_model->get_degree());
    }

    function load_degree_programs() {
        $faculty_id = $this->input->post('faculty_id');
        echo json_encode($this->degree_model->load_degree_programs($faculty_id));
    }

    function get_year_semesters() {
        //post values
        $degree_id = $this->input->post('degree_id');
        $year_no = $this->input->post('year_no');

        echo json_encode($this->Semester_model->get_year_semesters($degree_id, $year_no));
    }

    function save_center_degree_years() {
        //post values
        $data['center_degree_id'] = $this->input->post('center_degree_id');

        $data['center_id'] = $this->input->post('center');
        $data['batch_id'] = $this->input->post('yr_Bcode');
        $data['degree_id'] = $this->input->post('year_Dcode');

        $data['total_years'] = $this->input->post('y_years');
        $data['year_start'] = $this->input->post('year_start');
        $data['year_end'] = $this->input->post('year_end');
        
        echo json_encode($this->degree_model->save_center_degree_years($data));
    }

    function save_center_degree_semesters() {
        //post values
        $data['center_year_id'] = $this->input->post('center_year_id');
        $data['center_id'] = $this->input->post('sem_center');
        $data['batch_id'] = $this->input->post('sem_Bcode');
        $data['degree_id'] = $this->input->post('se_Dcode');
        $data['total_years'] = $this->input->post('total_years');
        $data['year_no'] = $this->input->post('s_years');
        
        $data['total_semesters'] = $this->input->post('total_semesters');
        $data['semester_start'] = $this->input->post('semester_start');
        $data['semester_end'] = $this->input->post('semester_end');

        echo json_encode($this->degree_model->save_center_degree_semesters($data));
    }

    function get_center_degree_years() {
        $center_degree_id = $this->input->post('center_degree_id');
        echo json_encode($this->degree_model->get_center_degree_years($center_degree_id));
    }
    
    function change_center_year_status(){
        $data['center_degree_id'] = $this->input->post('center_degree_id');
        $data['new_status'] = $this->input->post('new_status');
        
        echo json_encode($this->degree_model->change_center_year_status($data));
    }

    function get_center_degree_semesters(){
        $center_year_id = $this->input->post('center_year_id');
        echo json_encode($this->degree_model->get_center_degree_semesters($center_year_id));
    }
    
    function change_center_semester_status(){
        $data['center_year_id'] = $this->input->post('center_year_id');
        $data['new_status'] = $this->input->post('new_status');
        echo json_encode($this->degree_model->change_center_semester_status($data));
    }

    // function load_faculty_bybranch()
    // {
    //     $branch = $this->input->post('id');
    //     echo json_encode($this->auth->get_accessfaculties(array($branch)));
    // }
}

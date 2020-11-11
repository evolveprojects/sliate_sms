<?php

class Change_pw extends CI_Controller {

    public function change_pw() {
        parent::__construct();
        $this->load->model('change_pw_model');
    }

    function change_pw_view() {
//        $data['all_faculties'] = $this->auth->get_accessfaculties();
        //$data['all_courses'] = $this->change_pw_model->get_all_courses();
        $data['main_content'] = 'change_pw_view';
        $data['title'] = 'CHANGEPW';
        $this->load->view('includes/template', $data);
    }
	
    function change_password() {

	$result = $this->change_pw_model->authenticate();
        if($result == "success")
        {
            $this->session->set_flashdata('flashSuccess', 'Password has been changed !');
            redirect('login?login=logout');
        }
        else {
            $this->session->set_flashdata('flashError', $result);
            redirect('change_pw/change_pw_view');
        }
    }
}

<?php

class Script extends CI_Controller {

    public function Script() {
        parent::__construct();
        $this->load->model('Script_model');
        $this->load->model('course_model');
        $this->load->model('Util_model');
        $this->load->model('Student_model');
    }

    // change Course Code (kasun 2018-08-01)

    function change_course_code() {
        // $this->output->enable_profiler(TRUE);
        $data['exam_course'] = $this->course_model->load_courses_complete();

        $data['main_content'] = 'script_view';
        $data['title'] = 'Script';
        $this->load->view('includes/template', $data);
    }

    function run_change_course_code() {
        $data['center_id'] = $this->input->post('center_id');
        echo json_encode($this->Script_model->change_course_code($data));
    }
    
    
    function run_user_course_code() {
        $data['center_id'] = $this->input->post('center_id');
        echo json_encode($this->Script_model->run_user_course_code($data));
    }
    
    
    function update_need_index() {
        $data['center_id'] = $this->input->post('center_id');
        echo json_encode($this->Script_model->update_need_index($data));
    }
    
    function check_duplicate_images() {
        //$data['center_id'] = $this->input->post('center_id');
        //echo json_encode($this->Script_model->update_need_index($data));
        
        $this->load->helper('directory'); //load directory helper
        $dir = "uploads/studentprofile";
        $files = scandir($dir);
        echo count($files).'</br>';
        $file_count = 0;
        foreach($files as $k => $v)
        {
            //echo $v.'</br>';
            $filename = "uploads/studentprofile/".$v.'</br>';
            echo $filename; 
            
            //check file is exist on the DB..
            
            $result = $this->Script_model->check_duplicate_images($filename);
            if(count($result) > 0)
            {
                $file_count++;       
            }
        }
        echo $file_count;
        
    }
    
    
    function student_bulk_operation_support() 
    {
        $data['centers'] = $this->Student_model->get_all_centers();
        $data['courses'] = $this->Student_model->load_courses_complete();

        $data['main_content'] = 'script_view_for_sliate_support';
        $data['title'] = 'Script';
        $this->load->view('includes/template', $data);
    }

}

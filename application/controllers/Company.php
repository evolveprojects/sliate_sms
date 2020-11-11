<?php

class Company extends CI_controller {

function company() {
	parent::__construct();
	$this->load->model('company_model');
        $this->load->model('hall_model');
	$this->load->model('News_model');
	$this->load->model('Event_model');
        $this->load->model('Util_model');
}

function index() 
{
        $data['centers'] = $this->hall_model->get_all_centers();
        $data['halls'] = $this->hall_model->get_all_halls();
	$data['comp_info'] = $this->company_model->get_comp_info();
	$data['grp_info']  = $this->company_model->get_grp_info();
	$data['fy_info']  = $this->company_model->get_fy_info();
	$data['ay_info']  = $this->company_model->get_ay_info();
        $data['range_info'] = $this->company_model->get_range_info();
        $data['VERSION'] = $this->company_model->getVersion();
	$data['news'] = $this->News_model->getNews();		
	$data['posts'] = $this->Event_model->getPosts();
        $data['authority'] = $this->company_model->get_authority();
        
        $query = $this->company_model->getRange();
        $data['RANGE'] = null;
        if($query){
            $data['RANGE'] =  $query;
        }

  //$this->load->view('company_view.php', $data);

	$data['main_content'] = 'company_view';
	$data['title'] = 'COMPANY';
	$this->load->view('includes/template',$data);
}

function update_comp_info()
{
	$save_comp = $this->company_model->update_comp_info();

	if($save_comp)
	{
		$this->session->set_flashdata('flashSuccess', 'Changes saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save changes. Retry.');
	}

	redirect('company/index');

}


//study version save
function save_version(){
    $save_version = $this->company_model->save_version();

	if($save_version)
	{
		$this->session->set_flashdata('flashSuccess', 'Changes saved successfully.');
	}
	
	redirect('company?tab_id=version');
}

function save_group()
{
	$grp_save = $this->company_model->save_group();

	if($grp_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Group saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save group. Retry.');
	}

	redirect('company?tab_id=group');
}

function save_branch()
{
	$br_save = $this->company_model->save_branch();

	if($br_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Branch saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save branch. Retry.');
	}

	redirect('company?tab_id=branch');
}

function load_branches()
{
	echo json_encode($this->company_model->load_branches());
}

function edit_branch_load()
{
	echo json_encode($this->company_model->edit_branch_load());
}

function save_fyear()
{
	$fy_save = $this->company_model->save_fyear();

	if($fy_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Financial Year saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Financial Year. Retry.');
	}

	redirect('company?tab_id=fyear');
}

function save_ayear()
{
	$ay_save = $this->company_model->save_ayear();

	if($ay_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Academic Year saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Academic Year. Retry.');
	}

	redirect('company?tab_id=other');
}

function save_termperiod()
{
	$tp_save = $this->company_model->save_termperiod();

	if($tp_save)
	{
		$this->session->set_flashdata('flashSuccess', 'Term Period saved successfully.');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to save Term Period. Retry.');
	}

	redirect('company?tab_id=tperiod');
}

function load_termsperiods()
{
	echo json_encode($this->company_model->load_termsperiods());
}

function temp_view1()
{
	$data['main_content'] = 'temp_view';
	$data['title'] = 'ENROLLMENTS  - Kandy Branch';
	$this->load->view('includes/template',$data);
}

function temp_view2()
{
	$data['main_content'] = 'temp_view2';
	$data['title'] = 'AVERAGE PERFORMANCE';
	$this->load->view('includes/template',$data);
}

function temp_view3()
{
	$data['main_content'] = 'temp_view3';
	$data['title'] = 'ATTENDANCE';
	$this->load->view('includes/template',$data);
}

function temp_view4()
{
	$data['main_content'] = 'temp_view4';
	$data['title'] = 'RESULT SHEET';
	$this->load->view('includes/template',$data);
}


function edit(){
    $id =   $this->input->get('id');
    $this->db->where('id', $id);
    $data['data'] = $this->company_model->get_data($id);// call your model file and pass result in data variable
    $data['id'] = $id;
    $data['title'] = "Welcome to DB";
    $data['results'] = $this->category_model->getAll();
    $this->load->view('category', $data);
}

function save_range()
{
    
    $id    = $this->input->post('range_id');
    $start  = $this->input->post('start');
    $end   = $this->input->post('end');
    
    $data = array(
        'HGC_SEQ_NextValue' => $start,
        'HGC_SEQ_Reserved'   => $end,
        'RANGE_VALUES' => $start."-".$end
        );
    
        $this->company_model->save_range($id,$data);
        redirect('company?tab_id=range');
    
    
    //$this->company_model->save_range($id,$data);
    //redirect('company?tab_id=rrange');
    
//    $range_save = $this->company_model->save_range();
    
//    if($range_save)
//	{
//		$this->session->set_flashdata('flashSuccess', 'Student Registration Number Range Saved successfully.');
//	}
//	else
//	{
//		//$this->session->set_flashdata('flashError', 'Failed to save Student Registration Number Range. Retry.');
//	}
 
    
    
//    $data = array(
//        'start_range' => $this->input->post('start'),
//        'end_range'   => $this->input->post('end')
//    );
    
    
//      $data['start'] = $this->input->post('start');
//      $data['end'] = $this->input->post('end');
//      
//      if (empty($data['start'])) {
//            //insert
//            $result = $this->Company_model->save_range($data);
//            if ($result) {
//                $this->session->set_flashdata('flashSuccess');
//            } else {
//                $this->session->set_flashdata('flashError');
//            }
//        } else{}    
}

function update_version_status() {
        //post values
        $data['version_id'] = $this->input->post('version_id');
        $data['status'] = $this->input->post('status');
        echo json_encode($this->company_model->update_version_status($data));
    }

// function savedata(){
	//load registration view form
	// $this->load->view('company_view');
	//Check submit button 
	// if($this->input->post('save'))
	// {
	// $news_tile=$this->input->post('news_name');
	// $news_url=$this->input->post('news_url');
	// $this->Crud_model->saverecords($news_tile,$news_url);	
	// }
// }

function savenews(){
    $this->company_model->savenews();
}

function savevents(){
    $this->company_model->savevents();
}

function update_delete_status() {
        //post values
        $data['news_id'] = $this->input->post('news_id');
        $data['is_deleted'] = $this->input->post('is_deleted');
        echo json_encode($this->company_model->update_delete_status($data));
    }

function update_deletevent_status() {
        //post values
        $data['events_id'] = $this->input->post('events_id');
        $data['is_deleted'] = $this->input->post('is_deleted');
        echo json_encode($this->company_model->update_deletevent_status($data));
    }
    
	function save_authority(){
    $this->company_model->save_authority();
	}

	function delete_autho()
    {
        $sign_id = $this->input->post('id');
        echo json_encode($this->company_model->delete_autho($sign_id));
}
    
    //------------RELEASE RESULTS---------------
    
    function release_results()
    {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        
        if ($ug_level == 1) {
            $data['user_centers'] = $this->company_model->get_all_admin_centers();
        } else if ($ug_level == 2) {
            $data['user_centers'] = $this->company_model->get_center_admin_centers();
        } else {
            $data['user_centers'] = $this->company_model->get_user_centers();
        }
        
        $data['online_registration_flag'] = $this->company_model->get_online_registration_flag();
        $data['main_content'] = 'release_results_view';
        $data['title'] = 'RELEASE RESULTS';
        $this->load->view('includes/template', $data);
    }
    
    function set_online_registration_flag(){
        $data['btn_checked'] = $this->input->post('btn_checked');
        
        echo json_encode($this->company_model->set_online_registration_flag($data));
    }
    
    function load_result_courses(){
        $center = $this->input->post('center_id');
        
        echo json_encode($this->company_model->load_result_courses($center));
    }
    
    
    function load_result_years(){
        $course = $this->input->post('course_id');
        
        echo json_encode($this->company_model->load_result_years($course));
    }
    
    function search_exams_for_results(){
        
        $data['center'] = $this->input->post('center_id');
        $data['course'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year_no');
        
        echo json_encode($this->company_model->search_exams_for_results($data));
    }
    
    
    function update_release_result_exm_status(){
        $data['sem_exm_id'] = $this->input->post('sem_exm_id');
        $data['btn_checked'] = $this->input->post('btn_checked');
        
        echo json_encode($this->company_model->update_release_result_exm_status($data));
    }
    
    
    function update_release_result_exm_status_for_web(){
        $data['sem_exm_id'] = $this->input->post('sem_exm_id');
        $data['btn_checked'] = $this->input->post('btn_checked');
        
        echo json_encode($this->company_model->update_release_result_exm_status_for_web($data));
    }

}
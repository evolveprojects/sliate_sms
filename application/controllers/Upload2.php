
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Upload2 extends CI_Controller {

public function index() 
{
	
	//$data['stds']=$this->Student_model->get_data();
	// $data['stu_info'] = $this->Student_model->student_profile($sid);
    $data['main_content'] = 'import_student';
	$data['title'] = 'STUDENT';
	$this->load->view('includes/template',$data);	
	
}
	


}
	


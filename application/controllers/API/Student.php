<?php 
use sliate_sms\Libraries\REST_Controller;
require (APPPATH.'libraries/REST_Controller.php');



class Student extends REST_Controller{
   
     /* INSERT: POST REQUEST TYPE
       UPDATE: PUT REQUEST TYPE
       DELETE: DELETE REQUEST TYPE
       LIST: GET REQUEST TYPE
    */
    public function __construct(){
        parent::__construct();
        $this->load->model('API/Student_model');
    }
    
    // GET :<project_url>/Student/last_RegNo
    public function last_RegNo_get(){
    
      
       $data=array(
        "course_code"=>$this->input->get('course_code'),
        "course_type"=>$this->input->get('course_type'),
      // "center_code"=>$this->input->get('center_code'),
        "center_code"=>$this->input->get('center_code', TRUE),
        "year"=>$this->input->get('year')
       );
        $regNo=$this->Student_model->get_last_regNO($data);
       
       if(count($regNo)>0){
        $this->response(array(
            "status"=>1,
            "message"=>"Found Registration No",
            "data"=>$regNo
            //"data1"=>$this->input->get()

        ),REST_Controller::HTTP_OK);
       }else{
        $this->response(array(
            "status"=>0,
            "message"=>"Request Failed",
            "data"=>null

        ),REST_Controller::HTTP_NOT_FOUND);
       }

   
    }
    public function studentSave_post(){
   

      $this->response(array(
        "status"=>$this->input->post('status'),
        "message"=>"Request OK",
        "data"=>$this->input->post('id')
    ),REST_Controller::HTTP_OK);
    }
     
}
?>
<?php
class Hci_admission extends CI_controller
{

    function hci_admission()
    {
        parent::__construct();
        $this->load->model('hci_admission_model');
    }

    function index()
    {
        $this->new_admission();
    }

    public function new_admission($action = "insert", $id = "") {

        if($action=="insert"){
            $today= date("Y-m-d");
            $post = $this->input->post("post");

            if( $this->input->post("post"))
            {
                $post['eq_createdon'] = $today;
                $sql = $this->hci_admission_model->insert('hci_enquiry',$post);
        if($sql)
        {
            $this->msg->set('admission', "success_Saved successfully");
        }
             //   $this->hci_admission_model->insert('hci_preadmission',$today);


            }
        }

        if($action=="update")
        {
            $this->hci_admission_model->obj = $this->hci_admission_model->get_row('hci_enquiry',array('es_enquiryid'=>$id));
            $post = $this->input->post("post");
            if( $this->input->post("post"))
            {


                $sql = $this->hci_admission_model->update('hci_enquiry',$post,array('es_enquiryid' => $id));

                if($sql)
                {
                    $this->msg->set('admission', "success_Update successfully");
                }
            }

        }
        $data['reg_stu'] =$this->hci_admission_model->get_registeed_Stu();
        $data['stu_info'] = $this->hci_admission_model->get_student_info();
        $data['main_content'] = 'hci_admission_view';
        $data['title'] = 'ADMISSION';
        $this->load->view('includes/template', $data);
    }

    function load_methodof_knowing()
    {
        echo json_encode($this->hci_admission_model->load_methodof_knowing());
    }

    function remove_admission()
    {
        echo json_encode($this->hci_admission_model->remove_admission());
    }

}
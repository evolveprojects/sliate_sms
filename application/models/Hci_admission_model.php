<?php
class Hci_admission_model extends CI_model
{

    public $obj=array();
    protected $_uploaded_file;
    //last inserted id
    public $last_insert=0;
    function index()
    {
        $data['main_content'] = 'hci_admission_view.php';
        $data['title'] = 'ADMISSION';
        $this->load->view('includes/template', $data);
    }


   /* function update_student_info()
    {
        $es_preadmissionid  = $this->input->post('es_preadmissionid');
        $fname      = $this->input->post('fname');
        $lname      = $this->input->post('lname');
        $birthday   = $this->input->post('birthday');
        $grade      = $this->input->post('grade');
        $gender     = $this->input->post('gender');
        $eintake    = $this->input->post('eintake');
        $currentcollage         = $this->input->post('currentcollage');
        $egrade                 = $this->input->post('egrade');
        $fathername             = $this->input->post('fathername');
        $faddress1              = $this->input->post('faddress1');
        $faddress2              = $this->input->post('faddress2');
        $faddress3              = $this->input->post('faddress3');
        $fwork                  = $this->input->post('fwork');
        $email                  = $this->input->post('email');
        $mname                  = $this->input->post('mname');
        $maddress1              = $this->input->post('maddress1');
        $maddress2              = $this->input->post('maddress2');
        $maddress3              = $this->input->post('maddress3');
        $mwork                  = $this->input->post('mwork');
        $pname                  = $this->input->post('pname');
        $paddress1              = $this->input->post('paddress1');
        $paddress2              = $this->input->post('paddress2');
        $paddress3              = $this->input->post('paddress3');
        $pwork                  = $this->input->post('pwork');
        $diagnosedreason        = $this->input->post('diagnosedreason');
        $diagnosedreason1       = $this->input->post('diagnosedreason1');
        $today                  = date("Y-m-d");


        $comp_save['pre_student_username']  = $fname;
        $comp_save['pre_student_lastname']  = $lname;
        $comp_save['pre_dateofbirth']   =    $birthday;
        $comp_save['pre_grade']     = $grade;
        $comp_save['pre_gender']    = $gender;
        $comp_save['pre_intake']    = $eintake;
        $comp_save['pre_prev_university']   = $currentcollage;
        $comp_save['pre_class']     = $egrade;
        $comp_save['pre_fathername']    =$fathername;
        $comp_save['pre_fatheraddress1']= $faddress1;
        $comp_save['pre_fatheraddress2']    = $faddress2;
        $comp_save['pre_fatheraddress3']    = $faddress3;
        $comp_save['pre_fathersoccupation']     = $fwork;
        $comp_save['pre_contactno1']        = $email;
        $comp_save['pre_mothername']        = $mname;
        $comp_save['pre_motheraddress1']    = $maddress1;
        $comp_save['pre_motheraddress2']    = $maddress2;
        $comp_save['pre_motheraddress3']    = $maddress3;
        $comp_save['pre_motheroccupation']  = $mwork;
        $comp_save['pre_personname']        = $pname;
        $comp_save['pre_personaddress1']    = $paddress1;
        $comp_save['pre_personaddress2']    = $paddress2;
        $comp_save['pre_personaddress3']    =    $paddress3;
        $comp_save['occupation1']           = $pwork;
        $comp_save['pre_motheraddress1']    = $maddress1;
        $comp_save['pre_motheraddress2']    = $maddress2;
        $comp_save['pre_motheraddress3']    = $maddress3;
        $comp_save['pre_physical_status']= $diagnosedreason;
        $comp_save['pre_physical_details']      = $diagnosedreason1;
        $comp_save['admission_date'] =  $today;

        if(empty($es_preadmissionid))
        {
            $save = $this->db->insert('hci_preadmission',$comp_save);
        }
        else
        {
            $this->db->where('comp_id',$es_preadmissionid);
            $save = $this->db->update('hci_preadmission',$comp_save);
        }

        return $save;
    } */

    function get_student_info()
    {
        $this->db->select('hci_enquiry.* ,hci_preadmission.pre_status');
        $this->db->from('hci_enquiry');
        $this->db->join('hci_preadmission','hci_preadmission.es_enquiryid = hci_enquiry.es_enquiryid','LEFT');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    public function get_row($tbl="",$where="",$key=""){
        if($tbl == "" && $where == "")
            return false;
        if(is_array($where)) {
            $this->db->where($where);
        }
        $sql=$this->db->get($tbl);
        if($sql->num_rows() > 0 ){
            if($key!= ""){
                $row=$sql->row_array();
                return $row[$key];
            }else {
                return $sql->row_array();
            }
        }else
            return false;
    }

    public function insert($db="",$field="",$pic_id=""){
        if($field == "" && $db == "")
            return false;
        if($this->db->insert($db,$field)){
            $insert_id=$this->db->insert_id();
            $this->last_insert=$insert_id;
          //  $this->upload_files($db,$insert_id,$pic_id);
            return true;
        }
        else
            return false;
    }
    //update
    public function update($db="",$field="",$where=""){
        if($field == "" && $db == "")
            return false;
        if(is_array($where))
            $this->db->where($where);
        if($this->db->update($db,$field)){
         //   $this->upload_files($db,$where);
            return true;
        }
        else
            return false;
    }

    public function show_val($key=""){
        if(isset($this->obj[$key])){
            return  $this->obj[$key];
        }else {
            return "";
        }
    }

    function get_registeed_Stu()
    {
        $this->db->select('*');
        $this->db->from('hci_preadmission');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function load_methodof_knowing()
    {
        $this->db->distinct('knowabt');
        $this->db->select('knowabt');
        $knowingmethod = $this->db->get('hci_enquiry')->result_array();

        return $knowingmethod;
    }

    function remove_admission()
    {
        $this->db->where('es_enquiryid',$this->input->post('es_enquiryid'));
        $result = $this->db->delete('hci_enquiry');

        if($result)
        {
            $this->session->set_flashdata('flashSuccess', 'Location Removed Successfully.');
        }
        else
        {
            $this->session->set_flashdata('flashError', 'Failed to Remove Location. Retry.');
        }

        return $result;
    }

}
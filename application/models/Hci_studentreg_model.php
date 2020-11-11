<?php
class Hci_studentreg_model extends CI_model
{
    public $obj=array();
    protected $_uploaded_file;
    //last inserted id
    public $last_insert=0;
    function index()
    {
        $data['main_content'] = 'hci_studentreg_view.php';
        $data['title'] = 'STU_REG';
        $this->load->view('includes/template', $data);
    }
    function get_stu_info()
    {
        $this->db->select('*');
        $this->db->from('hci_enquiry');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    function search($q){
        $this->db->select('pre_student_username');
        $this->db->like('pre_student_username', $q);
        $query = $this->db->get('hci_preadmission');
        $row_set = array();
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = htmlentities(stripslashes($row['pre_student_username'])); //build an array
            }
            return $row_set;
        }
    }

    function get_registeed_Stu()
    {
        $this->db->select('hci_sibling.*,hci_preadmission.pre_student_username');
        $this->db->from('hci_sibling');
        $this->db->join('hci_preadmission','hci_preadmission.es_preadmissionid = hci_sibling.es_sibiling');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function registeed_Stu()
    {
        $this->db->select('*');
        $this->db->where('st_status','R');
        $reg_stu = $this->db->get('st_details')->result_array();

        return $reg_stu;
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
    public function get($tbl="",$where="",$order_by= "",$limit="-1",$start="-1"){
        if($tbl == "" && $where == "")
            return false;
        if(is_array($where)) {
            $this->db->where($where);
        }
        //limit
        if($limit >=0 && $start >=0) {
            $this->db->limit($limit, $start);
        }
        //order
        if($order_by!= "" ){
            $this->db->order_by($order_by['field'],$order_by['order']);
        }

        $sql=$this->db->get($tbl);
        if($sql->num_rows() > 0 ){

            return $sql->result_array();
        }else
            return false;

    }

    function get_feecat_pplans()
    {
        $this->db->select('*');
        $fees = $this->db->get('hci_feecategory')->result_array();

        $i = 0;
        foreach ($fees as $fee) 
        {
            $this->db->select('*');
            $this->db->where('plan_fee',$fee['fc_id']);
            $plan = $this->db->get('hci_paymentplan')->result_array();

            $fees[$i]['plans'] = $plan;
            $i++;
        }

        return $fees;
    }

    function save_payplans($sid)
    {
        
    }

}
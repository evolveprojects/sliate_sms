<?php 
class Student_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function get_last_regNO($data){
    
        $this->db->select('sr.stu_id,sr.reg_no,sr.center_id,sr.batch_id,sr.current_year,sr.current_semester,ec.course_code,sr.course_type,cb.br_code,SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, "/", -3), "/", 1) as reg_no_year, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('edu_course ec ','sr.course_id=ec.id');
        $this->db->join('cfg_branch cb','sr.center_id=cb.br_id');
        $this->db->where('sr.current_year', null);
        $this->db->where('sr.current_semester', null);
        $this->db->where('ec.course_code', $data['course_code']);
        $this->db->where('sr.course_type', $data['course_type']);
        $this->db->where('cb.br_code', $data['center_code']);
        $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, '/', -3), '/', 1)= ".$data['year']);
        $this->db->order_by('CONVERT(regno_order,UNSIGNED INTEGER) DESC');
        $this->db->limit(1);
       
        $result = $this->db->get('stu_reg sr')->row_array();
        if ($result) {
            return intval($result['regno_order'])+1;
        } else {
            return 1;
        }
    }
}

?>
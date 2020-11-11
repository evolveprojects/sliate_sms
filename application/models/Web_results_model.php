<?php
class Web_results_model extends CI_model
{
    function is_existing_reg_no($reg_no) 
    {
        $this->db->select('reg_no');
        $this->db->where('reg_no',$reg_no);
        $row_array = $this->db->get('stu_reg')->row_array();
        
        if(empty($row_array)){
            return false;
        } else{
            return true;
        }
    }
    
    function is_valid_branch_code($br_code)
    {
        $this->db->select('br_code');
        $this->db->where('br_code',$br_code);
        $row_array = $this->db->get('cfg_branch')->row_array();
        
        if(empty($row_array)){
            return false;
        } else{
            return true;
        }
    }
    
    function is_valid_course_code($course_code)
    {
        $this->db->select('course_code');
        $this->db->where('course_code',$course_code);
        $this->db->or_where('course_code_mahapola',$course_code);
        $row_array = $this->db->get('edu_course')->row_array();
        
        if(empty($row_array)){
            return false;
        } else{
            return true;
        }
    }
    
    function student_data_by_reg_no($reg_no) 
    {
      $this->db->select('*');  
      $this->db->where('reg_no',$reg_no);
      $stu_data = $this->db->get('stu_reg')->row_array(); 
      
      if(!empty($stu_data)){
          return $stu_data;
      } else {
          return false;
      }
    }
    
    function is_result_released_web($reg_no)
    {
     
      $stu_data = $this->student_data_by_reg_no($reg_no);
      $this->db->select('*');  
      $this->db->where('batch_id',$stu_data['batch_id']);
      $this->db->where('course_id',$stu_data['course_id']);
      $this->db->where('year_no',$stu_data['current_year']);
      $this->db->where('semester_no',$stu_data['current_semester']);
      $row_array = $this->db->get('exm_semester_exam')->row_array();
      
      if(!empty($row_array)){
          return $row_array;
      } else {
          return false;
      }
    }
    
    function get_student_results_by_reg_no($reg_no)
    {
        $stu_data = $this->student_data_by_reg_no($reg_no);
        $sem_exam_data = $this->is_result_released_web($reg_no);

        $this->db->select('sub.code, sub.subject, exm.result');
        $this->db->join('mod_subject sub', 'sub.id = exm.subject_id');
        $this->db->join('stu_reg stu', 'exm.student_id = stu.stu_id');
        $this->db->join('edu_course co','co.id = exm.course_id');
        $this->db->where('exm.student_id',$stu_data['stu_id']);
        $this->db->where('exm.course_id',$stu_data['course_id']);
        $this->db->where('exm.year_no',$stu_data['current_year']);
        $this->db->where('exm.semester_no',$stu_data['current_semester']);
        $this->db->where('exm.batch_id',$stu_data['batch_id']);
        $this->db->where('exm.sem_exam_id',$sem_exam_data['exam_id']);
        $this->db->where('exm.deleted',0);
        $result_array = $this->db->get('exm_mark exm')->result_array();
        
        return $result_array;
    }
    
    
    function get_student_common_details($reg_no) 
    {
      $this->db->select('stu.first_name, stu.last_name,stu.reg_no,co.course_name,stu.current_year, stu.current_semester');  
      $this->db->join('edu_course co','co.id = stu.course_id');
      $this->db->where('stu.reg_no',$reg_no);
      $stu_data = $this->db->get('stu_reg stu')->row_array(); 
      
      if(!empty($stu_data)){
          return $stu_data;
      } else {
          return false;
      }
    }
    
    function get_student_current_gpa($stu_reg_no)
    {
        $stu_data = $this->student_data_by_reg_no($stu_reg_no);
        
        $this->db->where('gpa.stu_id',$stu_data['stu_id']);
        $this->db->where('gpa.year',$stu_data['current_year']);
        $this->db->where('gpa.semester',$stu_data['current_semester']);
        $gpa_data = $this->db->get('exm_mark_stu_gpa gpa')->row_array(); 
        
        if(!empty($gpa_data)){
            return $gpa_data['gpa'];
        } else {
            return 0.00;
        }
    }
}
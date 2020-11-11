<?php 

class Aptitude_test_model extends CI_model {
    
    //table
    protected $table = 'student_exam_marks';


    function search_online_student($data) {
        try{
            $this->db->select('*');
            $this->db->from('stu_reg_online_reg');
            $this->db->join('student_exam_marks', 'student_exam_marks.student_id = stu_reg_online_reg.indexno','left');
            //$this->db->where('year', $data['year']);
            $this->db->where('priority1_1center', $data['center']);
            $this->db->where('priority1_course', $data['course']);

            $online_students = $this->db->get()->result_array();

            return $online_students;

        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
        }
    }

    function online_registered_students() {
        
        try {

            $this->db->select('*');
            $this->db->from('stu_reg_online_reg');
            $this->db->join('student_exam_marks', 'student_exam_marks.student_id = stu_reg_online_reg.indexno','left');
            
            $online_students = $this->db->get()->result_array();

        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
        }
        return $online_students;
    }


    //Add aptitude test marks
    function save_apt_mark($entries) {

        //save data
        try {
            
            foreach($entries as $entry){
                $this->db->select('*');
                $this->db->from('student_exam_marks');
                $this->db->where('student_id', $entry['student_id']);
                $stu = $this->db->get()->result('array');
                
                $row = $this->db->get_where('student_exam_marks', array('student_id' => $entry['student_id'], 'mark' => ''));

                if (empty($stu)) 
                {
                    $this->db->insert('student_exam_marks', $entry);
                } 
                if (!empty($row)) 
                {
                    $this->db->set('mark', $entry['mark']);
                    $this->db->where('student_id', $entry['student_id']);
                    $this->db->update('student_exam_marks');
                }
            }
        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
        }
    }

}
?>
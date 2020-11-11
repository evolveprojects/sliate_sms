<?php

class dataAnalysis_model extends CI_Model {
    
    
    
    
    function get_all_courses(){
        $this->db->select('de.*, de.description as d_des,yr.id as year_id, yr.*,se.*');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $course_id = $this->db->get('edu_course de')->row_array();

        return $course_id;
    }
    
    function analysis_load_subject_selection_course_list(){
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
//        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('cr.deleted', 0);
//        if ($ug_level == 5) {
//            $this->db->where('cr.id', $course_id);
//        }
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
    
    function analysis_get_course() {

//        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('de.*, de.description as d_des,yr.id as year_id, yr.*,se.*');
        $this->db->where('de.id', $this->input->post('id'));
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
//        $this->db->where_in('de.faculty_id',$faclist);
        $course_id = $this->db->get('edu_course de')->row_array();

        return $course_id;
    }
    
    function analysis_load_semester_exam($data, $batch_details){
        $this->db->select('*, se.id as sem_exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('se.semester_no', $batch_details['current_semester']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }
    
    function analysis_load_semesters($course_id, $year_no){
        $this->db->select('se.no_of_semester');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $result = $this->db->get('edu_semester se')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
    }
    
    function analysis_student_mark_details(){
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
//        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('ese.release_result', 1);
        $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        
        $this->db->group_by('esed.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); 
        
        $result_array['students'] = $this->db->get('exm_semester_exam ese')->result_array();
        
        $this->db->select('release_result');
        $this->db->where('exam_id', $data['exam_id']);
        $result_array['release_results'] = $this->db->get('exm_semester_exam')->result_array();
        
        for ($i = 0; $i < count($result_array['students']); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.student_id', $result_array['students'][$i]['stu_id']);
            $this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            $this->db->where('se.release_result', 1);
            //$this->db->where('sed.is_approved', 1);
            $result_array['students'][$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array['students'][$i]['gpa'] = $this->get_student_gpa_value($result_array['students'][$i]['stu_id'],$data['year_no'],$data['semester_no']); 
//            $result_array[$i]['overall_gpa'] = $this->get_student_gpa_value_show($data['overall_gpa']); 

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array['students'][$i]['stu_id']);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array['students'][$i]['exam_mark'] = $this->db->get('exm_ark em')->result_array();
        }  
        return $result_array;
    }
    
    
    
}
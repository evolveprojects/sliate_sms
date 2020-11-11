<?php

class Data_analysis_model extends CI_Model {
    
    
    
    
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
    
    function analysis_load_semester_exam($data){
        $this->db->select('*, se.id as sem_exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['analys_course_id']);
        $this->db->where('se.year_no', $data['analys_year']);
        $this->db->where('se.semester_no', $data['analys_semester']);
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
    
    function analysis_student_mark_details($data){
        
        if($data['time'] == '1'){
            $time = "F";
        }else{
            $time = "P";  
        }
        
        $this->db->distinct();
        $this->db->select ('sr.center_id, esed.student_id, cb.br_name, sr.course_type,esed.is_attend');
//        ,COUNT(sr.stu_id) as no_of_applicants
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        $this->db->where('sr.course_type', $time);
        
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        
        $this->db->group_by('sr.stu_id');
        $this->db->group_by('sr.center_id');
        
        $result_array['students'] = $this->db->get('exm_semester_exam_details esed')->result_array();
        $stu_count_array = array_count_values(array_column($result_array['students'], 'center_id'));
        

        $return_array = array();
        $i=0;
        foreach ($stu_count_array as $center=>$count){
            //print_r($result_array['students']);
            
            $return_array[$i]['center_id'] = $center;
            $return_array[$i]['br_name'] = $this->get_center_name_by_id($center);
            $return_array[$i]['course_type'] = $time;
            $return_array[$i]['stu_count'] = $count;
            $return_array[$i]['sat_exam'] = $this->analysis_sat_for_exam($data,$center);
            $stu_passed = $this->analysis_passed_all_subbjects($data,$center);
            $return_array[$i]['pass_count'] = $stu_passed['pass_count'];
            $return_array[$i]['inc_count'] = $stu_passed['inc_count'];
            $return_array[$i]['ab_ne_count'] = $stu_passed['ab_ne_count'];
            $return_array[$i]['pass_rate'] = (intval($stu_passed['pass_count'])/intval($count))*100;
            $return_array[$i]['pass_rate_round'] = round($return_array[$i]['pass_rate'],2);
            
            $i++;
        }
        
        return $return_array;      
    }
    
    
    function analysis_sat_for_exam($data,$center_id){
        $this->db->select ('sr.stu_id, sr.center_id, esed.student_id, cb.br_name, sr.course_type, esed.is_attend, esed.subject_id');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        if($data['time'] == '1'){
            $this->db->where('sr.course_type', "F");
        }else{
            $this->db->where('sr.course_type', "P");
        }
        
        $this->db->where('sr.center_id', $center_id);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('esed.is_attend', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam_details esed')->result_array();
        $student_array = array();

        $x = 0;
        for($i=0; $i<count($result_array); $i++){
            $index = $this->searchArray($result_array[$i]['student_id'],$student_array);
    
            if($index == -1){
                $student_array[$x]['student_id'] = $result_array[$i]['student_id'];
                $student_array[$x]['subject_id'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
                $x++;
            } else {
                $student_array[$index]['subject_id'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
            }
            
        }

        $sat_exam_count = 0;
        for($j=0; $j<count($student_array); $j++){
            $countflag = true;
            foreach($student_array[$j]['subject_id'] as $key => $value){
                if($student_array[$j]['subject_id'][$key] == 0){
                    $countflag = false;
                }
            }
            
            if($countflag){
                $sat_exam_count++;
            }
        }
        return $sat_exam_count;
        
    }
    
    function searchArray($nameKey, $myArray){
  
        if(empty($myArray)){
            return -1;
        } else {
            $flag = false;
           for ($i=0; $i < count($myArray); $i++) { 
                if ($myArray[$i]['student_id'] == $nameKey) {
                    $flag = true;
                    $index = $i;
                }  
            } 
            if($flag){
                return $index;
            } else {
                return -1;
            }
        }
        
    }
    
    
    
    function analysis_passed_all_subbjects($data,$center_id){
        $this->db->distinct();
        $this->db->select ('em.student_id, em.subject_id, em.result, em.deleted, em.sem_exam_id, esed.is_approved, esed.is_attend');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id = em.sem_exam_id');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
   
        $this->db->where('em.course_id', $data['course_id']);
        $this->db->where('em.batch_id', $data['batch_id']);
        $this->db->where('em.year_no', $data['year_no']);
        $this->db->where('em.semester_no', $data['semester_no']);
        $this->db->where('em.sem_exam_id', $data['exam_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        
        if($data['time'] == '1'){
            $this->db->where('sr.course_type', "F");
        }else{
            $this->db->where('sr.course_type', "P");
        }
        $this->db->where('sr.center_id', $center_id);
        $this->db->where('em.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('esed.is_attend', 1);
        $this->db->where('esed.is_approved', 2, 3, 4);       
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);

        $result_array = $this->db->get('exm_mark em')->result_array();
        
        $student_array = array();

        if(count($result_array) != 0){
            $x = 0;
            for($i=0; $i<count($result_array); $i++){
                $index = $this->searchArray($result_array[$i]['student_id'],$student_array);

                if($index == -1){
                    $student_array[$x]['student_id'] = $result_array[$i]['student_id'];
                    $student_array[$x]['result'][$result_array[$i]['subject_id']] = $result_array[$i]['result'];
                    $student_array[$x]['attendance'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
                    $student_array[$x]['approve'][$result_array[$i]['subject_id']] = $result_array[$i]['is_approved'];
                    $x++;
                } else {
                    $student_array[$index]['result'][$result_array[$i]['subject_id']] = $result_array[$i]['result'];
                    $student_array[$index]['attendance'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
                    $student_array[$index]['approve'][$result_array[$i]['subject_id']] = $result_array[$i]['is_approved'];
                }

                

            }   
        }
        
        //$res_array = array("AB", "I(CA)", "I(SE)", "INC", "E", "D", "D+", "C-", "DFR", "-", "", null, " ");
        $res_array = array("I(CA)", "I(SE)", "INC", "E", "D", "D+", "C-");
        $res_array2 = array("AB", "DFR", "-", "", " ", null);
        $pass_fail_array = array();

        $pass_count = 0;
        $inc_count = 0;
        $attend_count = 0;
        $approve_count = 0;

        if(count($student_array) != 0){
            for($j=0; $j<count($student_array); $j++){
                $countflag = true;
                
                $result_counter = 1;
                $poor_grade = 0;
                $existing_result_count = count($student_array[$j]['result']);
                foreach($student_array[$j]['result'] as $key => $value){ 
                    if(in_array($student_array[$j]['result'][$key], $res_array)){
                        $poor_grade++;
                        if(($existing_result_count == $result_counter) && ($poor_grade == 1)){
                            $gpa = $this->get_current_gpa_for_student($student_array[$j]['student_id']);
                            if($gpa<2){
                                $countflag = false;
                            }
                        } else if (!in_array($value, $res_array2)) {
                            $countflag = false;
                        }
                    }
                    $result_counter++;
                }

                if($countflag){
                    $pass_count++;
                }
                else{
                    $inc_count++;
                }

                $attendflag = true;
                foreach($student_array[$j]['attendance'] as $ky => $val){ 
                    if($student_array[$j]['attendance'][$ky] == 1){
                        $attendflag = false;
                    }               
                }

                if($attendflag){
                    $attend_count++;
                }

                $apprvflag = true;
                foreach($student_array[$j]['approve'] as $ke => $va){ 
                    if($student_array[$j]['approve'][$ke] == 1 || $student_array[$j]['approve'][$ke] == 2){
                        $apprvflag = false;
                    } 
                }

                if($apprvflag){
                    $approve_count++;
                }

            }
        }
        
        $pass_fail_array['pass_count'] = $pass_count;
        $pass_fail_array['inc_count'] = $inc_count;
        $pass_fail_array['attend_count'] = $attend_count;
        $pass_fail_array['approve_count'] = $approve_count;
        $pass_fail_array['ab_ne_count'] = ($attend_count+$approve_count);
        
        
        return $pass_fail_array;
    }
    
    function get_center_name_by_id($center_id)
    {
        $this->db->select('*');
        $this->db->where('br_id', $center_id);
        $result = $this->db->get('cfg_branch')->row_array();
        return $result['br_name'];
    }
    
    function analysis_print_load_student_data(){
        
    }
    
    function get_current_gpa_for_student($student_id)
    {
        $this->db->select('gpa');
        $this->db->where('stu_id',$student_id);
        $row_array = $this->db->get('exm_mark_stu_gpa')->row_array();
        
        if(!empty($row_array)){
            return $row_array['gpa'];
        } else {
            return 0.00;
        }
    }
    
    
    ////////////////////////////////////// subject wise data load //////////////////////////////////////
    
    function analysis_get_semester_subjects($data){
        
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $sem_subjects_code = [];

        $this->db->select('co.id, co.code, co.subject');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        $this->db->where('yr.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        
        return $result_array;
    }  
    
    
    function load_data_for_subj_analysis_report($data){
        
        $this->db->distinct();
        $this->db->select ('sr.center_id, esed.student_id, cb.br_name, sr.course_type, esed.is_attend');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        //$this->db->where('sr.course_type', $time);
        
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        
        $this->db->group_by('sr.stu_id');
        $this->db->group_by('sr.center_id');
        $this->db->group_by('sr.course_type');
        
        $this->db->order_by('sr.center_id');
        
       $result_array['students']  = $this->db->get('exm_semester_exam_details esed')->result_array();
        
        
        $stu_count_array = array_count_values(array_column($result_array['students'], 'center_id'));
        
        $return_array = array();
        $return_array['subjects'] = $this->analysis_get_semester_subjects($data);
        
        $subject_array = array();
        $z = 0;
        for($p=0; $p<count($return_array['subjects']); $p++){
            if(!in_array($return_array['subjects'][$p]['id'], $subject_array)){
                $subject_array[$z] = $return_array['subjects'][$p]['id'];
                $z++;
            } 
        }
   
        $return_array['subj_data'] = [];
        $i=0;
        foreach ($stu_count_array as $center=>$count){
            
            $return_array['subj_data'][$i]['center_id'] = $center;
            $return_array['subj_data'][$i]['br_name'] = $this->get_subj_wise_center_name_by_id($center);
            $return_array['subj_data'][$i]['full_count'] = $count;
            $return_array['subj_data'][$i]['stu_count'] = $this->get_subj_wise_stu_count($center, $result_array['students'], $data, $subject_array);
            $return_array['subj_data'][$i]['sat_exam'] = $this->analysis_subj_wise_sat_for_exam($data,$center, $subject_array);
            $stu_passed = $this->analysis_passed_subj_wise_all_subjects($data, $center, $subject_array, $return_array['subj_data'][$i]['stu_count']);
           
            $return_array['subj_data'][$i]['pass_count'] = $stu_passed['pass_count'];
            $return_array['subj_data'][$i]['fail_count'] = $stu_passed['fail_count'];
            $return_array['subj_data'][$i]['absent_count'] = $stu_passed['absent_count'];
            $return_array['subj_data'][$i]['pass_rate'] = $stu_passed['pass_rate'];
            
            $i++;
        }       
        
        return $return_array; 
    }
    
    
    function get_subj_wise_center_name_by_id($center_id)
    {
        $reslt = [];
        $this->db->select('*');
        $this->db->where('br_id', $center_id);
        $result = $this->db->get('cfg_branch')->row_array();
        
        $reslt['full_time'] = $result['br_name']."-FT";
        $reslt['part_time'] = $result['br_name']."-PT";
               
        return $reslt;

    }
    
       
    function get_subj_wise_stu_count($center_id, $students, $data, $subject_array)
    {   
        $f = 1;
        $p = 1;
        $stu_count = [];
        
//        $time['full_time'] = 0;
//        $time['part_time'] = 0;
//        
//        if(count($students) != 0){
//            for($x=0; $x<count($students); $x++){
//                if($students[$x]['center_id'] == $center_id){               
//                     if($students[$x]['course_type'] == "F"){
//                         $time['full_time'] = $f++;
//                     }
//
//                     if($students[$x]['course_type'] == "P"){
//                         $time['part_time'] = $p++;
//                     }
//                }
//            }
//        }
        
        //-------------
        
        
        $this->db->select ('sr.center_id, esed.student_id, cb.br_name, sr.course_type, esed.is_attend, esed.subject_id');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        
        $this->db->where('sr.center_id', $center_id);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam_details esed')->result_array();

        
        $students = array();
        
        if(count($result_array) != 0){
            $x = 0;
            $y = 0;
            for($i=0; $i<count($result_array); $i++){

                $index = $this->searchArray($result_array[$i]['student_id'],$students);

                if($index == -1){
                    $y = 0;
                    $students[$x]['student_id'] = $result_array[$i]['student_id'];
                    $students[$x]['course_type'] = $result_array[$i]['course_type'];
                    $students[$x]['subject_id'][$y] = $result_array[$i]['subject_id']; 

                    $x++;
                } 
                else {                
                    $students[$index]['subject_id'][$y] = $result_array[$i]['subject_id']; 
                } 
                $y++;
            }
        }
      
        $s=0;
        if(count($subject_array) != 0){
            for($k=0; $k<count($subject_array); $k++){
                $tu_count_full = 0;
                $stu_count_part = 0;

                if(count($students) != 0){
                    for($x=0; $x<count($students); $x++){           
                        foreach($students[$x]['subject_id'] as $key => $value){
                            $stucountflag_full = false;
                            $stucountflag_part = false;
                            if($value == $subject_array[$k]){
                                //if($students[$x]['center_id'] == $center_id){               
                                    if($students[$x]['course_type'] == "F"){
                                        $stucountflag_full = true;
                                    }

                                    if($students[$x]['course_type'] == "P"){
                                        $stucountflag_part = true;
                                    }
                               //}

                                if($stucountflag_full){
                                    $tu_count_full++;
                                }

                                if($stucountflag_part){
                                    $stu_count_part++;
                                }
                            } 
                        } 
                    }
                }
                $stu_count[$s][$subject_array[$k]]['full_time'] = $tu_count_full;
                $stu_count[$s][$subject_array[$k]]['part_time'] = $stu_count_part;
                $s++;
            }
        }

        return $stu_count;
    }
    
    
    function analysis_subj_wise_sat_for_exam($data,$center_id, $subject_array){
        
        $this->db->select ('sr.stu_id, sr.center_id, esed.student_id, cb.br_name, sr.course_type, esed.is_attend, esed.subject_id');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        
        $this->db->where('sr.center_id', $center_id);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('esed.is_attend', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam_details esed')->result_array();

        
        $student_subj_array = array();
        
        if(count($result_array) != 0){
            $x = 0;
            for($i=0; $i<count($result_array); $i++){

                $index = $this->searchArray($result_array[$i]['student_id'],$student_subj_array);

                if($index == -1){
                    $student_subj_array[$x]['student_id'] = $result_array[$i]['student_id'];
                    $student_subj_array[$x]['type'] = $result_array[$i]['course_type'];
                    $student_subj_array[$x]['subject_id'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend']; 

                    $x++;
                } 
                else {                
                    $student_subj_array[$index]['subject_id'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend']; 
                }          
            }
        }
 
        $sat_exam_count = []; 
        $v=0;
        if(count($subject_array) != 0){
            for($k=0; $k<count($subject_array); $k++){
                $sat_exam_count_full = 0;
                $sat_exam_count_part = 0;

                if(count($student_subj_array) != 0){
                    for($j=0; $j<count($student_subj_array); $j++){           
                        foreach($student_subj_array[$j]['subject_id'] as $key => $value){
                            $countflag_full = false;
                            $countflag_part = false;
                            if($key == $subject_array[$k]){
                                if($student_subj_array[$j]['type'] == "F"){
                                    if($student_subj_array[$j]['subject_id'][$key] == 1){
                                        $countflag_full = true;
                                    }
                                }

                                if($student_subj_array[$j]['type'] == "P"){
                                    if($student_subj_array[$j]['subject_id'][$key] == 1){
                                        $countflag_part = true;
                                    }
                                }

                                if($countflag_full){
                                    $sat_exam_count_full++;
                                }

                                if($countflag_part){
                                    $sat_exam_count_part++;
                                }
                            } 
                        } 
                    }
                }
                $sat_exam_count[$v][$subject_array[$k]]['full_time'] = $sat_exam_count_full;
                $sat_exam_count[$v][$subject_array[$k]]['part_time'] = $sat_exam_count_part;
                $v++;
            }
        }       
        return $sat_exam_count;
    }
    
    
    
    function analysis_passed_subj_wise_all_subjects($data, $center_id, $subject_array, $subj_wise_stu_count){
        
        $this->db->distinct();
        $this->db->select ('em.student_id, em.subject_id, em.result, em.deleted, em.sem_exam_id, esed.is_approved, esed.is_attend, sr.course_type');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id = em.sem_exam_id');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
   
        $this->db->where('em.course_id', $data['course_id']);
        $this->db->where('em.batch_id', $data['batch_id']);
        $this->db->where('em.year_no', $data['year_no']);
        $this->db->where('em.semester_no', $data['semester_no']);
        $this->db->where('em.sem_exam_id', $data['exam_id']);
        $this->db->where('esed.no_of_attempts', $data['analysis_attempt']);
        $this->db->where('sr.center_id', $center_id);
        $this->db->where('em.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('esed.is_attend', 1);
        $this->db->where('esed.is_approved', 2, 3, 4);       
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);

        $result_array = $this->db->get('exm_mark em')->result_array();
        
        $student_array = array();

        if(count($result_array) != 0){
            $x = 0;
            for($i=0; $i<count($result_array); $i++){
                $index = $this->searchArray($result_array[$i]['student_id'],$student_array);

                if($index == -1){
                    $student_array[$x]['student_id'] = $result_array[$i]['student_id'];
                    $student_array[$x]['type'] = $result_array[$i]['course_type'];
                    $student_array[$x]['result'][$result_array[$i]['subject_id']] = $result_array[$i]['result'];
                    $student_array[$x]['attendance'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
                    $x++;
                } else {
                    $student_array[$index]['result'][$result_array[$i]['subject_id']] = $result_array[$i]['result'];
                    $student_array[$index]['attendance'][$result_array[$i]['subject_id']] = $result_array[$i]['is_attend'];
                }
            }   
        }
        
        //$res_array = array("AB", "I(CA)", "I(SE)", "INC", "E", "D", "D+", "C-", "DFR", "-", "", " ", null);      
        $res_array = array("I(CA)", "I(SE)", "INC", "E", "D", "D+", "C-", "DFR", "NE", "N/E");
        $res_array2 = array("-", "", " ", null);
        $res_arrayAbsent = array("AB");
 
        $pass_array = array();
        $p = 0;
        if(count($subject_array) != 0){
            for($k=0; $k<count($subject_array); $k++){
                $pass_count_full = 0;
                $pass_count_part = 0;
                
                $fail_count_full = 0;
                $fail_count_part = 0;
                
                $absent_count_full = 0;
                $absent_count_part = 0;
                
                if(count($student_array) != 0){
                    for($j=0; $j<count($student_array); $j++){     
                        foreach($student_array[$j]['result'] as $key => $value){ 
                            $countpassflag_full = false;
                            $countpassflag_part = false;
                            
                            $countfailflag_full = false;
                            $countfailflag_part = false;
                            
                            $countabsentflag_full = false;
                            $countabsentflag_part = false;
                            
                            if($key == $subject_array[$k]){
                                if(!in_array($student_array[$j]['result'][$key], $res_array2)){
                                    if(!in_array($student_array[$j]['result'][$key], $res_array)){
                                        if($student_array[$j]['type'] == "F"){
                                            $countpassflag_full = true;
                                        }

                                        if($student_array[$j]['type'] == "P"){
                                            $countpassflag_part = true;
                                        }
                                    }
                                    else{
                                        if(in_array($student_array[$j]['result'][$key], $res_arrayAbsent)){
                                            if($student_array[$j]['type'] == "F"){
                                                $countabsentflag_full = true;
                                            }

                                            if($student_array[$j]['type'] == "P"){
                                                $countabsentflag_part = true;
                                            }
                                        }
                                        else{
                                            if($student_array[$j]['type'] == "F"){
                                                $countfailflag_full = true;
                                            }

                                            if($student_array[$j]['type'] == "P"){
                                                $countfailflag_part = true;
                                            }
                                        }
                                    }

                                    //Pass
                                    if($countpassflag_full){
                                        $pass_count_full++;
                                    }

                                    if($countpassflag_part){
                                        $pass_count_part++;
                                    }

                                    //Fail
                                    if($countfailflag_full){
                                        $fail_count_full++;
                                    }

                                    if($countfailflag_part){
                                        $fail_count_part++;
                                    }
                                    
                                    //Absent
                                    if($countabsentflag_full){
                                        $absent_count_full++;
                                    }

                                    if($countabsentflag_part){
                                        $absent_count_part++;
                                    }
                                }
                            }
                        }
                    }
                }
                
 
                $pass_array['pass_count'][$p][$subject_array[$k]]['full_time'] = $pass_count_full;
                $pass_array['pass_count'][$p][$subject_array[$k]]['part_time'] = $pass_count_part;
                
                $pass_array['fail_count'][$p][$subject_array[$k]]['full_time'] = $fail_count_full;
                $pass_array['fail_count'][$p][$subject_array[$k]]['part_time'] = $fail_count_part;
                
                $pass_array['absent_count'][$p][$subject_array[$k]]['full_time'] = $absent_count_full;
                $pass_array['absent_count'][$p][$subject_array[$k]]['part_time'] = $absent_count_part;
                
                
                if($subj_wise_stu_count[$p][$subject_array[$k]]['full_time'] > 0){
                    $pass_array['pass_rate'][$p][$subject_array[$k]]['full_time'] = round(((intval($pass_count_full)/intval($subj_wise_stu_count[$p][$subject_array[$k]]['full_time']))*100), 2);
                }
                else{
                    $pass_array['pass_rate'][$p][$subject_array[$k]]['full_time'] = 0;
                }
                
                if($subj_wise_stu_count[$p][$subject_array[$k]]['part_time'] > 0){
                    $pass_array['pass_rate'][$p][$subject_array[$k]]['part_time'] = round(((intval($pass_count_part)/intval($subj_wise_stu_count[$p][$subject_array[$k]]['part_time']))*100), 2);
                }
                else{
                    $pass_array['pass_rate'][$p][$subject_array[$k]]['part_time'] = 0;
                }
                
                $p++;
            }
        }  
        return $pass_array;
    }
    
    function get_selected_course_name($cou_id){
        $this->db->select("course_code,course_name");
        $this->db->where('id', $cou_id);
        return $this->db->get('edu_course')->row_array();
    }
    
    function get_selected_batch_name($bat_id){
        $this->db->select("batch_code");
        $this->db->where('id', $bat_id);
        $row_array = $this->db->get('edu_batch')->row_array();
        return $row_array['batch_code'];
    }
}
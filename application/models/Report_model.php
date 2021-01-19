<?php

class Report_model extends CI_Model {

    function load_user_level_course_list() {
        $r = 0;
        $center = $this->input->post('center_id');

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        foreach ($user_centers as $value) {
            $arr[$r] = $value['br_id'];
            $r++;
        }

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        if ($center != "all") {
            $this->db->where('ecc.center_id', $center);
        } else {
            $this->db->where_in('ecc.center_id', $arr);
        }
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_course_list() {
        $center = $this->input->post('center_id');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');

        if ($center != "all") {
            $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
            $this->db->where('ecc.center_id', $center);
        }

        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_user_course_list() {
        $center = $this->session->userdata('user_branch');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $center);
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_year_list() {

        $this->db->select('MAX(no_of_year) as max_year');
        $max_year = $this->db->get('edu_year')->row_array();

        $sel_course = $this->input->post('selected_course_id');

        $this->db->select('id,MAX(no_of_year) as no_of_year');

        if ($sel_course != "all") {
            $this->db->where('course_id', $sel_course);
        }
        if (!empty($max_year) && $sel_course == "all") {
            $this->db->where('no_of_year', $max_year['max_year']);
        }

        $years = $this->db->get('edu_year')->row_array();

        return $years;
    }

    function load_batch_list() {
        $course = $this->input->post('selected_course_id');
        $this->db->select('id,batch_code');
        if ($course != "all") {
            $this->db->where('course_id', $course);
        }
        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_semesters() {
        $this->db->select('no_of_semester');
        $this->db->where('year_id', $this->input->post('year_id'));
        $this->db->where('year_no', $this->input->post('year_no'));
        $result = $this->db->get('edu_semester')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
    }

//    function search_students_lookup($data) {
//        
//        $access_level = $this->Util_model->check_access_level();
//
//        $ug_level = $access_level[0]['ug_level'];
//
//        $this->db->select('*, st.deleted as stu_deleted');
//        $this->db->join('edu_course de','de.id=st.course_id');
//        $this->db->join('cfg_branch cb','cb.br_id=st.center_id');
//        
//        if($data['course_id'] != "all"){
//            $this->db->where('st.course_id', $data['course_id']);
//        }
//        
//        if($data['batch_id'] != ""){
//            $this->db->where('st.batch_id', $data['batch_id']);
//        }
//        
//        if($data['year_no'] != "all"){
//            $this->db->where('st.current_year', $data['year_no']);
//        }
//        
//        if($data['semester_no'] != "all"){
//            $this->db->where('st.current_semester', $data['semester_no']);
//        }
//        
//        if($ug_level == 1){
//            if($data['center_id'] != "all"){
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        }
//        else{
//            $center = $this->session->userdata('user_branch');
//            
//            $this->db->where('st.center_id', $center);
//        }
//        
//        $this->db->where('st.approved', 1);
//        $this->db->where('st.deleted', 0);
//        $result_array = $this->db->get('stu_reg st')->result_array();
//
//        return $result_array;
//    }

    function search_students_lookup($data) {

        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*,casgo1.grade as olmathg, casgo2.grade as olenglishg , cas1.subject_name as cas1s, cas2.subject_name as cas2s, cas3.subject_name as cas3s, cas4.subject_name as cas4s, '
                . 'casg1.grade as sub1g, casg2.grade as sub2g, casg3.grade as sub3g, casg4.grade as sub4g, st.deleted as stu_deleted, SUBSTRING_INDEX(st.reg_no, "/", -1) as regno_order');
        $this->db->join('edu_course de', 'de.id=st.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=st.center_id');
        $this->db->join('com_al_subject_stream cass', 'cass.stream_id = st.al_stream');
        $this->db->join('com_al_subject cas1', 'cas1.subject_id = st.al_subject1');
        $this->db->join('com_al_subject cas2', 'cas2.subject_id = st.al_subject2');
        $this->db->join('com_al_subject cas3', 'cas3.subject_id = st.al_subject3');
        $this->db->join('com_al_subject cas4', 'cas4.subject_id = st.al_subject4', 'LEFT');
        $this->db->join('com_al_subject_grade casg1', 'casg1.grade_id = st.al_subject1_grade');
        $this->db->join('com_al_subject_grade casg2', 'casg2.grade_id = st.al_subject2_grade');
        $this->db->join('com_al_subject_grade casg3', 'casg3.grade_id = st.al_subject3_grade');
        $this->db->join('com_al_subject_grade casg4', 'casg4.grade_id = st.al_subject4_grade', 'LEFT');

        $this->db->join('com_al_subject_grade casgo1', 'casgo1.grade_id = st.ol_maths_grade');
        $this->db->join('com_al_subject_grade casgo2', 'casgo2.grade_id = st.ol_english_grade');



        if ($data['course_id'] != "all") {
            $this->db->where('st.course_id', $data['course_id']);
        }

        if ($data['batch_id'] != "") {
            $this->db->where('st.batch_id', $data['batch_id']);
        }

        if ($data['year_no'] != "all") {
            $this->db->where('st.current_year', $data['year_no']);
        }

        if ($data['semester_no'] != "all") {
            $this->db->where('st.current_semester', $data['semester_no']);
        }

        if ($ug_level == 1) {
            if ($data['center_id'] != "all") {
                $this->db->where('st.center_id', $data['center_id']);
            }
        } else if ($ug_level == 3) {
            if ($data['center_id'] == "all") {
                $this->db->where_in('st.center_id', $arr);
            } else {
                $this->db->where('st.center_id', $data['center_id']);
            }
        } else {
            $center = $this->session->userdata('user_branch');

            $this->db->where('st.center_id', $center);
        }

        if ($data['type_student'] == 0) {
            $this->db->where('st.approved', 1);
        } else {
            $this->db->where('st.approved', 0);
        }

        $this->db->where('st.deleted', 0);
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg st')->result_array();

        return $result_array;
    }

    function search_staff_lookup($data) {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*, sld.deleted as staff_deleted');
        $this->db->join('cfg_branch cb', 'cb.br_id=sld.center_id');
//        $this->db->join('edu_course de','de.id=sld.course_id');
        $this->db->join('com_title ct', 'ct.id=sld.tit_name');

        if ($ug_level == 1) {
            if ($data['center_id'] != "all") {
                $this->db->where('sld.center_id', $data['center_id']);
            }
        } else {
            $center = $this->session->userdata('user_branch');

            $this->db->where('sld.center_id', $center);
        }

//        if($data['course_id'] != "all"){
//            $this->db->where('sld.course_id', $data['course_id']);
//        }

        $this->db->where('sld.approved', 1);
        $this->db->where('sld.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_details sld')->result_array();

        return $result_array;
    }

    function search_student_exam_lookup($data) {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*, sld.deleted as staff_deleted');
        $this->db->join('cfg_branch cb', 'cb.br_id=sld.center_id');
//        $this->db->join('edu_course de','de.id=sld.course_id');
        $this->db->join('com_title ct', 'ct.id=sld.tit_name');

        if ($ug_level == 1) {
            if ($data['center_id'] != "all") {
                $this->db->where('sld.center_id', $data['center_id']);
            }
        } else {
            $center = $this->session->userdata('user_branch');

            $this->db->where('sld.center_id', $center);
        }

//        if($data['course_id'] != "all"){
//            $this->db->where('sld.course_id', $data['course_id']);
//        }

        $this->db->where('sld.approved', 1);
        $this->db->where('sld.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_details sld')->result_array();

        return $result_array;
    }

//    function get_all_stu_count(){
//        
//        $access_level = $this->Util_model->check_access_level();
//
//        $ug_level = $access_level[0]['ug_level'];
//        
//        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(sr.stu_id) as stu_count, COUNT(IF(sr.approved = "1", sr.approved, null)) as apprv_status, COUNT(IF(sr.approved = "3", sr.approved, null)) as reject_status, COUNT(IF(sr.approved = "0", sr.approved, null)) as status');
//        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
//        $this->db->where('sr.deleted', 0);
//        
//        if($ug_level != 1){
//            $center = $this->session->userdata('user_branch');
//            $this->db->where('sr.center_id', $center);
//        }
//        $this->db->group_by('sr.course_id');
//        $this->db->group_by('sr.center_id');
//        $this->db->order_by('cb.br_name');
//        
//        return $stu_all_count_array = $this->db->get('stu_reg sr')->result_array();
//    }

    function get_student_list_years() {

        $this->db->select('created_date, EXTRACT(YEAR FROM created_date) as year');
        $this->db->group_by('EXTRACT(YEAR FROM created_date)');
        return $this->db->get('stu_reg')->result_array();
    }

    function get_rpt_all_stu_count($fulsumyr) {

        $x = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$x] = $value['br_id'];
                $x++;
            }
        }


        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(sr.stu_id) as stu_count, COUNT(IF(sr.approved = "1", sr.approved, null)) as apprv_status, COUNT(IF(sr.approved = "3", sr.approved, null)) as reject_status, COUNT(IF(sr.approved = "0", sr.approved, null)) as status');
        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');


        if ($ug_level != 1 && $ug_level != 3) {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sr.center_id', $center);
        } else if ($ug_level == 3) {
            $this->db->where_in('sr.center_id', $arr);
        }

        $this->db->where('sr.deleted', 0);
        $this->db->where('EXTRACT(YEAR FROM sr.created_date)=' . $fulsumyr);
        $this->db->group_by('sr.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->order_by('cb.br_name');

        return $stu_all_count_array = $this->db->get('stu_reg sr')->result_array();
    }

    function get_all_stu_count() {

        $x = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$x] = $value['br_id'];
                $x++;
            }
        }


        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(sr.stu_id) as stu_count, COUNT(IF(sr.approved = "1", sr.approved, null)) as apprv_status, COUNT(IF(sr.approved = "3", sr.approved, null)) as reject_status, COUNT(IF(sr.approved = "0", sr.approved, null)) as status');
        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');


        if ($ug_level != 1 && $ug_level != 3) {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sr.center_id', $center);
        } else if ($ug_level == 3) {
            $this->db->where_in('sr.center_id', $arr);
        }

        $this->db->where('sr.deleted', 0);
        $this->db->group_by('sr.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->order_by('cb.br_name');

        return $stu_all_count_array = $this->db->get('stu_reg sr')->result_array();
    }

    function get_all_staff_count() {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('cb.br_code, cb.br_name, COUNT(sld.stf_id) as staff_count, COUNT(IF(sld.approved = "1", sld.approved, null)) as apprv_status, COUNT(IF(sld.approved = "3", sld.approved, null)) as reject_status, COUNT(IF(sld.approved = "0", sld.approved, null)) as status');

        $this->db->join('cfg_branch cb', 'cb.br_id=sld.center_id');
        $this->db->where('sld.deleted', 0);

        if ($ug_level != 1) {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sld.center_id', $center);
        }
        $this->db->group_by('sld.center_id');
        $this->db->order_by('cb.br_name');

        return $stu_all_count_array = $this->db->get('sta_lecturer_details sld')->result_array();
    }

    function get_all_mahapola_student_count() {

        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(srm.mahapola_id) as stu_count, COUNT(IF(srm.approved = "1", srm.approved, null)) as apprv_status, COUNT(IF(srm.approved = "3", srm.approved, null)) as reject_status, COUNT(IF(srm.approved = "0", srm.approved, null)) as status');
        $this->db->join('stu_reg sr', 'sr.stu_id=srm.stu_id');
        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->where('sr.deleted', 0);
        $this->db->group_by('sr.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->order_by('cb.br_name');

        return $stu_all_count_array = $this->db->get('stu_reg_mahapola srm')->result_array();
    }

//    function student_course_wise_details($type){
//        
//        //$type = $this->input->post('type_val');
//        $access_level = $this->Util_model->check_access_level();
//
//        $ug_level = $access_level[0]['ug_level'];
//        
//        if($type == "gender"){
//            $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, sr.sex, COUNT(IF(sr.sex = "F", sr.sex, null)) as type2, COUNT(IF(sr.sex = "M", sr.sex, null)) as type1, COUNT(sr.sex) as type3');     
//        }
//         
//        if($type == "time"){
//            $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(IF(sr.course_type = "P", sr.course_type, null)) as type1, COUNT(IF(sr.course_type = "F", sr.course_type, null)) as type2, COUNT(sr.course_type) as type3');
//        }
//        
//        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
//        $this->db->where('sr.approved', 1);
//        $this->db->where('sr.deleted', 0);
//        if($ug_level != 1){
//           $center = $this->session->userdata('user_branch');
//           $this->db->where('sr.center_id', $center); 
//        }
//        $this->db->group_by('sr.course_id');
//        $this->db->group_by('sr.center_id');
//        $this->db->order_by('cb.br_name');
//        
//        return $stu_count_array = $this->db->get('stu_reg sr')->result_array();
//    }

    function student_course_wise_details($type) {

        $y = 0;
        //$type = $this->input->post('type_val');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$y] = $value['br_id'];
                $y++;
            }
        }


        if ($type == "gender") {
            $this->db->select('*, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, sr.sex, COUNT(IF(sr.sex = "F", sr.sex, null)) as type2, COUNT(IF(sr.sex = "M", sr.sex, null)) as type1, COUNT(sr.sex) as type3');
        }

        if ($type == "time") {
            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(IF(sr.course_type = "P", sr.course_type, null)) as type1, COUNT(IF(sr.course_type = "F", sr.course_type, null)) as type2, COUNT(sr.course_type) as type3');
        }

        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        if ($ug_level != 1 && $ug_level != 3) {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sr.center_id', $center);
        } else if ($ug_level == 3) {
            $this->db->where_in('sr.center_id', $arr);
        }
        $this->db->group_by('sr.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->order_by('cb.br_name');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');//////////Query Change

        return $stu_count_array = $this->db->get('stu_reg sr')->result_array();
    }

    function student_course_wise_mahapola_details($type) {

        //$type = $this->input->post('type_val');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(srm.mahapola_id) as stu_count, COUNT(IF(srm.approved = "1", srm.approved, null)) as apprv_status, COUNT(IF(srm.approved = "3", srm.approved, null)) as reject_status, COUNT(IF(srm.approved = "0", srm.approved, null)) as status');
        $this->db->join('stu_reg sreg', 'sreg.stu_id=srm.stu_id');
        $this->db->join('edu_course ec', 'ec.id=sreg.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sreg.center_id');
        $this->db->where('sreg.deleted', 0);
        if ($ug_level == 1) {
            if ($type != "all") {
                $this->db->where('sreg.center_id', $type);
            }
        } else {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sreg.center_id', $center);
        }

        $this->db->group_by('sreg.course_id');
        $this->db->group_by('sreg.center_id');
        $this->db->order_by('cb.br_name');

        return $stu_mahapola_count_array = $this->db->get('stu_reg_mahapola srm')->result_array();
    }

//    function load_mahapola_course_list(){
//        $this->db->select('*');
//        return $mahapola_course = $this->db->get('edu_course')->result_array();
//    }

    function get_mahapola_data($course, $center, $all, $mp_year) {
        $this->db->select('COUNT(stu_id) as stu_count');
        $mahapola_data['stu_count'] = $this->db->get('stu_reg')->result_array();

        $this->db->select('COUNT(strm.mahapola_id) as mp_count');
        $this->db->join('stu_reg_mahapola strm', 'strm.stu_id = str.stu_id');
        $this->db->join('edu_course edc', 'edc.id = str.course_id');
        if ($all == 0) {
            if ($center != "all") {
                $this->db->where('str.center_id', $center);
            }
            if ($course != "all") {
                $this->db->where('str.course_id', $course);
            }
            if ($mp_year != "all" && $mp_year != null) {
                $this->db->where('EXTRACT(YEAR FROM strm.created_date) = ' . $mp_year);
            }
        }
        $this->db->where('str.apply_mahapola', 1);
        $this->db->where('str.approved', 1);
        $this->db->where('str.deleted', 0);
        $this->db->where('strm.approved', 1);
        $this->db->where('strm.is_eligible', 1);
        $this->db->where('strm.director_approved', 1);
        $mahapola_data['mp_count'] = $this->db->get('stu_reg str')->result_array();

        $this->db->select('UPPER(sr.first_name) as first_name ,UPPER(sr.last_name) as last_name, UPPER(srm.full_name) as full_name,sr.al_year,sr.al_index_no,sr.al_z_core,sr.sex,sr.nic_no,sr.reg_no,UPPER(sr.permanent_address) as permanent_address, srm.need_index, UPPER(ec.course_code) as course_code, UPPER(ec.course_code_mahapola) as course_code_mahapola, ec.course_name, center.br_name as center_name');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id = sr.stu_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');
        $this->db->join('cfg_branch center', 'center.br_id = sr.center_id');
        if ($all == 0) {
            if ($center != "all") {
                $this->db->where('sr.center_id', $center);
            }
            if ($course != "all") {
                $this->db->where('sr.course_id', $course);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $mp_year);
            }
        }
        $this->db->where('sr.apply_mahapola', 1);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('srm.approved', 1);
        $this->db->where('srm.is_eligible', 1);
        $this->db->where('srm.director_approved', 1);
        $this->db->order_by('ec.course_code', 'ASC');
        $this->db->order_by('srm.need_index', 'DESC');
        $mahapola_data['mahapola'] = $this->db->get('stu_reg sr')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'RPT');
        $this->db->where('group', 1);
        $mahapola_data['authority'] = $this->db->get('cfg_common')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'MHPRPT');
        $this->db->where('group', 4);
        $mahapola_data['Mahapola_commence_dates'] = $this->db->get('cfg_common')->result_array();

        return $mahapola_data;
    }

    function get_mahapola_data_full($course1, $center1, $mp_year) {

        //$course = $this->input->post('course');

        $this->db->select('COUNT(stu_id) as stu_count');
        $mahapola_data['stu_count'] = $this->db->get('stu_reg')->result_array();

        $this->db->select('COUNT(strm1.mahapola_id) as mp_count');
        $this->db->join('stu_reg_mahapola strm1', 'strm1.stu_id = str1.stu_id');
        $this->db->join('edu_course edc1', 'edc1.id = str1.course_id');
        if ($center1 != "all") {
            $this->db->where('str1.center_id', $center1);
        }
        if ($course1 != "all") {
            $this->db->where('str1.course_id', $course1);
        }
        if ($mp_year != "all") {
            $this->db->where('EXTRACT(YEAR FROM strm1.created_date) = ' . $mp_year);
        }
        $this->db->where('str1.apply_mahapola', 1);
        $this->db->where('str1.approved', 1);
        $this->db->where('str1.deleted', 0);
        $this->db->where('strm1.approved', 1);
        $this->db->where('strm1.director_approved', 1);
        $mahapola_data['mp_count'] = $this->db->get('stu_reg str1')->result_array();

        $this->db->select('UPPER(sr1.first_name) as first_name ,UPPER(sr1.last_name) as last_name,UPPER(srm1.full_name) as full_name,sr1.al_year,sr1.al_index_no,sr1.al_z_core,sr1.sex,sr1.nic_no,sr1.reg_no,UPPER(sr1.permanent_address) as permanent_address, srm1.need_index, UPPER(ec1.course_code) as course_code, ec1.course_name, center.br_name as center_name,UPPER(ec1.course_code_mahapola) as course_code_mahapola');
        //$this->db->select('sr1.*, srm1.need_index, ec1.course_code, ec1.course_name');
        $this->db->join('stu_reg_mahapola srm1', 'srm1.stu_id = sr1.stu_id');
        $this->db->join('edu_course ec1', 'ec1.id = sr1.course_id');
        $this->db->join('cfg_branch center', 'center.br_id = sr1.center_id');
        if ($center1 != "all") {
            $this->db->where('sr1.center_id', $center1);
        }
        if ($course1 != "all") {
            $this->db->where('sr1.course_id', $course1);
        }
        if ($mp_year != "all") {
            $this->db->where('EXTRACT(YEAR FROM srm1.created_date) = ' . $mp_year);
        }
        $this->db->where('sr1.apply_mahapola', 1);
        $this->db->where('sr1.approved', 1);
        $this->db->where('sr1.deleted', 0);
        $this->db->where('srm1.approved', 1);
        $this->db->where('srm1.director_approved', 1);
        $this->db->order_by('srm1.need_index', 'DESC');
        $mahapola_data['mahapola'] = $this->db->get('stu_reg sr1')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'RPT');
        $this->db->where('group', 1);
        $mahapola_data['authority'] = $this->db->get('cfg_common')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'MHPRPT');
        $this->db->where('group', 4);
        $mahapola_data['Mahapola_commence_dates'] = $this->db->get('cfg_common')->result_array();

        return $mahapola_data;
    }

    function get_mahapola_data_ne($course2, $center2, $mp_year, $all) {

        //$course = $this->input->post('course');

        $this->db->select('COUNT(stu_id) as stu_count');
        $mahapola_data['stu_count'] = $this->db->get('stu_reg')->result_array();

        $this->db->select('COUNT(strm2.mahapola_id) as mp_count');
        $this->db->join('stu_reg_mahapola strm2', 'strm2.stu_id = str2.stu_id');
        $this->db->join('edu_course edc2', 'edc2.id = str2.course_id');
        if ($all == 0) {
            if ($center2 != "all") {
                $this->db->where('str2.center_id', $center2);
            }
            if ($course2 != "all") {
                $this->db->where('str2.course_id', $course2);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM strm2.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM strm2.created_date) = ' . $mp_year);
            }
        }

        $this->db->where('str2.apply_mahapola', 1);
        $this->db->where('str2.approved', 1);
        $this->db->where('str2.deleted', 0);
        $this->db->where('strm2.approved', 1);
        $this->db->where('strm2.is_eligible', 0);
        $this->db->where('strm2.director_approved', 1);

        $mahapola_data['mp_count'] = $this->db->get('stu_reg str2')->result_array();

        $this->db->select('UPPER(sr2.first_name) as first_name ,UPPER(sr2.last_name) as last_name,UPPER(srm2.full_name) as full_name,sr2.al_year,sr2.al_index_no,sr2.al_z_core,sr2.sex,sr2.nic_no,sr2.reg_no,center.br_name as center_name,UPPER(sr2.permanent_address) as permanent_address, srm2.need_index, UPPER(ec2.course_code) as course_code, ec2.course_name,UPPER(ec2.course_code_mahapola) as course_code_mahapola');
        //$this->db->select('sr2.*, srm2.need_index, ec2.course_code, ec2.course_name');
        $this->db->join('stu_reg_mahapola srm2', 'srm2.stu_id = sr2.stu_id');
        $this->db->join('edu_course ec2', 'ec2.id = sr2.course_id');
        $this->db->join('cfg_branch center', 'center.br_id = sr2.center_id');
        if ($all == 0) {
            if ($center2 != "all") {
                $this->db->where('sr2.center_id', $center2);
            }
            if ($course2 != "all") {
                $this->db->where('sr2.course_id', $course2);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm2.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm2.created_date) = ' . $mp_year);
            }
        }

        // $this->db->where('sr2.apply_mahapola', 1);
        $this->db->where('sr2.approved', 1);
        $this->db->where('sr2.deleted', 0);
        $this->db->where('srm2.approved', 1);
        $this->db->where('srm2.is_eligible', 0);
        $this->db->where('srm2.director_approved', 1);
        $this->db->order_by('srm2.need_index', 'DESC');

        $mahapola_data['mahapola'] = $this->db->get('stu_reg sr2')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'RPT');
        $this->db->where('group', 1);
        $mahapola_data['authority'] = $this->db->get('cfg_common')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'MHPRPT');
        $this->db->where('group', 4);
        $mahapola_data['Mahapola_commence_dates'] = $this->db->get('cfg_common')->result_array();

        return $mahapola_data;
    }

    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }

    function get_center_admin_login_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }

    function get_login_user_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();


        return $user_centers;
    }

    function search_students_id_card_details($data) {

        // $this->db->select('*, sreg.deleted as stu_deleted');
        $this->db->select('*, SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 1), "/", -1) AS CODE1,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 2), "/", -1) AS CODE2,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 3), "/", -1) AS CODE3,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 4), "/", -1) AS CODE4,
                              SUBSTRING_INDEX(sreg.reg_no, "/", -1) as regno_order,
                              CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 5), "/", -1) AS UNSIGNED) AS CODE5');
        $this->db->join('edu_course edc', 'edc.id=sreg.course_id');
        $this->db->join('cfg_branch cfb', 'cfb.br_id=sreg.center_id');

        if ($data['course_id'] != "all") {
            $this->db->where('sreg.course_id', $data['course_id']);
        }

        $this->db->where('sreg.center_id', $data['center_id']);
        $this->db->where('sreg.approved', 1);
        $this->db->where('sreg.deleted', 0);
        $this->db->group_by('sreg.reg_no');
        $this->db->order_by('CODE5', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg sreg')->result_array();

        return $result_array;
    }

    function search_students_id_card_details_year_wise($data) {

        // $this->db->select('*, sreg.deleted as stu_deleted');
        $this->db->select('*, SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 1), "/", -1) AS CODE1,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 2), "/", -1) AS CODE2,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 3), "/", -1) AS CODE3,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 4), "/", -1) AS CODE4,
                              SUBSTRING_INDEX(sreg.reg_no, "/", -1) as regno_order,
                              CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 5), "/", -1) AS UNSIGNED) AS CODE5');
        $this->db->join('edu_course edc', 'edc.id=sreg.course_id');
        $this->db->join('cfg_branch cfb', 'cfb.br_id=sreg.center_id');
        $this->db->join('cfg_district cd', 'sreg.district=cd.code');
        $this->db->join('com_religion cr', 'sreg.religion=cr.rel_id');

        if ($data['course_id'] != "all") {
            $this->db->where('sreg.course_id', $data['course_id']);
        }

        $this->db->where('sreg.center_id', $data['center_id']);
        $this->db->where('sreg.approved', 1);
        $this->db->where('sreg.deleted', 0);
        $this->db->where('EXTRACT(YEAR FROM sreg.created_date)=' . $data['year']);
        $this->db->group_by('sreg.reg_no');
        $this->db->order_by('CODE5', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg sreg')->result_array();

        return $result_array;
    }

    function load_mahapola_course_list() {
        $center = $this->input->post('center_id');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');

        if ($center != "all") {
            $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
            $this->db->where('ecc.center_id', $center);
        }

        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function get_student_exam_details($data) {

        $student_details = array();
        //get student data
        $this->db->select('*,sr.current_year as stu_year,sr.current_semester as stu_semester');
//        YEAR(STR_TO_DATE(DATE_ADD(eb.start_date , INTERVAL (sr.current_year-1) year), "%Y-%m-%d")) as exam_year
        //YEAR(STR_TO_DATE(DATE_ADD(edu_batch.start_date , INTERVAL (stu_reg.current_year-1) year), '%Y-%m-%d'))

        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('edu_course ec', 'sr.course_id = ec.id');
        $this->db->join('edu_batch eb', 'eb.course_id = sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->where('sr.stu_id', $data['id']);
        $this->db->where('esed.is_approved', 2);
//        $this->db->group_by('subject_id');
        $student_details['stu_all_count_array'] = $this->db->get('exm_semester_exam_details esed')->result_array();


        //get timetable data
        if (count($student_details['stu_all_count_array']) > 0) {
            $this->db->select('ese.exam_id');
            $this->db->where('ese.course_id ', $student_details['stu_all_count_array'][0]['course_id']);
            $this->db->where('ese.year_no ', $student_details['stu_all_count_array'][0]['stu_year']);
            $this->db->where('ese.semester_no ', $student_details['stu_all_count_array'][0]['stu_semester']);
            $this->db->where('ese.batch_id ', $student_details['stu_all_count_array'][0]['batch_id']);
            $exam_id = $this->db->get('exm_semester_exam ese')->row_array();
        }
        if (count($exam_id) > 0) {

            $this->db->select('es.esch_id,es.esch_date,es.esch_stime,es.esch_etime,mmd.name, csv.version_name,ms.code,ms.subject');
            $this->db->join('tta_examtimetable te', 'te.ttbl_id=es.esch_timetable');
            $this->db->join('mod_marking_details mmd', 'mmd.id=es.esch_examtype');
            $this->db->join('mod_subject ms', 'es.esch_subject= ms.id');
            $this->db->join('cfg_subject_version csv', 'ms.version_id =csv.version_id');
            $this->db->where('te.ttbl_exam', $exam_id['exam_id']);
            $this->db->where('es.esch_status', 'A');
            $this->db->order_by('es.esch_date ASC,es.esch_stime ASC');
            $schedules = $this->db->get('exm_schedule es')->result_array();
        }

        if (isset($schedules)) {
            for ($i = 0; $i < count($schedules); $i++) {
                $this->db->select('csv.version_name');
                $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
                $this->db->where('essv.esch_id', $schedules[$i]['esch_id']);

                $schedules[$i]['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();

                $student_details['schedules'] = $schedules;
            }
        } else {
            $student_details['schedules'] = array();
        }





        //get student follow subjects
        $this->db->distinct();
        $this->db->select('sfs.subject_id,csv.version_name,ms.subject,ms.code');
        $this->db->join('stu_follow_subject sfs', 'ss.id=sfs.student_subject_id');
        $this->db->join('cfg_subject_version csv', 'csv.version_id=sfs.version_id');
        $this->db->join('exm_semester_exam_details esed', 'esed.student_id=ss.student_id');
        $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
        $this->db->join('mod_subject ms', 'esed.subject_id=ms.id');
        $this->db->where('ss.student_id', $data['id']);
        $this->db->where('esed.is_approved', 2);
        $this->db->where('ese.exam_id', $exam_id['exam_id']);
        $this->db->where('ss.deleted', 0);
        $this->db->where('sfs.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->group_by('ms.id');
        $student_details['student_follow_subject'] = $this->db->get('stu_subject ss')->result_array();

        //get common persons details

        $this->db->select('cc.name,cc.position');
        $this->db->where('cc.type', 'EXM');
        $student_details['common_details'] = $this->db->get('cfg_common cc')->result_array();

        //update pdf generate status
        $this->db->trans_begin();
        $update_data = array(
            'admission_gen_status' => 1,
            'admission_gen_by' => $this->session->userdata('u_id'),
            'admission_gen_on' => date("Y-m-d H:i:s", now())
        );
        $this->db->where('stu_id', $data['id']);
        $this->db->where('exm_semester_exam_id', $exam_id['exam_id']);
        $this->db->update('exm_semester_exam_student_status', $update_data);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $student_details;
    }

    function get_student_exam_details_repeat($data) {

        $student_details = array();
        //get student data
        $this->db->select('*,sr.current_year as stu_year,sr.current_semester as stu_semester');
//        YEAR(STR_TO_DATE(DATE_ADD(eb.start_date , INTERVAL (sr.current_year-1) year), "%Y-%m-%d")) as exam_year
        //YEAR(STR_TO_DATE(DATE_ADD(edu_batch.start_date , INTERVAL (stu_reg.current_year-1) year), '%Y-%m-%d'))

        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('edu_course ec', 'sr.course_id = ec.id');
        $this->db->join('edu_batch eb', 'eb.course_id = sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->where('sr.stu_id', $data['id']);
        $this->db->where('esed.is_repeat_approved', 1);
        $this->db->where('esed.semester_exam_id', $data['sitting_exam']);
//        $this->db->group_by('subject_id');
        $student_details['stu_all_count_array'] = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();

        //get timetable data
        if (count($student_details['stu_all_count_array']) > 0) {
//            $this->db->select('ese.exam_id');
//            $this->db->where('ese.course_id ', $student_details['stu_all_count_array'][0]['course_id']);
//            $this->db->where('ese.year_no ', $student_details['stu_all_count_array'][0]['applying_year']);
//            $this->db->where('ese.semester_no ', $student_details['stu_all_count_array'][0]['applying_semester']);
//            $this->db->where('ese.batch_id ', $data['sitting_batch']);
//            $exam_id = $this->db->get('exm_semester_exam ese')->row_array();
            $exam_id = $data['sitting_exam'];
        }
        if (count($exam_id) > 0) {

            $this->db->select('es.esch_id,es.esch_date,es.esch_stime,es.esch_etime,mmd.name, csv.version_name,ms.code,ms.subject');
            $this->db->join('tta_examtimetable te', 'te.ttbl_id=es.esch_timetable');
            $this->db->join('mod_marking_details mmd', 'mmd.id=es.esch_examtype');
            $this->db->join('mod_subject ms', 'es.esch_subject= ms.id');
            $this->db->join('cfg_subject_version csv', 'ms.version_id =csv.version_id');
            $this->db->where('te.ttbl_exam', $exam_id);
            $this->db->where('es.esch_status', 'A');
            $this->db->order_by('es.esch_date ASC,es.esch_stime ASC');
            $schedules = $this->db->get('exm_schedule es')->result_array();
        }

        if (isset($schedules)) {
            for ($i = 0; $i < count($schedules); $i++) {
                $this->db->select('csv.version_name');
                $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
                $this->db->where('essv.esch_id', $schedules[$i]['esch_id']);

                $schedules[$i]['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();

                $student_details['schedules'] = $schedules;
            }
        } else {
            $student_details['schedules'] = array();
        }





        //get student follow subjects
        $this->db->distinct();
        $this->db->select('sfs.subject_id,csv.version_name,ms.subject,ms.code');
        $this->db->join('stu_follow_subject sfs', 'ss.id=sfs.student_subject_id');
        $this->db->join('cfg_subject_version csv', 'csv.version_id=sfs.version_id');
        $this->db->join('exm_semester_exam_details_repeat esed', 'esed.stu_id=ss.student_id');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id=esed.semester_exam_id');
        $this->db->join('mod_subject ms', 'esed.subject_id=ms.id');
        $this->db->where('ss.student_id', $data['id']);
        $this->db->where('esed.is_repeat_approved', 1);
        $this->db->where('ese.exam_id', $exam_id);
        $this->db->where('ss.deleted', 0);
        $this->db->where('sfs.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->group_by('ms.id');
        $student_details['student_follow_subject'] = $this->db->get('stu_subject ss')->result_array();

        //get common persons details

        $this->db->select('cc.name,cc.position');
        $this->db->where('cc.type', 'EXM');
        $student_details['common_details'] = $this->db->get('cfg_common cc')->result_array();

        //update pdf generate status
        $this->db->trans_begin();
        $update_data = array(
            'admission_gen_status' => 1,
            'admission_gen_by' => $this->session->userdata('u_id'),
            'admission_gen_on' => date("Y-m-d H:i:s", now())
        );
        $this->db->where('stu_id', $data['id']);
        $this->db->where('exm_semester_exam_id', $exam_id);
        $this->db->update('exm_semester_exam_student_status', $update_data);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $student_details;
    }

    function get_student_exam_details_bulk($data) {
        $student_details = array();
        $exam_idno = isset($data['exam_id']) ? $data['exam_id'] : "";
        $stu_id_array = $data['stu_ids'];
        // return $stu_id_array;
        $count = 0;
        for ($r = 0; $r < count($stu_id_array); $r++) {


            //get student data
            $this->db->select('sr.stu_id,sr.batch_id,sr.first_name,sr.last_name,sr.reg_no,sr.current_semester,sr.current_year,sr.course_id ,ec.course_name,cb.br_name,esed.subject_id');
//YEAR(STR_TO_DATE(DATE_ADD(eb.start_date , INTERVAL (sr.current_year-1) year), "%Y-%m-%d")) as exam_year            
//YEAR(STR_TO_DATE(DATE_ADD(edu_batch.start_date , INTERVAL (stu_reg.current_year-1) year), '%Y-%m-%d'))
            $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
            $this->db->join('edu_course ec', 'sr.course_id = ec.id');
            $this->db->join('edu_batch eb', 'eb.course_id = sr.course_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->where('sr.stu_id', $stu_id_array[$r]);
            $this->db->where('esed.is_approved', 2);
            $this->db->where('sr.deleted', 0);
            $this->db->group_by('stu_id');
            $student_details[$r]['stu_all_count_array'] = $this->db->get('exm_semester_exam_details esed')->result_array();

            if ($exam_idno == "") {
                if (count($student_details[$r]['stu_all_count_array']) > 0) {
                    $this->db->select('ese.exam_id');
                    $this->db->where('ese.course_id ', $student_details[$r]['stu_all_count_array'][0]['course_id']);
                    $this->db->where('ese.year_no ', $student_details[$r]['stu_all_count_array'][0]['current_year']);
                    $this->db->where('ese.semester_no ', $student_details[$r]['stu_all_count_array'][0]['current_semester']);
                    $this->db->where('ese.batch_id ', $student_details[$r]['stu_all_count_array'][0]['batch_id']);
                    $exam_id = $this->db->get('exm_semester_exam ese')->row_array();
                    $exam_idno = $exam_id['exam_id'];
                }
            }

            //get student follow subjects

            $this->db->distinct();
            $this->db->select('sfs.subject_id,csv.version_name,ms.subject,ms.code');
            $this->db->join('stu_follow_subject sfs', 'ss.id=sfs.student_subject_id');
            $this->db->join('cfg_subject_version csv', 'csv.version_id=sfs.version_id');
            $this->db->join('exm_semester_exam_details esed', 'esed.student_id=ss.student_id');
            $this->db->join('exm_semester_exam ese', 'ese.id=esed.semester_exam_id');
            $this->db->join('mod_subject ms', 'esed.subject_id=ms.id');
            $this->db->where('ss.student_id', $stu_id_array[$r]);
            $this->db->where('esed.is_approved', 2);
            $this->db->where('ese.exam_id', $exam_idno);
            $this->db->where('ss.deleted', 0);
            $this->db->where('sfs.deleted', 0);
            $this->db->where('esed.deleted', 0);
            $this->db->group_by('ms.id');
            $student_details[$r]['student_follow_subject'] = $this->db->get('stu_subject ss')->result_array();
            $count++;

            //update pdf generate status


            $this->db->trans_begin();
            $update_data = array(
                'admission_gen_status' => 1,
                'admission_gen_by' => $this->session->userdata('u_id'),
                'admission_gen_on' => date("Y-m-d H:i:s", now())
            );
            $this->db->where('stu_id', $stu_id_array[$r]);
            $this->db->where('exm_semester_exam_id', $exam_idno);
            $this->db->update('exm_semester_exam_student_status', $update_data);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }

        //get timetable data
        // if (count($exam_id) > 0) {
        $this->db->select('es.esch_id,es.esch_date,es.esch_stime,es.esch_etime,mmd.name, csv.version_name,ms.code,ms.subject');
        $this->db->join('tta_examtimetable te', 'te.ttbl_id=es.esch_timetable');
        $this->db->join('mod_marking_details mmd', 'mmd.id=es.esch_examtype');
        $this->db->join('mod_subject ms', 'es.esch_subject= ms.id');
        $this->db->join('cfg_subject_version csv', 'ms.version_id =csv.version_id');
        $this->db->where('te.ttbl_exam', $exam_idno);
        $this->db->where('es.esch_status', 'A');
        $this->db->order_by('es.esch_date ASC,es.esch_stime ASC');
        $schedules = $this->db->get('exm_schedule es')->result_array();
        // }

        for ($i = 0; $i < count($schedules); $i++) {
            $this->db->select('csv.version_name');
            $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
            $this->db->where('essv.esch_id', $schedules[$i]['esch_id']);
            $schedules[$i]['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();
        }

        $student_details['schedules'] = $schedules;
        $student_details['count'] = $count;


        //get common persons details

        $this->db->select('cc.name,cc.position');
        $this->db->where('cc.type', 'EXM');
        $student_details['common_details'] = $this->db->get('cfg_common cc')->result_array();

        return $student_details;
    }

    function get_student_exam_details_bulk_repeat($data) {
        $student_details = array();
        $exam_idno = isset($data['exam_id']) ? $data['exam_id'] : "";
        $stu_id_array = $data['stu_ids'];
        // return $stu_id_array;
        $count = 0;
        for ($r = 0; $r < count($stu_id_array); $r++) {


            //get student data
            $this->db->select('sr.stu_id,sr.batch_id,sr.first_name,sr.last_name,sr.reg_no,sr.current_semester,sr.current_year,sr.course_id ,ec.course_name,cb.br_name,esed.subject_id,esed.applying_year, esed.applying_semester');
//YEAR(STR_TO_DATE(DATE_ADD(eb.start_date , INTERVAL (sr.current_year-1) year), "%Y-%m-%d")) as exam_year            
//YEAR(STR_TO_DATE(DATE_ADD(edu_batch.start_date , INTERVAL (stu_reg.current_year-1) year), '%Y-%m-%d'))
            $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
            $this->db->join('edu_course ec', 'sr.course_id = ec.id');
            $this->db->join('edu_batch eb', 'eb.course_id = sr.course_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->where('sr.stu_id', $stu_id_array[$r]);
            $this->db->where('esed.is_repeat_approved', 1);
            $this->db->where('esed.semester_exam_id', $data['exam_id']);
            $this->db->where('sr.deleted', 0);
            $this->db->group_by('stu_id');
            $student_details[$r]['stu_all_count_array'] = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();

            if ($exam_idno == "") {
                if (count($student_details[$r]['stu_all_count_array']) > 0) {
//                    $this->db->select('ese.exam_id');
//                    $this->db->where('ese.course_id ', $student_details[$r]['stu_all_count_array'][0]['course_id']);
//                    $this->db->where('ese.year_no ', $student_details[$r]['stu_all_count_array'][0]['applying_year']);
//                    $this->db->where('ese.semester_no ', $student_details[$r]['stu_all_count_array'][0]['applying_semester']);
//                    $this->db->where('ese.batch_id ', $data['batch_id']);
//                    $exam_id = $this->db->get('exm_semester_exam ese')->row_array();
//                    $exam_idno = $exam_id['exam_id'];
                    $exam_idno = $data['exam_id'];
                }
            }

            //get student follow subjects

            $this->db->distinct();
            $this->db->select('sfs.subject_id,csv.version_name,ms.subject,ms.code');
            $this->db->join('stu_follow_subject sfs', 'ss.id=sfs.student_subject_id');
            $this->db->join('cfg_subject_version csv', 'csv.version_id=sfs.version_id');
            $this->db->join('exm_semester_exam_details_repeat esed', 'esed.stu_id=ss.student_id');
            $this->db->join('exm_semester_exam ese', 'ese.exam_id=esed.semester_exam_id');
            $this->db->join('mod_subject ms', 'esed.subject_id=ms.id');
            $this->db->where('ss.student_id', $stu_id_array[$r]);
            $this->db->where('esed.is_repeat_approved', 1);
            $this->db->where('ese.exam_id', $exam_idno);
            $this->db->where('ss.deleted', 0);
            $this->db->where('sfs.deleted', 0);
            $this->db->where('esed.deleted', 0);
            $this->db->group_by('ms.id');
            $student_details[$r]['student_follow_subject'] = $this->db->get('stu_subject ss')->result_array();
            $count++;

            //update pdf generate status


            $this->db->trans_begin();
            $update_data = array(
                'admission_gen_status' => 1,
                'admission_gen_by' => $this->session->userdata('u_id'),
                'admission_gen_on' => date("Y-m-d H:i:s", now())
            );
            $this->db->where('stu_id', $stu_id_array[$r]);
            $this->db->where('exm_semester_exam_id', $exam_idno);
            $this->db->update('exm_semester_exam_student_status', $update_data);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }


        $this->db->select('es.esch_id,es.esch_date,es.esch_stime,es.esch_etime,mmd.name, csv.version_name,ms.code,ms.subject');
        $this->db->join('tta_examtimetable te', 'te.ttbl_id=es.esch_timetable');
        $this->db->join('mod_marking_details mmd', 'mmd.id=es.esch_examtype');
        $this->db->join('mod_subject ms', 'es.esch_subject= ms.id');
        $this->db->join('cfg_subject_version csv', 'ms.version_id =csv.version_id');
        $this->db->where('te.ttbl_exam', $exam_idno);
        $this->db->where('es.esch_status', 'A');
        $this->db->order_by('es.esch_date ASC,es.esch_stime ASC');
        $schedules = $this->db->get('exm_schedule es')->result_array();
        // }

        for ($i = 0; $i < count($schedules); $i++) {
            $this->db->select('csv.version_name');
            $this->db->join('cfg_subject_version  csv', 'essv.version_id=csv.version_id');
            $this->db->where('essv.esch_id', $schedules[$i]['esch_id']);
            $schedules[$i]['subjects_version'] = $this->db->get('exm_schedule_subject_version essv')->result_array();
        }

        $student_details['schedules'] = $schedules;
        $student_details['count'] = $count;


        //get common persons details

        $this->db->select('cc.name,cc.position');
        $this->db->where('cc.type', 'EXM');
        $student_details['common_details'] = $this->db->get('cfg_common cc')->result_array();

        return $student_details;
    }

    function get_exam_applied_students($data) {
        if ($data['student_status'] == 1) {///////////Current Student Status ONE
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, first_name,nic_no,reg_no,stu_id,(SELECT admission_gen_status FROM exm_semester_exam_student_status WHERE stu_id=student_id AND exm_semester_exam_id=' . $data['exam_id'] . ') as printstatus');
            if ($data['batch_id'] == '' && $data['course_id'] == '') {
                $data['exam_id'] != '' ? $this->db->where('ese.exam_id', $data['exam_id']) : '';
            } else {
                $this->db->join('exm_semester_exam ese', 'ese.id  = esed.semester_exam_id');
                $data['batch_id'] != '' ? $this->db->where('ese.batch_id', $data['batch_id']) : '';
                $data['course_id'] != '' ? $this->db->where('ese.course_id', $data['course_id']) : '';
                $data['exam_id'] != '' ? $this->db->where('ese.exam_id', $data['exam_id']) : '';
            }


            $this->db->join('stu_reg sr', 'sr.stu_id  = esed.student_id');
            $this->db->where('esed.is_approved', 2);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('sr.deleted', 0);
            $this->db->group_by('student_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
            $exam_students = $this->db->get('exm_semester_exam_details esed')->result_array();
            return $exam_students;
            //return $data['names'];
        } else {///////////Repeat Student Status TWO
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.first_name, sr.nic_no, sr.reg_no, sr.stu_id,(SELECT admission_gen_status FROM exm_semester_exam_student_status WHERE stu_id=esedr.stu_id AND exm_semester_exam_id=' . $data['exam_id'] . ') as printstatus');
            if ($data['batch_id'] == '' && $data['course_id'] == '') {
                $data['exam_id'] != '' ? $this->db->where('ese.exam_id', $data['exam_id']) : '';
            } else {
                $this->db->join('exm_semester_exam ese', 'ese.exam_id  = esedr.semester_exam_id');
                $data['batch_id'] != '' ? $this->db->where('ese.batch_id', $data['batch_id']) : '';
                $data['course_id'] != '' ? $this->db->where('ese.course_id', $data['course_id']) : '';
                $data['exam_id'] != '' ? $this->db->where('ese.exam_id', $data['exam_id']) : '';
            }
            $this->db->join('stu_reg sr', 'sr.stu_id  = esedr.stu_id');
            $this->db->where('esedr.is_repeat_approved', 1);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('sr.deleted', 0);
            $this->db->group_by('esedr.stu_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
            $exam_students = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();
//            exm_semester_exam_details_repeat
            return $exam_students;
        }
    }

    function get_all_subjects() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $title_new = $this->db->get('mod_subject')->result_array();

        return $title_new;
    }

    function search_pdf_staff_lookup($data) {

        $this->db->select('*');

        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');

        $this->db->where('sld.center_id', $data['center_id']);
        if ($data['subject_id'] != "all")
            $this->db->where('sls.subject_id', $data['subject_id']);
        $this->db->where('sld.approved', 1);
        $this->db->where('sls.deleted', 0);
        $this->db->group_by('staffindex');


        $staff_result_array = $this->db->get('sta_lecturer_subject sls')->result_array();

        return $staff_result_array;
    }

    function load_staff_pdf($data) {

        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*');

        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');


        $this->db->where('sld.center_id', $data['center_id']);

        if ($data['subject_id'] != "all")
            $this->db->where('sls.subject_id', $data['subject_id']);
        $this->db->where('sld.approved', 1);
        $this->db->where('sls.deleted', 0);
        $this->db->group_by('staffindex');
        $this->db->order_by('subject', "asc");

        $staff_result_array = $this->db->get('sta_lecturer_subject sls')->result_array();

        return $staff_result_array;





//        $this->db->select('*, st.deleted as stu_deleted');
//        $this->db->join('edu_course de', 'de.id=st.course_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id=st.center_id');
//        if ($data['course_id'] != "all") {
//            $this->db->where('st.course_id', $data['course_id']);
//        }
//
//        if ($data['batch_id'] != "") {
//            $this->db->where('st.batch_id', $data['batch_id']);
//        }
//
//        if ($data['year_no'] != "all") {
//            $this->db->where('st.current_year', $data['year_no']);
//        }
//
//        if ($data['semester_no'] != "all") {
//            $this->db->where('st.current_semester', $data['semester_no']);
//        }
//
//        if ($ug_level == 1) {
//            if ($data['center_id'] != "all") {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else if ($ug_level == 3) {
//            if ($data['center_id'] == "all") {
//                $this->db->where_in('st.center_id', $arr);
//            } else {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else {
//            $center = $this->session->userdata('user_branch');
//
//            $this->db->where('st.center_id', $center);
//        }
//
//        $this->db->where('st.approved', 1);
//        $this->db->where('st.deleted', 0);
//        $result_array = $this->db->get('stu_reg st')->result_array();
//
//        return $result_array;
    }

    function get_all_courses_list() {
        $this->db->select('*');
        $title_new = $this->db->get('edu_course')->result_array();

        return $title_new;
    }

    function load_year_list_for_semsubject() {
        $this->db->select('MAX(no_of_year) as max_year');
        $max_year = $this->db->get('edu_year')->row_array();

        $sel_course = $this->input->post('selected_course_id');

        $this->db->select('id,MAX(no_of_year) as no_of_year');

        if ($sel_course != "all") {
            $this->db->where('course_id', $sel_course);
        }
        if (!empty($max_year) && $sel_course == "all") {
            $this->db->where('no_of_year', $max_year['max_year']);
        }

        $years = $this->db->get('edu_year')->row_array();

        return $years;
    }

    function load_semesters_list_for_semsubject() {
        $this->db->select('no_of_semester');
        $this->db->where('year_id', $this->input->post('year_id'));
        $this->db->where('year_no', $this->input->post('year_no'));
        $result = $this->db->get('edu_semester')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return NULL;
        }
    }

    function search_load_semester_sub_data($data) {

        $this->db->select('*');

        $this->db->join('mod_subject_group msg', 'msg.id = mss.subject_group_id');
        $this->db->join('edu_semester es', 'es.id = mss.semester_id');
        $this->db->join('edu_year ey', 'ey.id = es.year_id');
        $this->db->join('edu_course ec', 'ec.id = ey.course_id');
        $this->db->join('cfg_academicyears ca', 'ca.es_ac_year_id = mss.study_season_id');
        $this->db->join('edu_batch eb', 'eb.id = mss.batch_id');

        $this->db->join('mod_subject_group_subject mgs_d', 'mgs_d.subject_group_id=msg.id');
        $this->db->join('mod_subject subj', 'subj.id = mgs_d.subject_id');
        //$this->db->where('ey.course_id', $data['course_id']);

        $this->db->where('ey.course_id', $data['course_id']);
        $this->db->where('subj.deleted', 0);

        if ($data['year_no'] != "all")
            $this->db->where('year_no', $data['year_no']);

        if ($data['semester_no'] != "all")
            $this->db->where('semester_no', $data['semester_no']);
        //$this->db->group_by('subj.code');
        $search_semsub_array = $this->db->get('mod_semester_subject mss')->result_array();

        return $search_semsub_array;

        //$this->db->select('*,sc.deleted as y_c_deleted, sc.id as se_subject_id');
        //$this->db->join('mod_subject_group cg', 'cg.id=sc.subject_group_id');
        //$this->db->join('edu_semester se', 'se.id=sc.semester_id');
        //$this->db->join('edu_year yr', 'yr.id=se.year_id');
        //$this->db->join('edu_course de', 'de.id=yr.course_id');
        //$this->db->join('cfg_academicyears ac', 'ac.es_ac_year_id=sc.study_season_id');
        //$this->db->join('edu_batch ba', 'ba.id=sc.batch_id');
        //$result_array = $this->db->get('mod_semester_subject sc')->result_array();
        //return $result_array;
    }

    function load_sem_subject_pdf($data) {

        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*');

        $this->db->join('mod_subject_group msg', 'msg.id = mss.subject_group_id');
        $this->db->join('edu_semester es', 'es.id = mss.semester_id');
        $this->db->join('edu_year ey', 'ey.id = es.year_id');
        $this->db->join('edu_course ec', 'ec.id=ey.course_id');
        $this->db->join('cfg_academicyears ca', 'ca.es_ac_year_id=mss.study_season_id');
        $this->db->join('edu_batch eb', 'eb.id=mss.batch_id');


        $this->db->join('mod_subject_group_subject mgs_d', 'mgs_d.subject_group_id=msg.id');
        $this->db->join('mod_subject subj', 'subj.id=mgs_d.subject_id');
        $this->db->where('ey.course_id', $data['course_id']);

        if ($data['year_no'] != "all")
            $this->db->where('year_no', $data['year_no']);

        if ($data['semester_no'] != "all")
            $this->db->where('semester_no', $data['semester_no']);

        $search_semsub_array = $this->db->get('mod_semester_subject mss')->result_array();

        return $search_semsub_array;

//        $this->db->select('*');
//        
//        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
//        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');
//        
//        
//        $this->db->where('sld.center_id', $data['center_id']);
//        
//        if($data['subject_id']!="all")
//        $this->db->where('sls.subject_id', $data['subject_id']);
//        $this->db->where('sld.approved', 1);
//        $this->db->where('sls.deleted', 0);
//        $this->db->group_by('staffindex'); 
        //$sem_subject_detail_array = $this->db->get('sta_lecturer_subject sls')->result_array();
        //return $sem_subject_detail_array;
//        $this->db->select('*, st.deleted as stu_deleted');
//        $this->db->join('edu_course de', 'de.id=st.course_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id=st.center_id');
//        if ($data['course_id'] != "all") {
//            $this->db->where('st.course_id', $data['course_id']);
//        }
//
//        if ($data['batch_id'] != "") {
//            $this->db->where('st.batch_id', $data['batch_id']);
//        }
//
//        if ($data['year_no'] != "all") {
//            $this->db->where('st.current_year', $data['year_no']);
//        }
//
//        if ($data['semester_no'] != "all") {
//            $this->db->where('st.current_semester', $data['semester_no']);
//        }
//
//        if ($ug_level == 1) {
//            if ($data['center_id'] != "all") {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else if ($ug_level == 3) {
//            if ($data['center_id'] == "all") {
//                $this->db->where_in('st.center_id', $arr);
//            } else {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else {
//            $center = $this->session->userdata('user_branch');
//
//            $this->db->where('st.center_id', $center);
//        }
//
//        $this->db->where('st.approved', 1);
//        $this->db->where('st.deleted', 0);
//        $result_array = $this->db->get('stu_reg st')->result_array();
//
//        return $result_array;
    }

    function search_load_semester_sub_exam_data($data) {

        $this->db->select('*');
        $this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
        $this->db->join('cfg_academicyears', 'cfg_academicyears.es_ac_year_id=tta_examtimetable.ttbl_season');
        $this->db->join('exm_exam', 'exm_exam.id=tta_examtimetable.ttbl_exam');
        $this->db->join('exm_schedule', 'exm_schedule.esch_timetable = tta_examtimetable.ttbl_id');

        $this->db->join('mod_subject', 'mod_subject.id = exm_schedule.esch_subject');
        $this->db->join('mod_marking_details', 'mod_marking_details.id = exm_schedule.esch_examtype');

        $this->db->join('exm_semester_exam', 'exm_semester_exam.exam_id = tta_examtimetable.ttbl_exam');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');

        //$this->db->join('exm_schedule', 'exm_schedule.esch_timetable = tta_examtimetable.ttbl_id');
        //$this->db->where('mod_marking_details.type_id', 1);
        $this->db->where('tta_examtimetable.approved', 1);
        $this->db->where('tta_examtimetable.ttbl_course', $data['course_id']);


        if ($data['year_no'] != "all")
            $this->db->where('tta_examtimetable.ttbl_year', $data['year_no']);

        if ($data['semester_no'] != "all")
            $this->db->where('tta_examtimetable.ttbl_semester', $data['semester_no']);

        $this->db->group_by('ttbl_id');
        $timetables = $this->db->get('tta_examtimetable')->result_array();

        $count = 0;
        foreach ($timetables as $timsubj) {
            $this->db->select('ms.*, es.*');

            $this->db->join('exm_schedule es', 'es.esch_timetable = tt.ttbl_id');
            $this->db->join('mod_subject ms', 'ms.id = es.esch_subject');

            $this->db->where('tt.ttbl_id', $timsubj['ttbl_id']);

            $this->db->group_by('ms.id');
            $timetables[$count]['subjects'] = $this->db->get('tta_examtimetable tt')->result_array();
            $count++;
        }
//        echo '<pre>';
//        print_r($timetables);
        return $timetables;
    }

    function load_sem_subject_exam_pdf($data) {


        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*');
        $this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
        $this->db->join('cfg_academicyears', 'cfg_academicyears.es_ac_year_id=tta_examtimetable.ttbl_season');
        $this->db->join('exm_exam', 'exm_exam.id=tta_examtimetable.ttbl_exam');
        $this->db->join('exm_schedule', 'exm_schedule.esch_timetable = tta_examtimetable.ttbl_id');

        $this->db->join('mod_subject', 'mod_subject.id = exm_schedule.esch_subject');
        $this->db->join('mod_marking_details', 'mod_marking_details.id = exm_schedule.esch_examtype');

        $this->db->join('exm_semester_exam', 'exm_semester_exam.exam_id = tta_examtimetable.ttbl_exam');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');

        //$this->db->where('mod_marking_details.type_id', 1);
        $this->db->where('tta_examtimetable.approved', 1);
        $this->db->where('tta_examtimetable.ttbl_course', $data['course_id']);


        if ($data['year_no'] != "all")
            $this->db->where('tta_examtimetable.ttbl_year', $data['year_no']);

        if ($data['semester_no'] != "all")
            $this->db->where('tta_examtimetable.ttbl_semester', $data['semester_no']);

        $this->db->group_by('ttbl_id');
        $timetables = $this->db->get('tta_examtimetable')->result_array();


        $count = 0;
        foreach ($timetables as $timsubj) {
            $this->db->select('ms.*, es.*');

            $this->db->join('exm_schedule es', 'es.esch_timetable = tt.ttbl_id');
            $this->db->join('mod_subject ms', 'ms.id = es.esch_subject');

            $this->db->where('tt.ttbl_id', $timsubj['ttbl_id']);

            $this->db->group_by('ms.id');
            $timetables[$count]['subjects'] = $this->db->get('tta_examtimetable tt')->result_array();
            $count++;
        }

        return $timetables;

//        $this->db->select('*');
//        
//        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
//        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');
//        
//        
//        $this->db->where('sld.center_id', $data['center_id']);
//        
//        if($data['subject_id']!="all")
//        $this->db->where('sls.subject_id', $data['subject_id']);
//        $this->db->where('sld.approved', 1);
//        $this->db->where('sls.deleted', 0);
//        $this->db->group_by('staffindex'); 
        //$sem_subject_detail_array = $this->db->get('sta_lecturer_subject sls')->result_array();
        //return $sem_subject_detail_array;
//        $this->db->select('*, st.deleted as stu_deleted');
//        $this->db->join('edu_course de', 'de.id=st.course_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id=st.center_id');
//        if ($data['course_id'] != "all") {
//            $this->db->where('st.course_id', $data['course_id']);
//        }
//
//        if ($data['batch_id'] != "") {
//            $this->db->where('st.batch_id', $data['batch_id']);
//        }
//
//        if ($data['year_no'] != "all") {
//            $this->db->where('st.current_year', $data['year_no']);
//        }
//
//        if ($data['semester_no'] != "all") {
//            $this->db->where('st.current_semester', $data['semester_no']);
//        }
//
//        if ($ug_level == 1) {
//            if ($data['center_id'] != "all") {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else if ($ug_level == 3) {
//            if ($data['center_id'] == "all") {
//                $this->db->where_in('st.center_id', $arr);
//            } else {
//                $this->db->where('st.center_id', $data['center_id']);
//            }
//        } else {
//            $center = $this->session->userdata('user_branch');
//
//            $this->db->where('st.center_id', $center);
//        }
//
//        $this->db->where('st.approved', 1);
//        $this->db->where('st.deleted', 0);
//        $result_array = $this->db->get('stu_reg st')->result_array();
//
//        return $result_array;
    }

    function search_students_semester_subject($data) {
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
        $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
        $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_batch eb', 'eb.id = ss.batch_id');
        $this->db->join('edu_course ec', 'ec.id = ss.course_id');

        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ss.course_id', $data['course_id']);
        //if ($data['batch_id'] != "all")
        $this->db->where('ss.batch_id', $data['batch_id']);
        //if ($data['year_no'] != "all")
        $this->db->where('ss.year_no', $data['year_no']);
        //if ($data['semester_no'] != "all")
        $this->db->where('ss.semester_no', $data['semester_no']);
        $this->db->where('ss.is_approved', 1);
        $this->db->group_by('ss.student_id');


        $timetables = $this->db->get('stu_subject ss')->result_array();

        $count = 0;
        foreach ($timetables as $rw) {
            $this->db->select('*');
            $this->db->where('ss.student_id', $rw['stu_id']);
            $this->db->where('sfs.deleted', 0);
            $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
            $this->db->order_by('ms.id');
            $timetables[$count]['subjects'] = $this->db->get('stu_subject ss')->result_array();
            $count++;
        }

        return $timetables;
    }

    function print_students_semester_subject($data) {
        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
        $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
        $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_batch eb', 'eb.id = ss.batch_id');
        $this->db->join('edu_course ec', 'ec.id = ss.course_id');


        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ss.course_id', $data['course_id']);
        //if ($data['batch_id'] != "all")
        $this->db->where('ss.batch_id', $data['batch_id']);
        //if ($data['year_no'] != "all")
        $this->db->where('ss.year_no', $data['year_no']);
        //if ($data['semester_no'] != "all")
        $this->db->where('ss.semester_no', $data['semester_no']);
        $this->db->group_by('ss.student_id');


        $timetables = $this->db->get('stu_subject ss')->result_array();

        $count = 0;
        foreach ($timetables as $rw) {
            $this->db->select('*');
            $this->db->where('ss.student_id', $rw['stu_id']);
            $this->db->where('sfs.deleted', 0);
            $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');

            $timetables[$count]['subjects'] = $this->db->get('stu_subject ss')->result_array();
            $count++;
        }

        return $timetables;
    }

    function load_student_subjectwise($id, $exam_id, $center_id) {
        //exm_semester_exam_details.*,stu_reg.admission_no,stu_reg.first_name,stu_reg.last_name
        $this->db->select('*');
        $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
        $this->db->join('exm_semester_exam', 'exm_semester_exam.id = exm_semester_exam_details.semester_exam_id');

        $this->db->where('center_id', $center_id);
        $this->db->where('subject_id', $id);
        $this->db->where('exm_semester_exam.exam_id', $exam_id);
        $this->db->where('exm_semester_exam_details.is_approved', 2);
        //JOIN `exm_semester_exam` ON `exm_semester_exam`.`id` = `exm_semester_exam_details`.semester_exam_id
//        $this->db->where('is_attend', 0);
        // $this->db->where('subject_id',$subject);
        $stulist = $this->db->get('exm_semester_exam_details')->result_array();

        return $stulist;
    }

    function print_exam_attendees($data) {
        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        $this->db->select('*');
        $this->db->join('stu_reg', 'stu_reg.stu_id=exm_semester_exam_details.student_id');
        $this->db->join('exm_semester_exam', 'exm_semester_exam.id = exm_semester_exam_details.semester_exam_id');
        $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details.subject_id');
        $this->db->join('exm_exam', 'exm_semester_exam.exam_id = exm_exam.id');
        $this->db->join('exm_schedule', 'exm_schedule.esch_subject = mod_subject.id');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');
        //$this->db->join('exm_schedule','exm_schedule.esch_timetable = tta_examtimetable.ttbl_id');

        $this->db->where('center_id', $data['center_id']);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('exm_semester_exam.exam_id', $data['exam_id']);
        //$this->db->where('exm_semester_exam_details.is_approved',2);
        //JOIN `exm_semester_exam` ON `exm_semester_exam`.`id` = `exm_semester_exam_details`.semester_exam_id
        $this->db->where('is_attend', 0);
        // $this->db->where('subject_id',$subject);
        $stulist = $this->db->get('exm_semester_exam_details')->result_array();

        return $stulist;
    }

//    function eaas_load_exams()
//    {
//        $tt_course = $this->input->post('tt_course');
//        $tt_year = $this->input->post('tt_year');
//        $tt_semester = $this->input->post('tt_semester');
//        $tt_season = $this->input->post('tt_season');
//
//        $this->db->select('exm_exam.*');
//        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
//        if (!empty($tt_season)) {
//            $this->db->where('exm_semester_exam.study_season_id', $tt_season);
//        }
//        if (!empty($tt_semester)) {
//            $this->db->where('exm_semester_exam.semester_no', $tt_semester);
//        }
//        $this->db->where('exm_semester_exam.year_no', $tt_year);
//        $this->db->where('exm_semester_exam.course_id', $tt_course);
//        $this->db->where('exm_semester_exam.is_approved', 1);
//        
//        $exams = $this->db->get('exm_semester_exam')->result_array();
//
//        return $exams;
//    }





    function search_exam_attendended_students_data($data) {
        if ($data['student_status'] == 1) {
            $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order');

            $this->db->join('exm_semester_exam_details', 'exm_semester_exam_details.semester_exam_id = exm_semester_exam.id');
            $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
            $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details.subject_id');

            //$this->db->where('study_season_id', $data['study_season_id']);
            $this->db->where('stu_reg.center_id', $data['center_id']);
            $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
            $this->db->where('exm_semester_exam.course_id', $data['course_id']);
            $this->db->where('exm_semester_exam.year_no', $data['year_no']);
            $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
            $this->db->where('exm_semester_exam.exam_id', $data['exam_id']);

            $this->db->where('exm_semester_exam_details.is_attend', 1);


            $this->db->group_by('exm_semester_exam_details.student_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
            //$this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');

            $timetables = $this->db->get('exm_semester_exam')->result_array();

            $count = 0;
            foreach ($timetables as $rw) {
                $this->db->select('*');
                $this->db->join('exm_semester_exam ese', 'esed.semester_exam_id = ese.id');
                $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
                $this->db->where('esed.student_id', $rw['student_id']);
                $this->db->where('esed.is_attend', 1);
                $this->db->where('ese.exam_id', $data['exam_id']);
                $this->db->where('ms.deleted', 0);
                $this->db->where('esed.is_attend', 1);

                $timetables[$count]['subjectsatt'] = $this->db->get('exm_semester_exam_details esed')->result_array();
                $count++;
            }
        } else {
            $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order');

            $this->db->join('exm_semester_exam_details_repeat', 'exm_semester_exam_details_repeat.semester_exam_id = exm_semester_exam.exam_id');
            $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details_repeat.stu_id');
            $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details_repeat.subject_id');

            //$this->db->where('study_season_id', $data['study_season_id']);
            $this->db->where('stu_reg.center_id', $data['center_id']);
            $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
            $this->db->where('exm_semester_exam.course_id', $data['course_id']);
            $this->db->where('exm_semester_exam.year_no', $data['year_no']);
            $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
            $this->db->where('exm_semester_exam.exam_id', $data['exam_id']);

            $this->db->where('exm_semester_exam_details_repeat.is_attend', 1);


            $this->db->group_by('exm_semester_exam_details_repeat.stu_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
            //$this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');

            $timetables = $this->db->get('exm_semester_exam')->result_array();

            $count = 0;
            foreach ($timetables as $rw) {
                $this->db->select('*');
                $this->db->join('exm_semester_exam ese', 'esedr.semester_exam_id = ese.exam_id');
                $this->db->join('exm_semester_exam_details exmd', 'exmd.id = esedr.exm_semester_exam_details');
                $this->db->join('mod_subject ms', 'ms.id = esedr.subject_id');
                $this->db->where('esedr.stu_id', $rw['stu_id']);
                $this->db->where('esedr.is_attend', 1);
                $this->db->where('ese.exam_id', $data['exam_id']);
                $this->db->where('ms.deleted', 0);
                $this->db->where('esedr.is_attend', 1);

                $timetables[$count]['subjectsatt'] = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();
                $count++;
            }
        }
        return $timetables;
    }

    function print_search_exam_attendended_students_data($data) {

        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }

        if ($data['student_status'] == 1) {
            $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order');

            $this->db->join('exm_semester_exam_details', 'exm_semester_exam_details.semester_exam_id = exm_semester_exam.id');
            $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
            $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details.subject_id');
            $this->db->join('edu_course', 'edu_course.id = exm_semester_exam.course_id');
            $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');

            $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
            $this->db->where('stu_reg.center_id', $data['center_id']);
            $this->db->where('exm_semester_exam.course_id', $data['course_id']);
            $this->db->where('exm_semester_exam.year_no', $data['year_no']);
            $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
            $this->db->where('exm_semester_exam.exam_id', $data['exam_id']);

            $this->db->where('exm_semester_exam_details.is_attend', 1);
            $this->db->group_by('exm_semester_exam_details.student_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

            $timetables = $this->db->get('exm_semester_exam')->result_array();

            $count = 0;
            foreach ($timetables as $rw) {

                $this->db->select('*');
                $this->db->join('exm_semester_exam ese', 'esed.semester_exam_id = ese.id');
                $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
                $this->db->where('esed.student_id', $rw['student_id']);
                $this->db->where('esed.is_attend', 1);
                $this->db->where('ese.exam_id', $data['exam_id']);
                $this->db->where('ms.deleted', 0);
                $this->db->where('esed.is_attend', 1);

                $timetables[$count]['subjectsatt'] = $this->db->get('exm_semester_exam_details esed')->result_array();
                $count++;
            }
        } else {
            $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order');

            $this->db->join('exm_semester_exam_details_repeat', 'exm_semester_exam_details_repeat.semester_exam_id = exm_semester_exam.exam_id');
            $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details_repeat.stu_id');
            $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details_repeat.subject_id');
            $this->db->join('edu_course', 'edu_course.id = exm_semester_exam.course_id');
            $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');

            //$this->db->where('study_season_id', $data['study_season_id']);
            $this->db->where('stu_reg.center_id', $data['center_id']);
            $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
            $this->db->where('exm_semester_exam.course_id', $data['course_id']);
            $this->db->where('exm_semester_exam.year_no', $data['year_no']);
            $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
            $this->db->where('exm_semester_exam.exam_id', $data['exam_id']);

            $this->db->where('exm_semester_exam_details_repeat.is_attend', 1);


            $this->db->group_by('exm_semester_exam_details_repeat.stu_id');
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
            //$this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');

            $timetables = $this->db->get('exm_semester_exam')->result_array();

            $count = 0;
            foreach ($timetables as $rw) {
                $this->db->select('*');
                $this->db->join('exm_semester_exam ese', 'esedr.semester_exam_id = ese.exam_id');
                $this->db->join('exm_semester_exam_details exmd', 'exmd.id = esedr.exm_semester_exam_details');
                $this->db->join('mod_subject ms', 'ms.id = esedr.subject_id');
                $this->db->where('esedr.stu_id', $rw['stu_id']);
                $this->db->where('esedr.is_attend', 1);
                $this->db->where('ese.exam_id', $data['exam_id']);
                $this->db->where('ms.deleted', 0);
                $this->db->where('esedr.is_attend', 1);

                $timetables[$count]['subjectsatt'] = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();
                $count++;
            }
        }


        //$this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
//        $timetables = $this->db->get('exm_semester_exam')->result_array();

        return $timetables;
    }

    function get_ay_info() {
        $this->db->select('*');
        $range_res = $this->db->get('cfg_academicyears')->result_array();

        return $range_res;
    }

    function load_exams() {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_batch = $this->input->post('tt_batch');

        $this->db->select('exm_exam.*,exm_semester_exam.id as sem_exm_id');
        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
        // if (!empty($tt_season)) {
        //    $this->db->where('exm_semester_exam.study_season_id', $tt_season);
        // }
        if (!empty($tt_semester)) {
            $this->db->where('exm_semester_exam.semester_no', $tt_semester);
        }
        $this->db->where('exm_semester_exam.batch_id', $tt_batch);
        $this->db->where('exm_semester_exam.year_no', $tt_year);
        $this->db->where('exm_semester_exam.course_id', $tt_course);
        $this->db->where('exm_semester_exam.is_approved', 1);

        $exams = $this->db->get('exm_semester_exam')->result_array();

        return $exams;
    }

    function load_years() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        return $years['no_of_year'];
    }

    function load_semester() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        $this->db->where('year_id', $years['id']);
        $this->db->where('year_no', $this->input->post('tt_year'));
        $this->db->where('deleted', 0);
        $semester = $this->db->get('edu_semester')->row_array();

        return $semester['no_of_semester'];
    }

    function load_students_who_applied_for_exams($data) {

        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);

        if ($data['subject_id'] != "all") {
            $this->db->where('esed.subject_id', $data['subject_id']);
        }
        if ($data['east_type'] != '1') {
            if ($data['east_type'] == '2') {
                $this->db->where('esed.is_approved', 2);
            } else {
                $this->db->where('(esed.is_approved = 3 OR esed.is_approved = 4)');
//                $this->db->or_where('esed.is_approved',4);
            }
        }

        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
    }

    function load_exam_subjects() {
        //'tt_course_id': eh_course, 
        //'tt_year_no': eh_year, 
//        'tt_semester_no': eh_semester, 
        //'tt_exam_id': eh_exam,
        //'tt_study_season_id': eh_season,
        //'tt_center_id': eh_branch},

        $tt_batch_id = $this->input->post('tt_batch_id');
        $tt_center_id = $this->input->post('tt_center_id');
        $tt_course_id = $this->input->post('tt_course_id');
        $tt_year_no = $this->input->post('tt_year_no');
        $tt_semester_no = $this->input->post('tt_semester_no');
        $tt_exam_id = $this->input->post('tt_exam_id');

        $this->db->select('*');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('exm_schedule es', 'es.esch_subject = ms.id');

        $this->db->where('ese.batch_id', $tt_batch_id);
        $this->db->where('sr.center_id', $tt_center_id);
        $this->db->where('ese.course_id', $tt_course_id);
        $this->db->where('ese.year_no', $tt_year_no);
        $this->db->where('ese.semester_no', $tt_semester_no);
        $this->db->where('ese.exam_id', $tt_exam_id);

        $this->db->group_by('ms.code');

        $exams = $this->db->get('exm_semester_exam_details esed')->result_array();

        return $exams;
    }

    function dummy_load_students_who_applied_for_exams($data) {

        $this->db->select('*');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('ese.study_season_id', $data['study_season_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
//        $this->db->where('esed.subject_id', $data['subject_id']);

        $this->db->where('esed.is_approved', 2);
        $this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

        $count = 0;
        foreach ($timetables as $rw) {
            $this->db->select('*');
            $this->db->where('ss.subject_id', $rw['subject_id']);
            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
            //$this->db->where('sfs.deleted', 0);
            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
            $count++;
        }

        return $timetables;
    }

    function print_dummy_load_students_who_applied_for_exams($data) {///////////Won't Function//////////////
        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);

        if ($data['subject_id'] != "all") {
            $this->db->where('esed.subject_id', $data['subject_id']);
        }
        if ($data['east_type'] != '1') {
            if ($data['east_type'] == '2') {
                $this->db->where('esed.is_approved', 2);
            } else {
                $this->db->where('(esed.is_approved = 3 OR esed.is_approved = 4)');
//                $this->db->or_where('esed.is_approved',4);
            }
        }

        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
    }

    function search_students_exam_marks($data) {
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
        $this->db->join('edu_course ec', 'ec.id = em.course_id');
        $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
//        $this->db->join('edu_batch eb', 'eb.id = ss.batch_id');
//        $this->db->join('edu_course ec', 'ec.id = ss.course_id');

        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('em.course_id', $data['course_id']);

        $this->db->where('em.batch_id', $data['batch_id']);

        $this->db->where('em.year_no', $data['year_no']);
        //if ($data['semester_no'] != "all")
        $this->db->where('em.semester_no', $data['semester_no']);
        $this->db->group_by('sr.reg_no');


        $timetables = $this->db->get('exm_mark em')->result_array();

        $count = 0;
        foreach ($timetables as $rw) {
            $this->db->select('*');
            $this->db->where('ss.student_id', $rw['stu_id']);
//            $this->db->where('sfs.deleted', 0);
//            $this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            $this->db->join('mod_subject ms', 'ms.id = ss.subject_id');
            $timetables[$count]['subjects'] = $this->db->get('exm_mark ss')->result_array();
            $count++;
        }

        return $timetables;
    }

    function semester_subjects_by_semester($data) {

        //$user_id = $this->session->userdata('u_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $sem_subjects_code = [];

        $this->db->select('*');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        $this->db->where('yr.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
        $this->db->where('sc.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();

        if (count($result_array) > 0) {
            foreach ($result_array as $subject) {
                $sem_subjects[] = $subject['subject_id'];
                $sem_subjects_code[] = array('subject_id' => $subject['subject_id'], 'code' => $subject['code'], 'subject' => $subject['subject']);
            }
        }

        if ($this->session->userdata('user_ref_id') != null) {
            if ($ug_level == '4') {
                //             $this->db->select('sta_lecturer_subject.subject_id,mod_subject.code');
                //             $this->db->join('mod_subject', 'mod_subject.id = sta_lecturer_subject.subject_id');
                //             $this->db->where_in('sta_lecturer_subject.subject_id', $sem_subjects);
                //             $this->db->where('lecturer_id', $this->session->userdata('user_ref_id'));
                //
    //             $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject')->result_array();

                $this->db->select('sls.subject_id,msb.code,msb.subject');
                $this->db->join('mod_subject msb', 'msb.id = sls.subject_id');
                $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
                $this->db->where_in('sls.subject_id', $sem_subjects);
                $this->db->where('sld.stf_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sls.deleted', 0);
                $this->db->order_by('msb.id', 'ASC');

                $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject sls')->result_array();
            } else {
                $this->db->select('sfs.subject_id,ms.code,ms.subject');
                $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
                $this->db->join('stu_subject sts', 'sts.id = sfs.student_subject_id');
                $this->db->where_in('sfs.subject_id', $sem_subjects);
                $this->db->where('sts.student_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sfs.deleted', 0);
                $this->db->order_by('ms.id', 'ASC');

                $result_array[]['lecturer_subject'] = $this->db->get('stu_follow_subject sfs')->result_array();
            }
        } else {
            if ($ug_level == '1' || $ug_level == '2' || $ug_level == '3') {
                $result_array[]['lecturer_subject'] = $sem_subjects_code;
            } else {
                $result_array[]['lecturer_subject'] = null;
            }
        }
        return $result_array;
    }

    function load_student_for_exam_marks_ca($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('ese.release_result', 1);
        $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            $this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            $this->db->where('se.release_result', 1);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);
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
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;



        //-------------------------------------
//        $this->db->select('*');
//
//        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
//        $this->db->join('edu_course ec', 'ec.id = em.course_id');
//        $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
////        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
////        $this->db->join('edu_batch eb', 'eb.id = ss.batch_id');
////        $this->db->join('edu_course ec', 'ec.id = ss.course_id');
//
//        $this->db->where('sr.center_id', $data['center_id']);
//        $this->db->where('em.course_id', $data['course_id']);
//
//        $this->db->where('em.batch_id', $data['batch_id']);
//
//        $this->db->where('em.year_no', $data['year_no']);
//        //if ($data['semester_no'] != "all")
//        $this->db->where('em.semester_no', $data['semester_no']);
//        $this->db->group_by('sr.reg_no');
//
//
//        $result_array = $this->db->get('exm_mark em')->result_array();
//
//
//        for ($i = 0; $i < count($result_array); $i++) {
//            $this->db->select('*, co.type as subject_type, co.code as subject_code');
//            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
//            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('se.batch_id', $data['batch_id']);
//            $this->db->where('se.year_no', $data['year_no']);
//            $this->db->where('se.semester_no', $data['semester_no']);
//            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('se.deleted', 0);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//           $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'],$data['year_no'],$data['semester_no'] ); 
//
//            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,
//em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            $this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            //$this->db->where('em.is_hod_mark_aproved', 0);
//            //$this->db->where('em.is_director_mark_approved', 0);
//            //$this->db->where('em.is_ex_director_mark_approved', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//        }
////        print_r($result_array);
//        return $result_array;
    }

    function load_student_for_p_note($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, "/", 3), "/", -1) as reg_year, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        //$this->db->where('ese.release_result', 1);
        //$this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            //$this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            //$this->db->where('se.release_result', 1);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);
//            $result_array[$i]['overall_gpa'] = $this->get_student_gpa_value_show($data['overall_gpa']); 
            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }

    function load_repeat_student_for_p_note($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, "/", 3), "/", -1) as reg_year, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details_repeat esed', 'esed.semester_exam_id = ese.exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('exm_semester_exam_details esedd', 'esedd.id = esed.exm_semester_exam_details');
        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        // $this->db->where('ese.is_repeat_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        //$this->db->where('ese.release_result', 1);
        //$this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.stu_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.stu_id');
        $this->db->order_by('CAST(reg_year as SIGNED INTEGER)', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details_repeat sed', 'se.exam_id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->join('exm_semester_exam_details eseddd', 'eseddd.id = sed.exm_semester_exam_details');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.stu_id', $result_array[$i]['stu_id']);
            //$this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            $this->db->where('sed.deleted', 0);
            //$this->db->where('se.release_result', 1);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);
//            $result_array[$i]['overall_gpa'] = $this->get_student_gpa_value_show($data['overall_gpa']); 
            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }

    function print_load_student_data_for_p_note($data) {
        // $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, "/", 3), "/", -1) as reg_year ,sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
//        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        //$this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, sed.is_approved as exm_sub_approved,co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            //$this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);

            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }

    function print_repeat_load_student_data_for_p_note($data) {
        // $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, SUBSTRING_INDEX(SUBSTRING_INDEX(sr.reg_no, "/", 3), "/", -1) as reg_year, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details_repeat esed', 'esed.semester_exam_id = ese.exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('ese.is_approved', 1);
//        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        //$this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.stu_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.stu_id');
        $this->db->order_by('CAST(reg_year as SIGNED INTEGER)', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, sed.is_repeat_approved as exm_sub_approved,co.type as subject_type, co.code as subject_code');
            $this->db->join('exm_semester_exam_details_repeat sed', 'se.exam_id = sed.semester_exam_id');
            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('sed.stu_id', $result_array[$i]['stu_id']);
            //$this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $this->db->where('se.deleted', 0);
            $this->db->where('sed.deleted', 0);
            //$this->db->where('sed.is_approved', 1);

            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }

    function get_student_gpa_value($student_id, $year_no, $semester_no) {
        $this->db->select('*');
        $this->db->where('stu_id', $student_id);
        $this->db->where('year', $year_no);
        $this->db->where('semester', $semester_no);

        $stu_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();
        return $stu_gpa['gpa'];
    }

    function print_load_student_data($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('ed.regno_order, ed.stu_id,ed.reg_no,ed.admission_no,ed.first_name,ed.last_name');
        $this->db->where('ed.course_id', $data['course_id']);
        $this->db->where('ed.exam_id', $data['exam_id']);
        $this->db->where('ed.year_no', $data['year_no']);
        $this->db->where('ed.semester_no', $data['semester_no']);
        $this->db->where('ed.center_id', $data['center_id']);
        $this->db->where('ed.batch_id', $data['batch_id']);
        $this->db->where('EXISTS(select student_id from exm_mark where student_id = ed.student_id and subject_id = ed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('ed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('ed.student_id');
        $this->db->order_by('CAST(ed.regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exam_student_details_view ed')->result_array();


        for ($i = 0; $i < count($result_array); $i++) {
            //$this->db->select('*');
            $this->db->select('es.subject_type, es.subject_code, es.is_approved, es.is_repeat,es.is_absent,es.is_absent_approve,es.absent_deferement');
            $this->db->where('es.course_id', $data['course_id']);
            $this->db->where('es.batch_id', $data['batch_id']);
            $this->db->where('es.year_no', $data['year_no']);
            $this->db->where('es.semester_no', $data['semester_no']);
            $this->db->where('es.exam_id', $data['exam_id']);
            $this->db->where('es.student_id', $result_array[$i]['stu_id']);
            $this->db->where('EXISTS(select student_id from exm_mark where student_id = es.student_id and subject_id = es.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $result_array[$i]['applied_subjects'] = $this->db->get('exam_applied_subjects_of_student_view es')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);

             //get fraud status
             $this->db->select('count(stu_id) as fraud_status');
             $this->db->where('course_id', $data['course_id']);
             $this->db->where('batch_id', $data['batch_id']);
             $this->db->where('year_no', $data['year_no']);
             $this->db->where('semester_no', $data['semester_no']);
             $this->db->where('sem_exam_id', $data['exam_id']);
             $this->db->where('stu_id', $result_array[$i]['stu_id']);
             $fraudStatus=$this->db->get('exam_fraud_students ')->result_array();
             $result_array[$i]['fraud_status']=$fraudStatus[0]['fraud_status'];

            //$this->db->select('*');
            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,'
                    . 'em.is_hod_mark_aproved,em.is_director_mark_approved,em.deleted,em.exam_status,'
                    . 'em.subject_code,em.mark,em.persentage,em.exam_type_id,'
                    . 'em.detail_is_director_mark_approved,'
                    . 'em.detail_is_hod_mark_aproved,em.detail_deleted,'
                    . 'em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.is_ex_director_mark_approved,em.release_result');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $result_array[$i]['exam_mark'] = $this->db->get('exam_applied_sudents_marks_view em')->result_array();
        }
        return $result_array;
    }

    //This code is from bavithran.. Comment it out since cannot understand...
    /* function print_load_student_data($data) {
      $z = 0;
      $access_level = $this->Util_model->check_access_level();
      $ug_level = $access_level[0]['ug_level'];

      if ($ug_level == 3) {
      $loginuser_group = $this->session->userdata('u_ugroup');

      $this->db->select('*');
      $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
      $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
      $this->db->where('ag.rlist_usergroup', $loginuser_group);
      $user_centers = $this->db->get('cfg_branch cb')->result_array();

      foreach ($user_centers as $value) {
      $arr[$z] = $value['br_id'];
      $z++;
      }
      }


      $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
      $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
      $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
      //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
      // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');

      $this->db->where('ese.exam_id', $data['exam_id']);
      $this->db->where('ese.course_id', $data['course_id']);
      $this->db->where('ese.year_no', $data['year_no']);
      $this->db->where('ese.semester_no', $data['semester_no']);
      $this->db->where('sr.center_id', $data['center_id']);
      $this->db->where('ese.batch_id', $data['batch_id']);
      $this->db->where('ese.deleted', 0);
      //$this->db->where('ese.is_approved', 1);
      $this->db->where('sr.deleted', 0);
      $this->db->where('sr.approved', 1);
      $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
      $this->db->group_by('student_id');
      $result_array = $this->db->get('exm_semester_exam ese')->result_array();

      for ($i = 0; $i < count($result_array); $i++) {
      $this->db->select('*, co.type as subject_type, co.code as subject_code');
      $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
      $this->db->join('mod_subject co', 'co.id = sed.subject_id');
      $this->db->where('se.course_id', $data['course_id']);
      $this->db->where('se.batch_id', $data['batch_id']);
      $this->db->where('se.year_no', $data['year_no']);
      $this->db->where('se.semester_no', $data['semester_no']);
      $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
      $this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
      $this->db->where('se.deleted', 0);
      //$this->db->where('sed.is_approved', 1);
      $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
      $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'],$data['year_no'],$data['semester_no'] );

      // $this->db->select('*,co.code as subject_code');
      $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,
      em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
      ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted');
      $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
      $this->db->join('mod_subject co', 'co.id = em.subject_id');
      $this->db->where('em.course_id', $data['course_id']);
      $this->db->where('em.batch_id', $data['batch_id']);
      $this->db->where('em.year_no', $data['year_no']);
      $this->db->where('em.semester_no', $data['semester_no']);
      $this->db->where('em.student_id', $result_array[$i]['stu_id']);
      $this->db->where('em.deleted', 0);
      $this->db->where('ed.deleted', 0);
      $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
      }
      return $result_array;

      } */

//    function print_load_student_data($data) {
//       // $z = 0;
//        $access_level = $this->Util_model->check_access_level();
//        $ug_level = $access_level[0]['ug_level'];
//
////        if ($ug_level == 3) {
////            $loginuser_group = $this->session->userdata('u_ugroup');
////
////            $this->db->select('*');
////            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
////            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
////            $this->db->where('ag.rlist_usergroup', $loginuser_group);
////            $user_centers = $this->db->get('cfg_branch cb')->result_array();
////
////            foreach ($user_centers as $value) {
////                $arr[$z] = $value['br_id'];
////                $z++;
////            }
////        }
//        
//        
//        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
//        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
//        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
//        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
//       // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');
//
//        $this->db->where('ese.exam_id', $data['exam_id']);
//        $this->db->where('ese.course_id', $data['course_id']);
//        $this->db->where('ese.year_no', $data['year_no']);
//        $this->db->where('ese.semester_no', $data['semester_no']);
//        $this->db->where('sr.center_id', $data['center_id']);
//        $this->db->where('ese.batch_id', $data['batch_id']);
//        $this->db->where('ese.deleted', 0);
//        $this->db->where('ese.is_approved', 1);
//        $this->db->where('sr.deleted', 0);
//        $this->db->where('sr.approved', 1);
//        $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
//        if($ug_level == 5){
//            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
//        }
//        $this->db->group_by('esed.student_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
//        $result_array = $this->db->get('exm_semester_exam ese')->result_array();
//
//        for ($i = 0; $i < count($result_array); $i++) {
//            $this->db->select('*, co.type as subject_type, co.code as subject_code');
//            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
//            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('se.batch_id', $data['batch_id']);
//            $this->db->where('se.year_no', $data['year_no']);
//            $this->db->where('se.semester_no', $data['semester_no']);
//            $this->db->where('se.exam_id', $data['exam_id']);
//            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
//            $this->db->where('se.deleted', 0);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'],$data['year_no'],$data['semester_no'] ); 
//
//            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,'
//                    . 'em.is_hod_mark_aproved,em.is_director_mark_approved,em.deleted,em.exam_status,'
//                    . 'co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,'
//                    . 'ed.is_director_mark_approved AS detail_is_director_mark_approved,'
//                    . 'ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,'
//                    . 'em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.is_ex_director_mark_approved,es.release_result');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//        }
////        print_r($result_array);
//        return $result_array;
//        
//        
//        
////        $this->db->select('*');
////
////        $this->db->join('stu_reg sr', 'sr.stu_id = em.student_id');
////        $this->db->join('edu_course ec', 'ec.id = em.course_id');
////        $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
//////        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
//////        $this->db->join('edu_batch eb', 'eb.id = ss.batch_id');
//////        $this->db->join('edu_course ec', 'ec.id = ss.course_id');
////
////        $this->db->where('sr.center_id', $data['center_id']);
////        $this->db->where('em.course_id', $data['course_id']);
////
////        $this->db->where('em.batch_id', $data['batch_id']);
////
////        $this->db->where('em.year_no', $data['year_no']);
////        //if ($data['semester_no'] != "all")
////        $this->db->where('em.semester_no', $data['semester_no']);
////        $this->db->group_by('sr.reg_no');
////
////
////        $result_array = $this->db->get('exm_mark em')->result_array();
////
////
////        for ($i = 0; $i < count($result_array); $i++) {
////            $this->db->select('*, co.type as subject_type, co.code as subject_code');
////            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
////            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
////            $this->db->where('se.course_id', $data['course_id']);
////            $this->db->where('se.batch_id', $data['batch_id']);
////            $this->db->where('se.year_no', $data['year_no']);
////            $this->db->where('se.semester_no', $data['semester_no']);
////            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
////            $this->db->where('se.deleted', 0);
////            //$this->db->where('sed.is_approved', 1);
////            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
////
////            // $this->db->select('*,co.code as subject_code');
////            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,
////em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
////ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted');
////            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
////            $this->db->join('mod_subject co', 'co.id = em.subject_id');
////            $this->db->where('em.course_id', $data['course_id']);
////            $this->db->where('em.batch_id', $data['batch_id']);
////            $this->db->where('em.year_no', $data['year_no']);
////            $this->db->where('em.semester_no', $data['semester_no']);
////            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
////            $this->db->where('em.deleted', 0);
////            $this->db->where('ed.deleted', 0);
////            
////            //$this->db->where('em.is_hod_mark_aproved', 0);
////            //$this->db->where('em.is_director_mark_approved', 0);
////            //$this->db->where('em.is_ex_director_mark_approved', 0);
////            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
////        }
//////        print_r($result_array);
////        return $result_array;
//        
//    }


    function get_selected_course_name($cou_id) {
        $this->db->select("id,course_code,course_name");
        $this->db->where('id', $cou_id);
        return $this->db->get('edu_course')->row_array();
    }

    function get_selected_center_name($cen_id) {
        $this->db->select("br_id,br_code,br_name");
        $this->db->where('br_id', $cen_id);
        return $this->db->get('cfg_branch')->row_array();
    }

    function get_selected_batch_name($bat_id) {
        $this->db->select("id,batch_code");
        $this->db->where('id', $bat_id);
        return $this->db->get('edu_batch')->row_array();
    }

    function get_selected_stu_data($stu_id) {
        $this->db->select("reg_no, first_name");
        $this->db->where('stu_id', $stu_id);
        return $this->db->get('stu_reg')->row_array();
    }

    function get_result_authorities() {
        $this->db->select('*');
        //Need to be to according to commented status
        $this->db->where('type', 'RSLT');
        $this->db->where('group', 5);


//        $this->db->where('type', 'RPT');
//        $this->db->where('group', 1);
        return $this->db->get('cfg_common')->result_array();
    }

    function search_mast_students($data) {
        $this->db->select('sr.*, srm.*, ec.*');

        $this->db->join('stu_reg sr', 'sr.stu_id = srm.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');


        if ($data['all'] == 0) {
            if ($data['course_id'] != "all") {
                $this->db->where('sr.course_id', $data['course_id']);
            }
            if ($data['mp_year'] != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $data['mp_year']);
            }
            if ($data['center_id'] != "all") {
                $this->db->where('sr.center_id', $data['center_id']);
            }
        } else if ($data['all'] == 1) {
            if ($data['mp_year'] != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $data['mp_year']);
            }
        }

        $this->db->where('srm.approved', 1);

        $this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")




        $timetables = $this->db->get('stu_reg_mahapola srm')->result_array();
        return $timetables;
    }

    function print_mast_search($data) {
        $this->db->select('sr.*, srm.*, ec.*, cb.*');

        $this->db->join('stu_reg sr', 'sr.stu_id = srm.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');



        $this->db->where('sr.center_id', $data['center_id']);

        if ($data['all'] == 0) {
            if ($data['course_id'] != "all") {
                $this->db->where('sr.course_id', $data['course_id']);
            }
            if ($data['mp_year'] != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $data['mp_year']);
            }
        } else if ($data['all'] == 1) {
            if ($data['mp_year'] != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $data['mp_year']);
            }
        }

        $this->db->where('srm.approved', 1);

        $this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")




        $timetables = $this->db->get('stu_reg_mahapola srm')->result_array();
        return $timetables;
    }

    function search_diploma_eligible_students($data) {
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = stu_req.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = stu_req.center_id');
        $this->db->join('edu_batch eb', 'eb.id = stu_req.batch_id');

        $this->db->where('stu_req.center_id', $data['center_id']);
        $this->db->where('stu_req.course_id', $data['course_id']);
        $this->db->where('stu_req.batch_id', $data['batch_id']);

        $this->db->where('stu_req.request_type', 2);
        $this->db->where('stu_req.status', 1);
        //$this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")

        $timetables = $this->db->get('stu_requests stu_req')->result_array();
        return $timetables;
    }

    function print_search_diploma_eligible_students($data) {
        $z = 0;
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$z] = $value['br_id'];
                $z++;
            }
        }
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = stu_req.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = stu_req.center_id');
        $this->db->join('edu_batch eb', 'eb.id = stu_req.batch_id');
        $this->db->join('edu_course ec', 'ec.id = stu_req.course_id');

        $this->db->where('stu_req.center_id', $data['center_id']);
        $this->db->where('stu_req.course_id', $data['course_id']);
        $this->db->where('stu_req.batch_id', $data['batch_id']);

        $this->db->where('stu_req.request_type', 2);
        $this->db->where('stu_req.status', 1);

        //$this->db->where('srm.director_approved', 1);
        //if ($data['batch_id'] != "all")

        $dip_eli_stu = $this->db->get('stu_requests stu_req')->result_array();
        return $dip_eli_stu;
    }

    function load_exam_batch_list() {
        $course = $this->input->post('course_id');
        $this->db->select('id,batch_code');
        $this->db->where('course_id', $course);

        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_registar_course_list() {
        $r = 0;
        $center = $this->input->post('center_id');

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        foreach ($user_centers as $value) {
            $arr[$r] = $value['br_id'];
            $r++;
        }

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        if ($center != "all") {
            $this->db->where('ecc.center_id', $center);
        } else {
            $this->db->where_in('ecc.center_id', $arr);
        }
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_admin_course_list() {
        $center = $this->input->post('center_id');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');

        if ($center != "all") {
            $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
            $this->db->where('ecc.center_id', $center);
        }

        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_lecturer_course_list() {
        $center = $this->session->userdata('user_branch');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $center);
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_exam_apply_years() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        return $years['no_of_year'];
    }

    function load_exam_apply_semesters() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        $this->db->where('year_id', $years['id']);
        $this->db->where('year_no', $this->input->post('tt_year'));
        $this->db->where('deleted', 0);
        $semester = $this->db->get('edu_semester')->row_array();

        return $semester['no_of_semester'];
    }

    function load_exm_apply_batches() {
        $course = $this->input->post('course_id');
        $this->db->select('id,batch_code');
        //if($course != 0)
        $this->db->where('course_id', $course);

        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_exm_apply_exams() {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_batch = $this->input->post('tt_batch');

        $this->db->select('exm_exam.*');
        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
        $this->db->where('exm_semester_exam.batch_id', $tt_batch);
        $this->db->where('exm_semester_exam.semester_no', $tt_semester);
        $this->db->where('exm_semester_exam.year_no', $tt_year);
        $this->db->where('exm_semester_exam.course_id', $tt_course);
        $this->db->where('exm_semester_exam.is_approved', 1);

        $exams = $this->db->get('exm_semester_exam')->result_array();

        return $exams;
    }

    function load_exm_registar_course_list() {
        $r = 0;
        $center = $this->input->post('center_id');

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        foreach ($user_centers as $value) {
            $arr[$r] = $value['br_id'];
            $r++;
        }

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        if ($center != "all") {
            $this->db->where('ecc.center_id', $center);
        } else {
            $this->db->where_in('ecc.center_id', $arr);
        }
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_exm_admin_course_list() {
        $center = $this->input->post('center_id');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');

        if ($center != "all") {
            $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
            $this->db->where('ecc.center_id', $center);
        }

        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_exm_lecturer_course_list() {
        $center = $this->session->userdata('user_branch');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $center);
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_exam_years() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        return $years['no_of_year'];
    }

    function load_exam_semesters() {
        $this->db->where('course_id', $this->input->post('tt_course'));
        $this->db->where('deleted', 0);
        $years = $this->db->get('edu_year')->row_array();

        $this->db->where('year_id', $years['id']);
        $this->db->where('year_no', $this->input->post('tt_year'));
        $this->db->where('deleted', 0);
        $semester = $this->db->get('edu_semester')->row_array();

        return $semester['no_of_semester'];
    }

    function load_exm_batches() {
        $course = $this->input->post('course_id');
        $this->db->select('id,batch_code');
        $this->db->where('course_id', $course);

        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_exm_exams() {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
        $tt_batch = $this->input->post('tt_batch');

        $this->db->select('exm_exam.*');
        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
        $this->db->where('exm_semester_exam.batch_id', $tt_batch);
        $this->db->where('exm_semester_exam.semester_no', $tt_semester);
        $this->db->where('exm_semester_exam.year_no', $tt_year);
        $this->db->where('exm_semester_exam.course_id', $tt_course);
        $this->db->where('exm_semester_exam.is_approved', 1);

        $exams = $this->db->get('exm_semester_exam')->result_array();

        return $exams;
    }

    function load_all_exam_count($data) {

        //$this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, COUNT(sr.stu_id) as stu_count, COUNT(IF(esd.is_approved = "2", esd.is_approved, null)) as approve_count, COUNT(IF(esd.is_approved = "3", esd.is_approved, null)) as reject_count, COUNT(IF(esd.is_approved = "0" or esd.is_approved = "1", esd.is_approved, null)) as not_approve_count');

        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, 
                            SUM(if(esd.is_approved= 2, 1, 0)) AS approved, 
                            SUM(if(esd.is_approved= 3 or esd.is_approved= 4 , 1, 0)) AS rejected, 
                            SUM(if(esd.is_approved= 1 or esd.is_approved= 0, 1, 0)) AS not_approved,
                            if(SUM(if(esd.is_approved= 3 or esd.is_approved= 4, 1, 0))> 0, 1, 0) as final_reject,
                            if(SUM(if(esd.is_approved= 1 or esd.is_approved= 0, 1, 0)) > 0 && SUM(if(esd.is_approved= 3, 1, 0)) = 0, 1, 0) as final_not_approve,
                            if(SUM(if(esd.is_approved= 2, 1, 0)) > 0 && SUM(if(esd.is_approved= 1 or 0, 1, 0)) = 0 && SUM(if(esd.is_approved= 3, 1, 0)) = 0, 1, 0) as final_approve');

        $this->db->join('exm_semester_exam_details esd', 'ese.id=esd.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id=esd.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->join('edu_course ec', 'ec.id=ese.course_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');

        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.center_id', $data['center']);
        $this->db->where('ese.course_id', $data['course']);
        $this->db->where('ese.year_no', $data['year']);
        $this->db->where('ese.semester_no', $data['semester']);
        $this->db->where('ese.batch_id', $data['batch']);
        $this->db->where('ese.is_approved', 1);

        $this->db->where('esd.is_repeat', 0);

        if ($this->input->post('exam') != "") {
            $this->db->where('ese.exam_id', $data['exam']);
        }

        $this->db->group_by('ese.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->group_by('ese.exam_id');
        $this->db->group_by('esd.student_id');
        //$this->db->group_by('esd.subject_id');
        $this->db->order_by('cb.br_name');
        $this->db->order_by('sr.stu_id');

        $result_array = $stu_all_count_exm = $this->db->get('exm_semester_exam ese')->result_array();

        return $result_array;
    }

    function load_all_exam_count_repeat($data) {

        //$this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, COUNT(sr.stu_id) as stu_count, COUNT(IF(esd.is_approved = "2", esd.is_approved, null)) as approve_count, COUNT(IF(esd.is_approved = "3", esd.is_approved, null)) as reject_count, COUNT(IF(esd.is_approved = "0" or esd.is_approved = "1", esd.is_approved, null)) as not_approve_count');

        $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, 
                            SUM(if(esd.is_repeat_approved= 1, 1, 0)) AS approved, 
                            SUM(if(esd.is_repeat= 3, 1, 0)) AS rejected, 
                            SUM(if(esd.is_repeat= 0 and esd.is_repeat_approved= 0, 1, 0)) AS not_approved,
                            if(SUM(if(esd.is_repeat= 3, 1, 0))> 0, 1, 0) as final_reject,
                            if(SUM(if(esd.is_repeat= 0 and esd.is_repeat_approved= 0, 1, 0)) > 0, 1, 0) as final_not_approve,
                            if(SUM(if(esd.is_repeat_approved= 1, 1, 0)) > 0, 1, 0) as final_approve');

        $this->db->join('exm_semester_exam_details_repeat esd', 'ese.exam_id=esd.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id=esd.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->join('edu_course ec', 'ec.id=ese.course_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');

        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.center_id', $data['center']);
        $this->db->where('ese.course_id', $data['course']);
        $this->db->where('ese.year_no', $data['year']);
        $this->db->where('ese.semester_no', $data['semester']);
        $this->db->where('ese.batch_id', $data['batch']);
        $this->db->where('ese.is_approved', 1);

        $this->db->where('esd.deleted', 0);

        if ($this->input->post('exam') != "") {
            $this->db->where('ese.exam_id', $data['exam']);
        }

        $this->db->group_by('ese.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->group_by('ese.exam_id');
        $this->db->group_by('esd.stu_id');
        //$this->db->group_by('esd.subject_id');
        $this->db->order_by('cb.br_name');
        $this->db->order_by('sr.stu_id');

        $result_array = $stu_all_count_exm = $this->db->get('exm_semester_exam ese')->result_array();

        return $result_array;
    }

    function load_center_wise_student_exams($data) {

        if ($data['selected_type'] == 1) {
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, COUNT(esd.student_id) AS status_count');
        } else if ($data['selected_type'] == 2) {
            //to get the approved count
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, SUM(if(esd.is_approved= 2, 1, 0)) AS status_count');
        } else {
            //to get the reject count
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, SUM(if(esd.is_approved= 3 or esd.is_approved= 4, 1, 0)) AS status_count');
        }

        //$this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, SUM(if(esd.is_approved= 2, 1, 0)) AS approved, SUM(if(esd.is_approved= 3, 1, 0)) AS rejected, SUM(if(esd.is_approved= 1 or 0, 1, 0)) AS not_approved');

        $this->db->join('exm_semester_exam_details esd', 'ese.id=esd.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id=esd.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->join('edu_course ec', 'ec.id=ese.course_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');

        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.center_id', $data['ap_center']);
        $this->db->where('esd.is_repeat', 0);
        if ($data['ap_course'] != 0) {
            $this->db->where('ese.course_id', $data['ap_course']);
            $this->db->where('ese.year_no', $data['ap_year']);
            $this->db->where('ese.semester_no', $data['ap_semester']);
            $this->db->where('ese.batch_id', $data['ap_batch']);
            $this->db->where('ese.is_approved', 1);

            if ($this->input->post('exam') != "") {
                $this->db->where('ese.exam_id', $data['ap_exam']);
            }
        }

        $this->db->group_by('ese.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->group_by('ese.exam_id');
        $this->db->group_by('esd.student_id');

        $this->db->order_by('cb.br_name');
        $this->db->order_by('sr.stu_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');    ////////Query Change

        return $stu_exam_count = $this->db->get('exm_semester_exam ese')->result_array();
    }

    function load_center_wise_student_exams_repeat($data) {

        if ($data['selected_type'] == 1) {
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, COUNT(esd.stu_id) AS status_count');
        } else if ($data['selected_type'] == 2) {
            //to get the approved count
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, SUM(if(esd.is_repeat_approved= 1, 1, 0)) AS status_count');
        } else {
            //to get the reject count
            $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, sr.first_name, sr.reg_no, SUM(if(esd.is_repeat= 3, 1, 0)) AS status_count');
        }

        //$this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, ee.exam_code, ee.exam_name, sr.stu_id, SUM(if(esd.is_approved= 2, 1, 0)) AS approved, SUM(if(esd.is_approved= 3, 1, 0)) AS rejected, SUM(if(esd.is_approved= 1 or 0, 1, 0)) AS not_approved');

        $this->db->join('exm_semester_exam_details_repeat esd', 'ese.exam_id=esd.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id=esd.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->join('edu_course ec', 'ec.id=ese.course_id');
        $this->db->join('exm_exam ee', 'ee.id=ese.exam_id');

        $this->db->where('esd.deleted', 0);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.center_id', $data['ap_center']);
        if ($data['ap_course'] != 0) {
            $this->db->where('ese.course_id', $data['ap_course']);
            $this->db->where('ese.year_no', $data['ap_year']);
            $this->db->where('ese.semester_no', $data['ap_semester']);
            $this->db->where('ese.batch_id', $data['ap_batch']);
            $this->db->where('ese.is_approved', 1);

            if ($this->input->post('exam') != "") {
                $this->db->where('ese.exam_id', $data['ap_exam']);
            }
        }

        $this->db->group_by('ese.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->group_by('ese.exam_id');
        $this->db->group_by('esd.stu_id');

        $this->db->order_by('cb.br_name');
        $this->db->order_by('sr.stu_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');    ////////Query Change

        return $stu_exam_count = $this->db->get('exm_semester_exam ese')->result_array();
    }

    function get_user_groups() {

        $this->db->select('*');
        $user_groups = $this->db->get('ath_usergroup')->result_array();
        return $user_groups;
    }

    function get_user_types($user_group) {
        $this->db->select('*');
        $this->db->where('user_ugroup', $user_group);
        return $this->db->get('ath_user')->result_array();
    }

    function search_user_log_actions($data) {
        $this->db->select('*');
        $this->db->where('log_user', $data['user']);
        $this->db->where('log_timestamp >=', $data['from_date']);
        $this->db->where('log_timestamp <=', $data['to_date']);

        $result_array = $this->db->get('oth_logger')->result_array();
        return $result_array;
    }

    function get_student_gpa_value_show() {
        $user = $this->session->userdata('user_ref_id');

        $overallgpa = $this->db->query('SELECT overall_gpa FROM exm_mark_stu_gpa WHERE stu_id = "' . $user . '" AND exam_mark_stu_gpa_id = (SELECT MAX(exam_mark_stu_gpa_id) FROM exm_mark_stu_gpa WHERE stu_id ="' . $user . '")')->row_array();
        if ($overallgpa) {
            $overall = $overallgpa['overall_gpa'];
        } else {
            $overall = NULL;
        }

        return $overall;
    }

    function load_semester_subjects($data, $batch_details) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*,co.type as subject_type, co.id as subj_id');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');

        if ($ug_level == 4) {
            $this->db->join('sta_lecturer_subject ss', 'co.id = ss.subject_id');
            $this->db->where('ss.lecturer_id', $this->session->userdata('user_ref_id'));
            $this->db->where('ss.deleted', 0);
        }

        $this->db->where('yr.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
//        $this->db->order_by("co.type", "asc");
//        $this->db->order_by("co.code", "asc");
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    function load_semester_subjects_recorrection($data) {
//        $access_level = $this->Util_model->check_access_level();
//        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*,co.type as subject_type, co.id as subj_id');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');

//        if($ug_level == 4){
//            $this->db->join('sta_lecturer_subject ss', 'co.id = ss.subject_id');
//            $this->db->where('ss.lecturer_id', $this->session->userdata('user_ref_id'));
//            $this->db->where('ss.deleted', 0);
//        }

        $this->db->where('yr.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year']);
        $this->db->where('sc.semester_no', $data['semester']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
//        $this->db->order_by("co.type", "asc");
//        $this->db->order_by("co.code", "asc");
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    function load_student_for_repeated($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = esedr.stu_id');

        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('sr.course_id', $data['course_id']);
        $this->db->where('esedr.applying_year', $data['year_no']);
        $this->db->where('esedr.applying_semester', $data['semester_no']);
        $this->db->where('esedr.applying_batch', $data['batch_id']);
        $this->db->where('esedr.is_repeat', 1);
        $this->db->where('esedr.is_repeat_approved', 1);

        $this->db->group_by('esedr.stu_id');

        $result_array = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*');

            $this->db->join('mod_subject md', 'md.id = esedr1.subject_id');
            $this->db->where('esedr1.is_repeat', 1);
            $this->db->where('esedr1.is_repeat_approved', 1);
            $this->db->where('esedr1.stu_id', $result_array[$i]['stu_id']);

//            $this->db->group_by('esedr1.stu_id');


            $result_array[$i]['subjects'] = $this->db->get('exm_semester_exam_details_repeat esedr1')->result_array();
        }



        return $result_array;
    }

/////////////////////////////////////////////////
    function load_recorrection_student_data() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('sr.stu_id, sr.reg_no, sr.first_name');
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->where('em.course_id', $this->input->post('recorectCourse'));
        $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
        $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
        $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
        if ($ug_level == 5) {
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('em.is_recorrection_approved', 1);
        $this->db->where('em.is_recorrection', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('em.deleted', 0);
        $this->db->group_by('em.student_id');

        $exams_students = $this->db->get('exm_mark em')->result_array();

        for ($i = 0; $i < count($exams_students); $i++) {  //put only all subjects to one array..
            $this->db->select('ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->where('em.course_id', $this->input->post('recorectCourse'));
            $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
            $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('em.is_recorrection_approved', 1);
            $this->db->where('em.is_recorrection', 1);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);

            $exams_students[$i]['subjects'] = $this->db->get('exm_mark em')->result_array();
        }
        if ($exams_students) {
            return $exams_students;
        } else {
            return NULL;
        }
    }

    function load_rpt_semester_subjects_by_semester($data) {
        //$user_id = $this->session->userdata('u_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $sem_subjects_code = [];

        $this->db->select('*,co.type as subject_type');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
        $this->db->where('yr.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sd.deleted', 0);
        $this->db->where('sc.deleted', 0);
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();

        foreach ($result_array as $subject) {
            $sem_subjects[] = $subject['subject_id'];
            $sem_subjects_code[] = array('subject_id' => $subject['subject_id'], 'code' => $subject['code'], 'subject' => $subject['subject']);
        }

        if ($this->session->userdata('user_ref_id') != null) {
            if ($ug_level == '4') {
                //             $this->db->select('sta_lecturer_subject.subject_id,mod_subject.code,mod_subject.subject');
                //             $this->db->join('mod_subject', 'mod_subject.id = sta_lecturer_subject.subject_id');
                //             $this->db->where_in('sta_lecturer_subject.subject_id', $sem_subjects);
                //             $this->db->where('lecturer_id', $this->session->userdata('user_ref_id'));
                //
    //             $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject')->result_array();

                $this->db->select('sls.subject_id,msb.code,msb.subject');
                $this->db->join('mod_subject msb', 'msb.id = sls.subject_id');
                $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
                $this->db->where_in('sls.subject_id', $sem_subjects);
                $this->db->where('sld.stf_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sls.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('sta_lecturer_subject sls')->result_array();
            } else {
                $this->db->select('sfs.subject_id,ms.code,ms.subject');
                $this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
                $this->db->join('stu_subject sts', 'sts.id = sfs.student_subject_id');
                $this->db->where_in('sfs.subject_id', $sem_subjects);
                $this->db->where('sts.student_id', $this->session->userdata('user_ref_id'));
                $this->db->where('sfs.deleted', 0);

                $result_array[]['lecturer_subject'] = $this->db->get('stu_follow_subject sfs')->result_array();
            }
        } else {
            if ($ug_level == '1' || $ug_level == '2' || $ug_level == '3') {
                $result_array[]['lecturer_subject'] = $sem_subjects_code;
            } else {
                $result_array[]['lecturer_subject'] = null;
            }
        }

        return $result_array;
    }

    function load_rpt_student_for_exam_marks($data) {
        $result_array = [];
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('eser.regno_order, eser.stu_id,eser.reg_no,eser.admission_no,eser.first_name,eser.last_name,eser.batch_id,eser.release_result');
        $this->db->where('eser.applying_exam', $data['exam_id']);
        $this->db->where('eser.course_id', $data['course_id']);
        $this->db->where('eser.applying_year', $data['year_no']);
        $this->db->where('eser.applying_semester', $data['semester_no']);
        $this->db->where('eser.center_id', $data['center_id']);
        //$this->db->where('eser.applying_batch', $data['batch_id']);
        if ($ug_level == 5) {
            $this->db->where('eser.stu_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(eser.regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('repeat_exam_student_details_view eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('se.subject_type, se.subject_code,se.is_approved,se.subject_id,se.repeat_reject, se.rpt_is_absent,'
                    . 'se.rpt_is_absent_approve, se.rpt_absent_deferement');
            $this->db->where('se.course_id', $data['course_id']);
           // $this->db->where('se.applying_batch', $data['batch_id']);
            $this->db->where('se.applying_year', $data['year_no']);
            $this->db->where('se.applying_semester', $data['semester_no']);
            $this->db->where('se.applying_exam', $data['exam_id']);
            $this->db->where('se.stu_id', $result_array[$i]['stu_id']);
            $result_array[$i]['applied_subjects'] = $this->db->get('repeat_exam_applied_subjects_of_students_view se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);


            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
em.deleted,em.exam_status,em.subject_code,em.mark,em.persentage,em.exam_type_id,em.detail_is_director_mark_approved,
em.detail_is_hod_mark_aproved,em.detail_deleted,em.result,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.release_result');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $result_array[$i]['exam_mark'] = $this->db->get('repeat_exam_applied_students_marks_view em')->result_array();

            //fraud status  //fraud_status
            //SELECT `semester_exam_id` FROM `exm_semester_exam_details_repeat` WHERE `applying_exam`=16 AND `stu_id`=4413 GROUP BY `stu_id`
           
            $this->db->select('semester_exam_id ');
            $this->db->where('applying_exam', $data['exam_id']);
            $this->db->where('stu_id', $result_array[$i]['stu_id']);
            $this->db->group_by('stu_id');
            $temp_sem_exam_id = $this->db->get('exm_semester_exam_details_repeat')->result_array();
            $sem_exam_id=isset($temp_sem_exam_id[0]['semester_exam_id']) ? $temp_sem_exam_id[0]['semester_exam_id']:'';



            $this->db->select('count(stu_id) as count ');
            $this->db->where('course_id', $data['course_id']);
           // $this->db->where('se.applying_batch', $data['batch_id']);
            $this->db->where('year_no', $data['year_no']);
            $this->db->where('semester_no', $data['semester_no']);
            $this->db->where('sem_exam_id', $sem_exam_id);
            $this->db->where('stu_id', $result_array[$i]['stu_id']);
            $temp_array = $this->db->get('exam_fraud_students')->result_array();
            $result_array[$i]['fraud_status']=$temp_array[0]['count'];

        }
        return $result_array;
    }

//    function load_rpt_student_for_exam_marks($data)
//    {
//        $result_array = [];
//        $access_level = $this->Util_model->check_access_level();
//        $ug_level = $access_level[0]['ug_level'];
//        
//        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id,ese.release_result');
//        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
//        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
//        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
//      //  $this->db->join('exm_mark em', 'ese.id = em.sem_exam_id');
//       // $this->db->join('exm_mark_details emd', 'em.id = emd.exam_mark_id');
//
//        $this->db->where('eser.applying_exam', $data['exam_id']);
//        $this->db->where('ese.course_id', $data['course_id']);
//        $this->db->where('eser.applying_year', $data['year_no']);
//        $this->db->where('eser.applying_semester', $data['semester_no']);
//        $this->db->where('sr.center_id', $data['center_id']);       
//        $this->db->where('eser.applying_batch', $data['batch_id']);
//        $this->db->where('ese.deleted', 0);
//        //$this->db->where('eser.is_repeat_approved', 1);
//        $this->db->where('ese.is_approved', 1);
//        $this->db->where('sr.deleted', 0);
//        $this->db->where('sr.approved', 1);
//        if($ug_level == 5){
//            $this->db->where('eser.stu_id', $this->session->userdata('user_ref_id'));
//        }
//        $this->db->group_by('eser.stu_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
//        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();
//        
////        $this->db->select('release_result');
////        $this->db->where('exam_id', $data['exam_id']);
////        $result_array['release_results'] = $this->db->get('exm_semester_exam')->result_array();
//        
//        
//        for ($i = 0; $i < count($result_array); $i++) {
//            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id,sedr.is_repeat as repeat_reject, sedr.is_absent as rpt_is_absent,'
//                    . 'sedr.is_absent_approve as rpt_is_absent_approve, sedr.absent_deferement as rpt_absent_deferement');
//            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
//            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
//            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('sedr.applying_batch', $data['batch_id']);
//            $this->db->where('sedr.applying_year', $data['year_no']);
//            $this->db->where('sedr.applying_semester', $data['semester_no']);
//            $this->db->where('sedr.applying_exam', $data['exam_id']);
//            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
//            $this->db->where('se.deleted', 0);
//            $this->db->where('sedr.deleted', 0);
//            //$this->db->where('sedr.is_repeat_approved', 1);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();    
//            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'],$data['year_no'],$data['semester_no']); 
//            
//            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.result,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,es.release_result');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//        }
////        print_r($result_array);
//        return $result_array;
//     
//    }

    function load_recorrection_students($data) {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*, sr.stu_id, sr.reg_no, sr.first_name, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order'); ///////////Query Change
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->where('em.course_id', $data['course_id']);

        $this->db->where('em.batch_id', $data['batch_id']); //earlier commented
        $this->db->where('em.sem_exam_id', $data['exam_id']); //earlier commented

        $this->db->where('em.year_no', $data['year']);
        $this->db->where('em.semester_no', $data['semester']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('em.is_recorrection', 1);
        $this->db->where('em.is_recorrection_approved', 1);
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('em.deleted', 0);
        if ($ug_level == 5) {
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('em.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); ///////////Query Change

        $exams_students = $this->db->get('exm_mark em')->result_array();

        for ($i = 0; $i < count($exams_students); $i++) {  //put only all subjects to one array..
            $this->db->select('*, ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection,es.release_result');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.sem_exam_id', $data['exam_id']);
            $this->db->where('em.year_no', $data['year']);
            $this->db->where('em.semester_no', $data['semester']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_recorrection', 1);
            $this->db->where('em.is_recorrection_approved', 1);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);

            $exams_students[$i]['subjects'] = $this->db->get('exm_mark em')->result_array();
            $exams_students[$i]['gpa'] = $this->get_student_gpa_value($exams_students[$i]['stu_id'], $data['year'], $data['semester']);
        }

        return $exams_students;
    }

    function print_load_recorrection_students($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('*, sr.stu_id, sr.reg_no, sr.first_name, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order'); ///////////Query Change
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->where('em.course_id', $data['course_id']);
        $this->db->where('em.batch_id', $data['batch_id']);
        $this->db->where('em.sem_exam_id', $data['exam_id']);
        $this->db->where('em.year_no', $data['year']);
        $this->db->where('em.semester_no', $data['semester']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('em.is_recorrection', 1);
        $this->db->where('em.is_recorrection_approved', 1);
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('em.deleted', 0);

        if ($ug_level == 5) {
            $this->db->where('em.student_id', $this->session->userdata('user_ref_id'));
        }

        $this->db->group_by('em.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); ///////////Query Change

        $exams_students = $this->db->get('exm_mark em')->result_array();

        for ($i = 0; $i < count($exams_students); $i++) {  //put only all subjects to one array..
            $this->db->select('*, ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection,es.release_result');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.sem_exam_id', $data['exam_id']);
            $this->db->where('em.year_no', $data['year']);
            $this->db->where('em.semester_no', $data['semester']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_recorrection', 1);
            $this->db->where('em.is_recorrection_approved', 1);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);

            $exams_students[$i]['subjects'] = $this->db->get('exm_mark em')->result_array();
            $exams_students[$i]['gpa'] = $this->get_student_gpa_value($exams_students[$i]['stu_id'], $data['year'], $data['semester']);
        }

        return $exams_students;
    }

    function get_selected_recorrection_course_name($cou_id) {
        $this->db->select("id,course_code,course_name");
        $this->db->where('id', $cou_id);
        return $this->db->get('edu_course')->row_array();
    }

    function get_selected_recorrection_center_name($cen_id) {
        $this->db->select("br_id,br_code,br_name");
        $this->db->where('br_id', $cen_id);
        return $this->db->get('cfg_branch')->row_array();
    }

    function prnt_load_repeat_student_data_report($data) {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('eser.regno_order, eser.stu_id,eser.reg_no,eser.admission_no,eser.first_name,eser.last_name,eser.batch_id');

        $this->db->where('eser.applying_exam', $data['exam_id']);
        $this->db->where('eser.course_id', $data['course_id']);
        $this->db->where('eser.applying_year', $data['year_no']);
        $this->db->where('eser.applying_semester', $data['semester_no']);
        $this->db->where('eser.center_id', $data['center_id']);
       // $this->db->where('eser.applying_batch', $data['batch_id']);
        if ($ug_level == 5) {
            $this->db->where('eser.stu_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('repeat_exam_student_details_view eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('se.subject_type, se.subject_code,se.is_approved,se.subject_id,se.rpt_is_absent,'
                    . 'se.rpt_is_absent_approve, se.rpt_absent_deferement, se.is_repeat');
            $this->db->where('se.course_id', $data['course_id']);
           // $this->db->where('se.applying_batch', $data['batch_id']);
            $this->db->where('se.applying_year', $data['year_no']);
            $this->db->where('se.applying_semester', $data['semester_no']);
            $this->db->where('se.applying_exam', $data['exam_id']);
            $this->db->where('se.stu_id', $result_array[$i]['stu_id']);
            $result_array[$i]['applied_subjects'] = $this->db->get('repeat_exam_applied_subjects_of_students_view se')->result_array();
            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'], $data['year_no'], $data['semester_no']);

            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
                em.deleted,em.exam_status,em.subject_code,em.mark,em.persentage,em.exam_type_id,em.detail_is_director_mark_approved,
                em.detail_is_hod_mark_aproved,em.detail_deleted,em.result,em.release_result');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $result_array[$i]['exam_mark'] = $this->db->get('repeat_exam_applied_students_marks_view em')->result_array();
            //get fraud status
            $year_temp=explode("-",$data['year_no']);
            if(isset($year_temp[0]))
            {
                $year=$year_temp[0];
            }else{
                $year='';
            }


            $this->db->select('semester_exam_id ');
            $this->db->where('applying_exam', $data['exam_id']);
            $this->db->where('stu_id', $result_array[$i]['stu_id']);
            $this->db->group_by('stu_id');
            $temp_sem_exam_id = $this->db->get('exm_semester_exam_details_repeat')->result_array();
            $sem_exam_id=isset($temp_sem_exam_id[0]['semester_exam_id']) ? $temp_sem_exam_id[0]['semester_exam_id']:'';




            $this->db->select('count(stu_id) as fraud_status');
            $this->db->where('course_id', $data['course_id']);
            $this->db->where('batch_id', $data['batch_id']);
            $this->db->where('year_no', $year);
            $this->db->where('semester_no', $data['semester_no']);
            $this->db->where('sem_exam_id', $sem_exam_id);
            $this->db->where('stu_id', $result_array[$i]['stu_id']);
            $fraudStatus=$this->db->get('exam_fraud_students')->result_array();
            $result_array[$i]['fraud_status']=isset($fraudStatus[0]['fraud_status']) ? $fraudStatus[0]['fraud_status']:0;
        }
        return $result_array;
    }

//    function prnt_load_repeat_student_data_report($data){
//        $access_level = $this->Util_model->check_access_level();
//        $ug_level = $access_level[0]['ug_level'];
//        
//        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id');
//        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
//        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
//        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
//      //  $this->db->join('exm_mark em', 'ese.id = em.sem_exam_id');
//       // $this->db->join('exm_mark_details emd', 'em.id = emd.exam_mark_id');
//
//        $this->db->where('eser.applying_exam', $data['exam_id']);
//        $this->db->where('ese.course_id', $data['course_id']);
//        $this->db->where('eser.applying_year', $data['year_no']);
//        $this->db->where('eser.applying_semester', $data['semester_no']);
//        $this->db->where('sr.center_id', $data['center_id']);       
//        $this->db->where('eser.applying_batch', $data['batch_id']);
//        $this->db->where('ese.deleted', 0);
//        //$this->db->where('eser.is_repeat_approved', 1);
//        $this->db->where('ese.is_approved', 1);
//        $this->db->where('sr.deleted', 0);
//        $this->db->where('sr.approved', 1);
//        if($ug_level == 5){
//            $this->db->where('eser.stu_id', $this->session->userdata('user_ref_id'));
//        }
//        $this->db->group_by('eser.stu_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
//        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();
//
//        for ($i = 0; $i < count($result_array); $i++) {
//            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id,sedr.is_absent as rpt_is_absent,'
//                    . 'sedr.is_absent_approve as rpt_is_absent_approve, sedr.absent_deferement as rpt_absent_deferement');
//            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
//            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
//            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('sedr.applying_batch', $data['batch_id']);
//            $this->db->where('sedr.applying_year', $data['year_no']);
//            $this->db->where('sedr.applying_semester', $data['semester_no']);
//            $this->db->where('sedr.applying_exam', $data['exam_id']);
//            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
//            $this->db->where('se.deleted', 0);
//            //$this->db->where('sedr.is_repeat_approved', 1);
//            $this->db->where('sedr.deleted', 0);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//            $result_array[$i]['gpa'] = $this->get_student_gpa_value($result_array[$i]['stu_id'],$data['year_no'],$data['semester_no']); 
//
//            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//                em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//                ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.result,es.release_result');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//        }
////        print_r($result_array);
//        return $result_array;
//    }


    function get_selected_repeat_course_name($cou_id) {
        $this->db->select("id,course_code,course_name");
        $this->db->where('id', $cou_id);
        return $this->db->get('edu_course')->row_array();
    }

    function get_selected_repeat_center_name($cen_id) {
        $this->db->select("br_id,br_code,br_name");
        $this->db->where('br_id', $cen_id);
        return $this->db->get('cfg_branch')->row_array();
    }

    function differ_load_students_who_applied_for_exams($data) {
        if ($data['student_status'] == 1) {

            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
            $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
            $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
            $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
            $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');

            $this->db->where('ese.batch_id', $data['batch_id']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('ese.course_id', $data['course_id']);
            $this->db->where('ese.year_no', $data['year_no']);
            $this->db->where('ese.semester_no', $data['semester_no']);
            $this->db->where('ese.exam_id', $data['exam_id']);
            $this->db->where('sr.deleted', 0);


            if ($data['subject_id'] != "all") {
                $this->db->where('esed.subject_id', $data['subject_id']);
            }

            if ($data['is_attend'] != "all") {
                $this->db->where('esed.is_attend', $data['is_attend']);
            }


            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

            //$this->db->where('esed.is_approved', 2);
            //$this->db->group_by('ms.code');

            $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

            //        $count = 0;
            //        foreach ($timetables as $rw) {
            //            $this->db->select('*');
            //            $this->db->where('ss.subject_id', $rw['subject_id']);
            //            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
            //            //$this->db->where('sfs.deleted', 0);
            //            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            //            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
            //            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
            //            $count++;
            //        }
            //return $timetables;
        } else {

            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esedr.is_repeat_approved as subj_approved, esedr.is_attend as subj_attend, esedr.is_absent as exam_absent');
            $this->db->join('exm_semester_exam ese', 'ese.exam_id = esedr.semester_exam_id');
            $this->db->join('stu_reg sr', 'sr.stu_id = esedr.stu_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
            $this->db->join('mod_subject ms', 'ms.id = esedr.subject_id');
            $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');

            $this->db->where('ese.batch_id', $data['batch_id']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('ese.course_id', $data['course_id']);
            $this->db->where('ese.year_no', $data['year_no']);
            $this->db->where('ese.semester_no', $data['semester_no']);
            $this->db->where('ese.exam_id', $data['exam_id']);
            $this->db->where('sr.deleted', 0);

            if ($data['subject_id'] != "all") {
                $this->db->where('esedr.subject_id', $data['subject_id']);
            }

            if ($data['is_attend'] != "all") {
                $this->db->where('esedr.is_attend', $data['is_attend']);
            }

            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

            $timetables = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();
        }
        return $timetables;
    }

    function print_differ_load_students_who_applied($data) {


        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('sr.deleted', 0);

        if ($data['subject_id'] != "all") {
            $this->db->where('esed.subject_id', $data['subject_id']);
        }

        if ($data['is_attend'] != "all") {
            $this->db->where('esed.is_attend', $data['is_attend']);
        }


        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
    }

    function sign_load_exams() {
        $tt_course = $this->input->post('tt_course');
        $tt_year = $this->input->post('tt_year');
        $tt_semester = $this->input->post('tt_semester');
//        $tt_batch = $this->input->post('tt_batch');

        $this->db->select('exm_exam.*,exm_semester_exam.id as sem_exm_id');
        $this->db->join('exm_exam', 'exm_exam.id=exm_semester_exam.exam_id');
        // if (!empty($tt_season)) {
        //    $this->db->where('exm_semester_exam.study_season_id', $tt_season);
        // }
        if (!empty($tt_semester)) {
            $this->db->where('exm_semester_exam.semester_no', $tt_semester);
        }
//        $this->db->where('exm_semester_exam.batch_id', $tt_batch);
        $this->db->where('exm_semester_exam.year_no', $tt_year);
        $this->db->where('exm_semester_exam.course_id', $tt_course);
        $this->db->where('exm_semester_exam.is_approved', 1);

        $exams = $this->db->get('exm_semester_exam')->result_array();

        return $exams;
    }

    function sign_load_exam_subjects() {


        $tt_center_id = $this->input->post('tt_center_id');
        $tt_course_id = $this->input->post('tt_course_id');
        $tt_year_no = $this->input->post('tt_year_no');
        $tt_semester_no = $this->input->post('tt_semester_no');
        $tt_exam_id = $this->input->post('tt_exam_id');

        $this->db->select('*');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('exm_schedule es', 'es.esch_subject = ms.id');


        $this->db->where('sr.center_id', $tt_center_id);
        $this->db->where('ese.course_id', $tt_course_id);
        $this->db->where('ese.year_no', $tt_year_no);
        $this->db->where('ese.semester_no', $tt_semester_no);
        $this->db->where('ese.exam_id', $tt_exam_id);

        $this->db->group_by('ms.code');

        $exams = $this->db->get('exm_semester_exam_details esed')->result_array();

        return $exams;
    }

    function sign_load_students_who_applied_for_exams($data) {

        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.subject_id', $data['subject_id']);

        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.is_approved', 2);
        $this->db->where('sr.deleted', 0);
//        $this->db->where('esed.is_absent',0);
//        $this->db->where('esed.is_approved',2);
//        $this->db->where('esed.is_approved',3);
//        $this->db->or_where('esed.is_approved',4);
//        if ($data['subject_id'] != "all"){ 
//            $this->db->where('esed.subject_id', $data['subject_id']);
//        }

        $this->db->group_by('sr.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
    }

    function sign_load_students_who_applied_for_exams_repeat($data) {

        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_repeat_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.subject_id', $data['subject_id']);

        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.is_repeat_approved', 1);
//        $this->db->where('esed.is_absent',0);
//        $this->db->where('esed.is_approved',2);
//        $this->db->where('esed.is_approved',3);
//        $this->db->or_where('esed.is_approved',4);
//        if ($data['subject_id'] != "all"){ 
//            $this->db->where('esed.subject_id', $data['subject_id']);
//        }

        $this->db->group_by('sr.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
    }

    function print_sign_load_students_who_applied_for_exams($data) {

        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.subject_id', $data['subject_id']);

        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.is_approved', 2);
        //$this->db->where('esed.is_absent',0);
//        $this->db->where('esed.is_approved',2);
//        $this->db->where('esed.is_approved',3);
//        $this->db->or_where('esed.is_approved',4);


        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

        return $timetables;
    }

    function print_sign_load_students_who_applied_for_exams_repeat($data) {

        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_repeat_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
        $this->db->join('exm_semester_exam ese', 'ese.exam_id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');


        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.subject_id', $data['subject_id']);

        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.is_repeat_approved', 1);
        //$this->db->where('esed.is_absent',0);
//        $this->db->where('esed.is_approved',2);
//        $this->db->where('esed.is_approved',3);
//        $this->db->or_where('esed.is_approved',4);


        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $timetables = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();

        return $timetables;
    }

    ///$this->db->join('cfg_absent_deferement abd', 'abd.deferement = esed.absent_deferement');

    function get_recorrection_years($course_id) {
        $this->db->select('no_of_year');
        $this->db->where('course_id', $course_id);
        $year_no = $this->db->get('edu_year')->row_array();
        return $year_no;
    }

    function get_recorrection_semesters($course_id, $year_no) {
        $this->db->select('no_of_semester');
        $this->db->join('edu_year ey', 'es.year_id = ey.id');
        $this->db->where('ey.course_id', $course_id);
        $this->db->where('es.year_no', $year_no);
        $sem_no = $this->db->get('edu_semester es')->row_array();
        return $sem_no;
    }

    function get_recorrection_semesters_marks($course_id, $year_no, $year_id) {
        $this->db->select('no_of_semester');
        $this->db->join('edu_year ey', 'es.year_id = ey.id');
        $this->db->where('ey.course_id', $course_id);
        $this->db->where('es.year_no', $year_no);
        $this->db->where('es.year_id', $year_id);
        $sem_no = $this->db->get('edu_semester es')->row_array();
        return $sem_no;
    }

    function load_student_exam_marks_report($data) {
        $result_array = [];
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('ed.regno_order, ed.stu_id,ed.reg_no,ed.admission_no,ed.first_name,ed.last_name');
        $this->db->where('ed.course_id', $data['course_id']);
        $this->db->where('ed.exam_id', $data['exam_id']);
        $this->db->where('ed.year_no', $data['year_no']);
        $this->db->where('ed.semester_no', $data['semester_no']);
        $this->db->where('ed.center_id', $data['center_id']);
        $this->db->where('ed.batch_id', $data['batch_id']);
        $this->db->where('EXISTS(select student_id from exm_mark where student_id = ed.student_id and subject_id = ed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('ed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('ed.student_id');
        $this->db->order_by('CAST(ed.regno_order as SIGNED INTEGER)', 'ASC');
        $result_array['students'] = $this->db->get('exam_student_details_view ed')->result_array();

        $this->db->select('release_result');
        $this->db->where('exam_id', $data['exam_id']);
        $result_array['release_results'] = $this->db->get('exm_semester_exam')->result_array();


        for ($i = 0; $i < count($result_array['students']); $i++) {

            //$this->db->select('*');
            $this->db->select('se.subject_type, se.subject_code, se.is_approved, se.is_repeat');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('se.exam_id', $data['exam_id']);
            $this->db->where('se.student_id', $result_array['students'][$i]['stu_id']);
            $result_array['students'][$i]['stu_sem_applied_subjects'] = $this->db->get('exam_applied_subjects_of_student_view se')->result_array();

            //get fraud status
            $this->db->select('count(stu_id) as fraud_status');
            $this->db->where('course_id', $data['course_id']);
            $this->db->where('batch_id', $data['batch_id']);
            $this->db->where('year_no', $data['year_no']);
            $this->db->where('semester_no', $data['semester_no']);
            $this->db->where('sem_exam_id', $data['exam_id']);
            $this->db->where('stu_id', $result_array['students'][$i]['stu_id']);
            $fraudStatus=$this->db->get('exam_fraud_students ')->result_array();
            $result_array['students'][$i]['fraud_status']=isset($fraudStatus[0]['fraud_status']) ? $fraudStatus[0]['fraud_status']:0;

            //$this->db->select('*');
            $this->db->select('es.subject_type, es.subject_code, es.is_approved, es.is_repeat');
            $this->db->where('es.course_id', $data['course_id']);
            $this->db->where('es.batch_id', $data['batch_id']);
            $this->db->where('es.year_no', $data['year_no']);
            $this->db->where('es.semester_no', $data['semester_no']);
            $this->db->where('es.exam_id', $data['exam_id']);
            $this->db->where('es.student_id', $result_array['students'][$i]['stu_id']);
            $this->db->where('EXISTS(select student_id from exm_mark where student_id = es.student_id and subject_id = es.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
            $result_array['students'][$i]['applied_subjects'] = $this->db->get('exam_applied_subjects_of_student_view es')->result_array();
            $result_array['students'][$i]['gpa'] = $this->get_student_gpa_value($result_array['students'][$i]['stu_id'], $data['year_no'], $data['semester_no']);

            // $this->db->select('*');
            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
            em.deleted,em.exam_status,em.subject_code,em.mark,em.persentage,em.exam_type_id,em.detail_is_director_mark_approved,
            em.detail_is_hod_mark_aproved,em.detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.release_result');
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array['students'][$i]['stu_id']);
            $result_array['students'][$i]['exam_mark'] = $this->db->get('exam_applied_sudents_marks_view em')->result_array();
        }
        return $result_array;
    }

//    function load_student_exam_marks_report($data)
//    {       
//        $result_array = [];
//        $access_level = $this->Util_model->check_access_level();
//        $ug_level = $access_level[0]['ug_level'];
//        
//        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name');
//        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
//        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
//        //$this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
//       // $this->db->join('exm_mark em', 'ee.id = em.sem_exam_id');
//
//        $this->db->where('ese.exam_id', $data['exam_id']);
//        $this->db->where('ese.course_id', $data['course_id']);
//        $this->db->where('ese.year_no', $data['year_no']);
//        $this->db->where('ese.semester_no', $data['semester_no']);
//        $this->db->where('sr.center_id', $data['center_id']);
//        $this->db->where('ese.batch_id', $data['batch_id']);
//        $this->db->where('ese.deleted', 0);
//        $this->db->where('ese.is_approved', 1);
//        $this->db->where('sr.deleted', 0);
//        $this->db->where('sr.approved', 1);
//        $this->db->where('ese.release_result', 1);
//        $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
//        if($ug_level == 5){
//            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
//        }
//        $this->db->group_by('esed.student_id');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); 
//        
//        $result_array['students'] = $this->db->get('exm_semester_exam ese')->result_array();
//        
//       // print_r($result_array);
//        
//        $this->db->select('release_result');
//        $this->db->where('exam_id', $data['exam_id']);
//        $result_array['release_results'] = $this->db->get('exm_semester_exam')->result_array();
//        
//       // print_r($release_result);
//
//        for ($i = 0; $i < count($result_array['students']); $i++) {
//            
//            $this->db->select('*, co.type as subject_type, co.code as subject_code');
//            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
//            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('se.batch_id', $data['batch_id']);
//            $this->db->where('se.year_no', $data['year_no']);
//            $this->db->where('se.semester_no', $data['semester_no']);
//            $this->db->where('se.exam_id', $data['exam_id']);
//            $this->db->where('sed.student_id', $result_array['students'][$i]['stu_id']);
//            $this->db->where('se.deleted', 0);
//            $this->db->where('se.release_result', 1);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array['students'][$i]['stu_sem_applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//            
//            
//            
//            $this->db->select('*, co.type as subject_type, co.code as subject_code');
//            $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');
//            $this->db->join('mod_subject co', 'co.id = sed.subject_id');
//            $this->db->where('se.course_id', $data['course_id']);
//            $this->db->where('se.batch_id', $data['batch_id']);
//            $this->db->where('se.year_no', $data['year_no']);
//            $this->db->where('se.semester_no', $data['semester_no']);
//            $this->db->where('se.exam_id', $data['exam_id']);
//            $this->db->where('sed.student_id', $result_array['students'][$i]['stu_id']);
//            $this->db->where('EXISTS(select student_id from exm_mark where student_id = sed.student_id and subject_id = sed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
//            $this->db->where('se.deleted', 0);
//            $this->db->where('se.release_result', 1);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array['students'][$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//            $result_array['students'][$i]['gpa'] = $this->get_student_gpa_value($result_array['students'][$i]['stu_id'],$data['year_no'],$data['semester_no']); 
////            $result_array[$i]['overall_gpa'] = $this->get_student_gpa_value_show($data['overall_gpa']); 
//
//            // $this->db->select('*,co.code as subject_code');
//            $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,es.release_result');
//            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//            $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
//            $this->db->join('mod_subject co', 'co.id = em.subject_id');
//            $this->db->where('em.course_id', $data['course_id']);
//            //$this->db->where('em.batch_id', $data['batch_id']);
//            $this->db->where('em.year_no', $data['year_no']);
//            $this->db->where('em.semester_no', $data['semester_no']);
//            $this->db->where('em.student_id', $result_array['students'][$i]['stu_id']);
//            //$this->db->where('es.release_result', 1);
//            $this->db->where('em.deleted', 0);
//            $this->db->where('ed.deleted', 0);
//            $result_array['students'][$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//        }  
//        return $result_array;
//    }


    function load_repeat_batches_student($course_id, $id) {
        $this->db->select('*');
        $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
        $this->db->where('edu_batch.deleted', 0);
        $this->db->where('edu_batch.course_id', $course_id);
        $this->db->where('stu_reg.stu_id', $id);
        $result = $this->db->get('stu_reg')->result_array();

        return $result;
    }

    function get_exam_conduct_year($course, $year_no, $semester_no, $exam_id) {
        $this->db->select('tt.*');
        $this->db->where('tt.ttbl_course', $course);
        $this->db->where('tt.ttbl_year', $year_no);
        $this->db->where('tt.ttbl_semester', $semester_no);
        $this->db->where('tt.ttbl_exam', $exam_id);
        $this->db->where('tt.approved', 1);
        $ttData = $this->db->get('tta_examtimetable tt')->row_array();

        if (!empty($ttData)) {
            $this->db->select('sh.*');
            $this->db->where('sh.esch_timetable', $ttData['ttbl_id']);
            $this->db->where('sh.esch_status', 'A');
            $this->db->order_by('sh.esch_date', 'DESC');
            $ttData = $this->db->get('exm_schedule sh')->result_array();

            if (!empty($ttData)) {
                return $ttData[0]['esch_date'];
            }
        } else {
            return null;
        }
    }

    function get_recorrection_years_students($course_id, $student_id) {
        $this->db->select('*, stu_reg.current_year as no_of_year');
        $this->db->where('stu_id', $student_id);

        $year_no = $this->db->get('stu_reg')->row_array();

        return $year_no;
    }

    function get_recorrection_semesters_students($course_id, $year_no, $student_id) {
        $this->db->select('*, stu_reg.current_semester as no_of_semester');
        $this->db->where('stu_id', $student_id);

        $semester_no = $this->db->get('stu_reg')->row_array();

        return $semester_no;
    }

    function load_sub_data($data) {

        $this->db->select('*');

        $this->db->join('mod_subject_group msg', 'msg.id = mss.subject_group_id');
        $this->db->join('edu_semester es', 'es.id = mss.semester_id');
        $this->db->join('edu_year ey', 'ey.id = es.year_id');
        $this->db->join('edu_course ec', 'ec.id = ey.course_id');
        $this->db->join('cfg_academicyears ca', 'ca.es_ac_year_id = mss.study_season_id');
        $this->db->join('edu_batch eb', 'eb.id = mss.batch_id');

        $this->db->join('mod_subject_group_subject mgs_d', 'mgs_d.subject_group_id=msg.id');
        $this->db->join('mod_subject subj', 'subj.id = mgs_d.subject_id');
        //$this->db->where('ey.course_id', $data['course_id']);

        $this->db->where('ey.course_id', $data['course_id']);
        $this->db->where('subj.deleted', 0);

        if ($data['year_no'] != "all")
            $this->db->where('year_no', $data['year_no']);

        if ($data['semester_no'] != "all")
            $this->db->where('semester_no', $data['semester_no']);
        //$this->db->group_by('subj.code');
        $search_semsub_array = $this->db->get('mod_semester_subject mss')->result_array();

        return $search_semsub_array;
    }

    function get_center_by_id($center_id) {
        $this->db->select('*');
        $this->db->where('br_id', $center_id);
        $result = $this->db->get('cfg_branch')->row_array();
        return $result['br_name'];
    }

    function get_batch_by_id($batch_id) {
        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $result = $this->db->get('edu_batch')->row_array();
        return $result['batch_code'];
    }

    function get_course_by_id($course_id) {
        $this->db->select('*');
        $this->db->where('id', $course_id);
        $result = $this->db->get('edu_course')->row_array();
        return $result['course_code'] . '-' . $result['course_name'];
    }

    function search_stu_request_course_students_load($data) {

        $graduation_list = [];

        $this->db->select('*, MAX(emsg.overall_gpa) as max');
        $this->db->join('stu_reg sr', 'sr.stu_id = stu_req.student_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = stu_req.center_id');
        $this->db->join('edu_batch eb', 'eb.id = stu_req.batch_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');
        $this->db->join('exm_mark_stu_gpa emsg', 'emsg.stu_id = stu_req.student_id');

        $this->db->where('stu_req.center_id', $data['center_id']);
        $this->db->where('stu_req.course_id', $data['course_id']);
        $this->db->where('stu_req.batch_id', $data['batch_id']);


        if ($data['request_type'] == '1') {
//            $this->db->select_max('emsg.overall_gpa', 'max');
            $this->db->where('stu_req.request_type', 1);
            $this->db->where('stu_req.status', 1);
        } else if ($data['request_type'] == '2') {
//            $this->db->select_max('emsg.overall_gpa', 'max');
            $this->db->where('stu_req.request_type', 2);
            $this->db->where('stu_req.is_approved', 1);
        } else {
//            $this->db->select_max('emsg.overall_gpa', 'max');
            $this->db->where('stu_req.request_type', 2);
            $this->db->where('stu_req.is_approved', 3);
        }

        $this->db->group_by('stu_req.student_id');



        $graduation_list = $this->db->get('stu_requests stu_req')->result_array();

        return $graduation_list;
    }

    //Student Full Exam Marks Report
    function load_batches_full_results($course_id) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }

    function load_batches_full_results_student($course_id, $id) {
        $this->db->select('*');
        $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
        $this->db->where('edu_batch.deleted', 0);
        $this->db->where('edu_batch.course_id', $course_id);
        $this->db->where('stu_reg.stu_id', $id);
        $result = $this->db->get('stu_reg')->result_array();

        return $result;
    }

    function load_student_data_full_results($data) {
        $result_array = [];
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.first_name,sr.last_name');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');

        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('ese.release_result', 1);
        $this->db->where('EXISTS(select student_id from exm_mark where student_id = esed.student_id and subject_id = esed.subject_id and is_hod_mark_aproved = 1 and is_director_mark_approved = 1 and is_ex_director_mark_approved = 1)');
        if ($ug_level == 5) {
            $this->db->where('esed.student_id', $this->session->userdata('user_ref_id'));
        }
        $this->db->group_by('esed.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('exm_semester_exam ese')->result_array();

        return $result_array;
    }

    function load_student_full_results_list($data) {

        $this->db->select('sr.stu_id, sr.course_id, sr.batch_id, sr.current_year, sr.current_semester, sr.center_id, sr.reg_no, sr.first_name, ec.course_code, ec.course_name');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');
        $this->db->where('sr.stu_id', $data['stu_id']);
        $stu_data_array = $this->db->get('stu_reg sr')->result_array();

        $this->db->select('ey.no_of_year, , es.no_of_semester, es.year_id, es.year_no');
        $this->db->join('edu_semester es', 'ey.id = es.year_id');
        $this->db->where('ey.course_id', $stu_data_array[0]['course_id']);
        $year_array = $this->db->get('edu_year ey')->result_array();

        $g = 0;
        $stu_full_mrk_data_array = [];
        for ($y = 0; $y < $year_array[0]['no_of_year']; $y++) {
            for ($s = 0; $s < $year_array[$y]['no_of_semester']; $s++) {

                $this->db->select('exam_id, course_id, batch_id, year_no, semester_no, release_result');
                $this->db->where('course_id', $stu_data_array[0]['course_id']);
                $this->db->where('year_no', $y + 1);
                $this->db->where('semester_no', $s + 1);
                $this->db->where('batch_id', $stu_data_array[0]['batch_id']);
                $exam_array = $this->db->get('exm_semester_exam')->result_array();

                $mrk_array = [];
                $mrk_array['gpa'] = '';
                $mrk_array['exam_mark'] = [];
                if ($exam_array) {
                    //GET SUDENT RESULTS OF EACH YEAR AND SEMESTER
                    $mrk_array['gpa'] = $this->get_student_sgpa_full($data['stu_id'], $y + 1, $s + 1);
                    $mrk_array['cgpa'] = $this->get_student_cgpa($data['stu_id']);

                    $this->db->select('em.result,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,
            em.sem_exam_id,es.exam_id,co.type as subject_type, co.code as subject_code, co.id, co.subject, es.release_result');
                    $this->db->join('exm_semester_exam es', 'es.exam_id = em.sem_exam_id');
                    $this->db->join('mod_subject co', 'co.id = em.subject_id');
                    $this->db->where('em.course_id', $stu_data_array[0]['course_id']);
                    $this->db->where('em.year_no', $y + 1);
                    $this->db->where('em.semester_no', $s + 1);
                    $this->db->where('em.student_id', $data['stu_id']);
                    $this->db->where('em.deleted', 0);
                    $mrk_array['exam_mark'] = $this->db->get('exm_mark em')->result_array();
                }

                $stu_full_mrk_data_array['mark_details'][$g]['year'] = $y + 1;
                $stu_full_mrk_data_array['mark_details'][$g]['semester'] = $s + 1;
                $stu_full_mrk_data_array['mark_details'][$g]['stu_data'] = $mrk_array;

                $g++;
            }
        }

        $stu_full_mrk_data_array['stu_details'] = $stu_data_array;

        return $stu_full_mrk_data_array;
    }

    function get_student_sgpa_full($student_id, $year_no, $semester_no) {
        $this->db->select('*');
        $this->db->where('stu_id', $student_id);
        $this->db->where('year', $year_no);
        $this->db->where('semester', $semester_no);

        $stu_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();
        return $stu_gpa['gpa'];
    }

    function get_student_cgpa($student_id) {
        $this->db->select('exam_mark_stu_gpa_id, stu_id, overall_gpa');
        $this->db->where('exam_mark_stu_gpa_id = (select MAX(exam_mark_stu_gpa_id) from exm_mark_stu_gpa where stu_id =' . $student_id . ')');
        $stu_cgpa = $this->db->get('exm_mark_stu_gpa')->row_array();
        return $stu_cgpa['overall_gpa'];
    }

    function setter_load_exam_subjects() {
        //'tt_course_id': eh_course, 
        //'tt_year_no': eh_year, 
//        'tt_semester_no': eh_semester, 
        //'tt_exam_id': eh_exam,
        //'tt_study_season_id': eh_season,
        //'tt_center_id': eh_branch},

        $tt_batch_id = $this->input->post('tt_batch_id');
//        $tt_center_id = $this->input->post('tt_center_id');
        $tt_course_id = $this->input->post('tt_course_id');
        $tt_year_no = $this->input->post('tt_year_no');
        $tt_semester_no = $this->input->post('tt_semester_no');
        $tt_sem_exam_id = $this->input->post('tt_sem_exam_id');

        $this->db->select('*');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('exm_schedule es', 'es.esch_subject = ms.id');

        $this->db->where('ese.batch_id', $tt_batch_id);
//        $this->db->where('sr.center_id', $tt_center_id);
        $this->db->where('ese.course_id', $tt_course_id);
        $this->db->where('ese.year_no', $tt_year_no);
        $this->db->where('ese.semester_no', $tt_semester_no);
        $this->db->where('ese.id', $tt_sem_exam_id);

        $this->db->group_by('ms.code');

        $exams = $this->db->get('exm_semester_exam_details esed')->result_array();

        return $exams;
    }

    function setter_paper_data($data) {
//        print_r($data);
        $this->db->select('*, (ese.description) AS ese_description, (sld.stf_fname) AS set_name, (sldm.stf_fname) AS mod_name, (sld.stf_lname) AS set_lname, (sldm.stf_lname) AS setm_lname,'
                . '(ct.title_name) AS set_tit, (ctm.title_name) AS mod_tit');
        $this->db->join('exm_semester_exam ese', 'ese.id = eseps.semester_exam_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');

        $this->db->join('mod_subject ms', 'ms.id = eseps.subject_id');
        $this->db->join('edu_course ec', 'ec.id = ese.course_id');
        $this->db->join('edu_batch eb', 'eb.id = ese.batch_id');
        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = eseps.setter_lecturer_id');
        $this->db->join('sta_lecturer_details sldm', 'sldm.stf_id = eseps.moderator_lecturer_id');
        $this->db->join('com_title ct', 'ct.id = sld.tit_name');
        $this->db->join('com_title ctm', 'ctm.id = sldm.tit_name');



//        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
//        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
//        $this->db->join('edu_batch eb', 'eb.id = ese.batch_id');
//        $this->db->join('edu_year ey', 'ey.id = ese.year_no');
//        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = eseps.setter_lecturer_id');
//        $this->db->join('cfg_absent_deferement cad', 'cad.deferement = esed.absent_deferement');
//        $this->db->where('ese.course_id', $data['course_id']);
//        $this->db->where('ese.batch_id', $data['batch_id']);
//        $this->db->where('ese.year_no', $data['year_no']);
//        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('eseps.semester_exam_id', $data['exam_id']);
        $this->db->where('eseps.subject_id', $data['subject_id']);

//        if ($data['subject_id'] != "all"){ 
//            $this->db->where('esed.subject_id', $data['subject_id']);
//        }
//        
//        if($data['is_attend'] != "all"){
//            $this->db->where('esed.is_attend', $data['is_attend']);
//        }
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        //$this->db->where('esed.is_approved', 2);
        //$this->db->group_by('ms.code');

        $timetables = $this->db->get('exm_semester_exam_paper_setter eseps')->result_array();

//        $count = 0;
//        foreach ($timetables as $rw) {
//            $this->db->select('*');
//            $this->db->where('ss.subject_id', $rw['subject_id']);
//            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
//            //$this->db->where('sfs.deleted', 0);
//            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
//            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
//            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
//            $count++;
//        }

        return $timetables;
//        print_r($timetables);
    }

    function print_search_exam_subject_mark_data($data) {

        $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order,mod_subject.code as sub_code, mod_subject.subject as sub_name');

        $this->db->join('exm_semester_exam_details', 'exm_semester_exam_details.semester_exam_id = exm_semester_exam.id');
        $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details.student_id');
        $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details.subject_id');
        $this->db->join('edu_course', 'edu_course.id = exm_semester_exam.course_id');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');
        $this->db->join('exm_exam', 'exm_semester_exam.exam_id = exm_exam.id');
        $this->db->join('cfg_branch', 'cfg_branch.br_id = stu_reg.center_id');

        $this->db->where('stu_reg.center_id', $data['center_id']);
        $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
        $this->db->where('exm_semester_exam.course_id', $data['course_id']);
        $this->db->where('exm_semester_exam.year_no', $data['year_no']);
        $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
        $this->db->where('exm_semester_exam.id', $data['sem_exam_id']);

//        $this->db->where('exm_semester_exam_details.is_attend', 1);
        $this->db->where('exm_semester_exam_details.subject_id', $data['sub_id']);
        $this->db->where('exm_semester_exam_details.is_repeat', 0);
        $this->db->where('exm_semester_exam_details.deleted', 0);

        $this->db->group_by('exm_semester_exam_details.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $return_data = $this->db->get('exm_semester_exam')->result_array();

        $count = 0;
        foreach ($return_data as $rw) {
            $this->db->select('*');
            $this->db->join('exm_semester_exam ese', 'ttaex.ttbl_exam = ese.exam_id');
            $this->db->join('exm_schedule sch', 'sch.esch_timetable = ttaex.ttbl_id');
            $this->db->where('ttaex.ttbl_course', $data['course_id']);
            $this->db->where('ttaex.ttbl_year', $data['year_no']);
            $this->db->where('ttaex.ttbl_semester', $data['semester_no']);
            $this->db->where('sch.esch_subject', $data['sub_id']);
            $this->db->where('sch.esch_status', 'A');
            $this->db->where('ese.id', $data['sem_exam_id']);
//            $this->db->order_by('sch.esch_date', 'ASC');
            $this->db->where('ttaex.ttbl_status', 'A');
            $this->db->where('ttaex.approved', 1);
            $this->db->limit(1);
            $shedules = $this->db->get('tta_examtimetable ttaex')->row_array();
            $temp = explode('-', $shedules['esch_date']);
            $temp2 = explode(':', $shedules['esch_stime']);
//            $return_data[$count]['shedules'] = $temp2[1];
            if ($temp[0] == null || $temp[0] == '') {
                $return_data[$count]['exam_year'] = '';
            } else {
                $return_data[$count]['exam_year'] = $temp[0];
            }

            if (isset($temp2[0]) && isset($temp2[1])) {
                $return_data[$count]['examination_time'] = $temp2[0] . ':' . $temp2[1];
            } else {
                $return_data[$count]['examination_time'] = '';
            }

            $return_data[$count]['examination_date'] = $shedules['esch_date'];

            $count++;
        }


        return $return_data;
    }

    function print_search_exam_subject_mark_data_repeat($data) {

        $this->db->select('*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order,mod_subject.code as sub_code, mod_subject.subject as sub_name');

        $this->db->join('exm_semester_exam_details_repeat', 'exm_semester_exam_details_repeat.semester_exam_id = exm_semester_exam.exam_id');
        $this->db->join('stu_reg', 'stu_reg.stu_id = exm_semester_exam_details_repeat.stu_id');
        $this->db->join('mod_subject', 'mod_subject.id = exm_semester_exam_details_repeat.subject_id');
        $this->db->join('edu_course', 'edu_course.id = exm_semester_exam.course_id');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');
        $this->db->join('exm_exam', 'exm_semester_exam.exam_id = exm_exam.id');
        $this->db->join('cfg_branch', 'cfg_branch.br_id = stu_reg.center_id');

        $this->db->where('stu_reg.center_id', $data['center_id']);
        $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
        $this->db->where('exm_semester_exam.course_id', $data['course_id']);
        $this->db->where('exm_semester_exam.year_no', $data['year_no']);
        $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
        $this->db->where('exm_semester_exam.id', $data['sem_exam_id']);

//        $this->db->where('exm_semester_exam_details_repeat.is_attend', 1);
        $this->db->where('exm_semester_exam_details_repeat.subject_id', $data['sub_id']);
//        $this->db->where('exm_semester_exam_details_repeat.is_approved', 0);
        $this->db->where('exm_semester_exam_details_repeat.deleted', 0);

        $this->db->group_by('exm_semester_exam_details_repeat.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $return_data = $this->db->get('exm_semester_exam')->result_array();

        $count = 0;
        foreach ($return_data as $rw) {
            $this->db->select('*');
            $this->db->join('exm_semester_exam ese', 'ttaex.ttbl_exam = ese.exam_id');
            $this->db->join('exm_schedule sch', 'sch.esch_timetable = ttaex.ttbl_id');
            $this->db->where('ttaex.ttbl_course', $data['course_id']);
            $this->db->where('ttaex.ttbl_year', $data['year_no']);
            $this->db->where('ttaex.ttbl_semester', $data['semester_no']);
            $this->db->where('sch.esch_subject', $data['sub_id']);
            $this->db->where('sch.esch_status', 'A');
            $this->db->where('ese.id', $data['sem_exam_id']);
//            $this->db->order_by('sch.esch_date', 'ASC');
            $this->db->where('ttaex.ttbl_status', 'A');
            $this->db->where('ttaex.approved', 1);
            $this->db->limit(1);
            $shedules = $this->db->get('tta_examtimetable ttaex')->row_array();
            $temp = explode('-', $shedules['esch_date']);
            $temp2 = explode(':', $shedules['esch_stime']);
//            $return_data[$count]['shedules'] = $temp2[1];
            if ($temp[0] == null || $temp[0] == '') {
                $return_data[$count]['exam_year'] = '';
            } else {
                $return_data[$count]['exam_year'] = $temp[0];
            }

            if (isset($temp2[0]) && isset($temp2[1])) {
                $return_data[$count]['examination_time'] = $temp2[0] . ':' . $temp2[1];
            } else {
                $return_data[$count]['examination_time'] = '';
            }

            $return_data[$count]['examination_date'] = $shedules['esch_date'];

            $count++;
        }


        return $return_data;
    }

    function student_course_wise_details_stu_info($type, $year) {

        $y = 0;
        //$type = $this->input->post('type_val');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 3) {
            $loginuser_group = $this->session->userdata('u_ugroup');

            $this->db->select('*');
            $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
            $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
            $this->db->where('ag.rlist_usergroup', $loginuser_group);
            $user_centers = $this->db->get('cfg_branch cb')->result_array();

            foreach ($user_centers as $value) {
                $arr[$y] = $value['br_id'];
                $y++;
            }
        }


        if ($type == "gender") {
            $this->db->select('*, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, sr.sex, COUNT(IF(sr.sex = "F", sr.sex, null)) as type2, COUNT(IF(sr.sex = "M", sr.sex, null)) as type1, COUNT(sr.sex) as type3');
        }

        if ($type == "time") {
            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(IF(sr.course_type = "P", sr.course_type, null)) as type1, COUNT(IF(sr.course_type = "F", sr.course_type, null)) as type2, COUNT(sr.course_type) as type3');
        }

        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        if ($ug_level != 1 && $ug_level != 3) {
            $center = $this->session->userdata('user_branch');
            $this->db->where('sr.center_id', $center);
        } else if ($ug_level == 3) {
            $this->db->where_in('sr.center_id', $arr);
        }
        $this->db->where('EXTRACT(YEAR FROM sr.created_date)=' . $year);
        $this->db->group_by('sr.course_id');
        $this->db->group_by('sr.center_id');
        $this->db->order_by('cb.br_name');
//        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');//////////Query Change

        return $stu_count_array = $this->db->get('stu_reg sr')->result_array();
    }

    function get_mahapola_data_eligible_list($course, $center, $all, $mp_year) {
//        echo'<pre>';
//        print_r($course); echo '<br/>';
//        print_r($center); echo '<br/>';
//        print_r($all); echo '<br/>';
//        print_r($mp_year); echo '<br/>'; 

        $this->db->select('COUNT(stu_id) as stu_count');
        $mahapola_data['stu_count'] = $this->db->get('stu_reg')->result_array();

        $this->db->select('COUNT(strm.mahapola_id) as mp_count');
        $this->db->join('stu_reg_mahapola strm', 'strm.stu_id = str.stu_id');
        $this->db->join('edu_course edc', 'edc.id = str.course_id');
        if ($all == 0) {
            if ($center != "all") {
                $this->db->where('str.center_id', $center);
            }
            if ($course != "all") {
                $this->db->where('str.course_id', $course);
            }
            if ($mp_year != "all" && $mp_year != null) {
                $this->db->where('EXTRACT(YEAR FROM strm.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all" && $mp_year != null) {
                $this->db->where('EXTRACT(YEAR FROM strm.created_date) = ' . $mp_year);
            }
        }
        $this->db->where('str.apply_mahapola', 1);
        $this->db->where('str.approved', 1);
        $this->db->where('str.deleted', 0);
        $this->db->where('strm.approved', 1);
        $this->db->where('strm.is_eligible', 1);
        $this->db->where('strm.director_approved', 1);
        $mahapola_data['mp_count'] = $this->db->get('stu_reg str')->result_array();

        $this->db->select('UPPER(sr.first_name) as first_name ,UPPER(sr.last_name) as last_name, UPPER(srm.full_name) as full_name,sr.al_year,sr.al_index_no,sr.al_z_core,sr.sex,sr.nic_no,sr.reg_no,UPPER(sr.permanent_address) as permanent_address, srm.need_index, UPPER(ec.course_code) as course_code, UPPER(ec.course_code_mahapola) as course_code_mahapola, ec.course_name, center.br_name as center_name');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id = sr.stu_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');
        $this->db->join('cfg_branch center', 'center.br_id = sr.center_id');
        if ($all == 0) {
            if ($center != "all") {
                $this->db->where('sr.center_id', $center);
            }
            if ($course != "all") {
                $this->db->where('sr.course_id', $course);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $mp_year);
            }
        }
        $this->db->where('sr.apply_mahapola', 1);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('srm.approved', 1);
        $this->db->where('srm.is_eligible', 1);
        $this->db->where('srm.director_approved', 1);
        $this->db->order_by('ec.course_code', 'ASC');
        $this->db->order_by('srm.need_index', 'DESC');
        $mahapola_data['mahapola'] = $this->db->get('stu_reg sr')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'RPT');
        $this->db->where('group', 1);
        $mahapola_data['authority'] = $this->db->get('cfg_common')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'MHPRPT');
        $this->db->where('group', 4);
        $mahapola_data['Mahapola_commence_dates'] = $this->db->get('cfg_common')->result_array();

        return $mahapola_data;
    }

    function get_mahapola_data_full_list($course1, $center1, $mp_year, $all, $limit) {

        $this->db->select('COUNT(stu_id) as stu_count');
        $mahapola_data['stu_count'] = $this->db->get('stu_reg')->result_array();

        $this->db->select('COUNT(strm1.mahapola_id) as mp_count');
        $this->db->join('stu_reg_mahapola strm1', 'strm1.stu_id = str1.stu_id');
        $this->db->join('edu_course edc1', 'edc1.id = str1.course_id');
        if ($all == 0) {
            if ($center1 != "all") {
                $this->db->where('str1.center_id', $center1);
            }
            if ($course1 != "all") {
                $this->db->where('str1.course_id', $course1);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM strm1.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM strm1.created_date) = ' . $mp_year);
            }
        }

        $this->db->where('str1.apply_mahapola', 1);
        $this->db->where('str1.approved', 1);
        $this->db->where('str1.deleted', 0);
        $this->db->where('strm1.approved', 1);
        $this->db->where('strm1.director_approved', 1);
        $this->db->order_by('strm1.need_index', 'DESC');
        $this->db->order_by('cast(str1.al_z_core as decimal(5,4)) DESC');
        if ($limit != 'none') {
            $this->db->limit($limit);
        }
        $mahapola_data['mp_count'] = $this->db->get('stu_reg str1')->result_array();

        $this->db->select('UPPER(sr1.first_name) as first_name ,UPPER(sr1.last_name) as last_name,UPPER(srm1.full_name) as full_name,sr1.al_year,sr1.al_index_no,sr1.al_z_core,sr1.sex,sr1.nic_no,sr1.reg_no,UPPER(sr1.permanent_address) as permanent_address, srm1.need_index, UPPER(ec1.course_code) as course_code, ec1.course_name, center.br_name as center_name,UPPER(ec1.course_code_mahapola) as course_code_mahapola');
        $this->db->join('stu_reg_mahapola srm1', 'srm1.stu_id = sr1.stu_id');
        $this->db->join('edu_course ec1', 'ec1.id = sr1.course_id');
        $this->db->join('cfg_branch center', 'center.br_id = sr1.center_id');
        if ($all == 0) {
            if ($center1 != "all") {
                $this->db->where('sr1.center_id', $center1);
            }
            if ($course1 != "all") {
                $this->db->where('sr1.course_id', $course1);
            }
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm1.created_date) = ' . $mp_year);
            }
        } else if ($all == 1) {
            if ($mp_year != "all") {
                $this->db->where('EXTRACT(YEAR FROM srm1.created_date) = ' . $mp_year);
            }
        }

        $this->db->where('sr1.apply_mahapola', 1);
        $this->db->where('sr1.approved', 1);
        $this->db->where('sr1.deleted', 0);
        $this->db->where('srm1.approved', 1);
        $this->db->where('srm1.director_approved', 1);
        $this->db->order_by('srm1.need_index', 'DESC');
        $this->db->order_by('cast(sr1.al_z_core as decimal(5,4)) DESC');
        if ($limit != 'none') {
            $this->db->limit($limit);
        }
        $mahapola_data['mahapola'] = $this->db->get('stu_reg sr1')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'RPT');
        $this->db->where('group', 1);
        $mahapola_data['authority'] = $this->db->get('cfg_common')->result_array();

        $this->db->select('*');
        $this->db->where('type', 'MHPRPT');
        $this->db->where('group', 4);
        $mahapola_data['Mahapola_commence_dates'] = $this->db->get('cfg_common')->result_array();

        return $mahapola_data;
    }

    function deactivate_student_list_search($data) {
        $this->db->select('*, SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 1), "/", -1) AS CODE1,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 2), "/", -1) AS CODE2,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 3), "/", -1) AS CODE3,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 4), "/", -1) AS CODE4,
                              SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order,
                              CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 5), "/", -1) AS UNSIGNED) AS CODE5');

        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');

//        if ($data['center_id'] == "all" && $data['course_id'] != "all") {
////            $this->db->where('sr.center_id', $data['center_id']);
////            $this->db->where('sr.course_id', $data['course_id']);
//            $this->db->where('sr.approved', 3);
//            $this->db->where('sr.deleted', 0);
//            $this->db->where('EXTRACT(YEAR FROM sr.created_date)='.$data['year']);
//            $this->db->group_by('sr.reg_no');
////            $this->db->order_by('CODE5', 'ASC');
//            $this->db->order_by('cb.br_code', 'ASC');
//            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); 
//        
//            $result_array = $this->db->get('stu_reg sr')->result_array();
//
//            return $result_array;
//        }

        if ($data['center_id'] != "all") {
            $this->db->where('sr.center_id', $data['center_id']);
        }

        if ($data['course_id'] != "all") {
            $this->db->where('sr.course_id', $data['course_id']);
        }


//        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 1);
        $this->db->where('EXTRACT(YEAR FROM sr.created_date)=' . $data['year']);
        $this->db->group_by('sr.reg_no');
//        $this->db->order_by('CODE5', 'ASC');
        $this->db->order_by('cb.br_code', 'ASC');
        $this->db->order_by('sr.reg_no', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('stu_reg sr')->result_array();

        return $result_array;
    }

    function rejected_student_list_search($data) {
        $this->db->select('*, SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 1), "/", -1) AS CODE1,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 2), "/", -1) AS CODE2,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 3), "/", -1) AS CODE3,
                              SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 4), "/", -1) AS CODE4,
                              SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order,
                              CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(reg_no), "/", 5), "/", -1) AS UNSIGNED) AS CODE5');

        $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
        $this->db->join('edu_course ec', 'ec.id = sr.course_id');
//        if ($data['center_id'] == "all" && $data['course_id'] != "all") {
////            $this->db->where('sr.center_id', $data['center_id']);
////            $this->db->where('sr.course_id', $data['course_id']);
//            $this->db->where('sr.approved', 3);
//            $this->db->where('sr.deleted', 0);
//            $this->db->where('EXTRACT(YEAR FROM sr.created_date)='.$data['year']);
//            $this->db->group_by('sr.reg_no');
//            $this->db->order_by('cb.br_code', 'ASC');
////            $this->db->order_by('CODE5', 'ASC');
//            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); 
//        
//            $result_array = $this->db->get('stu_reg sr')->result_array();
//
//            return $result_array;
//        }




        if ($data['center_id'] != "all") {
            $this->db->where('sr.center_id', $data['center_id']);
        }

        if ($data['course_id'] != "all") {
            $this->db->where('sr.course_id', $data['course_id']);
        }



//        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('sr.approved', 3);
        $this->db->where('sr.deleted', 0);
        $this->db->where('EXTRACT(YEAR FROM sr.created_date)=' . $data['year']);
        $this->db->group_by('sr.reg_no');
//        $this->db->order_by('CODE5', 'ASC');
        $this->db->order_by('cb.br_code', 'ASC');
        $this->db->order_by('sr.reg_no', 'ASC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        $result_array = $this->db->get('stu_reg sr')->result_array();

        return $result_array;
    }

    function deferement_load_students_who_approved($data) {
        if ($data['student_status'] == 1) {

            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.is_approved as subj_approved, esed.is_attend as subj_attend, esed.is_absent as exam_absent');
            $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
            $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
            $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
            $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');

            $this->db->where('ese.batch_id', $data['batch_id']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('ese.course_id', $data['course_id']);
            $this->db->where('ese.year_no', $data['year_no']);
            $this->db->where('ese.semester_no', $data['semester_no']);
            $this->db->where('ese.exam_id', $data['exam_id']);

            $this->db->where('sr.deleted', 0);
            $this->db->where('esed.is_absent_approve', 1);
            $this->db->where('esed.is_absent', 1);


            if ($data['subject_id'] != "all") {
                $this->db->where('esed.subject_id', $data['subject_id']);
            }

            if ($data['is_attend'] != "all") {
                $this->db->where('esed.is_attend', $data['is_attend']);
            }

//$this->db->where('esed.is_absent_approve', 1);
            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

            //$this->db->where('esed.is_approved', 2);
            //$this->db->group_by('ms.code');

            $timetables = $this->db->get('exm_semester_exam_details esed')->result_array();

            //        $count = 0;
            //        foreach ($timetables as $rw) {
            //            $this->db->select('*');
            //            $this->db->where('ss.subject_id', $rw['subject_id']);
            //            $this->db->join('stu_reg sr', 'sr.stu_id = ss.student_id');
            //            //$this->db->where('sfs.deleted', 0);
            //            //$this->db->join('stu_follow_subject sfs', 'sfs.student_subject_id = ss.id');
            //            //$this->db->join('mod_subject ms', 'ms.id = sfs.subject_id');
            //            $timetables[$count]['students'] = $this->db->get('exm_semester_exam_details ss')->result_array();
            //            $count++;
            //        }
            //return $timetables;
        } else {

            $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esedr.is_repeat_approved as subj_approved, esedr.is_attend as subj_attend, esedr.is_absent as exam_absent');
            $this->db->join('exm_semester_exam ese', 'ese.exam_id = esedr.semester_exam_id');
            $this->db->join('stu_reg sr', 'sr.stu_id = esedr.stu_id');
            $this->db->join('cfg_branch cb', 'cb.br_id = sr.center_id');
            $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
            $this->db->join('mod_subject ms', 'ms.id = esedr.subject_id');
            $this->db->join('edu_batch eb', 'eb.id = sr.batch_id');

            $this->db->where('ese.batch_id', $data['batch_id']);
            $this->db->where('sr.center_id', $data['center_id']);
            $this->db->where('ese.course_id', $data['course_id']);
            $this->db->where('ese.year_no', $data['year_no']);
            $this->db->where('ese.semester_no', $data['semester_no']);
            $this->db->where('ese.exam_id', $data['exam_id']);
            $this->db->where('sr.deleted', 0);
            $this->db->where('esedr.is_absent_approve', 1);
            $this->db->where('esedr.is_absent', 1);

            if ($data['subject_id'] != "all") {
                $this->db->where('esedr.subject_id', $data['subject_id']);
            }

            if ($data['is_attend'] != "all") {
                $this->db->where('esedr.is_attend', $data['is_attend']);
            }

            $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

            $timetables = $this->db->get('exm_semester_exam_details_repeat esedr')->result_array();
        }
        return $timetables;
    }

    function load_lecturers_for_center($center_id) {
        $this->db->select('*');
        $this->db->join('com_title tit', 'tit.id=sta.tit_name');
        $this->db->where('sta.center_id', $center_id);

        $sta_list = $this->db->get('sta_lecturer_details sta')->result_array();

        return $sta_list;
    }

    function search_pdf_subject_lookup($data) {

        $this->db->select('*');

        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');

        $this->db->where('sld.center_id', $data['center_id']);
        if ($data['lecturer_id'] != "all")
            $this->db->where('sls.lecturer_id', $data['lecturer_id']);
        $this->db->where('sld.approved', 1);
        $this->db->where('sls.deleted', 0);
        $this->db->group_by('code');


        $subject_result_array = $this->db->get('sta_lecturer_subject sls')->result_array();

        return $subject_result_array;
    }

    function load_subject_pdf($data) {
        $this->db->select('*');

        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = sld.center_id');

        $this->db->where('sld.center_id', $data['center_id']);
        if ($data['lecturer_id'] != "all")
            $this->db->where('sls.lecturer_id', $data['lecturer_id']);
        $this->db->where('sld.approved', 1);
        $this->db->where('sls.deleted', 0);
        $this->db->group_by('code');
        $this->db->order_by('stf_fname', "asc");


        $subject_result_array = $this->db->get('sta_lecturer_subject sls')->result_array();

        return $subject_result_array;
    }

    //............................student_transfer..............................

    function load_transfer_pdf($data) {
        $this->db->select('rg.first_name,st.old_reg_no,st.new_reg_no,cb.br_name as new_center,ob.br_name as old_center');

        $this->db->join('stu_reg rg', 'rg.stu_id = st.stu_id');
        //$this->db->join('stu_transfer st', 'st.stu_transfer_id = srs.transfer_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = st.new_center_id');
        $this->db->join('cfg_branch ob', 'ob.br_id = st.old_center_id');
        $this->db->where('st.new_center_id', $data['tr_center_id']);
//        if ($data['center_id'] != "all")
//            $this->db->where('sls.lecturer_id', $data['lecturer_id']);
//        $this->db->where('st.approved', 1);
//        $this->db->where('st.deleted', 0);
        $this->db->group_by('reg_no');
        $this->db->order_by('first_name', "asc");

        $transfer_result_array = $this->db->get('stu_transfer st')->result_array();

        return $transfer_result_array;
    }

    function search_pdf_transfer_lookup($data) {

        $this->db->select('rg.first_name,st.old_reg_no,st.new_reg_no,cb.br_name as new_center,ob.br_name as old_center');

        $this->db->join('stu_reg rg', 'rg.stu_id = st.stu_id');
        $this->db->join('cfg_branch cb', 'cb.br_id = st.new_center_id');
        $this->db->join('cfg_branch ob', 'ob.br_id = st.old_center_id');
        $this->db->where('st.new_center_id', $data['tr_center_id']);
        $this->db->group_by('reg_no');
        $this->db->order_by('first_name', "asc");

        $transfer_result_array = $this->db->get('stu_transfer st')->result_array();

        return $transfer_result_array;
    }

    function mp_summary_search($data) {

        ///////Registrar pending Queries///////
             
        $this->db->select('cb.br_name, ec.course_code_mahapola,sr.center_id,sr.course_id,COUNT( srm.approved ) as reg_approve'); //COUNT(strm.stu_id) as registrar_pending

        $this->db->join('stu_reg sr', 'srm.stu_id=sr.stu_id');
        $this->db->join('cfg_branch cb', 'sr.center_id=cb.br_id');
        $this->db->join('edu_course ec', 'sr.course_id=ec.id');

        $this->db->where('EXTRACT(YEAR FROM srm.created_date)=' . $data['mp_summary_year']);
        $this->db->where('srm.approved', 0);
//        $this->db->where('strm.director_approved', 0);

        $this->db->group_by('sr.center_id, sr.course_id');
        $this->db->order_by('sr.center_id, sr.course_id');
    

        $mp_summary['registrar'] = $this->db->get('stu_reg_mahapola srm')->result_array();


        ///////Director pending Queries///////

        $this->db->select('cb.br_name, ec.course_code_mahapola,sr.center_id,sr.course_id,COUNT( srm.director_approved ) as director'); //COUNT(strm.stu_id) as registrar_pending

        $this->db->join('stu_reg sr', 'srm.stu_id=sr.stu_id');
        $this->db->join('cfg_branch cb', 'sr.center_id=cb.br_id');
        $this->db->join('edu_course ec', 'sr.course_id=ec.id');

        $this->db->where('EXTRACT(YEAR FROM srm.created_date)=' . $data['mp_summary_year']);
        $this->db->where('srm.approved', 1);
        $this->db->where('srm.director_approved', 0);

        $this->db->group_by('sr.center_id, sr.course_id');
        $this->db->order_by('sr.center_id, sr.course_id');

        $mp_summary['director'] = $this->db->get('stu_reg_mahapola srm')->result_array();


        ///////Eligible Students Queries///////
      
        
        $this->db->select('cb.br_name, ec.course_code_mahapola, sr.center_id, sr.course_id, COUNT( srm.is_eligible ) as eligible'); //COUNT(strm.stu_id) as registrar_pending

        $this->db->join('stu_reg sr', 'srm.stu_id=sr.stu_id');
        $this->db->join('cfg_branch cb', 'sr.center_id=cb.br_id');
        $this->db->join('edu_course ec', 'sr.course_id=ec.id');

        $this->db->where('EXTRACT(YEAR FROM srm.created_date)=' . $data['mp_summary_year']);
        //$this->db->where('strm.approved',1);
        //$this->db->where('strm.director_approved',1);
        $this->db->where('srm.is_eligible', 1);

        $this->db->group_by('sr.center_id, sr.course_id');
        $this->db->order_by('sr.center_id, sr.course_id');

        $mp_summary['eligible'] = $this->db->get('stu_reg_mahapola srm')->result_array();

        
        $sum_year_count;
        $sum_director_count = 0;
        $sum_eligible_count = 0;
        
        $r = 0;
        
       
        
      //  $output = array_merge($mp_summary['registrar'],$mp_summary['director'],$mp_summary['eligible']);
       // print_r($output);
    $output=array();
    
    for($q = 0; $q < count($mp_summary['registrar']); $q++){
            /*$output=array(
                'center'=>$mp_summary['registrar'][$q]['center_id'],
                'course'=>$mp_summary['registrar'][$q]['course_id'],
                'reg_pending'=>$mp_summary['registrar'][$q]['reg_approve']
            );*/
            //$output[$mp_summary['registrar'][$q]['br_name']][$mp_summary['registrar'][$q]['course_code_mahapola']]['reg_pending'];
            //$output[$mp_summary['registrar'][$q]['br_name']][$mp_summary['registrar'][$q]['course_code_mahapola']]['reg_pending']=$mp_summary['registrar'][$q]['reg_approve'];
            
    }
    for($a = 0; $a < count($mp_summary['director']); $a++){
           /* $output=array(
                'center'=>$mp_summary['director'][$a]['center_id'],
                'course'=>$mp_summary['director'][$a]['course_id'],
                'dir_pending'=>$mp_summary['director'][$a]['director']
            );*/
            //$output[$mp_summary['director'][$q]['br_name']][$mp_summary['director'][$q]['course_code_mahapola']]['reg_pending']=$mp_summary['director'][$q]['director'];
          
            
    }
    for($w = 0; $w < count($mp_summary['eligible']); $w++){
           /* $output=array(
                'center'=>$mp_summary['eligible'][$w]['center_id'],
                'course'=>$mp_summary['eligible'][$w]['course_id'],
                'eligible_students'=>$mp_summary['eligible'][$w]['eligible']
            );*/
            //$output[$mp_summary['eligible'][$q]['br_name']][$mp_summary['eligible'][$q]['course_code_mahapola']]['reg_pending']=$mp_summary['eligible'][$q]['eligible'];
          
         
         
//            $sum_year_count['center'][$i] = $mp_summary['year_extract'][$i]['branch'];
//            $sum_year_count['course'][$i] =  $mp_summary['year_extract'][$i]['course_code'];
//            $sum_year_count['reg_pending'][$i] = $mp_summary['year_extract'][$i]['registrar_pending'];
//            $sum_year_count['dir_pending'][$i] = $mp_summary['director'][$i]['directer_pending'];
//            $sum_year_count['eligible_students'][$i] = $mp_summary['eligible'][$i]['eligible_students'];
         
        }
        //print_r($mp_summary['registrar']);
       // print_r($mp_summary['director']);
       // print_r($mp_summary['eligible']);
        return $mp_summary;
       // return $mp_summary;
    }

}

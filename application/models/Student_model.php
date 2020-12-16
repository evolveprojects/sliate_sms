<?php

class Student_model extends CI_Model
{

    public function save_students($data)
    {

        $insert_data = array(
            'name' => $data['sname'],
            'full_name' => $data['sfull_name'],
            'civil_status' => $data['scivil_status'],
            'sex' => $data['ssex'],
            'dob' => $data['sdob'],
            'p_birth' => $data['sp_birth'],
            'm_number' => $data['sm_number'],
            'e_mail' => $data['se_mail'],
            'nic_no' => $data['snic_no'],
            'issues_date' => $data['sissues_date'],
            'index_no' => $data['sindex_no'],
            'id_type' => $data['sid_type'],
            'id_no' => $data['sid_no'],
            'citizen' => $data['scitizen'],
            'race' => $data['srace'],
            'religion' => $data['sreligion'],
            'state_citiznship' => $data['sstate_citiznship'],
            'ordination' => $data['sordination'],
            'address' => $data['saddress'],
            'a_distric' => $data['sa_distric'],
            'distric_no' => $data['sdistric_no'],
            'telephone' => $data['stelephone'],
            'r_year' => $data['sr_year'],
            'r_month' => $data['sr_month'],
            'r_date' => $data['sr_date'],
            'n_father' => $data['sn_father'],
            'n_mother' => $data['sn_mother'],
            'n_parent' => $data['sn_parent'],
            'p_address' => $data['sp_address'],
            'tp_no' => $data['stp_no'],
            'm_no' => $data['sm_no'],
            'e_year' => $data['se_year'],
            'e_attems' => $data['se_attems'],
            'e_subject' => $data['se_subject'],
            'e_grade' => $data['se_grade'],
            'e_medium' => $data['se_medium'],
            'z_score' => $data['sz_score'],
            'candidate' => $data['scandidate'],
            'school' => $data['sschool'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d H:i:s", now())
        );

        $update_data = array(
            'name' => $data['sname'],
            'full_name' => $data['sfull_name'],
            'civil_status' => $data['scivil_status'],
            'sex' => $data['ssex'],
            'dob' => $data['sdob'],
            'p_birth' => $data['sp_birth'],
            'm_number' => $data['sm_number'],
            'e_mail' => $data['se_mail'],
            'nic_no' => $data['snic_no'],
            'issues_date' => $data['sissues_date'],
            'index_no' => $data['sindex_no'],
            'id_type' => $data['sid_type'],
            'id_no' => $data['sid_no'],
            'citizen' => $data['scitizen'],
            'race' => $data['srace'],
            'religion' => $data['sreligion'],
            'state_citiznship' => $data['sstate_citiznship'],
            'ordination' => $data['sordination'],
            'address' => $data['saddress'],
            'a_distric' => $data['sa_distric'],
            'distric_no' => $data['sdistric_no'],
            'telephone' => $data['stelephone'],
            'r_year' => $data['sr_year'],
            'r_month' => $data['sr_month'],
            'r_date' => $data['sr_date'],
            'n_father' => $data['sn_father'],
            'n_mother' => $data['sn_mother'],
            'n_parent' => $data['sn_parent'],
            'p_address' => $data['sp_address'],
            'tp_no' => $data['stp_no'],
            'm_no' => $data['sm_no'],
            'e_year' => $data['se_year'],
            'e_attems' => $data['se_attems'],
            'e_subject' => $data['se_subject'],
            'e_grade' => $data['se_grade'],
            'e_medium' => $data['se_medium'],
            'z_score' => $data['sz_score'],
            'candidate' => $data['scandidate'],
            'school' => $data['sschool'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d H:i:s", now())
        );

        if (empty($data['student_id'])) {
            $result = $this->db->insert('student', $insert_data);
        } else {
            $this->db->where('stu_id', $data['student_id']);
            $result = $this->db->update('stu_reg', $update_data);
        }

        return $result;
    }

    function edit_student($student_id)
    {

        $this->db->select('*');
        $this->db->where('stu_id', $student_id);
        $edit_stu = $this->db->get('stu_reg')->result_array();

        return $edit_stu;
    }

    function get_all_students()
    {
        $branchlist = $this->auth->get_accessbranch();
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('reg.*,SUBSTRING_INDEX(reg_no, "/", -1) as regno_order,de.course_code, de.course_name');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        //$this->db->where_in('reg.center_id', $branchlist);
        //$this->db->where_in('de.faculty_id', $faclist);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.deleted', 0);
        $this->db->order_by("reg.center_id", 'ASC');
        $this->db->order_by("reg.course_id", 'ASC');
        $this->db->order_by("CAST(regno_order as SIGNED INTEGER)", 'ASC');
        $result_array = $this->db->get('stu_reg reg')->result_array();
        //var_dump($result_array);
        return $result_array;
    }

    function get_center_students()
    {
        //$branchlist = $this->auth->get_accessbranch();
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        //get the user branch 
        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('reg.*,SUBSTRING_INDEX(reg_no, "/", -1) as regno_order,de.course_code, de.course_name');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        //$this->db->where_in('reg.center_id', $branchlist);
        //$this->db->where_in('de.faculty_id', $faclist);

        $this->db->where('reg.center_id', $user_branch);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.deleted', 0);
        $this->db->order_by("reg.center_id", 'ASC');
        $this->db->order_by("reg.course_id", 'ASC');
        $this->db->order_by("CAST(regno_order as SIGNED INTEGER)", 'ASC');

        $result_array = $this->db->get('stu_reg reg')->result_array();
        return $result_array;
    }

    function get_student()
    {
        //$branchlist = $this->auth->get_accessbranch();
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        //get the user branch 
        $user_branch = $this->session->userdata('user_branch');
        $user_ref_id = $this->session->userdata('user_ref_id');
        $this->db->select('cb.*,reg.*,de.course_code, de.course_name');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=reg.center_id');
        //$this->db->where_in('reg.center_id', $branchlist);
        //$this->db->where_in('de.faculty_id', $faclist);
        $this->db->where('reg.center_id', $user_branch);
        $this->db->where('reg.stu_id', $user_ref_id);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.deleted', 0);
        $result_array = $this->db->get('stu_reg reg')->result_array();
        return $result_array;
    }

    function get_mahapola_student()
    {
        //$branchlist = $this->auth->get_accessbranch();
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        //get the user branch 
        $user_branch = $this->session->userdata('user_branch');
        $user_ref_id = $this->session->userdata('user_ref_id');
        $this->db->select('reg.*,de.course_code, de.course_name');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id=reg.stu_id');
        //$this->db->where_in('reg.center_id', $branchlist);
        //$this->db->where_in('de.faculty_id', $faclist);
        $this->db->where('reg.center_id', $user_branch);
        $this->db->where('reg.stu_id', $user_ref_id);
        $this->db->where('srm.approved', 1);
        $this->db->where('reg.apply_mahapola', 1);
        $result_array = $this->db->get('stu_reg reg')->result_array();
        return $result_array;
    }

    function load_student_reg_range()
    {

        $this->db->select('RANGE_VALUES');
        $this->db->where('HGC_SEQ_Name', 'REG_RANGE');
        $result_array = $this->db->get('oth_sequence')->result_array();
        return $result_array;
    }

    function view_stu_prof($student_id)
    {

        $this->db->select('reg.*,r.rel_name,ss.stream_name, cas1.subject_name as al_sub1, cas2.subject_name as al_sub2,'
            . 'cas3.subject_name as al_sub3,cas4.subject_name as al_sub4, g1.grade as al_grade1,g2.grade as al_grade2,'
            . ' g3.grade as al_grade3,g4.grade as al_grade4,og1.grade as maths_grade, og2.grade as eng_grade, dis.district');

        $this->db->join('com_religion r', 'r.rel_id = reg.religion', 'left');
        $this->db->join('com_al_subject_stream ss', 'ss.stream_id = reg.al_stream', 'left');

        $this->db->join('com_al_subject cas1', 'cas1.subject_id= reg.al_subject1', 'left');
        $this->db->join('com_al_subject cas2', 'cas2.subject_id = reg.al_subject2', 'left');
        $this->db->join('com_al_subject cas3', 'cas3.subject_id = reg.al_subject3', 'left');
        $this->db->join('com_al_subject cas4', 'cas4.subject_id = reg.al_subject4', 'left');

        $this->db->join('com_al_subject_grade g1', 'g1.grade_id = reg.al_subject1_grade', 'left');
        $this->db->join('com_al_subject_grade g2', 'g2.grade_id = reg.al_subject2_grade', 'left');
        $this->db->join('com_al_subject_grade g3', 'g3.grade_id = reg.al_subject3_grade', 'left');
        $this->db->join('com_al_subject_grade g4', 'g4.grade_id = reg.al_subject4_grade', 'left');

        $this->db->join('com_al_subject_grade og1', 'og1.grade_id = reg.ol_maths_grade', 'left');
        $this->db->join('com_al_subject_grade og2', 'og2.grade_id = reg.ol_english_grade', 'left');

        $this->db->join('cfg_district dis', 'dis.code = reg.district');


        $this->db->where('reg.stu_id', $student_id);
        $stu_prof = $this->db->get('stu_reg reg')->row_array();

        return $stu_prof;
    }

    function update_student_status($data)
    {
        $this->db->trans_begin();
        $update_data = array(
            'deleted' => $data['new_status'],
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d H:i:s", now())
        );
        $this->db->where('stu_id', $data['student_id']);
        $this->db->update('stu_reg', $update_data);

        $this->db->where('user_ref_id', $data['student_id']);
        $result = $this->db->update('ath_user', array('user_status' => "D"));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($data['new_status']) {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Deactivate Student. Retry.';
                $this->logger->systemlog('Student Status', 'Success', 'Failed to Deactivate Student.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Activate Student. Retry.';
                $this->logger->systemlog('Student Status', 'Success', 'Failed to Activate Student.', date("Y-m-d H:i:s", now()), $data);
            }
        } else {
            $this->db->trans_commit();
            if ($data['new_status']) {
                $res['status'] = 'success';
                $res['message'] = 'Student Deactivated Successfully';
                $this->logger->systemlog('Student Status', 'Success', 'Student Deactivated Successfully.', date("Y-m-d H:i:s", now()), $data);

            } else {
                $res['status'] = 'success';
                $res['message'] = 'Student Activated Successfully';
                $this->logger->systemlog('Student Status', 'Success', 'Student Activated Successfully.', date("Y-m-d H:i:s", now()), $data);

            }
        }
        return $res;
    }

    function get_students_by_batch($batch_id, $branch, $year, $semester, $status)
    {
        $this->db->select('stu_reg.*, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1) as regno_order');
        $this->db->join('edu_course de', 'de.id=stu_reg.course_id');
        $this->db->where('stu_reg.batch_id', $batch_id);
        $this->db->where('stu_reg.center_id', $branch);
        $this->db->where('stu_reg.current_year', $year);
        $this->db->where('stu_reg.current_semester', $semester);
        $this->db->where('stu_reg.deleted', 0);
        $this->db->where('stu_reg.approved', 1);
        if ($status == 0) {
            $this->db->where("NOT(EXISTS(select student_id from stu_subject where student_id = stu_reg.stu_id and year_no = $year and semester_no = $semester))");
        }
        //$this->db->where('de.faculty_id', $faculty);
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg')->result_array();
        return $result_array;
    }

    function get_students_by_batch_student_id($stu_id, $batch_id, $branch, $year, $semester, $status)
    {

        $this->db->select('stu_reg.*');
        $this->db->join('edu_course de', 'de.id=stu_reg.course_id');
        $this->db->where('stu_reg.batch_id', $batch_id);
        $this->db->where('stu_reg.center_id', $branch);
        $this->db->where('stu_reg.current_year', $year);
        $this->db->where('stu_reg.current_semester', $semester);
        $this->db->where('stu_reg.deleted', 0);
        $this->db->where('stu_reg.approved', 1);
        $this->db->where('stu_reg.stu_id', $stu_id);
        if ($status == 0) {
            $this->db->where("NOT(EXISTS(select student_id from stu_subject where student_id = stu_reg.stu_id and year_no = $year and semester_no = $semester))");
        }
        //$this->db->where('de.faculty_id', $faculty);
        $result_array = $this->db->get('stu_reg')->result_array();
        return $result_array;
    }

    function get_semester_subjects($data)
    {
        $this->db->select('*');

        $this->db->join('mod_subject_group_subject cgc', 'cgc.subject_id=cu.id');
        $this->db->join('mod_subject_group cg', 'cgc.subject_group_id=cg.id');
        $this->db->join('mod_semester_subject src', 'src.subject_group_id=cg.id');

        $this->db->join('edu_semester se', 'se.id = src.semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course de', 'de.id=yr.course_id');

        $this->db->where('de.id', $data['course_id']);
        $this->db->where('src.semester_no', $data['semester_no']);
        $this->db->where('src.batch_id', $data['batch_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('src.deleted', 0);
        $this->db->where('cgc.deleted', 0);
        $this->db->where('cu.deleted', 0);
        $result_array = $this->db->get('mod_subject cu')->result_array();
        return $result_array;
    }

    function save_student_subjects($data)
    {
        $this->db->trans_begin();

        $exist_id = $this->exist_student_subject_record($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
        $current_data = $this->current_student_data($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
        if ($current_data) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        if ($exist_id != NULL) {
            if($data['ug_level'] == 5){
                //update other all is_active to 0
                $this->update_stu_subject_active_flag($data['student_id']);
                //update
                $update_stu_cou = array(
                    'student_id' => $data['student_id'],
                    'course_id' => $data['course_id'],
                    'batch_id' => $data['batch_id'],
                    'year_no' => $data['year_no'],
                    'semester_no' => $data['semester_no'],
                    'is_active' => $is_active,
                    'is_approved' => 0,
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d H:i:s", now())
                );
                $this->db->where('id', $exist_id);
                $result1 = $this->db->update('stu_subject', $update_stu_cou);

                //update delete flag to 1 for all subject data and add new records
                //update
                $core_subjects = $this->student_subjects_by_type($exist_id, 1);
                for ($i = 0; $i < count($core_subjects); $i++) {
                    $update_core_subjects = array(
                        'deleted' => 1,
                        'deleted_by' => $this->session->userdata('u_id'),
                        'deleted_on' => date("Y-m-d H:i:s", now())
                    );

                    $this->db->where('id', $core_subjects[$i]['stu_f_id']);
                    $result1 = $this->db->update('stu_follow_subject', $update_core_subjects);
                }

                $elective_subjects = $this->student_subjects_by_type($exist_id, 2);
                for ($i = 0; $i < count($elective_subjects); $i++) {
                    $update_elective_subjects = array(
                        'deleted' => 1,
                        'deleted_by' => $this->session->userdata('u_id'),
                        'deleted_on' => date("Y-m-d H:i:s", now())
                    );
                    $this->db->where('id', $elective_subjects[$i]['stu_f_id']);
                    $result1 = $this->db->update('stu_follow_subject', $update_elective_subjects);
                }
                //insert
                if (!empty($data['core_subjects'])) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $exist_id,
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
                if (!empty($data['elective_subjects'])) {
                    for ($j = 0; $j < count($data['elective_subjects']); $j++) {
                        $insert_elective_subjects = array(
                            'student_subject_id' => $exist_id,
                            'subject_id' => $data['elective_subjects'][$j],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['e_subject_version'][$j],
                            'subj_group' => $data['subj_group']
                        );
                        //insert elective subjects
                        $result3 = $this->db->insert('stu_follow_subject', $insert_elective_subjects);
                    }
                }
            }
            else{
                $update_stu_cou_status = array(
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d H:i:s", now())
                );
                $this->db->where('id', $exist_id);
                $result4 = $this->db->update('stu_subject', $update_stu_cou_status);
            }
        } else {
            //insert 
            $insert_stu_cou = array(
                'student_id' => $data['student_id'],
                'course_id' => $data['course_id'],
                'batch_id' => $data['batch_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'is_active' => $is_active,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d H:i:s", now())
            );
            $result1 = $this->db->insert('stu_subject', $insert_stu_cou);
            $max_stu_co_id = $this->max_stu_subject_id();
            if (!empty($data['core_subjects'])) {
                if (count($data['core_subjects']) > 0) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
            }
            if (!empty($data['elective_subjects'])) {
                if (count($data['elective_subjects']) > 0) {
                    for ($j = 0; $j < count($data['elective_subjects']); $j++) {
                        $insert_elective_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $data['elective_subjects'][$j],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['e_subject_version'][$j],
                            'subj_group' => $data['subj_group']
                        );
                        //insert elective subjects
                        $result3 = $this->db->insert('stu_follow_subject', $insert_elective_subjects);
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save subjects';
            $this->logger->systemlog('Subject Selection', 'Failure', 'Failed to save subjects', date("Y-m-d H:i:s", now()),$data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Subjects saved successfully.';
            $this->logger->systemlog('Subject Selection', 'Success', 'Subjects saved successfully.', date("Y-m-d H:i:s", now()),$data);

        }
        return $res;
    }
    
    function save_bulk_student_subjects($data)
    {
        $this->db->trans_begin();

        $exist_id = $this->exist_student_subject_record($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
        $current_data = $this->current_student_data($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
        if ($current_data) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        if ($exist_id != NULL) {
            if($data['ug_level'] == 5){
                //update other all is_active to 0
                $this->update_stu_subject_active_flag($data['student_id']);
                //update
                $update_stu_cou = array(
                    'student_id' => $data['student_id'],
                    'course_id' => $data['course_id'],
                    'batch_id' => $data['batch_id'],
                    'year_no' => $data['year_no'],
                    'semester_no' => $data['semester_no'],
                    'is_active' => $is_active,
                    'is_approved' => 0,
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d H:i:s", now())
                );
                $this->db->where('id', $exist_id);
                $result1 = $this->db->update('stu_subject', $update_stu_cou);

                //update delete flag to 1 for all subject data and add new records
                //update
                $core_subjects = $this->student_subjects_by_type($exist_id, 1);
                for ($i = 0; $i < count($core_subjects); $i++) {
                    $update_core_subjects = array(
                        'deleted' => 1,
                        'deleted_by' => $this->session->userdata('u_id'),
                        'deleted_on' => date("Y-m-d H:i:s", now())
                    );

                    $this->db->where('id', $core_subjects[$i]['stu_f_id']);
                    $result1 = $this->db->update('stu_follow_subject', $update_core_subjects);
                }

                $elective_subjects = $this->student_subjects_by_type($exist_id, 2);
                for ($i = 0; $i < count($elective_subjects); $i++) {
                    $update_elective_subjects = array(
                        'deleted' => 1,
                        'deleted_by' => $this->session->userdata('u_id'),
                        'deleted_on' => date("Y-m-d H:i:s", now())
                    );
                    $this->db->where('id', $elective_subjects[$i]['stu_f_id']);
                    $result1 = $this->db->update('stu_follow_subject', $update_elective_subjects);
                }
                //insert
                if (!empty($data['core_subjects'])) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $exist_id,
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
                if (!empty($data['elective_subjects'])) {
                    for ($j = 0; $j < count($data['elective_subjects']); $j++) {
                        $insert_elective_subjects = array(
                            'student_subject_id' => $exist_id,
                            'subject_id' => $data['elective_subjects'][$j],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['e_subject_version'][$j],
                            'subj_group' => $data['subj_group']
                        );
                        //insert elective subjects
                        $result3 = $this->db->insert('stu_follow_subject', $insert_elective_subjects);
                    }
                }
            }
            else{
                $update_stu_cou_status = array(
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d H:i:s", now())
                );
                $this->db->where('id', $exist_id);
                $result4 = $this->db->update('stu_subject', $update_stu_cou_status);
            }
        } else {
            //insert 
            $insert_stu_cou = array(
                'student_id' => $data['student_id'],
                'course_id' => $data['course_id'],
                'batch_id' => $data['batch_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'is_active' => $is_active,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d H:i:s", now())
            );
            $result1 = $this->db->insert('stu_subject', $insert_stu_cou);
            $max_stu_co_id = $this->max_stu_subject_id();
            if (!empty($data['core_subjects'])) {
                if (count($data['core_subjects']) > 0) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
            }
            if (!empty($data['elective_subjects'])) {
                if (count($data['elective_subjects']) > 0) {
                    for ($j = 0; $j < count($data['elective_subjects']); $j++) {
                        $insert_elective_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $data['elective_subjects'][$j],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['e_subject_version'][$j],
                            'subj_group' => $data['subj_group']
                        );
                        //insert elective subjects
                        $result3 = $this->db->insert('stu_follow_subject', $insert_elective_subjects);
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save subjects';
            $this->logger->systemlog('Subject Selection', 'Failure', 'Failed to save subjects', date("Y-m-d H:i:s", now()),$data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Subjects saved successfully.';
            $this->logger->systemlog('Subject Selection', 'Success', 'Subjects saved successfully.', date("Y-m-d H:i:s", now()),$data);

        }
        return $res;
    }

    function update_stu_subject_active_flag($student_id)
    {
        $update_data = array('is_active' => 0);
        $this->db->where('stu_subject.student_id', $student_id);
        $result = $this->db->update('stu_subject', $update_data);

        return $result;
    }

    function current_student_data($stu_id, $course_id, $batch_id, $year_no, $semester_no)
    {
        $this->db->select('*');
        $this->db->where('stu.stu_id', $stu_id);
        $this->db->where('stu.course_id', $course_id);
        $this->db->where('stu.batch_id', $batch_id);
        $this->db->where('stu.current_year', $year_no);
        $this->db->where('stu.current_semester', $semester_no);

        $result = $this->db->get('stu_reg stu')->result_array();
        if (!empty($result)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function max_stu_subject_id()
    {
        $this->db->select('max(id)');
        $result = $this->db->get('stu_subject')->result_array();
        if ($result) {
            foreach ($result as $row) {
                return $row['max(id)'];
            }
        } else {
            return 0;
        }
    }

    function exist_student_subject_record($student_id, $course_id, $batch_id, $year_no, $semester_no)
    {
        $where_array = array(
            'student_id' => $student_id,
            'course_id' => $course_id,
            'batch_id' => $batch_id,
            'year_no' => $year_no,
            'semester_no' => $semester_no
        );
        $this->db->select('id');
        $this->db->where($where_array);
        $result = $this->db->get('stu_subject')->row_array();

        if ($result) {
            return $result['id'];
        } else {
            return NULL;
        }
    }

    function student_subjects_by_type($stu_co_id, $type)
    {
        $this->db->select('sfc.id as stu_f_id');
        $this->db->join('stu_subject sc', 'sc.id=sfc.student_subject_id');
        $this->db->join('mod_subject co', 'co.id=sfc.subject_id');
        $this->db->where('sc.id', $stu_co_id);
        $this->db->where('co.type', $type);
        $result = $this->db->get('stu_follow_subject sfc')->result_array();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    function filter_students_subject_selection($data)
    {
        $this->db->select('*,sc.deleted as stu_c_deleted, sc.id as stu_co_id');
        $this->db->join('stu_reg reg', 'sc.student_id=reg.stu_id');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->where('reg.center_id', $data['center_id']);
        $this->db->where('sc.course_id', $data['course_id']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sc.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.is_approved', 1);
        $this->db->where('reg.deleted', 0);
        $result_array = $this->db->get('stu_subject sc')->result_array();

        return $result_array;
    }

    function filter_students_subject_selection_student_id($data)
    {
        $this->db->select('*,sc.deleted as stu_c_deleted, sc.id as stu_co_id');
        $this->db->join('stu_reg reg', 'sc.student_id=reg.stu_id');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->where('reg.center_id', $data['center_id']);
        $this->db->where('sc.course_id', $data['course_id']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('sc.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.is_approved', 1);
        $this->db->where('reg.deleted', 0);
        $this->db->where('reg.stu_id', $data['stu_id']);
        $result_array = $this->db->get('stu_subject sc')->result_array();

        return $result_array;
    }

    function filter_students_batch_lookup($data)
    {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

        $this->db->select('*, stu.deleted as stu_deleted');
        $this->db->join('edu_course de', 'de.id=stu.course_id');
        $this->db->where('stu.course_id', $data['course_id']);
        $this->db->where('stu.batch_id', $data['batch_id']);
        $this->db->where('stu.current_year', $data['year_no']);
        $this->db->where('stu.current_semester', $data['semester_no']);
        $this->db->where_in('stu.center_id', $branchlist);
        $this->db->where_in('de.faculty_id', $faclist);

        $result_array = $this->db->get('stu_reg stu')->result_array();

        return $result_array;
    }

    function update_student_subject_status($data)
    {
        $this->db->trans_begin();
        if ($data['new_status'] == 0) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d H:i:s", now())
            );
        }

        $this->db->where('id', $data['stu_co_id']);
        $this->db->update('stu_subject', $update_data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($data['new_status']) {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Deactivate student subject. Retry.';
            } else {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Activate student subject. Retry.';
            }
        } else {
            $this->db->trans_commit();
            if ($data['new_status']) {
                $res['status'] = 'success';
                $res['message'] = 'Student Subject Deactivated Successfully';
            } else {
                $res['status'] = 'success';
                $res['message'] = 'Student Subject Activated Successfully';
            }
        }
        return $res;
    }

    function get_student_subject_list($stu_co_id)
    {
        $this->db->select('*');
        $this->db->join('stu_follow_subject sfc', 'sfc.student_subject_id=sc.id');
        $this->db->join('mod_subject co', 'co.id=sfc.subject_id');
        $this->db->where('sfc.student_subject_id', $stu_co_id);
        $this->db->where('sfc.deleted', 0);
        $this->db->where('sc.deleted', 0);
        $this->db->where('co.deleted', 0);
        $result_array = $this->db->get('stu_subject sc')->result_array();

        return $result_array;
    }

    function students_without_subject($data)
    {
        $selected_array = $this->filter_students_subject_selection($data);
//        print_r($selected_array);
        $this->db->select('*');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->where('reg.center_id', $data['center_id']);
        $this->db->where('reg.course_id', $data['course_id']);
        //$this->db->where('de.faculty_id', $data['faculty_id']);
        $this->db->where('reg.batch_id', $data['batch_id']);
        $this->db->where('reg.current_year', $data['year_no']);
        $this->db->where('reg.current_semester', $data['semester_no']);
        $this->db->where('reg.deleted', 0);
        $this->db->where('reg.approved', 1);
        $result_array = $this->db->get('stu_reg reg')->result_array();
//        print_r($result_array);
        $final_array = array_values(array_diff_key(array_column($result_array, NULL, 'stu_id'), array_column($selected_array, NULL, 'stu_id')));
//print_r($final_array);
        return $final_array;
    }

    function students_without_subject_student_id($data)
    {
        $selected_array = $this->filter_students_subject_selection($data);
//        print_r($selected_array);
        $this->db->select('*');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        $this->db->where('reg.center_id', $data['center_id']);
        $this->db->where('reg.course_id', $data['course_id']);
        //$this->db->where('de.faculty_id', $data['faculty_id']);
        $this->db->where('reg.batch_id', $data['batch_id']);
        $this->db->where('reg.current_year', $data['year_no']);
        $this->db->where('reg.current_semester', $data['semester_no']);
        $this->db->where('reg.deleted', 0);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.stu_id', $data['stu_id']);
        $result_array = $this->db->get('stu_reg reg')->result_array();
//        print_r($result_array);
        $final_array = array_values(array_diff_key(array_column($result_array, NULL, 'stu_id'), array_column($selected_array, NULL, 'stu_id')));
//print_r($final_array);
        return $final_array;
    }

    function get_current_subjects($stu_id)
    {
        $this->db->select('*');
        $this->db->join('stu_follow_subject sfc', 'sfc.student_subject_id=sc.id');
        $this->db->join('mod_subject co', 'co.id=sfc.subject_id');
        $this->db->where('sc.student_id', $stu_id);
        $this->db->where('sc.is_active', 1);
        $result_array = $this->db->get('stu_subject sc')->result_array();

        return $result_array;
    }

    function load_times_slots()
    {
        $date = $this->input->post('date');
        $hall = $this->input->post('hall');
        $branch = $this->input->post('branch');
        $faculty = $this->input->post('faculty');

        $this->db->select('tta_assign.ttas_timetable');
        $this->db->join('tta_timetable', 'tta_timetable.ttbl_id=tta_assign.ttas_timetable');
        $this->db->where('tta_assign.ttas_startdate <=', $date);
        $this->db->where('tta_assign.ttas_enddate >=', $date);
        $this->db->where('tta_assign.ttas_branch', $branch);
        $this->db->where('tta_timetable.ttbl_faculty', $faculty);
        $assignedtbls = $this->db->get('tta_assign')->result_array();

        $tblsary = array();
        foreach ($assignedtbls as $tbl) {
            array_push($tblsary, $tbl['ttas_timetable']);
        }

        $day = date('w', strtotime($date));
        $weekdary = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');

        $this->db->select('tta_lecture.*,mod_subject.code,mod_subject.subject,sta_lecturer_details.stf_fname,sta_lecturer_details.stf_lname,tta_timetable.ttbl_code');
        $this->db->join('mod_subject', 'mod_subject.id=tta_lecture.ttlc_subject');
        $this->db->join('sta_lecturer_details', 'sta_lecturer_details.stf_id=tta_lecture.ttlc_lecturer');
        $this->db->join('tta_timetable', 'tta_timetable.ttbl_id=tta_lecture.ttlc_timetable');
        $this->db->where_in('tta_lecture.ttlc_timetable', $tblsary);
        $this->db->where('tta_lecture.ttlc_hall', $hall);
        $this->db->where('tta_lecture.ttlc_weekday', $weekdary[$day]);
        $this->db->where('tta_lecture.ttlc_status', 'A');
        $this->db->group_by(array('tta_lecture.ttlc_starttime', 'tta_lecture.ttlc_endtime', 'tta_lecture.ttlc_lecturer', 'tta_lecture.ttlc_subject'));
        $timeslots = $this->db->get('tta_lecture')->result_array();

        $x = 0;
        foreach ($timeslots as $slot) {
            $start = date('g:i A', $slot['ttlc_starttime']);
            $end = date('g:i A', $slot['ttlc_endtime']);

            $timeslots[$x]['ttlc_starttimedisplay'] = $start;
            $timeslots[$x]['ttlc_endtimedisplay'] = $end;
            $x++;
        }

        return $timeslots;
    }

    function load_student_list()
    {
        $branch = $this->input->post('branch');
        $date = $this->input->post('date');
        $day = $this->input->post('day');
        $hall = $this->input->post('hall');
        $Sub = $this->input->post('Sub');
        $lec = $this->input->post('lec');
        $stm = $this->input->post('stm');
        $etm = $this->input->post('etm');
        $faculty = $this->input->post('faculty');

        $this->db->select('tta_assign.ttas_timetable');
        $this->db->join('tta_timetable', 'tta_timetable.ttbl_id=tta_assign.ttas_timetable');
        $this->db->where('tta_assign.ttas_startdate <=', $date);
        $this->db->where('tta_assign.ttas_enddate >=', $date);
        $this->db->where('tta_assign.ttas_branch', $branch);
        $this->db->where('tta_timetable.ttbl_faculty', $faculty);
        $assignedtbls = $this->db->get('tta_assign')->result_array();

        $tblsary = array();
        foreach ($assignedtbls as $tbl) {
            array_push($tblsary, $tbl['ttas_timetable']);
        }

        $this->db->where_in('ttlc_timetable', $tblsary);
        $this->db->where('ttlc_hall', $hall);
        $this->db->where('ttlc_weekday', $day);
        $this->db->where('ttlc_subject', $Sub);
        $this->db->where('ttlc_lecturer', $lec);
        $this->db->where('ttlc_starttime', $stm);
        $this->db->where('ttlc_endtime', $etm);
        $this->db->where('ttlc_status', 'A');
        $timeslots = $this->db->get('tta_lecture')->result_array();

        $i = 0;

        foreach ($timeslots as $slot) {
            $this->db->select('tta_timetable.*,edu_course.course_code,edu_course.course_code');
            $this->db->join('edu_course', 'edu_course.id=tta_timetable.ttbl_course');
            $this->db->where('ttbl_id', $slot['ttlc_timetable']);
            $tbldata = $this->db->get('tta_timetable')->row_array();

            $timeslots[$i]['coursedesc'] = '[ ' . $tbldata['ttbl_code'] . ' - ' . $tbldata['course_code'] . ' ] ' . $tbldata['course_code'];

            $this->db->where('course_id', $tbldata['ttbl_course']);
            $this->db->where('year_no', $tbldata['ttbl_year']);
            $this->db->where('semester_no', $tbldata['ttbl_semester']);
            $this->db->where('is_active', 1);
            $crsstud = $this->db->get('stu_subject')->result_array();

            if (!empty($crsstud)) {
                $subjectflwlist = array();

                foreach ($crsstud as $stu) {
                    $this->db->where('subject_id', $Sub);
                    $this->db->where('student_subject_id', $stu['id']);
                    $stusubject = $this->db->get('stu_follow_subject')->row_array();

                    if (!empty($stusubject)) {
                        array_push($subjectflwlist, $stu['id']);
                    }
                }

                $this->db->where('center_id', $branch);
                $this->db->where('course_id', $tbldata['ttbl_course']);
                $this->db->where('current_year', $tbldata['ttbl_year']);
                $this->db->where('current_semester', $tbldata['ttbl_semester']);
                $this->db->where_in('stu_id', $subjectflwlist);
                $student = $this->db->get('stu_reg')->result_array();

                $y = 0;
                foreach ($student as $stu) {

                    $this->db->where('atn_branch', $branch);
                    $this->db->where('atn_date', $date);
                    $this->db->where('atn_subject', $Sub);
                    $this->db->where('atn_starttime', $stm);
                    $this->db->where('atn_endtime', $etm);
                    $atndata = $this->db->get('stu_lecattendance')->row_array();

                    $this->db->where('atnstu_attendanceid', $atndata['atn_id']);
                    $this->db->where('atnstu_student', $stu['stu_id']);
                    $this->db->where('atnstu_isabsent', 1);
                    $this->db->where('atnstu_status', 'A');
                    $atnstu = $this->db->get('stu_lecattendancestudent')->row_array();

                    if (!empty($atnstu)) {
                        $student[$y]['isabsent'] = 1;
                    } else {
                        $student[$y]['isabsent'] = 0;
                    }
                    $y++;
                }

                $timeslots[$i]['students'] = $student;
            } else {
                $timeslots[$i]['students'] = array();
            }

            $i++;
        }

        return $timeslots;

        // $this->db->where('ttlc_id',$slotid);
        // $timeslot   = $this->db->get('tta_lecture')->row_array();
        // $this->db->where('ttbl_id',$timeslot['ttlc_timetable']);
        // $timetable  = $this->db->get('tta_timetable')->row_array();
        // $this->db
        // $this->db->select('hci_classstudent.*,st_details.st_id,st_details.family_name,st_details.other_names');
        // $this->db->join('st_details','st_details.id=hci_classstudent.clsstu_student');
        // $this->db->where('hci_classstudent.clsstu_ayear',$acyear);
        // $this->db->where('hci_classstudent.clsstu_grade',$grade);
        // $this->db->where('hci_classstudent.clsstu_class',$clss);
        // $this->db->where('hci_classstudent.clsstu_branch',$branch);
        // $this->db->where('hci_classstudent.clsstu_status','A');
        // $stulist = $this->db->get('hci_classstudent')->result_array();
        // $x = 0;
        // foreach ($stulist as $stu) 
        // {
        //     $this->db->where('ssatn_ayear',$acyear);
        //     $this->db->where('ssatn_grade',$grade);
        //     $this->db->where('ssatn_class',$clss);
        //     $this->db->where('ssatn_date',$date);
        //     $this->db->where('ssatn_student',$stu['clsstu_student']);
        //     $attendance = $this->db->get('hci_schoolattendance')->row_array();
        //     if(empty($attendance))
        //     {
        //         $stulist[$x]['ispresent'] = 0;
        //     }
        //     else
        //     {
        //         if($attendance['ssatn_ispresent']==1)
        //         {
        //             $stulist[$x]['ispresent'] = 1;
        //         }
        //         else
        //         {
        //             $stulist[$x]['ispresent'] = 0;
        //         }
        //     }
        //     $x++;
        // }
        //return $stulist;
    }

    function load_remove_student_list()
    {

        $this->db->select('sr.reg_no,sr.stu_id,sr.first_name,sr.last_name,sr.nic_no,ec.course_code,eb.batch_code');
        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('edu_batch eb', 'eb.id=sr.batch_id');
        $this->db->where('sr.deleted', 1);
        $_remove_student_list = $this->db->get('stu_reg sr')->result_array();
        return $_remove_student_list;
    }

    function update_attendance()
    {
        $branch = $this->input->post('atn_branch');
        $date = $this->input->post('atn_date');
        $subject = $this->input->post('atn_subject');
        $absstudents = $this->input->post('stuchk');
        $students = $this->input->post('atnstudent');
        $stm = $this->input->post('atn_stime');
        $etm = $this->input->post('atn_etime');

        $this->db->trans_begin();

        if (!empty($students)) {

            $this->db->where('atn_starttime', strtotime($stm));
            $this->db->where('atn_endtime', strtotime($etm));
            $this->db->where('atn_branch', $branch);
            $this->db->where('atn_date', $date);
            $this->db->where('atn_subject', $subject);
            $atndata = $this->db->get('stu_lecattendance')->row_array();

            if (empty($atndata)) {

                $atnsave['atn_branch'] = $branch;
                $atnsave['atn_date'] = $date;
                $atnsave['atn_subject'] = $subject;
                $atnsave['atn_starttime'] = $stm;
                $atnsave['atn_endtime'] = $etm;
                $this->db->insert('stu_lecattendance', $atnsave);
                $atn_id = $this->db->insert_id();

            } else {
                $atn_id = $atndata['atn_id'];
            }

            $this->db->where('atnstu_attendanceid', $atn_id);
            $this->db->update('stu_lecattendancestudent', array('atnstu_isabsent' => 'D'));

            foreach ($students as $stu) {

                $this->db->where('atnstu_attendanceid', $atn_id);
                $this->db->where('atnstu_student', $stu);
                $atnstu = $this->db->get('stu_lecattendancestudent')->row_array();

                $atnsvdata['atnstu_remarks'] = $this->input->post('remarks_' + $stu);

                if (in_array($stu, $absstudents)) {
                    $atnsvdata['atnstu_isabsent'] = 1;
                } else {
                    $atnsvdata['atnstu_isabsent'] = 0;
                }

                if (empty($atnstu)) {
                    $atnsvdata['atnstu_attendanceid'] = $atn_id;
                    $atnsvdata['atnstu_status'] = 'A';
                    $atnsvdata['atnstu_student'] = $stu;

                    $this->db->insert('stu_lecattendancestudent', $atnsvdata);
                } else {
                    $this->db->where('atnstu_attendanceid', $atn_id);
                    $this->db->where('atnstu_student', $stu);
                    $this->db->update('stu_lecattendancestudent', $atnsvdata);
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save attendance';
            $this->logger->systemlog('Update Attendance', 'Failure', 'Failed to Update Attendance', date("Y-m-d H:i:s", now()));
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Attendance saved successfully.';
            $this->logger->systemlog('Update Attendance', 'Success', 'Attendance Updated Successfully', date("Y-m-d H:i:s", now()));
        }
        return $res;
    }

    function students_for_apply_exam($data, $batch_details)
    {

        $this->db->select('*,stu.deleted as stu_deleted');

        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
//        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
//        $this->db->join('mod_subject co', 'co.id = fc.subject_id');
        $this->db->where('sc.course_id', $batch_details['course_id']);
        $this->db->where('sc.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
//        $this->db->where('sc.batch_id', $data['batch_id']);
//        $this->db->where('stu.current_year', $data['current_year']);
//        $this->db->where('stu.current_semester', $data['batch_id']);
        $this->db->where('stu.deleted', 0);
        $this->db->where('stu.approved', 1);
        $this->db->where('sc.is_approved', 1);

        $this->db->where('stu.batch_id', $data['batch_id']);
        $this->db->where('stu.center_id', $data['branch']);
        if ($data['access_level'] == 5)
            $this->db->where('stu.stu_id', $data['stu_id']);
        //and stu.stu_id=118
        $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = stu.stu_id AND semester_exam_id = '. $data['sem_exam_id'] .'))');
        $result_array = $this->db->get('stu_reg stu')->result_array();

        // if($status == 0){

        // }


        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('fc.deleted', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }
        return $result_array;
    }

    function applied_exam_students($data, $batch_details)
    {

        $this->db->select('*,stu.deleted as stu_deleted, SUBSTRING_INDEX(stu.reg_no, "/", -1) as regno_order');

        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
        $this->db->join('exm_semester_exam_details esxd', 'esxd.student_id = stu.stu_id');
//        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
        $this->db->join('mod_subject co', 'co.id = esxd.subject_id');
        $this->db->where('sc.course_id', $batch_details['course_id']);
        $this->db->where('sc.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
        $this->db->where('co.is_training_apply', 0);
//        $this->db->where('sc.batch_id', $data['batch_id']);
//        $this->db->where('stu.current_year', $data['current_year']);
//        $this->db->where('stu.current_semester', $data['batch_id']);
        $this->db->where('stu.deleted', 0);
        $this->db->where('esxd.is_approved', 1);

        $this->db->where('stu.batch_id', $data['batch_id']);
        $this->db->where('stu.center_id', $data['branch']);
        if ($data['access_level'] == 5)
            $this->db->where('stu.stu_id', $data['stu_id']);
        $this->db->group_by('stu.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');//////////Query Change
        //and stu.stu_id=118
        // $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = stu.stu_id))');
        $result_array = $this->db->get('stu_reg stu')->result_array();

        // if($status == 0){

        // }

        $sem_exam_id = $this->get_semetser_exam_id($batch_details['course_id'],$batch_details['current_year'],$batch_details['current_semester'],$data['batch_id']);
        
        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code ,`co`.id as subject_no');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            
            $this->db->join('exm_semester_exam_details exmd', 'co.id = exmd.subject_id');
            
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('fc.deleted', 0);
            
            $this->db->where('exmd.student_id', $result_array[$i]['stu_id']);
            $this->db->where('exmd.semester_exam_id', $sem_exam_id);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('exmd.deleted', 0);
            
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }
        return $result_array;
    }

    function get_semetser_exam_id($course, $year, $semester, $batch_id){
        $this->db->select('*');
        $this->db->where('exme.course_id', $course);
        $this->db->where('exme.year_no', $year);
        $this->db->where('exme.semester_no', $semester);
        $this->db->where('exme.batch_id', $batch_id);
        $result_array = $this->db->get('exm_semester_exam exme')->row_array();
        
        if(!empty($result_array)){
            return $result_array['id'];
        } else {
            return null;
        }
        
    }
    function approved_exam_students($data, $batch_details)
    {

        $this->db->select('*,stu.deleted as stu_deleted');

        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
        $this->db->join('exm_semester_exam_details esxd', 'esxd.student_id = stu.stu_id');
//        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
        $this->db->join('mod_subject co', 'co.id = esxd.subject_id');
        $this->db->where('sc.course_id', $batch_details['course_id']);
        $this->db->where('sc.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
//        $this->db->where('sc.batch_id', $data['batch_id']);
//        $this->db->where('stu.current_year', $data['current_year']);
//        $this->db->where('stu.current_semester', $data['batch_id']);
        $this->db->where('stu.deleted', 0);
        $this->db->where('esxd.is_approved', 0);

        $this->db->where('stu.batch_id', $data['batch_id']);
        $this->db->where('stu.center_id', $data['branch']);
        $this->db->where('co.is_training_apply', 0);
        if ($data['access_level'] == 5)
            $this->db->where('stu.stu_id', $data['stu_id']);
        $this->db->group_by('stu.stu_id');
        $this->db->order_by('stu.reg_no', 'ASC');
        //and stu.stu_id=118
        // $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = stu.stu_id))');
        $result_array = $this->db->get('stu_reg stu')->result_array();

        // if($status == 0){

        // }


        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code ,`co`.id as subject_no');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('fc.deleted', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }
        return $result_array;
    }



//    function load_student_current_subjects($data, $batch_details) {
//
//        $this->db->select('*,co.type as subject_type, co.code as subject_code');
//        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
////        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
////        $this->db->join('edu_year yr', 'yr.id = se.year_id');
//        $this->db->join('mod_subject co', 'co.id = fc.subject_id');
//        $this->db->join('stu_reg st', 'st.stu_id = sc.student_id');
//        $this->db->where('sc.course_id', $batch_details['course_id']);
//        $this->db->where('sc.year_no', $batch_details['current_year']);
//        $this->db->where('sc.semester_no', $batch_details['current_semester']);
//        $this->db->where('sc.batch_id', $data['batch_id']);
//        $this->db->where('sc.student_id', $data['stu_id']);
//        $this->db->order_by("co.type", "asc");
//        $this->db->order_by("co.code", "asc");
//        $result_array = $this->db->get('stu_subject sc')->result_array();
////        print_r($result_array);
//        return $result_array;
//    }

    function apply_for_exam($data, $batch_details)
    {
        $subj_approve = 0;
        $this->db->trans_begin();
        $student_array = array();
        //print_r($data['apply_exam']);
        while (list($key, $val) = each($data['apply_exam'])) {
            $student_array[] = $key;
        }
        $i = 0;
        foreach ($data['apply_exam'] as $row) {
            for ($j = 0; $j < count($row); $j++) {
                $subject_id[$j] = $this->get_subject_id_by_code($row[$j]);

                $insert_array = array(
                    'semester_exam_id' => $data['exam_id'],
                    'student_id' => $student_array[$i],
                    'no_of_attempts' => 0,
                    'subject_id' => $subject_id[$j],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d H:i:s", now())
                );
                $this->db->insert('exm_semester_exam_details', $insert_array);
                
                
                $this->db->select('is_training_apply, id');
                $this->db->where('id', $subject_id[$j]);
                $subject_apply_data = $this->db->get('mod_subject')->row_array();
                
                if(count($subject_apply_data) > 0){
                    if($subject_apply_data['is_training_apply'] == 1){
                    
                        $this->db->where('student_id', $student_array[$i]);
                        $this->db->where('semester_exam_id', $data['exam_id']);
                        $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
                        $stu_prof = $this->db->update('exm_semester_exam_details', array(
                            'is_approved' => 2,
                            'approved_by' => $this->session->userdata('u_id'),
                            'approved_datetime' => date("Y-m-d H:i:s", now())
                        ));
                    }
                }
            }

            $i++;
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            //$res['status'] = 'Failed';
            //$res['message'] = 'Failed to save Subject Group';
            $this->session->set_flashdata('flashError', 'Failed to update request! Retry.');
            $this->logger->systemlog('Apply Exam', 'Failure', 'Failed to apply to exam', date("Y-m-d H:i:s", now()),$data);


        } else {
            $this->db->trans_commit();
            //$res['status'] = 'success';
            //$res['message'] = 'Subject Group saved successfully.';
            $this->session->set_flashdata('flashSuccess', 'student applied for exam successfully !');
            $this->logger->systemlog('Apply Exam', 'Success', 'student applied for exam successfully.', date("Y-m-d H:i:s", now()),$data);

        }
        //return $res;
        //redirect('exam/apply_exam');
    }

    function apply_repeat_exam_request($data, $batch_details)
    {
        $this->db->trans_begin();
        $student_array = array();
        $sem_exam_detail_id = array();
       // print_r($data['rpt_apply_exam_request']);
        while (list($key, $val) = each($data['rpt_apply_exam_request'])) {
            $student_array[] = $key;

           /* $temp[] = $val;
            while (list($key, $val) = each($temp[0])) {
               // $subject_ids[] = $key;
                $sem_exam_detail_id[] = $key;
                $subject_ids[] = $val;
            }*/
        }

       // print_r($student_array);
      //  print_r($sem_exam_detail_id);
      //  print_r($subject_ids);
        $i = 0;
        foreach ($data['rpt_apply_exam_request'] as $row) {
            for ($j = 0; $j < count($row); $j++) {

                $subject_ids=explode("_",$row[$j]);

                $subject_id[$j] = $subject_ids[0];
                $sem_exam_detail_id[$j] = $subject_ids[1];
                $insert_array = array(
                    'stu_id' => $student_array[$i],
                    'exm_semester_exam_details' => $sem_exam_detail_id[$j],
                    'subject_id' => $subject_id[$j],
                    'is_repeat' => 0,
                    'is_repeat_approved' => 0,
                    'applying_batch' => $data['batch_id'],
                    'applying_year' => $data['year_no'],
                    'applying_semester' => $data['semester_no'],
                    'applying_exam' => $data['exam_id'],
                    'repeat_apply_for' => $data['repeat_apply_type'][$subject_id[$j]]
                );
                $this->db->insert('exm_semester_exam_details_repeat', $insert_array);

                $update_sem_detail['is_repeat'] = 1;
                $this->db->where('id', $sem_exam_detail_id[$j]);
                $this->db->update('exm_semester_exam_details', $update_sem_detail);
            }

            $i++;
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            //$res['status'] = 'Failed';
            //$res['message'] = 'Failed to save Subject Group';
            $this->session->set_flashdata('flashError', 'Failed to complete request! Retry.');

        } else {
            $this->db->trans_commit();
            //$res['status'] = 'success';
            //$res['message'] = 'Subject Group saved successfully.';
            $this->session->set_flashdata('flashSuccess', 'Applied for repeat exam successfully!');
        }
        //return $res;
        //redirect('exam/apply_exam');
    }
    
    
    function check_repeat_attempts($data){
//        $this->db->select('*');
//        $this->db->where('code', $subject_code);
//        $this->db->where('deleted', 0);
//        $row_array = $this->db->get('mod_subject sc')->row_array();
        
        
        $student_array = array();

        while (list($key, $val) = each($data['rpt_apply_exam_request'])) {
            $student_array[] = $key;
        }       

        $i = 0;
        foreach ($data['rpt_apply_exam_request'] as $row) {
            for ($j = 0; $j < count($row); $j++) {

                $subject_ids=explode("_",$row[$j]);

                $subject_id[$j] = $subject_ids[0];
                $sem_exam_detail_id[$j] = $subject_ids[1];
                
                $this->db->select('esed.no_of_attempts, ms.code, ms.subject');
                $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
                $this->db->where('esed.id', $sem_exam_detail_id[$j]);
                $this->db->where('esed.student_id', $student_array[$i]);
                $this->db->where('esed.subject_id', $subject_id[$j]);
                $attempt_count = $this->db->get('exm_semester_exam_details esed')->row_array();  
            }

            $i++;
        }
        
        return $attempt_count;
        
        
    }

    function get_subject_id_by_code($subject_code)
    {
        $this->db->select('*');
        $this->db->where('code', $subject_code);
        $this->db->where('deleted', 0);
        $row_array = $this->db->get('mod_subject sc')->row_array();
        if (!empty($row_array)) {

            return $row_array['id'];
        } else {
            return NULL;
        }
    }

    function load_student_for_exam_marks_ca($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order,IFNULL((SELECT count(stu_id) FROM exam_fraud_students WHERE stu_id=sr.stu_id AND course_id =ese.course_id AND year_no=ese.year_no AND semester_no=ese.semester_no AND batch_id=ese.batch_id AND sem_exam_id=ese.exam_id), 0) as fraud_status');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        //$this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
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
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {
               
                // $this->db->select('*,co.code as subject_code');
                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved,em.is_recorrection_approved');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
            }
        }
//        print_r($result_array);
        return $result_array;
    }

    function load_student_for_exam_marks_se($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order,IFNULL((SELECT count(stu_id) FROM exam_fraud_students WHERE stu_id=sr.stu_id AND course_id =ese.course_id AND year_no=ese.year_no AND semester_no=ese.semester_no AND batch_id=ese.batch_id AND sem_exam_id=ese.exam_id), 0) as fraud_status');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
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
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {

                // $this->db->select('*,co.code as subject_code');
                $this->db->select('em.is_ex_director_mark_approved, em.is_recorrection_approved, em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
                
                for ($y = 0; $y < count($result_array[$i]['exam_mark']); $y++) {
                    $data['subject_id'] = $result_array[$i]['exam_mark'][$y]['subject_id'];
                    $result_array[$i]['exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
                }
            }
        }
//        print_r($result_array);
        return $result_array;
    }
    
    
    function load_student_for_exam_marks_training($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 1);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
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
            $this->db->where('co.is_training_apply', 1);
            $this->db->where('se.deleted', 0);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {

                $this->db->select('em.is_ex_director_mark_approved, em.is_recorrection_approved, em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved,em.result');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 1);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
                
//                for ($y = 0; $y < count($result_array[$i]['exam_mark']); $y++) {
//                    $data['subject_id'] = $result_array[$i]['exam_mark'][$y]['subject_id'];
//                    $result_array[$i]['exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
//                }
            }
        }
        return $result_array;
    }
    

    function load_student_for_exam_marks_approval_hod_ca($data)
    {
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,IFNULL((SELECT count(stu_id) FROM exam_fraud_students WHERE stu_id=sr.stu_id AND course_id =ese.course_id AND year_no=ese.year_no AND semester_no=ese.semester_no AND batch_id=ese.batch_id AND sem_exam_id=ese.exam_id), 0) as fraud_status');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
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
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,'
                    . 'em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,'
                    . 'ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved,em.is_recorrection_approved');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
        //        print_r($result_array); is_ex_director_mark_approved
        return $result_array;
    }
    
    function load_rpt_student_for_exam_marks_approval_hod_ca($data)
    {
        //get Students
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat_approved', 1);
        //$this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            //get subjects
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) 
            {
                //get the marks for each subjects.
                // $this->db->select('*,co.code as subject_code');
                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,'
                        . 'em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,'
                        . 'ed.deleted as detail_deleted,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for,em.is_recorrection_approved');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $this->db->where('sedr.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();


                 /// load repeate students
                 $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
                 em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                 ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');
                 $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                 $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                 $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                 $this->db->join('mod_subject co', 'co.id = em.subject_id');
                 $this->db->where('em.course_id', $data['course_id']);
                 //$this->db->where('em.batch_id', $data['batch_id']);
                 //$this->db->where('em.batch_id', $rbatch);
                 $this->db->where('em.year_no', $data['year_no']);
                 $this->db->where('em.semester_no', $data['semester_no']);
                 $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                 $this->db->where('co.is_training_apply', 0);
                 $this->db->where('em.deleted', 0);
                 $this->db->where('ed.deleted', 0);
                 $this->db->where('sedr.deleted', 0);
                 $this->db->where('em.is_repeat_mark', 1);
                 $result_array[$i]['rpt_exam_mark'] = $this->db->get('exm_mark em')->result_array(); 
            }
        }
//        print_r($result_array); is_ex_director_mark_approved
        return $result_array;
    }

    function load_student_for_exam_marks_approval_dir_ca($data)
    {
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,IFNULL((SELECT count(stu_id) FROM exam_fraud_students WHERE stu_id=sr.stu_id AND course_id =ese.course_id AND year_no=ese.year_no AND semester_no=ese.semester_no AND batch_id=ese.batch_id AND sem_exam_id=ese.exam_id), 0) as fraud_status');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
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
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_mark,em.sem_exam_id,em.is_recorrection_approved,esed.is_approved as subj_approved');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }
    
    
    function load_rpt_student_for_exam_marks_approval_dir_ca($data)
    {
        //get Students
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            //get subjects
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) 
            {
                //get the marks for each subjects.
                // $this->db->select('*,co.code as subject_code');
                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,'
                        . 'em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,'
                        . 'ed.deleted as detail_deleted,em.is_repeat_mark,em.sem_exam_id,em.is_recorrection_approved,sedr.is_repeat,sedr.repeat_apply_for');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $this->db->where('sedr.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();

                 /// load repeate students
                 $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
                 em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                 ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');
                 $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                 $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                 $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                 $this->db->join('mod_subject co', 'co.id = em.subject_id');
                 $this->db->where('em.course_id', $data['course_id']);
                 //$this->db->where('em.batch_id', $data['batch_id']);
                 //$this->db->where('em.batch_id', $rbatch);
                 $this->db->where('em.year_no', $data['year_no']);
                 $this->db->where('em.semester_no', $data['semester_no']);
                 $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                 $this->db->where('co.is_training_apply', 0);
                 $this->db->where('em.deleted', 0);
                 $this->db->where('ed.deleted', 0);
                 $this->db->where('sedr.deleted', 0);
                 $this->db->where('em.is_repeat_mark', 1);
                 $result_array[$i]['rpt_exam_mark'] = $this->db->get('exm_mark em')->result_array(); 



            }
        }
//        print_r($result_array); is_ex_director_mark_approved
        return $result_array;
    }

    function load_student_for_exam_marks_approval_dir_se($data)
    {
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name ,IFNULL((SELECT count(stu_id) FROM exam_fraud_students WHERE stu_id=sr.stu_id AND course_id =ese.course_id AND year_no=ese.year_no AND semester_no=ese.semester_no AND batch_id=ese.batch_id AND sem_exam_id=ese.exam_id), 0) as fraud_status');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
       // $this->db->join('exam_fraud_students fr', 'sr.stu_id = fr.stu_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');
        
      //  $this->db->join('exm_mark em', 'ese.id = em.sem_exam_id');
       // $this->db->join('exm_mark_details emd', 'em.id = emd.exam_mark_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
       // $this->db->where('em.is_hod_mark_aproved', 1);
       // $this->db->where('em.is_director_mark_approved', 1);
       // $this->db->where('em.is_ex_director_mark_approved', 0);
       // $this->db->where('(emd.exam_type_id = "1" AND emd.mark != "0")');
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
            $this->db->where('sed.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.result,em.sem_exam_id,em.is_recorrection_approved,esed.is_approved as subj_approved,esed.is_exam_held,esed.is_attend');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }
//        print_r($result_array);
        return $result_array;
    }
    
    
    function load_rpt_student_for_exam_marks_approval_dir_se($data)
    {
    
        $this->db->select('SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');
      //  $this->db->join('exm_mark em', 'ese.id = em.sem_exam_id');
       // $this->db->join('exm_mark_details emd', 'em.id = emd.exam_mark_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat_approved', 1);
            //$this->db->where('sed.is_approved', 1);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();

            // $this->db->select('*,co.code as subject_code');
            $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.result,em.is_recorrection_approved,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for,sedr.is_exam_held,sedr.is_attend,sedr.is_repeat_approved');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.course_id', $data['course_id']);
            //$this->db->where('em.batch_id', $data['batch_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.student_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $this->db->where('sedr.deleted', 0);
            $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();

             /// load repeate students
             $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
             em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
             ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');
             $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
             $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
             $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
             $this->db->join('mod_subject co', 'co.id = em.subject_id');
             $this->db->where('em.course_id', $data['course_id']);
             //$this->db->where('em.batch_id', $data['batch_id']);
             //$this->db->where('em.batch_id', $rbatch);
             $this->db->where('em.year_no', $data['year_no']);
             $this->db->where('em.semester_no', $data['semester_no']);
             $this->db->where('em.student_id', $result_array[$i]['stu_id']);
             $this->db->where('co.is_training_apply', 0);
             $this->db->where('em.deleted', 0);
             $this->db->where('ed.deleted', 0);
             $this->db->where('sedr.deleted', 0);
             $this->db->where('em.is_repeat_mark', 1);
             $result_array[$i]['rpt_exam_mark'] = $this->db->get('exm_mark em')->result_array(); 


        }
//        print_r($result_array);
        return $result_array;
    }
    
    function load_student_exam_marks($data)
    {
        $this->db->select('mk.batch_id as mark_batch, mk.sem_exam_id as mark_exam, sr.batch_id as student_batch, esex.exam_id as student_exam');
        $this->db->join('exm_semester_exam esex', 'mk.sem_exam_id = esex.exam_id');
        $this->db->join('exm_semester_exam_details exd', 'exd.semester_exam_id = esex.id');
    
        //$this->db->join('exm_semester_exam_details exd', 'mk.student_id = exd.student_id');       
        //$this->db->join('exm_semester_exam esex', 'exd.semester_exam_id = esex.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = mk.student_id');
        $this->db->where('mk.student_id', $data['stu_id']);
        $this->db->where('mk.subject_id', $data['subject_id']);
        $this->db->where('mk.course_id', $data['course_id']);
        $this->db->where('mk.year_no', $data['year_no']);
        $this->db->where('mk.semester_no', $data['semester_no']);
        $this->db->where('mk.deleted', 0);
        $this->db->where('esex.deleted', 0);
        $this->db->where('sr.deleted', 0);
        $stu_data = $this->db->get('exm_mark mk')->row_array();
        if($stu_data){
            $stu_batch = $stu_data['mark_batch'];//get student repeat writing batch
            $stu_exam = $stu_data['mark_exam'];//get student repeat writing exam
            $current_stu_batch = $stu_data['student_batch'];//get student current batch
            $current_stu_exam = $stu_data['student_exam'];//get student current exam
        }
        else{
            $stu_batch = $data['batch_id'];
            $stu_exam = $data['exam_id'];
            $current_stu_batch = $stu_batch;
            $current_stu_exam = $stu_exam;
        }
        
   
        $this->db->select('*,stu.deleted as stu_deleted');
        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
        $this->db->join('edu_course de', 'de.id = stu.course_id');
        $this->db->join('edu_batch ba', 'ba.id = stu.batch_id');
        $this->db->where('sc.course_id', $data['course_id']);
        $this->db->where('sc.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('stu.deleted', 0);
        $this->db->where('stu.stu_id', $data['stu_id']);
        $this->db->where('stu.batch_id', $current_stu_batch);
        $result_array = $this->db->get('stu_reg stu')->row_array();

        //$subject_id = $this->get_subject_id_by_code($data['subject_code']);
        $subject_id = $data['subject_id'];

        $this->db->select('*, co.type as subject_type, co.code as subject_code');
        if($data['repeat'] == 1)
        $this->db->join('exm_semester_exam_details_repeat sed', 'se.exam_id = sed.semester_exam_id');
        else
        $this->db->join('exm_semester_exam_details sed', 'se.id = sed.semester_exam_id');

        $this->db->join('mod_subject co', 'co.id = sed.subject_id');
        $this->db->where('se.exam_id', $current_stu_exam);
        $this->db->where('se.course_id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_no']);
        $this->db->where('se.semester_no', $data['semester_no']);

        if($data['repeat'] == 1)
        $this->db->where('sed.stu_id', $data['stu_id']);
        else
        $this->db->where('sed.student_id', $data['stu_id']);

        $this->db->where('sed.subject_id', $subject_id);
        $this->db->where('se.deleted', 0);
        $result_array['subject_details'] = $this->db->get('exm_semester_exam se')->row_array();

        $result_array['subject_details']['repeat_details'] = $this->get_relevent_repeat_details($stu_exam, $data['stu_id'], $data['course_id'], $data['year_no'], $data['semester_no'], $stu_batch, $subject_id);

   
        if($data['repeat'] == 1){
            $this->db->select('SUM(credits) as total_credits');
            $this->db->join('stu_follow_subject sfs', 'sfs.subject_id = ms.id');
            $this->db->join('stu_subject ss', 'sfs.student_subject_id = ss.id');
            $this->db->where('ss.student_id', $data['stu_id']);
            $this->db->where('ss.course_id', $data['course_id']);
            $this->db->where('ss.batch_id', $result_array['subject_details']['repeat_details'][0]['applying_batch']);
            $this->db->where('ss.year_no', $data['year_no']);
            $this->db->where('ss.semester_no', $data['semester_no']);
            $this->db->where('ms.deleted', 0);
            $this->db->where('sfs.deleted', 0);
            $this->db->where('ss.deleted', 0);
            $credits = $this->db->get('mod_subject ms')->row_array();
        }
        else{
            $this->db->select('SUM(credits) as total_credits');
            $this->db->join('stu_follow_subject sfs', 'sfs.subject_id = ms.id');
            $this->db->join('stu_subject ss', 'sfs.student_subject_id = ss.id');
            $this->db->where('ss.student_id', $data['stu_id']);
            $this->db->where('ss.course_id', $data['course_id']);
            $this->db->where('ss.batch_id', $current_stu_batch);
            $this->db->where('ss.year_no', $data['year_no']);
            $this->db->where('ss.semester_no', $data['semester_no']);
            $this->db->where('ms.deleted', 0);
            $this->db->where('sfs.deleted', 0);
            $this->db->where('ss.deleted', 0);
            $credits = $this->db->get('mod_subject ms')->row_array();
        }
        
        
        
        //$this->db->select('(SUM(grade_point*subject_credit)/SUM(subject_credit)) as gpa');
//        $this->db->select('ROUND((SUM(grade_point*subject_credit)/'.$credits['total_credits'].'), 2) as gpa');
//        $this->db->where('student_id', $data['stu_id']);
//        $this->db->where('sem_exam_id', $stu_exam);
//        $gpa = $this->db->get('exm_mark')->row_array();
//        if($gpa['gpa']!=null)
//        $result_array['gpa_value'] = $gpa['gpa'];
//        else
//            $result_array['gpa_value']=0;
        
        if($data['repeat'] == 1){
            $this->db->select('ROUND((SUM(em.grade_point*em.subject_credit)/'.$credits['total_credits'].'), 2) as gpa');
            $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
            $this->db->where('em.student_id', $data['stu_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            //$this->db->where('sem_exam_id', $stu_exam);
            $this->db->where_not_in('em.result', array('DFR','I(SE)','I(CA)','INC','AB','N/E'));
            $this->db->where('em.deleted', 0);
            $this->db->where('ms.is_gpa_apply !=', 0);
            $gpa = $this->db->get('exm_mark em')->row_array();

            if($gpa['gpa']!=null) {
                $result_array['gpa_value'] = $gpa['gpa'];
            } else {
                $result_array['gpa_value'] = 0;
            } 
        }
        else{       
            $this->db->select('ROUND((SUM(em.grade_point*em.subject_credit)/'.$credits['total_credits'].'), 2) as gpa');
            $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
            $this->db->where('em.student_id', $data['stu_id']);
            $this->db->where('em.sem_exam_id', $stu_exam);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where_not_in('em.result', array('DFR','I(SE)','I(CA)','INC','AB','N/E'));
            $this->db->where('ms.is_gpa_apply !=', 0);
            $gpa = $this->db->get('exm_mark em')->row_array();

            if($gpa['gpa']!=null) {
                $result_array['gpa_value'] = $gpa['gpa'];
            } else {
                $result_array['gpa_value'] = 0;
            }
        }

        $result_array['subject_details']['marking_details'] = $this->get_relevent_marking_details_data($data['course_id'], $data['year_no'], $data['semester_no'], $current_stu_batch, $subject_id);


         /*$this->db->select('em.grade_point,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,ed.id, em.is_repeat_approve, em.is_repeat_mark');
        $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
        $this->db->join('mod_subject co', 'co.id = em.subject_id');
        $this->db->where('em.student_id', $data['stu_id']);
        $this->db->where('em.course_id', $data['course_id']);
        $this->db->where('em.year_no', $data['year_no']);
        $this->db->where('em.semester_no', $data['semester_no']);
       // $this->db->where('em.batch_id', $stu_batch);
        $this->db->where('em.subject_id', $subject_id);
//        $this->db->where('em.sem_exam_id', $result_array['subject_details']['semester_exam_id']);
        $this->db->where('em.deleted', 0);
        $this->db->where('ed.deleted', 0);
        if($data['repeat'] == 1)
        $this->db->where('em.is_repeat_mark', 1);

        $this->db->order_by('ed.id', 'DESC');
        $result_array['exam_mark'] = $this->db->get('exm_mark em')->result_array();*/

        if($data['repeat'] == 1){
            $this->db->select('em.grade_point,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
            em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
            ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,ed.id, em.is_repeat_approve, em.is_repeat_mark');
            $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
            $this->db->join('mod_subject co', 'co.id = em.subject_id');
            $this->db->where('em.student_id', $data['stu_id']);
            $this->db->where('em.course_id', $data['course_id']);
            $this->db->where('em.year_no', $data['year_no']);
            $this->db->where('em.semester_no', $data['semester_no']);
            $this->db->where('em.subject_id', $subject_id);
            $this->db->where('em.deleted', 0);
            $this->db->where('ed.deleted', 0);
            $this->db->where('em.is_repeat_mark', 1);
            $this->db->order_by('ed.id', 'DESC');
            $temp_arry= $this->db->get('exm_mark em')->result_array();
           
            if (!empty($temp_arry)) {
                $result_array['exam_mark'] = $temp_arry;              
            } 
            else
            {
                $this->db->select('em.grade_point,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
                em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,ed.id, em.is_repeat_approve, em.is_repeat_mark');
                        $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                        $this->db->join('mod_subject co', 'co.id = em.subject_id');
                        $this->db->where('em.student_id', $data['stu_id']);
                        $this->db->where('em.course_id', $data['course_id']);
                        $this->db->where('em.year_no', $data['year_no']);
                        $this->db->where('em.semester_no', $data['semester_no']);
                        $this->db->where('em.subject_id', $subject_id);
                        $this->db->where('em.deleted', 0);
                        $this->db->where('ed.deleted', 0);            
                        $this->db->order_by('ed.id', 'DESC');
                        $result_array['exam_mark'] = $this->db->get('exm_mark em')->result_array();
            }


        }else{
            $this->db->select('em.grade_point,em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
            em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
            ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,ed.id, em.is_repeat_approve, em.is_repeat_mark');
                    $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                    $this->db->join('mod_subject co', 'co.id = em.subject_id');
                    $this->db->where('em.student_id', $data['stu_id']);
                    $this->db->where('em.course_id', $data['course_id']);
                    $this->db->where('em.year_no', $data['year_no']);
                    $this->db->where('em.semester_no', $data['semester_no']);
                    $this->db->where('em.subject_id', $subject_id);
                    $this->db->where('em.deleted', 0);
                    $this->db->where('ed.deleted', 0);            
                    $this->db->order_by('ed.id', 'DESC');
                    $result_array['exam_mark'] = $this->db->get('exm_mark em')->result_array();
        }







        //get access level
        $this->load->model('Util_model');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $result_array['user_level'] = $ug_level;

//        print_r($result_array);
        return $result_array;
    }
    
    
    function get_relevent_repeat_details($exam_id, $stu_id, $course_id, $year_no, $sem_no, $batch_no, $subject_id)
    {
        $this->db->select('eser.*, co.credits, co.subject, co.code, de.course_code, ba.batch_code, sr.reg_no, sr.first_name');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('exm_semester_exam ese', 'esed.semester_exam_id = ese.id');
        $this->db->join('edu_course de', 'de.id = ese.course_id');
        $this->db->join('edu_batch ba', 'ba.id = ese.batch_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->where('eser.stu_id', $stu_id);
        $this->db->where('eser.subject_id', $subject_id);
        //$this->db->where('ese.exam_id', $exam_id);
        $this->db->where('ese.course_id', $course_id);
        $this->db->where('ese.year_no', $year_no);
        $this->db->where('ese.semester_no', $sem_no);
        $this->db->where('ese.deleted', 0);
        $this->db->where('eser.deleted', 0);
        $this->db->where('eser.is_repeat', 1);
        $this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('esed.deleted', 0);
        //$this->db->where('ese.batch_id', $batch_no);
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();
        return $result_array;
    }

    function get_relevent_marking_details($course_id, $year_no, $sem_no, $batch_no, $subject_id, $examTypeId)
    {
        $sem_id = $this->get_semester_id($course_id, $year_no);
        $this->db->select('*, mt.type as type');
        $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
        $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
        $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
        $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
        $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
        $this->db->join('mod_subject ms', 'ms.id = scd.subject_id');
        $this->db->where('sem.id', $sem_id);
        $this->db->where('sc.semester_no', $sem_no);
        $this->db->where('sc.batch_id', $batch_no);
        $this->db->where('scd.subject_id', $subject_id);
        $this->db->where('ms.is_training_apply', 0);
        $this->db->where('md.type_id', $examTypeId);
        $this->db->where('sc.deleted', 0);
        $this->db->where('scd.deleted', 0);
        $this->db->where('md.deleted', 0);
        $this->db->group_by('md.type_id');
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    //$examTypeId caused the error
    //Removed $examTypeId from the parameters list ($examTypeId was last param)
    function get_relevent_marking_details_data($course_id, $year_no, $sem_no, $batch_no, $subject_id)
    {
        $sem_id = $this->get_semester_id($course_id, $year_no);
        $this->db->select('*, mt.type as type');
        $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
        $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
        $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
        $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
        $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
        $this->db->join('mod_subject ms', 'ms.id = scd.subject_id');
        $this->db->where('sem.id', $sem_id);
        $this->db->where('sc.semester_no', $sem_no);
        $this->db->where('sc.batch_id', $batch_no);
        $this->db->where('scd.subject_id', $subject_id);
        $this->db->where('ms.is_training_apply', 0);
        $this->db->where('sc.deleted', 0);
        $this->db->where('scd.deleted', 0);
        $this->db->where('md.deleted', 0);
        $this->db->group_by('md.type_id');
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    
    function get_semester_id($course_id, $year_no)
    {
        $this->db->select('se.id as sem_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('edu_course de', 'de.id = yr.course_id');
        $this->db->where('de.id', $course_id);
        $this->db->where('se.year_no', $year_no);
        $this->db->where('yr.deleted', 0);
        $this->db->where('de.deleted', 0);
        $this->db->where('se.deleted', 0);
        $row_array = $this->db->get('edu_semester se')->row_array();

        if (!empty($row_array)) {
            return $row_array['sem_id'];
        } else {
            return NULL;
        }
    }

    function load_student_for_semester_update($data)
    {
        $this->db->select('*');
        $this->db->where('stu.course_id', $data['course_id']);
        $this->db->where('stu.center_id', $data['center_id']);
        $this->db->where('stu.batch_id', $data['batch_id']);
        $result_array = $this->db->get('stu_reg stu')->row_array();
        return $result_array;
    }

    function load_batchesforupgrade()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $this->input->post('course_id'));
        $this->db->where('iscompleted', 0);
        $batches = $this->db->get('edu_batch')->result_array();

//        $x = 0;
//        foreach ($batches as $batch) {
//            $this->db->where('stup_branch', $this->input->post('branch'));
//            $this->db->where('stup_studyseason', $this->input->post('study_season_id'));
//            $this->db->where('stup_course', $this->input->post('course_id'));
//            $this->db->where('stup_batch', $batch['id']);
//            $this->db->where('stup_status', 'A');
//            $isupgraded = $this->db->get('stu_upgrade')->row_array();
//
//            if (empty($isupgraded)) {
//                $batches[$x]['isupgraded'] = 0;
//            } else {
//                $batches[$x]['isupgraded'] = 1;
//            }
//            $x++;
//        }
        
        $x = 0;
        foreach ($batches as $batch) {
            $batches[$x]['isupgraded'] = 0;
            $x++;
        }

        return $batches;
    }

    function load_batches()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $this->input->post('id'));
        $this->db->where('iscompleted', 0);
        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_districts()
    {
        $this->db->select('*');
        $batches = $this->db->get('cfg_district')->result_array();

        return $batches;
    }

    function load_course_list()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }
    
    function load_course_list_hod($course_id)
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('cr.id', $course_id);
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_course_list_student_add_student()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');
        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_course_list_student()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->join('stu_reg sr', 'cr.id=sr.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');
        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_subject_selection_course_list($ug_level, $course_id)
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('cr.deleted', 0);
        if ($ug_level == 5) {
            $this->db->where('cr.id', $course_id);
        }
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_al_subject_list()
    {
        $this->db->select('*');
        $this->db->where('stream_id', $this->input->post('stream_id'));
        $this->db->order_by('subject_name asc');

        $course_list = $this->db->get('com_al_subject')->result_array();

        return $course_list;
    }

    function load_batch_student()
    {
        $id = $this->input->post('id');
        $curryear = $this->input->post('curryear');
        $currsem = $this->input->post('currsem');
        $studyseason = $this->input->post('study_season_id');
        $course_id = $this->input->post('course_id');
        $branch = $this->input->post('branch');

        $this->db->distinct();
        $this->db->join('exm_mark_stu_gpa gpa', 'gpa.stu_id=stu_reg.stu_id','left');
        $this->db->where('current_year', $curryear);
        $this->db->where('current_semester', $currsem);
        $this->db->where('course_id', $course_id);
        $this->db->where('center_id', $branch);
        $this->db->where('batch_id', $id);
        $this->db->where('approved', 1);
        $this->db->group_by('stu_reg.stu_id');
        $notfailedstus = $this->db->get('stu_reg')->result_array();

        $this->db->join('exm_mark_stu_gpa gpa', 'gpa.stu_id=stu_reg.stu_id','left');
        $this->db->where('current_year', $curryear);
        $this->db->where('current_semester', $currsem);
        $this->db->where('course_id', $course_id);
        $this->db->where('center_id', $branch);
        $this->db->where('batch_id !=', $id);
        $this->db->where('approved', 1);
        $this->db->group_by('stu_reg.stu_id');
        $oldstudentd = $this->db->get('stu_reg')->result_array();
        
        
        $this->db->select('ey.no_of_year, es.year_no, es.no_of_semester');
        $this->db->join('edu_semester es', 'ey.id=es.year_id');
        $this->db->where('course_id', $course_id);
        $course_years = $this->db->get('edu_year ey')->result_array();

        $all = array(
            "notfailedstus" => $notfailedstus,
            "oldstudentd" => $oldstudentd,
            "course_years" => $course_years
        );

        return $all;
    }

    function upgrade_students()
    {
        $sup_batch = $this->input->post('sup_batch');
        $sup_year = $this->input->post('sup_year');
        $sup_semester = $this->input->post('sup_semester');
        $sup_season = $this->input->post('sup_season');
        $sup_course = $this->input->post('sup_course');
        $sup_branch = $this->input->post('sup_branch');
        $studentlist = $this->input->post('studentlist');

        $studentchk = array();
        if (isset($_POST['studentchk'])) {
            $studentchk = $this->input->post('studentchk');
        }

        $this->db->trans_begin();

        $this->db->where('stup_branch', $sup_branch);
        $this->db->where('stup_studyseason', $sup_season);
        $this->db->where('stup_course', $sup_course);
        $this->db->where('stup_batch', $sup_batch);
        $isupgraded = $this->db->get('stu_upgrade')->row_array();

        $upstu['stup_promoteyear'] = $sup_year;
        $upstu['stup_promotesemester'] = $sup_semester;
        $upstu['stup_status'] = 'A';

        if (empty($isupgraded)) {
            $upstu['stup_branch'] = $sup_branch;
            $upstu['stup_studyseason'] = $sup_season;
            $upstu['stup_course'] = $sup_course;
            $upstu['stup_batch'] = $sup_batch;
            $upstu['stup_addedon'] = date("Y-m-d H:i:s", now());
            $upstu['stup_addedby'] = $this->session->userdata('u_id');
            $upstu['stup_addeduname'] = $this->session->userdata('u_name');

            $this->db->insert('stu_upgrade', $upstu);
            $upid = $this->db->insert_id();
        } else {
            $upstu['stup_updatedby'] = $this->session->userdata('u_id');
            $upstu['stup_updateduname'] = $this->session->userdata('u_name');

            $this->db->where('stup_id', $isupgraded['stup_id']);
            $this->db->update('stu_upgrade', $upstu);
            $upid = $isupgraded['stup_id'];
        }

        foreach ($studentlist as $stu) {
            if (!in_array($stu, $studentchk)) {

                $this->db->where('stu_id',$stu);
                $this->db->update('stu_reg',array('current_year'=>$sup_year,'current_semester'=>$sup_semester,'lastupgradeid'=>$upid));

                //insert studentts for student upgrade approval
                $ins_stu['stu_id'] = $stu;
                $ins_stu['stup_id'] = $upid;
                $ins_stu['upgrade_year'] = $sup_year;
                $ins_stu['upgrade_semester'] = $sup_semester;
                //$ins_stu['approved_status']   = $upid;
                $ins_stu['approved_by'] = $this->session->userdata('u_id');
                $ins_stu['approved_datetime'] = date("Y-m-d H:i:s", now());

                $this->db->insert('stu_upgrade_semester', $ins_stu);
            }
        }

        //batch_upgrade
        $this->db->where('id',$sup_batch);
        $this->db->update('edu_batch',array('current_year'=>$sup_year,'current_semester'=>$sup_semester));


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Upgrade Students';
            $this->logger->systemlog('Upgrade Students', 'Failure', 'Failed to Upgrade Students', date("Y-m-d H:i:s", now()),$upstu);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Students Upgraded successfully.';
            $this->logger->systemlog('Upgrade Students', 'Success', 'Students Upgraded successfully.', date("Y-m-d H:i:s", now()),$upstu);
        }
        
        return $res;
    }


    function get_title()
    {

        $this->db->select('*');
        $this->db->where('title_status', '1');
        $title_new = $this->db->get('com_title')->result_array();

        return $title_new;
    }


    function get_subject_stream()
    {

        $this->db->select('*');
        $this->db->order_by('show_order asc');
        $subject_stream = $this->db->get('com_al_subject_stream')->result_array();

        return $subject_stream;
    }

    function get_subject_ol_result_grade()
    {

        $this->db->select('*');
        $this->db->where('type', 'ol');
        $subject_grade = $this->db->get('com_al_subject_grade')->result_array();

        return $subject_grade;
    }

    function get_subject_al_result_grade()
    {

        $this->db->select('*');
        $this->db->where('type', 'al');
        $subject_grade = $this->db->get('com_al_subject_grade')->result_array();

        return $subject_grade;
    }

    function load_year_list()
    {
        $this->db->select('id,no_of_year');
        $this->db->where('course_id', $this->input->post('selected_course_id'));
        $years = $this->db->get('edu_year')->row_array();

        return $years;
    }
    
    function load_year_list_for_request()
    {
        $this->db->select('ey.id as id, sr.current_year as no_of_year');
        $this->db->join('edu_year ey', 'ey.course_id=sr.course_id');
        $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        $years = $this->db->get('stu_reg sr')->row_array();

        return $years;
    }

    function load_batch_list()
    {
        $this->db->select('id,batch_code');
        $this->db->where('course_id', $this->input->post('selected_course_id'));
        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    function load_semesters()
    {
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
    
    
    function load_semester_list_for_request()
    {
        $this->db->select('current_semester');
        $this->db->where('stu_id', $this->session->userdata('user_ref_id'));
        $result = $this->db->get('stu_reg')->row_array();
        if ($result) {
            return $result['current_semester'];
        } else {
            return NULL;
        }
    }
    
    
    
    function load_semesters_from_year()
    {
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
    
    
//    function load_semester_list_from_years()
//    {
//        $this->db->select('current_semester');
//        $this->db->where('stu_id', $this->session->userdata('user_ref_id'));
//        $result = $this->db->get('stu_reg')->row_array();
//        if ($result) {
//            return $result['current_semester'];
//        } else {
//            return NULL;
//        }
//    }
    
    

    function search_students_lookup($data)
    {

        //$this->db->select('*, SUBSTRING_INDEX(st.reg_no, "/", -1) as regno_order,st.deleted as stu_deleted');
        $this->db->select('st.stu_id,st.profileimage,st.apply_mahapola,st.reg_no,st.first_name,st.nic_no,de.course_code,de.course_name, SUBSTRING_INDEX(st.reg_no, "/", -1) as regno_order,st.deleted as stu_deleted');
        $this->db->join('edu_course de', 'de.id=st.course_id');

        if ($data['course_id'] != "") {
            $this->db->where('st.course_id', $data['course_id']);
        }
        if ($data['batch_id'] != 0) {
            $this->db->where('st.batch_id', $data['batch_id']);
        }
        if ($data['year_no'] != 0) {
            $this->db->where('st.current_year', $data['year_no']);
        }
        if ($data['semester_no'] != 0) {
            $this->db->where('st.current_semester', $data['semester_no']);
        }
        if ($data['center_id'] != "") {
            $this->db->where('st.center_id', $data['center_id']);
        }

        $this->db->where('st.deleted', 0);
        $this->db->where('st.approved', 1);
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg st')->result_array();

        return $result_array;
    }

    /*
     * get rows from the files table to download image
     */
    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('stu_reg');
        if (array_key_exists('id', $params) && !empty($params['id'])) {
            $this->db->where('stu_id', $params['id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
        }
        //return fetched data
        return $result;
    }


    function load_all_data()
    {

        $id = $this->input->post('stu_id');

        $this->db->select('*');
        $this->db->where('stu_id', $id);
        $res_stu_reg = $this->db->get('stu_reg')->result_array();
        $res_query['stu_reg'] = $res_stu_reg;

        $this->db->select('*');
        $this->db->where('stu_id', $id);
        $res_stu_reg_mahapola = $this->db->get('stu_reg_mahapola')->result_array();
        $res_query['res_stu_reg_mahapola'] = $res_stu_reg_mahapola;

        return $res_query;
    }

    function check_student_reg_no()
    {

        $reg_no = $this->input->post('reg_no');

        $this->db->select('count(stu_id) as reg_count');
        $this->db->where('reg_no', $reg_no);
        $reg_query = $this->db->get('stu_reg')->row_array();

        return $reg_query;
    }

    function load_stu_initial_batch_assign($data)
    {

        if ($data['intake_type'] == 'All') {
            $where = "(course_type = 'F' OR course_type = 'P')";
        } else if ($data['intake_type'] == 'F') {
            $where = "course_type = 'F'";
        } else if ($data['intake_type'] == 'P') {
            $where = "course_type = 'P'";
        }
        $this->db->select('*');
        $this->db->where('center_id', $data['center_id']);
        $this->db->where('course_id', $data['course_id']);
        $this->db->where('approved', '1');
        $this->db->where('deleted', '0');
        $this->db->where('batch_id', 0);
        $this->db->where($where);
        $result_array = $this->db->get('stu_reg')->result_array();

        return $result_array;
    }

    function initial_batch_assign()
    {
        $batch_id = $this->input->post('batches');

        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $batch_details = $this->db->get('edu_batch')->row_array();


        $studentlist = $this->input->post('assignstudentlist');

        if (isset($_POST['assignstudentchk'])) {
            $studentchk = $this->input->post('assignstudentchk');
        } else {
            $studentchk = array();
        }
        foreach ($studentlist as $stu) {
            if (in_array($stu, $studentchk)) {
                $this->db->where('stu_id', $stu);
                $this->db->update('stu_reg', array('batch_id' => $batch_id, 'current_year' => $batch_details['current_year'], 'current_semester' => $batch_details['current_semester']));
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Initial Batch Assign';
            $this->logger->systemlog('Initial Batch Assign', 'Failure', 'Failed to Initial Batch Assign', date("Y-m-d H:i:s", now()),$batch_details);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Initial Batch Assigned successfully.';
            $this->logger->systemlog('Initial Batch Assign', 'Success', 'Initial Batch Assigned successfully.', date("Y-m-d H:i:s", now()),$batch_details);
        }
        return $res;
    }

    function save_student()
    {

        $this->db->trans_begin();

        $stu_id = $this->input->post('stu_id');
        $stu_data = $this->edit_student($stu_id);
        $apply_mahapola = $this->input->post('apply_mahapola');
        $reg_no = $this->input->post('reg_no_part1') . $this->input->post('reg_no_part2');

        if (!empty($_FILES['stuprof_pic']['name'])) {
            $name_img = $_FILES['stuprof_pic']['name'];
            $temp_info = explode('.', $name_img);
            $ary_len = count($temp_info);

            $config['upload_path'] = './uploads/studentprofile/';
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            // $config['max_size']             = 100000;
            $config['overwrite']            = TRUE;
            $config['file_name'] = $reg_no;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('stuprof_pic')) {
                $error = array('error' => $this->upload->display_errors());
                $img_save_data = null;
            } else {
                $image_data = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/studentprofile/' . $image_data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = 50;
                $config['width'] = 200;
                $config['height'] = 250;
                $config['new_image'] = './uploads/studentprofile/' . $image_data['file_name'];


                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                //$image_data = $this->upload->data();
                $img_save_data = 'uploads/studentprofile/' . $image_data['file_name'];
            }
        } else {
            $img_save_data = null;
        }

        $savestu['reg_no'] = $this->input->post('reg_no_part1') . $this->input->post('reg_no_part2');
        $savestu['profileimage'] = $img_save_data;
        $savestu['admission_no'] = $this->input->post('admission_no');
        $savestu['center_id'] = $this->input->post('center_id');
        $savestu['first_name'] = $this->input->post('first_name');
        $savestu['last_name'] = $this->input->post('last_name');
        $savestu['civil_status'] = $this->input->post('civil_status');
        $savestu['sex'] = $this->input->post('sex');
        $savestu['nic_no'] = $this->input->post('nic_no');
        $savestu['birth_date'] = $this->input->post('birth_date');

        $savestu['age_year'] = $this->input->post('txtAgeYear');
        $savestu['age_month'] = $this->input->post('txtAgeMonth');
        $savestu['age_days'] = $this->input->post('txtAgeDays');

        $savestu['place_birth'] = $this->input->post('place_birth');
        $savestu['religion'] = $this->input->post('religion');
        $savestu['mobile_no'] = $this->input->post('mobile_no');
        $savestu['fixed_tp'] = $this->input->post('fixed_tp');
        $savestu['email'] = $this->input->post('email');
        $savestu['permanent_address'] = $this->input->post('permanent_address');
        $savestu['district'] = $this->input->post('district');

        //AL result se tion
        $savestu['al_year'] = $this->input->post('al_year');
        $savestu['al_index_no'] = $this->input->post('al_index_no');
        $savestu['al_medium'] = $this->input->post('al_medium');
        $savestu['al_stream'] = $this->input->post('al_stream');
        $savestu['al_subject1'] = $this->input->post('al_subject1');
        $savestu['al_subject2'] = $this->input->post('al_subject2');
        $savestu['al_subject3'] = $this->input->post('al_subject3');
        $savestu['al_subject4'] = $this->input->post('al_subject4');
        $savestu['al_subject1_grade'] = $this->input->post('al_subject1_grade');
        $savestu['al_subject2_grade'] = $this->input->post('al_subject2_grade');
        $savestu['al_subject3_grade'] = $this->input->post('al_subject3_grade');
        $savestu['al_subject4_grade'] = $this->input->post('al_subject4_grade');
        //newly added fields
        $savestu['common_gen_paper_index_no'] = $this->input->post('common_gen_paper_index_no');
        $savestu['common_gen_paper'] = $this->input->post('com_gen_paper');

        //print_r($savestu['common_gen_paper']);

        $savestu['al_z_core'] = $this->input->post('al_score_mode') . $this->input->post('al_z_core');


        //OL result section
        $savestu['ol_year'] = $this->input->post('ol_year');
        $savestu['ol_index_no'] = $this->input->post('ol_index_no');
        $savestu['ol_medium'] = $this->input->post('ol_medium');

        $savestu['ol_maths_grade'] = $this->input->post('ol_maths_grade');
        $savestu['ol_english_grade'] = $this->input->post('ol_english_grade');
        //newly added fields
        $savestu['is_ol_single_year'] = $this->input->post('ol_sityear');
        $savestu['ol_english_year'] = $this->input->post('ol_english_year');
        $savestu['ol_english_index_no'] = $this->input->post('ol_english_index_no');

        //Part Time course Details.
        $savestu['course_type'] = $this->input->post('course_type');
        $savestu['employment'] = $this->input->post('prt_Present_emp');
        $savestu['position'] = $this->input->post('prt_post');
        $savestu['epf_no'] = $this->input->post('prt_EPF');
        $savestu['work_place_address'] = $this->input->post('prt_address');
        $savestu['appointment_date'] = $this->input->post('prt_app_date');
        $savestu['business_reg_no'] = $this->input->post('prt_br');
        $savestu['business_reg_date'] = $this->input->post('prt_date_br');

        //genaral section
        $savestu['current_year'] = $this->input->post('faculty_id');
        $savestu['current_semester'] = $this->input->post('faculty_id');
        $savestu['faculty_id'] = $this->input->post('faculty_id');
        $savestu['batch_id'] = $this->input->post('batch_id');
        $savestu['course_id'] = $this->input->post('course_id');
        $savestu['apply_mahapola'] = $apply_mahapola;
        

        $this->db->where('id', $savestu['batch_id']);
        $batchinfo = $this->db->get('edu_batch')->row_array();

        $savestu['current_year'] = $batchinfo['current_year'];
        $savestu['current_semester'] = $batchinfo['current_semester'];
        // $savestu['lastupgradeid']     = $batchinfo[''];

        if ($stu_id == '') {
            $savestu['approved'] = 0;
            $savestu['create_by'] = $this->session->userdata('u_id');
            $savestu['created_date'] = date("Y-m-d H:i:s", now());
            //insert
            $result = $this->db->insert('stu_reg', $savestu);
            $insert_id = $this->db->insert_id();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                if (!$result) {
                    $this->session->set_flashdata('flashError', 'Failed to save student. Retry.');
                }

            } else {
                $this->db->trans_commit();
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Student saved successfully. ');
                    $this->session->set_flashdata('insert_id', $insert_id);
                    $this->logger->systemlog('Student Registration', 'Success', 'Student registered successfully.', date("Y-m-d H:i:s", now()),$savestu);
                }
            }

        } else {
            //get access level
            $this->load->model('Util_model');
            $access_level = $this->Util_model->check_access_level();
            $ug_level = $access_level[0]['ug_level'];
            
            if($ug_level == 5){ //student
                $savestu['approved'] = 0;
            }
            
            //  $ss= $this->input->post('center_id');
            // var_dump($ss);
            $savestu['updated_by'] = $this->session->userdata('u_id');
            $savestu['updated_on'] = date("Y-m-d H:i:s", now());

            if ($savestu['profileimage'] == null) {
                $savestu['profileimage'] = $this->input->post('edit_image_url');
            }
            //update
            $this->db->where('stu_id', $stu_id);
            $result = $this->db->update('stu_reg', $savestu);

            $updtuser['user_status'] = 'A';
            $this->db->where('user_ref_id', $stu_id);
            $user_result = $this->db->update('ath_user', $updtuser);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                if ($user_result != "") {
                    if (!($result && $user_result)) { //
                        $this->session->set_flashdata('flashError', 'Failed to update student. Retry.');
                    }
                }
            } else {
                $this->db->trans_commit();
                if ($user_result != "") {
                    if ($result && $user_result) { // 
                        $this->session->set_flashdata('flashSuccess', 'Student updated successfully.');
                        $this->session->set_flashdata('insert_id', $stu_id);
                        $this->logger->systemlog('Student Update', 'Success', 'Student updated successfully.', date("Y-m-d H:i:s", now()),$savestu);
                    }
                }
            }

        }


        /*if($apply_mahapola){
            redirect('student/mahapola_application_view');
        } else {
            redirect('student/student_lookup');
        }*/
        redirect('student/student_view');
    }

    function save_student_mahapola()
    {

        $stu_id = $this->input->post('stu_id');
        $mahapola_id = $this->input->post('mahapola_id');

        $savestu['stu_id'] = $stu_id;
        $savestu['title'] = $this->input->post('title');
        $savestu['full_name'] = $this->input->post('full_name');
        $savestu['address'] = $this->input->post('address');
        $savestu['nic'] = $this->input->post('nic');
        $savestu['telephone'] = $this->input->post('telephone');
        $savestu['mobile'] = $this->input->post('mobile');
        $savestu['distance'] = $this->input->post('distance');
        $savestu['al_year'] = $this->input->post('al_year');
        $savestu['al_index'] = $this->input->post('al_index');
        $savestu['al_z_score'] = $this->input->post('al_z_score');
        $savestu['al_subject_stream'] = $this->input->post('al_subject_stream');

        //02. Family Details section
        /*$savestu['fd_name1']        = $this->input->post('fd_name1');
        $savestu['fd_dob1']        = $this->input->post('fd_dob1');
        $savestu['fd_age_as_at1']        = $this->input->post('fd_age_as_at1');
        $savestu['fd_scl_name1']       = $this->input->post('fd_scl_name1');
        
        $savestu['fd_name2']        = $this->input->post('fd_name2');
        $savestu['fd_dob2']        = $this->input->post('fd_dob2');
        $savestu['fd_age_as_at2']        = $this->input->post('fd_age_as_at2');
        $savestu['fd_scl_name2']       = $this->input->post('fd_scl_name2');
        
        $savestu['fd_name3']        = $this->input->post('fd_name3');
        $savestu['fd_dob3']        = $this->input->post('fd_dob3');
        $savestu['fd_age_as_at3']        = $this->input->post('fd_age_as_at3');
        $savestu['fd_scl_name3']       = $this->input->post('fd_scl_name3');
        
        $savestu['fd_name4']        = $this->input->post('fd_name4');
        $savestu['fd_dob4']        = $this->input->post('fd_dob4');
        $savestu['fd_age_as_at4']        = $this->input->post('fd_age_as_at4');
        $savestu['fd_scl_name4']       = $this->input->post('fd_scl_name4');*/
        $savestu['schl_attendies'] = $this->input->post('schl_attendies');
        $savestu['schl_going_concession'] = $this->input->post('schl_going_concession');

        // Bros and sis Other university 
        /*$savestu['ou_stu_name1']        = $this->input->post('ou_stu_name1');
        $savestu['ou_uni_name1']        = $this->input->post('ou_uni_name1');
        $savestu['ou_course_name1']        = $this->input->post('ou_course_name1');
        $savestu['ou_al_year1']       = $this->input->post('ou_al_year1');
        $savestu['ou_al_index1']       = $this->input->post('ou_al_index1');
        $savestu['ou_mahapola_bursary1']       = $this->input->post('ou_mahapola_bursary1');
        
        $savestu['ou_stu_name2']        = $this->input->post('ou_stu_name2');
        $savestu['ou_uni_name2']        = $this->input->post('ou_uni_name2');
        $savestu['ou_course_name2']        = $this->input->post('ou_course_name2');
        $savestu['ou_al_year2']       = $this->input->post('ou_al_year2');
        $savestu['ou_al_index2']       = $this->input->post('ou_al_index2');
        $savestu['ou_mahapola_bursary2']       = $this->input->post('ou_mahapola_bursary2');*/
        $savestu['ou_attendies'] = $this->input->post('ou_attendies');
        $savestu['ou_going_concession'] = $this->input->post('ou_going_concession');

        // Bros and sis Other university  2
        /*$savestu['ou2_stu_name1']        = $this->input->post('ou2_stu_name1');
        $savestu['ou2_al_index1']        = $this->input->post('ou2_al_index1');
        $savestu['ou2_nic1']        = $this->input->post('ou2_nic1');
        $savestu['ou2_course_name1']       = $this->input->post('ou2_course_name1');
        $savestu['ou2_uni_name1']       = $this->input->post('ou2_uni_name1');
        
        $savestu['ou2_stu_name2']        = $this->input->post('ou2_stu_name2');
        $savestu['ou2_al_index2']        = $this->input->post('ou2_al_index2');
        $savestu['ou2_nic2']        = $this->input->post('ou2_nic2');
        $savestu['ou2_course_name2']       = $this->input->post('ou2_course_name2');
        $savestu['ou2_uni_name2']       = $this->input->post('ou2_uni_name2');*/

        //03. Income
        /*$savestu['inc_owner_name1']= $this->input->post('inc_owner_name1');
        $savestu['inc_relation1']= $this->input->post('inc_relation1');
        $savestu['inc_location1']= $this->input->post('inc_location1');
        $savestu['inc_cultivation1']= $this->input->post('inc_cultivation1');
        $savestu['inc_prop_details1'] = $this->input->post('inc_prop_details1');
        $savestu['inc_annual_income1']= $this->input->post('inc_annual_income1');
        
        $savestu['inc_owner_name2']= $this->input->post('inc_owner_name2');
        $savestu['inc_relation2']= $this->input->post('inc_relation2');
        $savestu['inc_location2']= $this->input->post('inc_location2');
        $savestu['inc_cultivation2']= $this->input->post('inc_cultivation2');
        $savestu['inc_prop_details2'] = $this->input->post('inc_prop_details2');
        $savestu['inc_annual_income2']= $this->input->post('inc_annual_income2');*/
        $savestu['income_from_land'] = $this->input->post('income_from_land');

        //Tax 
        /*$savestu['inct_owner_name1']= $this->input->post('inct_owner_name1');
        $savestu['inct_relation1']= $this->input->post('inct_relation1');
        $savestu['inct_assessment_no1']= $this->input->post('inct_assessment_no1');
        $savestu['inct_address1']= $this->input->post('inct_address1');
        $savestu['inct_anual_income1'] = $this->input->post('inct_anual_income1');
        $savestu['inct_lease_name1']= $this->input->post('inct_lease_name1');
        
        $savestu['inct_owner_name2']= $this->input->post('inct_owner_name2');
        $savestu['inct_relation2']= $this->input->post('inct_relation2');
        $savestu['inct_assessment_no2']= $this->input->post('inct_assessment_no2');
        $savestu['inct_address2']= $this->input->post('inct_address1');
        $savestu['inct_anual_income2'] = $this->input->post('inct_anual_income2');
        $savestu['inct_lease_name2']= $this->input->post('inct_lease_name2');
        
        //04. Income from houses rented or leased.
        $savestu['no_of_division']= $this->input->post('no_of_division');
        $savestu['ds_division'] = $this->input->post('ds_division');
        $savestu['local_authority'] = $this->input->post('local_authority');*/
        $savestu['income_from_rent'] = $this->input->post('income_from_rent');

        //05. If you are involved in any work that generating income
        //$savestu['empld_name']= $this->input->post('empld_name');
        //$savestu['empld_address']= $this->input->post('empld_address');
        //$savestu['empld_post']= $this->input->post('empld_post');
        $savestu['empld_salary'] = $this->input->post('empld_salary');
        //$savestu['empld_dateofapp']= $this->input->post('empld_dateofapp');

        //06. If you are married
        /*$savestu['employeement_status']= $this->input->post('employeement_status');
        $savestu['sp_date_of_marriage']= $this->input->post('sp_date_of_marriage');
        $savestu['spouse_name']= $this->input->post('spouse_name');
        $savestu['spouse_com_name']= $this->input->post('spouse_com_name');
        $savestu['spouse_com_address']= $this->input->post('spouse_com_address');
        $savestu['spouse_salary']= $this->input->post('spouse_salary');*/
        //$savestu['civil_status']= $this->input->post('civil_status');
        $savestu['spouse_annual_income'] = $this->input->post('spouse_annual_income');

        //07. Details of Father
        /*$savestu['fa_name']= $this->input->post('fa_name');
        $savestu['fa_live']= $this->input->post('fa_live');
        $savestu['fa_age']= $this->input->post('fa_age');
        $savestu['fa_occupation']= $this->input->post('fa_occupation');
        $savestu['fa_retired_date']= $this->input->post('fa_retired_date');
        $savestu['fa_termination_date']= $this->input->post('fa_termination_date');
        $savestu['fa_wp_address']= $this->input->post('fa_wp_address');
        $savestu['fa_annual_income']= $this->input->post('fa_annual_income');*/
        $savestu['fa_other_income'] = $this->input->post('fa_other_income');

        //07. Details of Mother
        /*$savestu['mo_name']= $this->input->post('mo_name');
        $savestu['mo_live']= $this->input->post('mo_live');
        $savestu['mo_age']= $this->input->post('mo_age');
        $savestu['mo_occupation']= $this->input->post('mo_occupation');
        $savestu['mo_retired_date']= $this->input->post('mo_retired_date');
        $savestu['mo_termination_date']= $this->input->post('mo_termination_date');
        $savestu['mo_wp_address']= $this->input->post('mo_wp_address');
        $savestu['mo_annual_income']= $this->input->post('mo_annual_income');*/
        $savestu['mo_other_income'] = $this->input->post('mo_other_income');

        //09. Total gross annual income of father and mother [grand total of sections 7 and 8]:
        $savestu['total_income'] = $this->input->post('total_income');

        //10.
        $savestu['guardians_status'] = $this->input->post('guardians_status');
        /*$savestu['ga_name']= $this->input->post('ga_name');
        $savestu['ga_address']= $this->input->post('ga_address');
        $savestu['ga_post']= $this->input->post('ga_post');*/
        $savestu['ga_income'] = $this->input->post('ga_income');

        //Need Index 
        $savestu['need_index'] = $this->input->post('need_index');
        $savestu['gramasewaka'] = $this->input->post('chk_gramasewaka');
        $savestu['divisional_secretariat'] = $this->input->post('chk_divisional_secretariat');
        // print_r($savestu);
        if ($mahapola_id == '') {
            $savestu['create_by'] = $this->session->userdata('u_id');
            $savestu['created_date'] = date("Y-m-d h:i:s", now());
            //insert
            $result = $this->db->insert('stu_reg_mahapola', $savestu);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Mahapola form saved successfully.');
                $this->logger->systemlog('Mahapola Registation', 'Success', 'Mahapola form saved successfully..', date("Y-m-d H:i:s", now()),$savestu);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to save Mahapola form. Retry.');
                $this->logger->systemlog('Mahapola Registation', 'Failure', 'Failed to save Mahapola form.', date("Y-m-d H:i:s", now()),$savestu);
            }
        } else {
            $savestu['updated_by'] = $this->session->userdata('u_id');
            $savestu['updated_on'] = date("Y-m-d h:i:s", now());
            //update
            $this->db->where('stu_id', $stu_id);
            $this->db->where('mahapola_id', $mahapola_id);
            $result = $this->db->update('stu_reg_mahapola', $savestu);
            if ($result) {
                $this->session->set_flashdata('flashSuccess', 'Mahapola form updated successfully.');
                $this->logger->systemlog('Mahapola Update', 'Success', 'Mahapola form updated successfully.', date("Y-m-d H:i:s", now()),$savestu);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to update Mahapola form. Retry.');
                $this->logger->systemlog('Mahapola Update', 'Failure', 'Failed to update Mahapola form.', date("Y-m-d H:i:s", now()),$savestu);

            }
        }
        return $result;
        //redirect('student/student_lookup');

    }

    function load_reg_no_list()
    {

        $this->db->select('*');
        $this->db->where('approved', 1);
        $this->db->where('deleted', 0);
        $reg_no_query = $this->db->get('stu_reg')->result_array();

        return $reg_no_query;
    }

    function load_reg_no_list_transfer()
    {

        $this->db->select('stu_id, reg_no');
        $this->db->where('approved', 1);
        $this->db->where('deleted', 0);
        $reg_no_query = $this->db->get('stu_reg')->result_array();

        return $reg_no_query;
    }
    
    function load_nic_no_list_transfer(){
        $this->db->select('stu_id, nic_no');
        $this->db->where('approved', 1);
        $this->db->where('deleted', 0);
        $nic_no_query = $this->db->get('stu_reg')->result_array();

        return $nic_no_query;
    }

    function load_reg_no_list_remove()
    {

        $this->db->select('stu_id, reg_no');
        $reg_no_query = $this->db->get('stu_reg')->result_array();

        return $reg_no_query;
    }
    
    function load_nic_no_list_remove()
    {

        $this->db->select('stu_id, nic_no');
        $nic_no_query = $this->db->get('stu_reg')->result_array();

        return $nic_no_query;
    }

    function load_reg_no_list_by_center()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('*');
        $this->db->join('cfg_branch br', 'br.br_id=sr.center_id');
        // $this->db->join('edu_course ec', 'ec.id=sr.course_id');

        $this->db->where('sr.center_id', $user_branch);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        $reg_no_query = $this->db->get('stu_reg sr')->result_array();

        return $reg_no_query;
    }

    function load_reg_no_list_by_center_transfer()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('stu_id, reg_no');
        $this->db->join('cfg_branch br', 'br.br_id=sr.center_id');
        // $this->db->join('edu_course ec', 'ec.id=sr.course_id');

        $this->db->where('sr.center_id', $user_branch);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        $reg_no_query = $this->db->get('stu_reg sr')->result_array();

        return $reg_no_query;
    }
    
    function load_nic_no_list_by_center_transfer()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('stu_id, nic_no');
        $this->db->join('cfg_branch br', 'br.br_id=sr.center_id');
        // $this->db->join('edu_course ec', 'ec.id=sr.course_id');

        $this->db->where('sr.center_id', $user_branch);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.deleted', 0);
        $reg_no_query = $this->db->get('stu_reg sr')->result_array();

        return $reg_no_query;
    }
    
    

    function load_reg_no_list_by_center_remove()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('stu_id, reg_no');
        $this->db->join('cfg_branch br', 'br.br_id=sr.center_id');
        // $this->db->join('edu_course ec', 'ec.id=sr.course_id');

        $this->db->where('sr.center_id', $user_branch);
        $reg_no_query = $this->db->get('stu_reg sr')->result_array();

        return $reg_no_query;
    }
    
    function load_nic_no_list_by_center_remove()
    {
        $user_branch = $this->session->userdata('user_branch');

        $this->db->select('stu_id, nic_no');
        $this->db->join('cfg_branch br', 'br.br_id=sr.center_id');
        // $this->db->join('edu_course ec', 'ec.id=sr.course_id');

        $this->db->where('sr.center_id', $user_branch);
        $reg_no_query = $this->db->get('stu_reg sr')->result_array();

        return $reg_no_query;
    }

    function get_center_students_reg_no()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('reg.*,de.course_code, de.course_name');
        $this->db->join('edu_course de', 'de.id=reg.course_id');
        //$this->db->where_in('reg.center_id', $branchlist);
        //$this->db->where_in('de.faculty_id', $faclist);
        $this->db->where('center_id', $user_branch);
        $this->db->where('approved', 1);
        $result_array = $this->db->get('stu_reg reg')->result_array();
        return $result_array;
    }

    function get_student_reg_id()
    {
        
        $search_type = $this->input->post('search_type');
        $reg_no = $this->input->post('reg_no');
        
        

        $this->db->select('*');
        if($search_type == 0){
            $this->db->where('reg_no', $reg_no);
        }else{
            $this->db->where('nic_no', $reg_no);
        }
        $this->db->where('deleted', 0);
        $reg_query = $this->db->get('stu_reg')->result_array();

        return $reg_query;
    }

    function remove_student($reg_no, $search_type_remove)
    {
        /* previous */
            //$this->db->where('reg_no', $reg_no);
            //$this->db->delete('stu_reg');
            //$this->logger->systemlog('Remove Student', 'Success', 'Removed Student successfully.', date("Y-m-d H:i:s", now()), array('student_reg_no'=>$reg_no));
            //return $this->db->affected_rows();
        /* previous */
        
        if($search_type_remove == 0){
            $this->db->delete('stu_reg', array('reg_no' => $reg_no));
            $this->db->delete('ath_user', array('user_name' => $reg_no));
            
            $this->logger->systemlog('Remove Student', 'Success', 'Removed Student successfully.', date("Y-m-d H:i:s", now()), array('student_reg_no'=>$reg_no));
            //return $this->db->affected_rows();
            ////$this->db->where('reg_no', $reg_no);
            ////$del_reg_no = $reg_no;
            
            ////$this->db->delete('stu_reg');
            //Delete user from ath_user
            ////$this->db->delete('ath_user');
        }else{
            $this->db->select('reg_no');
            $this->db->where('nic_no', $reg_no);
            $nic_query = $this->db->get('stu_reg')->row_array();
            
            
            $this->db->delete('ath_user', array('user_name' => $nic_query['reg_no']));
            $this->db->delete('stu_reg', array('nic_no' => $reg_no));
            
            
            //$this->logger->systemlog('Remove Student', 'Success', 'Removed Student successfully.', date("Y-m-d H:i:s", now()), array('student_reg_no'=>$nic_query));
            
            //$this->db->where('nic_no', $reg_no);
            //$this->db->delete('stu_reg');
            //$this->logger->systemlog('Remove Student', 'Success', 'Removed Student successfully.', date("Y-m-d H:i:s", now()), array('student_reg_no'=>$reg_no));
            //$this->db->delete('stu_reg', array('nic_no' => $reg_no));
            //$this->logger->systemlog('Remove Student', 'Success', 'Removed Student successfully.', date("Y-m-d H:i:s", now()), array('student_reg_no'=>$reg_no));
        }
        //$this->db->delete('stu_reg');
        //Delete user from ath_user
        
        
        return $this->db->affected_rows();
    }

    function save_transfer_student()
    {
        $this->db->trans_begin();
        
        $stu_id = $this->input->post('stu_id');
        $savestu['reg_no'] = $this->input->post('reg_no_part1') . $this->input->post('reg_no_part2');
        $savestu['center_id'] = $this->input->post('center_id');
        $savestu['course_type'] = $this->input->post('course_type');
        $savestu['course_id'] = $this->input->post('course_id');
        $savestu['updated_by'] = $this->session->userdata('u_id');
        $savestu['updated_on'] = date("Y-m-d H:i:s", now());
        
//        $savestu['search_type'] = $this->input->post('search_type');
        
        $this->db->select('stu_id, reg_no, center_id, course_id, course_type');
        $this->db->where('stu_id', $stu_id);
        $stuPreData = $this->db->get('stu_reg')->row_array();       

        //update
        $this->db->where('stu_id', $stu_id);
        $result = $this->db->update('stu_reg', $savestu);

        //*****************Updating user table
        //Get NEW CenterID, New GroupID 
        $this->db->select('ug_id');
        $this->db->where('ug_level', 5);
        $this->db->where('ug_branch', $this->input->post('center_id'));
        $user_PreData = $this->db->get('ath_usergroup')->row_array();  
        // Update NEW CenterID, New GroupID 
        $user_name = $this->input->post('reg_no_part1') . $this->input->post('reg_no_part2');
        
        //New array for upate user table.
        $update_user_Array = array(
            'user_name' => $user_name,
            'user_ugroup' => $user_PreData['ug_id'],
            'user_branch' => $this->input->post('center_id')
        );
        $this->db->where('user_ref_id', $stu_id);
        $this->db->where('user_type', "student");
        $user_result = $this->db->update('ath_user', $update_user_Array);   
        //*************************************
        $insertArray = array(
            'stu_id' => $stu_id,
            'old_reg_no' => $stuPreData['reg_no'],
            'new_reg_no' => $savestu['reg_no'],
            'old_center_id' => $stuPreData['center_id'],
            'new_center_id' => $savestu['center_id'],
            'old_course_id' => $stuPreData['course_id'],
            'new_course_id' => $savestu['course_id'],
            'old_course_type' => $stuPreData['course_type'],
            'new_course_type' => $savestu['course_type']
        );
        $insert_result = $this->db->insert('stu_transfer', $insertArray);

        if ($result == TRUE && $user_result == TRUE && $insert_result == TRUE) {
            $this->db->trans_commit();
            $this->session->set_flashdata('flashSuccess', 'Student Transfered Successfully.');
            $this->logger->systemlog('Transfer Student', 'Success', 'Student Transfered Successfully.', date("Y-m-d H:i:s", now()), $savestu);
            $this->session->set_flashdata('insert_id', $stu_id);

            redirect('student/transfer_student');
        } else {
            $this->db->trans_rollback();
            $this->session->set_flashdata('flashError', 'Failed to Transfer Student. Retry.');
            $this->logger->systemlog('Transfer Student', 'Failure', 'Failed to Transfer Student.', date("Y-m-d H:i:s", now()), $savestu);
            //redirect('student/student_lookup');
        }


    }

    function get_login_user_centers()
    {

        $loginuser_group = $this->session->userdata('u_ugroup');
        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }

    function get_all_centers()
    {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }

    function get_center_admin_login_centers()
    {

        $loginuser_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }

    function get_user_access_right($function)
    {

        $this->db->select('func_id');
        $this->db->where('func_url', $function);
        $func_id = $this->db->get('ath_authfunction')->row_array();

        $this->db->select('*');
        $this->db->join('ath_authrightgroup', 'ath_authright.rgt_rightgroup = ath_authrightgroup.rlist_id');
        $this->db->where('ath_authrightgroup.rlist_usergroup', $this->session->userdata('u_ugroup'));
        $this->db->where('rgt_refid', $func_id['func_id']);
        $has_func_rights['user_rights'] = $this->db->get('ath_authright')->row_array();

        $this->db->where('ug_id', $this->session->userdata('u_ugroup'));
        $has_func_rights['user_level'] = $this->db->get('ath_usergroup')->row_array();

        if ($has_func_rights) {
            return $has_func_rights;
        } else {
            return NULL;
        }

    }

    function get_user_access_right_for_sub_menu($function)
    {

        $this->db->select('func_id');
        $this->db->where('func_url', $function);
        $func_id = $this->db->get('ath_authfunction')->row_array();

        $this->db->select('*');
        $this->db->join('ath_authrightgroup', 'ath_authright.rgt_rightgroup = ath_authrightgroup.rlist_id');
        $this->db->where('ath_authrightgroup.rlist_usergroup', $this->session->userdata('u_ugroup'));
        $this->db->where('rgt_refid', $func_id['func_id']);
        $has_mahapola_rights['user_rights'] = $this->db->get('ath_authright')->row_array();

        $this->db->where('ug_id', $this->session->userdata('u_ugroup'));
        $has_mahapola_rights['user_level'] = $this->db->get('ath_usergroup')->row_array();

        if ($has_mahapola_rights) {
            return $has_mahapola_rights;
        } else {
            return NULL;
        }

    }

    function update_mahapola_eligible_status($mpyear)
    {       
        $update_result = '';

        $update_mahapola['is_eligible'] = 0;
        $this->db->where('(EXTRACT(YEAR FROM created_date))=', $mpyear);
        $mpyear_update = $this->db->update('stu_reg_mahapola', $update_mahapola);
        
        if($mpyear_update){
 
            $this->db->select('*');
            $this->db->from('stu_reg_mahapola srmp');
            $this->db->join('stu_reg sreg', 'sreg.stu_id=srmp.stu_id');
            $this->db->where('srmp.approved', 1);
            $this->db->where('srmp.director_approved', 1);
            $this->db->where('srmp.is_eligible', 0);
            $this->db->where('sreg.approved', 1);
            $this->db->where('sreg.deleted', 0);
            $this->db->where('sreg.apply_mahapola', 1);
            $this->db->order_by('srmp.need_index', 'DESC');
//            $this->db->order_by('CONVERT(sreg.al_z_core, DOUBLE) DESC');
            $this->db->order_by('cast(sreg.al_z_core as decimal(5,4)) DESC');
            $this->db->limit('1500');
            $eligible = $this->db->get()->result_array();

            foreach ($eligible as $elig) {
                $update_status['is_eligible'] = 1;
//                $update_status['is_eligible_datetime'] = date("Y-m-d H:i:s", now());
//                $update_status['is_eligible_done_by'] = $this->session->userdata('u_id');
                
                $this->db->where('stu_id', $elig['stu_id']);
                $this->db->where('mahapola_id', $elig['mahapola_id']);
                $this->db->where('(EXTRACT(YEAR FROM created_date))=', $mpyear);
                $update_result = $this->db->update('stu_reg_mahapola', $update_status);
            }

            if ($update_result) {
                $this->session->set_flashdata('flashSuccess', 'Student updated successfully!');
                $this->logger->systemlog('Mahapola Eligible List Update', 'Success', 'Student updated successfully.', date("Y-m-d H:i:s", now()),$eligible);
                $this->logger->systemlog('Mahapola Eligible List Update', 'Success', 'Mahapola Student Eligible Updated Details.', date("Y-m-d H:i:s", now()),$update_status);
            } else {
                $this->session->set_flashdata('flashError', 'Student updation failed!');
                $this->logger->systemlog('Mahapola Eligible List Update', 'Failure', 'Student updation failed.', date("Y-m-d H:i:s", now()),$eligible);
            }
        }
        else{
            $this->session->set_flashdata('flashError', 'Student updation failed!');
            $this->logger->systemlog('Mahapola Eligible List Update', 'Success', 'Student updation failed.', date("Y-m-d H:i:s", now()),array('mpyear'=>$mpyear));
        }

    }


    function check_duplicate_nic_no()
    {

        $nic_no = $this->input->post('nic_no');

        $this->db->select('count(stu_id) as nic_count');
        $this->db->where('nic_no', $nic_no);
        $nic_query = $this->db->get('stu_reg')->row_array();

        return $nic_query;
    }
    
    function check_duplicate_nic_no_online_reg()
    {

        $nic_no = $this->input->post('nic_no');

        $this->db->select('count(stu_id) as nic_count');
        $this->db->where('nic_no', $nic_no);
        $stureg_nic_query = $this->db->get('stu_reg')->row_array();
        
        $this->db->select('count(stu_id) as nic_count');
        $this->db->where('nic_no', $nic_no);
        $stureg_online_nic_query = $this->db->get('stu_reg_online_registration')->row_array();
        
        if($stureg_nic_query['nic_count'] >= 1 || $stureg_online_nic_query['nic_count'] >= 1)
            $nic_query['nic_count'] = 1;
        else
            $nic_query['nic_count'] = 0;
                    

        return $nic_query;
    }


    function load_courses_complete()
    {

        $this->db->select('de.*, de.id as course_id, yr.no_of_year');
        $this->db->join('edu_year yr', 'de.id=yr.course_id');
        $this->db->join('edu_semester se', 'se.year_id=yr.id');
        $this->db->join('stu_reg sr', 'sr.course_id=de.id');
        $this->db->where('de.deleted', 0);
        $this->db->where('yr.deleted', 0);
        $this->db->where('se.deleted', 0);
        $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        $this->db->distinct();
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    
    
    function load_student_courses()
    {

        $this->db->select('de.*, de.id as course_id');
        //$this->db->join('edu_year yr', 'de.id=yr.course_id');
        //$this->db->join('edu_semester se', 'se.year_id=yr.id');
        $this->db->join('stu_reg sr', 'sr.course_id=de.id');
        $this->db->where('de.deleted', 0);
        //$this->db->where('yr.deleted', 0);
        //$this->db->where('se.deleted', 0);
        $this->db->where('sr.stu_id', $this->session->userdata('user_ref_id'));
        $this->db->distinct();
        $courses = $this->db->get('edu_course de')->result_array();
        return $courses;
    }
    
    
    function load_rpt_student_for_exam_marks_ca($data)
    {
        $this->db->select('sedr.is_repeat,sedr.repeat_apply_for,sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat', 1);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('eser.deleted', 0);
        //$this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();
        
        
        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat', 1);
            //$this->db->where('sedr.is_repeat_approved', 1);
            $this->db->where('sedr.deleted', 0);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {

                // $this->db->select('*,co.code as subject_code');
               /* $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
                em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $this->db->where('sedr.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();*/

                /// load repeate students
                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,
                em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');//,sedr.is_repeat,sedr.repeat_apply_for
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
               
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
               
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
             
                $this->db->where('em.is_repeat_mark', 1);
                $this->db->where('sedr.deleted', 0);
                $this->db->where('co.is_training_apply', 0);

                $result_array[$i]['rpt_exam_mark'] = $this->db->get('exm_mark em')->result_array(); 


               /* $this->db->select('*');
                $this->db->where('course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('year_no', $data['year_no']);
                $this->db->where('semester_no', $data['semester_no']);
                $this->db->where('student_id', $result_array[$i]['stu_id']);
               
                $this->db->where('exam_mark_deleted', 0);
                $this->db->where('detail_deleted', 0);
             
                $this->db->where('is_repeat_mark', 1);
                $this->db->where('sedr_deleted', 0);
                $this->db->where('is_training_apply', 0);
                $result_array[$i]['rpt_exam_mark'] = $this->db->get('rpt_marks ')->result_array(); */
            }
        }
//        print_r($result_array);
        return $result_array;
    }
    
    
    function load_rpt_student_for_exam_marks_se($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat', 1);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('eser.deleted', 0);
        //$this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 0);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat', 1);
            //$this->db->where('sedr.is_repeat_approved', 1);
            $this->db->where('sedr.deleted', 0);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {
//                $this->db->select('batch_id');
//                $this->db->where('student_id', $result_array[$i]['stu_id']);
//                $this->db->where('subject_id', $result_array[$i]['applied_subjects'][$x]['subject_id']);
//                $this->db->where('course_id', $data['course_id']);
//                $this->db->where('year_no', $data['year_no']);
//                $this->db->where('semester_no', $data['semester_no']);
//                $this->db->where('deleted', 0);
//                $stu_batch = $this->db->get('exm_mark')->row_array();
//                if($stu_batch){
//                    $rbatch = $stu_batch['batch_id'];
//                }
//                else{
//                    $rbatch = $result_array[$i]['batch_id'];
//                }
                

                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.is_recorrection_approved,sedr.is_repeat,sedr.repeat_apply_for, sedr.is_repeat_approved');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $this->db->where('sedr.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();     

                 /// load repeate students
                 $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
                 em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                 ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,sedr.is_repeat,sedr.repeat_apply_for');
                 $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                 $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                 $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                 $this->db->join('mod_subject co', 'co.id = em.subject_id');
                 $this->db->where('em.course_id', $data['course_id']);
                 //$this->db->where('em.batch_id', $data['batch_id']);
                 //$this->db->where('em.batch_id', $rbatch);
                 $this->db->where('em.year_no', $data['year_no']);
                 $this->db->where('em.semester_no', $data['semester_no']);
                 $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                 $this->db->where('co.is_training_apply', 0);
                 $this->db->where('em.deleted', 0);
                 $this->db->where('ed.deleted', 0);
                 $this->db->where('sedr.deleted', 0);
                 $this->db->where('em.is_repeat_mark', 1);
                 $result_array[$i]['rpt_exam_mark'] = $this->db->get('exm_mark em')->result_array(); 



                
                for ($y = 0; $y < count($result_array[$i]['exam_mark']); $y++) {
                    $data['subject_id'] = $result_array[$i]['exam_mark'][$y]['subject_id'];
                    $result_array[$i]['exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
                   
                }
                for ($y = 0; $y < count($result_array[$i]['rpt_exam_mark']); $y++) {
                    $data['subject_id'] = $result_array[$i]['rpt_exam_mark'][$y]['subject_id'];
                    $result_array[$i]['rpt_exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
                   
                }
            }
        }
//        print_r($result_array);
        return $result_array;
    }
    
    
    function load_rpt_student_for_exam_marks_training($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('exm_semester_exam ese', 'eser.semester_exam_id = ese.exam_id');
        $this->db->join('exm_semester_exam_details esed', 'eser.exm_semester_exam_details = esed.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = eser.stu_id');
        $this->db->join('mod_subject co', 'co.id = eser.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('sr.center_id', $data['center_id']);       
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('co.is_training_apply', 1);
        $this->db->where('ese.deleted', 0);
        //$this->db->where('eser.is_repeat', 1);
        //$this->db->where('eser.is_repeat_approved', 1);
        $this->db->where('eser.deleted', 0);
        //$this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->group_by('eser.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam_details_repeat eser')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code,sed.is_approved as is_approved,co.id as subject_id');
            $this->db->join('exm_semester_exam_details_repeat sedr', 'se.exam_id = sedr.semester_exam_id');
            $this->db->join('exm_semester_exam_details sed', 'sedr.exm_semester_exam_details = sed.id');
            $this->db->join('mod_subject co', 'co.id = sedr.subject_id');
            $this->db->where('se.course_id', $data['course_id']);
            $this->db->where('se.batch_id', $data['batch_id']);
            $this->db->where('se.year_no', $data['year_no']);
            $this->db->where('se.semester_no', $data['semester_no']);
            $this->db->where('sedr.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('co.is_training_apply', 1);
            $this->db->where('se.deleted', 0);
            //$this->db->where('sedr.is_repeat', 1);
            //$this->db->where('sedr.is_repeat_approved', 1);
            $this->db->where('sedr.deleted', 0);
            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
            
            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {

                $this->db->select('em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,em.is_recorrection_approved,sedr.is_repeat,sedr.repeat_apply_for, sedr.is_repeat_approved,em.result');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('exm_semester_exam_details_repeat sedr', 'esed.id = sedr.exm_semester_exam_details');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $data['batch_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
                $this->db->where('co.is_training_apply', 1);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $this->db->where('sedr.deleted', 0);
                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();  
            }
        }
        return $result_array;
    }
    
    
    function save_student_subjects_support($data)
    {
        $this->db->trans_begin();

        $stu_list = $this->get_students_by_batch($data['batch_id'], $data['center'], $data['year_no'], $data['semester_no'], 0);
        
        foreach ($stu_list as $stu_data){
            $stu_id = $stu_data['stu_id'];
            
            $exist_id = $this->exist_student_subject_record($stu_id, $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
            $current_data = $this->current_student_data($stu_id, $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
        if ($current_data) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        if ($exist_id != NULL) {
            //update other all is_active to 0
            $this->update_stu_subject_active_flag($stu_id);
            //update
            $update_stu_cou = array(
                'student_id' => $stu_id,
                'course_id' => $data['course_id'],
                'batch_id' => $data['batch_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'is_active' => $is_active,
                'is_approved' => 1,
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d H:i:s", now()),
                'approved_by' => $this->session->userdata('u_id'),
                'approved_datetime' => date("Y-m-d H:i:s", now()));
            $this->db->where('id', $exist_id);
            $result1 = $this->db->update('stu_subject', $update_stu_cou);

            //update delete flag to 1 for all subject data and add new records
            //update
            $core_subjects = $this->student_subjects_by_type($exist_id, 1);
            for ($i = 0; $i < count($core_subjects); $i++) {
                $update_core_subjects = array(
                    'deleted' => 1,
                    'deleted_by' => $this->session->userdata('u_id'),
                    'deleted_on' => date("Y-m-d H:i:s", now())
                );

                $this->db->where('id', $core_subjects[$i]['stu_f_id']);
                $result1 = $this->db->update('stu_follow_subject', $update_core_subjects);
            }
            //insert
            if (!empty($data['core_subjects'])) {
                for ($i = 0; $i < count($data['core_subjects']); $i++) {
                    $insert_core_subjects = array(
                        'student_subject_id' => $exist_id,
                        'subject_id' => $data['core_subjects'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d H:i:s", now()),
                        'version_id' => $data['c_subject_version'][$i],
                        'subj_group' => $data['subj_group']
                    );
                    //insert core subjects
                    $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                }
            }
        } else {
            //insert 
            $insert_stu_cou = array(
                'student_id' => $stu_id,
                'course_id' => $data['course_id'],
                'batch_id' => $data['batch_id'],
                'year_no' => $data['year_no'],
                'semester_no' => $data['semester_no'],
                'is_active' => $is_active,
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d H:i:s", now()),
                 'is_approved' => 1,
                'approved_by' => $this->session->userdata('u_id'),
                'approved_datetime' => date("Y-m-d H:i:s", now())
            );
            $result1 = $this->db->insert('stu_subject', $insert_stu_cou);
            $max_stu_co_id = $this->max_stu_subject_id();
            if (!empty($data['core_subjects'])) {
                if (count($data['core_subjects']) > 0) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
            }
        }
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save subjects';
            $this->logger->systemlog('Subject Selection', 'Failure', 'Failed to save subjects', date("Y-m-d H:i:s", now()),$data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Subjects saved successfully.';
            $this->logger->systemlog('Subject Selection', 'Success', 'Subjects saved successfully.', date("Y-m-d H:i:s", now()),$data);

        }
        return $res;
    }

    function save_online_registration()
    {
        $this->db->trans_begin();

        $savestu['center_id'] = $this->input->post('center_id');
        $savestu['first_name'] = $this->input->post('first_name');
        $savestu['last_name'] = $this->input->post('last_name');
        $savestu['civil_status'] = $this->input->post('civil_status');
        $savestu['sex'] = $this->input->post('sex');
        $savestu['nic_no'] = $this->input->post('nic_no');
        $savestu['birth_date'] = $this->input->post('birth_date');

        $savestu['age_year'] = $this->input->post('txtAgeYear');
        $savestu['age_month'] = $this->input->post('txtAgeMonth');
        $savestu['age_days'] = $this->input->post('txtAgeDays');

        $savestu['place_birth'] = $this->input->post('place_birth');
        $savestu['religion'] = $this->input->post('religion');
        $savestu['mobile_no'] = $this->input->post('mobile_no');
        $savestu['fixed_tp'] = $this->input->post('fixed_tp');
        $savestu['email'] = $this->input->post('email');
        $savestu['permanent_address'] = $this->input->post('permanent_address');
        $savestu['district'] = $this->input->post('district');

        //AL result se tion
        $savestu['al_year'] = $this->input->post('al_year');
        $savestu['al_index_no'] = $this->input->post('al_index_no');
        $savestu['al_medium'] = $this->input->post('al_medium');
        $savestu['al_stream'] = $this->input->post('al_stream');
        $savestu['al_subject1'] = $this->input->post('al_subject1');
        $savestu['al_subject2'] = $this->input->post('al_subject2');
        $savestu['al_subject3'] = $this->input->post('al_subject3');
        $savestu['al_subject4'] = $this->input->post('al_subject4');
        $savestu['al_subject1_grade'] = $this->input->post('al_subject1_grade');
        $savestu['al_subject2_grade'] = $this->input->post('al_subject2_grade');
        $savestu['al_subject3_grade'] = $this->input->post('al_subject3_grade');
        $savestu['al_subject4_grade'] = $this->input->post('al_subject4_grade');
        $savestu['common_gen_paper'] = $this->input->post('com_gen_paper');


        $savestu['al_z_core'] = $this->input->post('al_score_mode') . $this->input->post('al_z_core');


        //OL result section
        $savestu['ol_year'] = $this->input->post('ol_year');
        $savestu['ol_index_no'] = $this->input->post('ol_index_no');
        $savestu['ol_medium'] = $this->input->post('ol_medium');

        $savestu['ol_maths_grade'] = $this->input->post('ol_maths_grade');
        $savestu['ol_english_grade'] = $this->input->post('ol_english_grade');

        //Part Time course Details.
        $savestu['course_type'] = $this->input->post('course_type');
        $savestu['employment'] = $this->input->post('prt_Present_emp');
        $savestu['position'] = $this->input->post('prt_post');
        $savestu['epf_no'] = $this->input->post('prt_EPF');
        $savestu['work_place_address'] = $this->input->post('prt_address');
        $savestu['appointment_date'] = $this->input->post('prt_app_date');
        $savestu['business_reg_no'] = $this->input->post('prt_br');
        $savestu['business_reg_date'] = $this->input->post('prt_date_br');

        $savestu['course_id'] = $this->input->post('course_id');


            $savestu['approved'] = 0;
            $savestu['create_by'] = $this->session->userdata('u_id');
            $savestu['created_date'] = date("Y-m-d H:i:s", now());
            //insert
            $result = $this->db->insert('stu_reg_online_registration', $savestu);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                if (!$result) {
                    $this->session->set_flashdata('flashError', 'Registration Failed. Retry.');
                }

            } else {
                $this->db->trans_commit();
                if ($result) {
                    $this->session->set_flashdata('flashSuccess', 'Student form submitted successfully ! ');
                }
            }

        redirect('student/online_registration');
    }
    
    
    function check_student_approved_status($ug_level){
        $result_data = [];
        
        if($ug_level == 5){
            $this->db->select('st.stu_id, st.reg_no, st.approved');
            $this->db->where('st.stu_id', $this->session->userdata('user_ref_id'));
            $result_data = $this->db->get('stu_reg st')->result_array();
        }
        
        return $result_data;
    }
    
    function applied_exam_students_approval($data, $batch_details)
    {

        $assign_subjects = Array();
        $subjects = Array();
        if ($data['access_level'] == 4){
            $lec_id =  $this->session->userdata('user_ref_id');
            $this->db->select('subject_id');
            $this->db->where('course_id',$batch_details['course_id']);
            $this->db->where('lecturer_id',$lec_id);
            $this->db->where('deleted',0);
            $assign_subjects = $this->db->get('sta_lecturer_subject')->result_array();
            
            if(!empty($assign_subjects)){
                for($j=0; $j<count($assign_subjects); $j++){
                    $subjects[] = $assign_subjects[$j]['subject_id'];
                }
            }
            
        }
        
        $this->db->select('*,stu.deleted as stu_deleted, SUBSTRING_INDEX(stu.reg_no, "/", -1) as regno_order');

        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
        $this->db->join('exm_semester_exam_details esxd', 'esxd.student_id = stu.stu_id');
        $this->db->where('sc.course_id', $batch_details['course_id']);
        $this->db->where('sc.year_no', $batch_details['current_year']);
        $this->db->where('sc.semester_no', $batch_details['current_semester']);
        $this->db->where('stu.deleted', 0);
        $this->db->where('esxd.is_approved', 1);

        $this->db->where('stu.batch_id', $data['batch_id']);
        $this->db->where('stu.center_id', $data['branch']);
        
            
        $this->db->group_by('stu.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');//////////Query Change
        $result_array = $this->db->get('stu_reg stu')->result_array();

        $sem_exam_id = $this->get_semetser_exam_id($batch_details['course_id'],$batch_details['current_year'],$batch_details['current_semester'],$data['batch_id']);
        
        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code ,`co`.id as subject_no');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            
            $this->db->join('exm_semester_exam_details exmd', 'co.id = exmd.subject_id');
            
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('fc.deleted', 0);
            
            $this->db->where('exmd.student_id', $result_array[$i]['stu_id']);
            $this->db->where('exmd.semester_exam_id', $sem_exam_id);
            $this->db->where('exmd.deleted', 0);
            if ($data['access_level'] == 4){
                if(!empty($subjects)){
                   $this->db->where_in('exmd.subject_id', $subjects); 
                }
            }
            
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }
        return $result_array;
    }
    
    function get_courses()
    {

        $this->db->select('*');
        $result_array = $this->db->get('edu_course')->result_array();

        return $result_array;
    } 
    
    function search_terminate_batch_lookup($data) {

        $this->db->select('eb.batch_code,ay.ac_startdate,ay.ac_enddate,eb.description,eb.id');
        $this->db->join('edu_batch eb', 'eb.id = ec.batch_id');
        $this->db->join('cfg_academicyears ay', 'ay.es_ac_year_id = eb.study_season_id');
        $this->db->where('ec.course_id', $data['tb_course_id']);
        $this->db->where('eb.iscompleted',0);
        $this->db->group_by('eb.batch_code');
        $this->db->order_by('eb.batch_code', "asc");

        $transfer_result_array = $this->db->get('edu_center_course ec')->result_array();
        
        return $transfer_result_array;
    }
    
    function update_batch_terminate_status($data)
    {
        $res = [];
        $update_data = array(
            'iscompleted' => 1
        );
        
        $this->db->where('id', $data['batch_id']);
        $t_result = $this->db->update('edu_batch', $update_data); 
        if($t_result){
            $res['status'] = "success";
            $res['message'] = "Batch Deactivated Successfully";
            $this->logger->systemlog('Update Terminate Batch Status', 'Success', 'Batch Deactivated Successfully.', date("Y-m-d H:i:s", now()), $data);

        }else{
            $res['status'] = "fail";
            $res['message'] = "Batch Deactivation Failed";
            $this->logger->systemlog('Update Terminate Batch Status', 'Failed', 'Batch Deactivation Failed', date("Y-m-d H:i:s", now()), $data);
        }
        return $res;
    }
    
    function dummy_update_subjects($data,$obj){
        for ($i = 0; $i < count($obj); $i++) {
            $data['student_id'] = $obj[$i]['ccheck_student_id'];
            
            $exist_id = $this->exist_student_subject_record($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
            $current_data = $this->current_student_data($data['student_id'], $data['course_id'], $data['batch_id'], $data['year_no'], $data['semester_no']);
            
            if ($current_data) {
                $is_active = 1;
            } else {
                $is_active = 0;
            }
            
            if ($exist_id == NULL) {
                $insert_stu_cou = array(
                    'student_id' => $obj[$i]['ccheck_student_id'],
                    'course_id' => $data['course_id'],
                    'batch_id' => $data['batch_id'],
                    'year_no' => $data['year_no'],
                    'semester_no' => $data['semester_no'],
                    'is_active' => $is_active,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d H:i:s", now())
                
                );
                $result1 = $this->db->insert('stu_subject', $insert_stu_cou);
                $max_stu_co_id = $this->max_stu_subject_id();
                
                for ($j = 0; $j < count($obj[$i]['core_subsjects']); $j++) {
                    $insert_core_subjects = array(
                        'student_subject_id' => $max_stu_co_id,
                        'subject_id' => $obj[$i]['core_subsjects'][$j]['arrayOfValues1'],
                        'version_id' => $obj[$i]['core_subsjects'][$j]['arrayOfValues2'],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d H:i:s", now()),
                        'subj_group' => $obj[$i]['core_sub_group']
                    );
                    //insert core subjects
                    $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                }
                
                if (count($obj[$i]['elect_subs']) > 0) {
                    for ($k = 0; $k < count($obj[$i]['elect_subs']); $k++) {
                        $insert_elec_subjects = array(
                            'student_subject_id' => $max_stu_co_id,
                            'subject_id' => $obj[$i]['elect_subs'][$k]['arrayOfValues1'],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $obj[$i]['elect_subs'][$k]['arrayOfValues2'],
                            'subj_group' => $obj[$i]['elect_sub_group']
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_elec_subjects);
                    }
                }
                
                
            }
        }
    }
    
    
    function load_student_wise_exam_marks_for_file_upload($data)
    {
        $this->db->select('sr.stu_id,sr.reg_no,sr.admission_no,sr.first_name,sr.last_name,sr.batch_id, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('exm_semester_exam_details esed', 'esed.semester_exam_id = ese.id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject co', 'co.id = esed.subject_id');

        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('co.is_training_apply', 0);
        $this->db->where('ese.deleted', 0);
        $this->db->where('ese.is_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('esed.student_id', $data['student_id']);
        $this->db->where('esed.subject_id', $data['subject_id']);
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('exm_semester_exam ese')->result_array();
        
        if(count($result_array) > 0){
            $this->db->select('em.is_ex_director_mark_approved, em.is_recorrection_approved, em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
                        em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
                        ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved');
                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
                $this->db->join('mod_subject co', 'co.id = em.subject_id');
                $this->db->where('em.course_id', $data['course_id']);
                //$this->db->where('em.batch_id', $rbatch);
                $this->db->where('em.year_no', $data['year_no']);
                $this->db->where('em.semester_no', $data['semester_no']);
                $this->db->where('em.student_id', $result_array[0]['stu_id']);
                $this->db->where('co.is_training_apply', 0);
                $this->db->where('em.deleted', 0);
                $this->db->where('ed.deleted', 0);
                $result_array[0]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
                
                for ($y = 0; $y < count($result_array[0]['exam_mark']); $y++) {
                    $data['subject_id'] = $result_array[0]['exam_mark'][$y]['subject_id'];
                    $result_array[0]['exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
                }
        }       

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
//            $this->db->where('co.is_training_apply', 0);
//            $this->db->where('se.deleted', 0);
//            //$this->db->where('sed.is_approved', 1);
//            $result_array[$i]['applied_subjects'] = $this->db->get('exm_semester_exam se')->result_array();
//            
//            for ($x = 0; $x < count($result_array[$i]['applied_subjects']); $x++) {
//
//                // $this->db->select('*,co.code as subject_code');
//                $this->db->select('em.is_ex_director_mark_approved, em.is_recorrection_approved, em.id,em.student_id,em.subject_id,em.total_marks,em.overall_grade,em.result,em.is_hod_mark_aproved,em.is_director_mark_approved,em.is_ex_director_mark_approved,
//    em.deleted,em.exam_status,co.`code` AS subject_code,ed.mark,ed.persentage,ed.exam_type_id,ed.is_director_mark_approved AS detail_is_director_mark_approved,
//    ed.is_hod_mark_aproved as detail_is_hod_mark_aproved,ed.deleted as detail_deleted,em.is_repeat_approve,em.is_repeat_mark,em.sem_exam_id,esed.is_approved as subj_approved');
//                $this->db->join('exm_mark_details ed', 'em.id = ed.exam_mark_id');
//                $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
//                $this->db->join('mod_subject co', 'co.id = em.subject_id');
//                $this->db->where('em.course_id', $data['course_id']);
//                //$this->db->where('em.batch_id', $rbatch);
//                $this->db->where('em.year_no', $data['year_no']);
//                $this->db->where('em.semester_no', $data['semester_no']);
//                $this->db->where('em.student_id', $result_array[$i]['stu_id']);
//                $this->db->where('co.is_training_apply', 0);
//                $this->db->where('em.deleted', 0);
//                $this->db->where('ed.deleted', 0);
//                $result_array[$i]['exam_mark'] = $this->db->get('exm_mark em')->result_array();
//                
//                for ($y = 0; $y < count($result_array[$i]['exam_mark']); $y++) {
//                    $data['subject_id'] = $result_array[$i]['exam_mark'][$y]['subject_id'];
//                    $result_array[$i]['exam_mark'][$y]['marking_details'] = $this->Approval_model->get_subject_marking_method_details($data);
//                }
//            }
//        }
//        print_r($result_array);
        return $result_array;
    }
    
}

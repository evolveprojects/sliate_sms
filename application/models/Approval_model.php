<?php

class Approval_model extends CI_Model
{

    public function get_all_approval_students($year)
    {

        $this->db->select('*,SUBSTRING_INDEX(reg_no, "/", -1) as regno_order');
        $this->db->where('approved', 0);
        $this->db->where('deleted', 0);
        $this->db->where('EXTRACT(YEAR FROM created_date) = ' . $year);
        $this->db->order_by("center_id", 'ASC');
        $this->db->order_by("course_id", 'ASC');
        $this->db->order_by("CAST(regno_order as SIGNED INTEGER)", 'ASC');
        $result_array = $this->db->get('stu_reg')->result_array();
        return $result_array;
    }

    public function get_all_approval_mahapola_students()
    {

        $this->db->select('reg.stu_id,reg.reg_no,reg.nic_no,reg.center_id,UPPER(reg.first_name) as first_name,srm.email_sent_status as mahapola_email_status,SUBSTRING_INDEX(reg.reg_no, "/", -1) as regno_order');
        $this->db->join('stu_reg reg', 'srm.stu_id=reg.stu_id');
        $this->db->where('srm.approved', 0);
        $this->db->where('reg.apply_mahapola', 1);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.deleted', 0);
        $this->db->order_by("center_id", 'ASC');
        $this->db->order_by("course_id", 'ASC');
        $this->db->order_by("CAST(regno_order as SIGNED INTEGER)", 'ASC');

        $result_array = $this->db->get('stu_reg_mahapola srm')->result_array();

        return $result_array;
    }

    public function get_all_rejected_students($year)
    {

        $this->db->select('*');
        $this->db->where('approved', 3);
        $this->db->where('deleted', 0);
        $this->db->where('EXTRACT(YEAR FROM created_date) = ' . $year);
        $reject_array = $this->db->get('stu_reg')->result_array();
        return $reject_array;
    }

    public function get_all_rejected_mahapola_students()
    {

        $this->db->select('*,srm.email_sent_status as mahapola_email_status');
        $this->db->join('stu_reg reg', 'srm.stu_id=reg.stu_id');
        $this->db->where('srm.approved', 3);
        $this->db->where('reg.apply_mahapola', 1);
        $this->db->where('reg.approved', 1);
        $this->db->where('reg.deleted', 0);
        $reject_array = $this->db->get('stu_reg_mahapola srm')->result_array();
        return $reject_array;
    }

    public function get_mahapola_applied_years()
    {

        $this->db->select('created_date, EXTRACT(YEAR FROM created_date) as year');
        $this->db->group_by('EXTRACT(YEAR FROM created_date)');
        return $this->db->get('stu_reg_mahapola')->result_array();
    }

    //Staff PRofile Approval
    public function get_all_approval_staff()
    {

        $this->db->select('*,sta.email_sent_status as staff_email_status,br.*,tl.title_name');
        $this->db->join('cfg_branch br', 'br.br_id=sta.center_id');
        $this->db->join('com_title tl', 'tl.id=sta.tit_name');
        $this->db->where('sta.approved', 0);
        $this->db->where('sta.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_details sta')->result_array();
        return $result_array;
    }

    public function get_all_rejected_staff()
    {

        $this->db->select('*,sta.email_sent_status as staff_email_status,br.*,tl.title_name');
        $this->db->join('cfg_branch br', 'br.br_id=sta.center_id');
        $this->db->join('com_title tl', 'tl.id=sta.tit_name');
        $this->db->where('sta.approved', 3);
        $this->db->where('sta.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_details sta')->result_array();
        return $result_array;
    }

    public function get_center_approval_staff()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*,sta.email_sent_status as staff_email_status,br.*,tl.title_name');
        $this->db->join('cfg_branch br', 'br.br_id=sta.center_id');
        $this->db->join('com_title tl', 'tl.id=sta.tit_name');
        $this->db->where('sta.approved', 0);
        $this->db->where('sta.deleted', 0);
        $this->db->where('sta.center_id', $user_branch);
        $result_array = $this->db->get('sta_lecturer_details sta')->result_array();

        return $result_array;
    }

    public function get_center_rejected_staff()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*,sta.email_sent_status as staff_email_status,br.*,tl.title_name');
        $this->db->join('cfg_branch br', 'br.br_id=sta.center_id');
        $this->db->join('com_title tl', 'tl.id=sta.tit_name');
        $this->db->where('sta.approved', 3);
        $this->db->where('sta.deleted', 0);
        $this->db->where('sta.center_id', $user_branch);
        $result_array = $this->db->get('sta_lecturer_details sta')->result_array();

        return $result_array;
    }

    public function get_center_approval_students($year)
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*');
        $this->db->where('approved', 0);
        $this->db->where('deleted', 0);
        $this->db->where('center_id', $user_branch);
        $this->db->where('EXTRACT(YEAR FROM created_date) = ' . $year);
        $result_array = $this->db->get('stu_reg')->result_array();
        return $result_array;
    }

//    function get_center_approval_students_by_year($year)
    //    {
    //
    //        $user_branch = $this->session->userdata('user_branch');
    //        $this->db->select('*');
    //        $this->db->where('approved', 0);
    //        $this->db->where('deleted', 0);
    //        $this->db->where('center_id', $user_branch);
    ////        $this->db->where('EXTRACT(YEAR FROM created_date) = '.$year);
    //        $result_array = $this->db->get('stu_reg')->result_array();
    //        return $result_array;
    //    }
    //
    //
    //    function get_center_reject_students_by_year($year)
    //    {
    //
    //        $user_branch = $this->session->userdata('user_branch');
    //        $this->db->select('*');
    //        $this->db->where('approved', 3);
    //        $this->db->where('deleted', 0);
    //        $this->db->where('center_id', $user_branch);
    ////        $this->db->where('EXTRACT(YEAR FROM created_date) = '.$year);
    //        $reject_array = $this->db->get('stu_reg')->result_array();
    //        return $reject_array;
    //    }

    public function get_center_approval_mahapola_students()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*,srm.email_sent_status as mahapola_email_status');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id=sr.stu_id');
        $this->db->where('srm.approved', 0);
        $this->db->where('sr.apply_mahapola', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.center_id', $user_branch);
        $result_array = $this->db->get('stu_reg sr')->result_array();
        return $result_array;
    }

    public function get_center_rejected_students()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*');
        $this->db->where('approved', 3);
        $this->db->where('deleted', 0);
        $this->db->where('center_id', $user_branch);
        $reject_array = $this->db->get('stu_reg')->result_array();
        return $reject_array;
    }

    public function get_center_rejected_mahapola_students()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*,srm.email_sent_status as mahapola_email_status');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id=sr.stu_id');
        $this->db->where('srm.approved', 3);
        $this->db->where('sr.apply_mahapola', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('sr.center_id', $user_branch);
        $reject_array = $this->db->get('stu_reg sr')->result_array();
        return $reject_array;
    }

    public function update_student_approval_status($data)
    {

        $this->db->trans_begin();
        $update_data = array(
            'approved' => $data['approved'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        );

        $this->db->where('stu_id', $data['student_id']);
        $result = $this->db->update('stu_reg', $update_data);

        $this->db->select('*');
        $this->db->where('user_name', $data['reg_no']);
        $exist_user = $this->db->get('ath_user')->row_array();

        $this->db->select('*');
        $this->db->where('ug_branch', $data['branch']);
        $this->db->like('ug_name', 'stu_', 'after');
        $stu_groups = $this->db->get('ath_usergroup')->result_array();

        $hashed_password = hash('sha512', $data['nic']);

        if ($data['approved'] == 1) {
            if (count($exist_user) == 0) {
                $student_user_data = array(
                    'user_name' => $data['reg_no'],
                    'user_password' => $hashed_password,
                    'user_ref_id' => $data['student_id'],
                    'user_type' => 'student',
                    'user_ugroup' => $stu_groups[0]['ug_id'],
                    'user_branch' => $data['branch'],
                    'user_email' => $data['email'],
                    'user_status' => 'A',
                    'created_by' => $this->session->userdata('u_id'),
                    'created_datetime' => date("Y-m-d H:i:s", now()),
                );

                $result = $this->db->insert('ath_user', $student_user_data);
            } else {
                $user_status['user_status'] = 'A';
                $user_status['user_email'] = $data['email'];
                $user_status['updated_by'] = $this->session->userdata('u_id');
                $user_status['updated_datetime'] = date("Y-m-d H:i:s", now());
                $this->db->where('user_ref_id', $data['student_id']);
                $result = $this->db->update('ath_user', $user_status);
            }
        }
        if ($data['approved'] == 3) {
            if (count($exist_user) != 0) {
                $user_status['user_status'] = 'D';
                $user_status['updated_by'] = $this->session->userdata('u_id');
                $user_status['updated_datetime'] = date("Y-m-d H:i:s", now());
                $this->db->where('user_ref_id', $data['student_id']);
                $result = $this->db->update('ath_user', $user_status);
            }

        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            if ($data['approved']) {
                $this->session->set_flashdata('flashError', 'Failed to Reject Student. Retry.');
                $this->logger->systemlog('Student Approval', 'Failure', 'Failed to Reject Student', date("Y-m-d H:i:s", now()), $data);

            } else {
                $this->session->set_flashdata('flashError', 'Failed to Approve Student. Retry.');
                $this->logger->systemlog('Student Approval', 'Failure', 'Failed to Approve Student', date("Y-m-d H:i:s", now()), $data);

            }
        } else {
            $this->db->trans_commit();
            $this->logger->systemlog('Student Approval', 'Success', 'Successfully Approved Student', date("Y-m-d H:i:s", now()), $data);
//            if ($data['approved'] == 1) {
            //                $this->session->set_flashdata('flashSuccess', 'Student Approved Successfully');
            //            }
            //            if ($data['approved'] == 3) {
            //                $this->session->set_flashdata('flashSuccess', 'Student Rejected Successfully.');
            //            }
        }

        return $result;
    }

    public function get_student_email($stu_id)
    {

        $this->db->select('*');
        $this->db->where('sr.stu_id', $stu_id);
        $this->db->join('edu_course ec', 'ec.id=sr.course_id');
        $this->db->join('cfg_branch cb', 'cb.br_id=sr.center_id');
        $stu_email = $this->db->get('stu_reg sr')->row_array();

        return $stu_email;

    }

    public function get_staff_email($staff)
    {
        $this->db->select('*');
        $this->db->join('com_title ct', 'ct.id=sta.tit_name');
        $this->db->join('cfg_branch cb', 'cb.br_id=sta.center_id');
        $this->db->where('sta.stf_id', $staff);
        $stu_email = $this->db->get('sta_lecturer_details sta')->row_array();

        return $stu_email;

    }

    public function update_email_status($reg_no)
    {

        $email_status['email_sent_status'] = 1;
        $this->db->where('reg_no', $reg_no);
        $this->db->update('stu_reg', $email_status);
    }

    public function view_stu_prof($student_id)
    {

        $this->db->select('*');
        $this->db->where('stu_id', $student_id);
        $stu_prof = $this->db->get('stu_reg')->row_array();

        return $stu_prof;
    }

    public function get_current_subjects($stu_id)
    {
        $this->db->select('*');
        $this->db->join('stu_follow_subject sfc', 'sfc.student_subject_id=sc.id');
        $this->db->join('mod_subject co', 'co.id=sfc.subject_id');
        $this->db->where('sc.student_id', $stu_id);
        $this->db->where('sc.is_active', 1);
        $result_array = $this->db->get('stu_subject sc')->result_array();

        return $result_array;
    }

    public function load_course_list()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    public function load_batch_list()
    {
        $this->db->select('id,batch_code');
        $this->db->where('course_id', $this->input->post('selected_course_id'));
        $batches = $this->db->get('edu_batch')->result_array();

        return $batches;
    }

    public function search_students_lookup()
    {
        //$this->db->join('stu_follow_subject sfc', 'sfc.student_subject_id=sc.id');
        $this->db->select('*');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('mod_subject ms', 'ms.id = esed.subject_id');
        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('exm_exam ee', 'ese.exam_id = ee.id');

        //$this->db->where('stu_id', $data['student_id']);
        //$this->db->where('center_id',$data['center_id'] );
        //$this->db->where('course_id',$data['course_id'] );
        //$this->db->where('batch_id',$data['l_Bcode'] );
        //$this->db->where('esed.center_id', $data['center_id']);
        //$this->db->where('esed.course_id', $data['course_id']);
        //$this->db->where('esed.batch_id', $data['batch_id']);
        $this->db->where('esed.is_approved', 0);

        //$this->db->where('st.current_year', $data['year_no']);
        //$this->db->where('st.current_semester', $data['semester_no']);
        //$this->db->where('st.center_id', $data['center_id']);

        $exam_result_array = $this->db->get('exm_semester_exam_details esed')->result_array();
        //$result_array = $this->db->get('exm_exam ee')->result_array();

        return $exam_result_array;
    }

    public function change_student_mahapola_approval_status($data)
    {

        $this->db->trans_begin();
        $update_data = array(
            'email_sent_status' => 1,
            'approved' => $data['approved'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        );

        $this->db->where('stu_id', $data['student_id']);
        $result = $this->db->update('stu_reg_mahapola', $update_data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            if ($data['approved']) {
                $this->session->set_flashdata('flashError', 'Failed to Reject Student for Mahapola. Retry.');
                $this->logger->systemlog('Mahapola Approval', 'Failure', 'Failed to Reject Student for Mahapola', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

            } else {
                $this->session->set_flashdata('flashError', 'Failed to Approve Student for Mahapola. Retry.');
                $this->logger->systemlog('Mahapola Approval', 'Failure', 'Failed to Approve Student for Mahapola', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

            }
        } else {
            $this->db->trans_commit();
            if ($data['approved'] == 1) {
                $this->session->set_flashdata('flashSuccess', 'Student Approved for Mahapola Successfully');
                $this->logger->systemlog('Mahapola Approval', 'Success', 'Student Approved for Mahapola Successfully', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

            }
            if ($data['approved'] == 3) {
                $this->session->set_flashdata('flashSuccess', 'Student Rejected for Mahapola Successfully.');
                $this->logger->systemlog('Mahapola Approval', 'Success', 'Student Rejected from Mahapola Successfully', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

            }
        }

        return $result;
    }

    public function update_staff_approval_status($data)
    {

        $this->db->trans_begin();
        if ($data['approved'] == 1) {

            $hashed_password = hash('sha512', $data['nic']);
            // check user exit
            $this->db->select('*');
            $this->db->where('user_name', $data['staffindex']);
            $exist_user = $this->db->get('ath_user')->row_array();

            //get the user group
            $this->db->select('*');
            $this->db->where('ug_branch', $data['center_id']);
            $this->db->like('ug_name', 'lec_', 'after');
            $lec_groups = $this->db->get('ath_usergroup')->result_array();

            if (count($exist_user) == 0) {
                $lec_user_data = array(
                    'user_name' => $data['staffindex'],
                    'user_password' => $hashed_password,
                    'user_ref_id' => $data['stf_id'],
                    'user_type' => 'lecturer',
                    'user_ugroup' => $lec_groups[0]['ug_id'],
                    'user_branch' => $data['center_id'],
                    'user_email' => $data['stf_email'],
                    'user_status' => 'A',
                    'created_by' => $this->session->userdata('u_id'),
                    'created_datetime' => date("Y-m-d H:i:s", now()),
                );

                $result = $this->db->insert('ath_user', $lec_user_data);
            } else {
                $user_status['user_status'] = 'A';
                $user_status['updated_by'] = $this->session->userdata('u_id');
                $user_status['updated_datetime'] = date("Y-m-d H:i:s", now());
                $this->db->where('user_ref_id', $data['stf_id']);
                $result = $this->db->update('ath_user', $user_status);
            }

            $update_data = array(
                'email_sent_status' => 1,
                'approved' => $data['approved'],
                'approved_by' => $this->session->userdata('u_id'),
                'approved_datetime' => date("Y-m-d H:i:s", now()),
            );
        } else {
            $update_data = array(
                'approved' => $data['approved'],
                'approved_by' => $this->session->userdata('u_id'),
                'approved_datetime' => date("Y-m-d H:i:s", now()),
            );
        }

        $this->db->where('stf_id', $data['stf_id']);
        $result = $this->db->update('sta_lecturer_details', $update_data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            if ($data['approved'] == 3) {
                $this->session->set_flashdata('flashError', 'Failed to Reject the Staff Member !');
                $this->logger->systemlog('Staff Approval', 'Failure', 'Failed to Reject the Staff Member', date("Y-m-d H:i:s", now()), $lec_user_data);
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Approve the Staff Member. Retry !');
                $this->logger->systemlog('Staff Approval', 'Failure', 'Failed to Approve the Staff Member', date("Y-m-d H:i:s", now()), $lec_user_data);
            }
        } else {
            $this->db->trans_commit();
            if ($data['approved'] == 1) {
                $this->session->set_flashdata('flashSuccess', 'Staff Member Approved Successfully');
                $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Approved Successfully', date("Y-m-d H:i:s", now()), $lec_user_data);
            }
            if ($data['approved'] == 3) {
                $this->session->set_flashdata('flashSuccess', 'Staff Member Rejected Successfully.');
                $this->logger->systemlog('Staff Approval', 'Success', 'Staff Member Rejected Successfully', date("Y-m-d H:i:s", now()), $lec_user_data);
            }
        }

        return $result;
    }

    public function load_mahapola_course_list()
    {
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

    public function search_mahapola_approve_students_lookup($data)
    {

        $this->db->select('st.stu_id, SUBSTRING_INDEX(st.reg_no, "/", -1)as regno_order , st.reg_no,st.nic_no,st.center_id,UPPER(st.first_name) as first_name, st.deleted as stu_deleted');
        $this->db->join('edu_course de', 'de.id=st.course_id');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id=st.stu_id');

        if ($data['course_id'] != "all") {
            $this->db->where('st.course_id', $data['course_id']);
        }

        if ($data['center_id'] != "all") {
            $this->db->where('st.center_id', $data['center_id']);
        }

        if ($data['status'] == 'approve') {
            $this->db->where('srm.approved', 0);
            $this->db->where('st.apply_mahapola', 1);
            $this->db->where('st.approved', 1);
            $this->db->where('st.deleted', 0);
            $this->db->where('EXTRACT(YEAR FROM srm.created_date)=', $data['mahapola_year']);
        }
        if ($data['status'] == 'reject') {
            $this->db->where('srm.approved', 3);
            $this->db->where('st.apply_mahapola', 1);
            $this->db->where('st.approved', 1);
            $this->db->where('st.deleted', 0);
            $this->db->where('EXTRACT(YEAR FROM srm.created_date)=', $data['mahapola_year']);
        }

        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');
        $result_array = $this->db->get('stu_reg st')->result_array();

        return $result_array;

    }

    public function search_staff_tobe_approve($data)
    {

        $this->db->select('*');

        $this->db->select('sta.*,br.*,tl.title_name');
        $this->db->join('cfg_branch br', 'br.br_id=sta.center_id');
        $this->db->join('com_title tl', 'tl.id=sta.tit_name');

//        if($data['course_id'] != "all"){
        //            $this->db->where('sta.course_id', $data['course_id']);
        //        }

        if ($data['center_id'] != "all") {
            $this->db->where('sta.center_id', $data['center_id']);
        }

        if ($data['status'] == 'approve') {
            $this->db->where('sta.approved', 0);
            $this->db->where('sta.deleted', 0);
        }
        if ($data['status'] == 'reject') {
            $this->db->where('sta.approved', 3);
            $this->db->where('sta.deleted', 0);
        }

        $result_array = $this->db->get('sta_lecturer_details sta')->result_array();

        return $result_array;

    }

    public function get_all_rejected_update_students()
    {

        $this->db->select('*');

        $this->db->join('stu_upgrade sc', 'sc.stup_id = sr.lastupgradeid', 'right');
        $this->db->join('stu_upgrade_semester sus1', 'sus1.stu_id = sr.stu_id', 'right');

        $this->db->where('sus1.approved_status', 3);

        $reject_array = $this->db->get('stu_reg sr')->result_array();

        //var_dump($result_array);
        return $reject_array;
    }

    public function get_all_approval_update_students()
    {
        $this->db->select('*');

        $this->db->join('stu_upgrade sc', 'sc.stup_id = sr.lastupgradeid', 'left'); //, 'left'
        $this->db->join('stu_upgrade_semester sus1', 'sus1.stu_id = sr.stu_id', 'left');

        $this->db->where('sus1.approved_status', 0);

        $result_array = $this->db->get('stu_reg sr')->result_array();

        //var_dump($result_array);
        return $result_array;
    }

    public function update_stu_apprv_sem_upgrade_status($data)
    {

        //$stu_prof['status'] = $data['approved_status'];

        $this->db->where('stu_id', $data['stu_id']);
        $stu_prof = $this->db->update('stu_upgrade_semester', array('approved_status' => $data['approved_status']));

        if ($stu_prof) {
            if ($data['approved_status'] == 1) {
                $this->db->where('stu_id', $data['stu_id']);
                $this->db->update('stu_reg', array('current_year' => $data['up_year'], 'current_semester' => $data['up_semester'], 'lastupgradeid' => $data['up_id']));

                $this->session->set_flashdata('flashSuccess', 'Student Approved Successfully.');
                $this->logger->systemlog('Student Approval', 'Success', 'Student Approved Successfully', date("Y-m-d H:i:s", now()), $data);

            }
            if ($data['approved_status'] == 3) {
                $this->session->set_flashdata('flashSuccess', 'Student Rejected Successfully.');
                $this->logger->systemlog('Student Approval', 'Success', 'Student Rejected Successfully', date("Y-m-d H:i:s", now()), $data);

            }
        }

        return $stu_prof;
    }

    public function search_mahapola_director_approval_list($data)
    {

        $this->db->select('*, st.deleted as stu_deleted, st.stu_id as student_id, SUBSTRING_INDEX(st.reg_no, "/", -1)as regno_order');
        $this->db->join('edu_course de', 'de.id=st.course_id');
        $this->db->join('stu_reg_mahapola srm', 'srm.stu_id=st.stu_id');

        if ($data['course_id'] != "all") {
            $this->db->where('st.course_id', $data['course_id']);
        }

        if ($data['center_id'] != "all") {
            $this->db->where('st.center_id', $data['center_id']);
        }
        $this->db->where('srm.approved', 1);
        $this->db->where('srm.is_eligible', 0);
        $this->db->where('srm.director_approved', 0);
        $this->db->where('st.apply_mahapola', 1);
        $this->db->where('st.approved', 1);
        $this->db->where('st.deleted', 0);

        if ($data['mp_year'] != "all") {
            $this->db->where('EXTRACT(YEAR FROM srm.created_date) = ' . $data['mp_year']);
        }

        $this->db->order_by('srm.need_index', 'DESC');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); /////////Query Change

        $result_array = $this->db->get('stu_reg st')->result_array();

        return $result_array;

    }

    public function bulk_approve_mahapola_students($data)
    {

        $updt_result = '';

        $update_data = array(
            'director_approved' => 1,
            'director_approved_by' => $this->session->userdata('u_id'),
            'director_approved_datetime' => date("Y-m-d H:i:s", now()),
        );

        $studentIDs = '';
        foreach ($data['approve_array'] as $row) {

            $this->db->where('stu_id', $row['student_id']);
            $this->db->where('mahapola_id', $row['mahapola_id']);
            $updt_result = $this->db->update('stu_reg_mahapola', $update_data);
            $studentIDs .= $row['student_id'];
        }

        $result_array = $update_data;
        $result_array['Student IDs'] = $studentIDs;

        if ($updt_result == true) {
            $this->session->set_flashdata('flashSuccess', 'All Students Approved Successfully!');
            $this->logger->systemlog('All Students Approval', 'Success', 'All Students Approved Successfully', date("Y-m-d H:i:s", now()), $result_array);

        } else {
            $this->session->set_flashdata('flashError', 'Failed to Approve Students for Mahapola. Retry!');
            $this->logger->systemlog('All Students Approval', 'Failure', 'Failed to Approve Students for Mahapola', date("Y-m-d H:i:s", now()), $result_array);

        }

        return $updt_result;
    }

    public function bulk_approve_exam_students($data)
    {

        $updt_result = '';

        $update_data = array(
            'is_approved' => 1,
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        );

        $semester_exam_detail_IDs = '';
        foreach ($data['approve_exam_array'] as $row) {

            $this->db->where('id', $row['id']);
            //$this->db->where('mahapola_id', $row['mahapola_id']);
            $updt_result = $this->db->update('exm_semester_exam_details', $update_data);
            $semester_exam_detail_IDs .= $row['id'];
        }
        $update_data['semester_exam_detail_IDs'] = $semester_exam_detail_IDs;

        if ($updt_result == true) {
            $this->session->set_flashdata('flashSuccess', 'All Students Approved Successfully!');
            $this->logger->systemlog('Bulk Student Approval Mahapola', 'Success', 'All Students Approved Successfully', date("Y-m-d H:i:s", now()), $update_data);
        } else {
            $this->session->set_flashdata('flashError', 'Failed to Approve Students for Mahapola. Retry!');
            $this->logger->systemlog('Bulk Student Approval Mahapola', 'Failure', 'Failed to Approve Students for Mahapola', date("Y-m-d H:i:s", now()), $update_data);
        }

        return $updt_result;
    }

    public function get_postpone()
    {
        $this->db->select('*,SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');
        $this->db->join('cfg_branch cb', 'cb.br_id  = st.center_id');
        $this->db->join('edu_course ec', 'ec.id = st.course_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = st.student_id');
        $this->db->join('edu_batch eb', 'eb.id = st.batch_id');
        // $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);
        $this->db->where('(st.status = 0 OR st.status = 1)');

        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC');

        //$this->db->where('st.status', 0);
        //        $this->db->join('edu_course ec, ec.id     = st.course_id');

        //$this->db->from('stu_requests st');
        $query = $this->db->get('stu_requests st');
        return $query->result();
    }

    public function get_postpone_by_center()
    {

        $user_branch = $this->session->userdata('user_branch');
        $this->db->select('*');
        $this->db->join('cfg_branch cb, cb.br_id = st.center_id');
        //$this->db->join('cfg_branch cb, cb.br_id  = st.center_id');
        //$this->db->join('edu_course ec, ec.id     = st.course_id');
        //$this->db->join('edu_course ec, ec.id     = st.course_id');

        //$this->db->from('stu_requests st');
        $this->db->where('reg.center_id', $user_branch);
        $query = $this->db->get('stu_requests st');
        return $query->result();
    }

    public function get_poname()
    {
        $this->db->select('stu_requests.*,ath_user.user_id');
        $this->db->join('ath_user', 'ath_user.user_id=stu_requests.student_id');
        //$this->db->join('cfg_group','cfg_group.grp_id=ath_user.user_group','left');
        //$this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch','left');
        $pnames = $this->db->get('stu_requests')->result_array();

        return $pnames;
    }

    public function update_approval_status($data)
    {
        $this->db->trans_begin();

        $postpone_update = array(
            'status' => $data['status'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_date' => date("Y-m-d H:i:s", now()),
        );

        $this->db->where('request_id', $data['request_id']);
        $this->db->update('stu_requests', $postpone_update);

        if ($data['status'] == 1) {
            $stu_reg_update = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d H:i:s", now()),
            );

            $this->db->where('stu_id', $data['student_id']);
            $this->db->update('stu_reg', $stu_reg_update);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            if ($data['status'] == 1) {
                $res['message'] = 'Approved Failed ';
                $this->session->set_flashdata('flashSuccess', 'Approved Failed !');
                $this->logger->systemlog('Postpone Request Status', 'Failure', 'Postpone Request Approval Failed.', date("Y-m-d H:i:s", now()), $data);
            } else {
                $res['message'] = 'Rejection Failed ';
                $this->session->set_flashdata('flashSuccess', 'Rejection Failed !');
                $this->logger->systemlog('Postpone Request Status', 'Failure', 'Postpone Request Rejection Failed.', date("Y-m-d H:i:s", now()), $data);
            }

        } else {
            $this->db->trans_commit();

            if ($data['status'] == 1) {
                //send mail to the student
                $email_reslt = $this->get_student_email($data['student_id']);
                $email = strtolower($email_reslt['email']);

                $config = array(
                    'protocol' => 'HTTP',
                    'smtp_host' => 'ssl://smtp.gmail.com', //smtp.gmail.com
                    'smtp_port' => 465,
                    'auth' => true,
                    'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
                    'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => true,
                );

                $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">Pospone Approved!</h2></div>';
                $htmlContent .= '<p>' . $email_reslt['first_name'] . ',</p>';
//                $htmlContent .= '<p>You have successfully completed your online registration at SLIATE-SMS for the course of ' . $email_reslt['course_name'] . ' at Advanced Technological Institute - ' . $email_reslt['br_name'] . '. We warmly welcome you to the  SLIATE Family. Your student profile has been created and the login information is as follows:</p>';
                $htmlContent .= '<p>Your postpone request is accepted at SLIATE-SMS for the course of ' . $email_reslt['course_name'] . ' at Advanced Technological Institute - ' . $email_reslt['br_name'] . '.</p>';
                //$htmlContent .= 'Link : <a href="http://student.sliate.ac.lk/">student.sliate.ac.lk</a><br/>';
                $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';

                $this->load->library('Email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('sms@sliate.ac.lk'); // change it to yours
                $this->email->to($email); // change it to yours
                $this->email->bcc('student.sliate.ac.lk@gmail.com');
                $this->email->subject('Auto reply at postpone request approval !');
                $this->email->message($htmlContent);

                if (!$this->email->send()) {
                    $res['status'] = 'success';
                    $res['message'] = 'Postpone Request Approved successfully.<span style="color:red;"><b> Email Could Not Sent.</b></span>.';
//                    $this->session->set_flashdata('flashSuccess', 'Approved successfully.<span style="color:red;"><b> Email Could Not Sent.</b></span>');
                    $this->logger->systemlog('Postpone Request Status', 'Success', 'Postpone Request Approved Successfully. Email could not sent.', date("Y-m-d H:i:s", now()), $data);
                } else {
                    $res['status'] = 'success';
                    $res['message'] = 'Postpone Request Approved successfully.';
//                    $this->session->set_flashdata('flashSuccess', 'Approved successfully');
                    $this->logger->systemlog('Postpone Request Status', 'Success', 'Postpone Request Approved Successfully', date("Y-m-d H:i:s", now()), $data);
                }
            } else {
                $res['status'] = 'success';
                $res['message'] = 'Postpone Request Rejected successfully.';
//                $this->session->set_flashdata('flashSuccess', 'Postpone Request Rejected successfully.');
                $this->logger->systemlog('Postpone Request Status', 'Success', 'Postpone Request Rejected Successfully', date("Y-m-d H:i:s", now()), $data);
            }

        }
        return $res;

    }

    public function update_graduation_approval_status($data)
    {

        $this->db->trans_begin();

        $update_array = array(
            'is_approved' => $data['status'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_date' => date("Y-m-d H:i:s", now()),
        );

        $this->db->where('request_id', $data['request_id']);
        $this->db->update('stu_requests', $update_array);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            if ($data['status'] == 1) {
                $res['message'] = 'Graduation Request Approval Failed ';
                $this->logger->systemlog('Graduation Request Approval Status', 'Failure', 'Failed To Approve Graduation Request', date("Y-m-d H:i:s", now()), array_merge($data, $update_array));
            } else {
                $res['message'] = 'Graduation Request Rejection Failed ';
                $this->logger->systemlog('Graduation Request Reject Status', 'Failure', 'Failed To Reject Graduation Request', date("Y-m-d H:i:s", now()), array_merge($data, $update_array));
            }

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            if ($data['status'] == 1) {
                $res['message'] = 'Graduation Request Approved successfully.';
                $this->logger->systemlog('Graduation Request Approval Status', 'Success', 'Approved Graduation Request', date("Y-m-d H:i:s", now()), $data);
            } else {
                $res['message'] = 'Graduation Request Rejected successfully.';
                $this->logger->systemlog('Graduation Request Reject Status', 'Success', 'Rejected Graduation Request', date("Y-m-d H:i:s", now()), $data);
            }

        }
        return $res;
    }

    public function get_lecture_timetable()
    {
        $this->db->select('*');
        $this->db->join('exm_exam ee', 'ee.id=te.ttbl_exam');
        //$this->db->join('edu_course ec','ec.id=te.ttbl_course');
        //$this->db->join('edu_semester es','es.id=te.ttbl_semester');
        //$this->db->join('exm_exam ee','ee.id=te.ttbl_exam');
        $this->db->join('edu_center_course_year eccy', 'eccy.id=te.ttbl_year');
        $this->db->join('edu_center_course_semester eccs', 'eccs.id=te.ttbl_semester');
        //$this->db->join('edu_center_course_semester eccs1','eccs1.center_year_id=eccs.id');

        $this->db->where('te.approved', 0);

        $lec_time_tbl_view = $this->db->get('tta_examtimetable te')->result_array();

        return $lec_time_tbl_view;
    }

    public function get_exam_timetable()
    {
        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

        $this->db->select('tta_examtimetable.*,edu_course.course_code,edu_course.course_name,cfg_academicyears.ac_startdate,cfg_academicyears.ac_enddate,exm_exam.exam_code,exm_exam.exam_name');
        $this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
        $this->db->join('cfg_academicyears', 'cfg_academicyears.es_ac_year_id=tta_examtimetable.ttbl_season');
        $this->db->join('exm_exam', 'exm_exam.id=tta_examtimetable.ttbl_exam');
        $this->db->where_in('tta_examtimetable.approved', 0);
        $timetables = $this->db->get('tta_examtimetable')->result_array();

        return $timetables;

    }

    public function get_exam_timetable_reject()
    {
        $faclist = $this->auth->get_accessfaculties($branch = array(), 'ID_ARY');

        $this->db->select('tta_examtimetable.*,edu_course.course_code,edu_course.course_name,cfg_academicyears.ac_startdate,cfg_academicyears.ac_enddate,exm_exam.exam_code,exm_exam.exam_name');
        $this->db->join('edu_course', 'edu_course.id=tta_examtimetable.ttbl_course');
        $this->db->join('cfg_academicyears', 'cfg_academicyears.es_ac_year_id=tta_examtimetable.ttbl_season');
        $this->db->join('exm_exam', 'exm_exam.id=tta_examtimetable.ttbl_exam');
        $this->db->where_in('tta_examtimetable.approved', 3);
        $timetables = $this->db->get('tta_examtimetable')->result_array();

        return $timetables;

    }

    public function get_lecture_timetable_reject()
    {
        $this->db->select('*');
        $this->db->join('exm_exam ee', 'ee.id=te.ttbl_exam');
        //$this->db->join('edu_course ec','ec.id=te.ttbl_course');
        //$this->db->join('edu_semester es','es.id=te.ttbl_semester');
        //$this->db->join('exm_exam ee','ee.id=te.ttbl_exam');
        $this->db->join('edu_center_course_year eccy', 'eccy.id=te.ttbl_year');
        $this->db->join('edu_center_course_semester eccs', 'eccs.id=te.ttbl_semester');

        $this->db->where('te.approved', 3);

        $lec_time_tbl_view = $this->db->get('tta_examtimetable te')->result_array();

        return $lec_time_tbl_view;
    }

    public function search_exam_ttbl($data)
    {

        $this->db->select('*, SUBSTRING_INDEX(st.reg_no, "/", -1) as regno_order,st.deleted as stu_deleted');
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

    public function update_examtime_status($data)
    {
        $this->db->trans_begin();

        $this->db->where('ttbl_id', $data['ttbl_id']);
        $stu_prof = $this->db->update('tta_examtimetable', array(
            'approved' => $data['approved'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        ));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            if ($data['approved'] == 1) {
                $res['status'] = 'Failed';
                $res['message'] = 'Timetable Approval Failed ';
            } else {
                $res['status'] = 'Failed';
                $res['message'] = 'Timetable Rejection Failed ';
            }

        } else {
            $this->db->trans_commit();
            if ($data['approved'] == 1) {
                $res['status'] = 'success';
                $res['message'] = 'Timetable Approved successfully.';
            } else {
                $res['status'] = 'success';
                $res['message'] = 'Timetable Rejected successfully.';
            }

        }

        return $res;

    }

    public function get_apply_exam()
    {
        $this->db->select('*');
        //$this->db->join('cfg_branch cb, cb.br_id  = st.center_id');
        //$this->db->join('edu_course ec, ec.id     = st.course_id');
        //$this->db->join('edu_course ec, ec.id     = st.course_id');

        //$this->db->from('stu_requests st');
        $this->db->join('stu_reg sr', 'sr.stu_id  = esed.student_id');
        //$this->db->join('mod_subject ms', 'ms.id  = esed.subject_id');
        $this->db->where('esed.deleted', 0);
        $this->db->where('esed.is_approved', 0);

        $query = $this->db->get('exm_semester_exam_details esed');
        return $query->result();
    }

    public function update_exam_status($data)
    {
        $this->db->trans_begin();

        // $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('student_id', $data['stu_id']);
        $this->db->where('semester_exam_id', $data['semester_id']);
        $this->db->update('exm_semester_exam_details', array(
            'is_approved' => $data['is_approved'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        ));

        //insert data into exm_semester_exam student status
        $student_data = array(
            'exm_semester_exam_id' => $data['semester_id'],
            'stu_id' => $data['stu_id'],
        );

        $this->db->insert('exm_semester_exam_student_status', $student_data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Approved Failed ';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Approved successfully.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
        }
        return $res;

    }

    public function update_exam_rej_status($data)
    {

        // $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('student_id', $data['stu_id']);
        $this->db->where('semester_exam_id', $data['semester_id']);
        $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
        $stu_prof = $this->db->update('exm_semester_exam_details', array(
            'is_approved' => $data['is_approved'],
            'rejected_reason' => $data['rejected_reason'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        ));

//        $this->db->select('esd.subject_id, es.exam_id, es.course_id, es.year_no, es.semester_no, es.batch_id');
        //        $this->db->join('exm_semester_exam es', 'es.id = esd.semester_exam_id');
        //        $this->db->where('esd.student_id', $data['stu_id']);
        //        $this->db->where('esd.semester_exam_id', $data['semester_id']);
        //        $subject_list = $this->db->get('exm_semester_exam_details esd')->result_array();
        //
        //        for($x=0; $x<count($subject_list); $x++){
        //
        //            $this->db->select('credits');
        //            $this->db->where('id', $subject_list[$x]['subject_id']);
        //            $subj_credits = $this->db->get('mod_subject')->row_array();
        //
        //            $sems_id = $this->get_edu_semester_id($subject_list[$x]['course_id'], $subject_list[$x]['year_no']);
        //
        //            $this->db->select('md.type_id, md.percentage, scd.subject_id');
        //            $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
        //            $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
        //            $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
        //            $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
        //            $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
        //            $this->db->where('sem.id', $sems_id);
        //            $this->db->where('sc.semester_no', $subject_list[$x]['semester_no']);
        //            $this->db->where('sc.batch_id', $subject_list[$x]['batch_id']);
        //            $this->db->where('scd.subject_id', $subject_list[$x]['subject_id']);
        //            $this->db->where('sc.deleted', 0);
        //            $this->db->where('scd.deleted', 0);
        //            $this->db->where('md.deleted', 0);
        //            $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        //
        //            if(count($result_array) > 0){
        //
        //                $insert_exam_mark = array(
        //                    'student_id' => $data['stu_id'],
        //                    'course_id' => $subject_list[$x]['course_id'],
        //                    'year_no' => $subject_list[$x]['year_no'],
        //                    'semester_no' => $subject_list[$x]['semester_no'],
        //                    'batch_id' => $subject_list[$x]['batch_id'],
        //                    'sem_exam_id' => $subject_list[$x]['exam_id'],
        //                    'subject_id' => $subject_list[$x]['subject_id'],
        //                    'total_marks' => 0,
        //                    'overall_grade' => 'N/E',
        //                    'grade_point' => 0,
        //                    'subject_credit' => $subj_credits['credits'],
        //                    'result' => 'N/E',
        //                    'is_repeat_approve' => 0,
        //                    'is_repeat_mark' => 0,
        //                    'is_hod_mark_aproved' => 1,
        //                    'is_director_mark_approved' => 1,
        //                    'is_ex_director_mark_approved' => 1,
        //                    'added_by' => $this->session->userdata('u_id'),
        //                    'added_on' => date("Y-m-d h:i:s", now())
        //                );
        //                $this->db->insert('exm_mark', $insert_exam_mark);
        //                $max_exam_mark_id = $this->get_max_rej_exam_mark_id();
        //
        //                for($y=0; $y<count($result_array); $y++){
        //
        //                    if($result_array[$y]['type_id'] == 2){
        //                        $hod_apprv = 1;
        //                    }
        //                    else{
        //                        $hod_apprv = 0;
        //                    }
        //
        //
        //                    $insert_mark_details = array(
        //                        'exam_mark_id' => $max_exam_mark_id,
        //                        'exam_type_id' => $result_array[$y]['type_id'],
        //                        'persentage' => $result_array[$y]['percentage'],
        //                        'mark' => 0,
        //                        'is_hod_mark_aproved' => $hod_apprv,
        //                        'hod_mark_aproved_by' => $this->session->userdata('u_id'),
        //                        'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
        //                        'is_director_mark_approved' => 1,
        //                        'director_mark_approved_by' => $this->session->userdata('u_id'),
        //                        'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
        //                        'added_by' => $this->session->userdata('u_id'),
        //                        'added_on' => date("Y-m-d h:i:s", now())
        //                    );
        //                    $this->db->insert('exm_mark_details', $insert_mark_details);
        //                }
        //            }
        //        }

        return $stu_prof;

    }

    public function get_edu_semester_id($course_id, $year_no)
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
            return null;
        }
    }

    public function get_max_rej_exam_mark_id()
    {
        $this->db->select('max(id)');
        $this->db->from('exm_mark');
        $result = $this->db->get()->result_array();
        foreach ($result as $row) {
            return $row['max(id)'];
        }
    }

    public function update_exam_approval_level2($data)
    {
        $this->db->trans_begin();

        for ($w = 0; $w < sizeof($data); $w++) {

            if (isset($data[$w]['rejected_reason'])) {

                $this->db->where('subject_id', $data[$w]['subject_id']);
                $this->db->where('student_id', $data[$w]['stu_id']);
                $this->db->where('semester_exam_id', $data[$w]['semester_id']);
                $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
                $this->db->update('exm_semester_exam_details', array(
                    'is_approved' => $data[$w]['is_approved'],
                    'rejected_reason' => $data[$w]['rejected_reason'],
                    'approved_by' => $this->session->userdata('u_id'),
                    'approved_datetime' => date("Y-m-d H:i:s", now()),
                ));

//                $this->db->select('esd.subject_id, es.exam_id, es.course_id, es.year_no, es.semester_no, es.batch_id');
                //                $this->db->join('exm_semester_exam es', 'es.id = esd.semester_exam_id');
                //                $this->db->where('esd.student_id', $data[$w]['stu_id']);
                //                $this->db->where('esd.semester_exam_id', $data[$w]['semester_id']);
                //                $this->db->where('esd.subject_id', $data[$w]['subject_id']);
                //                $subject_list = $this->db->get('exm_semester_exam_details esd')->result_array();
                //
                //                $this->db->select('credits');
                //                $this->db->where('id', $data[$w]['subject_id']);
                //                $subj_credits = $this->db->get('mod_subject')->row_array();
                //
                //                $sems_id = $this->get_edu_semester_id($subject_list[0]['course_id'], $subject_list[0]['year_no']);
                //
                //                $this->db->select('md.type_id, md.percentage, scd.subject_id');
                //                $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
                //                $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
                //                $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
                //                $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
                //                $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
                //                $this->db->where('sem.id', $sems_id);
                //                $this->db->where('sc.semester_no', $subject_list[0]['semester_no']);
                //                $this->db->where('sc.batch_id', $subject_list[0]['batch_id']);
                //                $this->db->where('scd.subject_id', $data[$w]['subject_id']);
                //                $this->db->where('sc.deleted', 0);
                //                $this->db->where('scd.deleted', 0);
                //                $this->db->where('md.deleted', 0);
                //                $result_array = $this->db->get('mod_semester_subject sc')->result_array();
                //
                //                if(count($result_array) > 0){
                //
                //                    $insert_exam_mark = array(
                //                        'student_id' => $data[$w]['stu_id'],
                //                        'course_id' => $subject_list[0]['course_id'],
                //                        'year_no' => $subject_list[0]['year_no'],
                //                        'semester_no' => $subject_list[0]['semester_no'],
                //                        'batch_id' => $subject_list[0]['batch_id'],
                //                        'sem_exam_id' => $subject_list[0]['exam_id'],
                //                        'subject_id' => $data[$w]['subject_id'],
                //                        'total_marks' => 0,
                //                        'overall_grade' => 'N/E',
                //                        'grade_point' => 0,
                //                        'subject_credit' => $subj_credits['credits'],
                //                        'result' => 'N/E',
                //                        'is_repeat_approve' => 0,
                //                        'is_repeat_mark' => 0,
                //                        'is_hod_mark_aproved' => 1,
                //                        'is_director_mark_approved' => 1,
                //                        'is_ex_director_mark_approved' => 1,
                //                        'added_by' => $this->session->userdata('u_id'),
                //                        'added_on' => date("Y-m-d h:i:s", now())
                //                    );
                //                    $this->db->insert('exm_mark', $insert_exam_mark);
                //                    $max_exam_mark_id = $this->get_max_rej_exam_mark_id();
                //
                //                    for($y=0; $y<count($result_array); $y++){
                //
                //                        if($result_array[$y]['type_id'] == 2){
                //                            $hod_apprv = 1;
                //                        }
                //                        else{
                //                            $hod_apprv = 0;
                //                        }
                //
                //                        $insert_mark_details = array(
                //                            'exam_mark_id' => $max_exam_mark_id,
                //                            'exam_type_id' => $result_array[$y]['type_id'],
                //                            'persentage' => $result_array[$y]['percentage'],
                //                            'mark' => 0,
                //                            'is_hod_mark_aproved' => $hod_apprv,
                //                            'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                //                            'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
                //                            'is_director_mark_approved' => 1,
                //                            'director_mark_approved_by' => $this->session->userdata('u_id'),
                //                            'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
                //                            'added_by' => $this->session->userdata('u_id'),
                //                            'added_on' => date("Y-m-d h:i:s", now())
                //                        );
                //                        $this->db->insert('exm_mark_details', $insert_mark_details);
                //                    }
                //                }

            } else {
                $this->db->where('subject_id', $data[$w]['subject_id']);
                $this->db->where('student_id', $data[$w]['stu_id']);
                $this->db->where('semester_exam_id', $data[$w]['semester_id']);
                $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
                $this->db->update('exm_semester_exam_details', array(
                    'is_approved' => $data[$w]['is_approved'],
                    'approved_by' => $this->session->userdata('u_id'),
                    'approved_datetime' => date("Y-m-d H:i:s", now()),
                ));

            }

        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Approved Failed ';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Exam Approval Status', 'Failure', 'Failed To Update Exam Approval Status', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Approved successfully.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Exam Approval Status', 'Success', 'Exam Approval Status Updated Successfully', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;
    }

    public function academic_exam_request_bulk_approval($data)
    {
        $this->db->trans_begin();
        for ($w = 0; $w < count($data); $w++) {
            $update_array = array(
                'is_approved' => $data[$w]['is_approved'],
                'approved_by' => $this->session->userdata('u_id'),
                'approved_datetime' => date("Y-m-d H:i:s", now()),
            );

            $this->db->where('subject_id', $data[$w]['subject_id']);
            $this->db->where('student_id', $data[$w]['stu_id']);
            $this->db->where('semester_exam_id', $data[$w]['semester_exam_id']);
            $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
            $this->db->update('exm_semester_exam_details', $update_array);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function load_student_approval_subjects($data)
    {

        $this->db->select('stu_reg.last_name, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1)as regno_order, stu_reg.admission_no,stu_reg.first_name,stu_reg.stu_id,stu_reg.approved,stu_reg.reg_no, stu_follow_subject.subject_id');
        $this->db->join('stu_follow_subject', 'stu_follow_subject.student_subject_id=stu_subject.id');
        $this->db->join('stu_reg', 'stu_subject.student_id=stu_reg.stu_id');

        $this->db->where('stu_reg.center_id', $data['center_id']);
        $this->db->where('stu_reg.approved', 1);
        $this->db->where('stu_reg.deleted', 0);
        $this->db->where('stu_subject.is_approved', 0);
        $this->db->where('stu_subject.course_id', $data['course_id']);
        $this->db->where('stu_subject.batch_id', $data['batch_id']);
        $this->db->where('stu_subject.year_no', $data['year_no']);
        $this->db->where('stu_subject.semester_no', $data['semester_no']);
        $this->db->group_by('stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); //////////////Query Change
        $result_array = $this->db->get('stu_subject')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code ,`co`.id as subject_no');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('fc.deleted', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }

        return $result_array;
    }

    public function load_student_request_approval_subjects($data)
    {

        $this->db->select('stu_reg.last_name, SUBSTRING_INDEX(stu_reg.reg_no, "/", -1)as regno_order, stu_reg.admission_no,stu_reg.first_name,stu_reg.stu_id,stu_reg.approved,stu_reg.reg_no, stu_follow_subject.subject_id');
        $this->db->join('stu_follow_subject', 'stu_follow_subject.student_subject_id=stu_subject.id');
        $this->db->join('stu_reg', 'stu_subject.student_id=stu_reg.stu_id');

        $this->db->where('stu_reg.center_id', $data['center_id']);
        $this->db->where('stu_reg.approved', 1);
        $this->db->where('stu_reg.deleted', 0);
        $this->db->where('stu_subject.is_approved', 0);
        $this->db->where('stu_subject.course_id', $data['course_id']);
        $this->db->where('stu_subject.batch_id', $data['batch_id']);
        $this->db->where('stu_subject.year_no', $data['year_no']);
        $this->db->where('stu_subject.semester_no', $data['semester_no']);
        $this->db->group_by('stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); //////////////Query Change
        $result_array = $this->db->get('stu_subject')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*, co.type as subject_type, co.code as subject_code ,`co`.id as subject_no');
            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = fc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            $this->db->where('sc.year_no', $data['year_no']);
            $this->db->where('sc.semester_no', $data['semester_no']);
            $this->db->where('fc.deleted', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('stu_subject sc')->result_array();
        }

        return $result_array;
    }

    public function approve_student_subject($data)
    {
        $this->db->trans_begin();
        $this->db->select('fc.subject_id as subject_id, fc.version_id as version_id, fc.subj_group as subj_group , fc.student_subject_id as student_subject_id,fc.added_by as added_by,fc.added_on as added_on');
        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
        $this->db->join('mod_subject co', 'co.id = fc.subject_id');
        $this->db->where('sc.student_id', $data['stu_id']);
        $this->db->where('sc.course_id', $data['course_id']);
        $this->db->where('sc.year_no', $data['year_no']);
        $this->db->where('sc.semester_no', $data['semester_no']);
        $this->db->where('sc.batch_id', $data['batch_id']);
        $this->db->where('fc.deleted', 0);
        $result_array = $this->db->get('stu_subject sc'); //->result_array();

        // $subject['old_subject_id']=array();

        if ($result_array->num_rows()) {
            foreach ($result_array->result_array() as $re_row) {
                $this->db->insert('stu_follow_subject_history', $re_row);

            }

            $insert_id = $this->db->insert_id();
            if ($insert_id != "") {

                $this->db->where('student_subject_id', $data['stu_subj_id']);
                $this->db->delete('stu_follow_subject');

                if (!empty($data['core_subjects'])) {
                    for ($i = 0; $i < count($data['core_subjects']); $i++) {
                        $insert_core_subjects = array(
                            'student_subject_id' => $data['stu_subj_id'],
                            'subject_id' => $data['core_subjects'][$i],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['c_subject_version'][$i],
                            'subj_group' => $data['subj_group'],
                        );
                        //insert core subjects
                        $result2 = $this->db->insert('stu_follow_subject', $insert_core_subjects);
                    }
                }
                if (!empty($data['elective_subjects'])) {
                    for ($j = 0; $j < count($data['elective_subjects']); $j++) {
                        $insert_elective_subjects = array(
                            'student_subject_id' => $data['stu_subj_id'],
                            'subject_id' => $data['elective_subjects'][$j],
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d H:i:s", now()),
                            'version_id' => $data['e_subject_version'][$j],
                            'subj_group' => $data['subj_group'],
                        );
                        //insert elective subjects
                        $result3 = $this->db->insert('stu_follow_subject', $insert_elective_subjects);
                    }
                }

                //update stu subject approval status
                $stu_subject_data = array(
                    'is_approved' => 1,
                    'approved_by' => $this->session->userdata('u_id'),
                    'approved_datetime' => date("Y-m-d H:i:s", now()),
                );

                $this->db->where('id', $data['stu_subj_id']);
                $this->db->update('stu_subject', $stu_subject_data);

            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Approved Failed ';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Approve Student Subject', 'Faliure', 'Approved Failed', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Approved successfully.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Approve Student Subject', 'Success', 'Staff Attendance Updated successfully.', date("Y-m-d H:i:s", now()), $data);
        }

        return $res;
    }

    public function get_all_courses_list()
    {
        $this->db->select('*');
        $title_new = $this->db->get('edu_course')->result_array();

        return $title_new;
    }

    public function load_exam_list($data)
    {
        $this->db->select('exm_exam.exam_code,exm_exam.id');

        $this->db->join('exm_exam', 'exm_exam.id = exm_semester_exam.exam_id');

        //$this->db->where('year_id', $this->input->post('year_id'));
        $this->db->where('exm_semester_exam.year_no', $data['year_no']);
        $this->db->where('exm_semester_exam.semester_no', $data['sel_semester_id']);
        $this->db->where('exm_semester_exam.course_id', $data['course_id']);
        $this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
        $this->db->where('exm_semester_exam.is_approved', 0);

        $result = $this->db->get('exm_semester_exam')->result_array();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function search_students_lookup1($data)
    {
        //$this->db->join('stu_follow_subject sfc', 'sfc.student_subject_id=sc.id');
        $this->db->select('*');

        $this->db->join('exm_semester_exam', 'exm_exam.id   = exm_semester_exam.exam_id');
        $this->db->join('edu_course', 'edu_course.id = exm_semester_exam.course_id');
        $this->db->join('edu_batch', 'edu_batch.id = exm_semester_exam.batch_id');

        $this->db->where('exm_semester_exam.course_id', $data['course_id']);
        //$this->db->where('exm_semester_exam.batch_id', $data['batch_id']);
        if ($data['year_no'] != "all") {
            $this->db->where('exm_semester_exam.year_no', $data['year_no']);
        }

        if ($data['semester_no'] != "all") {
            $this->db->where('exm_semester_exam.semester_no', $data['semester_no']);
        }

        //$this->db->where('exm_semester_exam.exam_id', $data['exam_id']);
        $this->db->where('exm_semester_exam.is_approved', 0);

        //$this->db->where('ese.deleted_by', 0);

        $exam_result_array = $this->db->get('exm_exam')->result_array();

        return $exam_result_array;
    }

    public function update_exam_approval_status1($data)
    {

        $this->db->where('exam_id', $data['exam_id']);
        //$this->db->where('semester_exam_id', $data['semester_id']);
        $stu_prof = $this->db->update('exm_semester_exam', array(
            'is_approved' => $data['is_approved'],
            'approved_by' => $this->session->userdata('u_id'),
            'approved_date' => date("Y-m-d H:i:s", now()),
        ));
        if ($data['is_approved'] == 1) {
            $this->logger->systemlog('Director Exam Approval Status Update', 'Success', 'Director Approved Exam Successfully', date("Y-m-d H:i:s", now()), $data);
        } else {
            $this->logger->systemlog('Director Exam Approval Status Update', 'Success', 'Director Rejected Exam Successfully', date("Y-m-d H:i:s", now()), $data);
        }
        //$update_rows = $this->db->affected_rows();
        return $stu_prof;

    }

    public function load_year_list()
    {

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

    public function load_semesters()
    {
        $this->db->select('no_of_semester');
        $this->db->where('year_id', $this->input->post('year_id'));
        $this->db->where('year_no', $this->input->post('year_no'));
        $result = $this->db->get('edu_semester')->row_array();
        if ($result) {
            return $result['no_of_semester'];
        } else {
            return null;
        }
    }

    public function mark_approve_status_hod($data)
    {
        $this->db->trans_begin();
        //call mark save
        /* if ($data['overall_grade'] != 'AB') {
        $this->load->model('exam_model');
        $this->exam_model->save_exam_marks($data, false);
        }*/

        //update
        //exm_exam_mark
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_hod_mark_aproved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now()),
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        $existing_detail_ids = $this->exam_model->get_ids__mark_detail_id_by_mark_id($mark_id);

        //return $existing_detail_ids;

        //detals table update 

        
            foreach($existing_detail_ids as $existing_detail_id){
                $this->db->select('exam_type_id,id');
                $this->db->where('id', $existing_detail_id['id']);
                $exam_mark_details_id = $this->db->get('exm_mark_details')->row_array();


                
                    if($exam_mark_details_id['exam_type_id']==2){
                        if($data['page']=="hod"){
                        $update_exam_mark = array(
                            'is_hod_mark_aproved' => $data['status'],
                            'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                            'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
                        );
                        $this->db->where('id', $exam_mark_details_id['id']);
                        $this->db->update('exm_mark_details', $update_exam_mark);
                        }
                       
                    }

            }

        

        //update hc_mark_details
        // $this->db->trans_rollback();
      
        // return $existing_detail_ids;
        //return 'persentage count :'.count($data['persentage']).'  ids:'.count($existing_detail_ids);
      /*  if (count($existing_detail_ids) == 2) {
            //            for ($i = 0; $i < count($data['persentage']); $i++) {
            //                if($data['subject_mark'][$i] == null || $data['subject_mark'][$i] == '' || $data['overall_grade'] == 'AB' ){
            //                    $mark = null;
            //                } else {
            //                    $mark = $data['subject_mark'][$i];
            //                }
            //                $update_mark_details = array(
            //                    'exam_mark_id' => $mark_id,
            //                    'exam_type_id' => $data['type_id'][$i],
            //                    'persentage' => $data['persentage'][$i],
            //                    'mark' => $mark,
            //                    'updated_by' => $this->session->userdata('u_id'),
            //                    'updated_on' => date("Y-m-d h:i:s", now())
            //                );
            //                $this->db->where('id', $existing_detail_ids[$i]['id']);
            //                $this->db->update('exm_mark_details', $update_mark_details);
            //            }
            $type_id = 2; //type 2 is Assignment,

            $this->db->select('exm_mark_details.id');
            $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
            $this->db->where('exm_mark.student_id', $data['stu_id']);
            $this->db->where('exm_mark.course_id', $data['course_id']);
            $this->db->where('exm_mark.year_no', $data['year_no']);
            $this->db->where('exm_mark.semester_no', $data['semester_no']);
            $this->db->where('exm_mark.batch_id', $data['batch_id']);
            $this->db->where('exm_mark.subject_id', $data['subject_id']);
            $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
            $this->db->where('exm_mark_details.exam_type_id', $type_id);
            $this->db->where('exm_mark_details.deleted', 0);
            //$this->db->where('exm_mark_details.persentage', $data['persentage']);
            $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
            //return $exam_mark_details_id;
            // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
            $update_exam_mark = array(
                'is_hod_mark_aproved' => $data['status'],
                'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
            );

            $this->db->where('id', $exam_mark_details_id['id']);
            $this->db->update('exm_mark_details', $update_exam_mark);
            //}
        } else {
            //delete all and insert new
            //delete
            $mark_delete_array = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now()),
            );
            $this->db->where('exam_mark_id', $mark_id);
            $this->db->update('exm_mark_details', $mark_delete_array);
            //insert
            for ($i = 0; $i < count($data['persentage']); $i++) {
                if ($data['subject_mark'][$i] == null || $data['subject_mark'][$i] == '' || $data['overall_grade'] == 'AB') {
                    $mark = null;
                } else {
                    $mark = $data['subject_mark'][$i];
                }
                $insert_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->insert('exm_mark_details', $insert_mark_details);
            }
        }

*/
        //====================== update mark approval status =================================

//        $type_id = 2;//type 2 is Assignment,
        //
        //        $this->db->select('exm_mark_details.id');
        //        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        //        $this->db->where('exm_mark.student_id', $data['stu_id']);
        //        $this->db->where('exm_mark.course_id', $data['course_id']);
        //        $this->db->where('exm_mark.year_no', $data['year_no']);
        //        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        //        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        //        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        //        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        //        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        //        $this->db->where('exm_mark_details.deleted', 0);
        //        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        //        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
        ////return $exam_mark_details_id;
        //        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        //        $update_exam_mark = array(
        //            'is_hod_mark_aproved' => $data['status'],
        //            'hod_mark_aproved_by' => $this->session->userdata('u_id'),
        //            'hod_mark_aproved_date' => date("Y-m-d h:i:s", now())
        //        );

//        $this->db->where('id', $exam_mark_details_id['id']);
        //        $this->db->update('exm_mark_details', $update_exam_mark);
        //        //}

        //====================== END update mark approval status =================================

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Approve Marks.';
            $res['page'] = 'hod';
            // $this->logger->systemlog('Approve Marks HOD', 'Faliure', 'Failed to Approve Marks.', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Marks Approved successfully.';
            $res['page'] = 'hod';
            //  $this->logger->systemlog('Approve Marks HOD', 'Success', 'Marks Approved successfully.', date("Y-m-d H:i:s", now()), $data);

        }

        return $res;
    }

    public function mark_approve_status_dir($data)
    {
        $this->db->trans_begin();
        //call mark save
        /* if ($data['overall_grade'] != 'AB') {
        $this->load->model('exam_model');
        $this->exam_model->save_exam_marks($data, false);
        }*/

        $subj_marking_details = $this->get_subject_marking_method_details($data);

        //update
        //exm_exam_mark
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $semester_subject_data = $this->get_applied_subject($mark_id, $data['repeat_status']);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_director_mark_approved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now()),
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        //update hc_mark_details
        // $this->db->trans_rollback();
        $existing_detail_ids = $this->exam_model->get_ids__mark_detail_id_by_mark_id($mark_id);
        // return $existing_detail_ids;
        //return 'persentage count :'.count($data['persentage']).'  ids:'.count($existing_detail_ids);
        if (count($existing_detail_ids) == count($data['persentage'])) {
            for ($i = 0; $i < count($data['persentage']); $i++) {
                if ($data['subject_mark'][$i] == null || $data['subject_mark'][$i] == '' || $data['overall_grade'] == 'AB') {
                    $mark = null;
                } else {
                    $mark = $data['subject_mark'][$i];
                }
                $update_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $mark,
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->where('id', $existing_detail_ids[$i]['id']);
                $this->db->update('exm_mark_details', $update_mark_details);
            }
        } else {
            //delete all and insert new
            //delete
            $mark_delete_array = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now()),
            );
            $this->db->where('exam_mark_id', $mark_id);
            $this->db->update('exm_mark_details', $mark_delete_array);
            //insert
            for ($i = 0; $i < count($data['persentage']); $i++) {
                if ($data['subject_mark'][$i] == null || $data['subject_mark'][$i] == '' || $data['overall_grade'] == 'AB') {
                    $mark = null;
                } else {
                    $mark = $data['subject_mark'][$i];
                }
                $insert_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $mark,
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now()),
                    'is_hod_mark_aproved' => 1,
                    'hod_mark_aproved_by' => $this->session->userdata('u_id'),
                    'hod_mark_aproved_date' => date("Y-m-d h:i:s", now()),
                );
                $this->db->insert('exm_mark_details', $insert_mark_details);
            }
        }

        //====================== update mark approval status =================================

        $type_id = 2; //type 2 is Assignment,

        $this->db->select('exm_mark_details.id');
        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        $this->db->where('exm_mark.student_id', $data['stu_id']);
        $this->db->where('exm_mark.course_id', $data['course_id']);
        $this->db->where('exm_mark.year_no', $data['year_no']);
        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        $this->db->where('exm_mark_details.deleted', 0);
        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
        //return $exam_mark_details_id;
        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        $update_exam_mark = array(
            'is_director_mark_approved' => $data['status'],
            'director_mark_approved_by' => $this->session->userdata('u_id'),
            'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
        );

        $this->db->where('id', $exam_mark_details_id['id']);
        $this->db->update('exm_mark_details', $update_exam_mark);
        //}

        //====================== END update mark approval status =================================

        if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----

            $update_exdir_status = array(
                'is_ex_director_mark_approved' => 1,
                'updated_by' => $this->session->userdata('u_id'),
                'updated_on' => date("Y-m-d h:i:s", now()),
            );

            $this->db->where('id', $mark_id);
            $this->db->update('exm_mark', $update_exdir_status);
        } else {
            if ($semester_subject_data['is_approved'] > 2) { //If Rejected
                $update_exdir_status = array(
                    'overall_grade' => 'N/E',
                    'grade_point' => 0,
                    'result' => 'N/E',
                    'is_ex_director_mark_approved' => 1,
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now()),
                );

                $this->db->where('id', $mark_id);
                $this->db->update('exm_mark', $update_exdir_status);
            }
        }

        if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----
            if ($data['repeat_status'] == 1) {
                $this->update_gpa_se_approval($mark_id, $data['stu_id'], $data, true, $semester_subject_data['is_recorrection_approved']);
            } else {
                $this->update_gpa_se_approval($mark_id, $data['stu_id'], $data, false, $semester_subject_data['is_recorrection_approved']);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Approve Marks.';
            $res['page'] = 'dir';
            $this->logger->systemlog('Mark Approve Dir', 'Faliure', 'Failed to Approve Marks.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Marks Approved successfully.';
            $res['page'] = 'dir';
            $this->logger->systemlog('Mark Approve Dir', 'Success', 'Marks Approved successfully.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        }

        return $res;
    }

    public function mark_approve_status_ex_dir($data)
    {
        $this->db->trans_begin();
        //call mark save
        /* if ($data['overall_grade'] != 'AB') {
        $this->load->model('exam_model');
        $this->exam_model->save_exam_marks($data, false);
        }*/

        //update
        //exm_exam_mark
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_ex_director_mark_approved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now()),
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        //update hc_mark_details
        // $this->db->trans_rollback();
        $existing_detail_ids = $this->exam_model->get_ids__mark_detail_id_by_mark_id($mark_id);
        // return $existing_detail_ids;
        //return 'persentage count :'.count($data['persentage']).'  ids:'.count($existing_detail_ids);
        if (count($existing_detail_ids) == count($data['persentage'])) {
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $update_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'updated_by' => $this->session->userdata('u_id'),
                    'updated_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->where('id', $existing_detail_ids[$i]['id']);
                $this->db->update('exm_mark_details', $update_mark_details);
            }
        } else {
            //delete all and insert new
            //delete
            $mark_delete_array = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now()),
            );
            $this->db->where('exam_mark_id', $mark_id);
            $this->db->update('exm_mark_details', $mark_delete_array);
            //insert
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $insert_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->insert('exm_mark_details', $insert_mark_details);
            }
        }

        //====================== update mark approval status =================================

        $type_id = 2; //type 2 is Assignment,

        $this->db->select('exm_mark_details.id');
        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        $this->db->where('exm_mark.student_id', $data['stu_id']);
        $this->db->where('exm_mark.course_id', $data['course_id']);
        $this->db->where('exm_mark.year_no', $data['year_no']);
        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        $this->db->where('exm_mark_details.deleted', 0);
        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
//return $exam_mark_details_id;
        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        $update_exam_mark = array(
            'is_director_mark_approved' => $data['status'],
            'director_mark_approved_by' => $this->session->userdata('u_id'),
            'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
        );

        $this->db->where('id', $exam_mark_details_id['id']);
        $this->db->update('exm_mark_details', $update_exam_mark);
        //}

        //====================== END update mark approval status =================================
        //=================================insert GPA values ==============================================

        //Calculate Overall GPA

        $gpa_total = 0;

        $this->db->select('stu_id, gpa');
        $this->db->where('stu_id', $data['stu_id']);

        $gpa_data = $this->db->get('exm_mark_stu_gpa')->result_array();

        $prev_gpa_count = count($gpa_data) + 1;

        for ($g = 0; $g < count($gpa_data); $g++) {
            $gpa_total += $gpa_data[$g]['gpa'];
        }

        $pre_overall_gpa = (($gpa_total + $data['gpa_value']) / $prev_gpa_count);
        $overall_gpa = round($pre_overall_gpa, 2);

        //insert gpa values
        $this->db->select('count(stu_id) as gpa_count');
        $this->db->where('stu_id', $data['stu_id']);
        $this->db->where('year', $data['year_no']);
        $this->db->where('semester', $data['semester_no']);

        $is_available_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();

        if ($is_available_gpa['gpa_count'] == 0) {
            $insert_gpa = array(
                'stu_id' => $data['stu_id'],
                'year' => $data['year_no'],
                'semester' => $data['semester_no'],
                'gpa' => $data['gpa_value'],
                'overall_gpa' => $overall_gpa,
                'created_by' => $this->session->userdata('u_id'),
                'created_on' => date("Y-m-d h:i:s", now()),

            );
            $this->db->insert('exm_mark_stu_gpa', $insert_gpa);
        } else {
            $update_gpa = array(
                'gpa' => $data['gpa_value'],
                'overall_gpa' => $overall_gpa,
                'update_by' => $this->session->userdata('u_id'),
                'update_on' => date("Y-m-d h:i:s", now()),
            );

            $this->db->where('stu_id', $data['stu_id']);
            $this->db->where('year', $data['year_no']);
            $this->db->where('semester', $data['semester_no']);
            $this->db->update('exm_mark_stu_gpa', $update_gpa);
        }
//=================================End insert GPA values ==============================================

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Approve Marks.';
            $res['page'] = 'ex_dir';
            $this->logger->systemlog('Mark Approve Ex Dir', 'Faliure', 'Failed to Approve Marks.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Marks Approved successfully.';
            $res['page'] = 'ex_dir';
            $this->logger->systemlog('Mark Approve Ex Dir', 'Success', 'Marks Approved successfully.', date("Y-m-d H:i:s", now()), $update_exam_mark);

        }

        return $res;
    }

    public function get_subject_marking_method_details($data)
    {

        $this->db->select('mmd.marking_method_id, mmd.type_id');
        $this->db->join('edu_semester es', 'es.year_id = ey.id');
        $this->db->join('mod_semester_subject mss', 'mss.semester_id = es.id');
        $this->db->join('mod_semester_subject_details mssd', 'mssd.semester_subject_id = mss.id');
        $this->db->join('mod_marking_details mmd', 'mmd.marking_method_id = mssd.marking_method_id');
        $this->db->where('ey.course_id', $data['course_id']);
        $this->db->where('es.year_no', $data['year_no']);
        $this->db->where('mss.semester_no', $data['semester_no']);
        $this->db->where('mss.batch_id', $data['batch_id']);
        $this->db->where('mssd.subject_id', $data['subject_id']);
        $this->db->where('ey.deleted', 0);
        $this->db->where('es.deleted', 0);
        $this->db->where('mss.deleted', 0);
        $this->db->where('mssd.deleted', 0);
        $this->db->where('mmd.deleted', 0);
        $marking_method_array = $this->db->get('edu_year ey')->result_array();

        return $marking_method_array;
    }

    public function get_all_centers()
    {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }

    public function load_semester_subjects($data, $batch_details)
    {
        $this->db->select('*,co.type as subject_type');
        $this->db->join('mod_semester_subject_details sd', 'sc.id = sd.semester_subject_id');
        $this->db->join('edu_semester se', 'se.id = sc.semester_id');
        $this->db->join('edu_year yr', 'yr.id = se.year_id');
        $this->db->join('mod_subject co', 'co.id = sd.subject_id');
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

    public function load_semester_subjects_deferement($data)
    {
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
//        $this->db->order_by("co.type", "asc");
        //        $this->db->order_by("co.code", "asc");
        $result_array = $this->db->get('mod_semester_subject sc')->result_array();
        return $result_array;
    }

    public function load_student_who_absent_exam($data, $batch_details)
    {

        $this->db->select('*, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order');

        $this->db->join('exm_semester_exam ese', 'ese.id = esed.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.student_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject md', 'md.id = esed.subject_id');

        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('ese.exam_id', $data['exam_id']);
        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.is_absent', 1);
        $this->db->where('esed.is_absent_approve', 0);
//        $this->db->where('absent_deferement', 0);
        if ($data['access_level'] == 5) {
            $this->db->where('esed.student_id', $data['stu_id']);
        } else {
            $this->db->group_by('sr.stu_id');
        }

        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); ////////////Query Change
        $result_array = $this->db->get('exm_semester_exam_details esed')->result_array();

//        $this->db->join('stu_subject sc', 'sc.student_id = stu.stu_id');
        ////        $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
        ////        $this->db->join('mod_subject co', 'co.id = fc.subject_id');
        //        $this->db->where('sc.course_id', $batch_details['course_id']);
        //        $this->db->where('sc.year_no', $batch_details['current_year']);
        //        $this->db->where('sc.semester_no', $batch_details['current_semester']);
        ////        $this->db->where('sc.batch_id', $data['batch_id']);
        ////        $this->db->where('stu.current_year', $data['current_year']);
        ////        $this->db->where('stu.current_semester', $data['batch_id']);
        //        $this->db->where('stu.deleted', 0);
        //        $this->db->where('sc.is_Approved', 1);
        //
        //        $this->db->where('stu.batch_id', $data['batch_id']);
        //        $this->db->where('stu.center_id', $data['center_id']);
        //        if ($data['access_level'] == 5)
        //            $this->db->where('stu.stu_id', $data['stu_id']);
        //        //and stu.stu_id=118
        //        $this->db->where('NOT(EXISTS(select student_id from exm_semester_exam_details where student_id = stu.stu_id))');
        //        $result_array = $this->db->get('stu_reg stu')->result_array();

        // if($status == 0){

        // }

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*');
//            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = sc.subject_id');
            $this->db->where('sc.student_id', $result_array[$i]['stu_id']);
            //$this->db->where('sc.is_attend', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('exm_semester_exam_details sc')->result_array();
        }
        return $result_array;
    }

    public function load_student_who_absent_exam_repeat($data)
    {

        $this->db->select('*, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order, esed.absent_deferement as absent_deferement, esed.semester_exam_id as semester_exam_id_rpt');

        $this->db->join('exm_semester_exam_details es', 'es.id = esed.exm_semester_exam_details');
        $this->db->join('exm_semester_exam ese', 'ese.id = es.semester_exam_id');
        $this->db->join('stu_reg sr', 'sr.stu_id = esed.stu_id');
        $this->db->join('exm_exam ee', 'ee.id = ese.exam_id');
        $this->db->join('mod_subject md', 'md.id = esed.subject_id');

        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('ese.course_id', $data['course_id']);
        $this->db->where('ese.batch_id', $data['batch_id']);
        $this->db->where('ese.year_no', $data['year_no']);
        $this->db->where('ese.semester_no', $data['semester_no']);
        $this->db->where('esed.semester_exam_id', $data['exam_id']);
        $this->db->where('esed.is_attend', 0);
        $this->db->where('esed.deleted', 0);
        $this->db->where('esed.is_absent', 1);
        $this->db->where('esed.is_repeat_approved', 1);
        $this->db->where('esed.is_exam_held', 1);
        $this->db->where('esed.is_absent_approve', 0);
        $this->db->where('sr.deleted', 0);
        $this->db->where('sr.approved', 1);

//        $this->db->where('absent_deferement', 0);
        //         if ($data['access_level'] == 5)
        //           $this->db->where('esed.stu_id', $data['stu_id']);
        //         else
        $this->db->group_by('sr.stu_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); ////////////Query Change
        $result_array = $this->db->get('exm_semester_exam_details_repeat esed')->result_array();

        for ($i = 0; $i < count($result_array); $i++) {
            $this->db->select('*');
//            $this->db->join('stu_follow_subject fc', 'sc.id = fc.student_subject_id');
            $this->db->join('mod_subject co', 'co.id = sc.subject_id');
            $this->db->where('sc.stu_id', $result_array[$i]['stu_id']);
            $this->db->where('sc.is_attend', 0);
            $result_array[$i]['selected_subjects'] = $this->db->get('exm_semester_exam_details_repeat sc')->result_array();
        }
        return $result_array;
    }

    public function deferement_approval($data)
    {
        $this->db->trans_begin();

        for ($i = 0; $i < sizeof($data['subjects']); $i++) {
            $this->db->where('student_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $this->db->set('is_absent_approve', 1, false);
            $this->db->set('no_of_attempts', 'no_of_attempts-1', false);
            $this->db->set('absent_approve_by', $this->session->userdata('u_id'), false);
            $this->db->set('absent_approve_datetime', "'" . date("Y-m-d H:i:s", now()) . "'", false);
            $this->db->update('exm_semester_exam_details');
//                    , array(
            //
            //            'is_absent_approve' => 1,
            //            //'is_absent' => is_absent-1,
            //            'absent_approve_by' => $this->session->userdata('u_id'),
            //            'absent_approve_datetime' => date("Y-m-d H:i:s", now()),
            //
            //
            //        )

        }
        // $this->db->where('subject_id', $data['subject_id']);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Deferment Approval Failed.';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Deferement Approval', 'Faliure', 'Deferment Approval Failed.', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Deferment Successfully Approved.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Deferement Approval', 'Success', 'Deferment Successfully Approved.', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;

    }

    public function deferement_approval_repeat($data)
    {

        $this->db->trans_begin();

        for ($i = 0; $i < sizeof($data['subjects']); $i++) {
            //$this->db->join('exm_semester_exam_details es', 'es.id = esedr.exm_semester_exam_details');
            $this->db->set('esedr.is_absent_approve', 1, false);
            //$this->db->set('exm_semester_exam_details.no_of_attempts', 'no_of_attempts-1',FALSE);
            $this->db->set('esedr.absent_approve_by', $this->session->userdata('u_id'), false);
            $this->db->set('esedr.absent_approve_datetime', "'" . date("Y-m-d H:i:s", now()) . "'", false);
            $this->db->where('esedr.stu_id', $data['stu_id']);
            $this->db->where('esedr.semester_exam_id', $data['semester_exam_id']);
            $this->db->where('esedr.subject_id', $data['subjects'][$i]);
            $this->db->update('exm_semester_exam_details_repeat esedr');

            $this->db->select("exm_semester_exam_details");
            $this->db->where('stu_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $approval_array = $this->db->get('exm_semester_exam_details_repeat')->row_array();

            if ($approval_array) {
                $exe_se_detail_id = $approval_array['exm_semester_exam_details'];
            } else {
                $exe_se_detail_id = null;
            }

            if ($exe_se_detail_id != null) {
                $this->db->set('exm_semester_exam_details.no_of_attempts', 'exm_semester_exam_details.no_of_attempts-1', false);
                $this->db->where('exm_semester_exam_details.id', $exe_se_detail_id);
                $this->db->update('exm_semester_exam_details');
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Repeat Deferment Approval Failed.';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Repeat Deferement Approval', 'Faliure', 'Repeat Deferment Approval Failed.', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Repeat Deferment Successfully Approved.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Repeat Deferement Approval', 'Success', 'Repeat Deferment Successfully Approved.', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;

    }

    public function deferement_reject($data)
    {
        $this->db->trans_begin();

        for ($i = 0; $i < sizeof($data['subjects']); $i++) {
            $this->db->where('student_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $this->db->set('is_absent_approve', 2, false);
            $this->db->set('absent_approve_by', $this->session->userdata('u_id'), false);
            $this->db->set('absent_approve_datetime', "'" . date("Y-m-d H:i:s", now()) . "'", false);

            $this->db->update('exm_semester_exam_details');
        }
        // $this->db->where('subject_id', $data['subject_id']);

//        , array(
        //
        //            'is_absent_approve' => 2,
        //            'added_by' => 'added_by+1',
        //            'absent_approve_by' => $this->session->userdata('u_id'),
        //            'absent_approve_datetime' => date("Y-m-d H:i:s", now()),
        //
        //
        //        )

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Deferment Rejection Failed.';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Deferement Reject', 'Faliure', 'Deferment Rejection Failed..', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Deferment Successfully Rejected.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Deferement Reject', 'Success', 'Deferment Successfully Rejected.', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;

    }

    public function deferement_reject_repeat($data)
    {
        $this->db->trans_begin();

        for ($i = 0; $i < sizeof($data['subjects']); $i++) {
            $this->db->where('stu_id', $data['stu_id']);
            $this->db->where('semester_exam_id', $data['semester_exam_id']);
            $this->db->where('subject_id', $data['subjects'][$i]);
            $this->db->set('is_absent_approve', 2, false);
            $this->db->set('absent_approve_by', $this->session->userdata('u_id'), false);
            $this->db->set('absent_approve_datetime', "'" . date("Y-m-d H:i:s", now()) . "'", false);

            $this->db->update('exm_semester_exam_details_repeat');
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Repeat Deferment Rejection Failed.';
            //$this->session->set_flashdata('flashSuccess', 'Approved Failed !');
            $this->logger->systemlog('Repeat Deferement Reject', 'Faliure', 'Repeat Deferment Rejection Failed..', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Repeat Deferment Successfully Rejected.';
            //$this->session->set_flashdata('flashSuccess', 'Approved successfully');
            $this->logger->systemlog('Repeat Deferement Reject', 'Success', 'Repeat Deferment Successfully Rejected.', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;

    }

    public function view_gpa_results($data)
    {
        $this->db->select('*');

        $this->db->join('stu_reg sr', 'sr.stu_id = emsg.stu_id');

        $this->db->where('emsg.stu_id', $data['stu_id']);

        $result_array = $this->db->get('exm_mark_stu_gpa emsg')->result_array();
        return $result_array;
    }

    public function load_recorrection_students_to_approve()
    {
        $this->db->select('sr.stu_id, sr.reg_no, sr.first_name, SUBSTRING_INDEX(sr.reg_no, "/", -1) as regno_order'); ///////////Query Change
        $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
        $this->db->where('em.course_id', $this->input->post('recorectCourse'));
        $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
        $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
        $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
        $this->db->where('em.is_recorrection', 1);
        $this->db->where('em.is_recorrection_approved', 0);
        $this->db->where('em.is_hod_mark_aproved', 1);
        $this->db->where('em.is_director_mark_approved', 1);
        $this->db->where('em.is_ex_director_mark_approved', 1);
        $this->db->where('sr.deleted', 0);
        $this->db->where('em.deleted', 0);
        $this->db->group_by('em.student_id');
        $this->db->order_by('CAST(regno_order as SIGNED INTEGER)', 'ASC'); ///////////Query Change

        $exams_students = $this->db->get('exm_mark em')->result_array();

        for ($i = 0; $i < count($exams_students); $i++) { //put only all subjects to one array..
            $this->db->select('ms.id as subject_id, ms.code, ms.subject, em.id as mark_id, em.sem_exam_id as exam_id, em.overall_grade, em.result, em.is_recorrection as recorrection');
            $this->db->join('stu_reg sr', 'sr.stu_id=em.student_id');
            $this->db->join('mod_subject ms', 'ms.id=em.subject_id');
            $this->db->where('em.course_id', $this->input->post('recorectCourse'));
            $this->db->where('em.batch_id', $this->input->post('recorectBatch'));
            $this->db->where('em.sem_exam_id', $this->input->post('recorectExam'));
            $this->db->where('sr.center_id', $this->input->post('recorectCenter'));
            $this->db->where('em.student_id', $exams_students[$i]['stu_id']);
            $this->db->where('em.is_recorrection', 1);
            $this->db->where('em.is_recorrection_approved', 0);
            $this->db->where('em.is_hod_mark_aproved', 1);
            $this->db->where('em.is_director_mark_approved', 1);
            $this->db->where('em.is_ex_director_mark_approved', 1);
            $this->db->where('sr.deleted', 0);
            $this->db->where('em.deleted', 0);

            $exams_students[$i]['subjects'] = $this->db->get('exm_mark em')->result_array();
        }
        if ($exams_students) {
            return $exams_students;
        } else {
            return null;
        }
    }

    public function update_recorrection_status($data)
    {

        $this->db->trans_begin();

        $mark_data_rec = $this->get_mark_data_for_recorrection($data);

        if (count($mark_data_rec) > 0) {
            $marking_method_array = $this->Student_model->get_relevent_marking_details($mark_data_rec['course_id'], $mark_data_rec['year_no'], $mark_data_rec['semester_no'], $mark_data_rec['batch_id'], $mark_data_rec['subject_id']);
        }

        if (count($marking_method_array) > 0) {
            if ((count($marking_method_array) == 1) && ($marking_method_array[0]['type_id'] == 2)) {
                if ($data['status'] == 1) {
                    $update_data = array(
                        'is_recorrection_approved' => $data['status'],
                        'recorrection_approved_by' => $this->session->userdata('u_id'),
                        'recorrection_approved_on' => date("Y-m-d H:i:s", now()),
                        'is_hod_mark_aproved' => 0,
                        'is_director_mark_approved' => 0,
                        'is_ex_director_mark_approved' => 0,
                    );
                } else {
                    $update_data = array(
                        'is_recorrection_approved' => $data['status'],
                        'recorrection_approved_by' => $this->session->userdata('u_id'),
                        'recorrection_approved_on' => date("Y-m-d H:i:s", now()),
                    );
                }

                $this->db->where('student_id', $data['student_id']);
                $this->db->where('sem_exam_id', $data['exam_id']);
                $this->db->where('subject_id', $data['subject_id']);
                $this->db->update('exm_mark', $update_data);

                $update_detail_data = array(
                    'is_hod_mark_aproved' => 0,
                    'is_director_mark_approved' => 0,
                );
                $this->db->where('exam_mark_id', $data['mark_id']);
                $this->db->where('exam_type_id', 2);
                $this->db->where('deleted', 0);
                $this->db->update('exm_mark_details', $update_detail_data);
            } else {
                if ($data['status'] == 1) {
                    $update_data = array(
                        'is_recorrection_approved' => $data['status'],
                        'recorrection_approved_by' => $this->session->userdata('u_id'),
                        'recorrection_approved_on' => date("Y-m-d H:i:s", now()),
                        'is_ex_director_mark_approved' => 0,
                    );
                } else {
                    $update_data = array(
                        'is_recorrection_approved' => $data['status'],
                        'recorrection_approved_by' => $this->session->userdata('u_id'),
                        'recorrection_approved_on' => date("Y-m-d H:i:s", now()),
                    );
                }

                $this->db->where('student_id', $data['student_id']);
                $this->db->where('sem_exam_id', $data['exam_id']);
                $this->db->where('subject_id', $data['subject_id']);
                $this->db->update('exm_mark', $update_data);

                $update_detail_data = array(
                    'is_director_mark_approved' => 0,
                );
                $this->db->where('exam_mark_id', $data['mark_id']);
                $this->db->where('exam_type_id', 1);
                $this->db->where('deleted', 0);
                $this->db->update('exm_mark_details', $update_detail_data);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'failed';
            $res['message'] = 'Failed to Approve/Reject Student. Retry.';
            $res['approve'] = $data['status'];
            $this->logger->systemlog('Update Recorrection Status', 'Faliure', 'Failed to Approve/Reject Student.', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Student Approve/Reject Successfully';
            $res['approve'] = $data['status'];
            $this->logger->systemlog('Update Recorrection Status', 'Success', 'Student Approve/Reject Successfully.', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;
    }

    public function get_mark_data_for_recorrection($data)
    {
        $this->db->select('course_id, year_no, semester_no, batch_id, subject_id');
        $this->db->where('id', $data['mark_id']);
        return $this->db->get('exm_mark')->row_array();
    }

    public function load_recorrect_course_list()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    public function load_recorrect_course_student()
    {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('ecc.center_id', $this->session->userdata('user_ref_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');
        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    public function load_recorrect_batches($course_id)
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('course_id', $course_id);
        $result = $this->db->get('edu_batch')->result_array();

        return $result;
    }

    public function load_recorrect_batches_student($course_id, $id)
    {
        $this->db->select('*');
        $this->db->join('edu_batch ', 'stu_reg.batch_id=edu_batch.id');
        $this->db->where('edu_batch.deleted', 0);
        $this->db->where('edu_batch.course_id', $course_id);
        $this->db->where('stu_reg.stu_id', $id);
        $result = $this->db->get('stu_reg')->result_array();

        return $result;
    }

    public function load_recorrect_exam($data, $batch_details)
    {
        $this->db->select('*, ex.id as exam_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $batch_details['course_id']);
        $this->db->where('se.year_no', $batch_details['current_year']);
        $this->db->where('se.semester_no', $batch_details['current_semester']);
        $this->db->where('se.batch_id', $data['batch_id']);
        $this->db->where('se.is_approved', 1);

        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }

    public function load_batch_details_by_id($batch_id)
    {
        $this->db->select('*');
        $this->db->where('id', $batch_id);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('edu_batch')->row_array();
        return $result_array;
    }

    public function rpt_approve_student($data)
    {
        $this->db->trans_begin();
        $student_array = array();
        $sem_exam_detail_id = array();
        //  print_r($_REQUEST);
        //  print_r($data);
        while (list($key, $val) = each($data['apply_exam']['apply_exam'])) {
            $student_array[] = $key;

        }
        $i = 0;
        foreach ($data['apply_exam']['apply_exam'] as $row) {
            for ($j = 0; $j < count($row); $j++) {

                $subject_ids = explode("_", $row[$j]);

                $subject_id[$j] = $subject_ids[0];
                $sem_exam_detail_id[$j] = $subject_ids[1];

                $this->db->select('exm_semester_exam_details_repeat_id as repeat_id');
                $this->db->where('stu_id', $student_array[$i]);
                $this->db->where('subject_id', $subject_id[$j]);
                $this->db->where('is_repeat', 1);
                $this->db->where('is_repeat_approved', 1);
                $this->db->where('deleted', 0);
                $stu_exists = $this->db->get('exm_semester_exam_details_repeat')->row_array();

                if ($stu_exists) {
                    $update_delete_repeat = array(
                        'deleted' => 1,
                    );
                    $this->db->where('exm_semester_exam_details_repeat_id', $stu_exists['repeat_id']);
                    $this->db->update('exm_semester_exam_details_repeat', $update_delete_repeat);
                }

                $update_sem_detail_rpt['is_repeat'] = 1;
                $update_sem_detail_rpt['is_repeat_approved'] = 1;
                $update_sem_detail_rpt['is_repeat_approved_by'] = $this->session->userdata('u_id');
                $update_sem_detail_rpt['is_repeat_approved_on'] = date("Y-m-d H:i:s", now());
                $update_sem_detail_rpt['semester_exam_id'] = $data['exam_id'];
                $this->db->where('deleted', 0);
                $this->db->where('stu_id', $student_array[$i]);
                $this->db->where('subject_id', $subject_id[$j]);
                $this->db->where('exm_semester_exam_details', $sem_exam_detail_id[$j]);
                $this->db->update('exm_semester_exam_details_repeat', $update_sem_detail_rpt);

                //update exm_semester_exm_details
                $update_sem_detail['is_repeat'] = 1;
                $this->db->where('id', $sem_exam_detail_id[$j]);
                $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
                $this->db->update('exm_semester_exam_details', $update_sem_detail);

//                $update_exm_mark['is_repeat_approve'] = 1;
                //                $this->db->where('student_id', $student_array[$i]);
                //                $this->db->where('subject_id', $subject_id[$j]);
                //                $this->db->where('batch_id', $data['batch_id']);
                //                $this->db->where('course_id', $data['course_id']);
                //                $this->db->where('year_no', $data['year_id']);
                //                $this->db->where('semester_no', $data['semester_id']);
                //                $this->db->update('exm_mark', $update_exm_mark);
            }

            $i++;

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('flashError', 'Failed to approve student for repeat exam. Retry!');
                $this->logger->systemlog('Repeat Approve Student', 'Faliure', 'Failed to approve student for repeat exam.', date("Y-m-d H:i:s", now()), $data);

            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('flashSuccess', 'Student approved for repeat exam successfully!');
                $this->logger->systemlog('Repeat Approve Student', 'Success', 'Student approved for repeat exam successfully.', date("Y-m-d H:i:s", now()), $data);

            }
        }
        //------

    }

    public function rpt_reject_student($data)
    {
        $this->db->trans_begin();
        $student_array = array();
        $sem_exam_detail_id = array();
        //  print_r($_REQUEST);
        //  print_r($data);
        while (list($key, $val) = each($data['apply_exam']['apply_exam'])) {
            $student_array[] = $key;

        }
        $i = 0;
        foreach ($data['apply_exam']['apply_exam'] as $row) {
            for ($j = 0; $j < count($row); $j++) {

                $subject_ids = explode("_", $row[$j]);

                $subject_id[$j] = $subject_ids[0];
                $sem_exam_detail_id[$j] = $subject_ids[1];

                $update_sem_detail_rpt['is_repeat'] = 3;
                $update_sem_detail_rpt['is_repeat_approved'] = 0;
                $update_sem_detail_rpt['is_repeat_approved_by'] = $this->session->userdata('u_id');
                $update_sem_detail_rpt['is_repeat_approved_on'] = date("Y-m-d H:i:s", now());
                $update_sem_detail_rpt['semester_exam_id'] = $data['exam_id'];
                //$update_sem_detail_rpt['semester_exam_id'] = $data['exam_id'];
                $this->db->where('deleted', 0);
                $this->db->where('stu_id', $student_array[$i]);
                $this->db->where('subject_id', $subject_id[$j]);
                $this->db->where('exm_semester_exam_details', $sem_exam_detail_id[$j]);
                $this->db->update('exm_semester_exam_details_repeat', $update_sem_detail_rpt);

                //update exm_semester_exm_details
                $update_sem_detail['is_repeat'] = 3;
                $this->db->where('id', $sem_exam_detail_id[$j]);
                $this->db->set('no_of_attempts', 'no_of_attempts+1', false);
                $this->db->update('exm_semester_exam_details', $update_sem_detail);

                //insert to exam marks table
                $this->db->select('esd.subject_id, esd.semester_exam_id, esm.course_id, esm.year_no, esm.semester_no, esm.batch_id');
                $this->db->join('exm_semester_exam_details esed', 'esd.exm_semester_exam_details = esed.id');
                $this->db->join('exm_semester_exam esm', 'esm.exam_id = esd.semester_exam_id');
                $this->db->where('esd.stu_id', $student_array[$i]);
                $this->db->where('esd.exm_semester_exam_details', $sem_exam_detail_id[$j]);
                $this->db->where('esd.subject_id', $subject_id[$j]);
                $subject_list = $this->db->get('exm_semester_exam_details_repeat esd')->result_array();

                $this->db->select('credits');
                $this->db->where('id', $subject_id[$j]);
                $subj_credits = $this->db->get('mod_subject')->row_array();

                $sems_id = $this->get_edu_semester_id($subject_list[0]['course_id'], $subject_list[0]['year_no']);

                $mark_id = $this->check_subject_mark_exists_rpt($subject_list, $student_array[$i]);

                $mark_data = $this->get_exam_mark_details_rpt($mark_id, $subject_id[$j]);

                $exam_mark_hod = $mark_data[0]['mark_hod_mark_aproved'];
                $exam_mark_director = $mark_data[0]['mark_director_mark_approved'];

                //delete
                $mark_delete = array(
                    'deleted' => 1,
                    'deleted_by' => $this->session->userdata('u_id'),
                    'deleted_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->where('id', $mark_id);
                $this->db->update('exm_mark', $mark_delete);

                $mark_detail_delete = array(
                    'deleted' => 1,
                    'deleted_by' => $this->session->userdata('u_id'),
                    'deleted_on' => date("Y-m-d h:i:s", now()),
                );
                $this->db->where('exam_mark_id', $mark_id);
                $this->db->update('exm_mark_details', $mark_detail_delete);

                $this->db->select('md.type_id, md.percentage, scd.subject_id');
                $this->db->join('edu_semester sem', 'sem.id = sc.semester_id');
                $this->db->join('mod_semester_subject_details scd', 'sc.id = scd.semester_subject_id');
                $this->db->join('mod_marking_method mm', 'mm.id = scd.marking_method_id');
                $this->db->join('mod_marking_details md', 'mm.id = md.marking_method_id');
                $this->db->join('mod_marking_types mt', 'md.type_id = mt.id');
                $this->db->where('sem.id', $sems_id);
                $this->db->where('sc.semester_no', $subject_list[0]['semester_no']);
                $this->db->where('sc.batch_id', $subject_list[0]['batch_id']);
                $this->db->where('scd.subject_id', $subject_id[$j]);
                $this->db->where('sc.deleted', 0);
                $this->db->where('scd.deleted', 0);
                $this->db->where('md.deleted', 0);
                $result_array = $this->db->get('mod_semester_subject sc')->result_array();

                if (count($result_array) > 0) {

                    //insert
                    //insert to exm_exam_mark
                    $insert_exam_mark = array(
                        'student_id' => $student_array[$i],
                        'course_id' => $subject_list[0]['course_id'],
                        'year_no' => $subject_list[0]['year_no'],
                        'semester_no' => $subject_list[0]['semester_no'],
                        'batch_id' => $subject_list[0]['batch_id'],
                        'sem_exam_id' => $subject_list[0]['semester_exam_id'],
                        'subject_id' => $subject_id[$j],
                        'total_marks' => 0,
                        'overall_grade' => 'N/E',
                        'grade_point' => 0,
                        'subject_credit' => $subj_credits['credits'],
                        'result' => 'N/E',
                        'is_recorrection' => 0,
                        'is_recorrection_approved' => 0,
                        'recorrection_approved_by' => 0,
                        'recorrection_approved_on' => "",
                        'is_hod_mark_aproved' => $exam_mark_hod,
                        'is_director_mark_approved' => $exam_mark_director,
                        'is_ex_director_mark_approved' => 1,
                        'exam_status' => $mark_data[0]['mark_exam_status'],
                        'is_repeat_approve' => 0,
                        'is_repeat_mark' => 1,
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now()),
                    );
                    $this->db->insert('exm_mark', $insert_exam_mark);
                    $max_exam_mark_id = $this->get_max_rej_exam_mark_id();

                    for ($y = 0; $y < count($result_array); $y++) {

                        $exam_mark_detail_hod = $mark_data[$y]['is_hod_mark_aproved'];
                        $exam_mark_detail_hod_approve_by = $mark_data[$y]['hod_mark_aproved_by'];
                        $exam_mark_detail_hod_approve_date = $mark_data[$y]['hod_mark_aproved_date'];

                        $exam_mark_detail_director = $mark_data[$y]['is_director_mark_approved'];
                        $exam_mark_detail_director_approve_by = $mark_data[$y]['director_mark_approved_by'];
                        $exam_mark_detail_director_approve_date = $mark_data[$y]['director_mark_approved_date'];

                        $insert_mark_details = array(
                            'exam_mark_id' => $max_exam_mark_id,
                            'exam_type_id' => $result_array[$y]['type_id'],
                            'persentage' => $result_array[$y]['percentage'],
                            'mark' => $mark_data[$y]['mark'],
                            'is_hod_mark_aproved' => $exam_mark_detail_hod,
                            'hod_mark_aproved_by' => $exam_mark_detail_hod_approve_by,
                            'hod_mark_aproved_date' => $exam_mark_detail_hod_approve_date,
                            'is_director_mark_approved' => $exam_mark_detail_director,
                            'director_mark_approved_by' => $exam_mark_detail_director_approve_by,
                            'director_mark_approved_date' => $exam_mark_detail_director_approve_date,
                            'added_by' => $this->session->userdata('u_id'),
                            'added_on' => date("Y-m-d h:i:s", now()),
                        );
                        $this->db->insert('exm_mark_details', $insert_mark_details);
                    }
                }

//                $update_exm_mark['is_repeat_approve'] = 3;
                //                $this->db->where('student_id', $student_array[$i]);
                //                $this->db->where('subject_id', $subject_id[$j]);
                //                $this->db->where('batch_id', $data['batch_id']);
                //                $this->db->where('course_id', $data['course_id']);
                //                $this->db->where('year_no', $data['year_id']);
                //                $this->db->where('semester_no', $data['semester_id']);
                //                $this->db->update('exm_mark', $update_exm_mark);
            }

            $i++;

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('flashError', 'Failed to reject student for repeat exam. Retry!');
                $this->logger->systemlog('Repeat Reject Student', 'Success', 'Failed to reject student for repeat exam.', date("Y-m-d H:i:s", now()), $data);

            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('flashSuccess', 'Student rejected for repeat exam successfully!');
                $this->logger->systemlog('Repeat Reject Student', 'Success', 'Student rejected for repeat exam successfully.', date("Y-m-d H:i:s", now()), $data);

            }
        }
        //------

    }

    public function check_subject_mark_exists_rpt($data, $student)
    {
        $this->db->select('*');
        $this->db->where('student_id', $student);
        $this->db->where('course_id', $data[0]['course_id']);
        $this->db->where('year_no', $data[0]['year_no']);
        $this->db->where('semester_no', $data[0]['semester_no']);
        //$this->db->where('batch_id', $batch);
        $this->db->where('subject_id', $data[0]['subject_id']);
        $this->db->where('deleted', 0);
        $result_array = $this->db->get('exm_mark')->row_array();
        if (!empty($result_array)) {
            //foreach ($result_array as $row) {
            return $result_array['id'];
            //}
        } else {
            return null;
        }
    }

    public function get_exam_mark_details_rpt($mark_id, $subject_id)
    {
        $this->db->select('em.id as mark_id, em.is_recorrection as mark_recorrection, em.is_recorrection_approved as mark_recorrection_approved, em.recorrection_approved_by as mark_recorrection_approve_by, em.recorrection_approved_on as mark_recorrection_approve_on,'
            . 'em.is_hod_mark_aproved as mark_hod_mark_aproved, em.is_director_mark_approved as mark_director_mark_approved, em.is_ex_director_mark_approved as mark_ex_director_mark_approved,'
            . 'em.exam_status as mark_exam_status, em.is_repeat_approve as mark_repeat_approve, emd.*');
        $this->db->join('exm_mark_details emd', 'emd.exam_mark_id = em.id');
        $this->db->where('em.id', $mark_id);
        $this->db->where('em.subject_id', $subject_id);
        $this->db->where('em.deleted', 0);
        $this->db->where('emd.deleted', 0);
        $result = $this->db->get('exm_mark em')->result_array();
        return $result;
    }

    public function get_exam_reject_reason()
    {

        $this->db->select('*');
        $reject_reason = $this->db->get('cfg_exam_reject_reason')->result_array();

        return $reject_reason;
    }

    public function bulk_dir_mark_approval($exm_mark_id, $user_level, $student_id, $form_data, $recorrectionFlag)
    {
        $result = true;
        if ($user_level == 'dir') {

            $is_repeat = 0;
            $semester_subject = $this->get_applied_subject($exm_mark_id, $is_repeat);
            $form_data['subject_id'] = $semester_subject['subject_id'];
            $subj_marking_details = $this->get_subject_marking_method_details($form_data);

            $this->db->select('is_hod_mark_aproved');
            $this->db->where('id', $exm_mark_id);
            $this->db->where('is_repeat_mark != 1');
            $hoFlagRow = $this->db->get('exm_mark')->row_array();
            $hoFlag = $hoFlagRow['is_hod_mark_aproved'];

            if ($hoFlag == 1) {
                $approval_mark = array('is_director_mark_approved' => 1);
                $this->db->where('id', $exm_mark_id);
                $result = $this->db->update('exm_mark', $approval_mark);

                $approval_details = array(
                    'is_director_mark_approved' => 1,
                    'director_mark_approved_date' => date("Y-m-d H:i:s", now()),
                    'director_mark_approved_by' => $this->session->userdata('u_id'),
                );

                $this->db->select('*');
                $this->db->where('exam_mark_id', $exm_mark_id);
                $result_array = $this->db->get('exm_mark_details')->result_array();

                foreach ($result_array as $mark_details) {
                    $hoFlag_details = $mark_details['is_hod_mark_aproved'];
                    if ($hoFlag_details) {
                        $this->db->where('id', $mark_details['id']);
                        $result = $this->db->update('exm_mark_details', $approval_details);
                    }
                }

                if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----
                    //                    if($semester_subject['is_approved'] > 2){ //If Rejected
                    //                        $update_exdir_status = array(
                    //                            'overall_grade' => 'N/E',
                    //                            'grade_point' => 0,
                    //                            'result' => 'N/E',
                    //                            'is_ex_director_mark_approved' => 1,
                    //                            'updated_by' => $this->session->userdata('u_id'),
                    //                            'updated_on' => date("Y-m-d h:i:s", now())
                    //                        );
                    //                    }
                    //                    else{
                    $update_exdir_status = array(
                        'is_ex_director_mark_approved' => 1,
                        'updated_by' => $this->session->userdata('u_id'),
                        'updated_on' => date("Y-m-d h:i:s", now()),
                    );
                    //}

                    $this->db->where('id', $exm_mark_id);
                    $this->db->update('exm_mark', $update_exdir_status);
                } else {
                    if ($semester_subject['is_approved'] > 2) { //If Rejected
                        $update_exdir_status = array(
                            'overall_grade' => 'N/E',
                            'grade_point' => 0,
                            'result' => 'N/E',
                            'is_ex_director_mark_approved' => 1,
                            'updated_by' => $this->session->userdata('u_id'),
                            'updated_on' => date("Y-m-d h:i:s", now()),
                        );

                        $this->db->where('id', $exm_mark_id);
                        $this->db->update('exm_mark', $update_exdir_status);
                    }
                }

                if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----
                    $this->update_gpa_se_approval($exm_mark_id, $student_id, $form_data, false, $recorrectionFlag);
                }

                $this->logger->systemlog('Dir bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_director_mark_approved' => 1, 'user_level' => $user_level));
            }

        } else if ($user_level == 'ex_dir') {
            $this->db->select('is_director_mark_approved');
            $this->db->where('id', $exm_mark_id);
            $this->db->where('is_repeat_mark != 1');
            $dirFlagRow = $this->db->get('exm_mark')->row_array();
            $dirFlag = $dirFlagRow['is_director_mark_approved'];

            if ($dirFlag == 1) {
                $approval = array('is_ex_director_mark_approved' => 1);
                $this->db->where('id', $exm_mark_id);
                $result = $this->db->update('exm_mark', $approval);

                $approval_details = array(
                    'is_director_mark_approved' => 1,
                    'director_mark_approved_date' => date("Y-m-d H:i:s", now()),
                    'director_mark_approved_by' => $this->session->userdata('u_id'),
                );

                $this->db->select('*');
                $this->db->where('exam_mark_id', $exm_mark_id);
                $result_array = $this->db->get('exm_mark_details')->result_array();

                foreach ($result_array as $mark_details) {
                    $this->db->where('id', $mark_details['id']);
                    $result = $this->db->update('exm_mark_details', $approval_details);
                }

                $this->update_gpa_se_approval($exm_mark_id, $student_id, $form_data, false, $recorrectionFlag);

                $this->logger->systemlog('Ex Dir bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_director_mark_approved' => 1, 'user_level' => $user_level));
            }
        }

        return $result;
    }

    public function get_applied_subject($exm_mrk_id, $is_repeat)
    {

        if ($is_repeat == 1) {
            $this->db->select('em.subject_id, esed.is_repeat_approved as is_approved, em.is_recorrection_approved');
            $this->db->join('exm_semester_exam_details_repeat esed', 'em.student_id = esed.stu_id AND em.subject_id = esed.subject_id');
            $this->db->where('em.id', $exm_mrk_id);
            $this->db->where('esed.deleted', 0);
            $sem_subject = $this->db->get('exm_mark em')->row_array();
        } else {
            $this->db->select('em.subject_id, esed.is_approved, em.is_recorrection_approved');
            $this->db->join('exm_semester_exam_details esed', 'em.student_id = esed.student_id AND em.subject_id = esed.subject_id');
            $this->db->where('em.id', $exm_mrk_id);
            $sem_subject = $this->db->get('exm_mark em')->row_array();
        }

        return $sem_subject;
    }

    public function update_gpa_se_approval($exm_mark_id, $student_id, $form_data, $repeat_flag, $recorrectionFlag)
    {
        //insert overall gpa to exm_mark_stu_gpa

        $batch_id = $form_data['batch_id'];

        if ($repeat_flag) {
            $this->db->select('*');
            $this->db->where('stu_id', $student_id);
            $stu_data_array = $this->db->get('stu_reg')->row_array();
            $batch_id = $stu_data_array['batch_id'];
        }

        $this->db->select('sem_exam_id');
        $this->db->where('id', $exm_mark_id);
        $sem_exam = $this->db->get('exm_mark')->row_array();

        $this->db->select('SUM(credits) as total_credits');
        $this->db->join('stu_follow_subject sfs', 'sfs.subject_id = ms.id');
        $this->db->join('stu_subject ss', 'sfs.student_subject_id = ss.id');
        $this->db->where('ss.student_id', $student_id);
        $this->db->where('ss.course_id', $form_data['course_id']);
        $this->db->where('ss.batch_id', $batch_id);
        $this->db->where('ss.year_no', $form_data['year_no']);
        $this->db->where('ss.semester_no', $form_data['semester_no']);
        $this->db->where('ms.is_gpa_apply !=', 0);
        $this->db->where('ms.deleted', 0);
        $this->db->where('sfs.deleted', 0);
        $this->db->where('ss.deleted', 0);
        $credits = $this->db->get('mod_subject ms')->row_array();

        if ($repeat_flag) {
            $this->db->select('ROUND((SUM(em.grade_point*em.subject_credit)/' . $credits['total_credits'] . '), 2) as gpa');
            $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
            $this->db->where('em.student_id', $student_id);
            $this->db->where('em.year_no', $form_data['year_no']);
            $this->db->where('em.semester_no', $form_data['semester_no']);
            //$this->db->where('sem_exam_id', $sem_exam['sem_exam_id']);
            $this->db->where_not_in('em.result', array('DFR', 'I(SE)', 'I(CA)', 'INC', 'AB', 'N/E', '-', ''));
            $this->db->where('ms.is_gpa_apply !=', 0);
            $this->db->where('em.deleted', 0);
            $gpa = $this->db->get('exm_mark em')->row_array();

            if ($gpa['gpa'] != null) {
                $result_array['gpa_value'] = $gpa['gpa'];
            } else {
                $result_array['gpa_value'] = 0;
            }
        } else {
            //$this->db->select('(SUM(grade_point*subject_credit)/SUM(subject_credit)) as gpa');
            $this->db->select('ROUND((SUM(em.grade_point*em.subject_credit)/' . $credits['total_credits'] . '), 2) as gpa');
            $this->db->join('mod_subject ms', 'ms.id = em.subject_id');
            $this->db->where('em.student_id', $student_id);
            $this->db->where('em.sem_exam_id', $sem_exam['sem_exam_id']);
            $this->db->where('em.year_no', $form_data['year_no']);
            $this->db->where('em.semester_no', $form_data['semester_no']);
            $this->db->where('em.semester_no', $form_data['semester_no']);
            $this->db->where_not_in('em.result', array('DFR', 'I(SE)', 'I(CA)', 'INC', 'AB', 'N/E', '-', ''));
            $this->db->where('ms.is_gpa_apply !=', 0);
            $gpa = $this->db->get('exm_mark em')->row_array();

            if ($gpa['gpa'] != null) {
                $result_array['gpa_value'] = $gpa['gpa'];
            } else {
                $result_array['gpa_value'] = 0;
            }
        }

        //calculate overall gpa

        $gpa_total = 0;

        if ($repeat_flag || $recorrectionFlag) {
            $this->db->select('stu_id, gpa');
            $this->db->where('stu_id', $student_id);
            $this->db->where('NOT(year = ' . $form_data['year_no'] . ' AND semester = ' . $form_data['semester_no'] . ')');

            $gpa_data = $this->db->get('exm_mark_stu_gpa')->result_array();

            $prev_gpa_count = count($gpa_data) + 1;

            for ($g = 0; $g < count($gpa_data); $g++) {
                $gpa_total += $gpa_data[$g]['gpa'];
            }

            $pre_overall_gpa = (($gpa_total + $result_array['gpa_value']) / $prev_gpa_count);
            $overall_gpa = round($pre_overall_gpa, 2);
        } else {

            $this->db->select('stu_id, gpa');
            $this->db->where('stu_id', $student_id);

            $gpa_data = $this->db->get('exm_mark_stu_gpa')->result_array();

            $prev_gpa_count = count($gpa_data) + 1;

            for ($g = 0; $g < count($gpa_data); $g++) {
                $gpa_total += $gpa_data[$g]['gpa'];
            }

            $pre_overall_gpa = (($gpa_total + $result_array['gpa_value']) / $prev_gpa_count);
            $overall_gpa = round($pre_overall_gpa, 2);
        }

        //insert gpa values
        $this->db->select('count(stu_id) as gpa_count');
        $this->db->where('stu_id', $student_id);
        $this->db->where('year', $form_data['year_no']);
        $this->db->where('semester', $form_data['semester_no']);

        $is_available_gpa = $this->db->get('exm_mark_stu_gpa')->row_array();

        if ($is_available_gpa['gpa_count'] == 0) {
            $insert_gpa = array(
                'stu_id' => $student_id,
                'year' => $form_data['year_no'],
                'semester' => $form_data['semester_no'],
                'gpa' => $result_array['gpa_value'],
                'overall_gpa' => $overall_gpa,
                'created_by' => $this->session->userdata('u_id'),
                'created_on' => date("Y-m-d h:i:s", now()),

            );
            $this->db->insert('exm_mark_stu_gpa', $insert_gpa);
        } else {
            if ($repeat_flag) {
                $update_gpa = array(
                    'gpa' => $result_array['gpa_value'],
                    'update_by' => $this->session->userdata('u_id'),
                    'update_on' => date("Y-m-d h:i:s", now()),
                );

                $update_overall_gpa = array(
                    'overall_gpa' => $overall_gpa,
                    'update_by' => $this->session->userdata('u_id'),
                    'update_on' => date("Y-m-d h:i:s", now()),
                );

                $this->db->where('stu_id', $student_id);
                $this->db->where('year', $form_data['year_no']);
                $this->db->where('semester', $form_data['semester_no']);
                $this->db->update('exm_mark_stu_gpa', $update_gpa);

                $this->db->where('stu_id', $student_id);
                $this->db->update('exm_mark_stu_gpa', $update_overall_gpa);
            } else {
                $update_gpa = array(
                    'gpa' => $result_array['gpa_value'],
                    'overall_gpa' => $overall_gpa,
                    'created_by' => $this->session->userdata('u_id'),
                    'created_on' => date("Y-m-d h:i:s", now()),
                );

                $this->db->where('stu_id', $student_id);
                $this->db->where('year', $form_data['year_no']);
                $this->db->where('semester', $form_data['semester_no']);
                $this->db->update('exm_mark_stu_gpa', $update_gpa);
            }
        }

    }

    public function bulk_rpt_dir_mark_approval($exm_mark_id, $user_level, $student_id, $form_data, $recorrectionFlag)
    {
        $result = true;
        if ($user_level == 'dir') {
            $is_repeat = 1;
            $semester_subject = $this->get_applied_subject($exm_mark_id, $is_repeat);
            $form_data['subject_id'] = $semester_subject['subject_id'];
            $subj_marking_details = $this->get_subject_marking_method_details($form_data);

            $this->db->select('is_hod_mark_aproved');
            $this->db->where('id', $exm_mark_id);
            $this->db->where('is_repeat_mark = 1');
            $hoFlagRow = $this->db->get('exm_mark')->row_array();
            $hoFlag = $hoFlagRow['is_hod_mark_aproved'];

            if ($hoFlag == 1) {
                $approval = array('is_director_mark_approved' => 1);
                $this->db->where('id', $exm_mark_id);
                $result = $this->db->update('exm_mark', $approval);

                $approval_details = array(
                    'is_director_mark_approved' => 1,
                    'director_mark_approved_date' => date("Y-m-d H:i:s", now()),
                    'director_mark_approved_by' => $this->session->userdata('u_id'),
                );

                $this->db->select('*');
                $this->db->where('exam_mark_id', $exm_mark_id);
                $result_array = $this->db->get('exm_mark_details')->result_array();

                foreach ($result_array as $mark_details) {
                    $hoFlag_details = $mark_details['is_hod_mark_aproved'];
                    if ($hoFlag_details) {
                        $this->db->where('id', $mark_details['id']);
                        $result = $this->db->update('exm_mark_details', $approval_details);
                    }
                }

                if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----
                    //                    if($semester_subject['is_approved'] > 2){ //If Rejected
                    //                        $update_exdir_status = array(
                    //                            'overall_grade' => 'N/E',
                    //                            'grade_point' => 0,
                    //                            'result' => 'N/E',
                    //                            'is_ex_director_mark_approved' => 1,
                    //                            'updated_by' => $this->session->userdata('u_id'),
                    //                            'updated_on' => date("Y-m-d h:i:s", now())
                    //                        );
                    //                    }
                    //                    else{
                    $update_exdir_status = array(
                        'is_ex_director_mark_approved' => 1,
                        'updated_by' => $this->session->userdata('u_id'),
                        'updated_on' => date("Y-m-d h:i:s", now()),
                    );
                    //}

                    $this->db->where('id', $exm_mark_id);
                    $this->db->update('exm_mark', $update_exdir_status);
                } else {
                    if ($semester_subject['is_approved'] > 2) { //If Rejected
                        $update_exdir_status = array(
                            'overall_grade' => 'N/E',
                            'grade_point' => 0,
                            'result' => 'N/E',
                            'is_ex_director_mark_approved' => 1,
                            'updated_by' => $this->session->userdata('u_id'),
                            'updated_on' => date("Y-m-d h:i:s", now()),
                        );

                        $this->db->where('id', $exm_mark_id);
                        $this->db->update('exm_mark', $update_exdir_status);
                    }
                }

                if ((count($subj_marking_details) == 1) && ($subj_marking_details[0]['type_id'] == 2)) { //---FOR ASSIGNMENT ONLY SUBJECTS----
                    $this->update_gpa_se_approval($exm_mark_id, $student_id, $form_data, true, $recorrectionFlag);
                }

                $this->logger->systemlog('Dir bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_director_mark_approved' => 1, 'user_level' => $user_level));
            }

        } else if ($user_level == 'ex_dir') {

            $this->db->select('is_director_mark_approved');
            $this->db->where('id', $exm_mark_id);
            $this->db->where('is_repeat_mark = 1');
            $dirFlagRow = $this->db->get('exm_mark')->row_array();
            $dirFlag = $dirFlagRow['is_director_mark_approved'];

            if ($dirFlag == 1) {
                $approval = array('is_ex_director_mark_approved' => 1);
                $this->db->where('id', $exm_mark_id);
                $result = $this->db->update('exm_mark', $approval);

                $approval_details = array(
                    'is_director_mark_approved' => 1,
                    'director_mark_approved_date' => date("Y-m-d H:i:s", now()),
                    'director_mark_approved_by' => $this->session->userdata('u_id'),
                );

                $this->db->select('*');
                $this->db->where('exam_mark_id', $exm_mark_id);
                $result_array = $this->db->get('exm_mark_details')->result_array();

                foreach ($result_array as $mark_details) {
                    $this->db->where('id', $mark_details['id']);
                    $result = $this->db->update('exm_mark_details', $approval_details);
                }

                $this->update_gpa_se_approval($exm_mark_id, $student_id, $form_data, true, $recorrectionFlag);

                $this->logger->systemlog('Ex Dir bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_ex_director_mark_approved' => 1, 'user_level' => $user_level));
            }
        }

        return $result;
    }

    public function cancel_postpone_status($data)
    {
        $this->db->trans_begin();

        $this->db->where('request_id', $data['request_id']);
        $this->db->update('stu_requests', array('status' => $data['status']));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Student Request Cancel Failed.';
            $this->session->set_flashdata('flashSuccess', 'Student Request Cancel Failed!');
            $this->logger->systemlog('Postpone / Graduation Request Cancel Status', 'Failure', 'Postpone / Graduation Request Cancel Failed', date("Y-m-d H:i:s", now()), $data);

        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Student Request Canceled Successfully.';
            $this->session->set_flashdata('flashSuccess', 'Student Request Canceled Successfully.');
            $this->logger->systemlog('Postpone / Graduation Request Cancel Status', 'Success', 'Postpone / Graduation Request Canceled Successfully', date("Y-m-d H:i:s", now()), $data);

        }
        return $res;

    }

    public function get_postpone_graduation_student_data($data)
    {

        $result_array = array();
        if ($data['type'] == 'graduation') {
            $this->db->select('*');
            $this->db->join('stu_reg reg', 'reg.stu_id = stu.student_id');
            $this->db->where('stu.batch_id', $data['post_batch']);
            $this->db->where('stu.center_id', $data['post_center']);
            $this->db->where('stu.course_id', $data['post_course']);
            $this->db->where('stu.request_type', 2);
            $this->db->where('stu.is_approved', 0);
            $result_array = $this->db->get('stu_requests stu')->result_array();

        } else if ($data['type'] == 'postpone') {
            $this->db->select('*');
            $this->db->join('stu_reg reg', 'reg.stu_id = stu.student_id');
            $this->db->where('stu.batch_id', $data['post_batch']);
            $this->db->where('stu.center_id', $data['post_center']);
            $this->db->where('stu.course_id', $data['post_course']);
            $this->db->where('stu.request_type', 1);
            $this->db->where('stu.status', 0);
            $result_array = $this->db->get('stu_requests stu')->result_array();
        }

        return $result_array;
    }

    public function update_exam_status_bulk($stu_data)
    {
        $this->db->trans_begin();

        $update_array = array(
            'is_approved' => 1,
            'approved_by' => $this->session->userdata('u_id'),
            'approved_datetime' => date("Y-m-d H:i:s", now()),
        );

        $this->db->where('student_id', $stu_data['stu_id']);
        $this->db->where('semester_exam_id', $stu_data['semester_exam_id']);
        $this->db->update('exm_semester_exam_details', $update_array);

        //insert data into exm_semester_exam student status
        $student_data = array(
            'exm_semester_exam_id' => $stu_data['semester_exam_id'],
            'stu_id' => $stu_data['stu_id'],
        );

        $this->db->insert('exm_semester_exam_student_status', $student_data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function bulk_mark_approval_training($exm_mark_id, $student_id, $form_data)
    {
        $result = true;

        $this->db->trans_begin();

        $approval = array('is_ex_director_mark_approved' => 1);
        $this->db->where('id', $exm_mark_id);
        $result = $this->db->update('exm_mark', $approval);

        $this->logger->systemlog('Training bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_ex_director_mark_approved' => 1));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = false;
        } else {
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function rpt_bulk_mark_approval_training($exm_mark_id, $student_id, $form_data)
    {
        $result = true;

        $this->db->trans_begin();

        $approval = array('is_ex_director_mark_approved' => 1);
        $this->db->where('id', $exm_mark_id);
        $result = $this->db->update('exm_mark', $approval);

        $this->logger->systemlog('Training repeat bulk mark approval', 'Success', 'Approved successfully.', date("Y-m-d H:i:s", now()), array('exm_mark_id' => $exm_mark_id, 'is_ex_director_mark_approved' => 1));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = false;
        } else {
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function bulk_ca_mark_approval_level1($data){//Assignment mark HOD Approval

        
        $this->db->trans_begin();
       
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_hod_mark_aproved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        //update hc_mark_details
      
      /*  $existing_detail_ids = $this->exam_model->get_ids__mark_detail_id_by_mark_id($mark_id);
        
        if (count($existing_detail_ids) == count($data['persentage'])) {
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $update_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->where('id', $existing_detail_ids[$i]['id']);
                $this->db->update('exm_mark_details', $update_mark_details);
            }
        } else {
            //delete all and insert new
            //delete
            $mark_delete_array = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('exam_mark_id', $mark_id);
            $this->db->update('exm_mark_details', $mark_delete_array);
            //insert
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $insert_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->insert('exm_mark_details', $insert_mark_details);
            }
        }*/


        //====================== update mark approval status =================================

        $type_id = 2;//type 2 is Assignment,

        $this->db->select('exm_mark_details.id');
        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        $this->db->where('exm_mark.student_id', $data['stu_id']);
        $this->db->where('exm_mark.course_id', $data['course_id']);
        $this->db->where('exm_mark.year_no', $data['year_no']);
        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        $this->db->where('exm_mark_details.deleted', 0);
        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();

        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        $update_exam_mark = array(
            'is_hod_mark_aproved' => $data['status'],
            'hod_mark_aproved_by' => $this->session->userdata('u_id'),
            'hod_mark_aproved_date' => date("Y-m-d h:i:s", now())
        );

        $this->db->where('id', $exam_mark_details_id['id']);
        $this->db->update('exm_mark_details', $update_exam_mark);
        //}

        //====================== END update mark approval status =================================


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res=false;
            
        } else {
            $this->db->trans_commit();
            $res=TRUE;
            
        }


        return $res;
    }

    public function bulk_ca_mark_approval_level2($data){//Assignment Mark Director Approval

        $this->db->trans_begin();
    
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_director_mark_approved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

     /*   //update hc_mark_details
        // $this->db->trans_rollback();
        $existing_detail_ids = $this->exam_model->get_ids__mark_detail_id_by_mark_id($mark_id);
        // return $existing_detail_ids;
        //return 'persentage count :'.count($data['persentage']).'  ids:'.count($existing_detail_ids);
        if (count($existing_detail_ids) == count($data['persentage'])) {
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $update_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->where('id', $existing_detail_ids[$i]['id']);
                $this->db->update('exm_mark_details', $update_mark_details);
            }
        } else {
            //delete all and insert new
            //delete
            $mark_delete_array = array(
                'deleted' => 1,
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->where('exam_mark_id', $mark_id);
            $this->db->update('exm_mark_details', $mark_delete_array);
            //insert
            for ($i = 0; $i < count($data['persentage']); $i++) {
                $insert_mark_details = array(
                    'exam_mark_id' => $mark_id,
                    'exam_type_id' => $data['type_id'][$i],
                    'persentage' => $data['persentage'][$i],
                    'mark' => $data['subject_mark'][$i],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );
                $this->db->insert('exm_mark_details', $insert_mark_details);
            }
        }*/


        //====================== update mark approval status =================================

        $type_id = 2;//type 2 is Assignment,

        $this->db->select('exm_mark_details.id');
        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        $this->db->where('exm_mark.student_id', $data['stu_id']);
        $this->db->where('exm_mark.course_id', $data['course_id']);
        $this->db->where('exm_mark.year_no', $data['year_no']);
        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        $this->db->where('exm_mark_details.deleted', 0);
        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
        //return $exam_mark_details_id;
        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        $update_exam_mark = array(
            'is_director_mark_approved' => $data['status'],
            'director_mark_approved_by' => $this->session->userdata('u_id'),
            'director_mark_approved_date' => date("Y-m-d h:i:s", now())
        );

        $this->db->where('id', $exam_mark_details_id['id']);
        $this->db->update('exm_mark_details', $update_exam_mark);
        //}

        //====================== END update mark approval status =================================


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res=false;

        } else {
            $this->db->trans_commit();
            $res=true;
        }


        return $res;

    }
    public function bulk_se_mark_approval_level_1($data){//Semester Exam Mark Approval
        $this->db->trans_begin();
       
        $this->load->model('exam_model');
        $mark_id = $this->exam_model->check_subject_mark_exists($data);

        $update_exam_mark = array(
            'student_id' => $data['stu_id'],
            'course_id' => $data['course_id'],
            'year_no' => $data['year_no'],
            'semester_no' => $data['semester_no'],
            'batch_id' => $data['batch_id'],
            'sem_exam_id' => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'total_marks' => $data['total_mark'],
            'overall_grade' => $data['overall_grade'],
            'is_ex_director_mark_approved' => $data['status'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('id', $mark_id);
        $this->db->update('exm_mark', $update_exam_mark);

        //update hc_mark_details
      


        //====================== update mark approval status =================================

        $type_id = 1;//

        $this->db->select('exm_mark_details.id');
        $this->db->join('exm_mark_details', 'exm_mark.id   = exm_mark_details.exam_mark_id');
        $this->db->where('exm_mark.student_id', $data['stu_id']);
        $this->db->where('exm_mark.course_id', $data['course_id']);
        $this->db->where('exm_mark.year_no', $data['year_no']);
        $this->db->where('exm_mark.semester_no', $data['semester_no']);
        $this->db->where('exm_mark.batch_id', $data['batch_id']);
        $this->db->where('exm_mark.subject_id', $data['subject_id']);
        $this->db->where('exm_mark.sem_exam_id', $data['exam_id']);
        $this->db->where('exm_mark_details.exam_type_id', $type_id);
        $this->db->where('exm_mark_details.deleted', 0);
        //$this->db->where('exm_mark_details.persentage', $data['persentage']);
        $exam_mark_details_id = $this->db->get('exm_mark')->row_array();
        //return $exam_mark_details_id;
        // if ($exam_mark_details_id != null || $exam_mark_details_id != '') {
        $update_exam_mark = array(
            'is_director_mark_approved' => $data['status'],
            'director_mark_approved_by' => $this->session->userdata('u_id'),
            'director_mark_approved_date' => date("Y-m-d h:i:s", now()),
            'is_hod_mark_aproved' => $data['status'],
            'hod_mark_aproved_by' => $this->session->userdata('u_id'),
            'hod_mark_aproved_date' => date("Y-m-d h:i:s", now())
        );

        $this->db->where('id', $exam_mark_details_id['id']);
        $this->db->update('exm_mark_details', $update_exam_mark);
        //}

        //====================== END update mark approval status =================================


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res=false;

        } else {
            $this->db->trans_commit();
            $res=true;

        }


        return $res;

    }
}

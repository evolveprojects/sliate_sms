<?php

class Interview_model extends CI_model {

    /**
     * Select Centers List
     *
     * @return mixed
     */
    function get_center() {
        $this->db->select('*');
        $this->db->order_by('br_name asc');
        $centers = $this->db->get('cfg_branch')->result_array();

        return $centers;
    }

    /**
     * Get course list according to centers
     *
     * @return mixed
     */
    function load_course_list() {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');
        $course_list = $this->db->get('edu_course cr')->result_array();
        return $course_list;
    }

    function get_student_data($data) {
        $this->db->select('*');
        $this->db->where('id', $data);
        $studentdata = $this->db->get('stu_reg_online_reg')->result_array();
        return $studentdata;
    }

    function search_registered_online_student_data($data) {
        $this->db->select('*');
        $this->db->where('or.is_selected =', 1);
        $this->db->where('or.selected_course', $data['course']);
        $this->db->where('or.selected_center', $data['center']);
        $this->db->where('or.year', $data['year']);
        $online_student_list = $this->db->get('stu_reg_online_reg or')->result_array();

        return $online_student_list;
    }

    function get_selected_course_by_id($course_id) {
        $this->db->select('course_name');
        $this->db->where('or.id =', $course_id);
        $courseName = $this->db->get('edu_course or')->result_array();
        return $courseName;
    }

    function get_selected_center_by_id($center_id) {
        $this->db->select('*');
        $this->db->where('or.br_id =', $center_id);
        $courseName = $this->db->get('cfg_branch or')->result_array();
        return $courseName;
    }

    /**
     * Select Student details by id
     *
     * @param $studentId
     * @return mixed
     */
    function get_student_details($studentId) {
        $this->db->select('*');
        $this->db->where('or.id =', $studentId);
        $online_student_details = $this->db->get('stu_reg_online_reg or')->result_array();
        return $online_student_details;
    }





    function search_online_student($data) {
        try{
            $this->db->select('*,sror.id stu_id');
            $this->db->from('stu_reg_online_reg sror');
            $this->db->join('student_exam_marks sem', 'sem.student_id = sror.id','left');
            $this->db->where('sror.year', $data['year']);
            $this->db->where('priority1_center1', $data['center']);
            $this->db->where('priority1_course', $data['course']);
            $online_students = $this->db->get()->result_array();
            return $online_students;
        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
        }
    }

    function online_registered_students($branch_id) {

        try {

            $this->db->select('*,sror.id stu_id');
            $this->db->from('stu_reg_online_reg sror');
            if (!$branch_id == null) {
                $this->db->where('priority1_center1',$branch_id);
            }
            $this->db->join('student_exam_marks sem', 'sem.student_id = sror.id','left');
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

    /**
     * update student sent email status
     *
     * @param $id
     */
    public function update_student_email_status($id) {
        $this->db->set('sent_interview_mail', 1);
        $this->db->where('id', $id);
        $this->db->update('stu_reg_online_reg');
    }

    function get_user_center($id) {
        $result = $this->db->get_where('cfg_branch',array('br_id'=>$id))->row_array();
        return $result;
    }

}
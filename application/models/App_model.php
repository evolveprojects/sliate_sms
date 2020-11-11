<?php

class App_model extends CI_Model {

    protected $table = 'stu_reg_online_reg';

    function get_al_subject_streams() {
        $this->db->select('*');
        $this->db->order_by('show_order asc');
        $al_subject_streams = $this->db->get('com_al_subject_stream')->result_array();

        return $al_subject_streams;
    }

    function load_al_subject_list() {
        $this->db->select('*');
        $this->db->where('stream_id', $this->input->post('stream_id'));
        $this->db->order_by('subject_name asc');

        $load_al_subject_list = $this->db->get('com_al_subject')->result_array();

        return $load_al_subject_list;
    }

    function get_subject_al_result_grade() {

        $this->db->select('*');
        $this->db->where('type', 'al');
        $subject_grade = $this->db->get('com_al_subject_grade')->result_array();

        return $subject_grade;
    }

    function get_subject_ol_result_grade() {
        $this->db->select('*');
        $this->db->where('type', 'ol');
        $subject_grade = $this->db->get('com_al_subject_grade')->result_array();

        return $subject_grade;
    }

    function get_center() {
        $this->db->select('*');
        $this->db->order_by('br_name asc');
        $centers = $this->db->get('cfg_branch')->result_array();

        return $centers;
    }
    
    function edit_center_load() {
        $this->db->select('*');
        $this->db->where('br_id', $this->input->post('id'));
        $br_data = $this->db->get('cfg_branch')->row_array();

        return $br_data;
    }

    function load_course_list() {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

    function load_course_list_for_student_registration() {
        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('cr.selection_type', $this->input->post('selectionType'));
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }



    function get_stream_percentage($centerId,$courseId,$year) {
        $this->db->select('*');
        $this->db->where('sasp.center_id', $centerId);
        $this->db->where('sasp.course_id', $courseId);
        $this->db->where('sasp.date', $year);
        $course_list = $this->db->get('stu_admin_selection_percentage sasp')->result_array();

        return $course_list;
    }

    function load_al_grades() {
        $this->db->select('*');
        $this->db->where('type', 'al');
        $subject_grade = $this->db->get('com_al_subject_grade')->result_array();

        return $subject_grade;
    }

    function authenticateLogin() {

        $name = $this->input->post('username');
        $pass = $this->input->post('password');
        $encr = hash('sha512', $pass);

        $this->db->select('*,cfg_branch.br_name');
        $this->db->join('ath_usergroup', 'ath_usergroup.ug_id=ath_user.user_ugroup');
        $this->db->join('cfg_branch', 'cfg_branch.br_id=ath_user.user_branch');
        $this->db->where("ath_user.user_name", $name);
        $this->db->where("ath_user.user_password", $encr);
        $this->db->where("ath_user.user_status", 'A');

        $result = $this->db->get("ath_user")->row_array();

        if (!empty($result)) {
            $branch = $this->get_branchdetails($result['ug_branch']);
            $this->session->set_userdata('u_name', $result['user_name']);
            $this->session->set_userdata('u_pass', $result['user_password']);
            $this->session->set_userdata('u_id', $result['user_id']);
            $this->session->set_userdata('u_ugroup', $result['user_ugroup']);
            $this->session->set_userdata('u_emp', $result['user_employee']);
            $this->session->set_userdata('u_group', $result['ug_company']);
            $this->session->set_userdata('u_branch', $result['br_name']);
            $this->session->set_userdata('u_br_code', $result['br_code']);
            $this->session->set_userdata('user_branch', $result['user_branch']);
            $this->session->set_userdata('user_ref_id', $result['user_ref_id']);
            $this->session->set_userdata('u_compname', $branch['br_name']);
            $this->session->set_userdata('u_compaddline1', $branch['br_addl1']);
            $this->session->set_userdata('u_compaddline2', $branch['br_addl2']);
            $this->session->set_userdata('u_compaddline3', $branch['br_city'] . ', ' . $branch['br_country']);
            $this->session->set_userdata('u_branchcode', $branch['br_code']);
        }

        return $result;
    }

    function last_login($data) {
        $resultdata = $this->db->insert('ath_userlogininfo', $data);
        return $resultdata;
    }

    function get_branchdetails($branch) {
        $this->db->where('br_id', $branch);
        $branch = $this->db->get('cfg_branch')->row_array();
    }

    function get_login() {

        $ip = $this->input->ip_address();
        $usr_ip = $this->input->ip_address('ip');

        $this->db->select('login_id');
        $this->db->from('ath_userlogininfo');
        $this->db->where('u_id', $this->session->userdata('u_id'));
        //$this->db->where('login_id <','(select_max login_id from ath_userlogininfo)');
        $this->db->order_by('login_id', 'desc');
        $this->db->limit('1', '1');
        $res = $this->db->get()->row_array();

        if ($res != null) {
            $this->db->select('*');
            $this->db->from('ath_userlogininfo');
            $this->db->where('login_id', $res['login_id']);
            $this->db->where('u_id', $this->session->userdata('u_id'));
            $login = $this->db->get()->row_array();
        } else {
            $this->db->select('*');
            $this->db->from('ath_userlogininfo');
            $this->db->where('u_id', $this->session->userdata('u_id'));
            $login = $this->db->get()->row_array();
        }
        return $login;
    }

    function register($data) {

        return $result = $this->db->insert('stu_reg_online_reg', $data);
    }

    function load_districts() {
        $this->db->select('*');
        $batches = $this->db->get('cfg_district')->result_array();

        return $batches;
    }

    function online_registered_students() {
        $this->db->select('*');
        //$this->db->group_by('indexno');
        $online_students = $this->db->get('stu_reg_online_reg')->result_array();

        return $online_students;
    }

    /**
     * Get Selected year
     *
     * @return mixed
     */
    function online_registered_selected_year() {
        $this->db->select('*');
        $selectedYear = $this->db->get('stu_admin_online_year')->result_array();
        return $selectedYear;
    }

    function online_student_registration_year() {
        $this->db->select('*');
        $selectedYear = $this->db->get('stu_admin_student_registration_year')->result_array();
        return $selectedYear;
    }

    function view_student_prof($id) {

        //$id = $this->input->get('id');

        $this->db->select('*,cd.district as or_district, or.is_approved as or_approved, or.id as or_stu_id, cass.stream_name as al_stream_name, cas1.subject_name as al_sub_1, cas2.subject_name as al_sub_2, cas3.subject_name as al_sub_3, cas4.subject_name as al_sub_4,'
                . 'casg1.grade as al_subg_1, casg2.grade as al_subg_2, casg3.grade as al_subg_3, casg4.grade as al_subg_4,'
                . 'casgm.grade as ol_math, casge.grade as ol_english,'
                . 'cb1.br_name as p1center, cb2.br_name as p2center, cb3.br_name as p3center,'
                . 'ec1.course_name as p1course, ec2.course_name as p2course, ec3.course_name as p3course,'
                . 'ct.title_name as titname');

        $this->db->join('cfg_district cd', 'cd.code = or.district');

        $this->db->join('com_al_subject_stream cass', 'cass.stream_id = or.al_stream');

        $this->db->join('com_al_subject cas1', 'cas1.subject_id = or.al_subject1', 'left outer');
        $this->db->join('com_al_subject cas2', 'cas2.subject_id = or.al_subject2', 'left outer');
        $this->db->join('com_al_subject cas3', 'cas3.subject_id = or.al_subject3', 'left outer');
        $this->db->join('com_al_subject cas4', 'cas4.subject_id = or.al_subject4', 'left outer');

        $this->db->join('com_al_subject_grade casg1', 'casg1.grade_id = or.al_sub1_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg2', 'casg2.grade_id = or.al_sub2_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg3', 'casg3.grade_id = or.al_sub3_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg4', 'casg4.grade_id = or.al_sub4_grade', 'left outer');

        $this->db->join('com_al_subject_grade casgm', 'casgm.grade_id = or.ol_maths_grade');
        $this->db->join('com_al_subject_grade casge', 'casge.grade_id = or.ol_english_grade');

        $this->db->join('cfg_branch cb1', 'cb1.br_id = or.priority1_center', 'left outer');
        $this->db->join('cfg_branch cb2', 'cb2.br_id = or.priority2_center', 'left outer');
        $this->db->join('cfg_branch cb3', 'cb3.br_id = or.priority3_center', 'left outer');

        $this->db->join('edu_course ec1', 'ec1.id = or.priority1_course', 'left outer');
        $this->db->join('edu_course ec2', 'ec2.id = or.priority2_course', 'left outer');
        $this->db->join('edu_course ec3', 'ec3.id = or.priority3_course', 'left outer');

        $this->db->join('com_title ct', 'ct.id = or.title');



        $this->db->where('or.id', $id);
        $this->db->group_by('indexno');
        $student_profile = $this->db->get('stu_reg_online_reg or')->row_array();

        return $student_profile;
    }

    function update_student_apprv_status($id, $status) {

        $data['is_approved'] = $status;
        $this->db->where('id', $id);
        $this->db->update('stu_reg_online_reg', $data);
    }

    /**
     * Get Course By center Id
     *
     * @param $centerId
     * @return mixed
     */
    function getCourseByCenterId($centerId) {
        $this->db->select('ec.id as id ,ec.course_name as course_name');
        $this->db->join('edu_center_course ecc', 'ec.id = ecc.course_id');
        $this->db->where('ecc.center_id', $centerId);

        $courseByCenter = $this->db->get('edu_course ec')->result_array();

        return $courseByCenter;
    }

    function update_student_reject_status($id, $status) {

        $data['is_approved'] = $status;
        $this->db->where('id', $id);
        $this->db->update('stu_reg_onsline_reg', $data);
    }

    function view_student_edit_prof($id) {

        //$id = $this->input->get('id');

        $this->db->select('*,cd.district as or_district, or.is_approved as or_approved, or.id as or_stu_id, cass.stream_name as al_stream_name, cas1.subject_name as al_sub_1, cas2.subject_name as al_sub_2, cas3.subject_name as al_sub_3, cas4.subject_name as al_sub_4,'
                . 'casg1.grade as al_subg_1, casg2.grade as al_subg_2, casg3.grade as al_subg_3, casg4.grade as al_subg_4,'
                . 'casgm.grade as ol_math, casge.grade as ol_english,'
                . 'cb1.br_name as p1center, cb2.br_name as p2center, cb3.br_name as p3center,'
                . 'ec1.course_name as p1course, ec2.course_name as p2course, ec3.course_name as p3course,'
                . 'ct.title_name as titname');

        $this->db->join('cfg_district cd', 'cd.code = or.district');

        $this->db->join('com_al_subject_stream cass', 'cass.stream_id = or.al_stream');

        $this->db->join('com_al_subject cas1', 'cas1.subject_id = or.al_subject1', 'left outer');
        $this->db->join('com_al_subject cas2', 'cas2.subject_id = or.al_subject2', 'left outer');
        $this->db->join('com_al_subject cas3', 'cas3.subject_id = or.al_subject3', 'left outer');
        $this->db->join('com_al_subject cas4', 'cas4.subject_id = or.al_subject4', 'left outer');

        $this->db->join('com_al_subject_grade casg1', 'casg1.grade_id = or.al_sub1_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg2', 'casg2.grade_id = or.al_sub2_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg3', 'casg3.grade_id = or.al_sub3_grade', 'left outer');
        $this->db->join('com_al_subject_grade casg4', 'casg4.grade_id = or.al_sub4_grade', 'left outer');

        $this->db->join('com_al_subject_grade casgm', 'casgm.grade_id = or.ol_maths_grade');
        $this->db->join('com_al_subject_grade casge', 'casge.grade_id = or.ol_english_grade');

        $this->db->join('cfg_branch cb1', 'cb1.br_id = or.priority1_center', 'left outer');
        $this->db->join('cfg_branch cb2', 'cb2.br_id = or.priority2_center', 'left outer');
        $this->db->join('cfg_branch cb3', 'cb3.br_id = or.priority3_center', 'left outer');

        $this->db->join('edu_course ec1', 'ec1.id = or.priority1_course', 'left outer');
        $this->db->join('edu_course ec2', 'ec2.id = or.priority2_course', 'left outer');
        $this->db->join('edu_course ec3', 'ec3.id = or.priority3_course', 'left outer');

        $this->db->join('com_title ct', 'ct.id = or.title');

        $this->db->where('or.id', $id);
        $this->db->group_by('indexno');
        $student_profile = $this->db->get('stu_reg_online_reg or')->row_array();

        return $student_profile;
    }

    public function get_count() {
        return $this->db->count_all($this->table);
    }

    public function get_authors($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    function update_online_student($id, $data) {
        $this->db->where('id', $id);
        return $result = $this->db->update('stu_reg_online_reg', $data);
    }

    function search_online_student_data($data) {
        $this->db->select('*');
        $this->db->where('or.priority1_center', $data['priority1_center']);
        $this->db->where('or.priority1_course', $data['priority1_course']);
        $this->db->where('or.priority1_time', $data['priority1_time']);

        $online_student_list = $this->db->get('stu_reg_online_reg or')->result_array();

        return $online_student_list;
    }

    function load_titles() {
        $this->db->select('*');
        $titles = $this->db->get('com_title')->result_array();

        return $titles;
    }

    function get_next_value() {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $value = $this->db->get('stu_reg_online_reg')->row('id');
        $next_value = $value + 1;

        return $next_value;
    }

    function get_applicaton_id($data) {
        $this->db->select('*');
        $this->db->where('or.nic', $data['nic']);
        $app_id = $this->db->get('stu_reg_online_reg or')->row('id');
        return $app_id;
    }

    function validate_duplicate_nic_number() {
        $nic = $this->input->post('nic');

        $this->db->select('count(id) as nic_count');
        $this->db->where('nic', $nic);
        $nic_query = $this->db->get('stu_reg_online_reg')->row_array();

        return $nic_query;
    }

    function set_capacity_course($data) {

        return $result = $this->db->insert('stu_admin_online_capacity', $data);
    }

    function set_selection_year($data) {

        return $result = $this->db->insert('stu_admin_online_year', $data);
    }

    function set_student_registration_year($data) {

        return $result = $this->db->insert('stu_admin_student_registration_year', $data);
    }

    function update_selection_year($data) {
        $this->db->update('stu_admin_online_year', $data);
    }

    function update_student_registration_year($data) {
        $this->db->update('stu_admin_student_registration_year', $data);
    }

    function set_value_load_details($data) {
        $this->db->select('*');
        $this->db->where('soc.center_id', $data['center_id']);
        $this->db->where('soc.course_id', $data['course_id']);

        $set_value_load_details = $this->db->get('stu_admin_online_capacity soc')->result_array();

        return $set_value_load_details;
    }

    function set_capacity_course_update($data) {
        $this->db->set('capacity', $data['capacity']);
        $this->db->where('id', $data['id']);
        $this->db->update('stu_admin_online_capacity');
    }

    function get_course() {
        $this->db->select('*');
        //$this->db->order_by('br_name asc');
        $centers = $this->db->get('edu_course')->result_array();

        return $centers;
    }

    /**
     * Update insert selection process
     *
     * @param $data
     * @return mixed
     */
    function set_selection_process($data) {
        if ($data['selection_type'] == 1) {
            $data['selection_type_name'] = 'Z- Score';
        } elseif ($data['selection_type'] == 2) {
            $data['selection_type_name'] = 'Selection Exam Marks';
        } else {
            $data['selection_type_name'] = 'Stream Percentage';
        }

        $this->db->where('course_id', $data['course_id']);
        $this->db->where('date', $data['date']);
        $query = $this->db->get('stu_admin_selection_course_type');

        if (!empty($query->result_array())) {
            $this->db->set('selection_type', $data['selection_type']);
            $this->db->set('selection_type_name', $data['selection_type_name']);
            $this->db->where('course_id', $data['course_id']);
            $this->db->where('date', $data['date']);
            $this->db->update('stu_admin_selection_course_type');
        } else {
            return $result = $this->db->insert('stu_admin_selection_course_type', $data);
        }
    }

    function get_center_course_z_score() {
        $this->db->select('sasct.date as sasct_date ,ec.id as edu_course_id, ec.course_name as ec_course_name, ec.course_code as ec_course_code');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = sasct.course_id');
        $this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sasct.date', $this->input->post('date'));
        $this->db->where('sasct.selection_type', 1);
        $this->db->group_by('ec.course_code');
        $this->db->group_by('ec.course_name');

        $course_z_score_list = $this->db->get('stu_admin_selection_course_type sasct')->result_array();

        return $course_z_score_list;
    }

    function get_z_score_details($data) {
        $this->db->select('*, saszs.id as saszs_id');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = saszs.course_id');
        $this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('saszs.center_id', $data['center_id']);
        $this->db->where('saszs.course_id', $data['course_id']);
        $this->db->where('saszs.date', $data['date']);

        $set_z_score_details = $this->db->get('stu_admin_set_z_score saszs')->result_array();

        return $set_z_score_details;
    }

    function get_center_course_exam() {
        $this->db->select('sasct.date as sasct_date ,ec.id as edu_course_id, ec.course_name as ec_course_name, ec.course_code as ec_course_code');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = sasct.course_id');
        $this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sasct.date', $this->input->post('date'));
        $this->db->where('sasct.selection_type', 2);
        $this->db->group_by('ec.course_code');
        $this->db->group_by('ec.course_name');

        $course_z_score_list = $this->db->get('stu_admin_selection_course_type sasct')->result_array();

        return $course_z_score_list;
    }

    function get_exam_details($data) {
        $this->db->select('*, sasem.id as sasem_id');
        //$this->db->join('edu_center_course ecc', 'ecc.course_id = sasem.course_id');
        //$this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('sasem.center_id', $data['center_id']);
        $this->db->where('sasem.course_id', $data['course_id']);
        $this->db->where('sasem.date', $data['date']);

        $set_z_score_details = $this->db->get('stu_admin_selection_exam_marks sasem')->result_array();

        return $set_z_score_details;
    }

    function get_al_streams() {
        $this->db->select('*');

        $centers = $this->db->get('com_al_subject_stream')->result_array();

        return $centers;
    }

    function get_stream_percentage_courses() {
        $this->db->select('sasct.selection_type as sasct_selection_type, sasct.date as sasct_date ,ec.id as edu_course_id, ec.course_name as ec_course_name, ec.course_code as ec_course_code');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = sasct.course_id');
        $this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sasct.date', $this->input->post('date'));
        $this->db->where('sasct.selection_type', 3);
        $this->db->group_by('ec.course_code');
        $this->db->group_by('ec.course_name');

        $course_z_score_list = $this->db->get('stu_admin_selection_course_type sasct')->result_array();

        return $course_z_score_list;
    }

    function get_stream_percentage_details($data) {
        $this->db->select('*, sasp.id as sasp_id');
        //$this->db->join('edu_center_course ecc', 'ecc.course_id = sasem.course_id');
//        $this->db->join('stu_admin_perc_child sapc', 'sapc.perc_id = sasp.id');
//        $this->db->join('com_al_subject_stream cass', 'cass.stream_id = sapc.perc_stream_id');
        $this->db->where('sasp.center_id', $data['center_id']);
        $this->db->where('sasp.course_id', $data['course_id']);
        $this->db->where('sasp.date', $data['date']);

        $set_percentage_details = $this->db->get('stu_admin_selection_percentage sasp')->result_array();
        $x = 0;
        foreach ($set_percentage_details as $perc) {
            $this->db->select('sapc.perc_id, sapc.perc_stream_id, sapc.percentage, cass.stream_name');
            $this->db->join('stu_admin_perc_child sapc', 'sapc.perc_id = sasp.id');
            $this->db->join('com_al_subject_stream cass', 'cass.stream_id = sapc.perc_stream_id');
            $this->db->where('sasp.center_id', $perc['center_id']);
            $this->db->where('sasp.course_id', $perc['course_id']);
            $this->db->where('sasp.date', $perc['date']);

            $set_percentage_details[$x]['percent_details'] = $this->db->get('stu_admin_selection_percentage sasp')->result_array();
            $x++;
        }

        return $set_percentage_details;
    }

    function get_z_score_year() {
        $this->db->select('sasct.date');
        $this->db->group_by('sasct.date');

        $get_z_score_year = $this->db->get('stu_admin_selection_course_type sasct')->result_array();


        return $get_z_score_year;
    }

    function get_mark_year() {
        $this->db->select('sasem.date');
        $this->db->group_by('sasem.date');

        $get_mark_year = $this->db->get('stu_admin_selection_course_type sasem')->result_array();


        return $get_mark_year;
    }

    function get_percentage_year() {
        $this->db->select('sasp.date');
        $this->db->group_by('sasp.date');

        $get_percentage_year = $this->db->get('stu_admin_selection_course_type sasp')->result_array();


        return $get_percentage_year;
    }

    function get_process_courses() {
        $this->db->select('sasct.date as sasct_date ,ec.id as edu_course_id, ec.course_name as ec_course_name, ec.course_code as ec_course_code');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = sasct.course_id');
        $this->db->join('edu_course ec', 'ec.id = ecc.course_id');
        $this->db->where('ecc.center_id', $this->input->post('center_id'));
        $this->db->where('sasct.date', $this->input->post('date'));
        //$this->db->where('sasct.selection_type', 1);
        $this->db->group_by('ec.course_code');
        $this->db->group_by('ec.course_name');

        $course_z_score_list = $this->db->get('stu_admin_selection_course_type sasct')->result_array();

        return $course_z_score_list;
    }

    function get_process_details($data) {
        $this->db->select('*,sasct.selection_type_name as sss, sasct.selection_type as sel_type ,saoc.capacity as limited_capacity');

        $this->db->join('stu_admin_online_capacity saoc', 'saoc.course_id = sasct.course_id');
        //$this->db->join('stu_admin_online_capacity saoc1', 'saoc1.center_id = sasct.center_id');
//        $this->db->join('stu_admin_online_capacity saoc2', 'saoc1.date = sasct.center_id');
        //$this->db->join('stu_admin_online_capacity saoc', 'saoc.course_id = sasct.course_id');
        //$this->db->join('stu_admin_set_z_score saszs', 'saszs.center_id = saoc.center_id');
        //$this->db->join('stu_admin_set_z_score saszs1', 'saszs1.center_id = sasct.course_id');

        $this->db->where('saoc.center_id', $data['center_id']);
        $this->db->where('sasct.course_id', $data['course_id']);
        $this->db->where('sasct.date', $data['date']);

        $get_process_details = $this->db->get('stu_admin_selection_course_type sasct')->result_array();

        $year = $data['date'];

        //print_r($get_process_details['selection_type']);
        $x = 0;
        for ($i = 0; $i < count($get_process_details); $i++) {

            $centerId = $data['center_id'];
            $courseId = $data['course_id'];

            if ($data['priority_type'] == 1) {
                $priorityCenterId = 'priority1_center';
                $priorityCourseId = 'priority1_course';
            }
            if ($data['priority_type'] == 2) {
                $priorityCenterId = 'priority2_center';
                $priorityCourseId = 'priority2_course';
            }
            if ($data['priority_type'] == 3) {
                $priorityCenterId = 'priority3_center';
                $priorityCourseId = 'priority3_course';
            }

            if ($get_process_details[$i]['selection_type'] == 1) {

                $query = $this->db->query("select * from 
                        stu_admin_selection_course_type sasct, 
                        stu_admin_online_capacity saoc 
                        where 
                            sasct.course_id = saoc.course_id and 
                            saoc.course_id=".$courseId." and 
                            saoc.center_id=".$centerId." and 
                            sasct.date='$year'"
                );

                $get_process_details[$x]['types'] = $query->result_array();
                $capacity = $capacity = $get_process_details[$x]['capacity'];

                if ($data['priority_type'] == 1) {
                    $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved =1 and
                                ".$priorityCenterId." = ".$centerId." and
                                ".$priorityCourseId." = ".$courseId."
                                order by z_score
                                desc limit $capacity"
                    );
                } else {
                    $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved =1 and
                                is_selected = 0 and
                                ".$priorityCenterId." = ".$centerId." and
                                ".$priorityCourseId." = ".$courseId."
                                order by z_score
                                desc limit $capacity"
                    );
                }

                $get_process_details[$x]['types']['students'] = $query->result_array();

            } else if ($get_process_details[$i]['selection_type'] == 2) {
                $query = $this->db->query("select * from 
                        stu_admin_selection_course_type sasct, 
                        stu_admin_online_capacity saoc 
                        where 
                            sasct.course_id = saoc.course_id and 
                            saoc.course_id=".$courseId." and 
                            saoc.center_id=".$centerId." and 
                            sasct.date='2020'"
                );
                $get_process_details[$x]['types'] = $query->result_array();

                $capacity = $capacity = $get_process_details[$x]['capacity'];

                if ($data['priority_type'] == 1) {
                    $studentQuery = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.".$priorityCenterId." = sxm.center_id and 
                            sror.".$priorityCourseId." = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.year = '2020'
                            order by sxm.mark desc 
                            limit $capacity");
                } else {
                    $studentQuery = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.".$priorityCenterId." = sxm.center_id and 
                            sror.".$priorityCourseId." = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.is_selected = 0 and
                            sror.year = '2020'
                            order by sxm.mark desc 
                            limit $capacity");
                }


                $get_process_details[$x]['types']['students'] = $studentQuery->result_array();
            } else if ($get_process_details[$i]['selection_type'] == 3) {
                $query = $this->db->query("select * from 
                        stu_admin_selection_course_type sasct, 
                        stu_admin_online_capacity saoc 
                        where 
                            sasct.course_id = saoc.course_id and 
                            saoc.course_id=".$courseId." and 
                            saoc.center_id=".$centerId." and 
                            sasct.date='$year'"
                );
                $get_process_details[$x]['types'] = $query->result_array();
                $capacity = $capacity = $get_process_details[$x]['capacity'];

                if (!empty($capacity)) {
                    $getPercentageQuery = $this->db->query("select * from stu_admin_selection_percentage sasp 
                        where  
                        sasp.center_id = ".$centerId." AND 
                        sasp.course_id = ".$courseId." AND
                        sasp.date = '$year'");

                    $courcePercentage = $getPercentageQuery->result_array();
                    if (!empty($courcePercentage[0]['commerce_perc'])) {
                        $commerce_perc = $courcePercentage[0]['commerce_perc'];
                        $commerceCount  = round($commerce_perc * $capacity/100);

                        $commerceQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Commerce' AND
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."
                            order by sror.z_score desc limit $commerceCount");

                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $commerceQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $commerceQuery->result_array();
                        }
                    }

                    if (!empty($courcePercentage[0]['arts_perc'])) {
                        $arts_perc = $courcePercentage[0]['arts_perc'];
                        $artsCount = round($arts_perc * $capacity/100);

                        $artsQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Arts' AND 
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."
                            order by sror.z_score desc limit $artsCount");

                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $artsQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $artsQuery->result_array();
                        }

                    }

                    if (!empty($courcePercentage[0]['bio_science_perc'])) {
                        $bio_science_perc = $courcePercentage[0]['bio_science_perc'];
                        $bioScienceCount = round($bio_science_perc * $capacity/100);

                        $bioScienceQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Bio Science' AND
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."                          
                            order by sror.z_score desc limit $bioScienceCount");

                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $bioScienceQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $bioScienceQuery->result_array();
                        }

                    }

                    if (!empty($courcePercentage[0]['mathematics_perc'])) {
                        $mathematics_perc = $courcePercentage[0]['mathematics_perc'];
                        $mathematicsCount = round($mathematics_perc * $capacity/100);

                        $mathematicsQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Mathematics'  AND
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."
                            order by sror.z_score desc limit $mathematicsCount");
                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $mathematicsQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $mathematicsQuery->result_array();
                        }

                    }

                    if (!empty($courcePercentage[0]['technology_perc'])) {
                        $technology_perc = $courcePercentage[0]['technology_perc'];
                        $technologyCount = round($technology_perc * $capacity/100);

                        $technologyQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Technology' AND 
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."
                            order by sror.z_score desc limit $technologyCount");

                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $technologyQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $technologyQuery->result_array();
                        }
                    }

                    if (!empty($courcePercentage[0]['other_perc'])) {
                        $other_perc = $courcePercentage[0]['other_perc'];
                        $otherCount = round($other_perc * $capacity/100);

                        $otherQuery = $this->db->query("select * from stu_reg_online_reg sror,com_al_subject_stream cass 
                            where sror.al_stream=cass.stream_id AND 
                            cass.stream_name = 'Other' AND
                            sror.year = ".$year." AND
                            sror.".$priorityCenterId." = ".$centerId." AND 
                            sror.".$priorityCourseId." = ".$courseId."
                            order by sror.z_score desc limit $otherCount");

                        if (!empty($get_process_details[$x]['types']['students'])) {
                            $get_process_details[$x]['types']['students'] = array_merge($get_process_details[$x]['types']['students'], $otherQuery->result_array());
                        } else {
                            $get_process_details[$x]['types']['students'] = $otherQuery->result_array();
                        }
                    }
                }
            }
        }



        return $get_process_details;
    }

    function set_process_students_select_new($data) {
        $centerId = $data['center_id'];
        $courseId = $data['course_id'];
        $capacity = $data['capacity'];
        $year = $data['date'];
        if($data['process_type'] == 1) {
            if ($data['set_priority_type'] == 1) {
                $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved ='1' and
                                priority1_center = '".$centerId."' and
                                priority1_course = '".$courseId."'
                                order by z_score desc limit $capacity");
                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 2) {
                $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved ='1' and
                                is_selected = '0' and
                                priority2_center = '".$centerId."' and
                                priority2_course = '".$courseId."'
                                order by z_score
                                desc limit '".$capacity."'"
                );
                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 3) {
                $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved ='1' and
                                is_selected = '0' and
                                priority3_center = '".$centerId."' and
                                priority3_course = '".$courseId."'
                                order by z_score
                                desc limit '".$capacity."'"
                );
                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 4) {
                $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved ='1' and
                                is_selected = '0' and
                                priority4_center = '".$centerId."' and
                                priority4_course = '".$courseId."'
                                order by z_score
                                desc limit '".$capacity."'"
                );
                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 5) {
                $query = $this->db->query("select * from stu_reg_online_reg
                                where
                                year='$year'  and
                                is_approved ='1' and
                                is_selected = '0' and
                                priority5_center = '".$centerId."' and
                                priority5_course = '".$courseId."'
                                order by z_score
                                desc limit '".$capacity."'"
                );
                $selected_student_array = $query->result_array();
            }
        }

        if($data['process_type'] == 2) {
            if ($data['set_priority_type'] == 1) {
                $centerId = $data['center_id'];
                $courseId = $data['course_id'];
                $capacity = $data['capacity'];

                $query = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.priority1_center = sxm.center_id and 
                            sror.priority1_course = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.year = '$year'
                            order by sxm.mark desc 
                            limit $capacity"
                );

                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 2) {

                $query = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.priority2_center = sxm.center_id and 
                            sror.priority2_course = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.is_selected = '0' and
                            sror.year = '$year'
                            order by sxm.mark desc 
                            limit $capacity"
                );
                $selected_student_array = $query->result_array();
            }
            if ($data['set_priority_type'] == 3) {
                $query = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.priority3_center = sxm.center_id and 
                            sror.priority3_course = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.is_selected = '0' and
                            sror.year = '$year'
                            order by sxm.mark desc 
                            limit $capacity"
                );
                $selected_student_array = $query->result_array();
            }

            if ($data['set_priority_type'] == 4) {
                $query = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.priority4_center = sxm.center_id and 
                            sror.priority4_course = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.is_selected = '0' and
                            sror.year = '$year'
                            order by sxm.mark desc 
                            limit $capacity"
                );
                $selected_student_array = $query->result_array();
            }

            if ($data['set_priority_type'] == 5) {
                $query = $this->db->query("select * from 
                        stu_reg_online_reg sror , 
                        student_exam_marks sxm 
                        where 
                            sror.id = sxm.student_id and 
                            sror.priority5_center = sxm.center_id and 
                            sror.priority5_course = sxm.course_id and
                            sror.is_approved =1 and 
                            sror.is_selected = '0' and
                            sror.year = '$year'
                            order by sxm.mark desc 
                            limit $capacity"
                );
                $selected_student_array = $query->result_array();
            }
        }
        $students = $selected_student_array;
        foreach ($students as $studentData) {
            $this->db->set('is_selected', 1);
            $this->db->where('id', $studentData['id']);
            $this->db->update('stu_reg_online_reg');
        }
        return $selected_student_array;
    }

    function set_process_students_select($data) {

        if($data['process_type'] == 1) {
            $this->db->select('id,SUBSTRING(z_score,2) as plus_minus');
            
            if($data['set_priority_type'] == 1) {
                $this->db->where('priority1_center', $data['center_id']);
                $this->db->where('priority1_course', $data['course_id']);
            }else if($data['set_priority_type'] == 2){
                $this->db->where('priority2_center', $data['center_id']);
                $this->db->where('priority2_course', $data['course_id']);
            }else if($data['set_priority_type'] == 3){
                $this->db->where('priority3_center', $data['center_id']);
                $this->db->where('priority3_course', $data['course_id']);
            }

            $this->db->where('is_approved', null);
            $this->db->like('z_score', '+', 'after');
            $this->db->order_by('z_score');
            $this->db->limit($data["capacity"]);

            $get_process = $this->db->get('stu_reg_online_reg')->result_array();

            foreach ($get_process as $ssss) {
                $this->db->set('is_approved', 1);
                $this->db->where('SUBSTRING(z_score,2) >', $data['limit']);
                $this->db->where('id', $ssss['id']);
                $this->db->update('stu_reg_online_reg');
            }
        } else if($data['process_type'] == 2) {
            $this->db->select('id, selection_mark');
            
            if($data['set_priority_type'] == 1){
                $this->db->where('priority1_center', $data['center_id']);
                $this->db->where('priority1_course', $data['course_id']);
            }else if($data['set_priority_type'] == 2){
                $this->db->where('priority2_center', $data['center_id']);
                $this->db->where('priority2_course', $data['course_id']);
            }else if($data['set_priority_type'] == 3){
                $this->db->where('priority3_center', $data['center_id']);
                $this->db->where('priority3_course', $data['course_id']);
            }
            $this->db->where('is_approved', null);
            $this->db->order_by('selection_mark');
            $this->db->limit($data["capacity"]);

            $get_process = $this->db->get('stu_reg_online_reg')->result_array();
            
            foreach ($get_process as $ssss) {
                $this->db->set('is_approved', 1);
                $this->db->where('id', $ssss['id']);
                $this->db->where('selection_mark >=', $data['limit']);
                $this->db->update('stu_reg_online_reg');
            }
        } else if($data['process_type'] == 3) {
            $seats_capacity = 5;
            $this->db->select('sapc.perc_stream_id as percentage_stream_id,cass.stream_name, sapc.percentage, sapc.id');

                $this->db->join('stu_admin_online_capacity saoc', 'saoc.center_id = sasp.center_id');
                $this->db->join('stu_admin_selection_course_type sasct', 'sasct.course_id = sasp.course_id');
                $this->db->join('stu_admin_perc_child sapc', 'sapc.perc_id = sasp.id');
                $this->db->join('com_al_subject_stream cass', 'cass.stream_id = sapc.perc_stream_id');

                $this->db->where('sasp.center_id', $data['center_id']);
                $this->db->where('sasct.course_id', $data['course_id']);
                $this->db->where('sasp.date', $data['date']);
                $this->db->where('sasct.selection_type', 3);
                $get_process_details['al_subjects_percentage'] = $this->db->get('stu_admin_selection_percentage sasp')->result_array();
                
                $x = 0;
                foreach($get_process_details['al_subjects_percentage'] as $percentages){
                    $perc = ($seats_capacity/100) * $percentages['percentage'];
                    //echo $perc.'<br>';
                    
                    $get_process_details['final_perc'][$x] = array(
                        'id' => $percentages['id'], 
                        'stream_id' => $percentages['percentage_stream_id'], 
                        'stream_name' => $percentages['stream_name'], 
                        'perc' => $perc
                    );
                    
                    $this->db->select('*');
                    
                    if($data['set_priority_type'] == 1){
                        $this->db->where('priority1_center', $data['center_id']);
                        $this->db->where('priority1_course', $data['course_id']);
                    }else if($data['set_priority_type'] == 2){
                        $this->db->where('priority2_center', $data['center_id']);
                        $this->db->where('priority2_course', $data['course_id']);
                    }else if($data['set_priority_type'] == 3){
                        $this->db->where('priority3_center', $data['center_id']);
                        $this->db->where('priority3_course', $data['course_id']);
                    }
                    
                    $this->db->where('sror.al_stream', $percentages['percentage_stream_id']);
                    $this->db->where('sror.is_approved', null);
                    $this->db->order_by('SUBSTRING(sror.z_score,2)');
                    $this->db->limit($perc);
                    
                    $student = $this->db->get('stu_reg_online_reg sror')->result_array();

                    foreach($student as $student){
                        $this->db->set('is_approved', 1);
                        $this->db->where('id', $student['id']);
                        //$this->db->where('SUBSTRING(z_score,2) >', $data['limit']);
                        $this->db->update('stu_reg_online_reg');
                    }
                    
                    echo '<pre>';
                    print_r($get_process_details['final_perc'][$x]);
                    echo '</pre>';
                    $x++;
                }
            
        }
    }
    
    function get_priority_list(){
        $this->db->select('*');
        $this->db->order_by('priority_name');

        $get_z_score_year = $this->db->get('stu_admin_priority sap')->result_array();


        return $get_z_score_year;
    }
    
    function set_priority($obj){
        foreach($obj as $row){
            $this->db->set('priority_status', $row['priority_status']);
            $this->db->where('id', $row['priority_id']);
            $this->db->update('stu_admin_priority');
        }
    }
    
    function get_priority_type(){
        $this->db->select('*');
        $this->db->where('priority_status', 1);

        $get_priority_type = $this->db->get('stu_admin_priority')->row_array();


        return $get_priority_type;
    }


    /**
     * @param $id
     * @param $data
     */
    function update_stream_percentage($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('stu_admin_selection_percentage', $data);
    }
    
    function save_center() {
        $br_id = $this->input->post('br_id');
        $name = $this->input->post('brname');
        $comcode = $this->input->post('brcode');
        $addl1 = $this->input->post('braddl1');
        $city = $this->input->post('brcity');
        $telephone = $this->input->post('brtelephone');
        $fax = $this->input->post('brfax');

        $br_save['br_name'] = $name;
        $br_save['br_code'] = $comcode;
        $br_save['br_addl1'] = $addl1;
        $br_save['br_city'] = $city;
        $br_save['br_country'] = $country;
        $br_save['br_telephone'] = $telephone;
        $br_save['br_fax'] = $fax;

        if (empty($br_id)) {
            $save = $this->db->insert('cfg_branch', $br_save);
            $this->logger->systemlog('Save New Center', 'Success', 'New Center successfully saved.', date("Y-m-d H:i:s", now()), $br_save);
        } else {
            $this->db->where('br_id', $br_id);
            $save = $this->db->update('cfg_branch', $br_save);
            $this->logger->systemlog('Update Center', 'Success', 'Center successfully Updated.', date("Y-m-d H:i:s", now()), $br_save);
        }

        return $save;
    }
    
    function delete_branch() {
        $br_id = $this->input->post('br_id');
        $this->db->where('br_id', $br_id);
        $this->db->delete('cfg_branch');

    function get_online_registered_students() {
        $this->db->select('*');
        //$this->db->group_by('indexno');
        $online_students = $this->db->get('stu_reg_online_reg')->result_array();

        return $online_students;
    }

        $this->logger->systemlog('deleted Center', 'Success', 'center deleted sucessfully', date("Y-m-d H:i:s", now()), $br_id);
       
        
    }


    /**
     * Select selection type according to year and course
     *
     * @param $data
     * @return mixed
     */
    function get_selection_process_details($data) {
        $this->db->select('*');
        $this->db->where('course_id', $data['course_id']);
        $this->db->where('date', $data['date']);
        $selection_course_type = $this->db->get('stu_admin_selection_course_type')->result_array();
        return $selection_course_type;
    }
}

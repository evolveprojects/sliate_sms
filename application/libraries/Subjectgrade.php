<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subjectgrade
{

    public function __construct()
    {

        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    private function system_grade($mark, $data, $is_rate)
    {

        for ($x = 0; $x < sizeof($data); $x++) {

            $grade_mark = $data[$x]['grade_mark'];
            $criteria = $data[$x]['criteria'];
            $condition = "$grade_mark $criteria $mark";
            //return $condition;

            if (eval("return $condition;")) {
                // alert(data[x]['grade']+'_'+data[x]['grade_rate']);

                if ($is_rate) {
                    return $data[$x]['grade_rate'];
                } else {
                    return $data[$x]['grade'];
                }

            }
        }
        return -1;
    }

    public function overall_grade($grade_method__id, $mark, $is_rate)
    {

        $data = $this->CI->db->query("SELECT gd.grade_mark,gd.grade,gd.grade_rate,gc.criteria FROM mod_grading_details gd JOIN mod_grading_criteria gc on gc.id=gd.grade_group WHERE gd.grading_method_id=2 AND gd.deleted=0 AND gc.status=1")->result_array();

        return $this->system_grade(round($mark), $data, $is_rate);
    }

    public function result_grades($is_attend, $absent_reson_approve, $se_mark, $ca_mark, $tot)
    {

        $data = $this->CI->db->query("SELECT gd.grade_mark,gd.grade,gd.grade_rate,gc.criteria FROM mod_grading_details gd JOIN mod_grading_criteria gc on gc.id=gd.grade_group WHERE gd.grading_method_id=2 AND gd.deleted=0 AND gc.status=1")->result_array();

        if ($ca_mark === '' || $ca_mark === null) { // ca not submitted // ca absent
            if ($is_attend == 1) { //attended
                if ($se_mark === '' || $se_mark === null) {
                } else if (round($se_mark) < 30) {
                    return 'INC';
                } else {
                    return 'I(CA)';
                }
            } else { //absent
                if ($absent_reson_approve == 1) {
                    return 'I(CA)';
                } else {
                    return 'AB';
                }
            }

        } else { // ca is 0 or more than 0
            if ($is_attend == 1) {
                if ($se_mark === '' || $se_mark === null) {

                } else if (round($se_mark) < 30) {
                    return 'I(SE)';
                } else {
                    return $this->system_grade(round($tot), $data, false);
                }
            } else {
                if ($absent_reson_approve == 1) {
                    return 'DFR';
                } else {
                    return 'AB';
                }
            }
        }
    }

}

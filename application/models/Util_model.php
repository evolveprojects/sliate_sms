<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model
{

    var $CI = NULL;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    function check_rights($sub_module)
    {

        $sessi_ug = $this->CI->session->userdata('u_ugroup');
        $sessi_uid = $this->CI->session->userdata('u_id');
        $this->db->select('u.user_id,u.user_name,u.user_ugroup,f.func_name,f.func_module,f.func_submodule,f.func_uitype,f.func_type,f.func_ui_name, r.rgt_status,r.rgt_id');
        $this->db->join('ath_usergroup ug', 'ug.ug_id = u.user_ugroup');
        $this->db->join('ath_authrightgroup rg', 'rg.rlist_usergroup = ug.ug_id');
        $this->db->join('ath_authright r', 'rg.rlist_id = r.rgt_rightgroup');
        $this->db->join('ath_authfunction f', 'r.rgt_refid = f.func_id');
        $this->db->where('u.user_ugroup', $sessi_ug);
        $this->db->where('u.user_id', $sessi_uid);
        $this->db->where('ug.ug_status', 'A');
        $this->db->where('f.func_submodule', $sub_module);
        $result_array = $this->db->get('Ath_user u')->result_array();
        return $result_array;

    }

    function check_access_level()
    {
        $sessi_uid = $this->CI->session->userdata('u_id');
        $this->db->select('u.user_id, u.user_name,u.user_ugroup,ug.ug_level, ug.ug_status,ug.ug_branch,cb.br_name,cb.br_code,ug.ug_course');
        $this->db->join('ath_usergroup ug', 'ug.ug_id = u.user_ugroup');
        $this->db->join('cfg_branch cb', 'cb.br_id = ug.ug_branch');
        $this->db->where('u.user_id', $sessi_uid);
        $this->db->where('ug.ug_status', 'A');
        $result_array = $this->db->get('ath_user u')->result_array();
        return $result_array;
    }


    function check_function_rights($function_name)
    {

        $sessi_ug = $this->CI->session->userdata('u_ugroup');
        //$sessi_uid = $this->CI->session->userdata('u_id');
        if ($sessi_ug != 1) {
            $this->db->select('*');
            $this->db->join('ath_authright ', 'ath_authfunction.func_id=ath_authright.rgt_refid');
            $this->db->join('ath_authrightgroup ', 'ath_authrightgroup.rlist_id= ath_authright.rgt_rightgroup');
            $this->db->join('ath_usergroup ', 'ath_usergroup.ug_id= ath_authright.rgt_rightgroup');

            $this->db->where('ath_authrightgroup.rlist_usergroup', $sessi_ug);
            $this->db->where('ath_authfunction.func_name', $function_name);
            $this->db->where('ath_usergroup.ug_status', 'A');
            $result_array = $this->db->get('ath_authfunction ')->result_array();
            return $result_array;
        } else {
            return $result_array = array(array('func_status' => 'A'));
        }

    }

}

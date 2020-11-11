<?php 

class Master_model extends CI_model {

    protected $table = '';

    function __construct() {
        parent::__construct();
    }

    function save_course($id, $data) 
    {
        if (empty($id)) 
        {
            $rows = $this->db->get_where('edu_course', array('course_code' => $data['course_code']))->result();

            if(count($rows) > 0)
            {
                $response['msg'] = 'This course already exists';
            } else 
            {
                $result = $this->db->insert('edu_course', $data);
                $response['msg'] = 'Insert Successfull!';
            }
            //$this->logger->systemlog('Manage Course Programs', 'Success', 'Created Course Successfully.', date("Y-m-d H:i:s", now()));
        } else 
        {
            $this->db->where('id', $id);
            $result = $this->db->update('edu_course', $data);
            //$this->logger->systemlog('Manage Course Programs', 'Success', 'Updated Course Successfully.', date("Y-m-d H:i:s", now()));
            $response['msg'] = 'Course Updated!';
        }
        return $response;
    }


    function get_all_courses() 
    {
        $this->db->where('deleted', 0);
        $this->db->select('de.*, de.deleted as course_deleted, de.id as course_id ');
        $result_array = $this->db->get('edu_course de')->result_array();
        return $result_array;
    }


    function save_cc($data, $cc_id)
    {
        if($cc_id =='')
        {
            $row = $this->db->get_where('edu_center_course', array('center_id' => $data['center_id'], 'course_id' => $data['course_id']))->result_array();

            if(count($row) > 0) 
            {
                $response['msg'] = 'This combination already exists';
            } else 
            {
                $result = $this->db->insert('edu_center_course', $data);
                $response['msg'] = 'Successfull';
            }
        } else 
        {
            $this->db->where('id', $cc_id);
            $result = $this->db->update('edu_center_course', $data);
            //$this->logger->systemlog('Manage Course Programs', 'Success', 'Updated Course Successfully.', date("Y-m-d H:i:s", now()));
            $response['msg'] = 'Data Updated!';
        }

        return $response;
    }

    function change_cc_status($cc_id) 
    {
        // $data = array('deleted' => 1);
        $this->db->set('deleted', '1', false);
        $this->db->where('id', $cc_id);
        $this->db->update('edu_center_course');
        //$this->logger->systemlog('Manage Course Programs', 'Success', 'Updated Course Successfully.', date("Y-m-d H:i:s", now()));
        //$response['msg'] = 'Data Deleted!';
    }

    //get all courses assigned to each center
    // function get_each_center_course() 
    // {
    //     $branchlist = $this->auth->get_accessbranch();
    //     //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

    //     $this->db->select('cd.*,de.*,br.*,ba.*,dy.*,ds.deleted as c_d_s_deleted, dy.id as center_year_id');
    //     $this->db->join('edu_center_course cd', 'cd.id=dy.center_course_id');
    //     $this->db->join('edu_course de', 'de.id=cd.course_id');
    //     $this->db->join('cfg_branch br', 'br.br_id=cd.center_id');
    //     $this->db->where_in('cd.center_id', $branchlist);
    //     $result_array = $this->db->get('edu_center_course_year dy')->result_array();
    //     return array_unique($result_array, SORT_REGULAR);
    // }
}

?>
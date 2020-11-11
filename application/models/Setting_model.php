<?php 
class Setting_model extends CI_model 
{
    //table
    protected $table = 'ath_user';

    function __construct() 
    {
        parent::__construct();
    }


    function get_users()
    {
        $this->db->select('*');
        $this->db->from('ath_user');
        $this->db->where('user_type', null);
        $this->db->or_where('user_type', 'super_user');
        $this->db->or_where('user_type', 'center_user');
        $this->db->or_where('user_type', 'examiner');
        $this->db->join('cfg_branch', 'cfg_branch.br_id = ath_user.user_branch');
        //$this->db->limit('500', '78');
        $records = $this->db->get()->result_array();
        return $records;
    }


    function store_user($data, $u_id)
    {
        $userValidator = $this->validateUser($data, $u_id);

        try 
        { 
            if($u_id) 
            {
                    $this->db->where('user_id', $u_id);
                    $this->db->update('ath_user', $data);
                    $response = 'Data update successful!';
            } else 
            {
                if($userValidator['isValid'])
                    {
                        $this->db->insert('ath_user',$data);
                        $response = $userValidator['msg'];
                        
                    } else  
                    {
                        $response = $userValidator['msg'];
                    }
                }
        } catch (Exception $e) 
        {
            log_message('error',$e->getMessage());
            return;
        }
        return $response;
    }


    public function validateUser($data, $u_id) 
    {
        $isemailExist = $query = $this->db->get_where('ath_user', array('user_email' => $data['user_email']))->result_array();
        $isnameExist = $query = $this->db->get_where('ath_user', array('user_name' => $data['user_name']))->result_array();
        
        if(count($isemailExist) > 0) 
            {
                $response = ['isValid' => 0, 'msg' => 'User with this Email already exists!'];
            } else
            {
                if(count($isnameExist) > 0)
                {
                    $response = ['isValid' => 0, 'msg' => 'User with this Name already exists!'];
                } else  
                {
                    $response = ['isValid' => 1, 'msg' => 'Data insert successful!'];
                }
            }
        return $response;
    }

}

?>
<?php 
class Forgot_Password_model extends CI_Model {
    
    function check_username_and_mail($username, $email)
    {
	$this->db->select('*,cfg_branch.br_name');
	$this->db->join('ath_usergroup','ath_usergroup.ug_id=ath_user.user_ugroup');
        $this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch');
	$this->db->where("ath_user.user_name",$username);
//        if($email != ''){
//            $this->db->where("ath_user.user_email",$email);
//        } 
	$this->db->where("ath_user.user_status",'A');

	$result = $this->db->get("ath_user")->row_array();

        if(empty($result)){
            return 'invalid_data';
        } else if(!empty($email)){
            if($result['user_email'] == '' || $result['user_email'] == null){
               return 'no_reg_email'; 
            } else if($result['user_email'] == $email){
                 return $result;
            } else {
                return 'invalid_email'; 
            }
                
        } else {
            return $result;
        }
	
    }
    
    function get_admin_details (){
        $this->db->select('*');
        $this->db->where("ath_user.user_name","Admin");
        $this->db->where("ath_user.user_ugroup",1);
        $this->db->where("ath_user.user_status",'A');
        $result = $this->db->get("ath_user")->row_array();
        return $result;
    }
}

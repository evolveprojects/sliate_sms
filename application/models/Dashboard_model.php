<?php
class Dashboard_model extends CI_Model {
    
	function get_login() {
		
		$ip = $this->input->ip_address();
		$usr_ip = $this->input->ip_address('ip');		

                $this->db->select('login_id');
		$this->db->from('ath_userlogininfo');
		$this->db->where('u_id',$this->session->userdata('u_id'));
		//$this->db->where('login_id <','(select_max login_id from ath_userlogininfo)');
		$this->db->order_by('login_id','desc');
		$this->db->limit('1','1');
		$res = $this->db->get()->row_array();
		
		if($res != null){
			$this->db->select('*');
			$this->db->from('ath_userlogininfo');
			$this->db->where('login_id',$res['login_id']);
			$this->db->where('u_id',$this->session->userdata('u_id'));
			$login = $this->db->get()->row_array();	
		}
                else
                {
                    $this->db->select('*');
                    $this->db->from('ath_userlogininfo');
                    $this->db->where('u_id',$this->session->userdata('u_id'));
                    $login = $this->db->get()->row_array();	
                }
		return $login;
	
    }

	
 	function last_login($data) {
		
//        $this->db->select('*');
//		$this->db->from('ath_userlogininfo');
//		$this->db->group_by('u_id,last_login_ip');
//		$query = $this->db->get()->result_array();
//		
//		foreach($query as $qr){
//			$this->db->where('u_id',$data['u_id']);
//			$this->db->where('last_login_ip',$data['last_login_ip']);
//			$this->db->from('ath_userlogininfo');
//			$usrdata = $this->db->get()->result_array();
//		}
		
//			$this->db->where('u_id',$data['u_id']);
//			$this->db->where('last_login_ip',$data['last_login_ip']);
			$resultdata = $this->db->insert('ath_userlogininfo',$data);

		return $resultdata;
    }	 

}
?>
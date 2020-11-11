<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 this class is used to check user privilages
*/
class logger
{

	var $CI = NULL;
	
	public function __construct()
	{
		$this->CI =& get_instance(); 
		$this->CI->load->database();
	}

	public function systemlog($action,$status,$description,$date,$data)
	{
		if($date==NULL)
		{
			$date = date("Y-m-d H:i:s", now());
		}

		$logsave['log_code'] 		= $this->CI->sequence->generate_sequence('LOG',5);
		$logsave['log_action'] 		= $action;
		$logsave['log_status'] 		= $status;
		$logsave['log_description']     = $description;
                $logsave['log_data']            = json_encode($data);
		$logsave['log_timestamp'] 	= $date;
		$logsave['log_user'] 		= $this->CI->session->userdata('u_id');

		$this->CI->db->insert('oth_logger',$logsave);
		return true;
	}
}	

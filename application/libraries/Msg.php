<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msg {
	public $messages=array();
	public $messages_store=array();
	public function set($type,$msg){
		$CI =& get_instance();
		$this->messages[$type][]=$msg;
		$json=json_encode($this->messages[$type]);
		$this->messages_store[$type]=$json;
		//$CI->session->set_flashdata(array($type=>$json));

	}

	public function show($type=""){
		//$CI =& get_instance();
		//$msg_array=json_decode($CI->session->flashdata($type),true);
		if(isset($this->messages_store[$type])){
			$msg_array=json_decode($this->messages_store[$type],true);	
			if(count($msg_array)>0){
				foreach($msg_array as $m=>$code):
					$this->genarate_html($code);      
				endforeach;		 
			 }
		}
		if(isset($this->messages_store['global'])){
			$msg_array=json_decode($this->messages_store['global'],true);	
			if(count($msg_array)>0){
				foreach($msg_array as $m=>$code):
					$this->genarate_html($code);      
				endforeach;		 
			 }
		}
	}
	public function show_json($type=""){
		$echo="";
		if(isset($this->messages_store[$type])){
				$msg_array=json_decode($this->messages_store[$type],true);	
			if(count($msg_array)>0){
				foreach($msg_array as $m=>$code):
					$echo.= url_title($code);     
				endforeach;	
				return $echo;	 
			 }
		//return $this->messages_store[$type];
		}
	}
	/* 
	string status_code 
	prefix : danger / info /warning / success  ETC 
	ex : danger_lagugeKeyORstringMsg 	
	*/
	function genarate_html($status_code =null)
		{
		
		
		$CI=& get_instance();
		$CI->load->helper('smiley');
		if ($status_code != null)
			{
			$status = explode('_', $status_code);
			$error = $status[1];
			$status = $status[0];
			$echo= '<div class="alert alert-' . $status . ' fade in">';
			$echo.=  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> × </button>';
			if ($CI->lang->line($status_code))
				{
				$echo.=  $CI->lang->line($status_code);
				}
			  else
				{
					$error = parse_smileys($error, base_url("assets/smiles/"));
				$echo.=  $error;
				}
			$echo.=  '</div>';
			}
			echo $echo;
		}
		
	}


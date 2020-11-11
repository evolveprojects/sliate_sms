<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 this class is used to check user privilages
*/
ob_start();

class auth
{

	var $CI = NULL;
	
	public function __construct()
	{
		$this->CI =& get_instance(); 
		$this->CI->load->database();
	}

	public function register_function()
	{
		/*URI Segment Capture*/
		$cur_url = $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?'/'.$this->CI->uri->rsegments[2]:'');

		$this->CI->db->where('func_url',$cur_url);
		$row = $this->CI->db->get('ath_authfunction')->row_array();
	
		if(empty($row))
		{
			$funcdata['func_name'] 		= $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?' :: '.$this->CI->uri->rsegments[2]:'');
			$funcdata['func_url'] 		= $cur_url;
			$funcdata['func_status'] 	= 'A';
			$funcdata['func_isedit']	= 1;
			$funcdata['func_developer'] = DEVELOPER;
 
			$this->CI->db->insert('ath_authfunction',$funcdata);
			$func_id = $this->CI->db->insert_id();

			// $rightdata['rgt_usergroup']	= 1;
			// $rightdata['rgt_user'] 		= 1;
			// $rightdata['rgt_type'] 		= 'function';
			// $rightdata['rgt_refid'] 	= $func_id;
			// $rightdata['rgt_status'] 	= 'A';
			// $rightdata['rgt_is']

			// $this->CI->db->insert('ath_authright',$rightdata);

			redirect('authmanage/register_function/' . $func_id);

		}
		return true;
	}
	
	public function check_rights()
	{
		$cur_url = $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?'/'.$this->CI->uri->rsegments[2]:'');

		$this->CI->db->where('func_url',$cur_url);
		$func = $this->CI->db->get('ath_authfunction')->row_array();

		if($func['func_isedit']==1)
		{
			$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
			$authgroup = $this->CI->db->get('ath_usergroup')->row_array();

			if($authgroup['ug_level']>=2)
			{
				// $this->CI->db->select('*');
				// $this->CI->db->where('rgt_refid',$func['func_id']);
				// $this->CI->db->where('rgt_type','function');
				// $this->CI->db->where('rgt_usergroup',$this->CI->session->userdata('u_ugroup'));
				// $this->CI->db->where('rgt_status','A');

				// $right = $this->CI->db->get('ath_authright')->result_array();

				// if(empty($right))
				// {
				// 	return false;
				// }
				// else
				// {
				// 	return true;
				// }
				$this->CI->db->where('rlist_usergroup',$this->CI->session->userdata('u_ugroup'));
				$rightgrpexist = $this->CI->db->get('ath_authrightgroup')->result_array();

				if(count($rightgrpexist)>0)
				{
					$rightgroups = array_column($rightgrpexist, 'rlist_id');                                        

					$this->CI->db->select('*');
					$this->CI->db->where_in('rgt_rightgroup',$rightgroups);
					//$this->CI->db->where('rgt_refid',$func['func_id']);
					$this->CI->db->where('rgt_type','function');
					$this->CI->db->where('rgt_status','A');
					$right = $this->CI->db->get('ath_authright')->result_array();
                                        
                                        //var_dump($right);die();

					if(!empty($right))
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}

	public function get_accessbranch()
	{
            if(!empty($this->CI->uri->rsegments[3]))
		$cur_url = $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?'/'.$this->CI->uri->rsegments[2]:'').($this->CI->uri->rsegments[3]!='index'?'/'.$this->CI->uri->rsegments[3]:'');
            else
                $cur_url = $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?'/'.$this->CI->uri->rsegments[2]:'');
            
		$prev_brs = array();
		$this->CI->db->where('func_url',$cur_url);
                $this->CI->db->where('func_status','A');
		$func = $this->CI->db->get('ath_authfunction')->row_array();

		$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
		$authgroup = $this->CI->db->get('ath_usergroup')->row_array();
                
		if($func['func_isedit']==1)
		{
			if($authgroup['ug_level']>=2)
			{
				$this->CI->db->select('ath_authrightgroup.*');
				$this->CI->db->join('ath_authrightgroup','ath_authrightgroup.rlist_id=ath_authright.rgt_rightgroup');
				$this->CI->db->where('ath_authright.rgt_refid',$func['func_id']);
				$this->CI->db->where('ath_authright.rgt_type','function');
				$this->CI->db->where('ath_authrightgroup.rlist_usergroup',$this->CI->session->userdata('u_ugroup'));
				$this->CI->db->where('ath_authright.rgt_status','A');
				$temprights = $this->CI->db->get('ath_authright')->row_array();

				if(!empty($temprights))
				{
					$this->CI->db->where('arbl_listid',$temprights['rlist_branchlist']);
					$authbranch = $this->CI->db->get('ath_authbranchlist')->result_array();

					$prev_brs = array_column($authbranch, 'arbl_branch');
				}
			}
                        else if($authgroup['ug_level']==2)
                        {
//                            $this->CI->db->where('arbl_listid',$temprights['rlist_branchlist']);
//                            $authbranch = $this->CI->db->get('ath_authbranchlist')->result_array();
                            
                            $br= $this->CI->session->userdata('user_branch');
                            
                            $authbranch = array(array('br_id'=>$br));
                            $prev_brs = array_column($authbranch, 'br_id');
                            
                        }
			else
			{
				$authbranch = $this->CI->db->get('cfg_branch')->result_array();

				$prev_brs = array_column($authbranch, 'br_id');
			}
		}

		if(empty($prev_brs))
		{
			$prev_brs[0] = null;
		}
		return $prev_brs;
	}

	public function get_accessfaculties()
	{
		$cur_url = $this->CI->uri->rsegments[1].($this->CI->uri->rsegments[2]!='index'?'/'.$this->CI->uri->rsegments[2]:'');

		$this->CI->db->where('func_url',$cur_url);
		$func = $this->CI->db->get('ath_authfunction')->row_array();

		$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
		$authgroup = $this->CI->db->get('ath_usergroup')->row_array();

		if($func['func_isedit']==1)
		{
			if($authgroup['ug_level']>=2)
			{
				$this->CI->db->select('ath_authrightgroup.*');
				$this->CI->db->join('ath_authrightgroup','ath_authrightgroup.rlist_id=ath_authright.rgt_rightgroup');
				$this->CI->db->where('ath_authright.rgt_refid',$func['func_id']);
				$this->CI->db->where('ath_authright.rgt_type','function');
				$this->CI->db->where('ath_authrightgroup.rlist_usergroup',$this->CI->session->userdata('u_ugroup'));
				$this->CI->db->where('ath_authright.rgt_status','A');
				$temprights = $this->CI->db->get('ath_authright')->row_array();

				if(!empty($temprights))
				{
					$this->CI->db->where('arfl_listid',$temprights['rlist_facultylist']);
					$authfacstemp = $this->CI->db->get('ath_authfacultylist')->result_array();

					$authfacs = array_column($authfacstemp, 'arfl_faculty');
				}
				else
				{
					$authfacs = array();
				}
			}
			else
			{
				$authfacstemp = $this->CI->db->get('edu_faculty')->result_array();

				$authfacs = array_column($authfacstemp, 'id');
			}
		}
		else
		{
			$authfacs = array();
		}

		// if(($type=='ID_ARY') && (!empty($authfacs)))
		// {
		// 	$id_ary = array();

		// 	foreach ($authfacs as $fac) 
		// 	{
		// 		array_push($id_ary, $fac['id']);
		// 	}

		// 	return $id_ary;
		// }
		// else
		// {
			return $authfacs;
		// }
	}

	public function check_navright()
	{
		$this->CI->db->distinct('func_module');
		$this->CI->db->select('func_module');
		$this->CI->db->where('func_status','A');
		$this->CI->db->where('func_isedit',1);
		$modules = $this->CI->db->get('ath_authfunction')->result_array();

		$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
		$authgroup = $this->CI->db->get('ath_usergroup')->row_array();

		$x = 0;
		foreach ($modules as $mod) 
		{
			$this->CI->db->distinct('func_submodule');
			$this->CI->db->select('func_submodule');
			$this->CI->db->where('func_status','A');
			$this->CI->db->where('func_isedit',1);
			$this->CI->db->where('func_module',$mod['func_module']);
			$this->CI->db->where('func_type','Page Open');
			$submods = $this->CI->db->get('ath_authfunction')->result_array();

			$subslist = array();

			foreach ($submods as $sub) 
			{	
				if($authgroup['ug_level']>=2)
				{	
					$this->CI->db->where('rlist_usergroup',$this->CI->session->userdata('u_ugroup'));
					$rightgrpexist = $this->CI->db->get('ath_authrightgroup')->result_array();

					if(count($rightgrpexist)>0)
					{
						$rightgroups = array_column($rightgrpexist, 'rlist_id');

						$this->CI->db->select('*');
						$this->CI->db->join('ath_authfunction','ath_authfunction.func_id=ath_authright.rgt_refid');
						$this->CI->db->where_in('rgt_rightgroup',$rightgroups);
						$this->CI->db->where('ath_authfunction.func_submodule',$sub['func_submodule']);
						$this->CI->db->where('rgt_type','function');
						$this->CI->db->where('rgt_status','A');
						$right = $this->CI->db->get('ath_authright')->result_array();

						if(!empty($right))
						{
							array_push($subslist, $sub['func_submodule']);
						}
					}
				}
				else
				{
					array_push($subslist, $sub['func_submodule']);
				}
			}

			$modules[$x]['subslist'] = $subslist;
			$x++;
		}

		return $modules;
	}

	public function check_tab_access($type)
	{
		$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
		$authgroup = $this->CI->db->get('ath_usergroup')->row_array();

		if($type=="Group" || $type=="Company" || $type=="Fyear")
		{
			if($authgroup['ug_level']==1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else if($type=="Branch" || $type=="Other" || $type=="Range" || $type=="Version" || $type=="News" || $type=="Events" || $type=="Signature Authority")
		{
			if($authgroup['ug_level']==1 || $authgroup['ug_level']==2)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else if($type=="Hall")
		{
			return true;
		}

		// $this->CI->db->where('func_status','A');
		// $this->CI->db->where('func_isedit',1);
		// if($type=="Group")
		// {
		// 	$this->CI->db->where('func_module','Configurations');
		// 	$this->CI->db->where('func_submodule','Group');
		// 	$this->CI->db->where('func_uitype !=','Full Page');
		// }
		// $functions = $this->CI->db->get('ath_authfunction')->result_array();

		// if(!empty($functions))
		// {
		// 	$hasright = false;

		// 	foreach ($functions as $value) 
		// 	{
		// 		if($authgroup['ug_level']>3)
		// 		{
		// 			$this->CI->db->where('rgt_usergroup',$this->CI->session->userdata('u_ugroup'));
		// 		}
		// 		$this->CI->db->where('rgt_type','function');
		// 		$right = $this->CI->db->get('ath_authright')->result_array();

		// 		if(!empty($right))
		// 		{
		// 			$hasright = true;
		// 		}
		// 	}

		// 	return $hasright;
		// }
		// else
		// {
		// 	return false;
		// }
	}

	public function get_ugroup_options()
	{
		$this->CI->db->where('ug_id',$this->CI->session->userdata('u_ugroup'));
		$authgroup = $this->CI->db->get('ath_usergroup')->row_array();

		// if($authgroup['ug_level']==1)
		// {
		// 	$ops = "<option value='1'>1</option>".
  //                  "<option value='2'>2</option>".
  //                  "<option value='3'>3</option>".
  //                  "<option value='4'>4</option>".
  //                  "<option value='5'>5</option>".
  //                  "<option value='6'>6</option>";
  //           $comp = 'all';
		// }
		// else if($authgroup['ug_level']==2)
		// {
		// 	$ops = "<option value='3'>3</option>".
		// 		   "<option value='4'>4</option>".
  //                  "<option value='5'>5</option>".
  //                  "<option value='6'>6</option>";
  //           $comp = $this->CI->session->userdata('u_group');
		// }
		// else if($authgroup['ug_level']==3)
		// {
		// 	$ops = "<option value='4'>4</option>".
  //                  "<option value='5'>5</option>".
		// 		   "<option value='6'>6</option>";
		// 	$comp = $this->CI->session->userdata('u_group');
		// }
		// else
		// {
		// 	$ops = "";
		// 	$comp = $this->CI->session->userdata('u_group');
		// }
		$ops = "<option value='1'>1 - All Centers / All Functions </option>".
               "<!--<option value='2'>2 - All Centers / Selected Functions</option>-->".
               "<option value='2'>2 - Selected Centers / All Functions/ All Features</option>".
                "<option value='3'>3 - Selected Centers / Selected Functions / All Features</option>".
               "<option value='4'>4 - Selected Centers / Selected Functions / Selected Features</option>".
                "<option value='5'>5 - Selected Centers / Selected Functions / Single User</option>";

        $comp = $this->CI->session->userdata('u_group');

		$all = array(
			"ops" => $ops,
			"comp" => $comp
			);
		return $all;
	}
	
	public function get_brcode($brid)
	{
		$this->CI->db->where('br_id',$brid);
		$brnachdetail = $this->CI->db->get('cfg_branch')->row_array();

		return $brnachdetail['br_code'];
	}

       
}	

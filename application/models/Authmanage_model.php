<?php
class Authmanage_model extends CI_model {

function get_function_info()
{
	$this->db->select('*');
	$this->db->where('func_id',$this->input->post('id'));
	$funcinfo = $this->db->get('ath_authfunction')->row_array();

	return $funcinfo;
}

function update_function_details()
{
	$func_id 	 = $this->input->post('func_id');
	$funcmodule  = $this->input->post('funcmodule');
	$submodule 	 = $this->input->post('submodule');
	$description = $this->input->post('description');
	$func_type   = $this->input->post('func_type');
	$ui_type 	 = $this->input->post('ui_type');

	$this->db->where('func_module',$funcmodule);
	$mcount = $this->db->count_all_results('ath_authfunction');

	$updatefunc['func_module']   	= $funcmodule;
	$updatefunc['func_submodule'] 	= $submodule;
	$updatefunc['func_description'] = $description;
	$updatefunc['func_type'] 		= $func_type;
	$updatefunc['func_uitype'] 		= $ui_type;
	$updatefunc['func_status'] 		= 'A';

	if(isset($_POST['editable']))
	{
		$updatefunc['func_isedit'] = 1;
	}
	else
	{
		$updatefunc['func_isedit'] = 0;
	}

	$this->db->where('func_id',$func_id);
	$this->db->update('ath_authfunction',$updatefunc);
}

function load_submodule()
{
	$this->db->distinct('func_submodule');
	$this->db->select('func_submodule');
	$this->db->where('func_isedit',1);
	$this->db->like('func_module',$this->input->post('mainmod'));
	$submods = $this->db->get('ath_authfunction')->result_array();

	return $submods;
}

function get_pre_data()
{
	$this->db->distinct('func_module');
	$this->db->select('func_module');
	$this->db->where('func_isedit',1);
	$modules = $this->db->get('ath_authfunction')->result_array();

	$functions = $this->db->get('ath_authfunction')->result_array();

	$all['modules'] = $modules;
	$all['functions'] = $functions;

	return $all;
}

function search_right()
{
	$group  = $this->input->post('group');
	$module = $this->input->post('module');
	$branchary = $this->input->post('branchary');
	//$facultsary = $this->input->post('facultsary');     

	$branchgrp = $this->get_branch_group($branchary,'search');
	//$facultgrp = $this->get_facult_group($facultsary,'search');

	$this->db->distinct('func_module');
	$this->db->select('func_module');
	//$this->db->select('IF(func_module IS NULL or func_module = \'\', \'Buttons\', func_module) as func_module');
	$this->db->where('func_isedit',1);
	$this->db->where('func_status','A');
	if($module!='all')
	{
		$this->db->where('func_module',$module);
	}
	$modules = $this->db->get('ath_authfunction')->result_array();

	$y = 0;
	foreach ($modules as $mod) 
	{
		$this->db->select('*');
		$this->db->where('func_status','A');
		$this->db->where('func_isedit',1);
		$this->db->where('func_module',$mod['func_module']);
		//$this->db->where('func_module',$mod['func_module']=='Buttons' ? '':$mod['func_module']);
		$this->db->order_by('func_submodule');
       // $this->db->limit(50);
		$functions = $this->db->get('ath_authfunction')->result_array();

		$x = 0;
		foreach ($functions as $func) 
		{
			if(($branchgrp!=0)) // && ($facultgrp!=0)
			{
				$this->db->where('rlist_usergroup',$group);
				$this->db->where('rlist_branchlist',$branchgrp);
				//$this->db->where('rlist_facultylist',$facultgrp);
				$rightgrpexist = $this->db->get('ath_authrightgroup')->row_array();

				if(empty($rightgrpexist))
				{
					$functions[$x]['rgt_hasrgt']= 'D';
				}
				else
				{
					$this->db->select('*');
					$this->db->where('rgt_refid',$func['func_id']);
					$this->db->where('rgt_type','function');
					$this->db->where('rgt_rightgroup',$rightgrpexist['rlist_id']);
					$this->db->where('rgt_status','A');
					$right = $this->db->get('ath_authright')->row_array();

					if(!empty($right))
					{
						$functions[$x]['rgt_hasrgt']= 'A';
					}
					else
					{
						$functions[$x]['rgt_hasrgt']= 'D';
					}
				}
			}
			else
			{
				$functions[$x]['rgt_hasrgt']= 'D';
			}
			
			$x++;
		}


		$modules[$y]['functions'] = $functions;
		$y++; 
	}
	
	return $modules;
}


function set_rights()
{
	$module = $this->input->post('module');
	$group  = $this->input->post('group');
	$funcs  = $this->input->post('ar_check');
	$branch = $this->input->post('branch');

	$this->db->trans_begin();
        
        $this->db->select('rlist_branchlist, rlist_id');
        $this->db->where('rlist_usergroup',$group);
        $brlist_id = $this->db->get('ath_authrightgroup')->result_array();
        
        if($brlist_id != null)
        {
            foreach ($brlist_id as $brlid){
                $this->db->where('rgt_rightgroup',$brlid['rlist_id']);
                $func_result = $this->db->delete('ath_authright');
            }

            $this->db->where('rlist_usergroup',$group);
            $func_result2 = $this->db->delete('ath_authrightgroup');
        }

	$branchgrp = $this->get_branch_group($branch,'save');
	//$facultgrp = $this->get_facult_group($facults,'save');

	$this->db->where('rlist_usergroup',$group);
	$this->db->where('rlist_branchlist',$branchgrp);
	//$this->db->where('rlist_facultylist',$facultgrp);
	$rightgrpexist = $this->db->get('ath_authrightgroup')->row_array();

	$rightgrpsave['rlist_status']		= 'A';

	if(empty($rightgrpexist))
	{
		$rightgrpsave['rlist_usergroup']	= $group;	
		$rightgrpsave['rlist_branchlist']	= $branchgrp;	
		//$rightgrpsave['rlist_facultylist']	= $facultgrp;	
		$rightgrpsave['rlist_createdby']	= $this->session->userdata('u_id');;	
		$rightgrpsave['rlist_createdon']	= date("Y-m-d H:i:s", now());
                $rightgrpsave['rlist_module']	= $module;
		
		$this->db->insert('ath_authrightgroup',$rightgrpsave);

		$rgtid = $this->db->insert_id();	
	}
	else
	{
		$rightgrpsave['rlist_updatedby']	= $this->session->userdata('u_id');;	
		$this->db->where('rlist_id',$rightgrpexist['rlist_id']);
		$this->db->update('ath_authrightgroup',$rightgrpsave);

		$rgtid = $rightgrpexist['rlist_id'];
	}

	if($module=='all')
	{
		$this->db->where('rgt_rightgroup',$rgtid);
		$this->db->where('rgt_type','function');
		$this->db->update('ath_authright',array('rgt_status'=>'D'));
	}
	else
	{
		$this->db->where('func_module',$module);	
		$functions = $this->db->get('ath_authfunction')->result_array();

		foreach ($functions as $fun) 
		{
			$this->db->where('rgt_type','function');
			$this->db->where('rgt_refid',$fun['func_id']);
			$this->db->where('rgt_rightgroup',$rgtid);
			$this->db->update('ath_authright',array('rgt_status'=>'D'));
		}
	}

	foreach ($funcs as $func) 
	{
		$this->db->where('rgt_type','function');
		$this->db->where('rgt_refid',$func);
		$this->db->where('rgt_rightgroup',$rgtid);
		$rgtexist = $this->db->get('ath_authright')->row_array();

		$savergt['rgt_status'] = 'A';

		if(empty($rgtexist))
		{
			$savergt['rgt_rightgroup'] = $rgtid;
			$savergt['rgt_type'] = 'function';
			$savergt['rgt_refid'] = $func;

			$this->db->insert('ath_authright',$savergt);
		}
		else
		{
			$this->db->where('rgt_id',$rgtexist['rgt_id']);
			$this->db->update('ath_authright',$savergt);
		}
	}

	if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        $this->session->set_flashdata('flashError', 'Failed to Register Function. Retry.');
        $this->logger->systemlog('Set Access Rights', 'Failure', 'Failed to Set Access Rights.', date("Y-m-d H:i:s", now()),$rightgrpsave);
        return false;
    }
    else
    {
        $this->db->trans_commit();
        $this->session->set_flashdata('flashSuccess', 'Function Registered successfully.');
        $this->logger->systemlog('Set Access Rights', 'Success', 'Set Access Rights Successfully.', date("Y-m-d H:i:s", now()),$rightgrpsave);
        return true;    
    }
}

function get_branch_group($branch,$type)
{
	$this->db->select('arbl_listid, COUNT(arbl_branch) as brcount');
	$this->db->group_by('arbl_listid'); 
	$this->db->order_by('arbl_listid', 'desc'); 
	$brgrps = $this->db->get('ath_authbranchlist')->result_array();

	$brgrp = 0;
	foreach ($brgrps as $grp) 
	{
		if(count($branch)==$grp['brcount'])
		{
			$this->db->where('arbl_listid',$grp['arbl_listid']);
			$this->db->where_in('arbl_branch',$branch);
			$allbr = $this->db->get('ath_authbranchlist')->result_array();

			if(count($allbr) == count($branch))
			{
				$brgrp = $grp['arbl_listid'];
			}
		}
	}

	if($type=='save')
	{
		if($brgrp==0)
		{
			if(empty($brgrps))
			{
				$brgrp = 1;
			}
			else
			{
				$brgrp = $brgrps[0]['arbl_listid']+1;
			}
			
			foreach ($branch as $br) 
			{
				$brgrpsave['arbl_listid'] = $brgrp;
				$brgrpsave['arbl_branch'] = $br;
				$this->db->insert('ath_authbranchlist', $brgrpsave);
			}
		}
	}

	return $brgrp;
}

function get_facult_group($facults,$type)
{
	$this->db->select('arfl_listid, COUNT(arfl_faculty) as faccount');
	$this->db->group_by('arfl_listid'); 
	$this->db->order_by('arfl_listid', 'desc'); 
	$facgrps = $this->db->get('ath_authfacultylist')->result_array();

	$facgrp = 0;
	foreach ($facgrps as $grp) 
	{
		if(count($facults)==$grp['faccount'])
		{
			$this->db->where('arfl_listid',$grp['arfl_listid']);
			$this->db->where_in('arfl_faculty',$facults);
			$allbr = $this->db->get('ath_authfacultylist')->result_array();

			if(count($allbr) == count($facults))
			{
				$facgrp = $grp['arfl_listid'];
			}
		}
	}

	if($type=='save')
	{
		if($facgrp==0)
		{
			if(empty($facgrps))
			{
				$facgrp = 1;
			}
			else
			{
				$facgrp = $facgrps[0]['arfl_listid']+1;
			}

			foreach ($facults as $fac) 
			{
				$facgrpsave['arfl_listid'] = $facgrp;
				$facgrpsave['arfl_faculty'] = $fac;
				$this->db->insert('ath_authfacultylist', $facgrpsave);
			}
		}
	}

	return $facgrp;
}


function load_user_right_data()
{
	$usrgroup = $this->input->post('ugroup');
        
	$this->db->select('arg.*, abr.arbl_branch');
	$this->db->where('rlist_usergroup',$usrgroup);
        $this->db->join('ath_authbranchlist abr','abr.arbl_listid=arg.rlist_branchlist');
	$user_right_data = $this->db->get('ath_authrightgroup arg')->result_array();

	return $user_right_data;
}

}
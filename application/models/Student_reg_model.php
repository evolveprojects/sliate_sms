<?php

class Company_model extends CI_model {

function update_comp_info()
{
	$comp_id 	= $this->input->post('comp_id');
	$name 		= $this->input->post('name');
	$brnum 		= $this->input->post('brnum');
	$comcode 	= $this->input->post('comcode');
	$addl1 		= $this->input->post('addl1');
	$addl2 		= $this->input->post('addl2');
	$city 		= $this->input->post('city');
	$country 	= $this->input->post('country');
	$telephone 	= $this->input->post('telephone');
	$fax 		= $this->input->post('fax');

	$comp_save['comp_name'] 	= $name;
	$comp_save['comp_brno'] 	= $brnum;
	$comp_save['comp_code'] 	= $comcode;
	$comp_save['comp_addl1'] 	= $addl1;
	$comp_save['comp_addl2'] 	= $addl2;
	$comp_save['comp_city'] 	= $city;
	$comp_save['comp_country'] 	= $country;
	$comp_save['comp_telephone']= $telephone;
	$comp_save['comp_fax'] 		= $fax;

	if(empty($comp_id))
	{
		$save = $this->db->insert('cfg_company',$comp_save);
	}
	else
	{
		$this->db->where('comp_id',$comp_id);
		$save = $this->db->update('cfg_company',$comp_save);
	}
	
	return $save;
}

function get_comp_info()
{
	$this->db->select('*');
	$this->db->where('comp_id',1);
	$comp_info = $this->db->get('cfg_company')->row_array();
	return $comp_info;
}

function save_group()
{
	$group_id 	= $this->input->post('group_id');
	$grname 	= $this->input->post('grname');

	$grp_save['grp_name'] 	= $grname;

	if(empty($group_id))
	{
		$save = $this->db->insert('cfg_group',$grp_save);
	}
	else
	{
		$this->db->where('grp_id',$group_id);
		$save = $this->db->update('cfg_group',$grp_save);
	}
	
	return $save;
}

function get_grp_info()
{
	$this->db->select('*');
	$grp_info = $this->db->get('cfg_group')->result_array();

	return $grp_info;
}

function save_branch()
{
	$br_id 		= $this->input->post('br_id');
	$group 		= $this->input->post('brgrp');
	$name 		= $this->input->post('brname');
	$comcode 	= $this->input->post('brcode');
	$addl1 		= $this->input->post('braddl1');
	$addl2 		= $this->input->post('braddl2');
	$city 		= $this->input->post('brcity');
	$country 	= $this->input->post('brcountry');
	$telephone 	= $this->input->post('brtelephone');
	$fax 		= $this->input->post('brfax');

	$br_save['br_group'] 	= $group;
	$br_save['br_name'] 	= $name;
	$br_save['br_code'] 	= $comcode;
	$br_save['br_addl1'] 	= $addl1;
	$br_save['br_addl2'] 	= $addl2;
	$br_save['br_city'] 	= $city;
	$br_save['br_country'] 	= $country;
	$br_save['br_telephone']= $telephone;
	$br_save['br_fax'] 		= $fax;

	if(empty($br_id))
	{
		$save = $this->db->insert('cfg_branch',$br_save);
	}
	else
	{
		$this->db->where('br_id',$br_id);
		$save = $this->db->update('cfg_branch',$br_save);
	}
	
	return $save;
}

function load_branches()
{
	$this->db->select('*');
	$this->db->where('br_group',$this->input->post('id'));
	$branches = $this->db->get('cfg_branch')->result_array();

	return $branches;
}

function edit_branch_load()
{
	$this->db->select('*');
	$this->db->where('br_id',$this->input->post('id'));
	$br_data = $this->db->get('cfg_branch')->row_array();

	return $br_data;
}

function save_fyear()
{
	$fy_id = $this->input->post('fy_id');
	$fs_date = $this->input->post('fs_date');
	$fe_date = $this->input->post('fe_date');

	$fy_save['fi_startdate'] = $fs_date;
	$fy_save['fi_enddate'] = $fe_date;

	if(isset($_POST['is_curr']))
	{
		$update = $this->db->update('cfg_finance_master',array('fi_iscurryear'=>0));
		$fy_save['fi_iscurryear'] = 1;
	}
	else
	{
		$fy_save['fi_iscurryear'] = 0;
	}

	if(empty($fy_id))
	{
		$result = $this->db->insert('cfg_finance_master',$fy_save);
	}
	else
	{
		$this->db->where('es_finance_masterid',$fy_id);
		$result = $this->db->update('cfg_finance_master',$fy_save);
	}
	
	return $result;
}

function get_fy_info()
{
	$this->db->select('*');
	$fy_res = $this->db->get('cfg_finance_master')->result_array();

	return $fy_res;
}

function save_ayear()
{
	$ay_id = $this->input->post('ay_id');
	$as_date = $this->input->post('as_date');
	$ae_date = $this->input->post('ae_date');
	$terms	= $this->input->post('terms');
	$intakes= $this->input->post('intakes');

	$this->db->trans_begin();

	$ay_save['ac_startdate'] = $as_date;
	$ay_save['ac_enddate'] = $ae_date;

	if(isset($_POST['is_curr_a']))
	{
		$this->db->update('cfg_academicyears',array('ac_iscurryear'=>0));
		$ay_save['ac_iscurryear'] = 1;
	}
	else
	{
		$ay_save['ac_iscurryear'] = 0;
	}

	if(empty($ay_id))
	{
		$this->db->insert('cfg_academicyears',$ay_save);
		$ay_id = $this->db->insert_id();
	}
	else
	{
		$this->db->where('es_ac_year_id',$ay_id);
		$this->db->update('cfg_academicyears',$ay_save);
	}

	for($x=1; $x<=$terms;$x++)
	{
		$trm_id = $this->input->post('trm_id_'.$x);

		$term_save['term_number'] 	= $this->input->post('term_'.$x);
		$term_save['term_sdate'] 	= $this->input->post('sdate_'.$x);
		$term_save['term_edate'] 	= $this->input->post('edate_'.$x);
		$term_save['term_acyear'] 	= $ay_id;

		if(empty($trm_id))
		{
			$result = $this->db->insert('cfg_term',$term_save);
		}
		else
		{
			$this->db->where('term_id',$trm_id);
			$result = $this->db->update('cfg_term',$term_save);
		}
	}

	for($x=1; $x<=$intakes;$x++)
	{
		$int_id = $this->input->post('int_id_'.$x);

		$int_save['int_number'] 	= $this->input->post('intnum_'.$x);
		$int_save['int_name'] 	= $this->input->post('intname_'.$x);
		$int_save['int_start'] 	= $this->input->post('intsdate_'.$x);
		$int_save['int_end'] 	= $this->input->post('intedate_'.$x);
		$int_save['int_acyear'] 	= $ay_id;

		if(empty($int_id))
		{
			$result = $this->db->insert('stu_intake',$int_save);
		}
		else
		{
			$this->db->where('int_id',$int_id);
			$result = $this->db->update('stu_intake',$int_save);
		}
	}

	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return false;
	}
	else
	{
		$this->db->trans_commit();
		return true;	
	}
}

function get_ay_info()
{
	$this->db->select('*');
	$ay_res = $this->db->get('cfg_academicyears')->result_array();

	return $ay_res;
}

function load_terms()
{
	$this->db->where('term_acyear',$this->input->post('id'));
	$terms = $this->db->get('cfg_term')->result_array();

	$this->db->where('int_acyear',$this->input->post('id'));
	$intakes = $this->db->get('stu_intake')->result_array();

	$all = array(
		'terms' => $terms,
		'intakes' => $intakes
		);

	return $all;
}

}
<?php
class Hci_config_model extends CI_model
{

function get_deptinfo()
{
	//$this->db->where('dept_status','A');
	$deptinfo = $this->db->get('cfg_department')->result_array();

	return $deptinfo;
}

function save_department()
{
	$dept_id 	= $this->input->post('dept_id');
	$depname 	= $this->input->post('depname');

	$deptsv['dept_name'] = $depname;
	$deptsv['dept_status'] = 'A';

	if(empty($dept_id))
	{
		$save = $this->db->insert('cfg_department',$deptsv);
	}
	else
	{
		$this->db->where('dept_id',$dept_id);
		$save = $this->db->Update('cfg_department',$deptsv);
	}
	
	return $save;
}

function change_deptstatus()
{
	$this->db->where('dept_id',$this->input->post('dept_id'));
	$result = $this->db->update('cfg_department',array('dept_status'=>$this->input->post('new_s')));

	if($result)
	{
		if($this->input->post('new_s')=='A')
		{
			$this->session->set_flashdata('flashSuccess', 'Department Activated Successfully.');
		}
		else
		{
			$this->session->set_flashdata('flashSuccess', 'Department Deactivated Successfully.');
		}
		
	}
	else
	{
		if($this->input->post('new_s')=='A')
		{
			$this->session->set_flashdata('flashError', 'Failed to Activate Department. Retry.');
		}
		else
		{
			$this->session->set_flashdata('flashError', 'Failed to Deactivate Department. Retry.');
		}
	}

	return $result;
}

function get_desiginfo()
{
	//$this->db->where('dept_status','A');
	$desiginfo = $this->db->get('cfg_designation')->result_array();

	return $desiginfo;
}

function save_designation()
{
	$desig_id 	= $this->input->post('desig_id');
	$desig_name 	= $this->input->post('desig_name');

	$desigsv['desig_name'] = $desig_name;
	$desigsv['desig_status'] = 'A';

	if(empty($desig_id))
	{
		$save = $this->db->insert('cfg_designation',$desigsv);
	}
	else
	{
		$this->db->where('desig_id',$desig_id);
		$save = $this->db->Update('cfg_designation',$desigsv);
	}
	
	return $save;
}

function change_desigstatus()
{
	$this->db->where('desig_id',$this->input->post('desig_id'));
	$result = $this->db->update('cfg_designation',array('desig_status'=>$this->input->post('new_s')));

	if($result)
	{
		if($this->input->post('new_s')=='A')
		{
			$this->session->set_flashdata('flashSuccess', 'Designation Activated Successfully.');
		}
		else
		{
			$this->session->set_flashdata('flashSuccess', 'Designation Deactivated Successfully.');
		}
		
	}
	else
	{
		if($this->input->post('new_s')=='A')
		{
			$this->session->set_flashdata('flashError', 'Failed to Activate Designation. Retry.');
		}
		else
		{
			$this->session->set_flashdata('flashError', 'Failed to Deactivate Designation. Retry.');
		}
	}

	return $result;
}

}
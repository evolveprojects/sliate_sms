<?php

class Hci_grade_model extends CI_model {

function save_grade()
{
	$grd_id 	= $this->input->post('grd_id');
	$grname 	= $this->input->post('grname');
	$grpromo    = $this->input->post('grpromo');
	$gr_code 	= $this->input->post('gr_code');

	$grd_save['grd_name'] 	= $grname;
	$grd_save['grd_status'] = 'A';
	$grd_save['grd_promotegrd'] = $grpromo;
	$grd_save['grd_code'] = $gr_code;

	if(empty($grd_id))
	{
		$save = $this->db->insert('hci_grade',$grd_save);
	}
	else
	{
		$this->db->where('grd_id',$grd_id);
		$save = $this->db->Update('hci_grade',$grd_save);
	}
	
	return $save;
}


function get_grd_info()
{
	$this->db->select('*');
	//$this->db->where('grd_status','A');
	$grd_info = $this->db->get('hci_grade')->result_array();

	$i = 0;
	foreach ($grd_info as $grd) 
	{
		$this->db->where('fsf_grade',$grd['grd_id']);
		$count = $this->db->count_all_results('hci_feestructure_fees');

		if($count==0)
		{
			$grd_info[$i]['grd_isused'] = 0;
		}
		else
		{
			$grd_info[$i]['grd_isused'] = 1;
		}

		$i++;
	}

	return $grd_info;
}

function remove_grade()
	{
		$this->db->where('grd_id',$this->input->post('grd_id'));
		$result = $this->db->delete('hci_grade');

		if($result)
		{
			$this->session->set_flashdata('flashSuccess', 'Location Removed Successfully.');
		}
		else
		{
			$this->session->set_flashdata('flashError', 'Failed to Remove Location. Retry.');
		}

		return $result;
	}

function change_status()
	{
		$this->db->where('grd_id',$this->input->post('grd_id'));
		$result = $this->db->update('hci_grade',array('grd_status'=>$this->input->post('new_s')));

		if($result)
		{
			if($this->input->post('new_s')=='A')
			{
				$this->session->set_flashdata('flashSuccess', 'Location Activated Successfully.');
			}
			else
			{
				$this->session->set_flashdata('flashSuccess', 'Location Deactivated Successfully.');
			}
			
		}
		else
		{
			if($this->input->post('new_s')=='A')
			{
				$this->session->set_flashdata('flashError', 'Failed to Activate Location. Retry.');
			}
			else
			{
				$this->session->set_flashdata('flashError', 'Failed to Deactivate Location. Retry.');
			}
		}

		return $result;
	}

}
<?php
class Hci_transport_model extends CI_model
{
function save_route()
{
	$id = $this->input->post('route_id');
	$name = $this->input->post('rt_name');

	$rt_save['route_title'] = $name;
	$rt_save['status'] = 'A';

	$this->db->trans_begin();

	if(empty($id))
	{
		$this->db->insert('hci_trans_route',$rt_save);
	}
	else
	{
		$this->db->where('id',$id);
		$this->db->update('hci_trans_route',$rt_save);
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

function get_routes()
{
	$this->db->where('status','A');
	$routes = $this->db->get('hci_trans_route')->result_array();

	return $routes;
}

function get_picking_points()
{
	// $this->db->where('status','A');
	$this->db->join('hci_trans_route','hci_trans_route.id=hci_transpickpoint.tpp_route');
	$picks = $this->db->get('hci_transpickpoint')->result_array();

	return $picks;
}

function save_pickpoint()
{
	$pp_route = $this->input->post('pp_route');
	$pick_id = $this->input->post('pick_id');
	$Pick_dist = $this->input->post('Pick_dist');
	$pick_point = $this->input->post('pick_point');
	
	$pp_save['place_name'] = $pick_point;
	$pp_save['tpp_route'] = $pp_route;
	$pp_save['tpp_stype'] = $Pick_dist;

	$this->db->trans_begin();

	if(empty($pick_id))
	{
		$this->db->insert('hci_transpickpoint',$pp_save);
	}
	else
	{
		$this->db->where('tr_place_id',$pick_id);
		$this->db->update('hci_transpickpoint',$pp_save);
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

function save_feestructure()
{
	$fs_id = $this->input->post('fs_id');
	$description = $this->input->post('description');
	$amt = $this->input->post('amt');

	$fs_save['fs_name'] = $description;
	// $fs_save['fs_iscurrent'] = $;

	$this->db->trans_begin();

	if(empty($fs_id))
	{
		$this->db->insert('hci_trans_feestructure',$fs_save);
		$fs_id = $this->db->insert_id();
	}
	else
	{
		$this->db->where('fs_id',$fs_id);
		$this->db->update('hci_trans_feestructure',$fs_save);
	}

	$all_inps = $_POST;
	$all_inp_ary = array_keys($all_inps);

	foreach ($all_inp_ary as $inp) 
	{
		$temp = explode('_', $inp);

		if($temp[0]=='feeamt')
		{	
			$fee['fsf_amount'] = $this->input->post($inp);

			$this->db->where('fsf_distance',$temp[1]);
			$this->db->where('fsf_isholiday',$temp[2]);
			$this->db->where('fsf_feestructure',$fs_id);
			$isex = $this->db->get('hci_trans_fsfee')->row_array();

			if(empty($isex))
			{
				$fee['fsf_distance'] = $temp[1];
				$fee['fsf_feestructure'] = $fs_id;
				$fee['fsf_isholiday'] = $temp[2];

				$this->db->insert('hci_trans_fsfee',$fee);
			}
			else
			{
				$this->db->where('fsf_id',$isex['fsf_id']);
				$this->db->update('hci_trans_fsfee',$fee);
			}
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

function get_feestructure()
{
	$this->db->select('*');
	$fss = $this->db->get('hci_trans_feestructure')->result_array();
	return $fss;
}

function save_registration()
{
	$student = $this->input->post('student');
	$feestruc = $this->input->post('feestruc');

	$save['st_includetrans'] = '1';
	$save['st_transfeestructure'] = $feestruc;
	
	$this->db->where('id',$student);
	$this->db->update('st_details',$save);
	
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
}
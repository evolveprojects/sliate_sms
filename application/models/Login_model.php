<?php 
class Login_model extends CI_Model {

function authenticateLogin() 
{
	$name = $this->input->post('username');
	$pass = $this->input->post('password');
	$encr = hash('sha512',$pass);

	// $this->db->select('user.*,employee.emp_name,employee.emp_location,location.loc_name,designation.desi_name,designation.desi_access_level');
	// $this->db->join('employee','employee.emp_id=user.user_employee');
	// $this->db->join('designation','designation.desi_id=employee.emp_designation');
	// $this->db->join('location','location.loc_id=employee.emp_location');
	// $this->db->where("user.user_name",$this->input->post('usernm'));
	// $this->db->where("user.user_password", $pass);
	// $result = $this->db->get("user")->row_array();

	$this->db->select('*,cfg_branch.br_name');
	$this->db->join('ath_usergroup','ath_usergroup.ug_id=ath_user.user_ugroup');
        $this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch');
	$this->db->where("ath_user.user_name",$name);
	$this->db->where("ath_user.user_password",$encr);
	$this->db->where("ath_user.user_status",'A');

	$result = $this->db->get("ath_user")->row_array();

	if(!empty($result))
	{
		$branch = $this->get_branchdetails($result['ug_branch']);

		$this->session->set_userdata('u_name',$result['user_name']);
        $this->session->set_userdata('u_pass',$result['user_password']);
		$this->session->set_userdata('u_id',$result['user_id']);
		$this->session->set_userdata('u_ugroup',$result['user_ugroup']);
		$this->session->set_userdata('u_emp',$result['user_employee']);
		$this->session->set_userdata('u_group',$result['ug_company']);
		$this->session->set_userdata('u_branch',$result['br_name']);
        $this->session->set_userdata('u_br_code',$result['br_code']);
        $this->session->set_userdata('user_branch',$result['user_branch']);
        $this->session->set_userdata('user_ref_id',$result['user_ref_id']);
		$this->session->set_userdata('u_compname',$branch['br_name']);
	    $this->session->set_userdata('u_compaddline1',$branch['br_addl1']);
	    $this->session->set_userdata('u_compaddline2',$branch['br_addl2']);
	    $this->session->set_userdata('u_compaddline3',$branch['br_city'].', '.$branch['br_country']);
	   	$this->session->set_userdata('u_branchcode',$branch['br_code']);
	}

	if($result['user_type'])
	{
		$per = $this->db->get_where('ath_role_permissions', array('role_id' => $result['user_type']))->row_array();
		
		$permissions = json_decode($per['permissions']);

		$this->session->set_userdata('permissions', $permissions);
	} else {
		$this->session->set_userdata('permissions', ['no permissions assigned']);
	}

	return $result;
}


function get_branchdetails($branch)
{
    $this->db->where('br_id',$branch);
    $branch = $this->db->get('cfg_branch')->row_array();
}

}

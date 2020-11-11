<?php 
class User_model extends CI_Model {
	
function save_user(){
	
	$usr_id = $this->input->post('usr_id');
	$usrname = $this->input->post('usname');
	$user_ugroup = $this->input->post('user_group_select');
	$upas = $this->input->post('uspass');
	$rupas = $this->input->post('ruspass');
	$user_branch = $this->input->post('user_branch');
        $usremail = $this->input->post('email');
	$u_id = $this->session->userdata('u_id');
        
        $hashed_password = hash('sha512',$upas);
        
	$insert_data = array(
            'user_name' => $usrname,
            'user_password' => $hashed_password,
            'user_ugroup'=>$user_ugroup,
            'user_status'=> 'A',
            'user_branch' => $user_branch,
            'user_email' => $usremail,
            'created_by'=> $u_id,
            'created_datetime' => date("Y-m-d H:i:s", now())
	);
	
	$update_data = array(

        'user_name' => $usrname,
        'user_password' => $hashed_password,
        'user_ugroup'=>$user_ugroup,	
        //'user_status'=> 'A',
        'user_branch' => $user_branch,
        'user_email' => $usremail,
        'updated_by'=> $u_id,
        'updated_datetime' => date("Y-m-d H:i:s", now())

	);
        
        $config = Array(
            'protocol' => 'HTTP',
            'smtp_host' => 'ssl://smtp.gmail.com',   //smtp.gmail.com
            'smtp_port' => 465,
            'auth' => true,
            'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
            'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        
        $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">Password Changed!</h2></div>';
        $htmlContent .= '<p>Dear '.$usrname.',</p>';
        $htmlContent .= '<p>Your Password has been changed.Please use below credentials to login.</p>';
        $htmlContent .= 'Link : <a href="http://student.sliate.ac.lk/">student.sliate.ac.lk</a><br/>';
        $htmlContent .= 'User Name : ' . $username . '<br/>';
        $htmlContent .= 'Password : ' . $upas . '<br/>';
        $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';
        $this->load->library('Email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('sms@sliate.ac.lk'); // change it to yours
        $this->email->to($usremail);// change it to yours 
        $this->email->bcc('student.sliate.ac.lk@gmail.com');
        $this->email->subject('SLIATE SMS - Password Changed!');
        $this->email->message($htmlContent);
	
	if (empty($usr_id)) {
		
            if ($upas == $rupas) {
                $result = $this->db->insert('ath_user', $insert_data);
                
                if($result){
                    //new user save
                    if ($this->email->send()) {
                        $this->session->set_flashdata('flashSuccess', 'User saved successfully.Email Sent.');
                        $this->logger->systemlog('Save User', 'Success', 'User saved successfully.Email Sent.', date("Y-m-d H:i:s", now()),$insert_data);
                    } else {
                        $this->session->set_flashdata('flashSuccess', 'User saved successfully.<span style="color:red;"><b> Email Could Not Sent.</b></span>');
                        $this->logger->systemlog('Save User', 'Success', 'User saved successfully.Email not Sent.', date("Y-m-d H:i:s", now()),$insert_data);
                    }
                }
                else{
                    $this->session->set_flashdata('flashSuccess', 'User not saved.');
                    $this->logger->systemlog('Save User', 'Failure', 'Failed to Save User.', date("Y-m-d H:i:s", now()),$insert_data);
                }
            }
            else{
                $result = $this->session->set_flashdata('flashError', 'Password and confirm password does not match.');
            }
		
        } 
	else {
            $this->db->where('user_id', $usr_id);
            $result = $this->db->update('ath_user', $update_data);
            
            if($result){
                //update user
                if ($this->email->send()) {
                    $this->session->set_flashdata('flashSuccess', 'User updated successfully. Email Sent.');
                    $this->logger->systemlog('Update User', 'Success', 'User updated successfully.Email sent.', date("Y-m-d H:i:s", now()),$update_data);
                } else {
                    $this->session->set_flashdata('flashSuccess', 'User updated successfully.<span style="color:red;"><b> Email Could Not Sent.</b></span>');
                    $this->logger->systemlog('Update User', 'Success', 'User updated successfully.Email not sent.', date("Y-m-d H:i:s", now()),$update_data);
                }
                
            }
            else{
                $this->session->set_flashdata('flashSuccess', 'User updation failed.');
                $this->logger->systemlog('Update User', 'Failure', 'Failed to Update User.', date("Y-m-d H:i:s", now()),$update_data);
            }
        }

	//return $result;
		
	/* if ($upas == $rupas) {
	$this->db->insert('ath_user', $data);
	}
	else{
		//$msg = "Passwords Doses't Match";
		echo "<script type='text/javascript'>alert('New Password is not Same');</script>";
	} */
	//$grp_save['ug_name'] 		= $grname;
	//$grp_save['ug_status'] 	= 'A';
	//$grp_save['ug_level'] = $acc_level;
}

function get_branch_list(){
    
    $this->db->select('*');
    $user_branches = $this->db->get('cfg_branch')->result_array();

    return $user_branches;
}

function edit_user(){
	
}

function delet_user_group($ug_id)
{
    $this->db->where('ug_id', $ug_id);
    $this->db->delete('ath_usergroup');
    $this->session->set_flashdata('flashSuccess', 'User group deleted successfully !.');
    
    $this->sb->select('*');
    $this->db->where('ug_id', $ug_id);
    $row_array = $this->db->get('cfg_branch')->row_array();
    
    $this->logger->systemlog('Delete User Group', 'Success', 'User Group deleted successfully.', date("Y-m-d H:i:s", now()), $row_array);
    return $this->db->affected_rows();
    
}

function save_usergroup() 
{
	$group_id 	= $this->input->post('grp_id');
        $gr_prefix      = $this->input->post('ugrp_name_pref');
	$grname 	= $this->input->post('ugrp_name_pref').$this->input->post('ugrp_name');
	$acc_level 	= $this->input->post('acc_level');
        $course_id      = $this->input->post('user_grp_course');
        
	$grp_save['ug_name'] = $grname;
	$grp_save['ug_status'] 	= 'A';
	$grp_save['ug_level'] = $acc_level;
        

//        $exists = $this->check_group_name_exists($grname);
        
//        if($exists == true){
//            $this->session->set_flashdata('flashError', 'User Group Already Exists! Use Another Name.');
//        } else {
            if($acc_level>1)
            {
                $grp_save['ug_branch'] = $this->input->post('user_grp_center');
                if($acc_level == 2){
                    if($gr_prefix == 'hod_'){
                        $grp_save['ug_course'] = $course_id;
                    } else if($gr_prefix == 'exam_'){
                        $grp_save['ug_branch']= null;
                    }
                    
                } 
            }
            else{
                $grp_save['ug_branch'] = '8';

            }
            if(empty($group_id))
            {
                    $save = $this->db->insert('ath_usergroup',$grp_save);

                    if($save)
                    {
                            $this->session->set_flashdata('flashSuccess', 'User group saved successfully.');
                            $this->logger->systemlog('Save User Group', 'Success', 'User group saved successfully.', date("Y-m-d H:i:s", now()),$grp_save);
                    }
                    else
                    {
                            $this->session->set_flashdata('flashError', 'Failed to save User group. Retry.');
                            $this->logger->systemlog('Save User Group', 'Failure', 'Failed to save User group.', date("Y-m-d H:i:s", now()),$grp_save);
                    }
            }
            else
            {
                    $this->db->where('ug_id',$group_id);
                    $save = $this->db->update('ath_usergroup',$grp_save);

                    if($save)
                    {
                            $this->session->set_flashdata('flashSuccess', 'User group updated successfully.');
                            $this->logger->systemlog('Edit User Group', 'Success', 'User group edited successfully.', date("Y-m-d H:i:s", now()),$grp_save);
                    }
                    else
                    {
                            $this->session->set_flashdata('flashError', 'Failed to update User group. Retry.');
                            $this->logger->systemlog('Edit User Group', 'Failure', 'Failed to edit User group.', date("Y-m-d H:i:s", now()),$grp_save);
                    }
            }
            return $save;
//        }
        
//	if($acc_level==2)
//	{
//		$grp_save['ug_company'] = $this->input->post('comp');
//	}
//	
//	if($acc_level==3)
//	{
//		$grp_save['ug_company'] = $this->input->post('comp');
//		$grp_save['ug_branch'] = $this->input->post('branch');
//	}
        
        
	
	
}

function check_group_name_exists($ug_name){
        $this->db->select('ug_name');
        $this->db->where('ug_status','A');
         $this->db->where('ug_name',$ug_name);
        $groups = $this->db->get('ath_usergroup')->result_array();
        
        if(!empty($groups)){
           return true; 
        } else {
            return false;
        }
}
function get_user_groups()
{
	$this->db->select('*');
	$this->db->where('ug_status','A');
	$groups = $this->db->get('ath_usergroup')->result_array();

	return $groups;
}

function get_user_groups_for_examiner()
{
	$this->db->select('*');
	$this->db->where('ug_status','A');
        $this->db->where('ug_level', 2);
        $this->db->like('ug_name', 'exam_');
	$groups = $this->db->get('ath_usergroup')->result_array();

	return $groups;
}




 function get_user_groups_lookup() {
     
        $acc_level = $this->input->post('acc_level');
        $group = $this->input->post('group');
        
          
        $this->db->select('ath_user.*,ath_usergroup.ug_name,ath_usergroup.ug_level,cfg_group.grp_name,cfg_branch.br_name,cfg_branch.br_code,cfg_branch.br_id');
	$this->db->join('ath_usergroup','ath_usergroup.ug_id=ath_user.user_ugroup');
	$this->db->join('cfg_group','cfg_group.grp_id=ath_user.user_group','left');
	$this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch','left');
        
        if($acc_level != ""){
            $this->db->where('ath_usergroup.ug_level', $acc_level);
        }
        if($group != ""){
            $this->db->where('ath_user.user_ugroup', $group);
        }
  
	$users = $this->db->get('ath_user')->result_array();

	return $users;
        
    }








function get_users_list()
{
	$this->db->select('ath_user.*,ath_usergroup.ug_name,ath_usergroup.ug_level,cfg_group.grp_name,cfg_branch.br_name,cfg_branch.br_code,cfg_branch.br_id');
	$this->db->join('ath_usergroup','ath_usergroup.ug_id=ath_user.user_ugroup');
	$this->db->join('cfg_group','cfg_group.grp_id=ath_user.user_group','left');
	$this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch','left');
	$users = $this->db->get('ath_user')->result_array();

	return $users;
}

function reset_user()
{
        
        $id = $this->input->post('id');
	$pass = '12345678';
	$encr = hash('sha512',$pass);
	
	$this->db->where('user_id',$id);
	$result = $this->db->update('ath_user',array('user_status'=>'A','user_password'=>$encr));

	if($result)
	{
		$this->session->set_flashdata('flashSuccess', 'User password reset successfully.');
                $this->logger->systemlog('Reset User Password', 'Success', 'User password reset successfully.', date("Y-m-d H:i:s", now()),array('user_status'=>'A','user_password'=>$encr));
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to reset user password. Retry.');
                $this->logger->systemlog('Reset User Password', 'Failure', 'Failed to reset password.', date("Y-m-d H:i:s", now()),array('user_status'=>'A','user_password'=>$encr));
	}

	return $result;
}

function update_status()
{
	$id = $this->input->post('id');
	$status = $this->input->post('status');
        $uname = $this->input->post('uname');
 
	if($status=='A')
	{
		$s_display = 'Activated';
		$f_display = 'Activate';
                $active = 0;
	}
	else
	{
		$s_display = 'Deactivated';
		$f_display = 'Deactivate';
                $active = 1;
	}

	$this->db->where('user_id',$id);
	$result = $this->db->update('ath_user',array('user_status'=>$status));
        
        $this->db->where('reg_no',$uname);
	$result = $this->db->update('stu_reg',array('deleted'=>$active));

        $this->db->select('reg_no,first_name,last_name,updated_by,updated_on');
        $this->db->where('reg_no',$uname);
        $row_array = $this->db->get('stu_reg')->row_array();
         
	if($result)
	{
		$this->session->set_flashdata('flashSuccess', 'User '.$s_display.' successfully.');
                $this->logger->systemlog('Update Status', 'Success', 'Status Successfully Updated.', date("Y-m-d H:i:s", now()),$row_array);
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to '.$f_display.' User. Retry.');
                $this->logger->systemlog('Update Status', 'Failure', 'Failed to Update Status.', date("Y-m-d H:i:s", now()),$row_array);
	}

	return $result;
}

function delete_user()
{
	$id = $this->input->post('id');

	$this->db->where('user_id',$id);
	$result = $this->db->delete('ath_user');
        
        $this->db->select('*');
        $this->db->where('user_id',$id);
        $row_array = $this->db->get('ath_user')->row_array();
         

	if($result)
	{
		$this->session->set_flashdata('flashSuccess', 'User Deleted successfully.');
                $this->logger->systemlog('Delete User', 'Success', 'User Deleted successfully.', date("Y-m-d H:i:s", now()),$row_array);
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to Delete User. Retry.');
                $this->logger->systemlog('Delete User', 'Failure', 'Failed to Delete User.', date("Y-m-d H:i:s", now()),$row_array);
	}

	return $result;
}

function check_user_group(){
    $name = $this->input->post('name');
        
    $this->db->select('count(ug_name) as name_count');
    $this->db->where('ug_name',$name);
    $this->db->where('ug_status','A');
    $name_query = $this->db->get('ath_usergroup')->row_array();

    return $name_query;
}

function check_duplicate_user(){
    $usrname = $this->input->post('usrname');
        
    $this->db->select('count(user_name) as usrname_count');
    $this->db->where('user_name',$usrname);
    $usrname_query = $this->db->get('ath_user')->row_array();

    return $usrname_query;
}

 
function get_user_group_branch(){
    $user_group = $this->input->post('user_group');
        
    $this->db->select('*');
    $this->db->where('ug_id',$user_group);
    $this->db->join('cfg_branch cb','cb.br_id=ag.ug_branch');
    $user_group_query = $this->db->get('ath_usergroup ag')->row_array();

    return $user_group_query;
}

function filter_accuser_detail(){
	
	$type = $this->input->post('type_val');
        
        if($type == "gender"){
            $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, sr.sex, COUNT(IF(sr.sex = "F", sr.sex, null)) as type2, COUNT(IF(sr.sex = "M", sr.sex, null)) as type1');     
        }
         
        if($type == "time"){
            $this->db->select('ec.course_code, ec.course_name, cb.br_code, cb.br_name, COUNT(IF(sr.course_type = "P", sr.course_type, null)) as type1, COUNT(IF(sr.course_type = "F", sr.course_type, null)) as type2');
        }
        
        $this->db->select('ath_user.*,ath_usergroup.ug_name,ath_usergroup.ug_level,cfg_group.grp_name,cfg_branch.br_name,cfg_branch.br_code,cfg_branch.br_id');
		$this->db->join('ath_usergroup','ath_usergroup.ug_id=ath_user.user_ugroup');
		$this->db->join('cfg_group','cfg_group.grp_id=ath_user.user_group','left');
		$this->db->join('cfg_branch','cfg_branch.br_id=ath_user.user_branch','left');
		$users = $this->db->get('ath_user')->result_array();

		return $users;
        
        return $stu_count_array = $this->db->get('stu_reg sr')->result_array();
}

    function load_center_course_list(){
        $center = $this->input->post('center_id');

        $this->db->select('cr.id as course_id, cr.course_code, cr.course_name');
        $this->db->join('edu_center_course ecc', 'cr.id=ecc.course_id');
        $this->db->where('ecc.center_id', $center);
        $this->db->group_by('cr.course_code');
        $this->db->group_by('cr.course_name');

        $course_list = $this->db->get('edu_course cr')->result_array();

        return $course_list;
    }

}
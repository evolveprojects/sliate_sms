<?php

class Change_pw_model extends CI_Model {

    function authenticate() {

        //$name = $this->input->post('username');
        $pass = $this->input->post('password');
        $sess_pass = $this->session->userdata('u_pass');
        $pass1 = $this->input->post('newpass');
        $pass2 = $this->input->post('new2pass');
        $uid = $this->session->userdata('u_id');
		$encr = hash('sha512',$pass);
		$encr1 = hash('sha512',$pass1);
		
		
        $data = array('user_password' => $encr1);

        //var_dump($pass);
//sdfbvdsfbdsbdsbsdgb
        if ($sess_pass == $encr) {
            //jgvjvgvjgvjjvb
            if ($pass1 == $pass2) {
                //echo "<script type='text/javascript'>alert('yes');</script>";
                //$pass1 = $_POST['newpass'];
                //$query = "UPDATE 'hcum' SET 'user_password'='$pass1'";
                $this->db->where('user_id', $uid);
                $this->db->update('ath_user', $data);
                //redirect('login?login=logout');
                $msg = "success";
            } else {
                //echo "<script type='text/javascript'>alert('New Password is not Same');</script>";
                $msg =  "Password and re-type passwords does not match !";
            }
        } else {
            $msg = "Old Password does not match !";
            //echo "<script type='text/javascript'>alert('Old Password Does not Match');</script>";
        }
        return $msg;
    }
}    
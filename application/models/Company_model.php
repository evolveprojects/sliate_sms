<?php

class Company_model extends CI_model {

    function update_comp_info() {
        $comp_id = $this->input->post('comp_id');
        $name = $this->input->post('name');
        $brnum = $this->input->post('brnum');
        $comcode = $this->input->post('comcode');
        $addl1 = $this->input->post('addl1');
        $addl2 = $this->input->post('addl2');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $telephone = $this->input->post('telephone');
        $fax = $this->input->post('fax');

        $comp_save['comp_name'] = $name;
        $comp_save['comp_brno'] = $brnum;
        $comp_save['comp_code'] = $comcode;
        $comp_save['comp_addl1'] = $addl1;
        $comp_save['comp_addl2'] = $addl2;
        $comp_save['comp_city'] = $city;
        $comp_save['comp_country'] = $country;
        $comp_save['comp_telephone'] = $telephone;
        $comp_save['comp_fax'] = $fax;

        if (empty($comp_id)) {
            $save = $this->db->insert('cfg_company', $comp_save);
            $this->logger->systemlog('Save Company Information', 'Success', 'Saved Company Information.', date("Y-m-d H:i:s", now()), $comp_save);
        } else {
            $this->db->where('comp_id', $comp_id);
            $save = $this->db->update('cfg_company', $comp_save);
            $this->logger->systemlog('Update Company Information', 'Success', 'Updated Company Information.', date("Y-m-d H:i:s", now()), $comp_save);
        }

        return $save;
    }
    
  //study version save
    function save_version(){
        $version_id = $this->input->post('version_id');
        $version_name = $this->input->post('version_name');
        $description = $this->input->post('description');
    
        $version_save['version_name'] = $version_name;
        $version_save['description'] = $description;
        
        if (empty($version_id)) {
            $save = $this->db->insert('cfg_subject_version', $version_save);
            
            $this->session->set_flashdata('flashSuccess', 'Study Version Saved successfully.');
        } else {
            $this->db->where('version_id', $version_id);
            $save = $this->db->update('cfg_subject_version', $version_save);
            
            $this->session->set_flashdata('flashSuccess', 'Study Version Updated successfully.');
        } 
        //redirect('company?tab_id=version');
        
        
    }

    function get_comp_info() {
        $this->db->select('*');
        $this->db->where('comp_id', 1);
        $comp_info = $this->db->get('cfg_company')->row_array();
        return $comp_info;
    }

    function save_group() {
        $group_id = $this->input->post('group_id');
        $grname = $this->input->post('grname');

        $grp_save['grp_name'] = $grname;

        if (empty($group_id)) {
            $save = $this->db->insert('cfg_group', $grp_save);
            $this->logger->systemlog('Manage Company', 'Success', 'Company Saved successfully.', date("Y-m-d H:i:s", now()), $grp_save);
        } else {
            $this->db->where('grp_id', $group_id);
            $save = $this->db->update('cfg_group', $grp_save);
            $this->logger->systemlog('Manage Company', 'Success', 'Company Updated successfully.', date("Y-m-d H:i:s", now()), $grp_save);
        }

        return $save;
    }

    function get_grp_info() {
        $this->db->where('ug_id', $this->session->userdata('u_ugroup'));
        $authgroup = $this->db->get('ath_usergroup')->row_array();

        $this->db->select('*');
        if ($authgroup['ug_level'] == 2 || $authgroup['ug_level'] == 3) {
            $this->db->where('grp_id', $authgroup['ug_company']);
        }
        $comp = $this->db->get('cfg_group')->result_array();

        return $comp;
    }

    function save_branch() {
        $br_id = $this->input->post('br_id');
        $group = $this->input->post('brgrp');
        $name = $this->input->post('brname');
        $comcode = $this->input->post('brcode');
        $addl1 = $this->input->post('braddl1');
        $addl2 = $this->input->post('braddl2');
        $city = $this->input->post('brcity');
        $country = $this->input->post('brcountry');
        $telephone = $this->input->post('brtelephone');
        $fax = $this->input->post('brfax');

        $br_save['br_group'] = $group;
        $br_save['br_name'] = $name;
        $br_save['br_code'] = $comcode;
        $br_save['br_addl1'] = $addl1;
        $br_save['br_addl2'] = $addl2;
        $br_save['br_city'] = $city;
        $br_save['br_country'] = $country;
        $br_save['br_telephone'] = $telephone;
        $br_save['br_fax'] = $fax;

        if (empty($br_id)) {
            $save = $this->db->insert('cfg_branch', $br_save);
            $this->logger->systemlog('Save New Center', 'Success', 'New Center successfully saved.', date("Y-m-d H:i:s", now()), $br_save);
        } else {
            $this->db->where('br_id', $br_id);
            $save = $this->db->update('cfg_branch', $br_save);
            $this->logger->systemlog('Update Center', 'Success', 'Center successfully Updated.', date("Y-m-d H:i:s", now()), $br_save);
        }

        return $save;
    }

    function load_branches() {
        $this->db->where('ug_id', $this->session->userdata('u_ugroup'));
        $authgroup = $this->db->get('ath_usergroup')->row_array();

        $this->db->select('*');
        $this->db->where('br_group', $this->input->post('id'));
        if ($authgroup['ug_level'] == 3) {
            $this->db->where('br_id', $authgroup['ug_branch']);
        }
        $branches = $this->db->get('cfg_branch')->result_array();

        return $branches;
    }

    function edit_branch_load() {
        $this->db->select('*');
        $this->db->where('br_id', $this->input->post('id'));
        $br_data = $this->db->get('cfg_branch')->row_array();

        return $br_data;
    }

    function save_fyear() {
        $fy_id = $this->input->post('fy_id');
        $fs_date = $this->input->post('fs_date');
        $fe_date = $this->input->post('fe_date');

        $fy_save['fi_startdate'] = $fs_date;
        $fy_save['fi_enddate'] = $fe_date;

        if (isset($_POST['is_curr'])) {
            $update = $this->db->update('cfg_finance_master', array('fi_iscurryear' => 0));
            $fy_save['fi_iscurryear'] = 1;
        } else {
            $fy_save['fi_iscurryear'] = 0;
        }

        if (empty($fy_id)) {
            $result = $this->db->insert('cfg_finance_master', $fy_save);
        } else {
            $this->db->where('es_finance_masterid', $fy_id);
            $result = $this->db->update('cfg_finance_master', $fy_save);
        }

        return $result;
    }

    function get_fy_info() {
        $this->db->select('*');
        $fy_res = $this->db->get('cfg_finance_master')->result_array();

        return $fy_res;
    }

    function save_ayear() {
        $ay_id = $this->input->post('ay_id');
        $as_date = $this->input->post('as_date');
        $ae_date = $this->input->post('ae_date');
        $terms = $this->input->post('terms');
        $intakes = $this->input->post('intakes');

        $this->db->trans_begin();

        $ay_save['ac_startdate'] = $as_date;
        $ay_save['ac_enddate'] = $ae_date;

        if (isset($_POST['is_curr_a'])) {
            $this->db->update('cfg_academicyears', array('ac_iscurryear' => 0));
            $ay_save['ac_iscurryear'] = 1;
        } else {
            $ay_save['ac_iscurryear'] = 0;
        }

        if (empty($ay_id)) {
            $this->db->insert('cfg_academicyears', $ay_save);
            $ay_id = $this->db->insert_id();
        } else {
            $this->db->where('es_ac_year_id', $ay_id);
            $this->db->update('cfg_academicyears', $ay_save);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->logger->systemlog('Update Study Season Info', 'Failure', 'Failed to Update Study Season Info : ' . $ay_save['ac_startdate'] . ' - ' . $ay_save['ac_enddate'], date("Y-m-d H:i:s", now()));
            $this->db->trans_rollback();
            return false;
        } else {
            $this->logger->systemlog('Update Study Season Info', 'Success', 'Study Season Info Updated successfully : ' . $ay_save['ac_startdate'] . ' - ' . $ay_save['ac_enddate'], date("Y-m-d H:i:s", now()));
            $this->db->trans_commit();
            return true;
        }
        //redirect('company?tab_id=other');
    }

    function get_ay_info() {
        $this->db->select('*');
        $range_res = $this->db->get('cfg_academicyears')->result_array();

        return $range_res;
    }

    function get_range_info(){
        $this->db->select('*');
        $this->db->where('HGC_SEQ_Name', 'REG_RANGE');
        //$this->db->where('id', 1);
        $range_info = $this->db->get('oth_sequence')->row_array();
        return $range_info;
        
    }
    
    function getRange() {
        $this->db->select("HGC_SEQ_NextValue, HGC_SEQ_Reserved, RANGE_VALUES");
        $this->db->from('oth_sequence');
        $query = $this->db->get();
        
        return $query->result(); 
    }
    
    function load_terms() {
        $today = date("Y-m-d");
        $this->db->where('int_start <=', $today);
        $this->db->where('int_end >=', $today);

        $intake = $this->db->get('stu_intake')->row_array();
        $this->db->where('term_acyear', $this->input->post('id'));
        $terms = $this->db->get('cfg_term')->result_array();

        $this->db->where('int_acyear', $this->input->post('id'));
        $intakes = $this->db->get('stu_intake')->result_array();

        $this->db->where('int_start <=', $today);
        $this->db->where('int_end >=', $today);
        $currintake = $this->db->get('stu_intake')->row_array();

        $this->db->where('term_sdate <=', $today);
        $this->db->where('term_edate >=', $today);
        $currterm = $this->db->get('cfg_term')->row_array();

        $all = array(
            'terms' => $terms,
            'intakes' => $intakes,
            'currintake' => $currintake['int_id'],
            'currterm' => $currterm['term_id']
        );

        return $all;
    }

    function load_termsperiods() {
        $this->db->where('tprd_status', 'A');
        $this->db->where('tprd_term', $this->input->post('id'));
        $period = $this->db->get('cfg_termperiod')->result_array();

        return $period;
    }

    function save_termperiod() {
        $tp_term = $this->input->post('tp_term');
        $tp_periods = $this->input->post('tp_periods');
        $prd_id = $this->input->post('prdid');

        $this->db->trans_begin();

        $this->db->where('term_id', $tp_term);
        $this->db->update('cfg_term', array('term_periods' => $tp_periods));

        $this->db->where('tprd_term', $tp_term);
        $this->db->update('cfg_termperiod', array('tprd_status' => 'D'));

        foreach ($prd_id as $key => $pdr) {

            $prdsv['tprd_name']   = $this->input->post('tprd_' . $key);
            $prdsv['tprd_sdate']  = $this->input->post('tpsdate_' . $key);
            $prdsv['tprd_edate']  = $this->input->post('tpedate_' . $key);
            $prdsv['tprd_status'] = 'A';
            $prdsv['tprd_term']   = $tp_term;

            if ($pdr == '') {
                $this->db->insert('cfg_termperiod', $prdsv);
            } else {
                $this->db->where('tprd_id', $pdr);
                $this->db->update('cfg_termperiod', $prdsv);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    
    
    function save_range($id,$data){ 
        
       $this->db->where('HGC_SEQ_Name', 'REG_RANGE');
       $this->db->update('oth_sequence', $data);
       
       $this->session->set_flashdata('flashSuccess', 'Student Registration Number Range Saved successfully.');
       //redirect('company?tab_id=range');
       
      /*  
        $query  = null; 

        $strt   =  $_POST['start']; 
        $en     =  $_POST['end'];
        
        $query  = $this->db->get_where('range_tbl', array(//making selection
            'start_range' => $strt,
            'end_range'   => $en
        ));
        
        $count = $query->num_rows(); //counting result from query
        if ($count === 0) {
          $data = array(
              'start_range' => $strt,
              'end_range'   => $en
           );
        $this->db->insert('range_tbl', $data);
        return $data;*/
        
//        $data = array(
//            'start_range' => $this->input->post('start'),
//            'end_range'   => $this->input->post('end'),
//            //'full_range'  => $this->input->post($tot_range)
//        );
        
        
        
        
        
//        $insert_data = array(
//            'start_range' => $data['start'],
//            'end_range' => $data['end']
//        );
//        
//        if (empty($data['id'])) {
//            $result = $this->db->insert('range_table', $insert_data);
//        } else {}
//        
//        return $result;
    /*}else{
     $this->session->set_flashdata('flashError', 'Already Range Submitted. Retry.');
    }*/
    }
    function get_all_study_seasons() {
        $result_array = $this->db->get('cfg_academicyears')->result_array();
        return $result_array;
    }
    
    function getVersion(){
         $this->db->select("version_id, version_name, description, status");
         //$this->db->where('status', 0);
         $this->db->from('cfg_subject_version');
         $query1 = $this->db->get();
         return $query1->result_array();
    }
    

    
    function edit_version_load(){
        $this->db->select('*');
        $this->db->where('version_id', $this->input->post('version_id'));
        $version_data = $this->db->get('cfg_subject_version')->row_array();

        return $version_data;
    }
    
    
    function update_version_status($data) {
      $this->db->where('version_id', $data['version_id']);
      $stu_prof = $this->db->update('cfg_subject_version',array('status'=>$data['status']));
      
      return $stu_prof;
     
    }
	
	// function savenews($news_tile,$news_url)
	// {
	// $query="insert into com_latest_news (news_name, news_url)";
	// $this->db->query($query);
	// }
	
    function savenews()
    {
		$news_id = $this->input->post('news_id');
        $news_tile = $this->input->post('news_tile');
        $news_url = $this->input->post('news_url');
		$u_id = $this->session->userdata('u_id');
			
            $insert_data = array(
                'news_name' => $news_tile,
                'news_url' => $news_url,
				'created_by'=> $u_id,
				'created_on' => date("Y-m-d H:i:s", now())
            );
			$update_data = array(
                'news_name' => $news_tile,
                'news_url' => $news_url,
				'updated_by'=> $u_id,
            );
			if (empty($news_id)) {
				$this->db->insert('com_latest_news', $insert_data);
                                $this->logger->systemlog('Manage News', 'Success', 'News Added Successfully.', date("Y-m-d H:i:s", now()), $insert_data);
			}
			else {
				$this->db->where('news_id', $news_id);
				$this->db->update('com_latest_news', $update_data);
                                $this->logger->systemlog('Manage News', 'Success', 'News Updated Successfully.', date("Y-m-d H:i:s", now()), $update_data);
			}
			redirect('company?tab_id=news');
    }
	
	function savevents()
    {
		$event_id = $this->input->post('event_id');
        $event_tile = $this->input->post('event_tile');
        $event_url = $this->input->post('event_url');
		$u_id = $this->session->userdata('u_id');

            $insert_data = array(
                'events_name' => $event_tile,
                'events_url' => $event_url,
				'created_by'=> $u_id,
				'created_on' => date("Y-m-d H:i:s", now())
            );
			$update_data = array(
                'events_name' => $event_tile,
                'events_url' => $event_url,
				'updated_by'=> $u_id,
            );
			if (empty($event_id)) {
				$this->db->insert('com_latest_events', $insert_data);
                                $this->logger->systemlog('Manage Events', 'Success', 'Event Added Successfully.', date("Y-m-d H:i:s", now()), $insert_data);
			}
			else {
				$this->db->where('events_id', $event_id);
				$this->db->update('com_latest_events', $update_data);
                                $this->logger->systemlog('Manage Events', 'Success', 'Event Updated Successfully.', date("Y-m-d H:i:s", now()), $update_data);
			}
			redirect('company?tab_id=events');
    }
	
	function getNews(){
		  $this->db->select("news_name");
		  $this->db->select("news_url");
		  $this->db->from('com_latest_news');
		  $query = $this->db->get();
		  return $query->result_array();
 }
 
	function getPosts(){
		  $this->db->select("events_name");
		  $this->db->select("events_url");  
		  $this->db->from('com_latest_events');
		  $query = $this->db->get();
		  return $query->result_array();
 }
 
    function update_delete_status($data) {
	  $this->db->where('news_id', $data['news_id']);
      $del_new = $this->db->update('com_latest_news',array('is_deleted'=>1));
      
      return $del_new;
           
}

	function update_deletevent_status($data) {
	  $this->db->where('events_id', $data['events_id']);
      $del_even = $this->db->update('com_latest_events',array('is_deleted'=>1));
      
      return $del_even;
           
}

	function save_authority()
    {
	$sign_id = $this->input->post('sign_id');
        $sig_type = $this->input->post('sig_type');
        $sig_name = $this->input->post('sig_name');
        $sig_position = $this->input->post('sig_position');
        $sig_admi = $this->input->post('sig_admi');
        $sig_comen = $this->input->post('sig_comen');
        $sig_typen = 'RPT';
        
        if ($sig_type==1) {
            $sig_typen = 'RPT';
        }
        elseif($sig_type==2){
            $sig_typen = 'DSG';
        }
        elseif($sig_type==3){
            $sig_typen = 'QLF';
        }
        elseif($sig_type==4){
            $sig_typen = 'MHPRPT';
        }
        elseif($sig_type==5){
            $sig_typen = 'RSLT';
        }
        elseif($sig_type==6){
            $sig_typen = 'MHPRPT';
        }
            
        //$event_url = $this->input->post('event_url');
	//$u_id = $this->session->userdata('u_id');

            $insert_data = array(
                'type' => $sig_typen,
                'group' => $sig_type,
                'name' => $sig_name,
                'position' => $sig_position,
                'date_admitted' => $sig_admi,
                'date_commence' => $sig_comen
                //'created_by'=> $u_id,
		//'created_on' => date("Y-m-d H:i:s", now())
            );
            $update_data = array(
                'group' => $sig_type,
                'name' => $sig_name,
                'position' => $sig_position,
                'date_admitted' => $sig_admi,
                'date_commence' => $sig_comen
		//'updated_by'=> $u_id,
            );
			if (empty($sign_id)) {
				$this->db->insert('cfg_common', $insert_data);                                
                                //$this->logger->systemlog('Manage Events', 'Success', 'Event Added Successfully.', date("Y-m-d H:i:s", now()));
			}
			else {
				$this->db->where('id', $sign_id);
				$this->db->update('cfg_common', $update_data);
                                //$this->logger->systemlog('Manage Events', 'Success', 'Event Updated Successfully.', date("Y-m-d H:i:s", now()));
			}
			redirect('company?tab_id=authority');
    }

    function get_authority(){
            $this->db->select("id");
            $this->db->select("type");
            $this->db->select("name");
            $this->db->select("position");
            $this->db->select("date_admitted");
            $this->db->select("date_commence");
            $this->db->select("group");
            $this->db->from('cfg_common');
            $query = $this->db->get();
            return $query->result_array();
    }

    function delete_autho($sign_id)
    {
      $this->db->where('id', $sign_id);
      $this->db->delete('cfg_common');
    } 


    function get_user_centers()
    {
        $user_group = $this->session->userdata('u_ugroup');
        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $user_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }


    function get_center_admin_centers()
    {

        $user_group = $this->session->userdata('u_ugroup');

        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $user_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }
    
    
    function get_all_admin_centers()
    {

        $this->db->select('*');
        $user_centers = $this->db->get('cfg_branch')->result_array();

        return $user_centers;
    }
    
    
    function load_result_courses($center){
        $this->db->select('*');
        $this->db->join('edu_center_course ecc', 'ecc.course_id = ec.id');
        $this->db->where('ecc.center_id', $center);
        $this->db->group_by('ec.course_code');
        $this->db->group_by('ec.course_name');
        $res_courses = $this->db->get('edu_course ec')->result_array();
        
        return $res_courses;
    }
    
    
    function load_result_years($course){
        $this->db->select('*');
        $this->db->where('ey.course_id', $course);
        $res_years = $this->db->get('edu_year ey')->result_array();
        
        return $res_years;
    }
    
    
    
    function search_exams_for_results($data)
    {
        $this->db->select('*, ex.id as exam_id, se.id as sem_exm_id');
        $this->db->join('exm_exam ex', 'ex.id = se.exam_id');
        $this->db->where('se.course_id', $data['course']);
        $this->db->where('se.year_no', $data['year']);
        $this->db->where('se.is_approved', 1);
        
        $result_array = $this->db->get('exm_semester_exam se')->result_array();
        return $result_array;
    }

    
    function update_release_result_exm_status($data)
    {

        $effective_date = null;
        if($data['btn_checked']){
            $effective_date =date("Y-m-d H:i:s", now());
        }
        
        $update_data = array(
            'release_result' => $data['btn_checked'],
            'effective_date' => $effective_date,
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d H:i:s", now())
        );

            $this->db->where('id', $data['sem_exm_id']);
            $updt_result = $this->db->update('exm_semester_exam', $update_data);

        if ($updt_result == true) {
            $res['status'] = 'success';
            $res['message'] = 'Exam Results Release Status For Reports Updated Successfully!';
            $this->logger->systemlog('Exam Result Release For Reports', 'Success', 'Exam Results Release Status For Reports Updated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        } else {
            $res['status'] = 'failed';
            $res['message'] = 'Failed To Update Release Exam Results Status. Retry!';
            $this->logger->systemlog('Exam Result Release For Reports', 'Failure', 'Failed To Update Release Exam Results Status For Reports.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        }

        return $res;
    }
    
    
    
    function update_release_result_exm_status_for_web($data)
    {
        $effective_date = null;
        if($data['btn_checked']){
            $effective_date =date("Y-m-d H:i:s", now());
        }

        $update_data = array(
            'release_result_web' => $data['btn_checked'],
            'effective_date_web' => $effective_date,
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d H:i:s", now())
        );

            $this->db->where('id', $data['sem_exm_id']);
            $updt_result = $this->db->update('exm_semester_exam', $update_data);

        if ($updt_result == true) {
            $res['status'] = 'success';
            $res['message'] = 'Exam Results Release Status for Web Updated Successfully!';
            $this->logger->systemlog('Exam Result Release For Web', 'Success', 'Exam Results Release Status For Web Updated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        } else {
            $res['status'] = 'failed';
            $res['message'] = 'Failed To Update Release Exam Results Status for Web. Retry!';
            $this->logger->systemlog('Exam Result Release For Web', 'Failure', 'Failed To Update Release Exam Results Status For Web.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        }

        return $res;
    }

    function get_online_registration_flag(){
        $this->db->select('hide_show_element');
        $row_array = $this->db->get('cfg_company')->row_array();
        if(!empty($row_array)){
            foreach ($row_array as $flag){
                if($flag == null){
                    $reg_flag = 0;
                } else {
                    $reg_flag = $flag;
                }
            }
        } else {
            $reg_flag = 0;
        }
        
        return $reg_flag;
    }
    
    function set_online_registration_flag($data)
    {

        $update_data = array(
            'hide_show_element' => $data['btn_checked']
        );

            $this->db->where('comp_id', 1);
            $updt_result = $this->db->update('cfg_company', $update_data);

        if ($updt_result == true) {
            $res['status'] = 'success';
            $res['message'] = 'Online Registration Status Updated Successfully!';
            $this->logger->systemlog('Online Registration Status', 'Success', 'Online Registration Status For Web Updated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        } else {
            $res['status'] = 'failed';
            $res['message'] = 'Failed To Update Release Exam Results Status for Web. Retry!';
            $this->logger->systemlog('Online Registration Status', 'Failure', 'Failed To Update Online Registration Status.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));

        }

        return $res;
    }
}
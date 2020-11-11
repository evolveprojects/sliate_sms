<?php
class Timetable_model extends CI_model {

function load_courses()
{
	$this->db->where('deleted',0);
	$courses = $this->db->get('edu_course')->result_array();

	return $courses;
}

function load_years()
{
	$this->db->where('course_id',$this->input->post('tt_course'));
	$this->db->where('deleted',0);
	$years = $this->db->get('edu_year')->row_array();

	return $years['no_of_year'];
}

function load_semester()
{
	$this->db->where('course_id',$this->input->post('tt_course'));
	$this->db->where('deleted',0);
	$years = $this->db->get('edu_year')->row_array();

	$this->db->where('year_id',$years['id']);
	$this->db->where('year_no',$this->input->post('tt_year'));
	$this->db->where('deleted',0);
	$semester = $this->db->get('edu_semester')->row_array();

	return $semester['no_of_semester'];
}

function savetimetbl()
{
	$tt_branch 		= $this->input->post('tt_branch');
    $tt_description = $this->input->post('tt_description');
    $tt_type 		= $this->input->post('tt_type');
    $tt_course 		= $this->input->post('tt_course');
    $tt_year 		= $this->input->post('tt_year');
    $tt_semester 	= $this->input->post('tt_semester');
    $tt_id 			= $this->input->post('tt_id');
    $tt_action 		= $this->input->post('tt_action');
    $tt_clonett		= $this->input->post('tt_clonett');
    $br_code 		= $this->auth->get_brcode($tt_branch);
    $tt_faculty		= $this->input->post('tt_faculty');

    $tblsave['ttbl_faculty'] 	= $tt_faculty;
    $tblsave['ttbl_branch'] 	= $tt_branch;
    $tblsave['ttbl_description']= $tt_description;
    $tblsave['ttbl_type'] 		= $tt_type;
    $tblsave['ttbl_course'] 	= $tt_course;
    $tblsave['ttbl_year'] 		= $tt_year;
    $tblsave['ttbl_semester'] 	= $tt_semester;
    $tblsave['ttbl_status']		= 'A';
	$tblsave['ttbl_isverified']	= 0;
	$tblsave['ttbl_isconfirmed']= 0;

	if(empty($tt_id))
	{
		$tblsave['ttbl_code'] 		= $this->sequence->generate_sequence('TT'.$br_code.date('y'),3);
		$tblsave['ttbl_addedon']	= date("Y-m-d H:i:s", now());
		$tblsave['ttbl_addedby']	= $this->session->userdata('u_id');
		$tblsave['ttbl_addeduname']	= $this->session->userdata('u_name');
		$result = $this->db->insert('tta_timetable',$tblsave);
		$tt_id = $this->db->insert_id();

		if($tt_action=='clone')
		{
			$this->db->where('ttlc_timetable',$tt_clonett);
			$lectures = $this->db->get('tta_lecture')->result_array();

			foreach ($lectures as $lect) 
			{
				$lectsave['ttlc_timetable']		= $tt_id;
				$lectsave['ttlc_subject']		= $lect['ttlc_subject'];
				$lectsave['ttlc_hall']			= $lect['ttlc_hall'];
				$lectsave['ttlc_lecturer']		= $lect['ttlc_lecturer'];
				$lectsave['ttlc_starttime']		= $lect['ttlc_starttime'];
				$lectsave['ttlc_endtime']		= $lect['ttlc_endtime'];
				$lectsave['ttlc_status']		= 'A';
				$lectsave['ttlc_weekday'] 		= $lect['ttlc_weekday'];
				$lectsave['ttlc_addedon']		= date("Y-m-d H:i:s", now());
				$lectsave['ttlc_addedby']		= $this->session->userdata('u_id');
				$lectsave['ttlc_addeduname']	= $this->session->userdata('u_name');
				$result = $this->db->insert('tta_lecture',$lectsave);
			}
		}

		if($result)
		{
			$res['message'] = 'Time Table Created successfully';
        	$this->logger->systemlog('Create Time Table','Success','Time Table Created successfully : '.$tblsave['ttbl_description'],date("Y-m-d H:i:s", now()));
        	$res['status'] = 'success';
		}
		else
		{
			$res['message'] = 'Failed to create Time Table';
        	$this->logger->systemlog('Create Time Table','Failure','Failed to create Time Table : '.$tblsave['ttbl_description'],date("Y-m-d H:i:s", now()));
        	$res['status'] = 'Failed';
		}
	}
	else
	{
		$tblsave['ttbl_updatedby']		= $this->session->userdata('u_id');
		$tblsave['ttbl_updateduname']	= $this->session->userdata('u_name');
		$this->db->where('ttbl_id',$tt_id);
		$result = $this->db->update('tta_timetable',$tblsave);

		if($result)
		{
			$res['message'] = 'Time Table Updated successfully';
        	$this->logger->systemlog('Update Time Table','Success','Time Table Updated successfully : '.$tblsave['ttbl_description'],date("Y-m-d H:i:s", now()));
        	$res['status'] = 'success';
		}
		else
		{
			$res['message'] = 'Failed to update Time Table';
        	$this->logger->systemlog('Update Time Table','Failure','Failed to update Time Table : '.$tblsave['ttbl_description'],date("Y-m-d H:i:s", now()));
        	$res['status'] = 'Failed';
		}
	} 
	$res['tt_id'] = $tt_id;
	return $res;  
}

function load_timetable_data()
{
	$id = $this->input->post('id');

	$this->db->where('ttbl_id',$id);
	$tbl = $this->db->get('tta_timetable')->row_array();

	return $tbl;
}

function load_lectureslist()
{
	$id = $this->input->post('id');
	$weekdary = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');

	$lectbyday = array();

	$i = 0;
	foreach ($weekdary as $day) 
	{
		$this->db->select('tta_lecture.*,mod_subject.code,mod_subject.subject,cfg_hall.hall_name,sta_lecturer_details.stf_fname,sta_lecturer_details.stf_lname');
		$this->db->join('mod_subject','mod_subject.id=tta_lecture.ttlc_subject');
		$this->db->join('cfg_hall','cfg_hall.id=tta_lecture.ttlc_hall');
		$this->db->join('sta_lecturer_details','sta_lecturer_details.stf_id=tta_lecture.ttlc_lecturer');
		$this->db->where('ttlc_timetable',$id);
		$this->db->where('ttlc_weekday',$day);
		$this->db->order_by('ttlc_starttime');
		$lectlist = $this->db->get('tta_lecture')->result_array();

		$x = 0;
		foreach ($lectlist as $lect) 
		{
			$start = date('g:i A', $lect['ttlc_starttime']);
			$end = date('g:i A', $lect['ttlc_endtime']);

			$lectlist[$x]['ttlc_starttime'] = $start;
			$lectlist[$x]['ttlc_endtime'] = $end;
			$x++;
		}

		// $sortedlist = array();

		// foreach ($lectlist as $lect) 
		// {
		// 	if($lect[''])
		// }
		$lectbyday[$i]['day'] = substr($day,0,3);
		$lectbyday[$i]['lectlist'] = $lectlist;
		$i++;
	}

	return $lectbyday; 
}

function load_subjects()
{
	$tt_semester = $this->input->post('tt_semester');
	$tt_course = $this->input->post('tt_course');
	$tt_year = $this->input->post('tt_year');

	$this->db->where('course_id',$tt_course);
	$this->db->where('deleted',0);
	$years = $this->db->get('edu_year')->row_array();

	$this->db->where('year_id',$years['id']);
	$this->db->where('year_no',$tt_year);
	$this->db->where('deleted',0);
	$semester = $this->db->get('edu_semester')->row_array();

	$this->db->select('mod_subject.*');
	$this->db->join('mod_subject_group_subject','mod_subject_group_subject.subject_group_id=mod_semester_subject.subject_group_id');
	$this->db->join('mod_subject','mod_subject.id=mod_subject_group_subject.subject_id');
	$this->db->where('mod_semester_subject.semester_id',$semester['id']);
	$this->db->where('mod_semester_subject.semester_no',$tt_semester);
	$this->db->group_by("mod_subject.id");
	$subs = $this->db->get('mod_semester_subject')->result_array();

	return $subs;
}

function load_halls()
{
	$id = $this->input->post('tt_branch');

	$this->db->where('center_id',$id);
	$halls = $this->db->get('cfg_hall')->result_array();

	return $halls;
}

function load_lecturers()
{
	$id = $this->input->post('sub');

	$this->db->select('sta_lecturer_details.*');
	// $this->db->join('mod_subject_group_subject','mod_subject_group_subject.subject_group_id=sta_lecturer_subject.subject_group_id');
	$this->db->join('sta_lecturer_details','sta_lecturer_details.stf_id=sta_lecturer_subject.lecturer_id');
	$this->db->where('sta_lecturer_subject.subject_id',$id);
	// $this->db->group_by("mod_subject.id");
	$lecs = $this->db->get('sta_lecturer_subject')->result_array();

	return $lecs;
}

function save_lecture()
{
	$lect_id       = $this->input->post('lect_id');
    $lect_subject  = $this->input->post('lect_subject');
    $lect_hall     = $this->input->post('lect_hall');
    $lect_lecturer = $this->input->post('lect_lecturer');
    $lect_starttime= $this->input->post('lect_starttime');
    $lect_endtime  = $this->input->post('lect_endtime');
    $tt_id         = $this->input->post('tt_id');
    $displaytxt	   = $this->input->post('displaytxt');
    $tt_weekday	   = $this->input->post('tt_weekday');

	$lectsave['ttlc_timetable']		= $tt_id;
	$lectsave['ttlc_subject']		= $lect_subject;
	$lectsave['ttlc_hall']			= $lect_hall;
	$lectsave['ttlc_lecturer']		= $lect_lecturer;
	$lectsave['ttlc_starttime']		= strtotime($lect_starttime);
	$lectsave['ttlc_endtime']		= strtotime($lect_endtime);
	$lectsave['ttlc_status']		= 'A';
	$lectsave['ttlc_weekday'] 		= $tt_weekday;

	if(empty($lect_id))
	{
		$lectsave['ttlc_addedon']	= date("Y-m-d H:i:s", now());
		$lectsave['ttlc_addedby']	= $this->session->userdata('u_id');
		$lectsave['ttlc_addeduname']= $this->session->userdata('u_name');
		$result = $this->db->insert('tta_lecture',$lectsave);
		
		if($result)
		{
			$lect_id = $this->db->insert_id();
			$res['message'] = 'Lecture added successfully';
        	$this->logger->systemlog('Add Lecture','Success','Lecture added successfully : '.$displaytxt,date("Y-m-d H:i:s", now()));
        	$res['status'] = 'success';
		}
		else
		{
			$res['message'] = 'Failed to add Lecture';
        	$this->logger->systemlog('Add Lecture','Failure','Failed to add Lecture : '.$displaytxt,date("Y-m-d H:i:s", now()));
        	$res['status'] = 'Failed';
		}
	}
	else
	{
		$lectsave['ttlc_updatedby']		= $this->session->userdata('u_id');
		$lectsave['ttlc_updateduname']	= $this->session->userdata('u_name');
		$this->db->where('ttlc_id',$lect_id);
		$result = $this->db->update('tta_lecture',$lectsave);

		if($result)
		{
			$res['message'] = 'Lecture Edited successfully';
        	$this->logger->systemlog('Edit Lecture','Success','Lecture Edited successfully : '.$displaytxt,date("Y-m-d H:i:s", now()));
        	$res['status'] = 'success';
		}
		else
		{
			$res['message'] = 'Failed to Edit Lecture';
        	$this->logger->systemlog('Edit Lecture','Failure','Failed to Edit Lecture : '.$displaytxt,date("Y-m-d H:i:s", now()));
        	$res['status'] = 'Failed';
		}
	} 

	return $res;  
}

function load_finalized_timetables()
{
	$authbranch = $this->auth->get_accessbranch();
	$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
	// $this->db->where('',1);
	$this->db->select('tta_timetable.*,edu_course.course_code,edu_course.course_code,cfg_branch.br_name');
	$this->db->join('edu_course','edu_course.id=tta_timetable.ttbl_course');
	$this->db->join('cfg_branch','cfg_branch.br_id=tta_timetable.ttbl_branch');
	$this->db->where_in('tta_timetable.ttbl_branch',$authbranch);
	$this->db->where_in('tta_timetable.ttbl_faculty',$faclist);
	$timetables = $this->db->get('tta_timetable')->result_array();

	return $timetables;
}

function verify_timetable()
{
	$id   = $this->input->post('id');
	$desc = $this->input->post('desc');

	$this->db->where('ttbl_id',$id);
	$result = $this->db->update('tta_timetable',array('ttbl_isverified'=>1));

	if($result)
	{
		$res['message'] = 'Time Table verified successfully';
    	$this->logger->systemlog('Edit Lecture','Success','Time Table : '.$desc.' verified successfully',date("Y-m-d H:i:s", now()));
    	$res['status'] = 'success';
	}
	else
	{
		$res['message'] = 'Failed to verify Time Table';
    	$this->logger->systemlog('Edit Lecture','Failure','Failed to verify Time Table : '.$desc,date("Y-m-d H:i:s", now()));
    	$res['status'] = 'Failed';
	}

	return $res;
}

function confirm_timetable()
{
	$id   = $this->input->post('id');
	$desc = $this->input->post('desc');

	$this->db->where('ttbl_id',$id);
	$result = $this->db->update('tta_timetable',array('ttbl_isconfirmed'=>1));

	if($result)
	{
		$res['message'] = 'Time Table confirmed successfully';
    	$this->logger->systemlog('Edit Lecture','Success','Time Table : '.$desc.' confirmed successfully',date("Y-m-d H:i:s", now()));
    	$res['status'] = 'success';
	}
	else
	{
		$res['message'] = 'Failed to confirm Time Table';
    	$this->logger->systemlog('Edit Lecture','Failure','Failed to confirm Time Table : '.$desc,date("Y-m-d H:i:s", now()));
    	$res['status'] = 'Failed';
	}

	return $res;
}

function load_lecture_timeslot()
{
	$id = $this->input->post('id');

	$this->db->where('ttlc_id',$id);
	$lects = $this->db->get('tta_lecture')->row_array();

	$start = date('g:i A', $lects['ttlc_starttime']);
	$end = date('g:i A', $lects['ttlc_endtime']);

	$lects['ttlc_starttime'] = $start;
	$lects['ttlc_endtime'] = $end;

	return $lects;
}

function delete_lecture()
{
	$id   = $this->input->post('id');

	$this->db->where('ttlc_id',$id);
	$result = $this->db->delete('tta_lecture');

	if($result)
	{
		$res['message'] = 'Lecture Removed successfully';
    	$this->logger->systemlog('Remove Lecture','Success','Lecture : '.$id.' removed successfully',date("Y-m-d H:i:s", now()));
    	$res['status'] = 'success';
	}
	else
	{
		$res['message'] = 'Failed to Remove Lecture';
    	$this->logger->systemlog('Remove Lecture','Failure','Failed to remove Lecture : '.$id,date("Y-m-d H:i:s", now()));
    	$res['status'] = 'Failed';
	}

	return $res;
}

function assign_time_table()
{
	$tt_branch 		= $this->input->post('tt_branch');
    $tt_course 		= $this->input->post('tt_course');
    $tt_year 		= $this->input->post('tt_year');
    $tt_semester 	= $this->input->post('tt_semester');
    $tt_id 			= $this->input->post('assi_timetable');
    $startdate 		= $this->input->post('startdate');
    $enddate		= $this->input->post('enddate');
    $tt_faculty		= $this->input->post('tt_faculty');

	$assi['ttas_type']		= 'L';
	$assi['ttas_branch']	= $tt_branch;
	$assi['ttas_course']	= $tt_course;
	$assi['ttas_year']		= $tt_year;
	$assi['ttas_semester']	= $tt_semester;
	$assi['ttas_startdate']	= $startdate;
	$assi['ttas_enddate']	= $enddate;
	$assi['ttas_timetable']	= $tt_id;
	$assi['ttas_status']	= 'A';
	$assi['ttas_faculty']	= $tt_faculty;

	$result = $this->db->insert('tta_assign',$assi);
	return $result;
}

function get_startdate()
{
	$tt_branch 		= $this->input->post('tt_branch');
    $tt_course 		= $this->input->post('tt_course');
    $tt_year 		= $this->input->post('tt_year');
    $tt_semester 	= $this->input->post('tt_semester');
    $tt_tmtbl 		= $this->input->post('tt_tmtbl');

    $this->db->where('ttas_branch',$tt_branch);
    $this->db->where('ttas_course',$tt_course);
    $this->db->where('ttas_year',$tt_year);
    $this->db->where('ttas_semester',$tt_semester);
    // $this->db->where('ttas_timetable',$tt_tmtbl);
    $this->db->where('ttas_status','A');
    $this->db->where('ttas_type','L');
    $this->db->order_by('ttas_enddate',"desc");
    $this->db->limit(1);
    $assilast = $this->db->get('tta_assign')->row_array();

    $start_date = '';
    
    if(!empty($assilast))
    {
    	$start_date = date("Y-m-d", strtotime("+1 day", strtotime($assilast['ttas_enddate'])));
    }

    return $start_date;
}

function load_assined_timetables()
{
	$srch_branch      = $this->input->post('srch_branch');
    $srch_course      = $this->input->post('srch_course');
    $srch_year        = $this->input->post('srch_year');
    $srch_semester    = $this->input->post('srch_semester');
    // $srch_table       = $this->input->post('srch_table');
    // $srch_startdate   = $this->input->post('srch_startdate');
    // $srch_enddate     = $this->input->post('srch_enddate');
    $srch_faculty     = $this->input->post('srch_faculty');

    $branchlist = $this->auth->get_accessbranch();

    if(!empty($srch_branch))
    {
    	$faclist = $this->auth->get_accessfaculties($branch=array($srch_branch),'ID_ARY');
    }
    else
    {
    	$faclist = $this->auth->get_accessfaculties($branchlist,'ID_ARY');
    }


	$this->db->select('tta_timetable.*,edu_course.course_code,edu_course.course_code,cfg_branch.br_name');
	$this->db->join('edu_course','edu_course.id=tta_timetable.ttbl_course');
	$this->db->join('cfg_branch','cfg_branch.br_id=tta_timetable.ttbl_branch');

    if(!empty($srch_branch))
    {
    	$this->db->where('tta_timetable.ttbl_branch',$srch_branch);
    }
    else
    {
    	$this->db->where_in('tta_timetable.ttbl_branch',$branchlist);
    }

    if(!empty($srch_faculty))
    {
    	$this->db->where('tta_timetable.ttbl_faculty',$srch_faculty);
    }
    else
    {
    	$this->db->where_in('tta_timetable.ttbl_faculty',$faclist);
    }
   
   	if(!empty($srch_course))
    {
    	$this->db->where('tta_timetable.ttbl_course',$srch_course);
    }

    if(!empty($srch_year))
    {
    	$this->db->where('tta_timetable.ttbl_year',$srch_year);
    }

    if(!empty($srch_semester))
    {
    	$this->db->where('tta_timetable.ttbl_semester',$srch_semester);
    }
    
    // if(!empty($srch_table))
    // {
    // 	$this->db->where('ttbl_id',$srch_table);
    // }
   
    $this->db->where('ttbl_isconfirmed',1);
    $timetables = $this->db->get('tta_timetable')->result_array();

    $x = 0;
    foreach ($timetables as $tbl) 
    {
    	// if(!empty($srch_startdate) && empty($srch_enddate))
    	// {
    	// 	$this->db->where('ttas_startdate >=',$srch_startdate);
    	// }

    	// if(!empty($srch_startdate))
	    // {
	    // 	$this->db->where('ttas_startdate <=',$srch_startdate);
	    // }

	    // if(!empty($srch_enddate))
	    // {
	    // 	$this->db->where('ttas_enddate >=',$srch_enddate);
	    // }

    	$this->db->where('ttas_timetable',$tbl['ttbl_id']);
    	$assilist = $this->db->get('tta_assign')->result_array();

    	$timetables[$x]['assilist'] = $assilist;
    	$x++;
    }

    return $timetables;
}

function load_courses_list()
{
	//$this->db->where('faculty_id',$this->input->post('id'));
	$courses = $this->db->get('edu_course')->result_array();

	return $courses;
}
}
<?php
class Hci_student_model extends CI_model 
{

function load_student()
{
	

    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    $stat = $_POST['stat'];

    $this->db->select('*');
    if($stat == 'r')
    {
        $this->db->where('st_status','R');
    }  
    else if($stat == 'l')
    {
        $this->db->where('st_status','L');
    }

    if(!empty($_POST['search']['value']))
    {
    	for($i=0 ; $i<count($_POST['columns']);$i++){
	        if($_POST['columns'][$i]['data']!='actions')
            {
                $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
                if($i==0)
                {
                    $this->db->like($column,$_POST['search']['value']);
                }
                else
                {
                    if($column == 'stu_name')
                    {
                        $this->db->or_like("CONCAT_WS(' ', family_name, other_names)",$_POST['search']['value']);
                    } 
                    else
                    {
                        $this->db->or_like($column,$_POST['search']['value']);
                    }                   
                }
            }
	    }

	    $this->db->where('id >=',$start);
    }
    else
    {
    	$this->db->where('id >=',$start); 
    }
    

    $this->db->limit($length);
    $this->db->order_by($orderBy,$orderType);
    if($stat == 'p')
    {
        $reg_stu = $this->db->get('st_details_temp')->result_array();
        $reftbl = 'dt';
    }
    else
    {
        $reg_stu = $this->db->get('st_details')->result_array();
        $reftbl = 'd';
    }

    $x = 0;
    foreach ($reg_stu as $stu) 
    {
        $reg_stu[$x]['actions'] = '<div class="btn-row"><div class="btn-group">'.
                                    '<button type="button" class="btn btn-primary btn-xs" onclick="event.preventDefault();load_stuprofview('.$stu['id'].',\''.$reftbl.'\')">view Profile</button>'.
                                    '<div class="btn-group">'.
                                    '<button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">'.
                                    'Actions'.
                                    '<span class="caret"></span>'.
                                    '</button>'.
                                    '<ul class="dropdown-menu">'.
                                    '<li><a href="#" onclick="event.preventDefault();load_stueditview('.$stu['id'].',\''.$reftbl.'\')">Edit</a></li>'.
                                    '<li><a href="#" onclick="event.preventDefault();load_assigngrade('.$stu['id'].',\''.$reftbl.'\')">Assign Grade</a></li>'.
                                    '<li><a href="#" onclick="event.preventDefault();load_paymentinfo('.$stu['id'].',\''.$reftbl.'\')">Payment Info</a></li>'.
                                    '<li><a href="#" onclick="event.preventDefault();load_sturegister('.$stu['id'].',\''.$reftbl.'\')">Register</a></li>'.
                                    '</ul>'.
                                    '</div>'.
                                    '</div></div>';

        $reg_stu[$x]['stu_name'] = $stu['family_name']." ".$stu['other_names'];
        $x++;
    }

    if(!empty($_POST['search']['value']))
    {
    	for($i=0 ; $i<count($_POST['columns']);$i++){
            if($_POST['columns'][$i]['data']!='actions')
            {
    	        $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
    	        if($i==0)
    	        {
    	        	$this->db->like($column,$_POST['search']['value']);
    	        }
    	       	else
    	       	{
    	       		if($column == 'stu_name')
                    {
                        $this->db->or_like("CONCAT_WS(' ', family_name, other_names)",$_POST['search']['value']);
                    } 
                    else
                    {
                        $this->db->or_like($column,$_POST['search']['value']);
                    } 
    	       	}
            }
	    }

	    $this->db->where('id >=',$start);
    }
    if($stat == 'r')
    {
        $this->db->where('st_status','R');
    }  
    else if($stat == 'l')
    {
        $this->db->where('st_status','L');
    }
    $this->db->order_by('id','DESC');
    $this->db->limit(1);

    if($stat == 'p')
    {
        $all_stu = $this->db->get('st_details_temp')->result_array();
    }
    else
    {
        $all_stu = $this->db->get('st_details')->result_array();
    }

    $count = $all_stu[0]['id'];

    // $data = array();
    // foreach ($reg_stu as $stu ) 
    // {
    //     $data[] = $row ;
    // }

	$output = array(
                "draw" => intval($draw),
			    "recordsTotal" => $count,
			    "recordsFiltered" => $count,
			    "data" => $reg_stu
            );

    return $output;
}

function load_student_data()
{
    $id = $this->input->get('id');
    $rt = $this->input->get('rt');

    $this->db->where('id',$id);
    if($rt == 'dt')
    {
        $studata = $this->db->get('st_details_temp')->row_array();
    }
    else
    {
        $studata = $this->db->get('st_details')->row_array();
    }

    $this->db->select('es_family');
    if($rt == 'dt')
    {
        $this->db->where('hci_sibling.es_reftable','st_details_temp');
    }
    else
    {
        $this->db->where('hci_sibling.es_reftable','st_details');
    }
    $this->db->where('es_admissionid',$id);
    $family = $this->db->get('hci_sibling')->row_array();

    if(!empty($family))
    {
        $this->db->select('hci_sibling.*,st_details.other_names,st_details.family_name');
        $this->db->join('st_details','st_details.id=hci_sibling.es_admissionid');
        $this->db->where('hci_sibling.es_reftable','st_details');
        $this->db->where('hci_sibling.es_family',$family['es_family']);
        $this->db->where('hci_sibling.es_admissionid !=',$id);
        $this->db->order_by('hci_sibling.es_seqnumber');
        $siblings = $this->db->get('hci_sibling')->result_array(); 

        $firstsib = null;
        foreach ($siblings as $sib) 
        {
            $sibary[] = $sib['es_admissionid'];
            if($sib['es_seqnumber']==1)
            {
                $firstsib = $sib['es_admissionid'];
            }
        }
        $famseq = count($sibary)+1;

        $this->db->select('st_feestructure');
        $this->db->where('id',$firstsib);
        $fsfees = $this->db->get('st_details')->row_array();

        if($fsfees['st_feestructure']==$studata['st_feestructure'])
        {
            $feesary = array(0,$fsfees['st_feestructure']);
        }
        else
        {
            $feesary = array(0,$fsfees['st_feestructure'],$studata['st_feestructure']);
        }
    }
    else
    {
        $siblings = null;
        $sibary = array();
        $firstsib = null;
        $famseq   = 1;
        $feesary = array(0,$studata['st_feestructure']);
    }

    $this->db->where('spp_student',$id);
    if($rt == 'dt')
    {
        $this->db->where('spp_reftable','st_details_temp');
    }
    else
    {
        $this->db->where('spp_reftable','st_details');
    }
    $this->db->where('spp_status','A');
    $payplans = $this->db->get('hci_stupaymentplan')->result_array();

    $discounts = array();

    $this->db->select('hci_adjusment.*');;
    $this->db->join('hci_adjstemplate','hci_adjstemplate.at_adjusment=hci_adjusment.adj_id'); 
    if ($famseq>=4) 
    {
        $this->db->where('hci_adjstemplate.at_applyfor',4);
    }
    else
    {
         $this->db->where('hci_adjstemplate.at_applyfor',$famseq);
    }
    $sibdiscounts = $this->db->get('hci_adjusment')->result_array();

    foreach ($sibdiscounts as $sibd) 
    {
        array_push($discounts,$sibd);
    }

    $this->db->select('hci_adjusment.*');;
    $this->db->join('hci_adjstemplate','hci_adjstemplate.at_adjusment=hci_adjusment.adj_id'); 
    $this->db->where('hci_adjstemplate.at_applyfor',5);
    $this->db->where_in('hci_adjstemplate.at_feestructure',$feesary);
    $fsdiscounts = $this->db->get('hci_adjusment')->result_array();

    foreach ($fsdiscounts as $fsd) 
    {
        array_push($discounts,$fsd);
    }

    $i = 0;
    foreach ($discounts as $disc) 
    {
        $this->db->where('ats_student',$id);
        if($rt == 'dt')
        {
            $this->db->where('ats_reftable','st_details_temp');
        }
        else
        {
            $this->db->where('ats_reftable','st_details');
        }
        $this->db->where('ats_adjstemp',$disc['adj_id']);
        $this->db->where('ats_status','A');
        $studisc = $this->db->get('hci_adjsstudent')->row_array();

        if(empty($studisc))
        {
            $discounts[$i]['isselected'] = 0;
        }
        else
        {
            $discounts[$i]['isselected'] = 1;           
        }
        $i++;
    }

    $all = array(
        "stu_data" => $studata,
        "siblings" => $sibary,
        "payplans" => $payplans,
        "discounts" => $discounts
        );
    return $all;
}

function update_student_info()
{
    $ref_t        = $this->input->post('ref_t');
    $id           = $this->input->post('id');
    $sibilins     = $this->input->post('es_sibiling');
    $discountschk = $this->input->post('discountschk');
    $pplan        = $this->input->post('pplan');
    $today= date("Y-m-d");

    $this->db->trans_begin();

    $this->db->where('int_start <=',$today);
    $this->db->where('int_end >=',$today);
    $intake = $this->db->get('stu_intake')->row_array();

    $updatedata['other_names']  = $this->input->post('other_names');
    $updatedata['family_name']  = $this->input->post('family_name');
    $updatedata['st_gender']    = $this->input->post('st_gender');
    $updatedata['dob']      = $this->input->post('dob');    
    $updatedata['st_religion']  = $this->input->post('st_religion');
    $updatedata['citizenship']  = $this->input->post('citizenship');
    $updatedata['passport']     = $this->input->post('passport');
    $updatedata['issue']    = $this->input->post('issue');
    $updatedata['language'] = $this->input->post('language');
    $updatedata['lang_home']    = $this->input->post('lang_home');   
    $updatedata['mom_name'] = $this->input->post('mom_name');
    $updatedata['mom_addy'] = $this->input->post('mom_addy');
    $updatedata['mom_add2'] = $this->input->post('mom_add2');
    $updatedata['mom_addcity']  = $this->input->post('mom_addcity');
    $updatedata['mom_home']     = $this->input->post('mom_home');
    $updatedata['mom_mobile']   = $this->input->post('mom_mobile');
    $updatedata['mom_email']    = $this->input->post('mom_email');
    $updatedata['dad_name'] = $this->input->post('dad_name');
    $updatedata['dad_addy'] = $this->input->post('dad_addy');
    $updatedata['dad_add2'] = $this->input->post('dad_add2');
    $updatedata['dad_addcity']  = $this->input->post('dad_addcity');
    $updatedata['dad_home'] = $this->input->post('dad_home');
    $updatedata['dad_mobile']   = $this->input->post('dad_mobile');
    $updatedata['dad_email']    = $this->input->post('dad_email');
    $updatedata['guar_name']    = $this->input->post('guar_name');
    $updatedata['guar_addy']    = $this->input->post('guar_addy');
    $updatedata['guar_add2']    = $this->input->post('guar_add2');
    $updatedata['guar_addcity'] = $this->input->post('guar_addcity');
    $updatedata['guar_home']    = $this->input->post('guar_home');
    $updatedata['guar_mobile']  = $this->input->post('guar_mobile');
    $updatedata['guar_email']   = $this->input->post('guar_email');
    $updatedata['st_infComPerson']  = $this->input->post('st_infComPerson');
    $updatedata['emg_name'] = $this->input->post('emg_name');
    $updatedata['emg_addy'] = $this->input->post('emg_addy');
    $updatedata['emg_add2'] = $this->input->post('emg_add2');
    $updatedata['emg_addcity']  = $this->input->post('emg_addcity');
    $updatedata['emg_home'] = $this->input->post('emg_home');
    $updatedata['emg_mobile']   = $this->input->post('emg_mobile');
    $updatedata['school_age']   = $this->input->post('school_age');
    $updatedata['1sch_name']    = $this->input->post('1sch_name');
    $updatedata['1sch_addy']    = $this->input->post('1sch_addy');
    $updatedata['1sch_add2']    = $this->input->post('1sch_add2');
    $updatedata['1sch_addcity'] = $this->input->post('1sch_addcity');
    $updatedata['1sch_lang']    = $this->input->post('1sch_lang');
    $updatedata['ffrom']    = $this->input->post('ffrom');
    $updatedata['fto']      = $this->input->post('fto');
    $updatedata['st_curgrade'] = $this->input->post('st_curgrade');
    $updatedata['mgt_wd']   = $this->input->post('mgt_wd');
    $updatedata['mgt_exp']  = $this->input->post('mgt_exp');
    $updatedata['int_act']  = $this->input->post('int_act');
    $updatedata['eng_xp']   = $this->input->post('eng_xp');
    $updatedata['eng_sit']  = $this->input->post('eng_sit');
    $updatedata['eng_len']  = $this->input->post('eng_len');
    $updatedata['enr_sped'] = $this->input->post('enr_sped');
    $updatedata['sped_xp']  = $this->input->post('sped_xp');
    $updatedata['med_test'] = $this->input->post('med_test');
    $updatedata['med_xp']   = $this->input->post('med_xp');
    $updatedata['med_dis']  = $this->input->post('med_dis');
    $updatedata['dis_xp']   = $this->input->post('dis_xp');
    $updatedata['dad_aff']  = $this->input->post('dad_aff');
    $updatedata['dad_pos']  = $this->input->post('dad_pos');
    $updatedata['dad_biz_addy'] = $this->input->post('dad_biz_addy');
    $updatedata['dad_biz_tel']  = $this->input->post('dad_biz_tel');
    $updatedata['mom_aff']  = $this->input->post('mom_aff');
    $updatedata['mom_pos']  = $this->input->post('mom_pos');
    $updatedata['mom_biz_addy'] = $this->input->post('mom_biz_addy');
    $updatedata['mom_biz_tel']  = $this->input->post('mom_biz_tel');
    $updatedata['ex_date']  = $this->input->post('ex_date');
    $updatedata['len_stay'] = $this->input->post('len_stay');
    $updatedata['curriculum']   = $this->input->post('curriculum');
    $updatedata['exclude_transport']    = $this->input->post('exclude_transport');
    $updatedata['local_nationality']    = $this->input->post('local_nationality');
    $updatedata['foreign_nationality']  = $this->input->post('foreign_nationality');

    if($ref_t=='dt')
    {
        $updatedata['st_grade'] = $this->input->post('st_grade');
        $updatedata['st_feestructure'] = $this->input->post('st_feestructure');
        $updatedata['st_addpaymethod'] = $this->input->post('st_addpaymethod');
        $updatedata['entered_date'] = $today;
        $updatedata['st_intake'] = $intake['int_id'];

        $this->db->where('id',$id);
        $this->db->update('st_details_temp',$updatedata);

        //-----------------------------siblings----------------

        if(!empty($sibilins))
        {
            $this->db->where('es_reftable','st_details');
            $this->db->where_in('es_admissionid',$sibilins);
            $family = $this->db->get('hci_sibling')->result_array();

            $tot_families = $this->db->count_all('hci_stfamily');

            if(empty($family))
            {
                $this->db->insert('hci_stfamily',array("sf_num"=>($tot_families+1)));
                $family_id = $this->db->insert_id();
            }
            else
            {
                $family_id = $family[0]['es_family'];
            }

            //array_push($sibilins,$new_stu);

            sort($sibilins);

            foreach ($sibilins as $key => $ns) 
            {
                $this->db->where('es_reftable','st_details');
                $this->db->where('es_admissionid',$ns);
                $sibls = $this->db->get('hci_sibling')->row_array();

                $siblins_save['es_family'] = $family_id;
                $siblins_save['es_admissionid'] = $ns;
                $siblins_save['es_seqnumber'] = $key+1;
                $siblins_save['es_reftable'] = 'st_details';

                // if($process_name=="register")
                // {
                //     $siblins_save['es_reftable'] = 'st_details';
                // }
                // else
                // {
                //     $siblins_save['es_reftable'] = 'st_details_temp';
                // }

                if(empty($sibls))
                {
                    $this->db->insert('hci_sibling',$siblins_save);
                }
            }

            $this->db->where('es_reftable','st_details_temp');
            $this->db->where('es_admissionid',$id);
            $stuinfamily = $this->db->get('hci_sibling')->row_array();

            $add_tosib['es_family'] = $family_id;
            $add_tosib['es_seqnumber'] = count($sibilins)+1;
            $add_tosib['es_reftable'] = 'st_details_temp';

            if(empty($stuinfamily))
            {
                $add_tosib['es_admissionid'] = $id;
                $this->db->insert('hci_sibling',$add_tosib);
                $stufamid = $this->db->insert_id();
            }
            else
            {
                $this->db->where('es_reftable','st_details_temp');
                $this->db->where('es_admissionid',$id);
                $this->db->update('hci_sibling',$add_tosib);
                $stufamid = $stuinfamily['es_sibilingid'];
            }
        }

        if(isset($_POST['regi_btn']))
        {          
            $updatedata['st_status'] = 'R';
            
            $this->db->insert('st_details',$updatedata);
            $new_stu=$this->hci_studentreg_model->last_insert;

            //---------------------------------- stu id

            $this->db->where('ac_iscurryear',1);
            $acc_year = $this->db->get('cfg_academicyears')->row_array();

            $this->db->where('grd_id',$updatedata['st_grade']);
            $grd_data = $this->db->get('hci_grade')->row_array();

            $this->db->where('st_intake',$intake['int_id']);
            $this->db->where('st_grade',$updatedata['st_grade']);
            $int_grd_count = $this->db->count_all_results('st_details');

            $tot_stu_count = $this->db->count_all('st_details');

            $curr_year = date('y', strtotime($acc_year['ac_startdate']));
            $curr_intake = date('m', strtotime($intake['int_start']));
            $grd_code = $grd_data['grd_code'];

            $stu_index = 'MA/'.$curr_year.'/'.$curr_intake.'/'.$grd_code.'-'.($int_grd_count).'/'.($tot_stu_count+94);

            $this->db->where('id',$new_stu);
            $this->db->update('st_details',array('st_id'=>$stu_index));

            //---------------------------sibling reg

            if(!empty($sibilins))
            {
                $up_siblings['es_reftable'] = 'st_details';
                $up_siblings['es_admissionid'] = $new_stu;

                $this->db->where('es_sibilingid',$stufamid);
                $this->db->update('hci_sibling',$up_siblings);
            }
        }
    }
    else
    {
        $this->db->where('id',$id);
        $this->db->update('st_details',$updatedata);
    }

    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        $this->msg->set('admission', "Failed to update data. retry");
    }
    else
    {
        $this->db->trans_commit(); 
        $this->msg->set('admission', "Updated successfully");
    }
}

function load_stubygrade()
{
    $grade = $this->input->post('grd');
    $ayear = $this->input->post('ayear');

    $this->db->select('st_details.*,currgrd.grd_name as "curr",nextgrd.grd_name as "next",nextgrd.grd_id as "next_id"');
    $this->db->join('hci_grade as currgrd','currgrd.grd_id=st_details.st_grade');
    $this->db->join('hci_grade as nextgrd','nextgrd.grd_id=currgrd.grd_promotegrd','left');
    if(!empty($grade))
    {
        $this->db->where('st_details.st_grade',$grade);
    }
    $this->db->where('st_details.st_status','R');
    //$this->db->where('st_details.st_lastpromoted !=',$ayear);
    $stu_list = $this->db->get('st_details')->result_array();

    return $stu_list;
}

function promote_students()
{
    $stu_list = $this->input->post('stuchk');
    $ayear = $this->input->post('ayear');

    $this->db->trans_begin();

    foreach ($stu_list as $stu) 
    {
        $this->db->select('st_details.st_feestructure,st_details.st_addpaymethod,hci_feemaster.fee_aftemp,hci_feemaster.fee_tftemp,st_details.st_grade,hci_grade.grd_promotegrd');
        $this->db->join('hci_feemaster','hci_feemaster.es_feemasterid=st_details.st_feestructure');
        $this->db->join('hci_grade','hci_grade.grd_id=st_details.st_grade');
        $this->db->where('st_details.id',$stu);
        $fs = $this->db->get('st_details')->row_array();

        $currgrd = $fs['st_grade'];
        $nextgrd = $fs['grd_promotegrd'];

        $this->db->where('id',$stu);
        $this->db->update('st_details',array('st_grade'=>$nextgrd,'st_lastpromoted'=>$ayear));

        $gpdata['gp_ayear'] = $ayear;
        $gpdata['gp_student'] = $stu;
        $gpdata['gp_currgrade'] = $currgrd;
        $gpdata['gp_nextgrade'] = $nextgrd;

        $this->db->insert('hci_gradepromo',$gpdata);

        $save_inv['inv_student'] = $stu;
        $save_inv['inv_date'] = date("Y-m-d");;
        $save_inv['inv_status'] = 'P';
        $save_inv['inv_description'] = 'AnnualPromo';
        $this->db->insert('hci_invoice',$save_inv);

        $inv_id = $this->db->insert_id();

        $this->db->where('spp_reftable','st_details');
        $this->db->where('spp_student',$stu);
        $pplans = $this->db->get('hci_stupaymentplan')->result_array();

        foreach ($pplans as $value) {
            $plan_ary[] = $value['spp_paymentplan'];
        }

        if(!empty($fs['st_feestructure']))
        {
            $this->db->where('fsf_grade',$nextgrd);
            $this->db->where('fsf_feetemplate',$fs['fee_aftemp']);
            $af_template = $this->db->get('hci_feestructure_fees')->result_array();

            $this->db->where('fsf_grade',$nextgrd);
            $this->db->where('fsf_feetemplate',$fs['fee_tftemp']);
            $tf_template = $this->db->get('hci_feestructure_fees')->result_array();

            foreach ($af_template as $fee) 
            {
                $save_fee['invf_invoice'] = $inv_id;
                $save_fee['invf_fee'] = $fee['fsf_id'];

                if($fs['st_addpaymethod']==2)
                {
                    $temp_amt = $fee['fsf_slabold'];

                    $this->db->where('plan_fee',$fee['fsf_id']);
                    $this->db->where_in('plan_id',$plan_ary);
                    $fee_plans = $this->db->get('hci_paymentplan')->row_array();
                    
                    if($temp_amt>0)
                    {
                        if($fee_plans['plan_type']=='M')
                        {
                            $save_fee['invf_amount'] = $temp_amt;
                        }
                        else if($fee_plans['plan_type']=='T')
                        {
                            $save_fee['invf_amount'] = $temp_amt;
                        }
                        else
                        {
                            $save_fee['invf_amount'] = $temp_amt*3;
                        }

                        $this->db->insert('hci_invoicefee',$save_fee);
                    }
                }  
            }

            foreach ($tf_template as $fee) 
            {
                $save_fee['invf_invoice'] = $inv_id;
                $save_fee['invf_fee'] = $fee['fsf_id'];
                $save_fee['invf_amount'] = $fee['fsf_amt'];

                $this->db->where('plan_fee',$fee['fsf_id']);
                $this->db->where_in('plan_id',$plan_ary);
                $fee_plans = $this->db->get('hci_paymentplan')->row_array();
                
                if($fee['fsf_amt']>0)
                {
                    if($fee_plans['plan_type']=='M')
                    {
                        $save_fee['invf_amount'] = $fee['fsf_amt'];
                    }
                    else if($fee_plans['plan_type']=='T')
                    {
                        $save_fee['invf_amount'] = $fee['fsf_amt'];
                    }
                    else
                    {
                        $save_fee['invf_amount'] = $fee['fsf_amt']*3;
                    }

                    $this->db->insert('hci_invoicefee',$save_fee);
                }
            }
        }

        $this->db->where('ats_student',$stu);
        $this->db->where('ats_reftable','st_details');
        $discounts =$this->db->get('hci_adjsstudent')->result_array();

        foreach ($discounts  as $disc) 
        {
            $this->db->where('hci_adjstemplate.at_adjusment',$disc['ats_adjstemp']);
            $this->db->join('hci_adjusment','hci_adjusment.adj_id=hci_adjstemplate.at_adjusment');
            $temp_data = $this->db->get('hci_adjstemplate')->row_array();

            $inv_dis['id_invoice']   = $inv_id;
            $inv_dis['id_adjusment'] = $disc['ats_adjstemp'];
            $inv_dis['id_adjstemp']  = $temp_data['at_id'];

            $this->db->insert('hci_stuinvdiscount',$inv_dis);
        }
    }

    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        $this->msg->set('admission', "Failed to process Grade Promotion. retry");
    }
    else
    {
        $this->db->trans_commit(); 
        $this->msg->set('admission', "Grade Promotion processed successfully");
    }
}

function generate_term_invoice()
{
    $stu_list = $this->input->post('stuchk');

    foreach ($stu_list as $stu) 
    {
        $currgrd = $this->input->post('currgrd_'.$stu);
        $nextgrd = $this->input->post('nextgrd_'.$stu);

        $this->db->select('st_feestructure,st_addpaymethod');
        $this->db->where('id',$stu);
        $fs = $this->db->get('st_details')->row_array();

        $this->db->where('fsf_grade',$nextgrd);
        $this->db->where('fsf_feetemplate',$fs['fee_aftemp']);
        $af_template = $this->db->get('hci_feestructure_fees')->result_array();

        $this->db->where('fsf_grade',$nextgrd);
        $this->db->where('fsf_feetemplate',$fs['fee_tftemp']);
        $tf_template = $this->db->get('hci_feestructure_fees')->result_array();

        $save_inv['inv_student'] = $stu;
        $save_inv['inv_date'] = date("Y-m-d");;
        $save_inv['inv_status'] = 'P';
        $this->db->insert('hci_invoice',$save_inv);

        $inv_id = $this->db->insert_id();

        $this->db->where('spp_reftable','st_details');
        $this->db->where('spp_student',$stu);
        $pplans = $this->db->get('hci_stupaymentplan')->result_array();

        foreach ($pplans as $value) {
            $plan_ary[] = $value['spp_paymentplan'];
        }

        foreach ($af_template as $fee) 
        {
            $save_fee['invf_invoice'] = $inv_id;
            $save_fee['invf_fee'] = $fee['fsf_id'];

            if($post['st_addpaymethod']==2)
            {
                $temp_amt = $fee['fsf_slabold'];
            }

            $this->db->where('plan_fee',$fee['fsf_id']);
            $this->db->where_in('plan_id',$plan_ary);
            $fee_plans = $this->db->get('hci_paymentplan')->row_array();
            
            if($temp_amt>0)
            {
                if($fee_plans['plan_type']=='M')
                {
                    $save_fee['invf_amount'] = $temp_amt;
                }
                else if($fee_plans['plan_type']=='T')
                {
                    $save_fee['invf_amount'] = $temp_amt;
                }
                else
                {
                    $save_fee['invf_amount'] = $temp_amt*3;
                }

                $this->db->insert('hci_invoicefee',$save_fee);
            }  
        }

        foreach ($tf_template as $fee) 
        {
            $save_fee['invf_invoice'] = $inv_id;
            $save_fee['invf_fee'] = $fee['fsf_id'];
            $save_fee['invf_amount'] = $fee['fsf_amt'];

            $this->db->where('plan_fee',$fee['fsf_id']);
            $this->db->where_in('plan_id',$plan_ary);
            $fee_plans = $this->db->get('hci_paymentplan')->row_array();
            
            if($fee['fsf_amt']<0)
            {
                if($fee_plans['plan_type']=='M')
                {
                    $save_fee['invf_amount'] = $fee['fsf_amt'];
                }
                else if($fee_plans['plan_type']=='T')
                {
                    $save_fee['invf_amount'] = $fee['fsf_amt'];
                }
                else
                {
                    $save_fee['invf_amount'] = $fee['fsf_amt']*3;
                }

                $this->db->insert('hci_invoicefee',$save_fee);
            }
        }

        $this->db->where('ats_student',$stu);
        $this->db->where('ats_reftable','st_details');
        $discounts =$this->db->get('hci_adjsstudent')->result_array();

        foreach ($discounts  as $disc) 
        {
            $this->db->where('hci_adjstemplate.at_adjusment',$disc);
            $this->db->join('hci_adjusment','hci_adjusment.adj_id=hci_adjstemplate.at_adjusment');
            $temp_data = $this->db->get('hci_adjstemplate')->row_array();

            $inv_dis['id_invoice']   = $inv_id;
            $inv_dis['id_adjusment'] = $disc;
            $inv_dis['id_adjstemp']  = $temp_data['at_id'];

            $this->db->insert('hci_stuinvdiscount',$inv_dis);
        }
    }
}
}
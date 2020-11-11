<?php 
class Hci_feestructure_model extends CI_model {

function save_fee()
{
	$fee_id 	= $this->input->post('fee_id');
	$fee_cat	= $this->input->post('feecat');
	$terms		= $this->input->post('terms');
	$payterms	= $this->input->post('payterms');

	if(isset($_POST['is_main']))
	{
		$save_fee['fc_includeinmain']		= 1;
	}	
	else
	{
		$save_fee['fc_includeinmain']		= 0;
	}

	$save_fee['fc_name']		= $fee_cat;		
	$save_fee['fc_type']		= $payterms;

	if($payterms=='other')
	{
		$save_fee['fc_numofterms']	= $terms;
	}
	
	if(empty($fee_id))	
	{
		$feecatindx = $this->sequence->generate_sequence('FEE',3);
		$save_fee['fc_index'] = $feecatindx;
		$result = $this->db->insert('hci_feecategory',$save_fee);
		$fee_id = $this->db->insert_id();
	}	
	else
	{
		$this->db->where('fc_id',$fee_id);
		$result = $this->db->update('hci_feecategory',$save_fee);
	}

	if($payterms=='other')
	{
		for($x=1; $x<=$terms;$x++)
		{
			$trm_id = $this->input->post('trm_id_'.$x);

			$term_save['fct_fee'] = $fee_id;
			$term_save['fct_term'] = $this->input->post('term_'.$x);
			$term_save['fct_sdate'] = $this->input->post('sdate_'.$x);
			$term_save['fct_smonth'] = $this->input->post('smonth_'.$x);
			$term_save['fct_edate'] = $this->input->post('edate_'.$x);
			$term_save['fct_emonth'] = $this->input->post('emonth_'.$x);

			if(empty($trm_id))
			{
				$result = $this->db->insert('hci_feecatterm',$term_save);
			}
			else
			{
				$this->db->where('fct_id',$trm_id);
				$result = $this->db->update('hci_feecatterm',$term_save);
			}
		}
	}

	return $result;
}

function get_feecats()
{
	$this->db->select('*');
	// $this->db->where('fc_includeinmain',1);
	$fees = $this->db->get('hci_feecategory')->result_array();

	return $fees;
}

function load_fee_templates()
{
	$this->db->select('*');
	$temps = $this->db->get('hci_feetemplate')->result_array();

	return $temps;
}

function load_feestructure_data()
{
	$this->db->select('hci_feemaster.*,at.ft_name as admtemp,ft.ft_name as trmtemp');
	$this->db->join('hci_feetemplate as at', 'hci_feemaster.fee_aftemp = at.ft_id','left');
    $this->db->join('hci_feetemplate as ft', 'hci_feemaster.fee_tftemp = ft.ft_id','left');

	if($_POST['fs_id']!=null)
	{
		$this->db->where('hci_feemaster.es_feemasterid',$_POST['fs_id']);
	}
	else
	{
		$this->db->where('hci_feemaster.fee_iscurrent',1);
	}

	$fs_data = $this->db->get('hci_feemaster')->row_array();



	// $this->db->where_in('fsf_feetemplate',array($fs_data['fee_aftemp'],$fs_data['fee_tftemp']));
	// $fees = $this->db->get('hci_feestructure_fees')->result_array();

	// $all = array(
	// 	'fs_data' => $fs_data,
	// 	'fees' => $fees
	// 	);

	return $fs_data;
}

function save_fee_structure()
{
	$fs_name = $this->input->post('fs_name');
	$eff_date = $this->input->post('eff_date');

	$this->db->trans_begin();

	// if(isset($_POST['new_af']))
	// {
	// 	$this->db->where('ft_feecat', 1);
	// 	$aftemplatecount = $this->db->count_all_results('hci_feetemplate');

	// 	$newaft['ft_name'] = 'AF - '.($aftemplatecount+1);
	// 	$newaft['ft_feecat'] = 1;

	// 	$this->db->insert('hci_feetemplate',$newaft);
	// 	$aftemplid = $this->db->insert_id();
	// }
	// else
	// {
	// 	$aftemplid = $this->db->insert_id();
	// }
	
	if(isset($_POST['new_af']))
	{
		$Af = $this->input->post('Af_name');

		$newaft['ft_name'] = $Af;
		$newaft['ft_feecat'] = 1;

		$this->db->insert('hci_feetemplate',$newaft);
		$aftemplid = $this->db->insert_id();

	}
	else
	{
		$aftemplid = $this->input->post('af_template');
		$Af = $this->input->post('Af_name');

		$edit_af['ft_name'] = $Af;

		$this->db->where('ft_id',$aftemplid);
		$this->db->update('hci_feetemplate',$edit_af);
	}

	if(isset($_POST['new_tf']))
	{
		$Tf = $this->input->post('Tf_name');

		$newtft['ft_name'] = $Tf;
		$newtft['ft_feecat'] = 2;

		$this->db->insert('hci_feetemplate',$newtft);
		$tftemplid = $this->db->insert_id();

	}
	else
	{
		$tftemplid = $this->input->post('tf_template');
		$Tf = $this->input->post('Tf_name');

		$edit_tf['ft_name'] = $Tf;

		$this->db->where('ft_id',$tftemplid);
		$this->db->update('hci_feetemplate',$edit_tf);
	}

	$all_inps = $_POST;
	$all_inp_ary = array_keys($all_inps);

	foreach ($all_inp_ary as $inp) 
	{
		$temp = explode('_', $inp);

		if($temp[0]=='amt')
		{
			$this->db->where('fsf_grade',$temp[1]);
			$this->db->where('fsf_fee',$temp[2]);
			if($temp[2]==1)
			{
				$this->db->where('fsf_feetemplate',$aftemplid);
			}
			else
			{
				$this->db->where('fsf_feetemplate',$tftemplid);
			}
			$feeext = $this->db->get('hci_feestructure_fees')->row_array();

			if($temp[2]==1)
			{
				$save_fsfs['fsf_slabnew'] 	= $this->input->post('amtnew_'.$temp[1].'_'.$temp[2]);
				$save_fsfs['fsf_slabold'] 	= $this->input->post('amtold_'.$temp[1].'_'.$temp[2]);
				$save_fsfs['fsf_feetemplate'] = $aftemplid;
			}
			else
			{
				$save_fsfs['fsf_slabnew'] 	= NULL;
				$save_fsfs['fsf_slabold'] 	= NULL;
				$save_fsfs['fsf_feetemplate'] = $tftemplid;
			}

			$save_fsfs['fsf_amt'] 			= $this->input->post($inp);
			$save_fsfs['fsf_status'] 		= 'A';
			
			if(empty($feeext))
			{
				$save_fsfs['fsf_grade'] 		= $temp[1];
				$save_fsfs['fsf_fee'] 			= $temp[2];
				$this->db->insert('hci_feestructure_fees',$save_fsfs);
			}
			else
			{
				$save_fsfs['fsf_grade'] 		= $temp[1];
				$save_fsfs['fsf_fee'] 			= $temp[2];
				
				$this->db->where('fsf_grade',$temp[1]);
				$this->db->where('fsf_fee',$temp[2]);
				if($temp[2]==1)
				{
					$this->db->where('fsf_feetemplate',$aftemplid);
				}
				else
				{
					$this->db->where('fsf_feetemplate',$tftemplid);
				}
				$this->db->update('hci_feestructure_fees',$save_fsfs);
			}
		}
	}

	$fs_save['fee_description']	= $fs_name;
	$fs_save['fee_status']		= "A";
	$fs_save['fee_effdate']		= $eff_date;
	$fs_save['fee_aftemp']		= $aftemplid;
	$fs_save['fee_tftemp']		= $tftemplid;

	if(isset($_POST['is_curr']))
	{
		$update = $this->db->update('hci_feemaster',array('fee_iscurrent'=>0));
		$fs_save['fee_iscurrent'] = 1;
	}
	else
	{
		$fs_save['fee_iscurrent'] = 0;
	}

	if (isset($_POST['changesbtn'])) {
		$fs_id = $this->input->post('fs_id');
		$this->db->where('es_feemasterid',$fs_id);
		$result = $this->db->update('hci_feemaster',$fs_save);
    }
    else
    {	
		$result = $this->db->insert('hci_feemaster',$fs_save);
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

function load_fee_terms()
{
	$this->db->where('fct_fee',$this->input->post('id'));
	$terms = $this->db->get('hci_feecatterm')->result_array();

	return $terms;

}

function load_active_feestructures()
{
	$this->db->select('hci_feemaster.*,at.ft_name as admtemp,ft.ft_name as trmtemp');
	$this->db->join('hci_feetemplate as at', 'hci_feemaster.fee_aftemp = at.ft_id','left');
    $this->db->join('hci_feetemplate as ft', 'hci_feemaster.fee_tftemp = ft.ft_id','left');
	$this->db->where('hci_feemaster.fee_status','A');
	$feests = $this->db->get('hci_feemaster')->result_array();

	return $feests;
}

function save_feegroups()
{
	$fs_id = $this->input->post('grp_fs');
	$gradegrp = $this->input->post('gradegrp');

	$this->db->trans_begin();

	foreach ($gradegrp as $grade) 
	{
		$temp = explode('_', $grade);

		$this->db->where('fg_fstructure',$fs_id);
		$this->db->where('fg_grade',$temp[0]);
		$isexist = $this->db->get('hci_feegroup')->row_array();

		$fg_save['fg_group'] = $temp[1];

		if(empty($isexist))
		{	
			$fg_save['fg_fstructure'] = $fs_id;
			$fg_save['fg_grade'] = $temp[0];

			$this->db->insert('hci_feegroup',$fg_save);
		}
		else
		{
			$this->db->where('fg_id',$isexist['fg_id']);
			$this->db->insert('hci_feegroup',$fg_save);
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

function load_feetemp_amounts()
{
	$this->db->where('fsf_feetemplate',$this->input->post('aft'));
	$afts = $this->db->get('hci_feestructure_fees')->result_array();

	$this->db->where('fsf_feetemplate',$this->input->post('tft'));
	$tfts = $this->db->get('hci_feestructure_fees')->result_array();

	$all = array(
		"afts" => $afts,
		"tfts" => $tfts
		);

	return $all;
}

function save_paymentplan()
{
	$description = $this->input->post('description');
	$fee_cat = $this->input->post('fee_cat');
	$ins_type = $this->input->post('ins_type');
	$pplan_id	= $this->input->post('pplan_id');

	$this->db->trans_begin();

	$plan_save['plan_name'] = $description;
	$plan_save['plan_fee'] = $fee_cat;
	$plan_save['plan_type'] = $ins_type;
	$plan_save['plan_status'] = 'A';

	if(empty($pplan_id))
	{
		$this->db->insert('hci_paymentplan',$plan_save);
		$pplan_id = $this->db->insert_id();
	}
	else
	{
		$this->db->where('plan_id',$pplan_id);
		$this->db->update('hci_paymentplan',$plan_save);

		$this->db->where('ins_plan',$pplan_id);
		$this->db->update('hci_instalment',array('ins_status'=>'D'));
	}

	if($ins_type=='T')
	{
		$instalements = 3;
	}
	else if($ins_type=='M')
	{
		$instalements = 12;		
	}
	else
	{
		$instalements = 0;	
	}

	for($x=1; $x<=$instalements;$x++)
	{
		$ins_id = $this->input->post('ins_id_'.$x);

		$ins_save['ins_number'] = $this->input->post('ins_'.$x);
		$ins_save['ins_ddate'] 	= $this->input->post('ddate_'.$x);
		$ins_save['ins_plan'] 	= $pplan_id;
		$ins_save['ins_status'] = 'A';

		$this->db->where('ins_plan',$pplan_id);
		$this->db->where('ins_number',$x);
		$ins_exist = $this->db->get('hci_instalment')->row_array();

		if(empty($ins_exist))
		{
			$result = $this->db->insert('hci_instalment',$ins_save);
		}
		else
		{
			$this->db->where('ins_id',$ins_exist['ins_id']);
			$result = $this->db->update('hci_instalment',$ins_save);
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

function load_payment_plans()
{
	$this->db->select('hci_paymentplan.*,hci_feecategory.fc_name');
	$this->db->join('hci_feecategory','hci_feecategory.fc_id=hci_paymentplan.plan_fee');
	$this->db->where('hci_paymentplan.plan_status','A');
	$plan = $this->db->get('hci_paymentplan')->result_array();
	
	$i = 0;
	foreach ($plan as $pln) 
	{
		$this->db->select('*');
		$this->db->where('ins_plan',$pln['plan_id']);
		$this->db->where('ins_status','A');
		$instalment = $this->db->get('hci_instalment')->result_array();
		$plan[$i]['inst'] = $instalment;
		$i++;
	}
	return $plan;
}

function edit_pay_plan()
{
	$this->db->select('*');
	$this->db->where('plan_id',$this->input->post('id'));
	$plan = $this->db->get('hci_paymentplan')->row_array();
	
	$this->db->select('*');
	$this->db->where('ins_plan',$this->input->post('id'));
	$this->db->where('ins_status','A');
	$instalment = $this->db->get('hci_instalment')->result_array();
	$plan['inst'] = $instalment;

	return $plan;
}

}
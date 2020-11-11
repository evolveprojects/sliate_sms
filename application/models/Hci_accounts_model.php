<?php
class Hci_accounts_model extends CI_model
{
function create_invoice($stuid)
{

    // $this->db->select('*');
    // $this->db->where('es_admissionid',$stuid);
    // $family = $this->db->get('hci_sibling')->row_array();

    

    // // if(empty($siblings))
    // // {

    

    

    //     $inv_ary = array();

    //     // foreach ($af_template as $value) 
    //     // {
    //     //     $temp_ary = array(
    //     //         "" => $,
    //     //         "" => $,
    //     //         "" => $,
    //     //         "" => $,
    //     //         "" => $,
    //     //         );
    //     // }

    //     //var_dump($fee_data);

   

    
    // // }

    
}

function get_invoices()
{
	$this->db->select('hci_invoice.*,st_details.family_name,st_details.other_names,st_details.st_addpaymethod');
	$this->db->join('st_details','st_details.id=hci_invoice.inv_student');
	$inv_info = $this->db->get('hci_invoice')->result_array();
	return $inv_info;
}

function load_invoicefees($inv)
{
    $this->db->select('hci_invoice.*,st_details.family_name,st_details.other_names,st_details.st_addpaymethod,st_details.st_id');
    $this->db->join('st_details','st_details.id=hci_invoice.inv_student');
    $this->db->where('hci_invoice.inv_id',$inv);
    $invoice_data = $this->db->get('hci_invoice')->row_array();

    $this->db->select('hci_invoicefee.*,hci_feecategory.fc_name,hci_feestructure_fees.fsf_fee,hci_feestructure_fees.fsf_id');
    $this->db->join('hci_feestructure_fees','hci_feestructure_fees.fsf_id=hci_invoicefee.invf_fee');
    $this->db->join('hci_feecategory','hci_feecategory.fc_id=hci_feestructure_fees.fsf_fee');
    $this->db->where('hci_invoicefee.invf_invoice',$inv);
    $invoice_fees = $this->db->get('hci_invoicefee')->result_array();

    $this->db->join('hci_adjstemplate','hci_stuinvdiscount.id_adjstemp=hci_adjstemplate.at_id');
    $this->db->join('hci_adjusment','hci_stuinvdiscount.id_adjusment=hci_adjusment.adj_id');
    $this->db->where('hci_stuinvdiscount.id_invoice',$inv);
    $invoice_disc = $this->db->get('hci_stuinvdiscount')->result_array();

    $i = 0;
    foreach ($invoice_disc as $disc) 
    {
        $this->db->where('atf_adjstemp',$disc['at_id']);
        $discfee = $this->db->get('hci_adjsfees')->result_array();

        $invoice_disc[$i]['discfee'] = $discfee;
        $i++;
    }

    $this->db->join('hci_adjusment','hci_adjusment.adj_id=hci_adjstemplate.at_adjusment');
    $this->db->where('hci_adjstemplate.at_applyfor',1);
    $this->db->where('hci_adjusment.adj_status','A');
    $other_adjs = $this->db->get('hci_adjstemplate')->result_array();

    $this->db->select('hci_paymentplan.*');
    $this->db->join('hci_paymentplan','hci_paymentplan.plan_id=hci_stupaymentplan.spp_paymentplan');
    $this->db->where('hci_stupaymentplan.spp_student',$invoice_data['inv_student']);
    $payment_plan = $this->db->get('hci_stupaymentplan')->result_array();

    $all = array(
        'invoice_data' => $invoice_data,
        'invoice_fees' => $invoice_fees,
        'invoice_disc' => $invoice_disc,
        'other_adjs'   => $other_adjs,
        'payment_plan' => $payment_plan
        );
    
	return $all;
}

function save_adjusment()
{
    $adj_type = $this->input->post('adj_type');
    $adj_id = $this->input->post('adj_id');
    $adj_name = $this->input->post('adj_name');
    $adj_fee = $this->input->post('adj_fee');
    $adj_appfor = $this->input->post('adj_appfor');
    $adj_calamttype = $this->input->post('adj_calamttype');
    $adj_amt = $this->input->post('adj_amt');
 
    $save_adj['adj_description'] = $adj_name; 
    $save_adj['adj_type']        = $adj_type; 
    $save_adj['adj_feecat']      = $adj_fee; 
    $save_adj['adj_applyfor']    = $adj_appfor; 
    $save_adj['adj_amttype']     = $adj_calamttype;   
    $save_adj['adj_amount']      = $adj_amt; 
    $save_adj['adj_status']      = 'A'; 

    $this->db->trans_begin();

    if(empty($adj_id))
    {
        $this->db->insert('hci_adjusment',$save_adj);
    }
    else
    {
        $this->db->where('adj_id',$adj_id);
        $this->db->update('hci_adjusment',$save_adj);
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

function load_adjusment()
{
    $this->db->select('*');
    $adjs = $this->db->get('hci_adjusment')->result_array();

    return $adjs;
}

function config_adjusments()
{
    $conf_id = $this->input->post('conf_id');
    $conf_adj = $this->input->post('conf_adj');
    $conf_appfor = $this->input->post('conf_appfor');
    $conf_appstu = $this->input->post('conf_appstu');
    $selstu = $this->input->post('selstu');
    $conf_fs = $this->input->post('conf_fs');
    $amts = $this->input->post('amts');
    $amtnew = $this->input->post('amtnew');
    $amtold = $this->input->post('amtold');

    $this->db->trans_begin();

    $save_temp['at_adjusment'] = $conf_adj;
    $save_temp['at_applyfor'] = $conf_appfor;
    $save_temp['at_students'] = $conf_appstu;
    $save_temp['at_feestructure'] = $conf_fs;

    if(empty($conf_id))
    {
        $this->db->insert('hci_adjstemplate',$save_temp);
        $conf_id = $this->db->insert_id();
    }
    else
    {
        $this->db->where('at_id',$conf_id);
        $this->db->update('hci_adjstemplate',$save_temp);

        $this->db->where('ats_adjstemp',$conf_id);
        $this->db->update('hci_adjsstudent',array('ats_status'=>'D'));

        $this->db->where('atf_adjstemp',$conf_id);
        $this->db->update('hci_adjsfees',array('aft_status'=>'D','aft_tot'=>null,'aft_new'=>null,'aft_old'=>null));
    }

    if($conf_appstu==2)
    {
        foreach ($selstu as $stu) 
        {
            $this->db->where('ats_adjstemp',$conf_id);
            $this->db->where('ats_student',$stu);
            $stu_ext = $this->db->get('hci_adjsstudent')->row_array();

            $stu_save['ats_status'] = 'A';

            if(empty($stu_ext))
            {
                $stu_save['ats_adjstemp'] = $conf_id;
                $stu_save['ats_student'] = $stu;

                $this->db->insert('hci_adjsstudent',$stu_save);
            }
            else
            {
                $this->db->where('ats_id',$stu_ext['ats_id']);
                $this->db->update('hci_adjsstudent',$stu_save);
            }
        }
    }

    if($conf_appfor==2)
    {
        $this->db->select('es_admissionid');
        $this->db->where('es_seqnumber',2);
        $sib2s = $this->db->get('hci_sibling')->result_array();

        foreach ($sib2s as $sib2) 
        {
            $this->db->where('ats_adjstemp',$conf_id);
            $this->db->where('ats_student',$sib2['es_admissionid']);
            $sib2_ext = $this->db->get('hci_adjsstudent')->row_array();

            $sib2_save['ats_status'] = 'A';

            if(empty($sib2_ext))
            {
                $sib2_save['ats_adjstemp'] = $conf_id;
                $sib2_save['ats_student'] = $sib2['es_admissionid'];

                $this->db->insert('hci_adjsstudent',$sib2_save);
            }
            else
            {
                $this->db->where('ats_id',$sib2_ext['ats_id']);
                $this->db->update('hci_adjsstudent',$sib2_save);
            }
        }
    }

    if($conf_appfor==3)
    {
        $this->db->select('es_admissionid');
        $this->db->where('es_seqnumber',3);
        $sib3s = $this->db->get('hci_sibling')->result_array();

        foreach ($sib3s as $sib3) 
        {
            $this->db->where('ats_adjstemp',$conf_id);
            $this->db->where('ats_student',$sib3['es_admissionid']);
            $sib3_ext = $this->db->get('hci_adjsstudent')->row_array();

            $sib3_save['ats_status'] = 'A';

            if(empty($sib3_ext))
            {
                $sib3_save['ats_adjstemp'] = $conf_id;
                $sib3_save['ats_student'] = $sib3['es_admissionid'];

                $this->db->insert('hci_adjsstudent',$sib3_save);
            }
            else
            {
                $this->db->where('ats_id',$sib3_ext['ats_id']);
                $this->db->update('hci_adjsstudent',$sib3_save);
            }
        }
    }

    if($conf_appfor==4)
    {
        $this->db->select('es_admissionid');
        $this->db->where('es_seqnumber >=',4);
        $sib4s = $this->db->get('hci_sibling')->result_array();

        foreach ($sib4s as $sib4) 
        {
            $this->db->where('ats_adjstemp',$conf_id);
            $this->db->where('ats_student',$sib4['es_admissionid']);
            $sib4_ext = $this->db->get('hci_adjsstudent')->row_array();

            $sib4_save['ats_status'] = 'A';

            if(empty($sib4_ext))
            {
                $sib4_save['ats_adjstemp'] = $conf_id;
                $sib4_save['ats_student'] = $sib4['es_admissionid'];

                $this->db->insert('hci_adjsstudent',$sib4_save);
            }
            else
            {
                $this->db->where('ats_id',$sib4_ext['ats_id']);
                $this->db->update('hci_adjsstudent',$sib4_save);
            }
        }
    }

    if($conf_appfor==5 && !empty($conf_fs))
    {   
        foreach ($amts as $amt) 
        {
            $this->db->where('atf_adjstemp',$conf_id);
            $this->db->where('aft_fsfee',$amt);
            $amt_ext = $this->db->get('hci_adjsfees')->row_array();

            $amt_save['aft_status'] = 'A';

            if(empty($amt_ext))
            {
                $amt_save['atf_adjstemp'] = $conf_id;
                $amt_save['aft_fsfee'] = $amt;
                $amt_save['aft_tot'] = 1;
                // $amt_save['aft_old'] = $

                $this->db->insert('hci_adjsfees',$amt_save);
            }
            else
            {
                $this->db->where('atf_id',$amt_ext['atf_id']);
                $this->db->update('hci_adjsfees',$amt_save);
            }
        }

        foreach ($amtnew as $new) 
        {
            $this->db->where('atf_adjstemp',$conf_id);
            $this->db->where('aft_fsfee',$new);
            $new_saved = $this->db->get('hci_adjsfees')->row_array();

            $new_save['aft_status'] = 'A';
            $new_save['aft_new'] = 1;

            if(empty($new_saved))
            {
                $new_save['atf_adjstemp'] = $conf_id;
                $new_save['aft_fsfee'] = $new;  

                $this->db->insert('hci_adjsfees',$new_save);
            }
            else
            {
                $this->db->where('atf_id',$new_saved['atf_id']);
                $this->db->update('hci_adjsfees',$new_save);
            }
        }

        foreach ($amtold as $old) 
        {
            $this->db->where('atf_adjstemp',$conf_id);
            $this->db->where('aft_fsfee',$old);
            $old_saved = $this->db->get('hci_adjsfees')->row_array();

            $old_save['aft_status'] = 'A';
            $old_save['aft_old'] = 1;

            if(empty($old_saved))
            {
                $old_save['atf_adjstemp'] = $conf_id;
                $old_save['aft_fsfee'] = $old;  

                $this->db->insert('hci_adjsfees',$old_save);
            }
            else
            {
                $this->db->where('atf_id',$old_saved['atf_id']);
                $this->db->update('hci_adjsfees',$old_save);
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

function erp_integration()
{
    $invlist = $this->input->post('invlist');

    $erp_db = $this->load->database('erp_db', TRUE); 
    $br_pref = '3';

    $erp_db->select('value');
    $erp_db->where('name','f_year');
    $f_year = $erp_db->get($br_pref.'_sys_prefs')->row_array();

    $this->db->trans_begin();

    foreach ($invlist as $inv) 
    {
        $this->db->where('inv_id',$inv);
        $invoice_data = $this->db->get('hci_invoice')->row_array();

        $this->db->select('hci_invoicefee.*,hci_feecategory.fc_name,hci_feestructure_fees.fsf_fee,hci_feestructure_fees.fsf_id');
        $this->db->join('hci_feestructure_fees','hci_feestructure_fees.fsf_id=hci_invoicefee.invf_fee');
        $this->db->join('hci_feecategory','hci_feecategory.fc_id=hci_feestructure_fees.fsf_fee');
        $this->db->where('hci_invoicefee.invf_invoice',$inv);
        $invoice_fees = $this->db->get('hci_invoicefee')->result_array();

        $this->db->join('hci_adjstemplate','hci_stuinvdiscount.id_adjstemp=hci_adjstemplate.at_id');
        $this->db->join('hci_adjusment','hci_stuinvdiscount.id_adjusment=hci_adjusment.adj_id');
        $this->db->where('hci_stuinvdiscount.id_invoice',$inv);
        $invoice_disc = $this->db->get('hci_stuinvdiscount')->result_array();

        $i = 0;
        foreach ($invoice_disc as $disc) 
        {
            $this->db->where('atf_adjstemp',$disc['at_id']);
            $discfee = $this->db->get('hci_adjsfees')->result_array();

            $invoice_disc[$i]['discfee'] = $discfee;
            $i++;
        }

        $this->db->join('hci_adjusment','hci_adjusment.adj_id=hci_adjstemplate.at_adjusment');
        $this->db->where('hci_adjstemplate.at_applyfor',1);
        $this->db->where('hci_adjusment.adj_status','A');
        $other_adjs = $this->db->get('hci_adjstemplate')->result_array();

        $this->db->select('hci_paymentplan.*');
        $this->db->join('hci_paymentplan','hci_paymentplan.plan_id=hci_stupaymentplan.spp_paymentplan');
        $this->db->where('hci_stupaymentplan.spp_student',$invoice_data['inv_student']);
        $payment_plan = $this->db->get('hci_stupaymentplan')->result_array();

        $tot_amt = 0;
        $tot_dis = 0;
        $tot_add = 0;
        $x = 0;
        $tablerw = '';
        foreach ($invoice_fees as $fee) 
        {
            $addition = 0;
            $discount = 0;
            
            foreach($invoice_disc as $disc)
            {
                if($disc['adj_feecat']==$fee['fsf_fee'])
                {
                    $addtodisc = FALSE;
                    if($disc['at_applyfor']==5)
                    {
                        if(!empty($disc['discfee']))
                        {
                            foreach($disc['discfee'] as $discfee)
                            {
                                if($discfee['aft_fsfee']==$fee['fsf_id'])
                                {
                                    if($fee['fsf_fee']==1)
                                    {
                                        if($invoice_data['inv_description']=='Registration')
                                        {
                                            if($discfee['aft_tot']==1)
                                            {
                                                $addtodisc = TRUE;
                                            }
                                            else if($discfee['aft_new']==1)
                                            {
                                                $addtodisc = TRUE;
                                            }
                                        }
                                        else if($invoice_data['inv_description']=='AnnualPromo')
                                        {
                                            if($discfee['aft_old']==1)
                                            {
                                                $addtodisc = TRUE;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $pay_type = '';
                                        foreach($payment_plan as $plan)
                                        {
                                            if($plan['plan_fee']==$fee['fsf_fee'])
                                            {
                                                $pay_type = $plan['plan_type'];
                                            }
                                        }

                                        if($disc['adj_applyfor']==1)
                                        {
                                            if($pay_type == 'TA')
                                            {
                                                $addtodisc = TRUE;
                                            }
                                        }
                                        else
                                        {
                                            $addtodisc = TRUE;
                                        }
                                    }  
                                }
                            }
                        }
                        else
                        {
                            $addtodisc = TRUE;
                        }
                    }
                    else
                    {
                        $addtodisc = TRUE;
                    }

                    if($addtodisc==TRUE)
                    {
                        if($disc['adj_type']=='A')
                        {
                            if($disc['adj_amttype']=='P')
                            {
                                $addition += ($fee['invf_amount']*$disc['adj_amount'])/100;
                            }
                            else
                            {
                                $addition += $disc['adj_amount'];
                            }
                        
                        }
                        else
                        {
                            if($disc['adj_amttype']=='P')
                            {
                                $discount += ($fee['invf_amount']*$disc['adj_amount'])/100;
                            }
                            else
                            {
                                $discount += $disc['adj_amount'];
                            }
                        }
                    }
                }
            }
            $invoice_fees[$x]['discounts'] = $discount;
            $invoice_fees[$x]['additions'] = $addition;
            $invoice_fees[$x]['net_amount'] = $fee['invf_amount']-$discount+$addition;

            $tot_amt += $fee['invf_amount'];
            $tot_amt += $addition;
            $tot_amt -= $discount;
            $tot_dis += $discount;
            $tot_add += $addition;
            $x++;
        }

        $currmonth = date ('m');

        if($invoice_data['inv_description']=='Registration')
        {
            if($currmonth>=5)
            {
                $tot_months = 17-$currmonth;
            }
            else
            {
                $tot_months = 5-$currmonth;
            }
        }
        else
        {
            $tot_months = 4;
            foreach ($payment_plan as $plan) 
            {
                if($plan['plan_fee']!=1 && $plan['plan_type']=='TA')
                {
                    $tot_months = 12;
                }
            }

            foreach ($invoice_fees as $fee)
            {
                if($fee['fsf_fee']==1)
                {
                    $tot_months = 12;
                }
            }
        }
        for ($x = 1; $x <= $tot_months; $x++) 
        {
            $smi_save['smi_invoice'] = $inv;
            $smi_save['smi_student'] = $invoice_data['inv_student'];
            $smi_save['smi_subnumber'] = $x;

            if($x==1)
            {
                $smi_save['smi_status'] = 'T';
                $smi_save['smi_processdate'] = date('Y-m-d');
            }
            else
            {
                $smi_save['smi_status'] = 'P';
                $smi_save['smi_processdate'] = date('Y-m-d', strtotime(date("y-m-d") . "+".($x-1)." months") ); 
            }
            $this->db->insert('hci_stumonthlyinvoice',$smi_save);
            $minv_id = $this->db->insert_id();

            if($x==1)
            {
                $erp_db->where('trans_type',0);
                $pattern = $erp_db->get($br_pref.'_reflines')->row_array();

                $refs['id'] = $pattern['pattern'];
                $refs['type'] = 0;
                $refs['reference'] = $pattern['pattern'];

                $erp_db->insert($br_pref.'_refs',$refs);

                $autrail['type'] = 0;
                $autrail['trans_no'] = $pattern['pattern'];
                $autrail['user'] = 1;
                $autrail['fiscal_year'] = $f_year['value'];
                $autrail['gl_date'] = date('Y-m-d');
                $autrail['gl_seq'] = 0;

                $erp_db->insert($br_pref.'_audit_trail',$autrail);

                $gl_transid = $erp_db->insert_id();

                $erp_db->set('pattern', 'pattern+1', FALSE);
                $erp_db->where('trans_type',0);
                $erp_db->update($br_pref.'_reflines');
            }

            $total_amount = 0;
            $tot_cr = 0;
            $differed =0;

            $gl_trans['type'] = 0;
            $gl_trans['type_no'] = $gl_transid;
            $gl_trans['tran_date'] = date('Y-m-d');
            $gl_trans['dimension_id'] = 0;
            $gl_trans['dimension2_id'] = 0;

            foreach ($invoice_fees as $fee) 
            {
                if($fee['fsf_fee']==1)
                {
                    $minv_details['smid_description'] = 'Admission Fees Income';
                    $minv_details['smid_glcode'] = '0510';
                    $minv_details['smid_monthinv'] = $minv_id;
                    $minv_details['smid_amount'] = $fee['net_amount']/$tot_months;
                    //$minv_details['smid_amount'] = ($fee['net_amount']/$tot_months)*$x;
                    $minv_details['smid_rdcrtype'] = 'CR';
                    $minv_details['smid_action'] = 'A';

                    $this->db->insert('hci_stumonthinvdetail',$minv_details);
                    $total_amount += $fee['invf_amount']/$tot_months;
                    $tot_cr += $fee['invf_amount']/$tot_months;

                    if($x==1)
                    {
                        $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));
             
                        $gl_trans['account'] = '0510';
                        $gl_trans['amount'] = 0-($fee['net_amount']/$tot_months);
                        $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
                    }
                    else
                    {
                        $differed += ($fee['net_amount']/$tot_months);
                    }
                    // $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));
                
                }
                
                if($fee['fsf_fee']==2)
                {
                    $this->db->select('hci_paymentplan.*');
                    $this->db->join('hci_paymentplan','hci_paymentplan.plan_id=hci_stupaymentplan.spp_paymentplan');
                    $this->db->where('hci_stupaymentplan.spp_student',$invoice_data['inv_student']);
                    $this->db->where('hci_paymentplan.plan_fee',$fee['fsf_fee']);
                    $payment_plan = $this->db->get('hci_stupaymentplan')->row_array();

                    if($payment_plan['plan_type']!='TA')
                    {
                        if($currmonth<4)
                        {
                            $tot_months = 5-$currmonth;
                        }
                        else if($currmonth<8)
                        {
                            $tot_months = 9-$currmonth;
                        }
                        else
                        {
                            $tot_months = 13-$currmonth;
                        }
                    }

                    $minv_details['smid_description'] = 'Term Fees Income';
                    $minv_details['smid_glcode'] = '0511';
                    $minv_details['smid_monthinv'] = $minv_id;
                    $minv_details['smid_amount'] = $fee['net_amount']/$tot_months;
                    // $minv_details['smid_amount'] = ($fee['net_amount']/$tot_months)*$x;
                    $minv_details['smid_rdcrtype'] = 'CR';
                    $minv_details['smid_action'] = 'A';

                    $this->db->insert('hci_stumonthinvdetail',$minv_details);
                    $total_amount += $fee['invf_amount']/$tot_months;
                    $tot_cr += $fee['net_amount']/$tot_months;

                    if($x==1)
                    {
                        $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));

                        $gl_trans['account'] = '0511';
                        $gl_trans['amount'] = 0-($fee['net_amount']/$tot_months);
                        $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
                    }
                    else
                    {
                        $differed += ($fee['net_amount']/$tot_months);
                    }
                    // $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));
                }

                if($fee['fsf_fee']==3)
                {
                    $this->db->select('hci_paymentplan.*');
                    $this->db->join('hci_paymentplan','hci_paymentplan.plan_id=hci_stupaymentplan.spp_paymentplan');
                    $this->db->where('hci_stupaymentplan.spp_student',$invoice_data['inv_student']);
                    $this->db->where('hci_paymentplan.plan_fee',$fee['fsf_fee']);
                    $payment_plan = $this->db->get('hci_stupaymentplan')->row_array();

                    if($payment_plan['plan_type']!='TA')
                    {
                        if($currmonth<4)
                        {
                            $tot_months = 5-$currmonth;
                        }
                        else if($currmonth<8)
                        {
                            $tot_months = 9-$currmonth;
                        }
                        else
                        {
                            $tot_months = 13-$currmonth;
                        }
                    }

                    $minv_details['smid_description'] = 'Service Fees Income';
                    $minv_details['smid_glcode'] = '0515';
                    $minv_details['smid_monthinv'] = $minv_id;
                    $minv_details['smid_amount'] = $fee['net_amount']/$tot_months;
                    // $minv_details['smid_amount'] = ($fee['net_amount']/$tot_months)*$x;
                    $minv_details['smid_rdcrtype'] = 'CR';
                    $minv_details['smid_action'] = 'A';

                    $this->db->insert('hci_stumonthinvdetail',$minv_details);
                    $total_amount += $fee['invf_amount']/$tot_months;
                    $tot_cr += $fee['net_amount']/$tot_months;

                    if($x==1)
                    {
                        $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));

                        $gl_trans['account'] = '0515';
                        $gl_trans['amount'] = 0-($fee['net_amount']/$tot_months);
                        $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
                    }
                    else
                    {
                        $differed += ($fee['net_amount']/$tot_months);
                    }
                    // $differed += (($fee['net_amount']/$tot_months)*($tot_months-$x));
                }
            }

            foreach($other_adjs as $other_adj)
            {
                if($other_adj['adj_description']=='NBT')
                {
                    if($other_adj['adj_type']=='A')
                    {
                        if($other_adj['adj_amttype']=='P')
                        {
                            $add_amt = ($tot_amt*$other_adj['adj_amount']/100);
                        }
                        else
                        {
                            $add_amt = $other_adj['adj_amount'];
                        }

                        $minv_details['smid_description'] = 'NBT Expenses';
                        $minv_details['smid_glcode'] = '1115';
                        $minv_details['smid_monthinv'] = $minv_id;
                        $minv_details['smid_amount'] = ($add_amt/$tot_months);
                        // $minv_details['smid_amount'] = ($add_amt/$tot_months)*$x;
                        $minv_details['smid_rdcrtype'] = 'CR';
                        $minv_details['smid_action'] = 'A';

                        $this->db->insert('hci_stumonthinvdetail',$minv_details);

                        $tot_amt += $add_amt;

                        if($x==1)
                        {
                            $differed += (($add_amt/$tot_months)*($tot_months-$x));

                            $gl_trans['account'] = '1115';
                            $gl_trans['amount'] = 0-($add_amt/$tot_months);
                            $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
                        }
                        else
                        {
                            $differed += (($add_amt/$tot_months));
                        }
                        //$differed += (($add_amt/$tot_months)*($tot_months-$x));
                    }
                    else
                    {
                        // if($other_adj['adj_amttype']=='P')
                        // {
                        //     $ded_amount = ($total_amount*$other_adj['adj_amount']/100);
                        // }
                        // else
                        // {
                        //     $ded_amount = $other_adj['adj_amount'];
                        // }
                    }
                }
            }

            $minv_details['smid_description'] = 'Differed  Revenue';
            $minv_details['smid_glcode'] = '0201';
            $minv_details['smid_monthinv'] = $minv_id;
            $minv_details['smid_amount'] = $differed;
            $minv_details['smid_rdcrtype'] = 'CR';

            if($x==1)
            {
                $minv_details['smid_action'] = 'A';

                $gl_trans['account'] = '0201';
                $gl_trans['amount'] = 0-$differed;
                $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
            }
            else
            {
                $minv_details['smid_action'] = 'D';
            }

            $this->db->insert('hci_stumonthinvdetail',$minv_details);
            $tot_cr += ($fee['net_amount']/$tot_months)*($tot_months-1);

            if($x==1)
            {
                $minv_details['smid_description'] = 'Accounts Receivables-School Students';
                $minv_details['smid_glcode'] = '0054';
                $minv_details['smid_monthinv'] = $minv_id;
                $minv_details['smid_amount'] = $tot_amt;
                $minv_details['smid_rdcrtype'] = 'DR';

                $this->db->insert('hci_stumonthinvdetail',$minv_details);

                $gl_trans['account'] = '0054';
                $gl_trans['amount'] = $tot_amt;
                $erp_db->insert($br_pref.'_gl_trans',$gl_trans);
            }

            $tot_amt -= $add_amt;
        }

        // $this->db->where('inv_id',$inv);
        // $this->db->update('hci_invoice',array('inv_status' => 'T'));//transfered

    }

    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        $this->msg->set('admission', "Failed to Process Invoice/s. retry");
    }
    else
    {
        $this->db->trans_commit(); 
        $this->msg->set('admission', "Invoice/s Processed successfully");
    }
}

}
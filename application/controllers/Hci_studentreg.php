<?php
class Hci_studentreg extends CI_controller
{

function hci_studentreg()
{
    parent::__construct();
    $this->load->model('hci_studentreg_model');
    $this->load->model('rules_model');
    $this->load->model('hci_feestructure_model');
    $this->load->model('company_model');
}

function index()
{
    $this->new_studentreg();
    $this->new_studentupdate();
}

public function new_studentreg($action = "insert", $id = "") 
{
    if($action=="insert")
    {
        $this->db->trans_begin();

        $this->hci_studentreg_model->obj = $this->hci_studentreg_model->get_row('hci_enquiry',array('es_enquiryid'=>$id));
        $today= date("Y-m-d");
        $post = $this->input->post("post");

        if(isset($_POST['btn_type']))
        {
            $process_name = 'register';
        }
        else
        {
            $process_name = 'save';
        }

        if($this->input->post("post"))
        {
            $today= date("Y-m-d");

            $this->db->where('int_start <=',$today);
            $this->db->where('int_end >=',$today);
            $intake = $this->db->get('stu_intake')->row_array();

            $this->db->where('es_feemasterid',$post['st_feestructure']);
            $fee_structure = $this->db->get('hci_feemaster')->row_array();

            //$this->db->where('fsf_grade',$post['st_grade']);
            $this->db->where('fsf_feetemplate',$fee_structure['fee_aftemp']);
            $af_template = $this->db->get('hci_feestructure_fees')->result_array();

            //$this->db->where('fsf_grade',$post['st_grade']);
            $this->db->where('fsf_feetemplate',$fee_structure['fee_tftemp']);
            $tf_template = $this->db->get('hci_feestructure_fees')->result_array();

            if($process_name=="register")
            {
                $post['entered_date'] = $today;
                $post['st_status'] = 'R';
                $post['st_intake'] = $intake['int_id'];
                $post['st_lastpromoted'] = $post['st_accyear'];

                $sql = $this->hci_studentreg_model->insert('st_details',$post);
                $new_stu=$this->hci_studentreg_model->last_insert;

                //---------------------------------- stu id

                $this->db->where('ac_iscurryear',1);
                $acc_year = $this->db->get('cfg_academicyears')->row_array();

                $this->db->where('grd_id',$post['st_grade']);
                $grd_data = $this->db->get('hci_grade')->row_array();

                $this->db->where('st_intake',$intake['int_id']);
                $this->db->where('st_grade',$post['st_grade']);
                $int_grd_count = $this->db->count_all_results('st_details');

                $tot_stu_count = $this->db->count_all('st_details');

                $curr_year = date('y', strtotime($acc_year['ac_startdate']));
                $curr_intake = date('m', strtotime($intake['int_start']));
                $grd_code = $grd_data['grd_code'];

                $stu_index = 'MA/'.$curr_year.'/'.$curr_intake.'/'.$grd_code.'-'.($int_grd_count).'/'.($tot_stu_count+94);

                $this->db->where('id',$new_stu);
                $this->db->update('st_details',array('st_id'=>$stu_index));
            }
            else
            {
                $post['entered_date'] = $today;
                $post['st_status'] = 'P';
                $post['st_intake'] = $intake['int_id'];

                $sql = $this->hci_studentreg_model->insert('st_details_temp',$post);
                $new_stu=$this->hci_studentreg_model->last_insert;
            }

            //-----------------------------siblings----------------

            $sibilins=$this->input->post("es_sibiling");

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

                $add_tosib['es_family'] = $family_id;
                $add_tosib['es_admissionid'] = $new_stu;
                $add_tosib['es_seqnumber'] = count($sibilins)+1;

                if($process_name=="register")
                {
                    $add_tosib['es_reftable'] = 'st_details';
                }
                else
                {
                    $add_tosib['es_reftable'] = 'st_details_temp';
                }

                $this->db->insert('hci_sibling',$add_tosib);
            }

            //-------------------------payment scheme---------------------

            $pplans = $this->input->post('pplan');

            if($process_name=="register")
            {
                $savespp['spp_reftable'] = 'st_details';
            }
            else
            {
                $savespp['spp_reftable'] = 'st_details_temp';
            }

            $this->db->set('spp_status','D');
            $this->db->where('spp_reftable',$savespp['spp_reftable']);
            $this->db->where('spp_student',$new_stu);
            $this->db->update('hci_stupaymentplan');

            foreach ($pplans as $plan) 
            {
                if(!empty($plan))
                {
                    $this->db->where('spp_student',$new_stu);
                    $this->db->where('spp_reftable',$savespp['spp_reftable']);
                    $this->db->where('spp_paymentplan',$plan);
                    $isexist = $this->db->get('hci_stupaymentplan')->row_array();

                    $savespp['spp_status'] = 'A';

                    if(empty($isexist))
                    {
                        $savespp['spp_student'] = $new_stu;
                        $savespp['spp_paymentplan'] = $plan;

                        $this->db->insert('hci_stupaymentplan',$savespp);
                    }
                    else
                    {
                        $this->db->where('spp_id',$isexist['spp_id']);
                        $this->db->update('hci_stupaymentplan',$savespp);
                    }
                }
             
            }

            //------------------------ Invoice ------------------

            if($process_name=="register")
            {
                $erp_db = $this->load->database('erp_db', TRUE);

                $save_inv['inv_student'] = $new_stu;
                $save_inv['inv_date'] = date("Y-m-d");;
                $save_inv['inv_status'] = 'P';
                $save_inv['inv_description'] = 'Registration';
                $this->db->insert('hci_invoice',$save_inv);

                $inv_id = $this->db->insert_id();

                foreach ($af_template as $fee) 
                {
                    if($fee['fsf_grade']==$post['st_grade'])
                    {
                        $save_fee['invf_invoice'] = $inv_id;
                        $save_fee['invf_fee'] = $fee['fsf_id'];

                        if($post['st_addpaymethod']==1)
                        {
                            $temp_amt = $fee['fsf_amt'];
                        }
                        else
                        {
                            $temp_amt = $fee['fsf_slabnew'];
                        }
           
                        $this->db->where('plan_fee',$fee['fsf_id']);
                        $this->db->where_in('plan_id',$pplans);
                        $fee_plans = $this->db->get('hci_paymentplan')->row_array();

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
                    if($fee['fsf_grade']==$post['st_grade'])
                    {
                        $save_fee['invf_invoice'] = $inv_id;
                        $save_fee['invf_fee'] = $fee['fsf_id'];
                        $save_fee['invf_amount'] = $fee['fsf_amt'];

                        $this->db->where('plan_fee',$fee['fsf_id']);
                        $this->db->where_in('plan_id',$pplans);
                        $fee_plans = $this->db->get('hci_paymentplan')->row_array();

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

            $discounts = array();

            if(isset($_POST['discountschk']))
            {
                $discounts = $this->input->post('discountschk');
            }

            $new_discount = $this->input->post('discinp');

            if(!empty($new_discount))
            {
                foreach ($new_discount as $key => $dis) 
                {
                    if(!empty($dis))
                    {
                        $app_for = $this->input->post('adj_appfor');

                        $save_adj['adj_description'] = 'Student Special'; 
                        $save_adj['adj_type']        = 'D'; 
                        $save_adj['adj_feecat']      = $key; 
                        $save_adj['adj_applyfor']    = $app_for[$key]; 
                        $save_adj['adj_amttype']     = 'P';   
                        $save_adj['adj_amount']      = $dis; 
                        $save_adj['adj_status']      = 'A'; 

                        $this->db->insert('hci_adjusment',$save_adj);
                        $new_disc = $this->db->insert_id();

                        if(!empty($new_discount))
                        {
                            array_push($discounts,$new_disc);
                        }

                        $save_temp['at_adjusment'] = $new_disc;
                        $save_temp['at_applyfor'] = 5;
                        $save_temp['at_students'] = 2;
                        $save_temp['at_feestructure'] = $post['st_feestructure'];

                        $this->db->insert('hci_adjstemplate',$save_temp);
                        $disctemp = $this->db->insert_id();

                        $amt_save['aft_status'] = 'A';
                        $amt_save['atf_adjstemp'] = $disctemp;

                        if($key==1)
                        {   
                            foreach ($af_template as $afees) 
                            {
                                $amt_save['aft_fsfee'] = $afees['fsf_id'];
                                $amt_save['aft_tot'] = 1;

                                if($afees['fsf_slabnew']>0)
                                {
                                    $amt_save['aft_new'] = 1;
                                }
                                else
                                {
                                    $amt_save['aft_new'] = null;
                                }

                                if($afees['fsf_slabold']>0)
                                {
                                    $amt_save['aft_old'] = 1;
                                }
                                else
                                {
                                    $amt_save['aft_old'] = null;
                                }

                                $this->db->insert('hci_adjsfees',$amt_save);
                            }
                        }
                        else
                        {
                            foreach ($tf_template as $tfees) 
                            {
                                if($tfees['fsf_fee']==$key)
                                {
                                    $amt_save['aft_fsfee'] = $tfees['fsf_id'];
                                    $amt_save['aft_tot'] = 1;
                                    $amt_save['aft_new'] = null;
                                    $amt_save['aft_old'] = null;

                                    $this->db->insert('hci_adjsfees',$amt_save);
                                }
                            }
                        }
                    }
                }
            }
            
            // discounts - start
            
            $discount_info = array();

            if(!empty($discounts))
            {
                foreach ($discounts  as $disc) 
                {
                    $this->db->where('hci_adjstemplate.at_adjusment',$disc);
                    $this->db->join('hci_adjusment','hci_adjusment.adj_id=hci_adjstemplate.at_adjusment');
                    $temp_data = $this->db->get('hci_adjstemplate')->row_array();

                    $this->db->where('atf_adjstemp',$temp_data['at_id']);
                    $discount_fees = $this->db->get('hci_adjsfees')->result_array();
                    $temp_data['discount_fees'] = $discount_fees;

                    if($process_name=="register")
                    {
                        $inv_dis['id_invoice']   = $inv_id;
                        $inv_dis['id_adjusment'] = $disc;
                        $inv_dis['id_adjstemp']  = $temp_data['at_id'];

                        $this->db->insert('hci_stuinvdiscount',$inv_dis);

                        $disc_save['ats_reftable'] = 'st_details';
                    }
                    else
                    {
                        $disc_save['ats_reftable'] = 'st_details_temp';
                    }

                    $disc_save['ats_status'] = 'A';
                    $disc_save['ats_adjstemp'] = $temp_data['at_id'];
                    $disc_save['ats_student'] = $new_stu;

                    $this->db->insert('hci_adjsstudent',$disc_save);
                }
            }
            //discounts - end

            // if($process_name=="register")
            // {
            //     $this->load->model('hci_accounts_model');
            //     $this->hci_accounts_model->erp_integration($inv_id,$save_inv['inv_description']);
            // }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $this->msg->set('admission', "Failed to save data. retry");
            }
            else
            {
                $this->db->trans_commit(); 
                $this->msg->set('admission', "success_Saved successfully");
            }
        }
    }
    $data['fees']  = $this->hci_studentreg_model->get_feecat_pplans();
    $data['fss'] = $this->hci_feestructure_model->load_active_feestructures();
    $data['stu_info'] = $this->hci_studentreg_model->get_stu_info();
    $data['reg_stu'] = $this->hci_studentreg_model->registeed_Stu();
    $data['acc_years'] = $this->company_model->get_ay_info();
    $data['main_content'] = 'hci_studentreg_view';
    $data['title'] = 'STU_REG';
    $this->load->view('includes/template', $data);
}

function add_old_student()
{
    // $this->db->distinct('intake');
    // $this->db->select('intake');
    // // $this->db->where('id >',2061);
    // $this->db->order_by('id');
    // $old_stu = $this->db->get('st_details')->result_array();

    // echo "<pre>";
    // var_dump($old_stu);
    // echo "</pre>";

    // $shiftin = null;
    // $shiftout= null;

    // $punch = null;
    // $prevpunch = null;

    // $savedata['punch'] = $punch;

    // if($prevpunch == 'in')
    // {
    //     if($shiftin>$punch>($shiftin-2))
    //     {
    //         $savedata['type'] = 'in';
    //     }
    //     else
    //     {
    //         $savedata['type'] = 'out';
    //     }
    // }
    // elseif($prevpunch=='out')
    // {
    //     $savedata['type'] = 'in';
    // }
    // else
    // {
    //     if($shiftin>$punch>($shiftin-2))
    //     {
    //         $savedata['type'] = 'in';
    //     }
    //     else
    //     {
    //         $savedata['type'] = 'out';
    //     }
    // }
}

function accy()
{
    $years = $this->db->get('cfg_academicyears')->result_array();

        foreach ($years as $yr) 
        {
            $this->db->set('st_accyear',$yr['es_ac_year_id']);
            $this->db->where('entered_date >=',$yr['ac_startdate']);
            $this->db->where('entered_date <=',$yr['ac_enddate']);
            $this->db->update('st_details');

            // echo "<pre>";
            // var_dump("Started date".$yr['ac_startdate']);
            // var_dump($stu);
            // var_dump("End date".$yr['ac_enddate']);
            // echo "</pre>";
        }
}

function grds()
{
    // $this->db->distinct('pref_grade');
    // $this->db->select('pref_grade');
    // //$this->db->where('st_prefgrade',NULL);
    $old_stu = $this->db->get('st_details')->result_array();

    
    foreach ($old_stu as $value) 
    {
        // $this->db->set('st_prefgrade',$this->get_grd_id($value['pref_grade']));
        // $this->db->where('pref_grade',$value['pref_grade']);
        $this->db->set('st_grade',$value['st_curgrade']);
        $this->db->where('id',$value['id']);
        $this->db->update('st_details');
    }



    // echo "<pre>";
    // var_dump($clz_ary);
    // echo "</pre>";
}

function sibs()
{
//     //$this->db->distinct('first_child');
//     $this->db->select('*');
//     // $this->db->where('id >',2061);
//     $old_stu = $this->db->get('st_details')->result_array();

//     $i =1;
//     foreach ($old_stu as $value) 
//     {  
//         if($value['first_child']!='' && $value['first_child']!=null)
//         {
//                 $this->db->select('id');
//                 $this->db->where('st_id',$value['first_child']);
//                 $firchild = $this->db->get('st_details')->row_array();

//                 $this->db->select('id');
//                 $this->db->where('first_child',$value['first_child']);
//                 $this->db->order_by('id');
//                 $siblings_old = $this->db->get('st_details')->result_array();

//                 $sibling_ary = Array($firchild['id']);

//                 foreach ($siblings_old as $sib) 
//                 {
//                     array_push($sibling_ary,$sib["id"]);
//                 }

//                 sort($sibling_ary);

//                 $tot_families = $this->db->count_all('hci_stfamily');

//                 $this->db->where_in('es_admissionid',$sibling_ary);
//                 $family = $this->db->get('hci_sibling')->result_array();

//                 if(empty($family))
//                 {
//                     $this->db->insert('hci_stfamily',array("sf_num"=>($tot_families+1)));
//                     $family_id = $this->db->insert_id();
//                 }
//                 else
//                 {
//                     $family_id = $family[0]['es_family'];
//                 }
                
//                 foreach ($sibling_ary as $key => $ns) 
//                 {
//                     $this->db->where('es_admissionid',$ns);
//                     $sibls = $this->db->get('hci_sibling')->row_array();

//                     $siblins_save['es_family'] = $family_id;
//                     $siblins_save['es_admissionid'] = $ns;
//                     $siblins_save['es_seqnumber'] = $key+1;

//                     if(empty($sibls))
//                     {
//                         $this->db->insert('hci_sibling',$siblins_save);
//                     }
//                 }
            

//             // if(count($sibling_ary)>=2)
//             // {
//             //     echo "<pre>";
//             // var_dump($sibling_ary);
//             // var_dump($i);
//             // echo "</pre>";
//             // $i++;
//             // }
            
//         }
//     }
//     // echo "<pre>";
//     // var_dump($old_stu);
//     // echo "</pre>";
}

function load_sibling_data()
{
    $sibls = $this->input->post('sibs');
    $fs = $this->input->post('fs');
    $type = $this->input->post('type');

    $discounts = array();

    if(!empty($sibls))
    {
        $this->db->select('es_family');
        $this->db->where('es_reftable','st_details');
        $this->db->where('es_admissionid',$sibls[0]);
        $stufamily = $this->db->get('hci_sibling')->row_array();

        if(empty($stufamily))
        {
            $firstsib = $sibls[0];
            $siblings = array($sibls[0]);
            $famseq = 2;
        }
        else
        {
            $this->db->select('*');
            $this->db->where('es_reftable','st_details');
            $this->db->where('es_family',$stufamily['es_family']);
            if(isset($_POST['stu']))
            {
                $this->db->where('es_admissionid !=',$_POST['stu']);
            }
            $sibs = $this->db->get('hci_sibling')->result_array();

            $firstsib = null;
            $famseq = count($sibs)+1;
            $siblings = array();

            foreach ($sibs as $sib) 
            {
                if($sib['es_seqnumber']==1)
                {
                    $firstsib = $sib['es_admissionid'];
                }
                array_push($siblings, $sib['es_admissionid']);
            }
        }

        $this->db->select('*');
        $this->db->where('id',$firstsib);
        $fsdata = $this->db->get('st_details')->row_array();

        if($type=="sibs")
        {
            $feesary = array(0,$fsdata['st_feestructure']);
            $fs = $fsdata['st_feestructure'];
        }
        else
        {
            $feesary = array(0,$fs,$fsdata['st_feestructure']);
        }

        $this->db->select('hci_adjusment.*,hci_adjstemplate.at_applyfor');
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
    }
    else
    {
        $firstsib = null;
        $siblings = null;
        $famseq   = 1;
        $fsdata = null;
        $feesary = array(0,$fs);
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


    
    
    

    $all = array(
        'siblings' => $siblings,
        'discounts' => $discounts,
        'fs' => $fs,
        'fsdata' => $fsdata
        );

    echo json_encode($all);
}

function get_grd_id($grd)
{

switch ($grd) {
    case "LK":
        $grade = 17;
        break;
    case "NR":
        $grade = 2;
        break;
    case "UK":
        $grade = 18;
        break;
    case "G5":
        $grade = 8;
        break;
    case "PG":
        $grade = 1;
        break;
    case "G1":
        $grade = 4;
        break;
    case "G4":
        $grade = 7;
        break;
    case "G3":
        $grade = 6;
        break;
    case "G2":
        $grade = 5;
        break;
    case "G6":
        $grade = 9;
        break;
    case "G7":
        $grade = 10;
        break;
    case "G8":
        $grade = 11;
        break;
    case "LKG":
        $grade = 17;
        break;
    case "Nursurey":
        $grade = 2;
        break;
    case "Nursery":
        $grade = 2;
        break;
    case "grade 4":
        $grade = 7;
        break;
    case "PLAY GROUP":
        $grade = 1;
        break;
    case "GRADE 1":
        $grade = 4;
        break;
    case "PLAYGROUP":
        $grade = 1;
        break;
    case "GRADE 7":
        $grade = 10;
        break;
    case "7":
        $grade = 10;
        break;
    case "GRADE 5":
        $grade = 8;
        break;
    case "LOWER KINDERGARTEN":
        $grade = 17;
        break;
    case "UKG":
        $grade = 18;
        break;
    case "GRADE 3":
        $grade = 6;
        break;
    case "GRADE 6":
        $grade = 9;
        break;
    case "GRADE 8":
        $grade = 11;
        break;
    case "GRADE 2":
        $grade = 5;
        break;
    case "GRADE1":
        $grade = 4;
        break;
    case "GRADE5":
        $grade = 8;
        break;
    case "GR 2":
        $grade = 5;
        break;
    case "P":
        $grade = 1;
        break;
    case "Upper Kindergarten":
        $grade = 18;
        break;
    case "YEAR 4":
        $grade = 7;
        break;
    case "YEAR 1":
        $grade = 4;
        break;
    case "GRADE7":
        $grade = 10;
        break;
    case "YEAR 3":
        $grade = 6;
        break;
    case "YEAR 5":
        $grade = 8;
        break;
    case "KINDERGARTEN":
        $grade = 3;
        break;
    case "YEAR 7":
        $grade = 10;
        break;
    case "YEAR 9":
        $grade = 12;
        break;
    case "YEAR 10":
        $grade = 13;
        break;
    case "YEAR 8":
        $grade = 11;
        break;
    case "YEAR 6":
        $grade = 9;
        break;
    case "YEAR 2":
        $grade = 5;
        break;
    case "NUR":
        $grade = 2;
        break;
    case "YEAR 12":
        $grade = 15;
        break;
    case "YEAR 11":
        $grade = 14;
        break;
    case "KG":
        $grade = 3;
        break;
    case "KIDERGARTEN":
        $grade = 3;
        break;
    case "NURSARY":
        $grade = 2;
        break;
    case "YEAR 06":
        $grade = 9;
        break;
    case "YEAAR 12":
        $grade = 15;
        break;
    case "YEAR12":
        $grade = 15;
        break;
    case "YEAR 03":
        $grade = 6;
        break;
    case "YEAR 01":
        $grade = 4;
        break;
    case "YEAR 02":
        $grade = 5;
        break;
    case "YEAR 04":
        $grade = 7;
        break;
    case "YEAR 05":
        $grade = 8;
        break;
    case "YEAR 08":
        $grade = 11;
        break;
    case "YEAR04":
        $grade = 7;
        break;
    case "YEAR01":
        $grade = 4;
        break;
    case "YEAR05":
        $grade = 8;
        break;
    case "YEAR2":
        $grade = 5;
        break;
    case "YEAR02":
        $grade = 5;
        break;
    case "YEAR03":
        $grade = 6;
        break;
    case "YEAR07":
        $grade = 10;
        break;
    case "YEAR08":
        $grade = 11;
        break;
    default:
        $grade = null;
}

    return $grade;
}

}
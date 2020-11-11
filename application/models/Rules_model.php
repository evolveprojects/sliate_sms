<?php
class Rules_model extends CI_model
{
    function create_invoice($stuid)
    {
        $this->db->select('*');
        $this->db->where('es_admissionid',$stuid);
        $family = $this->db->get('hci_sibling')->row_array();

        $this->db->select('*');
        $this->db->where('id',$stuid);
        $studata = $this->db->get('st_details')->row_array();

        $this->db->where('es_feemasterid',$studata['st_feestructure']);
        $fee_structure = $this->db->get('hci_feemaster')->row_array();

        $this->db->where('fsf_grade',$studata['st_grade']);
        $this->db->where('fsf_feetemplate',$fee_structure['fee_aftemp']);
        $af_template = $this->db->get('hci_feestructure_fees')->row_array();

        $this->db->where('fsf_grade',$studata['st_grade']);
        $this->db->where('fsf_feetemplate',$fee_structure['fee_tftemp']);
        $tf_template = $this->db->get('hci_feestructure_fees')->result_array();

        $this->db->where('fsf_feestructure',$fee_structure['es_feemasterid']);
        $this->db->where('fsf_grade',$studata['pre_prev_class']);
        $this->db->where('fsf_fee',1);
        $fee_data = $this->db->get('hci_feestructure_fees')->result_array();

        $save_inv['inv_student'] = $stuid;
        $save_inv['inv_date'] = date("Y-m-d");;
        $save_inv['inv_status'] = 'P';
        $this->db->insert('hci_invoice',$save_inv);

        $inv_id = $this->db->insert_id();

        $save_fee['invf_invoice'] = $inv_id;
        $save_fee['invf_fee'] = $fee_data['fsf_id'];

        if($studata['pre_payplan']==1)
        {
            $save_fee['invf_amount'] = $fee_data['fsf_amt'];
        }
        else
        {
            $save_fee['invf_amount'] = $fee_data['fsf_slabnew'];
        }
            
        $this->db->insert('hci_invoicefee',$save_fee);

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
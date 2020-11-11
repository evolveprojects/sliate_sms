<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sequence{

	var $CI = null;

    public function __construct()
    {
        $this->CI =& get_instance(); 
        $this->CI->load->database();
    }	
	
    function generate_sequence($key='SEQ',$pad = 0,$altkey ='')
    {
        $r = $this->CI->db->query('SELECT get_next_value(?) as val',($altkey == '' ? $key : $altkey))->row_array();
        if($pad > 0)
            $r['val'] = str_pad($r['val'],$pad,'0',STR_PAD_LEFT);
        return $key . $r['val'];
    }

    function getindexval($string,$pad)
    {
        $this->CI->db->where('HGC_SEQ_Name',$string);
        $nextval = $this->CI->db->get('oth_sequence')->row_array();

        if(empty($nextval))
        {
            return $string.str_pad(1,$pad,"0",STR_PAD_LEFT);
        }
        else
        {
            return $string.str_pad((++$nextval['HGC_SEQ_NextValue']),$pad,"0",STR_PAD_LEFT);
        }
    }
            
}

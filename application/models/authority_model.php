<?php
class authority_model extends CI_Model {
 
 function get_authority(){
  $this->db->select("id");
  $this->db->select("type");
  $this->db->select("name");
  $this->db->select("position");    
  $this->db->from('cfg_common');
  $query = $this->db->get();
  return $query->result_array();
 }
 
}
?>
<?php
class Event_model extends CI_Model {
 
 function getPosts(){
  $this->db->select("events_id");
  $this->db->select("events_name");
  $this->db->select("events_url");
  $this->db->select("is_deleted");    
  $this->db->from('com_latest_events');
  $query = $this->db->get();
  return $query->result_array();
 }
 
}
?>
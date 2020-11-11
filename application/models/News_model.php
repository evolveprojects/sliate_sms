<?php
class News_model extends CI_Model {
 
 function getNews(){
  $this->db->select("news_id");
  $this->db->select("news_name");
  $this->db->select("news_url");
  $this->db->select("is_deleted");  
  $this->db->from('com_latest_news');
  $query = $this->db->get();
  return $query->result_array();
 }
 
}
?>
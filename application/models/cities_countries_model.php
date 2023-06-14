<?php
class Cities_countries_model extends CI_Model {
   public function __construct()
   {
      $this->load->database();
   }

   //fill your cities dropdown depending on the selected city
   public function getCityByCountry($cat_id)
   {
      $this->db->select('*');
      $this->db->from('regions');
      $where = "country_id = '".$cat_id."'";
      $this->db->where($where);
      $query = $this->db->get();
      return $query->result();
   }
}

?>

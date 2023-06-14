<?php
$country_id = $this->input->post('country_id');
$this->db->select('*');
$this->db->from('regions');
$where = "country_id = '".$country_id."'";
$this->db->where($where);
$query = $this->db->get();
foreach ($query->result() as $row)
{
	 //here we build a dropdown item line for each query result
	 $output .= "<option value='".$row->id."'>".$row->name."</option>";
}
echo $output;
?>

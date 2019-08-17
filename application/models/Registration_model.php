<?php 


/**
 * 
 */
class Registration_model extends CI_model{
	
	public function insertUser($data)
	{
		$this->db->insert('surveyor', $data);
	}
}
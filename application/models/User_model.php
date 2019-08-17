<?php 


/**
 * 
 */
class User_model extends CI_model
{

	public function getUser()
	{
		return $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
	}

	public function updatePhoto($imageUpload)
	{
		return $this->db->update('surveyor', ['image' => $imageUpload], ['email' => $this->session->userdata('email')]);
	}
}
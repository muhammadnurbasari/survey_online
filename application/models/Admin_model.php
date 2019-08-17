<?php 


/**
 * 
 */
class Admin_model extends CI_model{
	
	public function getAllUser()
	{
		return $this->db->get('surveyor')->result_array();
	}

	public function getUser()
	{
		return $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
	}

	public function editUser($surveyor_id)
	{
		return $this->db->get_where('surveyor',['surveyor_id' => $surveyor_id ])->row_array();
	}

	public function updateUser()
	{
		$data = [
			'name' => htmlspecialchars($this->input->post('nama', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'role_id' => $this->input->post('role', true),
			'is_active' => $this->input->post('is_active', true)
		];

		return $this->db->update('surveyor', $data, ['surveyor_id' => $this->input->post('id')]);
	}

	public function updateTabelLogin()
	{
		$data = [
			'email' => htmlspecialchars($this->input->post('email', true)),
		];

		return $this->db->update('login', $data, ['id_surveyor' => $this->input->post('id')]);
	}

	public function deleteUser()
	{
		return $this->db->delete('surveyor',['surveyor_id' => $this->input->post('surveyor_id')]);
	}

	public function deleteTabelLogin()
	{
		return $this->db->delete('login',['id_surveyor' => $this->input->post('surveyor_id')]);
	}

	public function updatePhoto($imageUpload)
	{
		return $this->db->update('surveyor', ['image' => $imageUpload], ['email' => $this->session->userdata('email')]);
	}
}
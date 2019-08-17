<?php 


/**
 * 
 */
class Angket_model extends CI_model
{

	// method insert
	public function insertAngket($data)
	{
		return $this->db->insert('angket', $data);
	}

	public function insertPertanyaan($dataPertanyaan)
	{
		return $this->db->insert('angket_detail_pertanyaan', $dataPertanyaan);
	}

	public function insertInterval($dataInterval)
	{
		return $this->db->insert('angket_detail_interval', $dataInterval);
	}
	// selesai method insert



	// method select
	public function selectAngketHeader()
	{
		$this->db->order_by('id_angket', 'DESC');
		$result = $this->db->get('angket')->result_array();
		return $result;
	}

	public function viewHeader($id_angket)
	{
		return $this->db->get_where('angket', ['id_angket' => $id_angket])->row_array();
	}

	public function viewPertanyaan($id_angket)
	{
		// Join table angket dan table angket_detail_pertanyaan ( untuk mengambil data angket dan pertanyaan)

		$this->db->select('angket_detail_pertanyaan.id_pertanyaan,angket_detail_pertanyaan.pertanyaan,angket.judul,angket.id_angket,angket.share,angket.tanggal,angket.is_active,angket.publish');
		$this->db->from('angket');
		$this->db->join('angket_detail_pertanyaan', 'angket.id_angket = angket_detail_pertanyaan.id_angket');
		$this->db->where('angket_detail_pertanyaan.id_angket',$id_angket);
		return $this->db->get()->result_array();
	}

	public function viewInterval($id_angket)
	{
		// Join table angket_detail_interval dan table angket_detail_pertanyaan ( untuk mengambil data interval)

		$this->db->select('angket_detail_pertanyaan.id_pertanyaan,angket_detail_interval.id_interval,angket_detail_interval.nama_interval');
		$this->db->from('angket_detail_interval');
		$this->db->join('angket_detail_pertanyaan', 'angket_detail_interval.id_pertanyaan = angket_detail_pertanyaan.id_pertanyaan');
		$this->db->where('angket_detail_pertanyaan.id_angket',$id_angket);
		return $this->db->get()->result_array();
	}

	// selesai method select


	// method update
	public function updatePublish($id_angket)
	{
		$this->db->set('publish', 1);
		$this->db->where('id_angket', $id_angket);
		return $this->db->update('angket');
	}

	public function updateStop($id_angket)
	{
		$this->db->set('is_active', 0);
		$this->db->where('id_angket', $id_angket);
		return $this->db->update('angket');
	}

	public function updateAngket($id_angket, $data)
	{
		$this->db->where('id_angket', $id_angket);
		return $this->db->update('angket', $data);
	}

	public function updatePertanyaan($id_pertanyaan, $data)
	{
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		return $this->db->update('angket_detail_pertanyaan', $data);
	}

	public function updateInterval($id_interval, $data)
	{
		$this->db->where('id_interval', $id_interval);
		return $this->db->update('angket_detail_interval', $data);
	}
	// selesai method update


	// method delete
	public function deleteInterval($id_pertanyaan)
	{
		// hapus interval
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		return $this->db->delete('angket_detail_interval');
	}

	public function deletePertanyaan($id_pertanyaan)
	{
		// hapus pertanyaan
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		return $this->db->delete('angket_detail_pertanyaan');
	}

	public function deleteAngket($id_angket)
	{
		// hapus pertanyaan
		$this->db->where('id_angket', $id_angket);
		return $this->db->delete('angket');
	}	
	// selesai method delete


}

// dibuat oleh muhammad nur basari



















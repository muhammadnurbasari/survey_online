<?php 


/**
 * 
 */
class Nilai extends CI_controller
{

	public function __construct()
	{
		parent::__construct();

		$nipd = $this->session->userdata('nipd');
		$nidn = $this->session->userdata('nidn');

		if (!$nipd) {
			if (!$nidn) {
			redirect('auth');
			}
		}	
		
	}
	
	public function simpan_nilai()
	{
		$id_angket = $this->input->post('id_angket');
		$item = $this->input->post('item');

		
		if ($this->session->userdata('nipd')) {
			// jika yang isi angket mahasiswa
			$id_responden_mhs = $this->input->post('id_responden_mhs');

			// simpan nilai 
			$data = array(
		        'id_angket' => $id_angket,
		        'id_responden_mhs' => $id_responden_mhs,
			);

			$this->db->insert('nilai', $data);
			// simpan nilai selesai

			// simpan nilai detail
				// ambil id_nilai max
				$this->db->select_max('id_nilai', 'max_id_nilai');
				$queryMax = $this->db->get('nilai')->row_array();
				$max_id_nilai = $queryMax['max_id_nilai'];
				// selesai ambil id_nilai max

				$selesai_looping = count($this->input->post());

				for ($start=0; $start < $selesai_looping - 2; $start++) : 
					$data = array(
					        'nilai' => $this->input->post($start+1),
					        'id_nilai' => $max_id_nilai
					);

					$this->db->insert('nilai_detail', $data);
				endfor;

			// simpan nilai detail selesai

				redirect('responden');

		}else{
			// jika yang isi dosen
			$id_responden_dosen = $this->input->post('id_responden_dosen');

			// simpan nilai
			$data = array(
		        'id_angket' => $id_angket,
		        'id_responden_dosen' => $id_responden_dosen,
			);

			$this->db->insert('nilai', $data);
			// selesai simpan nilai

			// simpan nilai detail
				// ambil id_nilai max
				$this->db->select_max('id_nilai', 'max_id_nilai');
				$queryMax = $this->db->get('nilai')->row_array();
				$max_id_nilai = $queryMax['max_id_nilai'];
				// selesai ambil id_nilai max

				$selesai_looping = count($this->input->post());

				for ($start=0; $start < $selesai_looping - 2; $start++) : 
					$data = array(
					        'nilai' => $this->input->post($start+1),
					        'id_nilai' => $max_id_nilai
					);

					$this->db->insert('nilai_detail', $data);
				endfor;

			// simpan nilai detail selesai
				redirect('responden');
		}
		
	}

	public function grafik()
	{
		
	}
		
}

// dibuat oleh muhammad nur basari


























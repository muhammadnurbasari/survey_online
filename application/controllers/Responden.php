<?php 


/**
 * 
 */
class Responden extends CI_controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Angket_model');
		$this->load->library('form_validation');

		// proteksi apabila ada user coba membuka sebelum login
		$role = $this->session->userdata('role_id');
		$nipd = $this->session->userdata('nipd');
		$nidn = $this->session->userdata('nidn');

		if ($role) {
			// apabila ada surveyor mencoba akses halaman ini maka akan di redirect
			if ($role == 2) {
				redirect('user');	
			}else{
				redirect('admin');	
			}
			
		}

		if (!$nipd) {
			if (!$nidn) {
			redirect('auth');
			}
		}	

	}

	public function index()
	{
		$mahasiswa = $this->session->userdata('nipd');

		// jika login sebagai responden mahasiswa
		if ($mahasiswa) {
			// Qeury hitung semua nagket share angket = public, dan responden mahasiswa sudah isi angket
			$queryPublicJoin = "SELECT count(angket.id_angket) AS hitungJOin FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_mhs =".$this->session->userdata('nipd');
			$publicJoin = $this->db->query($queryPublicJoin)->result_array();
			
			// query hitung semua angket share = public
			$queryPublic = "SELECT count(angket.id_angket) AS hitung FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1";
			$public = $this->db->query($queryPublic)->result_array();
			
			// cek angket dengan share = public
			if ($public[0]['hitung'] === $publicJoin[0]['hitungJOin']) {
				// jika responden mahasiswa sudah mengisi semua angket share = public, maka cek angket share = mahasiswa
				$queryMhsJoin = "SELECT count(angket.id_angket) AS hitungJOin FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'mahasiswa' AND nilai.id_responden_mhs =".$this->session->userdata('nipd');
				$mhsJoin = $this->db->query($queryMhsJoin)->result_array();
				
				// query hitung semua angket share = mahasiswa
				$queryMhs = "SELECT count(angket.id_angket) AS hitung FROM angket WHERE angket.share = 'mahasiswa' AND angket.is_active = 1 AND angket.publish = 1";
				$mhs = $this->db->query($queryMhs)->result_array();
				
				// cek angket dengan share = mahasiswa,jika nagket share = mahasiswa tidak ada akan di reirect ke auth
				if ($mhs[0]['hitung'] === $mhsJoin[0]['hitungJOin']) {
					redirect('auth/logout');
				}else{
					// jika share angket = mahasiswa ada, dan responden mahasiswa belum isi
					$queryMhsNotCount = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'mahasiswa' AND angket.is_active = 1 AND angket.publish = 1";
					$mhsNotCount = $this->db->query($queryMhsNotCount)->result_array();
					
					// looping mencari angket share = mahasiswa yang blum diisi
					for ($i=0; $i < $mhs[0]['hitung'] ; $i++) : 
						$query = "SELECT angket.id_angket FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'mahasiswa' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_mhs =".$this->session->userdata('nipd')." AND nilai.id_angket =".$mhsNotCount[$i]['id_angket'];
						$eksekusi = $this->db->query($query)->result_array();
						
						if (!$eksekusi) {
							$queryMhsEksekusi = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.id_angket=".$mhsNotCount[$i]['id_angket'];
							$mhsEksekusi = $this->db->query($queryMhsEksekusi)->result_array();
							$this->isiAngket($mhsNotCount[$i]['id_angket'], $mhsEksekusi);
							$i = $mhs[0]['hitung'];
						}
					endfor;
				}
				
			}else{
				// jika share angket = public ada, dan responden mahasiswa belum isi
				$queryPublicNotCount = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1";
				$publicNotCount = $this->db->query($queryPublicNotCount)->result_array();
				
				// looping mencari angket share = public yang blum diisi
				for ($i=0; $i < $public[0]['hitung'] ; $i++) : 
					$query = "SELECT angket.id_angket FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_mhs =".$this->session->userdata('nipd')." AND nilai.id_angket =".$publicNotCount[$i]['id_angket'];
					$eksekusi = $this->db->query($query)->result_array();
					
					if (!$eksekusi) {
						$queryPublicEksekusi = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND angket.id_angket=".$publicNotCount[$i]['id_angket'];
						$publicEksekusi = $this->db->query($queryPublicEksekusi)->result_array();
						$this->isiAngket($publicNotCount[$i]['id_angket'], $publicNotCount);
						$i = $public[0]['hitung'];
					}
				endfor;
			}
		}else{

			// jika login sebagai dosen

			// Qeury hitung semua nagket share angket = public, dan responden dosen sudah isi angket
			$queryPublicJoin = "SELECT count(angket.id_angket) AS hitungJOin FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_dosen =".$this->session->userdata('nidn');
			$publicJoin = $this->db->query($queryPublicJoin)->result_array();
			
			// query hitung semua angket share = public
			$queryPublic = "SELECT count(angket.id_angket) AS hitung FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1";
			$public = $this->db->query($queryPublic)->result_array();
			
			// cek angket dengan share = public
			if ($public[0]['hitung'] === $publicJoin[0]['hitungJOin']) {
				// jika responden dosen sudah mengisi semua angket share = public, maka cek angket share = dosen
				$queryDosenJoin = "SELECT count(angket.id_angket) AS hitungJOin FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'dosen' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_dosen =".$this->session->userdata('nidn');
				$DosenJoin = $this->db->query($queryDosenJoin)->result_array();
			
				// query hitung semua angket share = dosen
				$queryDosen = "SELECT count(angket.id_angket) AS hitung FROM angket WHERE angket.share = 'dosen' AND angket.is_active = 1 AND angket.publish = 1";
				$dosen = $this->db->query($queryDosen)->result_array();

				// cek angket dengan share = dosen,jika nagket share = dosen tidak ada akan di reirect ke auth/logout
				if ($dosen[0]['hitung'] === $DosenJoin[0]['hitungJOin']) {
					redirect('auth/logout');
				}else{
					// jika share angket = dosen ada, dan responden dosen belum isi
					$queryDosenNotCount = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'dosen' AND angket.is_active = 1 AND angket.publish = 1";
					$dosenNotCount = $this->db->query($queryDosenNotCount)->result_array();
					
					// looping mencari angket share = dosen yang blum diisi
					for ($i=0; $i < $dosen[0]['hitung'] ; $i++) : 
						$query = "SELECT angket.id_angket FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'dosen' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_dosen =".$this->session->userdata('nidn')." AND nilai.id_angket =".$dosenNotCount[$i]['id_angket'];
						$eksekusi = $this->db->query($query)->result_array();
						
						if (!$eksekusi) {
							$queryDosenEksekusi = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'dosen' AND angket.is_active = 1 AND angket.publish = 1 AND angket.id_angket=".$dosenNotCount[$i]['id_angket'];
							$dosenEksekusi = $this->db->query($queryDosenEksekusi)->result_array();
							$this->isiAngket($dosenNotCount[$i]['id_angket'], $dosenEksekusi);
							$i = $dosen[0]['hitung'];
						}
					endfor;
				}
				
			}else{
				// jika share angket = public ada, dan responden dosen belum isi
				$queryPublicNotCount = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1";
				$publicNotCount = $this->db->query($queryPublicNotCount)->result_array();
				
				// looping mencari angket share = public yang blum diisi
				for ($i=0; $i < $public[0]['hitung'] ; $i++) : 
					$query = "SELECT angket.id_angket FROM angket INNER JOIN nilai ON angket.id_angket = nilai.id_angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND nilai.id_responden_dosen =".$this->session->userdata('nidn')." AND nilai.id_angket =".$publicNotCount[$i]['id_angket'];
					$eksekusi = $this->db->query($query)->result_array();
					
					if (!$eksekusi) {
						$queryPublicEksekusi = "SELECT angket.id_angket,angket.judul FROM angket WHERE angket.share = 'public' AND angket.is_active = 1 AND angket.publish = 1 AND angket.id_angket=".$publicNotCount[$i]['id_angket'];
						$publicEksekusi = $this->db->query($queryPublicEksekusi)->result_array();
						$this->isiAngket($publicNotCount[$i]['id_angket'], $publicEksekusi);
						$i = $public[0]['hitung'];
					}
				endfor;
			}
			
		}
		
	}

	public function isiAngket($id_angket, $share)
	{
			$data['title'] = "Isi Angket";
			$data['angkets'] = $share;
			$queryIntervalPertanyaan = "SELECT angket_detail_pertanyaan.id_pertanyaan,angket_detail_pertanyaan.pertanyaan,angket_detail_interval.nama_interval FROM angket_detail_interval JOIN angket_detail_pertanyaan ON angket_detail_interval.id_pertanyaan = angket_detail_pertanyaan.id_pertanyaan WHERE angket_detail_pertanyaan.id_angket = $id_angket";
			$intervalPertanyaan = $this->db->query($queryIntervalPertanyaan)->result_array();
			$data['intervals'] = $intervalPertanyaan;

			$this->load->view('_partials/auth_header', $data);
			$this->load->view('Responden/index', $data);
			$this->load->view('_partials/auth_footer');
	}

	
}
// dibuat oleh muhammad nur basari

	












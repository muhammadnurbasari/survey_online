<?php 


/**
 * 
 */
class Angket extends CI_controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Angket_model');
		$this->load->library('form_validation');

		// proteksi apabila ada user coba membuka sebelum login
		$role_session = $this->session->userdata('role_id');
		if (!$role_session) {
			redirect('auth');	
		}

	}

	public function index()
	{
		$this->templating('Daftar Angket','angket/index');
	}

	public function viewAngket($id_angket)
	{
		// query menghitung total pertanyaan
		$queryJmlPertanyaan = "SELECT count(angket_detail_pertanyaan.id_pertanyaan) AS jumlah_pertanyaan FROM angket_detail_pertanyaan INNER JOIN angket ON angket_detail_pertanyaan.id_angket = angket.id_angket WHERE angket.id_angket =$id_angket";
		$eksekusiJmlPertanyaan = $this->db->query($queryJmlPertanyaan)->row_array();
		
		// query join menampilkan semua nilai sesuai kode angket
		$queryNilai = "SELECT count(nilai_detail.nilai) AS jumlah_nilai FROM nilai_detail INNER JOIN nilai ON nilai_detail.id_nilai = nilai.id_nilai WHERE nilai.id_angket = $id_angket";
		$eksekusiNilai = $this->db->query($queryNilai)->row_array();

		$total_responden = $eksekusiNilai['jumlah_nilai'] / $eksekusiJmlPertanyaan['jumlah_pertanyaan'];

		// query join menampilkan total nilai sesuai kode angket
		$queryTotalNilai = "SELECT sum(nilai_detail.nilai) AS total_nilai FROM nilai_detail INNER JOIN nilai ON nilai_detail.id_nilai = nilai.id_nilai WHERE nilai.id_angket = $id_angket";
		$eksekusiTotalNilai = $this->db->query($queryTotalNilai)->row_array();

		$data['user'] = $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('surveyor_role',['role_id' => $this->session->userdata('role_id')])->row_array();
		$data['details'] = $this->Angket_model->viewPertanyaan($id_angket);
		$data['detail_header'] = $this->Angket_model->viewHeader($id_angket);
		$data['detail_intervals'] = $this->Angket_model->viewInterval($id_angket);
		$data['total_nilai'] = $eksekusiTotalNilai;
		$data['total_responden'] = $total_responden;
		$data['total_pertanyaan'] = $eksekusiJmlPertanyaan;
		$data['title'] = "View Angket";
		$tempt = 'angket/viewAngket';

		$this->load->view('_partials/header', $data);
		$this->load->view('_partials/sidebar');
		$this->load->view('_partials/topbar');
		$this->load->view($tempt, $data);
		$this->load->view('_partials/footer');
	}

	public function publish($id_angket, $link_publish)
	{
		if ($link_publish === "Publish") {
			$data = $this->Angket_model->viewPertanyaan($id_angket);
			$this->Angket_model->updatePublish($id_angket);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Angket Sudah Di <strong>Publish</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button></div>');
			redirect('angket/viewAngket/'.$id_angket);
		}else{
			if ($link_publish === "Stop") {
			$this->Angket_model->updateStop($id_angket);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Proses Survei Sudah <strong>Selesai</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button></div>');
			redirect('angket/viewAngket/'.$id_angket);
			}
		}
	}


	public function edit_angket($id_angket)
	{
		$data['user'] = $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('surveyor_role',['role_id' => $this->session->userdata('role_id')])->row_array();
		$data['details'] = $this->Angket_model->viewPertanyaan($id_angket);
		$data['detail_intervals'] = $this->Angket_model->viewInterval($id_angket);
		$data['detail_header'] = $this->Angket_model->viewHeader($id_angket);
		$data['title'] = "Edit Angket";
		$tempt = 'angket/editAngket';

		$this->load->view('_partials/header', $data);
		$this->load->view('_partials/sidebar');
		$this->load->view('_partials/topbar');
		$this->load->view($tempt, $data);
		$this->load->view('_partials/footer');	
	}

	public function hapus_pertanyaan($id_pertanyaan, $id_angket)
	{
		// jika pertanyaan sisa satu, maka tidak bisa dihapus
		$query = "SELECT count(pertanyaan) FROM angket_detail_pertanyaan WHERE id_angket = $id_angket";
		$total_pertanyaan_sisa = $this->db->query($query)->row_array();
		if ($total_pertanyaan_sisa['count(pertanyaan)'] == 1) {
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Tidak Bisa Menghapus, Minimal harus ada 1 pertanyaan !!!</div>');
			redirect('angket/edit_angket/'.$id_angket);
		}else{
			$this->Angket_model->deleteInterval($id_pertanyaan);
			$this->Angket_model->deletePertanyaan($id_pertanyaan);
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Satu Pertanyan Yang Sudah Tersimpan Berhasil Dihapus !!!</div>');
			redirect('angket/edit_angket/'.$id_angket);
		}	
	}

	public function re_survei()
	{
		// ambil id_angket
		$id_angket = $this->input->post('id_angket');

		// hapus nilai dan nilai detail
		$queryHapusNilai = "SELECT nilai.id_nilai FROM nilai WHERE nilai.id_angket = $id_angket";
		$hapusNilai = $this->db->query($queryHapusNilai)->result_array();

		for ($a=0; $a < count($hapusNilai) ; $a++) { 
			$deleteNilaiDetail = "DELETE FROM nilai_detail WHERE nilai_detail.id_nilai =".$hapusNilai[$a]['id_nilai'];
			$this->db->query($deleteNilaiDetail);
		}

		for ($b=0; $b < count($hapusNilai) ; $b++) { 
			$deleteNilai = "DELETE FROM nilai WHERE nilai.id_nilai =".$hapusNilai[$b]['id_nilai'];
			$this->db->query($deleteNilai);
		}
		// selesai hapus nilai dan nilai detail

		// update angket is_active = 1, dan publish = 1
		$data = array(
        'is_active' => true,
        'publish' => false
		);

		$this->db->where('id_angket', $id_angket);
		$this->db->update('angket', $data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil RE - SURVEI ( Silahkan Publish, supaya mendapatkan data dari responden terbaru ) !!!</div>');
		redirect('angket/viewAngket/'.$id_angket);
	}

	public function hapus_angket()
	{
		// ambil id_angket
		$id_angket = $this->input->post('id_angket');

		// ambil id_pertanyaan
		$gabungan = $this->Angket_model->viewPertanyaan($id_angket);
		$judul = $gabungan[0]['judul'];
		$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Angket Berjudul = '.$judul.' Telah Di HAPUS !!!</div>');

		for ($i=0; $i < count($gabungan); $i++) { 
			$id_pertanyaan[] = $gabungan[$i]['id_pertanyaan'];
		}
		
		// hapus interval
		for ($interval=0; $interval < count($id_pertanyaan) ; $interval++) { 
			$this->Angket_model->deleteInterval($id_pertanyaan[$interval]);
		}

		// hapus pertanyaan
		for ($pertanyaan=0; $pertanyaan < count($id_pertanyaan) ; $pertanyaan++) { 
			$this->Angket_model->deletePertanyaan($id_pertanyaan[$pertanyaan]);
		}

		// hapus nilai dan nilai detail
		$queryHapusNilai = "SELECT nilai.id_nilai FROM nilai WHERE nilai.id_angket = $id_angket";
		$hapusNilai = $this->db->query($queryHapusNilai)->result_array();

		for ($a=0; $a < count($hapusNilai) ; $a++) { 
			$deleteNilaiDetail = "DELETE FROM nilai_detail WHERE nilai_detail.id_nilai =".$hapusNilai[$a]['id_nilai'];
			$this->db->query($deleteNilaiDetail);
		}

		for ($b=0; $b < count($hapusNilai) ; $b++) { 
			$deleteNilai = "DELETE FROM nilai WHERE nilai.id_nilai =".$hapusNilai[$b]['id_nilai'];
			$this->db->query($deleteNilai);
		}
		// selesai hapus nilai dan nilai detail

		// hapus angket
		$this->Angket_model->deleteAngket($id_angket);
		// redirect ke halaman angket
		redirect('angket/index');

		
	}

	public function update_header_angket()
	{
		// method ini akan dipanggil di methode update_angket()
		// update angket
					$data = [
						'judul' => htmlspecialchars($this->input->post('judul_angket', true)),
						'share' => htmlspecialchars($this->input->post('share', true)),
						'update_by' => $this->session->userdata('surveyor_id')
					];	
					$this->Angket_model->updateAngket($this->input->post('id_angket'), $data);
		// selesai update angket
	}

	public function update_pertanyaan_lama()
	{
		// method ini akan dipanggil di methode update_angket()
		$pertanyaan = $this->input->post('item', true);
		$id_angket = $this->input->post('id_angket');

				// update angket_detail_pertanyaan
					// memasukkan kedalam array total id_pertanyaan
					for ($i=0; $i < count($pertanyaan['question_id']) ; $i++) : 
						$total_id_pertanyaan[] = $pertanyaan['question_id'][$i];
					endfor;
					

					// memasukkan kedalam array total pertanyaan
					for ($i=0; $i < count($pertanyaan['question']) ; $i++) : 
						$total_pertanyaan[] = $pertanyaan['question'][$i];
					endfor;
				
					// update pertanyaan lama
					for ($start=0; $start < count($total_id_pertanyaan) ; $start++) :
						$data = [
							'pertanyaan' => $total_pertanyaan[$start]
						];
						$this->Angket_model->updatePertanyaan($total_id_pertanyaan[$start], $data);
					endfor;
					// selesai update pertanyaan lama

					// memasukkan kedalam array total id_interval
					for ($i=0; $i < count($pertanyaan['option_id']) ; $i++) : 
						$total_id_interval[] = $pertanyaan['option_id'][$i];
					endfor;
					

					// memasukkan kedalam array total nama interval
					for ($i=0; $i < count($pertanyaan['option']) ; $i++) : 
						$total_interval[] = $pertanyaan['option'][$i];
					endfor;

					// update interval lama
					for ($start=0; $start < count($total_id_interval) ; $start++) :
						$data = [
							'nama_interval' => $total_interval[$start]
						];
						$this->Angket_model->updateInterval($total_id_interval[$start],$data);
					endfor;
					// selesai update interval lama		
	}

	public function save_pertanyaan_baru()
	{
		// method ini akan dipanggil di methode update_angket()
			$pertanyaan = $this->input->post('item', true);
			$id_angket = $this->input->post('id_angket');

			// ambil id_pertanyaan (max) pertanyaan lama
			$query = "SELECT max(id_pertanyaan) FROM angket_detail_pertanyaan WHERE id_angket = $id_angket";
			$hasil_query = $this->db->query($query)->row_array();
			$id_pertanyaan_lama_max = $hasil_query['max(id_pertanyaan)'];
			

			// memasukkan kedalam array total pertanyaan
			for ($i=0; $i < count($pertanyaan['question_baru']) ; $i++) : 
				$total_pertanyaan[] = $pertanyaan['question_baru'][$i];
			endfor;
			
			// simpan pertanyaan baru
			for ($i=0; $i < count($total_pertanyaan) ; $i++) :
				$dataPertanyaan = [
						'pertanyaan' => $total_pertanyaan[$i],
						'id_angket' => $id_angket
				];
				$this->Angket_model->insertPertanyaan($dataPertanyaan);
			endfor;
			// selesai simpan pertanyaan baru

		
			// memasukkan kedalam array total interval baru
			for ($i=0; $i < count($pertanyaan['option_baru']) ; $i++) : 
				$total_option[] = $pertanyaan['option_baru'][$i];
			endfor;
			
			// memasukkan array $total_option[] dalam array $option_array[]
			$start = 5;
			$indikator = 0;
			for ($a=0; $a < count($total_option)/5; $a++) {
				$option =[];
				for ($b=$indikator; $b < $start ; $b++) { 
					$option[] = $total_option[$b];
				}
				$option_array[] = $option;
				$start = $start + 5;
				$indikator = $indikator + 5;
			}

			

			// mengambil Id_pertanyaan yang baru disimpan untuk digunakan proses simpan
			$query2 = "SELECT id_pertanyaan FROM angket_detail_pertanyaan WHERE id_angket = $id_angket AND id_pertanyaan > $id_pertanyaan_lama_max";
			$id_pertanyaan_baru = $this->db->query($query2)->result_array();
			
			// simpan interval
			$start = 0;
			for ($arr=0; $arr < count($id_pertanyaan_baru) ; $arr++) { 
				$dataInterval = [];
				for ($i=0; $i < 5 ; $i++) :
					$dataInterval = [
							'nama_interval' => $option_array[$start][$i],
							'id_pertanyaan' => $id_pertanyaan_baru[$start]['id_pertanyaan']
					];
					$this->Angket_model->insertInterval($dataInterval);
				endfor;
				$start = $start + 1;
			}
		// selesai simpan angket_detail_interval

	}


	public function update_pertanyaan_terbaru()
	{
		// untuk menyimpan pertanyaan apabila semua pertanyaan yang sudah tersimpan dihapus
		// method ini akan dipanggil di methode update_angket()
		$pertanyaan = $this->input->post('item', true);
		$id_angket = $this->input->post('id_angket');

		// simpan angket_detail_pertanyaan
			// memasukkan kedalam array total pertanyaan
			for ($i=0; $i < count($pertanyaan['question_baru']) ; $i++) : 
				$total_pertanyaan[] = $pertanyaan['question_baru'][$i];
			endfor;
			
			// simpan pertanyaan
			for ($i=0; $i < count($total_pertanyaan) ; $i++) :
				$dataPertanyaan = [
						'pertanyaan' => $total_pertanyaan[$i],
						'id_angket' => $id_angket
				];
				$this->Angket_model->insertPertanyaan($dataPertanyaan);
			endfor;
		// selesai simpan angket_detail_pertanyaan

		// simpan angket_detail_interval
			// memasukkan kedalam array total interval
			for ($i=0; $i < count($pertanyaan['option_baru']) ; $i++) : 
				$total_option[] = $pertanyaan['option_baru'][$i];
			endfor;
			
			// memasukkan array $total_option[] dalam array $option_array[]
			// deklarasi variable 
			$start = 5;
			$indikator = 0;
			for ($a=0; $a < count($total_option)/5; $a++) {
				$option =[];
				for ($b=$indikator; $b < $start ; $b++) { 
					$option[] = $total_option[$b];
				}
				$option_array[] = $option;
				$start = $start + 5;
				$indikator = $indikator + 5;
			}

			// mengambil Id_pertanyaan untuk digunakan proses simpan
			$this->db->select('id_pertanyaan');
			$id_pertanyaan = $this->db->get_where('angket_detail_pertanyaan',['id_angket' => $id_angket])->result_array();
			// simpan interval
			$start = 0;
			for ($arr=0; $arr < count($id_pertanyaan) ; $arr++) { 
				$dataInterval = [];
				for ($i=0; $i < 5 ; $i++) :
					$dataInterval = [
							'nama_interval' => $option_array[$start][$i],
							'id_pertanyaan' => $id_pertanyaan[$start]['id_pertanyaan']
					];
					$this->Angket_model->insertInterval($dataInterval);
				endfor;
				$start = $start + 1;
			}
		// selesai simpan angket_detail_interval
	}


	public function update_angket()
	{
		$pertanyaan = $this->input->post('item', true);
		$id_angket = $this->input->post('id_angket');

		// cek jika pertanyaan telah dihapus semua
		$query = "SELECT count(pertanyaan) FROM angket_detail_pertanyaan WHERE id_angket = $id_angket";
		$cek_pertanyaan = $this->db->query($query)->row_array();

		if ($cek_pertanyaan['count(pertanyaan)'] == 0 && count($pertanyaan) > 0) {
			$this->update_header_angket();
			$this->update_pertanyaan_terbaru();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Update Angket ( menghapus pertanyaan lama dan menambahkan pertanyaan baru ) !!!</div>');
			redirect('angket/viewAngket/'.$id_angket);
		}else{
			// kondisi jika semua pertanyaan dihapus
			if (count($pertanyaan['question_id']) == 0 && count($pertanyaan['question_baru']) == 0) {
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Tidak bisa di Update, Minimal harus ada satu pertanyaan !!!</div>');
				redirect('angket/edit_angket/'.$id_angket);
			}else{
				// kodisi jika hanya update pertanyaan lama tanpa menambah pertanyaan baru
				if (count($pertanyaan['question_id']) > 0 && count($pertanyaan['question_baru']) == 0) {
					$this->update_header_angket();
					$this->update_pertanyaan_lama();
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Update Angket (Tidak menambahkan pertanyaan baru ?)</div>');
					redirect('angket/viewAngket/'.$id_angket);
				}else{
					// kondisi jika update pertanyaan lama dan menambah pertanyaan baru
					if (count($pertanyaan['question_id']) > 0 && count($pertanyaan['question_baru']) > 0) {
						$this->update_header_angket();
						$this->update_pertanyaan_lama();
						$this->save_pertanyaan_baru();
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Update Angket dan menambahkan pertanyaan baru!!!</div>');
						redirect('angket/viewAngket/'.$id_angket);	
					}
				}
			}
		}

	}


	public function save_angket()
	{
		$pertanyaan = $this->input->post('item', true);
		
		if ($pertanyaan == 0) {
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Anda Belum Membuat Pertanyaan dan interval <strong> Silahkan Klik Add Questions </strong> !!!</div>');
			redirect('user/create_angket');
		}
		// simpan angket
			$data = [
				'tanggal' => date('Y-m-d'),
				'judul' => htmlspecialchars($this->input->post('judul_angket', true)),
				'share' => htmlspecialchars($this->input->post('share', true)),
				'is_active' => 1,
				'publish' => 0,
				'created_by' => $this->session->userdata('surveyor_id'),
				'update_by' => 0
			];

			$this->Angket_model->insertAngket($data);
		// selesai simpan angket
		
		// simpan angket_detail_pertanyaan
			// memasukkan kedalam array total pertanyaan
			for ($i=0; $i < count($pertanyaan['question']) ; $i++) : 
				$total_pertanyaan[] = $pertanyaan['question'][$i];
			endfor;
			
			// mengambil id_angket
			$this->db->select_max('id_angket');
			$id_angkets = $this->db->get('angket')->row_array(); 
			$id_angket = $id_angkets['id_angket'];
			
			// simpan pertanyaan
			for ($i=0; $i < count($total_pertanyaan) ; $i++) :
				$dataPertanyaan = [
						'pertanyaan' => $total_pertanyaan[$i],
						'id_angket' => $id_angket
				];
				$this->Angket_model->insertPertanyaan($dataPertanyaan);
			endfor;
		// selesai simpan angket_detail_pertanyaan

		// simpan angket_detail_interval
			// memasukkan kedalam array total interval
			for ($i=0; $i < count($pertanyaan['option']) ; $i++) : 
				$total_option[] = $pertanyaan['option'][$i];
			endfor;
			
			// memasukkan array $total_option[] dalam array $option_array[]
			// deklarasi variable 
			$start = 5;
			$indikator = 0;
			for ($a=0; $a < count($total_option)/5; $a++) {
				$option =[];
				for ($b=$indikator; $b < $start ; $b++) { 
					$option[] = $total_option[$b];
				}
				$option_array[] = $option;
				$start = $start + 5;
				$indikator = $indikator + 5;
			}

			// mengambil Id_pertanyaan untuk digunakan proses simpan
			$this->db->select('id_pertanyaan');
			$id_pertanyaan = $this->db->get_where('angket_detail_pertanyaan',['id_angket' => $id_angket])->result_array();
			// simpan interval
			$start = 0;
			for ($arr=0; $arr < count($id_pertanyaan) ; $arr++) { 
				$dataInterval = [];
				for ($i=0; $i < 5 ; $i++) :
					$dataInterval = [
							'nama_interval' => $option_array[$start][$i],
							'id_pertanyaan' => $id_pertanyaan[$start]['id_pertanyaan']
					];
					$this->Angket_model->insertInterval($dataInterval);
				endfor;
				$start = $start + 1;
			}
		// selesai simpan angket_detail_interval

			// halaman dialihkan ke data angket dengan mengirim pesan berhasil
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Angket berhasil di simpan !!!</div>');
			redirect('angket/viewAngket/'.$id_angket);
	}

	public function grafik($id_angket)
	{
		// method ini digunakan untuk menampilkan grafik dari survei
		// grafik dinilai dari total jumlah responden dan total nilai yang didapatkan

		// judul angket
		$query3 = "SELECT angket.judul,angket.id_angket FROM angket WHERE angket.id_angket = $id_angket";
		$judulAngket = $this->db->query($query3)->row_array();
		// selesai judul angket

		// daftar pertanyaan
		$query = "SELECT angket_detail_pertanyaan.pertanyaan FROM angket_detail_pertanyaan INNER JOIN angket ON angket_detail_pertanyaan.id_angket = angket.id_angket WHERE angket.id_angket = $id_angket";
		$daftarPertanyaan = $this->db->query($query)->result_array();
		// selesai daftar pertanyaan

		// total nilai setiap pertanyaan
		$query2 = "SELECT nilai_detail.nilai FROM nilai_detail INNER JOIN nilai ON nilai_detail.id_nilai = nilai.id_nilai WHERE nilai.id_angket = $id_angket";
		$totalNilai = $this->db->query($query2)->result_array();

		if (count($totalNilai) / count($daftarPertanyaan) > 1) {
			$awal = 0;
			$tambah = 0;
			for ($i=0; $i < count($daftarPertanyaan) ; $i++) : 
				$nilai = 0;
				for ($a=0; $a < count($totalNilai) / count($daftarPertanyaan)  ; $a++) { 
					$nilai = $nilai + $totalNilai[$awal]['nilai'];
					$awal = $awal + count($daftarPertanyaan);
				}
				$nilaiAkhir[] = $nilai;
				$awal = 0;
				$tambah = $tambah + 1;
				$awal = $awal + $tambah;
			endfor;
		}else{
			if (count($totalNilai) == 0) {
				$nilaiAkhir = [] ;
			}else{
			$nilaiAkhir[] = $totalNilai[0]['nilai'];
			}
		}

		$daftarNilai = $nilaiAkhir;
		// selesai total nilai setiap pertanyaan

		$data['judul'] = $judulAngket;
		$data['daftar_nilai'] = $daftarNilai;
		$data['daftar_pertanyaan'] = $daftarPertanyaan;
		$data['title'] = 'Grafik';
		$this->load->view('_partials/auth_header', $data);
		$this->load->view('angket/grafik');
		$this->load->view('_partials/auth_footer');

	}

	public function cetak_nilai($id_angket)
	{
		$query = "SELECT judul FROM angket WHERE id_angket = $id_angket";
		$eksekusi = $this->db->query($query)->row_array();
		
		// query menghitung total pertanyaan
		$queryJmlPertanyaan = "SELECT count(angket_detail_pertanyaan.id_pertanyaan) AS jumlah_pertanyaan FROM angket_detail_pertanyaan INNER JOIN angket ON angket_detail_pertanyaan.id_angket = angket.id_angket WHERE angket.id_angket =$id_angket";
		$eksekusiJmlPertanyaan = $this->db->query($queryJmlPertanyaan)->row_array();
		
		// query join menampilkan semua nilai sesuai kode angket
		$queryNilai = "SELECT nilai_detail.nilai FROM nilai_detail INNER JOIN nilai ON nilai_detail.id_nilai = nilai.id_nilai WHERE nilai.id_angket = $id_angket";
		$eksekusiNilai = $this->db->query($queryNilai)->result_array();

		// query join menampilkan total nilai sesuai kode angket
		$queryTotalNilai = "SELECT sum(nilai_detail.nilai) AS total_nilai FROM nilai_detail INNER JOIN nilai ON nilai_detail.id_nilai = nilai.id_nilai WHERE nilai.id_angket = $id_angket";
		$eksekusiTotalNilai = $this->db->query($queryTotalNilai)->row_array();
		
		$total_responden = count($eksekusiNilai) / $eksekusiJmlPertanyaan['jumlah_pertanyaan'];

		$mpdf = new \Mpdf\Mpdf([190,236]);
		$html = '<!DOCTYPE html>
		<html>

		<head>
		  <title>'. SITE_NAME .' || cetak nilai</title>

		  <style type="text/css">
		  	 img{
		      float: left;
		    }
		  	 h3{
		      text-align: center;
		      margin-top: 0;
		      margin-bottom: 0;
		    }
		     h4{
		      text-align: center;
		    }
		    hr{
		      margin-top: 0;
		      margin-bottom: 0;
		    }
		     table{
		      text-align: center;
		    }
		    th{
		      text-align: center;
		      background-color: #4169E1;
		    }
		    tr{
		      text-align: center;
		      background-color: #ddd;
		      font-family: times new roman;
		    }
		    footer{
		    	text-align: center;
		    	margin-top: 50px;
		    }
		  </style>
		</head>

		  <body>
		  <img src=" '.base_url('assets/img/LOGO BARU STMIK Insan P.png').' " style="width:90px;height:90px;">
		    <h3>Data Nilai Survei
		    <h4>" '.$eksekusi['judul'].' "</h4>
		    </h3>
		    <hr>
		    <h5 style="margin-left:530px;">Tanggal : '.date('d M Y').'</h5>
		    <h5>Summary</h5>
		    <h5>
		    	|| Total responden : '.count($eksekusiNilai) / $eksekusiJmlPertanyaan['jumlah_pertanyaan'].'
		    	|| Total Nilai     : '.$eksekusiTotalNilai['total_nilai'].'
		    	||
		    </h5>
		    <table border="0">
			  <tr>
			    <th>Interval</th>
			    <th>Grade</th>
			    <th>Keterangan</th>
			  </tr>';
						$interval_puncak = $total_responden * $eksekusiJmlPertanyaan['jumlah_pertanyaan'] * 5;

						$panjang_interval = $interval_puncak / 5;
						$awal = 0;
						$akhir = 0;
						$grade_string = ['A','B','C','D','E'];
						$keterangan_string = ['Sangat Baik','Baik','Cukup Baik','Kurang Baik','Buruk'];

						for ($i=0; $i < 5; $i++) { 
						$interval_awal = $interval_puncak - $panjang_interval - $awal + 1;
						$interval_akhir = $interval_puncak - $akhir;
						$html .= '<tr>';
						$html .= '<td>'.$interval_awal.' - '.$interval_akhir.'</td>';
						$html .= '<td>'.$grade_string[$i].'</td>';
						$html .= '<td>'.$keterangan_string[$i].'</td>';
						$html .= '</tr>';
						$awal = $awal + $panjang_interval;
						$akhir = $akhir + $panjang_interval;
							}; 
	
	$html .= '</table>
			 <h5>Detail</h5>
		    <table border="0">
			  <tr>
			    <th rowspan="2">No</th>
			    <th colspan="'.$eksekusiJmlPertanyaan['jumlah_pertanyaan'].'" width="800">PERTANYAAN</th>
			    <th rowspan="2">Total</th>
			  </tr>
			  <tr>';
			  // looping header jumlah pertanyaan
			    for ($i=1; $i <= $eksekusiJmlPertanyaan['jumlah_pertanyaan']; $i++) {
			    	$html .= '<th>Ke - '.$i.'</th>';	
			    };
	$html .= '</tr>';		  
				// looping no urut, dan nilai
				$mulai = 0;
				for ($i=1; $i <= count($eksekusiNilai) / $eksekusiJmlPertanyaan['jumlah_pertanyaan'] ; $i++) { 

					$html .= '<tr>';
					$html .= '<td>('.$i.')';		
					$html .= '</td>';

					
					$total = 0;
						// looping nilai
						for ($startnilai= 0; $startnilai < $eksekusiJmlPertanyaan['jumlah_pertanyaan'] ; $startnilai++) { 
							$html .= '<td>'.$eksekusiNilai[$mulai]['nilai'].'</td>';
							$total = $total + $eksekusiNilai[$mulai]['nilai'];
							$mulai = $mulai + 1;
						};
						
					$html .= '<td>'.$total.'';		
					$html .= '</td>';
					$html .= '</tr>';
					
					$mulai = $mulai;
				};
	 			
	$html .= '</table>
 			</body>
			</html>';

		$mpdf->WriteHTML($html);
		$mpdf->setHTMLFooter('<footer>
                 <span>Copyright &copy; STMIK IP 2019</span>
          	</footer>',[]);
		$mpdf->Output($eksekusi['judul'].'.pdf', 'i');
	}

	private function templating($judul,$halaman)
	{
		$data['user'] = $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('surveyor_role',['role_id' => $this->session->userdata('role_id')])->row_array();
		$data['title'] = $judul;
		$data['angkets'] = $this->Angket_model->selectAngketHeader();
		$tempt = $halaman;

		$this->load->view('_partials/header', $data);
		$this->load->view('_partials/sidebar');
		$this->load->view('_partials/topbar');
		$this->load->view($tempt, $data);
		$this->load->view('_partials/footer');
	}

	
}
// dibuat oleh muhammad nur basari






















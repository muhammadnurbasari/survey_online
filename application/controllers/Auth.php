<?php 


/**
 * 
 */
class Auth extends CI_controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Registration_model');
		
		
	}
	
	public function index()
	{
		$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password','password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('_partials/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('_partials/auth_footer');
		}else{
			// validation success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		// get login
		$login = $this->db->get_where('login', ['email' => $email])->row_array();
		if ($login === Null) {

			// get surveyor
			$surveyor = $this->db->get_where('surveyor', ['email' => $email])->row_array();
			// jika surveyor ada
			if ($surveyor) {
				// cek aktivasi
				if ($surveyor['is_active'] == 1) {
					// cek password
					if (password_verify($password, $surveyor['password'])) {
						$data = [
							'email' => $surveyor['email'],
							'surveyor_id' => $surveyor['surveyor_id'],
							'role_id' => $surveyor['role_id'],
							'name' => $surveyor['name']
						];
						$this->session->set_userdata($data);
						if ($surveyor['role_id'] == 1) {
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Sistem merekomendasi untuk mengubah Password, <strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah
                      </a></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button></div>');
							redirect('admin');
						}else{
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Sistem merekomendasi untuk mengubah Password, <strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah
                      </a></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button></div>');
							redirect('user');
						}
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password !!</div>');
						redirect('auth');
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your email has been activated !!</div>');
					redirect('auth');
				}
			}else{
				$this->db->select('mahasiswa_pt.nipd,mahasiswa.email');
				$this->db->from('mahasiswa_pt');
				$this->db->where('email', $email);
				$this->db->join('mahasiswa', 'mahasiswa_pt.id_pd = mahasiswa.id_pd');
				$mahasiswa = $this->db->get()->row_array();
				// jika login sebagai mahasiswa
				if ($mahasiswa) {
					
					// cek password menggunakan nipd
					if ($password == $mahasiswa['nipd']) {
						$data = [
							'email' => $mahasiswa['email'],
							'nipd' => $mahasiswa['nipd'],
						];
						$this->session->set_userdata($data);
						$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Sistem merekomendasi untuk mengubah Password, <strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah
                      </a></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button></div>');
						redirect('responden');
					}else{
						// jika password salah
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password !!</div>');
						redirect('auth');
					}
				}else{
					$this->db->select('nidn,email');
					$dosen = $this->db->get_where('dosen', ['email' => $email])->row_array();
					
					// jika login sebagai dosen
					if ($dosen) {
						// cek password menggunakan nidn
						if ($password == $dosen['nidn']) {
							$data = [
								'email' => $dosen['email'],
								'nidn' => $dosen['nidn'],
							];
							$this->session->set_userdata($data);
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">Sistem merekomendasi untuk mengubah Password, <strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah
                      </a></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button></div>');
							redirect('responden');
						}else{
							// jika password salah
							$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!!</div>');
							redirect('auth');
						}
					}else{
					// 	// jika tidak ada semuanya
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your email is not register!!</div>');
						redirect('auth');
					}
				}
			}
		}else{
			// jika tabel login tidak null

			if ($login['id_surveyor'] != null) {
				// jika id_surveyor tidak kosong
				$surveyor = $this->db->get_where('surveyor',['surveyor_id' => $login['id_surveyor']])->row_array();
				if (password_verify($password, $login['password'])) {
					// cek password verifikasi
					if ($surveyor['is_active'] == 1) {
						// cek jika status aktif
						$data = [
							'email' => $surveyor['email'],
							'surveyor_id' => $surveyor['surveyor_id'],
							'role_id' => $surveyor['role_id'],
							'name' => $surveyor['name']
						];
						$this->session->set_userdata($data);

						if ($surveyor['role_id'] == 1) {
						// jika masuk sebagai admin
							redirect('admin');
						}else{
							// jika masuk sebagai surveyor
							if ($surveyor['role_id'] == 2) {
								redirect('user');
							}
						}
					}else{
						// jika status tidak aktif
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Status surveyor tidak aktif!!</div>');
						redirect('auth');
					}
					
				}else{
					// jika password tidak terverivikasi
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password!!</div>');
						redirect('auth');
				}	
			}else{
				if ($login['id_responden_mhs'] != null) {
					// jika id_responden_mhs tidak null
					$this->db->select('mahasiswa_pt.nipd,mahasiswa.email');
					$this->db->from('mahasiswa_pt');
					$this->db->where('email', $email);
					$this->db->join('mahasiswa', 'mahasiswa_pt.id_pd = mahasiswa.id_pd');
					$mahasiswa = $this->db->get()->row_array();
					if (password_verify($password, $login['password'])) {
						// jika password terverivikasi
						$data = [
							'email' => $mahasiswa['email'],
							'nipd' => $mahasiswa['nipd'],
						];
						$this->session->set_userdata($data);
						redirect('responden');
					}else{
						// jika password tidak terverivikasi
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password!!</div>');
							redirect('auth');
					}
				}else{
					// jika id_responden_dosen ada
					if ($login['id_responden_dosen'] != null) {
						if (password_verify($password, $login['password'])) {
							// jika password terverivikasi
							$this->db->select('nidn,email');
							$dosen = $this->db->get_where('dosen', ['email' => $email])->row_array();
							$data = [
									'email' => $dosen['email'],
									'nidn' => $dosen['nidn'],
								];
							$this->session->set_userdata($data);
							redirect('responden');
						}else{
							// jika password salah
							$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password!!</div>');
							redirect('auth');
						}
					}
				}
			}

		}
		
	}

		public function registration()
	{
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[surveyor.email]',[
			'is_unique' => 'this email has already register!!!'
		]);
		$this->form_validation->set_rules('password','Password','required|trim|min_length[5]|matches[passconf]',[
			'matches'=> 'Password Dont Matches!!',
			'min_length' => 'Password too short!!'
		]);
		$this->form_validation->set_rules('passconf','Passconf','required|trim|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Registration';
			$data['user'] = $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
			$this->load->view('_partials/header', $data);
			$this->load->view('_partials/sidebar');
			$this->load->view('_partials/topbar');
			$this->load->view('auth/registration', $data);
			$this->load->view('_partials/footer');
		}else{
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'image' => 'profile.png',
				'role_id' => 2,
				'is_active' => 1,
				'created_date' => date('Y-m-d')
			];

			$this->Registration_model->insertUser($data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation! A New Member has been created !!!</div>');
			redirect('admin/data_user');
		}
	}

	public function ubah_pass()
	{
		
		if ($this->session->userdata('role_id') == 1) {
			// jika masuk sebagai admin
			$passlama = $this->input->post('passwordlama');
			$cekpasslama = $this->db->get_where('surveyor', ['email' => $this->session->userdata('email')])->row_array();
			
			// cek password lama sama atau tidak
			if (password_verify($passlama, $cekpasslama['password'])) {
				// jika password lama sesuai dengan yang diinput
				if ($this->input->post('passwordbaru') != $this->input->post('konfirmasi')) {
					// jika password baru tidak sama dengan konfirmasi
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password baru tidak sama dengan konfirmasi password,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('admin');
				}else{
					// jika password baru sama dengan konfirmasi maka password baru akan disimpan
					$passbaru = $this->input->post('passwordbaru');
					$data = array(
			        'email' => $this->session->userdata('email'),
			        'password' => password_hash($passbaru, PASSWORD_DEFAULT),
			        'id_surveyor' => $cekpasslama['surveyor_id']
					);

					$this->db->insert('Login', $data);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Ubah password berhasil !!!</div>');
					redirect('admin');
				}
			}else{
				// jika password lama tidak sesuai dengan yang diinput
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password lama tidak sesuai,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('admin');
			}

		}

		if ($this->session->userdata('role_id') == 2) {
			// jika masuk sebagai surveyor
			$passlama = $this->input->post('passwordlama');
			$cekpasslama = $this->db->get_where('surveyor', ['email' => $this->session->userdata('email')])->row_array();
			
			// cek password lama sama atau tidak
			if (password_verify($passlama, $cekpasslama['password'])) {
				// jika password lama sesuai dengan yang diinput
				if ($this->input->post('passwordbaru') != $this->input->post('konfirmasi')) {
					// jika password baru tidak sama dengan konfirmasi
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password baru tidak sama dengan konfirmasi password,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('user');
				}else{
					// jika password baru sama dengan konfirmasi maka password baru akan disimpan
					$passbaru = $this->input->post('passwordbaru');
					$data = array(
			        'email' => $this->session->userdata('email'),
			        'password' => password_hash($passbaru, PASSWORD_DEFAULT),
			        'id_surveyor' => $cekpasslama['surveyor_id']
					);

					$this->db->insert('Login', $data);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Ubah password berhasil !!!</div>');
					redirect('user');
				}
			}else{
				// jika password lama tidak sesuai dengan yang diinput
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password lama tidak sesuai,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('user');
			}

		}

		$nidn = $this->session->userdata('nidn');
		if ($nidn) {
			// jika masuk sebagai dosen
			$passlama = $this->input->post('passwordlama');
			$cekpasslama = $this->db->get_where('dosen', ['nidn' => $nidn])->row_array();
			// cek password lama sama atau tidak
			if ($passlama == $cekpasslama['nidn']) {
				// jika password lama sesuai dengan yang diinput
				if ($this->input->post('passwordbaru') != $this->input->post('konfirmasi')) {
					// jika password baru tidak sama dengan konfirmasi
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password baru tidak sama dengan konfirmasi password,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('responden');
				}else{
					// jika password baru sama dengan konfirmasi maka password baru akan disimpan
					$passbaru = $this->input->post('passwordbaru');
					$data = array(
			        'email' => $this->session->userdata('email'),
			        'password' => password_hash($passbaru, PASSWORD_DEFAULT),
			        'id_responden_dosen' => $cekpasslama['id_ptk']
					);

					$this->db->insert('Login', $data);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Ubah password berhasil !!!</div>');
					redirect('responden');
				}
			}else{
				// jika password lama tidak sesuai dengan yang diinput
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password lama tidak sesuai,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('responden');
			}

		}

		$nipd = $this->session->userdata('nipd');
		if ($nipd) {
			// jika masuk sebagai mahasiswa
			$passlama = $this->input->post('passwordlama');
			$cekpasslama = $this->db->get_where('mahasiswa_pt', ['nipd' => $nipd])->row_array();
			// cek password lama sama atau tidak
			if ($passlama == $cekpasslama['nipd']) {
				// jika password lama sesuai dengan yang diinput
				if ($this->input->post('passwordbaru') != $this->input->post('konfirmasi')) {
					// jika password baru tidak sama dengan konfirmasi
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password baru tidak sama dengan konfirmasi password,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('responden');
				}else{
					// jika password baru sama dengan konfirmasi maka password baru akan disimpan
					$passbaru = $this->input->post('passwordbaru');
					$data = array(
			        'email' => $this->session->userdata('email'),
			        'password' => password_hash($passbaru, PASSWORD_DEFAULT),
			        'id_responden_mhs' => $cekpasslama['id_reg_pd']
					);

					$this->db->insert('Login', $data);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Ubah password berhasil !!!</div>');
					redirect('responden');
				}
			}else{
				// jika password lama tidak sesuai dengan yang diinput
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Ubah Password gagal, Password lama tidak sesuai,<strong><a id="ubahPassword" href="#" data-toggle="modal" data-target="#ubahPass">Klik ubah password
                      </a></strong> !!!</div>');
					redirect('responden');
			}

		}
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('nipd');
		$this->session->unset_userdata('nidn');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been Logged Out!!</div>');
		redirect('auth');
		
	}
}

// dibuat oleh muhammad nur basari


























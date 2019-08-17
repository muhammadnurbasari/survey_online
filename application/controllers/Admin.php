<?php 


/**
 * 
 */
class Admin extends CI_controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('form_validation');

		// proteksi apabila ada user coba membuka halaman admin
		$role_session = $this->session->userdata('role_id');
		if (!$role_session) {
			redirect('auth');	
		}
		
		if ($role_session != 1) {
			redirect('user');
		}

		
	}

	public function index()
	{
		$data['user'] = $this->Admin_model->getUser();
		$data['title'] = 'Dashboard';
		$tempt = 'admin/index';

		$this->templating($data,$tempt);
	}

	private function templating($data,$tempt)
	{
		$this->load->view('_partials/header', $data);
		$this->load->view('_partials/sidebar');
		$this->load->view('_partials/topbar');
		$this->load->view($tempt, $data);
		$this->load->view('_partials/footer');
	}

	public function data_user()
	{
		$data['users'] = $this->Admin_model->getAllUser();
		$data['user'] = $this->Admin_model->getUser();
		$data['title'] = 'Data Surveyor';
		$tempt = 'admin/user';

		$this->templating($data,$tempt);
	}

	public function myProfile()
	{
		$data['user'] = $this->Admin_model->getUser();
		$data['role'] = $this->db->get_where('surveyor_role',['role_id' => $this->session->userdata('role_id')])->row_array();
		$data['title'] = 'My Profile';
		$tempt = 'admin/my_profile';

		$this->templating($data,$tempt);
	}

	public function edit_user($user_id)
	{
		$data['details'] = $this->Admin_model->editUser($user_id);
		$data['user'] = $this->Admin_model->getUser();
		$data['title'] = "Edit User";
		$tempt = 'admin/edit_user';

		$this->templating($data,$tempt);
	}

	public function update_user()
	{
		$inputIsActiv = $this->input->post('is_active');
		$inputRole = $this->input->post('role');
		$inputId = $this->input->post('id');

		// cari ditable login jika sudah ganti password
		$this->db->where('id_surveyor', $inputId);
		$this->db->from('login');
		$tabelLogin = $this->db->get()->row_array();

		$this->form_validation->set_rules('nama','Nama','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			// jika tidak lolos validasi
			$data['details'] = $this->Admin_model->editUser($inputId);
			$data['user'] = $this->Admin_model->getUser();
			$data['title'] = "Edit User";
			$tempt = 'admin/edit_user';
		

			$this->templating($data,$tempt);
		}else{
			// jika lolos validasi
			// hitung total admin
			$this->db->where('role_id', 1);
			$this->db->where('is_active', 1);
			$this->db->from('surveyor');
			$admin = $this->db->get()->result_array();

			if (count($admin) === 1) {
				// jika surveyor role = admin dan active sisa 1
				if ($inputId === $admin[0]['surveyor_id']) {
					// jika id yang di post sama dengan id dari surveyor admin yang sisa 1
					if ($inputRole == 1) {
						// cek jika role yang dipost = 1
						if ($inputIsActiv == 1) {
							// cek jika is_active = 1
							// update ke database
							$this->Admin_model->updateUser();
							
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Congratulation!</strong> Update data Success
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');
								//get admin
								$this->db->where('surveyor_id', $inputId);
								$this->db->from('surveyor');
								$getSurveyorUpdate = $this->db->get()->row_array();

								if ($getSurveyorUpdate['surveyor_id'] == $this->session->userdata('surveyor_id')) {
								// jika yang diedit adalah admin yang login, maka merubah nilai session sesuai update
								$data = [
										'email' => $getSurveyorUpdate['email'],
										'surveyor_id' => $getSurveyorUpdate['surveyor_id'],
										'role_id' => $getSurveyorUpdate['role_id'],
										'name' => $getSurveyorUpdate['name']
									];
								$this->session->set_userdata($data);
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}else{
								// jika yang di edit bukan admin yang sedang login
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}
						}else{
							// cek jika is_active != 1
							$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">
								  <strong>Update Gagal!</strong> Note : Harus Ada Satu Administrator Yang AKTIF
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');
							redirect('admin/data_user');
						}
					}else{
						// cek jika role yang dipost != 1
						$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">
								  <strong>Update Gagal!</strong> Note : Harus Ada Satu Administrator Yang AKTIF
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');
						redirect('admin/data_user');
					}
				}else{
					// jika id yang di post tidak sama dengan id dari surveyor admin yang sisa 1
					// update ke database
							$this->Admin_model->updateUser();
							
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Congratulation!</strong> Update data Success
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');
								//get admin
								$this->db->where('surveyor_id', $inputId);
								$this->db->from('surveyor');
								$getSurveyorUpdate = $this->db->get()->row_array();

								if ($getSurveyorUpdate['surveyor_id'] == $this->session->userdata('surveyor_id')) {
								// jika yang diedit adalah admin yang login, maka merubah nilai session sesuai update
								$data = [
										'email' => $getSurveyorUpdate['email'],
										'surveyor_id' => $getSurveyorUpdate['surveyor_id'],
										'role_id' => $getSurveyorUpdate['role_id'],
										'name' => $getSurveyorUpdate['name']
									];
								$this->session->set_userdata($data);
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}else{
								// jika yang di edit bukan admin yang sedang login
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}
				}
			}else{
				// jika surveyor role = admin dan active sisa lebih 1
			// update ke database
							$this->Admin_model->updateUser();
							
							$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Congratulation!</strong> Update data Success
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');
								//get admin
								$this->db->where('surveyor_id', $inputId);
								$this->db->from('surveyor');
								$getSurveyorUpdate = $this->db->get()->row_array();

								if ($getSurveyorUpdate['surveyor_id'] == $this->session->userdata('surveyor_id')) {
								// jika yang diedit adalah admin yang login, maka merubah nilai session sesuai update
								$data = [
										'email' => $getSurveyorUpdate['email'],
										'surveyor_id' => $getSurveyorUpdate['surveyor_id'],
										'role_id' => $getSurveyorUpdate['role_id'],
										'name' => $getSurveyorUpdate['name']
									];
								$this->session->set_userdata($data);
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}else{
								// jika yang di edit bukan admin yang sedang login
									if ($tabelLogin) {
										// jika sudah pernah ganti password
										$this->Admin_model->updateTabelLogin();
										redirect('admin/data_user');
									}
								redirect('admin/data_user');
								}
			}
		}
			
			
	}

	public function delete_user()
	{
		$idPost = $this->input->post('surveyor_id');
		
		// cari ditable login jika sudah ganti password
		$this->db->where('id_surveyor', $idPost);
		$this->db->from('login');
		$tabelLogin = $this->db->get()->row_array();

		// hitung total admin
		$this->db->where('role_id', 1);
		$this->db->where('is_active', 1);
		$this->db->from('surveyor');
		$admin = $this->db->get()->result_array();
		

		if (count($admin) === 1) {
			// jika admin yang aktif sisa satu
			if ($admin[0]['surveyor_id'] === $idPost) {
				// jika admin aktif sisa 1 dan akan dihapus, maka akan muncul pesan warning
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				 <strong>Tidak bisa hapus!</strong> Sistem membutuhkan minimal satu Administrator yang AKTIF
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/data_user');
			}else{
				// jika admin aktif sisa 1 dan tidak dihapus, maka akan hapus sesuai id yang dipost

				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 <strong>Delete data Success!</strong> 
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');

				if ($tabelLogin) {
					// jika sudah pernah ganti password
					$this->Admin_model->deleteTabelLogin();
				}
				
				// jika belum pernah ganti password

				$this->Admin_model->deleteUser();
				redirect('admin/data_user');
			}
		}else{
			// jika admin yang aktif lebih dari satu
			
			if ($this->session->userdata('name') == $this->input->post('name')) {
				// jika surveyor menghapus dirinya sendiri, maka tidak bisa
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					 <strong>Tidak bisa hapus AKUN YANG SEDANG LOGIN!</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
				redirect('admin/data_user');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 <strong>Delete data Success!</strong> 
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');

				if ($tabelLogin) {
					// jika sudah pernah ganti password
					$this->Admin_model->deleteTabelLogin();
				}
				
				// jika belum pernah ganti password
				$this->Admin_model->deleteUser();
				redirect('admin/data_user');
			}
		}
		
	}

	public function update_photo()
	{
		// cek jika ada gambar yang akan di upload
		$upload_image = $_FILES['image']['name'];

		// cek jika belum memilih gambar
		if (!$upload_image) {
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>no file choose!</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/myProfile');
		}
		
		if ($upload_image) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$data['user'] = $this->Admin_model->getUser();
				$old_image = $data['user']['image'];
				if ($old_image != 'profile.png') {
					unlink(FCPATH . 'assets/img/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Gagal upload photo, Ukuran file terlalu besar atau File tidak didukung!</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/myProfile');
			}
			$this->Admin_model->updatePhoto($new_image);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>change photo Success!</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/myProfile');
		}
	}


}

// dibuat oleh muhammad nur basari











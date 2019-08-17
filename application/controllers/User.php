<?php 


/**
 * 
 */
class User extends CI_controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');

		// proteksi apabila ada user coba membuka sebelum login
		$role_session = $this->session->userdata('role_id');
		if (!$role_session) {
			redirect('auth');	
		}

	}
	public function index()
	{
		$this->templating('Surveyor','user/index');
	}


	public function create_angket()
	{
		$this->templating('Create Angket','user/create_angket');
	}

	private function templating($judul,$halaman)
	{
		$data['user'] = $this->db->get_where('surveyor',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('surveyor_role',['role_id' => $this->session->userdata('role_id')])->row_array();
		$data['title'] = $judul;
		$tempt = $halaman;

		$this->load->view('_partials/header', $data);
		$this->load->view('_partials/sidebar');
		$this->load->view('_partials/topbar');
		$this->load->view($tempt, $data);
		$this->load->view('_partials/footer');
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
			redirect('user');
		}
		
		if ($upload_image) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$data['user'] = $this->User_model->getUser();
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
			redirect('user');
			}
			$this->User_model->updatePhoto($new_image);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>change photo Success!</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('user');
		}
	}
}
// dibuat oleh muhammad nur basari

















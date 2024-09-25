<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Mapel_model', 'mapel');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Course_model', 'course');
		$this->load->model('Pengumuman_model', 'pengumuman');
		isGuru($this->session->userdata['role_id']); 
		$this->email = $this->session->userdata['email'];
	}

	public function index(){
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = 'Home';

		$data['count_course'] = $this->course->getCourseCount($data['user']['id']);
		$data['count_siswa'] = $this->course->getCourseSiswaCount($data['user']['id'])->num_rows();
		$data['count_announcement'] = $this->pengumuman->getDataPengumuman(3)->num_rows();
		
		$this->load->view('templates/header', $data);
		$this->load->view('guru/index', $data);
		$this->load->view('templates/footer');
	}

	public function profile()
	{
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();

		$data['title'] = "Profile";
		$data['guru'] = $this->profile->getDataGuru($data['user']['id'])->row_array();
		$data['mapel'] = $this->mapel->getDataMapel()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('guru/profile', $data);
		$this->load->view('templates/footer');
	}

	public function updateProfile()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
		$this->form_validation->set_rules('mapel_id', 'Mata Pelajaran', 'required');

		if ($this->form_validation->run() == false) {
			alert_danger('Filled cannot be empty!');
		}else{
			$this->profile->updateProfile();
			alert_success('Profile berhasil diperbarui');
			redirect('guru/profile');
		}
	}

	public function updatePhoto()
	{
		$update = $this->profile->updatePhotoProfile();
		if ($update) {
			alert_success('Photo Profile berhasil diperbarui');
			redirect('guru/profile');
		}else{
			alert_danger('Photo Profile gagal diperbarui');
			redirect('guru/profile');
		}
	}

	public function ubahPassword()
	{
		$data = $this->profile->updatePassword();
		if ($data) {
			$this->alert_success('Password berhasil diubah!');
			redirect('guru/profile');
		}else{
			$this->alert_danger($data);
			redirect('guru/profile');
		}
	}
}
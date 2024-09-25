<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Mapel_model', 'mapel');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Course_model', 'course');
		isSiswa($this->session->userdata['role_id']); 
		$this->email = $this->session->userdata['email'];
	}

	public function index(){
		$data['user'] = $this->profile->getDataSiswa(null,$this->email)->row_array();
		$data['title'] = 'Home';
		
		$data['mapel'] = $this->mapel->getDataMapel()->result_array();
		$data['new_course'] = $this->course->getAllNewCourse()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function profile()
	{
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();

		$data['title'] = "Profile";
		$data['siswa'] = $this->profile->getDataSiswa($data['user']['id'])->row_array();
		$data['kelas'] = $this->kelas->getDataKelas()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('siswa/profile', $data);
		$this->load->view('templates/footer');
	}

	public function updateProfile()
	{
		$data = $this->profile->updateProfile();
		if ($data) {
			alert_success('Profile kamu berhasil diperbarui!');
			redirect('siswa/profile');
		}
	}

	public function updatePhoto()
	{
		$data = $this->profile->updatePhotoProfile();
		if ($data) {
			alert_success('Photo profile kamu berhasil diperbarui!');
			redirect('siswa/profile');
		}
	}

	public function ubahPassword()
	{
		$data = $this->profile->updatePassword();
		if ($data) {
			alert_success('Password berhasil diubah!');
			redirect('siswa/profile');
		}else{
			alert_danger($data);
			redirect('siswa/profile');
		}
	}

}
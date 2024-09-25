<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Materi_model', 'materi');
		$this->load->model('Comment_model', 'comment');

		if (!$this->session->userdata('email', 'role_id')) {
			$data = base_url();
			$this->session->unset_userdata('email', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$this->email = $this->session->userdata['email'];

	}


	public function index(){
		isSiswa($this->session->userdata['role_id']);
		$id_materi = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Materi";
		$data['materi'] = $this->materi->getDataMateri(null, $id_materi)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['materi']['id_section_comment'])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('materi/index', $data);
		$this->load->view('templates/footer');
	}

	public function createMateri($id_section = null){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['section'] = $this->db->get_where('section', ['id_section' => $id_section])->row_array();
		$data['title'] = "Tambah Materi Baru";

		$this->form_validation->set_rules('title_materi', 'Title Materi', 'required');
		$this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('materi/createMateri', $data);
			$this->load->view('templates/footer');
		}else{
			$this->materi->createMateri();
			alert_success('Materi berhasil ditambahkan!');
			redirect('course/detail/'.$this->input->post('course_uuid'));
		}
	}

	public function editMateri($id){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Materi";
		$data['materi'] = $this->materi->getDataMateri(null, $id)->row_array();


		$data['comments'] = $this->comment->getDataComment($data['materi']['id_section_comment'])->result_array();

		$this->form_validation->set_rules('title_materi', 'Title Materi', 'required');
		$this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('materi/editMateri', $data);
			$this->load->view('templates/footer');
		}else{
			$this->materi->updateMateri($id);
			alert_success('Materi berhasil diperbarui!');
			redirect('materi/editMateri/'.$id);
		}
	}

	public function comment($id_materi, $id_section_comment){
		
		$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('id_user')])->row_array();
		$this->form_validation->set_rules('message', 'Pesan', 'required');

		if ($data['user']['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);

			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('materi/editMateri/'.$id_materi);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('materi/editMateri/'.$id_materi);
			}
		}else if ($data['user']['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('materi?id='.$id_materi);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('materi?id='.$id_materi);
			}
		}
	}

	public function deleteComment($id_materi, $id_comment){
		$role_id = $this->session->userdata['role_id'];
		if ($role_id == 2) {
			isGuru($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('materi/editMateri/'.$id_materi);
		}else if($role_id == 1){
			isSiswa($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('materi?id='.$id_materi);
		}	
	}
	
	public function deleteMateri($id){
		isGuru($this->session->userdata['role_id']);
		$data['materi'] = $this->materi->getDataMateri(null, $id)->row_array();
		$this->materi->deleteMateri($id);
		alert_success('Materi berhasil dihapus!');
		redirect('course/detail/'.$data['materi']['course_uuid']);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Tugas_model', 'tugas');
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
		$id_tugas = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Tugas";
		$data['tugas'] = $this->tugas->getDataTugas(null, $id_tugas)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['tugas']['id_section_comment'])->result_array();

		$data['tugas_siswa'] = $this->tugas->getDataTugasSiswa($id_tugas, $data['user']['id'])->result_array();

		$this->form_validation->set_rules('catatan_siswa', 'Catatan Tugas', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('tugas/index', $data);
			$this->load->view('templates/footer');
		}else{
			$id_section = $data['tugas']['id_section'];
			$course_uuid = $data['tugas']['course_uuid'];
			$id_siswa = $data['user']['id'];
			$checkTugasSiswa = $this->tugas->countTugasSiswa($id_siswa, $id_tugas);
			if ($checkTugasSiswa > 0) {
				alert_success('Kamu sudah membuat tugas kamu!');
				redirect('tugas?id='.$id_tugas);
			}else{
				$tambah_tugas = $this->tugas->createTugasSiswa($id_tugas, $id_section, $course_uuid, $id_siswa);
				if ($tambah_tugas) {
					alert_success('Tugas kamu berhasil dikumpulkan!');
					redirect('tugas?id='.$id_tugas);
				}else{
					alert_danger('Something went wrong!');
					redirect('tugas?id='.$id_tugas);
				}
			}
		}
	}


	public function createTugas($id_section = null){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['section'] = $this->db->get_where('section', ['id_section' => $id_section])->row_array();
		$data['title'] = "Tambah Tugas Baru";

		$this->form_validation->set_rules('title_tugas', 'Title Tugas', 'required');
		$this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi Tugas', 'required');
		$this->form_validation->set_rules('deadline_tugas', 'Deadline Tugas', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('tugas/createTugas', $data);
			$this->load->view('templates/footer');
		}else{
			$this->tugas->createTugas();
			alert_success('Tugas berhasil ditambahkan!');
			redirect('course/detail/'.$this->input->post('course_uuid'));
		}
	}

	public function editTugas($id){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Edit";
		$data['tugas'] = $this->tugas->getDataTugas(null, $id)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['tugas']['id_section_comment'])->result_array();
		$data['tugas_siswa'] = $this->tugas->getDataTugasSiswa($id)->result_array();

		$this->form_validation->set_rules('title_tugas', 'Title Tugas', 'required');
		$this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi Tugas', 'required');
		$this->form_validation->set_rules('deadline_tugas', 'Deadline Tugas', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('tugas/editTugas', $data);
			$this->load->view('templates/footer');
		}else{
			$this->tugas->updateTugas($id);
			alert_success('Materi berhasil diperbarui!');
			redirect('tugas/editTugas/'.$id);
		}
	}

	public function comment($id_tugas, $id_section_comment){

		$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('id_user')])->row_array();

		$this->form_validation->set_rules('message', 'Pesan', 'required');


		if ($data['user']['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);

			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('tugas/editTugas/'.$id_tugas);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('tugas/editTugas/'.$id_tugas);
			}
		}else if ($data['user']['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('tugas?id='.$id_tugas);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('tugas?id='.$id_tugas);
			}
		}
	}

	public function deleteComment($id_tugas, $id_comment){
		$role_id = $this->session->userdata['role_id'];

		if ($role_id == 2) {
			isGuru($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dikirim!');
			redirect('tugas/editTugas/'.$id_tugas);
		}else if($role_id == 1){
			isSiswa($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dikirim!');
			redirect('tugas?id='.$id_tugas);
		}	
	}

	public function nilaiTugasSiswa($id_tugas_siswa){
		$data['tugas_siswa'] = $this->tugas->getDataTugasSiswa(null, null, $id_tugas_siswa)->row_array();

		$nilai = $this->input->post('nilai');
		if ($nilai > 100) {
			alert_success('Nilai yang diinput lebih dari 100');
			redirect('tugas/editTugas/'.$data['tugas_siswa']['id_tugas']);
		}else{
			$this->db->set('nilai', $nilai);
			$this->db->set('status', 'Selesai');
			$this->db->where('id_tugas_siswa', $id_tugas_siswa);
			$this->db->update('tugas_siswa');
			alert_success('Nilai tugas siswa berhasil ditambahkan');
			redirect('tugas/editTugas/'.$data['tugas_siswa']['id_tugas']);
		}
	}

	public function deleteTugasSiswa($id_tugas_siswa = null)
	{
		$tugas = $this->db->get_where('tugas_siswa', ['id' => $id_tugas_siswa])->row_array();
		$query = $this->db->delete('tugas_siswa', ['id' => $id_tugas_siswa]);
		if ($query) {
			unlink(FCPATH . 'assets/upload/tugasSiswa/'. $tugas['file_tugas']);
		}
		$this->alert_success('Tugas siswa berhasil berhasil dihapus!');
		redirect('tugas/editTugas/'.$tugas['id_tugas']);
	}


	public function deleteTugas($id){
		isGuru($this->session->userdata['role_id']);
		$data['tugas'] = $this->tugas->getDataTugas(null, $id)->row_array();
		$this->tugas->deleteTugas($id);
		alert_success('Tugas berhasil dihapus!');
		redirect('course/detail/'.$data['tugas']['course_uuid']);
	}

}

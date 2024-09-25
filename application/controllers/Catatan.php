<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Catatan_model', 'catatan');
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
		$id_catatan = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Catatan";
		$data['catatan'] = $this->catatan->getDataCatatan(null, $id_catatan)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['catatan']['id_section_comment'])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('catatan/index', $data);
		$this->load->view('templates/footer');
	}

	public function createCatatan($id_section = null){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['section'] = $this->db->get_where('section', ['id_section' => $id_section])->row_array();
		$data['title'] = "Tambah Catatan Baru";

		$this->form_validation->set_rules('title_catatan', 'Title catatan', 'required');
		$this->form_validation->set_rules('deskripsi_catatan', 'Deskripsi catatan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('catatan/createCatatan', $data);
			$this->load->view('templates/footer');
		}else{
			$this->catatan->createCatatan();
			alert_success('Catatan berhasil ditambahkan!');
			redirect('course/detail/'.$this->input->post('course_uuid'));
		}
	}

	public function editCatatan($id){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Catatan";
		$data['catatan'] = $this->catatan->getDataCatatan(null, $id)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['catatan']['id_section_comment'])->result_array();

		$this->form_validation->set_rules('title_catatan', 'Title catatan', 'required');
		$this->form_validation->set_rules('deskripsi_catatan', 'Deskripsi catatan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('catatan/editCatatan', $data);
			$this->load->view('templates/footer');
		}else{
			$this->catatan->updateCatatan($id);
			alert_success('Catatan berhasil diperbarui!');
			redirect('catatan/editCatatan/'.$id);
		}
	}

	public function comment($id_catatan, $id_section_comment){
		
		$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('id_user')])->row_array();
		$this->form_validation->set_rules('message', 'Pesan', 'required');

		if ($data['user']['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('catatan/editCatatan/'.$id_catatan);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('catatan/editCatatan/'.$id_catatan);
			}
		}else if ($data['user']['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('catatan?id='.$id_catatan);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('catatan?id='.$id_catatan);
			}
		}
	}

	public function deleteComment($id_catatan, $id_comment){
		$role_id = $this->session->userdata['role_id'];
		if ($role_id == 2) {
			isGuru($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('catatan/editCatatan/'.$id_catatan);
		}else if($role_id == 1){
			isSiswa($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('catatan?id='.$id_catatan);
		}	
	}

	public function deleteCatatan($id){
		isGuru($this->session->userdata['role_id']);
		$data['catatan'] = $this->catatan->getDataLink(null, $id)->row_array();
		$this->catatan->deleteCatatan($id);
		alert_success('catatan berhasil dihapus!');
		redirect('course/detail/'.$data['catatan']['course_uuid']);
	}
}

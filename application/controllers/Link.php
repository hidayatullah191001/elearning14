<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Link_model', 'link');
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
		$id_link = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Link";
		$data['link'] = $this->link->getDataLink(null, $id_link)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['link']['id_section_comment'])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('link/index', $data);
		$this->load->view('templates/footer');
	}


	public function createLink($id_section = null){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['section'] = $this->db->get_where('section', ['id_section' => $id_section])->row_array();
		$data['title'] = "Tambah Link Baru";

		$this->form_validation->set_rules('title_link', 'Title Link', 'required');
		$this->form_validation->set_rules('deskripsi_link', 'Deskripsi Link', 'required');
		$this->form_validation->set_rules('link', 'Link', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('link/createLink', $data);
			$this->load->view('templates/footer');
		}else{
			$this->link->createLink();
			alert_success('Link berhasil ditambahkan!');
			redirect('course/detail/'.$this->input->post('course_uuid'));
		}
	}

	public function editLink($id){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Link";
		$data['link'] = $this->link->getDataLink(null, $id)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['link']['id_section_comment'])->result_array();

		$this->form_validation->set_rules('title_link', 'Title Link', 'required');
		$this->form_validation->set_rules('deskripsi_link', 'Deskripsi Link', 'required');
		$this->form_validation->set_rules('link', 'Link', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('link/editLink', $data);
			$this->load->view('templates/footer');
		}else{
			$this->link->updateLink($id);
			alert_success('Link berhasil diperbarui!');
			redirect('link/editLink/'.$id);
		}
	}

	public function comment($id_link, $id_section_comment){
		
		$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('id_user')])->row_array();
		$this->form_validation->set_rules('message', 'Pesan', 'required');


		if ($data['user']['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);

			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('link/editLink/'.$id_link);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('link/editLink/'.$id_link);
			}
		}else if ($data['user']['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('link?id='.$id_link);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('link?id='.$id_link);
			}
		}
	}

	public function deleteComment($id_link, $id_comment){
		$role_id = $this->session->userdata['role_id'];
		if ($role_id == 2) {
			isGuru($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('link/editLink/'.$id_link);
		}else if($role_id == 1){
			isSiswa($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dihapus!');
			redirect('link?id='.$id_link);
		}	
	}

	public function deleteLink($id){
		isGuru($this->session->userdata['role_id']);
		$data['link'] = $this->link->getDataLink(null, $id)->row_array();
		$this->link->deleteLink($id);
		alert_success('Link berhasil dihapus!');
		redirect('course/detail/'.$data['link']['course_uuid']);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Video_model', 'video');
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
		$id_video = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Video";
		$data['video'] = $this->video->getDataVideo(null, $id_video)->row_array();
		$data['comments'] = $this->comment->getDataComment($data['video']['id_section_comment'])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('video/index', $data);
		$this->load->view('templates/footer');
	}


	public function createVideo(){
		if ($this->session->userdata['role_id'] == 2) {
			
			$this->form_validation->set_rules('title', 'Title Video', 'required');
			$this->form_validation->set_rules('link', 'Link Video', 'required');

			if ($this->form_validation->run() == false) {
				alert_danger('Something went wrong!');
				redirect('course/detail/'.$this->input->post('course_uuid'));
			}else{
				$this->video->createVideo();
				alert_success('Video berhasil ditambahkan!');
				redirect('course/detail/'.$this->input->post('course_uuid'));
			}
		}
	}

	public function editVideo($id){
		isGuru($this->session->userdata['role_id']);
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Video";
		$data['video'] = $this->video->getDataVideo(null, $id)->row_array();

		$data['comments'] = $this->comment->getDataComment($data['video']['id_section_comment'])->result_array();


		$this->form_validation->set_rules('title', 'Title Video', 'required');
		$this->form_validation->set_rules('link', 'Link Video', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('video/editVideo', $data);
			$this->load->view('templates/footer');
		}else{
			$this->video->updateVideo($id);
			alert_success('Video berhasil diperbarui!');
			redirect('video/editVideo/'.$id);
		}
	}

	public function comment($id_video, $id_section_comment){
		
		$data['user'] = $this->db->get_where('user', ['id' => $this->input->post('id_user')])->row_array();

			$this->form_validation->set_rules('message', 'Pesan', 'required');


		if ($data['user']['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);

			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('video/editVideo/'.$id_video);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('video/editVideo/'.$id_video);
			}
		}else if ($data['user']['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);
			if ($this->form_validation->run() == false) {
				alert_danger('Something Went Wrong!');
				redirect('video?id='.$id_video);
			}else{
				$this->comment->createComment($id_section_comment);
				alert_success('Pesan berhasil dikirim!');
				redirect('video?id='.$id_video);
			}
		}
	}

	public function deleteComment($id_video, $id_comment){
		$role_id = $this->session->userdata['role_id'];

		if ($role_id == 2) {
			isGuru($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dikirim!');
			redirect('video/editVideo/'.$id_video);
		}else if($role_id == 1){
			isSiswa($this->session->userdata['role_id']);
			$this->comment->deleteComment($id_comment);
			alert_success('Pesan berhasil dikirim!');
			redirect('video?id='.$id_video);
		}	
	}
	
	public function deleteVideo($id){
		$data['video'] = $this->video->getDataVideo(null, $id)->row_array();
		$this->video->deleteVideo($id);
		alert_success('Video berhasil dihapus!');
		redirect('course/detail/'.$data['video']['course_uuid']);
	}

}

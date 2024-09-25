<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Forum_model', 'forum');

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
		$id_forum = $this->input->get('id');

		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		

		if ($id_forum == null) {
			$data['title'] = "Discussion";

			$data['forum_topik'] = $this->forum->getDataTopikForum()->result_array();
			$data['chats'] = $this->forum->getDataChatForum()->result_array();

			$this->form_validation->set_rules('topik', 'Topik', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('forum/discussion', $data);
				$this->load->view('templates/footer');
			}else{
				$this->forum->createTopikDiscussion(0, $data['user']['id']);
				alert_success('Topik Diskusi berhasil dibuat!');
				redirect('forum');
			}
			
		}else{
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['title'] = "Forum";
			$data['forum'] = $this->forum->getDataForum(null, $id_forum)->row_array();
			$data['forum_topik'] = $this->forum->getDataTopikForum($id_forum)->result_array();
			$data['chats'] = $this->forum->getDataChatForum()->result_array();

			$this->form_validation->set_rules('topik', 'Topik', 'required');

			if ($this->form_validation->run() ==false) {
				$this->load->view('templates/header', $data);
				$this->load->view('forum/index_siswa', $data);
				$this->load->view('templates/footer');
			}else{
				$this->forum->createTopikDiscussion($id_forum, $data['user']['id']);
				alert_success('Topik Diskusi berhasil dibuat!');
				redirect('forum?id='.$id_forum);
			}
		}
	}

	public function view(){
		isSiswa($this->session->userdata['role_id']);
		$id_topik = $this->input->get('topik');
		$data['topik'] = $this->forum->getDataTopikForum(null, $id_topik)->row_array();
		if ($data['topik'] == null) {
			alert_danger('Topik Diskusi tidak ditemukan!');
			redirect('course/mycourse');
		}else{
			$data['title'] = 'Forum';
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['topik'] = $this->forum->getDataTopikForum(null, $id_topik)->row_array();
			$data['chat'] = $this->forum->getDataChatForum($id_topik)->result_array();

			$this->form_validation->set_rules('message', 'Message', 'required');

			if ($this->form_validation->run() ==false) {
				$this->load->view('templates/header', $data);
				$this->load->view('forum/view', $data);
				$this->load->view('templates/footer');
			}else{
				$this->forum->createDiscussionChat($id_topik, $data['user']['id']);
				alert_success('Pesan berhasil dikirim!');
				redirect('forum/view?topik='.$id_topik);
			}
		}
	}

	public function deleteChat($id_chat){
		$chat = $this->forum->getDataChatForum(null, $id_chat)->row_array();
		$this->forum->deleteChat($id_chat);
		alert_success('Pesan berhasil dihapus!');
		redirect('forum/view?topik='.$chat['id_forum_topik']);
	}

	public function deleteTopik($id_topik, $id_forum = null){

		$topik = $this->forum->getDataTopikForum(null, $id_topik)->row_array();
		$this->forum->deleteChat(null, $id_topik);
		$this->forum->deleteTopik($id_topik);
		if ($id_forum) {
			alert_success('Topik berhasil dihapus!');
			redirect('forum?id='.$id_forum);
		}else{
			alert_success('Topik berhasil dihapus!');
			redirect('forum');
		}
		
	}
}
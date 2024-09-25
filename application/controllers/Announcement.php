<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Announcement extends CI_Controller
{
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Pengumuman_model', 'pengumuman');
		$this->email = $this->session->userdata['email'];
	}

	public function index(){

		if ($this->session->userdata['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);
		}else{
			isSiswa($this->session->userdata['role_id']); 
		} 

		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		
		$data['title'] = 'Announcement';
		$data['pengumumans'] = $this->pengumuman->getDataPengumuman(3)->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pengumuman/index_guru', $data);
		$this->load->view('templates/footer');
	}


	public function update_pengumuman($uuid=null){
		$this->form_validation->set_rules('title_pengumuman', 'Title Pengumuman', 'required');
		$this->form_validation->set_rules('deskripsi_pengumuman', 'Deskripsi Pengumuman', 'required');

		if ($this->form_validation->run() == false) {
			alert_danger('Something went wrong!');
		}else{
			if ($this->session->userdata['role_id'] == 3) {
				$this->pengumuman->updatePengumuman();
				alert_success('Pengumuman berhasil diperbarui');
				redirect('operator/pengumuman');
			}else if($this->session->userdata['role_id'] ==2){
				$this->pengumuman->updatePengumuman();
				alert_success('Pengumuman berhasil diperbarui');
				redirect('course/annoucementCourse/'.$uuid);
			}
		}
	}

	public function delete_pengumuman($id_pengumuman, $uuid=null){
		if ($this->session->userdata['role_id'] == 3) {
			$this->pengumuman->deletePengumuman($id_pengumuman);
			alert_success('Pengumuman berhasil dihapus');
			redirect('operator/pengumuman');
		}else if($this->session->userdata['role_id'] ==2 ){
			$this->pengumuman->deletePengumuman($id_pengumuman);
			alert_success('Pengumuman berhasil dihapus');
			redirect('course/annoucementCourse/'.$uuid);
		}
	}
}

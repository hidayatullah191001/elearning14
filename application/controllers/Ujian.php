<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Ujian_model', 'ujian');

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
		$id_ujian = $this->input->get('id');
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = "Ujian";
		$data['ujian'] = $this->ujian->getDataUjian(null, $id_ujian)->row_array();
		$data['count_ujian_siswa'] = $this->ujian->checkUjianSiswa($id_ujian, $data['user']['id']);
		

		if ($data['count_ujian_siswa'] > 0) {
			$data['ujian_siswa'] = $this->ujian->getUjianSiswa($data['ujian']['course_uuid'], $data['user']['id'], $id_ujian)->row_array();
			
			$data['ujian_siswa_all'] = $this->ujian->getUjianSiswa($data['ujian']['course_uuid'], $data['user']['id'], $id_ujian)->result_array();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('ujian/index', $data);
		$this->load->view('templates/footer');
	}

	public function start(){
		isSiswa($this->session->userdata['role_id']);
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$course_uuid = $this->input->get('course_uuid');

		$section_id = $this->input->get('section');
		$id_ujian = decryptId($this->input->get('ujian'));

		$data['ujian'] = $this->ujian->getDataUjian(null, $id_ujian)->row_array();
		$data['title'] = $data['ujian']['title_ujian'];
		$data['soal'] = $this->ujian->getAllSoalUjian($id_ujian, 1);

		$time_now = date('d F Y H:i:s');
		$addingDeadline= strtotime($time_now.$data['ujian']['lama_pengerjaan'].'minute');
		$data_ujian_siswa = [
			'course_uuid' => $course_uuid,
			'id_section' => $section_id,
			'id_siswa' => $data['user']['id'],
			'id_ujian' => $id_ujian,
			'date_start' => $addingDeadline,
			'jumlah_soal' => 0,
			'jumlah_benar' => 0,
			'jumlah_salah' => 0,
			'jumlah_kosong' => 0,
			'hasil_nilai' => 0,
			'status' => 'Proses',
			'date_created_ujian_siswa' => time(),
		];
		$ujian_siswa = $this->ujian->checkUjianSiswa($id_ujian, $data['user']['id']);

		if ($ujian_siswa < 1) {
			$this->db->insert('ujian_siswa', $data_ujian_siswa);
			$id_ujian_siswa = $this->db->insert_id();
		}

		$data['ujian_siswa'] = $this->ujian->getUjianSiswa($course_uuid, $data['user']['id'], $id_ujian, )->row_array(); 

		if ($data['ujian_siswa']['status'] == "Selesai" || ($data['ujian_siswa']['date_start'] - strtotime($time_now)) < 0) {
			alert_success('Kamu telah menyelesaikan ujian!');
			redirect('ujian?id='.$id_ujian);
		}else{
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header_ujian', $data);
				$this->load->view('ujian/view', $data);
				$this->load->view('templates/footer_ujian');
			}else{
				$pilihan = $this->input->post('pilihan');
				$id_soal = $this->input->post('id');
				$jumlah = $this->input->post('jumlah');

				$score = 0;
				$benar = 0;
				$salah = 0;
				$kosong = 0;

				for ($i=0; $i < $jumlah; $i++) { 
					$nomor = $id_soal[$i];

					if (empty($pilihan[$nomor])) {
						$kosong++;
					}else{
						$jawaban = $pilihan[$nomor];

						$cek = $this->ujian->cekJawabanSoal($nomor, $jawaban);
						if ($cek) {
							$benar++;
						}else{
							$salah++;
						}
					}
					$score = 100/$jumlah*$benar;
					$hasil = number_format($score, 1);
				}
				$this->db->set('jumlah_soal', $jumlah);
				$this->db->set('jumlah_benar', $benar);
				$this->db->set('jumlah_salah', $salah);
				$this->db->set('jumlah_kosong', $kosong);
				$this->db->set('hasil_nilai', $hasil);
				$this->db->set('status', 'Selesai');
				$this->db->set('date_created_ujian_siswa', time());
				if ($id_ujian_siswa != null) {
					$this->db->where('id_ujian_siswa', $id_ujian_siswa);
				}else{
					$this->db->where('id_ujian_siswa', $data['ujian_siswa']['id_ujian_siswa']);
				}
				$this->db->update('ujian_siswa');
				alert_success('Selamat, kamu telah menyelesaikan ujian kamu!');
				redirect('ujian?id='.$id_ujian);
			}
		}
	}

	public function createUjian($id_section = null){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['section'] = $this->db->get_where('section', ['id_section' => $id_section])->row_array();
		$data['title'] = "Tambah Ujian Baru";

		$this->form_validation->set_rules('title_ujian', 'Title Ujian', 'required');
		$this->form_validation->set_rules('deskripsi_ujian', 'Deskripsi Ujian', 'required');
		$this->form_validation->set_rules('tanggal_mulai_ujian', 'Tanggal Mulai Ujian', 'required');
		$this->form_validation->set_rules('tanggal_akhir_ujian', 'Tanggal Akhir Ujian', 'required');
		$this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('ujian/createUjian', $data);
			$this->load->view('templates/footer');
		}else{
			$this->ujian->createUjian();
			alert_success('Ujian berhasil ditambahkan!');
			redirect('course/detail/'.$this->input->post('course_uuid'));
		}
	}

	public function view($id){
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = "Ujian";
		$data['ujian'] = $this->ujian->getDataUjian(null, $id)->row_array();
		$data['hasil_ujian'] = $this->ujian->getDataUjianSiswa($id)->result_array();
		$data['soal_ujian'] = $this->ujian->getAllSoalUjian($id);

		$this->form_validation->set_rules('title_ujian', 'Title Ujian', 'required');
		$this->form_validation->set_rules('deskripsi_ujian', 'Deskripsi Ujian', 'required');
		$this->form_validation->set_rules('tanggal_mulai_ujian', 'Tanggal Mulai Ujian', 'required');
		$this->form_validation->set_rules('tanggal_akhir_ujian', 'Tanggal Akhir Ujian', 'required');
		$this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('ujian/editUjian', $data);
			$this->load->view('templates/footer');
		}else{
			$this->ujian->updateUjian($id);
			alert_success('Ujian berhasil diperbarui!');
			redirect('ujian/view/'.$id);
		}
	}

	public function createSoal($id_ujian){
		$this->form_validation->set_rules('soal', 'Soal Ujian', 'required');
		$this->form_validation->set_rules('opsi_a', 'Opsi A Ujian', 'required');
		$this->form_validation->set_rules('opsi_b', 'Opsi B Ujian', 'required');
		$this->form_validation->set_rules('opsi_c', 'Opsi C Ujian', 'required');
		$this->form_validation->set_rules('opsi_d', 'Opsi D Ujian', 'required');
		$this->form_validation->set_rules('kunci', 'Kunci Jawaban Soal', 'required');

		if ($this->form_validation->run() == false) {
			alert_danger('Something went wrong!');
			redirect('ujian/view/'.$id_ujian);
		}else{
			$this->ujian->createSoal($id_ujian);
			alert_success('Soal Ujian Berhasil Ditambahkan');
			redirect('ujian/view/'.$id_ujian);
		}
	}

	public function editSoal($id_relasi)
	{
		isGuru($this->session->userdata['role_id']);

		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['ujian'] = $this->ujian->getUjianRelasiById($id_relasi, true);
		$data['title'] = 'Edit Soal';

		$this->form_validation->set_rules('soal', 'Soal Ujian', 'required');
		$this->form_validation->set_rules('opsi_a', 'Opsi A Ujian', 'required');
		$this->form_validation->set_rules('opsi_b', 'Opsi B Ujian', 'required');
		$this->form_validation->set_rules('opsi_c', 'Opsi C Ujian', 'required');
		$this->form_validation->set_rules('opsi_d', 'Opsi D Ujian', 'required');
		$this->form_validation->set_rules('kunci', 'Kunci Jawaban Soal', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('ujian/editSoal', $data);
			$this->load->view('templates/footer');
		}else{
			$this->ujian->updateSoal($id_relasi);
			alert_success('Soal Ujian Berhasil Diperbarui');
			redirect('ujian/view/'.$data['ujian']['id_ujian']);
		}
	}

	public function deleteSoal($id_relasi){
		$data['ujian'] = $this->ujian->getUjianRelasiById($id_relasi);
		$this->ujian->deleteSoal($id_relasi, $data['ujian']['id_soal']);
		alert_success('Ujian berhasil dihapus!');
		redirect('ujian/view/'.$data['ujian']['id_ujian']);
	}

	public function deleteUjian($id){
		isGuru($this->session->userdata['role_id']);
		$data['ujian'] = $this->ujian->getDataUjian(null, $id)->row_array();
		$this->ujian->deleteUjian($id);
		alert_success('Ujian berhasil dihapus!');
		redirect('course/detail/'.$data['ujian']['course_uuid']);
	}

	public function deleteUjianSiswa($id_ujian_siswa){
		isGuru($this->session->userdata['role_id']);
		$data['ujian_siswa'] = $this->ujian->getDataUjianSiswa(null, $id_ujian_siswa)->row_array();
		$this->ujian->deleteUjianSiswa($id_ujian_siswa);
		alert_success('Data ujian siswa berhasil dihapus!');
		redirect('ujian/view/'.$data['ujian_siswa']['id_ujian']);
	}

}

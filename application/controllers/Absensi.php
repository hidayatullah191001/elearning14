<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Course_model', 'course');
		$this->load->model('Absensi_model', 'absensi');

		if (!$this->session->userdata('email', 'role_id')) {
			$data = base_url();
			$this->session->unset_userdata('email', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$this->email = $this->session->userdata['email'];
	}

	public function index(){
		if ($this->session->userdata['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);

			$course_uuid = $this->input->get('course');

			$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse()->row_array(null, $course_uuid);

			$data['absensis'] = $this->absensi->getDataAbsensi($course_uuid)->result_array();

			$data['title'] = "Absensi";

			$this->form_validation->set_rules('tanggal', 'Tanggal Absensi', 'required');
			$this->form_validation->set_rules('mulai', 'Jam Mulai', 'required');
			$this->form_validation->set_rules('akhir', 'Jam Akhir', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('absensi/index_guru', $data);
				$this->load->view('templates/footer');
			}else{
				$this->absensi->createAbsensi($course_uuid);
				alert_success('Absensi berhasil ditambahkan!');
				redirect('absensi?course='.$course_uuid);
			}
		}else if($this->session->userdata['role_id'] == 1){
			isSiswa($this->session->userdata['role_id']);

			$course_uuid = $this->input->get('course');

			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse(null, $course_uuid)->row_array();
			$data['absensis'] = $this->absensi->getDataAttendance($data['user']['id'],$course_uuid, false)->result_array();
			$data['absensi_siswas'] = $this->absensi->getDataAbsensiSiswa($data['user']['id'],$course_uuid)->result_array();
			$data['title'] = "Absensi";

			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('absensi/index_siswa', $data);
				$this->load->view('templates/footer');
			}else{
				$id_absensi = $this->input->post('id_absensi');
				$absensi = $this->absensi->getDataAbsensi(null, $id_absensi)->row_array();
				$keterangan = $this->input->post('keterangan');
				$date_submitted = time();

				$tanggal = date('d F Y', $absensi['tanggal']);
				$jam_mulai = date('H:i', $absensi['jam_mulai']);
				$jam_akhir = date('H:i', $absensi['jam_akhir']);

				$jam_sekarang = date('H:i', $date_submitted);
				$tanggal_sekarang = date('d F Y', $date_submitted);

				$checkAbsenSiswa = $this->absensi->checkAbsensiSiswa($data['user']['id'], $id_absensi)->row_array();
				if ($checkAbsenSiswa > 0) {
					alert_success('Kamu sudah mengisi absensi!');
					redirect('absensi?course='.$course_uuid);
				}else{
					if ($tanggal === $tanggal_sekarang) {
						if ($jam_sekarang >= $jam_mulai && $jam_sekarang <= $jam_akhir) {
							if ($keterangan != null) {
								$this->absensi->createAbsensiSiswa($id_absensi, $data['user']['id'], $course_uuid, $date_submitted, $keterangan);
								alert_success('Absensi berhasil dibuat!');
								redirect('absensi?course='.$course_uuid);
							}else{
								alert_danger('Keterangan tidak boleh kosong!');
								redirect('absensi?course='.$course_uuid);
							}
						}else{
							alert_danger('Belum waktunya absen atau absen sudah melewati batas waktu!');
							redirect('absensi?course='.$course_uuid);
						}
					}else{
						alert_danger('Absen ditutup!');
						redirect('absensi?course='.$course_uuid);
					}
				}
			}
			
		}
	}

	public function viewAbsensi(){
		isGuru($this->session->userdata['role_id']);
		$id = $this->input->get('absensi');
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['absensi'] = $this->absensi->getDataAbsensi(null, $id)->row_array();
		var_dump($this->email);
		die();
		$data['absensis'] = $this->absensi->getDataAbsensiSiswa(null, null, $id)->result_array();
		
		$data['title'] = "Absensi";

		$this->load->view('templates/header', $data);
		$this->load->view('absensi/viewAbsensi', $data);
		$this->load->view('templates/footer');
	}

	public function updateAbsensi($id){
		$data['absensi'] = $this->absensi->getDataAbsensi(null, $id)->row_array();

		$this->form_validation->set_rules('tanggal', 'Tanggal Absensi', 'required');
		$this->form_validation->set_rules('mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('akhir', 'Jam Akhir', 'required');

		if ($this->form_validation->run() == false) {
			alert_danger('Something went wrong!');
			redirect('absensi?course='.$course_uuid);
		}else{
			$this->absensi->updateAbsensi($id);
			alert_success('Absensi berhasil diperbarui!');
			redirect('absensi?course='.$course_uuid);
		}
	}

	public function deleteAbsensi($id){
		$data['absensi'] = $this->absensi->getDataAbsensi(null, $id)->row_array();
		$this->absensi->deleteAbsensi($id);
		alert_success('Absensi berhasil dihapus!');
		redirect('absensi?course='.$data['absensi']['course_uuid']);
	}

}
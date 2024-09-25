<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model', 'profile');
		$this->load->model('Mapel_model', 'mapel');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Course_model', 'course');
		$this->load->model('Video_model', 'video');
		$this->load->model('Materi_model', 'materi');
		$this->load->model('Tugas_model', 'tugas');
		$this->load->model('Link_model', 'link');
		$this->load->model('Catatan_model', 'catatan');
		$this->load->model('Ujian_model', 'ujian');
		$this->load->model('Absensi_model', 'absensi');
		$this->load->model('Pengumuman_model', 'pengumuman');
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
		if ($this->session->userdata['role_id'] == 2) {
			$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
			$data['title'] = 'Courses';

			$search = $this->input->get('search');

			$data['kelas'] = $this->kelas->getDataKelas()->result_array();
			$data['mapel'] = $this->mapel->getDataMapel()->result_array();

			if ($search != null) {
				$data['courses'] = $this->course->getDataCourse($data['user']['id'], null, $search)->result_array();
			}else{
				$data['courses'] = $this->course->getDataCourse($data['user']['id'])->result_array();
			}

			$data['enroll_course'] = $this->db->get('course_enroll')->result_array();

			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required');
			$this->form_validation->set_rules('mapel', 'Mapel', 'required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
			$this->form_validation->set_rules('kunci', 'Kunci', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('course/index_guru', $data);
				$this->load->view('templates/footer');
			}else{
				$this->course->createCourse($data['user']['id']);
				alert_success('Course berhasil dibuat!');
				redirect('course');
			}
			
		}else if($this->session->userdata['role_id'] == 1){
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['title'] = 'Courses';

			$search = $this->input->get('search');
			$category = $this->input->get('category');


			$data['kelas'] = $this->kelas->getDataKelas()->result_array();
			$data['mapel'] = $this->mapel->getDataMapel()->result_array();

			if ($search != null) {
				$data['courses'] = $this->course->getDataCourseSiswa($search)->result_array();
			}else if($category != null){
				$data['courses'] = $this->course->getDataCourseSiswa(null, $category)->result_array();
			}else{
				$data['courses'] = $this->course->getDataCourseSiswa()->result_array();
			}
			$data['enroll_course'] = $this->db->get('course_enroll')->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('course/index_siswa', $data);
			$this->load->view('templates/footer');
		}
	}

	public function detail($uuid){
		$data['sections'] = $this->course->getDataSection($uuid)->result_array();
		$data['videos'] = $this->video->getDataVideo($uuid)->result_array();
		$data['materis'] = $this->materi->getDataMateri($uuid)->result_array();
		$data['tugass'] = $this->tugas->getDataTugas($uuid)->result_array();
		$data['links'] = $this->link->getDataLink($uuid)->result_array();
		$data['catatans'] = $this->catatan->getDataCatatan($uuid)->result_array();
		$data['ujians'] = $this->ujian->getDataUjian($uuid)->result_array();
		$data['forum'] = $this->forum->getDataForum($uuid)->row_array();
		$data['count_pengumuman'] = $this->pengumuman->getDataPengumuman(null, $uuid)->num_rows();

		$data['title'] = 'Detail Course';

		if ($this->session->userdata['role_id'] == 2) {
			$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('course/detail_course_guru', $data);
			$this->load->view('templates/footer');
		}else{
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse($data['user']['id'], $uuid)->row_array();

			$checkEnroll = $this->course->checkEnroll($data['user']['id'], $uuid)->num_rows();
			$data['absensis'] = $this->absensi->getDataAttendance($data['user']['id'],$uuid, true)->result_array();

			$data['tugas_sides'] = $this->tugas->getDataTugasSiswaSide($data['user']['id'],$uuid, true)->result_array();

			if ($checkEnroll < 1) {
				alert_danger('Akses ditolak, kamu belum melakukan enroll course ini! Silahkan pilih course terlebih dahulu!');
				redirect('course');
			}else{
				$this->load->view('templates/header', $data);
				$this->load->view('course/detail_course_siswa', $data);
				$this->load->view('templates/footer');
			}
		}
	}

	public function detailCourse($uuid){
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = 'Detail Course';
		$data['course'] = $this->course->getDataCourseSiswa(null, null, $uuid)->row_array();
		$data['enroll_course'] = $this->db->get('course_enroll')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('course/detail', $data);
		$this->load->view('templates/footer');
	}

	public function editCourse($uuid=null){
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
		$data['title'] = 'Edit Courses';

		$data['kelas'] = $this->kelas->getDataKelas()->result_array();
		$data['mapel'] = $this->mapel->getDataMapel()->result_array();
		$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('mapel', 'Mapel', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('kunci', 'Kunci', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('course/edit_course_guru', $data);
			$this->load->view('templates/footer');
		}else{
			$this->course->updateCourse($uuid);
			alert_success('Course berhasil dibuat!');
			redirect('course/detail/'.$data['course']['uuid']);
		}
	}

	public function forumCourse($uuid){
		if ($this->session->userdata['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);
			$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
			$data['title'] = 'Forum';
			$data['forum'] = $this->forum->getDataForum($uuid)->row_array();

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('course/forum_course_guru', $data);
				$this->load->view('templates/footer');
			}else{
				$this->forum->createForum($uuid);
				alert_success('Forum course berhasil dibuat');
				redirect('course/forumCourse/'.$uuid);
			}
		}
	}

	public function annoucementCourse($uuid){
		if ($this->session->userdata['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);
			$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
			$data['title'] = 'Annoucement';
			$data['forum'] = $this->forum->getDataForum($uuid)->row_array();
			$data['pengumumans'] = $this->pengumuman->getDataPengumuman(null, $uuid)->result_array();

			$this->form_validation->set_rules('title_pengumuman', 'Title Pengumuman', 'required');
			$this->form_validation->set_rules('deskripsi_pengumuman', 'Deskripsi Pengumuman', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('course/annoucement_course_guru', $data);
				$this->load->view('templates/footer');
			}else{
				$this->pengumuman->createPengumuman($data['user']['role_id'], $data['user']['id'], $uuid);
				alert_success('Pengumuman berhasil dibuat');
				redirect('course/annoucementCourse/'.$uuid);
			}
		}else if($this->session->userdata['role_id'] == 1){

			isSiswa($this->session->userdata['role_id']);
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
			$data['title'] = 'Annoucement';
			$data['forum'] = $this->forum->getDataForum($uuid)->row_array();
			$data['pengumumans'] = $this->pengumuman->getDataPengumuman(null, $uuid)->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('course/annoucement_course_siswa', $data);
			$this->load->view('templates/footer');
		}
	}

	public function enroll($uuid){
		isSiswa($this->session->userdata['role_id']);
		$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();

		$key = $data['course']['kunci'];

		$this->form_validation->set_rules('keyenroll', 'Key Enroll', 'required');
		$checkEnroll = $this->course->checkEnroll($data['user']['id'], $uuid)->num_rows();

		if ($this->form_validation->run()==false) {
			alert_danger('Something went wrong!');
			redirect('course/detailCourse/'.$uuid);
		}else{
			$keyenroll = $this->input->post('keyenroll');
			if ($keyenroll == null) {
				alert_danger(' Key tidak boleh kosong!');
				redirect('course/detailCourse/'.$uuid);
			}else if (strtolower($keyenroll) != strtolower($key)) {
				alert_danger(' Key yang kamu masukkan salah. Coba lagi!');
				redirect('course/detailCourse/'.$uuid);
			}else if ($data['user']['nisn'] === '') {
				alert_danger(' NISN kamu masih kosong. Mohon isi terlebih dahulu!');
				redirect('course/detailCourse/'.$uuid);
			}else if ($checkEnroll > 0) {
				alert_success('Kamu telah terdaftar di course ini!');
				redirect('course/detailCourse/'.$uuid);
			}else {
				$this->course->createEnrollCourse($data['user']['id'], $uuid);
				alert_success('Course berhasil ditambahkan ke My Course!');
				redirect('course/mycourse/');
			}
		}
	}

	public function enrollUsers($uuid=null){
		isGuru($this->session->userdata['role_id']);
		$data['title'] = "Enroll Users";
		$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
		$data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();

		$data['enroll_users'] = $this->course->getDataUserEnroll($uuid)->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('course/enrollUsers', $data);
		$this->load->view('templates/footer');
	}

	public function deleteEnroll($id_enroll){
		if ($this->session->userdata['role_id'] == 2) {
			isGuru($this->session->userdata['role_id']);
			$enroll_users = $this->course->getDataUserEnroll(null, $id_enroll)->row_array();
			$this->course->deleteEnroll($id_enroll);
			alert_success('Data enroll berhasil dihapus!');
			redirect('course/enrollUsers/'.$enroll_users['course_uuid']);

		}elseif($this->session->userdata['role_id'] == 1){
			$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
			isSiswa($this->session->userdata['role_id']);
			$enroll_users = $this->course->getDataUserEnroll(null, $id_enroll)->row_array();
			$this->course->deleteEnroll($id_enroll);
			alert_success('Kamu berhasil unenroll dari course!');
			redirect('course/myCourse');
		}
	}

	public function mycourse(){
		isSiswa($this->session->userdata['role_id']);
		$data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
		$data['title'] = 'My Courses';

		$search = $this->input->get('search');
		$category = $this->input->get('category');

		$data['kelas'] = $this->kelas->getDataKelas()->result_array();
		$data['mapel'] = $this->mapel->getDataMapel()->result_array();

		if ($search != null) {
			$data['courses'] = $this->course->getDataMyCourse($data['user']['id'], $search)->result_array();
		}else{
			$data['courses'] = $this->course->getDataMyCourse($data['user']['id'])->result_array();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('course/myCourse', $data);
		$this->load->view('templates/footer');
	}

	public function publishCourse($uuid=null)
	{
		isGuru($this->session->userdata['role_id']);
		$data['course'] = $this->course->getDataCourse(null, $uuid)->row_array();
		if ($data['course']['is_publish'] == 0) {
			$this->db->set('is_publish', 1);
			$this->db->where('uuid', $uuid);
			$this->db->update('course');
			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				Status course dipublish!
				</div>');
			redirect('course/detail/'.$uuid);
		}else{
			$this->db->set('is_publish', 0);
			$this->db->where('uuid', $uuid);
			$this->db->update('course');
			$this->session->set_flashdata('message', '
				<div class="alert alert-success">
				Status course tidak dipublish!
				</div>');
			redirect('course/detail/'.$uuid);
		}
	}

	public function create_section($uuid){
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if ($this->form_validation->run()==false) {
			alert_danger('Something went wrong!');
			redirect('course/detail/'.$uuid);
		}else{
			$this->course->createSection($uuid);
			alert_success('New Section berhasil dibuat!');
			redirect('course/detail/'.$uuid);
		}
	}

	public function delete_section($uuid, $id_section){
		$this->course->deleteSection($id_section);
		alert_success('Section berhasil dihapus!');
		redirect('course/detail/'.$uuid);
	}

	public function delete($uuid){
		$this->course->delete($uuid);
		alert_success('Course berhasil dihapus!');
		redirect('course');
	}
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas_model extends CI_Model
{

	public function createTugas(){

		$dataSectionComment = [
			'course_uuid' => $this->input->post('course_uuid'),
			'id_section' => $this->input->post('section_id'),
			'date_created' => time(),
		];

		$this->db->insert('section_comment', $dataSectionComment);

		$id_section_comment = $this->db->insert_id();

		$data = [
			'id_section' => $this->input->post('section_id'),
			'course_uuid' => $this->input->post('course_uuid'),
			'title_tugas' => $this->input->post('title_tugas'),
			'deskripsi_tugas' => $this->input->post('deskripsi_tugas'),
			'deadline_tugas' => strtotime($this->input->post('deadline_tugas')),
			'file_tugas' => $this->fungsiUploadFileTugas('file_tugas'),
			'is_closed' => 0,
			'id_section_comment' => $id_section_comment,
			'date_created_tugas' => time(),
		];

		return $this->db->insert('tugas', $data);
	}

	public function getDataTugas($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM tugas WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM tugas WHERE id_tugas = $id";
		}else{
			$query = "SELECT * FROM tugas";
		}
		return $this->db->query($query);
	}

	public function getDataTugasSiswaSide($id, $uuid, $limit=false){
		if ($limit == true) {
			$query = "SELECT tugas_siswa.id_siswa, tugas.*, 
			CASE WHEN tugas_siswa.id_siswa IS NOT NULL THEN 1
			ELSE 0
			END AS `check`
			FROM tugas LEFT JOIN tugas_siswa on tugas.id_tugas = tugas_siswa.id_tugas AND tugas_siswa.id_siswa = $id WHERE tugas.course_uuid = '$uuid' ORDER BY `check` = 1 DESC ,tugas_siswa.date_uploaded ASC LIMIT 5";
		}else{
			$query = "SELECT *, 
			CASE WHEN tugas_siswa.id_siswa IS NOT NULL THEN 1
			ELSE 0
			END AS `check`
			FROM tugas LEFT JOIN tugas_siswa on tugas.id_tugas = tugas_siswa.id_tugas AND tugas_siswa.id_siswa = $id WHERE tugas.course_uuid = '$uuid' ORDER BY `check` = 1 DESC tugas_siswa.date_uploaded ASC";
		}
		
		return $this->db->query($query);
	}

	public function getDataTugasSiswa($id_tugas = null, $id_siswa = null, $id_tugas_siswa = null){
		if ($id_tugas != null && $id_siswa != null) {
			$query = "SELECT * FROM tugas_siswa WHERE tugas_siswa.id_tugas = $id_tugas AND tugas_siswa.id_siswa = $id_siswa";
		}else if($id_tugas){
			$query = "SELECT tugas_siswa.*, user.id, user.photo_profile, user.name  FROM tugas_siswa INNER JOIN user on tugas_siswa.id_siswa = user.id WHERE tugas_siswa.id_tugas = $id_tugas";
		}else if($id_siswa){
			$query = "SELECT tugas_siswa.*, user.id, user.photo_profile, user.name  FROM tugas_siswa INNER JOIN user on tugas_siswa.id_siswa = user.id WHERE tugas_siswa.id_siswa = $id_siswa";
		}else if($id_tugas_siswa){
			$query = "SELECT tugas_siswa.*, user.id, user.photo_profile, user.name  FROM tugas_siswa INNER JOIN user on tugas_siswa.id_siswa = user.id WHERE tugas_siswa.id_tugas_siswa = $id_tugas_siswa";
		}else{
			$query = "SELECT * FROM tugas_siswa";
		}

		return $this->db->query($query);
	}

	public function updateTugas($id)
	{
		$oldtugas = $this->input->post('oldtugas');
		if (!empty($_FILES['file_tugas']['name'])) {
			$data = [
				'title_tugas' => $this->input->post('title_tugas'),
				'deskripsi_tugas' => $this->input->post('deskripsi_tugas'),
				'deadline_tugas' => strtotime($this->input->post('deadline_tugas')),
				'file_tugas' => $this->fungsiUploadFileTugas('file_tugas'),
			];
			unlink(FCPATH . 'assets/upload/tugas/'. $oldtugas);
		}else{
			$data = [
				'title_tugas' => $this->input->post('title_tugas'),
				'deskripsi_tugas' => $this->input->post('deskripsi_tugas'),
				'deadline_tugas' => strtotime($this->input->post('deadline_tugas')),
				'file_tugas' => $oldtugas,
			];
		}
		$this->db->where('id_tugas', $id);
		return $this->db->update('tugas', $data);
	}

	public function countTugasSiswa($id_siswa, $id_tugas)
	{
		return $this->db->get_where('tugas_siswa', ['id_siswa' => $id_siswa, 'id_tugas' => $id_tugas])->num_rows();
	}

	public function createTugasSiswa($id_tugas, $id_section, $course_uuid, $id_siswa)
	{
		$data_tugas = [
			'id_tugas' => $id_tugas,
			'id_section' => $id_section,
			'course_uuid' => $course_uuid,
			'id_siswa' => $id_siswa,
			'file_tugas' => $this->fungsiUploadFileTugasSiswa('file_tugas'),
			'catatan_tugas_siswa' => $this->input->post('catatan_siswa'),
			'status' => 'Pending',
			'nilai' => 0,
			'date_uploaded' => time(),
		];
		return $this->db->insert('tugas_siswa', $data_tugas);
	}

	public function deleteTugas($id){
		return $this->db->delete('tugas', ['id_tugas' => $id]);
	}

	public function fungsiUploadFileTugas($namainputan){
		$config['upload_path']          = './assets/upload/tugas/';
		$config['allowed_types']        = 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|rar|zip|pdf';
		$config['max_size']             = 0;
		$this->load->library('upload', $config);
		$this->upload->do_upload($namainputan);
		return $this->upload->data("file_name");
	}


	public function fungsiUploadFileTugasSiswa($namainputan){
		$config['upload_path']          = './assets/upload/tugasSiswa/';
		$config['allowed_types']        = 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|rar|zip|pdf';
		$config['max_size']             = 0;
		$this->load->library('upload', $config);
		$this->upload->do_upload($namainputan);
		return $this->upload->data("file_name");
	}


}
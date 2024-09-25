<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi_model extends CI_Model
{

	public function createMateri(){

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
			'title_materi' => $this->input->post('title_materi'),
			'deskripsi_materi' => $this->input->post('deskripsi_materi'),
			'file_materi' => $this->fungsiUploadFileMateri('file_materi'),
			'id_section_comment' => $id_section_comment,
			'date_created_materi' => time(),
		];

		return $this->db->insert('materi', $data);
	}

	public function getDataMateri($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM materi WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM materi WHERE id_materi = $id";
		}else{
			$query = "SELECT * FROM materi";
		}
		return $this->db->query($query);
	}

	public function updateMateri($id)
	{
		$oldmateri = $this->input->post('oldmateri');
		if (!empty($_FILES['file_materi']['name'])) {
			$data = [
				'title_materi' => $this->input->post('title_materi'),
				'deskripsi_materi' => $this->input->post('deskripsi_materi'),
				'file_materi' => $this->fungsiUploadFileMateri('file_materi'),
			];
			unlink(FCPATH . 'assets/upload/materi/'. $oldmateri);
		}else{
			$data = [
				'title_materi' => $this->input->post('title_materi'),
				'deskripsi_materi' => $this->input->post('deskripsi_materi'),
				'file_materi' => $oldmateri,
			];
		}
		$this->db->where('id_materi', $id);
		return $this->db->update('materi', $data);

	}

	public function deleteMateri($id){
		return $this->db->delete('materi', ['id_materi' => $id]);
	}

	public function fungsiUploadFileMateri($namainputan){
		$config['upload_path']          = './assets/upload/materi/';
		$config['allowed_types']        = 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|rar|zip|pdf';
		$config['max_size']             = 0;
		$this->load->library('upload', $config);
		$this->upload->do_upload($namainputan);
		return $this->upload->data("file_name");
	}

}
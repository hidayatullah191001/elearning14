<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatan_model extends CI_Model
{

	public function createCatatan(){

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
			'title_catatan' => $this->input->post('title_catatan'),
			'deskripsi_catatan' => $this->input->post('deskripsi_catatan'),
			'id_section_comment' => $id_section_comment,
			'date_created_catatan' => time(),
		];

		return $this->db->insert('catatan', $data);
	}

	public function getDataCatatan($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM catatan WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM catatan WHERE id_catatan = $id";
		}else{
			$query = "SELECT * FROM catatan";
		}
		return $this->db->query($query);
	}

	public function updateCatatan($id)
	{
		$data = [
			'title_catatan' => $this->input->post('title_catatan'),
			'deskripsi_catatan' => $this->input->post('deskripsi_catatan'),
		];

		$this->db->where('id_catatan', $id);
		return $this->db->update('catatan', $data);

	}

	public function deleteCatatan($id){
		return $this->db->delete('catatan', ['id_catatan' => $id]);
	}

}
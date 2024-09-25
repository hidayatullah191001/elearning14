<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Link_model extends CI_Model
{

	public function createLink(){

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
			'title_link' => $this->input->post('title_link'),
			'deskripsi_link' => $this->input->post('deskripsi_link'),
			'link' => $this->input->post('link'),
			'id_section_comment' => $id_section_comment,
			'date_created_link' => time(),
		];

		return $this->db->insert('link', $data);
	}

	public function getDataLink($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM link WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM link WHERE id_link = $id";
		}else{
			$query = "SELECT * FROM link";
		}
		return $this->db->query($query);
	}

	public function updateLink($id)
	{
		$data = [
			'title_link' => $this->input->post('title_link'),
			'deskripsi_link' => $this->input->post('deskripsi_link'),
			'link' => $this->input->post('link'),
		];

		$this->db->where('id_link', $id);
		return $this->db->update('link', $data);

	}

	public function deleteLink($id){
		return $this->db->delete('link', ['id_link' => $id]);
	}

}
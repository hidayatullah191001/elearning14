<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Video_model extends CI_Model
{

	public function createVideo(){
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
			'title_video' => $this->input->post('title'),
			'link_video' => $this->input->post('link'),
			'pembahasan' => '',
			'id_section_comment' => $id_section_comment,
			'date_created_video' => time(),
		];

		return $this->db->insert('video', $data);
	}

	public function getDataVideo($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM video WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM video WHERE id_video = $id";
		}else{
			$query = "SELECT * FROM video";
		}
		return $this->db->query($query);
	}

	public function updateVideo($id)
	{
		$data = [
			'title_video' => $this->input->post('title'),
			'link_video' => $this->input->post('link'),
			'pembahasan' => $this->input->post('pembahasan'),
		];

		$this->db->where('id_video', $id);
		return $this->db->update('video', $data);

	}

	public function deleteVideo($id){
		return $this->db->delete('video', ['id_video' => $id]);
	}
}
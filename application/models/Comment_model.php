<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment_model extends CI_Model
{

	public function createComment($id_section_comment){
		$data = [
			'id_user' => $this->input->post('id_user'),
			'id_section_comment' => $id_section_comment,
			'text' => $this->input->post('message'),
			'date_comment' => time(),
		];

		return $this->db->insert('comment', $data);
	}

	public function getDataComment($id_section_comment){
		$query = "SELECT * FROM comment INNER JOIN user on comment.id_user = user.id where comment.id_section_comment = $id_section_comment";
		return $this->db->query($query);
	}

	public function deleteComment($id_comment){
		return $this->db->delete('comment', ['id_comment' => $id_comment]);
	}
}
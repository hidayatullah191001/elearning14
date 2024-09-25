<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum_model extends CI_Model
{

	public function createTopikDiscussion($id_forum, $id_siswa){

		$data = [
			'id_forum' => $id_forum,
			'id_siswa' => $id_siswa,
			'title_topik' => $this->input->post('topik'),
			'deskripsi_topik' => $this->input->post('deskripsi'),
			'date_created_topik' => time(),
		];

		return $this->db->insert('forum_topik', $data);
	}

	public function getDataForum($uuid=null, $id_forum=null){
		if ($uuid) {
			$query = "SELECT * FROM forum WHERE course_uuid = '$uuid'";
		}else if ($id_forum) {
			$query = "SELECT * FROM forum WHERE id_forum = $id_forum";
		}
		return $this->db->query($query);
	}

	public function getDataTopikForum($id_forum=null, $id_topik=null){
		if ($id_forum) {
			$query = "SELECT * FROM forum_topik INNER JOIN user on forum_topik.id_siswa = user.id WHERE forum_topik.id_forum = $id_forum";
		}elseif($id_topik){
			$query = "SELECT * FROM forum_topik INNER JOIN user on forum_topik.id_siswa = user.id WHERE forum_topik.id_forum_topik = $id_topik";
		}else{
			$query = "SELECT * FROM forum_topik INNER JOIN user on forum_topik.id_siswa = user.id WHERE forum_topik.id_forum = 0";
		}
		
		return $this->db->query($query);
	}

	public function getDataChatForum($id_topik=null, $id_chat=null){
		if ($id_topik) {
			$query = "SELECT * FROM forum_chat INNER JOIN user on forum_chat.id_siswa = user.id WHERE forum_chat.id_forum_topik = $id_topik";
		}else if($id_chat){
			$query = "SELECT * FROM forum_chat INNER JOIN user on forum_chat.id_siswa = user.id WHERE forum_chat.id_forum_chat = $id_chat";
		}else{
			$query = "SELECT * FROM forum_chat";
		}
		return $this->db->query($query);
	}

	public function createForum($uuid){
		$data = [
			'course_uuid' => $uuid,
			'title_forum' => $this->input->post('title'),
			'deskripsi_forum' => $this->input->post('deskripsi'),
			'date_created_forum' => time(),
		];

		return $this->db->insert('forum', $data);
	}


	public function createDiscussionChat($id_topik, $id_siswa){
		$data = [
			'id_forum_topik' => $id_topik,
			'id_siswa' => $id_siswa,
			'message' => $this->input->post('message'),
			'date_created_chat' => time(),
		];

		return $this->db->insert('forum_chat', $data);
	}

	public function deleteChat($id_chat=null, $id_topik=null){
		if ($id_chat) {
			return $this->db->delete('forum_chat',['id_forum_chat' => $id_chat]);
		}else if ($id_topik) {
			return $this->db->delete('forum_chat',['id_forum_topik' => $id_topik]);
		}
	}

	public function deleteTopik($id_topik){
		return $this->db->delete('forum_topik',['id_forum_topik' => $id_topik]);
	}
}
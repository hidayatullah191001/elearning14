<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{

	public function createPengumuman($role_id=null, $id_users=null, $uuid=null){
		
		if ($role_id == 3) {
			$data = [
				'course_uuid' => '',
				'title_pengumuman' => $this->input->post('title_pengumuman'),
				'deskripsi_pengumuman' => $this->input->post('deskripsi_pengumuman'),
				'role_id' => $role_id,
				'id_users' => $id_users,
				'date_created_pengumuman' => time(),
			];
		}else{
			$data = [
				'course_uuid' => $uuid,
				'title_pengumuman' => $this->input->post('title_pengumuman'),
				'deskripsi_pengumuman' => $this->input->post('deskripsi_pengumuman'),
				'role_id' => $role_id,
				'id_users' => $id_users,
				'date_created_pengumuman' => time(),
			];
		}
		return $this->db->insert('pengumuman', $data);
	}

	public function getDataPengumuman($role_id=null, $uuid=null){
		if ($role_id) {
			$query = "SELECT * FROM pengumuman INNER JOIN user on pengumuman.id_users = user.id WHERE pengumuman.role_id = $role_id";
		}elseif($uuid){
			$query = "SELECT * FROM pengumuman  INNER JOIN user on pengumuman.id_users = user.id WHERE pengumuman.course_uuid = '$uuid'";
		}else{
			$query = "SELECT * FROM pengumuman  INNER JOIN user on pengumuman.id_users = user.id";
		}

		return $this->db->query($query);
	}

	public function updatePengumuman(){
		$id_pengumuman = $this->input->post('id_pengumuman');
		$title_pengumuman = $this->input->post('title_pengumuman');
		$deskripsi_pengumuman = $this->input->post('deskripsi_pengumuman');

		$this->db->set('title_pengumuman', $title_pengumuman);
		$this->db->set('deskripsi_pengumuman', $deskripsi_pengumuman);
		$this->db->where('id_pengumuman', $id_pengumuman);

		return $this->db->update('pengumuman');
	}

	public function deletePengumuman($id_pengumuman){
		return $this->db->delete('pengumuman', ['id_pengumuman' => $id_pengumuman]);
	}
}
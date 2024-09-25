<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{

	public function createAbsensi($course_uuid){
		$data = [
			'course_uuid' => $course_uuid,
			'tanggal'=> strtotime($this->input->post('tanggal')),
			'jam_mulai' => strtotime($this->input->post('mulai')),
			'jam_akhir' => strtotime($this->input->post('akhir')),
			'date_created_absen' => time(),
		];

		return $this->db->insert('absensi', $data);
	}

	public function getDataAbsensi($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM absensi WHERE course_uuid = '$uuid' ORDER BY tanggal, jam_mulai ASC";
		}else if($id){
			$query = "SELECT * FROM absensi WHERE id_absensi = $id ORDER BY tanggal, jam_mulai ASC";
		}else{
			$query = "SELECT * FROM absensi ORDER BY tanggal, jam_mulai ASC";
		}
		return $this->db->query($query);
	}

	public function getDataAbsensiSiswa($id_siswa = null, $uuid = null, $id_absensi= null){
		if ($id_absensi) {
			$query = "SELECT * FROM attendance 
			INNER JOIN absensi on absensi.id_absensi = attendance.id_absensi
			INNER JOIN absensi_siswa on attendance.id_absensi_siswa = absensi_siswa.id 
			INNER JOIN user on attendance.id_siswa = user.id
			WHERE attendance.id_absensi = $id_absensi";
		}elseif($id_siswa){
			$query = "SELECT * FROM attendance 
			INNER JOIN absensi on absensi.id_absensi = attendance.id_absensi
			INNER JOIN absensi_siswa on attendance.id_absensi_siswa = absensi_siswa.id WHERE attendance.id_siswa = $id_siswa
			";
		}else{
			$query = "SELECT * FROM attendance 
			INNER JOIN absensi on absensi.id_absensi = attendance.id_absensi
			INNER JOIN absensi_siswa on attendance.id_absensi_siswa = absensi_siswa.id WHERE attendance.id_siswa = $id_siswa AND absensi.course_uuid = '$uuid'
			";
		}
		
		return $this->db->query($query);
	}

	public function getDataAttendance($id, $uuid, $limit=false){
		if ($limit == true) {
			$query = "SELECT *, 
			CASE WHEN attendance.id_siswa IS NOT NULL THEN 1
			ELSE 0
			END AS `check`
			FROM attendance RIGHT JOIN absensi on absensi.id_absensi = attendance.id_absensi AND attendance.id_siswa = $id WHERE absensi.course_uuid = '$uuid' ORDER BY `check` = 1 DESC, tanggal ASC, jam_mulai ASC LIMIT 5";
		}else{
			$query = "SELECT *, 
			CASE WHEN attendance.id_siswa IS NOT NULL THEN 1
			ELSE 0
			END AS `check`
			FROM attendance RIGHT JOIN absensi on absensi.id_absensi = attendance.id_absensi AND attendance.id_siswa = $id WHERE absensi.course_uuid = '$uuid' ORDER BY tanggal, jam_mulai ASC";
		}
		
		return $this->db->query($query);
	}

	public function updateAbsensi($id)
	{
		$data = [
			'tanggal'=> strtotime($this->input->post('tanggal')),
			'jam_mulai' => strtotime($this->input->post('mulai')),
			'jam_akhir' => strtotime($this->input->post('akhir')),
		];

		$this->db->where('id_absensi', $id);
		return $this->db->update('absensi', $data);

	}

	public function deleteAbsensi($id){
		return $this->db->delete('absensi', ['id_absensi' => $id]);
	}


	public function checkAbsensiSiswa($id_siswa, $id_absensi)
	{
		$query = "SELECT * FROM absensi_siswa INNER JOIN attendance ON absensi_siswa.id = attendance.id_absensi_siswa WHERE attendance.id_absensi = $id_absensi AND id_siswa = $id_siswa";
		return $this->db->query($query);
	}

	public function createAbsensiSiswa($id_absensi, $id_siswa, $uuid, $date_submitted, $keterangan)
	{
		$data_absen_siswa = [
			'course_uuid' => $uuid,
			'date_attended' => $date_submitted,
			'keterangan' => $keterangan
		];
		$this->db->insert('absensi_siswa', $data_absen_siswa);

		$data_attandance = [
			'id_absensi_siswa' => $this->db->insert_id(),
			'id_absensi' => $id_absensi,
			'id_siswa' => $id_siswa,
		];

		return $this->db->insert('attendance', $data_attandance);
	}


}
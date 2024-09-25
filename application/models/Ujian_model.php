<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian_model extends CI_Model
{

	public function createUjian(){
		$data = [
			'id_section' => $this->input->post('section_id'),
			'course_uuid' => $this->input->post('course_uuid'),
			'title_ujian' => $this->input->post('title_ujian'),
			'deskripsi_ujian' => $this->input->post('deskripsi_ujian'),
			'lama_pengerjaan' => $this->input->post('lama_pengerjaan'),
			'tanggal_mulai_ujian' => strtotime($this->input->post('tanggal_mulai_ujian')),
			'tanggal_akhir_ujian' => strtotime($this->input->post('tanggal_akhir_ujian')),
			'date_created_ujian' => time(),
		];

		return $this->db->insert('ujian', $data);
	}

	public function getDataUjian($uuid=null, $id=null){
		if ($uuid) {
			$query = "SELECT * FROM ujian WHERE course_uuid = '$uuid'";
		}else if($id){
			$query = "SELECT * FROM ujian WHERE id_ujian = $id";
		}else{
			$query = "SELECT * FROM ujian";
		}
		return $this->db->query($query);
	}

	public function updateUjian($id)
	{
		$data = [
			'title_ujian' => $this->input->post('title_ujian'),
			'deskripsi_ujian' => $this->input->post('deskripsi_ujian'),
			'lama_pengerjaan' => $this->input->post('lama_pengerjaan'),
			'tanggal_mulai_ujian' => strtotime($this->input->post('tanggal_mulai_ujian')),
			'tanggal_akhir_ujian' => strtotime($this->input->post('tanggal_akhir_ujian')),
		];

		$this->db->where('id_ujian', $id);
		return $this->db->update('ujian', $data);

	}

	public function deleteUjian($id){
		return $this->db->delete('ujian', ['id_ujian' => $id]);
	}

	public function getAllSoalUjian($id, $aktif = null)
	{
		if ($aktif == null) {
			$query = "SELECT * FROM soal_ujian INNER JOIN ujian_soal_relasi ar on soal_ujian.id_soal = ar.id_soal WHERE ar.id_ujian = '$id'";
		}else{
			$query = "SELECT * FROM soal_ujian INNER JOIN ujian_soal_relasi ar on soal_ujian.id_soal = ar.id_soal WHERE ar.id_ujian = '$id' AND ar.aktif = 1";
		}
		
		return $this->db->query($query)->result_array();
	}


	public function getUjianRelasiById($id_relasi, $join = null)
	{
		if ($join == null) {
			return $this->db->get_where('ujian_soal_relasi', ['id_relasi' => $id_relasi])->row_array();
		}else{
			$query = "SELECT * FROM ujian_soal_relasi INNER JOIN ujian on ujian_soal_relasi.id_ujian = ujian.id_ujian INNER JOIN soal_ujian on ujian_soal_relasi.id_soal = soal_ujian.id_soal WHERE ujian_soal_relasi.id_relasi = '$id_relasi' ORDER BY RAND()";
			return $this->db->query($query)->row_array();
		}
	}

	public function getUjianSiswa($course_uuid, $id_siswa, $id_ujian){
		$query = "SELECT * FROM ujian_siswa WHERE course_uuid = '$course_uuid' AND id_ujian = '$id_ujian' AND id_siswa = '$id_siswa'";
		
		return $this->db->query($query);
	}

	public function getDataUjianSiswa($id_ujian =null, $id_ujian_siswa=null){
		if ($id_ujian_siswa != null) {
			$query = "SELECT *, ujian_siswa.status as status_ujian FROM ujian_siswa INNER JOIN user on ujian_siswa.id_siswa = user.id WHERE ujian_siswa.id_ujian_siswa = $id_ujian_siswa";
		}else{
			$query = "SELECT *, ujian_siswa.status as status_ujian FROM ujian_siswa INNER JOIN user on ujian_siswa.id_siswa = user.id WHERE ujian_siswa.id_ujian = $id_ujian";
		}

		return $this->db->query($query);
	}


	public function checkUjianSiswa($id_ujian, $id_siswa)
	{
		
		$query = "SELECT * FROM ujian_siswa WHERE id_siswa = '$id_siswa' AND id_ujian = '$id_ujian'";
		return $this->db->query($query)->num_rows();
	}

	public function createSoal($id_ujian){
		$data_soal = [
			'soal' => $this->input->post('soal'),
			'opsi_a' => $this->input->post('opsi_a'),
			'opsi_b' => $this->input->post('opsi_b'),
			'opsi_c' => $this->input->post('opsi_c'),
			'opsi_d' => $this->input->post('opsi_d'),
			'kunci_jawaban' => strtoupper($this->input->post('kunci')),
			'date_created_soal' => time(),
		];

		$this->db->insert('soal_ujian', $data_soal);

		$id_soal = $this->db->insert_id();

		$data_relasi = [
			'id_ujian' => $id_ujian,
			'id_soal' => $id_soal,
			'aktif' => 1,
		];

		return $this->db->insert('ujian_soal_relasi', $data_relasi);
	}

	public function updateSoal($id_relasi){
		$data_soal = [
			'soal' => $this->input->post('soal'),
			'opsi_a' => $this->input->post('opsi_a'),
			'opsi_b' => $this->input->post('opsi_b'),
			'opsi_c' => $this->input->post('opsi_c'),
			'opsi_d' => $this->input->post('opsi_d'),
			'kunci_jawaban' => strtoupper($this->input->post('kunci')),
		];

		$this->db->set('aktif', $this->input->post('aktif'));
		$this->db->where('id_relasi', $id_relasi);
		$this->db->update('ujian_soal_relasi');

		$this->db->where('id_soal', $data['ujian']['id_soal']);
		return $this->db->update('soal_ujian', $data_soal);
	}
	
	public function cekJawabanSoal($nomor, $kunci)
	{
		
		$query = "SELECT * FROM soal_ujian WHERE id_soal = '$nomor' AND kunci_jawaban = '$kunci'";
		return $this->db->query($query)->num_rows();
	}

	public function deleteSoal($id_relasi, $id_soal){
		$this->db->delete('soal_ujian', ['id_soal' => $id_soal]);
		return $this->db->delete('ujian_soal_relasi', ['id_relasi' => $id_relasi]);
	}

	public function deleteUjianSiswa($id_ujian_siswa){
		return $this->db->delete('ujian_siswa', ['id_ujian_siswa' => $id_ujian_siswa]);
	}

}
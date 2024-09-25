<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Model
{

	public function getDataCourse($userId=null, $uuid = null, $key=null, $mapelId = null)
	{
		if ($userId != null && $uuid == null && $key == null) {
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id WHERE course.guru_id = $userId";
		}else if ($userId != null && $uuid != null) {
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id
			INNER JOIN course_enroll on course_enroll.course_uuid = course.uuid
			WHERE course.uuid = '$uuid' AND course_enroll.id_siswa = $userId";
		}else if($userId != null && $key !=null){
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id INNER JOIN mapel on mapel.id_mapel = course.mapel_id WHERE course.guru_id = $userId AND course.nama_course LIKE '%$key%' OR kelas.nama_kelas LIKE '%$key%'";
		}else if($mapelId){
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id INNER JOIN mapel on mapel.id_mapel = course.mapel_id WHERE mapel.id_mapel = $mapelId";
		}else if($uuid){
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id
			WHERE course.uuid = '$uuid'";
		}else{
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id = course.uuid";
		}
		return $this->db->query($query);
	}

	public function getDataMyCourse($id_siswa, $seacrh =null){

		if ($seacrh) {
			$query = "SELECT * FROM course_enroll INNER JOIN course on course_enroll.course_uuid = course.uuid INNER JOIN kelas on course.kelas_id = kelas.id_kelas INNER JOIN mapel on course.mapel_id = mapel.id_mapel WHERE course_enroll.id_siswa = $id_siswa AND course.nama_course LIKE '%$seacrh%' OR kelas.nama_kelas LIKE '%$seacrh%'";
		}else{
			$query = "SELECT * FROM course_enroll INNER JOIN course on course_enroll.course_uuid = course.uuid INNER JOIN kelas on course.kelas_id = kelas.id_kelas INNER JOIN mapel on course.mapel_id = mapel.id_mapel WHERE course_enroll.id_siswa = $id_siswa";
		}
		return $this->db->query($query);
	}

	public function getDataCourseSiswa($key=null, $mapelId = null, $uuid=null){
		if ($key) {
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id WHERE course.is_publish = 1 AND course.nama_course LIKE '%$key%' OR kelas.nama_kelas LIKE '%$key%'";
		}elseif($mapelId){
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id WHERE course.is_publish = 1 AND mapel.id_mapel = $mapelId";
		}else if($uuid){
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id
			INNER JOIN user on course.guru_id = user.id
			WHERE course.uuid = '$uuid'";
		}else{
			$query = "SELECT * FROM course INNER JOIN kelas on kelas.id_kelas = course.kelas_id 
			INNER JOIN mapel on mapel.id_mapel = course.mapel_id WHERE course.is_publish = 1";
			
		}
		return $this->db->query($query);
	}

	public function getDataUserEnroll($uuid=null, $id_enroll=null){

		if ($uuid) {
			$query = "SELECT * FROM course_enroll INNER JOIN user on course_enroll.id_siswa = user.id 
			INNER JOIN siswa on user.profile_id = siswa.id_siswa INNER JOIN kelas on siswa.kelas_id = kelas.id_kelas Where course_enroll.course_uuid = '$uuid'";
		}elseif($id_enroll){
			$query = "SELECT * FROM course_enroll INNER JOIN user on course_enroll.id_siswa = user.id 
			INNER JOIN siswa on user.profile_id = siswa.id_siswa INNER JOIN kelas on siswa.kelas_id = kelas.id_kelas Where course_enroll.id_enroll = $id_enroll";
		}
		return $this->db->query($query);
	}	

	public function getAllNewCourse()
	{
		$query = "SELECT * FROM course 
		INNER JOIN kelas ON course.kelas_id = kelas.id_kelas 
		INNER JOIN mapel ON course.mapel_id = mapel.id_mapel 
		INNER JOIN user on course.guru_id = user.id 
		INNER JOIN guru on user.profile_id = guru.id_guru 
		WHERE course.is_publish = 1 ORDER BY course.id_course DESC LIMIT 8";
		return $this->db->query($query);
	}


	public function createCourse($userId){
		$nama = $this->input->post('nama');
		$uid = trim($nama.time().$userId);
		$uuid = str_replace(' ', '', $uid);
		$fixuuid = preg_replace('/[^\p{L}\p{N}\s]/u', '', $uuid);
		$data = [
			'uuid' => strtolower($fixuuid),
			'nama_course' => $nama,
			'kelas_id' => $this->input->post('kelas'),
			'mapel_id' => $this->input->post('mapel'),
			'deskripsi' => $this->input->post('deskripsi'),
			'thumbnail' => $this->fungsiUploadThumbnail('thumbnail'),
			'kunci' => $this->input->post('kunci'),
			'guru_id' => $userId,
			'is_publish' => 0,
			'is_deleted' => 0,
			'date_created_course' => time(),
		];
		return $this->db->insert('course', $data);
	}

	public function createSection($uuid){
		$nama = $this->input->post('nama');
		$data = [
			'uuid_course' => $uuid,
			'nama_section' => $nama,
		];

		return $this->db->insert('section', $data);
	}

	public function getDataSection($uuid){
		return $this->db->get_where('section', ['uuid_course' => $uuid]);
	}

	public function deleteSection($id){
		return $this->db->delete('section', ['id_section' => $id]);
	}

	public function deleteEnroll($id){
		return $this->db->delete('course_enroll', ['id_enroll' => $id]);
	}

	public function updateCourse($uuid){
		$oldthumbnail = $this->input->post('oldthumbnail');
		if (!empty($_FILES['thumbnail']['name'])) {
			$data = [
				'nama_course' => $this->input->post('nama'),
				'kelas_id' => $this->input->post('kelas'),
				'mapel_id' => $this->input->post('mapel'),
				'deskripsi' => $this->input->post('deskripsi'),
				'thumbnail' => $this->fungsiUploadThumbnail('thumbnail'),
				'kunci' => $this->input->post('kunci'),
			];
			unlink(FCPATH . 'assets/upload/thumbnail/'. $oldthumbnail);
		}else{
			$data = [
				'nama_course' => $this->input->post('nama'),
				'kelas_id' => $this->input->post('kelas'),
				'mapel_id' => $this->input->post('mapel'),
				'deskripsi' => $this->input->post('deskripsi'),
				'thumbnail' => $oldthumbnail,
				'kunci' => $this->input->post('kunci'),
			];
		}
		$this->db->where('uuid', $uuid);
		return $this->db->update('course', $data);
	}

	public function fungsiUploadThumbnail($namainputan){
		$config['upload_path']          = './assets/upload/thumbnail/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 0;
		$this->load->library('upload', $config);
		$this->upload->do_upload($namainputan);
		return $this->upload->data("file_name");
	}

	public function checkEnroll($id, $uuid)
	{
		$query = "SELECT * FROM course_enroll WHERE id_siswa = $id AND course_uuid = '$uuid'";
		return $this->db->query($query);
	}

	public function createEnrollCourse($id_user, $uuid)
	{
		$data = [
			'id_siswa' => $id_user,
			'course_uuid' => $uuid,
			'date_enroll' => time()
		];
		return $this->db->insert('course_enroll', $data);
	}

	public function getCourseCount($id_guru)
	{
		return $this->db->get_where('course', ['guru_id' => $id_guru])->num_rows();
	}

	public function getCourseSiswaCount($id_guru){
		$query = "SELECT DISTINCT(course_enroll.id_siswa) FROM course INNER JOIN course_enroll on course.uuid = course_enroll.course_uuid WHERE course.guru_id = $id_guru";
		return $this->db->query($query);
	}

	public function delete($uuid){
		$this->db->delete('section', ['uuid_course' => $uuid]);
		$this->db->delete('absensi', ['course_uuid' => $uuid]);
		$this->db->delete('ujian', ['course_uuid' => $uuid]);
		$this->db->delete('materi', ['course_uuid' => $uuid]);
		$this->db->delete('video', ['course_uuid' => $uuid]);
		$this->db->delete('link', ['course_uuid' => $uuid]);
		$this->db->delete('catatan', ['course_uuid' => $uuid]);
		$this->db->delete('forum', ['course_uuid' => $uuid]);
		$this->db->delete('ujian', ['course_uuid' => $uuid]);
		$this->db->delete('tugas', ['course_uuid' => $uuid]);
		$this->db->delete('pengumuman', ['course_uuid' => $uuid]);
		$this->db->delete('section_comment', ['course_uuid' => $uuid]);
		return $this->db->delete('course', ['uuid' => $uuid]);
	}
}
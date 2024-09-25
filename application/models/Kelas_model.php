<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
	public function getDataKelas($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM kelas WHERE id_kelas = $id";
        }else{
            $query = "SELECT * FROM kelas";
        }
        return $this->db->query($query);
    }

	public function createKelas(){
		$kelas = $this->input->post('kelas');
		$data = [
			'nama_kelas' => $kelas,
			'date_created' => time(),
		];
		return $this->db->insert('kelas', $data);
	}

	public function updateKelas(){
		$id_kelas = $this->input->post('id_kelas');
		$kelas = $this->input->post('kelas');
		$this->db->set('nama_kelas', $kelas );
		$this->db->where('id_kelas', $id_kelas);
		return $this->db->update('kelas');   
	}

	public function deleteKelas($id_kelas){
		return $this->db->delete('kelas', ['id_kelas' => $id_kelas]);   
	}

	public function countKelas(){
		return $this->db->get('kelas')->num_rows();
	}
}
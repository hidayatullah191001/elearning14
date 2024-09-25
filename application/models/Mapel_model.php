<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{

    public function getDataMapel($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM mapel WHERE id_mapel = $id";
        }else{
            $query = "SELECT * FROM mapel";
        }
        return $this->db->query($query);
    }

    public function createMapel(){
        $mapel = $this->input->post('mapel');
        $data = [
            'mapel' => $mapel,
            'date_created' => time(),
        ];
        return $this->db->insert('mapel', $data);
    }

    public function updateMapel(){
        $id_mapel = $this->input->post('id_mapel');
        $mapel = $this->input->post('mapel');
        $this->db->set('mapel', $mapel );
        $this->db->where('id_mapel', $id_mapel);
        return $this->db->update('mapel');   
    }

    public function deleteMapel($id_mapel){
        return $this->db->delete('mapel', ['id_mapel' => $id_mapel]);   
    }

    public function countMapel(){
        return $this->db->get('mapel')->num_rows();
    }
}
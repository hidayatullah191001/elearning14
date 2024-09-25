<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    public function getDataSiswa($id = null, $email=null){
    	if ($id) {
    		$query = "SELECT * FROM user INNER JOIN siswa on user.profile_id = siswa.id_siswa INNER JOIN kelas on siswa.kelas_id = kelas.id_kelas WHERE user.id = $id";
    	}else if($email){
    		$query = "SELECT * FROM user INNER JOIN siswa on user.profile_id = siswa.id_siswa WHERE user.email = '$email'";
    	}else{
            $query = "SELECT * FROM user INNER JOIN siswa on user.profile_id = siswa.id_siswa INNER JOIN kelas on siswa.kelas_id = kelas.id_kelas";
        }
    	return $this->db->query($query);
    }

    public function getDataOperator($id = null, $email = null){
    	if ($id) {
    		$query = "SELECT * FROM user INNER JOIN operator ON user.profile_id = operator.id_operator WHERE user.id = $id";
    	}else if($email){
    		$query = "SELECT * FROM user INNER JOIN operator ON user.profile_id = operator.id_operator WHERE user.email = '$email'";
    	}else{
    		$query = "SELECT * FROM user";
    	}
    	return $this->db->query($query);
    }

    public function getDataGuru($id = null, $email = null){
        if ($id) {
            $query = "SELECT * FROM user INNER JOIN guru ON user.profile_id = guru.id_guru WHERE user.id = $id";
        }else if($email){
            $query = "SELECT * FROM user INNER JOIN guru ON user.profile_id = guru.id_guru WHERE user.email = '$email'";
        }else{
            $query = "SELECT * FROM user";
        }
        return $this->db->query($query);
    }

    
    public function updateProfile()
    {
        $role = $this->input->post('role_id');
        if ($role == 3) {
            $this->db->set('nip', $this->input->post('nip'));
            $this->db->set('no_telp', $this->input->post('no_telp'));
            $this->db->where('id_operator', $this->input->post('id_operator'));
            $this->db->update('operator');
        }else if($role == 2){
            $this->db->set('nip', $this->input->post('nip'));
            $this->db->set('no_telp', $this->input->post('no_telp'));
            $this->db->set('bio', $this->input->post('bio'));
            $this->db->set('mapel_id', $this->input->post('mapel_id'));
            $this->db->where('id_guru', $this->input->post('id_guru'));
            $this->db->update('guru');
        }else if ($role == 1){
            $this->db->set('nisn', $this->input->post('nisn'));
            $this->db->set('kelas_id', $this->input->post('kelas_id'));
            $this->db->set('no_telp', $this->input->post('no_telp'));
            $this->db->where('id_siswa', $this->input->post('id_siswa'));
            $this->db->update('siswa');
        }
        
        $this->db->set('name', $this->input->post('name'));
        $this->db->where('id', $this->input->post('id_user'));
        return $this->db->update('user');
    }

    public function updatePhotoProfile()
    {
        $id_user = $this->input->post('id_user');

        $upload_image = $_FILES['image']['name'];
        if($upload_image){
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
            $config['max_size'] = 0;
            $config['upload_path'] = 'assets/upload/avatar/';

            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('image'))
            {
                $old_image = $this->input->post('oldfoto');
                if($old_image != 'default.jpg'){
                    unlink(FCPATH . 'assets/upload/avatar/'. $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('photo_profile', $new_image);
            }
            else
            {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('id',$id_user);
        return $this->db->update('user');
    }

    public function updatePassword()
    {
        $id_user = $this->input->post('id_user');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        if (strlen($password1) < 8 || strlen($password2) < 8) {
            return "Passrd harus 8 Char";
        }elseif ($password1 != $password2) {
            return "Password tidak sama!";
        }else{
            $this->db->set('password', password_hash($password1, PASSWORD_DEFAULT));
            $this->db->where('id', $id_user);
            return $this->db->update('user');
        }
    }

}
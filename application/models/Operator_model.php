<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_model extends CI_Model
{
    private $_table = "user";

    public $id;
    public $name;
    public $email;
    public $role_id;
    public $is_active;
    public $is_deleted;
    public $date_modified;

    public function update_user() {
        $post = $this->input->post();

        $this->id = $post["id"];
        $this->name = $post["name"];
        $this->email = $post["email"];
        $this->role_id = $post["role_id"];
        if(isset($_POST['is_active']) )
        {
            $this->is_active = $post["is_active"];
        }
        else
        {
            $this->is_active = 0;
        }
        if(isset($_POST['is_deleted']) )
        {
            $this->is_deleted = $post["is_deleted"];
        }
        else
        {
            $this->is_deleted = 0;
        }
        $this->date_modified = time();
        $this->db->update($this->_table, $this, array('id' => $post['id']));

    }

    public function delete($id_user)
    {
        return $this->db->delete($this->_table, array("id" => $id_user));
    }
   
    public function countUser(){
        return $this->db->get('user')->num_rows();
    }
}

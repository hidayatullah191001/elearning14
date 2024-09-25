<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if($this->session->userdata('email'))
        {
            if ($this->session->userdata('role_id') == 1) {
                redirect('siswa');
            }else if($this->session->userdata('role_id') == 2){
                redirect('guru');
            }else if($this->session->userdata('role_id') == 3)  {
                redirect('operator');
            }else{
                redirect('auth/logout');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi lolos
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user=$this->db->get_where('user', ['email'=> $email])->row_array();

        if($user)
        {
            if($user['is_active']==1){
                // cek password
                if (password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    $this->db->set('status', 'Aktif');
                    $this->db->set('date_accessed', time());
                    $this->db->where('id', $user['id']);
                    $this->db->update('user');

                    if ($user['role_id'] == 1){
                        redirect('siswa');
                    }else if($user['role_id'] == 2){
                        redirect('guru');
                    }else if ($user['role_id'] == 3){
                        redirect('operator');
                    }
                }else{
                    $this-> session ->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Password anda salah</div>');
                    redirect('auth');                       
                }
            }else{
                $this-> session ->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Email anda belum diaktivasi. Hubungi operator untuk meminta aktivasi akun!</div>');
                redirect('auth');
            }

        }else{
            $this-> session ->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Email tidak terdaftar! </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if($this->session->userdata('email'))
        {
            redirect('user');
        }
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Passoword', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            
            $datasiswa = [
                'nisn' => '',
                'image' => 'default.png',
                'kelas_id'=> 0,
                'no_telp' => ''
            ];
            $this->db->insert('siswa', $datasiswa);

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'profile_id' => $this->db->insert_id(),
                'photo_profile' => 'default.jpg',
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1, 
                'is_active' => 1,
                'is_deleted' => 0,
                'status'=> 'Tidak Aktif',
                'date_created' => time(),
                'date_modified' => time(),
                'date_accessed' => 0
            ];
            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                Akun berhasil dibuat, silahkan login dengan akun tersebut.
                </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($data['user'] == null) {
            redirect('auth');
        }else{
            $this->db->set('status', 'Tidak Aktif');
        $this->db->where('id', $data['user']['id']);
        $this->db->update('user');
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                Kamu telah keluar dari aplikasi!
                </div>');
            redirect('auth');
        }
        }

        
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

}

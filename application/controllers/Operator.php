<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public $email;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Operator_model', 'operator');
        $this->load->model('Mapel_model', 'mapel');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->model('Profile_model', 'profile');
        $this->load->model('Pengumuman_model', 'pengumuman');
        isOperator($this->session->userdata['role_id']); 
        $this->email = $this->session->userdata['email'];
    }
    
    public function index()
    {
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();
        $data['title'] = 'Home';
        $data['total_kelas'] = $this->kelas->countKelas();
        $data['total_mapel'] = $this->mapel->countMapel();
        $data['total_users'] = $this->operator->countUser();

        $this->load->view('templates/header', $data);
        $this->load->view('operator/index', $data);
        $this->load->view('templates/footer');
    }

    public function management_users()
    {
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();
        isOperator($data['user']['role_id']); 

        $data['title'] = 'Management Users';
        $data['userr'] = $this->db->get('user')->result_array();
        $data['role'] = $this->db->get('role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('operator/management_users', $data);
        $this->load->view('templates/footer');
    }

    public function add_user(){
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();
        isOperator($data['user']['role_id']); 
        
        $data['title'] = 'Add New User';

        $data['userr'] = $this->db->get('user')->result_array();

        $data['role'] = $this->db->get('role')->result_array();

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
            alert_danger(validation_errors());
            redirect('operator/management_users');
        } else {
            $role = $this->input->post('role_id');
            if ($role == 2) {
                $dataguru = [
                    'nip' => '',
                    'bio' => '',
                    'no_telp' => '',
                    'mapel_id' => 0,
                ];
                $this->db->insert('guru', $dataguru);
            }else if ($role == 1) {
                $datasiswa = [
                    'nisn' => '',
                    'kelas_id'=> 0,
                    'no_telp' => ''
                ];
                $this->db->insert('siswa', $datasiswa);
            }

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'profile_id' => $this->db->insert_id(),
                'photo_profile' => 'default.jpg',
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'is_active' => 0,
                'is_deleted' => 0,
                'status'=> 'Tidak Aktif',
                'date_created' => time(),
                'date_modified' => time(),
                'date_accessed' => 0,
            ];
            $this->db->insert('user', $data);
            alert_success('Akun berhasil dibuat!');
            redirect('operator/management_users');
        }
    }

    public function update_user() {

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                Something went wrong!
                </div>');
            redirect('operator/management_users');
        }else{
            $this->operator->update_user();
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                Akun berhasil diperbarui!
                </div>');
            redirect('operator/management_users');
        }
    }


    public function delete($id = null)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('user');
        alert_success('Akun Berhasil dihapus!');
        redirect('operator/management_users');
    }

    public function deletePermanen($id = null)
    {

        $_id = $this->db->get_where('user', ['id' => $id])->row_array();
        $query = $this->db->delete('user', ['id' => $id]);
        if ($_id['role_id'] == 2) {
            $query2 = $this->db->delete('guru', ['id_guru' => $_id['profile_id']]);
        }else if($_id['role_id'] == 1){
            $query2 = $this->db->delete('siswa', ['id_siswa' => $_id['profile_id']]);
        }
        alert_success('Akun Berhasil dihapus permanen!');
        redirect('operator/management_users');
    }

    public function master(){
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();
        $data['title'] = 'Data Master';

        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['mapel'] = $this->db->get('mapel')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('operator/master', $data);
        $this->load->view('templates/footer');
    }

    public function pengumuman(){
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();
        $data['title'] = 'Pengumuman';

        // $data['kelas'] = $this->db->get('kelas')->result_array();
        // $data['mapel'] = $this->db->get('mapel')->result_array();

        $data['pengumumans'] = $this->pengumuman->getDataPengumuman()->result_array();

        $this->form_validation->set_rules('title_pengumuman', 'Title Pengumuman', 'required');
        $this->form_validation->set_rules('deskripsi_pengumuman', 'Deskripsi Pengumuman', 'required');

        if ($this->form_validation->run() ==false) {
            $this->load->view('templates/header', $data);
            $this->load->view('operator/pengumuman', $data);
            $this->load->view('templates/footer');
        }else{
            $this->pengumuman->createPengumuman($data['user']['role_id'], $data['user']['id']);
            alert_success('Pengumuman berhasil dibuat');
            redirect('operator/pengumuman');
        }
    }


    public function create_kelas(){
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == false) {
            alert_danger(validation_errors());
        }else{
            $this->kelas->createKelas();
            alert_success('Data Kelas berhasil dibuat');
            redirect('operator/master');
        }
    }

    public function update_kelas(){
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == false) {
            alert_danger(validation_errors());
            redirect('operator/master');
        }else{
            $this->kelas->updateKelas();
            alert_success('Data Kelas berhasil diperbarui');
            redirect('operator/master');
        }
    }

    public function delete_kelas($id_kelas){
        $this->kelas->deleteKelas($id_kelas);
        alert_success('Data Kelas berhasil dihapus');
        redirect('operator/master');
    }

    public function create_mapel(){
        $this->form_validation->set_rules('mapel', 'Mapel', 'required');

        if ($this->form_validation->run() == false) {
            alert_danger(validation_errors());
            redirect('operator/master');
        }else{
            $this->mapel->createMapel();
            alert_success('Data Mata Pelajaran berhasil dibuat');
            redirect('operator/master');
        }
    }

    public function update_mapel(){
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            alert_danger(validation_errors());
            redirect('operator/master');
        }else{
            $this->mapel->updateMapel();
            alert_success('Data Mata Pelajaran berhasil diperbarui');
            redirect('operator/master');
        }
    }

    public function delete_mapel($id_mapel){
        $this->mapel->deleteMapel($id_mapel);
        alert_success('Data Mata Pelajaran berhasil dihapus');
        redirect('operator/master');
    }


    public function profile()
    {
        $data['user'] = $this->profile->getDataOperator(null, $this->email)->row_array();

        $data['title'] = "Profile";
        $data['operator'] = $this->profile->getDataOperator($data['user']['id'])->row_array();

        
        $this->load->view('templates/header', $data);
        $this->load->view('operator/profile', $data);
        $this->load->view('templates/footer');
    }

    public function updateProfile()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');

        if ($this->form_validation->run() == false) {
            alert_danger(validation_errors());
            redirect('operator/master');
        }else{
            $this->profile->updateProfile();
            alert_success('Profile berhasil diperbarui');
            redirect('operator/profile');
        }
    }

    public function updatePhoto()
    {
        $update = $this->profile->updatePhotoProfile();
        if ($update) {
            alert_success('Photo Profile berhasil diperbarui');
            redirect('operator/profile');
        }else{
            alert_danger('Photo Profile gagal diperbarui');
            redirect('operator/profile');
        }
    }

    public function ubahPassword()
    {
        $data = $this->profile->updatePassword();
        if ($data) {
            $this->alert_success('Password berhasil diubah!');
            redirect('profile');
        }else{
            $this->alert_danger($data);
            redirect('profile');
        }
    }


}

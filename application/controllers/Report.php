<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public $email;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model', 'profile');
        $this->load->model('Report_model', 'report');
        $this->load->model('Tugas_model', 'tugas');
        $this->load->model('Absensi_model', 'absensi');
        $this->email = $this->session->userdata['email'];
    }
    
    public function index()
    {
        $data['title'] = 'Report';
        if ($this->session->userdata['role_id'] == 2) {
            isGuru($this->session->userdata['role_id']); 
            
            $data['user'] = $this->profile->getDataGuru(null, $this->email)->row_array();
            $data['reportUser'] = $this->report->getDataSiswaEnrollCourse($data['user']['id'])->result_array();
            $data['alluser'] = $this->profile->getDataSiswa()->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('report/index', $data);
            $this->load->view('templates/footer');
        }else{
            isSiswa($this->session->userdata['role_id']); 
            $data['user'] = $this->profile->getDataSiswa(null, $this->email)->row_array();
            $data['reportUser'] = $this->report->getReportCourse($data['user']['id'])->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('report/index_siswa', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function cetak($id_siswa, $id_course = null){
        $this->load->library('Pdfgenerator');
        $paper = 'A4';
        $orientation = "portrait";
        $this->data['title_pdf'] = 'Report';

        $data['siswa'] = $this->profile->getDataSiswa($id_siswa)->row_array();
        $data['sections'] = $this->db->get('section')->result_array();
        $data['course'] = $this->db->get_where('course', ['id_course' => $id_course])->row_array();
        $data['tugas_siswa'] = $this->tugas->getDataTugasSiswa()->result_array();
        $data['ujian_siswa'] = $this->db->get('ujian_siswa')->result_array();
        $data['absensi_siswa'] = $this->absensi->getDataAbsensiSiswa($data['siswa']['id'])->result_array();

        if ($id_course) {
            $file_pdf = 'Report - '.$data['siswa']['name'] .' - '. $data['course']['nama_course'];
            $data['enrollCourse'] = $this->report->getReportCourse($id_siswa, $id_course)->row_array();

            $html = $this->load->view('report/cetak_siswa', $data, true);   
            // $this->load->view('report/cetak_siswa', $data);

        }else{
            $data['enrollCourse'] = $this->report->getReportCourse($id_siswa, null)->result_array();

            $file_pdf = 'Report - '.$data['siswa']['name'];
            $html = $this->load->view('report/cetak', $data, true);   
            // $this->load->view('report/cetak', $data);
        }
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        
    }
}
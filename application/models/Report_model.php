<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{

    public function getDataSiswaEnrollCourse($id_guru)
    {
        $query = "SELECT DISTINCT(course_enroll.id_siswa) FROM course 
        INNER JOIN course_enroll on course_enroll.course_uuid = course.uuid
        WHERE course.guru_id = $id_guru";

        return $this->db->query($query);
    }

    public function getReportCourse($id_siswa, $id_course = null){
        if ($id_course == null) {
            $query = "SELECT * FROM course_enroll 
            INNER JOIN course on course_enroll.course_uuid = course.uuid
            WHERE course_enroll.id_siswa = $id_siswa";
        }else{
            $query = "SELECT * FROM course_enroll 
            INNER JOIN course on course_enroll.course_uuid = course.uuid
            INNER JOIN user on course.guru_id = user.id
            WHERE course_enroll.id_siswa = $id_siswa AND course.id_course = $id_course";
        }
        return $this->db->query($query);   
    }
}
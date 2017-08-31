<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Teacher extends CI_Model
{
    public function addTeacher($id) 
    {
        $data['user_id'] = $id;
        $query = "SELECT * FROM `teacher` WHERE  '$id' LIKE `teacher`.`user_id`";
        $result = $this->db->query($query);
        $this->db->where('id',$id);
        $this->db->update('student',array('access_level' => 2));
        if($result->num_rows() <= 0)
        {
            $result = $this->db->insert('teacher',$data);
        }
        return $result;
    }
    
    public function getTeacherCourses($id)
    {
        $query = "SELECT * FROM `course` WHERE `course`.`teacher_user_id` = $id ";
        $result = $this->db->query($query)->result();
        //if($result->num_rows() > 0)
            return $result;
        //return false;
    }
    
    public function unapprovedCourses($id)
    {
        $query = "SELECT COUNT(*) AS `count` FROM `course` WHERE `teacher_user_id` = $id AND `approved` = 0";
        $result = $this->db->query($query)->row()->count;
        return $result;
    }
}

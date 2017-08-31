<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Model
{
    public function validate($username,$password)
    {
        $query = "SELECT * FROM `student` WHERE  '$username' LIKE `student`.`email` AND '$password' LIKE `student`.`password`";
        $result = $this->db->query($query);
        if($result->num_rows() == 1)
        {
            $row = $result->row();
            if ($row->status === 0) 
            {
                return 'User disabled';
            }
            $newdata = array(
                'id'=>$row->id,
                'email'=>$row->email,
                'name'=>$row->firstname,
                'lastname'=>$row->lastname,
                'access_level'=>$row->access_level,
                'picture_url'=>$row->picture_url,
                'logged_in'=>true
            );
            $this->session->set_userdata($newdata);
            return;
        }
        return 'Invalid username or password';
    }
    
    public function addStudent($userdata,$domains) 
    {
        $this->db->trans_start();
        $query = $this->db->insert('student',$userdata);
        $id = $this->db->insert_id();
        foreach ($domains as $domain) {
            $this->db->insert("user_domain",array("user_id" => $id,"domain_name" => $domain ));
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function promoteToTeacher(){
        $this->db->where('id',  $this->session->userdata('access_level'));
        $result = $this->db->update('student',array('access_level' => 2));
        return $result;
    }

    public function getAllStudents() {
        $result = $this->db->query("SELECT `student`.`id`, `firstname`,"
                . " `lastname`, `email`, `phone`, `country`,"
                . " `picture_url`, `access_level`.`access_level`, `active`,"
                . " `status`, `timestamp` FROM `student`,`access_level`"
                . " WHERE `student`.`access_level`=`access_level`.`id`")->result();
        return $result;
    }
    
    public function getEmailById($email) {
        $result = $this->db->query("SELECT `id` FROM `student` WHERE `email` LIKE '$email'")->row()->id;
        return $result;
    }
    
    public function getLastRated() {
        $result = $this->db->query("SELECT `course_id` FROM `user_rating` WHERE `user_id`=".$this->session->userdata("id")." ORDER BY `timestamp` LIMIT 1")->row()->course_id;
        return $result;
        
    }
    
    
}
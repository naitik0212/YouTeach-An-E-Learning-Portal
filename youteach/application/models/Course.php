<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Model
{
    public function getTopCourses($num){
        $query = "SELECT `name`,`id` FROM `youteach`.`course` WHERE `approved` = 1 and `status` = 1 ORDER BY `views` DESC LIMIT $num";
        $result = $this->db->query($query)->result();
        return $result;
    }
    
    public function getAllDomains() {
        $query = "SELECT `name` FROM `youteach`.`domain` ORDER BY `name`";
        $result = $this->db->query($query)->result();
        return $result;
    }
    
    public function addDomain($domain) {
        $data['name'] = $domain;
        $query = "SELECT * FROM `domain` WHERE  '$domain' LIKE `domain`.`name`";
        $result = $this->db->query($query);
        if($result->num_rows() <= 0)
            $result = $this->db->insert('domain',$data);
        return $result;
    }
    
    public function addCourse($courseinfo) {
        $this->db->trans_start();
        $result = $this->db->insert('course',$courseinfo);
        if($result)
            $result = $this->db->insert_id();
        $this->db->trans_complete();
        return $result;
    }
    
    public function updateCourse($courseinfo,$courseid) {
        $this->db->where("id",$courseid);
        $result = $this->db->update('course',$courseinfo);
        return $result;
    }
    
    public function addVideoFile($files){
        $this->db->trans_start();
        foreach($files as $fileinfo)
        {
            $this->db->insert('course_video',$fileinfo);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function deleteCourse($courseid) {
        $query = "SELECT `image_loc` FROM `course` WHERE `id` = $courseid";
        $result = $this->db->query($query);
        $imgpath = 'courses/'.$result->row()->image_loc;
        if(file_exists($imgpath))
        {
            unlink($imgpath);
        }
        $this->db->where('id',$courseid);
        $this->db->delete('course');
        $this->db->where('course_id',$courseid);
        $this->db->delete('course_video');
        $vidpath = 'courses/'.  md5($this->session->userdata('email')).'/videos/'.$courseid.'/';
        if(file_exists($vidpath))
        {
            delete_files($vidpath.'/');
            rmdir($vidpath);
        }
        return TRUE;
    }
    
    public function getCourseStatus($courseid) {
        $query = "SELECT `approved` ,`status`,`finalized` FROM `course` WHERE `id` = $courseid";
        return $this->db->query($query)->row();
    }
    
    public function getCourseData($courseid) {
        $query = "SELECT * FROM course WHERE `id`= $courseid";
        return $this->db->query($query)->row();
    }
//    private  function rrmdir($dir) { 
//        if (is_dir($dir)) { 
//            $objects = scandir($dir); 
//                foreach ($objects as $object) { 
//                    if ($object != "." && $object != "..") { 
//                        if (is_dir($dir."/".$object))
//                          rrmdir($dir."/".$object);
//                        else
//                          unlink($dir."/".$object); 
//                    } 
//                }
//            rmdir($dir); 
//        } 
//    }
    
    
    public function updateCourseModerator($courseid,$mod_id){
        $this->db->where("id",$courseid);
        return $this->db->update("course",array('moderator_user_id' => $mod_id));
    }
    
    public function finalizeCourse($courseid,$mod_id){
        
        $this->db->trans_start();
            $this->db->where("id",$courseid);
            $this->db->update("course",array('finalized' => 1 , 'finalized_timestamp' => date("y-m-d h:i:s",time())));
            $this->Request->createRequest(array('request_type_id' => 2 , 'user_id' => $this->session->userdata('id'),'moderator_id' => $mod_id, "course_id" => $courseid ,"request_message" => "approval for course"));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function isFinalized($courseid){
        return $this->db->query("SELECT finalized FROM `course` WHERE `id` = $courseid")->row()->finalized;
    }

    public function isUserCourse($course) {
        $query = "SELECT * FROM `course` WHERE `id` = $course AND `teacher_user_id` = ".$this->session->userdata('id');
        if($this->db->query($query)->num_rows() == 1)
            return true;
        return false;
    }
    public function getCourseById2($courseid) {
        $this->db->where("id",$courseid);
        $this->db->set("views","views+1",FALSE);
        $this->db->update("course");
        $query ="(SELECT `course`.`id`, `name`, `description`, "
                . "`teacher_user_id`, `image_loc`, `views`, `course`.`timestamp`, "
                . "`finalized`, `finalized_timestamp`, `edited_timestamp`, "
                . "`approved_timestamp`, `approved`, `course`.`status`, "
                . "`moderator_user_id`, `domain_name`,`email` as `teacher_email` "
                . "FROM `course`,`student` WHERE `student`.`id`=`course`.`teacher_user_id` "
                . " AND `course`.`id` = $courseid) ";
        return $this->db->query($query)->row();
    }
    public function getCourseById($courseid) {
        $this->db->where("id",$courseid);
        $this->db->set("views","views+1",FALSE);
        $this->db->update("course");
        $query = "SELECT `abc`.*,`student`.`email` as `moderator_email` "
                . "FROM "
                . "(SELECT `course`.`id`, `name`, `description`, "
                . "`teacher_user_id`, `image_loc`, `views`, `course`.`timestamp`, "
                . "`finalized`, `finalized_timestamp`, `edited_timestamp`, "
                . "`approved_timestamp`, `approved`, `course`.`status`, "
                . "`moderator_user_id`, `domain_name`,`email` as `teacher_email` "
                . "FROM `course`,`student` WHERE `student`.`id`=`course`.`teacher_user_id` "
                . " AND `course`.`id` = $courseid) "
                . "as `abc`,`student` WHERE `moderator_user_id`=`student`.`id` ";
        return $this->db->query($query)->row();
    }
    
    public function getCourseVideos($courseid){
        $courseid = addslashes($courseid);
            return $this->db->query("SELECT * FROM `course_video` WHERE `course_id` = $courseid ORDER BY `course_video_index`")->result();
        return false;
    }
    
    public function getAllCoursesWithJoin()
    {
        $query = "SELECT `abc`.*,`student`.`email` as `moderator_email` "
                . "FROM "
                . "(SELECT `course`.`id`, `name`, `description`, "
                . "`teacher_user_id`, `image_loc`, `views`, `course`.`timestamp`, "
                . "`finalized`, `finalized_timestamp`, `edited_timestamp`, "
                . "`approved_timestamp`, `approved`, `course`.`status`, "
                . "`moderator_user_id`, `domain_name`,`email` as `teacher_email` "
                . "FROM `course`,`student` WHERE `student`.`id`=`course`.`teacher_user_id` ) "
                . "as `abc`,`student` WHERE `moderator_user_id`=`student`.`id` ";
        $result = $this->db->query($query)->result();
        //if($result->num_rows() > 0)
            return $result;
        //return false;
    }
    
    public function getCurrentUserRating($courseid)
    {
        $result = $this->db->query("SELECT * FROM `user_rating` WHERE `course_id` = $courseid AND `user_id` = ".$this->session->userdata("id"))->row();
        if($result)
            return $result;
        else return null;
    }
    
    public function approveCourse($courseid)
    {
        $this->db->where("id",$courseid);
        error_reporting(E_ERROR | E_PARSE);
        $this->db->update("course",array("approved" => 1,"status" => 1,'approved_timestamp' => date("y-m-d h:i:s",time())));
        $this->db->where("course_id",$courseid);
        $this->db->set("granted","1");
        return $this->db->update("user_request");
    }
    
    public function allowCourseModification($courseid)
    {
        $this->db->where("id",$courseid);
        $this->db->set("finalized","0");
        return $this->db->update("course");
    }
    
    public function getCourseComments($id){
        $query = "SELECT `course_comment`.`id`, `course_id`, `user_id`, "
                . "`course_comment`.`timestamp`, `comment_body`,`email` "
                . "AS `user_email`,`picture_url` AS `user_image` FROM "
                . "`course_comment`,`student` WHERE `user_id` = `student`.`id` "
                . "AND `course_id` = $id ORDER BY `course_comment`.`timestamp`";
        return $this->db->query($query)->result();
    }
    
    public function courseAvailable($id){
        if(!isset($id))
            return 0;
        $query = "SELECT EXISTS(SELECT 1 FROM `course` WHERE `id` = $id) AS `exists`";
        return $this->db->query($query)->row()->exists;
    }

    public function addCourseComment($comment_info){
        return $this->db->insert("course_comment",$comment_info);
    }
    
    public function createCourseRating($courseid,$rating){
        $userid = $this->session->userdata("id");
        $query = "SELECT EXISTS(SELECT 1 FROM `user_rating` WHERE `course_id` = $courseid AND `user_id` = $userid) AS `exists`";
        if($this->db->query($query)->row()->exists != 0)
        {
            $this->db->where(array("course_id"=>$courseid , "user_id"=>$userid));
            return $this->db->update("user_rating",array("rating"=>$rating));
        }
        else 
            return $this->db->insert("user_rating",array("user_id" =>$userid , "course_id" =>$courseid , "rating" =>$rating));
    }
}

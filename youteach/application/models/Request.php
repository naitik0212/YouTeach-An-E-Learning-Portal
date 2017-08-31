<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 1 : add_course_request
 * 2 : course_verification
 * 3 : delete_or_edit_course
 */

class Request extends CI_Model
{
    public function createRequest($request_data) {
       $result = $this->db->insert("user_request",$request_data);
       return $result;
    }
    
    public function getAllRequestsWithJoin() {
        $query = "SELECT `temp`.*,`course`.`name` AS `course_name` "
                . "FROM (SELECT `user_request`.`id`, `user_request`.`timestamp`, "
                . "`request_type_id`, `course_id`, `request_message`, `user_id`, "
                . "`moderator_id`, `viewed`, `granted`,`email` AS `user_email` FROM  "
                . "`user_request`,`student`,`course` WHERE `student`.`id` = `user_id`) AS `temp`, "
                . "`course` WHERE `course`.`id` = `course_id`";
        return $this->db->query($query)->result();
    }
    
    public function getAllRequestsWithJoinPending() {
        $query = "SELECT `temp`.*,`course`.`name` AS `course_name` "
                . "FROM (SELECT `user_request`.`id`, `user_request`.`timestamp`, "
                . "`request_type_id`, `course_id`, `request_message`, `user_id`, "
                . "`moderator_id`, `viewed`, `granted`,`email` AS `user_email` "
                . "FROM  `user_request`,`student` WHERE `student`.`id` = `user_id`"
                . " AND `granted`=0) AS `temp`, `course` WHERE `course`.`id` = `course_id`";
        return $this->db->query($query)->result();
    }
    
    public function getAllRequestsWithJoinGranted() {
       $query = "SELECT `temp`.*,`course`.`name` AS `course_name` "
                . "FROM (SELECT `user_request`.`id`, `user_request`.`timestamp`, "
                . "`request_type_id`, `course_id`, `request_message`, `user_id`, "
                . "`moderator_id`, `viewed`, `granted`,`email` AS `user_email` "
                . "FROM  `user_request`,`student` WHERE `student`.`id` = `user_id`"
                . " AND `granted`=1) AS `temp`, `course` WHERE `course`.`id` = `course_id`";
        return $this->db->query($query)->result();
    }
    
    public function getPendingCount() {
        $query = "SELECT COUNT(`id`) AS `count` FROM `user_request` WHERE `granted` = 0 AND `moderator_id`=".$this->session->userdata("id");
        $result = $this->db->query($query)->row();
        if($result !== null)
            return $result->count;
    }
}
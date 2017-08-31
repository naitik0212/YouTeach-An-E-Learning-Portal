<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model
{
    public function viewAllSentMessages()
    {
        $query = "SELECT `temp`.*,`email` as `receiver_email` FROM "
                . "(SELECT `sender_id`, `receiver_id`, `subject`, `body`, "
                . "`message`.`timestamp`, `viewed`, `message`.`id`,`email` "
                . "AS `sender_email` FROM `message`,`student` WHERE "
                . "`sender_id` = `student`.`id` AND `sender_id` = ".$this->session->userdata("id")." AND `message`.`sender_deleted` = 0) "
                . "AS `temp`,`student` WHERE `receiver_id`=`student`.`id` ORDER BY `id` DESC";
        return $this->db->query($query)->result();
    }
    
    public function viewAllReceivedMessages()
    {
        $query = "SELECT `temp`.*,`email` as `sender_email` FROM "
                . "(SELECT `sender_id`, `receiver_id`, `subject`, `body`, "
                . "`message`.`timestamp`, `viewed`, `message`.`id`,`email` "
                . "AS `receiver_email` FROM `message`,`student` WHERE "
                . "`receiver_id` = `student`.`id` AND `receiver_id` = ".$this->session->userdata("id")." AND `message`.`receiver_deleted` = 0 ) "
                . "AS `temp`,`student` WHERE `sender_id`=`student`.`id`  ORDER BY `id` DESC";
        return $this->db->query($query)->result();
    }
    
    public function createMessage($message_details)
    {
        return $this->db->insert("message",$message_details);
    }
    
    public function readMessage($messageid) {
        $this->db->where("id",$messageid);
        return $this->db->update("message",array("viewed"=>1));
    }
    
    public function deleteMessage($messageid) {
        $query = "SELECT * FROM `message` WHERE $messageid = `id`";
        $result = $this->db->query($query)->row();        
        $this->db->trans_start();
        $this->db->where("id",$messageid);
        if($result->sender_id === $this->session->userdata("id")){
            if($result->receiver_deleted==0)
                $this->db->update("message",array("sender_deleted"=>1));
            else $this->db->delete("message");        
            $this->db->trans_complete();
            return -1;
        }else if($result->receiver_id === $this->session->userdata("id")){
            if($result->sender_deleted==0)
                $this->db->update("message",array("receiver_deleted"=>1));
            else $this->db->delete("message");
            $this->db->trans_complete();
            return 1;
        }
    }
}

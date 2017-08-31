<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Moderator extends CI_Model
{
    public function getModId()
    {
        $result = $this->db->query("SELECT `user_id` FROM `moderator` ORDER BY RAND() LIMIT 1")->row_array();
        return $result['user_id'];
    }
}
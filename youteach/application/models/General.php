<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class General extends CI_Model
{
    public function getAllCountries() {
        return $this->db->query("SELECT * FROM `country`")->result();
    }
    
    public function isCountry($country) {
        $this->db->where("country_name",$country);
        $result = $this->db->get("country");
        if($result->num_rows() > 0)
            return true;
        return false;
    }
}
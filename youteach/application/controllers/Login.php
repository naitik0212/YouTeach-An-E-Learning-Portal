<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        //force_ssl();
    }
    
    public function index()
    {
        $username = $this->input->post('email');
        $password = hash('sha512', $this->input->post('password'));
        $validate = $this->Student->validate($username,$password);
        if(isset($validate))
            $this->session->set_flashdata('login_error',$validate);
        redirect (site_url(),'refresh');
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect (site_url(),'refresh');
    }
    
    public function modLogout() {
        $this->session->sess_destroy();
        redirect (site_url('backend'),'refresh');
    }
    
}


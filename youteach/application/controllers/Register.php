<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $this->load->model("General");
        if($this->session->userdata('logged_in'))
            redirect (base_url());
        //force_ssl();
        
        $data["domains"] = $this->Course->getAllDomains();
        $data["countries"] = $this->General->getAllCountries();
        $this->load->view('register',$data);
        
    }
    
    public function registerUser()
    {
        $domain = null;
        $count = count($domain = $this->input->post('domain'));
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[255]|alpha|xss_clean');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[255]|alpha|xss_clean');
        $this->form_validation->set_rules('gender','Gender','trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('dob','','trim|max_length[255]|xss_clean|callback_date_check');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[student.email]|xss_clean');
        $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[255]|trim|xss_clean');
        $this->form_validation->set_rules('phone','Mobile No.','trim|less_than[10000000000]|greater_than[1000000000]|xss_clean');
        $this->form_validation->set_rules('country','Country','trim|required|xss_clean|callback_country_check');
        $this->form_validation->set_rules('inst','Institute','trim|max_length[255]|xss_clean');
        $this->form_validation->set_rules('skill','Skills','trim|max_length[5000]|xss_clean');
        for($i = 0; $i < $count ; $i++)
            $this->form_validation->set_rules('domain['.$i.']',$domain[$i],'trim|max_length[5000]|xss_clean|callback_domain_check');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','required');
        
        if(!$this->form_validation->run())
        {
            $data["domains"] = $this->Course->getAllDomains();
            $data["countries"] = $this->General->getAllCountries();
            $data['error'] ='Validation error';
            $this->load->view('register',$data);
            return;
        }
        
        $this->upload->initialize($this->pictureUploadOptions($this->input->post("email")));
        if(!$this->upload->do_upload("picture"))
        {
            $data["domains"] = $this->Course->getAllDomains();
            $data["countries"] = $this->General->getAllCountries();
            $data['error'] ='Image upload failed';
            $this->load->view('register',$data);
            return;
        }
        $userdata['picture_url']=  $this->upload->data()["file_name"];
        $userdata['firstname']= $this->input->post("firstname");
        $userdata['lastname'] = $this->input->post("lastname");
        $userdata['email'] = $this->input->post('email');
        $userdata['password'] = hash('sha512', $this->input->post('password'));
        $userdata['phone'] = $this->input->post('phone');
        $userdata['gender'] = $this->input->post('gender');
        $userdata['institute'] = $this->input->post('inst');
        $userdata['skill'] = $this->input->post('skill');
        $userdata['dob'] = $this->input->post('dob');
        $userdata['country'] = $this->input->post('country');
        //$domain = $this->input->post('domain');
        
        if($this->Student->addStudent($userdata,$domain))
        {
            $this->session->set_flashdata('success', 'You have successfully registered. Please login with the registered details');
            redirect(site_url(),'refresh');
        }
    }
    
    private function pictureUploadOptions($useremail)
    {   
        $config = array();
        $config['upload_path'] = './assets/images/profile_pics';
        $config['max_size']      = '2048';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']     = FALSE;
        $config['file_name'] = md5($useremail);
        return $config;
    }
    
    public function date_check($str)
    {
        $temp = explode("-", $str);
        if(checkdate( $temp[1], $temp[2] ,$temp[0]))
        {
                return true;
        }else{
            $this->form_validation->set_message("date_check","Date is invalid");
            return false;
        }
    }
    
    public function country_check($str)
    {
        if($this->General->isCountry($str))
            return true;
        else {
            $this->form_validation->set_message("country_check","Invalid Country");
        }
    }
    
    public function domain_check($domain){
        $temp_val = $this->db->query("SELECT EXISTS(SELECT 1 FROM `domain` WHERE `name` LIKE '$domain') AS `exists`")->row();
        if(!$temp_val->exists)
        {
            $this->form_validation->set_message("domain_check","%s is not list of domains list");
            return false;
        }
        return true;
    }
}


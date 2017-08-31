<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Backend extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    private function userLoginCheck($access)
    {
        if(!in_array($this->session->userdata('access_level'), $access))
            redirect (site_url('Backend/login'));
    }
    
    public function index() 
    {
        $this->userLoginCheck(array(3,4));
        $data['page']='blank';
        $data['header']="dashboard";
        $data['request_count'] = $this->Request->getPendingCount();
        $this->load->view('backend/dashboard',$data);
    }
    
    public function login()
    {
        $data=null;
        if($this->session->userdata('logged_in') && in_array($this->session->userdata('access_level'),array(3,4,5)))
            redirect (site_url('backend'));
        if($this->session->flashdata('error'))
            $data['error'] = $this->session->flashdata('error');
        $this->load->view('backend/login',$data);
    }
    
    public function validate()
    {
        $username = $this->input->post('email');
        $password = hash('sha512',$this->input->post('password'));
        $validate = $this->Student->validate($username,$password);
        if(!isset($validate))
            $this->session->set_flashdata('error',$validate);
        redirect (site_url('backend'),'refresh');
    }
    
    public function viewUsers(){
        $this->userLoginCheck(array(3,4,5));
        $data['page'] = 'allUsers';
        $data['header'] = 'List of Users';
        $data['users'] = $this->Student->getAllStudents();
        $data['request_count'] = $this->Request->getPendingCount();
        $this->load->view('backend/main_view',$data);
    }
    
    public function viewCourses(){
        $this->userLoginCheck(array(3,4,5));
        $data['page'] = 'allCourses';
        $data['header'] = 'List of Courses';
        $data['courses'] = $this->Course->getAllCoursesWithJoin();
        $this->load->view('backend/main_view',$data);
    }
   
    public function viewcourse($id){
        if(!is_numeric($id))
        {
            $data["heading"] = "Page not found";
            $data["message"] = "The page you are looking for is removed or is not available";
            $this->load->view("errors/html/error_404",$data);
            return;
        }
        $data['page'] = "course_view";
        $data['header'] = "Home";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['course'] = $this->Course->getCourseById($id);
        if(!$data['course'] || !$data['course']->approved  )
            redirect (site_url());
        $data['course_files'] = $this->Course->getCourseVideos($id);
        if($this->session->userdata('logged_in'))
        {
            $result = $this->Course->getCurrentUserRating($id);
            if($result != null)
                $data['rating'] =  $result->rating;
            else $data["rating"] = -1;
        }
        else {$data['rating'] = -1;}
        $this->session->set_userdata("doc_dir",md5($data['course']->teacher_email)."/docs"."/".$id);
        $data['comments'] = $this->Course->getCourseComments($id);
        $this->load->view('backend/main_view',$data);
    }
    
    public function docLoad($id){
        //$this->session->keep_flashdata("doc_dir");
        $this->load->model('ftp_server/Doc');
        $access = null;
        if($this->session->userdata('logged_in') && $this->Course->isUserCourse($id))
        {
             $access= array(
                        'read'   => true,
                        'write'  => true,
                        'locked' => false,
                        'hidden' => false
                    );
        }
        else {
            $access= array(
                        'read'   => true,
                        'write'  => false,
                        'locked' => true,
                        'hidden' => false
                    );
        }
        $opts = array(
	// 'debug' => true,
                    'bind' => array(    
                    '' => 'mySimpleCallback'
                            ),
                    'roots' => array(
                            array(
                                    'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
                                    'path'          => './courses/'.$this->session->userdata("doc_dir"),                 // path to files (REQUIRED)
                                    //'URL'           => dirname($_SERVER['PHP_SELF']) . '/../files/', // URL to files (REQUIRED)
                                    //'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
                                    'uploadAllow'   => array('all'),// Mimetype `image` and `text/plain` allowed to upload
                                    'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
                                    'accessControl' => 'access',                   // disable and hide dot starting files (OPTIONAL)
                                    'uploadMaxSize' => '1G',
                                    'defaults'     => $access
                            )
                        )
                    );
        $this->Doc->setOpts($opts);
    }

    
    public function viewRequestsPending(){
        $this->userLoginCheck(array(3,4,5));
        $data['page'] = 'allRequestPending';
        $data['header'] = 'List of Requests';
        $data['request_count'] = $this->Request->getPendingCount();
        $data['requests'] = $this->Request->getAllRequestsWithJoinPending();
        $this->load->view('backend/main_view',$data);
    }
    
    public function viewRequestsGranted(){
        $this->userLoginCheck(array(3,4,5));
        $data['page'] = 'allRequestGranted';
        $data['header'] = 'List of Requests';
        $data['request_count'] = $this->Request->getPendingCount();
        $data['requests'] = $this->Request->getAllRequestsWithJoinGranted();
        $this->load->view('backend/main_view',$data);
    }
    
    public function approveCourse($courseid) {
        $this->Course->approveCourse($courseid);
        $this->viewcourse($courseid);
    }
}


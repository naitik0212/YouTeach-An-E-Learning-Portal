<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Frontend extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        //force_ssl();
    }
    /*
     * Checks verifies user access_level
     */
    private function userAccess($access_level)
    {
        if(!in_array($this->session->userdata('access_level'), $access_level))
        {
            redirect(site_url());
        }
        return true;
    }

    public function index() {
        $data['page'] = "home";
        $data['header'] = "Home";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $this->load->view('frontend_view',$data);
    }
    
    public function courseUpload(){
        $this->userAccess(array(1,2));
        //Add the function to request a moderator for a course upload
        
        if($this->Teacher->unapprovedCourses($this->session->userdata('id')) >= 3)
        {
            $this->session->set_flashdata('error','You already have 3 unapproved courses. Please wait until on of them is approved');
            redirect(site_url('frontend/userCourses'));
        }
        $data['page'] = "courseUpload";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $this->load->view('courseUpload_view',$data);
    }
    
    public function uploadWizard(){
        $this->userAccess(array(1,2));
        //Add the function to request a moderator for a course upload
        
        if($this->Teacher->unapprovedCourses($this->session->userdata('id')) >= 3)
        {
            $this->session->set_flashdata('error','You already have 3 unapproved courses. Please wait until on of them is approved');
            redirect(site_url('frontend/userCourses'));
        }
        $data['page'] = "uploadWizard";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $this->load->view('courseUpload_view',$data);
    }
    
    public function domainNameCheck($domain) {
        if($this->input->post('domain') === 'Other' && $domain===NULL) {
            $this->form_validation->set_message('domainNameCheck','Please specify the Domain name');
            return FALSE;
        }
        return TRUE;
    }
    
    private function coverUploadOptions($coursename){   
        $config = array();
        $config['upload_path'] = './courses/'.md5($this->session->userdata('email')).'/images/';
        $config['max_size']      = '2048';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite']     = FALSE;
        $config['file_name'] = md5($coursename);
        return $config;
    }
        
    public function courseUploadHelper() {
        $this->userAccess(array(1,2));
        $this->form_validation->set_rules('name','Name','trim|required|min_length[5]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|min_length[250]|max_length[16000000]|required|xss_clean');
        $this->form_validation->set_rules('domain','Domain','trim|min_length[1]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('domain2','Domain','trim|min_length[1]|max_length[255]|xss_clean|callback_domainNameCheck|is_unique[`domain`.`name`]');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','required');

        if(!$this->form_validation->run()) {
            $data['error']='Errors';
            $data['page'] = "courseUpload";
            $data['header'] = "Course Upload";
            $data['top_courses'] = $this->Course->getTopCourses(10);
            $data['domain'] = $this->Course->getAllDomains();
            $this->load->view('courseUpload_view',$data);
            return;
        }
        if($this->input->post('domain')=== 'Other')
            $courseInfo['domain_name'] = $this->input->post('domain2');
        else $courseInfo['domain_name'] = $this->input->post('domain');
        
        $this->Course->addDomain($courseInfo['domain_name']);
        
        $courseInfo['name'] = $this->input->post('name');
        $courseInfo['description'] = $this->input->post('description');     
        $courseInfo['teacher_user_id'] = $this->session->userdata('id');
        
        $hash = md5($this->session->userdata('email'));
        if(!file_exists('./courses/'.$hash))
        {
            mkdir ('./courses/'.$hash,0777);
            mkdir ('./courses/'.$hash.'/videos',0777);
            mkdir ('./courses/'.$hash.'/images',0777);
            mkdir ('./courses/'.$hash.'/docs',0777);
        }
        $this->upload->initialize($this->coverUploadOptions($this->input->post('name')));
        if(!$this->upload->do_upload('frontcover')) {
            $data['error'] = $this->upload->display_errors();
            $data['cover_error'] = $this->upload->display_errors();
            $data['page'] = "courseUpload";
            $data['header'] = "Course Upload";
            $data['top_courses'] = $this->Course->getTopCourses(10);
            $data['domain'] = $this->Course->getAllDomains();
            $this->load->view('courseUpload_view',$data);
            return;
        }
        else
        {
            $courseInfo['image_loc'] = $hash.'/images/'.$this->upload->data()['file_name'];
        }
        
        $this->Teacher->addTeacher($this->session->userdata('id'));
        
        if($id=$this->Course->addCourse($courseInfo))
        {
            $this->Student->promoteToTeacher();
            $this->session->set_userdata('access_level',2);
            $this->session->set_flashdata('success','Course details successfully updated');
            redirect(site_url('frontend/courseSelectType/'.$id),'refresh');
        }
        else
        {
            unlink($this->upload->data()['full_name']);
            $this->session->set_flashdata('error','Error whileuploading course, try again later');
            redirect(site_url('frontend/courseUpload'),'refresh');
        }
    }
    
    
    public function courseEdit($courseid){
        $this->userAccess(array(2));
        $courseid = $this->db->escape_str($courseid);
        if(!$this->Course->isUserCourse($courseid))
            redirect (site_url());
        $courseinfo = $this->Course->getCourseData($courseid);
        if($courseinfo->status == 1 || $courseinfo->approved == 1 || $courseinfo->finalized)
        {
            $this->session->set_flashdata('error','Course is Online. Request moderator for editing the course');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
        $data['courseinfo'] = $courseinfo;
        $data['page'] = "courseEdit";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $this->load->view('courseUpload_view',$data);
    }
    
    public function courseEditHelper($courseid) {
        $this->userAccess(array(2));        
        $courseid = $this->db->escape_str($courseid);
        if(!$this->Course->isUserCourse($courseid))
            redirect (site_url());
        $status = $this->Course->getCourseStatus($courseid);
        if($status->status == 1 || $status->approved == 1)
        {
            $this->session->set_flashdata('error','Course is Online. Request moderator for editing the course');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
        $current_courseinfo = $this->Course->getCourseData($courseid);
        $this->form_validation->set_rules('name','Name','trim|required|min_length[5]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|min_length[250]|max_length[16000000]|required|xss_clean');
        $this->form_validation->set_rules('domain','Domain','trim|min_length[1]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('domain2','Domain','trim|min_length[1]|max_length[255]|xss_clean|callback_domainNameCheck|is_unique[`domain`.`name`]');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','required');

        if(!$this->form_validation->run()) {
            $data['error']='Errors';
            $data['page'] = "courseEdit";
            $data['header'] = "Course Upload";
            $data['top_courses'] = $this->Course->getTopCourses(10);
            $data['courseinfo']= $current_courseinfo;
            $data['domain'] = $this->Course->getAllDomains();
            $this->load->view('courseUpload_view',$data);
            return;
        }
        if($this->input->post('domain')=== 'Other')
            $courseInfo['domain_name'] = $this->input->post('domain2');
        else $courseInfo['domain_name'] = $this->input->post('domain');
        
        $this->Course->addDomain($courseInfo['domain_name']);
        
        $courseInfo['name'] = $this->input->post('name');
        $courseInfo['description'] = $this->input->post('description');     
        
        $hash = md5($this->session->userdata('email'));
        if(!file_exists('./courses/'.$hash))
        {
            mkdir ('./courses/'.$hash,0777);
            mkdir ('./courses/'.$hash.'/videos',0777);
            mkdir ('./courses/'.$hash.'/images',0777);
            mkdir ('./courses/'.$hash.'/docs',0777);
        }
        if(file_exists($_FILES['frontcover']['tmp_name']) && is_uploaded_file($_FILES['frontcover']['tmp_name'])) {
            unlink("./courses/".$courseInfo->image_loc);
            $this->upload->initialize($this->coverUploadOptions($this->input->post('name')));
            if(!$this->upload->do_upload('frontcover')) {
                $data['error'] = $this->upload->display_errors();
                $data['cover_error'] = $this->upload->display_errors();
                $data['page'] = "courseEdit";
                $data['header'] = "Course Upload";
                $data['top_courses'] = $this->Course->getTopCourses(10);
                $data['domain'] = $this->Course->getAllDomains();
                $this->load->view('courseUpload_view',$data);
                return;
            }
            else
            {
                $courseInfo['image_loc'] = $hash.'/images/'.$this->upload->data()['file_name'];
            }
        }
        $this->Teacher->addTeacher($this->session->userdata('id'));

        if($this->Course->updateCourse($courseInfo,$courseid))
        {
            $this->Student->promoteToTeacher();
            $this->session->set_userdata('access_level',2);
            $this->session->set_flashdata('success','Course details successfully updated');
            redirect(site_url('frontend/courseUploadFiles/'.$courseid),'refresh');
        }
        else
        {
            unlink($this->upload->data()['full_name']);
            $this->session->set_flashdata('error','Error whileuploading course, try again later');
            redirect(site_url('frontend/courseUpload'),'refresh');
        }
    }
    public function courseSelectType($courseid){
        $this->userAccess(array(2));
        if(!$this->Course->isUserCourse($courseid)){
            redirect(site_url());
        }
        
        $data['page'] = "courseSelectType";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['courseid'] = $courseid;
        //$data['domain'] = $this->Course->getAllDomains();
        $data['courseid'] = $courseid;
        $this->load->view('courseSelectType_view',$data);
        
        //$
    }
    
    public function courseYoutubeFiles($courseid){
        $this->userAccess(array(2));
        if(!$this->Course->isUserCourse($courseid)){
            redirect(site_url());
        }
        $data['page'] = "courseYoutubeFiles";
        $data['header'] = "Add Youtube files";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $data['courseid'] = $courseid;
        $this->load->view('frontend_view',$data);
        
    }
    
    
    public function courseUploadFiles($courseid){
        $this->userAccess(array(2));
        
        if($this->Course->isUserCourse($courseid))
        {
            $status = $this->Course->getCourseStatus($courseid);
            if($status->status == 1 || $status->approved == 1 || $status->finalized == 1)
            {
                $this->session->set_flashdata('error','Course is Finalized or Online. Request moderator for editing this course');
                redirect(site_url('frontend/userCourses/'),'refresh');
            }
            $pathvid = 'courses/'.  md5($this->session->userdata('email')).'/videos/'.$courseid;
            $pathdoc = 'courses/'.  md5($this->session->userdata('email')).'/docs/'.$courseid;
            if(!file_exists($pathvid))
            {
                mkdir($pathvid, 0777);
            }
            if(!file_exists($pathdoc))
            {
                mkdir($pathdoc, 0777);
            }
            $this->session->set_flashdata('upload_dir',$pathvid);
        }
        else 
        {
            redirect (site_url());
        }
        $data['page'] = "courseUploadFiles";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $data['courseid'] = $courseid;
        $this->load->view('courseUploadFiles_view',$data);
    }
    
    public function courseUploadFilesHelper() {
        $this->userAccess(array(2));
        $this->session->keep_flashdata('upload_dir');
        $this->load->library('Uploadhandler');
    }
    
    public function courseFinalize($courseid) {
        $this->userAccess(array(2));
        if (!$this->Course->isUserCourse($courseid)) {
            redirect(site_url());
        }
        $status = $this->Course->getCourseStatus($courseid);
        if($status->status == 1 || $status->approved == 1||$status->finalized == 1)
        {
            $this->session->set_flashdata('error','Course is Online or finalized. Request moderator for editing this course');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
        $data['page'] = "courseFinalize";
        $data['header'] = "Course Upload";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        //$data['courseid'] = $courseid;
        $data['course'] = $this->Course->getCourseByID2($courseid);
        $data['files'] = directory_map('courses/'.md5($this->session->userdata('email')).'/videos/'.$courseid.'/');
        $this->load->view('courseFinalize_view',$data);
    }
    
    public function courseFinalizeHelper($courseid) {
        $this->userAccess(array(2));
        if (!$this->Course->isUserCourse($courseid)) {
            redirect(site_url());
        }
        $files = directory_map('courses/'.md5($this->session->userdata('email')).'/videos/'.$courseid.'/');
        foreach ($files as $file)
        {
            $this->form_validation->set_rules(md5($file)."-index","$file Index",'trim|xss_clean|required|greater_than[0]|less_than['.(count($files)+1).']');
            $this->form_validation->set_rules(md5($file)."-des","$file Description",'trim|xss_clean|max_length[150]');
            //echo (md5($file)."-index ");
            echo var_dump($_POST);
        }
        
        $ytlinks = $this->input->post("count");
        echo ("testing".$ytlinks);
        for($i=1;$i<=$ytlinks;$i++)
        {
            $this->form_validation->set_rules("youtube-index-".$i,"Youtube Index","trim|xss_clean|required|greater_than[0]|less_than[51]");
            $this->form_validation->set_rules("youtube-id-".$i,"Youtube Index","trim|xss_clean|required|min_length[11]|max_length[11]");
            $this->form_validation->set_rules("youtube-name-".$i,"Video name","trim|xss_clean|required|min_length[3]|max_length[511]");
            $this->form_validation->set_rules("youtube-des-".$i,"Video Description","trim|xss_clean|min_length[11]|max_length[1100]");
        }
        echo "//www.youtube.com/embed/"+$this->input->post("youtube-name-1");
        if(!$this->form_validation->run())
        {
            $this->session->set_flashdata("error",  validation_errors());
            echo validation_errors();
            return;
            //redirect(site_url('Frontend'.'/courseFinalize/'.$courseid));            
        }
        $i = 0;
        foreach ($files as $file)
        {
            $courseVideoInfo[$i]['file_path'] = 'courses/'.md5($this->session->userdata('email')).'/videos/'.$courseid.'/'.$file;
            $courseVideoInfo[$i]['course_id'] = $courseid;
            $courseVideoInfo[$i]['video_description'] = $this->input->post(md5($file)."-des");
            $courseVideoInfo[$i]['course_video_index'] = $this->input->post(md5($file)."-index");
            $courseVideoInfo[$i]['file_name'] = $file;
            $i++;
        }
        
        for($j=1;$j<=$ytlinks;$j++)
        {
            $courseVideoInfo[$i]['file_path'] = "//www.youtube.com/embed/".$this->input->post("youtube-id-".$j);
            $courseVideoInfo[$i]['course_id'] = $courseid;
            $courseVideoInfo[$i]['video_description'] = $this->input->post("youtube-des-".$j);
            $courseVideoInfo[$i]['course_video_index'] = $this->input->post("youtube-index-".$j);
            $courseVideoInfo[$i]['file_name'] = $this->input->post("youtube-name-".$j);
            $courseVideoInfo[$i]['type'] = "youtube";
            $i++;
            echo "added";
        }
        if($this->Course->addVideoFile($courseVideoInfo))
        {
            $this->session->set_flashdata('courseUploadSuccess','Course successfully added');
            $mod = $this->Moderator->getModId();
            $this->Course->updateCourseModerator($courseid,$mod);
            $this->Course->finalizeCourse($courseid,$mod);
            redirect(site_url('Frontend/successCourseUpload/'.$courseid));
        }
        else {
            $this->session->set_flashdata('error','There were errors while uploading indices, please try again later');
            redirect(site_url('Frontend'.'/courseFinalize/'.$courseid,'refresh'));            
        }
    }
    
    public function successCourseUpload($course)
    {
        $data['page'] = "uploadSuccess";
        $data['header'] = "UploadSuccess";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $this->load->view('frontend_view',$data);
    }

    public function userCourses(){
        $this->userAccess(array(2));
        $data['page'] = "userCourses";
        $data['header'] = "Your Courses";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data['domain'] = $this->Course->getAllDomains();
        $data['result'] = $this->Teacher->getTeacherCourses($this->session->userdata('id'));
        $this->load->view('userCourses_view',$data);
    }
            
    
    public function removeCourse($courseid)
    {
        $this->userAccess(array(2));        
        $courseid = $this->db->escape_str($courseid);
        if(!$this->Course->isUserCourse($courseid))
            redirect (site_url());
        $status = $this->Course->getCourseStatus($courseid);
        if($status->status == 1 || $status->approved == 1 || $status->finalized == 1)
        {
            $this->session->set_flashdata('error','Course is Online or Finalized. Request moderator for deleting the course');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
        if($this->Course->deleteCourse($courseid))
        {
            $this->session->set_flashdata('success','Course deleted successfully');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
        else
        {
            $this->session->set_flashdata('error','Course could not be deleted');
            redirect(site_url('frontend/userCourses/'),'refresh');
        }
    }

    public function viewcourse($id=null){
        if($id == null)
            redirect (site_url());
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
        $this->load->view('frontend_view',$data);
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

    public function addComment($id){
        if($this->Course->courseAvailable($id) == 0)
            redirect (site_url ());
        if(!$this->session->userdata("logged_in"))
        {
            $this->session->set_flashdata("comment_error","Please Login to comment");
            redirect(site_url("frontend/viewcourse/".$id));
        }
        $data["comment_body"] = $this->input->post("comment");
        $data["user_id"] = $this->session->userdata("id");
        $data["course_id"] = $id;
        $this->Course->addCourseComment($data);
        redirect(site_url("frontend/viewcourse/".$id."#comments"));
    }
    
    
   /*
    * Code For Messages .....
    */
    
   public function getComment(){
       $test = array(
           "test" => "It works"
       );
       
       echo json_encode($test);
   }
   
   public function rateCourse(){
       $courseid = $this->input->post("courseid");
       if($this->Course->courseAvailable($courseid) == 0)
            redirect (site_url ());
       $rating = $this->input->post("rating");
       if(!$this->session->userdata("logged_in"))
       {
           $error = array("error" => "Please login to rate course");
           echo json_encode($error);
           return;
       }
       if(!is_numeric($rating) || $rating > 10 || $rating < 0 )
       {
           $error = array("error" => "Invalid rating");
           echo json_encode($error);
           return;
       }
       $result = $this->Course->createCourseRating($courseid,$rating);
        $success = array("success" => "Successfully rated ".$courseid);
        echo json_encode($success);   
    }

    public function getVid(){
        $data["type"] = $this->input->post("type");
        if( strcasecmp($data["type"], "file") == 0)
            $data["source"] = "/codeigniter/".$this->input->post("address");
        else if( strcasecmp($data["type"], "youtube") == 0)
            $data["source"] = $this->input->post("address");
        $data["index"]=  $this->input->post("index");
        $data["name"]= $this->input->post("name");
        $data["description"]=  $this->input->post("description");
        //$data["source"]= base_url().urldecode($this->input->get("path"));
        //$data["type"] = "video/mp4";
        $this->load->view("video_frame",$data);
    }
    
    public function receivedMessages(){
        $this->userAccess(array(1,2,3,4));
        $data["page"] = "receivedMessage";
        $data["header"] = "Messages Received";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data["messages"] = $this->Message->viewAllReceivedMessages();
        $this->load->view("frontend_view",$data);
    }
    
    public function sentMessages(){
        $this->userAccess(array(1,2,3,4));
        $data["page"] = "sentMessage";
        $data["header"] = "Messages Sent";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data["messages"] = $this->Message->viewAllSentMessages();
        $this->load->view("frontend_view",$data);
    }
    
    public function deleteMessage($messageid){
        $this->userAccess(array(1,2,3,4));
        if(!is_numeric($messageid)){
            redirect(site_url());
        }
        $response=NULL;
        if($response=$this->Message->deleteMessage($messageid)){
            $this->session->set_flashdata('success','Message deleted successfully');
        }
        else $this->session->set_flashdata('success','Message deleted successfully');
        if($response > 0)
            redirect(site_url('frontend/receivedMessages'),'refresh');
        else if($response < 0){
            redirect(site_url('frontend/sentMessages'),'refresh');
        }
    }
    
    public function getReceivedMessages() {
        $this->userAccess(array(1,2,3,4));
        $messages = $this->Message->viewAllReceivedMessages();
        $i = 0;
        $message_json = '{'
                . '"data" : [';
        foreach ($messages as $message )
        {
            $i++;
            $message_json = $message_json.'['
                    . '"'.$i.'",'
                    . '"'.$message->sender_email.'",'
                    . '"'.$message->subject.'",'
                    . '"'.$message->body.'",'
                    . '"'.$message->timestamp.'",'
                    . '"Some action " ]'
                    . ']';
        }
        $message_json = $message_json."}";
        echo $message;
    }

    public function error() {
        $this->load->view('invalid');
    }
    
    public function createMessage($recipient = NULL){ 
        $this->userAccess(array(1,2));
        $data["page"] = "createMessage";
        $data["header"] = "Messages Received";
        $data['top_courses'] = $this->Course->getTopCourses(10);
        $data["recipient"] = urldecode($recipient);
        $this->load->view("frontend_view",$data);
    }
    
    public function createMessageHelper(){
        $this->userAccess(array(1,2));
        $this->form_validation->set_rules('receiver','Receiver','trim|required|min_length[5]|max_length[255]|callback__email_check|xss_clean');
        $this->form_validation->set_rules('subject','Subject','trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('message','Message','trim|min_length[20]|xss_clean|required');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','required');
        
        if(!$this->form_validation->run()) {
            $data['page'] = "createMessage";
            $data['header'] = "Messages";
            $data['top_courses'] = $this->Course->getTopCourses(10);
            $this->load->view('frontend_view',$data);
            return;
        }
        
        $messageInfo['receiver_id'] = $this->Student->getEmailById($this->input->post('receiver'));
        $messageInfo['subject'] = "".$this->input->post('description'); 
        $messageInfo['sender_id'] = $this->session->userdata('id');
        $messageInfo['body'] = $this->input->post('message');
        
        if($id=$this->Message->createMessage($messageInfo))
        {
            $this->session->set_flashdata('success','Message Sent successfully');
            redirect(site_url('frontend/receivedMessages'),'refresh');
        }
        else
        {
            $this->session->set_flashdata('error','Message could not be sent');
            redirect(site_url('frontend/receivedMessages'),'refresh');
        }
    }
    
    public function _email_check($email){
        if(!strcmp($email,$this->session->userdata("email"))){
            $this->form_validation->set_message("_email_check","You cannot be a receiver to your own message");
            return false;
        }
        $temp_val = $this->db->query("SELECT EXISTS(SELECT 1 FROM `student` WHERE `email` LIKE '$email') AS `exists`")->row();
        if(!$temp_val->exists)
        {
            $this->form_validation->set_message("_email_check","User %s does not exists");
            return false;
        }
        return true;
    }
    
    public function readMessage(){
        
    }
    
    public function getRecommendations() {
        $lastRated = $this->Student->getLastRated();
        $rec = $this->Recommender->getRecommendations($lastRated);
          foreach($rec as $row)
            {        
                echo $row->item_id2." | ".$row->average."<br>";
            }
            
    }
}

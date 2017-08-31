    <div id="content">
        <div class="outer">
          <div class="inner bg-light lter">
                  <!-- Page Content -->

        <div id="">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header"><span class="h3"><?php echo $course->name ?></span></div>
            </div>
        </div>   
        <?php if($course->approved == 0) {?>
         <div class="row">
             <div class="col-lg-12">
                 <div class="alert alert-warning h4">This course is yet to be approved</div>
             </div>
         </div><?php } ?>  

        <link href="<?php echo base_url('assets') ?>/ratingmaster/themes/fontawesome-stars.css" rel="stylesheet" type="text/css"/>

        <?php if($this->session->flashdata("comment_error") !== null) {?>
            <div class="row">
                <div class="col-lg-12">
        <div class="alert alert-warning h4"><?php echo $this->session->flashdata("comment_error"); ?></div>
                </div>
            </div><?php } ?>
        <div class="row">
            <div class="col-md-12" id="video-frame" >
            </div>
        </div>
        <script>
            $(document).ready(function(){
                // when user browses to page
                $('#video-frame').html("<img src='<?php echo base_url("assets/images")."/spinner.gif"; ?>' class = 'container-fluid'>");
                     $(".list-group").children("a").first().click();
               
            });
        </script>
        <style>
            .img-small{
                width: 50px;
                height: 50px;
            }
        </style>
        <div class="row">
            <div class="col-lg-12">
                    <div class="panel panel-default course-info">
                        <div class="panel-heading">
                            <h3><?php echo $course->name; ?></h3>
                        </div>
                        <div class="panel-body inner-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="<?php echo base_url()."courses/".$course->image_loc; ?>" id="course-info-img" class="img-circle img-thumbnail"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Published by:
                                        </div>
                                        <div class="col-md-8">
                                    <?php echo $course->teacher_email; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            Approved by:
                                        </div>
                                        <div class="col-md-8">
                                            <?php echo $course->moderator_email; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Started on:
                                        </div>
                                        <div class="col-md-8">
                                            <?php echo $course->timestamp; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            Approved on:
                                        </div>
                                        <div class="col-md-8">
                                            <?php echo $course->approved_timestamp; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo "Views: ".$course->views;?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo "Ratings: " ?>
                                            <select id="ratings">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Course Description:</h4><br/>
                                    <p><?php echo $course->description; ?></p>
                                    
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#course_nav" data-toggle="tab">Course navigation</a>
                                </li>
                                <li class=""><a href="#comments" data-toggle="tab">Comments</a>
                                </li>
                                <li><a href="#questions" data-toggle="tab">Questions</a>
                                </li>
                                <li><a href="#docs" data-toggle="tab">Associated Docs</a>
                                </li>
                                <li><a href="#tests" data-toggle="tab">Test Papers</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="course_nav">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: thick solid #000000;">
                                            <div class="list-group" style="padding-top: 18px; max-height: 300px; overflow-y: scroll">
                                                <?php $i = 1; 
                                                foreach ($course_files as $file) {?>
                                                <a href="<?php echo $file->file_path ?>" class="list-group-item vid_list vid-link <?php if($i++ == 1) echo "active"; ?>">
                                                    <h4 class="list-group-item-heading"><span class='index'><?php echo $file->course_video_index."</span>: <span class='name'>".$file->file_name; ?></span></h4>
                                                  <p class="list-group-item-text"><?php echo $file->video_description; ?></p>
                                                  <p class="type hidden"><?php echo $file->type ?></p>
                                                </a>
                                                <?php } ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="comments">
                                    <h4>Comments</h4>
                                <div class="chat-panel panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-comments fa-fw"></i>

                                    <div class="btn-group pull-right">


                                    </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <ul class="chat" id="comments">
                                        <?php foreach ($comments as $comment) {
                                            if($comment->user_id !== $this->session->userdata("id"))
                                            {
                                            ?>

                                        <li class="left clearfix">
                                            <span class="chat-img pull-left">
                                                <img src="<?php echo base_url("assets/images/profile_pics")."/".$comment->user_image  ?>" alt="User Avatar" class="img-circle img-small">
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font"><?php echo $comment->user_email ?></strong>
                                                    <small class="pull-right text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i> <?php echo $comment->timestamp ?>
                                                    </small>
                                                </div>
                                                <p>
                                                    <?php echo htmlspecialchars($comment->comment_body) ?>
                                                </p>
                                            </div>
                                        </li>
                                            <?php } else 
                                            {?>

                                        <li class="right clearfix">
                                            <span class="chat-img pull-right">
                                                <img src="<?php echo base_url("assets/images/profile_pics")."/".$comment->user_image  ?>" alt="User Avatar" class="img-circle img-small">
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <small class=" text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i> <?php echo $comment->timestamp ?></small>
                                                    <strong class="pull-right primary-font"><?php echo $comment->user_email ?></strong>
                                                </div>
                                                <p>
                                                    <?php echo htmlspecialchars($comment->comment_body) ?>
                                                </p>
                                            </div>
                                        </li>
                                            <?php } ?>

                                        <?php }?>
                                    </ul> 
                                </div>
                                <!-- /.panel-body -->
                                <div class="panel-footer">
                                    <form role="form" id="addComment" method="post" action="<?php echo site_url("Frontend")."/addComment/".$course->id ?>">
                                        <div class="input-group">
                                            <input id="btn-input" name="comment" required="" type="text" class="form-control input-sm" placeholder="Type comment message here...">
                                            <span class="input-group-btn">
                                                <input class="btn btn-info btn-sm" id="btn-chat" type="submit"  value="Send">
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.panel-footer -->
                            </div>
                </div>
                                <div class="tab-pane fade" id="questions">
                                    <h4>Questions</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="docs">
                                    <?php $this->load->view("frontend/doc_view");?>
                                </div>
                                <div class="tab-pane fade" id="tests">
                                    <h4>Course Tests</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
        </div>
        <script src="<?php echo base_url('assets') ?>/readmore/js/readmore.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets') ?>/ratingmaster/jquery.barrating.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets') ?>/flowplayer/js/flowplayer.min.js" type="text/javascript"></script>
	<script type="text/javascript">
                
                $('.inner-content').readmore({
                    moreLink: '<div class="panel-footer show-more-link"><a href="#" class="">Show more</a></div>',
                    lessLink: '<div class="panel-footer show-less-link"><a href="#" class="">Show less</a><div>',
                    collapsedHeight: 125,
                    afterToggle: function(trigger, element, expanded) {
                        if(! expanded) { // The "Close" link was clicked
                            $('html, body').animate({scrollTop: element.offset().top}, {duration: 100});
                        }
                    }
                });
                
                 $(".vid_list").click( function (event) {
                    var addr = $(this).attr("href");
                    //$("#video-frame").empty();
                    event.preventDefault();
                    var index = $(this).children("h4").children(".index").html();
                    var name = $(this).children("h4").children(".name").html();
                    var description = $(this).children(".list-group-item-text").html();
                    var type = $(this).children(".type").html();
                    $.ajax({
                            url:"<?php echo site_url("frontend")."/getVid" ?>",
                            type:"POST",
                            data:{
                                address:addr,
                                index:index,
                                name:name,
                                description:description,
                                type:type
                            },
                            success:function(response) {
                                //console.log(response);
                                $("#video-frame").html(response);

                            }
                        });
                }
            );
	</script>
        <script type="text/javascript">

        $(function() {
           $('#ratings').barrating({
            initialRating:<?php echo $rating ?>,
            theme: 'fontawesome-stars',
            fastClick: true,
            onSelect:  function(value,text,event){
            if(event !== null)
            {
            var rating = value;
            $.ajax({
                "url":"<?php echo site_url("frontend")."/rateCourse"; ?>",
                "type":"POST",
                "data":{"rating":rating,"courseid":"<?php echo $course->id?>"},
                "success":function (response){
                    data = $.parseJSON(response);
                    if(data.error){
                        alert(data.error);
                        $('select').barrating("clear");
                    } else if(data.success){
                        
                    }
                },
                "error":function (jqXHR,textStatus,errorThrown){
                    alert("There seems to be some error, please try later");
                    console.log(jqXHR,textStatus,errorThrown);
                }
            });
            }
        }
        });
    });
        
        $(document).ready(function() {
        $(".vid_list").click(function () {
            $(".vid_list").removeClass("active");
            // $(".tab").addClass("active"); // instead of this do the below 
            $(this).addClass("active");   
        });
        });
        
        </script>
        
        </div>
    <!-- /#page-wrapper -->
    
          </div><!-- /.inner -->
        </div><!-- /.outer -->
      </div><!-- /#content -->
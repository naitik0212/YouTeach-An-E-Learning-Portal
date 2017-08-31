    <div id="content">
        <link href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <style>
            .course_img{
                max-height: 100px;
            }
            
        </style>
        <script>
            $(document).ready(function(){
                $('#course_table').dataTable({
                        "scrollX":true
                    } );
                $(".fancybox").fancybox();
            }
        );
        </script>
        
        
        <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <table class="table cell-border" id="course_table" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Domain</th>
                                <th>Uploaded by</th>
                                <th>Approved by</th>
                                <th>Cover page</th>
                                <th>Active status</th>
                                <th>Time Stamp</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($courses as $course) { ?>
                            <?php 
                            $i = 0
                            ?>
                            <tr>
                                <td title="Click to view course"><a href="<?php echo site_url("backend/viewcourse")."/".$course->id ?>" style="text-decoration: none"><?php echo $course->name?></a></td>
                                <td><a class="fancybox" title="Course Description" href="#<?php echo "description".(++$i)?>"><?php echo substr(htmlspecialchars($course->description),0,25)." ..."; ?></a>
                                    <div style="width:400px;display: none;" title="Description" id="<?php echo "description".$i?>" ><?php echo $course->description ?></div>
                                </td>
                                <td><?php echo $course->domain_name ?></td>
                                <td><?php echo $course->teacher_email ?></td>
                                <td><?php if($course->approved == 0)
                                            echo "Not approved";
                                        else echo $course->moderator_email
                                    ?>
                                </td>
                                <td><img src="<?php echo base_url('courses/'.$course->image_loc ); ?>" class="img-responsive img-rounded course_img"></td>
                                <td>
                                    <?php 
                                    if($course->status == 0)
                                    {
                                        echo '<div class="alert alert-danger text-center"><a href="#" class="alert-link">Blocked</a></div>';
                                    }
                                    else 
                                    {
                                        echo '<div class="alert alert-success text-center"><a href="#" class="alert-link">Online</a></div>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $course->timestamp; ?></td>
                                <td>Add actions</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div><!-- /.inner -->
        <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        </div><!-- /.outer -->
      </div><!-- /#content -->
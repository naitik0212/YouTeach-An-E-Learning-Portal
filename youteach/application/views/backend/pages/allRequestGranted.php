    <div id="content">
        <link href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
        <style>
            .user_img{
                max-height: 100px;
            }
            
            .unread{
                background: #d5d8ff;
            }
            
        </style>
        <script>
            $(document).ready(function(){
                $('#user_table').dataTable({
                    "scrollX" : true
                });
            }
        );
        
        function conf(val) {
            var message;
            if(val === 1)
                message = "Are you sure you want to approve this course?";
            else if(val === 2)
                message = "Are you sure you want to get this course remodified?";
            else
                message = "Are you sure you want to delete this course?";
            var response = false;
            response = confirm(message);
//            bootbox.confirm(message, function(result) {
//                    response = result;
//            });
            return response;
        }
        
        </script>
        
        
        <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <table class="table table table-striped table-hover" id="user_table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request By</th>
                                <th>Request for</th>
                                <th>Associated Course</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($requests as $request) { ?>

                            <tr class="">
                                <td><?php echo $request->user_email; ?></td>
                                <td><?php echo $request->request_message ?></td>
                                <td title="Click to view course"><a href="<?php echo site_url("backend/viewcourse")."/".$request->course_id ?>" style="text-decoration: none"><?php echo $request->course_name ?></a></td>
                                <td><?php echo ucfirst($request->timestamp); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div><!-- /.inner -->
        <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js" type="text/javascript"></script>
        </div><!-- /.outer -->
      </div><!-- /#content -->
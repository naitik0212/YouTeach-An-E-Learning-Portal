    <div id="content">
        <link href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
        <style>
            .user_img{
                max-height: 100px;
            }
            
            
        </style>
        <script>
            $(document).ready(function(){
                $('#user_table').DataTable();
            }
        );
        </script>
        
        
        <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                    <table class="table table table-striped table-hover" id="user_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Image</th>
                                <th>Active status</th>
                                <th>Access Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($users as $user) { ?>

                            <tr>
                                <td><?php echo $user->firstname." ".$user->lastname ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->phone ?></td>
                                <td><?php echo $user->country ?></td>
                                <td><img src="<?php echo base_url('assets/images/profile_pics').'/'.$user->picture_url; ?>" class="img-responsive img-rounded user_img"></td>
                                <td>
                                    <?php 
                                    if($user->status == 0)
                                    {
                                        echo '<div class="alert alert-danger text-center"><a href="#" class="alert-link">Blocked</a></div>';
                                    }
                                    else {
                                        echo '<div class="alert alert-success text-center"><a href="#" class="alert-link">Active</a></div>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo ucfirst($user->access_level); ?></td>
                                <td>Add actions</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div><!-- /.inner -->
         
        </div><!-- /.outer -->
      </div><!-- /#content -->
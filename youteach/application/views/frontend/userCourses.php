<div id="page-wrapper" >
    
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header"><span class="h3">Your Courses</span> <a href="<?php echo site_url('frontend/courseUpload') ?>" class="btn btn-primary pull-right ">Create New <span class="fa fa-plus-square"></span></a></div>
                <ol class="breadcrumb">
                    <li class="">Your Courses</li>
                </ol>
        </div>
    </div>
    <link href="<?php echo base_url(); ?>assets/DataTables/datatables.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url() ?>assets/js/bootbox.min.js" type="text/javascript"></script>

    <script>
    function del()
    {
        var val=confirm("Delete this item?");
        if(val)
            return true;
        return false;
    }
    $(document).ready(function() {
    $('#courseList').DataTable();
} );
</script>
<div class="panel panel-default">
    <div class="panel-heading">
        List Loaded 
    </div>
    <?php if($this->session->flashdata('error')!=NULL) { ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div> 
    <?php } 
    else if($this->session->flashdata('success')!=NULL){?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div> 
        <?php
    }
        ?>
    <div class="panel-body">
        <div class="table-responsive inside_content ps-container" style="margin-bottom: 50px">
    <style>
        th,td{
            text-align: center;
        }
      
    </style>
    <table id="courseList" class="table table-striped table-responsive">
        <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Domain</th>
              <th>Upload Time</th>
              <th>Online Status</th>
              <th>Approval Status</th>
              <th>Cover page</th>
              <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            foreach ($result as $row) 
            { ?>
            <tr>
                <td><?php if($row->finalized) { ?><a href="<?php echo site_url("frontend/viewcourse")."/".$row->id ?>" style="text-decoration: none" title="Click to view course"><?php echo $row->name?></a> <?php }
                else echo "<p>".$row->name."</p>"?>
                </td>

                <td title="<?php echo htmlspecialchars($row->description) ?>">
                    <?php echo htmlspecialchars(substr($row->description, 0, 15)." ...."); ?>
                </td>
                <td>
                    <?php echo $row->domain_name; ?>
                </td>
                <td>
                    <?php echo $row->timestamp; ?>
                </td>
                <td>
                    <a href="#"
                         class="<?php if($row->approved==0) 
                         {echo 'btn btn-info disabled';$value='Offline';} 
                         else if($row->status==0){echo 'btn btn-warning';$value='Archived'; } 
                         else {echo 'btn btn-success';$value='Online';}?>" ><?php echo $value; ?>
                    </a>                
                </td>
                <td>
                    <span
                         class="<?php if($row->approved==1) 
                         {echo 'fa fa-check';$value='Approved';} 
                         else {echo 'fa fa-close';$value='Not Approved'; } ?>" >
                    </span>                
                </td>
                <td>
                    <img alt="No Course cover" style="width: 100px" src="<?php echo base_url('courses/'.$row->image_loc) ?>" />
                </td>
                <td>
                    <a class="delete" href="<?php echo site_url("frontend/removeCourse").'/'.$row->id;?>" onclick="return del();"><span class="fa fa-fw fa-trash" ></span></a>&nbsp;&nbsp;
                    <a class="edit" href="<?php echo site_url("frontend/courseEdit").'/'.$row->id; ?>" onclick=""><span class="fa fa-fw fa-edit" ></span></a>
                </td>
            </tr>
                
            <?php
            }
            ?>
            
        </tbody>
    </table>
    
    </div>
    </div>
            <script src="<?php echo base_url(); ?>assets/DataTables/datatables.js" type="text/javascript"></script>
</div>   
    
    
</div>
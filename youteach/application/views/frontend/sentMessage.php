<div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sent Messages<a href="<?php echo site_url("frontend")."/createMessage" ?>" class="btn btn-primary btn-grad pull-right">New Meessage <i class="fa fa-envelope-o"> </i></a></h1>
                    <div id="create_message" class="" style="display: none;max-width: 600px">
                        <form action="" >
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter receiver email" name="receiver" >
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter message subject" name="subject" >
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Enter message" class="form-control" height="400px" style="" name="message"></textarea>
                            </div>
                        </form>
                    </div>
                    <?php if(isset($error))
                    {
                        ?><span class="error"><?php echo validation_errors() ?></span><?php
                    }
                        else{?>
                        <ol class="breadcrumb">
                            <li class="">Messages</li>
                            <li class="active">Sent Messages</li>
                        </ol>
                    <?php }?>
                </div>
                <!-- /.col-lg-12 -->
        </div>
    <link href="<?php echo base_url(); ?>assets/DataTables/datatables.css" rel="stylesheet" type="text/css"/>
     <script>
    function del()
    {
        var val=confirm("Delete this item?");
        if(val)
            return true;
        return false;
    }
    $(document).ready(function() {
    $('#messages').DataTable({
        responsive:true,
        scrollx:true
    });    
} );

</script>
    <div class="panel panel-default">
        <?php if($this->session->flashdata("success")) echo "<div class='alert alert-success'>".$this->session->flashdata("success")."</div>" ?>
        <div class="panel-heading">
            Messages Loaded
        </div>
        <div class="panel-body">
            <table id="messages" class="display text-center" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Recipient</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            $i=0;
            foreach ($messages as $message) 
            { ?>
                    <tr style="">
                <td>
                    <?php echo ++$i; ?>
                </td>
                <td>
                    <a href="<?php echo $message->receiver_email; ?>">
                       <?php echo $message->receiver_email; ?>
                    </a>                
                </td>
              
                <td>
                    <?php if($message->subject) echo $message->subject; else echo("------")?>
                </td>  
                <td>                    
                    <a href="#<?php echo "message".$i; ?>" class="btn btn-default message_link">View Message</a>
                    <div id="<?php echo "message".$i; ?>" style="display: none">
                        <?php echo $message->body; ?>
                    </div>
                </td>
                <td>
                    <?php echo $message->timestamp; ?>
                </td>
              
                <td>
                    <a href="<?php echo site_url("frontend/deleteMessage").'/'.$message->id;?>" title="delete message" class="delete" ><span class="fa fa-fw fa-trash" ></span></a>&nbsp;&nbsp;
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
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js" type="text/javascript"></script>

    <script>
        $(document).ready( function() {
            $(".message_link").fancybox();
        }
        );

        $(".delete").click( function(event) {
        event.preventDefault();
        var url = $(this).attr("href");
        bootbox.confirm("Are sure you want to delete this course?", function(result){
            if(result){
                top.location.href = url;
            }
        })});
    </script>
</div>
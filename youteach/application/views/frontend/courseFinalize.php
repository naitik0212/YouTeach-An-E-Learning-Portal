<div id="page-wrapper" >
    
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header"><span class="h3">Final Step</span></div>
                <ol class="breadcrumb">
                    <li class="">Finalize Course <?php echo $course->name ?></li>
                </ol>
        </div>
    </div>
 <!--      <link href="<?php echo base_url('assets') ?>/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>-->
 <link href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
<!--    <script src="<?php echo base_url('assets') ?>/fancybox/jquery.fancybox.js" type="text/javascript"></script>-->

    <script>
        var table;
    function del()
    {
        var val=confirm("Delete this item?");
        if(val)
            return true;
        return false;
    }
    $(document).ready(function() {
        table = $('#courseList').DataTable( {
                "rowReorder":true,
                "columnDefs": [
                    { orderable: false, targets: -1 },
                    { orderable: false, targets: -2 },
                    { orderable: false, targets: -3 }
                ]
            });
            table.on("row-reordered",function(){
                $("tbody tr").each(function(index){
                   $(this).children(".sorting_1").first().children("input").val(
                        $(this).children(".sorting_1").children("p").text()
                        );
                });
            });
        //$("#count").val(table.column(0).length);
    } );


    function verifyindex()
    {
        var x = document.forms["fileIndex"].getElementsByTagName("input");
        var index = [];
        var temp;
        for(var i = 1; i<x.length - 1 ; i++)
        {
            if(x[i].value == "")
            {
                alert("Please enter all indices");
                return false;
            }
            index.push(parseInt(x[i].value));
        }
        index = index.slice().sort();
        for(var i = 0; i<index.length-1 ; i++ )
        {
            if(index[i+1] == index[i])
            {
                alert("Invalid indices");
                return false;
            }
        }
        
        var val=confirm("Provided information cannot be changed later. Still proceed?");
        if(val)
            return true;
        else
            return false;
    }
    
</script>
        <ol class="list-group">
            <li class="list-group-item">
                Add Youtube URLs here.(if required)
            </li>
            <li class="list-group-item">
                Arrange the following in the desired order by drag-drop
            </li>
        </ol>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn btn-primary pull-right" id="addYoutube"><i class="fa fa-plus "></i> Add Youtube URL</a>
            </div>
        </div>
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
        
        
    <form method="post" action="<?php echo site_url('Frontend/courseFinalizeHelper').'/'.$course->id ?>" name="fileIndex">
        <div class="row">
            <div class="col-md-12"><div class="table-responsive inside_content ps-container" style="margin-bottom: 50px">
    <style>
        th,td{
            text-align: center;
            width: 20%;
        }
      
    </style>
            <table id="courseList" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Index</th>
                        <th>Video</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    foreach ($files as $row) 
                    { ?>
                    <tr>
                        <td>
                            <p class=""><?php echo $i ?></p>
                            <input class="form-control hidden" value="<?php echo $i++ ?>" type="number" min="1" max="50" name="<?php echo md5($row)."-index"; ?>" required="">
                        </td>

                        <td>
                            <div style="width: 300px">
                                <video src="<?php echo base_url().'courses/'.md5($this->session->userdata('email')).'/videos/'.$course->id.'/'.$row ;?>" width="300px" controls></video>
                            </div>
                        </td>
                        <td>
                            <span><?php echo $row; ?> </span>
                        </td>
                        <td>
        <!--                    <a href="#<?php echo md5($row)."ele" ?>" class="fancybox" >Video Desc</a>
                            <div style="display: none" id="<?php echo md5($row)."ele" ?>">-->
                                <textarea class="form-control" placeholder="Add Descripton" name="<?php echo md5($row)."-des" ?>" ></textarea>
        <!--                    </div>-->
                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 pull-right">
                <input type="submit" class="btn btn-primary" style="width: 80%" value="Submit" />
            </div>
            <div class="col-md-2">
                <a class="btn btn-default" href="<?php echo site_url("frontend")."/courseUploadFiles/".$course->id ?>">Previous</a>
            </div>
        </div>
        <input class="hidden" type="number" name="count" id="count" value="0">
    </form>
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function getId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);

            if (match && match[2].length === 11) {
                return match[2];
            } else {
                return 'error';
            }
        }
        
        $("#addYoutube").click( function(event){
            event.preventDefault();
            bootbox.dialog({ title: "Add youtube url",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Video Name</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="name" name="name" type="text" placeholder="Video name" class="form-control input-md"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="url">Video URL</label> ' +
                    '<div class="col-md-4">' +
                    '<input type="url" name="url" id="url" value="" placeholder="Video URL" class="form-control input-md" checked="checked"> ' +
                    '</div> </div>' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="description">Video Description</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input type="description" name="description" id="description" placeholder="Video Description" class="form-control input-md" checked="checked"> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var a = parseInt($("#count").val());
                            a += 1;
                            $("#count").val(a);
                            var name = $('#name').val();
                            var url = $("#url").val();
                            var index = a;
                            var description = $("#description").val();;
                            //console.log("Video " + name + ". URL <b>" + url + "</b>");
                            var vidId = getId(url);
                            var vidCode = '<iframe width="250" src="//www.youtube.com/embed/' 
                            + vidId + '" frameborder="0" allowfullscreen></iframe>';
                            table.row.add(['<p class="">'+(parseInt(table.column(0).length)+1)+'</p>'+
                            ' <input class="form-control hidden" value="'+index+'" type="number" min="1" max="50" name="youtube-index-'+index+'" required="">',
                            vidCode+'<input class="form-control hidden" value="'+vidId+'" type="text" name="youtube-id-'+index+'" required="">',
                            '<input class="form-control" value="'+name+'" type="text" name="youtube-name-'+index+'" required="">'
                                ,'<textarea class="form-control" placeholder="Add Descripton" name="youtube-des-'+index+'" >'+description+'</textarea>']).draw(false);
                        }
                    }
                }});
            $.ajax(""
                    );
        }
        );
    </script>
    </div>
</div>   
    
    
</div>
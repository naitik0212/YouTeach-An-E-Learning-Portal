<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
           <h1 class="page-header">Course Upload</h1>

               <ol class="breadcrumb">
                   <li>
                       Course Upload
                   </li>
                   <li class="active">
                       Add Youtube video
                   </li>
               </ol>
       </div>
    </div>
    <link href="<?php echo base_url() ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <style>
        tr > th , tr > td{
            text-align: center;
        }
    </style>
    <script>
        $(document).ready( function(){
 var t = $('#urlList').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    
     var counter = 1;
 
    $('#addLink').on( 'click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5',
            '<a id="delete'+counter+'" ><i class="fa fa-remove"></i></a>'
        ] ).draw( false );
 
        counter++;
    } );
 
    // Automatically add a first row of data
    $('#addLink').click();
    });

    </script>
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8">
                        Select your Upload method
                    </div>
                    <div class="col-md-4 text-right">
                        <a class="btn btn-primary" id="addLink"><i class="fa fa-plus"></i> Add Video</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                    <form method="post" onsubmit="return verifyindex()" action="" name="fileIndex">
                        <table id="urlList" class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>File</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
        
                        <input type="submit" class="form-control" value="Submit" />
                    </form>

                </div>
                </div>
            </div>
        </div>
        </div>
        <script src="<?php echo base_url() ?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
    </div>
</div>
<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
           <h1 class="page-header">Course Upload</h1>

               <ol class="breadcrumb">
                   <li>
                       Course Upload
                   </li>
                   <li class="active">
                       Course Method
                   </li>
               </ol>
       </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Select your Upload method
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a href="<?php echo site_url("frontend")."/courseUploadFiles/".$courseid; ?>" title="upload Video Files" style="color:  #09A2FF">
                            <i class="fa fa-upload fa-5x"></i>
                        </a>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="<?php echo site_url("frontend")."/courseYoutubeFiles/".$courseid; ?>" title="upload via Youtube" style="color: #EE1C1B">
                        <i class="fa fa-youtube fa-5x" ></i>
                    </a>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo site_url("frontend")."/courseEdit/".$courseid; ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Previous</a>
                                </div>
                                <div class="col-md-8">
                                    
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo site_url("frontend")."/userCourses"; ?>" class="btn btn-default pull-right"><i class="fa fa-times-circle"></i>  Cancel   </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
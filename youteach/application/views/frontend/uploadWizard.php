    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Upload a course</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
            </div>
            <link href="<?php echo base_url(); ?>assets/wizard/css/bootstrap-wizard.css" rel="stylesheet" type="text/css"/>
            <script src="<?php echo base_url(); ?>assets/wizard/js/bootstrap-wizard.min.js" type="text/javascript"></script>
            <!-- /.container-fluid -->
            
            <div class="container-fluid">
                <div class="wizard" id="some-wizard" data-title="Wizard Title">
                    <div class="wizard-card" data-cardname="card1">
                        <h3>Add Course Details</h3>
                        <?php $this->load->view("frontend/courseUpload_1") ?>
                    </div>

                    <div class="wizard-card" data-cardname="card2">
                        <h3>Card 2</h3>
                        Some content
                    </div>
                </div>
            </div>
            
            <script>
                var wizard = null;
                $(function() {
                    var options = {
                        contentHeight:550,
                        contentWidth:1300
                    };
                    wizard = $("#some-wizard").wizard(options);
                    wizard.show();
                });
            </script>
        </div>
    <!-- /#page-wrapper -->
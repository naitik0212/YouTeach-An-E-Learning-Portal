<!-- jQuery and jQuery UI (REQUIRED) -->
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- elFinder CSS (REQUIRED) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ftp') ?>/css/elfinder.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ftp') ?>/css/theme.css">
<!-- elFinder JS (REQUIRED) -->

<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $(document).ready(function() {
                $('#elfinder').elfinder({
                        url : '<?php echo site_url('frontend/docLoad/'.$course->id) ?>'  // connector URL (REQUIRED)
                });
        });
</script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

 <script src="<?php echo base_url('assets/ftp') ?>/js/elfinder.min.js"></script>
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>


    <div id="video-content"> Loading the player ... </div>
    <script src="<?php echo base_url() ?>assets/jwplayer/jwplayer.js" type="text/javascript"></script>
    <script>jwplayer.key="Jt0fVDkkdqz/3aZqa1u9Sy25zELRHseCPcN39A==";</script>
    <script type="text/javascript">
    var playerInstance = jwplayer("video-content");
    var source = "<?php echo $source?>";
    var type = "<?php echo $type; ?>";
    var file;
    if(type === "youtube"){
        file = "//youtu.be/"+getId(source);
    }
    else 
        file = source;
    playerInstance.setup({
        file:file,
        //image: "/codeigniter/assets/images/play-button-overlay.png",
        width: "100%",
        aspectratio: "16:9",
        title: '<?php echo $name ?>',
        description: '<?php echo $description ?>',
        mediaid: '123456'
    });
    
    function getId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);

            if (match && match[2].length === 11) {
                return match[2];
            } else {
                return 'error';
            }
        }
        
    </script>
<!--    <script src="<?php echo base_url(); ?>assets/flowplayer/js/flowplayer.min.js" type="text/javascript"></script>-->

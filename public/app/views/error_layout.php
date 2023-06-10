<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta content="<?php echo _author; ?>" name="author">
		<meta content="<?php echo _sitename; ?>" name="appname">
		<meta content="<?php echo _sitevers; ?>" name="version">
		<meta content="<?php echo _sitedesc; ?>" name="description">

        <?php foreach($this->styles as $style){ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo preg_match("/^http.*/i", $style)? $style : base_url($style); ?>" />
        <?php } ?>

        <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

        <?php foreach($this->scripts as $script){ ?>
            <script src="<?php echo preg_match("/^http.*/i", $script)? $script : base_url($script); ?>"></script>
        <?php } ?>

        <title><?php echo is_array($title)? implode(" :: ", $title) : $title; ?></title>
    </head>
	<body class="pace-top" oncontextmenu="return false;">
        <div id="page-loader" class="fade in">
            <span class="spinner"></span>
        </div>
        <div id="page-container" class="fade">
            <?php $this->load->view($view); ?>
        </div>
        <script id="WebApplication">
            $(document).ready(function(){
                App.init();
            });
        </script>
        <script language="JavaScript">
            window.onload = function() {
                document.addEventListener("contextmenu", function(e) {
                    e.preventDefault();
                }, false);
                document.addEventListener("keydown", function(e) {
                    //document.onkeydown = function(e) {
                    // "I" key
                    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                        disabledEvent(e);
                    }
                    // "J" key
                    if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                        disabledEvent(e);
                    }
                    // "S" key + macOS
                    if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                        disabledEvent(e);
                    }
                    // "U" key
                    if (e.ctrlKey && e.keyCode == 85) {
                        disabledEvent(e);
                    }
                    // "F12" key
                    if (event.keyCode == 123) {
                        disabledEvent(e);
                    }
                }, false);

                function disabledEvent(e) {
                    if (e.stopPropagation) {
                        e.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                    e.preventDefault();
                    return false;
                }
            };
        </script>
    </body>
</html>

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

    <?php foreach ($this->styles as $style) { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo preg_match("/^http.*/i", $style) ? $style : base_url($style); ?>" />
    <?php } ?>

    <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

    <?php foreach ($this->scripts as $script) { ?>
        <script src="<?php echo preg_match("/^http.*/i", $script) ? $script : base_url($script); ?>"></script>
    <?php } ?>

    <title><?php echo is_array($title) ? implode(" :: ", $title) : $title; ?></title>
    <style>
        .bselect-modal .bootstrap-select.form-control {
            height: auto !important;
        }

        tr.group,
        tr.group:hover {
            background-color: #e2e7eb !important;
        }

        table.table-bordered.dataTable th:last-child,
        table.table-bordered.dataTable td:last-child {
            border-right: 1px solid #e2e7eb;
        }

        .bootstrap-select.btn-group .dropdown-menu.inner {
            max-height: 220px !important;
        }

        input[data-readonly] {
            pointer-events: none;
        }
    </style>
</head>

<!-- <body oncontextmenu="return false;"> -->
<body>
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
        <?php $this->load->view("head_layout"); ?>
        <?php $this->load->view("nave_layout"); ?>
        <?php $this->load->view($view); ?>
        <?php $this->load->view("foot_layout"); ?>
    </div>
    <script id="WebApplication">
        $(document).ready(function() {
            App.init();

            var current_url = String(window.location.href).replace(new RegExp("\\&action.*", "gm"), "");
            var current_url = current_url.replace(new RegExp(".*index\.php", "gm"), "index.php");
            $("#sidebar ul.nav:has(.nav-header) > li:not(:has(a.nav-header))").each(function(index, value) {
                if ($(this).find("a[href*='" + current_url + "']").length > 0) {
                    $(this).removeClass("active").addClass("active");
                }
            });
            $("#sidebar ul.sub-menu > li").each(function(index, value) {
                if ($(this).find("a[href*='" + current_url + "']").length > 0) {
                    $(this).removeClass("active").addClass("active");
                }
            });
        });
    </script>
    <!-- <script language="JavaScript">
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
    </script> -->
</body>

</html>
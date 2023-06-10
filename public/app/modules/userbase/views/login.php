<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta content="Jack Devians" name="author">
    <meta content="Login Form" name="description">

    <title><?php echo is_array($title) ? implode(" :: ", $title) : $title; ?></title>

    <link rel="icon" type="image/png" href="<?php echo base_url('assets/login/img/favicon.png'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/login.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap">
    <link rel="stylesheet" href="<?php echo base_url('assets/login/vendor/gritter/css/jquery.gritter.css'); ?>">

    <script src="<?php echo base_url('assets/login/js/kit-64d58efce2.js'); ?>"></script>
    <script src="<?php echo base_url('assets/login/js/jquery-3.2.1.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/login/vendor/jquery-ajaxq/ajaxq.js'); ?>"></script>
    <script>
        $(document).on("submit", "#form-login", function(event) {
            event.preventDefault();
            $btn = $(this).find("button[type=submit]");
            request = $.ajaxq("queue", {
                "url": $(this).attr("action"),
                "type": "POST",
                "data": $(this).serialize(),
                "dataType": "json",
            });
            request.done(function(json) {
                if (json.success) {
                    $.gritter.add({
                        title: json.title,
                        text: json.messages
                    });
                    document.location = json.profile;
                } else {
                    $.gritter.add({
                        title: json.title,
                        text: json.messages
                    });
                }
            });
            request.fail(function(jqXHR, textStatus) {
                $.gritter.add({
                    title: "Request failed",
                    text: textStatus
                });
            });
            return false;
        });

        $(document).on("submit", "#form-register", function(event) {
            event.preventDefault();
            form = $(this);
            formData = $(this)[0];
            $btn = form.find("button[type='submit']");
            request = $.ajaxq("queue", {
                "url": form.attr("action"),
                "type": "POST",
                "data": new FormData(formData),
                "dataType": "json",
                "cache": false,
                "contentType": false,
                "processData": false,
            });
            request.done(function(json) {
                if (json.success) {
                    $.gritter.add({
                        title: json.title,
                        text: json.messages
                    });
                    document.getElementById("form-register").reset();
                } else {
                    $.gritter.add({
                        title: json.title,
                        text: json.messages
                    });
                }
            });
            request.fail(function(jqXHR, textStatus) {
                $.gritter.add({
                    title: "Request failed",
                    text: textStatus
                });
            });
            return false;
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form id="form-login" action="<?php echo base_url('enter-app'); ?>" class="sign-in-form" method="POST">
                    <img src="<?php echo base_url("assets/login/img/logo.png"); ?>" class="login-logo">
                    <!-- <h2 class="title">Sign in</h2> -->
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" placeholder="Username or E-mail" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <button type="submit" class="btn solid">
                        Login
                    </button>
                </form>
                <form id="form-register" action="<?php echo base_url('register'); ?>" class="sign-up-form" method="POST">
                    <img src="<?php echo base_url("assets/login/img/logo.png"); ?>" class="login-logo">
                    <!-- <h2 class="title">Sign up</h2> -->
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Full Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <button type="submit" class="btn">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        You can register for our online membership and get many opportunities to realize your success
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="<?php echo base_url('assets/login/img/login.svg'); ?>" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Use your existing account to login and view activity result
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="<?php echo base_url('assets/login/img/register.svg'); ?>" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/login/js/login.js'); ?>"></script>
    <script src="<?php echo base_url('assets/login/vendor/gritter/js/jquery.gritter.js'); ?>"></script>
</body>

</html>
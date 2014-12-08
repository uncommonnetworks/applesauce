<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
    <base href="/" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sign In - PixelAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Open Sans font from Google CDN -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

    <!-- Pixel Admin's stylesheets -->
    <link href="assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="assets/javascripts/ie.min.js"></script>
    <![endif]-->




</head>


<!-- 1. $BODY ======================================================================================

	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-default page-signin">

<!-- Page background -->
<div id="page-signin-bg">
    <!-- Background overlay -->
    <div class="overlay"></div>
    <!-- Replace this with your bg image -->
    <img src="assets/demo/signin-bg-2.jpg" alt="">
</div>
<!-- / Page background -->

<!-- Container -->
<div class="signin-container">

    <!-- Left side -->
    <div class="signin-info">
        <a href="index.html" class="logo">
            <img src="assets/demo/logo-big.png" alt="" style="margin-top: -5px;">&nbsp;
            Applesauce
        </a> <!-- / .logo -->
        <div class="slogan">
            Cinnamon.  Raisins.  Nutmeg.
        </div> <!-- / .slogan -->
        <ul>
            <li><i class="fa fa-sitemap signin-icon"></i> Flexible modular structure</li>
            <li><i class="fa fa-file-text-o signin-icon"></i> LESS &amp; SCSS source files</li>
            <li><i class="fa fa-outdent signin-icon"></i> RTL direction support</li>
            <li><i class="fa fa-heart signin-icon"></i> Crafted with love</li>
        </ul> <!-- / Info list -->
    </div>
    <!-- / Left side -->

    <!-- Right side -->
    <div class="signin-form">
        <!-- Form -->
        {{ Form::open(array('url'=>'users/login', 'id'=>'signin-form_id')) }}
        {{ Form::hidden('remember', 1) }}
<!--        <form action="index.html" id="signin-form_id">-->
            <div class="signin-text">
                <span>Sign In to your account</span>
            </div> <!-- / .signin-text -->

            <div class="form-group w-icon">
                {{ Form::text('email', null, array('class' => 'form-control input-lg', 'id' => 'username_id', 'placeholder' => 'email address')) }}
<!--                <input type="text" name="signin_username" id="username_id" class="form-control input-lg" placeholder="Username or email">-->
                <span class="fa fa-user signin-form-icon"></span>
            </div> <!-- / Username -->

            <div class="form-group w-icon">
                {{ Form::password('password', array('class' => 'form-control input-lg', 'placeholder' => 'password', 'id' => 'password_id')) }}
<!--                <input type="password" name="signin_password" id="password_id" class="form-control input-lg" placeholder="Password">-->
                <span class="fa fa-lock signin-form-icon"></span>
            </div> <!-- / Password -->

            <div class="form-actions">
                {{ Form::submit('LOG IN', array('class' => 'signin-btn bg-primary')) }}
        {{ Form::close() }}
<!--                <input type="submit" value="SIGN IN" class="signin-btn bg-primary">
-->
                <a href="/users/forgot_password" class="forgot-password" id="forgot-password-link">Forgot your password?</a>
            </div> <!-- / .form-actions -->
        </form>
        <!-- / Form -->


        <!-- Password reset form -->
        <div class="password-reset-form" id="password-reset-form">
            <div class="header">
                <div class="signin-text">
                    <span>Password reset</span>
                    <div class="close">&times;</div>
                </div> <!-- / .signin-text -->
            </div> <!-- / .header -->

            <!-- Form -->
            <form action="index.html" id="password-reset-form_id">
                <div class="form-group w-icon">
                    <input type="text" name="password_reset_email" id="p_email_id" class="form-control input-lg" placeholder="Enter your email">
                    <span class="fa fa-envelope signin-form-icon"></span>
                </div> <!-- / Email -->

                <div class="form-actions">
                    <input type="submit" value="SEND PASSWORD RESET LINK" class="signin-btn bg-primary">
                </div> <!-- / .form-actions -->
            </form>
            <!-- / Form -->
        </div>
        <!-- / Password reset form -->
    </div>
    <!-- Right side -->
</div>
<!-- / Container -->


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
    // Resize BG
    init.push(function () {
        var $ph  = $('#page-signin-bg'),
            $img = $ph.find('> img');

        $(window).on('resize', function () {
            $img.attr('style', '');
            if ($img.height() < $ph.height()) {
                $img.css({
                    height: '100%',
                    width: 'auto'
                });
            }
        });
    });

    // Show/Hide password reset form on click
    init.push(function () {
        $('#forgot-password-link').click(function () {
            $('#password-reset-form').fadeIn(400);
            return false;
        });
        $('#password-reset-form .close').click(function () {
            $('#password-reset-form').fadeOut(400);
            return false;
        });
    });

    // Setup Sign In form validation
    init.push(function () {
        $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate username
        $("#username_id").rules("add", {
            required: true,
            minlength: 3
        });

        // Validate password
        $("#password_id").rules("add", {
            required: true,
            minlength: 6
        });
    });

    // Setup Password Reset form validation
    init.push(function () {
        $("#password-reset-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate email
        $("#p_email_id").rules("add", {
            required: true,
            email: true
        });
    });

    window.PixelAdmin.start(init);
</script>

</body>
</html>

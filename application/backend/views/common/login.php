<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>../fav.png"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    <div class="login_back" style="background-image: url(../assets/image/back.jpg);">
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
            <div class="login-logo">
       <h1 class="text-blue">Admin | iipars</h1>
       <h3>Login Now </h3>
    </div>
        <!--<p class="login-box-msg">Sign in to start your session</p>-->
        <?php if($this->session->flashdata('message')!="") {  ?>
                <p style="color:red"><?php echo $this->session->flashdata('message'); ?></p>
        <?php } ?>
        <form action="<?php echo base_url(); ?>index.php/admin_login/login_submit" method="post" name="adminloginform" onsubmit="return validateForm()">
            <div class="form-group has-feedback">
                <!-- <p class="username_txt">User Name</p> -->
                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                <span class="glyphicon glyphicon-user form-control-feedback new_icon"></span>
            </div>
            <div class="form-group has-feedback">
                <!-- <p class="username_txt">Password</p> -->
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                <span class="glyphicon glyphicon-lock form-control-feedback new_icon"></span>
            </div>
            <div class="row">
                <!--<div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>-->
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat btn_new_design">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <script type="text/javascript">
            

 function validateForm() {
    var check_username = document.forms["adminloginform"]["username"].value;
    var check_password = document.forms["adminloginform"]["password"].value;
    
    //var discount = document.forms["product-submit-form"]["discount"].value;

    if (check_username == "") {
        alert("Username must be filled out");
        document.getElementById("username").style.borderColor = "red";
        window.location.assign("#username");
        return false;
    } else {
      document.getElementById("username").style.borderColor = "#777";
    }
    
    if (check_password == "") {
        alert("Password must be filled out");
        document.getElementById("password").style.borderColor = "red";
        window.location.assign("#password");
        return false;
    }  else {
      document.getElementById("password").style.borderColor = "#777";
    }
    
}


        </script>

       <!-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>-->
        <!-- /.social-auth-links -->

        <!--<a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    /*$(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });*/
</script>
</body>
</html>

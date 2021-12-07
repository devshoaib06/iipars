<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.8.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>Nerdizor - Control Panel Login</title>
        <meta name="description" content="Manage your school here">
        <meta name="keywords" content="School Management,Manage Student,Manage Exam,Manage Corese">
        <meta name="author" content="Ayman Anani">

        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>  
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'/>
        <link href="resource/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="resource/theme/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="resource/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="resource/theme/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
        <link href="resource/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="resource/theme/assets/global/img/favicon.ico"/>
        <style>
            body.newlogin{padding:0; margin:0; background:#2d2d2d !important;}
            .newlogin .content {width:400px; padding:0;}
            .loginmain{width:400px; margin:0 auto; padding:15px 0 0 0; font-family:"Open Sans"; color:#595959;}
            .newlogin .login-form {background:#2d2d2d;}
            .newlogin .content h3 {
                color: #ebebeb; font-size:15px; margin:0 0 20px 0 !important; padding:0
            }
            .newlogin .content h3 span{font-size:18px;}
            .login .logo{background:none;}
            .loginlogo{text-align:center; padding:15px 0 25px 0;}
            .logininner{margin:0 0 15px 0;}
            .head_login{padding:10px 0; color:#fff; font-size:15px; }
            .head_login span{font-size:18px;}
            .loginfield{padding:0px; font-size:14px; color:#757575;}
            .logintext{width:94%; height:38px; line-height:38px; border:1px solid #4a4a49; margin:10px 0; padding:0 10px; color:#848586; font-size:14px; background:#343433;}
            .loginsubmit{width:100%; text-align:center; height:38px; line-height:38px; border:none; background:#ed7423; color:#fff; font-size:15px;  cursor:pointer; margin-top:8px;}
            .loginfield a{color:#ed7423; text-decoration:none;}
            .bott_login{border-bottom:1px solid #343433; padding:20px 0;}
            .leftlogin{float:left;}
            .rightlogin{float:right;}

            .leftlogin1{float:left; padding:20px 0 0 0;}
            .rightlogin1{float:right; padding:20px 0 0 0;}
            .rightlogin1 a{color:#ed7423; text-decoration:none;}
            .rightlogin1 a:hover{text-decoration:underline;}
            .loginfield a:hover{ text-decoration:underline;}
            .create{text-align:center;}
            a.createbutt {padding:9px 15px; margin:5px 0 25px 0; background:#f5a61c; border:none; color:#fff; font-size:14px; text-transform:uppercase; display:inline-block; text-decoration:none; }
            a:hover.createbutt {background:#bd540e; text-decoration:none; color:#fff;}

            .newlogin input[type="text"] {
                background: #343433 none repeat scroll 0 0 !important;
                border: 1px solid #4a4a49 !important;
                color: #848586;
                font-size: 13px;
                height: 40px;
                line-height: 40px;
                margin: 10px 0;
                padding: 0 10px;
                width:100%; border-radius:0 !important;
            }
            .newlogin input[type="password"] {
                background: #343433 none repeat scroll 0 0 !important;
                border: 1px solid #4a4a49 !important;
                color: #848586;
                font-size: 13px;
                height: 38px;
                line-height: 38px;
                margin: 10px 0;
                padding: 0 10px;
                width: 100%; border-radius:0 !important;
            }

            .newlogin .content .create-account{
                border-top: 1px dotted #343433 !important;
                margin-top: 21px !important;
                padding-top: 17px !important;}

            .register-form {background:#2d2d2d;}
            .register-form h3 {color: #ebebeb;
                               font-size: 15px;
                               margin: 0 0 15px !important;
                               padding: 0;}

            a {
                color: #ed7423;
                text-decoration: none;
            }
            a:hover{text-decoration:underline; color: #ed7423;}

            .register {background: #ed7423 none repeat scroll 0 0;
                       border: medium none;
                       color: #fff;
                       cursor: pointer;
                       font-size: 15px;
                       height: 38px;
                       line-height: 38px;
                       margin-top: 8px;
                       text-align: center;
                       width: 100%; margin:0 0 8px 0;}

            .backregi{background: #999999 none repeat scroll 0 0;
                      border: medium none;
                      color: #fff;
                      cursor: pointer;
                      font-size: 15px;
                      height: 38px;
                      line-height: 38px;
                      text-align: center;
                      width: 25%; margin:8px auto 8px auto; }
            .registerout{text-align:center;}
            .forget-form{background:#2d2d2d;}
            .newlogin .copyright {color: #7c7c7c;}
            .newlogin .form-control::-moz-placeholder {
                color: #848586;
                opacity: 1;
            }


            @media only screen 
            and (min-width : 320px) 
            and (max-width : 479px){
                .login .logo{width:100%;}
                .loginmain{width:92%;}
                .newlogin .content{width:100%;}

            }

        </style>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login newlogin">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img alt="Login" src="resource/login-style/images/loginlogo.png">
        </div>
        <!-- END LOGO -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGIN -->
        <div class="loginmain">
            <div class="content">
                <?php
                $check = 0;
                $username = "";
                $password = "";
                $user_type = "";
                if (isset($_COOKIE[COOKIE . "username"])) {
                    $username = $_COOKIE[COOKIE . "username"];
                }
                if (isset($_COOKIE[COOKIE . "password"])) {
                    $password = $_COOKIE[COOKIE . "password"];
                }
                if (isset($_COOKIE[COOKIE . "user_type"])) {
                    $user_type = $_COOKIE[COOKIE . "user_type"];
                }
                if (isset($_COOKIE[COOKIE . "username"]) && isset($_COOKIE[COOKIE . "password"])) {
                    $check = 1;
                }
                //echo $check;
                ?>
                <!-- BEGIN LOGIN FORM -->
                <form action="login" method="post" id="form_login" class="login-form" >                
                    <h3 class="form-title"><span><?php echo $lb_welcome_dot; ?></span> <?php echo $lb_please_login_dot; ?> <?php //echo $lb_login_to_your_account;    ?></h3>
                    <?php if (isset($success_msg) && $success_msg != ""): ?>                 
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <i class="fa-lg fa fa-check"></i>
                            <span>
                                <?php echo $success_msg; ?>
                            </span>
                        </div>
                    <?php else: if (isset($error_msg) && $error_msg != "") { ?>
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <i class="fa-lg fa fa-warning"></i>
                                <span>
                                    <?php echo $error_msg; ?>
                                </span>
                            </div>
                        <?php } endif;
                    ?>


                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>
                            <?php echo $lb_enter_user_pass_lebel; ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_username; ?></label>
                        <div class="input-icon">

                            <input type="text" id="login_email_nid" name="login_email_nid" class="form-control input-lg" placeholder="<?php echo $lb_username_or_email; ?>" value="<?php echo $username; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_password; ?></label>
                        <div class="input-icon">

                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo $lb_password; ?>" name="login_password"  id="login_password"  required/>
                        </div>
                    </div>



                    <button type="submit" class="loginsubmit">
                        <?php echo $bt_login; ?> 
                    </button>
                    <div class="form-group">
                        <label class="leftlogin1">
                            <input type="checkbox" name="login_remember-me" id="login_remember-me" value="1" <?php
                            if ($check == 1) {
                                echo "checked";
                            }
                            ?>/><?php echo $lb_remember_me; ?></label>


                        <span class="rightlogin1">

                            <a href="javascript:;" id="forget-password"><?php echo $lb_forgot_password_q; ?></a>
                        </span>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="bott_login">
                        <span class="leftlogin">Or login with</span>
                        <span class="rightlogin">

                            <a href="<?php echo $fb_connect_url; ?>"><img src="resource/login-style/images/icon1.png" alt="" /> </a>                            
                            <a href="<?php echo $authUrl; ?>"><img src="resource/login-style/images/icon3.png" alt="" /> </a>
                            <!--<a href="#"><img src="resource/login-style/images/icon2.png" alt="" /></a>
                            <a href="#"><img src="resource/login-style/images/icon4.png" alt="" /> </a>-->

                        </span>
                        <div style="clear:both;"></div>
                    </div>


                    <div class="create-account create ">

                        <a href="javascript:;" id="register-btn" class="createbutt">Create an account</a>

                    </div>

                </form>
                <!-- END LOGIN FORM -->
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="forgot-password" method="post" id="form_reminder">
                    <input name="redirect_url" type="hidden" value="login" />
                    <h3><?php echo $lb_forgot_your_password; ?></h3>
                    <p>
                        <?php echo $lb_pass_label; ?>
                    </p>
                    <div class="form-group">
                        <div class="input-icon">

                            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo $lb_email; ?>" name="reminder_email"/>
                        </div>
                    </div>
                    <div class="registerout">
                        <button type="submit" class="register">
                            <?php echo $bt_submit; ?> 
                        </button>
                        <button type="button" id="back-btn" class=" backregi">
                            <i class="fa fa-arrow-left"></i>&nbsp;<?php echo $bt_back; ?> </button>

                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
                <!-- BEGIN REGISTRATION FORM -->
                <form class="register-form" action="registration-one" method="post" id="register_fm" name="register_fm" >
                    <h3 ><?php echo $lb_registration; ?></h3>
                    <p class="hint"> <?php echo $lb_registration_hint_text; ?> </p>  


                    <?php /* if (isset($success_msg) && $success_msg != ""): ?>                 
                      <div class="alert alert-success">
                      <button class="close" data-close="alert"></button>
                      <i class="fa-lg fa fa-check"></i>
                      <span>
                      <?php echo $success_msg; ?>
                      </span>
                      </div>
                      <?php else: if (isset($error_msg) && $error_msg != "") { ?>
                      <div class="alert alert-danger">
                      <button class="close" data-close="alert"></button>
                      <i class="fa-lg fa fa-warning"></i>
                      <span>
                      <?php echo $error_msg; ?>
                      </span>
                      </div>
                      <?php } endif; */ ?>


                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_first_name; ?></label> 
                        <input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $lb_first_name; ?>" name="first_name" id="first_name" />                  
                    </div>

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_middle_name; ?></label> 
                        <input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $lb_middle_name; ?>" name="middle_name" id="middle_name" />                  
                    </div>

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_last_name; ?></label> 
                        <input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $lb_last_name; ?>" name="last_name" id="last_name" />                  
                    </div>

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_email; ?></label> 
                        <input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $lb_email; ?>" name="email" id="email" onBlur="return email_exist(this.value);"  onFocus="return hide_email_msg();" />
                        <span id="remail" style="margin-bottom: 5px;margin-top: 5px;"></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_code; ?></label> 
                        <input class="form-control placeholder-no-fix" type="text" placeholder="<?php echo $lb_code; ?>" name="reg_code" id="reg_code" />                  
                    </div>

                    <p class="hint"> <?php echo $lb_credential_hint_text; ?> </p>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_user_name; ?></label>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo $lb_user_name; ?>" name="user_name" id="user_name" onBlur="return user_name_exist(this.value);"  onFocus="return hide_user_name_msg();" /> 
                        <span id="ruser_name" style="margin-bottom: 5px;margin-top: 5px;"></span></div>

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_password; ?></label>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo $lb_password; ?>" name="password" id="password" /> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9"><?php echo $lb_retype_password; ?></label>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo $lb_retype_password; ?>" name="rpassword" id="rpassword" /> </div>

                    <div class="form-group margin-top-20 margin-bottom-20">
                        <label class="check">
                            <input type="checkbox" name="tnc" /> I agree to the
                            <a href="javascript:;"> Terms of Service </a> &
                            <a href="javascript:;"> Privacy Policy </a>
                        </label>
                        <div id="register_tnc_error"> </div>
                    </div>
                    <div class="registerout"> 
                        <button type="submit" id="register-submit-btn" class="register"><?php echo $bt_register; ?></button>                   
                        <button type="button" id="register-back-btn" class="backregi"> <i class="fa fa-arrow-left"></i>&nbsp;<?php echo $bt_back; ?> </button>
                        <div style="clear:both;"></div>

                    </div>
                </form>
                <!-- END REGISTRATION FORM -->
            </div>
            <!-- END LOGIN -->
            <!-- BEGIN COPYRIGHT -->
            <div class="copyright">
                <?php echo date('Y'); ?> &copy;  Nerdizor.
            </div>
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="../../assets/global/plugins/respond.min.js"></script>
        <script src="../../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="resource/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="resource/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="resource/theme/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="resource/theme/assets/global/plugins/select2/select2.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="resource/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="resource/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="resource/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
        <script src="resource/theme/assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
                            jQuery(document).ready(function () {
                                Metronic.init(); // init metronic core components
                                Layout.init(); // init current layout
                                Login.init();
                                Demo.init();
                                // init background slide images

                            });
        </script>
        <script>

            function  hide_email_msg() {
                $('#remail').empty();
            }

            function email_exist(email) {
                $('#remail').empty();
                if (email == "") {
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>user_ajax/email_exist_not_login",
                        data: "email=" + email,
                        datatype: "html",
                        cache: "false",
                        success: function (msg) {

                            msg = JSON.parse(msg);
                            msgNumber = parseInt(msg.number);

                            if (msgNumber == "0") {
                                $('#remail').html(msg.message);
                            } else if (msgNumber == "1") {
                                $('#remail').html(msg.message);
                                $('#email').val("");
                            } else {
                                if ($("[for='email']").text() == '') {
                                    $('#remail').html(msg.message);
                                    $('#email').val("");
                                }
                            }

                        }
                    });
                }
            }

            function  hide_user_name_msg() {
                $('#ruser_name').empty();
            }

            function user_name_exist(user_name) {
                $('#ruser_name').empty();
                //$('#ruser_name').closest('.form-group').removeClass('has-error'); 
                //$('#ruser_name').removeClass('help-block help-block-error');
                if (user_name == "") {
                } else {

                    //var nameRegex = /^[a-zA-Z\-]+$/;
                    var nameRegex = /^[A-Z a-z][a-zA-Z0-9_.]+$/;

                    var validfirstUsername = document.register_fm.user_name.value.match(nameRegex);

                    if (validfirstUsername) {

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>user_ajax/user_name_exist_not_login",
                            data: "user_name=" + user_name,
                            datatype: "html",
                            cache: "false",
                            success: function (msg) {

                                msg = JSON.parse(msg);
                                msgNumber = parseInt(msg.number);

                                if (msgNumber == "0") {
                                    $('#ruser_name').html(msg.message);
                                } else if (msgNumber == "1") {
                                    $('#ruser_name').html(msg.message);
                                    $('#user_name').val("");
                                } else {
                                    if ($("[for='user_name']").text() == '') {
                                        $('#ruser_name').html(msg.message);
                                        $('#user_name').val("");
                                    }
                                }

                            }
                        });

                    } else {
                        $('#ruser_name').closest('.form-group').addClass('has-error');
                        $('#ruser_name').addClass('help-block help-block-error');

<?php
$msg = $this->all_function->fetchMessage('user_name_pattern');
?>
                        $('#ruser_name').html("<?php echo $msg; ?>");
                        return false;
                    }

                }
            }

        </script>


        
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
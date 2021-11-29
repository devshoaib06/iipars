<!DOCTYPE html>

<!-- 

Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6

Version: 4.5.4

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

        <meta charset="utf-8" />

        <title><?php echo e(config('constants.site_name')); ?> | Admin Login <?php /*{{trans('common.page_title.login')}} - {{config('constants.site_name')}}*/?></title>

        <base href="<?php echo e(config('path.main_site_path')); ?>" >

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta content="" name="description" />

        <meta content="" name="author" />

		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" /> 

		

		<!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/uniform/css/uniform.default.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="<?php echo e(asset('public/assets/global/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/select2/css/select2-bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="<?php echo e(asset('public/assets/global/css/components.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->

        <link href="<?php echo e(asset('public/assets/pages/css/login.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>"/>
        <style type="text/css">
            /*rgba(233,114,39,0.9);*/
                .down-banner{
                    background:rgba(30,68,141,0.9);
                    position: fixed;
                    width: 100%;
                    height: 100%;
                    color:#fff;
                    font-size: 4rem;
                    z-index: 9999;
                    font-weight: 700;
                    text-align: center;
                    top:0;
            
                }
                .down-banner-expired{
                    background:#fff;
                    position: fixed;
                    width: 100%;
                    height: 100%;
                    color:#666;
                    font-size: 4rem;
                    z-index: 9999;
                    font-weight: 700;
                    text-align: center;
                    top:0;
            
                }
                .down-banner-text {
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                right: 0;
                padding: 0 40px;
            }
            
                @media  screen and (min-width: 20rem) {
              .down-banner {
                font-size: calc(4rem + 1.2 * ((100vw - 20rem) / 30));
              }
            }
            @media  screen and (min-width: 50rem) {
              .down-banner {
                font-size: 4.5rem;
              }
            }
            </style>

    </head>

    <!-- END HEAD -->

	

	<body class=" login">
        <div class="login-header">
            <div class="copyright" > Welcome  <?php echo e(config("constants.site_name")); ?> </div>
            
        </div>
        <!-- BEGIN LOGO -->

        <div class="logo">

            <a href="<?php echo e(url(config("constants.admin_prefix"))); ?>">

                <img src="<?php echo e(asset('public/assets/pages/img/logo-big.jpg')); ?>" alt="" /> </a>

        </div>

        <!-- END LOGO -->

        <!-- BEGIN LOGIN -->

        <div class="content">

            <!-- BEGIN LOGIN FORM -->

			<form class="login-form" action="<?php echo e(url(config('constants.admin_prefix').'/login')); ?>" method="post">

			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <h3 class="form-title font-green"><i class="fa fa-key">Sign In</i></h3>

                <div class="alert alert-danger display-hide">

                    <button class="close" data-close="alert alert-danger"></button>

                    <span> Enter email and password. </span>

                </div>

				<?php if(Session::has('message')): ?>                         

				<div class="alert alert-danger">

					<button class="close" data-close="alert"></button>

					<span><?php echo e(Session::get('message')); ?> </span>

				</div>

				<?php endif; ?> 

				<!--Below this for reset forget password redirect page message --> 

				<?php if(isset($message)): ?>

				<div class="alert alert-info ">

					<button class="close" data-close="alert"></button>

					<span><?php echo e($message); ?> </span>

				</div>

				<?php endif; ?> 	

				<!--Below this for csrf token time expire redirect page message --> 

				<?php if($errors->has('token_error')): ?>

					<div class="alert alert-danger ">

						<button class="close" data-close="alert"></button>

						<span><?php echo e($errors->first('token_error')); ?></span>

					</div>					

				<?php endif; ?>			

				

				

				

                <div class="form-group">

                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

                    <label class="control-label visible-ie8 visible-ie9">Username</label>

                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="User Name" name="username" value="<?php if(isset($_COOKIE['teachinns_username']) && !empty($_COOKIE['teachinns_username'])) echo $_COOKIE['teachinns_username']; ?>" /> 

					<?php if($errors->has('username')): ?>

                                    <span class="help-block">

                                        <strong><?php echo e($errors->first('email')); ?></strong>

                                    </span>

                                    <?php endif; ?>	

					</div>

                <div class="form-group">

                    <label class="control-label visible-ie8 visible-ie9">Password</label>

                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['teachinns_password']) && !empty($_COOKIE['teachinns_password'])) echo $_COOKIE['teachinns_password']; ?>" /> 

					 <?php if($errors->has('password')): ?>

                                    <span class="help-block">

                                        <strong><?php echo e($errors->first('password')); ?></strong>

                                    </span>

                                    <?php endif; ?>	

					</div>

                <div class="form-actions">

                    <button type="submit" class="btn green uppercase">Login</button>

                    <label class="rememberme check">

                        <input type="checkbox" name="remember_me" value="1" <?php if(isset($_COOKIE['teachinns_password']) && !empty($_COOKIE['teachinns_password'])) echo "checked='checked'"; ?> />Remember </label>

                   <!-- <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a> -->

                </div>                

            </form>

				

				

				

				

            <!-- END LOGIN FORM -->

            <!-- BEGIN FORGOT PASSWORD FORM -->

            <form class="forget-form" action="<?php echo e(url(config('constants.admin_prefix').'/password/email')); ?>" method="post">

			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <h3 class="font-green">Forget Password ?</h3>				

                <p> Enter your e-mail address below to reset your password. </p>

				<div class="alert alert-danger display-hide">

                    <button class="close" data-close="alert"></button>

                    <span> Enter valid registered email. </span>

                </div>

				<?php if(Session::has('message')): ?>                         

				<div class="alert alert-danger ">

					<button class="close" data-close="alert"></button>

					<span><?php echo e(Session::get('message')); ?> </span>

				</div>

				<?php endif; ?> 

                <div class="form-group">

                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>

                <div class="form-actions">

                    <button type="button" id="back-btn" class="btn btn-default">Back</button>

                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>

                </div>

            </form>

            <!-- END FORGOT PASSWORD FORM -->

            

        </div>
        <!-- ------------------Alert------------------------- -->



<!-- ------------------Alert------------------------- -->
        
        <!-- BEGIN FOOTER -->
        <div class="login-footer">
            <div class="copyright"> <?php echo e(date('Y')); ?> &copy; <?php echo e(config("constants.site_name")); ?>. </div>
            
        </div>
        <!-- END FOOTER -->

        <!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

        <!-- BEGIN CORE PLUGINS -->

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/js.cookie.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/uniform/jquery.uniform.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-validation/js/additional-methods.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/select2/js/select2.full.min.js')); ?>" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <script src="<?php echo e(asset('public/assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <!--<script src="<?php echo e(asset('public/assets/pages/scripts/login.min.js')); ?>" type="text/javascript"></script>-->

        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <!-- END THEME LAYOUT SCRIPTS -->

		

		<script type="text/javascript">

		

		var Login = function() {



    		var handleLogin = function() {



        $('.login-form').validate({

            errorElement: 'span', //default input error message container

            errorClass: 'help-block', // default input error message class

            focusInvalid: false, // do not focus the last invalid input

            rules: {

                username: {

                    required: true

                },

                password: {

                    required: true

                },

                remember: {

                    required: false

                }

            },



            messages: {

                username: {

                    required: "Username is required."

                },

                password: {

                    required: "Password is required."

                }

            },



            invalidHandler: function(event, validator) { //display error alert on form submit   

                $('.alert-danger', $('.login-form')).show();

            },



            highlight: function(element) { // hightlight error inputs

                $(element)

                    .closest('.form-group').addClass('has-error'); // set error class to the control group

            },



            success: function(label) {

                label.closest('.form-group').removeClass('has-error');

                label.remove();

            },



            errorPlacement: function(error, element) {

                error.insertAfter(element.closest('.input-icon'));

            },



            submitHandler: function(form) {

                form.submit(); // form validation success, call ajax form submit

            }

        });



        $('.login-form input').keypress(function(e) {

            if (e.which == 13) {

                if ($('.login-form').validate().form()) {

                    $('.login-form').submit(); //form validation success, call ajax form submit

                }

                return false;

            }

        });

    }



    		var handleForgetPassword = function() {

			

				$('.forget-form').validate({

				errorElement: 'span', //default input error message container

				errorClass: 'help-block', // default input error message class

				focusInvalid: false, // do not focus the last invalid input

				ignore: "",

				rules: {

					email: {

						required: true,

						email: true,

						remote :

						{

							url: "<?php echo e(url(config('constants.admin_prefix').'/isregister/email')); ?>",

							type: "get",

							data:

							{

								email: function()

								{

									return $('.forget-form :input[name="email"]').val();

								}

							}

						}

					}

				},

	

				messages: {

					email: {

						required: "Email is required.",

						email: "Enter valid email address.",

						remote: 'Email is not registered.'

					}

				},

	

				invalidHandler: function(event, validator) { //display error alert on form submit   

					$('.alert-danger', $('.forget-form')).show();

				},

	

				highlight: function(element) { // hightlight error inputs

					$(element)

						.closest('.form-group').addClass('has-error'); // set error class to the control group

				},

	

				success: function(label) {

					label.closest('.form-group').removeClass('has-error');

					label.remove();

				},

	

				errorPlacement: function(error, element) {

					error.insertAfter(element.closest('.input-icon'));

				},

	

				submitHandler: function(form) {

					form.submit();

				}

			});

	

				$('.forget-form input').keypress(function(e) {

				if (e.which == 13) {

					if ($('.forget-form').validate().form()) {

						$('.forget-form').submit();

					}

					return false;

				}

			});

	

				jQuery('#forget-password').click(function() {

				jQuery('.login-form').hide();

				jQuery('.forget-form').show();

			});

	

				jQuery('#back-btn').click(function() {

				jQuery('.login-form').show();

				jQuery('.forget-form').hide();

			});



    		}



    



			return {

				//main function to initiate the module

				init: function() {

		

					handleLogin();

					handleForgetPassword();

					

		

				}

		

			};

			

		}();

		

		jQuery(document).ready(function() {

			Login.init();

		});

		

		</script>

    </body>    



</html><?php /**PATH /home/teachinns/public_html/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>
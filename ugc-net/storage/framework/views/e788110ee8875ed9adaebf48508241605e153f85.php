<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php if(trim($__env->yieldContent('page_title'))): ?><?php echo $__env->yieldContent('page_title'); ?> <?php else: ?> <?php echo e(config("constants.site_name")); ?>  <?php endif; ?> - <?php echo e(config('constants.site_name')); ?> </title> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
		
		<meta name="description" content="<?php if(trim($__env->yieldContent('meta_description'))): ?><?php echo $__env->yieldContent('meta_description'); ?> <?php else: ?> <?php echo e(config('constants.site_name')); ?> <?php endif; ?>" />
		<meta name="keywords" content="<?php if(trim($__env->yieldContent('meta_keywords'))): ?><?php echo $__env->yieldContent('meta_keywords'); ?> <?php else: ?> <?php echo e(config('constants.site_name')); ?> <?php endif; ?>" />
		<meta content="" name="author" />
		
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" /> 
		<base href="<?php echo e(config('path.main_site_path')); ?>" >
        <!-- BEGIN PAGE FIRST SCRIPTS -->
        <script src="<?php echo e(asset('public/assets/global/plugins/pace/pace.min.js')); ?>" type="text/javascript"></script>
        <!-- END PAGE FIRST SCRIPTS -->
        <!-- BEGIN PAGE TOP STYLES -->
        <link href="<?php echo e(asset('public/assets/global/plugins/pace/themes/pace-theme-flash.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE TOP STYLES -->
		
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo e(asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/global/plugins/uniform/css/uniform.default.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->		
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php echo $__env->yieldContent('page_level_plugins_css'); ?>
        <!-- END PAGE LEVEL PLUGINS -->				
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php echo $__env->yieldContent('page_level_css'); ?>
        <!-- END PAGE LEVEL PLUGINS -->		
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo e(asset('public/assets/global/css/components.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo e(asset('public/assets/global/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/layout.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/themes/blue.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/custom.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>"/>
		<style type="text/css">
			/*rgba(233,114,39,0.9);*/
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

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    	
    	<noscript>
		<div class="alerttopbar">
			<label>Javascript is not enable in your browser, please enable javascript, thankyou.</label>
		</div>

		<div class="alertboxupper">
			<div class="alertinner">
			<h3><span style="color: #a10c0c;"><strong>ERROR</strong></span><br/>!! Please enable your browser javascript !!</h3>
			</div>
		</div>
		</noscript>

		<div class="alerttopbar" id="noNET" style="display: none;">
			<label><strong>ERROR -</strong> No internet connection</label>
		</div>
        
        <!-- BEGIN HEADER -->
        <?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<!-- ------------------Alert------------------------- -->


<!-- ------------------Alert------------------------- -->
        <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        <?php echo $__env->yieldContent('page_level_plugins'); ?> 	
        <!-- END PAGE LEVEL PLUGINS -->		
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <!--<script src="<?php echo e(asset('public/assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>-->
		<script src="<?php echo e(asset('public/assets/global/scripts/app.js')); ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<?php echo $__env->yieldContent('page_level_scripts'); ?> 	
		<!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo e(asset('public/assets/layouts/layout/scripts/layout.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/layouts/layout/scripts/demo.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS EXTREME END-->
		<?php echo $__env->yieldContent('page_level_scripts_extreme_end'); ?> 	
		 <!-- END PAGE LEVEL SCRIPTS EXTREME END -->	
		 
			
		<script>
		jQuery(document).ready(function () {
		
			$('.numbers').keyup(function () {
				this.value = this.value.replace(/[^0-9\.]/g, '');
			});

		});
		</script>
		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		<script type="text/javascript">
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 3600000); // 1 hour 
			//setInterval(refreshToken, 30000); // 30 seconds 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            //setInterval(refreshToken, 3600000); // 1 hour 
			
			
			function setCookieMenu() {				
				
				if ($("body").hasClass("page-sidebar-closed") == true) {
            		var cvalue = 1;
				}
				else {
					var cvalue = 0;		
				}					
				
				var d = new Date();
				d.setTime(d.getTime() + (1*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();				
				document.cookie =  "teachinns_left_menu=" + cvalue + ";" + expires + ";path=/teachinns";
			}			
			function getCookieMenu() {
				var name = "teachinns_left_menu=";
				var decodedCookie = decodeURIComponent(document.cookie);
				var ca = decodedCookie.split(';');
				for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
						//alert(c.substring(name.length, c.length));
					}
				}
				return "";
			}
			function checkCookieMenu() {
				var user=getCookieMenu();
				if (user == "1") {
					$("body").removeClass("page-sidebar-closed");	
					$(".page-sidebar-menu").removeClass("page-sidebar-menu-closed");
				} else {
				  	$("body").addClass("page-sidebar-closed");
					$(".page-sidebar-menu").addClass("page-sidebar-menu-closed");
				}
			}
			
			checkCookieMenu();
			

        </script>

        <script type="text/javascript">
        	setInterval(function(){
			    if(navigator.onLine){
			        $("#noNET").hide();
			    }else{
			        $("#noNET").show();
			    }
			},5000);
        </script>

        
		 	
    </body>

</html><?php /**PATH /home/teachinns/public_html/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>
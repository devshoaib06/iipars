<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php if(trim($__env->yieldContent('page_title'))): ?><?php echo $__env->yieldContent('page_title'); ?> <?php else: ?> <?php echo e(config("constants.site_name")); ?>  <?php endif; ?> - <?php echo e(config('constants.site_name')); ?> </title> 
        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />
        
        <?php echo $__env->yieldContent('page_level_plugins_css'); ?>
       
        <?php echo $__env->yieldContent('page_level_css'); ?>
       
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/layout.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/themes/blue.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo e(asset('public/assets/layouts/layout/css/custom.css')); ?>" rel="stylesheet" type="text/css" />
       
        <link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>"/>
	</head>
    
    <body class="">
    	
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
        
       
        <div class="clearfix"> </div>
        
        <?php echo $__env->yieldContent('content'); ?>
       
       
    </body>

</html><?php /**PATH /home/teachinns/public_html/resources/views/admin/layouts/view_order.blade.php ENDPATH**/ ?>
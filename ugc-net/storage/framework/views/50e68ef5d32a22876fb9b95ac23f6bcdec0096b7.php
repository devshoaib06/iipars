<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<header id="header" class="header">
	
    <?php echo $__env->make('frontend.includes.top_header_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   

    <?php echo $__env->make('frontend.includes.header_menu_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</header>

<?php echo $__env->yieldContent('page_content'); ?>
<?php echo $__env->yieldContent('page_level_plugins'); ?>


<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/layout/layout_master.blade.php ENDPATH**/ ?>
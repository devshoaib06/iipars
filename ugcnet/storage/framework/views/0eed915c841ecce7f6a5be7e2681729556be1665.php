<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<header id="site_header" class="site_header1">
	
    <?php echo $__env->make('frontend.includes.top_header_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   

    <?php echo $__env->make('frontend.includes.header_menu_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</header>

<?php echo $__env->yieldContent('page_content'); ?>
<?php echo $__env->yieldContent('page_level_plugins'); ?>


<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /home/teachinns/public_html/resources/views/frontend/layout/layout_master.blade.php ENDPATH**/ ?>
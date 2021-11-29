<?php $__env->startPush('page_meta'); ?>
    <?php if( isset($page_metadata) && !empty($page_metadata) ): ?>
    <?php if(@$page_metadata->meta_robots=="Teachinns" || @$page_metadata->meta_robots==""): ?>
    	<?php @$page_metadata->meta_robots="index, follow";?>
    <?php endif; ?>
        <title><?php echo e($page_metadata->meta_title); ?></title>
        
        <meta name="description" content="<?php echo e($page_metadata->meta_desc); ?>">
        <meta name="keywords" content="<?php echo e($page_metadata->meta_keyword); ?>">
        <meta name="robots" content="<?php echo e(@$page_metadata->meta_robots); ?>"/>
    <?php endif; ?>
<?php $__env->stopPush(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/structure/page_meta.blade.php ENDPATH**/ ?>
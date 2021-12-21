<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>404</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                    

                    
                <div class="col-12 col-sm-12 col-md-12 error-page text-center">
                    <h1 class="m-0">404</h1>
                <?php if(Session::has('message')): ?>   
                    <h2><?php echo e(Session::get('message')); ?></h2>
                <?php else: ?>
                    <h2>Oops, something's went wrong!</h2>
                <?php endif; ?>
                <h3>Don't worry, try below helpful link</h3>
                <p>&nbsp;</p>
                <p><a href="<?php echo e(route('home')); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Home</a></p>
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

              
                </div>
                
            </div>
        </div>
    </section>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/errors/404.blade.php ENDPATH**/ ?>
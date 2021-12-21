<?php if( isset($home_banners) ): ?>

<?php if(auth()->guard()->check()): ?>
<section class="bannersection top-slider-bar">
<?php endif; ?>    
<?php if(auth()->guard()->guest()): ?>
    <section class="bannersection top-slider-bar">
<?php endif; ?>
    <section id="demos" class="outerslider">
        
            <div class="">
            <div class="item">

                <img src="<?php echo e(asset('public/frontend/images/Last-Minute-Suggestion.jpg')); ?>" alt="Last Minute Suggestion for UGC-NTA NET/SET/JRF Exam 2020" />
                <div class="bannermaintext">
                    
                </div>
            </div>
            
        </div>

    </section>
    <div class="bannertexst_slider">
    <div class="container">
        
        <?php if(count($bannersliders)==1): ?>
        <div class="bannerprice_slider">
            <section id="demos" class="outerslider">
                <?php $__currentLoopData = $bannersliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="banner-text-new">
                    <?php echo html_entity_decode($item->title); ?>


                    
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>    
        </div>    

        <?php endif; ?>
        <?php if(count($bannersliders)>1): ?>
        <div class="bannerprice_slider">
            <section id="demos" class="outerslider">
                <div class="owl-carousel" id="banner-slider">
                        <?php $__currentLoopData = $bannersliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <div class="item">
                            
                                <div class="banner-text-new">
                                    <?php echo html_entity_decode($item->title); ?>


                                    
                                </div>
                            </div>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                </div>
            </section>    
        </div>
        <?php endif; ?>
    </div>
    </div>
</section>
<?php endif; ?><?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/includes/home_banner.blade.php ENDPATH**/ ?>
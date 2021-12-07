<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li><?php echo e($cms->heading); ?></li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-12 <?php echo e(count($mentors)>0?'col-md-9':'col-md-12'); ?>">
                    <h1><?php echo $cms->heading; ?></h1>
                    <?php echo $cms->description; ?>

                </div>
                <?php if(count($mentors)>0): ?>
                    
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="sidebarCont newsticker-demo">
                        <h3>Our Mentors</h3>
                        <div class="mentorWrap newsticker-jcarousellite">
                            <ul>
                                <?php $__empty_1 = true; $__currentLoopData = $mentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="<?php echo e($mentor->id); ?>">
                                        <div class="mentorCont">
                                            <div class="mentorImg">
                                                <img src="<?php echo e(Storage::disk(config('disk.get_mentor'))->url($mentor->image)); ?>" />
                                            </div>
                                            <div class="mentorInfo">
                                                <p><?php echo e($mentor->name); ?></p>
                                                <p><em><?php echo e($mentor->qualification); ?></em></p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugcnet/resources/views/frontend/cms.blade.php ENDPATH**/ ?>
<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<?php echo $__env->make('frontend.includes.home_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $myfunction = new App\library\myFunctions();
?>


<section class="innerbanner">
        <img src="<?php echo e(asset('public/frontend/images/shortbanner.jpg')); ?>" alt="">
    </section>


<section class="bodycont">


    <section class="videosection">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-xs-8">
                    <h2>Search tag: <?php echo e($slug); ?></h2>
                    
                </div>
                <div class="col-sm-3 col-xs-4">
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        
            <div class="videoinner">
                <div class="row d-flex f-wrap">
                    <?php 
                    $myfunction = new App\library\myFunctions();  
                    ?>
                     <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $exam_slug = $myfunction->getProductExam($course->product_id);?>

                    <?php
                        $image=asset('storage/uploads/courses/No-Image.jpg');
                        if($course->image!=""){
                            $image=asset('storage/uploads/courses/'.$course->image);
                        }
					?>
                    <div class="col-sm-3">
                        <div class="tabdiv listdiv">
                        <a href="<?php echo e(route('front.corsCont',['exam'=>$exam_slug,'slug'=>$course->slug])); ?>">    
                            <div class="tabtop listtop">
                                    <img src="<?php echo e($image); ?>" alt="">
                            </div>
                            <h3><?php echo e($course->name); ?></h3>
                        </a>
                        
                            <?php if(floor($course->price)=="0"): ?>
                            <div class="rightprice">Free</div>
                            <?php else: ?>
                                <div class="rightprice">
                                        <?php if( isset($course->revised_price) ): ?>
                                <span>₹<?php echo e(number_format(floor($course->price))); ?></span>
                                <?php endif; ?>
                                ₹<?php echo e(number_format(floor($course->revised_price!=""?$course->revised_price:$course->price))); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                        <div class="col-sm-9 col-xs-8">
                            <p>No Course found.</p>
                            
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            
                            <div class="clearfix"></div>
                        </div>
                    
                   <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
   
   
    
    

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/course/course_tag_list.blade.php ENDPATH**/ ?>
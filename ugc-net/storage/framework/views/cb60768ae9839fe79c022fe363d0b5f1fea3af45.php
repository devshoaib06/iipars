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


    <section class="homeBodyCont">

        <?php if( isset($home_feature_courses) ): ?>
            <div class="container">
                <div class="row d-flex f-wrap">
                    <div class="col-sm-9 col-xs-8">
                        <h1>Last Minute Suggestion</h1>
                        
                    </div>
            <?php $__currentLoopData = $home_feature_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home_feature_course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $exam_slug = $myfunction->getProductExam($home_feature_course->product_id);
                $exam_name = $myfunction->getProductExamName($home_feature_course->product_id);
                $course_image=asset('storage/uploads/courses/noimage.jpeg');
                if($home_feature_course->image){
                    $course_image=asset('storage/uploads/courses/thumbs/'.$home_feature_course->image);
                }
                $exists = \Storage::disk(config('disk.get_course'))->exists('thumbs/'.$home_feature_course->image);
                if(!$exists){
                    $course_image=asset('storage/uploads/courses/noimage.jpeg');
        
                }
        
            ?>
                    <div class="col-sm-12 col-md-4 col-lg-4 courseCont">
        
        
                        <div class=" b-outline">
                            <a href="<?php echo e(route('front.corsCont', array('exam'=>$exam_slug,'slug' => $home_feature_course->slug))); ?>">
                                <div class="bodyContHead">
                            <div class="">
                                
                                <div class="course-title"><h2><?php echo e($home_feature_course->name); ?></h2>
                                <h4><?php echo e($exam_name); ?></h4></div>
                                <div class="course-img"><img src="<?php echo e($course_image); ?>" alt="<?php echo e($home_feature_course->img_alt); ?>"  /></div>
                                <div class="clear"></div>
                            </div>
                            <!-- <div class="course-img">
                                
                            </div> -->
                            
                                
                                <!-- <a href="#" class="seeall">See All</a>-->
                                </div>
        
        
                                <div class="outerleftsection">
                                    <h3>What you'll Get</h3>
                                    <div class="short-desc">                        
                                    <?php echo html_entity_decode($home_feature_course->short_description); ?>

                                    </div>
                                <?php if((floor($home_feature_course->price)==0)): ?>    
                                <div class="price ">
                                    Free
                                </div>
                                <?php else: ?>
                                <div class="price ">
                                    <?php if($home_feature_course->revised_price!=""): ?>
                                    <span>₹<?php echo e(number_format(floor($home_feature_course->price))); ?></span>
                                    <?php endif; ?>
                                    ₹<?php echo e(number_format(floor($home_feature_course->revised_price!=""?($home_feature_course->revised_price):$home_feature_course->price))); ?>

                                </div>
                                
                                <?php endif; ?>
                            </a>
                            <div class="row">
                                <div class="col-sm-6">
                                     <?php if(auth()->guard()->guest()): ?>
                                    <a href="" class="buynow buy-now-login" data-toggle="modal" data-productid="<?php echo e($home_feature_course->product_id); ?>" data-target=".login-modal">Enroll Now</a>
                                <?php endif; ?>
                                <?php if(auth()->guard()->check()): ?>
                                <form action="<?php echo e(route('billing')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($home_feature_course->product_id); ?>">
        
                                    
                                    <input type="submit" class="buynow" value="Enroll Now">
                                </form>    
                                <?php endif; ?>
                                    
                                </div>
                                <?php if($home_feature_course->no_of_students): ?>
                                    
                                <div class="col-sm-6 text-right">
                                    <i class="fa fa-users"></i> <?php echo e($home_feature_course->no_of_students); ?> Students
                                </div>
                                
                                <?php endif; ?>
                                
                            </div>
                        </div>
                            
                            
                        </div>
                    </div>
                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
            </div>
        </section>
   
        <?php endif; ?>
    
    

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script>
    
    $('.buy-now-login').click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="<?php echo e(route('visitor-buy-product')); ?>";
        let data={
            product_id:product_id
        }
        $.post(url,data,function(response){

        })
    })
    $('.login-modal').on('hidden.bs.modal', function () {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="<?php echo e(route('visitor-remove-buy-product')); ?>";
        $.post(url,function(response){

        })
    })

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/lastMinuteSuggestion.blade.php ENDPATH**/ ?>
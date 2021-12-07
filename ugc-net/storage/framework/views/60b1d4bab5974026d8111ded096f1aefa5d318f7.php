<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<?php echo $__env->make('frontend.includes.home_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>
<section class="iconsection">
    <div class="container">
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="<?php echo e(asset('public/frontend/images/courses_icon.png')); ?>" class="lefticon"  alt="Best Online Courses for CSIR-UGC NET/SET/JRF exam
                "/>
                <span>Best Online Courses</span>
                Explore a variety of fresh topics
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="<?php echo e(asset('public/frontend/images/instruction.png')); ?>" class="lefticon"  alt="Expert Instruction for CSIR-UGC NET/SET/JRF exam
                "/>
                <span>Expert Instruction</span>
                Find the right instructor for you
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="<?php echo e(asset('public/frontend/images/access.png')); ?>" class="lefticon"  alt="Lifetime access of all courses materials
                "/>
                <span>Lifetime Access</span>
                Learn on your schedule
            </div>
        </div>
    </div>
</section>

<section class="course-highlight">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            <a href="<?php echo e(url('ugc-nta-set-jrf-new')); ?>">
                    <div class="ugc-csir-courses">
                        <h4>UGC-NTA NET/SET/JRF</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo e(url('csir-net-set-jrf')); ?>">
                    <div class="ugc-csir-courses">
                        <h4>CSIR NET/SET/JRF</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>


<section class="homeBodyCont">

<?php if( isset($home_feature_courses) ): ?>
    <div class="container">
        <div class="row d-flex f-wrap">
        
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
    <?php if(count($preview_courses)>0): ?>
    <section class="previewSection" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="previewHead">
                        <h2>Preview Courses</h2>
                    </div>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = $preview_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview_course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php 
                    $exam_slug = $myfunction->getProductExam($preview_course->product_id);
                    $exam_name = $myfunction->getProductExamName($preview_course->product_id);

                ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="b-outline previewBox">
                            <a href="<?php echo e(route('front.corsCont', array('exam'=>$exam_slug,'slug' => $preview_course->slug))); ?>">
                            <div class="bodyContHead">
                                <h2><?php echo e($preview_course->name); ?></h2>
                                <h4><?php echo e($exam_name); ?></h4>
                            </div>
                            <div class="outerleftsection">
                                <h3>What you'll Get</h3>
                                <div class="short-desc preview-short-desc">                        
                                    <?php echo html_entity_decode($preview_course->short_description); ?>

                                </div>
                            </a>    
                            <?php if(auth()->guard()->guest()): ?>
                            <a href="" class="buynow buy-now-login" data-toggle="modal" data-productid="<?php echo e($preview_course->product_id); ?>" data-target=".login-modal">Preview Now</a>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('billing')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($preview_course->product_id); ?>">

                                
                                <input type="submit" class="buynow" value="Preview Now">
                            </form>    
                            <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Preview Course Coming soon.</p>
                <?php endif; ?>

                
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if(count($home_videos)>0): ?>
        
        <section class="videosection">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-xs-8">
                        <h2>Some Of Our Videos</h2>
                    
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <a href="#" class="seeall">See All</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            
                <div class="videoinner">
                    <div class="row">
                        <?php $__currentLoopData = $home_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $video_embed_link = $myfunction->parseYouTubeUrl($video->video_url);
                        ?>
                        <div class="col-sm-6 col-md-3">
                        
                            <div class="tabdiv">
                                <div class="tabtop">
                                    <iframe width="350" height="233" src="<?php echo e($protocol); ?>://www.youtube.com/embed/<?php echo $video_embed_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <h3><?php echo e($video->title); ?></h3>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="getupdate">
        <div class="container">
            <form  enctype="multipart/form-data" id="newsletter-form">
                <?php echo e(csrf_field()); ?>

                <h3>Get free Updates from Teachinns</h3>
                <h4>Please enter your email ID and hit the subscribe buttons to receives free updates</h4>
                <span class="p-relative">  
                <input type="text" class="subtext" id="email" name="email">
                <input type="submit" value="Subscribe" class="subbut">
                </span>
            </form>
            <h4 class="notification-msg"></h4>
        </div>
    </section>
    
        
    <?php if( isset($home_testimonial_text) ): ?>
    

    <section class="testimonials">
        <div class="container">

            <h2>Testimonials</h2>

            <section id="demos" class="outerslider">
                <div class="owl-carousel2">
                    <?php $__currentLoopData = $home_testimonial_text; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">

                        <div class="testibox">
                            <img src="<?php echo e(asset('public/frontend/images/invited.jpg')); ?>" class="inviterd" alt="" />
                            <p><?php echo e($ts_t->testimonial_text); ?></p>
                            <span><?php echo e($ts_t->student_name); ?></span>
                            <br>
                            <em><?php echo e($ts_t->student_course); ?></em>
                        </div>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    

                </div>

            </section>

        </div>
    </section>

    <?php endif; ?>
    
    <section class="contribute">
        <div class="container">
            <div class="innerbox">
                <div class="box border">
                    <div class="boxinner">
                        <h3>Become a Contributor</h3>
                        
                        <a href="#" class="login">Join as Contributor</a>
                    </div>
                </div>
                <div class="box">
                    <div class="boxinner1">
                        <h3>Become a Reseller</h3>
                        
                        <a href="#" class="login">Sign up as Reseller</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="display:none">
    <form action="<?php echo e(route('billing')); ?>" method="POST" id="billing-login">
        <?php echo csrf_field(); ?>
        <input type="hidden" value="" id="redirected_product">
        <input type="submit">
    </form>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script>
    $("#newsletter-form").validate({
      errorElement: 'span',
    //   errorPlacement: function (error, element) {
       
    //         error.insertAfter($("#newsletter-form"));
        
    //  },
      rules: {      
          
            email:{
              required: true,
              email: true,
              remote: {
                type: 'post',
                        url: "<?php echo e(url(route('newsletter-checkEmailExists'))); ?>",                                            
                        data: {
                              'email': function () { return $('#email').val(); },
                              "_token": "<?php echo e(csrf_token()); ?>"
                              }
              }  
          },
      },
      messages: {        
        email:{
              required: 'Email is required.',
              email: 'Please enter valid email.',
              remote:'You are already subscribe.'
          },
          
      },
      submitHandler: function (form) {
      event.preventDefault();
      //$(".subbut").prop("disabled", true);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let url="<?php echo e(route('insert-newsletter')); ?>";
        let data=$('#newsletter-form').serialize();
        $.post(url,data,function(response){
           //$(".subbut").prop("disabled", false);
         
          if(response){
            
              let noti_text="Thanks for subscription."  
              $('.notification-msg').text(noti_text);   
          }else{
              let noti_text="Some thing went wrong."  
              $('.notification-msg').text(noti_text);
          }
        })          
      
      }
        
    });

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
  

<?php if(isset($banner) && $banner->status==1): ?>
    
<div class="modal fade ad_modal modal-pop">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body ad_image">

            <div class="close_icon">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo e(asset('public/frontend/images/cross_icon.png')); ?>" alt="close"></button>
            </div>
            <div class="outerleftsection">
                <?php if($banner->title): ?>
                <div class="modal-title">
                    <h2 ><?php echo e($banner->title); ?></h2>

                </div>
                <?php endif; ?>
                <?php if($banner->description): ?>
                <?php echo html_entity_decode($banner->description); ?>

                <?php endif; ?>
            </div> 
            <div class="popupImg">
                <?php if($banner->image): ?>
                <img src="<?php echo e(asset('storage/uploads/banner/'.$banner->image)); ?>" alt="<?php echo e($banner->title); ?>" style="width: 100%">
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
</div> 
<script src="<?php echo e(asset('public/frontend/js/jquery.cookie.js')); ?>"></script>
<script>
    $(document).ready(function () {
        if ($.cookie('pop') == null) {
         $('.ad_modal').modal('show');
         $.cookie('pop', '1');
        }

        // Check if user saw the modal
        // var key = 'hadModal',
        //     //hadModal = localStorage.getItem(key);
        //     hadModal =Cookies.get(key)
        //     // Show the modal only if new user
        //     if (!hadModal) {
        //         $('.ad_modal').modal('show');
        //     }
            
        //     // If modal is displayed, store that in localStorage
        //     $('.ad_modal').on('shown.bs.modal', function () {
        //         //localStorage.setItem(key, true);
        //         hadModal=$.cookie(key,1);
        // })
        

        setTimeout(function () {
            $('.ad_modal').modal('hide');
        }, 40000);
    });
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugcnet/resources/views/frontend/home.blade.php ENDPATH**/ ?>
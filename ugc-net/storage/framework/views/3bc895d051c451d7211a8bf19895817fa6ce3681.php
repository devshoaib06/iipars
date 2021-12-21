<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();
    
    ?>
<!-- <section class="innerbanner">
        <img src="<?php echo e(asset('public/frontend/images/shortbanner.jpg')); ?>" alt="Crack the CSIR-UGC NET/SET/JRF exam with our online course material
    ">
    </section> -->
<section class="inner-header divider parallax layer-overlay1 overlay-white-8"
    style="background-image: url(<?php echo e(asset('public/frontend/images/shortbanner.jpg')); ?>); background-repeat: no-repeat; background-size: 100%; background-position: 0 0; height:200px">

    <div class="container pt-30 pb-30">

        <!-- Section Content -->

        <div class="section-content">



        </div>

    </div>

</section>

<!-- Section: Breadcrumb  -->
<section class="breadcamp">
    <div class="container">
        <ul>
            <li><a href="<?php echo e(config('path.iipars_base_url')); ?>">Home</a></li>
            <li class="active text-theme-colored"><?php echo e($course_details_page->name); ?></li>
        </ul>
    </div>
</section>

<!-- start Section: Content -->
<section class="section-content__innerpage">
    <form action="<?php echo e(route('billing')); ?>" method="post">
        <div class="container ">
            <div class="row d-flex">

                <div class="col-sm-8">

                    <div class="row" style="margin-bottom:30px">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($course_details_page->product_id); ?>">
                        <div class="col-sm-8">
                            <h1><?php echo e($course_details_page->name); ?> </h1>
                            <h2>
                                <?php $exam_name = $myfunction->getProductExamName($course_details_page->product_id);
                                ?>
                            </h2>
                            <div class="caption">
                                <div class="subcource">
                                    <ul>
                                        <?php
                                        $meta_keys = explode(',', $course_details_page->meta_key);
                                        $meta_keys = array_filter($meta_keys);
                                        
                                        ?>
                                        <?php $__currentLoopData = $meta_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('front.corstagList', ['slug' => $info])); ?>">
                                            <li><?php echo e($info); ?></li>
                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4 text-right">
                            <!-- <h2 style="padding:0 0 0;">Course Fees</h2> -->

                            <?php if(floor($course_details_page->price) == 0): ?>
                            <div class="rightprice " style="padding:0 0 10px">
                                Free
                            </div>
                            <?php else: ?>
                            <div class="rightprice" style="padding:0 0 10px">
                                <?php if(isset($course_details_page->revised_price)): ?>
                                <span>₹<?php echo e(number_format(floor($course_details_page->price))); ?></span>
                                <?php endif; ?>
                                ₹<?php echo e(number_format(floor($course_details_page->revised_price != '' ? $course_details_page->revised_price : $course_details_page->price))); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(floor($course_details_page->price) == 0): ?>
                                    <input type="submit" class="buynow btn btn-success enrollbtn"
                                        value="Preview Now">
                                <?php else: ?>
                                    <input type="submit" class="buynow btn btn-success enrollbtn"
                                    value="Enroll Now">
                                    
                                <?php endif; ?>

                            <?php endif; ?>
                            
                            <?php if(auth()->guard()->guest()): ?>
                                <?php if(floor($course_details_page->price) == 0): ?>
                                    <a href="#" class="buynow btn btn-success buy-now-login" data-toggle="modal"
                                    data-productid="<?php echo e($course_details_page->product_id); ?>"
                                    data-target=".login-modal">Preview Now</a>
                                <?php else: ?>
                                    <a ref="#" class="buynow btn btn-success buy-now-login" data-toggle="modal"
                                    data-productid="<?php echo e($course_details_page->product_id); ?>"
                                    data-target=".login-modal">Enroll Now</a>
                                <?php endif; ?>
                                


                            <?php endif; ?>

                            
                        </div>
                    </div>


                    <?php echo html_entity_decode($course_details_page->intro_text); ?>


                    
                    <hr>

                    <h3>What you'll Get</h3>
                    <div class="highlightsection">

                        <?php $__currentLoopData = $related_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper => $materials): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $myFuntion = new \App\library\myFunctions();
                            $paper_info = @$myFuntion->getPaperName($paper);
                           
                            ?>
                        <h4><?php echo e($paper_info->paper_name); ?> </h4>
                       
                        <?php if(count($materials) > 0): ?>
                        <?php
                            $exam_paper_units=@$myFuntion->getPaperSubject($course_details_page->product_id,$paper_info->id);
                            
                        ?>
                        <ul>
                            <?php $__currentLoopData = $exam_paper_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_paper_unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($exam_paper_unit->subject)): ?>
                                <li><?php echo e(@$exam_paper_unit->subject->subject_name); ?> </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>    
                       
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                        $material_name = @$myFuntion->getMaterialName($material);
                                        ?>
                            <p><?php echo e($material_name); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php endif; ?>
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php echo html_entity_decode($course_details_page->description); ?>


                    <hr>
                    <h3>Important Dates</h3>
                    <?php echo html_entity_decode($course_details_page->important_notice); ?>







                </div>
                <div class="col-sm-4">
                    <div class="rightvideo">
                        <div class="tabdiv">

                            <?php
                            $course_image = asset('storage/uploads/courses/61b208e45490c.jpg');
                            if ($course_details_page->image) {
                                $course_image = asset('storage/uploads/courses/' . $course_details_page->image);
                            }
                            ?>
                            <div class="tabtop">
                                <img src="<?php echo e($course_image); ?>"
                                    alt="<?php echo e($exam_name); ?> <?php echo e($course_details_page->name); ?> 2020 ">
                            </div>

                            <div class="rating" style="display:none"><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                    aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star-half-o" aria-hidden="true"></i> 4.7 (7,373)
                            </div>
                            <div class="sublist">
                                <h2>This course includes</h2>
                                <?php echo html_entity_decode($course_details_page->short_description); ?>

                            </div>
                            <?php if(floor($course_details_page->price) == 0): ?>
                            <div class="rightprice ">
                                Free
                            </div>
                            <?php else: ?>
                            <div class="rightprice">
                                <?php if(isset($course_details_page->revised_price)): ?>
                                <span>₹<?php echo e(number_format(floor($course_details_page->price))); ?></span>
                                <?php endif; ?>
                                ₹<?php echo e(number_format(floor($course_details_page->revised_price != '' ? $course_details_page->revised_price : $course_details_page->price))); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                
                                <?php if(floor($course_details_page->price) == 0): ?>
                                <input type="submit" class="buynow btn btn-success enrollbtn"
                                        value="Preview Now">
                                <?php else: ?>
                                <input type="submit" class="buynow btn btn-success enrollbtn"
                                value="Enroll Now">
                                    
                                <?php endif; ?>    
                            <?php endif; ?>
                            
                            <?php if(auth()->guard()->guest()): ?>
                            

                                <?php if(floor($course_details_page->price) == 0): ?>
                                    <a href="#" class="buynow btn btn-success buy-now-login" data-toggle="modal"
                                    data-productid="<?php echo e($course_details_page->product_id); ?>"
                                    data-target=".login-modal">Preview Now</a>
                                <?php else: ?>
                                    <a href="#" class="buynow btn btn-success buy-now-login" data-toggle="modal"
                                    data-productid="<?php echo e($course_details_page->product_id); ?>"
                                    data-target=".login-modal">Enroll Now</a>
                                    
                                <?php endif; ?>
                            <?php endif; ?>
                           
                            

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </form>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script>
    $('.buy-now-login').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = $(this).data('productid')
        let url = "<?php echo e(route('visitor-buy-product')); ?>";
        let data = {
            product_id: product_id
        }
        $.post(url, data, function (response) {

        })
    })
    $('.login-modal').on('hidden.bs.modal', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = $(this).data('productid')
        let url = "<?php echo e(route('visitor-remove-buy-product')); ?>";
        $.post(url, function (response) {

        })
    })

</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/course/iiparsdetails.blade.php ENDPATH**/ ?>
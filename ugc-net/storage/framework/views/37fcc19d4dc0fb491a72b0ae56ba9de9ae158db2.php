<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>

<?php $__env->startSection('page_content'); ?>
    <section class="inner-header divider parallax1 layer-overlay1 overlay-white-8"
        style="background-image: url(<?php echo e(asset('public/frontend/images/shortbanner.jpg')); ?>); background-repeat: no-repeat; background-size: 100%; background-position: 0 0; height:200px">

        <div class="container pt-30 pb-30">

            <!-- Section Content -->

            <div class="section-content">



            </div>

        </div>

    </section>
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(config('path.iipars_base_url')); ?>">Home</a></li>
                <li class="active text-theme-colored">UGC - NET </li>
            </ul>
        </div>
    </section>
    <section class="section-content__innerpage">
        <div class="container ">



            <h1>UGC NET</h1>

            <div class="row d-flex flex-wrap">
                <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-md-4 ">
                        <div class="course-details"><img alt=""
                                src="<?php echo e(url('public/frontend/images')); ?>/ugc_net_images/<?php echo e($paper->paper_name); ?>.jpg"
                                style="height:220px; width:100%">
                            <div class="details-overlay">
                                <h3 class="text-white"><?php echo e($paper->paper_name); ?></h3>

                                
                            </div>
                        </div>
                        <div class="papper-unit">
                            <ul>
                                <?php
                                    $units = $myfunction->getPaperUnits(1, $paper->id);
                                    $allCourses=$myfunction->getCourses(1,$paper->id);
                                ?>
                                <?php $__currentLoopData = $allCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($course->product)): ?>
                                <li>
                                    <a href="<?= url('/') ?>/course/<?= $course->product->slug ?>">
                                        <?php echo e($course->product->name); ?>

                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
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

                email: {
                    required: true,
                    email: true,
                    remote: {
                        type: 'post',
                        url: "<?php echo e(url(route('newsletter-checkEmailExists'))); ?>",
                        data: {
                            'email': function() {
                                return $('#email').val();
                            },
                            "_token": "<?php echo e(csrf_token()); ?>"
                        }
                    }
                },
            },
            messages: {
                email: {
                    required: 'Email is required.',
                    email: 'Please enter valid email.',
                    remote: 'You are already subscribe.'
                },

            },
            submitHandler: function(form) {
                event.preventDefault();
                //$(".subbut").prop("disabled", true);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = "<?php echo e(route('insert-newsletter')); ?>";
                let data = $('#newsletter-form').serialize();
                $.post(url, data, function(response) {
                    //$(".subbut").prop("disabled", false);

                    if (response) {

                        let noti_text = "Thanks for subscription."
                        $('.notification-msg').text(noti_text);
                    } else {
                        let noti_text = "Some thing went wrong."
                        $('.notification-msg').text(noti_text);
                    }
                })

            }

        });

        $('.buy-now-login').click(function() {
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
            $.post(url, data, function(response) {

            })
        })
        $('.login-modal').on('hidden.bs.modal', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let product_id = $(this).data('productid')
            let url = "<?php echo e(route('visitor-remove-buy-product')); ?>";
            $.post(url, function(response) {

            })
        })
    </script>


    <?php if(isset($banner) && $banner->status == 1): ?>

        <div class="modal fade ad_modal modal-pop">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body ad_image">

                        <div class="close_icon">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img
                                    src="<?php echo e(asset('public/frontend/images/cross_icon.png')); ?>" alt="close"></button>
                        </div>
                        <div class="outerleftsection">
                            <?php if($banner->title): ?>
                                <div class="modal-title">
                                    <h2><?php echo e($banner->title); ?></h2>

                                </div>
                            <?php endif; ?>
                            <?php if($banner->description): ?>
                                <?php echo html_entity_decode($banner->description); ?>

                            <?php endif; ?>
                        </div>
                        <div class="popupImg">
                            <?php if($banner->image): ?>
                                <img src="<?php echo e(asset('storage/uploads/banner/' . $banner->image)); ?>"
                                    alt="<?php echo e($banner->title); ?>" style="width: 100%">
                            <?php endif; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo e(asset('public/frontend/js/jquery.cookie.js')); ?>"></script>
        <script>
            $(document).ready(function() {
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


                setTimeout(function() {
                    $('.ad_modal').modal('hide');
                }, 40000);
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/ugc-net/home.blade.php ENDPATH**/ ?>
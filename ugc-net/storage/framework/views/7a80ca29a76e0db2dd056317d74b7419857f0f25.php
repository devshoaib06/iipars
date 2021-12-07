<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<?php echo $__env->make('frontend.includes.home_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <h1>Contact Us</h1>
                <p>Fill out the form below and we will be in touch as soon as possible.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 contactWrap">
                    <div class="contactLeft">
                        <form id="contact-form" method="POST" action="<?php echo e(route('contactAction')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if(Session::has('message')): ?>
                                <div class="<?php echo e(Session::get('messageClass')); ?>">
                                    <button class="close" data-close="alert"></button>
                                    <span><?php echo e(Session::get('message')); ?> </span>
                                </div>
                                <?php endif; ?>


                                <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cname" placeholder="Name" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                               
                                                <span id="errNm1"></span>
                                                <?php echo NoCaptcha::renderJs(); ?>

                                                <?php echo NoCaptcha::display(); ?>

                            </div>
                            <div class="form-group">
                                <input type="submit" id="contact" value="SUBMIT QUERY" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="contactRight">
                        <h3>Get in touch with us</h3>
                        <ul class="contactInfo">
                            
                            <li><span>Email:</span> <a href="mailto:<?php echo e(trim(getSettings('enquiry_email'))); ?>" class="contact-link"><?php echo e(trim(getSettings('enquiry_email'))); ?></a></li>
                            <li><span>Phone:</span> 
                                <a href="tel:<?php echo e(trim(getSettings('phone'))); ?>" class="contact-link"><?php echo e(trim(getSettings('phone'))); ?></a> <br>
                                <a href="tel:<?php echo e(trim(getSettings('phone-2'))); ?>" class="contact-link"><?php echo e(trim(getSettings('phone-2'))); ?></a>
                            </li>
                        </ul>
                        

            
                    </div>

                </div>


            </div>


        </div>
    </section>
        

</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script type="text/javascript">
        var FormValidation = function () {
        var handleValidation = function() {
        var form1 = $('#contact-form');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                                cname: {
                                    required: true
                                },
                                email:{
                                    required:true,
                                    email:true
                                },
                                phone:{
                                    required:true
                                },
                                subject:{
                                    required:true
                                },
                                message:{
                                    required:true
                                },
                                "g-recaptcha-response":{
                                    required:true
                                },
                                
                        },
                        messages: {                                
                                npassword: {
                                    required: ' Please provide password',

                                },
                                repassword:{
                                    equalTo: "Retype password must be same as password"
                                }

                        },
                        invalidHandler: function (event, validator) { //display error alert on form submit              
                        success1.hide();
                                error1.show();
                                //App.scrollTo(error1, - 200);
                        },
                        highlight: function (element) { // hightlight error inputs
                        $(element)
                                .closest('.form-group').addClass('has-error'); // set error class to the control group
                        },
                        unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                                .closest('.form-group').removeClass('has-error'); // set error class to the control group
                        },
                        success: function (label) {
                        label
                                .closest('.form-group').removeClass('has-error'); // set success class to the control group
                        },
                        submitHandler: function (form) {
                        //success1.show();
                        error1.hide();
                                form.submit(); // form validation success, call ajax form submit
                        }
                });
        }

        return {

        init: function () {


        handleValidation();
        }

        };
        }();
        
        jQuery(document).ready(function() {
           FormValidation.init();
        });
        </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/contactus.blade.php ENDPATH**/ ?>
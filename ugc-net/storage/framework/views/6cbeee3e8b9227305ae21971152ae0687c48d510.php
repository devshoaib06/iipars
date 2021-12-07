<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
     <section class="breadcamp">
            <div class="container">
                <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li>Registration</li>
                </ul>
            </div>
        </section>
        <section class="innerpage">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">

                        <h1>Signup for Registration</h1>
                        <div class="formsignup" >
                            
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
                            <form id="register-form" action="<?php echo e(route('signupAction')); ?>" method="POST">
                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control"  value="<?php echo e(old('first_name')); ?>"/>
                                            <?php if($errors->has('first_name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                           <input type="text" name="last_name" class="form-control" value="<?php echo e(old('last_name')); ?>"/>
                                            <?php if($errors->has('last_name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo e(old('email')); ?>" id="uemail"/>
                                            <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="contactnumber" class="form-control" value="<?php echo e(old('contactnumber')); ?>" id="contactnumber"/>
                                            <?php if($errors->has('contactnumber')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('contactnumber')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" id="upassword" name="password" class="form-control" />
                                            <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input type="password" class="form-control" id="reset_password" name="reset_password" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ReCaptcha">Recaptcha:</label>
                                                <span id="errNm1"></span>
                                                <?php echo NoCaptcha::renderJs(); ?>

                                                <?php echo NoCaptcha::display(); ?>

                                        </div>
                                    </div>
                                </div>
                            <p style="margin-top:15px;">By creating an account you agree to our <a href="<?php echo e(url('/terms-condition')); ?>" target="blank">Terms & Conditions.</a></p>
                                <button type="submit" class="submitbut">Sign Up</button>
                                <div class="clearfix"></div>
                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </section>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
        var FormValidation = function () {
        var handleValidation = function() {
        var form1 = $('#register-form');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        // errorPlacement: function(error, element) {
                        //     //Custom position: first name
                        //     if (element.attr("name") == "g-recaptcha-response" ) {
                        //         $("#errNm1").text(error);
                        //     }
                        //     // //Custom position: second name
                        //     // else if (element.attr("name") == "second" ) {
                        //     //     $("#errNm2").text(error);
                        //     // }
                        //     // // Default position: if no match is met (other fields)
                        //     // else {
                        //     //     error.append($('.errorTxt span'));
                        //     // }
                        // },
                        rules: {
                                first_name: {
                                required: true
                                },
                                last_name: {
                                required: true
                                },
                                username:{
                                required: true
                                },
                                "g-recaptcha-response":{
                                    required:true
                                },
                                email: {
                                required: true,
                                        email: true,
                                        remote: {
                                        type: 'post',
                                                url: '<?php echo e(url(config("constants.admin_prefix")."/"."email-exist")); ?>',
                                                data: {
                                                'email': function () { return $('#uemail').val(); },
                                                "_token": "<?php echo e(csrf_token()); ?>"
                                                }
                                        }
                                },
                                country: {
                                    required: true
                                },
                                address: {
                                    required: true
                                },
                                contactnumber:{
                                    required: true,
                                },
                                password: {
                                    required: true,
                                    minlength: 5
                                },
                                reset_password: {
                                  required: true,
                                  minlength: 5,
                                  equalTo: "#upassword"
                                }
                                
                        },
                        messages: {
                                first_name: {
                                    required: 'First Name is required.'
                                },
                                
                                last_name: {
                                    required: 'Last Name is required.'
                                },
                                contactnumber: {
                                    required: 'Please provide phone number'
                                },
                                email: {
                                required: 'Please provide email',
                                        email:'Please provide proper email address',
                                        remote:'The email is already in use'
                                },
                                password: {
                                    required: ' Please provide password',

                                },
                                reset_password:{
                                    equalTo:"Repeat password must be same as password"
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
        $("#form_sample_1").submit(function(){
});</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/auth/register.blade.php ENDPATH**/ ?>
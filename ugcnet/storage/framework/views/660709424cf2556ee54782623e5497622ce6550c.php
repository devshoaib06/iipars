<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<?php echo $__env->make('frontend.includes.home_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2">
                    <div class="contributorCont">
                        <?php if(Session::has('message')): ?>                         
                        <div class="<?php echo e(Session::get('messageClass')); ?>">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo e(Session::get('message')); ?> </span>
                        </div>
                        <?php endif; ?> 
                        <div class="contributorHead">
                            <h4>Forgot Password</h4>
                            
                        </div>
                        <form action="<?php echo e(route('forget_password_action')); ?>" id="contributorlogin" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input type="email" class="form-control" name="femail" id="email" placeholder="Enter Email">
                                
                            </div> 
                            <input type="submit" id="contributorLogin" value="Send">
                        </form>
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
        var form1 = $('#contributorlogin');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                            femail:{
                                    required:true,
                                    email:true,
                                    remote: {
                                    type: 'post',
                                            url: "<?php echo e(url(route('check_useremail'))); ?>",                                            
                                            data: {
                                                    'femail': function () { return $('#email').val(); },
                                                    "_token": "<?php echo e(csrf_token()); ?>"
                                                    }
                                    }  
                                }
                        },
                        messages: {                                
                            femail:{
                                required: 'Email is required.',
                                email: 'Please enter valid email.',
                                remote:'Sorry! this email-id not registered.'
                            },

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
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/reseller/auth/forgot-password.blade.php ENDPATH**/ ?>
<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
     <section class="breadcamp">
            <div class="container">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </section>

        <section class="innerpage">
            <div class="container">
              <form id="billing" action=<?php echo e(route('billingAction')); ?> enctype="multipart/form-data" method="POST" >
                 <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                        <div class="formsignup">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Billing details</h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <span class="star">*</span></label>
                                            <input type="text" name="first_name" value="<?php echo e(Auth::check()?$userinfo->firstname:''); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="star">*</span></label>
                                                <input type="text" name="last_name" value="<?php echo e(Auth::check()?$userinfo->lastname:''); ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Phone <span class="star">*</span></label>
                                                <input type="text" name="phone" value="<?php echo e(Auth::check()?$userinfo->contactnumber:''); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Email address <span class="star">*</span></label>
                                                <input type="text" name="email" value="<?php echo e(Auth::check()?$userinfo->email:''); ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: none">
                                        <h3>Shipping Address</h3>
                                            <div class="row" >
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Street address  <span class="star">*</span></label>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <input type="text" name="street_address_1" value="<?php echo e(!empty($lastbillinfo)?$lastbillinfo->street_address_1:''); ?>" class="form-control">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="street_address_2" value="<?php echo e(!empty($lastbillinfo)?$lastbillinfo->street_address_2:''); ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Town / City <span class="star">*</span></label>
                                                        <input type="text" name="city" value="<?php echo e(!empty($lastbillinfo)?$lastbillinfo->city:''); ?>"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>State <span class="star">*</span></label>
                                                        <select class="form-control" name="state" >
                                                            <option value="">Select</option>
                                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($state->state_id); ?>" 
                                                                <?php echo e(!empty($lastbillinfo)?$lastbillinfo->state==$state->state_id?'selected':'':''); ?>><?php echo e($state->state_name); ?></option>                                                        
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
            
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Postcode / ZIP <span class="star">*</span></label>
                                                    <input type="text" name="zip" value="<?php echo e(!empty($lastbillinfo)?$lastbillinfo->zip:''); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    </div>

                                </div>
                                <div class="col-sm-12">

                                    <h3>Your order</h3>
                                    
                                    <div class="table-responsive1">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Course</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo e($products->name); ?>&nbsp; <strong>× 1</strong> </td>
                
                                                    <td>  ₹<span><?php echo e(number_format((float)$price, 2, '.', '')); ?></span>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>  ₹<span class="subtotal"><?php echo e(number_format((float)$price, 2, '.', '')); ?></span>
                                                    </td>
                                                </tr>
                                                <?php if(isset($cb_amount) && $cb_amount!="" ): ?>
                                                <tr>
                                                    <td>
                                                        Cashback </td>
                                                    <td> - ₹<span><?php echo e(number_format((float)$cb_amount, 2, '.', '')); ?></span>
                                                    </td>
                                                </tr>
                                                    
                                                <?php endif; ?>
                                                <tr class="discount-section"></tr>
                                                <tr class="cashback-section"></tr>

                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong>₹<span class="totalprice"><?php echo e(number_format((float)$total_after_cashback, 2, '.', '')); ?><span></strong> </td>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    <input type="hidden" name="product_id" value="<?php echo e($products->product_id); ?>">
                                    <input type="hidden" name="subtotal"  value="<?php echo e($total_after_cashback); ?>">
                                    <input type="hidden" name="discount_amount" id="discount_amount"  value="">
                                    <input type="hidden" name="grand_total" id="grand_total"  value="<?php echo e($total_after_cashback); ?>">
                                    <input type="hidden" name="cb_amount" id="cb_amount"  value="<?php echo e($cb_amount); ?>">
                                    </div>
                                    
                                    <?php if($products->is_reseller_charge): ?>
                                    <h4>Reseller Code</h4>
                                    
                                    <div class="codetext">
                                         If you have a Reseller code, please apply.
                                    </div>
                                   
                                    <div class="resellercode coupancode">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                <input type="text" class="form-control" name ="reseller_code" value="<?php echo e($reseller_code!=''?$reseller_code:''); ?>" placeholder="Reseller Code" id="reseller_code">
                                                <span class="resellercode-success"></span>
                                                <span class="resellercode-error"></span>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group"><button type="button" class="reseller-code-btn submitbut"><?php echo e($reseller_code!=''?'Applied':'Apply'); ?></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <h4>Credit Card/Debit Card/NetBanking</h4>
                                    <img src="<?php echo e(asset('public/frontend/images/payment.png')); ?>">
                                    <div class="codetext">
                                        Pay securely by Credit or Debit card or Internet Banking through Razorpay.
                                    </div>

                                <p class="shorttext">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="<?php echo e(url('/privacy-policy')); ?>">privacy policy.</a></p>
                                   <button type="submit" class="paybut" >Place Order</button>
                                    
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> 
                                        <span class="error-class"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
              </form>
            </div>
        </section>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $('.coupon-btn').click(function(){
        let coupon_code=$('#couponcode').val();
        let url="<?php echo e(route('ajaxCheckCoupon')); ?>";
        let data={
            coupon_code:coupon_code,
            _token:"<?php echo e(csrf_token()); ?>",
            subtotal:$('.totalprice').text()
        };
        debugger
        //$('.totalprice').html('');
        $('.couponcode-error').html('');
        if($('.discount-section').html()==""){

            $.post(url,data,function(response){
                let dishtml='';   
                                
                if(response.statusCode=="1"){
                    dishtml+='<th>Discount</th>';
                    dishtml+='<td>-₹<span class="">'+response.discount+'</span></td>';
                    $('.discount-section').html(dishtml);
                    $('.totalprice').html(response.discount_price);
                    $('#discount_amount').val(response.discount);
                    $('#grand_total').val(response.discount_price);
                }
                else{
                    $('.couponcode-error').html(response.errorMessage);
                }
            });
        }
    })
    $('.reseller-code-btn').click(function(){
        let reseller_code=$('#reseller_code').val();
        let url="<?php echo e(route('ajaxResellerCode')); ?>";
        let data={
            reseller_code:reseller_code,
            _token:"<?php echo e(csrf_token()); ?>",
            subtotal:$('.totalprice').text()
        };
        
        //$('.totalprice').html('');
        $('.resellercode-error').html('');
        $('.resellercode-success').html('');
        if($('.cashback-section').html()==""){

            $.post(url,data,function(response){
                let dishtml='';   
                if(response.statusCode=="1"){
                    $('.resellercode-success').html(response.message); 
                    dishtml+='<th>Cashback</th>';
                    dishtml+='<td>-₹<span class="cashback_price">'+response.discount+'</span></td>';
                    $('.cashback-section').html(dishtml);
                    $('.totalprice').html(response.discount_price);
                    $('#cb_amount').val(response.discount);
                    $('#grand_total').val(response.discount_price);
                }
                else{
                    $('.resellercode-error').html(response.message);
                }
            });
        }
    })
</script>
<script>
    var personal_info_validation = function () {
        var handleValidation = function() {
                var form1 = $('#billing');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                 $('.resellercode-success').html('');

                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                            first_name: {
                                required: true
                            },
                            last_name: {
                                required: true
                            },
                            country: {
                                //required: true
                            },
                            reseller_code:{
                                remote: {
                                    type: 'post',
                                        url: '<?php echo e(route("ajaxResellerCodeExists")); ?>',
                                        data: {
                                        'reseller_code': function () { return $('#reseller_code').val(); },
                                        "_token": "<?php echo e(csrf_token()); ?>"
                                     }
                                }
                            },
                            phone: {
                                required: true
                            },
                            city: {
                                //required: true
                            },
                            street_address_1: {
                                //required: true
                            },
                            state:{
                                //required: true

                            },
                            zip: {
                                //required: true
                            },
                            email: {
                                required: true,
                                email: true,
                            },
                            
                            
                        },
                        messages: {
                        /*select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be "selected"")
                        }*/
                        
                            name: {
                                required: 'Name is required.'
                            },
                            
                            
                            email: {
                                required: 'Please provide email',
                                        email:'Please provide proper email address',
                                        remote:'The email is already in use'
                            },
                            reseller_code:{
                                remote: 'Invalid Code / Code Expired'  

                            }
                            
                            
                            
                            
                        },
                        invalidHandler: function (event, validator) { //display error alert on form submit              
                            success1.hide();
                            error1.show();
                            var errors = validator.numberOfInvalids();
                            if (errors) {                    
                                validator.errorList[0].element.focus();
                            }
                           // App.scrollTo(error1, - 200);
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
                            $('.paybut').prop('disabled',true);
                            $('.paybut').html("<i class='fa fa-spinner fa-spin'></i>");
                            error1.hide();
                            //form.submit(); // form validation success, call ajax form submit

                            let reseller_code=$('#reseller_code').val();

                            if($("span").hasClass('cashback_price')){
                                
                            if(reseller_code==""){
                                
                                let totalprice=$('.totalprice').text();
                                var cashback_price=$('.cashback_price').text();
                                totalprice=parseInt(totalprice)+parseInt(cashback_price);
                                $('.totalprice').text(totalprice);
                                $('#grand_total').val(totalprice);
                                $('#cb_amount').val('');
                                $('.cashback-section').html('');
                            }
                            }
                            let url="<?php echo e(route('billingAction')); ?>"
                            let data=form1.serialize();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }

                            });
                            $.post(url,data,function(response){
                                
                                var first_name=$('input[name=first_name]').val();
                                var last_name=$('input[name=last_name]').val();
                                var email=$('input[name=email]').val();
                                var phone=$('input[name=phone]').val();
                                $('.paybut').prop('disabled',false);
                                $('.paybut').html("Place Order");
                                if(response.status=="success"){
                                    let redirect_url=response.url;
                                    var options = {
                                        "key": response.api_key, // Enter the Key ID generated from the Dashboard
                                        "amount": response.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
                                        "currency": "INR",
                                        "name": "Teachinns",
                                        //"description": "A simple test script",
                                        "image": "https://teachinns.com/public/frontend/images/logo.png",
                                        "order_id": response.order_id,//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
                                        "handler": paymentSuccessHandler,
                                        "prefill": {
                                            "name": first_name +" "+last_name,
                                            "email": email,
                                            "contact": phone
                                        },
                                        "notes": {
                                            "address": ""
                                        },
                                        "theme": {
                                            "color": "#2270b5"
                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                    rzp1.open();
                                    //window.location.replace(redirect_url);
                                }
                                else if(response.status==0){
                                    $('.alert-danger').show();
                                    $('.error-class').html(response.errorMessage)
                                }
                            })
                        }
                });
        }

        return {
        //main function to initiate the module
        init: function () {


        handleValidation();
        }

        };
    }();
    jQuery(document).ready(function() {
		personal_info_validation.init();
		
	});
    function paymentSuccessHandler(transaction) {
        $('.paybut').prop('disabled',true);
        $('.paybut').html("<i class='fa fa-spinner fa-spin'></i>");
        $.ajax({
            method: 'post',
            url: "<?php echo route('payment-success'); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "razorpay_payment_id": transaction.razorpay_payment_id,
                "razorpay_order_id": transaction.razorpay_order_id,
                "transaction_info":transaction
            },
            complete: function (r) {
                console.log('complete');
                console.log(r);
                
            },
            success:function(response){
                $('.paybut').prop('disabled',false);
                $('.paybut').html("Place Order");
                if(response.status=="success"){
                    let redirect_url=response.url;
                    window.location.replace(redirect_url);
                }
            }
        })
    }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/course/billing/billing.blade.php ENDPATH**/ ?>
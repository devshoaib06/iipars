@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
     <section class="breadcamp">
            <div class="container">
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </section>

        <section class="innerpage">
            <div class="container">
              <form id="billing" action={{route('billingAction')}} enctype="multipart/form-data" method="POST" >
                 @csrf
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
                                            <input type="text" name="first_name" value="{{Auth::check()?$userinfo->firstname:''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="star">*</span></label>
                                                <input type="text" name="last_name" value="{{Auth::check()?$userinfo->lastname:''}}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Phone <span class="star">*</span></label>
                                                <input type="text" name="phone" value="{{Auth::check()?$userinfo->contactnumber:''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Email address <span class="star">*</span></label>
                                                <input type="text" name="email" value="{{Auth::check()?$userinfo->email:''}}" class="form-control">
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
                                                                <input type="text" name="street_address_1" value="{{!empty($lastbillinfo)?$lastbillinfo->street_address_1:''}}" class="form-control">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="street_address_2" value="{{!empty($lastbillinfo)?$lastbillinfo->street_address_2:''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Town / City <span class="star">*</span></label>
                                                        <input type="text" name="city" value="{{!empty($lastbillinfo)?$lastbillinfo->city:''}}"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>State <span class="star">*</span></label>
                                                        <select class="form-control" name="state" >
                                                            <option value="">Select</option>
                                                            @foreach ($states as $state)
                                                            <option value="{{$state->state_id}}" 
                                                                {{!empty($lastbillinfo)?$lastbillinfo->state==$state->state_id?'selected':'':''}}>{{$state->state_name}}</option>                                                        
                                                            @endforeach
                                                        </select>
            
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Postcode / ZIP <span class="star">*</span></label>
                                                    <input type="text" name="zip" value="{{!empty($lastbillinfo)?$lastbillinfo->zip:''}}" class="form-control">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Order notes (optional)</label>
                                                        <textarea class="form-control" name="order_notes"></textarea>
                                                    </div>
                                                </div> --}}
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
                                                        {{$products->name}}&nbsp; <strong>× 1</strong> </td>
                
                                                    <td>  ₹<span>{{number_format((float)$price, 2, '.', '')}}</span>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            
                                            <tfoot>
                                            @if ($price!=$revised_price)
                                                @if ($discount_amount!=0)
                                                <tr>
                                                    <td>
                                                        Discount&nbsp; <strong>({{ $discount_percentage }}%)</strong> </td>
                
                                                    <td>  ₹<span>{{number_format((float)$discount_amount, 2, '.', '')}}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($extra_discount!=0)
                                                <tr>
                                                    <td>
                                                        <strong>Extra Discount</strong> </td>
                
                                                    <td>  ₹<span>{{number_format((float)$extra_discount, 2, '.', '')}}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endif
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>  ₹<span class="subtotal">{{number_format((float)$revised_price, 2, '.', '')}}</span>
                                                    </td>
                                                </tr>
                                                @if (isset($cb_amount) && $cb_amount!="" )
                                                <tr>
                                                    <td>
                                                        Cashback </td>
                                                    <td> - ₹<span>{{number_format((float)$cb_amount, 2, '.', '')}}</span>
                                                    </td>
                                                </tr>
                                                    
                                                @endif
                                                <tr class="discount-section"></tr>
                                                <tr class="cashback-section"></tr>

                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong>₹<span class="totalprice">{{number_format((float)$total_after_cashback, 2, '.', '')}}<span></strong> </td>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    <input type="hidden" name="product_id" value="{{$products->product_id}}">
                                    <input type="hidden" name="subtotal"  value="{{number_format((float)$revised_price, 2, '.', '')}}">
                                    <input type="hidden" name="discount_amount" id="discount_amount"  value="{{number_format((float)$discount_amount, 2, '.', '')}}">
                                    <input type="hidden" name="extra_discount" id="extra_discount"  value="{{number_format((float)$extra_discount, 2, '.', '')}}">
                                    <input type="hidden" name="grand_total" id="grand_total"  value="{{number_format((float)$revised_price, 2, '.', '')}}">
                                    <input type="hidden" name="cb_amount" id="cb_amount"  value="{{$cb_amount}}">
                                    </div>
                                    {{-- <div class="coupancode">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                <input type="text" class="form-control" name ="couponcode" value="" placeholder="Coupon Code" id="couponcode">
                                                <span class="couponcode-error"></span>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group"><button type="button" class="coupon-btn submitbut">Apply</button></div>
                                               
                                            </div>
                                        </div>
                                    </div> --}}
                                    @if($products->is_reseller_charge)
                                    <h4>Reseller Code</h4>
                                    
                                    <div class="codetext">
                                         If you have a Reseller code, please apply.
                                    </div>
                                   
                                    <div class="resellercode coupancode">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                <input type="text" class="form-control" name ="reseller_code" value="{{$reseller_code!=''?$reseller_code:''}}" placeholder="Reseller Code" id="reseller_code">
                                                <span class="resellercode-success"></span>
                                                <span class="resellercode-error"></span>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group"><button type="button" class="reseller-code-btn submitbut">{{$reseller_code!=''?'Applied':'Apply'}}</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <h4>Credit Card/Debit Card/NetBanking</h4>
                                    <img src="{{asset('public/frontend/images/payment.png')}}">
                                    <div class="codetext">
                                        Pay securely by Credit or Debit card or Internet Banking through Razorpay.
                                    </div>

                                <p class="shorttext">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="{{ url('/privacy-policy') }}">privacy policy.</a></p>
                                   <button type="submit" class="paybut btn-primary" >Place Order</button>
                                    {{-- <input type="submit" class="paybut" value="Place Order"> --}}
                                    <div class="alert alert-danger hide">
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
@stop
@push('page_js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $('.coupon-btn').click(function(){
        let coupon_code=$('#couponcode').val();
        let url="{{route('ajaxCheckCoupon')}}";
        let data={
            coupon_code:coupon_code,
            _token:"{{csrf_token() }}",
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
        let url="{{route('ajaxResellerCode')}}";
        let data={
            reseller_code:reseller_code,
            _token:"{{csrf_token() }}",
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
                                        url: '{{route("ajaxResellerCodeExists")}}',
                                        data: {
                                        'reseller_code': function () { return $('#reseller_code').val(); },
                                        "_token": "{{ csrf_token() }}"
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
                            let url="{{route('billingAction')}}"
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
                                        "name": "{{ env('APP_NAME','IIPARS') }}",
                                        //"description": "A simple test script",
                                        "image": "{{ asset('public/frontend/images/logo-iipars.png') }}",
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
            url: "{!!route('payment-success')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
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

@endpush
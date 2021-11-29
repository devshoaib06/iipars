@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

@include('frontend.includes.home_banner')


<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Sign Up</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2">
                    <div class="resellerCont">

                        @if(Session::has('message'))                         
                                <div class="{{ Session::get('messageClass') }}">
                                    <button class="close" data-close="alert"></button>
                                    <span>{{ Session::get('message') }} </span>
                                </div>
                                @endif  

                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                        <div class="resellerHead">
                            <h4>Reseller Signup</h4>
                            <p>
                                Enter the details below to signup with us.
                            </p>
                        </div>
                        <form action="{{route('resellersignupAction')}}"  method="POST" id="reseller-signup">
                            @csrf
                            <div class="personalInfo">
                                <h4>Personal Details</h4>
                                <div class="form-group">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="repassword" placeholder="Retype Password">
                                </div>
                            </div>
                            <div class="bankingInfo">
                                <h4>Banking Details</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ac_holder_name" placeholder="Account Holder Name" value="{{ old('ac_holder_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ old('account_number') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ old('bank_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="bank_branch" placeholder="Branch" value="{{ old('bank_branch') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC Code" value="{{ old('ifsc_code') }}">
                                </div>
                                <div class="form-group">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                            </div>
                            <input type="submit" id="resellerSignup" value="Signup" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        

</section>


@endsection

@push('page_js')
<script type="text/javascript">
        var FormValidation = function () {
        var handleValidation = function() {
        var form1 = $('#reseller-signup');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                            first_name:{
                                required:true,
                            },
                            last_name:{
                                required:true,
                            },
                            phone:{
                                required:true,
                            },
                            ac_holder_name:{
                                required:true,
                            },
                            account_number:{
                                required:true,
                            },
                            bank_name:{
                                required:true,
                            },
                            bank_branch:{
                                required:true,
                            },
                            ifsc_code:{
                                required:true,
                            },
                            email:{
                                required: true,
                                email: true,
                                remote: {
                                        type: 'post',
                                        url: '{{url(config("constants.admin_prefix")."/"."email-exist")}}',
                                        data: {
                                        'email': function () { return $('#email').val(); },
                                        "_token": "{{ csrf_token() }}"
                                        }
                                }
                            },
                            password:{
                                required:true,
                                minlength: 6
                            },
                            repassword: {
                                required: true,
                                minlength: 6,
                                equalTo: "#password"
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
                                },
                                email:{
                                    remote:"Email already in use."
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

@endpush
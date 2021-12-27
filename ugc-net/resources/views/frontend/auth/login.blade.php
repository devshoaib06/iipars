@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
     <section class="breadcamp">
            <div class="container">
                <ul>
                <li><a href="{{ config('path.iipars_base_url') }}">Home</a></li>
                    <li>Sign In</li>
                </ul>
            </div>
        </section>
        <section class="log-sec">
            <div class="container">
                <div class="log-wrap">
				<h2>Sign in to your account</h2>
				<p style="color:green"><b></b></p>
				<p style="color:red"><b></b></p>

				<div class="form-wrap">
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
					<form id="register-form" method="POST" action="{{route('student.loginAction')}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

						<div class="col-lg-12">
							<div class="form-group">
								<input type="email" name="email" id="email" class="input-box" placeholder="Email">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="password" name="password" id="password" class="input-box" placeholder="Password">
							</div>
						</div>
						<div class="col-lg-6">
							<!-- <div class="lt-rem">
								<label>
									<input type="checkbox" class="rem-mark">
									Rememder me
								</label>
							</div> -->
						</div>
						<div class="col-lg-6">
							<div class="rt-forg">
								<a href="{{route('sign-up')}}">Don't have an account? Sign up
                                    now</a>
							</div>
						</div>
						<div class="srv-btn">
                            <button type="submit" class="btn btn-dark btn-sm mt-15"> Login</button>

						</div>
					</form>
				</div>
			</div>
                {{-- <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">

                        <h1>Sign In</h1>
                        <div class="formsignup" >
                            
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
                            


                        </div>
                    </div>
                </div> --}}

            </div>
        </section>
</section>
@stop
@push('page_js')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
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
                                
                                email: {
                                required: true,
                                        email: true,
                                        
                                },
                             
                                password: {
                                    required: true,
                                    minlength: 5
                                },
                                
                                
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

@endpush
@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

@include('frontend.includes.home_banner')




<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
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
                        <form id="contact-form" method="POST" action="{{route('contactAction')}}">
                            @csrf
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
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
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
                            {{-- <li><span>Address:</span> {{trim(getSettings('address'))}}</li> --}}
                            <li><span>Email:</span> <a href="mailto:{{trim(getSettings('enquiry_email'))}}" class="contact-link">{{trim(getSettings('enquiry_email'))}}</a></li>
                            <li><span>Phone:</span> 
                                <a href="tel:{{trim(getSettings('phone'))}}" class="contact-link">{{trim(getSettings('phone'))}}</a> <br>
                                <a href="tel:{{trim(getSettings('phone-2'))}}" class="contact-link">{{trim(getSettings('phone-2'))}}</a>
                            </li>
                        </ul>
                        {{-- <h3>Be social with us</h3>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29472.80666953494!2d88.404077009786!3d22.57533172887186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275c719156233%3A0x696fbc623d90d6a3!2sBidhannagar%2C%20Kolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1582701638981!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div> --}}

            
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

@endpush
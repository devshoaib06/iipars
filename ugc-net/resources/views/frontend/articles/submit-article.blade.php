@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php $myFunction= new App\library\myFunctions();
      $protocol = $myFunction->getYoutubeProtocol();                                                
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Articles</li>
                <li>Submit your article</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="articleCont">
                <form action="{{route('submitArticle')}}" method="POST" enctype="multipart/form-data" id="article-form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <h1>Submit your article</h1>
                        </div>
                    </div>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="{{ Session::get('messageClass') }}">
                            <button class="close" data-close="alert"></button>
                            <span>{{ Session::get('message') }} </span>
                        </div>
                        @endif
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your name:</label>
                                <input type="text" name="writer_name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your email:</label>
                                <input type="email"  name="writer_email" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your phone:</label>
                                <input type="tel" name="writer_phone" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Article title</label>
                                <input type="text" name="title" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter your article title here.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Meta Tags</label>
                                <input type="text" name="meta_tags" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter  meta tags here.</label>
                        </div>
                    </div>
                    {{-- <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter  meta key here.</label>
                        </div>
                    </div> --}}
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Article description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter short article description here.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Upload article image (if any)</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Upload article image here in (.jpeg), (.jpg), (.png) format (if any).</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Upload file</label>
                                <input type="file" name="file" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Upload you article here in (.pdf), (.docx), (.doc) format.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <input type="submit" value="SUBMIT ARTICLE" />
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </section>
</section>
@endsection

@push('page_js')
<script type="text/javascript">
        var FormValidation = function () {
        var handleValidation = function() {
        var form1 = $('#article-form');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                                writer_name: {
                                    required: true
                                },
                                writer_email:{
                                    required:true,
                                    email:true
                                },
                                writer_phone:{
                                    required:true
                                },
                                title:{
                                    required:true
                                },
                                description:{
                                    required:true
                                },
                                image:{
                                    //required:true,
                                    extension: "jpeg|jpg|png"
                                },
                                file:{
                                    //required:true,
                                    extension: "pdf|doc|docx"
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
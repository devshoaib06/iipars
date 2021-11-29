@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              @include('frontend.includes.student_menu')
            </div>
            <div class="col-sm-12">
              <div class="tabCont">
              <h1>Change Password</h1>
              <?php if(Session::has('message')) { ?>
                  <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                      {{ Session::get('message') }}
                  </div>
              <?php } ?>
              <div class="row">
                <form action="{{ route('update_password') }}" method="post" name="change_pass" id="change_pass">
                    {{ csrf_field() }}
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    <label>New Password:</label>
                      <input type="password" class="form-control" name="npassword" id="npassword">
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="from-group">
                    <label>Retype New Password:</label>
                      <input type="password" class="form-control" name="repassword" id="repassword">
                    </div>
                  </div>
                  
                  
                  <div class="col-sm-12">
                      <button type="submit" class="submitbutdash">Update</button>
                  </div>
                </form>
                </div>

                </div>
              </div>
              </div>
        </div>
    </section>
</section>
@endsection

@push('page_js')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
        var FormValidation = function () {
        var handleValidation = function() {
        var form1 = $('#change_pass');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                                npassword: {
                                    required: true,
                                    minlength: 5
                                },
                                repassword: {
                                    required: true,
                                    minlength: 5,
                                    equalTo: "#npassword"
                                }
                                
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
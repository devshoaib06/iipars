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
              <div class="col-xs-12 col-sm-12 col-md-12">
                    @include('frontend.reseller.includes.reseller_menu')
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="tabCont">
                    <?php if(Session::has('message')) { ?>
                        <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                            {{ Session::get('message') }}
                        </div>
                    <?php } ?>
                    <h1>Edit Account</h1>
                    <form action="{{route('reseller-account-update',['id'=>Hasher::encode(@Auth::id())])}}" method="post" id="myaccount-form">
                        {!! csrf_field() !!}
                        <div class="personalInfo">
                            <h4>Personal Details</h4>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="" value="{{$userinfo->firstname}}">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Last Name:</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="" value="{{$userinfo->lastname}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="" value="{{$userinfo->email}}">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Phone:</label>
                                    <input type="text" class="form-control" name="phn_no" placeholder="" value="{{$userinfo->contactnumber}}">
                                </div>
                            </div>
                            {{-- <div class="form-group col-xs-12 col-sm-6">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="" value="123456">
                            </div> --}}
                            <div class="row">
                        
                        </div>
                        <div class="bankingInfo">
                            <h4>Banking Details</h4>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Account Holder Name:</label>
                                    <input type="text" class="form-control" name="ac_holder_name" placeholder="" value="{{isset($bank_details)?$bank_details->ac_holder_name:''}}">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Account Nuumber:</label>
                                    <input type="text" class="form-control" name="account_number" placeholder="" value="{{isset($bank_details)?$bank_details->account_number:''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Bank Name:</label>
                                    <input type="text" class="form-control" name="bank_name" placeholder="" value="{{isset($bank_details)?$bank_details->bank_name:''}}">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Branch:</label>
                                    <input type="text" class="form-control" name="bank_branch" placeholder="" value="{{isset($bank_details)?$bank_details->bank_branch:''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>IFSC Code:</label>
                                    <input type="text" class="form-control" name="ifsc_code" placeholder="" value="{{isset($bank_details)?$bank_details->ifsc_code:''}}">
                                </div>
                            </div>    
                        </div>
                        <input type="submit" value="Update" />
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
        var form1 = $('#myaccount-form');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                                firstname: {
                                  required: true
                                },
                                lastname: {
                                 required: true
                                },
                                phn_no:{
                                 required: true
                                },
                                "subjects[]":{
                                 required: true
                                },
                                email: {
                                  required: true,
                                  email: true,
                                        
                                },
                                ac_holder_name: {
                                  required: true                          
                                },
                                account_number: {
                                  required: true                          
                                },
                                bank_branch: {
                                  required: true                          
                                },
                                ifsc_code: {
                                  required: true                          
                                },
                               
                                
                        },
                        messages: {
                                firstname: {
                                    required: 'First Name is required.'
                                },
                                
                                lastname: {
                                    required: 'Last Name is required.'
                                },
                                phn_no: {
                                    required: 'Please provide phone number'
                                },
                                email: {
                                required: 'Please provide email',
                                        email:'Please provide proper email address',
                                        remote:'The email is already in use'
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
        $("#form_sample_1").submit(function(){
});</script>
    
@endpush
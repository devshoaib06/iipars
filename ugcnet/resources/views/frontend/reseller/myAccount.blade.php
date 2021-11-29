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
                    <h1>My Account</h1>
                    <a href="{{route('reseller-edit-account',['user_id'=>\Hasher::encode(Auth::id())])}}"><input type="button" value="Edit account" style="float: right;" /></a>
                    <div class="personalInfo">
                        <h4>Personal Details</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{$userinfo->firstname}} {{$userinfo->lastname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{$userinfo->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{$userinfo->contactnumber}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Password:</td>
                                        <td>{{$userinfo->contactnumber}}</td>
                                    </tr> --}}
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bankingInfo">
                        <h4>Banking Details</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Account Holder Name:</td>

                                        <td>{{isset($bank_details)?$bank_details->ac_holder_name:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Number:</td>
                                        <td>{{isset($bank_details)?$bank_details->account_number:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Name:</td>
                                        <td>{{isset($bank_details)?$bank_details->bank_name:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Branch:</td>
                                        <td>{{isset($bank_details)?$bank_details->bank_branch:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>IFSC Code:</td>
                                        <td>{{isset($bank_details)?$bank_details->ifsc_code:''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <!--<form>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="name" placeholder="Abir Singha" value="">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" disabled name="email" placeholder="abirsingha01@gmail.com" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="phone" placeholder="9874589613" value="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" disabled name="password" placeholder="123456">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="acname" placeholder="Abir Singha" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="acnumber" placeholder="001723698714788" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="branch" placeholder="Howrah" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled name="ifsc" placeholder="01414" value="">
                        </div>

                    </form>-->
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
                                email: {
                                  required: true,
                                  email: true,
                                        
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
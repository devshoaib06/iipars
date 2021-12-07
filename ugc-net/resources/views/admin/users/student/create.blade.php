@extends('admin.layouts.app')

@section('page_title')
	Student-Create
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
@endsection



@section('content')	
    <!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- BEGIN SIDEBAR -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				@include('admin.partials.sidebarMenu')
				<!-- END SIDEBAR MENU -->
				<!-- END SIDEBAR MENU -->
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<!-- BEGIN CONTENT BODY -->
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<!-- BEGIN THEME PANEL -->
				@include('admin.partials.theme')
				<!-- END THEME PANEL -->
				<!-- BEGIN PAGE BAR -->
				<div class="page-bar">
					<!--<ul class="page-breadcrumb">
						<li>
							<a href="index.html">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="#">Blank Page</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>Page Layouts</span>
						</li>
					</ul>
					<div class="page-toolbar">
						<div class="btn-group pull-right">
							<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
								<i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">
										<i class="icon-bell"></i> Action</a>
								</li>
								<li>
									<a href="#">
										<i class="icon-shield"></i> Another action</a>
								</li>
								<li>
									<a href="#">
										<i class="icon-user"></i> Something else here</a>
								</li>
								<li class="divider"> </li>
								<li>
									<a href="#">
										<i class="icon-bag"></i> Separated link</a>
								</li>
							</ul>
						</div>
					</div>-->
				</div>
				<!-- END PAGE BAR -->
				<!-- BEGIN PAGE TITLE-->
				<!--<h3 class="page-title"> Managed State 
					<small>blank page layout</small>
				</h3>-->
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold ">Add Student
                                    </span>
                                </div>
                                <!--<div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                    </div>
                                </div>-->
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{route('createStudent')}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                        @if(Session::has('message'))                         
                                        <div class="{{ Session::get('messageClass') }}">
                                            <button class="close" data-close="alert"></button>
                                            <span>{{ Session::get('message') }} </span>
                                        </div>
                                        @endif  

                                        <!--profile pic-->
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">First Name
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="first_name" class="form-control"  value="{{ old('first_name') }}"/> </div>
                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div> <!--First Name-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Last Name
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"/> </div>
                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div> <!--Last Name-->
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gender
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">Select Gender</option> 
                                                    <option value="1">Male</option> 
                                                    <option value="2">Female</option> 
                                                </select>
                                                @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div> <!--Gender value-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="email"/> </div>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>  <!--Email Value-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Contact Number
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="contactnumber" class="form-control" value="{{ old('contactnumber') }}" id="contactnumber"/> </div>
                                            @if ($errors->has('contactnumber'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contactnumber') }}</strong>
                                            </span>
                                            @endif
                                        </div>  <!--Email Value-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Country
                                                <span class="required"> * </span>
                                            </label>

                                            <div class="col-md-6">
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach ($allCountries as $counties)
                                                    <option value="{{$counties['id']}}">{{$counties['country_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div> <!--Country value-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Address
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <textarea name="address" id="address" cols="" rows="" class="form-control">{{ old('address') }}</textarea>
                                                @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>  <!--Address value-->
                                        <!--div class="form-group">
                                            <label class="control-label col-md-3">Telephone
                                                <span class="required"> * </span>
                                            </label>
                                           
												<div class="col-md-6">
												
                                                <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ old('mobile_number') }}"/>
												</div>
											
											
                                            @if ($errors->has('mobile_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </span>
                                            @endif
                                        </div-->  <!--Mobile number-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Password
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="password" name="password" class="form-control" /> </div>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>  <!--Password value-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="example-inline-radio1" type="radio" value="1" name="status" checked="checked"> Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="status"> Inactive</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="{{ route('students') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
			</div>
			<!-- END CONTENT BODY -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->            
		@include('admin.partials.quickSidebar')
		<!-- END QUICK SIDEBAR -->
	</div>    
    <!-- END CONTAINER -->
@endsection


@section('page_level_plugins')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>

@endsection

@section('page_level_scripts')
<script type="text/javascript">
        var FormValidation = function () {

// basic validation
        var handleValidation = function() {
// for more info visit the official plugin documentation: 
// http://docs.jquery.com/Plugins/Validation

        var form1 = $('#form_sample_1');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);
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
                                gender:{
                                required: true
                                },
								
								email: {
                                required: true,
                                        email: true,
                                        remote: {
                                        type: 'post',
                                                url: '{{url(config("constants.admin_prefix")."/"."email-exist")}}',
                                                data: {
                                                'email': function () { return $('#email').val(); }
                                                }
                                        }
                                },
                                country: {
                                required: true
                                },
                                address: {
                                required: true
                                },
								contactnumber:{
                                    required: true,
                                },
								
								
								
								
								
								
								
                                /*mobile_number: {
                                required: true,
                                        remote: {
                                        type: 'post',
                                                url: '{{url(config("constants.admin_prefix")."/"."mobile-number-exist")}}',
                                                data: {
                                                'mobile_number': function () { return $('#mobile_number').val(); }
                                                }
                                        }
                                },*/
                                
                               
                                password: {
                                required: true
                                }
                                
                        },
                        messages: {
                        /*select_multi: {
                         maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                         minlength: jQuery.validator.format("At least {0} items must be "selected"")
                         }*/
						 
						 	
                                first_name: {
                                required: 'First Name is required.'
                                },
                                
                                last_name: {
                                required: 'Last Name is required.'
                                },
						 
						 
								
								 gender: {
                                required: 'Please provide gender'
                                },
								
								
                                email: {
                                required: 'Please provide email',
                                        email:'Please provide proper email address',
                                        remote:'The email is already in use'
                                },
								
								
								country: {
                                required: 'Country is required.'
                                },
								
								address: {
                                required: 'Please provide address'
                                },
								
								/*mobile_number: {
                                	required: 'Mobile number is required',
                                        remote:'Mobile number is already in use'
                                },*/
                                password: {
                                required: ' Please provide password'
                                },
                                
                               
                                
                                

                        },
                        invalidHandler: function (event, validator) { //display error alert on form submit              
                        success1.hide();
                                error1.show();
                                App.scrollTo(error1, - 200);
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
//main function to initiate the module
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
@endsection
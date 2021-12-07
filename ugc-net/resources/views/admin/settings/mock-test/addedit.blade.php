@extends('admin.layouts.app')

@section('page_title')
	Mock Test Setting
@endsection

@section('page_level_plugins_css')
<link href="public/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
				<h3 class="page-title"> <?php /*General Setting
					<small>blank page layout</small> */ ?>
				</h3>
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings "></i>
                                    <span class="caption-subject  sbold ">Edit Mock Test Setting
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
                                <form action="{{$form_url}}" id="form_sample_1" class="form-horizontal" method="POST" >
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


                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif	

                                     
                                        
										
										
																										
										@foreach ($setting as $v)
										
										
										<div class="form-group">
                                            <label class="control-label col-md-4"><?php echo $v->title; ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
												
                                                
												@if ($v->type == 1)
												<input type="text" name="<?php echo $v->setting_id; ?>" class="form-control @if($v->isNum == '1') numbers @endif" value="{{$v->content}}" @if($v->isNum == '1') style="width: 100px;" @endif />
												@else
												<textarea class="form-control" rows="3" name="<?php echo $v->setting_id; ?>" id="textarea">{{$v->content}}</textarea> 
												@endif
											</div>
                                        </div>
									
									
																	
										@endforeach											
											
										
										
										

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->                                
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
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
<script src="{{config('path.assets_path')}}/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

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
						
						@foreach ($setting as $v)
                        {{$v->setting_id}}: {
                        	required: true,
                            @if ( $v->setting_id == 'commission_percentage')
                            min: 1
                            @endif
                        },
                        @endforeach	
							        
                        },
                        messages: {
                        /*select_multi: {
                         maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                         minlength: jQuery.validator.format("At least {0} items must be "selected"")
                         }*/


						@foreach ($setting as $v)
						{{$v->setting_id}}: {
                        	required: '{{$v->title}} is required.'

                        },
						@endforeach		

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
        jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
        }, "Please provide type");
        jQuery(document).ready(function() {
FormValidation.init();
});
        $("#form_sample_1").submit(function(){
});
  /*****Only neumeric field validation******/
   $("#phone_code").keydown(function(e) {
       // Allow: backspace, delete, tab, escape, enter and .
       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
           // Allow: Ctrl+A, Command+A
           (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
           // Allow: home, end, left, right, down, up
           (e.keyCode >= 35 && e.keyCode <= 40)) {
           // let it happen, don't do anything
           return;
       }
       // Ensure that it is a number and stop the keypress
       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
           e.preventDefault();
       }
   });
   CKEDITOR.replace( 'textarea', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [                
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"document","groups":["mode"]},
                {"name":"insert","groups":["image","table","horizontalrule","spcialchar"]},             
                {"name":"styles","groups":["styles","undo","redo"]}
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',
           

        } );
    </script>
@endsection
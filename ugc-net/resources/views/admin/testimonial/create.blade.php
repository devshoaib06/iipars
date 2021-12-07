@extends('admin.layouts.app')

@section('page_title')
Testimonials
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<style>
#pdesc-error{
    position: absolute;
    bottom: -22px;
    left:14px;
}
</style>
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
                                    <i class="icon-video "></i>
                                    <span class="caption-subject  sbold ">Add Testimonial
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
                                <form action="{{route('createTestimonials')}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>

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

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Student Name
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="student_name" class="form-control"  value="{{ old('student_name') }}"/ autocomplete="off"> </div>

                                        </div> <!--First Name-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Course Title
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="student_course" class="form-control" value="{{ old('video_url') }}" autocomplete="off" /> </div>

                                        </div> <!--Last Name-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3"> Select Testimonial Type
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                               
                                            <select class="form-control" name="testimonial_type" id="testimonial_type">
                                                    <option value="">Select </option>
                                                    <option value="1">Video</option>
                                                    <option value="2">Text</option>
                                                </select>
                                               
                                               </div>

                                        </div> <!--Last Name-->
                                        
                                        <div class="form-group" style="display:none;" id="video_block">
                                            <label class="control-label col-md-3">Video URL
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}" autocomplete="off" /> </div>

                                        </div> <!--Last Name-->

                                        <div class="form-group"  style="display:none;" id="testimonial_block">
                                            <label class="control-label col-md-3">Testimonial Content
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6"> 
                                                <textarea name="testimonial_text" id="pdesc" rows="20" class="form-control"  /></textarea>
                                                                                          
                                                </div>      
                                                
                                                <!-- <div id="description_error"> </div>  -->
                                        </div> <!--Last Name-->

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
                                                <a href="{{ route('testimonials') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
<script src="public/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

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

    //IMPORTANT: update CKEDITOR textarea with actual content before submit
    form1.on('submit', function() {
        for(var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
    })
    
    form1.validate({
    errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ".ignore", // validate all fields including form hidden input
            rules: {
                student_name: {
                        required: true
                },
                student_course: {
                    required: true
                },
                testimonial_type: {
                    required: true
                },
                testimonial_text: {
                    required: true
                },
                video_url: {
                    required: true
                }                    
            },
            messages: {

                student_name: {
                    required: 'Student Name is required.',
                },
                student_course: {
                    required: 'Student Course is required.',
                },
                testimonial_type: {
                    required: 'Testimonial Type is required.',
                },
                testimonial_text: {
                    required: 'Testimonial Text is required.',
                },
                video_url: {
                    required: 'Video Url is required.',
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("data-error-container")) { 
                    error.appendTo(element.attr("data-error-container"));
                } 
                else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
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

</script>

<script type="text/javascript">

    $(document).ready( function() {  

        $("#testimonial_type").change( function() {  

            var testimonialType = $(this).val();

            if( testimonialType == '' ) {
                $("#video_block").hide();
                

                $("#testimonial_block").hide();
            } else if( testimonialType == '1') {
                $("#video_block").show();
                $("#video_url").removeClass('ignore');

                $("#testimonial_block").hide();
                $("#pdesc").addClass('ignore');

            } else if( testimonialType == '2') {
                $("#testimonial_block").show();
                $("#pdesc").removeClass('ignore');

                $("#video_block").hide();
                $("#video_url").addClass('ignore');
            }

        });

    });

//   CKEDITOR.replace( 'pdesc', {
//             // Define the toolbar groups as it is a more accessible solution.
//             toolbarGroups: [                
//                 {"name":"basicstyles","groups":["basicstyles"]},
//                 {"name":"links","groups":["links"]},
//                 {"name":"paragraph","groups":["list","blocks"]},
//                 {"name":"document","groups":["mode"]},
//                 {"name":"insert","groups":["image","table","horizontalrule","spcialchar"]},             
//                 {"name":"styles","groups":["styles","undo","redo"]}
//             ],
//             // Remove the redundant buttons from toolbar groups defined above.
//             removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',
//             height: '600px',

//         } );
</script>
@endsection

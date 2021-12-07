@extends('admin.layouts.app')

@section('page_title')
	Floater Sign Up
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
			
			<div class="page-sidebar navbar-collapse collapse">
				
				@include('admin.partials.sidebarMenu')
				
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
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold ">Floater Sign Up
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{route('saveFloaterSignUp')}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                            <label class="control-label col-md-2">Title
                                                {{-- <span class="required"> * </span> --}}
                                            </label>
                                            <div class="col-md-8">
                                            <input type="text" name="title" class="form-control"  value="{{$banner->title}}"/> </div>
                                            @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Description</label>
                                            <div class="col-md-8">

                                            <textarea id="pdesc" class="ckeditor form-control" rows="7"  name="notidescription"> 
                                                {{$banner->description}}
                                            </textarea> 
                                            @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Time (in sec)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                            <input type="text" name="time" class="form-control"  value="{{$banner->time}}"/> </div>
                                            @if ($errors->has('time'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('time') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       
                                       
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Status <span class="required"> * </span></label>
                                            <div class="col-md-8">

                                                <div class="radio-list">
                                                    <label class="radio-inline" for="status-inline-radio3">
                                                        <input id="status-inline-radio3" type="radio" value="1" name="status" {{$banner->status==1?'checked':''}} > Active</label>
                                                    <label class="radio-inline" for="status-inline-radio4">
                                                        <input id="status-inline-radio4" type="radio" value="0" name="status" {{$banner->status==0?'checked':''}}> Inactive</label>
                                                </div>
                                            </div> 

                                        </div> 
                                       
                                       

                                        
                                        
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                
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
                form1.validate({
                errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "", // validate all fields including form hidden input
                        rules: {
                                time: {
                                    required: true,
                                    number:true
                                },
                                
                                title:{
                                    required:true
                                },
                                notidescription:{
                                    required:function() 
                                            {
                                            CKEDITOR.instances.notidescription.updateElement();
                                            }
                                },
                                
                                
                        },
                        messages: {
                            title: {
                                required: 'Title is required.',
                            },
                            time: {
                                required: 'Time is required.',
                                number:'Please enter valid time'
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
                        errorPlacement: function (error, element) {
                            if (element.attr("type") == "checkbox") {
                                //error.insertAfter($(element).parents('div').prev($('.subject')));
                            } else {
                                error.insertBefore(element);
                            }
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
});
CKEDITOR.replace( 'notidescription', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [                
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"document","groups":["mode"]},
                {"name":"insert","groups":["image","table","horizontalrule","spcialchar"]},             
                {"name":"styles","groups":["styles","undo","redo"]}
            ],
            //filebrowserBrowseUrl: '/browser/browse.php',
            filebrowserUploadUrl: '{{route('uploadImageCKeditor',['_token' => csrf_token() ])}}',
            //extraPlugins: 'uploadimage',
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',
            //height: '600px',

        } );
</script>
@endsection
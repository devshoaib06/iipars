@extends('admin.layouts.app')

@section('page_title')
	Combo Course - Add
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<link href="{{config('path.assets_path')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
<style>

    .tag_fields{
        color: #3f444a;
        font-size: 18px;
        font-weight: 500;
        margin: 0 0 15px;
    }
</style>
@endsection

<?php $myFunction= new App\library\myFunctions();
      $protocol = $myFunction->getYoutubeProtocol();
?>

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
				<h3 class="page-title">
                Add new combo course
                </h3>
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="portlet light portlet-fit portlet-datatable bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase"> Add new combo course
                                    </span>
                                </div>
                                    
                                <div class="actions btn-set">
                                 
                                 
                                    <button class="btn btn-secondary-outline" onclick="location.href = '{{url(route('combo-course'))}}';">
                                        <i class="fa fa-angle-left"></i> Back
                                    </button>
                                    <button type="submit"  class="btn green" id="save-button">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                    <!--<button class="btn green" id="save_and_duplicate">
                                        <i class="fa fa-check"></i> Save & Duplicate
                                    </button>-->
                                </div>
                            </div>
                            <div class="portlet-body">
							     <form role="form" action="{{route('addComboCourseAction')}}" id="course_info_form" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }} 
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
                                
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs nav-tabs-lg">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab"> Details </a>
                                        </li>
                                        <li>
                                            <a href="#tab_2" data-toggle="tab">Courses</a>
                                        </li>
                                        <li>
                                            <a href="#tab_3" data-toggle="tab">Videos</a>
                                        </li>
                                        
										
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row profile-account">
                                                <div class="col-md-3">
                                                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#tab_1-1">
                                                                <i class="fa fa-cog"></i> General Information </a>
                                                            <span class="after"> </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="tab-content">
                                                        <div id="tab_1-1" class="tab-pane active">
                                                           
                                                                <div class="form-group">
                                                                    <label class="control-label">Name <span class="required"> * </span></label>
                                                                    <input type="text"  name="g_name" class="form-control" value="{{ old('g_name') }}"/> 
                                                                    @if ($errors->has('g_name'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('g_name') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Short Description <span class="required"> * </span></label>
                                                                    <textarea name="s_description" id="s_description" class="form-control">{{old('s_description')}}</textarea> 
                                                                    @if ($errors->has('s_description'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('s_description') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Description <span class="required"> * </span></label>
                                                                    <textarea id="pdesc" class="ckeditor form-control" rows="3" name="description" data-error-container="#description_error"> 
                                                                      {{ old('description') }}
                                                                    </textarea> 
                                                                    @if ($errors->has('description'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Important Notice <span class="required"> * </span></label>
                                                                    <textarea id="inote" class="ckeditor form-control" rows="3" name="important_notice" data-error-container="#important_notice_error"> 
                                                                      {{ old('important_notice') }}
                                                                    </textarea> 
                                                                    @if ($errors->has('important_notice'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('important_notice') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Price <span class="required"> * </span></label>
                                                                    <input type="text"  name="course_price" class="form-control" value="{{ old('course_price') }}"/> 
                                                                    @if ($errors->has('course_price'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('course_price') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Discount Price </label>
                                                                    <input type="text"  name="discount_price" class="form-control" value="{{ old('discount_price') }}"/> 
                                                                    @if ($errors->has('discount_price'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('discount_price') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Expiry Date <span class="required"> * </span></label>
                                                                    <input class="form-control  date-picker" name="expiry_date" size="16" type="text" value="{{ old('expiry_date') }}" />

                                                                    @if ($errors->has('expiry_date'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('expiry_date') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Meta Keywords <span class="required"> * </span></label>
                                                                    <input class="form-control" name="meta_key" size="16" type="text" value="{{ old('meta_key') }}" />

                                                                    @if ($errors->has('meta_key'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('meta_key') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cover Image</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <span class="btn green btn-file">
                                                                            <span class="fileinput-new"> Select file </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="hidden"><input type="file" name="image"> </span>
                                                                        <span class="fileinput-filename"> </span> &nbsp;
                                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                    </div>
                                                                
                                                                </div>
																<div class="form-group">
                                                                    <label class="ccontrol-label">Is Featured <span class="required"> * </span></label>
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" for="example-inline-radio1">
                                                                            <input id="example-inline-radio1" type="radio" value="1" name="is_popular" checked="checked"> Yes</label>
                                                                        <label class="radio-inline" for="example-inline-radio2">
                                                                            <input id="example-inline-radio2" type="radio" value="0" name="is_popular"> No</label>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="ccontrol-label">Show on Home slider <span class="required"> * </span></label>
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" for="example-inline-radio5">
                                                                            <input id="example-inline-radio5" type="radio" value="1" name="home_slider" > Yes</label>
                                                                        <label class="radio-inline" for="example-inline-radio6">
                                                                            <input id="example-inline-radio6" type="radio" value="0" name="home_slider" checked="checked"> No</label>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="ccontrol-label">Status <span class="required"> * </span></label>
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" for="example-inline-radio3">
                                                                            <input id="example-inline-radio3" type="radio" value="1" name="status" checked="checked"> Active</label>
                                                                        <label class="radio-inline" for="example-inline-radio4">
                                                                            <input id="example-inline-radio4" type="radio" value="0" name="status"> Inactive</label>
                                                                    </div>
                                                                </div> 
                                                                {{-- <div class="margiv-top-10">
                                                                    <button type="submit" class="btn green">Save Changes</button>
                                                                </div> --}}
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-md-9-->
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab_2">
                                            @php 
                                                $myFunction= new App\library\myFunctions();
                                                
                                            @endphp
                                                @foreach($product_contributors as $key=>$item)

                                            <div class="form-group">
                                                    <div class="product-cont">
                                                        <input type="checkbox" class="product-check" name="products[]" value="{{$key}}"><label>{{$myFunction->getProductName($key)}}</label>
                                                        <ul style="list-style-type:none ;display: none">
                                                           @foreach($item as $contributor)
                                                            <li class="product-item">
                                                                <input type="checkbox" class="conti-check" name="contributors[]" value="{{$contributor->contributor_id}}">{{$contributor->firstname .' '.$contributor->lastname }}
                                                                <span class="prod_contributors_span" style="display: none;">
                                                                <input type="checkbox" class="prod_contributors" name="prod_contributors[]" value="{{$contributor->product_id}}" >
                                                                 </span>
                                                            </li>
                                                             @endforeach
                                                           
                                                        </ul>
                                                    </div>
                                            </div>
                                                @endforeach
                                                
                                        </div>
                                        <div class="tab-pane" id="tab_3">
                                            <div class="row">
                                                
                                                @foreach($videos as $video)
                                                <?php $video_embed_link=$myFunction->parseYouTubeUrl($video->video_url);?>
                                                
                                                    <div class="col-sm-3 pb-30 video">
                                                         <iframe width="270" height="180" src="{{$protocol}}://www.youtube.com/embed/<?php echo $video_embed_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        <input type="checkbox" name="video[]" value="{{$video->id}}">{{$video->title}} 
                                                    </div>
                                                @endforeach
                                            </div> 
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                    <button type="submit" name="add" class="btn btn-success hidden-btn">submit</button>
                            </form>
                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End: life time stats -->
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

<script src="{{config('path.assets_path')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>    
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
 <script src="{{config('path.assets_path')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
{{-- <script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
 <script src="{{config('path.assets_path')}}/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script> --}}
@endsection

@section('page_level_scripts')

<script type="text/javascript">	
    

    $(document).ready(function(){
        personal_info_validation.init();
        $(".hidden-btn").hide(); 
        $('#save-button').on('click',function(){
            $(".hidden-btn").trigger("click");
        })
        
        $(".product-check").on('click',function(){
            $(this).parents(".product-cont").find("ul").hide();
            $(this).parents(".product-cont").find("li.product-item").find('input.conti-check').click();
            $(this).parents(".product-cont").find("ul").find('.conti-check').prop('disabled',true);
            if($(this).is(':checked')){

                $(this).parents(".product-cont").find("ul").show();
                $(this).parents(".product-cont").find("li.product-item").find('input.conti-check').click();
                $(this).parents(".product-cont").find("ul").find('.conti-check').prop('disabled',false);
            }
        })

        $(".conti-check").click(function(){
            $(this).parents(".product-item").find('input.prod_contributors').prop('checked',false);
            let parent_check=$(this).parents(".product-cont").find('input.conti-check:checked').length;
            if(!parent_check){
                $(this).parents(".product-cont").find('.product-check').click();
            }
            if($(this).is(':checked')){
                $(this).parents(".product-item").find('input.prod_contributors').prop('checked',true);
            }
        })

       
        
    })   

    $('.checkbox_check').change(function(){
         if(!$(this).is(":checked")){
            $(this).parents('li.mt-list-item').find(".task-list-item").remove();
         }
    });
    $(document).on('change','.contributor_check',function(){
        
        $(this).parents('li.task-list-item').find('.contributor_price').prop("required",true);
        $(this).parents('li.task-list-item').find('.contributor_price').prop("readonly",false);
        
        if(!$(this).is(':checked')){
            $(this).parents('li.task-list-item').find('.contributor_price').prop("required",false);
            $(this).parents('li.task-list-item').find('.contributor_price').prop("readonly",true);
            $(this).parents('li.task-list-item').find('.contributor_price').val("");
        }
    })
    var personal_info_validation = function () {
    // basic validation
    var handleValidation = function() {
        var form1 = $('#course_info_form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.on('submit', function() {
                    for(var instanceName in CKEDITOR.instances) {
                        CKEDITOR.instances[instanceName].updateElement();
                    }
                })      

        form1.validate({
        errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                g_name: {
                    required: true
                },
                s_description: {
                    required: true,                    
                   
                },
                description: {
                    required: true, 
                },
                important_notice: {
                    required: true, 
                },
                course_price:{
                    required: true,
                     number: true
                },
                discount_price:{                    
                     number: true
                },
                image:{
                    accept:"jpg,png,jpeg,gif"
                },
                price:{
                    required: true,
                     number: true
                },
                expiry_date: {
                    required: true
                },
                meta_key: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'Please provide email',
                            email:'Please provide proper email address',
                            remote:'The email is already in use'
                },
                'videos[]': {
                    required: 'Country is required.'

                },
                price: {
                    required: 'Please provide price'
                },
                firstname: {
                    required: 'First Name is required.'
                },
                
                lastname: {
                    required: 'Last Name is required.'
                },
                /*mobile_number: {
                    required: 'Mobile number is required',
                            remote:'Mobile number is already in use'
                },*/
                address: {
                    required: 'Please provide address'
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

    
            
    

    var imageupload_validation = function () {
    // basic validation
    var handleValidation = function() {
    var form1 = $('#image_upload_form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        form1.validate({
        errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
            profile_pic:{
            required: true,
                accept:"jpg,png,jpeg,gif"
            }
            },
            messages: {
            profile_pic:{
            required: "Select Image for the user",
                    accept: "Only image type jpg/png/jpeg/gif is allowed"
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

    
    
    
   

    
    if (App.isAngularJsApp() === false) {
		jQuery(document).ready(function () {
			//HotelImage.init();
			//fancybox_init();
		});
	}
    
</script>

<script>
    function change_hidden_value(id)
    {
        if($("#checkbox_"+ id).is(':checked')){
        $("#hidden_"+ id).val(1); 												
        
        }else{
        $("#hidden_"+ id).val(0);
        
        }
	}
</script>
<script type="text/javascript">
    CKEDITOR.replace( 'pdesc', {
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
    CKEDITOR.replace( 'inote', {
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
    CKEDITOR.replace( 's_description', {
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
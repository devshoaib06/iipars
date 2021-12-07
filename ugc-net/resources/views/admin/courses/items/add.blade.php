@extends('admin.layouts.app')

@section('page_title')
	Item - Edit
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
                Add new item
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
                                    <span class="caption-subject font-dark sbold uppercase"> Add new item
                                    </span>
                                </div>
                                    
                                <div class="actions btn-set">
                                 
                                 
                                    <button class="btn btn-secondary-outline" onclick="location.href = '{{url(config("constants.admin_prefix"))}}/items';">
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
							     <form role="form" action="{{route('addItemAction')}}" id="material_info_form" method="POST">
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
                                            <a href="#tab_2" data-toggle="tab">Materials</a>
                                        </li>
                                        <li>
                                            <a href="#tab_3" data-toggle="tab">Videos</a>
                                        </li>
                                        <li>
                                            <a href="#tab_4" data-toggle="tab">Contributors</a>
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
                                                                    <input type="text"  name="g_name" class="form-control" value=""/> 
                                                                </div>
																<div class="form-group">
                                                                    <label class="ccontrol-label">Status <span class="required"> * </span></label>
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" for="example-inline-radio1">
                                                                            <input id="example-inline-radio1" type="radio" value="1" name="status" checked="checked"> Active</label>
                                                                        <label class="radio-inline" for="example-inline-radio2">
                                                                            <input id="example-inline-radio2" type="radio" value="0" name="status"> Inactive</label>
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
                                            <div class="alert alert-success margin-bottom-10">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                <i class="fa fa-warning fa-lg"></i> Only pdf format allowed. </div>
                                            <div id="tab_images_uploader_container" class="text-align margin-bottom-10">
                                                <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success">
                                                    <i class="fa fa-plus"></i> Select Files </a>
                                                <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                                    <i class="fa fa-share"></i> Upload Files </a>
                                            </div>
                                            <div class="row">
                                                <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"> </div>
                                            </div>
                                            <div class="hidden-data"></div>
                                        </div>
                                        
                                        <div class="tab-pane" id="tab_3">
                                            <div id="dynamic_field">
                                            </div>
                                            <div class="form-group">
                                                <button type="button" name="add" id="add" class="btn btn-success">Add Youtube Video</button>
                                            </div>
                                            <button type="submit" name="add" class="btn btn-success hidden-btn">submit</button>
                                            <br>
                                            <br> 
                                        </div>
                                        <div class="tab-pane" id="tab_4">

                                             <div class="form-group">
                                                
                                                <div class="checkbox-list">
                                                    @foreach($contributors as $contributor)
                                                        <label>
                                                            <input type="checkbox" name="contibutors[]" value="{{$contributor->contributor_id}}">{{$contributor->name}}
                                                        </label>
                                                    @endforeach
                                                    
                                                </div>
                                            </div>
                                              
                                            <br>
                                                    
                                        </div>

                                        </div>
                                        </div>
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
{{-- <script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
 <script src="{{config('path.assets_path')}}/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script> --}}
@endsection

@section('page_level_scripts')

<script type="text/javascript">	
    let i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="form-group col-sm-6 p-rel"><input type="text" name="videos[]" placeholder="Video Url" class="form-control" /><a href="javascript:;" id="'+i+'" data-repeater-delete class="btn btn-danger btn_remove p-art"><i class="fa fa-close"></i></a></div></div>');  
      }); 
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
    var personal_info_validation = function () {
    // basic validation
    var handleValidation = function() {
        var form1 = $('#material_info_form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        form1.validate({
        errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                g_name: {
                    required: true
                },
                'videos[]': {
                    required: true,                    
                    url: true
                },
                'contibutors[]': {
                    required: true,                                        
                }
            },
            messages: {
                'videos[]': {
                    required: 'Youtube video link is required.'

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
       personal_info_validation.init();
       $(".hidden-btn").hide(); 
       $('#save-button').on('click',function(){
       $(".hidden-btn").trigger("click");
      })
    });
    
    var MaterialImage = function () {

    var handleImages = function() {
        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
             
            browse_button : document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself
             
			/*url :{ { url('admin/ajax-hotel-booked-list-admin'.'/'.$hotel->hotel_id) } }*/
			/*url : "upload.php",*/
           // url : "/bnbanz/admin/ajax-hotel-image-upload-admin/4",
            url : "{{ url('admin/ajax-item-image-upload-admin') }}",
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "Pdf files", extensions : "pdf"}
                ],
               // prevent_duplicates: true
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            // Flash settings
            flash_swf_url : 'assets/plugins/plupload/js/Moxie.swf',
     
            // Silverlight settings
            silverlight_xap_url : 'assets/plugins/plupload/js/Moxie.xap',             
         
            init: {
                PostInit: function() {
                    $('#tab_images_uploader_filelist').html("");
         
                    $('#tab_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });

                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        let file_name = $('#materials_'+$(this).parent('.added-files').attr("data-file-id")).val();
                        $.ajax({
                            url : "{{ url('admin/ajax-item-image-remove-admin') }}",
                            dataType: 'json',
                            type: 'post',
                            contentType: 'application/json',
                            data: JSON.stringify( { mat_file_name: file_name } ),
                            success: function(response){
                               // Remove
                                if (response.result && response.result == 'OK') {
                                    
                                }
                                else
                                {
                                    App.alert({type: 'danger', message: 'Remove failed. Please retry.', closeInSeconds: 10, icon: 'warning'});
                                }
                            } 
                        });
                        uploader.removeFile($(this).parent('.added-files').attr("id"));
                        $(this).parent('.added-files').remove();
                        $('.hidden-data').children('#materials_'+$(this).parent('.added-files').attr("data-file-id")).remove();
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '" data-file-id="' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> remove</a></div>');
                        
                        //$('.hidden-data').append('<input type="hidden" name="material_files[]"  id="materials_' + file.id + '" value="'+ file.name + '"/>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);
                    let fileval;
                    if (response.result && response.result == 'OK') {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Done'); // set successfull upload
                        $('.hidden-data').append('<input type="hidden" name="material_files[]"  id="materials_' + file.id + '" value="'+ response.file_name + '"/>');
                        //let prevUploadedFiles=$('#materials').val();
                        //let uploaded_file=response.file_name;
                        //fileval=prevUploadedFiles;
                        //fileval+=uploaded_file+','
                        //$('#materials').val(fileval);
						//$('#hotel_image_list').DataTable().ajax.reload();
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        App.alert({type: 'danger', message: 'One of uploads failed. Please retry.', closeInSeconds: 10, icon: 'warning'});
                    }
                },
         
                Error: function(up, err) {
                    App.alert({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });

        uploader.init();

    }
	
//	var handleImageList = function () {
//
//        var grid = new Datatable();
//
//        grid.init({
//            src: $("#hotel_image_list"),
//            onSuccess: function (grid) {
//                // execute some code after table records loaded
//            },
//            onError: function (grid) {
//                // execute some code on network or other general error  
//            },
//            loadingMessage: 'Loading...',
//            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
//                "lengthMenu": [
//                    [10, 20, 50, 100, 150, -1],
//                    [10, 20, 50, 100, 150, "All"] // change per page values here
//                ],
//                "pageLength": 10, // default record count per page
//                /*"ajax": {
//                    "url": "../demo/ecommerce_product_history.php", // ajax source
//                },*/
//				"ajax": {
//						"url": "{{ url('admin/ajax-item-image-list-admin'.'/') }}", // ajax source
//				},
//                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
//                    'orderable': false,
//                    'targets': [0, 3]
//                }],				
//                "order": [
//                    [1, "desc"]
//                ] // set first column as a default sort by asc
//            }
//        });
//    }

    return {
        //main function to initiate the module
        init: function () {
			//handleImageList();
            handleImages();
        }

    };}();
    
    if (App.isAngularJsApp() === false) {
		jQuery(document).ready(function () {
			MaterialImage.init();
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

@endsection
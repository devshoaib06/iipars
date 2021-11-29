@extends('admin.layouts.app')

@section('page_title')
	Course - Add
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
                Add new course
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
                                    <span class="caption-subject font-dark sbold uppercase"> Add new course
                                    </span>
                                </div>
                                    
                                <div class="actions btn-set">
                                 
                                 
                                    <button class="btn btn-secondary-outline" onclick="location.href = '{{url(route('courses'))}}';">
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
							     <form role="form" action="{{route('addCourseAction')}}" id="course_info_form" method="POST" enctype="multipart/form-data">
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
                                        {{-- <li>
                                            <a href="#tab_2" data-toggle="tab">Materials</a>
                                        </li> --}}
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
                                                                <label class="control-label">Exam <span class="required"> * </span></label>
                                                                <select name="exam_id" id="exam_id" class="form-control">
                                                                    <option value="">Select Exam</option>
                                                                    @foreach($allExams as $exam)   
                                                                        <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="paper-section">
                                                                
                                                            </div>  
                                                            <div class="form-group">
                                                                <label class="control-label">Subject <span class="required"> * </span></label>
                                                                <div class="radio-list subject-list">
                                                                   @foreach ($allSubjects as $subject)
                                                                    <label class="radio-inline" for="example-inline-radio{{$subject->id}}">
                                                                        <input id="example-inline-radio{{$subject->id}}" 
                                                                               type="checkbox" 
                                                                               value="{{$subject->id}}" 
                                                                               name="subject_list[]"
                                                                        >
                                                                        {{$subject->subject_name}}
                                                                    </label>
                                                                   @endforeach
                                                                   
                                                                </div>
                                                            </div>  
                                                            {{-- <div class="form-group">
                                                                <label class="control-label">Material <span class="required"> * </span></label>
                                                                <div class="radio-list subject-list">
                                                                    @foreach ($allMaterials as $material)
                                                                     <label class="radio-inline" for="example-inline-radio{{$material->id}}">
                                                                         <input id="example-inline-radio{{$material->id}}" 
                                                                                type="checkbox" 
                                                                                value="{{$material->id}}" 
                                                                                name="subject_list[]"
                                                                         >
                                                                         {{$material->material_name}}
                                                                     </label>
                                                                    @endforeach
                                                                 </div>
                                                            </div> --}}
                                                           
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
                                            <div class="mt-element-list">
                                                <div class="mt-list-head list-todo blue">
                                                   
                                                </div>
                                                <div class="mt-list-container list-todo">
                                                    <div class="list-todo-line"></div>
                                                    <ul>
                                                        <?php $i=1;?>
                                                        @foreach($items as $item)
                                                        <li class="mt-list-item">
                                                            <div class="list-todo-icon bg-white material-list" data-itemid="{{$item->item_id}}"data-target="#task-{{$i}}" data-toggle="collapse" >
                                                                
                                                                <input type="checkbox" name="materials[]" class="checkbox_check"  value="{{$item->item_id}}">
                                                            </div>
                                                            <div class="list-todo-item dark">
                                                                <a class="list-toggle-container">
                                                                    <div class="list-toggle done uppercase">
                                                                        <div class="list-toggle-title bold">{{$item->name}}</div>
                                                                        {{-- <div class="badge badge-default pull-right bold">3</div> --}}
                                                                    </div>
                                                                </a>
                                                                <div class="task-list panel-collapse collapse" id="task-{{$i}}">
                                                                    <ul class="contributor_list"></ul>
                                                                    <div class="task-footer bg-grey">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php $i++;?>
                                                        @endforeach
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_3">
                                            <div class="row">
                                                <?php $myFunction= new App\library\myFunctions();
                                                $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
                                                
                                                ?>
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
    let i=1;
    $('#add').click(function(){  
        
           i++;
          
           $('#dynamic_field').append('<div class="form-group"><div id="row'+i+'" class="dynamic-added"><input type="text" name="videos[]" placeholder="Video Url" class="form-control" /><a href="javascript:;" id="'+i+'" data-repeater-delete class="btn btn-danger btn_remove"><i class="fa fa-close"></i></a</div></div>');  
      }); 
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

    $(document).ready(function(){
        personal_info_validation.init();
        $(".hidden-btn").hide(); 
        $('#save-button').on('click',function(){
            $(".hidden-btn").trigger("click");
        })
       /* $(".check-material").on('click',function(){

          console.log($(this).parents('li.mt-list-item').find(".task-list").hasClass( "in" ))
          console.log($(this).prop('checked'))
;
          $(this).parents('li.mt-list-item').find("a").click();
          $(this).parents('li.mt-list-item').find(".contributor_check").prop("checked",true);
        })*/

        $('.material-list').click(function(){
            let itemid=$(this).data('itemid')
            let url="{{route('ajaxCourseMaterialList')}}"
            let data={itemid:itemid}
            var $this=$(this);

            if($(this).parents('li.mt-list-item').find("ul.contributor_list").html()==""){

                $.post(url,data,function(response){
                    let contributor_html='';
                    $.each(response,function(index, res){
                        contributor_html+='<li class="task-list-item done">';
                        contributor_html+='<div class="row">'
                        contributor_html+='<div class="form-group col-sm-3">'
                        contributor_html+='<input type="checkbox" class="contributor_check" name=contributor[] value="'+res.contributor_id+'"> '+res.firstname+' '+res.lastname
                        contributor_html+='</div>'
                        contributor_html+='<div class="form-group col-sm-3">'
                        contributor_html+='<label class="control-label">Price</label>'
                        contributor_html+='<input type="text"  name="price[]" class="form-control contributor_price" value=""/> '
                        contributor_html+='<input type="hidden"  name="item_id[]"  class="form-control contributor_item" value="'+res.item_id+'"/> '
                        contributor_html+='</div>'
                        contributor_html+='</div>'
                        contributor_html+='</li>'

                    })  

                    $this.parents('li.mt-list-item').find("ul.contributor_list").html(contributor_html) 
                    
                    if($this.find('.checkbox_check').is(":checked")){
                        $this.parents('li.mt-list-item').find(".contributor_check").prop("checked",true);
                        $this.parents('li.mt-list-item').find(".contributor_price").prop("required",true);
                    }
                    else{
                        $this.parents('li.mt-list-item').find(".contributor_check").prop("checked",false);
                        $this.parents('li.mt-list-item').find(".contributor_price").prop("required",false);
                    }
                })
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
        $(this).parents('li.task-list-item').find('.contributor_price').prop("disabled",false);
        $(this).parents('li.task-list-item').find('.contributor_item').prop("disabled",false);
        
        if(!$(this).is(':checked')){
            $(this).parents('li.task-list-item').find('.contributor_price').prop("required",false);
            $(this).parents('li.task-list-item').find('.contributor_price').prop("disabled",true);
            $(this).parents('li.task-list-item').find('.contributor_item').prop("disabled",true);
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
                },
                subject:{
                    required:true
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

        $('#exam_id').on('change',function(){
            let exam_id=$(this).val();
            let data={
                exam_id:exam_id
            }
            let url="{{route('ajaxAddCourseExamPaper')}}"
            $.post(url,data,function(response){
                $("#paper-section").html('');
                if ( response.length != 0 ){

                    let paperhtml='<label class="control-label">Paper</label>';
                        paperhtml+='<span class="required" aria-required="true"> * </span>';
                        paperhtml+='<div class="check-list ">';
                    $.each(response,function(key,res){
                        paperhtml+='<div class="paper-sub-section">';
                        paperhtml+='<label class="check-inline" for="example-inline-check-'+key+'">';
                        //paperhtml+='<div class="checker" id="example-inline-check-'+key+'"><span>';
                        paperhtml+='<input id="example-inline-check-'+key+'" class="paper_check" type="checkbox" value="'+res.id+'" name="paper_list[]">';
                        //paperhtml+='</span></div>';
                        paperhtml+=res.paper_name;
                        paperhtml+='</label>';
                        paperhtml+='<div class="material-section"></div>';
                        paperhtml+='</div>';
                        
                    })
                        paperhtml+='</div>';
                                                                    
                    $("#paper-section").html(paperhtml);                                      
                }
            })  

      
        })
        $(document).on('click','.paper_check',function(){
            var $this=$(this);
            let exam_id=$("#exam_id").val();
            let paper_id=$(this).val();
            let data={
                exam_id:exam_id,
                paper_id:paper_id
            }
            let url="{{route('ajaxAddCourseExamPaperMaterial')}}"
            $this.parents('.paper-sub-section').find('.material-section').html('');
            if($(this).is(":checked")){
                $.post(url,data,function(response){
                    

                    if ( response.length != 0 ){
                        let paperhtml='';
                            paperhtml='<div class="check-list paper-material-list">';
                        $.each(response,function(key,res){
                            paperhtml+='<label class="check col-sm-12" for="example-check-'+key+'">';
                            paperhtml+='<input id="example-check-'+key+'" class="material-list-check" type="checkbox" value="'+res.material_id+'" name="material_list[]">';
                            paperhtml+=res.material_name;
                            paperhtml+='</label>';
                            
                        })
                            paperhtml+='</div>';
                                                                        
                            $this.parents('.paper-sub-section').find('.material-section').html(paperhtml);   
                            $this.parents('.paper-sub-section').find('.material-section').find('input.material-list-check').prop('checked',true);                                   
                    }
                    
                })  
            }    
      
        })
   
</script>  

@endsection
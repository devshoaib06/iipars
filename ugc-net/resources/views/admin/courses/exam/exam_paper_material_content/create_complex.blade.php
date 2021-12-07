@extends('admin.layouts.app')

@section('page_title')
Exams Paper
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

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
                                    <span class="caption-subject  sbold ">Add Exam Paper Material Content
                                    </span>
                                </div>
                               
                            </div>

                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{route('createExamPaperMaterialContent')}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                            <label class="control-label col-sm-3">Subject <span class="required"> * </span></label>
                                            <div class="col-sm-6">
                                                <select name="subject" id="subject" class="form-control">
                                                    <option value="">Select Subject</option>
                                                @foreach($subjects as $subject)   
                                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <?php $i=1;?>   
                                        @foreach ($exam_paper_materials as $exam_paper_material)
                                        <div class="main-material-content">                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3"></label>
                                                <label class="col-md-6">
                                                <input type="checkbox" name="exam_paper_material[]" class="exam_paper_material" value="{{$exam_paper_material->id}}">
                                                
                                                    {{$exam_paper_material->exam_name .'-'. $exam_paper_material->paper_name}} 
                                               
                                                    <span class="display-hide">
                                                        <input type="checkbox" name="exam_id[]" class="exam_id " value="{{$exam_paper_material->exam_id}}">
                                                        <input type="checkbox" name="paper_id[]" class="paper_id " value="{{$exam_paper_material->paper_id}}">                                                
                                                    </span>
                                                    
                                                <?php
                                                    $myFunction=new App\library\myFunctions();
                                                    $material_lists=explode(',',$exam_paper_material->material_list);
                                               
                                                ?>
                                                <ul>
                                                 
                                                @foreach ($material_lists as $mlist)
                                                    <?php $material_name=$myFunction->getMaterialName($mlist); 
                                                   
                                                    ?>
                                                    <label class="checkbox" for="example-checkbox-{{$i}}">
                                                    <input id="example-checkbox-{{$i}}" type="checkbox" 
                                                        class="study_material"
                                                        value="{{$mlist}}" name="material_list[]"
                                                    > 
                                                        {{$material_name}}
                                                    </label>
                                                    <div class="study-materail-section">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Upload Material</label>
                                                            <div class="col-md-6">
                                                            <input type="file" name="material_content_files_{{$exam_paper_material->id}}_{{$mlist}}[]" multiple>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group"><label class="control-label col-md-5">--OR--</label></div>                                                                  
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Videos</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control " name="videos[]" size="16" type="text" value="{{ old('videos') }}" />
                
                                                            </div>
                                                        </div> 
                                                        <div class="video_parent_class">
                                                        <div id="dynamic_field">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-6">
                                                            <button type="button" name="add"  class="btn btn-success add_more">Add Youtube Video</button>
                                                            </div>
                                                        </div> 
                                                        </div>  
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Contributor(s)</label>
                                                                
                                                            </div>
                                                            <div class="form-group contributor-list">
                                                                
                                                            </div> 
                                                        </div>                                                               
                                                    </div>
                                                   
                                                    <?php
                                                        //}
                                                    $i++;
                                                    ?>
                                                @endforeach
                                                </ul>
                                                </label>
                                                
                                            </div>
                                             
                                        </div>
                                         @endforeach
                                        {{-- <div class="form-group">
                                            <label class="control-label col-md-3">Materials
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6 material-list">
                                                @foreach ($allMaterials as $material)
                                                 <label class="radio-inline" for="example-inline-checkbox">
                                                 <input id="example-inline-checkbox" type="checkbox" value="{{$material->id}}" name="material_list[]"> {{$material->material_name}}</label>
                                                    
                                                @endforeach
                                                
                                             </div>
                                             <div class="material-list-error"></div>
                                        </div>  --}}
                                        

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
                                                <a href="{{ route('exam-paper') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

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
    /*form1.on('submit', function() {
        for(var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
    })*/
    
    form1.validate({
    errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ".ignore", // validate all fields including form hidden input
            rules: {
                exam: {
                        required: true
                },
                paper: {
                        required: true
                },
                "material_list[]":{
                    required:true
                }
                                 
            },
            messages: {

                exam_name: {
                    required: 'Exam Name is required.',
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("data-error-container")) { 
                    error.appendTo(element.attr("data-error-container"));
                } 
                else if(element.attr("name") == "material_list[]" ){
                    error.appendTo(".material-list");
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
  $('#exam').on('change',function(){
        let exam_id=$(this).val();
        let data={
            exam_id:exam_id
        }
        let url="{{route('ajaxExamPaper')}}"
        $.post(url,data,function(response){
            let paperhtml='<option value="">Select paper</option>';
            $.each(response,function(key,res){
                paperhtml+='<option value="'+res.id+'" >'+res.paper_name+'</option>';
            })
             $("#paper").html(paperhtml);                                      
        })  

      
  })  

  let i=1;
  $('.study-materail-section').hide();
  let dynamichtml='';
    $('.add_more').click(function(){
        i++;
        
   
        $(this).parents('.video_parent_class').find('#dynamic_field').append('<div class="row" id="row'+i+'"><label class="control-label col-md-3"></label><div class="form-group col-sm-6 p-rel"><input type="text" name="videos[]" placeholder="Video Url" class="form-control" /><a href="javascript:;" id="'+i+'" data-repeater-delete class="btn btn-danger btn_remove p-art"><i class="fa fa-close"></i></a></div></div>');  
      }); 
    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
    });
    $(document).on('click', '.study_material', function(){ 
        
        $(this).parents('.main-material-content').find('.study-materail-section').toggle();
        

    });

    $('#subject').on('change',function(){
        $(this).val();
        let contributorhtml="";

        let url="{{route('ajaxSubjectContributor')}}";
            let data={
                subject_id:$(this).val()
            };
            $.post(url,data,function(response){
                let i=1;
                $.each(response,function(index,result){
                    contributorhtml+='<label class="control-label col-md-3"></label>'
                    contributorhtml+='<div class="col-md-3">'
                    contributorhtml+='<label class="checkbox" for="example-checkbox-'+i+'">'
                    contributorhtml+='<input id="example-checkbox-'+i+'" type="checkbox" value="'+result.contributor_id+'" name="contributor_list[]">'+result.firstname+' '+result.lastname +'</label>'
                    contributorhtml+='</div>'
                    contributorhtml+='<label class="control-label col-sm-3">Price</label>'
                    contributorhtml+='<div class="col-sm-3">'
                    contributorhtml+='<input type="text" name="price[]" class="form-control contributor_price" value="">'
                    contributorhtml+='<input type="hidden" name="item_id[]" class="form-control contributor_item" value="7">' 
                    contributorhtml+='</div>'

                })
                
                $('.contributor-list').html(contributorhtml);
            })

    })
    
    $('.exam_paper_material').click(function(){
        $(this).parents(".main-material-content").find(".sub-material").click()
        $(this).parents(".main-material-content").find(".study_material").click()
        $(this).parents(".main-material-content").find(".exam_id").click()
        $(this).parents(".main-material-content").find(".paper_id").click()
    })

});

</script>


@endsection

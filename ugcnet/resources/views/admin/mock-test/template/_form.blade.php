@extends('admin.layouts.app')

@section('page_title')
{{$pagetitle}}
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
                                    <span class="caption-subject  sbold ">{{$pagetitle}}
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{$form_url}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                            <label class="control-label col-md-3">Name
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                            <input type="text" name="name" value="{{isset($mocktemplate)?$mocktemplate->name:''}}" class="form-control" />
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Duration (In Minutes)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <input type="text" name="duration" class="form-control" value="{{isset($mocktemplate)?$mocktemplate->duration:''}}" />

                                            </div>
                                            @if ($errors->has('duration'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('duration') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tabulation Rule
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <select name="tabulation_rule_id" id="tabulation_rule_id" class="form-control">
                                                    <option value="">Select Rule</option>
                                                    @foreach ($rules as $rule)
                                                    <option value="{{$rule['id']}}" 
                                                    @if(isset($mocktemplate))
                                                        @if($mocktemplate->tabulation_rule_id == $rule['id']) selected @endif
                                                    @endif
                                                    >{{$rule['name']}}</option>
                                                    @endforeach
                                                </select> 

                                            </div>
                                            @if ($errors->has('duration'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('duration') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                                
                                                <div class="col-md-2">Level <span class="required"> * </span></div>
                                            <div class="col-md-2">No. of Questions <span class="required"> * </span></div>
                                            <div class="col-md-2">Marks per Question</div>
                                            
                                        </div>
                                        @php
                                            $j=1;
                                        @endphp  
                                        @forelse ($templateDetails as $templateDetail)
                                        <div class="form-group" id="clonerow">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <select name="level_id[]" id="level_id" class="form-control "  >
                                                    <option value="">Select Level</option>
                                                    @foreach ($question_levels as $question_level)
                                                    <option value="{{$question_level['id']}}" 
                                                    @if(isset($templateDetail))
                                                        @if($templateDetail->level_id == $question_level['id']) selected @endif
                                                    @endif
                                                    
                                                    >{{$question_level['name']}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('level_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('level_id') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="number_of_questions[]" value="{{isset($templateDetail)?$templateDetail->number_of_questions:''}}" class="form-control" />
                                                
                                            @if ($errors->has('number_of_questions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('number_of_questions') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="marks_per_question[]" value="{{isset($templateDetail)?$templateDetail->marks_per_question:''}}" class="form-control" />
                                            @if ($errors->has('marks_per_question'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('marks_per_question') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            
                                        
                                            @if ($j>1)
                                                    
                                                    <label class="col-md-1 removeBtn"><input class="btn red"  type="button" value="-" onclick="removeRow(this)"></label>
                                                @endif
                                        </div>
                                        @php
                                            $j++;
                                        @endphp  
                                        @empty
                                            
                                        <div class="form-group" id="clonerow">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <select name="level_id[]" id="level_id" class="form-control "  >
                                                    <option value="">Select Level</option>
                                                    @foreach ($question_levels as $question_level)
                                                    <option value="{{$question_level['id']}}" 
                                                    @if(isset($mocktemplate))
                                                        @if($mocktemplate->level_id == $question_level['id']) selected @endif
                                                    @endif
                                                    
                                                    >{{$question_level['name']}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('level_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('level_id') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="number_of_questions[]" value="{{isset($mocktemplate)?$mocktemplate->number_of_questions:''}}" class="form-control" />
                                                
                                            @if ($errors->has('number_of_questions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('number_of_questions') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="marks_per_question[]" value="{{isset($mocktemplate)?$mocktemplate->marks_per_question:''}}" class="form-control" />
                                            @if ($errors->has('marks_per_question'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('marks_per_question') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            
                                        
                                            <label class="col-md-1 removeBtn"></label>
                                        </div>
                                        @endforelse
                                        <div id="divitems">
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-9 text-right">
                                                
                                                <input type="button" value="Add More" class="btn green" onclick="addNewRow()" />
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="example-inline-radio1" type="radio" value="1" name="is_active" {{isset($mocktemplate)?$mocktemplate->is_active==1?'checked':'':'checked'}} > Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="is_active" {{isset($mocktemplate)?$mocktemplate->is_active==0?'checked':'':''}}> Inactive</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="{{ route('showMockTemplateList') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
                                name: {
                                    required: true
                                },
                                duration: {
                                    required: true,
                                    number:true,
                                    min:1
                                },
                                "level_id[]": {
                                    required: true
                                },
                                "number_of_questions[]": {
                                    required: true,
                                    number:true,
                                    min:1
                                },
                                "tabulation_rule_id":{
                                    required: true

                                }

                               
                                
                        },
                        messages: {
                            name: {
                                required: ' Name is required.'
                            },
                            duration: {
                                required: 'Duration is required.',
                                min:'Enter valid duration'
                            },
                            "number_of_questions[]": {
                                    required: 'No. of Question is required.',
                                    min:'No. of Question must be valid'

                            },
                            "level_id[]": {
                                    required: 'Level is required.'
                            },
                            "tabulation_rule_id":{
                                    required:  'Rule is required.'

                            },
                            image: {
                                required: 'Image is required.',
								extension: "Only images are allowed."

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

var $i=1;

function addNewRow(){
    
    var htmldata=$('#divitems').html();
        $('#divitems').append("<div id='divdynamicitems"+$i+"' class='appendedrow'></div>");


        // Create clone of <div class='input-form'>
        var newel = $('#clonerow:last').clone();
       
        newel.appendTo("#divdynamicitems"+$i);

        
        $("#divdynamicitems"+$i).find('.removeBtn').append('<input class="btn red"  type="button" value="-"  onclick="removeItem('+$i+')">');
        
        $i++;
}
function removeItem($j){
	$("#divdynamicitems"+$j).remove();
}
function removeRow(_this){
       
       $(_this).parents("#clonerow").remove();
}

</script>
@endsection
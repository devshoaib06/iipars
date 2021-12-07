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
<style>
    .is_correct_check{
        display: none;
    }
</style>
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
                                    <span class="caption-subject  sbold ">Add Question
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{route('editMockQuestionAction',['id'=>\Hasher::encode($question->id)])}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                            <label class="control-label col-md-3">Question
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                {{-- <input type="text" name="question" class="form-control"  value="{{old('question')}}"/>  --}}
                                                <textarea name="question" rows="8" class="form-control" >{{$question->question}}</textarea>
                                            </div>
                                            @if ($errors->has('question'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                            <div class="col-md-2">Exam</div>
                                            <div class="col-md-2">Paper</div>
                                            <div class="col-md-2">Subject</div>
                                            <div class="col-md-2">Level</div>
                                        </div>
                                        @php
                                            $j=1;
                                        @endphp
                                        @forelse($question_details as $question_detail)
                                            @php
                                                $myFunction=new  \App\library\myFunctions;
                                                $papers=$myFunction->getExamPaper($question_detail->exam_id);
                                            @endphp
                                            <div class="form-group" id="clonerow">
                                                <div class="control-label col-md-3">
                                                    
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="exam_id[]" id="exam_id" class="form-control exam_id"  >
                                                        <option value="">Select Exam</option>
                                                        @foreach ($exams as $exam)
                                                        <option value="{{$exam['id']}}" 
                                                        @if ($question_detail->exam_id==$exam['id'])
                                                            selected
                                                        @endif
                                                        
                                                        >{{$exam['exam_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('level_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('level_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="paper_id[]" id="paper-section" class="form-control paper-section"  >
                                                        <option value="">Select Paper</option>
                                                        @foreach ($papers as $paper)
                                                        <option value="{{$paper['id']}}" 
                                                        @if ($question_detail->paper_id==$paper['id'])
                                                            selected
                                                        @endif
                                                        
                                                        >{{$paper['paper_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                @if ($errors->has('level_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('level_id') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="subject_id[]" id="subject_id" class="form-control subject-section" >
                                                        <option value="">Select Subject</option>
                                                        @foreach ($subjects as $subject)
                                                        <option value="{{$subject['id']}}" 
                                                        @if ($question_detail->subject_id==$subject['id'])
                                                            selected
                                                        @endif
                                                        
                                                        >{{$subject['subject_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                @if ($errors->has('subject_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <select name="level_id[]" id="level_id" class="form-control "  >
                                                        <option value="">Select Level</option>
                                                        @foreach ($question_levels as $question_level)
                                                        <option value="{{$question_level['id']}}" 
                                                        @if ($question_detail->level_id==$question_level['id'])
                                                            selected
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
                                                @if ($j>1)
                                                    
                                                    <label class="col-md-1 removeBtn"><input class="btn red"  type="button" value="-" onclick="removeRow(this)"></label>
                                                @else    
                                                    <label class="col-md-1 removeBtn"></label>
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
                                                <select name="exam_id[]" id="exam_id" class="form-control exam_id"  >
                                                    <option value="">Select Exam</option>
                                                    @foreach ($exams as $exam)
                                                    <option value="{{$exam['id']}}" 
                                                   
                                                    
                                                    >{{$exam['exam_name']}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('level_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('level_id') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <select name="paper_id[]" id="paper-section" class="form-control paper-section"  >
                                                    <option value="">Select Paper</option>
                                                    @foreach ($papers as $paper)
                                                    <option value="{{$paper['id']}}" 
                                                    @if(isset($mocktemplate))
                                                        @if($mocktemplate->paper_id == $paper['id']) selected @endif
                                                    @endif
                                                    
                                                    >{{$paper['paper_name']}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('level_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('level_id') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <select name="subject_id[]" id="subject_id" class="form-control subject-section" >
                                                    <option value="">Select Subject</option>
                                                    @foreach ($subjects as $subject)
                                                    <option value="{{$subject['id']}}" 
                                                    @if(isset($mocktemplate))
                                                        @if($mocktemplate->subject_id == $subject['id']) selected @endif
                                                    @endif
                                                    
                                                    >{{$subject['subject_name']}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('subject_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('subject_id') }}</strong>
                                            </span>
                                            @endif
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
                                            <label class="col-md-1 removeBtn"></label>
                                        </div>  
                                        @endforelse
                                        <div id="divitems">
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-11 text-right">
                                                
                                                <input type="button" value="Add More" class="btn green" onclick="addNewRow()" />
                                            </div>

                                        
                                        </div>
                                      
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Option Type <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="option_type_1">
                                                    <input id="option_type_1" type="radio" value="0" name="option_type" {{$question->option_type==0?'checked':''}} > None</label>
                                                <label class="radio-inline" for="option_type_2">
                                                    <input id="option_type_2" type="radio" value="1" name="option_type" {{$question->option_type==1?'checked':''}} > Simple</label>
                                                <label class="radio-inline" for="option_type_3">
                                                    <input id="option_type_3" type="radio" value="2" name="option_type" {{$question->option_type==2?'checked':''}} > Conjugate</label>    
                                            </div>
                                        </div>
                                        
                                        
                                        @if ($question->option_type==0)
                                        @include('admin.mock-test.questions_master._none')
                                            
                                        @endif
                                        @if ($question->option_type==1)
                                            @include('admin.mock-test.questions_master._simple')

                                            
                                        @endif
                                        @if ($question->option_type==2)
                                            @include('admin.mock-test.questions_master._conjugate')
                                            
                                        @endif
                                        <div id="divans" class="divans"></div>
                                        <div class="form-group">
                                            <div class="control-label col-md-9 text-right">
                                                
                                                <input type="button" value="Add More Answer" class="btn green" onclick="addNewAns()" />
                                            </div>


                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label col-md-3">Answer explanation
                                                
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <textarea name="correct_clarification" rows="8" class="form-control" >{{$question->correct_clarification}}</textarea>
                                            </div>
                                            @if ($errors->has('correct_clarification'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('correct_clarification') }}</strong>
                                            </span>
                                            @endif
                                        </div> --}}

                                        
                                        
                                        
                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="example-inline-radio1" type="radio" value="1" name="is_active"  {{$question->is_active==1?'checked':''}} > Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="is_active"{{$question->is_active==0?'checked':''}} > Inactive</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="{{ route('showMockQuestionList') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
                                question: {
                                    required: true
                                },
                                "exam_id[]":{
                                    required: true

                                },
                                "paper_id[]":{
                                    required: true

                                },
                                "subject_id[]":{
                                    required: true

                                },
                                "level_id[]":{
                                    required: true

                                },
                                correct: {
                                    required: true
                                },
                                options1: {
                                    required: true
                                },
                                options2: {
                                    required: true
                                },
                                'category': {
                                    required: true
                                },
                                
                                
                        },
                        messages: {
                            name: {
                                required: 'Full Name is required.'
                            },
                            qualification: {
                                required: 'Qualification is required.'
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

            $('body').on('change','.exam_id',function(){
                debugger
                let exam_id=$(this).val();
                var $this=$(this).parents('.appendedrow').attr('id');
                //console.log($this);
                let data={
                    exam_id:exam_id
                }
                let url="{{route('ajaxCourseExamPaper')}}"
                $.post(url,data,function(response){
                    //$("#paper-section").html('');
                    if ( response.length != 0 ){

                        let paperhtml=subjecthtml='';
                        
                        $.each(response.paperlist,function(key,res){
                            paperhtml+='<option value="'+res.paper_id+'">';
                            paperhtml+=' '+res.paper_name;
                            paperhtml+='</option>';
                        })  
                        $.each(response.allSubjects,function(key,res){
                            subjecthtml+='<option value="'+res.id+'">';
                            subjecthtml+=' '+res.subject_name;
                            subjecthtml+='</option>';
                        })
                        if($this==undefined){
                            $(".paper-section:first").html(paperhtml);
                            $(".subject-section:first").html(subjecthtml);
                        }else{

                            $("#"+$this).find(".paper-section").html(paperhtml);                                      
                            $("#"+$this).find(".subject-section").html(subjecthtml);                                      
                        }                                         
                    }
                })  

      
            });

            $('body').on('click','.is_check',function(){
                debugger
                $('.is_check').not(this).closest('span').removeClass('checked');
                $('.is_check').not(this).prop('checked', false);
                
                var data=$(this).data('val');
                var el=$(this);
                showAnsExp(data);
                
                if(el.is(":checked")){
                    $(this).closest('.is_correct_span').addClass('checked');
                }else{
                    $(this).closest('.is_correct_span').removeClass('checked');
                    
                }
                //$('input:checkbox').not(this).attr('checked', 'checked');
                // $('.is_check').attr("checked", false);
                // $(this).attr("checked", true); 
                //$('.is_check').not(this).closest('.is_correct_span').removeClass('checked');
            })
        });
        $("#form_sample_1").submit(function(){
});

var $i=$k=1;
//Clone Exam/Paper Row
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

//End Exam/Paper Row
//Add New Anwer 

function addNewAns(){
    var _clonelength=($('.cloneans').length)+1;

     
    
var htmldata=$('#divans').html();
var rowData='<div id="divdynamicans'+_clonelength+'"><div class="form-group cloneans" >'
    rowData+='<label class="control-label col-md-3"> Answer #'+_clonelength+'<span class="required"> &nbsp; </span></label> ';
    rowData+='<div class="col-md-1">';
    rowData+='<input type="text" name="ans_serial_no'+_clonelength+'" class="form-control"  value=""/>'
                    
    rowData+='</div>';
    rowData+='<div class="col-md-5">';
    rowData+='<input type="text" name="answer_'+_clonelength+'" class="form-control"  value=""/>'
    rowData+='</div>'
    rowData+='<div class="col-md-1">';
    rowData+='<div class="checker"><span class="is_correct_span"><input type="checkbox" id="ans_'+_clonelength+'" name="is_correct'+_clonelength+'" data-val="'+_clonelength+'" class="form-control is_check" value="1"></span></div> ';
    rowData+='<input class="btn red"  type="button" value="-"  onclick="removeAns('+_clonelength+')">';
    rowData+='</div>';
    // //rowData+='<div class="checker"><span><input type="checkbox" name="is_correct'+_clonelength+'" class="form-control" value="1"></span></div> ';
    rowData+='<div class="col-md-1">';
    rowData+='</div>';
    rowData+='</div>';

    rowData+='<div class="form-group ansexp'+_clonelength+' anstext is_correct_check" >'
    rowData+='<label class="control-label col-md-3"> Answer Explanation #'+_clonelength+'<span class="required"> &nbsp; </span></label> ';
  
    rowData+='<div class="col-md-6">';
    rowData+='<textarea name="correct_explanation'+_clonelength+'" rows="8" class="form-control" ></textarea>'
    rowData+='</div>'
    rowData+='</div>';
    rowData+='</div>';

   
   
    
        $('.divans').append(rowData);
    
    
    $k++;
}


function removeAns($j){
	$("#divdynamicans"+$j).remove();
}
function removeRow(_this){
       
    $(_this).parents("#clonerow").remove();
} 

function removeCloneRow(_this){
       
       $(_this).parents(".clonerow").remove();
} 
   

//Clone Opt Simple Opt
function addNewSimpleOpt(){
    var _clonelength=($('.cloneOpt').length)+1;

     
    
    var htmldata=$('#divopt').html();
    var rowData='<div class="form-group cloneOpt" id="divdynamicOpt'+_clonelength+'">'
        rowData+='<label class="control-label col-md-3"> Option #'+_clonelength+'<span class="required"> &nbsp; </span></label> ';
        rowData+='<div class="col-md-1">';
        rowData+='<input type="text" name="option_no'+_clonelength+'" class="form-control"  value=""/>'
                        
        rowData+='</div>';
        rowData+='<div class="col-md-5">';
        rowData+='<input type="text" name="option_text'+_clonelength+'" class="form-control"  value=""/>'
        rowData+='</div>'
    
    
        rowData+='<div class="col-sm-1 removeBtn"><input class="btn red"  type="button" value="-"  onclick="removeOpt('+_clonelength+')"></div>';
        
            $('.divopt').append(rowData);
        
        
        $k++;
}
function removeOpt($j){
	$("#divdynamicOpt"+$j).remove();
}

//Clone Opt Conjugate Opt
function addNewConjugateOpt(){
    var _clonelength=($('.cloneOpt').length)+1;

     
    
    var htmldata=$('#divopt').html();
    var rowData='<div class="form-group cloneOpt" id="divdynamicOpt'+_clonelength+'">'
        rowData+='<label class="control-label col-md-3"> Option #'+_clonelength+'<span class="required"> &nbsp; </span></label> ';
        rowData+='<div class="col-md-1">';
        rowData+='<input type="text" name="option_no'+_clonelength+'" class="form-control"  value=""/>'
        rowData+='</div>';
        rowData+='<div class="col-md-3">';
        rowData+='<input type="text" name="option_text'+_clonelength+'" class="form-control"  value=""/>'
        rowData+='</div>'
        rowData+='<div class="col-md-1">';
        rowData+='<input type="text" name="option_col_no'+_clonelength+'" class="form-control"  value=""/>'
        rowData+='</div>';
        rowData+='<div class="col-md-3">';
        rowData+='<input type="text" name="option_col_text'+_clonelength+'" class="form-control"  value=""/>'
        rowData+='</div>'
    
    
        rowData+='<div class="col-sm-1 removeBtn"><input class="btn red"  type="button" value="-"  onclick="removeOpt('+_clonelength+')"></div>';
        
            $('.divopt').append(rowData);
        
        
        $k++;
}

function showAnsExp($k){
    debugger
    $('.anstext').hide();
    if($("#ans_"+$k).is(':checked')){

        $(".ansexp"+$k).show();
    }
   


}

</script>
@endsection
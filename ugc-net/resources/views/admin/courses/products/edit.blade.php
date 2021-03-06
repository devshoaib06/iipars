@extends('admin.layouts.app')

@section('page_title')
Course - Edit
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet"
    type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
    rel="stylesheet" type="text/css" />

<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
    rel="stylesheet" type="text/css" />
<link
    href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
    rel="stylesheet" type="text/css" />

<link href="{{config('path.assets_path')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
    type="text/css" />
<link href="{{config('path.assets_path')}}/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"
    rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
    rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
<style>
    .tag_fields {
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
                Edit Course
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
                                <span class="caption-subject font-dark sbold uppercase"> Edit Course -
                                    {{$product->name}}
                                </span>
                            </div>

                            <div class="actions btn-set">


                                <button class="btn btn-secondary-outline"
                                    onclick="location.href = '{{url(route('courses'))}}';">
                                    <i class="fa fa-angle-left"></i> Back
                                </button>
                                <button type="submit" class="btn green" id="save-button">
                                    <i class="fa fa-check"></i> Save
                                </button>
                                <button type="submit"  class="btn green" id="duplicate-button">
                                        <i class="fa fa-check"></i> Save & Duplicate
                                    </button>
                                <!--<button class="btn green" id="save_and_duplicate">
                                        <i class="fa fa-check"></i> Save & Duplicate
                                    </button>-->
                            </div>
                        </div>
                        <div class="portlet-body">

                            <form role="form"
                                action="{{route('editCourseAction',['id'=>\Hasher::encode($product->product_id)])}}"
                                id="course_info_form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please
                                    check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is
                                    successful! </div>

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
                                                            <input type="hidden" name="request_type">
                                                            <div class="form-group">
                                                                <label class="control-label">Exam <span
                                                                        class="required"> * </span></label>
                                                                <select name="exam_id" id="exam_id"
                                                                    class="form-control">
                                                                    <option value="">Select Exam</option>
                                                                    @foreach($allExams as $exam)
                                                                    <option value="{{$exam->id}}"
                                                                        {{$relatedexam==$exam->id?'selected':''}}>
                                                                        {{$exam->exam_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            {{-- <div class="form-group" id="paper-section">
                                                                <label class="control-label">Paper <span
                                                                        class="required"> * </span></label>
                                                                <select name="paper_list[]" id="paper_id"
                                                                    class="form-control">
                                                                    <option value="">Select Paper</option>
                                                                    @foreach($allPapers as $paper)
                                                                    <option value="{{$paper->paper_id}}"
                                                            {{$relatedPapers[0]==$paper->paper_id?'selected':''}}>
                                                            {{$paper->paper_name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div> --}}
                                                        <div class="form-group " id="paper-section">
                                                            <label class="control-label prevpaper">Paper <span
                                                                    class="required"> * </span></label>
                                                            <div class="check-list">
                                                                <?php
                                                                        
                                                                    ?>
                                                                @foreach ($allPapers as $paper)
                                                                <div class="paper-sub-section ">
                                                                    <label class="check-inline"
                                                                        for="example-radio{{$paper->paper_id}}">
                                                                        <input id="example-radio{{$paper->paper_id}}"
                                                                            type="checkbox" value="{{$paper->paper_id}}"
                                                                            name="paper_list[]" class="paper_check"
                                                                            {{in_array($paper->paper_id,$relatedPapers)?'checked':''}}>
                                                                        {{$paper->paper_name}}
                                                                    </label>
                                                                    <div class="subject-related-section {{in_array($paper->paper_id,$relatedPapers)?'':'hide'}}">
                                                                        <div class="material-section">
    
                                                                            <div class="check-list paper-material-list">
    
                                                                                <label class="check col-sm-12">
                                                                                    <input class="material-list-all-check"
                                                                                        type="checkbox" value="1"
                                                                                        name="all_material{{$paper->paper_id}}[]"
                                                                                        {{@in_array('1',$all_material_array[$paper->paper_id])?'checked':''}}>All
                                                                                </label>
    
                                                                                @foreach ($related_materials as
                                                                                $key=>$material)
                                                                                @if($paper->paper_id==$material['paper_id'])
    
                                                                                <label class="check col-sm-12">
                                                                                    <input class="material-list-check"
                                                                                        type="checkbox"
                                                                                        value="{{$material['material_id']}}"
                                                                                        name="material_list{{$paper->paper_id}}[]"
                                                                                        {{@in_array($material['material_id'],$selectedmaterials[$paper->paper_id])?'checked':''}}>{{$material['material_name']}}
                                                                                </label>
                                                                                @endif
                                                                                @endforeach
    
                                                                            </div>
                                                                        </div>
                                                                        <div class="subject-section">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label subject-info">Units
                                                                                    <span class="required"> *
                                                                                    </span></label>
                                                                                <div class="radio-list subject-list">
                                                                                    @php
                                                                                        $allSubjects=$myFunction->getPaperAdminUnits($exam_id = 1, $paper->paper_id);
                                                                                        // echo "<pre>";
                                                                                        //     print_r($relatedSubjects);
                                                                                        // echo "<pre>";
    
                                                                                    @endphp
                                                                                    <label class="">
                                                                                        <input class="subject-list-all-check"
                                                                                            type="checkbox" value="1"
                                                                                            name="all_subject{{$paper->paper_id}}[]"
                                                                                            >All
                                                                                    </label>
                                                                                    @foreach ($allSubjects as $subject)
                                                                                    <label class="radio-inline"
                                                                                        for="example-inline-radio{{$paper->paper_id}}-{{$subject->id}}">
                                                                                        <input
                                                                                            id="example-inline-radio{{$paper->paper_id}}-{{$subject->id}}"
                                                                                            type="checkbox"
                                                                                            class="subject-list-check"
                                                                                            value="{{$subject->id}}"
                                                                                            name="subject_list{{$paper->paper_id}}[]"
                                                                                            {{@in_array($subject->id,$relatedSubjects[$paper->paper_id])?'checked':''}}>
                                                                                        {{$subject->subject_name}}
                                                                                    </label>
                                                                                    @endforeach
    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                        

                                                            

                                            <div class="form-group">
                                                <label class="control-label">Name <span class="required"> *
                                                    </span></label>
                                                <input type="text" name="g_name" class="form-control"
                                                    value="{{$product->name}}" />
                                                @if ($errors->has('g_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('g_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Intro Text <span class="required"> *
                                                    </span></label>
                                                <textarea name="intro_text" id="intro_text"
                                                    class="form-control">{{$product->intro_text}}</textarea>
                                                @if ($errors->has('intro_text'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('intro_text') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Short Description <span class="required"> *
                                                    </span></label>
                                                <textarea name="s_description" id="s_description"
                                                    class="form-control">{{$product->short_description}}</textarea>
                                                @if ($errors->has('s_description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('s_description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description <span class="required"> *
                                                    </span></label>
                                                <textarea id="pdesc" class="ckeditor form-control" rows="3"
                                                    name="description" data-error-container="#description_error">
                                                                    {{$product->description}}  
                                                                    </textarea>
                                                @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Important Notice <span class="required"> *
                                                    </span></label>
                                                <textarea id="inote" class="ckeditor form-control" rows="3"
                                                    name="important_notice"
                                                    data-error-container="#important_notice_error">
                                                                      {{$product->important_notice}}
                                                                    </textarea>
                                                @if ($errors->has('important_notice'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('important_notice') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Price  <span class="required"> *
                                                    </span></label>
                                                <input type="text" name="course_price" id="course_price"
                                                    class="form-control" value="{{$product->price}}" />
                                                @if ($errors->has('course_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('course_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Revised Percent (%)
                                                     </label>
                                                <input type="text" name="revised_percent" id="revised_percent"
                                                    class="form-control" value="{{$product->revised_percent}}" />
                                                @if ($errors->has('revised_percent'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('revised_percent') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Extra Discount
                                                     </label>
                                                <input type="text" name="extra_discount" id="extra_discount"
                                                    class="form-control" value="{{$product->extra_discount}}" />
                                                @if ($errors->has('extra_discount'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('extra_discount') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Revised Price  </label>
                                                <input type="text" name="revised_price" id="revised_price"
                                                    class="form-control" value="{{$product->revised_price}}" />
                                                @if ($errors->has('revised_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('revised_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group hide">
                                                <label class="control-label">No. of Students
                                                </label>
                                                <input type="text" name="no_of_students" id="no_of_students"
                                                    class="form-control" value="{{$product->no_of_students}}" />
                                                @if ($errors->has('no_of_students'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_students') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Start Date <span class="required"> *
                                                    </span></label>
                                                <input class="form-control  date-picker" name="start_date" size="16"
                                                    type="text"
                                                    value="{{\Carbon\Carbon::parse($product->start_date)->format('d/m/Y')}}" />

                                                @if ($errors->has('start_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">End Date <span class="required"> *
                                                    </span></label>
                                                <input class="form-control  date-picker" name="end_date" size="16"
                                                    type="text"
                                                    value="{{\Carbon\Carbon::parse($product->end_date)->format('d/m/Y')}}" />

                                                @if ($errors->has('end_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Meta Title </label>
                                                <input class="form-control" name="meta_title" size="16" type="text"
                                                    value="{{ $product->meta_title}}" />

                                                @if ($errors->has('meta_title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Meta Keywords</label>
                                                <input class="form-control" name="meta_key" size="16" type="text"
                                                    value="{{ $product->meta_key}}" />

                                                @if ($errors->has('meta_key'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_key') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Robots </label>
                                                <input class="form-control" name="meta_robots" size="16" type="text"
                                                    value="{{ $product->meta_robots}}" />

                                                @if ($errors->has('meta_robots'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_robots') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Meta Description
                                                </label>
                                                {{-- <input class="form-control" name="meta_description" size="16" type="text" value="{{ old('meta_description') }}"
                                                /> --}}
                                                <textarea class="form-control" name="meta_description"
                                                    rows="10">{{ $product->meta_description }}</textarea>
                                                @if ($errors->has('meta_description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Slug <span class="required"> *
                                                    </span></label>
                                                <input class="form-control" name="slug" size="16" type="text"
                                                    value="{{ $product->slug}}" />

                                                @if ($errors->has('slug'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('slug') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Cover Image</label>


                                                <!-- <div class="clearfix margin-top-10">
                                                                                     <span class="label label-danger"> NOTE! </span>
                                                                                     <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                                 </div>-->


                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn green btn-file">
                                                        <span class="fileinput-new"> Select </span>
                                                        <span class="fileinput-exists"> Change
                                                        </span>
                                                        <input type="hidden"><input type="file" name="image"> </span>
                                                    <span class="fileinput-filename"> </span> &nbsp;
                                                    <a href="javascript:;" class="close fileinput-exists"
                                                        data-dismiss="fileinput"> </a>
                                                </div>

                                            </div>
                                            @if(!empty($product->image))
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 200px; height: 150px;">

                                                        <img src="{{asset(config('path.course_image')).'/'.$product->image}}"
                                                            alt="" /> </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                        style="max-width: 200px; max-height: 150px;">
                                                    </div>

                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="control-label">Image Alt </label>
                                                <input class="form-control" name="img_alt" size="16" type="text"
                                                    value="{{ $product->img_alt}}" />

                                                @if ($errors->has('img_alt'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('img_alt') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group hide">
                                                <label class="ccontrol-label">Is Featured <span class="required"> *
                                                    </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="featured-inline-radio1">
                                                        <input id="featured-inline-radio1" type="radio" value="1"
                                                            name="is_popular"> Yes</label>
                                                    <label class="radio-inline" for="featured-inline-radio2">
                                                        <input id="featured-inline-radio2" type="radio" value="0"
                                                            name="is_popular" checked> No</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="ccontrol-label">Is Combo Course <span class="required"> *
                                                    </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="combo-course-inline-radio1">
                                                        <input id="combo-course-inline-radio1" type="radio" value="1"
                                                            name="is_combo" {{$product->is_combo==1?'checked':''}}>
                                                        Yes</label>
                                                    <label class="radio-inline" for="combo-course-inline-radio2">
                                                        <input id="combo-course-inline-radio2" type="radio" value="0"
                                                            name="is_combo" {{$product->is_combo==0?'checked':''}}>
                                                        No</label>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="ccontrol-label">Is Preview <span class="required"> *
                                                    </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="preview-inline-radio1">
                                                        <input id="preview-inline-radio1" type="radio" value="1"
                                                            name="is_preview" {{$product->is_preview==1?'checked':''}}>
                                                        Yes</label>
                                                    <label class="radio-inline" for="preview-inline-radio2">
                                                        <input id="preview-inline-radio2" type="radio" value="0"
                                                            name="is_preview" {{$product->is_preview==0?'checked':''}}>
                                                        No</label>
                                                </div>
                                            </div>
                                            @if ($product->is_preview==1)
                                                
                                                <div class="form-group ">
                                                    @php
                                                        $allCourses=$myFunction->getCourses(1,$relatedPapers[0]);
                                                    @endphp
                                                    
                                                    <label class="control-label">Preview Main Course <span class="required"> * </span></label>
                                                    <select name="preview_main_course" id="preview_main_course"
                                                        class="form-control">
                                                        <option value="">Select Main Course</option>
                                                        @foreach($allCourses as $course)
                                                            @if (!empty($course->product))
                                                                <option value="{{$course->product->product_id}}"
                                                                    {{$product->preview_main_course==$course->product->product_id?'selected':''}}>
                                                                    {{$course->product->name}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            <div class="form-group hide">
                                                <label class="ccontrol-label">Show on Home slider
                                                    <span class="required"> * </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="slider-inline-radio5">
                                                        <input id="slider-inline-radio5" type="radio" value="1"
                                                            name="home_slider"
                                                            {{$product->home_slider==1?'checked':''}}>
                                                        Yes</label>
                                                    <label class="radio-inline" for="slider-inline-radio6">
                                                        <input id="slider-inline-radio6" type="radio" value="0"
                                                            name="home_slider"
                                                            {{$product->home_slider==0?'checked':''}}>
                                                        No</label>
                                                </div>
                                            </div>
                                            <div class="form-group hide">
                                                <label class="ccontrol-label">Will Reseller Charge
                                                    apply ? <span class="required"> *
                                                    </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="reseller-inline-radio5">
                                                        <input id="reseller-inline-radio5" type="radio" value="1"
                                                            name="is_reseller_charge"
                                                            {{$product->is_reseller_charge==1?'checked':''}}>
                                                        Yes</label>
                                                    <label class="radio-inline" for="reseller-inline-radio6">
                                                        <input id="reseller-inline-radio6" type="radio" value="0"
                                                            name="is_reseller_charge"
                                                            {{$product->is_reseller_charge==0?'checked':''}}>
                                                        No</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="ccontrol-label">Status <span class="required"> *
                                                    </span></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline" for="status-inline-radio3">
                                                        <input id="status-inline-radio3" type="radio" value="1"
                                                            name="status" {{$product->status==1?'checked':''}}>
                                                        Active</label>
                                                    <label class="radio-inline" for="status-inline-radio4">
                                                        <input id="status-inline-radio4" type="radio" value="0"
                                                            name="status" {{$product->status==0?'checked':''}}>
                                                        Inactive</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--end col-md-9-->
                        </div>
                    </div>


                    <div class="tab-pane" id="tab_3">
                        <div class="row">

                            @foreach($videos as $video)
                            <?php $video_embed_link=$myFunction->parseYouTubeUrl($video->video_url);?>
                            <div class="col-sm-3 pb-30 video">
                                <iframe width="270" height="180"
                                    src="{{$protocol}}://www.youtube.com/embed/<?php echo $video_embed_link;?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>

                                <input type="checkbox" {{in_array($video->id,$product_video)?'checked':''}}
                                    name="video[]" value="{{$video->id}}">{{$video->title}}
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
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>

<script src="{{config('path.assets_path')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript">
</script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
    type="text/javascript"></script>
<script
    src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/plupload/js/plupload.full.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
    type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
{{-- <script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-repeater/jquery.repeater.js"
type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
--}}
@endsection

@section('page_level_scripts')

<script type="text/javascript">
    let i = 1;
    $('#add').click(function () {

        i++;

        $('#dynamic_field').append('<div class="form-group"><div id="row' + i +
            '" class="dynamic-added"><input type="text" name="videos[]" placeholder="Video Url" class="form-control" /><a href="javascript:;" id="' +
            i +
            '" data-repeater-delete class="btn btn-danger btn_remove"><i class="fa fa-close"></i></a</div></div>'
        );
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).ready(function () {
        personal_info_validation.init();
        $(".hidden-btn").hide();
        $('#save-button').on('click', function () {
            $("input[name='request_type']").val('update');
            $(".hidden-btn").trigger("click");
        })
        $('#duplicate-button').on('click', function () {
            $("input[name='request_type']").val('duplicate');
            $(".hidden-btn").trigger("click");
        })

        // $(document).on('change','#revised_percent',function(){
        //     debugger
        // var org_price=$('#course_price').val();
        // var revised_percent=$('#revised_percent').val();

        // var revised_price=org_price-org_price*revised_percent/100;
        //     $("#revised_price").val(Math.round(revised_price));
        // });
        // $(document).on('change','#course_price',function(){
        //     debugger
        // var org_price=$('#course_price').val();
        // var revised_percent=$('#revised_percent').val();

        // var revised_price=org_price-org_price*revised_percent/100;
        //     $("#revised_price").val(Math.round(revised_price));
        // });

        $('.material-list').click(function () {
            let itemid = $(this).data('itemid')
            let url = "{{route('ajaxEditCourseMaterialList')}}"
            let data = {
                itemid: itemid,
                product_id: "{{$product->product_id}}"
            }
            var $this = $(this);
            let check_list = $(this).parents('li.mt-list-item').find("ul.contributor_list").html();
            //console.log(check_list.trim());
            if (check_list.trim() == "") {

                $.post(url, data, function (response) {
                    let contributor_html = '';
                    $.each(response, function (index, res) {
                        contributor_html += '<li class="task-list-item done">';
                        contributor_html += '<div class="row">'
                        contributor_html += '<div class="form-group col-sm-3">'
                        if (res.price == null) {
                            contributor_html +=
                                '<input type="checkbox" class="contributor_check" name=contributor[] value="' +
                                res.contributor_id + '"> ' + res.firstname + ' ' + res
                                .lastname

                        } else {

                            contributor_html +=
                                '<input type="checkbox" checked class="contributor_check" name=contributor[] value="' +
                                res.contributor_id + '"> ' + res.firstname + ' ' + res
                                .lastname
                        }
                        contributor_html += '</div>'
                        contributor_html += '<div class="form-group col-sm-3">'
                        contributor_html += '<label class="control-label">Price</label>'
                        if (res.price == null) {
                            contributor_html +=
                                '<input type="text"  name="price[]" class="form-control contributor_price" value="" disabled /> '
                            contributor_html +=
                                '<input type="hidden" disabled name="item_id[]" class="form-control contributor_item" value="' +
                                res.item_id + '"/> '
                        } else {
                            contributor_html +=
                                '<input type="text"  name="price[]" class="form-control contributor_price" value="' +
                                res.price + '" /> '
                            contributor_html +=
                                '<input type="hidden"  name="item_id[]" class="form-control contributor_item" value="' +
                                res.item_id + '"/> '

                        }
                        contributor_html += '</div>'
                        contributor_html += '</div>'
                        contributor_html += '</li>'

                    })

                    $this.parents('li.mt-list-item').find("ul.contributor_list").html(
                        contributor_html)

                    /*if($this.find('.checkbox_check').is(":checked")){
                        $this.parents('li.mt-list-item').find(".contributor_check").prop("checked",true);
                        $this.parents('li.mt-list-item').find(".contributor_price").prop("required",true);
                    }
                    else{
                        $this.parents('li.mt-list-item').find(".contributor_check").prop("checked",false);
                        $this.parents('li.mt-list-item').find(".contributor_price").prop("required",false);
                    }*/
                })
            }
        })

    })

    $(document).on('change', '.contributor_check', function () {

        $(this).parents('li.task-list-item').find('.contributor_price').prop("required", true);
        $(this).parents('li.task-list-item').find('.contributor_price').prop("disabled", false);
        $(this).parents('li.task-list-item').find('.contributor_item').prop("disabled", false);

        if (!$(this).is(':checked')) {
            $(this).parents('li.task-list-item').find('.contributor_price').prop("required", false);
            $(this).parents('li.task-list-item').find('.contributor_price').prop("disabled", true);
            $(this).parents('li.task-list-item').find('.contributor_item').prop("disabled", true);
            $(this).parents('li.task-list-item').find('.contributor_price').val("");
        }
    })
    //setTimeout(function(){
    $('.checkbox_check').change(function () {

        if (!$(this).is(":checked")) {
            $(this).parents('li.mt-list-item').find("li.task-list-item").remove();
        }
    });

    //},5000);
    var personal_info_validation = function () {
        // basic validation
        var handleValidation = function () {
            var form1 = $('#course_info_form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.on('submit', function () {
                for (var instanceName in CKEDITOR.instances) {
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
                    course_price: {
                        required: true,
                        number: true
                    },
                    "subject_list[]": {
                        required: true
                    },
                    "paper_list[]": {
                        required: true
                    },
                    "material_list[]": {
                        required: true
                    },
                    image: {
                        accept: "jpg,png,jpeg,gif"
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },
                    meta_key: {
                        required: true
                    },
                    subject: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'Please provide email',
                        email: 'Please provide proper email address',
                        remote: 'The email is already in use'
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
                invalidHandler: function (event,
                    validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass(
                            'has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass(
                            'has-error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass(
                            'has-error'); // set success class to the control group
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





    var imageupload_validation = function () {
        // basic validation
        var handleValidation = function () {
            var form1 = $('#image_upload_form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    profile_pic: {
                        required: true,
                        accept: "jpg,png,jpeg,gif"
                    }
                },
                messages: {
                    profile_pic: {
                        required: "Select Image for the user",
                        accept: "Only image type jpg/png/jpeg/gif is allowed"
                    }
                },
                invalidHandler: function (event,
                    validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass(
                            'has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass(
                            'has-error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass(
                            'has-error'); // set success class to the control group
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
    function change_hidden_value(id) {
        if ($("#checkbox_" + id).is(':checked')) {
            $("#hidden_" + id).val(1);

        } else {
            $("#hidden_" + id).val(0);

        }
    }

</script>
<script type="text/javascript">
    CKEDITOR.replace('pdesc', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["image", "table", "horizontalrule", "spcialchar"]
            },
            {
                "name": "styles",
                "groups": ["styles", "undo", "redo"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',


    });
    CKEDITOR.replace('inote', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["image", "table", "horizontalrule", "spcialchar"]
            },
            {
                "name": "styles",
                "groups": ["styles", "undo", "redo"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',


    });
    CKEDITOR.replace('s_description', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["image", "table", "horizontalrule", "spcialchar"]
            },
            {
                "name": "styles",
                "groups": ["styles", "undo", "redo"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',


    });
    CKEDITOR.replace('intro_text', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["image", "table", "horizontalrule", "spcialchar"]
            },
            {
                "name": "styles",
                "groups": ["styles", "undo", "redo"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Subscript,Superscript,Anchor,Styles,Specialchar,Smiley,Save,Flash,IFrame',


    });

    // $('#exam_id').on('change',function(){
    //     let exam_id=$(this).val();
    //     let data={
    //         exam_id:exam_id
    //     }
    //     let url="{{route('ajaxAddCourseExamPaper')}}"
    //     $.post(url,data,function(response){
    //         $("#paper-section").html('');
    //         if ( response.length != 0 ){


    //             let paperhtml='<label class="control-label">Paper</label>';
    //                 paperhtml+='<span class="required" aria-required="true"> * </span>';
    //                 paperhtml+='<div class="check-list ">';
    //             $.each(response,function(key,res){
    //                 paperhtml+='<div class="paper-sub-section">';
    //                 paperhtml+='<label class="check-inline" for="example-inline-check-'+key+'-'+res.paper_id+'">';
    //                 //paperhtml+='<div class="checker" id="example-inline-check-'+key+'-'+res.paper_id+'"><span>';
    //                 paperhtml+='<input id="example-inline-check-'+key+'-'+res.paper_id+'" class="paper_check" type="checkbox" value="'+res.paper_id+'" name="paper_list[]">';
    //                 //paperhtml+='</span></div>';
    //                 paperhtml+=' '+res.paper_name;
    //                 paperhtml+='</label>';
    //                 paperhtml+='<div class="material-section"></div>';
    //                 paperhtml+='<div class="subject-section"></div>';

    //                 paperhtml+='</div>';

    //             })
    //                 paperhtml+='</div>';

    //             $("#paper-section").html(paperhtml);      
    //             $('.prevpaper').hide();                                
    //         }
    //     })  


    // })
    // $(document).on('click','.paper_check',function(){

    //     var $this=$(this);
    //     let exam_id=$("#exam_id").val();
    //     let paper_id=$(this).val();
    //     let data={
    //         exam_id:exam_id,
    //         paper_id:paper_id
    //     }
    //     let url="{{route('ajaxAddCourseExamPaperMaterial')}}"
    //             //debugger
    //     //if($this.parents('.paper-sub-section').find('.material-section').html().trim()==""){

    //         $this.parents('.paper-sub-section').find('.material-section').html('');
    //         $this.parents('.paper-sub-section').find('.subject-section').html('');
    //         if($(this).is(":checked")){
    //                 $.post(url,data,function(response){
    //                     if ( response.length != 0 ){
    //                         let paperhtml='';
    //                             paperhtml='<div class="check-list paper-material-list">';
    //                             paperhtml+='<label class="check col-sm-12" for="example-check-all-'+paper_id+'">';
    //                             paperhtml+='<input id="example-check-all-'+paper_id+'" class="material-list-all-check" type="checkbox" value="1" name="all_material'+paper_id+'[]">';
    //                             paperhtml+=' All '
    //                             paperhtml+='</label>';
    //                         $.each(response.material_array,function(key,res){
    //                             paperhtml+='<label class="check col-sm-12" for="example-check-'+key+'-'+res.material_id+'-'+res.paper_id+'">';
    //                             paperhtml+='<input id="example-check-'+key+'-'+res.material_id+'-'+res.paper_id+'" class="material-list-check" type="checkbox" value="'+res.material_id+'" name="material_list'+res.paper_id+'[]">';
    //                             paperhtml+=' '+res.material_name;
    //                             paperhtml+='</label>';

    //                         })
    //                             paperhtml+='</div>';

    //                         let subjecthtml=  ' <div class="form-group">';
    //                             subjecthtml+= '<label class="control-label subject-info">Subject <span class="required"> * </span></label>'
    //                             subjecthtml+= '<div class="radio-list subject-list">'
    //                         $.each(response.allSubjects,function(key,subject){
    //                             subjecthtml+= '<label class="radio-inline" for="example-inline-radio'+key+'-'+subject.id+'">'
    //                             subjecthtml+='<input id="example-inline-radio'+key+'-'+subject.id+'" type="checkbox" value="'+subject.id+'" name="subject_list'+response.paper_id+'[]" required>'
    //                             subjecthtml+=' '+subject.subject_name;                                                                       
    //                             subjecthtml+='</label>'
    //                         });                                           

    //                             subjecthtml+= '</div>'
    //                             subjecthtml+= '</div>';

    //                             $this.parents('.paper-sub-section').find('.material-section').html(paperhtml);
    //                             $this.parents('.paper-sub-section').find('.subject-section').html(subjecthtml); 


    //                             $this.parents('.paper-sub-section').find('.material-section').find('input.material-list-check').prop('checked',true);
    //                             $this.parents('.paper-sub-section').find('.material-section').find('input.material-list-all-check').prop('checked',true);
    //                     }
    //                 })  
    //         }    
    //     //}
    // });


    $('#exam_id').on('change', function () {
        let exam_id = $(this).val();
        let data = {
            exam_id: exam_id
        }
        let url = "{{route('ajaxAddCourseExamPaper')}}"
        $.post(url, data, function (response) {
            $("#paper-section").html('');
            if (response.length != 0) {

                let paperhtml = '<label class="control-label">Paper</label>';
                paperhtml += '<span class="required" aria-required="true"> * </span>';
                paperhtml += '<div class="check-list ">';
                paperhtml += '<div class="paper-sub-section">';
                paperhtml += '<select name="paper_list[]" id="paper_id" class="form-control">';
                paperhtml += '<option value="">Select Paper</option>';
                $.each(response, function (key, res) {
                    paperhtml += '<option value="' + res.paper_id + '">' + res.paper_name +
                        '</option>';
                })
                paperhtml += '</select>';

                // $.each(response,function(key,res){
                //     paperhtml+='<div class="paper-sub-section">';
                //     paperhtml+='<label class="check-inline" for="example-inline-check-'+key+'-'+res.paper_id+'">';
                //     //paperhtml+='<div class="checker" id="example-inline-check-'+key+'"><span>';
                //     paperhtml+='<input id="example-inline-check-'+key+'-'+res.paper_id+'" class="paper_check" type="checkbox" value="'+res.paper_id+'" name="paper_list[]">';
                //     //paperhtml+='</span></div>';
                //     paperhtml+=' '+res.paper_name;
                //     paperhtml+='</label>';
                //     //paperhtml+='<label class="control-label">Subject</label>';
                //     paperhtml+='<div class="material-section"></div>';
                //     paperhtml+='<div class="subject-section"></div>';
                //     paperhtml+='</div>';

                // })
                paperhtml += '<div class="subject-section"></div>';
                paperhtml += '<div class="material-section"></div>';
                paperhtml += '</div>';

                $("#paper-section").html(paperhtml);
            }
        })


    })
    $(document).on('click','.paper_check',function(){
        debugger
        $(this).parents('.paper-sub-section').find('.subject-related-section').addClass('hide'); 
        if ($(this).is(":checked")) {
            $(this).parents('.paper-sub-section').find('.subject-related-section').removeClass('hide');             
        }
    });
    $(document).on('change', '#paper_id', function () {
        var $this = $(this);
        let exam_id = $("#exam_id").val();
        let paper_id = $(this).val();
        let data = {
            exam_id: exam_id,
            paper_id: paper_id
        }
        debugger
        let url = "{{route('ajaxAddCourseExamPaperMaterial')}}"
        $this.parents('.paper-sub-section').find('.material-section').html('');
        $this.parents('.paper-sub-section').find('.subject-section').html('');

        //if($(this).is(":checked")){
        $.post(url, data, function (response) {


            if (response.length != 0) {
                let paperhtml = '';

                paperhtml += '<div class="check-list paper-material-list">';
                paperhtml +=
                    '<label class="control-label subject-info">Materials <span class="required"> * </span></label>';
                paperhtml += '<label class="check col-sm-12" for="example-check-all-' + paper_id + '">';
                paperhtml += '<input id="example-check-all-' + paper_id +
                    '" class="material-list-all-check" type="checkbox" value="1" name="all_material' +
                    paper_id + '[]">';
                paperhtml += ' All '
                paperhtml += '</label>';
                $.each(response.material_array, function (key, res) {
                    paperhtml += '<label class="check col-sm-12" for="example-check-' + key +
                        '-' + res.material_id + '-' + res.paper_id + '">';
                    paperhtml += '<input id="example-check-' + key + '-' + res.material_id +
                        '-' + res.paper_id +
                        '" class="material-list-check" type="checkbox" value="' + res
                        .material_id + '" name="material_list' + res.paper_id + '[]">';
                    paperhtml += ' ' + res.material_name;
                    paperhtml += '</label>';

                })
                paperhtml += '</div>';

                let subjecthtml = ' <div class="form-group">';
                subjecthtml +=
                    '<label class="control-label subject-info">Unit <span class="required"> * </span></label>'
                subjecthtml += '<div class="radio-list subject-list">'
                subjecthtml += '<label class="check col-sm-12" for="subject-check-all-' + paper_id +
                    '">';
                subjecthtml += '<input id="subject-check-all-' + paper_id +
                    '" class="subject-list-all-check" type="checkbox" value="1" name="all_subject' +
                    paper_id + '[]">';
                subjecthtml += ' All '
                subjecthtml += '</label>';
                $.each(response.allSubjects, function (key, subject) {
                    subjecthtml += '<label class="radio-inline" for="example-inline-radio' +
                        key + '-' + subject.id + '">'
                    subjecthtml += '<input id="example-inline-radio' + key + '-' + subject.id +
                        '" class="subject-list-check" type="checkbox" value="' + subject.id +
                        '" name="subject_list' + response.paper_id + '[]">'
                    subjecthtml += ' ' + subject.subject_name;
                    subjecthtml += '</label>'
                });

                subjecthtml += '</div>'


                $this.parents('.paper-sub-section').find('.material-section').html(paperhtml);
                $this.parents('.paper-sub-section').find('.subject-section').html(subjecthtml);
                $this.parents('.paper-sub-section').find('.material-section').find(
                    'input.material-list-check').prop('checked', true);
                $this.parents('.paper-sub-section').find('.material-section').find(
                    'input.material-list-all-check').prop('checked', true);
            }

        })
        //}    

    })


    $(document).on('click', '.material-list-all-check', function () {
        //debugger;
        $(this).parents('.paper-material-list').find('.material-list-check').prop('checked', false);
        $(this).parents('.paper-material-list').find('.checker').find('span').removeClass('checked');
        if ($(this).is(":checked")) {
            $(this).parents('.paper-material-list').find('.checker').find('span').addClass('checked');
            $(this).parents('.paper-material-list').find('.material-list-check').prop('checked', true);
        }

    });
    $(document).on('click', '.subject-list-all-check', function () {
        debugger;
        $(this).parents('.subject-list').find('.subject-list-check').prop('checked', false);
        $(this).parents('.subject-list').find('.checker').find('span').removeClass('checked');
        if ($(this).is(":checked")) {
            $(this).parents('.subject-list').find('.checker').find('span').addClass('checked');
            $(this).parents('.subject-list').find('.subject-list-check').prop('checked', true);
        }

    });

</script>
<script>
    $('.material-list-check').click(function () {
        //$(this).parents('.paper-sub-section').find('.paper_check').prop('checked', function() {
        //alert($(this).parents('.paper-material-list').find(':checked').length);
        //return $(this).parents('.paper-material-list').find(':checked').length;
        //});
        // $(this).parents('.paper-sub-section').find('span').removeClass('checked');
        //     $(this).prop('checked', false);
        // let papercheckChecked=$(this).parents('.paper-sub-section').find('.paper_check').is(":checked");
        // if(!papercheckChecked){
        //     //$(this).parents('.paper-sub-section').find('.paper_check').prop('checked',true);
        //     $(this).parents('.paper-sub-section').find('span').addClass('checked');
        //     $(this).prop('checked', true);
        // }
    })

</script>
<script>
    var ComponentsDateTimePickers = function () {

        var handleDatePickers = function () {

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    format: "dd/mm/yyyy",
                    autoclose: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            }

            /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
        }



        return {
            //main function to initiate the module
            init: function () {
                handleDatePickers();

            }
        };

    }();

    if (App.isAngularJsApp() === false) {
        jQuery(document).ready(function () {
            ComponentsDateTimePickers.init();
        });
    }

</script>

@endsection

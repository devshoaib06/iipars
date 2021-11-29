@extends('admin.layouts.app')

@section('page_title')
	Article-Edit
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
                                    <span class="caption-subject  sbold ">Edit Article - {{$article_info->name}}
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="{{route('article-update',['id'=>\Hasher::encode($article_info->id)])}}" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                            <label class="control-label col-md-3">Title
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="title" class="form-control"  value="{{$article_info->title}}"/> </div>
                                            @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label col-md-3">Categories
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">Select Category</option> 
                                                    @foreach ($categories as $category)
                                                            <option value="{{$category->id}}" {{$category->id==$article_info->category_id?'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                        </div> --}}
                                        
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Description
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <textarea name="description" id="description"  class="form-control" rows="5" cols="7">{{$article_info->description}}</textarea>

                                            @if ($errors->has('qualification'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('qualification') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Categories
                                                <span class="required"> * </span>

                                            </label>
                                            <div class="checkbox-list col-md-6 subject-list">
                                               @foreach ($categories as $category)
                                                <label class="checkbox-inline" for="example-inline-checkbox{{$category->id}}">
                                                <input id="example-inline-checkbox{{$category->id}}" type="checkbox" 
                                                    value="{{$category->id}}" name="category_list[]" 
                                                    {{@in_array($category->id,$selected_cat)?'checked':''}}
                                                > {{$category->name}}</label>
                                                   
                                               @endforeach
                                               
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Meta Tags
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="meta_tags" class="form-control" value="{{$article_info->meta_tags}}" id="meta_tags"/> </div>
                                            @if ($errors->has('meta_tags'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_tags') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                        
                                        <div class="form-group">
                                                <label class="control-label col-md-3">Meta Title
                                                    
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="meta_title" class="form-control" value="{{$article_info->meta_title}}" id="meta_title"/> </div>
                                                @if ($errors->has('meta_title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-3">Meta Robots
                                                    
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="meta_robots" class="form-control" value="{{$article_info->meta_robots}}" id="meta_robots"/> </div>
                                                @if ($errors->has('meta_robots'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_robots') }}</strong>
                                                </span>
                                                @endif
                                        </div> 
                                        <div class="form-group">
                                                <label class="control-label col-md-3">Meta Description
                                                    
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea name="meta_description" rows="10" class="form-control" id="meta_description">{{$article_info->meta_description}}</textarea>
                                                </div>
                                                @if ($errors->has('meta_description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_description') }}</strong>
                                                </span>
                                                @endif
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Submitted By
                                                
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="writer_name" class="form-control" value="{{$article_info->writer_name}}" id="writer_name"/> </div>
                                            @if ($errors->has('writer_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('writer_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Submitter Email
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="writer_email" class="form-control" value="{{$article_info->writer_email}}" id="writer_email"/> </div>
                                            @if ($errors->has('writer_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('writer_email') }}</strong>
                                            </span>
                                            @endif
                                        </div>  

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Submitter Phone
                                                
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="writer_phone" class="form-control" value="{{$article_info->writer_phone}}" id="writer_phone"/> 
                                            
                                            </div>
                                            @if ($errors->has('writer_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('writer_phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>  

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Image 
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                @if($article_info->image)
                                                <img src="{{Storage::disk(config('disk.get_article_image'))->url($article_info->image)}}" width="100px" height="100px">
                                                @else
                                                <img src="{{Storage::disk(config('disk.get_article_image'))->url('no-image.jpg')}}" width="100px" height="100px">
                                                @endif
											</div>
                                            
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            </label>
                                            <div class="col-md-6">
                                                <input type="file" name="image"   id="image"/> 
                                                <span>Supported Files: png,jpg,jpeg. </span>
                                                
                                            </div>
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                                @if ($errors->has('image'))
                                            </span>
                                            @endif
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">File 
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <a href="{{route('downloadArticleFile',['article_id'=>\Hasher::encode($article_info->id)])}}">
                                                    {{$article_info->fileName}}
                                                </a>
											</div>
                                            
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            </label>
                                            <div class="col-md-6">
                                                <input type="file" name="file"   id="file"/> </div>
                                                @if($errors->has('file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                                <span>Supported Files: pdf </span>
                                            @endif
                                        </div> 

                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Is Featured <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="featured-inline-radio1">
                                                    <input id="featured-inline-radio1" type="radio" value="1" name="is_featured" {{$article_info->is_featured==1?'checked':''}}> Yes</label>
                                                <label class="radio-inline" for="featured-inline-radio2">
                                                    <input id="featured-inline-radio2" type="radio" value="0" name="is_featured" {{$article_info->is_featured==0?'checked':''}}> No</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status <span class="required"> * </span></label>
                                            <div class="radio-list col-md-6">
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="example-inline-radio1" type="radio" value="1" name="status" {{$article_info->status==1?'checked':''}}> Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="status" {{$article_info->status==0?'checked':''}}> Inactive</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="{{ route('article-list') }}"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
                            writer_name: {
                                    required: true
                                },
                                'category_list[]': {
                                    required: true
                                },
                                writer_email:{
                                    required:true,
                                    email:true
                                },
                                // writer_phone:{
                                //     required:true
                                // },
                                title:{
                                    required:true
                                },
                                description:{
                                    required:function() 
                                            {
                                            CKEDITOR.instances.description.updateElement();
                                            }
                                },
                                image:{
                                    //required:true,
                                    extension: "jpeg|jpg|png"
                                },
                                file:{
                                    //required:true,
                                    extension: "pdf|doc|docx"
                                }
                                
                                
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
CKEDITOR.replace( 'description', {
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
            //height: '600px',

        } );
</script>
@endsection
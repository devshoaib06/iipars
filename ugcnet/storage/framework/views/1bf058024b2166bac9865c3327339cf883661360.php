<?php $__env->startSection('page_title'); ?>
Exams Paper
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

<style>
#pdesc-error{
    position: absolute;
    bottom: -22px;
    left:14px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_css'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
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
				<?php echo $__env->make('admin.partials.sidebarMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
				<?php echo $__env->make('admin.partials.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                <form action="<?php echo e(route('createExamPaperMaterialContent')); ?>" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>


                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                        <div class="alert alert-danger content-error display-hide">
                                            <button class="close" data-close="alert"></button> Please upload material or insert a video.
                                        </div>
                                        	<?php if(count($errors) > 0): ?>
											<div class="alert alert-danger">
												<ul>
													<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li><?php echo e($error); ?></li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</ul>
											</div>
											<?php endif; ?>


                                        <?php if(Session::has('message')): ?>
                                        <div class="<?php echo e(Session::get('messageClass')); ?>">
                                            <button class="close" data-close="alert"></button>
                                            <span><?php echo e(Session::get('message')); ?> </span>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Exams <span class="required"> * </span></label>
                                            <div class="col-sm-6">
                                                <select name="exam_id" id="exam" class="form-control">
                                                    <option value="">Select Exam</option>
                                                <?php $__currentLoopData = $allExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                    <option value="<?php echo e($exam->id); ?>" <?php if(old('exam_id')==$exam->id): ?> "selected" <?php endif; ?>><?php echo e($exam->exam_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Paper <span class="required"> * </span></label>
                                            <div class="col-sm-6">
                                                <select name="paper_id" id="paper" class="form-control">
                                                    <option value="">Select Paper</option>
                                                <?php $__currentLoopData = $allPapers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                    <option value="<?php echo e($paper->id); ?>"><?php echo e($paper->paper_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Subject <span class="required"> * </span></label>
                                            <div class="col-sm-6">
                                                <select name="subject_id" id="subject" class="form-control">
                                                    <option value="">Select Subject</option>
                                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                    <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Materials <span class="required"> * </span></label>
                                            <div class="col-sm-6">
                                                <select name="material_id" id="material" class="form-control">
                                                    <option value="">Select Material</option>
                                                    <?php $__currentLoopData = $allMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                    <option value="<?php echo e($material->id); ?>"><?php echo e($material->material_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="study-materail-section">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Upload Material</label>
                                                <div class="col-md-6">
                                                <input type="file" name="material_content_files[]" id="material_content" multiple>
                                                </div>
                                            </div> 
                                            <div class="form-group"><label class="control-label col-md-5">--OR--</label></div>                                                                  
                                            
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
                                                                                                        
                                        </div>
                                        <div class="contibutor-section">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Contributor(s)</label>
                                                
                                            </div>
                                            <div class="form-group contributor-list">
                                                
                                            </div> 
                                        </div> 
                                        <input type="hidden" id="checkcontent" name="check_content" value="0" >
                                        
                                        

                                        
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="<?php echo e(route('exam-paper-material-content')); ?>"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
		<?php echo $__env->make('admin.partials.quickSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- END QUICK SIDEBAR -->
	</div>
    <!-- END CONTAINER -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page_level_plugins'); ?>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>
<script src="public/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<script type="text/javascript">
var FormValidation = function () {

// basic validation
var handleValidation = function() {
// for more info visit the official plugin documentation: 
// http://docs.jquery.com/Plugins/Validation

var form1 = $('#form_sample_1');

    var error1 = $('.alert-danger', form1);
    var error2 = $('.content-error', form1);
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
                exam_id: {
                        required: true
                },
                subject_id: {
                        required: true
                },
                paper_id: {
                        required: true
                },
                material_id:{
                    required:true
                },
                'material_content_files[]':{
                    required: '#videos:blank',
                    extension: "pdf"
                },
                'videos[]':{
                    required: '#material_content:blank'

                }
                                 
            },
            messages: {

                exam_name: {
                    required: 'Exam Name is required.',
                },
                'material_content_files[]':{
                    extension:'Please upload only pdf'
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
                error2.hide();
                
                if($("#checkcontent").val()==0){
                    error2.show();
                    return false;
                }
                
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
        let url="<?php echo e(route('ajaxExamPaper')); ?>"
        $.post(url,data,function(response){
            let paperhtml='<option value="">Select paper</option>';
            $.each(response,function(key,res){
                paperhtml+='<option value="'+res.id+'" >'+res.paper_name+'</option>';
            })
             $("#paper").html(paperhtml);                                      
        })  

      
  })  

  $("#material_content").on('change',function(){
      var content_val=$(this).val();
      if(content_val){
          $("#checkcontent").val(1);
      }
  })
  $(document).on('change',"input[name='videos[]']",function(){
      
      var content_val=$(this).val();
      if(content_val){
          $("#checkcontent").val(1);
      }
  })

  

  let i=1;
  $('.study-materail-section').hide();
  $('.contibutor-section').hide();
  let dynamichtml='';
    $('.add_more').click(function(){
        i++;
        
        var html='<div class="row" id="row'+i+'">';
            html+='<label class="control-label col-md-3"></label>';
            html+='<div class="form-group col-sm-3 p-rel" style="margin-left: 0px;">';
            html+='<input type="text" id="videos_title'+i+'" name="videos_title[]" placeholder="Title" class="form-control" required />';
            html+='</div>';
            html+='<div class="form-group col-sm-3 p-rel"   style="margin-left: 16px;">';
            html+='<input type="text" id="videos'+i+'" name="videos[]" placeholder="Url" class="form-control" />';
            html+='<a href="javascript:;" id="'+i+'" data-repeater-delete class="btn btn-danger btn_remove  tooltips p-art" data-original-title="Remove Content">';
            html+='<i class="fa fa-close"></i></a>';
            html+='</div>';
            html+='</div>';

        $(this).parents('.video_parent_class').find('#dynamic_field').append(html);  
      }); 
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
    });
    $(document).on('click', '.study_material', function(){ 
        
        $(this).parents('.main-material-content').find('.study-materail-section').toggle();
        

    });

    $('#subject').on('change',function(){
        if($(this).val()==""){
            $('.contibutor-section').hide();
            
        }
        let contributorhtml="";

        let url="<?php echo e(route('ajaxSubjectContributor')); ?>";
            let data={
                subject_id:$(this).val()
            };
            $.post(url,data,function(response){
                let i=1;
                $.each(response,function(index,result){
                    contributorhtml+='<div class="appendedContributor"><label class="control-label col-md-3"></label>'
                    contributorhtml+='<div class="col-md-3">'
                    contributorhtml+='<label class="checkbox" for="example-checkbox-'+i+'">'
                    contributorhtml+='<input id="example-checkbox-'+i+'" type="checkbox" class="contributor_check" value="'+result.contributor_id+'" name="contributor_list[]">'+result.firstname+' '+result.lastname +'</label>'
                    contributorhtml+='</div>'
                    contributorhtml+='<label class="control-label col-sm-1">Price</label>'
                    contributorhtml+='<div class="col-sm-3">'
                    contributorhtml+='<input type="text" name="price[]" class="form-control contributor_price" value="" >'
                    contributorhtml+='</div></div>'

                    i++;

                })
                
                $('.contributor-list').html(contributorhtml);
                $('.contributor_price').prop('disabled',true);
            })

    })
    $("#material").change(function(){
            $('.contibutor-section').hide();
            $('.study-materail-section').hide();

        if($(this).val()!=""){
            $('.contibutor-section').show();
            $('.study-materail-section').show();

        }
    });
    $('.exam_paper_material').click(function(){
        $(this).parents(".main-material-content").find(".sub-material").click()
        $(this).parents(".main-material-content").find(".study_material").click()
        $(this).parents(".main-material-content").find(".exam_id").click()
        $(this).parents(".main-material-content").find(".paper_id").click()
    })

    $(document).on('click','.contributor_check',function(){
        
        $(this).parents('.appendedContributor').find('.contributor_price').prop('disabled',true);
        if($(this).is(':checked')){
            $(this).parents('.appendedContributor').find('.contributor_price').prop('disabled',false);
            $(this).parents('.appendedContributor').find('.contributor_price').prop('required',true);

        }
                
    })

});

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/courses/exam/exam_paper_material_content/create.blade.php ENDPATH**/ ?>
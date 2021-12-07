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
                                    <span class="caption-subject  sbold ">Add Exam Paper Material
                                    </span>
                                </div>
                                <!--<div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                        <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                    </div>
                                </div>-->
                            </div>

                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo e(route('createExamPaper')); ?>" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>


                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>

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
                                            <label class="control-label col-md-3">Exams
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="exam" id="exam" class="form-control">
                                                    <option value="">Select exam</option>
                                                    <?php $__currentLoopData = $allExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($exam['id']); ?>"><?php echo e($exam['exam_name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Papers
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="paper" id="paper" class="form-control">
                                                    
                                                </select>
                                            </div>

                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Material Type
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6 material-list">
                                                <?php $__currentLoopData = $allMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <label class="checkbox-inline" for="material-inline-checkbox<?php echo e($material->id); ?>">
                                                 <input id="material-inline-checkbox<?php echo e($material->id); ?>" type="checkbox" value="<?php echo e($material->id); ?>" name="material_list[]"> <?php echo e($material->material_name); ?></label>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                
                                             </div>
                                             <div class="material-list-error"></div>
                                        </div> 
                                        

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
                                                <a href="<?php echo e(route('exam-paper')); ?>"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
        let url="<?php echo e(route('ajaxExamPaper')); ?>"
        $.post(url,data,function(response){
            let paperhtml='<option value="">Select paper</option>';
            $.each(response,function(key,res){
                paperhtml+='<option value="'+res.id+'" >'+res.paper_name+'</option>';
            })
             $("#paper").html(paperhtml);                                      
        })  

      
  })  

});

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugcnet/resources/views/admin/courses/exam/exam_paper/create.blade.php ENDPATH**/ ?>
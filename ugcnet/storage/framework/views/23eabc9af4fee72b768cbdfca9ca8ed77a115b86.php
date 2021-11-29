<?php $__env->startSection('page_title'); ?>
<?php echo e($pagetitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_css'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>	
    <!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			
			<div class="page-sidebar navbar-collapse collapse">
				
				<?php echo $__env->make('admin.partials.sidebarMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
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
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold "><?php echo e($pagetitle); ?>

                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo e($form_url); ?>" id="form_sample_1" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>


                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                        <?php if(Session::has('message')): ?>                         
                                        <div class="<?php echo e(Session::get('messageClass')); ?>">
                                            <button class="close" data-close="alert"></button>
                                            <span><?php echo e(Session::get('message')); ?> </span>
                                        </div>
                                        <?php endif; ?>  

                                        <!--profile pic-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Name
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                            <input type="text" name="name" value="<?php echo e(isset($mocktemplate)?$mocktemplate->name:''); ?>" class="form-control" />
                                            <?php if($errors->has('name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Duration (In Minutes)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <input type="text" name="duration" class="form-control" value="<?php echo e(isset($mocktemplate)?$mocktemplate->duration:''); ?>" />

                                            </div>
                                            <?php if($errors->has('duration')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('duration')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tabulation Rule
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <select name="tabulation_rule_id" id="tabulation_rule_id" class="form-control">
                                                    <option value="">Select Rule</option>
                                                    <?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($rule['id']); ?>" 
                                                    <?php if(isset($mocktemplate)): ?>
                                                        <?php if($mocktemplate->tabulation_rule_id == $rule['id']): ?> selected <?php endif; ?>
                                                    <?php endif; ?>
                                                    ><?php echo e($rule['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select> 

                                            </div>
                                            <?php if($errors->has('duration')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('duration')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                                
                                                <div class="col-md-2">Level <span class="required"> * </span></div>
                                            <div class="col-md-2">No. of Questions <span class="required"> * </span></div>
                                            <div class="col-md-2">Marks per Question</div>
                                            
                                        </div>
                                        <?php
                                            $j=1;
                                        ?>  
                                        <?php $__empty_1 = true; $__currentLoopData = $templateDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $templateDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="form-group" id="clonerow">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <select name="level_id[]" id="level_id" class="form-control "  >
                                                    <option value="">Select Level</option>
                                                    <?php $__currentLoopData = $question_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($question_level['id']); ?>" 
                                                    <?php if(isset($templateDetail)): ?>
                                                        <?php if($templateDetail->level_id == $question_level['id']): ?> selected <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                    ><?php echo e($question_level['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php if($errors->has('level_id')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('level_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="number_of_questions[]" value="<?php echo e(isset($templateDetail)?$templateDetail->number_of_questions:''); ?>" class="form-control" />
                                                
                                            <?php if($errors->has('number_of_questions')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('number_of_questions')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="marks_per_question[]" value="<?php echo e(isset($templateDetail)?$templateDetail->marks_per_question:''); ?>" class="form-control" />
                                            <?php if($errors->has('marks_per_question')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('marks_per_question')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            
                                        
                                            <?php if($j>1): ?>
                                                    
                                                    <label class="col-md-1 removeBtn"><input class="btn red"  type="button" value="-" onclick="removeRow(this)"></label>
                                                <?php endif; ?>
                                        </div>
                                        <?php
                                            $j++;
                                        ?>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            
                                        <div class="form-group" id="clonerow">
                                            <div class="control-label col-md-3">
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <select name="level_id[]" id="level_id" class="form-control "  >
                                                    <option value="">Select Level</option>
                                                    <?php $__currentLoopData = $question_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($question_level['id']); ?>" 
                                                    <?php if(isset($mocktemplate)): ?>
                                                        <?php if($mocktemplate->level_id == $question_level['id']): ?> selected <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                    ><?php echo e($question_level['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php if($errors->has('level_id')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('level_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="number_of_questions[]" value="<?php echo e(isset($mocktemplate)?$mocktemplate->number_of_questions:''); ?>" class="form-control" />
                                                
                                            <?php if($errors->has('number_of_questions')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('number_of_questions')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="marks_per_question[]" value="<?php echo e(isset($mocktemplate)?$mocktemplate->marks_per_question:''); ?>" class="form-control" />
                                            <?php if($errors->has('marks_per_question')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('marks_per_question')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            
                                        
                                            <label class="col-md-1 removeBtn"></label>
                                        </div>
                                        <?php endif; ?>
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
                                                    <input id="example-inline-radio1" type="radio" value="1" name="is_active" <?php echo e(isset($mocktemplate)?$mocktemplate->is_active==1?'checked':'':'checked'); ?> > Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="is_active" <?php echo e(isset($mocktemplate)?$mocktemplate->is_active==0?'checked':'':''); ?>> Inactive</label>
                                            </div>
                                        </div>  <!--Status Value-->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="<?php echo e(route('showMockTemplateList')); ?>"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/mock-test/template/_form.blade.php ENDPATH**/ ?>
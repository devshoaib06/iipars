<?php $__env->startSection('page_title'); ?>
    CMS
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="public/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
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
                    <!--<ul class="page-breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#">Blank Page</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Page Layouts</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="icon-bell"></i> Action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-shield"></i> Another action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> Something else here</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-bag"></i> Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"> <?php /* Managed Countries 
					<small>blank page layout</small>*/ ?>
				</h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!--<div class="m-heading-1 border-green m-bordered">
                    <h3>jQuery Validation Plugin</h3>
                    <p> This jQuery plugin makes simple clientside form validation easy, whilst still offering plenty of customization options. For more info please check out
                        <a class="btn red btn-outline" href="http://jqueryvalidation.org" target="_blank">the official documentation</a>
                    </p>
                </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-red"></i>
                                    <span class="caption-subject font-red sbold uppercase"><?php if(!empty($CmsMasters)) echo "Update CMS Page"; else echo "Add New CMS"; ?></span>
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
                                <form action="<?php echo e($form_url); ?>" id="form_sample_1" class="form-horizontal" method="POST">
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
                                        
                                        
                                        <?php if(count($errors) > 0): ?>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>  



                                        <div class="form-group">
                                            <label class="control-label col-md-3">Page URL
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-9"><input type="text" name="url" class="form-control" value="<?php if(!empty($CmsMasters)) echo $CmsMasters->url; ?>" <?php if(!empty($CmsMasters)) echo "readonly"; ?> /> </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">Page Heading
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-9"><input type="text" name="heading" class="form-control" value="<?php if(!empty($CmsMasters)) echo $CmsMasters->heading; ?>" /> </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">Description</label>
                                            <div class="col-md-9"><textarea id="pdesc" class="ckeditor form-control" rows="20" name="description" data-error-container="#description_error"><?php if(!empty($CmsMasters)) echo $CmsMasters->description; ?></textarea> 
                                                <div id="description_error"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Meta Title
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-9"><input type="text" name="meta_title" class="form-control" value="<?php if(!empty($CmsMasters)) echo $CmsMasters->meta_title; ?>" /> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Meta Keyword
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-9"><input type="text" name="meta_keyword" class="form-control" value="<?php if(!empty($CmsMasters)) echo $CmsMasters->meta_keyword; ?>" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Robots
                                                
                                            </label>
                                            <div class="col-md-9"><input type="text" name="meta_robots" class="form-control" value="<?php if(!empty($CmsMasters)) echo $CmsMasters->meta_robots; ?>" /> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Meta Description</label>
                                            <div class="col-md-9"><textarea class="form-control" rows="3" name="meta_description"><?php if(!empty($CmsMasters)) echo $CmsMasters->meta_description; ?></textarea> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status <span class="required"> * </span></label>
                                            <div class="radio-list">
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="example-inline-radio1" type="radio" value="1" name="status" <?php if(!empty($CmsMasters) && $CmsMasters->status == '1') { echo "checked"; } ?> <?php if(empty($CmsMasters)) echo "checked"; ?> >
                                                Active</label>
                                                <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="example-inline-radio2" type="radio" value="0" name="status" <?php if(!empty($CmsMasters) && $CmsMasters->status == '0') { echo "checked"; } ?> >Inactive</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <a href="<?php echo e(url(config("constants.admin_prefix").'/cms')); ?>"><button type="button" class="btn grey-salsa btn-outline">Cancel</button></a>
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
<script src="<?php echo asset('public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('public/assets/global/plugins/jquery-validation/js/additional-methods.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('public/assets/global/plugins/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('public/assets/global/plugins/backstretch/jquery.backstretch.min.js'); ?>" type="text/javascript"></script>
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

    //IMPORTANT: update CKEDITOR textarea with actual content before submit
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
                    url: {
                        required: true
                    },
                    heading: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    meta_title: {
                        required: true
                    },
                    meta_keyword: {
                        required: true
                    }
                    
            },
            messages: {

                url: {
                    required: 'Page URL is required.',
                },
                heading: {
                    required: 'Page Heading is required.',
                },
                description: {
                    required: 'Page Description is required.',
                },
                meta_title: {
                    required: 'Meta Title is required.',
                },
                meta_keyword: {
                    required: 'Meta Keyword is required.',
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("data-error-container")) { 
                    error.appendTo(element.attr("data-error-container"));
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
});
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
            height: '600px',

        } );

  //  CKEDITOR.editorConfig = function( config )
//{
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
   // config.height = '1000px';
//};

   
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/settings/cms/addedit.blade.php ENDPATH**/ ?>
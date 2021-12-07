<?php $__env->startSection('page_title'); ?>
	Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" >
<link href="<?php echo e(config('path.assets_path')); ?>/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_css'); ?>

<style>
    .tag_fields{
        color: #3f444a;
        font-size: 18px;
        font-weight: 500;
        margin: 0 0 15px;
    }
</style>

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
				<!--<h3 class="page-title"> Managed State 
					<small>blank page layout</small>
				</h3>-->
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="portlet light portlet-fit portlet-datatable bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold "> 
									<?php
									
									if(Auth::guard('admins')->user()->user_type_id == 1){
										echo "Admin Details";
									}
									?> <span class="hidden-xs">| <?php echo e($user_info->name); ?> </span>
                                    </span>
                                </div>
                                <div class="actions">
								<!-- <input type="checkbox" class="make-switch" data-on-text="Active" data-off-text="Inactive" <?php if($user_info->status == '1'){ ?> checked <?php } ?> data-on-color="success" data-off-color="warning" data-size="small" onChange="change_status()" name="status" id="status" >-->
								<!-- checked data-on="success" data-on-color="success" data-off-color="danger" data-size="small" -->
								<!--<a href="<?php echo e(url(config("constants.admin_prefix"))); ?>/users-owner" class="btn default">Back</a>-->
                                   <!-- <div class="btn-group btn-group-devided" data-toggle="buttons">
										
							
							
						
										
										
                                       <label class="btn btn-transparent green btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                        <label class="btn btn-transparent blue btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Settings</label> 
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                            <i class="fa fa-share"></i>
                                            <span class="hidden-xs"> Tools </span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;"> Export to Excel </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Export to CSV </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Export to XML </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"> Print Invoices </a>
                                            </li>
                                        </ul>
                                    </div>  -->
                                </div>
                            </div>
                            <div class="portlet-body">
							
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
							
							
							
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs nav-tabs-lg">
									<li class="active">
										<a href="#tab_1_1" data-toggle="tab"> Overview </a>
									</li>
									<li>
										<a href="#tab_1_3" data-toggle="tab"> Account </a>
									</li>
									
                                    </ul>
                                    <div class="tab-content">
                                      						
											<div class="tab-pane active" id="tab_1_1">
												<div class="row">
													<div class="col-md-3">
														<ul class="list-unstyled profile-nav">
															<li>
																<img src="<?php echo e(config('path.assets_path')); ?>/assets/layouts/layout/img/avatar.png" class="img-responsive pic-bordered" alt="" />
																<!--<a href="javascript:;" class="profile-edit"> edit </a>-->
															</li>
															
														</ul>
													</div>
													<div class="col-md-9">
														<div class="row">
															<div class="col-md-8 profile-info">
															<h1 class="font-green sbold uppercase"><?php echo e($user_info->name); ?></h1>
																
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Email</h2></div>
                                                                <div class="col-md-4"><?php echo e($user_info->email); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Country</h2></div>
                                                                <div class="col-md-4">INDIA
                                                                	
                                                                </div>
                                                            </div>
                                                            

				
				
															</div>
															
														</div>														
													</div>
												</div>
											</div>
											
											<div class="tab-pane" id="tab_1_3">
											
												<div class="row profile-account">
													<div class="col-md-3">
														<ul class="ver-inline-menu tabbable margin-bottom-10">
				
															<li class="active">
																<a data-toggle="tab" href="#tab_1-1">
																	<i class="fa fa-cog"></i> Personal info </a>
																<span class="after"> </span>
															</li>
															<!--<li>
																<a data-toggle="tab" href="#tab_2-2">
																	<i class="fa fa-picture-o"></i> Change Profile Picture </a>
															</li>-->
															<li>
																<a data-toggle="tab" href="#tab_3-3">
																	<i class="fa fa-lock"></i> Change Password </a>
															</li>
															
														</ul>
													</div>
													<div class="col-md-9">
														<div class="tab-content">
															<div id="tab_1-1" class="tab-pane active">
																<form action="<?php echo e(url(config("constants.admin_prefix") . "/" . "admin-update")); ?>" id="form_personal_info"  method="POST" >
				
																	<?php echo csrf_field(); ?>

                                                                	
																	<div class="form-group">
                                                                    <label class="control-label"> Name</label>
                                                                    <input type="text" value="<?php echo e($user_info->name); ?>" class="form-control" name="name"/> 
                                                                </div>
                                                                	
																	
													
																
																	
																	
																	<div class="form-group">
																		<label class="control-label">Email</label>
																		<input type="text" name="email" class="form-control" id="email" value="<?php echo e($user_info->email); ?>"/> 
																	</div>
																	
																	
																	
																	<div class="margiv-top-10">
																		<button type="submit" class="btn green">Save Changes</button>
																		<!-- <a href="javascript:;" class="btn default"> Cancel </a> -->
																	</div>
																</form>
															</div>
															<div id="tab_2-2" class="tab-pane">
																<!--<p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
																	</p>-->
																<form action="<?php echo e(url(config("constants.admin_prefix") . "/" . "admin-image")); ?>" id="form_image_upload"  method="POST" enctype="multipart/form-data">
																	<?php echo csrf_field(); ?>

																	
																	<div class="form-group">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

																				<img src="<?php echo e(config('path.assets_path')); ?>/assets/layouts/layout/img/avatar.png" alt="" />

																				 </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>

																				<span class="btn default btn-file">
																					<span class="fileinput-new"> Select image </span>
																					<span class="fileinput-exists"> Change </span>
																					<input type="file" name="profile_pic"> </span>
																				<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
																			</div>
																		</div>
																		<?php if($errors->has('profile_pic')): ?>
													                    <br/><span style="color:RED;"><small><?php echo e($errors->first('profile_pic')); ?></small></span>
													                    <?php endif; ?>
																		<!-- <div class="clearfix margin-top-10">
																			 <span class="label label-danger"> NOTE! </span>
																			 <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
																		 </div>-->
																	</div>
																	
																	<div class="margin-top-10">
																		<button type="submit" class="btn green">Save Changes</button>
																	</div>
																	
																</form>
															</div>
															<div id="tab_3-3" class="tab-pane">
				
																<form action="<?php echo e(url(config("constants.admin_prefix") . "/" . "admin-password-update")); ?>" id="form_password_checking"  method="POST">
																	<?php echo csrf_field(); ?>

																	
																	<div class="form-group">
																		<label class="control-label">New Password</label>
																		<input type="password" class="form-control" name="password" id="password"/> </div>
																		
																	<div class="form-group">
																		<label class="control-label">Re-type New Password</label>
																		<input type="password" class="form-control" name="con_password" id="con_password"/> </div>
																		
																	<div class="margin-top-10">
				
																		<button type="submit" class="btn green">Change Password</button>
																		<!-- <a href="javascript:;" class="btn default"> Cancel </a>-->
																	</div>
																	
																</form>
															</div>
														</div>
													</div>
													<!--end col-md-9-->
												</div>												
											</div>                                       
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




<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<script type="text/javascript">




	var personal_info_validation = function () {

		
		var handleValidation = function() {
				var form1 = $('#form_personal_info');
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
							
							email: {
								required: true,
								email: true,
								remote: {
										type: 'post',
												url: '<?php echo e(url(config("constants.admin_prefix")."/"."email-exist-update")); ?>',
												data: {
												'user_id': function () { return '<?php echo $user_info->id ?>' }
												}
										}
							},
							
							
						},
						messages: {
						/*select_multi: {
						 maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
						 minlength: jQuery.validator.format("At least {0} items must be "selected"")
						 }*/
						
							name: {
								required: 'Name is required.'
							},
							
							
							email: {
								required: 'Please provide email',
										email:'Please provide proper email address',
										remote:'The email is already in use'
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
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form_image_upload');
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
	
	var password_validation = function () {

		// basic validation
		var handleValidation = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#form_password_checking');
				var error1 = $('.alert-danger', form1);
				var success1 = $('.alert-success', form1);
				form1.validate({
				errorElement: 'span', //default input error message container
						errorClass: 'help-block help-block-error', // default input error message class
						focusInvalid: false, // do not focus the last invalid input
						ignore: "", // validate all fields including form hidden input
						rules: {
							password:{
								required: true,
								minlength: 8	
							},
							con_password:{
								equalTo: "#password"
							},
						},
						messages: {
							password:{
								required: "Please provide password",
								minlength: "Please enter at least 8 characters"	
							},
							con_password:{
								equalTo: "Both the password must be same",
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
		personal_info_validation.init();
		imageupload_validation.init();
		password_validation.init();
	});
	
	
	
	
	/*
	function change_status() {

	val = $('#status').bootstrapSwitch('state');
 
	 var s = 0;
	 if(val){
		s = 1;
	 }	

	
	
	$.post("<?php echo e(url(config("constants.admin_prefix").'/ajax-change-user-status')); ?>", {"user_id": <?php echo e($user_info->user_id); ?>, "status": s}).done(function (data) {
		
	});
	
	}
*/
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugcnet/resources/views/admin/users/admin/edit.blade.php ENDPATH**/ ?>
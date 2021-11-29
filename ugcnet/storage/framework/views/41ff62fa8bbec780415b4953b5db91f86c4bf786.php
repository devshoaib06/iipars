<?php $__env->startSection('page_title'); ?>
	Student - Edit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
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
                                    <span class="caption-subject sbold "><?php echo e($user_info->firstname." ".$user_info->lastname); ?> 
                                       <!-- <span class="hidden-xs">| <?php echo e($user_info->email); ?></span>-->


                                    </span>
                                </div>
								
                                <div class="actions">
                                    
                                    <a href="<?php echo e(route('students')); ?>" class="btn default">Back</a>
                                    
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


								<?php 
										$myfunction = new App\library\myFunctions(); 
								?>

                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs nav-tabs-lg">


                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Overview </a>
                                        </li>
										<?php 
											if(Auth::guard('admins')->user()->user_type_id == 1){
											?> 
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Account </a>
                                        </li>
										
										
										<?php 
											}
											?> 

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <ul class="list-unstyled profile-nav">
                                                       
                                                       
                                                    </ul>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-8 profile-info">
                                                            <h1 class="font-green sbold uppercase"><?php echo e($user_info->firstname." ".$user_info->lastname); ?></h1>
                                                            <!--<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
                                                                </p>-->
															
															
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Gender</h2></div>
                                                                <div class="col-md-4">
                                                                    <?php if($user_info->gender=="1"): ?> Male <?php endif; ?>
                                                                    <?php if($user_info->gender=="2"): ?> Female <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Email</h2></div>
                                                                <div class="col-md-4"><?php echo e($user_info->email); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Country</h2></div>
                                                                <div class="col-md-4"><?php echo e(getCountryName($user_info->country_id)); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4"><h2 class="tag_fields">Address</h2></div>
                                                                <div class="col-md-4"><?php echo e($user_info->address); ?></div>
                                                            </div>


                                                        </div>
                                                        <!--end col-md-8-->
                                                       
                                                        <!--end col-md-4-->
                                                    </div>
                                                    <!--end row-->
                                                    
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
                                                        
                                                        <li>
                                                            <a data-toggle="tab" href="#tab_3-3">
                                                                <i class="fa fa-lock"></i> Change Password </a>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="tab-content">
                                                        <div id="tab_1-1" class="tab-pane active">
                                                            <form action="<?php echo e(route('student-update',['id'=>Hasher::encode($user_info->id)])); ?>" id="user_info_form"  method="POST">

                                                                <?php echo csrf_field(); ?>

                                                                <div class="form-group">
                                                                    <label class="control-label">First Name</label>
                                                                    <input type="text" value="<?php echo e($user_info->firstname); ?>" class="form-control" name="firstname"/> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <input type="text" value="<?php echo e($user_info->lastname); ?>" class="form-control" name="lastname"/> 
                                                                </div>
																
                                                                <div class="form-group">
                                                                    <label class="control-label">Gender</label>
                                                                    <select name="gender" id="gender" class="form-control">
                                                                        <option value="">Select Gender</option> 
                                                                        <option value="1"  <?php if($user_info->gender=='1'): ?> selected <?php endif; ?>>Male</option> 
                                                                        <option value="2"  <?php if($user_info->gender=='2'): ?> selected <?php endif; ?>>Female</option> 
                                                                    </select>                                                 
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text" name="email" class="form-control" id="email" value="<?php echo e($user_info->email); ?>"/> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Contact Number</label>
                                                                    <input type="text" name="contactnumber" class="form-control" id="contactnumber" value="<?php echo e($user_info->contactnumber); ?>"/> 
                                                                </div>
                                                               
                                                                <div class="form-group">

                                                                    <label class="control-label">Country</label>                                                                    
                                                                    <select name="country" id="country" class="form-control">
                                                                        <option value="">Select Country</option>
                                                                        <?php $__currentLoopData = $allCountries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($counties['id']); ?>" <?php if($user_info->country_id == $counties['id']): ?> selected <?php endif; ?>><?php echo e($counties['country_name']); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>                                                
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Address</label>
                                                                    <textarea class="form-control" rows="3" name="address"><?php echo e($user_info->address); ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    
                                                                    <div class="radio-list ">
                                                                        <label class="radio-inline" for="example-inline-radio1">
                                                                            <input id="example-inline-radio1" type="radio" value="1" name="status" <?php if( isset($user_info) && $user_info->status == '1'): ?> checked <?php endif; ?>> Active</label>
                                                                        <label class="radio-inline" for="example-inline-radio2">
                                                                            <input id="example-inline-radio2" type="radio" value="0" name="status" <?php if( isset($user_info) && $user_info->status == '0'): ?> checked <?php endif; ?>> Inactive</label>
                                                                    </div>
                                                                </div>

                                                                <div class="margiv-top-10">
                                                                    <button type="submit"  class="btn green">Save Changes</button>
                                                                    <!-- <a href="javascript:;" class="btn default"> Cancel </a>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="tab_2-2" class="tab-pane">
                                                            <!--<p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                                </p>-->
                                                           
                                                        </div>
                                                        <div id="tab_3-3" class="tab-pane">

                                                            <form action="<?php echo e(route('student-password-update',['id'=>Hasher::encode($user_info->id)])); ?>" id="password_checking"  method="POST">
                                                                <?php echo csrf_field(); ?>

                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" class="form-control" name="password" id="password"/> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" class="form-control" name="con_password" id="con_password"/> </div>
                                                                <div class="margin-top-10">

                                                                    <button type="submit"  class="btn green">Change Password</button>
                                                                    <!-- <a href="javascript:;" class="btn default"> Cancel </a>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <!--end col-md-9-->
                                            </div>
                                        </div>
										
										<!--div class="tab-pane" id="tab_1_4">
											<div class="row">
												test
											</div>
										</div-->
										
										
										
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
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



<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>    
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<script type="text/javascript">	


		var personal_info_validation = function () {

		// basic validation
		var handleValidation = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

				var form1 = $('#user_info_form');
				var error1 = $('.alert-danger', form1);
				var success1 = $('.alert-success', form1);
				form1.validate({
				errorElement: 'span', //default input error message container
						errorClass: 'help-block help-block-error', // default input error message class
						focusInvalid: false, // do not focus the last invalid input
						ignore: "", // validate all fields including form hidden input
						rules: {
							firstname: {
								required: true
							},
							lastname: {
								required: true
							},
							
							gender:{
								required: true
							},
							country: {
								required: true
							},
							/*mobile_number: {
								required: true,
									remote: {
									type: 'post',
											url: '<?php echo e(url(config("constants.admin_prefix")."/"."mobile-number-exist-update")); ?>',
											data: {
												'user_id': function () { return '<?php //echo $user_info->id ?>' }
											}
										}
							},*/
							address: {
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
							}
						},
						messages: {
						/*select_multi: {
						 maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
						 minlength: jQuery.validator.format("At least {0} items must be "selected"")
						 }*/
							email: {
								required: 'Please provide email',
										email:'Please provide proper email address',
										remote:'The email is already in use'
							},
							country: {
								required: 'Country is required.'
							},
							gender: {
								required: 'Please provide gender'
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

		var form1 = $('#image_upload_form');
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

		var form1 = $('#password_checking');
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
						},
								con_password:{
								equalTo: "#password"
								},
						},
						messages: {
						password:{
						required: "Please provide password",
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
		password_validation.init();});
		
        </script>

<script>
function change_hidden_value(id){
										
	if($("#checkbox_"+ id).is(':checked')){
	$("#hidden_"+ id).val(1); 												
	
	}else{
	$("#hidden_"+ id).val(0);
	
	}
	}	
	
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/users/student/edit.blade.php ENDPATH**/ ?>
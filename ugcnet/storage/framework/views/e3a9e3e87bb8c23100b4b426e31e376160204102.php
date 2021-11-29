<?php $__env->startSection('page_title'); ?>
	Orders - View
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
									<i class="icon-settings font-dark"></i>
									<span class="caption-subject font-dark sbold uppercase"> Request from - <?php echo e(@$order_info[0]->name); ?>

                    
										<span class="hidden-xs">| <?php echo e(\Carbon\Carbon::parse(@$order_info[0]->requested_date)->format('F j, Y')); ?>  </span>
									</span>
								</div>
								
							</div>
							<div class="portlet-body">
								<div class="tabbable-line">
									<ul class="nav nav-tabs nav-tabs-lg">
										<li class="active">
											<a href="#tab_1" data-toggle="tab"> Details </a>
										</li>
										
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1">
											
											<div class="row" >
												<div class="col-md-12 col-sm-12">
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
													<div class="portlet grey-cascade box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-cogs"></i>Orders</div>
															
														</div>
														
														<div class="portlet-body">
															<div class="table-responsive">
																<form action="<?php echo e(route('updatePaymentRequestDetails',['id'=>\Hasher::encode(@$order_info[0]->id)])); ?>" method="POST" id="request_info_form">
																	<?php echo csrf_field(); ?>
																<table class="table table-hover table-bordered table-striped">
																	<thead>
																		<tr>
																			<th> </th>
																			<th> Order No. </th>
																			
																			<th> Course </th>
																			<th> Purchase Date </th>
																			<th> Price </th>
																			<th> Earned Amount </th>
																			<th> Status </th>
																			<th> Pay Date </th>
																			<th> Pay Type  </th>
																			<th> Cheque No/NEFT</th>
																		</tr>
																	</thead>

																	<tbody>
																		<?php $__empty_1 = true; $__currentLoopData = $order_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
																			<?php 
																				$pay_status="Due";
																				if($order->pay_status==1){
																					$pay_status="Pending";

																				}
																				if($order->pay_status==2)
																					$pay_status="Paid";
																			?>
																			<tr class="order-row">
																			<td>
																				<input type="checkbox"  class="form-control pay-checkbox" 
																					value="<?php echo e($order->order_id); ?>" name="order_no[]"
																					<?php echo e($order->pay_status==2?'disabled':''); ?>

																				>
																			</td>
																			<td><?php echo e($order->order_no); ?></td>
																			<td><?php echo e($order->course_name); ?></td>
																			<td><?php echo e(\Carbon\Carbon::parse($order->purchase_date)->format('d/m/Y')); ?></td>
																			<td><?php echo e(floor($order->revised_price?$order->revised_price:$order->price)); ?></td>
																			<td><?php echo e($order->order_amount); ?></td>
																			<td><?php echo e($pay_status); ?></td>
																			<?php if($order->pay_status==2): ?>
																				<td>
																					<?php echo e(\Carbon\Carbon::parse($order->pay_date)->format('d/m/Y')); ?>

																				</td>
																				<td>
																					<?php if($order->pay_type==1): ?>
																					Cheque
																					<?php elseif($order->pay_type==2): ?>
																					NEFT
																					<?php endif; ?>
																					
																				</td>
																				<td>
																					<?php echo e($order->cheque_no_neft); ?>

																					
																				</td>
																			<?php else: ?>
																				<td>
																						<input class="form-control  date-picker field-check" name="pay_date[]" size="16" type="text" value="" disabled="disabled" />
																				</td>
																				<td>
																					<select name="pay_types[]" class="form-control field-check" disabled="disabled">
																						<option value="">Select</option>
																						<option value="1">Cheque</option>
																						<option value="2">NEFT</option>
																					</select>
																					
																				</td>
																				<td>
																					<input type="text" value="" class="form-control field-check" name="pay_no[]" disabled="disabled">
																					
																				</td>
																			<?php endif; ?>
																				
																				
																			</tr>
																		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
																			<tr>
																				<td colspan="9">No order yet.</td>
																			</tr>	
																		<?php endif; ?>
																		
																	</tbody>
																</table>
																<div class="text-right">
																<input type="submit" value="Save" class="btn green">
																</div>
																</form>
															</div>
														</div>
													</div>
												</div>
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
<style>
	.payment_details-section .value,.order-status{
		text-transform: capitalize;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
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
jQuery(document).ready(function() {    
    ComponentsDateTimePickers.init(); 
	personal_info_validation.init();
});
}

$('.pay-checkbox').click(function(){
	if($(this).is(":checked")){
		$(this).parents('.order-row').find(':disabled').removeAttr('disabled','disabled');
		$(this).parents('.order-row').find('.field-check').attr("required","required");
	}else{
		
		$(this).parents('.order-row').find('.field-check').attr('disabled','disabled');
		$(this).parents('.order-row').find('.field-check').prop('required',false);
	}
});
</script>
<script>
	var personal_info_validation = function () {
    // basic validation
    var handleValidation = function() {
        var form1 = $('#request_info_form');
        var tab1 = $('#tab_1');
        var error1 = $('.alert-danger', tab1);
        var success1 = $('.alert-success', tab1);

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
               
            },
            messages: {
                
                'videos[]': {
                    required: 'Country is required.'

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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/payment-request/view.blade.php ENDPATH**/ ?>
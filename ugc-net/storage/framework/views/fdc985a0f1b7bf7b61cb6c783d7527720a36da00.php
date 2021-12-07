<?php $__env->startSection('page_title'); ?>
	Test Pattern 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<!--<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />-->
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

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
				
				</div>
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject sbold ">  Test Pattern List</span>
                                </div>
                                
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
											<?php 
											if(Auth::guard('admins')->user()->user_type_id == 1){
											?> 
                                           <div class="btn-group">
                                                <a href="<?php echo e(route('createMockTemplate')); ?>"><button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button></a> 
                                            </div>
											<?php 
											}
											?> 
                                            
                                        </div>
                                        <div class="col-md-6">
                                         
                                        </div>
                                    </div>
                                </div>
                                 <div class="table-container">
								 <?php if(Session::has('message')): ?>                         
                                        <div class="<?php echo e(Session::get('messageClass')); ?>">
                                            <button class="close" data-close="alert"></button>
                                            <span><?php echo e(Session::get('message')); ?> </span>
                                        </div>
                                        <?php endif; ?>  
                                    <table class="table table-striped table-bordered table-hover" id="employer_list">
                                        <thead>
                                            <tr role="row" class="heading">	
												<th width="3%"> #ID </th>
                                               
                                                <th width="20%"> Name </th>
                                                <th width="15%"> Duration (In Minutes) </th>
                                                <th width="15%"> Rule </th>
                                                <th width="15%"> Level </th>
                                                <th width="15%"> Status </th>
                                                <th width="5%"> Action </th>

                                            </tr>
                                            <tr role="row" class="filter">
												<td></td>
												
                                                <td>
                                                   
                                                    <input type="text" name="question" class="form-control form-filter input-sm" >
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
												<td>
                                                    <select name="status" class="form-control form-filter input-sm">
                                                        <option value="">Select...</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>                                                          
                                                    </select>
                                                </td>
                                                
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <button class="btn btn-sm yellow filter-submit margin-bottom">
                                                            <i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                    <button class="btn btn-sm red filter-cancel">
                                                        <i class="fa fa-times"></i> Reset</button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
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

<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<script type="text/javascript">

        var EcommerceOrdersView = function () {

            var handleHistory = function () {

                var grid = new Datatable();

                grid.init({
                    src: $("#employer_list"),
                    onSuccess: function (grid) {
                        // execute some code after table records loaded
                    },
                    onError: function (grid) {
                        // execute some code on network or other general error  
                    },
                    loadingMessage: 'Loading...',
                    dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 
                        "lengthMenu": [
                            [<?php echo e(config("constants.LENGTH_MENU_ADVANCE_1")); ?>, -1],
							[<?php echo e(config("constants.LENGTH_MENU_ADVANCE_2")); ?>, "All"] // change per page values her
                        ],
                        "pageLength": <?php echo e(config("constants.PAGE_LENGTH_ADVANCE")); ?>, // default record count per page
                        "bServerSide": true,
                        "bProcessing": true,
                        "ajax": {                            
                            "url": "<?php echo e(url(route('ajaxMockTemplateList'))); ?>", // ajax source					
                        },
                        "columnDefs": [{// define columns sorting options(by default all columns are sortable extept the first checkbox column)
                                'orderable': false,
                                'targets': [4]
                            }],
                        "order": [
                            [0, "desc"]
                        ] // set first column as a default sort by asc
                    }
                });

                // handle group actionsubmit button click
                grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                    e.preventDefault();
                    var action = $(".table-group-action-input", grid.getTableWrapper());
                    if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                        grid.setAjaxParam("customActionType", "group_action");
                        grid.setAjaxParam("customActionName", action.val());
                        grid.setAjaxParam("id", grid.getSelectedRows());
                        grid.getDataTable().ajax.reload();
                        grid.clearAjaxParams();
                    } else if (action.val() == "") {
                        App.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'Please select an action',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    } else if (grid.getSelectedRowsCount() === 0) {
                        App.alert({
                            type: 'danger',
                            icon: 'warning',
                            message: 'No record selected',
                            container: grid.getTableWrapper(),
                            place: 'prepend'
                        });
                    }
                });
            }

            var initPickers = function () {
                //init date pickers
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    autoclose: true
                });

                $(".datetime-picker").datetimepicker({
                    isRTL: App.isRTL(),
                    autoclose: true,
                    todayBtn: true,
                    pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
                    minuteStep: 10
                });
            }

            return {
                //main function to initiate the module
                init: function () {
                    initPickers();

                    handleHistory();
                }

            };

        }();

        jQuery(document).ready(function () {
            EcommerceOrdersView.init();
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iipars/ugcnet/resources/views/admin/mock-test/template/list.blade.php ENDPATH**/ ?>
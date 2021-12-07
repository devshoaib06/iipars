<?php $__env->startSection('page_title'); ?>
    Categories
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="public/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                            <a href="#">Tables</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Datatables</span>
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
                    <h3>DataTables jQuery Plugin</h3>
                    <p> DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. </p>
                    <p> For more info please check out
                        <a class="btn red btn-outline" href="http://datatables.net/" target="_blank">the official documentation</a>
                    </p>
                </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase"> Article Categories <?php /*if(isset($template) && !empty($template)) echo "(".count($template).")";*/ ?></span>
                                </div>
                                <!--<div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                    </div>
                                </div>-->
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
											if(Auth::guard('admins')->user()->user_type_id == 1){
											?> 
                                           <div class="btn-group">
                                                <a href="<?php echo e(route('createCategory')); ?>"><button id="sample_editable_1_new" class="btn sbold green"> Add New
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
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" >
                                    <thead>
                                        <tr>
                                           <th width="5%"> # </th>
                                            <th width="70%"> Category </th>                         
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ++$count; ?>
                                        <tr class="odd gradeX">
                                           <td> <?php echo e($count); ?> </td>     
                                            <td> <?php echo e($c->name); ?> </td>
                                            <?php if($c->status): ?>
                                            <td> <span class="label label-sm label-success"> Active </span> </td>
                                            <?php else: ?>
                                            <td> <span class="label label-sm label-danger"> Inactive </span> </td>                                                         
                                            <?php endif; ?>
                                            <td>  
                                                
                                                 <a  href="<?php echo e(route('editArticleCategory',['id'=>Hasher::encode($c->id)])); ?>" data-toggle="tooltip" class="btn btn-default btn-sm"><i class="fa fa-edit "></i>Edit</a>
                                                
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                         
                                    </tbody>
                                </table>
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
<script src="<?php echo asset('public/assets/global/scripts/datatable.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('public/assets/global/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('page_level_scripts'); ?>


    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        $('#sample_1').DataTable();
    </script>   
    <!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/articles/categories/list.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page_title'); ?>
	Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
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
				<h3 class="page-title"> Dashboard
					<!--<small>blank page layout</small>-->
				</h3>
				<div class="note note-info">
					<p> Welcome To <?php echo e(config("constants.site_name")); ?>  </p>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalStudent) ): ?><?php echo e($totalStudent); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Students </div>
							</div>
							<a class="more" href="<?php echo e(config('constants.admin_prefix')); ?>/students"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalContrubutor) ): ?><?php echo e($totalContrubutor); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Contributors </div>
							</div>
							<a class="more" href="<?php echo e(config('constants.admin_prefix')); ?>/contributors"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
                        
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat  green-meadow">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalDistributor) ): ?><?php echo e($totalDistributor); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Distributors </div>
							</div>
							<a class="more" href="<?php echo e(config('constants.admin_prefix')); ?>/distributors"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat red-haze">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalCourse) ): ?><?php echo e($totalCourse); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Courses </div>
							</div>
							<a class="more" href="<?php echo e(route('courses')); ?>"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat purple">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalOrder) ): ?><?php echo e($totalOrder); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Orders </div>
							</div>
							<a class="more" href="<?php echo e(route('orderList')); ?>"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat grey-mint">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($totalSubscriber) ): ?><?php echo e($totalSubscriber); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Subscribers </div>
							</div>
							<a class="more" href="<?php echo e(route('newsletter-list')); ?>"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat yellow-casablanca">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php if( isset($visitorcount) ): ?><?php echo e($visitorcount); ?><?php endif; ?>">0</span>
								</div>
								<div class="desc"> Total Visitors </div>
							</div>
							<a class="more" href="javascript::void(0)" style="visibility: hidden"> View All
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</div>
				
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				
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
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>
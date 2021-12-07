@extends('admin.layouts.app')

@section('page_title')
	Dashboard
@endsection

@section('page_level_plugins_css')
@endsection

@section('page_level_css')
@endsection



@section('content')	
	
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
				@include('admin.partials.sidebarMenu')
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
				@include('admin.partials.theme')
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
					<p> Welcome To {{config("constants.site_name")}}  </p>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-user"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="@if( isset($totalStudent) ){{ $totalStudent }}@endif">0</span>
								</div>
								<div class="desc"> Total Students </div>
							</div>
							<a class="more" href="{{ config('constants.admin_prefix') }}/students"> View All
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
									<span data-counter="counterup" data-value="@if( isset($totalContrubutor) ){{ $totalContrubutor }}@endif">0</span>
								</div>
								<div class="desc"> Total Contributors </div>
							</div>
							<a class="more" href="{{ config('constants.admin_prefix') }}/contributors"> View All
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
									<span data-counter="counterup" data-value="@if( isset($totalDistributor) ){{ $totalDistributor }}@endif">0</span>
								</div>
								<div class="desc"> Total Distributors </div>
							</div>
							<a class="more" href="{{ config('constants.admin_prefix') }}/distributors"> View All
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
									<span data-counter="counterup" data-value="@if( isset($totalCourse) ){{ $totalCourse }}@endif">0</span>
								</div>
								<div class="desc"> Total Courses </div>
							</div>
							<a class="more" href="{{ route('courses')}}"> View All
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
									<span data-counter="counterup" data-value="@if( isset($totalOrder) ){{ $totalOrder }}@endif">0</span>
								</div>
								<div class="desc"> Total Orders </div>
							</div>
							<a class="more" href="{{ route('orderList')}}"> View All
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
									<span data-counter="counterup" data-value="@if( isset($totalSubscriber) ){{ $totalSubscriber }}@endif">0</span>
								</div>
								<div class="desc"> Total Subscribers </div>
							</div>
							<a class="more" href="{{ route('newsletter-list')}}"> View All
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
									<span data-counter="counterup" data-value="@if( isset($visitorcount) ){{ $visitorcount }}@endif">0</span>
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
		@include('admin.partials.quickSidebar')
		<!-- END QUICK SIDEBAR -->
	</div>		
	<!-- END CONTAINER -->

@endsection


@section('page_level_plugins')
<script src="{{config('path.assets_path')}}/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
@endsection

@section('page_level_scripts')
@endsection
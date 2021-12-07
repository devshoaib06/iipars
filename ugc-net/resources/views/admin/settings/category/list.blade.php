@extends('admin.layouts.app')

@section('page_title')
	Category 
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
										<i class="icon-venture"></i> Something else here</a>
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
				<h3 class="page-title"> <?php /*Manage Country
					<small>blank page layout</small>*/ ?>
				</h3>
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <i class="icon-settings "></i>
                                    <span class="caption-subject sbold ">  Category </span>
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
                                            <div class="btn-group">
                                                <a href="{{ url(config("constants.admin_prefix").'/add-category') }}"><button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!--<div class="btn-group pull-right">
                                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-print"></i> Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="table-container">
									@if(Session::has('message'))                         
                                        <div class="{{ Session::get('messageClass') }}">
                                            <button class="close" data-close="alert"></button>
                                            <span>{{ Session::get('message') }} </span>
                                        </div>
                                        @endif  
                                	<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%"> # </th>
                                            <th width="30%"> Parent </th>
                                            <th width="30%"> Name </th>
                                            <th width="15%"> Updated Date </th>
                                            <th width="10%"> Status </th>
                                            <th width="5%"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>									
                                        <?php 
										$count = 0; 
										?>
                                        @foreach ($masterList as $list)
										<?php ++$count; ?>
										@php
										
										$parentObj = \App\Category::find($list->parent_id);
										
										@endphp
                                        <tr class="odd gradeX">
											<td> {{ $count }} </td> 
											<td> {{ $parentObj['name'] }} </td> 
											<td> {{ $list->name }} </td>            
                                            <td> {{ App\library\myFunctions::dateText($list->updated_at,'d_m_y') }} </td>
                                            <td>
                                                @if ($list->is_active == '1')
                                                <span class="label label-sm label-success"> Active </span>
                                                @elseif ($list->is_active == '0')
                                                <span class="label label-sm label-warning"> Inactive </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a  href="{{ url(config("constants.admin_prefix").'/edit-category') }}/{{\Hasher::encode($list->category_id)}}" data-toggle="tooltip" class="btn btn-default btn-sm"><i class="fa fa-edit "></i> Edit </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
		@include('admin.partials.quickSidebar')
		<!-- END QUICK SIDEBAR -->
	</div>    
    <!-- END CONTAINER -->

@endsection

@section('page_level_plugins')
<script src="{{config('path.assets_path')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
@endsection

@section('page_level_scripts')
<script type="text/javascript">
        var TableDatatablesManaged = function () {

        var initTable1 = function () {

        var table = $('#sample_1');
                // begin first table
                table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                "aria": {
                "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                },
                        "emptyTable": "No Record Found",
                        "info": "Showing _START_ to _END_ of _TOTAL_ records",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "lengthMenu": "Show _MENU_",
                        "search": "Search:",
                        "zeroRecords": "No matching records found",
                        "paginate": {
                        "previous":"Prev",
                                "next": "Next",
                                "last": "Last",
                                "first": "First"
                        }
                },
                        // Or you can use remote translation file
                        //"language": {
                        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                        //},

                        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                        // So when dropdowns used the scrollable div should be removed.
                        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                        "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
                        "columnDefs": [ {
                        "targets": 0,
                                "orderable": false,
                                "searchable": false
                        }],
                        "lengthMenu": [
                                [ {{ config("constants.LENGTH_MENU_BASIC_1") }}, - 1],
                                [ {{ config("constants.LENGTH_MENU_BASIC_2") }}, "All"]
                        ],
                        // set the initial value
                        "pageLength": {{ config("constants.PAGE_LENGTH_BASIC") }},
                        "pagingType": "bootstrap_full_number",
                        "columnDefs": [{  // set default column settings
                        'orderable': false,
                                'targets': [0, 1, 5]
                        }, {
                        "searchable": false,
                                "targets": [2]
                        }],
                        "order": [
                                [2, "asc"]
                        ] // set first column as a default sort by asc
                });
                var tableWrapper = jQuery('#sample_1_wrapper');
                table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
        if (checked) {
        $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
        } else {
        $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
        }
        });
                jQuery.uniform.update(set);
        });
                table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
                });
        }



        return {

        //main function to initiate the module
        init: function () {
        if (!jQuery().dataTable) {
        return;
        }

        initTable1();
        }

        };
        }();
        if (App.isAngularJsApp() === false) {
            jQuery(document).ready(function() {
            TableDatatablesManaged.init();
        });
        }
    </script>
@endsection
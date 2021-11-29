@extends('admin.layouts.app')

@section('page_title')
	Questions
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<!--<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />-->
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

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
				@include('admin.partials.sidebarMenu')
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
				
				</div>
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject sbold ">  Question List</span>
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
                                                <a href="{{ route('createQuestion')}}"><button id="sample_editable_1_new" class="btn sbold green"> Add New
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
								 @if(Session::has('message'))                         
                                        <div class="{{ Session::get('messageClass') }}">
                                            <button class="close" data-close="alert"></button>
                                            <span>{{ Session::get('message') }} </span>
                                        </div>
                                        @endif  
                                    <table class="table table-striped table-bordered table-hover" id="employer_list">
                                        <thead>
                                            <tr role="row" class="heading">	
												<th width="3%"> #ID </th>
                                               
                                                <th width="20%"> Question </th>
                                                <th width="15%"> Category </th>
                                                <th width="15%"> Status </th>
                                                <th width="5%"> Action </th>

                                            </tr>
                                            <tr role="row" class="filter">
												<td></td>
												
                                                <td>
                                                   
                                                    <input type="text" name="question" class="form-control form-filter input-sm" >
                                                </td>
                                                <td>
                                                    <select name="category" class="form-control form-filter input-sm">
                                                        <option value="">Select...</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                            
                                                        @endforeach
                                                    </select>
												</td>
                                                
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
		@include('admin.partials.quickSidebar')
		<!-- END QUICK SIDEBAR -->
	</div>    
    <!-- END CONTAINER -->

@endsection


@section('page_level_plugins')

<script src="{{config('path.assets_path')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

@endsection

@section('page_level_scripts')
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
                            [{{config("constants.LENGTH_MENU_ADVANCE_1")}}, -1],
							[{{config("constants.LENGTH_MENU_ADVANCE_2")}}, "All"] // change per page values her
                        ],
                        "pageLength": {{config("constants.PAGE_LENGTH_ADVANCE")}}, // default record count per page
                        "bServerSide": true,
                        "bProcessing": true,
                        "ajax": {                            
                            "url": "{{ url(route('ajaxQuestionList')) }}", // ajax source					
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
@endsection
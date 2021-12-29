@extends('admin.layouts.app')

@section('page_title')
	Courses
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
				<!--<h3 class="page-title">  Managed Location
					<small>blank page layout</small>
				</h3>-->
				<!-- END PAGE TITLE-->
				<!-- END PAGE HEADER-->
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject sbold ">  Course List</span>
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
                                                <a href="{{ route('createCourse')}}"><button id="sample_editable_1_new" class="btn sbold green"> Add New
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
                                    <div class="alert alert-danger " id="hidden-msg">
                                        <button class="close" data-close="alert"></button>
                                        <span class="er-msg"></span>
                                    </div>
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
                                                {{-- <th width="5%"> Course ID </th> --}}
                                                <th width="20%"> Name </th>
                                                <th width="15%"> Exams </th>
                                                <th width="15%"> Papers </th>
                                                {{-- <th width="10%"> Subjects </th> --}}
												<th width="18%"> Start Date </th>
												<th width="20%"> End Date </th>
												<th width="20%"> Order </th>
                                                <th width="15%"> Status </th>
                                                <th width="5%"> Action </th>

                                            </tr>
                                            <tr role="row" class="filter">
												<td></td>
												{{-- <td></td> --}}
                                                <td>
                                                    {{-- <select name="product_id" id="product_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Course</option>
                                                        @foreach($allProducts as $v)
                                                        <option value="{{ $v->product_id }}" >{{ $v->name }}</option>
                                                        @endforeach
                                                    </select>   
                                                    --}}
                                                    <input type="text" name="product_name" class="form-control form-filter input-sm" >
                                                </td>
                                                <td>
                                                    <select name="exam_id" id="exam_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Exam</option>
                                                        @foreach($allExams as $v)
                                                        <option value="{{ $v->id }}" >{{ $v->exam_name }}</option>
                                                        @endforeach
                                                    </select>
												</td>
                                                <td>
                                                    <select name="paper_id" id="paper_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Paper</option>
                                                        @foreach($allPapers as $v)
                                                    <option value="{{ $v->id }}" >{{$v->exam_name}} - {{ $v->paper_name }} </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                
                                                {{-- <td>
                                                    <select name="subject_id" id="subject_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Subject</option>
                                                        @foreach($allsubjects as $v)
                                                    <option value="{{ $v->id }}" >{{ $v->subject_name }} </option>
                                                        @endforeach
                                                    </select>

                                                </td> --}}
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="date_from" placeholder="Start Date">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="date_to" placeholder="End Date">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    
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
        $('body').on('click','.remove-product',function(){
        //debugger;
            var $tr = $(this).closest('tr');
            var product_id=$(this).data('value');
                var data={product_id:product_id};
                var url="{{route('ajaxProductDelete')}}";
                var confirm_text=confirm('Are you sure you want to delete?')
                if(confirm_text){

                    $.post(url,data,function(response){
                        var res=JSON.parse(response);
                        debugger
                        if(res.status==1){
                            $tr.find('td').fadeOut(1000,function(){ 
                                        $tr.remove();                    
                            });
                        }else{
                            $("#hidden-msg").show();
                            $('.er-msg').text(res.message);
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        }
                    })
                }
                    
        });

        var EcommerceOrdersView = function () {
            $("#hidden-msg").hide();

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
                            "url": "{{ url(route('ajaxCourseList')) }}", // ajax source					
                        },
                        "columnDefs": [{// define columns sorting options(by default all columns are sortable extept the first checkbox column)
                                'orderable': false,
                                'targets': [7]
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
            $(document).on('change','.sequence_update',function(){
                debugger
                let product_id=$(this).data('id');
                let sequence=$(this).val();
                let url= "{{ route('saveProductSequence') }}"

                let data={
                    product_id:product_id, 
                    sequence:sequence
                }
                $.post(url,data,function(response){

                })
            })
        });

    </script>
@endsection
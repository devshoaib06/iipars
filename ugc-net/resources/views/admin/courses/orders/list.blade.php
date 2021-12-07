@extends('admin.layouts.app')

@section('page_title')
	Orders
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
                                    <span class="caption-subject sbold ">  Order List</span>
                                </div>
                                
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
											
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
												
                                                <th width="15%"> Order</th>
                                                <th width="15%"> Buyer </th>
                                                <th width="15%"> Course </th>
                                                {{-- <th width="15%"> Subject </th> --}}
                                                <th width="10%"> Amount </th>
                                                <th width="20%"> Purchase Date </th>
												<th width="20%"> Expiry </th>
												<th width="15%"> Status </th>
												
                                                <th width="5%"> Action </th>

                                            </tr>
                                            <tr role="row" class="filter">
												
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="order_number" placeholder="Order number" />                                                  
                                                </td>
                                                <td>
                                                    <select name="user_id" id="user_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Student</option>
                                                        @foreach($allStudents as $v)
                                                        <option value="{{ $v->id }}" >{{ $v->firstname }} {{ $v->lastname }}</option>
                                                        @endforeach
                                                    </select>
												</td>
                                                <td>
                                                    <select name="product_id" id="product_id" class="form-control form-filter input-sm" > 
                                                        <option value="" >Select Course</option>
                                                        @foreach($allCourses as $v)
                                                    <option value="{{ $v->product_id }}" >{{$v->name}}  </option>
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
                                                    <input type="text" class="form-control form-filter input-sm" name="amount" placeholder="Amount" />                                                  

                                                </td>
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="purchase_date_from" placeholder="Start Date">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="purchase_date_to" placeholder="End Date">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="date_from" placeholder="Start Date">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
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
                                                    <select id="payment_status" name="payment_status" class="form-control form-filter input-sm">
                                                        <option value="">Select</option>
                                                        <option value="created">Pending</option>
                                                        <option value="success">Success</option>
                                                    </select>
                                                </td>
                                                
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <button class="btn btn-sm yellow btn-search filter-submit margin-bottom">
                                                            <i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                    <button class="btn btn-sm red filter-cancel btn-reset">
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
            <div class="modal fade" id="viewOrder" role="dialog">
                <div class="modal-dialog modal-lg">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                    </div>
                    <div class="modal-body">
                          
                            <div class="order_details"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button " class="btn btn-default invoice_url_btn" ><a href="#" class="invoice_url">Invoice</a></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    </div>
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
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

@endsection

@section('page_level_scripts')
<script>
    $('body').on('click','.remove-order',function(){
        //debugger;
        var $tr = $(this).closest('tr');
        var order_id=$(this).data('value');
            var data={order_id:order_id};
            var url="{{route('ajaxOrderDelete')}}";
            if(confirm('Are you sure you want to delete?')){

                $.post(url,data,function(){
                    $tr.find('td').fadeOut(1000,function(){ 
                                $tr.remove();                    
                    });
                })
            }
                
    });
    
    
    
    $(document).on('click','.viewBilling',function(){
       // 
        let url="{{route('viewOrderDetails')}}";
        let data={
            order_id:$(this).data('orderid')
        }    
        $.post(url,data,function(response){
            $('.order_details').html(response.html);
        })
    });    
</script>
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
                            "url": "{{ url(route('ajaxOrderList')) }}", // ajax source					
                        },
                        "columnDefs": [{// define columns sorting options(by default all columns are sortable extept the first checkbox column)
                                'orderable': false,
                                'targets': [0,4]
                            }],
                        "order": [
                            [1, "asc"]
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
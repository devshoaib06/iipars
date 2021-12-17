@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @include('frontend.includes.student_menu')
                </div>
                <div class="col-sm-12">
                    <div class="tabCont">
                        <h1>Orders</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="order_table">
                                <thead>
                                    <tr role="row" class="heading">	
                                        
                                        <th width="15%"> Order</th>
                                        {{-- <th width="15%"> Buyer </th> --}}
                                        <th width="15%"> Course </th>
                                        {{-- <th width="15%"> Subject </th> --}}
                                        <th width="10%"> Amount </th>
                                        <th width="15%"> Purchase Date </th>
                                        <th width="15%"> Expiry </th>
                                        <th width="15%"> Status </th>
                                        
                                        <th width="5%"> Action </th>

                                    </tr>
                                    
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <?php 
                                        $status="";
                                        if($order->status=="created"){
                                            $status="Pending";
                                        }
                                        if($order->status=="success"){
                                            $status="Success";
                                        }
                                    ?>
                                    <tr>
                                        <td>{{$order->order_id}}</td>
                                        <td>{{$order->product_name}}</td>
                                        {{-- <td>{{$order->order_id}}</td> --}}
                                        <td>{{$order->grand_total}}</td>
                                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($order->end_date)->format('d/m/Y')}}</td>
                                        <td>{{$status}}</td>
                                    <td><a href="#" data-order_id={{$order->id}} class="btn btn-sm btn-default viewBilling" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> View </a></td>
                                    
                                    </tr>
                                @endforeach    
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('page_js')
<script>
  $(document).ready(function(){

   
  })  
</script>
<script src="{{asset('public/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
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
                    // App.alert({
                    //     type: 'danger',
                    //     icon: 'warning',
                    //     message: 'Please select an action',
                    //     container: grid.getTableWrapper(),
                    //     place: 'prepend'
                    // });
                } else if (grid.getSelectedRowsCount() === 0) {
                    // App.alert({
                    //     type: 'danger',
                    //     icon: 'warning',
                    //     message: 'No record selected',
                    //     container: grid.getTableWrapper(),
                    //     place: 'prepend'
                    // });
                }
            });
        }

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                //rtl: App.isRTL(),
                autoclose: true
            });

            $(".datetime-picker").datetimepicker({
                //isRTL: App.isRTL(),
                autoclose: true,
                todayBtn: true,
               // pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
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
        //EcommerceOrdersView.init();
        $("#order_table").dataTable({
            order: [[ 0, "desc" ]]
        } );
        $('.viewBilling').on('click',function(){
        let url="{{route('viewOrderInfo')}}";
        let data={
            order_id:$(this).data('order_id')
        }    
            $.get(url,data,function(response){

                $("#order_details").html(response.html);
            })

        });

    });


</script>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Order Information</h4>
        </div>
        <div id="order_details">

        </div>
        
      </div>
      
    </div>
  </div>
  <style>
  table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
  }
  th, td {
	padding: 5px;
	text-align: left;
  }
  </style>

@endpush
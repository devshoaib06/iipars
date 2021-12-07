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
                        <h1>Mock Tests</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="order_table">
                                <thead>
                                    <tr role="row" class="heading">	
                                        
                                        <th width="15%"> Test</th>
                                        {{-- <th width="15%"> Buyer </th> --}}
                                        <th width="15%"> Subject </th>
                                        {{-- <th width="15%"> Subject </th> --}}
                                        <th width="10%"> Course </th>
                                        <th width="15%"> Test Date </th>
                                        <th width="15%"> Full Marks </th>
                                        <th width="15%"> Secured Marks </th>
                                        <th width="15%"> Status </th>
                                        
                                        

                                    </tr>
                                    
                                </thead>
                                <tbody>
                                @foreach($allmocktests as $mocktest)
                                    <?php 
                                        $status="";
                                        if($mocktest->countdown>0){
                                            $status="Pending";
                                        }
                                        else{
                                            $status="Completed";
                                        }
                                    ?>
                                    <tr>
                                        <td>{{$mocktest->test_name}}</td>
                                        <td>{{$mocktest->subject->subject_name}}</td>
                                        <td>{{$mocktest->course->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($mocktest->start_datetime)->format('d/m/Y')}}</td>
                                        <td>{{$mocktest->secured_marks}}</td>
                                        <td>{{$mocktest->full_marks}}</td>
                                        @if ($mocktest->countdown>0)
                                            <td> <span class="label label-sm label-warning">Pending</span>
                                                <a href="{{route('mocktest',['mock_test_id'=>\Hasher::encode($mocktest->id)])}}">
                                                    <i class="fa fa-play" aria-hidden="true" title="Resume"></i>
                                                </a>
                                            </td>
                                            
                                        @else
                                            <td><span class="label label-sm label-success"> Finished </span></td>
                                            
                                        @endif
                                        {{-- <td>{{$order->product_name}}</td>
                                        
                                        <td>{{$order->grand_total}}</td>
                                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($order->end_date)->format('d/m/Y')}}</td>
                                    <td><a href="#" data-order_id={{$order->id}} class="btn btn-sm btn-default viewBilling" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> View </a></td> --}}
                                    
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
            order: [[ 3, "desc" ]]
        } );
        $('.viewBilling').on('click',function(){
        let url="{{route('viewOrderInfo')}}";
        let data={
            order_id:$(this).data('order_id')
        }    
            $.get(url,data,function(response){
                let pay_status=response.order_info.payment_status=='created'?'Pending':response.order_info.payment_status;
                let discount_amount=response.order_info.discount_amount==null?'0.00':response.order_info.discount_amount;
                let revised_price=response.order_info.revised_price==null?'0.00':response.order_info.revised_price
                let street_address_2= response.billing_info.street_address_2==null?'': response.billing_info.street_address_2;
               
                $('.card_info').show();
                if(pay_status=="Pending"){
                    $('.card_info').hide();
                }
                $('.order_no').text(response.order_info.order_id)
                
                
                $('.order_date').text(response.order_date)
                $('.order_status').text(pay_status)
                $('.grand_total').text(response.order_info.grand_total)

                $('.cust_name').text(response.billing_info.first_name+' '+response.billing_info.last_name)
                $('.email').text(response.billing_info.email)
                $('.phone_number').text(response.billing_info.phone)
                // if("")
                // $('.biller_name').text(response.order_info.fullname);
                $('.address').text(response.billing_info.street_address_1+' '+ street_address_2)
                $('.city_zip').text(response.billing_info.city+' '+response.billing_info.zip)
                $('.state').text(response.state.state_name)
                $('.country').text(response.country.country_name)


                $('.product_name').text(response.order_info.product_name)
                $('.org_price').text('₹'+response.order_info.price)
                $('.revised_price').text('₹'+revised_price)
                $('.discount_amount').text('₹'+discount_amount)
                $('.grand_total').text('₹'+response.order_info.grand_total)
                if(response.order_info.student_cb_amount!=""){

                    $('.cashback').text('₹'+ response.order_info.student_cb_amount)
                }
                $('.invoice_url').attr("href",response.invoice_url);

                if(response.payment_details.payment_method=="Free"){
                    $('.invoice_url').hide();
                    $('.invoice_url_btn').hide();
                }
                
                let pay_html='';
                   

                    pay_html+='<tr>';
                    pay_html+= '<th style="width: 30%">Payment Type:</th>';
                    pay_html+= '<td class="last4digit">'+response.payment_details.payment_method+'</td>';
                    pay_html+= '</tr>';
                    pay_html+= '<tr>';
                    if(response.payment_details.payment_method=="card"){
                        pay_html+='<tr>';
                        pay_html+= '<th style="width: 30%">Last 4 digit:</th>';
                        pay_html+= '<td class="last4digit">'+response.card_info.last4digit+'</td>';
                        pay_html+= '</tr>';
                        pay_html+= '<tr>';
                        pay_html+= ' <th>Card Network:</th>';
                        pay_html+= ' <td class="card_network">'+response.card_info.card_network+'</td>';
                        pay_html+= '</tr>';
                        pay_html+= '<tr>';
                        pay_html+= ' <th>Card Type:</th>';
                        pay_html+= ' <td class="card_type">'+response.card_info.card_type+'</td>';
                        pay_html+= '</tr>';
                    }
                    if(response.payment_details.payment_method=="netbanking"){
                        pay_html+='<tr>';
                        pay_html+= '<th style="width: 30%">Bank:</th>';
                        pay_html+= '<td class="last4digit">'+response.payment_details.bank+'</td>';
                        pay_html+= '</tr>';
                        
                    }
                    if(response.payment_details.payment_method=="upi"){
                        pay_html+='<tr>';
                        pay_html+= '<th style="width: 30%">UPI ID:</th>';
                        pay_html+= '<td class="last4digit">'+response.payment_details.vpa+'</td>';
                        pay_html+= '</tr>';
                        
                    }
                    if(response.payment_details.payment_method=="wallet"){
                        pay_html+='<tr>';
                        pay_html+= '<th style="width: 30%">Wallet:</th>';
                        pay_html+= '<td class="last4digit">'+response.payment_details.wallet+'</td>';
                        pay_html+= '</tr>';
                        
                    }

                    $('.payment-detail-table').html(pay_html);
               
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
        <div class="modal-body">
                <h2>Order Details:</h2>
                <div class="table-responsive">
            <table style="width:100%" class="table table-hover table-bordered table-striped">
                <tr>
                  <th style="width: 30%">Order #:</th>
                  <td class="order_no"></td>
                </tr>
                <tr>
                  <th>Order Date & Time:</th>
                  <td class="order_date" ></td>
                </tr>
                <tr>
                  <th>Order Status:</th>
                  <td class="order_status" ></td>
                </tr>
                <tr>
                    <th>Grand Total:</th>
                    <td class="grand_total"></td>
                </tr>
              </table>
          </div>

              <h2>Customer Information:</h2>
              <div class="table-responsive">
            <table style="width:100%" class="table table-hover table-bordered table-striped">
                <tr>
                  <th style="width: 30%">Customer Name:</th>
                  <td class="cust_name"></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td class="email"></td>
                </tr>
                <tr>
                  <th>Phone Number:</th>
                  <td class="phone_number"></td>
                </tr>
              </table>
          </div>

              <h2>Shipping Address:</h2>
              <div class="table-responsive">
            <table style="width:100%" class="table table-hover table-bordered table-striped">
                <tr>
                  <th style="width: 30%">Biller Name:</th>
                  <td class="cust_name"></td>
                </tr>
                <tr>
                  <th>Street Address:</th>
                  <td class="address"></td>
                </tr>
                <tr>
                  <th>City & Zip:</th>
                  <td class="city_zip"></td>
                </tr>
                <tr>
                    <th>State:</th>
                    <td class="state"></td>
                </tr>
                <tr>
                    <th>Country:</th>
                    <td class="country"></td>
                    </tr>
              </table>
          </div>
            <div class="card_info">
                <h2>Payment Details:</h2>
                <div class="table-responsive">
                <table style="width:100%" class="table payment-detail-table table-hover table-bordered table-striped">
                    
                </table>
            </div>
            
            </div>  

            <h2>Course Information:</h2>
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Course </th>
                            
                            <th> Original Price </th>
                            <th> Revised Price </th>
                            
                            <th> Cashback </th>
                            <th> Discount Amount </th>
                            <th> Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product_name">
                            UGC-NTA NET/SET - Paper 1 - General Paper 1 (WB SET 2020) - Previous Years Question Solution 
                            </td>
                            <td class="org_price"> ₹ 2500.00 </td>
                            <td class="revised_price"> ₹ 2500.00 </td>
                            
                            <td class="cashback"> ₹ 0.00 </td>
                            <td class="discount_amount"> ₹ 0.00  </td>
                            <td class="grand_total"> ₹ 2500.00 </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button " class="btn btn-default invoice_url_btn" ><a href="#" class="invoice_url">Invoice</a></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
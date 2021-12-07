@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')
<?php 
    $myLibrary=new \App\library\myFunctions;
?>

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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    @include('frontend.reseller.includes.reseller_menu')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="tabCont">
                        <h1>Dashboard</h1>
                        <?php if(Session::has('message')) { ?>
                            <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                                {{ Session::get('message') }}
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Total Earning</h4>
                                            <h5>₹ <span class="tot_earned">{{$total_earned}}</span></h5>
                                        </div>
                                    </div>
                                    @php 
                                        $paid_amount=0;
                                        $paid_amount=$myLibrary->getContributorTotalPaid(Auth::id());
                                    @endphp
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4> Received Till date</h4>
                                            <h5>₹ <span class="paid_amount">{{$paid_amount}}</span></h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Due as on today</h4>
                                        <h5>₹ <span class="total_due">{{$total_earned - $paid_amount}}</span></h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Reseller Code</h4>
                                            <h5 style="color:#fe9c4b">{{$distributor->reseller_code}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="earningCont">
                                            <h4>Reseller Code Link</h4>
                                            <h5 style="color:#fe9c4b"  class="copy-link">{{url('/')}}{{config('path.reseller_code_url').'/'.$distributor->reseller_code}}
                                            
                                                <span class="btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="{{url('/')}}{{config('path.reseller_code_url').'/'.$distributor->reseller_code}}" title="Copy to clipboard"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
                                            </h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Number of Enrollments</h4>
                                            <h5 style=" text-align:center;">{{count($orders)}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="userSearchBy">
                                    <form class="form-inline" method="POST" id="search-form">
                                        <div class="form-group">
                                            <label>Search : </label>
                                        </div>
                                        <div class="form-group" >
                                           
                                            <input type="text" name="date_from" class="form-control datepicker" placeholder="From Date" id="from_date" autocomplete="off">

                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="date_to" class="form-control datepicker" placeholder="To Date" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="filter-record" value="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="userSearchResult table-responsive">
                                    <form action="{{route('paymentrequestAction')}}" method="POST">
                                        @csrf
                                    <table class="table table-responsive table-bordered " id="order_table">
                                        <thead>
                                            <tr>
                                            
                                                <td colspan="12" class="text-right">
                                                    <input type="submit" value="Request Payment" id="request-payment">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Select</h4>
                                                </td>
                                                <td>
                                                    <h4>Order ID</h4>
                                                </td>
                                                <td>
                                                    <h4>Course Name</h4>
                                                </td>
                                                <td>
                                                    <h4>Student Name</h4>
                                                </td>
                                                <td>
                                                    <h4>Order Date</h4>
                                                </td>
                                                <td>
                                                    <h4>Price</h4>
                                                </td>
                                                <td>
                                                    <h4>Earned Percentage</h4>
                                                </td>
                                                <td>
                                                    <h4>Earned Amount</h4>
                                                </td>
                                                <td>
                                                    <h4>Payment Date</h4>
                                                </td>
                                                <td>
                                                    <h4>Pay Type</h4>
                                                </td>
                                                <td>
                                                    <h4>Cheque No/NEFT</h4>
                                                </td>
                                            
                                                <td class="text-center">
                                                    <h4>Status</h4>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="append-data">
                                            @forelse ($orders as $order)
                                            <?php 
                                                $payment_info=$myLibrary->getPaymentInfo($order->order_id);
                                                // echo "<pre>";
                                                // print_r($payment_info);
                                                // echo "</pre>";
                                                $pay_date="-";
                                                $pay_type="-";
                                                $pay_str="Due";
                                                $cheque_no_neft="-";
                                                $pay_status=0;
                                                if($payment_info){
                                                    $pay_status=$payment_info->pay_status;
                                                    if($pay_status==1){
                                                        $pay_str="Requested";
                                                    }
                                                    else if($pay_status==2){
                                                        $pay_date=$payment_info->pay_date;
                                                        $cheque_no_neft=$payment_info->cheque_no_neft;
                                                        $pay_str="Paid";
                                                    }

                                                    if($payment_info->pay_type==1){
                                                        $pay_type="Cheque";
                                                    }
                                                    elseif($payment_info->pay_type==2){
                                                        $pay_type="NEFT";

                                                    }

                                                }
                                            ?>
                                            <tr >
                                                <td class="order-td">
                                                    <input type="checkbox" name="checkdorders[]" class="order-check" {{$pay_status!=0?'disabled':''}} value={{$order->order_id}} >
                                                    <input type="hidden" class="amount-check" name="orderamount[]" value={{$order->commission_amount}} disabled="disabled" >
                                                </td>
                                                <td>{{$order->reciept_id}}</td>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->username}}</td>
                                                <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                                                <td>{{$order->revised_price!=""?$order->revised_price:$order->price}}</td>
                                                <td>{{$order->commission_percent}}</td>
                                                <td>{{$order->commission_amount}}</td>
                                                <td>
                                                    @if($pay_date!="-")
                                                    {{\Carbon\Carbon::parse($pay_date)->format('d/m/Y')}}
                                                    @else
                                                    {{$pay_date}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$pay_type}}
                                                    
                                                </td>
                                                <td>{{$cheque_no_neft}}</td>
                                                <td class="text-center">
                                                    @if($pay_str=="Requested")
                                                        <a href="#" class="text text-info"><strong>{{$pay_str}}</strong></a>
                                                    @endif
                                                    @if($pay_str=="Due")
                                                        <a href="#" class="text text-danger"><strong>{{$pay_str}}</strong></a>
                                                    @endif
                                                    @if($pay_str=="Paid")
                                                        <a href="#" class="text text-success"><strong>{{$pay_str}}</strong></a>
                                                    @endif
                                                    
                                            
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="12">No order yet.</td></tr>
                                            @endforelse
                                            
                                            
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
@endsection

@push('page_js')
<script src="{{asset('public/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script>
    $('.order-check').on('click',function(){
        $(this).parents('.order-td').find('.amount-check').attr('disabled','disabled');
        if($(this).is(":checked")){
            $(this).parents('.order-td').find('.amount-check').removeAttr('disabled','disabled');

        }
    })
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            //startDate: '-3d'
        })

        $('#search-form').on('submit', function(e) {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            //debugger
            e.preventDefault();
            let data=$("#search-form").serialize();
            let url="{{route('ajaxpaymentFilter')}}";    
            $.post(url,data,function(response){
                $('.append-data').html(response.html)
                $('.tot_earned').html(response.total_earned)
                $('.paid_amount').html(response.paid_amount)
                $('.total_due').html(response.total_due)
            })
        })

        //$('.copy-to-clipboard').on
    });

function copyToClipboard(text, el) {
  var copyTest = document.queryCommandSupported('copy');
  var elOriginalText = el.attr('data-original-title');

  if (copyTest === true) {
    var copyTextArea = document.createElement("textarea");
    copyTextArea.value = text;
    document.body.appendChild(copyTextArea);
    copyTextArea.select();
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'Copied!' : 'Whoops, not copied!';
      el.attr('data-original-title', msg).tooltip('show');
    } catch (err) {
      console.log('Oops, unable to copy');
    }
    document.body.removeChild(copyTextArea);
    el.attr('data-original-title', elOriginalText);
  } else {
    // Fallback if browser doesn't support .execCommand('copy')
    window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
  }
}

$(document).ready(function() {
  // Initialize
  // ---------------------------------------------------------------------

  // Tooltips
  // Requires Bootstrap 3 for functionality
  $('.js-tooltip').tooltip();

  // Copy to clipboard
  // Grab any text in the attribute 'data-copy' and pass it to the 
  // copy function
  $('.js-copy').click(function() {
    var text = $(this).attr('data-copy');
    var el = $(this);
    copyToClipboard(text, el);
  });
});
    // $("#order_table").dataTable({
    //         order: [[ 0, "desc" ]]
    // } );
</script>
@endpush
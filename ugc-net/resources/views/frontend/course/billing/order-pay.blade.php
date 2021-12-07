@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')
@section('page_content')

       
        <section class="bodycont">
            <section class="breadcamp">
                   <div class="container">
                       <ul>
                           <li><a href="{{url('/')}}">Home</a></li>
                           <li>Billing</li>
                       </ul>
                   </div>
               </section>
       
               <section class="innerpage">
                   <div class="container">
                       <h1>Checkout</h1>
                       <div class="table-responsive">
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                       <thead class="thead-dark">
                         <tr>
                           <td>Order number</td>
                           <td>Date</td>
                           <td>Total</td>
                           <td>Payment method</td>
                         </tr>
                         </thead>
                         <tbody>
                         <tr>
                         <td>{{$order->order_id}}</td>
                           <td>{{date('F d, Y',strtotime($order->created_at))}}</td>
                           <td>{{$order->grand_total}}</td>
                           <td>Credit Card/Debit Card/NetBanking</td>
                         </tr>
                         </tbody>
                       </table>
                       </div>
                       <p><strong>Thank you for your order, please click the button below to pay with Razorpay.</strong></p>
                       <p>
                           <button type="submit" class="submitbutdash1" id="rzp-button1">Pay Now</button>
                           <a href="{{route('paymentCancel',['order_id'=>Hasher::encode($order->id)])}}"><button type="button" class="submitbutdash1">Cancel</button></a>
                       </p>
                   </div>
               </section>
       </section>
@stop
@push('page_js')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var options = {
        "key": "<?php echo $api_key; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $api_key; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        "currency": "<?php echo $order['currency']?>",
        "name": "Teachinns",
        //"description": "A simple test script",
        "image": "http://teachinns.karmickdev.com/public/frontend/images/logo.png",
        "order_id": "<?php echo $order['payment_order_id']?>",//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
        "handler": paymentSuccessHandler,
        "prefill": {
            "name": "{{$billing_info->first_name}} {{$billing_info->last_name}}",
            "email": "{{$billing_info->email}}",
            "contact": "{{$billing_info->phone}}"
        },
        "notes": {
            "address": "note value"
        },
        "theme": {
            "color": "#2270b5"
        }
    };
    var rzp1 = new Razorpay(options);
    
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }

    $(document).ready(function(){
        rzp1.open();
    })

    function paymentSuccessHandler(transaction) {
        
        $.ajax({
            method: 'post',
            url: "{!!route('payment-success')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id,
                "razorpay_order_id": transaction.razorpay_order_id,
                "transaction_info":transaction
            },
            complete: function (r) {
                console.log('complete');
                console.log(r);
            },
            success:function(response){
                if(response.status=="success"){
                    let redirect_url=response.url;
                    window.location.replace(redirect_url);
                }
            }
        })
    }
    </script>
@endpush

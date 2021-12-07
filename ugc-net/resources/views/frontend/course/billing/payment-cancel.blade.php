@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')
@section('page_content')

        {{-- <button id="rzp-button1">Pay</button> --}}
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
                    <div class="thankyou">
                        <div class="tickicon"><span><i class="fa fa-check" aria-hidden="true"></i></span></div>
                        <div class="thankyouheading">Thank you</div>
                        <p>Welcome to the world of knowledge.</p>
                        
                        
                        <div class="thankbot">
                        <p>Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.</p>
                        <p><strong><a href="{{route('orderPay',['order_id'=>Hasher::encode($order->id)])}}">Pay</a></strong></p>
                        
                        <div class="orderdetais">
                        <h3>Order details</h3>
                        <?php
                            $amount=$product->revised_price!=""?$product->revised_price:$product->price;
                            $subtotal=$amount;
                            if($order->discount_amount){
                                $subtotal=$amount-$order->discount_amount;
                            }
                        ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                            <tr>
                                <td><strong>Course</strong></td>
                                <td><strong>Total</strong></td>
                            </tr>
                            <tr>
                                <td>{{$product->name}} × 1</td>
                                <td>₹{{$amount}}</td>
                            </tr>
                            @if($order->discount_amount)
                            <tr>
                                <td>Discount:</td>
                                <td>- ₹{{$order->discount_amount}}</td>
                            </tr>
                            @endif  
                            <tr>
                                <td>Subtotal:</td>
                                <td>₹{{$subtotal}}</td>
                            </tr>
                            <tr>
                                <td>Payment method:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td><strong>₹{{$order->grand_total}}</strong></td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="orderdetais">
                        <h3>Billing Address</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                {{$billing_info->first_name}}  {{$billing_info->last_name}}<br>
                            <p>{{$billing_info->street_address_1}}, {{$billing_info->street_address_2}}<br>
                                {{$billing_info->city}} {{$billing_info->zip}} <br>
                                {{$state->state_name}}<br>
                                {{$country->country_name}}<br>
                                {{$billing_info->phone}}<br>
                                {{$billing_info->email}}<br>
                            </p>
                            
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
        </div>
    </section>
</section>
@stop
@push('page_js')



@endpush

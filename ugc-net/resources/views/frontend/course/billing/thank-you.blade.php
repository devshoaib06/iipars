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
                    <p>Welcome to the world of knowledge. Go to your <a href="{{route('dashboard')}}">dashboard</a> to view your account <br>
                        details and to download your courses.</p>
                        
                        
                        <div class="thankbot">
                            @if(Session::has('message'))                         
								<div class="{{ Session::get('messageClass') }}">
									<button class="close" data-close="alert"></button>
									<span>{{ Session::get('message') }} </span>
								</div>
								@endif  

								@if (count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
                                @endif
                          @if($payment_details->payment_method!="Free")      
                            <a href="{{route('dashboard')}}">My dashboard</a>
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
                                        <td> &nbsp; ₹ {{$order->course_price}}</td>
                                    </tr>
                                    @if($order->discount_amount!=0  )
                                    <tr>
                                        <td>Discount:</td>
                                        <td>- ₹ {{$order->discount_amount}}</td>
                                    </tr>
                                    @endif 
                                    @if($order->extra_discount!=0  )
                                    <tr>
                                        <td>Extra Discount:</td>
                                        <td>- ₹ {{$order->extra_discount}}</td>
                                    </tr>
                                    @endif 
                                    @if($order->student_cb_amount!=""  )
                                    <tr>
                                        <td>Cashback:</td>
                                        <td>- ₹ {{number_format((float)$order->student_cb_amount, 2, '.', '')}}</td>
                                    </tr>
                                    @endif  
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td>  &nbsp; ₹ {{$order->subtotal}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td><strong> &nbsp; ₹ {{$order->grand_total}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Payment method:</td>
                                    <td style="text-transform:capitalize"> &nbsp;{{$payment_details->payment_method}}</td>
                                    </tr>
                                </table>
                            
                            </div>
                            <div class="orderdetais">
                            <h3>Billing Address</h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>{{$billing_info->first_name}}  {{$billing_info->last_name}}</strong><br>
                                        @if ($billing_info->street_address_1)
                                            {{$billing_info->street_address_1}} {{$billing_info->street_address_2}},<br>
                                        @endif
                                        @if ($billing_info->city)
                                            {{$billing_info->city}}<br>
                                        @endif
                                        @if (isset($state->state_name))
                                            {{@$state->state_name}} -  {{$billing_info->zip}}, {{$country->country_name}} <br>
                                        @endif
                                        
                                        <strong>Phone Number: </strong>{{$billing_info->phone}}<br>
                                        <strong>Email: </strong>{{$billing_info->email}}<br>
                                    
                                    
                                    </div>
                                </div>  
                            </div>
                          @endif  
                    
                    
                </div>
                
            </div>
        </div>
    </section>
</section>
@stop
@push('page_js')
<script>
    // $(document).ready(function(){
    //     setTimeout(function(){ 
    //         let url="{{route('dashboard')}}";
            
    //         window.location.replace(url);
    //     }, 20000);
    // })
</script>


@endpush

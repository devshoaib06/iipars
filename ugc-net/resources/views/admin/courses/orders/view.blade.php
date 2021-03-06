@extends('admin.layouts.view_order')

@section('page_title')
	Orders - View
@endsection

@section('page_level_plugins_css')


@endsection

@section('page_level_css')
<style>

    .tag_fields{
        color: #3f444a;
        font-size: 18px;
        font-weight: 500;
        margin: 0 0 15px;
    }
</style>
@endsection



@section('content')	
    
	<div class="">
		
		<div class="">
			
			<div class="">
				
				<div class="row">
					<div class="col-md-12">
						
						<div class="portlet light portlet-fit portlet-datatable bordered">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-dark"></i>
									<span class="caption-subject font-dark sbold uppercase"> Order #{{$order_info->order_id}}
                    
										<span class="hidden-xs">| {{\Carbon\Carbon::parse($order_info->created_at)->format('F j, Y H:i:s')}}  </span>
									</span>
								</div>
								
							</div>
							<div class="portlet-body">
								<div class="tabbable-line">
									<ul class="nav nav-tabs nav-tabs-lg">
										<li class="active">
											<a href="#tab_1" data-toggle="tab"> Details </a>
										</li>
										
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1">
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="portlet yellow-crusta box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-cogs"></i>Order Details </div>
															
														</div>
														<div class="portlet-body">
															<div class="row static-info">
																<div class="col-md-5 name"> Order #: </div>
																<div class="col-md-7 value"> {{$order_info->order_id}}
																	{{-- <span class="label label-info label-sm"> Email confirmation was sent </span> --}}
																</div>
															</div>
															<div class="row static-info">
																<div class="col-md-5 name"> Order Date & Time: </div>
																<div class="col-md-7 value"> {{\Carbon\Carbon::parse($order_info->created_at)->format('F j, Y H:i:s')}} </div>
															</div>
															<div class="row static-info">
																<div class="col-md-5 name"> Order Status: </div>
																<div class="col-md-7 value">
																	<span class="label label-success order-status" > {{$order_info->payment_status!="success"?"Pending":$order_info->payment_status}} </span>
																</div>
															</div>
															<div class="row static-info">
																<div class="col-md-5 name"> Grand Total: </div>
																<div class="col-md-7 value"> ??? {{$order_info->grand_total}} </div>
															</div>
															@if ($reseller_amount)
																
																<div class="row static-info">
																	<div class="col-md-5 name"> Reseller Amount: </div>
																	<div class="col-md-7 value"> ??? {{$reseller_amount->price_earn}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> Reseller Code Applied: </div>
																	<div class="col-md-7 value">{{$order_info->reseller_code_applied}} </div>
																</div>
															@endif
														
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="portlet blue-hoki box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-cogs"></i>Customer Information </div>
															
														</div>
														<div class="portlet-body">
															<div class="row static-info">
																<div class="col-md-5 name"> Customer Name: </div>
																<div class="col-md-7 value"> {{$order_info->fullname}} </div>
															</div>
															<div class="row static-info">
																<div class="col-md-5 name"> Email: </div>
																<div class="col-md-7 value"> {{$order_info->email}} </div>
															</div>
															
															<div class="row static-info">
																<div class="col-md-5 name"> Phone Number: </div>
																<div class="col-md-7 value"> {{$billing_info->phone}} </div>
															</div>
														</div>
													</div>
												</div>
											</div>
											@if($order_info->payment_status=="success" )
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<div class="portlet red-sunglo box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-cogs"></i>Payment Details </div>
															
														</div>
														<div class="portlet-body">
															<div class="portlet-body payment_details-section">
																
																<div class="row static-info">
																	<div class="col-md-5 name"> Payment Method: </div>
																	<div class="col-md-7 value"> {{$payment_details->payment_method}} </div>
																</div>
																@if($payment_details->payment_method=="card")
																<div class="row static-info">
																	<div class="col-md-5 name"> Last 4 digit: </div>
																	<div class="col-md-7 value"> {{$card_info->last4digit}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> Card Network: </div>
																	<div class="col-md-7 value"> {{$card_info->card_network}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> Card Type: </div>
																	<div class="col-md-7 value"> {{$card_info->card_type}} </div>
																</div>
																@endif
																@if($payment_details->payment_method=="netbanking")
																<div class="row static-info">
																	<div class="col-md-5 name"> Bank: </div>
																	<div class="col-md-7 value"> {{$payment_details->bank}} </div>
																</div>
																@endif
																@if($payment_details->payment_method=="upi")
																<div class="row static-info">
																	<div class="col-md-5 name"> UPI ID: </div>
																	<div class="col-md-7 value"> {{$payment_details->vpa}} </div>
																</div>
																@endif
																@if($payment_details->payment_method=="wallet")
																<div class="row static-info">
																	<div class="col-md-5 name"> Wallet: </div>
																	<div class="col-md-7 value"> {{$payment_details->wallet}} </div>
																</div>
																@endif
																@if($order_info->p_gateway_payment_id)
																<div class="row static-info">
																	<div class="col-md-5 name"> RazorPay Payment id: </div>
																	<div class="col-md-7 value"> {{$order_info->p_gateway_payment_id}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> RazorPay Order id: </div>
																	<div class="col-md-7 value"> {{$order_info->payment_order_id}} </div>
																</div>
																@endif
															</div>
														</div>
													</div>
												</div>
												@if($billing_info->street_address_1!="")
												<div class="col-md-6 col-sm-6">
													<div class="portlet blue box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-truck "></i>Shipping Details </div>
															
														</div>
														<div class="portlet-body">
															<div class="portlet-body payment_details-section">
																
																<div class="row static-info">
																	<div class="col-md-5 name"> Address: </div>
																	<div class="col-md-7 value"> {{$billing_info->street_address_1}} {{$billing_info->street_address_2}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> City & Zip: </div>
																	<div class="col-md-7 value"> {{$billing_info->city}} {{$billing_info->zip}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> State: </div>
																	<div class="col-md-7 value"> {{@$state->state_name}} </div>
																</div>
																<div class="row static-info">
																	<div class="col-md-5 name"> Country: </div>
																	<div class="col-md-7 value"> India </div>
																</div>
																
															</div>
														</div>
													</div>
												</div>
												@endif
											</div>		
											@endif
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="portlet grey-cascade box">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-cogs"></i>Course</div>
															
														</div>
														<div class="portlet-body">
															<div class="table-responsive">
																<table class="table table-hover table-bordered table-striped">
																	<thead>
																		<tr>
																			<th> Course </th>
																			
																			<th> Original Price </th>
																			<th> Revised Price (On {{\Carbon\Carbon::parse($order_info->created_at)->format('F j, Y')}}) </th>
																			<th> Discount Amount <br /> ({{ $order_info->revised_percent?$order_info->revised_percent:0 }}%) </th>
																			@if ($order_info->extra_discount)
																			<th> Extra Discount </th>
																				
																			@endif
																			{{-- <th> CGST -@ 9% </th>
																			<th> SGST -@ 9% </th> --}}
																			<th> Total </th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>
																			<a href="{{route('editCourse',['id'=>Hasher::encode($order_info->product_id)])}}"> {{$order_info->product_name}} </a>
																			</td>
																			<td> ??? {{$order_info->price}} </td>
																			{{-- <td> ??? {{$order_info->revised_price!=""?$order_info->revised_price:$order_info->price}} </td> --}}
																			<td> ??? {{$order_info->revised_price?$order_info->revised_price:0.00}}</td>
																			<td> ??? {{$order_info->discount_amount!=""?$order_info->discount_amount:'0.00'}}  </td>
																			@if ($order_info->extra_discount)
																				
																			<td> ??? {{$order_info->extra_discount}}</td>
																			@endif
																			{{-- <td> ??? 0.00 </td>
																			<td> ??? 0.00 </td> --}}
																			<td> ??? {{$order_info->grand_total}} </td>
																		</tr>
																		
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End: life time stats -->
					</div>
				</div>
			</div>
			
		</div>
	
	</div>    
 
@endsection


@section('page_level_plugins')

<style>
	.payment_details-section .value,.order-status{
		text-transform: capitalize;
	}
</style>
@endsection

@section('page_level_scripts')


@endsection
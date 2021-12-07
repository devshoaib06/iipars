
        <div class="main-wrap static-page checkout-wrapper">
	        <div class="container">
	            <div class="ch-cont">
	            <div class="row clearfix">
	                <div class="col-md-12">
	                    <ul class="cart-steps">
	                        <li class="cart-step summery complete">01. Summary</li>
	                        <li class="cart-step address complete">02. Shipping Address</li>
	                        <li class="cart-step shipping complete">03. Payment</li>
	                        <li class="cart-step payment current">04. Confirm Order</li>
	                    </ul>
	                </div>
	            </div>
	           <div class="row clearfix">
	            <form class="" action="<?php echo base_url();?>manage_checkout/order_submit_action" method="post">
	                <div class="col-md-12">
	                	<div class="table-responsive">
		                    <table id="cart_summary" class="cart_summery table table-bordered table-striped">
		                    	<thead>
			                        <tr>
			                            <th>Shipping adress</th>
			                            <th>Payment</th>
			                            <th colspan="5">Products</th>
			                            
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr>
			                            <?php 
			                            	$user_id = $this->session->userdata('user_session_id');
			                            	$shipping_address = $this->common_model->common($table_name = 'tbl_delivery_address', $field = array(), $where = array('deli_user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			                            ?>
			                             <td>
			                                <h5><b>Name : </b><?php echo @$shipping_address[0]->deli_name;?></h5>

			                                <h5><b>Email : </b><?php echo @$shipping_address[0]->deli_mail;?></h5>
			                                <h5><b>Contact No : </b> <?php echo @$shipping_address[0]->deli_phone;?></h5>
			                                <h5><b>Alternate Contact No : </b> <?php echo @$shipping_address[0]->deli_alt_phone;?></h5>
			                                 <h5><b>Location : </b><?php echo @$shipping_address[0]->deli_location;?>,<br><br><b>Pincode : </b><?php echo @$shipping_address[0]->deli_pin;?> <br><br><b>City : </b><?php echo @$shipping_address[0]->deli_city;?>,<br><br> <b>State : </b><?php echo @$shipping_address[0]->deli_state;?>,<br><br> India.</h5>
			                              
			                                
			                            </td>
			                            <td>
			                            	<h5><b>Payment: </b><?php if($this->session->userdata('payment_type')=='COD'){ echo 'Cash On Delivery'; }else{ echo 'Online Payment';} ?></h5>
			                            </td>

			                            <td colspan="5">
										<?php 
										$user_id = $this->session->userdata('user_session_id');
										$seller_cart_item = $this->common_model->common($table_name='tbl_seller_cart',$field=array(),$where=array('user_id'=>$user_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
										if(count($seller_cart_item)>0)
										{
											foreach($seller_cart_item as $item)
											{ 
												$product_id = $item->cart_item_id;
												$product_details = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
												$product_image = $this->common_model->common($table_name='tbl_product_image',$field=array(),$where=array('product_id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
												?>
													<div class="pp-bx">
					                            	<img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image[0]->image;?>" class="cimg" alt="" />
					                            	<h4><?php echo @$product_details[0]->product_name;?></h4>
					                            	<span class="cart_item_price">(  <i class="fa fa-inr"></i> <?php echo $item->cart_item_net_price;?>  X <?php echo $item->cart_item_qty;?> ) =  <i class="fa fa-inr"></i> <?php echo ($item->cart_item_net_price*$item->cart_item_qty);?></span>
					                            	</div>
									<?php	}
										}

										?>
			                            	

			                            	

			                            </td>
			                           
			                        </tr>
			                       
			                        <!-- <tr>
			                            <td rowspan="3" colspan="3" id="cart_voucher" class="cart_voucher"></td>
			                            <td colspan="3" class="text-right">Total Price</td>
			                            <td class="price" id="total_product"><span class="price"><i class="fa fa-inr"></i> <?php echo $this->session->userdata('checkout_total_amount');?></span></td>
			                        </tr> -->
			                        <!-- <tr>
			                            <td colspan="3" class="text-right">Total shipping</td>
			                            <td class="price" id="total_shipping">N/A</td>
			                        </tr> -->
			                        <tr>
			                            <td colspan="3" class="total_price_container text-right"><span>Grand Total</span></td>
			                            <td class="price" id="total_price_container"> 
			                                <span class="total_price price"><i class="fa fa-inr"></i> <?php echo $this->session->userdata('checkout_total_amount');?></span>
			                            </td>
			                        </tr>
			                    </tbody>
		                    </table>
		                </div>
	                </div>
	                <div class="next-wrap">
	                    <div class="col-md-12 text-right">
	                       <!--  <a class="btn btn-default">Place Order <i class="fa fa-angle-right"></i></a> -->
	                        <button class="btn btn-default btn-main btn-down" type="submit">Place Order <i class="fa fa-angle-right"></i></button>
	                    </div>
	                </div>

	            </form>

	            </div>
	        </div>
	    </div>
	        </div>
	        </div>
	    </div>

		
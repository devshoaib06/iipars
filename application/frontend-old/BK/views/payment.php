	

        <div class="main-wrap static-page checkout-wrapper">
	        <div class="container">
	        	<div class="ch-cont">
	            <div class="row clearfix">
	                <div class="col-md-12">
	                    <ul class="cart-steps">
	                        <li class="cart-step shipping">01. Summary<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step address">02. Shipping Address<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        
	                        <li class="cart-step summery current">03. Payment<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step payment">04. Confirm Order</li>
	                    </ul>
	                </div>
	            </div>
	            <div class="row clearfix">
	            <form action="<?php echo base_url();?>manage_checkout/order_submit" class="shipping-address" method="post">
	                <div class="col-md-12">
	                	<div class="row clearfix">
	                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	                			<div class="payment-title">
	                			<h3>Payment Option</h3>
	                			</div>
	                				<div class="form-group clearfix">
	                					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="radio-inline payment-radio"><input type="radio" name="optradio" value="COD" checked="">Cash on Delivery (COD)</label>
	                					</div>
	                					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="radio-inline payment-radio"><input type="radio" name="optradio" value="ONLINE">Online Pay</label>
	                					</div>
	                				</div>
	                			
	                		</div>
				            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				            	<div class="pricebox">
				            		<h3>Price Details</h3>
				            		<ul>
				            			<!-- <li>No Of Product <span><?php echo $this->session->userdata('total_no_product');?></span></li> -->
				            			<li>Total Price <span><i class="fa fa-inr"></i> <?php echo $this->session->userdata('checkout_total_amount');?></span></li>
				            			<li class="total-price">Amount Payble <span><i class="fa fa-inr"></i> <?php echo $this->session->userdata('checkout_total_amount');?></span></li>
				            		</ul>
				            	</div>
				            </div>    	
		                </div>
	                </div>
	                <div class="next-wrap">
	                   <div class="col-md-12 text-right">
	                        <!-- <a href="confirm-order.php" class="btn btn-default btn-main btn-down">Confirm Order <i class="fa fa-angle-right"></i></a> -->
	                         <button class="btn btn-default btn-main btn-down" type="submit">Confirm Order <i class="fa fa-angle-right"></i></button>
	                    </div>
	                </div>
	             </form>
	            </div>
	        </div>
	    </div>


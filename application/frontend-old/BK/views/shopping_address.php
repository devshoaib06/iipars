
        <div class="main-wrap static-page checkout-wrapper">
	        <div class="container">
	        <div class="ch-cont">
	            
	            <div class="row clearfix">
	                <div class="col-md-12">
	                    <ul class="cart-steps">
	                        <li class="cart-step summery complete">01. Summary<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step address current">02. Shipping Address<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step shipping">03. Payment<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step payment">04. Confirm Order</li>
	                    </ul>
	                </div>
	            </div>
	            <div class="row clearfix">
	            	<form action="<?php echo base_url();?>manage_checkout/billing_address" class="shipping-address" method="post">
	                <div class="col-md-12">
	                	<div class="row clearfix">
	                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	                			
			                		<div class="form-group clearfix">
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
			                				<input type="text" name="name" class="form-control" placeholder="Name" required="" value="<?php echo @$shipping_address[0]->deli_name;?>" />
			                			</div>
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
			                				<input type="text" name="email" class="form-control" placeholder="Email" required="" value="<?php echo @$shipping_address[0]->deli_mail;?>"/>
			                			</div>
			                		</div>
			                		<div class="form-group clearfix">
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
			                				<input type="text" name="phone" class="form-control" placeholder="Phone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" required="" value="<?php echo @$shipping_address[0]->deli_phone;?>"/>
			                			</div>
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
			                				<input type="text" name="alter_phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" class="form-control" placeholder="Alternate Phone (Optional)" value="<?php echo @$shipping_address[0]->deli_alt_phone;?>"/>
			                			</div>
			                		</div>
			                		<div class="form-group clearfix">
			                			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
			                				<input type="text" name="location" class="form-control" placeholder="Location" id="autocomplete" onclick="geolocate()" required="" value="<?php echo @$shipping_address[0]->deli_location;?>"/>
			                			</div> -->
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
			                				<input type="text" name="pincode" class="form-control" placeholder="Pincode" id="postal_code" required="" onkeyup="check_zip()" value="<?php echo @$shipping_address[0]->deli_pin;?>"/>
			                			</div>
			                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
			                				<input type="text" name="city" class="form-control" placeholder="City" id="loc_city" required="" value="<?php echo @$shipping_address[0]->deli_city;?>"/>
			                			</div>
			                		</div>
			                		 <div class="form-group clearfix">
			                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd-left">
			                				<input type="text" name="state" class="form-control" placeholder="State"  id="loc_state" required="" value="<?php echo @$shipping_address[0]->deli_state;?>"/>
			                			</div>
			                			
			                		</div> 
			                		<div class="form-group clearfix">
			                			
			                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd-left">
			                				<textarea type="text" name="address" class="form-control" placeholder="Address" id="address" required="" rows="5" ><?php echo @$shipping_address[0]->deli_location;?></textarea>
			                			</div>
			                		</div> 
			                		<!-- <div class="form-group clearfix" id="spa">
			                			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 nopadd-left">
			                				<label class="address-type">Address Type</label>
			                			</div>
			                			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 nopadd-right" >
			                				<label class="radio-inline"><input type="radio" name="optradio" value="Home/Personal" required="" <?php if(@$shipping_address[0]->deli_adds_type=='Home/Personal'){echo 'checked';} ?>>Home/Personal</label>
											<label class="radio-inline"><input type="radio" name="optradio" value="Office/Commercial" <?php if(@$shipping_address[0]->deli_adds_type=='Office/Commercial'){echo 'checked';} ?>>Office/Commercial</label>
			                			</div>
			                		</div>
			                	 -->
	                		</div>
	                		<?php 
	                		$seller_cart_list =  $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	                		
	                		?>
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
	                       <!--  <a href="payment.php" class="btn btn-default btn-main btn-down">PROCEED TO PAYMENT <i class="fa fa-angle-right"></i></a> -->
	                       <button class="btn btn-default btn-main btn-down">PROCEED TO PAYMENT <i class="fa fa-angle-right"></i></button>
	                    </div>
	                </div>
	                </form>
	            </div>

	            </div>
	        </div>
	    </div>
	    <script>
function check_zip()
{

  var zip = $('#postal_code').val();
  var city = '';
  var state = '';

 
   $.ajax({
                    type: "POST",
                    url:'https://maps.googleapis.com/maps/api/geocode/json?address='+zip,
                    success: function(response)
                    {
                     var address_components = response.results[0].address_components;
                     $.each(address_components, function(index, component){
                     var types = component.types;
                     $.each(types, function(index, type){
                    if(type == 'locality')
                    {
                    city = component.long_name;
                    }
                    if(city == "")
                    {
                       if(type == 'administrative_area_level_2')
                       {
                         city = component.long_name;
                       } 
                    }
                    if(type == 'administrative_area_level_1') 
                    {
                    state = component.long_name;
                    }
                    });
                    });
   
        $('#loc_city').val(city);   
        $('#loc_state').val(state);
                    }
        });



}
    </script>
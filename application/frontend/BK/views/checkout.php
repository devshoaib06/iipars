		



		

        <div class="main-wrap static-page checkout-wrapper">
	        <div class="container">
	        	<div class="ch-cont">
	            <div class="row clearfix">
	                
	            </div>
	            <div class="row clearfix">
	                <div class="col-md-12">
	                    <ul class="cart-steps">
	                        <li class="cart-step summery current">01. Summary<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step address">02. Shipping Address<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step shipping">03. Payment<i class="fa fa-angle-double-right mar-lft" aria-hidden="true"></i></li>
	                        <li class="cart-step payment">04. Confirm Order</li>
	                    </ul>
	                </div>
	            </div>
	            <div class="row clearfix">
	                <div class="col-md-12">
	                	<div class="table-responsive">
		                    <table id="cart_summary" class="cart_summery table table-bordered table-striped">
		                    	<thead>
			                        <tr>
			                            <th>Product</th>
			                            <th colspan="2">Description</th>
			                            <th>Availability</th>
			                            <th>Unit price</th>
			                            <th>Qty</th>
			                            <th>Total</th>
			                          <!--   <th>Action</th> -->
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<?php 
			                    		$sub_total=0;
			                    		if(count($seller_cart_details)>0){
			                    			$i=0;
			                    		foreach($seller_cart_details as $seller_cart){
			                    			$i++;
			                    			$product_id = $seller_cart->cart_item_id;
			                    			$product_details = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			                    			$product_image = $this->common_model->common($table_name='tbl_product_image',$field=array(),$where=array('product_id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			                    ?>   
			                        <tr>
			                            <td>
			                            	<img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image[0]->image;?>" class="cimg" alt="" />
			                            </td>
			                            <td colspan="2">
			                                <h5><?php echo @$product_details[0]->product_name;?></h5>
			                           
			                                <!-- <p><b>Unit:</b> <span>1 kg</span></p> -->
			                            </td>
			                            <td>
			                            	 <?php if(@$product_details[0]->availability=='Yes'){?>
			                            	<span class="availability-status label label-success">In stock</span>
			                            <?php } else { ?>
											<span class="availability-status label label-warning">Out Of stock</span>
			                            <?php } ?>
			                            </td>
			                            <td><span class="price"><i class="fa fa-inr"></i><?php echo @$product_details[0]->net_price;?></span></td>
			                            <td><span class="qty"><?php echo $seller_cart->cart_item_qty;?></span></td>
			                            <td><span class="price"><i class="fa fa-inr"></i>  <?php echo ($seller_cart->cart_item_qty*@$product_details[0]->net_price);?></span></td>
			                            <!-- <td>
			                            	<a href="#" class="deleteItem"><i class="fa fa-trash"></i></a>
			                            </td> -->
			                        </tr>
			                         <?php 
			                    	$sub_total= $sub_total+((@$product_details[0]->net_price)*($seller_cart->cart_item_qty));
			                    	$session_total_value= array(
                                        						'checkout_total_amount'=>$sub_total,
                                        						
                                   							);
            						$this->session->set_userdata($session_total_value);
			                		} 
			                    } ?>
			                       <!--  <tr>
			                            <td rowspan="3" colspan="3" id="cart_voucher" class="cart_voucher"></td>
			                            <td colspan="3" class="text-right">Total products</td>
			                            <td class="price" id="total_product"><span class="price"><i class="fa fa-inr"></i> 53.00</span></td>
			                        </tr>
			                        <tr>
			                            <td colspan="3" class="text-right">Total shipping</td>
			                            <td class="price" id="total_shipping"><i class="fa fa-inr"></i> 2.00</td>
			                        </tr> -->
			                         <tr>
			                            <td colspan="5" class="total_price_container text-right"> <span>Grand Total</span></td>
			                            <td class="price" id="total_price_container"> 
			                                <span class="total_price price"><i class="fa fa-inr"></i> <?php echo $sub_total;?></span>
			                            </td>
			                        </tr>
			                    </tbody>
			                  
		                    </table>
		                </div>
	                </div>
	                <div class="next-wrap">
	                    <div class="col-md-6 col-xs-6">
	                        <a href="<?php echo $this->url->link(1);?>" class="btn btn-default btn-main"><i class="fa fa-angle-left"></i> Continue shopping</a>
	                    </div>
	                    <div class="col-md-6 col-xs-6 text-right">
	                        <a href="<?php echo $this->url->link(16);?>" class="btn btn-default btn-main">Process to checkout <i class="fa fa-angle-right"></i></a>
	                    </div>
	                </div>
	            </div>


	            </div>
	        </div>
	    </div>

		
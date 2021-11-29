


<div class="body-content outer-top-xs">



        <div class="main-wrap static-page checkout-wrapper">
	        <div class="container">
	            
	            <div class="row clearfix">
	                <div class="col-md-12">
	                	<div class="table-responsive">
		                    <table id="cart_summary" class="cart_summery table table-bordered table-striped">
		                    	<thead>
			                        <tr>
			                            <th>Product</th>
			                            <th>Description</th>
			                            <th>Availability</th>
			                            <th>Unit price</th>
			                            <th>Qty</th>
			                            <th>Total</th>
			                            <th>Action</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                   <?php  
			                   			$cart_sess_id= $this->session->userdata('cart_session_id');

			                   			if($this->session->userdata('user_session_id')=='' && $cart_sess_id!='')
										{
                                        	@$cart_list = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                        }
                                        else
                                        {
                                        	$user_sess_id= $this->session->userdata('user_session_id');
                                        	@$cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                        }
                                        $sub_total=0;
                                        if(count(@$cart_list)>0)
                                        {
                                        	foreach ($cart_list as $cart) {

                                        		$product_id = $cart->cart_item_id;
                                        		$product_details = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
                                        		$product_image = $this->common_model->common($table_name='tbl_product_image',$field=array(),$where=array('product_id'=>$product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
                                        		
                                        	
                                ?>
			                        <tr>
			                            <td>
			                            	<img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image[0]->image;?>" class="cimg" alt="" />
			                            </td>
			                            <td>
			                                <h5><?php echo @$product_details[0]->product_name;?></h5>
			                           
			                               <!--  <p><b>Color:</b> <span>Orange</span></p> -->
			                            </td>
			                            <td>
			                            	<?php if(@$product_details[0]->availability=='Yes'){?>
			                            	<span class="availability-status label label-success">In stock</span>
			                            	<?php } else { ?>
			                            	<span class="availability-status label label-warning">Out Of stock</span>
			                            	<?php } ?>
			                            </td>
			                            <td><span class="price"><i class="fa fa-inr"></i> <?php echo @$product_details[0]->net_price;?></span></td>
			                            <td><input type="number" id="quantity_<?php echo $cart->id;?>" min="1" value="<?php echo $cart->cart_item_qty;?>" > <br> <a style="cursor: pointer;" onclick="update_cart(<?php echo $cart->id; ?>)">Update</a></td> 
			                            <td><span class="price"> ( <i class="fa fa-inr"></i> <?php echo @$product_details[0]->net_price;?> X <?php echo $cart->cart_item_qty;?> ) = <i class="fa fa-inr"></i> <?php echo (@$product_details[0]->net_price*$cart->cart_item_qty);?></span></td>
			                            <td>
			                            	<a href="#" class="deleteItem" onclick="delete_cart_item(<?php echo $cart->id;?>)"><i class="fa fa-trash"></i></a>
			                            </td>
			                        </tr>

			                        <?php 
			                        	$sub_total= $sub_total+((@$product_details[0]->net_price)*($cart->cart_item_qty));
			                        }   }?>

			                       
			                        
			                    </tbody>
		                    </table>
		                </div>
	                </div>
	               
	            </div>
	        </div>
	    </div>

<script type="text/javascript">
	function update_cart(id)
	{
		//alert(id);
	    var base_url='<?php echo base_url(); ?>';
	    if(confirm('are you sure to want to update quantity?'))
	    {
	        var update_quantity= $("#quantity_"+id).val();
	        //alert(update_quantity);
	        $.ajax(

	            {
	               type: "POST",

	               dataType: 'html',

	               url: base_url + "manage_cart/update_cart_qnty",

	               data: {cart_id:id,update_quantity:update_quantity},

	               async: false,

	               success: function (data) {

	            
	               location.reload();




	            }

	            

	        	});
	    	}
	}
</script>
<script type="text/javascript">
	function delete_cart_item(id)
	{
		if(confirm('Are you sure to delete this cart?'))
    	{
			window.location.href="<?php echo base_url();?>manage_cart/delete_cart/"+id;
		}
	}
			
</script>
































	<div class="container">
	 
		<div class="row ">
			<div class="shopping-cart">

				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="<?php echo $this->url->link(1);?>" class="btn btn-upper btn-primary outer-left-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; Continue Shopping</a>
								
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>

				</tr>
			</tfoot>
			


			




		</table><!-- /table -->


	</div>
</div><!-- /.shopping-cart-table -->	



<div class="col-md-4 col-sm-12 cart-shopping-total" id="main-float">
	<table class="table">
		<thead>
			<tr>
				<th>
					<!-- <div class="cart-sub-total">
						Subtotal<span class="inner-left-md"><i class="fa fa-inr"></i> <?php echo $sub_total;?></span>
					</div> -->
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md"><i class="fa fa-inr"></i> <?php echo $sub_total;?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<a href="<?php echo $this->url->slug(8);?>" class="btn btn-primary checkout-btn" id="ptc">PROCCED TO CHECKOUT</a>
				
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->



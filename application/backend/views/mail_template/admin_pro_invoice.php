
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">


<table width="100%">
	<tr>
	<td colspan="6">
<a href=""><img src="../assets/upload/logo/<?php echo $inv_logo; ?>" alt="Groce24" width="150px" class="img-responsive"></a>
<br>
 <?php $contact= $this->admin_model->selectAll('tbl_site_address');
  echo @$contact[0]->site_email; ?><br>
  <?php 
   echo @$contact[0]->site_phone;
            ?> 
        </td>

          
            	
            		<td colspan="6"><?php  echo @$contact[0]->site_address; ?></td>
            	</tr>
            </table>
<div style="height:90px;width:10px;"></div>
<div>
	<table border="1" width="100%">
		<tr>
			<th colspan="10" style="text-align:center">INVOICE</th>
		</tr>
		<!-- <tr>
			<th colspan="9" style="text-align:center">TAX/RETAIL INVOICE</th>
		</tr> -->
		<tr>
			<td colspan="4">Invoice No: <?php echo $invoice_no; ?><br>
							 Date:<?php echo date('jS M y', strtotime($order_date));?>
			</td>
			<td colspan="4">Order Number:<?php echo @$orderno; ?><br>

							Date:<?php echo date('jS M y', strtotime($order_date)); ?>
			</td>
			<td colspan="2"> <img src="../assets/upload/<?php echo $awb_barcode_file; ?>"></td>
		</tr>
		<tr>
			<td colspan="5"><b>Delivery Address</b><br>
			<?php if(@$buyer_address[0]->user_first_name.' '.@$buyer_address[0]->user_last_name != "") { echo @$buyer_address[0]->user_first_name.' '.@$buyer_address[0]->user_last_name;} else { } ?><br>
			Email:<?php echo @$buyer_address[0]->user_email; ?><br>
			Mobile:<?php echo @$buyer_address[0]->user_phone_no; ?><br>
			Address:<?php echo @$buyer_address[0]->user_address; ?><br>
			Pincode:<?php echo @$buyer_address[0]->user_pincode; ?><br>
			Delivery Time Slot:<?php echo $final_del_time; ?>
			</td>
			<td colspan="5"><b>Billing Address</b><br>
					Name: <?php echo @$billing_address[0]->first_name.' '.@$billing_address[0]->last_name; ?><br>
					Address: <?php echo @$billing_address[0]->address; ?><br>
					Pin code: <?php echo @$billing_address[0]->pincode; ?><br>
					Contact: <?php echo @$billing_address[0]->mobile; ?><br>
			</td>
		</tr>
		 <tr>
			<td colspan="4" style="text-align: center;"><b>Payment Option</b><br>
							
			
		

			<td colspan="6"  style="text-align: center;"> <b><?php if($payment_status=="cod"){ echo "Cash On Delivery";} 
                  elseif($payment_status=="swap_card"){ echo "Swipe Card";} 
                  else {echo $payment_status;}?>
            </td>
		</tr> 
		
		<tr>
			<th>Sl. No.</th>
			<th colspan="2">PRODUCT</th>
			<th>PACK SIZE</th>
			<!-- <th>SKU</th> -->
			<!-- <th>Description</th> -->
			<th>MRP(Rs)</th>
		   <th>Discount(%)</th>
		    <th>Net Pricce(Rs.)</th>
		   <th>QTY</th>
			<!-- <th>Shipping</th> -->
			<th>GST(%)</th>
			
			<th>TOTAL(Rs.)</th>
			
			
		</tr>

		<?php 
		$i=0;
		 $order_details= $this->admin_model->selectOne('tbl_order_details','order_id',$order_id);
		foreach($order_details as $details)
		{
			

			 $product = $this->common->select($table_name='tbl_product',$field=array(),$where=array('id'=>@$details->order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

		
			 $discount = $this->common->select($table_name='tbl_product_price',$field=array(),$where=array('product_id'=>@$details->order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

			  $mrp_price = $this->common->select($table_name='tbl_product_price',$field=array(),$where=array('product_price_id'=>@$details->order_product_price_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			    
			$i++;
			?>
		<tr>
			<td style="text-align: center;"><?php echo $i;?></td>
			<td colspan="2" width="25%" style="text-align: center;"><?php echo @$product[0]->product_name;?><br>

			<td  width="30%" style="text-align: center;">


					<?php 

					$unit=$this->admin_model->selectOne('tbl_weight_class','weight_class_id',$details->cart_item_pro_unit);

					echo @$details->cart_item_pro_qty.' '.@$unit[0]->weight_class;

					?>

					<br>

			</td>
			<!-- <td><?php echo @$pro_desc[0]->sku_id;?></td> -->
			
			<td style="text-align: center;"><?php echo @$mrp_price[0]->mrp_price; ?></td>
                  <td style="text-align: center;"><?php
                if(@$discount[0]->discount !=0 || @$discount[0]->discount !="") { echo @$discount[0]->discount;} else{ echo '0'; }
                  ?>
                    
                  </td> 
                   <td><?php echo @$mrp_price[0]->net_price; ?></td>
                  <td style="text-align: center;"><?php echo $details->order_product_qty;?></td>
                  
                 <td style="text-align: center;"> <?php if(@$product[0]->tax_rate!= ""){ echo @$product[0]->tax_rate;  } else { echo  '0.0 %'; } ?></td>
                
			<td style="text-align: center;"> <?php 

			
			$sbtotal= number_format((float)$details->order_product_price*$details->order_product_qty, 2, '.', '');
			
			echo $sbtotal;
			?></td>
			
		</tr>
		<?php
	}
	?>
	

	<tr>
			<td colspan="8">Sub-Total:</td>
			<td style="text-align: center;" colspan="2">

				<?php 

				$detail_amt=0;
						$order_details= $this->admin_model->selectOne('tbl_order_details','order_id',$order_id);
		foreach($order_details as $details)
		{
				$a=number_format((float)$details->order_product_price*$details->order_product_qty, 2, '.', '');
				$detail_amt+=$a;
			} echo 'Rs. '.$detail_amt;
				?>
					

				</td>
		</tr>

			<?php if($flat_discount != "" || $flat_discount != 0){ ?>

	<tr>
			<td colspan="8">Flat Discount:</td>
			<td style="text-align: center;" colspan="2">

				<?php 
						
				echo 'Rs. '.$flat_discount;
				?>
					

				</td>
		</tr>
		<?php } ?>

		<?php if($shipping_charge != ""){ ?>

	<tr>
			<td colspan="8">Shipping charge:</td>
			<td style="text-align: center;" colspan="2">

				<?php 
						
				echo 'Rs. '.$shipping_charge;
				?>
					

				</td>
		</tr>
		<?php } ?>
		
		
	<?php if($wallet_amt != ""){ ?>

	<tr>
			<td colspan="8">Wallet Value:</td>
			<td style="text-align: center;" colspan="2">

				<?php 
						
				echo 'Rs. '.$wallet_amt;
				?>
					

				</td>
		</tr>
		<?php } ?>
		
		<tr>
			<td colspan="8">Total:</td>
			<td style="text-align: center;" colspan="2">

				<?php 
						
				$t_amt=($total_amt - $flat_discount);
				echo 'Rs. '.number_format((float)$t_amt, 2, '.', '');


				?>
					

				</td>
		</tr>
		<tr>
			<td colspan="3">Total in Words:</td>
			<td colspan="7"><?php $ttl_amnt=$total_amt - $flat_discount; echo 'RUPEES '.strtoupper ($this->admin_model->convert_number($ttl_amnt)).' ONLY'; ?></td></tr>
		<!-- <tr>
			<td colspan="8">Payment:</td>
			<td> <?php if($payment_status=='cod'){ echo 'Cash On Delivery'; } else { echo 'Online Payment'; }?></td>
		</tr>  -->
		<tr>
			<td colspan="10">
				<p>All buy is made for end user only. not for resale. any quaires regarding order please mail groce24.com
	          </p>
			</td>
			<table border="1">
		<tr>
			<td colspan="10">THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</td>
		</tr>
	</table>
		</tr>
	</table>
	
		<!-- <p><b>DECLARATION</b></p> -->
		<!-- <p>We declare that this invoice shows actual price of the product described inclusive of all taxes and that all particulars are true and correct.</p> -->
		
	<!-- <table border="1">
		<tr>
			<td colspan="10">THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</td>
		</tr>
	</table> -->
</div>

<div style="height:70px;width:10px;"></div>


</body>

</html>

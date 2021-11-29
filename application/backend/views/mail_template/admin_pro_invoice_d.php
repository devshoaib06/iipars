
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">



<a href=""><img src="../assets/image/logo-final.png" alt="Joynagar" width="150px" class="img-responsive"></a>
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
			<td colspan="4">Order Number:<?php echo @$order_number.$order_details_id; ?><br>

							Date:<?php echo date('jS M y', strtotime($order_date)); ?>
			</td>
			<td colspan="2"> <img src="../assets/upload/<?php echo $awb_barcode_file; ?>"></td>
		</tr>
		<tr>
			<td colspan="5"><b>Seller</b><br>
			<?php if(@$seller_details[0]->user_type_id=='2'){?>
				<?php echo @$seller_address[0]->company_name; ?><br>
				
				<?php echo 'Address: '.@$seller_address[0]->company_address.', '.@$seller_address[0]->company_pincode; ?>
			<?php } else { echo 'N/A'; } ?>
			</td>
			<td colspan="5"><b>billing/shipping address</b><br>
					Name: <?php echo $buyer_details[0]->first_name; ?> <?php echo $buyer_details[0]->last_name; ?><br>
					Address: <?php echo $buyer_address[0]->user_address; ?><br>
					Pin code: <?php echo $buyer_address[0]->user_pincode; ?><br>
					Contact: <?php echo $buyer_details[0]->mobile; ?><br>
			</td>
		</tr>
		<tr>
			<td colspan="4">Order through joynagar.com<br>
							
			</td>
			<td colspan="4">Phone:1800 200 2171
			</td>

			<td colspan="2"> <?php if($payment_status=='cod'){ echo 'COD'; } else { echo 'Online Payment'; }?></td>
		</tr>
		
		<tr>
			<th>Sl. No.</th>
			<th colspan="2">PRODUCT</th>
			<!-- <th>SKU</th> -->
			<!-- <th>Description</th> -->
			<th>QTY</th>
			<th colspan="2">PRICE (GST Included)</th>
			<!-- <th>Discount</th> -->
			<!-- <th>Shipping</th> -->
			<th>GST</th>
			<th>Shipping</th>
			<th colspan="2">TOTAL</th>
			
			
		</tr>

		<?php 
		$i=0;
		$items=count($order_details);
		foreach($order_details as $row)
		{
			    $qty=$row->order_product_qty;
				$total_price= $qty * $row->order_product_price;
			
			$pro_desc= $this->admin_model->selectOne('tbl_product','id',$row->order_product_id);
			//$pro_attribute= $this->admin_model->selectOne('tb_product_attribute','product_id',$row->product_id);
			$i++;
			?>
		<tr>
			<td><?php echo $i;?></td>
			<td colspan="2"><?php echo @$pro_desc[0]->product_name;?><br>

			</td>
			<!-- <td><?php echo @$pro_desc[0]->sku_id;?></td> -->
			<td><?php echo $row->order_product_qty;?></td>
			<td colspan="2"><?php echo 'Rs.'.round($row->order_product_qty*$row->order_product_price); ?></td>
                 <!--  <td><?php
                
                  $pro_disc= round($discount/$items);
                  echo 'Rs. '.$pro_disc; ?>
                    
                  </td> -->
                  
                 <td> <?php  if(@$pro_desc[0]->tax!="") { echo @$pro_desc[0]->tax; } else{ echo 'N/A'; } ?>%</td>
                 <td><?php echo 'Rs. '.$row->order_product_shipping; ?></td>
			<td colspan="2"> <?php 

			 $pro_disc= round($discount/$items);
			$sbtotal= $row->order_product_qty*$row->order_product_price;
			$sbtotal= $sbtotal-$pro_disc;
			$sbtotal=round($sbtotal+$row->order_product_shipping);
			echo 'Rs. '.$sbtotal;
			?></td>
			
		</tr>
		<?php
	}
	?>
		
		<tr>
			<td colspan="9">TOTAL:</td>
			<td>

				<?php 
						
				echo 'Rs. '.$sbtotal;
				?>
					

				</td>
		</tr>
		<tr>
			<td colspan="9">TOTAL IN WORDS:</td>
			<td><?php echo 'Rupees '.$this->admin_model->convert_number($sbtotal).' Only'; ?></td></tr>
		<!-- <tr>
			<td colspan="8">Payment:</td>
			<td> <?php if($payment_status=='cod'){ echo 'Cash On Delivery'; } else { echo 'Online Payment'; }?></td>
		</tr>  -->
		<tr>
			<td colspan="10">
				<p>All buy is made for end user only. not for resale. any quaires regarding order please mail order@groce24.com
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">



<a href=""><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Groce24" width="300px" class="img-responsive"></a>
<div style="height:90px;width:10px;"></div>
<div>
	<table border="1" width="100%">
		<tr>
			<th colspan="6" style="text-align:center">Ordered via Groce24</th>
		</tr>
		<tr>
			<th colspan="6" style="text-align:center">TAX/RETAIL INVOICE</th>
		</tr>
		<tr>
			<td colspan="3">Invoice No: <?php echo $invoice_no; ?></td>
			<td colspan="3">Invoice Date:<?php echo date('d/m/y');?></td>
		</tr>
		<tr>
			
			<td colspan="2"><b>Buyer Details</b><br>
					Name: <?php if($buyer_details[0]->first_name.' '.$buyer_details[0]->last_name!= ""){echo $buyer_details[0]->first_name.' '.$buyer_details[0]->last_name;} else{ 'Not Inserted'; } ?><br>
					Contact: <?php echo $buyer_details[0]->mobile; ?><br>
					Pin code: <?php echo $buyer_details[0]->pincode; ?><br>
					Address: <?php echo $buyer_details[0]->address; ?><br>
					
					
			</td>

			<td colspan="4"><b>Delivery address</b><br>
					Name: <?php echo $buyer_address[0]->user_first_name; ?> <?php echo $buyer_address[0]->user_last_name; ?><br>
					Contact: <?php echo $buyer_address[0]->user_phone_no; ?><br>
					Pin code: <?php echo $buyer_address[0]->user_pincode; ?><br>
					Address: <?php echo $buyer_address[0]->user_address; ?><br>
					
					
			</td>
		</tr>
		
		<tr>
			<th>Sl. No.</th>
			<th>Product</th>
			<th>SKU</th>

			<th>Description</th>
			<th>Qty</th>
			<th>Amount(GST Included)</th>
			
			
		</tr>

		<?php 
		$i=0;
		foreach($order_details as $row)
		{
			
			
			$pro_desc= $this->admin_model->selectOne('tbl_product','id',$row->order_product_id);
			//$pro_attribute= $this->admin_model->selectOne('tb_product_attribute','product_id',$row->product_id);
			$i++;
			?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo @$pro_desc[0]->product_name;?><br>

			</td>
			<td><?php echo @$pro_desc[0]->sku_id;?></td>
			<td>
				<?php $string=@$pro_desc[0]->description; echo word_limiter($string,10);?>
			</td>
			<td><?php echo $row->order_product_qty;?></td>
			<td>Rs. <?php echo ($row->order_product_qty * $row->order_product_price);?></td>
			
		</tr>
		<?php
	}
	?>
		
		<tr>
			<td colspan="5">Total:</td>
			<td>Rs. <?php echo $order_total_price;?></td>
		</tr>
		<tr>
			<td colspan="5">In Words:</td>
			<td><?php echo 'Rupees '.$this->admin_model->convert_number($order_total_price).' Only'; ?></td></tr>
		<tr>
			<td colspan="5">Payment:</td>
			<td> <?php if($payment_status=='cod'){ echo 'Cash On Delivery'; } else { echo 'Online Payment'; }?></td>
		</tr> 
	</table>
	
		<p><b>DECLARATION</b></p>
		<p>We declare that this invoice shows actual price of the product described inclusive of all taxes and that all particulars are true and correct.</p>
		<p>In case you find the Selling Price more than quoted on the Product, Immediately inform:   info@groce24kolkata.com 
	</p>
	<table border="1">
		<tr>
			<td>THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</td>
		</tr>
	</table>
</div>

<div style="height:70px;width:10px;"></div>


</body>

</html>

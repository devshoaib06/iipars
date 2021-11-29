
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">



<a href=""><img src="<?php echo base_url();?>assets/images/logo2.png" style="max-width:369px;" alt="flxiekart" class="img-responsive"></a>
<div style="height:90px;width:10px;"></div>
<div>
	<table>
		<tr>
			<td colspan="7">Dear Admin,</td>
		</tr>
		<tr>
			<td colspan="7">A new order has been placed by <?php echo @$mail_data['first_name']; ?> on <?php echo date('d-m-Y', strtotime(@$mail_data['order_date']));?>. Details are given bellow</td>
		</tr>
	</table>
	<table border="1">
		

		<!-- <tr>
			<td colspan="3">Invoice No: <?php echo $invoice_no; ?></td>
			<td colspan="4">Invoice Date:<?php echo date('d/m/y');?></td>
		</tr> -->
		<tr>
			<td colspan="3"><b>Billing Details</b><br>
				Name: <?php echo @$mail_data['first_name'].' '.@$mail_data['last_name']; ?><br>
				
				Email: <?php echo @$mail_data['email']; ?><br>
				Contact: <?php echo @$mail_data['mobile']; ?><br>
			</td>
			<td colspan="4"><b>Delivery Details</b><br>
					Name: <?php echo @$mail_data['deli_name']; ?><br>
					Address: <?php echo @$mail_data['deli_location']; ?><br>
					Pin code: <?php echo @$mail_data['deli_pin']; ?><br>
					Contact: <?php echo @$mail_data['deli_phone']; ?><br>
					Email: <?php echo @$mail_data['deli_mail']; ?><br>
			</td>
		</tr>
		<!-- <tr>
			<td colspan="3">Dispatched By: Flxiekart</td>
			<td colspan="3">#AWB:</td>
		</tr> -->
		<tr>
			<th>Sl. No.</th>
			<th>Product</th>
			<th>SKU</th>
			<th>Description</th>
			<th>Qty</th>
			<th>Amount</th>
			<th>Seller</th>
		</tr>

		<?php 
		$i=0;
		foreach(@$mail_data['order_details'] as $row)
		{
			$pro_desc = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$row->order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			$pro_image = $this->common_model->common($table_name='tbl_product_image',$field=array(),$where=array('product_id'=>$row->order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			if(@$pro_desc[0]->user_type_id=='2')
			{
				$seller_details= $this->common_model->common($table_name='tbl_user',$field=array(),$where=array('user_id'=>@$pro_desc[0]->seller_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

			}
			$i++;
			?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo @$pro_desc[0]->product_name;?><br>
			<img src=<?php echo base_url();?>assets/upload/product/<?php echo @$pro_image[0]->image;?> height="100px" width="100px"></td></td>
			<td><?php echo $pro_desc[0]->sku_id;?></td>
			<td>
				Manufacture Date: <br>
				<?php
				echo date('d-m-Y', strtotime($pro_desc[0]->manufactured_date)).'<br>';

				?><br>
				Expiry Date: <br>
				<?php
				echo date('d-m-Y', strtotime($pro_desc[0]->expiry_date)).'<br>';

				?><br>
				Brand Name: <br>
				<?php 
				$brand_id = $pro_desc[0]->brand_id;
				$brand = $this->common_model->common($table_name='tbl_brand',$field=array(),$where=array('brand_id'=>$brand_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
				echo @$brand[0]->brand_name;

				?>
			</td>
			<td><?php echo $row->order_product_qty;?></td>
			<td>Rs. <?php echo $row->order_product_price;?></td>
			<td><?php if(@$pro_desc[0]->user_type_id=='2'){ ?>
			<?php echo @$seller_details[0]->first_name.' '.@$seller_details[0]->last_name; ?><br><br>
				
				<?php echo 'Address: '.@$seller_details[0]->area; ?>
			<?php } else { echo 'N/A'; } ?>
			</td>
		</tr>
		<?php
	}
	?>
		<!-- <tr>
			<td colspan="5">Coupon Discount:</td>
			<td colspan="2">Rs. <?php echo $ship_bill_details[0]->coupon_discount;?></td>
		</tr> -->
		<!-- <tr>
			<td colspan="5">Shipping Charge:</td>
			<td></td>
		</tr> -->
		<tr>
			<td colspan="5">Total:</td>
			<td colspan="2">Rs. <?php echo @$mail_data['order_total_price']; ?></td>
		</tr>
		<tr>
			<td colspan="5">In Words:</td>
			<td colspan="2"><?php echo 'Rupees '.$this->common_model->convert_number(@$mail_data['order_total_price']).' Only'; ?></td></tr>
		<tr>
	</table>
	
		<p><b>DECLARATION</b></p>
		<p>We declare that this invoice shows actual price of the product described inclusive of all taxes and that all particulars are true and correct.</p>
		<p>In case you find the Selling Price more than quoted on the Product, Immediately inform:  info@sexologistinkolkata.com 
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

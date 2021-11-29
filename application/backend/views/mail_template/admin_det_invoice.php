
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">



<a href=""><img src="../assets/images/logo.png" alt="flxiekart" class="img-responsive"></a>
<div style="height:90px;width:10px;"></div>
<div>
	<table border="1" width="100%">
		<tr>
			<th colspan="6" style="text-align:center">Flxiekart Subscription Plan Invoice</th>
		</tr>
		<!-- <tr>
			<th colspan="6" style="text-align:center">TAX/RETAIL INVOICE</th>
		</tr> -->
		<tr>
			<td colspan="3">Invoice No: <?php echo $invoice_no; ?></td>
			<td colspan="3">Invoice Date:<?php echo date('d/m/y');?></td>
		</tr>
		<tr>
				<td colspan="3">
				Flexikart Online Services Pvt Ltd (OPC)<br>
				CIN: U74999WB2016OPC217964<br>
				Registered Office:<br>
				1st Floor, Ashirbad Apartment<br>
				S.F.Road, By Lane -2<br>
				Asansol-713303<br>
				West Bengal, India<br>
				GSTIN:19AACCF9474A1ZK<br>
				Contact: +91 7365987234



				<!-- <?php echo $seller_details[0]->seller_public_name; ?><br>
				<?php echo 'GST: '.$seller_details[0]->seller_taxid; ?><br>
				<?php echo 'Address: '.$seller_contact[0]->seller_contact_address1.', '.$seller_contact[0]->seller_contact_zip; ?> -->
			</td>
			<td colspan="3"><b>Client Details</b><br>
					Client Name: <?php echo $seller_details[0]->seller_public_name; ?><br>
					Company Name: <?php echo $seller_details[0]->seller_business_name; ?><br>
					Address: <?php echo $seller_contact[0]->seller_contact_address1; ?><br>
					Pin code: <?php echo $seller_contact[0]->seller_contact_zip; ?><br>
					Contact: <?php echo $seller_contact[0]->seller_contact_phone; ?><br>
					GST No: <?php echo $seller_details[0]->seller_taxid; ?><br>
			</td>
		</tr>
		<!-- <tr>
			<td colspan="3">Dispatched By: Flxiekart</td>
			<td colspan="3">#AWB:</td>
		</tr> -->
		<tr>
			
			<td colspan="2">Sl. No.</td>
			<td colspan="2">Subscription Plan details</td>
			<td colspan="2">Amount</td>
			
			
		</tr>

		<?php 
		$i=0;
		foreach($order_pro_list as $row)
		{
			
			
			
			$i++;
			?>
		<tr>
			<td colspan="2"><?php echo $i;?></td>
			
			<td colspan="2"><?php echo $order_info[0]->advertise_plan_name;?> Start From <?php echo $order_pro_list[0]->plan_from_date;?> To end Date <?php echo $order_pro_list[0]->plan_to_date;?></td>
			
			<td colspan="2">Rs. <?php echo $row->plan_net_price;?></td>
			 
		</tr>
		<?php
	}
	?>
	<tr >
		
		<td colspan="6">Subscription Plan Amount inclusive of GST(18%)</td>
	</tr>
		<!-- <tr>
			<td colspan="5">Coupon Discount:</td>
			<td>Rs. <?php echo $ship_bill_details[0]->coupon_discount;?></td>
		</tr> -->
		<!-- <tr>
			<td colspan="5">Shipping Charge:</td>
			<td></td>
		</tr> -->
		<tr>
			<td colspan="5">Total:</td>
			<td>Rs. <?php echo $row->plan_net_price;?></td>
		</tr>
		<tr>
			<td colspan="3">In Words:</td>
			<td colspan="3"><?php echo 'Rupees '.$this->admin_model->convert_number($row->plan_net_price).' Only'; ?></td></tr>
		
	</table><br><br><br>
	
		<p style="text-align: center">In case of Any query contact sales@flexikart.com </p><br><br><br>
	<table border="1">
		<tr>
			<td>THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</td>
		</tr>
	</table>
</div>

<div style="height:70px;width:10px;"></div>


</body>

</html>

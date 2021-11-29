
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
			<th colspan="7" style="text-align:center">Ordered via Flxiekart</th>
		</tr>
		<tr>
			<th colspan="7" style="text-align:center">TAX/RETAIL INVOICE</th>
		</tr>
		<tr>
			<td colspan="3">Invoice No: <?php echo $invoice_no; ?></td>
			<td colspan="4">Invoice Date:<?php echo date('d/m/y');?></td>
		</tr>
		<tr>
			<td colspan="3"><b>Billing Details</b><br>
				Name: <?php echo $ship_bill_details[0]->payment_firstname; ?><br>
				Address: <?php echo $ship_bill_details[0]->payment_address_1; ?><br>
				Pin code: <?php echo $ship_bill_details[0]->payment_postcode; ?><br>
				Contact: <?php echo $ship_bill_details[0]->payment_mobile; ?><br>
			</td>
			<td colspan="4"><b>Delivery Details</b><br>
					Name: <?php echo $ship_bill_details[0]->shipping_firstname; ?><br>
					Address: <?php echo $ship_bill_details[0]->shipping_address_1; ?><br>
					Pin code: <?php echo $ship_bill_details[0]->shipping_postcode; ?><br>
					Contact: <?php echo $ship_bill_details[0]->shipping_mobile; ?><br>
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
		foreach($order_pro_list as $row)
		{
			$seller_details= $this->admin_model->selectOne('tb_seller','seller_id',$row->order_product_seller_id);
			$seller_contact= $this->admin_model->selectOne('tb_seller_contact','seller_id',$row->order_product_seller_id);
			$pro_desc= $this->admin_model->selectOne('tb_product','product_id',$row->product_id);
			$pro_attribute= $this->admin_model->selectOne('tb_product_attribute','product_id',$row->product_id);
			$i++;
			?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row->order_product_name;?><br>

			<?php
			
                    if($row->order_product_color)
                      {
                        echo 'Color: '.$row->order_product_color.'<br>';
                      }
                      if($row->order_product_size)
                      {
                        echo 'Size: '.$row->order_product_size.'<br>';
                      }
                      if($row->spectacle_power_type)
                      {
                        echo 'Power type: '.$row->spectacle_power_type.'<br>';
                      }
                      if($row->r_sph!='')
                      {
                        ?>
                      <table border="1">
                            <tr>
                                <td></td>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>AXIS</th>
                              </tr>
                              <tr>
                                <th>R</th>
                                <td><?php echo $row->r_sph; ?></td>
                                <td><?php echo $row->r_cyl; ?></td>
                                <td><?php echo $row->r_axis; ?></td>
                              </tr>
                              <tr>
                                <th>L</th>
                                <td><?php echo $row->l_sph; ?></td>
                                <td><?php echo $row->l_cyl; ?></td>
                                <td><?php echo $row->l_axis; ?></td>
                              </tr>
                    </table>
                    <?php
                  }
                  ?></td>
			<td><?php echo $pro_desc[0]->product_sku;?></td>
			<td><?php echo 'Product id: '.$pro_desc[0]->product_id;?><br>
				Specification:<br>
				<?php
				foreach($pro_attribute as $attr)
					{
						echo $attr->product_attribute.'<br>';
						}
							?></td>
			<td><?php echo $row->order_product_quantity;?></td>
			<td>Rs. <?php echo $row->order_product_price;?></td>
			<td><?php echo $seller_details[0]->seller_public_name; ?><br>
				<?php echo 'GST: '.$seller_details[0]->seller_taxid; ?><br>
				<?php echo 'Address: '.$seller_contact[0]->seller_contact_address1.', '.$seller_contact[0]->seller_contact_zip; ?>
			</td>
		</tr>
		<?php
	}
	?>
		<tr>
			<td colspan="5">Coupon Discount:</td>
			<td colspan="2">Rs. <?php echo $ship_bill_details[0]->coupon_discount;?></td>
		</tr>
		<!-- <tr>
			<td colspan="5">Shipping Charge:</td>
			<td></td>
		</tr> -->
		<tr>
			<td colspan="5">Total:</td>
			<td colspan="2">Rs. <?php echo $ship_bill_details[0]->total;?></td>
		</tr>
		<tr>
			<td colspan="5">In Words:</td>
			<td colspan="2"><?php echo 'Rupees '.$this->admin_model->convert_number($ship_bill_details[0]->total).' Only'; ?></td></tr>
		<tr>
			<td colspan="5">Payment:</td>
			<td colspan="2"> <?php echo $ship_bill_details[0]->payment_status;?></td>
		</tr> 
	</table>
	
		<p><b>DECLARATION</b></p>
		<p>We declare that this invoice shows actual price of the product described inclusive of all taxes and that all particulars are true and correct.</p>
		<p>In case you find the Selling Price more than quoted on the Product, Immediately inform:  mrperror@flxiekart.com  
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

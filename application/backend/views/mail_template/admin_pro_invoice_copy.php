
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>

.border-none th, .border-none td{
	border-color: #fff
	padding: 4px;
} 

table th, table td{
	border: 1px solid #ddd;
}

    .col-md-12 {
    width: 100%;
  }
  .col-md-11 {
    width: 91.66666667%;
  }
  .col-md-10 {
    width: 83.33333333%;
  }
  .col-md-9 {
    width: 75%;
  }
  .col-md-8 {
    width: 66.66666667%;
  }
  .col-md-7 {
    width: 58.33333333%;
  }
  .col-md-6 {
    width: 50%;
  }
  .col-md-5 {
    width: 41.66666667%;
  }
  .col-md-4 {
    width: 33.33333333%;
  }
  .col-md-3 {
    width: 25%;
  }
  .col-md-2 {
    width: 16.66666667%;
  }
  .col-md-1 {
    width: 8.33333333%;
  }

  .text-right{
    text-align: right
  }
    .invoice-box{
            max-width: 50%;
        margin:auto;
        padding:15px;
        padding-top: 0px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:14px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .margin-0{
        margin: 0px;
    }

    .pull-right{
        float: right
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
            font-size: 13px;
    letter-spacing: normal;
    }
    
    .invoice-box table td{
        padding:4px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:0px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:0px;
    }
    
    .invoice-box table tr.heading td {
    background: #333;
    border-bottom: 1px solid #ddd;
    /* font-weight: bold; */
    color: #fff;
}
tr.total {
    background: #f3f3f3;
}

span.bg-green {
    background: #8BC34A;
    padding: 4px 11px;
    border-radius: 3px;
    color: #fff;
}

span.bg-red {
    background: #F44336;
    padding: 4px 11px;
    border-radius: 3px;
    color: #fff;
}

span.bg-blue {
    background: #2196F3;
    padding: 4px 11px;
    border-radius: 3px;
    color: #fff;
}
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }

    .text-center{
        text-align: center !important
    }
    </style>
</head>

<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt " >


<!-- http://192.168.0.12/dme/site/assets/images/logo1.png -->


<!-- <a href=""><img src="assets/image/logo1.png" alt="Coupon Monkey" width="" class="img-responsive"></a> -->

<div class="">
	<table class="border-none"  width="100%">
		<tr class="information">
                <td colspan="7">
                    <table  width="100%">
                        <tbody><tr>
                            <td>
                            <img src="assets/image/logo1.jpg" alt="Coupon Monkey" width="" class="img-responsive">
                            <br>
                            Invoice No: <?php echo $invoice_no; ?><br>
                            Invoice Date:<?php echo date('jS M Y', strtotime($invoice_date));?>
                            </td>
                            
                            <td class="pull-right">
                                 <b>Coupon Monkey</b><br> <br>
                                 <p class="margin-0">Groce24, Nabinnagar, Kalyandaha, Chapra, Nadia, West Bengal, India, Pin 741123</p><br>
                                 <p><b>GSTIN: </b><?php echo @$invoice_setting[0]->gstin; ?><br>
                                 <b>PAN No.: </b><?php echo @$invoice_setting[0]->pan; ?><br>
                                 <?php
                                 if($buyer_details[0]->deli_country!='India')
                                    {
                                        ?>
                                        <b>IEC No.: </b><?php echo @$invoice_setting[0]->iec; ?><br>
                                        <?php
                                    }
                                    ?>
                            </p>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
	</table>

	<table width="100%">

		<tr class="heading">
			<td colspan="6" style="text-align:center; background: #333; color: #fff">Ordered via Groce24</td>
		</tr>
		<tr class="heading">
			<td colspan="6" style="text-align:center; background: #333; color: #fff">TAX/RETAIL INVOICE</td>
		</tr>
		<!-- <tr>
			<td colspan="3">Invoice No: <?php echo $invoice_no; ?></td>
			<td colspan="3">Invoice Date:<?php echo date('d/m/y');?></td>
		</tr> -->
		<tr>
			
			<td colspan="3" style="padding: 4px;"><b>Delivery Details</b><br>
					Name: <?php echo $buyer_details[0]->deli_name; ?><br>
					Address: <?php echo $buyer_details[0]->deli_location.', '.$buyer_details[0]->deli_city.', '.$buyer_details[0]->deli_state.' '.$buyer_details[0]->deli_country; ?><br>
					Pin code: <?php echo $buyer_details[0]->deli_pin; ?><br>
					Landmark: <?php echo $buyer_details[0]->deli_landmark; ?><br>
					Contact: <?php echo $buyer_details[0]->deli_phone; ?><br>
			</td>
            <td colspan="3" style="padding: 4px;"><b>Billing Details</b><br>
                    Name: <?php echo $billing_details[0]->first_name; ?><br>
                    Address: <?php echo $billing_details[0]->address.', '.$billing_details[0]->city.', '.$billing_details[0]->state.', '.$billing_details[0]->country; ?><br>
                    Pin code: <?php echo $billing_details[0]->pincode; ?><br>
                    Landmark: <?php echo $billing_details[0]->area; ?><br>
                    Contact: <?php echo $billing_details[0]->mobile.', '.$billing_details[0]->login_email; ?><br>
            </td>
		</tr>
		
		<tr style="border: 1px solid #ddd;">
			<th>Sl. No.</th>
			<th colspan="2">Product</th>
			<th>SKU</th>
			<!-- <th>Description</th> -->
			<th>Qty</th>
			<th>Amount</th>
			
			
		</tr>

		<?php 
		$i=0;
		foreach($order_details as $row)
		{
			
			
			$pro_desc= $this->admin_model->selectOne('tbl_product','id',$row->order_product_id);
			$pickstate= $this->admin_model->selectOne('states','id',@$pro_desc[0]->state_id);
			//$pro_attribute= $this->admin_model->selectOne('tb_product_attribute','product_id',$row->product_id);
			$i++;
			?>
		<tr>
			<td><?php echo $i;?></td>
			<td colspan="2"><?php echo @$pro_desc[0]->product_name;?><br>

			</td>
			<td><?php echo @$pro_desc[0]->sku_id;?></td>
			<!-- <td><?php echo @$pro_desc[0]->full_description;?> <br> -->
				

			</td>
			<td><?php echo $row->order_product_qty;?></td>
			<td><!-- Rs <?php echo round($row->order_product_qty*$row->order_product_price);?> --></td>
			<input type="hidden">
		</tr>
		<?php
	}
	?>
	<tr>
			<td colspan="5">Product price:</td>
			<td>Rs. <?php echo $netproductprice;?></td>
			
		</tr>
		<?php
		if($buyer_details[0]->deli_state!=@$pickstate[0]->name){
			?>
			<tr>
			
			<td colspan="5">IGST:</td>
			<td>Rs. <?php echo $netgst;?></td>
			
		</tr>
			<?php
}
			else{
				?>
		<tr>
			
			<td colspan="5">CGST:</td>
			<td>Rs. <?php echo $netgst/2;?></td>
			
		</tr>
		<tr>
			
			<td colspan="5">SGST:</td>
			<td>Rs. <?php echo $netgst/2;?></td>
			
		</tr>
		<?php
	}
	?>
		<tr>
			
			<td colspan="5">Total:</td>
			<td>Rs <?php echo round($row->order_product_qty*$row->order_product_price);?></td>
		</tr>

		<tr>
			<td colspan="5">In Words:</td>
			<td><?php echo 'Rupees '.$this->admin_model->convert_number($row->order_product_qty*$row->order_product_price).' Only'; ?></td></tr>
		<tr>
			<td colspan="5">Payment:</td>
			<td> <?php if($payment_status=='cod'){ echo 'Cash On Delivery'; } else { echo 'Online Payment'; }?></td>
		</tr> 
	</table>
	
		<p><b>DECLARATION</b></p>
		<p>We declare that this invoice shows actual price of the product described inclusive of all taxes and that all particulars are true and correct.</p>
		<p>In case you find the Selling Price more than quoted on the Product, Immediately inform:   
		admin@couponmonkey.in 
	</p>
	<table border="1">
		<tr>
			<td>THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</td>
		</tr>
	</table>
</div>




</body>

</html>

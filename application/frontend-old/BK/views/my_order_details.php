<section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                    <?php 
                                    if(@$user_details[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$user_details[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$user_details[0]->first_name;?> <?php echo @$user_details[0]->last_name;?></h4>
                            </div>
                             <ul>
                                <li class="active"><a href="<?php echo $this->url->link(5);?>">Edit Profile</a></li>
                                <li><a href="<?php echo $this->url->link(6);?>">Change Password</a></li>
                                <li><a href="<?php echo $this->url->link(24);?>">My Order</a></li>
                                <li><a href="<?php echo $this->url->link(7);?>">My Wishlist</a></li>
                                <li><a href="<?php echo $this->url->link(31); ?>">Close my account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">My Order Details</h3>
                            <div class="myorder-content cards">
                                <div class="head">
                                    <h5>Order Details</h5>
                                </div>
                                <div class="body clearfix">
                                    <div class="col-md-6 border-right">

                                        <p>Order ID :  <span class="pull-right"><?php echo @$order_list[0]->order_unique_id;?> (<?php echo count($order_details)?> Item<?php if(count($order_details)>1){ echo 's';}?>)</span></p>

                                        <p>Order Date : <span class="pull-right"><?php echo date('j F Y',strtotime(@$order_list[0]->created_date))?></span></p>

                                        <p>Total Amount :  <span class="pull-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo @$order_list[0]->order_total_price;?></span></p>

                                        <p>Payment Type :  <span class="pull-right"> <?php if(@$order_list[0]->payment_status=='cod'){ echo 'Cash On Delivery';} else{ echo 'Online Payment';}?></span></p>

                                    </div>
                                    <div class="col-md-6">

                                        <h5><b><?php echo @$delivery_address[0]->deli_name;?></b></h5>
                                        <p><i class="fa fa-map-marker"></i>  <?php echo @$delivery_address[0]->deli_location;?><br>
                                            <span><?php echo @$delivery_address[0]->deli_city;?>, <?php echo @$delivery_address[0]->deli_state;?>,</span>
                                            <span><?php echo @$delivery_address[0]->deli_pin;?><br>India.</span>
                                        </p>
                                    </div>
                                    
                                    
                                </div>
                                
                            </div><!--//single-order-content-->
                            <div class="myorder-content">
                                <div class="head">
                                    <h5>ORDER SUMMARY</h5>
                                </div>
                            
                                <?php if(count($order_details)>0){

                                    foreach($order_details as $details)
                                    {
                                        $product_id = $details->order_product_id;
                                        $product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                        $product_image_details = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                                ?>
                                <div class="body clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image_details[0]->image;?>" class="img-responsive od-img" alt="" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                        <h5 ><?php echo @$product_details[0]->product_name;?></h5>
                                        <ul>
                                            <li>Quantity : <div><?php echo $details->order_product_qty;?></div></li>
                                            <!-- <li>Size : <div>XL</div></li> -->
                                           
                                        </ul>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 pull-right">
                                        <p class="price"><i class="fa fa-inr"></i> <?php echo $details->order_product_price;?></p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 pull-right">
                                        <span class="availability-status label label-success"><?php echo @$details->order_product_status;?> </span>       
                                        <?php if(@$details->order_product_status=='Pending'){?>
                                        <a href="" class="label label-danger" onclick=cancel_your_order(<?php echo $details->order_details_id;?>) >Cancel Order</a>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                                <?php } 
                                    }
                                ?>
                              
                                <div class="body clearfix">
                                    <div class="col-lg-5 col-md-5 col-sm-3 col-xs-12">
                                    <p class="tot"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('j F Y ',strtotime(@$order_list[0]->created_date))?></p>
                                    </div>
                                    
                                    <div class="col-lg-5 col-md-5 col-sm-3 col-xs-12 pull-right">
                                        <p class="tot1"> Order Total:   <span><i class="fa fa-inr"></i>  <?php echo @$order_list[0]->order_total_price;?></span></p>
                                    </div>
                                    
                                </div>
                               
                            </div><!--//single-order-content-->
                           
                        </div>
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->


        <script type="text/javascript">
  function cancel_your_order(id)
  {
        //alert(id);
      var base_url='<?php echo base_url(); ?>';
      if(confirm('Are you sure to cancel your order ?'))
      {
        $.ajax(

            {

            type: "POST",

            dataType: 'html',

            url: base_url + "manage_order/cancel_buyer_order",

            data: {order_id:id},

            async: false,

            success: function (data) {

              // alert(data);

              //alert('Item deleted from your cart');

               //$("#cart_list").html(data);
               location.reload();

            }

            

        });

    }
  }
</script>
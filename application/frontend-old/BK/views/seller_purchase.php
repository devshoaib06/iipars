


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
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$user_details[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$user_details[0]->first_name.' '.@$user_details[0]->last_name; ?></h4>
                            </div>


                                <h4 class="sell-p">My Account</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
                                <li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
                                <!-- <li><a href="seller-review.php">Reviews</a></li> -->
                                <li><a href="<?php echo $this->url->link(27); ?>">Close my account</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(29); ?>">Add a Single Product</a></li>
                                <!-- <li><a href="seller-featured-product.php">My featured Products</a></li> -->
                                <!-- <li><a href="#">Close my account</a></li> -->
                            </ul>


                              <h4 class="sell-p">My Orders</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(31);?>">Order List</a></li>
                               
                            </ul>


                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">Order History</h3>
                           </div>

                           
                         



<div class="table-responsive">
                            <table id="sp-list">
                                <thead>
                                    <tr>
                                       
                                       
                                        <th class="sp-pad">Status</th>
                                        <th class="sp-pad">Item</th>
                                        <th class="sp-pad">Quantity</th>
                                        <th class="sp-pad">Total Price</th>
                                        <th class="sp-pad">Customer</th>
                                        <th class="sp-pad">Placed On</th>
                                        <th class="sp-pad">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php if(count($order_details)>0)
                                { 
                                    foreach($order_details as $order)
                                    {
                                        $product_id = $order->order_product_id;
                                        $order_id = $order->order_id;
                                        $order_list = $this->admin_model->selectOne('tbl_order','order_id',$order_id);
                                        $customer_id = @$order_list[0]->order_customer_id;
                                        $customer_details =  $this->admin_model->selectOne('tbl_user','user_id',$customer_id);                                       
                                        $product_details = $this->admin_model->selectOne('tbl_product','id',$product_id);
                                        //$product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 
                                ?>
                                    <tr>
                                        
                                        <td>
                                            <h5>
                                            <?php if($order->order_product_status=='Pending'){?>
                                            <select onchange="seller_order_status_change(this.value,'<?php echo $order->order_details_id;?>')">
                                                <option value="Pending" <?php if($order->order_product_status=='Pending'){ echo 'selected'; } ?> >Pending</option>
                                                <option value="Order_Taken" <?php if($order->order_product_status=='Order_Taken'){ echo 'selected'; } ?> >Order Taken</option>
                                                <option value="Dispatched" <?php if($order->order_product_status=='Dispatched'){ echo 'selected'; } ?> disabled>Dispatched</option>
                                                <option value="Delivered" <?php if($order->order_product_status=='Delivered'){ echo 'selected'; } ?> disabled>Delivered</option>
                                                <option value="Canceled" <?php if($order->order_product_status=='Canceled'){ echo 'selected'; } ?> >Canceled</option>
                                            
                                            </select> 
                                            <?php } elseif($order->order_product_status=='Order_Taken'){ ?>
                                            <select onchange="seller_order_status_change(this.value,'<?php echo $order->order_details_id;?>')">
                                                <option value="Order_Taken" <?php if($order->order_product_status=='Order_Taken'){ echo 'selected'; } ?> >Order Taken</option>
                                                <option value="Dispatched" <?php if($order->order_product_status=='Dispatched'){ echo 'selected'; } ?> >Dispatched</option>
                                                <option value="Delivered" <?php if($order->order_product_status=='Delivered'){ echo 'selected'; } ?> disabled>Delivered</option>
                                                <option value="Canceled" <?php if($order->order_product_status=='Canceled'){ echo 'selected'; } ?> disabled>Canceled</option>
                                            </select> 
                                            
                                            <?php }  elseif($order->order_product_status=='Dispatched'){ ?>
                                            <select onchange="seller_order_status_change(this.value,'<?php echo $order->order_details_id;?>')">
                                                
                                                <option value="Dispatched" <?php if($order->order_product_status=='Dispatched'){ echo 'selected'; } ?> >Dispatched</option>
                                                <option value="Delivered" <?php if($order->order_product_status=='Delivered'){ echo 'selected'; } ?> >Delivered</option>
                                               
                                            </select> 
                                            <?php } elseif($order->order_product_status=='Delivered') { ?>
                                            <select onchange="seller_order_status_change(this.value,'<?php echo $order->order_details_id;?>')">
                                                
                                                
                                                <option value="Delivered" <?php if($order->order_product_status=='Delivered'){ echo 'selected'; } ?> >Delivered</option>
                                               
                                            </select>
                                            <?php } else { ?>
                                            <select onchange="seller_order_status_change(this.value,'<?php echo $order->order_details_id;?>')">
                                                
                                                
                                                <option value="Canceled" <?php if($order->order_product_status=='Canceled'){ echo 'selected'; } ?> >Canceled</option>
                                               
                                            </select>
                                            <?php } ?>
                                            </h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5><?php echo @$product_details[0]->product_name;;?></h5></span>
                                        </td>
                                        <td><h5><?php echo $order->order_product_qty;?></h5></td>
                                        
                                        <td><h5><i class="fa fa-inr"></i>  <?php echo $order->order_product_price;?></h5></td>
                                        <td><h5><?php echo @$customer_details[0]->first_name;?> <?php echo @$customer_details[0]->last_name;?><br>( <?php echo @$customer_details[0]->mobile;?> )</h5></td>
                                        
                                        <td><h5><?php echo date('F j, Y, g:i a' , strtotime(@$order->order_created_date));?></h5></td>
                                        <td><a href="<?php echo $this->url->link(29);?>/<?php echo $order->order_details_id;?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        
                                        <?php if($order->order_product_status=='Delivered' || $order->order_product_status=='Canceled'){?>
                                        <a onclick="delete_order('<?php echo $order->order_details_id;?>')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        <?php } ?>
                                    </tr>
                                <?php }   

                                  }   ?>
                                   
                                </tbody>
                            </table>

                            <!-- <div class="save-btn">
                            
                                    <button type="submit" class="btn btn-default">save</button>
                            
                                    </div> -->
                        </div>

                        
                    </div>
                </div>
            </div>



        </section><!--//my-account-wrapper-->
         <div id="pwdModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="email_title"></h4>
      </div>
      <form method="post" action="<?php echo base_url();?>manage_seller_order/cancel_reason">
      <div class="modal-body">
       <h4>Mention Reason For Cancelation of this Product.</h4>

         <textarea type="text" name="cancel_reason" id="cancel_reason" class="form-control" onkeypress="cancel_reason(this.value)"></textarea>
          <input type="hidden" name="order_details_id"  value="" id="order_details_id" >                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" >Submit</button> 
      </div>
      </form>
    </div>

  </div>
</div>


       <script>
           function seller_order_status_change(value,id)
           {
                //alert(id);
                if(value=='Canceled')
                {
                  //alert(value);
                  $("#pwdModal").modal('show');
                  $("#order_details_id").val(id);

                  
                           
                }
                else
                {
                
                $.ajax(
                  {

                    type: "POST",
                    dataType: 'html',
                    url: base_url + "manage_seller_order/order_status_change",
                    data: {order_details_id:id,order_status:value},
                    async: false,
                    success: function (data) {
                           alert(data);
                           

                           alert('Order status has been successfully changed.');

                           //$("#cart_list").html(data);
                           //$('body').animate({ scrollTop: 40 }, 'slow')
                           location.reload();

                       }

                   });
              }
              
           }
       </script>
      
       <script>
           function delete_order(id)
           {
                //alert(id);
               if(confirm('Are you sure to delete your order From List ?'))
               { 
                $.ajax(
                  {

                    type: "POST",
                    dataType: 'html',
                    url: base_url + "manage_seller_order/order_delete",
                    data: {order_details_id:id},
                    async: false,
                    success: function (data) {
                           //alert(data);
                           

                           alert('Your order deleted successfully.');


                           //$("#cart_list").html(data);
                           //$('body').animate({ scrollTop: 40 }, 'slow')
                           location.reload();

                       }

                   });
                }
           }
       </script>




        
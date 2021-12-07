   


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


                                <h4 class="sell-p">My Account</h4>
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
                            <h3 class="title">Order History</h3>
                           </div>

                           
                         



                    <div class="table-responsive">
                        <?php 
                            if(count($order_list)>0){
                        ?>
                            <table id="sp-list">
                                <thead>
                                    <tr>
                                      
                                        <th class="sp-pad">Order ID</th>
                                        <!--  <th class="sp-pad">Order Status</th> -->
                                        <th class="sp-pad">Date Added</th>
                                        <th class="sp-pad">No. of Products</th>
                                        <th class="sp-pad">Payment Method</th>
                                        <th class="sp-pad">Total</th>
                                        <th class="sp-pad">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                        foreach($order_list as $list){
                                            $order_id = $list->order_id;
                                            $order_details = $this->common_model->common($table_name='tbl_order_details',$field=array(),$where=array('order_id'=>$order_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
                                    ?>
                                    <tr>
                                        
                                        <td>
                                            <h5><?php echo $list->order_unique_id;?></h5>
                                            
                                            
                                        </td>
                                        <!-- <td>
                                           <span><h5><?php echo $list->order_status;?></h5></span>
                                        </td> -->
                                        <td><h5><?php echo date('d-m-Y',strtotime($list->created_date));?></h5></td>
                                        
                                        <td><h5><?php echo count($order_details);?></h5></td>
                                        <td><h5><?php if($list->payment_status=='cod'){
                                            echo 'Cash On Delivery';} else { echo 'Online Payment'; }?></h5></td>
                                        
                                        <td><h5><i class="fa fa-inr"></i> <?php echo $list->order_total_price;?></h5></td>
                                        <td><a href="<?php echo $this->url->link(25);?>/<?php echo $list->order_id;?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            
                                            <!-- <a onclick="delete_order('<?php echo $list->order_id;?>')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>  -->
                                        
                                        </td>
                                        
                                    </tr>
                                <?php }  ?>
                                    
                                    

                                </tbody>
                            </table>
                            <?php } else { echo 'You have no order.'; } ?>
                            <!-- <div class="save-btn">
                            
                                    <button type="submit" class="btn btn-default">save</button>
                            
                                    </div> -->
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
                    url: base_url + "manage_order/order_delete",
                    data: {order_id:id},
                    async: false,
                    success: function (data) {
                           //alert(data);
                           
                           alert('Your order deleted successfully.');

                           location.reload();

                       }

                   });
                }
           }
       </script>
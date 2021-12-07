    


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                  <?php 
                                    if(@$seller_detail[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$seller_detail[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$seller_detail[0]->first_name.' '.@$seller_detail[0]->last_name; ?></h4>
                            </div>


                                <h4 class="sell-p">My Account</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
                                <li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
                              <!--   <li><a href="seller-review.php">Reviews</a></li> -->
                                <li><a href="<?php echo $this->url->link(30); ?>">Close my account</a></li>
                                <li><a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(29); ?>">Add a Single Product</a></li>
                               <!--  <li><a href="seller-featured-product.php">My featured Products</a></li> -->
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
                            <h3 class="title">Close Account</h3>
                           </div>

                           <div class="r-bx">

                           <div class="col-md-12" id="review">
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
                                <div class="sca">
                                        <p>Do you really want to close your account? Once you confirm to close your Seller account in DSY Apnabazar. your profile as Seller will be disabled in our system. thus buyer will not be able to find your business neither your products in our data base. However. you will be able to purchase as a regular user. <b>If you want to restore your account, Contact Your Admin.</b></p>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                                        <button class="btn-yes" onclick="close_account()" type="button">Yes</button>
                                        <!-- <button class="btn-no" type="button">No</button> -->
                                    </div>



                           </div>

                          <!--  <div class="save-btn">

                                    <button type="submit" class="btn btn-default" id="sca-mar">save</button>

                                    </div> -->
                                      <!-- <a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a> -->
                           </div>


                           

                           </div>
                          



















                        
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->

        <script type="text/javascript">
          function close_account(id)
          {
            if(confirm('Are you sure to Close the account?'))
            {
                window.location.href="<?php echo base_url();?>seller_bussiness_profile/close_account/"+id;
            }
          }
        </script>

       
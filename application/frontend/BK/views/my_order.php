      

        

        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">

                                <div class="profile-image">
                                    <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$user_details[0]->image;?>" class="img-responsive" alt="" />
                                </div>
                                <h4 class="my-name"><?php echo @$user_details[0]->first_name;?> <?php echo @$user_details[0]->last_name;?></h4>
                            </div>
                            <ul>
                                <li><a href="<?php echo $this->url->link(5);?>">Edit Profile</a></li>
                                <li><a href="<?php echo $this->url->link(6);?>">Change Password</a></li>
                                <li class="active"><a href="<?php echo $this->url->link(24);?>">My Order</a></li>
                                <li><a href="<?php echo $this->url->link(7);?>">My Wishlist</a></li>
                                <li><a href="<?php echo $this->url->link(31); ?>">Close my account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">My Order</h3>

                        <?php 
                        if(count($order_list)>0)
                        {
                            foreach($order_list as $order)
                            {

                                


                        ?>

                            <div class="myorder-content">
                                <div class="head">
                                    <h5>Lorem Ipsum<a href="#"><span>Order ID - #255</span></a></h5>
                                </div>
                                <div class="body clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                       <img src="assets/images/products/p2.jpg" class="img-responsive od-img" alt="" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <ul>
                                            <li>Quantity : <div>2</div></li>
                                            <li>Size : <div>XL</div></li>
                                            <!-- <li>Color : 
                                                <div>  
                                                    <ul class="color-box">
                                                        <label class="radio">
                                                            <input id="radio1" type="radio" name="radios1" checked />
                                                            <span class="outer" style="border: 2px solid red;">
                                                                <span class="inner" style="background-color: red;"></span>
                                                            </span>
                                                        </label>
                                                    </ul>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="price"><i class="fa fa-inr"></i> 500</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="status">Delivered on <span>Fri, Feb 5th '16</span></p>
                                        <small>Your item has been delivered</small>
                                    </div>
                                </div>
                                <div class="foot">
                                    <h5>Ordered On <span>Fri, Sep 16th '16 </span> <span class="total-price"><i class="fa fa-inr"></i> 1000</span></h5>
                                </div>
                            </div><!--//single-order-content-->

                    <?php }  

                      }  ?>

                            <!-- <div class="myorder-content">
                                <div class="head">
                                    <h5>Lorem Ipsum<span>Order ID - #255</span></h5>
                                </div>
                                <div class="body clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <img src="assets/images/products/p12.jpg" class="img-responsive od-img" alt="" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <ul>
                                            <li>Quantity : <div>2</div></li>
                                            <li>Size : <div>XL</div></li>
                                           <li>Color : 
                                                <div>  
                                                    <ul class="color-box">
                                                        <label class="radio">
                                                            <input id="radio2" type="radio" name="radios2" checked="" />
                                                            <span class="outer" style="border: 2px solid black;">
                                                                <span class="inner" style="background-color: black;"></span>
                                                            </span>
                                                        </label>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="price"><i class="fa fa-inr"></i> 500</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="status">Delivered on <span>Fri, Feb 5th '16</span></p>
                                        <small>Your item has been delivered</small>
                                    </div>
                                </div>
                                <div class="foot">
                                    <h5>Ordered On <span>Fri, Sep 16th '16 </span> <span class="total-price"><i class="fa fa-inr"></i> 1000</span></h5>
                                </div>
                            </div> --><!--//single-order-content-->
                            <!-- <div class="myorder-content">
                                <div class="head">
                                    <h5>Lorem Ipsum<span>Order ID - #255</span></h5>
                                </div>
                                <div class="body clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                       <img src="assets/images/products/p30.jpg" class="img-responsive od-img" alt="" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <ul>
                                            <li>Quantity : <div>2</div></li>
                                            <li>Size : <div>XL</div></li>
                                         <li>Color : 
                                                <div>  
                                                    <ul class="color-box">
                                                        <label class="radio">
                                                            <input id="radio3" type="radio" name="radios" checked="" />
                                                            <span class="outer" style="border: 2px solid green;">
                                                                <span class="inner" style="background-color: green;"></span>
                                                            </span>
                                                        </label>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="price"><i class="fa fa-inr"></i> 500</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p class="status">Delivered on <span>Fri, Feb 5th '16</span></p>
                                        <small>Your item has been delivered</small>
                                    </div>
                                </div>
                                <div class="foot">
                                    <h5>Ordered On <span>Fri, Sep 16th '16 </span> <span class="total-price"><i class="fa fa-inr"></i> 1000</span></h5>
                                </div>
                            </div> --><!--//single-order-content-->
                        </div>
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->

      
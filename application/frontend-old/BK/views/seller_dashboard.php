	


        <section class="my-account-wrapper">
        	<div class="container">
        		<div class="row clearfix">
        			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        				<div class="myaccount-sidebar">
        					<div class="profile-content">
        						<div class="profile-image">
                                <?php 
                                    if(@$seller_dashboard[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$seller_dashboard[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
        							
        						</div>
        						<h4 class="my-name"><?php echo @$seller_dashboard[0]->first_name.' '.@$seller_dashboard[0]->last_name; ?></h4>
        					</div>


                                <h4 class="sell-p">My Account</h4>
        					<ul>
    							<li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
    							<li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
    							<!-- <li><a href="seller-review.php">Reviews</a></li> -->
    							<li><a href="<?php echo $this->url->link(30); ?>">Close my account</a></li>
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
        					<h3 class="title">Dashboard</h3>
                            <div class="form-container">
                                <!-- <form action="">
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="" class="form-control" placeholder="Name" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="email" name="" class="form-control" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="" class="form-control" placeholder="Phone Number" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="email" name="" class="form-control" placeholder="City" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="" class="form-control" placeholder="State" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="email" name="" class="form-control" placeholder="Pin Code" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <textarea class="form-control" rows="4" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <button class="btb pull-right">Submit</button>
                                </form> -->
                                <div class="col-md-3 col-xs-6">
                                    <div class="grid-wrap dg-color-1">
                                        <p>
                        <span>
                        <?php
                        $total_order= count($total_order);
                        if(strlen($total_order)<2) 
                        {
                            $total_order='0'.$total_order;
                        }
                        else{
                            $total_order=$total_order;
                        }
                             echo $total_order; 
                        ?>
                      </span>
                                        </p>
                                        <p>Orders</p>
                                    </div>
                                </div>

                                 <div class="col-md-3 col-xs-6">
                                    <div class="grid-wrap dg-color-2">
                                        <p><span>
                        <?php
                        $total_product= count($total_product);
                        if(strlen($total_product)<2) 
                        {
                            $total_product='0'.$total_product;
                        }
                        else{
                            $total_product=$total_product;
                        }
                             echo $total_product; 
                        ?>
                      </span>
                                        </p>
                                        <p>Products</p>
                                    </div>
                                </div>


                                 <div class="col-md-3 col-xs-6">
                                    <div class="grid-wrap dg-color-3">
                                        <p>
                        <span> 
                                        <?php
                        $total_feature_product= count($total_feature_product);
                        if(strlen($total_feature_product)<2) 
                        {
                            $total_feature_product='0'.$total_feature_product;
                        }
                        else{
                            $total_feature_product=$total_feature_product;
                        }
                             echo $total_feature_product; 
                        ?>
                            
                        </span>
                                        </p>
                                        <p>Feature Products</p>
                                    </div>
                                </div>

                                 <!-- <div class="col-md-3 col-xs-6">
                                    <div class="grid-wrap dg-color-4">
                                        <p><span>15</span>
                                        </p>
                                        <p>Awaiting Delivery</p>
                                    </div>
                                </div> -->

                            </div>



<!-- <div class="main-wrap static-page checkout-wrapper">
            <div class="container">
               
                
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="seller-dash">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5>0011</h5>
                                        </td>
                                        <td>
                                            <h5>Carlos Cortes</h5>
                                            
                                            
                                        </td>
                                        <td>
                                            <span class="availability-status label label-success">Active</span>
                                        </td>
                                        <td><h5>05/10/2016</h5></td>
                                        <td><h5>2,500.00€</h5></td>
                                        <td><a href="#" class="seller-view"><i class="fa fa-trash"></i></a></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                           <h5>0011</h5>
                                        </td>
                                        <td>
                                            <h5>Carlos Eduardo Cortés</h5>
                                          
                                            
                                        </td>
                                        <td>
                                            <span class="availability-status label label-success">Active</span>
                                        </td>
                                        <td><h5>05/10/2016</h5></td>
                                        <td><h5>2,500.00€</h5></td>
                                        <td><a href="#" class="seller-view"><i class="fa fa-trash"></i></a></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                           <h5>0011</h5>
                                        </td>
                                        <td>
                                            <h5>srk</h5>
                                          
                                            
                                        </td>
                                        <td>
                                            <span class="availability-status label label-success">Active</span>
                                        </td>
                                        <td><h5>05/10/2016</h5></td>
                                        <td><h5>2,500.00€</h5></td>
                                        <td><a href="#" class="seller-view"><i class="fa fa-trash"></i></a></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                           <h5>0011</h5>
                                        </td>
                                        <td>
                                            <h5>sufiyan ksr</h5>
                                          
                                            
                                        </td>
                                        <td>
                                            <span class="availability-status label label-success">Active</span>
                                        </td>
                                        <td><h5>05/10/2016</h5></td>
                                        <td><h5>2,500.00€</h5></td>
                                        <td><a href="#" class="seller-view"><i class="fa fa-trash"></i></a></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                           <h5>0011</h5>
                                        </td>
                                        <td>
                                            <h5>Carlos Cortes</h5>
                                          
                                            
                                        </td>
                                        <td>
                                            <span class="availability-status label label-success">Active</span>
                                        </td>
                                        <td><h5>05/10/2016</h5></td>
                                        <td><h5>2,500.00€</h5></td>
                                        <td><a href="#" class="seller-view"><i class="fa fa-trash"></i></a></td>
                                        
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div> -->

<!-- <div class="table-responsive">
                            <table id="sp-list" class="sb-mar">
                                <thead>
                                    <tr>
                                       
                                         <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>
                                            <h5>110</h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5>sirajul sk</h5></span>
                                        </td>
                                        <td><h5>active</h5></td>
                                        
                                        <td><h5>05/10/2016</h5></td>
                                        
                                          <td><h5>2,500.00€</h5></td>
                                        
                                        <td><a href="#" class="seller-view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        <td>
                                            <h5>110</h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5>sirajul sk</h5></span>
                                        </td>
                                        <td><h5>active</h5></td>
                                        
                                        <td><h5>05/10/2016</h5></td>
                                        
                                          <td><h5>2,500.00€</h5></td>
                                        
                                        <td><a href="#" class="seller-view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        
                                    </tr>


                                    <tr>
                                        
                                        <td>
                                            <h5>110</h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5>sirajul sk</h5></span>
                                        </td>
                                        <td><h5>active</h5></td>
                                        
                                        <td><h5>05/10/2016</h5></td>
                                        
                                          <td><h5>2,500.00€</h5></td>
                                        
                                        <td><a href="#" class="seller-view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        
                                    </tr>


                                    <tr>
                                        
                                        <td>
                                            <h5>110</h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5>sirajul sk</h5></span>
                                        </td>
                                        <td><h5>active</h5></td>
                                        
                                        <td><h5>05/10/2016</h5></td>
                                        
                                          <td><h5>2,500.00€</h5></td>
                                        
                                        <td><a href="#" class="seller-view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        <td>
                                            <h5>110</h5>
                                            
                                            
                                        </td>
                                        <td>
                                           <span><h5>sirajul sk</h5></span>
                                        </td>
                                        <td><h5>active</h5></td>
                                        
                                        <td><h5>05/10/2016</h5></td>
                                        
                                          <td><h5>2,500.00€</h5></td>
                                        
                                        <td><a href="#" class="seller-view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        
                                    </tr>
                                    


                                      

                                   
                                   
                                </tbody>
                            </table>

                           

                        </div>
 -->















        				</div>
        			</div>
        		</div>
        	</div>
        </section><!--//my-account-wrapper-->

        
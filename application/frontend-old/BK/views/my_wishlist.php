      

        

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
                                <h4 class="my-name"><?php echo @$user_details[0]->first_name.' '.@$user_details[0]->last_name; ?></h4>
                            </div>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(5);?>">Edit Profile</a></li>
                                <li><a href="<?php echo $this->url->link(6);?>">Change Password</a></li>
                                <li><a href="<?php echo $this->url->link(24);?>">My Order</a></li>
                                <li><a href="<?php echo $this->url->link(7);?>">My Wishlist</a></li>
                                <li><a href="<?php echo $this->url->link(27); ?>">Close my account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

                        <div class="myaccount-widget">
                        <?php
                            if($this->session->flashdata('err_msg')!='')
                             {
                                ?>
                                <span style="color:red;"><b><?php echo $this->session->flashdata('err_msg'); ?></b></span>
                            <?php
                            }?> 
                            <?php
                            if($this->session->flashdata('succ_msg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_msg'); ?></b></span>
                            <?php
                            }?> 
                            <h3 class="title">My Wishlist</h3>

                <?php if(count($wish_list)>0){

                        foreach($wish_list as $list){
                            $product_id = $list->product_id;
                            $product =  $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                            $product_image =  $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                    ?>
                            <div class="myorder-content">
                                <div class="head">
                                    <h5 class="wn"><a href="<?php echo $this->url->link(4);?>/<?php echo @$product[0]->id; ?>/<?php echo @$product[0]->slug; ?>"><?php echo $list->product_name;?></a></h5>

                                    <div class="bx-right">
                                    <?php if(@$product[0]->availability=='Yes'){?>
                                    <a href="" class="btn btn-info" >Available</a>
                                    <?php } else { ?>
                                    <a href="" class="btn btn-warning" >Out of stock</a>
                                    <?php } ?>
                                       
                                    </div>
                                    
                                </div>
                                <div class="body clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <a href="<?php echo $this->url->link(4);?>/<?php echo @$product[0]->id; ?>/<?php echo @$product[0]->slug; ?>">
                                       <img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image[0]->image;?>" class="img-responsive od-img" alt="" />
                                    </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <!-- <ul>
                                            <li>Quantity : <div>2</div></li>
                                            <li>Size : <div>XL</div></li>
                                         
                                        </ul> -->
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <!-- <p class="price"><i class="fa fa-inr"></i> 500</p> -->
                                        <ul>
                                            <li><b>Price : </b><div> <i class="fa fa-inr"></i> <?php echo @$product[0]->price;?></div></li>
                                            <li><b>Discount : </b><div><?php if(@$product[0]->discount!=''){ echo round(@$product[0]->discount);?> % <?php } else { 'N/A'; } ?></div></li>
                                            <li><b>Net Price : </b><div><i class="fa fa-inr"></i> <?php if(@$product[0]->discount!=''){ echo @$product[0]->net_price; } else { echo @$product[0]->price; }?></div></li>
                                        </ul> 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-1">
                                        <p class="del" style="cursor: pointer;" onclick=remove_wishlist('<?php echo $list->wish_id;?>')><i class="fa fa-trash" aria-hidden="true"></i></p>
                                        
                                    </div>
                                    <?php if(@$product[0]->availability=='Yes'){?>
                                    <a href="#" class="btn btn-success bx-right mar" id="but-cl" onclick="buy_single(<?php echo @$product[0]->id;?>)">Buy Now</a>
                                    <?php } else { ?>
                                    <a href="#" class="btn btn-success bx-right mar" id="but-cl" disabled title="Out Of Stock">Buy Now</a>
                                    <?php } ?>
                                </div>
                                <div class="foot">

                                       
                                </div>
                            </div><!--//single-order-content-->

                    <?php }  }  else { echo 'No Wishlist Products Available.'; }?>

                            

                                
                        </div>
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->

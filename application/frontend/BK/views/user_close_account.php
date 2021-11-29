    


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="myaccount-sidebar">
                  <div class="profile-content">
                    <div class="profile-image">
                    <?php 
                    if(@$user_detail[0]->image!='')
                    { ?>
                        <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$user_detail[0]->image;?>" class="img-responsive" alt="" />
                    <?php  } else { ?>
                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                    <?php } ?>
                      
                    </div>
                    <h4 class="my-name"><?php echo @$user_detail[0]->first_name.' '.@$user_detail[0]->last_name; ?></h4>
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
                            <h3 class="title">Close Account</h3>
                           </div>

                           <div class="r-bx">

                           <div class="col-md-12" id="review">
                            <div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
                                <div class="sca">
                                        <p>Do you really want to close your account? Once you confirm to close your buyer account in DSY Apnabazar . your profile as buyer will be disabled in our system. <b>If you want to restore your account, Contact Your Admin.</b></p>
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
                window.location.href="<?php echo base_url();?>my_account/close_account/"+id;
            }
          }
        </script>

       